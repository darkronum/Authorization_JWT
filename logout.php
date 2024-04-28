<?php

session_start();
setcookie('token');
$_SESSION['msg'] = "<p style='color: green;'>Deslogado com sucesso!</p>";
header("Location: index.php");
?>
