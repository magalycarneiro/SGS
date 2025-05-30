<?php
// Caminho ABSOLUTO para config.inc.php
require_once('C:/xampp/htdocs/SGS/clinica/config/config.inc.php');

// Caminho para Prontuario.class.php
require_once(__DIR__ . '/../Classes/Prontuario.class.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $prontuario = new Prontuario();
        $prontuario->setNomepaciente($_POST['nomepaciente'] ?? '');
        $prontuario->setPrescricao($_POST['prescricao'] ?? '');
        $prontuario->setObservacoes($_POST['observacoes'] ?? '');
        $prontuario->setDiagnostico($_POST['diagnostico'] ?? '');
        $prontuario->setAtestado($_POST['atestado'] ?? '');
        $prontuario->setEncaminhamento($_POST['encaminhamento'] ?? '');
        $prontuario->setAntecedentes($_POST['antecedentes'] ?? '');
        $prontuario->setSolicitacaoexames($_POST['solicitacaoexames'] ?? '');
        $prontuario->setExames($_POST['exames'] ?? '');

        if ($prontuario->inserir()) {
            header("Location: index.php?sucesso=1");
            exit();
        } else {
            $erro = $prontuario->getMensagemErro();
        }
    } catch (Exception $e) {
        $erro = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Prontuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Cadastrar Novo Prontuário</h2>
        
        <?php if (isset($erro)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
        <?php endif; ?>
        
        <form method="post">
            <div class="mb-3">
                <label for="nomepaciente" class="form-label">Nome do Paciente</label>
                <input type="text" class="form-control" id="nomepaciente" name="nomepaciente" required>
            </div>
            
            <div class="mb-3">
                <label for="prescricao" class="form-label">Prescrição</label>
                <textarea class="form-control" id="prescricao" name="prescricao" rows="3"></textarea>
            </div>
            
            <div class="mb-3">
                <label for="observacoes" class="form-label">Observações</label>
                <textarea class="form-control" id="observacoes" name="observacoes" rows="3"></textarea>
            </div>
            
            <div class="mb-3">
                <label for="diagnostico" class="form-label">Diagnóstico</label>
                <textarea class="form-control" id="diagnostico" name="diagnostico" rows="3"></textarea>
            </div>
            
            <div class="mb-3">
                <label for="atestado" class="form-label">Atestado</label>
                <textarea class="form-control" id="atestado" name="atestado" rows="3"></textarea>
            </div>
            
            <div class="mb-3">
                <label for="encaminhamento" class="form-label">Encaminhamento</label>
                <textarea class="form-control" id="encaminhamento" name="encaminhamento" rows="3"></textarea>
            </div>
            
            <div class="mb-3">
                <label for="antecedentes" class="form-label">Antecedentes</label>
                <textarea class="form-control" id="antecedentes" name="antecedentes" rows="3"></textarea>
            </div>
            
            <div class="mb-3">
                <label for="solicitacaoexames" class="form-label">Solicitação de Exames</label>
                <textarea class="form-control" id="solicitacaoexames" name="solicitacaoexames" rows="3"></textarea>
            </div>
            
            <div class="mb-3">
                <label for="exames" class="form-label">Exames</label>
                <textarea class="form-control" id="exames" name="exames" rows="3"></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>