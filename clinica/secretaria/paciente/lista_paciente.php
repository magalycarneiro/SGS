<?php
require_once("../Classes/Paciente.class.php");

if (isset($_GET['excluir'])) {
    $id = intval($_GET['excluir']);

    if ($id > 0) {
        $c = new Paciente($id, '', '', '', '', '', '');
        $c->excluir();
    }

    header("Location: lista_consulta.php");
    exit;
}

$busca = $_GET['busca'] ?? "";
$tipo  = $_GET['tipo'] ?? 0;

$lista = Paciente::listar($tipo, $busca);

$itens = '';

foreach ($lista as $paciente) {
    $item = file_get_contents('itens_listagem_pacientes.html');

    $item = str_replace('{idpaciente}', $paciente->getPaciente(), $item);
    $item = str_replace('{nome}', $paciente->getNome(), $item);
    $item = str_replace('{cpf}', $paciente->getCPF(), $item);
    $item = str_replace('{data_nascimento}', $paciente->getData_nascimento(), $item);
    $item = str_replace('{telefone}', $paciente->getTelefone(), $item);

    $itens .= $item;
}

$html = file_get_contents('listagem_paciente.html');
$html = str_replace('{itens}', $itens, $html);

echo $html;

?>
