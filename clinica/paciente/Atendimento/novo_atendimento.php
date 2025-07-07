<?php include_once('../includes/tema.php'); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Novo Atendimento</title>
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
            max-width: 600px;
            margin: auto;
            background-color: <?= $cardBg ?>;
            border: 1px solid var(--border-color);
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: var(--primary-dark);
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: var(--primary-dark);
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--primary-lightest);
            border-radius: 6px;
            background-color: <?= $cardBg ?>;
            color: <?= $textColor ?>;
        }

        .botoes {
            margin-top: 20px;
            display: flex;
            gap: 10px;
        }

        button, a.btn {
            background-color: var(--primary);
            color: var(--text-on-primary);
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            font-weight: 500;
        }

        button:hover, a.btn:hover {
            background-color: var(--primary-dark);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Novo Atendimento</h1>
        <form action="salvar_atendimento.php" method="POST">
            <div class="form-group">
                <label for="data">Data:</label>
                <input type="date" name="data" id="data" required>
            </div>

            <div class="form-group">
                <label for="tipo">Tipo:</label>
                <select name="tipo" id="tipo">
                    <option value="Presencial">Presencial</option>
                    <option value="Telefone">Telefone</option>
                </select>
            </div>

            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea name="descricao" id="descricao" rows="4"></textarea>
            </div>

            <div class="botoes">
                <button type="submit">Salvar</button>
                <a href="index.php" class="btn">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>
