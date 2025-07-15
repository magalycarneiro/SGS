<?php
require_once(__DIR__ . '/../Classes/Prescricao.class.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $prescricao = new Prescricao();
        $prescricao->setPaciente($_POST['paciente']);
        $prescricao->setMedico($_POST['medico']);
        $prescricao->setData($_POST['data']);
        $prescricao->setMedicamentos($_POST['medicamentos']);
        $prescricao->setPosologia($_POST['posologia']);
        $prescricao->setObservacoes($_POST['observacoes']);
        
        $id = $prescricao->salvar();
        $nomeArquivo = $prescricao->gerarPDF();
        
        header("Location: visualizar_prescricao.php?id=" . $id);
        exit();
    } catch (Exception $e) {
        header("Location: form_cad_prescricao.html?erro=" . urlencode($e->getMessage()));
        exit();
    }
} else {
    header("Location: form_cad_prescricao.html");
    exit();
}