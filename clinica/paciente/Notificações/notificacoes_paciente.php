<?php include_once('../includes/tema.php'); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificações</title>
    <style>
        :root {
            --primary-dark: #693E7F;
            --primary: #935CC4;
            --primary-light: #A56ACB;
            --accent: #B579DC;
            --background-claro: #f5f5f5;
            --background-escuro: #1E1E1E;
            --card-background-claro: #FFFFFF;
            --card-background-escuro: #2C2C2C;
            --text-color-claro: #212529;
            --text-color-escuro: #E5E5E5;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: <?= $background ?>;
            color: <?= $textColor ?>;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            background-color: <?= $cardBg ?>;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            color: var(--primary-dark);
            margin-bottom: 30px;
        }

        .no-notifications {
            text-align: center;
            font-size: 18px;
            padding: 40px 20px;
            border: 2px dashed var(--primary-light);
            border-radius: 8px;
            background-color: rgba(179, 121, 220, 0.08);
        }

        .btn-voltar {
            display: inline-block;
            margin-top: 30px;
            padding: 10px 20px;
            background-color: var(--primary);
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .btn-voltar:hover {
            background-color: var(--primary-dark);
        }

        .icon {
            font-size: 48px;
            color: var(--primary-light);
            margin-bottom: 15px;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <h1>Notificações</h1>

        <div class="no-notifications">
            <div class="icon"><i class="fas fa-bell-slash"></i></div>
            <p>Você não possui nenhuma notificação no momento.</p>
        </div>

        <div style="text-align: center;">
            <a href="../index.php" class="btn-voltar"><i class="fas fa-arrow-left"></i> Voltar ao painel</a>
        </div>
    </div>
</body>
</html>
