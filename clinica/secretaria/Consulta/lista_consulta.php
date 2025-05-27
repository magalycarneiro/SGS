<?php
require_once("../Classes/Consulta.class.php");
$busca = isset($_GET['busca']) ? $_GET['busca'] : "";
$tipo = isset($_GET['tipo']) ? $_GET['tipo'] : 0;

$lista = Consulta::listar($tipo, $busca);
$itens = '';
foreach($lista as $consulta) {
    $item = file_get_contents('itens_listagem_consultas.html');
    
    $item = str_replace('{idconsulta}', $consulta->getIdconsulta(), $item);
    $item = str_replace('{status}', formatarStatus($consulta->getStatus()), $item);
    $item = str_replace('{data_hora}', formatarDataHora($consulta->getDataHora()), $item);
    $item = str_replace('{paciente}', $consulta->getPaciente(), $item);
    $item = str_replace('{medico}', $consulta->getMedico(), $item);
    $item = str_replace('{clinica}', $consulta->getClinica(), $item);
    
    $itens .= $item;
}

$listagem = file_get_contents('listagem_consulta.html');
$listagem = str_replace('{itens}', $itens, $listagem);
print($listagem);

// Helper function to format date
function formatarDataHora($data_hora) {
    if (empty($data_hora)) return "";
    $date = new DateTime($data_hora);
    return $date->format('d/m/Y H:i');
}
?>