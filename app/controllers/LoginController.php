<?php

require_once __DIR__ . "/../../config/config.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] = "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    try {
        $stmt = $conn->prepare("SELECT id, email, senha. tipo_usuario FROM usuario WHERE email = ?");
        $stmt->execute([$email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if($usuario && password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_email'] = $usuario['email'];
            $_SESSION['usuario_tipo'] = $usuario['tipo_usuario'];
            echo "Login bem-sucedido! Bem-vindo, " . $usuario['nome'] . "!";
        } else {
            echo "Email ou senha incorreta.";
        }
        $_SESSION['login_sucesso'] = "Login bem-sucedido! Bem-vindo, " . $usuario['nome'] . "!";
        header("Location: /projeto_rh/views/auth.php");
        exit();
    } catch (PDOException $e) {
        $_SESSION['login_erro'] = "Email ou senha incorretos.";
        header("Location: /projeto_rh/views/auth.php");
        exit();
    }
}