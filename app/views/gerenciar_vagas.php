<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../models/Vaga.php';
session_start();

if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'empresa') {
    header("Location: /ProjetoTalents/app/views/auth.php");
    exit();
}

$vagaModel = new Vaga($conn);
$vagas = $vagaModel->findByEmpresaId($_SESSION['usuario_id']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Vagas</title>
    <link rel="stylesheet" href="../../public/css/style.css">
</head>
<body>

    <h2>Suas Vagas Publicadas</h2>
    
    <?php if (empty($vagas)): ?>
        <p>Você ainda não publicou nenhuma vaga.</p>
    <?php else: ?>
        <?php foreach ($vagas as $vaga): ?>
            <div class="vaga-item">
                <h3><?php echo htmlspecialchars($vaga['titulo']); ?></h3>
                <p><strong>Descrição:</strong> <?php echo nl2br(htmlspecialchars($vaga['descricao'])); ?></p>
                <p><strong>Requisitos:</strong> <?php echo nl2br(htmlspecialchars($vaga['requisitos'])); ?></p>
                <p><strong>Localização:</strong> <?php echo htmlspecialchars($vaga['localizacao']); ?></p>
                <div class="vaga-actions">
                    <a href="editar_vaga.php?id=<?php echo $vaga['id']; ?>" class="edit">Editar</a>
                    <form action="../controllers/VagaController.php" method="POST" style="display:inline;">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?php echo $vaga['id']; ?>">
                        <button type="submit" class="delete" onclick="return confirm('Tem certeza que deseja deletar esta vaga?');">Deletar</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <a href="/ProjetoTalents/app/views/painel_empresa.php">Voltar ao Painel</a>

</body>
</html>