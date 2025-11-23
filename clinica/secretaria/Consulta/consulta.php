<?php
require_once __DIR__ . '/../Classes/Consulta.class.php';

$conn = new mysqli("localhost", "root", "", "sgs");
if ($conn->connect_error) die("Erro de conexão: " . $conn->connect_error);

$idconsulta = isset($_POST['idconsulta']) && $_POST['idconsulta'] !== '' ? (int) $_POST['idconsulta'] : null;
$status     = $_POST['status'] ?? '';
$data_hora  = $_POST['data_hora'] ?? '';
$idmedico   = $_POST['idmedico'] ?? '';
$idpaciente = $_POST['idpaciente'] ?? '';
$acao       = $_POST['acao'] ?? '';

$consulta = new Consulta($idconsulta, $status, $data_hora, $idmedico, $idpaciente);

if ($acao === "salvar") {
    if ($consulta->idconsulta) {
        // Atualiza consulta
        $stmt = $conn->prepare("UPDATE consulta SET status=?, idpaciente=?, idmedico=?, data_hora=? WHERE idconsulta=?");
        $stmt->bind_param("ssssi", $consulta->status, $consulta->idpaciente, $consulta->idmedico, $consulta->data_hora, $consulta->idconsulta);
    } else {
        // Nova consulta
        $stmt = $conn->prepare("INSERT INTO consulta (status, idpaciente, idmedico, data_hora) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $consulta->status, $consulta->idpaciente, $consulta->idmedico, $consulta->data_hora);
    }

    if ($stmt->execute()) {
        header("Location: lista_consulta.php");
        exit();
    } else {
        die("Erro ao salvar consulta: " . $stmt->error);
    }

} elseif ($acao === "excluir") {
    if ($consulta->idconsulta) {
        $stmt = $conn->prepare("DELETE FROM consulta WHERE idconsulta=?");
        $stmt->bind_param("i", $consulta->idconsulta);
        if ($stmt->execute()) {
            header("Location: lista_consulta.php");
            exit();
        } else {
            die("Erro ao excluir consulta: " . $stmt->error);
        }
    } else {
        die("Nenhum código de consulta informado para exclusão.");
    }
}

$conn->close();
