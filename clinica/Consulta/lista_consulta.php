<?php
require_once("../Classes/Consulta.class.php");
$busca = isset($_GET['busca']) ? $_GET['busca'] : "";
$tipo = isset($_GET['tipo']) ? $_GET['tipo'] : 0;

$lista = Consulta::listar($tipo, $busca);
$itens = '';
foreach($lista as $consulta) {
    $item = file_get_contents('itens_listagem_consultas.html');
    
    // Handle file attachments display
    $anexos = $consulta->getAnexos();
    $hide_anexos = empty($anexos) ? 'style="display:none"' : '';
    
    $item = str_replace('{id}', $consulta->getId(), $item);
    $item = str_replace('{paciente}', $consulta->getPaciente(), $item);
    $item = str_replace('{medico}', $consulta->getMedico(), $item);
    $item = str_replace('{data}', formatarData($consulta->getData()), $item);
    $item = str_replace('{clinica}', $consulta->getClinica(), $item);
    
    $itens .= $item;
}

$listagem = file_get_contents('listagem_consulta.html');
$listagem = str_replace('{itens}', $itens, $listagem);
print($listagem);

// Helper function to format date
function formatarData($data) {
    if (empty($data)) return "";
    $date = new DateTime($data);
    return $date->format('d/m/Y H:i');
}
?>