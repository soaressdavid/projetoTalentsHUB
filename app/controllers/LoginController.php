<?php

require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../models/User.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $userModel = new User($conn);
    $usuario = $userModel->findByEmail($email);

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        $_SESSION['usuario_tipo'] = $usuario['tipo_usuario'];

        if ($usuario['tipo_usuario'] == 'candidato') {
            header("Location: /ProjetoTalents/app/views/painel_candidato.php");
        } elseif ($usuario['tipo_usuario'] == 'empresa') {
            header("Location: /ProjetoTalents/app/views/painel_empresa.php");
        } elseif ($usuario['tipo_usuario'] == 'admin') {
            header("Location: /ProjetoTalents/app/views/painel_admin.php");
        }
        
        exit();
    } else {
        $_SESSION['login_erro'] = "Email ou senha incorreto.";
        header("Location: /ProjetoTalents/app/views/auth.php");
        exit();
    }
} else {
    header("Location: /ProjetoTalents/app/views/auth.php");
    exit();
}