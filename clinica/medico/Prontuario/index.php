<?php
// Caminho ABSOLUTO para config.inc.php
require_once('C:/xampp/htdocs/SGS/clinica/config/config.inc.php');

// Caminho para Prontuario.class.php
require_once(__DIR__ . '/../Classes/Prontuario.class.php');

// Processa ações (editar e excluir)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (isset($_POST['acao'])) {
            if ($_POST['acao'] === 'editar') {
                $prontuario = new Prontuario(
                    $_POST['id'] ?? 0,
                    $_POST['nomepaciente'] ?? '',
                    $_POST['prescricao'] ?? '',
                    $_POST['observacoes'] ?? '',
                    $_POST['diagnostico'] ?? '',
                    $_POST['atestado'] ?? '',
                    $_POST['encaminhamento'] ?? '',
                    $_POST['antecedentes'] ?? '',
                    $_POST['solicitacaoexames'] ?? '',
                    $_POST['exames'] ?? ''
                );
                
                if ($prontuario->alterar()) {
                    header("Location: index.php?visualizar=" . $prontuario->getIdPRONTUARIO());
                    exit();
                }
            } elseif ($_POST['acao'] === 'excluir' && isset($_POST['id_excluir'])) {
                $prontuario = new Prontuario($_POST['id_excluir'] ?? 0);
                if ($prontuario->excluir()) {
                    header("Location: index.php");
                    exit();
                }
            }
        }
    } catch (Exception $e) {
        $erro = $e->getMessage();
    }
}

// Processa busca e visualização
$busca = $_GET['busca'] ?? '';
$idVisualizar = $_GET['visualizar'] ?? 0;
$tipoBusca = !empty($busca) ? 2 : 0;
$lista = Prontuario::listar($tipoBusca, $busca);
$prontuarioDetalhado = null;

