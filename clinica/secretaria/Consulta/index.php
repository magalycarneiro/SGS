<?php
require_once(__DIR__ . "/../Classes/Consulta.class.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $idconsulta = isset($_POST['idconsulta']) ? intval($_POST['idconsulta']) : 0;
    $status = $_POST['status'] ?? '';
    $idpaciente = $_POST['idpaciente'] ?? '';
    $idmedico = $_POST['idmedico'] ?? '';
    $data_hora = $_POST['data_hora'] ?? '';
    $acao = $_POST['acao'] ?? '';

    $consulta = new Consulta($idconsulta, $status, $data_hora, $idmedico, $idpaciente);

    if ($acao == 'salvar') {
        if ($idconsulta > 0) {
            $consulta->alterar();
        } else {
            $consulta->inserir();
        }
    } elseif ($acao == 'excluir') {
        if ($idconsulta > 0) {
            $consulta->excluir();
        }
    }

    header("Location: index.php");
    exit;
}

$form = file_get_contents('form_cad_consulta.html');

$idconsulta = isset($_GET['idconsulta']) ? intval($_GET['idconsulta']) : 0;

if ($idconsulta > 0) {
    $resultado = Consulta::listar(1, $idconsulta);
} else {
    $resultado = [];
}

if (!empty($resultado)) {
    $consulta = $resultado[0];

    $form = str_replace('{idconsulta}', $consulta->getConsulta(), $form);
    $form = str_replace('{status}', $consulta->getStatus(), $form);
    $form = str_replace('{idpaciente}', $consulta->getPaciente(), $form);
    $form = str_replace('{idmedico}', $consulta->getMedico(), $form);
    $form = str_replace('{data_hora}', $consulta->getDataHora(), $form);

} else {
    $form = str_replace('{idconsulta}', '0', $form);
    $form = str_replace('{status}', '', $form);
    $form = str_replace('{idpaciente}', '', $form);
    $form = str_replace('{idmedico}', '', $form);
    $form = str_replace('{data_hora}', '', $form);
}

echo $form;

echo "<br><br><a href='lista_consulta.php'>Ver Lista de Consultas</a>";

