<?php
//session_start();
require_once(__DIR__ . '/../config/db.php');  // CAMINHO ABSOLUTO PARA NÃO DAR ERRO COM O FEED ADM
//var_dump($_SESSION['usuario_nome']); // mostra o usuario da session

class Publicacao {
    private $conn;

    // Imagens
    private $table_imagem = "tblImagensPost";  
    public $Img_caminhoImg;

    // Publicação
    private $table_publicacao = "tblPublicacao";
    public $Pub_idUsuario;
    public $Pub_titulo;
    public $Pub_subTitulo;
    public $Pub_descricao;
    public $Pub_dataAnuncio;
    public $Pub_horaAnuncio; 

    private $table_usuario = "tblUsuario";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getPublicacoes() {
        $publicacoes = [];
        
        // Selecionando dados de várias tabelas usando JOIN
        $query = "
            SELECT 
                p.id_pla, 
                p.Pub_idUsuario, 
                p.Pub_titulo, 
                p.Pub_subTitulo, 
                p.Pub_idImagem1, 
                p.Pub_idImagem2, 
                p.Pub_descricao, 
                p.Pub_dataAnuncio, 
                p.Pub_horaAnuncio, 
                u.Usu_nome,  -- Nome do usuário
                i1.Img_caminhoImg AS Img1_caminho, -- Caminho da primeira imagem
                i2.Img_caminhoImg AS Img2_caminho  -- Caminho da segunda imagem
            FROM 
                " . $this->table_publicacao . " p
            LEFT JOIN " . $this->table_usuario . " u ON p.Pub_idUsuario = u.id_usu
            LEFT JOIN " . $this->table_imagem . " i1 ON p.Pub_idImagem1 = i1.id_ima
            LEFT JOIN " . $this->table_imagem . " i2 ON p.Pub_idImagem2 = i2.id_ima
            ORDER BY p.Pub_dataAnuncio DESC
        ";
    
        $stmt = $this->conn->prepare($query);
        if ($stmt === false) {
            throw new Exception("Erro na preparação da consulta: " . $this->conn->error);
        }
    
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Armazenando os resultados no array
        while ($row = $result->fetch_assoc()) {
            $publicacoes[] = $row;
        }
    
        $stmt->close();
        return $publicacoes;
    }
    
   
    public function select_usuario() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $nome_usuario = $_SESSION['usuario_nome'] ?? null; 

