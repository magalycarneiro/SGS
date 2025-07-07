<?php 
include_once('includes/tema.php');

// Define valores padrão caso as variáveis do tema não estejam definidas
if (!isset($background)) {
    $background = '#F8F9FA';  // cor clara padrão
}
if (!isset($textColor)) {
    $textColor = '#212529';
}
if (!isset($cardBg)) {
    $cardBg = '#FFFFFF';
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Painel do Paciente</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
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

        .header {
            background-color: var(--primary-dark);
            color: var(--text-on-primary);
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            font-size: 24px;
            font-weight: 600;
        }

        .dashboard {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .card {
            background-color: <?= $cardBg ?>;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: transform 0.2s, box-shadow 0.2s;
            cursor: pointer;
            text-align: center;
            border: 1px solid var(--border-color);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            border-color: var(--primary-light);
        }

        .card i {
            font-size: 40px;
            margin-bottom: 15px;
            color: var(--primary);
        }

        .card h2 {
            font-size: 18px;
            margin-bottom: 10px;
            color: var(--primary-dark);
            font-weight: 600;
        }

        .card p {
            color: var(--text-muted);
            font-size: 14px;
        }

        .quick-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .action-btn {
            background-color: var(--primary);
            color: var(--text-on-primary);
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .action-btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Bem-vindo, Paciente</h1>
        <div class="quick-actions">
          
                    <a href="Notificações/notificacoes_paciente.php" class="action-btn">
                         <i class="fas fa-bell"></i> Notificações
    
                    </a>
              
           
        </div>
    </div>

    <div class="dashboard">
        <div class="card" onclick="location.href='Agendamento/index.php'">
            <i class="fas fa-calendar-alt"></i>
            <h2>Agendamentos</h2>
            <p>Marcar e gerenciar consultas</p>
        </div>

        <div class="card" onclick="location.href='Exames/index.php'">
            <i class="fas fa-vials"></i>
            <h2>Exames</h2>
            <p>Consulte seus exames laboratoriais e de imagem</p>
        </div>

        <div class="card" onclick="location.href='Atendimento/index.php'">
            <i class="fas fa-phone-volume"></i>
            <h2>Atendimentos</h2>
            <p>Gerencie os atendimentos presenciais e por telefone</p>
        </div>

        <div class="card" onclick="location.href='Configurações/index.php'">
            <i class="fas fa-cogs"></i>
            <h2>Configurações</h2>
            <p>Gerencie as preferências do sistema</p>
        </div>
    </div>
</body>
</html>
