<?php

require_once __DIR__ . '/../../config/config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] =="POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $tipo_usuario = $_POST['tipo_usuario'];

    $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

    try {
        $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha, tipo_usuario) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nome, $email, $senhaCriptografada, $tipo_usuario]);

        $usuario_id = $conn->lastInsertId();
        
        if ($tipo_usuario === 'candidato') {
            $stmt = $conn -> prepare("INSERT INTO candidatos (usuario_id) VALUES (?)");
            $stmt->execute([$usuario_id]);
        } elseif($tipo_usuario === 'empresa') {
            $stmt = $conn ->prepare("INSERT INTO empresas (usuario_id) VALUES (?)");
            $stmt->execute([$usuario_id]);
        }

        $_SESSION['cadastro_sucesso'] = "Cadastro de ". $tipo_usuario . " realizado com sucesso!";
        header("Location: /PROJETOTALENTS/app/views/auth.php");
        exit();
    } catch (PDOException $e) {
        $_SESSION['cadastro_erro'] = "Erro ao cadastrar " . $e->getMessage();
        header("Location: /PROJETOTALENTS/app/views/auth.php");
        exit();
    }
} else {
    header("Location: /PROJETOTALENTS/app/views/auth.php");
    exit();
}