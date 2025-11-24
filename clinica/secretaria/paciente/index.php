<?php
require_once(__DIR__ . "/../Classes/Paciente.class.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $idpaciente = isset($_POST['idpaciente']) ? intval($_POST['idpaciente']) : 0;
    $nome = $_POST['nome'] ?? '';
    $cpf = $_POST['cpf'] ?? '';
    $data_nascimento = $_POST['data_nascimento'] ?? '';
    $telefone = $_POST['telefone'] ?? '';
    $email = $_POST['email'] ?? '';
    $endereco = $_POST['endereco'] ?? '';
    $acao = $_POST['acao'] ?? '';

    $paciente = new Paciente($idpaciente, $nome, $cpf, $data_nascimento, $telefone, $email, $endereco);

    if ($acao == 'salvar') {
        if ($idpaciente > 0) {
            $paciente->alterar();
        } else {
            $paciente->inserir();
        }
    } elseif ($acao == 'excluir') {
        if ($idpaciente > 0) {
            $paciente->excluir();
        }
    }

    header("Location: index.php");
    exit;
}

$form = file_get_contents('form_cad_paciente.php');

$idpaciente = isset($_GET['idpaciente']) ? intval($_GET['idpaciente']) : 0;

if ($idpaciente > 0) {
    $resultado = Paciente::listar(1, $idpaciente);
} else {
    $resultado = [];
}

if (!empty($resultado)) {
    $paciente = $resultado[0];

    $form = str_replace('{idpaciente}', $paciente->getPaciente(), $form);
    $form = str_replace('{nome}', $paciente->getNome(), $form);
    $form = str_replace('{cpf}', $paciente->getCPF(), $form);
    $form = str_replace('{data_nascimento}', $paciente->getData_nascimento(), $form);
    $form = str_replace('{telefone}', $paciente->getTelefone(), $form);
    $form = str_replace('{email}', $paciente->getEmail(), $form);
    $form = str_replace('{endereco}', $paciente->getEndereco(), $form);

} else {
    $form = str_replace('{idpaciente}', '0', $form);
    $form = str_replace('{nome}', '', $form);
    $form = str_replace('{cpf}', '', $form);
    $form = str_replace('{data_nascimento}', '', $form);
    $form = str_replace('{telefone}', '', $form);
    $form = str_replace('{email}', '', $form);
    $form = str_replace('{endereco}', '', $form);
}

echo $form;

echo "<br><br><a href='lista_paciente.php'>Ver Lista de Pacientes</a>";
