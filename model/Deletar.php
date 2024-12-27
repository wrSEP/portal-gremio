<?php
session_start();
require_once('../config/db.php');

// Verificar se o usuário está autenticado
if (!isset($_SESSION['usuario_nome'])) {
    header("Location: ../views/login.php");
    exit();
}

// Verifica se o ID foi passado na URL
if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    echo "ID recebido: " . $id; // Converte o ID para garantir que é um número

    // Verifica se a publicação com o ID fornecido realmente existe
    $sql = "SELECT id_pla FROM tblPublicacao WHERE id_pla = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Se a publicação existe, continua o processo de exclusão
        $conn->begin_transaction();

        // Deletar a publicação pela ID
        $deleteSql = "DELETE FROM tblPublicacao WHERE id_pla = ?";
        $deleteStmt = $conn->prepare($deleteSql);
        $deleteStmt->bind_param("i", $id);

        if ($deleteStmt->execute()) {
            // Commit da transação se a exclusão for bem-sucedida
            $conn->commit();
            header("Location: ../views/gremio/feed_adm/feedADM.php"); // Redireciona de volta para a página de publicações
            exit();
        } else {
            // Rollback em caso de erro
            $conn->rollback();
            echo "Erro ao deletar: " . $conn->error;
        }

        $deleteStmt->close();
    } else {
        echo "Publicação não encontrada!";
    }

    $stmt->close();
} else {
    echo "ID não fornecido!";
}
?>
