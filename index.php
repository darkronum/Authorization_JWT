<?php
session_start();
ob_start();

include_once 'connection.php';

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Darkronum - Login com token e cookie</title>
</head>
<body>
    <h1>Login</h1>

    <?php

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (!empty($dados['SendLogin'])) {

    $query_usuario = "SELECT id, nome, usuario, email, senha 
                FROM usuarios
                WHERE usuario = :usuario
                LIMIT 1";

    $result_usuario = $conn->prepare($query_usuario);
    $result_usuario->bindParam(':usuario', $dados['usuario']);

    $result_usuario->execute();

    if (($result_usuario) && ($result_usuario->rowCount() != 0)) {

        $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);

        if (password_verify($dados['senha'], $row_usuario['senha'])) {

            $duracao = time() + (7 * 24 * 60 * 60);

            $payload = [
                'exp' => $duracao,
                'id' => $row_usuario['id'],
                'nome' => $row_usuario['nome'],
                'email' => $row_usuario['email']
            ];

            $jwt = jwt_encode($payload);

            setcookie('token', $jwt, (time() + (7 * 24 * 60 * 60)));

            header("Location: dashboard.php");

        } else {
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário ou senha inválida!</p>";
        }
    } else {
        $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário ou senha inválida!</p>";
    }
}

if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>

    <form method="POST" action="">
        <label>Usuário: </label>
        <input type="text" name="usuario" placeholder="Digite o usuário"><br><br>

        <label>Senha: </label>
        <input type="password" name="senha" placeholder="Digite a senha"><br><br>

        <input type="submit" name="SendLogin" value="Acessar"><br><br>
    </form>

    <br><br>
    Usuário: admin@admin.com.br<br>
    Senha: 123456
    
</body>
</html>

<?php
function jwt_encode($payload) {
    $header = json_encode(['alg' => 'HS256', 'typ' => 'JWT']);
    $header = base64_encode($header);

    $payload = json_encode($payload);
    $payload = base64_encode($payload);

    $signature = hash_hmac('sha256', "$header.$payload", 'DGBU85S46H9M5W4X6OD7', true);
    $signature = base64_encode($signature);

    return "$header.$payload.$signature";
}
?>
