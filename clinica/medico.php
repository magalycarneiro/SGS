<?php
session_start();

// Verifica se o usuário está logado e é médico
if (!isset($_SESSION['loggedin']) || $_SESSION['userdata']['tipo'] !== 'medico') {
    header("Location: login.php");
    exit;
}

$user = $_SESSION['userdata'];

require_once 'includes/conexao.php';

 //Busca os agendamentos do médico
$stmt = $pdo->prepare("
    SELECT a.*, p.nome as paciente, p.cpf, h.data, h.hora 
    FROM agendamentos a
    JOIN usuarios p ON a.id_paciente = p.id
    JOIN horarios h ON a.id_horario = h.id
    WHERE a.id_medico = ? AND a.status = 'agendado' AND h.data >= CURDATE()
    ORDER BY h.data, h.hora
");
$stmt->execute([$user['id']]);
$agendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Busca os prontuários do médico
$stmt = $pdo->prepare("
    SELECT pr.*, p.nome as paciente 
    FROM prontuarios pr
    JOIN usuarios p ON pr.id_paciente = p.id
    WHERE pr.id_medico = ?
    ORDER BY pr.data_consulta DESC
");
$stmt->execute([$user['id']]);
$prontuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?> 

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área do Médico - Clínica Médica</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/medico.css">
</head>
<body>
    <div class="dashboard-medico">
        <aside class="sidebar-medico">
            <div class="sidebar-header">
                <h2>Clínica Médica</h2>
                <p>Área do Médico</p>
            </div>
            
            <nav>
                <ul class="sidebar-nav">
                    <li><a href="#" class="active">Dashboard</a></li>
                    <li><a href="#prontuarios">Prontuários</a></li>
                    <li><a href="#agenda">Agenda</a></li>
                    <li><a href="logout.php">Sair</a></li>
                </ul>
            </nav>
            
            <div class="doctor-info">
                <p>Bem-vindo,</p>
                <h3>Dr. <?= htmlspecialchars($user['nome']) ?></h3>
                <p><?= htmlspecialchars($user['especialidade']) ?></p>
            </div>
        </aside>
        
        <!-- Conteúdo Principal -->
        <main class="main-content">
            <section class="welcome-section">
                <h1>Bem-vindo, Dr. <?= htmlspecialchars($user['nome']) ?></h1>
                <p>Aqui você pode gerenciar seus prontuários eletrônicos e visualizar sua agenda.</p>
            </section>
            
            <!-- Cards de Resumo -->
            <div class="summary-cards">
                <div class="summary-card">
                    <h3>Consultas Hoje</h3>
                    <p><?= count(array_filter($agendamentos, function($a) { 
                        return date('Y-m-d', strtotime($a['data'])) == date('Y-m-d'); 
                    })) ?></p>
                </div>
                
                <div class="summary-card">
                    <h3>Prontuários</h3>
                    <p><?= count($prontuarios) ?></p>
                </div>
                
                <div class="summary-card">
                    <h3>Próximas Consultas</h3>
                    <p><?= count($agendamentos) ?></p>
                </div>
            </div>
            
            <!-- Seção de Prontuários -->
            <div class="section-container">
                <section id="prontuarios" class="section-panel">
                    <div class="section-header">
                        <h2>Prontuário Eletrônico</h2>
                        <button id="novoProntuario" class="btn-primary">Novo Prontuário</button>
                    </div>
                    
                    <!-- Lista de Prontuários -->
                    <div class="prontuario-list">
                        <table class="medical-table">
                            <thead>
                                <tr>
                                    <th>Paciente</th>
                                    <th>Data da Consulta</th>
                                    <th>Diagnóstico</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($prontuarios as $prontuario): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($prontuario['paciente']) ?></td>
                                        <td><?= date('d/m/Y', strtotime($prontuario['data_consulta'])) ?></td>
                                        <td><?= htmlspecialchars($prontuario['diagnostico']) ?></td>
                                        <td>
                                            <a href="#" class="btn-edit" data-id="<?= $prontuario['id'] ?>">Editar</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Formulário de Prontuário (inicialmente oculto) -->
                    <div id="prontuarioFormContainer" style="display: none; margin-top: 30px;">
                        <form id="prontuarioForm" class="prontuario-form" action="processa_prontuario.php" method="POST">
                            <input type="hidden" name="id_prontuario" id="id_prontuario" value="">
                            
                            <div class="form-group">
                                <label for="paciente">Paciente</label>
                                <select name="id_paciente" id="paciente" required>
                                    <?php 
                                    // Busca pacientes com consultas agendadas
                                    $stmt = $pdo->prepare("
                                        SELECT DISTINCT p.id, p.nome 
                                        FROM agendamentos a
                                        JOIN usuarios p ON a.id_paciente = p.id
                                        WHERE a.id_medico = ?
                                        ORDER BY p.nome
                                    ");
                                    $stmt->execute([$user['id']]);
                                    $pacientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    
                                    foreach ($pacientes as $paciente): 
                                    ?>
                                        <option value="<?= $paciente['id'] ?>"><?= htmlspecialchars($paciente['nome']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="data_consulta">Data da Consulta</label>
                                <input type="date" name="data_consulta" id="data_consulta" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="diagnostico">Diagnóstico</label>
                                <input type="text" name="diagnostico" id="diagnostico" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="sintomas">Sintomas</label>
                                <textarea name="sintomas" id="sintomas"></textarea>
                            </div>
                            
                            <div class="form-group">
                                <label for="tratamento">Tratamento Prescrito</label>
                                <textarea name="tratamento" id="tratamento"></textarea>
                            </div>
                            
                            <div class="form-group">
                                <label for="observacoes">Observações</label>
                                <textarea name="observacoes" id="observacoes"></textarea>
                            </div>
                            
                            <div class="form-actions">
                                <button type="button" id="cancelarProntuario" class="btn-cancelar">Cancelar</button>
                                <button type="submit" name="salvar_prontuario" class="btn-primary">Salvar Prontuário</button>
                            </div>
                        </form>
                    </div>
                </section>
                
                <!-- Seção de Agenda -->
                <section id="agenda" class="section-panel">
                    <div class="section-header">
                        <h2>Sua Agenda</h2>
                    </div>
                    
                    <div class="agenda-list">
                        <table class="medical-table">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Hora</th>
                                    <th>Paciente</th>
                                    <th>CPF</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($agendamentos as $agendamento): ?>
                                    <tr>
                                        <td><?= date('d/m/Y', strtotime($agendamento['data'])) ?></td>
                                        <td><?= date('H:i', strtotime($agendamento['hora'])) ?></td>
                                        <td><?= htmlspecialchars($agendamento['paciente']) ?></td>
                                        <td><?= htmlspecialchars($agendamento['cpf']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </main>
    </div>

    <script src="js/medico.js"></script>
</body>
</html>