        if ($nome_usuario) {
            $stmt3 = $this->conn->prepare("SELECT id_usu FROM " . $this->table_usuario . " WHERE Usu_nome = ?");
            $stmt3->bind_param("s", $nome_usuario);
            $stmt3->execute();
            $resultadousuario = $stmt3->get_result();

            if ($resultadousuario->num_rows > 0) {
                $rowusuario = $resultadousuario->fetch_assoc();
                return $rowusuario['id_usu'];
            } else {
                return "Não foi possível obter o id";
            }
        } else {
            return "Nome de usuário não definido na sessão.";
        }
    }


    // Função para inserir a imagem
        public function create_imagens($caminhos) {
            foreach ($caminhos as $caminho) {
                $query = "INSERT INTO " . $this->table_imagem . " (Img_caminhoImg) VALUES (?)";
                $stmt = $this->conn->prepare($query);
                if (!$stmt) {
                    throw new Exception("Erro na preparação da consulta: " . $this->conn->error);
                }
                $stmt->bind_param("s", $caminho);
                $stmt->execute();
            }
            return true;
        }

    // Função para pegar id da imagem
    public function get_imagem($enderecoimg, $caminhos) {
        $caminhos[] = $enderecoimg;

        $queryimagem = "SELECT id_ima FROM " . $this->table_imagem . " WHERE Img_caminhoImg = ?";
        $stmtimagem = $this->conn->prepare($queryimagem);
        $stmtimagem->bind_param("s", $enderecoimg);  
        $stmtimagem->execute(); 
        $resultadoimagem = $stmtimagem->get_result();

        if ($resultadoimagem->num_rows > 0) {
            $rowimagem = $resultadoimagem->fetch_assoc();  
            return $rowimagem['id_ima'];
        } else {
            return null;
        }
    }

    // Função para criar publicação
    public function create_pub($caminhos) {
        // Pega os IDs das imagens
        $id_endereco1 = isset($caminhos[0]) ? $this->get_imagem($caminhos[0], $caminhos) : null;
        $id_endereco2 = isset($caminhos[1]) ? $this->get_imagem($caminhos[1], $caminhos) : null;

        // Se não houver a segunda imagem, passamos NULL para Pub_idImagem2
        if (empty($id_endereco2)) {
            $id_endereco2 = null;
        }

        // Inserir dados na tabela de publicação
        $query2 = "INSERT INTO " . $this->table_publicacao . " (Pub_idUsuario, 
                Pub_titulo, 
                Pub_subTitulo, 
                Pub_idImagem1, 
                Pub_idImagem2, 
                Pub_descricao, 
                Pub_dataAnuncio, 
                Pub_horaAnuncio) VALUES (?,?,?,?,?,?,?,?)"; 

        $stmt2 = $this->conn->prepare($query2);
        if (!$stmt2) {
            throw new Exception("Erro na preparação da consulta: " . $this->conn->error);
        }

        $stmt2->bind_param("issiisss", 
            $this->Pub_idUsuario, 
            $this->Pub_titulo,
            $this->Pub_subTitulo, 
            $id_endereco1,  
            $id_endereco2,
            $this->Pub_descricao, 
            $this->Pub_dataAnuncio, 
            $this->Pub_horaAnuncio
        );

        if ($stmt2->execute()) {
            echo "Publicação criada com sucesso!";
            return header('Location: ../views/gremio/feed_adm/feedADM.php');

        } else {
            echo "Erro ao criar a publicação: " . $stmt2->error;
        }

    }

  
}

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    
    $publicacao = new Publicacao($conn);
    try {
        // Função para salvar as imagens
        function salvarImagem() {
            $imagem1 = $_FILES['imagem1'];
            $imagem2 = $_FILES['imagem2'];
            $diretorio = '../assets/';
            $caminhos = [];

            if (move_uploaded_file($imagem1['tmp_name'], $diretorio . basename($imagem1['name']))) {
                $caminhos[] = $diretorio . basename($imagem1['name']);
            }

            if (move_uploaded_file($imagem2['tmp_name'], $diretorio . basename($imagem2['name']))) {
                $caminhos[] = $diretorio . basename($imagem2['name']);
            }

            return $caminhos;
        }

        $caminhos = salvarImagem();
        $publicacao->create_imagens($caminhos);

        echo "Imagens inseridas com sucesso!";

        // Verificar se os dados da publicação foram passados corretamente
        if (isset($_POST['tituloPub'], $_POST['subTituloPub'], $_POST['descricao'], 
                  $_POST['dataAnuncio'], $_POST['horaAnuncio'])) {

            $usuario = $publicacao->select_usuario(); 
            $id_usuario = $usuario;
            $publicacao->Pub_idUsuario = $id_usuario;

            $publicacao->Pub_titulo = $_POST['tituloPub'];
            $publicacao->Pub_subTitulo = $_POST['subTituloPub'];
            $publicacao->Pub_descricao = $_POST['descricao'];
            $publicacao->Pub_dataAnuncio = $_POST['dataAnuncio'];
            $publicacao->Pub_horaAnuncio = $_POST['horaAnuncio'];

            // Criar publicação
            $resultado_pub = $publicacao->create_pub($caminhos);
            echo $resultado_pub;
        } else {
            echo "Todos os campos são obrigatórios.";
        }
    } catch (Exception $e) {
        echo "Erro: " . $e->getMessage();
    } 
}


?>
