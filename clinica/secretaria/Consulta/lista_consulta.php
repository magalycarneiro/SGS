<?php
require_once("../Classes/Consulta.class.php");

if (isset($_GET['excluir'])) {
    $id = intval($_GET['excluir']);

    if ($id > 0) {
        $c = new Consulta($id, '', '', '', '');
        $c->excluir();
    }

    header("Location: lista_consulta.php");
    exit;
}

$busca = $_GET['busca'] ?? "";
$tipo  = $_GET['tipo'] ?? 0;

$lista = Consulta::listar($tipo, $busca);

$itens = '';

foreach ($lista as $consulta) {
    $item = file_get_contents('itens_listagem_consultas.html');

    $item = str_replace('{idconsulta}', $consulta->getConsulta(), $item);
    $statusTxt = ($consulta->getStatus() == 1) ? "Confirmada" : "Não confirmada";
    $item = str_replace('{status}', $statusTxt, $item);
    $item = str_replace('{paciente}', $consulta->getPaciente(), $item);
    $item = str_replace('{medico}', $consulta->getMedico(), $item);
    $item = str_replace('{data_hora}', $consulta->getDataHora(), $item);

    $itens .= $item;
}

$html = file_get_contents('listagem_consulta.html');
$html = str_replace('{itens}', $itens, $html);

echo $html;

?>
