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
                    header("Location: index.php");
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

// Processa busca
$busca = $_GET['busca'] ?? '';
$tipoBusca = !empty($busca) ? 2 : 0;
$lista = Prontuario::listar($tipoBusca, $busca);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Prontuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .search-box { margin-bottom: 20px; }
        .add-btn { margin-bottom: 20px; }
        .btn-actions .btn { margin-right: 5px; }
        .btn-actions .btn:last-child { margin-right: 0; }
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
                               placeholder="Buscar prontuários..." value="<?= htmlspecialchars($busca) ?>">
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
        </div>

        <!-- Tabela de Prontuários -->
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Paciente</th>
                        <th>Prescrição</th>
                        <th>Observações</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista as $prontuario): ?>
                    <tr>
                        <td><?= $prontuario->getIdPRONTUARIO() ?></td>
                        <td><?= htmlspecialchars($prontuario->getNomepaciente()) ?></td>
                        <td><?= htmlspecialchars($prontuario->getPrescricao()) ?></td>
                        <td><?= htmlspecialchars($prontuario->getObservacoes()) ?></td>
                        <td class="btn-actions">
                            <!-- Botão Editar -->
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
                            
                            <!-- Botão Excluir -->
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

        <!-- Modal de Edição -->
        <div class="modal fade" id="modalEditar" tabindex="-1" aria-hidden="true">
            <!-- ... (mantenha o conteúdo existente do modal de edição) ... -->
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
        // Configura o modal de exclusão
        document.getElementById('modalExcluir').addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            document.getElementById('idExcluir').value = button.getAttribute('data-id');
        });
    </script>
</body>
</html>