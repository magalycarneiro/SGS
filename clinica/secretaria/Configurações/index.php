<?php
require_once('../Classes/Configuracoes.class.php');

// Processar formulário
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $notificacoes = isset($_POST['notificacoes']) ? 1 : 0;
    $tema = $_POST['tema'];

    Configuracoes::salvar($notificacoes, $tema);
    header("Location: index.php?salvo=1");
    exit();
}

// Carregar configurações atuais
$config = Configuracoes::carregar();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Preferências do Sistema</title>
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
            background-color: <?= $config['tema'] === 'escuro' ? 'var(--background-escuro)' : 'var(--background-claro)' ?>;
            color: <?= $config['tema'] === 'escuro' ? 'var(--text-color-escuro)' : 'var(--text-color-claro)' ?>;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 40px;
        }

        .container {
            max-width: 500px;
            margin: auto;
            background-color: <?= $config['tema'] === 'escuro' ? 'var(--card-background-escuro)' : 'var(--card-background-claro)' ?>;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            border: 1px solid var(--border-color);
        }

        h1 {
            font-size: 26px;
            margin-bottom: 25px;
            color: var(--primary-dark);
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
        }

        input[type="checkbox"] {
            margin-right: 10px;
        }

        select, input[type="checkbox"] {
            margin-top: 5px;
        }

        button {
            background-color: var(--primary);
            color: var(--text-on-primary);
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.3s;
            margin-top: 20px;
        }

        button:hover {
            background-color: var(--primary-dark);
        }

        .voltar {
            display: inline-block;
            margin-top: 25px;
            color: var(--primary-dark);
            text-decoration: none;
            font-weight: 500;
        }

        .voltar:hover {
            text-decoration: underline;
        }

        .mensagem {
            margin-bottom: 20px;
            color: green;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Preferências do Sistema</h1>

        <?php if (isset($_GET['salvo'])): ?>
            <p class="mensagem">✅ Configurações salvas com sucesso!</p>
        <?php endif; ?>

        <form method="POST" action="">
            <label>
                <input type="checkbox" name="notificacoes" <?= $config['notificacoes'] ? 'checked' : '' ?>>
                Notificações
            </label>

            <label for="tema">Tema:</label>
            <select id="tema" name="tema">
                <option value="claro" <?= $config['tema'] === 'claro' ? 'selected' : '' ?>>Claro</option>
                <option value="escuro" <?= $config['tema'] === 'escuro' ? 'selected' : '' ?>>Escuro</option>
            </select>

            <br>
            <button type="submit">Salvar</button>
        </form>

        <a class="voltar" href="../index.php">← Voltar ao painel</a>
    </div>
</body>
</html>
