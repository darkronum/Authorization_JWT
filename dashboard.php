<?php

session_start();
ob_start();

include_once 'validate_token.php';

if (!validarToken()) {
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Necessário realizar o login para acessar a página!</p>";
    header("Location: index.php");
    exit();
}

echo "Bem vindo " . recuperarNomeToken() . ". <br>";
echo "E-mail do usuário logado " . recuperarEmailToken() . ". <br>";
echo "<a href='logout.php'>Sair</a><br>";

?>
