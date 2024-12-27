<?php
$host = "localhost"; //br612.hostgator.com.br
$usuario = "root"; // hubsap45_usrkefe
$senha = "";
$banco = "hubsap45_bd_kefe";

try {
    $conn = new mysqli($host, $usuario, $senha, $banco);

    if ($conn->connect_error) {
        throw new Exception("Falha na conexão: " . $conn->connect_error);
    }

   // echo "Conexão bem-sucedida!";
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}
?>