if ($idVisualizar > 0) {
    $resultado = Prontuario::listar(1, $idVisualizar);
    if (!empty($resultado)) {
        $prontuarioDetalhado = $resultado[0];
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Prontuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: var(--background);
        color: var(--text-color);
        line-height: 1.6;
    }

    .container {
        max-width: 1200px;
        padding: 20px;
    }

    /* Header e Títulos */
    h2 {
        color: var(--primary-dark);
        font-weight: 600;
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid var(--primary-lightest);
    }

    h3 {
        color: var(--primary);
        font-weight: 500;
        margin-bottom: 1.2rem;
    }

    /* Cards */
    .card {
        border: none;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        margin-bottom: 20px;
        background-color: var(--card-background);
    }

    .card-header {
        background-color: var(--primary-dark);
        color: var(--text-on-primary);
        border-radius: 8px 8px 0 0 !important;
        padding: 12px 20px;
        font-weight: 500;
    }

    /* Botões */
    .btn {
        border-radius: 6px;
        font-weight: 500;
        padding: 8px 16px;
        transition: all 0.3s ease;
        border: none;
    }

    .btn-primary {
        background-color: var(--primary);
        color: var(--text-on-primary);
    }

    .btn-primary:hover {
        background-color: var(--primary-dark);
        transform: translateY(-1px);
    }

    .btn-secondary {
        background-color: #6C757D;
        color: var(--text-on-primary);
    }

    .btn-success {
        background-color:rgb(150, 102, 192);
    }

    .btn-success:hover {
        background-color:rgb(188, 157, 215);
    }

    .btn-success:active {
        background-color:rgb(59, 31, 84);
    }

    .btn-warning {
        background-color:rgb(212, 196, 148);
        color: var(--text-color);
    }

    .btn-danger {
        background-color:rgb(219, 128, 137);
    }

    .btn-outline-secondary {
        border: 1px solid #6C757D;
        color: #6C757D;
        background-color: transparent;
    }

    /* Tabela */
    .table {
        background-color: var(--card-background);
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .table thead th {
        background-color: var(--primary-dark);
        color: var(--text-on-primary);
        border: none;
        padding: 12px 15px;
        font-weight: 500;
    }

    .table tbody tr {
        transition: background-color 0.2s ease;
    }

    .table tbody tr:hover {
        background-color: rgba(197, 170, 227, 0.1);
    }

    .table td, .table th {
        padding: 12px 15px;
        vertical-align: middle;
        border-top: 1px solid var(--border-color);
    }

    /* Links */
    .id-link {
        color: var(--primary);
        text-decoration: none;
        font-weight: 500;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .id-link:hover {
        color: var(--primary-dark);
        text-decoration: underline;
    }

    /* Área de Detalhes */
    .detalhes-prontuario {
        background-color: var(--card-background);
        border-radius: 8px;
        padding: 25px;
        margin-top: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        border-left: 4px solid var(--primary);
    }

    .campo-detalhe {
        margin-bottom: 20px;
    }

    .campo-detalhe label {
        color: var(--primary);
        font-weight: 500;
        margin-bottom: 5px;
        display: block;
    }

    .campo-detalhe p {
        background-color: rgba(197, 170, 227, 0.1);
        padding: 10px 15px;
        border-radius: 6px;
        margin-bottom: 0;
        min-height: 44px;
    }

    /* Modais */
    .modal-header {
        background-color: var(--primary-dark);
        color: var(--text-on-primary);
        border-radius: 8px 8px 0 0;
    }

    .modal-title {
        font-weight: 500;
    }

    .btn-close-white {
        filter: invert(1);
    }

    /* Formulários */
    .form-control {
        border-radius: 6px;
        padding: 8px 12px;
        border: 1px solid var(--border-color);
    }

    .form-control:focus {
        border-color: var(--primary-light);
        box-shadow: 0 0 0 0.25rem rgba(147, 92, 196, 0.25);
    }

    /* Alertas */
    .alert {
        border-radius: 6px;
        padding: 12px 16px;
    }

    /* Espaçamentos */
    .search-box {
        margin-bottom: 25px;
    }

    .add-btn {
        margin-bottom: 25px;
    }

    .btn-actions .btn {
        margin-right: 8px;
    }

    .btn-actions .btn:last-child {
        margin-right: 0;
    }

    /* Responsividade */
    @media (max-width: 768px) {
        .container {
            padding: 15px;
        }
        
        .table td, .table th {
            padding: 8px 10px;
        }
        
        .detalhes-prontuario {
            padding: 15px;
        }
    }

    /* Estilos Específicos para a Tabela */


</style>
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-4">Gestão de Prontuários</h2>

        <!-- Exibe apenas erros -->
        <?php if (isset($erro)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
        <?php endif; ?>

        <!-- Barra de Busca -->
        <div class="card search-box">
            <div class="card-body">
                <form method="get" class="row g-3">
                    <div class="col-md-8">
                        <input type="text" name="busca" class="form-control" 
                               placeholder="Buscar por nome do paciente..." value="<?= htmlspecialchars($busca) ?>">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                        <a href="index.php" class="btn btn-secondary">Limpar</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Botão Adicionar -->
        <div class="add-btn">
            <a href="cadastro_prontuario.php" class="btn btn-success">+ Novo Prontuário</a>
            <?php if ($idVisualizar > 0): ?>
                <a href="index.php" class="btn btn-outline-secondary ms-2">Voltar para lista</a>
            <?php endif; ?>
        </div>

        <?php if ($idVisualizar > 0 && $prontuarioDetalhado): ?>
            <!-- Exibição detalhada do prontuário -->
            <div class="detalhes-prontuario">
                <h3>Prontuário #<?= $prontuarioDetalhado->getIdPRONTUARIO() ?></h3>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="campo-detalhe">
                            <label>Paciente:</label>
                            <p><?= htmlspecialchars($prontuarioDetalhado->getNomepaciente()) ?></p>
                        </div>
                        
                        <div class="campo-detalhe">
                            <label>Prescrição:</label>
                            <p><?= htmlspecialchars($prontuarioDetalhado->getPrescricao()) ?></p>
                        </div>
                        
                        <div class="campo-detalhe">
                            <label>Observações:</label>
                            <p><?= htmlspecialchars($prontuarioDetalhado->getObservacoes()) ?></p>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="campo-detalhe">
                            <label>Diagnóstico:</label>
                            <p><?= htmlspecialchars($prontuarioDetalhado->getDiagnostico()) ?></p>
                        </div>
                        
                        <div class="campo-detalhe">
                            <label>Atestado:</label>
                            <p><?= htmlspecialchars($prontuarioDetalhado->getAtestado()) ?></p>
                        </div>
                        
                        <div class="campo-detalhe">
                            <label>Encaminhamento:</label>
                            <p><?= htmlspecialchars($prontuarioDetalhado->getEncaminhamento()) ?></p>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="campo-detalhe">
                            <label>Antecedentes:</label>
                            <p><?= htmlspecialchars($prontuarioDetalhado->getAntecedentes()) ?></p>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="campo-detalhe">
                            <label>Exames:</label>
                            <p><?= htmlspecialchars($prontuarioDetalhado->getExames()) ?></p>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4">
                    <button class="btn btn-warning btn-editar" 
                            data-bs-toggle="modal" data-bs-target="#modalEditar"
                            data-id="<?= $prontuarioDetalhado->getIdPRONTUARIO() ?>"
                            data-nome="<?= htmlspecialchars($prontuarioDetalhado->getNomepaciente()) ?>"
                            data-prescricao="<?= htmlspecialchars($prontuarioDetalhado->getPrescricao()) ?>"
                            data-observacoes="<?= htmlspecialchars($prontuarioDetalhado->getObservacoes()) ?>"
                            data-diagnostico="<?= htmlspecialchars($prontuarioDetalhado->getDiagnostico()) ?>"
                            data-atestado="<?= htmlspecialchars($prontuarioDetalhado->getAtestado()) ?>"
                            data-encaminhamento="<?= htmlspecialchars($prontuarioDetalhado->getEncaminhamento()) ?>"
                            data-antecedentes="<?= htmlspecialchars($prontuarioDetalhado->getAntecedentes()) ?>"
                            data-solicitacaoexames="<?= htmlspecialchars($prontuarioDetalhado->getSolicitacaoexames()) ?>"
                            data-exames="<?= htmlspecialchars($prontuarioDetalhado->getExames()) ?>">
                        Editar Prontuário
                    </button>
                </div>
            </div>

        <?php else: ?>
            <!-- Lista simplificada de prontuários -->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Paciente</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lista as $prontuario): ?>
                        <tr>
                            <td>
                                <span class="id-link" onclick="window.location.href='index.php?visualizar=<?= $prontuario->getIdPRONTUARIO() ?>'">
                                    <?= $prontuario->getIdPRONTUARIO() ?>
                                </span>
                            </td>
                            <td><?= htmlspecialchars($prontuario->getNomepaciente()) ?></td>
                            <td class="btn-actions">
                                <button class="btn btn-sm btn-warning btn-editar" 
                                        data-bs-toggle="modal" data-bs-target="#modalEditar"
                                        data-id="<?= $prontuario->getIdPRONTUARIO() ?>"
                                        data-nome="<?= htmlspecialchars($prontuario->getNomepaciente()) ?>"
                                        data-prescricao="<?= htmlspecialchars($prontuario->getPrescricao()) ?>"
                                        data-observacoes="<?= htmlspecialchars($prontuario->getObservacoes()) ?>"
                                        data-diagnostico="<?= htmlspecialchars($prontuario->getDiagnostico()) ?>"
                                        data-atestado="<?= htmlspecialchars($prontuario->getAtestado()) ?>"
                                        data-encaminhamento="<?= htmlspecialchars($prontuario->getEncaminhamento()) ?>"
                                        data-antecedentes="<?= htmlspecialchars($prontuario->getAntecedentes()) ?>"
                                        data-solicitacaoexames="<?= htmlspecialchars($prontuario->getSolicitacaoexames()) ?>"
                                        data-exames="<?= htmlspecialchars($prontuario->getExames()) ?>">
                                    Editar
                                </button>
                                
                                <button class="btn btn-sm btn-danger" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#modalExcluir"
                                        data-id="<?= $prontuario->getIdPRONTUARIO() ?>">
                                    Excluir
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

        <!-- Modal de Edição -->
        <div class="modal fade" id="modalEditar" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form method="post">
                        <div class="modal-header">
                            <h5 class="modal-title">Editar Prontuário</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" id="editId">
                            <input type="hidden" name="acao" value="editar">
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nome do Paciente</label>
                                    <input type="text" name="nomepaciente" id="editNome" class="form-control" required>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Atestado</label>
                                    <textarea name="atestado" id="editAtestado" class="form-control" rows="2"></textarea>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Prescrição</label>
                                <textarea name="prescricao" id="editPrescricao" class="form-control" rows="3"></textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Observações</label>
                                <textarea name="observacoes" id="editObservacoes" class="form-control" rows="3"></textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Diagnóstico</label>
                                <textarea name="diagnostico" id="editDiagnostico" class="form-control" rows="3"></textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Encaminhamento</label>
                                <textarea name="encaminhamento" id="editEncaminhamento" class="form-control" rows="3"></textarea>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Antecedentes</label>
                                    <textarea name="antecedentes" id="editAntecedentes" class="form-control" rows="3"></textarea>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Exames</label>
                                    <textarea name="exames" id="editExames" class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal de Confirmação de Exclusão -->
        <div class="modal fade" id="modalExcluir" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title">Confirmar Exclusão</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Tem certeza que deseja excluir este prontuário permanentemente?</p>
                            <input type="hidden" name="id_excluir" id="idExcluir">
                            <input type="hidden" name="acao" value="excluir">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger">Confirmar Exclusão</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Configura o modal de edição
        document.getElementById('modalEditar').addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            document.getElementById('editId').value = button.getAttribute('data-id');
            document.getElementById('editNome').value = button.getAttribute('data-nome');
            document.getElementById('editPrescricao').value = button.getAttribute('data-prescricao');
            document.getElementById('editObservacoes').value = button.getAttribute('data-observacoes');
            document.getElementById('editDiagnostico').value = button.getAttribute('data-diagnostico');
            document.getElementById('editAtestado').value = button.getAttribute('data-atestado');
            document.getElementById('editEncaminhamento').value = button.getAttribute('data-encaminhamento');
            document.getElementById('editAntecedentes').value = button.getAttribute('data-antecedentes');
            document.getElementById('editExames').value = button.getAttribute('data-exames');
        });

        // Configura o modal de exclusão
        document.getElementById('modalExcluir').addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            document.getElementById('idExcluir').value = button.getAttribute('data-id');
        });
    </script>
</body>
</html>