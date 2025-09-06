<?php

session_start();

if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo']  !== 'candidato') {
    header("Location: /PROJETOTALENTS/app/views/auth.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=".css">
    <title>Pagina de Canditato</title>
</head>
<body>
    <h2>Bem-vindo, <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?></h2>
    <p>Este é o seu painel de candidato. Aqui você poderá ver suas candidaturas</p>

    <a href="/PROJETOTALESNTS/app/controllers/LogoutControler.php">Sair</a>
    
</body>
</html>
