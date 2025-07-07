<?php
require_once(__DIR__ . '/../Classes/SolicitacaoExame.class.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $solicitacao = new SolicitacaoExame();
        $solicitacao->setPaciente($_POST['paciente']);
        $solicitacao->setMedico($_POST['medico']);
        $solicitacao->setData($_POST['data']);
        $solicitacao->setTipoExame($_POST['tipoExame']);
        $solicitacao->setIndicacao($_POST['indicacao']);
        $solicitacao->setUrgente(isset($_POST['urgente']) ? 1 : 0);
        $solicitacao->setObservacoes($_POST['observacoes']);
        
        $id = $solicitacao->salvar();
        $nomeArquivo = $solicitacao->gerarPDF();
        
        header("Location: visualizar_solicitacao.php?id=" . $id);
        exit();
    } catch (Exception $e) {
        header("Location: form_cad_solicitacao.html?erro=" . urlencode($e->getMessage()));
        exit();
    }
} else {
    header("Location: form_cad_solicitacao.html");
    exit();
}