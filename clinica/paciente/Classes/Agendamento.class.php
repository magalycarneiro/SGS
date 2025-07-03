<?php
require_once(__DIR__ . '/../../config/conexao.php');

class Agendamento {
    public static function listar() {
        try {
            $conexao = Conexao::getConexao(); // <- aqui corrigimos o método
            $sql = "SELECT * FROM agendamentos";
            $stmt = $conexao->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erro ao listar agendamentos: " . $e->getMessage());
        }
    }

    public static function salvar($medico, $data, $hora, $especialidade) {
        try {
            $conexao = Conexao::getConexao();
            $sql = "INSERT INTO agendamentos (medico, data, hora, especialidade) VALUES (?, ?, ?, ?)";
            $stmt = $conexao->prepare($sql);
            $stmt->execute([$medico, $data, $hora, $especialidade]);
            return true;
        } catch (PDOException $e) {
            die("Erro ao salvar agendamento: " . $e->getMessage());
        }
    }

       public static function excluir($id) {
        try {
            $conexao = Conexao::getConexao();
            $sql = "DELETE FROM agendamentos WHERE id = ?";
            $stmt = $conexao->prepare($sql);
            $stmt->execute([$id]);
            return true;
        } catch (PDOException $e) {
            die("Erro ao excluir agendamento: " . $e->getMessage());
        }
    }
}
?>
