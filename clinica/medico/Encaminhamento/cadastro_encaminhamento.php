<?php
require_once(__DIR__ . '/../Classes/Encaminhamento.class.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $encaminhamento = new Encaminhamento();
        $encaminhamento->setPaciente($_POST['paciente']);
        $encaminhamento->setMedico($_POST['medico']);
        $encaminhamento->setData($_POST['data']);
        $encaminhamento->setEspecialidade($_POST['especialidade']);
        $encaminhamento->setMotivo($_POST['motivo']);
        $encaminhamento->setObservacoes($_POST['observacoes']);
        
        $id = $encaminhamento->salvar();
        $nomeArquivo = $encaminhamento->gerarPDF();
        
        header("Location: visualizar_encaminhamento.php?id=" . $id);
        exit();
    } catch (Exception $e) {
        header("Location: form_cad_encaminhamento.html?erro=" . urlencode($e->getMessage()));
        exit();
    }
} else {
    header("Location: form_cad_encaminhamento.html");
    exit();
}