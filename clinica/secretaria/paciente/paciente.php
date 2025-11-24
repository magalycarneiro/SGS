<?php
require_once __DIR__ . '/../Classes/Paciente.class.php';

$conn = new mysqli("localhost", "root", "", "sgs");
if ($conn->connect_error) die("Erro de conexão: " . $conn->connect_error);

$idpaciente = isset($_POST['idpaciente']) && $_POST['idpaciente'] !== '' ? (int) $_POST['idpaciente'] : null;
$nome     = $_POST['nome'] ?? '';
$cpf  = $_POST['cpf'] ?? '';
$data_nascimento   = $_POST['data_nascimento'] ?? '';
$telefone = $_POST['telefone'] ?? '';
$email = $_POST['email'] ?? '';
$endereco = $_POST['endereco'] ?? '';
$acao       = $_POST['acao'] ?? '';

$paciente = new Paciente($idpaciente, $nome, $cpf, $data_nascimento, $telefone, $email, $endereco);

if ($acao === "salvar") {

    if ($paciente->idpaciente) {
        $stmt = $conn->prepare("
            UPDATE paciente SET 
                nome=?, cpf=?, data_nascimento=?, telefone=?, email=?, endereco=?
            WHERE idpaciente=?
        ");

        $stmt->bind_param(
            "ssssssi",
            $paciente->nome,
            $paciente->cpf,
            $paciente->data_nascimento,
            $paciente->telefone,
            $paciente->email,
            $paciente->endereco,
            $paciente->idpaciente
        );

    } else {

        $stmt = $conn->prepare("
            INSERT INTO paciente (nome, cpf, data_nascimento, telefone, email, endereco)
            VALUES (?, ?, ?, ?, ?, ?)
        ");

        $stmt->bind_param(
            "ssssss",
            $paciente->nome,
            $paciente->cpf,
            $paciente->data_nascimento,
            $paciente->telefone,
            $paciente->email,
            $paciente->endereco
        );
    }

    if ($stmt->execute()) {
        header("Location: lista_paciente.php");
        exit();
    } else {
        die("Erro ao salvar paciente: " . $stmt->error);
    }


} elseif ($acao === "excluir") {

    if ($paciente->idpaciente) {
        $stmt = $conn->prepare("DELETE FROM paciente WHERE idpaciente=?");
        $stmt->bind_param("i", $paciente->idpaciente);

        if ($stmt->execute()) {
            header("Location: lista_paciente.php");
            exit();
        } else {
            die("Erro ao excluir paciente: " . $stmt->error);
        }

    } else {
        die("Nenhum código de paciente informado para exclusão.");
    }
}

$conn->close();

