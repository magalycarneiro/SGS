<?php
include_once('../includes/tema.php'); 
require_once('../Classes/Atendimento.class.php');
$atendimentos = Atendimento::listarTodos();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Atendimentos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary-dark: #693E7F;
            --primary: #935CC4;
            --primary-light: #A56ACB;
            --primary-lighter: #B579DC;
            --primary-lightest: #C2AAE3;
            --text-on-primary: #FFFFFF;
            --background-claro: #F8F9FA;
            --background-escuro: #1E1E1E;
            --card-background-claro: #FFFFFF;
            --card-background-escuro: #2C2C2C;
            --text-color-claro: #212529;
            --text-color-escuro: #E5E5E5;
            --border-color: #E9ECEF;
        }

        body {
            background-color: <?= $background ?>;
            color: <?= $textColor ?>;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
        }

        .container {
            background-color: <?= $cardBg ?>;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            max-width: 800px;
            margin: auto;
            border: 1px solid var(--border-color);
        }

        h1 {
            color: var(--primary-dark);
            margin-bottom: 20px;
        }

        ul {
            list-style: none;
            padding-left: 0;
        }

        li {
            background-color: <?= $cardBg ?>;
            border: 1px solid var(--border-color);
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
        }

        a {
            color: var(--primary-dark);
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .mensagem {
            color: green;
            font-weight: bold;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Seus Atendimentos</h1>

        <?php if (isset($_GET['sucesso'])): ?>
            <p class="mensagem">✅ Atendimento cadastrado com sucesso!</p>
        <?php endif; ?>

        <ul>
            <?php foreach($atendimentos as $at): ?>
                <li><?= $at->getInfo(); ?></li>
            <?php endforeach; ?>
        </ul>

        <a href="novo_atendimento.php">+ Novo Atendimento</a><br>
        <a href="../index.php">Voltar ao painel</a>
    </div>
</body>
</html>
