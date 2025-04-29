<?php
session_start();

// Verifica se o usuário está logado e é médico
if (!isset($_SESSION['loggedin']) || $_SESSION['userdata']['tipo'] !== 'medico') {
    header("Location: login.php");
    exit;
}

$user = $_SESSION['userdata'];
require_once 'includes/conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['salvar_prontuario'])) {
    $id_prontuario = $_POST['id_prontuario'] ?? null;
    $id_paciente = $_POST['id_paciente'];
    $data_consulta = $_POST['data_consulta'];
    $diagnostico = $_POST['diagnostico'];
    $sintomas = $_POST['sintomas'] ?? '';
    $tratamento = $_POST['tratamento'] ?? '';
    $observacoes = $_POST['observacoes'] ?? '';
    
    try {
        if (empty($id_prontuario)) {
            // Novo prontuário
            $stmt = $pdo->prepare("
                INSERT INTO prontuarios 
                (id_paciente, id_medico, data_consulta, diagnostico, sintomas, tratamento, observacoes)
                VALUES (?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([
                $id_paciente,
                $user['id'],
                $data_consulta,
                $diagnostico,
                $sintomas,
                $tratamento,
                $observacoes
            ]);
            
            $_SESSION['mensagem'] = "Prontuário criado com sucesso!";
        } else {
            // Atualizar prontuário existente
            $stmt = $pdo->prepare("
                UPDATE prontuarios SET
                id_paciente = ?,
                data_consulta = ?,
                diagnostico = ?,
                sintomas = ?,
                tratamento = ?,
                observacoes = ?
                WHERE id = ? AND id_medico = ?
            ");
            $stmt->execute([
                $id_paciente,
                $data_consulta,
                $diagnostico,
                $sintomas,
                $tratamento,
                $observacoes,
                $id_prontuario,
                $user['id']
            ]);
            
            $_SESSION['mensagem'] = "Prontuário atualizado com sucesso!";
        }
    } catch (PDOException $e) {
        $_SESSION['erro'] = "Erro ao salvar prontuário: " . $e->getMessage();
    }
    
    header("Location: medico.php");
    exit;
}