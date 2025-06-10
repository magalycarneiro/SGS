<?php
require_once(__DIR__ . '/../Classes/Atestado.class.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $atestado = new Atestado();
        $atestado->setPaciente($_POST['paciente']);
        $atestado->setMedico($_POST['medico']);
        $atestado->setData($_POST['data']);
        $atestado->setCid($_POST['cid']);
        $atestado->setDias($_POST['dias']);
        $atestado->setObservacoes($_POST['observacoes']);
        
        $id = $atestado->salvar();
        $nomeArquivo = $atestado->gerarPDF();
        
        header("Location: index.php?sucesso=1&id=" . $id);
        exit();
    } catch (Exception $e) {
        header("Location: form_cad_atestado.html?erro=" . urlencode($e->getMessage()));
        exit();
    }
} else {
    header("Location: form_cad_atestado.html");
    exit();
}