<?php
session_start();

// Verifica se o usuário está logado e é secretária
if (!isset($_SESSION['loggedin']) || $_SESSION['userdata']['tipo'] !== 'secretaria') {
    header("Location: login.php");
    exit;
}

$user = $_SESSION['userdata'];
require_once 'includes/conexao.php';

// Busca os agendamentos
$stmt = $pdo->prepare("
    SELECT a.*, p.nome as paciente, p.cpf, m.nome as medico, h.data, h.hora 
    FROM agendamentos a
    JOIN usuarios p ON a.id_paciente = p.id
    JOIN usuarios m ON a.id_medico = m.id
    JOIN horarios h ON a.id_horario = h.id
    WHERE a.status = 'agendado'
    ORDER BY h.data, h.hora
");
$stmt->execute();
$agendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Busca lista de espera
$stmt = $pdo->prepare("
    SELECT l.*, p.nome as paciente, p.cpf, p.telefone
    FROM lista_espera l
    JOIN usuarios p ON l.id_paciente = p.id
    ORDER BY l.data_cadastro
");
$stmt->execute();
$lista_espera = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Busca agendamentos de pré-natal
$stmt = $pdo->prepare("
    SELECT a.*, p.nome as paciente, p.cpf, m.nome as medico, h.data, h.hora 
    FROM agendamentos a
    JOIN usuarios p ON a.id_paciente = p.id
    JOIN usuarios m ON a.id_medico = m.id
    JOIN horarios h ON a.id_horario = h.id
    WHERE a.status = 'agendado' AND a.tipo = 'pre_natal'
    ORDER BY h.data, h.hora
");
$stmt->execute();
$pre_natal = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Busca dados financeiros
$stmt = $pdo->query("
    SELECT 
        SUM(CASE WHEN status = 'pago' THEN valor ELSE 0 END) as total_pago,
        SUM(CASE WHEN status = 'pendente' THEN valor ELSE 0 END) as total_pendente,
        COUNT(*) as total_procedimentos
    FROM financeiro
    WHERE MONTH(data) = MONTH(CURRENT_DATE())
");
$financeiro = $stmt->fetch(PDO::FETCH_ASSOC);

// Busca médicos para formulários
$medicos = $pdo->query("SELECT id, nome, especialidade FROM usuarios WHERE tipo = 'medico'")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área da Secretária - Clínica Médica</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/secretaria.css">
</head>
<body>
    <div class="dashboard-secretaria">
        <!-- Sidebar -->
        <aside class="sidebar-secretaria">
            <div class="sidebar-header">
                <h2>Clínica Médica</h2>
                <p>Área da Secretária</p>
            </div>
            
            <nav>
                <ul class="sidebar-nav">
                    <li><a href="#" class="active">Dashboard</a></li>
                    <li><a href="#agenda">Agenda Médica</a></li>
                    <li><a href="#lista-espera">Lista de Espera</a></li>
                    <li><a href="#pre-natal">Pré-Natal</a></li>
                    <li><a href="#financeiro">Gestão Financeira</a></li>
                    <li><a href="logout.php">Sair</a></li>
                </ul>
            </nav>
            
            <div class="user-info">
                <p>Bem-vindo,</p>
                <h3><?= htmlspecialchars($user['nome']) ?></h3>
                <p>Secretária</p>
            </div>
        </aside>
        
        <!-- Conteúdo Principal -->
        <main class="main-content">
            <section class="welcome-section">
                <h1>Bem-vinda, <?= htmlspecialchars($user['nome']) ?></h1>
                <p>Aqui você pode gerenciar toda a operação da clínica.</p>
            </section>
            
            <!-- Abas -->
            <div class="tabs-container">
                <div class="tabs">
                    <div class="tab active" data-tab="agenda">Agenda Médica</div>
                    <div class="tab" data-tab="lista-espera">Lista de Espera</div>
                    <div class="tab" data-tab="pre-natal">Pré-Natal</div>
                    <div class="tab" data-tab="financeiro">Gestão Financeira</div>
                </div>
                
                <!-- Conteúdo da Agenda Médica -->
                <div id="agenda" class="tab-content active">
                    <div class="section-header">
                        <h2>Agenda Médica</h2>
                        <button id="novoAgendamento" class="btn-primary">Novo Agendamento</button>
                    </div>
                    
                    <table class="secretaria-table">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Hora</th>
                                <th>Paciente</th>
                                <th>CPF</th>
                                <th>Médico</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($agendamentos as $agendamento): ?>
                                <tr>
                                    <td><?= date('d/m/Y', strtotime($agendamento['data'])) ?></td>
                                    <td><?= date('H:i', strtotime($agendamento['hora'])) ?></td>
                                    <td><?= htmlspecialchars($agendamento['paciente']) ?></td>
                                    <td><?= htmlspecialchars($agendamento['cpf']) ?></td>
                                    <td><?= htmlspecialchars($agendamento['medico']) ?></td>
                                    <td class="status-<?= $agendamento['status'] ?>">
                                        <?= ucfirst($agendamento['status']) ?>
                                    </td>
                                    <td>
                                        <button class="btn-edit" data-id="<?= $agendamento['id'] ?>">Editar</button>
                                        <form action="processa_secretaria.php" method="POST" style="display: inline;">
                                            <input type="hidden" name="id_agendamento" value="<?= $agendamento['id'] ?>">
                                            <button type="submit" name="cancelar" class="btn-cancelar">Cancelar</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    
                    <!-- Formulário de Novo Agendamento (inicialmente oculto) -->
                    <div id="agendamentoFormContainer" style="display: none; margin-top: 30px;">
                        <form id="agendamentoForm" class="secretaria-form" action="processa_secretaria.php" method="POST">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="paciente">Paciente</label>
                                    <input type="text" id="paciente" name="paciente" required>
                                </div>
                                <div class="form-group">
                                    <label for="cpf">CPF</label>
                                    <input type="text" id="cpf" name="cpf" required>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="medico">Médico</label>
                                    <select id="medico" name="id_medico" required>
                                        <?php foreach ($medicos as $medico): ?>
                                            <option value="<?= $medico['id'] ?>">
                                                <?= htmlspecialchars($medico['nome']) ?> - <?= htmlspecialchars($medico['especialidade']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tipo_consulta">Tipo de Consulta</label>
                                    <select id="tipo_consulta" name="tipo_consulta">
                                        <option value="consulta">Consulta</option>
                                        <option value="pre_natal">Pré-Natal</option>
                                        <option value="retorno">Retorno</option>
                                        <option value="exame">Exame</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="data">Data</label>
                                    <input type="date" id="data" name="data" required>
                                </div>
                                <div class="form-group">
                                    <label for="hora">Hora</label>
                                    <input type="time" id="hora" name="hora" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="observacoes">Observações</label>
                                <textarea id="observacoes" name="observacoes"></textarea>
                            </div>
                            
                            <div class="form-actions">
                                <button type="button" id="cancelarAgendamento" class="btn-cancelar">Cancelar</button>
                                <button type="submit" name="agendar" class="btn-primary">Salvar Agendamento</button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Conteúdo da Lista de Espera -->
                <div id="lista-espera" class="tab-content">
                    <div class="section-header">
                        <h2>Lista de Espera</h2>
                        <button id="novoListaEspera" class="btn-primary">Adicionar à Lista</button>
                    </div>
                    
                    <table class="secretaria-table">
                        <thead>
                            <tr>
                                <th>Paciente</th>
                                <th>CPF</th>
                                <th>Telefone</th>
                                <th>Data Cadastro</th>
                                <th>Prioridade</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lista_espera as $item): ?>
                                <tr>
                                    <td><?= htmlspecialchars($item['paciente']) ?></td>
                                    <td><?= htmlspecialchars($item['cpf']) ?></td>
                                    <td><?= htmlspecialchars($item['telefone']) ?></td>
                                    <td><?= date('d/m/Y', strtotime($item['data_cadastro'])) ?></td>
                                    <td><?= htmlspecialchars($item['prioridade']) ?></td>
                                    <td>
                                        <button class="btn-edit" data-id="<?= $item['id'] ?>">Editar</button>
                                        <button class="btn-agendar" data-cpf="<?= $item['cpf'] ?>">Agendar</button>
                                        <form action="processa_secretaria.php" method="POST" style="display: inline;">
                                            <input type="hidden" name="id_lista_espera" value="<?= $item['id'] ?>">
                                            <button type="submit" name="remover_lista" class="btn-cancelar">Remover</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    
                    <!-- Formulário de Lista de Espera -->
                    <div id="listaEsperaFormContainer" style="display: none; margin-top: 30px;">
                        <form id="listaEsperaForm" class="secretaria-form" action="processa_secretaria.php" method="POST">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="le_paciente">Paciente</label>
                                    <input type="text" id="le_paciente" name="paciente" required>
                                </div>
                                <div class="form-group">
                                    <label for="le_cpf">CPF</label>
                                    <input type="text" id="le_cpf" name="cpf" required>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="le_telefone">Telefone</label>
                                    <input type="text" id="le_telefone" name="telefone" required>
                                </div>
                                <div class="form-group">
                                    <label for="le_prioridade">Prioridade</label>
                                    <select id="le_prioridade" name="prioridade" required>
                                        <option value="normal">Normal</option>
                                        <option value="alta">Alta</option>
                                        <option value="urgente">Urgente</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="le_observacoes">Observações</label>
                                <textarea id="le_observacoes" name="observacoes"></textarea>
                            </div>
                            
                            <div class="form-actions">
                                <button type="button" id="cancelarListaEspera" class="btn-cancelar">Cancelar</button>
                                <button type="submit" name="adicionar_lista" class="btn-primary">Adicionar à Lista</button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Conteúdo do Pré-Natal -->
                <div id="pre-natal" class="tab-content">
                    <div class="section-header">
                        <h2>Agenda de Pré-Natal</h2>
                        <button id="novoPreNatal" class="btn-primary">Novo Agendamento</button>
                    </div>
                    
                    <table class="secretaria-table">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Hora</th>
                                <th>Paciente</th>
                                <th>CPF</th>
                                <th>Médico</th>
                                <th>Semana Gestação</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pre_natal as $agendamento): ?>
                                <tr>
                                    <td><?= date('d/m/Y', strtotime($agendamento['data'])) ?></td>
                                    <td><?= date('H:i', strtotime($agendamento['hora'])) ?></td>
                                    <td><?= htmlspecialchars($agendamento['paciente']) ?></td>
                                    <td><?= htmlspecialchars($agendamento['cpf']) ?></td>
                                    <td><?= htmlspecialchars($agendamento['medico']) ?></td>
                                    <td><?= $agendamento['semana_gestacao'] ?? '--' ?></td>
                                    <td>
                                        <button class="btn-edit" data-id="<?= $agendamento['id'] ?>">Editar</button>
                                        <form action="processa_secretaria.php" method="POST" style="display: inline;">
                                            <input type="hidden" name="id_agendamento" value="<?= $agendamento['id'] ?>">
                                            <button type="submit" name="cancelar" class="btn-cancelar">Cancelar</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <!-- Conteúdo da Gestão Financeira -->
                <div id="financeiro" class="tab-content">
                    <div class="section-header">
                        <h2>Gestão Financeira</h2>
                        <button id="novoLancamento" class="btn-primary">Novo Lançamento</button>
                    </div>
                    
                    <div class="finance-cards">
                        <div class="finance-card">
                            <h3>Recebido (Mês)</h3>
                            <div class="value">R$ <?= number_format($financeiro['total_pago'], 2, ',', '.') ?></div>
                            <div class="info">Total recebido este mês</div>
                        </div>
                        
                        <div class="finance-card">
                            <h3>Pendente</h3>
                            <div class="value">R$ <?= number_format($financeiro['total_pendente'], 2, ',', '.') ?></div>
                            <div class="info">A receber este mês</div>
                        </div>
                        
                        <div class="finance-card">
                            <h3>Procedimentos</h3>
                            <div class="value"><?= $financeiro['total_procedimentos'] ?></div>
                            <div class="info">Realizados este mês</div>
                        </div>
                    </div>
                    
                    <h3>Últimos Lançamentos</h3>
                    <table class="secretaria-table">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Paciente</th>
                                <th>Procedimento</th>
                                <th>Valor</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $lancamentos = $pdo->query("
                                SELECT f.*, p.nome as paciente 
                                FROM financeiro f
                                LEFT JOIN usuarios p ON f.id_paciente = p.id
                                ORDER BY f.data DESC
                                LIMIT 10
                            ")->fetchAll(PDO::FETCH_ASSOC);
                            
                            foreach ($lancamentos as $lancamento): 
                            ?>
                                <tr>
                                    <td><?= date('d/m/Y', strtotime($lancamento['data'])) ?></td>
                                    <td><?= htmlspecialchars($lancamento['paciente'] ?? '--') ?></td>
                                    <td><?= htmlspecialchars($lancamento['procedimento']) ?></td>
                                    <td>R$ <?= number_format($lancamento['valor'], 2, ',', '.') ?></td>
                                    <td class="status-<?= $lancamento['status'] ?>">
                                        <?= ucfirst($lancamento['status']) ?>
                                    </td>
                                    <td>
                                        <button class="btn-edit" data-id="<?= $lancamento['id'] ?>">Editar</button>
                                        <?php if ($lancamento['status'] == 'pendente'): ?>
                                            <form action="processa_secretaria.php" method="POST" style="display: inline;">
                                                <input type="hidden" name="id_lancamento" value="<?= $lancamento['id'] ?>">
                                                <button type="submit" name="marcar_pago" class="btn-primary">Marcar como Pago</button>
                                            </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    
                    <!-- Formulário de Lançamento Financeiro -->
                    <div id="lancamentoFormContainer" style="display: none; margin-top: 30px;">
                        <form id="lancamentoForm" class="secretaria-form" action="processa_secretaria.php" method="POST">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="f_paciente">Paciente</label>
                                    <input type="text" id="f_paciente" name="paciente">
                                </div>
                                <div class="form-group">
                                    <label for="f_cpf">CPF</label>
                                    <input type="text" id="f_cpf" name="cpf">
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="f_procedimento">Procedimento</label>
                                    <input type="text" id="f_procedimento" name="procedimento" required>
                                </div>
                                <div class="form-group">
                                    <label for="f_valor">Valor</label>
                                    <input type="number" id="f_valor" name="valor" step="0.01" min="0" required>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="f_data">Data</label>
                                    <input type="date" id="f_data" name="data" required>
                                </div>
                                <div class="form-group">
                                    <label for="f_status">Status</label>
                                    <select id="f_status" name="status" required>
                                        <option value="pago">Pago</option>
                                        <option value="pendente">Pendente</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="f_observacoes">Observações</label>
                                <textarea id="f_observacoes" name="observacoes"></textarea>
                            </div>
                            
                            <div class="form-actions">
                                <button type="button" id="cancelarLancamento" class="btn-cancelar">Cancelar</button>
                                <button type="submit" name="adicionar_lancamento" class="btn-primary">Salvar Lançamento</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="js/secretaria.js"></script>
</body>
</html>