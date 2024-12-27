<?php
require_once('../config/db.php');
session_start(); // Inicia a sessão


class Usuario {
    private $conn;
    private $table_name = "tblUsuario"; // Nome da tabela

    public $id_usu;
    public $Usu_RM;
    public $Usu_nome;
    public $Usu_telefone;
    public $Usu_emailETEC;
    public $Usu_senhaETEC;
    public $Usu_numAcesso;

  

    public function __construct($db) {
        $this->conn = $db;
    }

    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $result = $this->conn->query($query);

        // Verificar se houve erro na consulta
        if (!$result) {
            throw new Exception("Erro na consulta: " . $this->conn->error);
        }

        return $result;
    }


    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (Usu_RM, Usu_nome, Usu_telefone, Usu_emailETEC, Usu_senhaETEC, Usu_numAcesso) 
                  VALUES (?, ?, ?, ?, ?, ?)";
    
        $stmt = $this->conn->prepare($query);
    
        if (!$stmt) {
            echo "Erro na preparação da consulta: " . $this->conn->error;
            return false;
        }
    
        $stmt->bind_param(
            "issssi",
            $this->Usu_RM,
            $this->Usu_nome,
            $this->Usu_telefone,
            $this->Usu_emailETEC,
            $this->Usu_senhaETEC,
            $this->Usu_numAcesso
        );
    
        if ($stmt->execute()) { 
            header('Location: ../views/login.php');
            exit; // Garante que o script pare após o redirecionamento
            return true;
           
        } else {
            echo "Erro ao cadastrar: " . $stmt->error;
            return false;
        }
    } 
    
   /*  public function verificar_usuario($Usu_emailEntrar, $Usu_senhaEntrar) {
        $stmt = $this->conn->prepare("SELECT Usu_senhaETEC, Usu_numAcesso FROM " . $this->table_name . " WHERE Usu_emailETEC = ?");
        $stmt->bind_param("s", $Usu_emailETEC);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $row = $resultado->fetch_assoc();
            if (password_verify($Usu_senhaEntrar, $row['Usu_senhaETEC'])) {
                return $row['Usu_numAcesso']; // Retorna o número de acesso
            }
        }
        return false; // Usuário não encontrado ou senha incorreta
    }

}
 */
}

// Criando a instância do usuário
$usuario = new Usuario($conn);
$stmt = $usuario->readAll();


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // CADASTRO


    // Verifica se todos os campos foram preenchidos
    if (
        isset($_POST['Usu_RM'], $_POST['Usu_nome'], $_POST['Usu_telefone'], 
              $_POST['Usu_emailETEC'], $_POST['Usu_senhaETEC'], $_POST['Usu_numAcesso'])
    ) {
        // Atribuir os valores recebidos aos atributos do objeto
        $usuario->Usu_RM = $_POST['Usu_RM'];
        $usuario->Usu_nome = $_POST['Usu_nome'];
        $usuario->Usu_telefone = $_POST['Usu_telefone'];
        $usuario->Usu_emailETEC = $_POST['Usu_emailETEC'];
        $usuario->Usu_senhaETEC = password_hash($_POST['Usu_senhaETEC'], PASSWORD_BCRYPT);
        $usuario->Usu_numAcesso = $_POST['Usu_numAcesso'];

        // Tenta inserir os dados no banco
        if ($usuario->create()) {
            echo "Cadastro realizado com sucesso!";
        } else {
            echo "Erro ao cadastrar: " . $conn->error;
        }
    } else {
        echo "Todos os campos são obrigatórios.";
    }
}
 
// Verificação de login

/* if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Usu_emailEntrar = $_POST['Usu_emailEntrar'];
    $Usu_senhaEntrar = $_POST['Usu_senhaEntrar'];

    // Busca o usuário pelo nome
    $stmt = $conn->prepare("SELECT Usu_senhaETEC FROM $table_name WHERE Usu_emailETEC = ?");
    $stmt->bind_param("s", $Usu_emailETEC);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($Usu_senhaETEC);
        $stmt->fetch();

        // Verifica se a senha está correta
        if (password_verify($Usu_senhaEntrar, $Usu_senhaETEC)) {
            echo "Login bem-sucedido! Bem-vindo, $Usu_emailEntrar!";
        } else {
            echo "Senha incorreta.";
        }
    } else {
        echo "Usuário não encontrado.";
    }

}
 */

// Verificando se há resultados
if ($stmt && $stmt->num_rows > 0) {
    // Exibe os dados
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>RM</th><th>Nome</th><th>Telefone</th><th>Email</th><th>Senha</th><th>Número de Acesso</th></tr>";

    while ($linha = $stmt->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $linha["id_usu"] . "</td>";
        echo "<td>" . $linha["Usu_RM"] . "</td>";
        echo "<td>" . $linha["Usu_nome"] . "</td>";
        echo "<td>" . $linha["Usu_telefone"] . "</td>";
        echo "<td>" . $linha["Usu_emailETEC"] . "</td>";
        echo "<td>" . $linha["Usu_senhaETEC"] . "</td>";
        echo "<td>" . $linha["Usu_numAcesso"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Nenhum registro encontrado.";
}

// Fechar a conexão
$conn->close();
?>
