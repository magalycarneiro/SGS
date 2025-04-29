<?php
session_start();

// Verifica se o usuário está logado e é secretária
if (!isset($_SESSION['loggedin']) || $_SESSION['userdata']['tipo'] !== 'secretaria') {
    header("Location: login.php");
    exit;
}

require_once 'includes/conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Cancelar agendamento
    if (isset($_POST['cancelar'])) {
        $id_agendamento = $_POST['id_agendamento'];
        
        try {
            $pdo->beginTransaction();
            
            // Atualiza status do agendamento
            $stmt = $pdo->prepare("UPDATE agendamentos SET status = 'cancelado' WHERE id = ?");
            $stmt->execute([$id_agendamento]);
            
            // Libera o horário
            $stmt = $pdo->prepare("
                UPDATE horarios h
                JOIN agendamentos a ON h.id = a.id_horario
                SET h.disponivel = TRUE
                WHERE a.id = ?
            ");
            $stmt->execute([$id_agendamento]);
            
            $pdo->commit();
            $_SESSION['mensagem'] = "Agendamento cancelado com sucesso!";
        } catch (PDOException $e) {
            $pdo->rollBack();
            $_SESSION['erro'] = "Erro ao cancelar agendamento: " . $e->getMessage();
        }
    }
    
    // Novo agendamento
    elseif (isset($_POST['agendar'])) {
        $paciente = $_POST['paciente'];
        $cpf = $_POST['cpf'];
        $id_medico = $_POST['id_medico'];
        $tipo_consulta = $_POST['tipo_consulta'];
        $data = $_POST['data'];
        $hora = $_POST['hora'];
        $observacoes = $_POST['observacoes'] ?? '';
        
        try {
            $pdo->beginTransaction();
            
            // Verifica se paciente existe ou cria novo
            $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE cpf = ?");
            $stmt->execute([$cpf]);
            $paciente_existente = $stmt->fetch();
            
            if ($paciente_existente) {
                $id_paciente = $paciente_existente['id'];
            } else {
                $stmt = $pdo->prepare("
                    INSERT INTO usuarios (nome, cpf, tipo)
                    VALUES (?, ?, 'paciente')
                ");
                $stmt->execute([$paciente, $cpf]);
                $id_paciente = $pdo->lastInsertId();
            }
            
            // Cria horário se não existir
            $stmt = $pdo->prepare("
                SELECT id FROM horarios 
                WHERE data = ? AND hora = ? AND id_medico = ?
            ");
            $stmt->execute([$data, $hora, $id_medico]);
            $horario_existente = $stmt->fetch();
            
            if ($horario_existente) {
                $id_horario = $horario_existente['id'];
                // Verifica se horário está disponível
                $stmt = $pdo->prepare("SELECT disponivel FROM horarios WHERE id = ?");
                $stmt->execute([$id_horario]);
                $disponivel = $stmt