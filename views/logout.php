<?php
session_start(); // Inicia a sessão

// Verifica se a sessão está ativa
if (isset($_SESSION['usuario_nome'])) {
    // Remove todas as variáveis da sessão
    $_SESSION = array();
    
    // Destrói a sessão
    session_destroy(); 

    // Redireciona para a página de login
    header("Location: login.php");
    exit();
} else {
    // Redireciona para a página de login se não houver sessão ativa
    header("Location: login.php");
    exit();
}
?>
