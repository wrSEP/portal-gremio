<?php
session_start();

require_once('../config/db.php'); // Conexão com o banco

class UsuarioEntrar {
    private $conn;
    private $table_name = "tblUsuario"; // Nome da tabela

    public function __construct($db) {
        $this->conn = $db;
    }

    // Função para verificar login
    public function verificar_login($Usu_emailEntrar, $Usu_senhaEntrar) {
        $stmt = $this->conn->prepare("SELECT Usu_senhaETEC, Usu_nome, Usu_numAcesso FROM " . $this->table_name . " WHERE Usu_emailETEC = ?");
        $stmt->bind_param("s", $Usu_emailEntrar);  // Substitui o ? pelo e-mail
        $stmt->execute();
        $resultado = $stmt->get_result();  // Pega o resultado da consulta
       

        if ($resultado->num_rows > 0) {
            $row = $resultado->fetch_assoc();  // Pega a linha do resultado
            // Verifica se a senha digitada corresponde ao hash salvo
            if (password_verify($Usu_senhaEntrar, $row['Usu_senhaETEC'])) {

                 // Armazena o nome do usuário na sessão
                $_SESSION['usuario_nome'] = $row['Usu_nome'];
                
                if ($row['Usu_numAcesso'] == 1) {
                    header("Location: ../views/gremio/areaGremio.php"); // Redireciona para a página correspondente
                    exit();
                } else {
                    header("Location: ../views/aluno/areaAluno.php"); // Redireciona para outra página
                    exit();
                }
            } else {
                return "Senha incorreta.";
            }      

        } else {
            return "Usuário não encontrado.";
        }

        
    }
}

// Criando a instância da classe
$usuarioEntrar = new UsuarioEntrar($conn);

// Verifica se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Usu_emailEntrar = $_POST['Usu_emailEntrar'];
    $Usu_senhaEntrar = $_POST['Usu_senhaEntrar'];

    // Faz a verificação do login
    $resultado = $usuarioEntrar->verificar_login($Usu_emailEntrar, $Usu_senhaEntrar);

    // Exibe a mensagem apropriada
    if (is_numeric($resultado)) {
        echo "Login bem-sucedido! Bem-vindo, $Usu_emailEntrar!";
    } else {
        echo $resultado;  // Exibe "Usuário não encontrado" ou "Senha incorreta"
    }
}
?>
