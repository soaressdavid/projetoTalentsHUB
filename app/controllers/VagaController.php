<?php

require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../models/Vaga.php';
session_start();

if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'empresa') {
    header("Location: /ProjetoTalents/app/views/auth.php");
    exit();
}

$vagaModel = new Vaga($conn);
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset ($_POST['action']) && $_POST['action'] === 'create') {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $requisitos = $_POST['requisitos'];
    $localizacao = $_POST['localizacao'];
    $empresa_id = $_SESSION['usuario_id'];

    if($vagaModel->create($titulo, $descricao, $requisitos, $localizacao, $empresa_id)) {
        $_SESSION['vaga_sucesso'] = "Vaga publicada com suceso!";
    } else {
        $_SESSION['vaga_erro'] = "Erro ao publicar vaga";
    }

    header("Location: /ProjetoTalents/app/views/painel_empresa.php");
    exit();
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] === 'upadate') {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $requisitos = $_POST['requisitos'];
    $localizacao = $_POST['localizacao'];

    $vaga = $vagaModel ->findById($id);

    if ($vaga['empresa_id'] !== $_SESSION['usuario_id']) {
        $_SESSION['vaga_erro'] = "Você não tem permissão para editar esta vaga.";
    header("Location: /ProjetoTalents/app/views/painel_empresa.php");
        exit();
    }

    if ($vagaModel->delete($id)) {
        $_SESSION['vaga_sucesso'] = "Vaga deletada com sucesso!";
    } else {
        $_SESSION['vaga_erro'] = "Erro ao deletar vaga.";
    }
    header("Location: /ProjetoTalents/app/views/painel_empresa.php");
    exit();
}