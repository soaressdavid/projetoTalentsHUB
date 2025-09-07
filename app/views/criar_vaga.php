<?php

session_start();

if(!isset($_SESSION['usuaro_id']) || $_SESSION['usuario_tipo'] !== 'empresa') {
    header("Location: /PROJETOTALENTS/app/views/auth.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        h2 {
            color: #0056b3;
            text-align: center;
        }

        form {
            background: #fff;
            padding: 2em;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        label {
            display: block;
            margin-bottom: 0.5em;
            font-weight: bold;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 0.8em;
            margin-bottom: 1em;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        
        textarea {
            resize: vertical;
        }

        input[type="submit"] {
            display: block;
            width: 100%;
            padding: 1em;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
            font-weight: bold;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .back-link {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #007bff;
            text-decoration: none;
        }
    </style>

</head>
<body>
    <h2>Criar Nova Vaga</h2>

    <form action="../app/controllers/VagaController.php" method="POST">
        <label for="titulo">Título da Vaga:</label><br>
        <input type="text" id="titulo" name="titulo" required><br><br>

        <label for="descricao">Descrição:</label><br>
        <textarea id="descricao" name="descricao" rows="5" required></textarea><br><br>

        <label for="requisitos">Requisitos:</label><br>
        <textarea id="requisitos" name="requisitos" rows="5" required></textarea><br><br>
        
        <label for="localizacao">Localização:</label><br>
        <input type="text" id="localizacao" name="localizacao" required><br><br>

        <input type="hidden" name="empresa_id" value="<?php echo htmlspecialchars($_SESSION['usuario_id']); ?>">
        
        <input type="submit" value="Publicar Vaga">
    </form>

    <a href="/ProjetoTalents/app/views/painel_empresa.php" class="back-link">Voltar ao painel</a>
</body>
</html>