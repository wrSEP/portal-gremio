<?php
require_once('../config/db.php');

class ImagensPost {
    private $conn;
    private $table_name = "tblimagensPost"; // Nome da tabela

    // Propriedades da imagem
    public $id_ima;
    public $Img_caminhoImg;
    public $Img_nome;
   
    // Construtor da classe
    public function __construct($db) {
        $this->conn = $db;
    }

    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name;
        return $this->conn->query($query);

         // Verificar se houve erro na consulta
         if (!$result) {
            throw new Exception("Erro na consulta: " . $this->conn->error);
        }

        return $result;
    }

    // Função para inserir a imagem e retornar o ID
    public function create($Img_caminhoImg) {
        $query = "INSERT INTO " . $this->table_name . " (Img_caminhoImg, Img_nome) VALUES (?,?)";
        $stmt = $this->conn->prepare($query);

          // Verificar se a preparação foi bem-sucedida
          if (!$stmt) {
            throw new Exception("Erro na preparação da consulta: " . $this->conn->error);
        }

        // Bind dos parâmetros e execução
        $stmt->bind_param("ss", $Img_caminhoImg, $Img_nome);

        if ($stmt->execute()) {
            // Retorna o ID da imagem recém inserida
            return $this->conn->insert_id; // Use insert_id para mysqli
        } else {
            throw new Exception("Erro ao inserir imagem: " . $stmt->error);
        }
    }
}
 /*  
// Criando a instância do usuário
$imagensPost = new ImagensPost($conn);
$stmt = $imagensPost->readAll();

// Verificando se há resultados
if ($stmt && $stmt->num_rows > 0) {
    // Exibe os dados
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>NomeImagem:</th><th>CaminhoImagem:</th><th>Data:</th><th>Hora:</th></tr>";

    while ($linha = $stmt->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $linha["id_imagensPost"] . "</td>";
        echo "<td>" . $linha["Img_nomeImg"] . "</td>";
        echo "<td>" . $linha["Img_caminhoImg"] . "</td>";
        echo "<td>" . $linha["Img_dataAdicionada"] . "</td>";
        echo "<td>" . $linha["Img_horaAdicionada"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Nenhum registro encontrado.";
}

// Fechar a conexão
$conn->close(); */


?>
