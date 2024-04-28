<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "authorization_jwt";

try {
    $conn = new PDO("mysql:host=$host;dbname=" . $dbname, $user, $pass);
} catch (PDOException $err) {
    echo "Erro: Conexão com banco de dados não realizada com sucesso. Erro gerado " . $err->getMessage();
}
?>
