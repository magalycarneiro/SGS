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

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: var(--background);
        color: var(--text-color);
        line-height: 1.6;
    }

    .container {
        max-width: 1000px;
        padding: 30px;
        background-color: var(--card-background);
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        margin: 40px auto;
    }

    h2 {
        color: var(--primary-dark);
        font-weight: 600;
        margin-bottom: 2rem;
        padding-bottom: 0.8rem;
        border-bottom: 2px solid var(--primary-lightest);
        position: relative;
    }

    h2:after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 100px;
        height: 2px;
        background-color: var(--primary);
    }

    /* Sistema de grid para o formulário */
    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    /* Campos lado a lado */
    .side-by-side {
        grid-column: span 2;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    /* Campos que ocupam duas colunas */
    .full-width {
        grid-column: span 2;
    }

    .form-label {
        font-weight: 500;
        color: var(--primary-dark);
        margin-bottom: 0.5rem;
        display: block;
    }

    .form-control {
        width: 100%;
        border-radius: 6px;
        padding: 10px 15px;
        border: 1px solid var(--border-color);
        transition: all 0.3s ease;
        background-color: rgba(197, 170, 227, 0.05);
    }

    .form-control:focus {
        border-color: var(--primary-light);
        box-shadow: 0 0 0 0.25rem rgba(147, 92, 196, 0.15);
        background-color: var(--card-background);
        outline: none;
    }

    textarea.form-control {
        min-height: 100px;
        resize: vertical;
    }

    /* Estilos para botões */
    .button-group {
        grid-column: span 2;
        display: flex;
        gap: 15px;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid var(--border-color);
    }

    .btn {
        border-radius: 6px;
        font-weight: 500;
        padding: 10px 20px;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        font-size: 0.9rem;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .btn-primary {
        background-color: var(--primary);
        color: var(--text-on-primary);
    }

    .btn-primary:hover {
        background-color: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .btn-secondary {
        background-color: #6C757D;
        color: var(--text-on-primary);
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        transform: translateY(-2px);
    }

    /* Estilos para alertas */
    .alert {
        grid-column: span 2;
        border-radius: 6px;
        padding: 15px;
        margin-bottom: 25px;
        border: none;
    }

    .alert-danger {
        background-color: rgba(220, 53, 69, 0.1);
        color: var(--error-color);
        border-left: 4px solid var(--error-color);
    }

    /* Responsividade */
    @media (max-width: 768px) {
        .container {
            padding: 20px;
            margin: 20px 10px;
        }
        
        .form-grid, 
        .side-by-side {
            grid-template-columns: 1fr;
        }
        
        .side-by-side,
        .full-width {
            grid-column: span 1;
        }
        
        .button-group {
            flex-direction: column;
        }
    }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2>Cadastrar Novo Prontuário</h2>
        
        <?php if (isset($erro)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
        <?php endif; ?>
        
        <form method="post" class="form-grid">
            <!-- Campos lado a lado -->
            <div class="side-by-side">
                <div class="form-group">
                    <label for="nomepaciente" class="form-label">Nome do Paciente</label>
                    <input type="text" class="form-control" id="nomepaciente" name="nomepaciente" required>
                </div>
                
                <div class="form-group">
                    <label for="data" class="form-label">Data</label>
                    <input type="date" class="form-control" id="data" name="data" required>
                </div>
            </div>
            
            <!-- Campos de texto grandes -->
            <div class="form-group full-width">
                <label for="prescricao" class="form-label">Prescrição</label>
                <textarea class="form-control" id="prescricao" name="prescricao" rows="3"></textarea>
            </div>
            
            <div class="form-group full-width">
                <label for="observacoes" class="form-label">Observações</label>
                <textarea class="form-control" id="observacoes" name="observacoes" rows="3"></textarea>
            </div>
            
            <!-- Mais campos lado a lado -->
            <div class="side-by-side">
                <div class="form-group">
                    <label for="diagnostico" class="form-label">Diagnóstico</label>
                    <textarea class="form-control" id="diagnostico" name="diagnostico" rows="3"></textarea>
                </div>
                
                <div class="form-group">
                    <label for="atestado" class="form-label">Atestado</label>
                    <textarea class="form-control" id="atestado" name="atestado" rows="3"></textarea>
                </div>
            </div>
            
            <!-- Campos individuais -->
            <div class="form-group full-width">
                <label for="encaminhamento" class="form-label">Encaminhamento</label>
                <textarea class="form-control" id="encaminhamento" name="encaminhamento" rows="3"></textarea>
            </div>
            
            <div class="form-group full-width">
                <label for="antecedentes" class="form-label">Antecedentes</label>
                <textarea class="form-control" id="antecedentes" name="antecedentes" rows="3"></textarea>
            </div>
            
            <div class="side-by-side">
                <div class="form-group">
                    <label for="solicitacaoexames" class="form-label">Solicitação de Exames</label>
                    <textarea class="form-control" id="solicitacaoexames" name="solicitacaoexames" rows="3"></textarea>
                </div>
                
                <div class="form-group">
                    <label for="exames" class="form-label">Exames</label>
                    <textarea class="form-control" id="exames" name="exames" rows="3"></textarea>
                </div>
            </div>
            
            <!-- Grupo de botões -->
            <div class="button-group">
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="index.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>