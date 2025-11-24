<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel da Secretária</title>
    <style>
        :root {
            --primary-dark: #693E7F;
            --primary: #935CC4;
            --primary-light: #A56ACB;
            --primary-lighter: #B579DC;
            --primary-lightest: #C2AAE3;
            --text-on-primary: #FFFFFF;
            --background: #F8F9FA;
            --card-background: #FFFFFF;
            --text-color: #212529;
            --text-muted: #6C757D;
            --border-color: #E9ECEF;
            --success-color: #28a745;
            --error-color: #dc3545;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--background);
            padding: 20px;
            color: var(--text-color);
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
            background-color: var(--card-background);
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

        .card h2 a {
            text-decoration: none !important;
            color: var(--primary-dark) !important;
            font-size: inherit !important;
            font-weight: inherit !important;
            display: inline-block;
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

        .action-btn i {
            font-size: 16px;
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .quick-actions {
                margin-top: 15px;
                width: 100%;
            }

            .action-btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="header">
        <h1>Bem-vinda, Secretária(o)</h1>
        <div class="quick-actions">
              <a href="Notificações/notificacoes_secretaria.php" class="action-btn">
                         <i class="fas fa-bell"></i> Notificações
    
                    </a>
            <button class="action-btn" onclick="location.href='paciente/'">
                <i class="fas fa-user-plus"></i> Novo Paciente
            </button>
        </div>
    </div>

    <div class="dashboard">
        <div class="card" onclick="location.href='Consulta/'">
            <i class="fas fa-calendar-alt"></i>
            <h2>Agendamentos</h2>
            <p>Marque e gerencie consultas</p>
        </div>

        <div class="card" onclick="location.href='Consulta/lista_consulta.php'">
            <i class="fas fa-notes-medical"></i>
            <h2>Consultas</h2>
            <p>Visualize as consultas marcadas</p>
        </div>

        <div class="card" onclick="location.href='paciente/'">
            <i class="fas fa-user-plus"></i>
            <h2>Cadastro de Pacientes</h2>
            <p>Adicione novos pacientes à clínica</p>
        </div>

        <div class="card" onclick="location.href='paciente/lista_paciente.php'">
            <i class="fas fa-users"></i>
            <h2>Pacientes Cadastrados</h2>
            <p>Visualize os pacientes cadastrados</p>
        </div>

        <div class="card" onclick="location.href=''">
            <i class="fas fa-phone-volume"></i>
            <h2>Atendimentos</h2>
            <p>Gerencie os atendimentos presenciais e por telefone</p>
        </div>

        <div class="card" onclick="location.href='#'">
            <i class="fas fa-file-invoice"></i>
            <h2>Faturamento</h2>
            <p>Controle de pagamentos e convênios</p>
        </div>

        <div class="card" onclick="location.href='Configurações/index.php'">
            <i class="fas fa-cogs"></i>
            <h2>Configurações</h2>
            <p>Gerencie as preferências do sistema</p>
        </div>
    </div>
</body>
</html>
