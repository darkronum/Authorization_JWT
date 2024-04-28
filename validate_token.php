<?php

function validarToken(){
    if(!isset($_COOKIE['token'])) {
        return false;
    }

    $token = $_COOKIE['token'];
    $token_parts = explode('.', $token);
    if(count($token_parts) !== 3) {
        return false;
    }

    list($header, $payload, $signature) = $token_parts;

    $chave = "DGBU85S46H9M5W4X6OD7";

    $validar_assinatura = hash_hmac('sha256', "$header.$payload", $chave, true);
    $validar_assinatura = base64_encode($validar_assinatura);

    if($signature !== $validar_assinatura) {
        return false;
    }

    $dados_token = json_decode(base64_decode($payload));
    if(!$dados_token || !isset($dados_token->exp)) {
        return false;
    }

    if($dados_token->exp < time()) {
        return false;
    }

    return true;
}

function recuperarNomeToken(){
    if(!isset($_COOKIE['token'])) {
        return "";
    }

    $token = $_COOKIE['token'];
    $token_parts = explode('.', $token);
    if(count($token_parts) !== 3) {
        return "";
    }

    $payload = json_decode(base64_decode($token_parts[1]));
    if(!$payload || !isset($payload->nome)) {
        return "";
    }

    return $payload->nome;
}

function recuperarEmailToken(){
    if(!isset($_COOKIE['token'])) {
        return "";
    }

    $token = $_COOKIE['token'];
    $token_parts = explode('.', $token);
    if(count($token_parts) !== 3) {
        return "";
    }

    $payload = json_decode(base64_decode($token_parts[1]));
    if(!$payload || !isset($payload->email)) {
        return "";
    }

    return $payload->email;
}

?>
