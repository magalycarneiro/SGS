<?php
class Agendamento {
    private $conn;

    public function __construct($pdo) {
        $this->conn = $pdo;
    }

    public function cadastrar($dados) {
        $sql = "INSERT INTO agendamentos 
                (nome_paciente, nome_medico, data_consulta, horario, observacoes)
                VALUES (:nome_paciente, :nome_medico, :data_consulta, :horario, :observacoes)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($dados);
    }
}
?>
