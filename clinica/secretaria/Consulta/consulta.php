<?php
require_once("../Classes/Consulta.class.php");

$acao = $_POST['acao'] ?? $_GET['acao'] ?? null;

function renderForm($c = null) {
    $tpl = file_get_contents('form_cad_consulta.html');
    $rep = [
        '{idconsulta}' => $c ? $c->getConsulta() : '',
        '{status}'     => $c ? $c->getStatus()   : '',
        '{data_hora}'  => $c ? $c->getDataHora() : '',
        '{idmedico}'   => $c ? $c->getMedico()   : '',
        '{idpaciente}' => $c ? $c->getPaciente() : '',
    ];
    echo str_replace(array_keys($rep), array_values($rep), $tpl);
    exit;
}

switch ($acao) {
    case 'salvar': // criar ou atualizar (se id vier preenchido)
        $idconsulta = trim($_POST['idconsulta'] ?? '');
        $status     = $_POST['status']     ?? '';
        $data_hora  = $_POST['data_hora']  ?? '';
        $idmedico   = $_POST['idmedico']   ?? '';
        $idpaciente = $_POST['idpaciente'] ?? '';

        $consulta = new Consulta($idconsulta, $status, $data_hora, $idmedico, $idpaciente);

        if ($idconsulta === '' || $idconsulta === '0') {
            $consulta->inserir();
        } else {
            $consulta->alterar();
        }
        header("Location: lista_consulta.php");
        exit;

    case 'editar':
        $id = $_GET['idconsulta'] ?? '';
        if ($id === '') { header("Location: lista_consulta.php"); exit; }
        $lista = Consulta::listar(1, $id); // tipo 1 = por código
        if (!$lista) { header("Location: lista_consulta.php"); exit; }
        renderForm($lista[0]);

    case 'excluir':
        $id = $_GET['idconsulta'] ?? '';
        if ($id !== '') {
            $lista = Consulta::listar(1, $id);
            if ($lista) { $lista[0]->excluir(); }
        }
        header("Location: lista_consulta.php");
        exit;

    default: // abrir formulário em branco
        renderForm();
}
