<?php
require_once(__DIR__ . '/../../Classe/Database.class.php');

class Encaminhamento {
    private $id;
    private $paciente;
    private $medico;
    private $data;
    private $especialidade;
    private $motivo;
    private $observacoes;

    // Getters e Setters
    public function setId($id) { $this->id = $id; }
    public function getId() { return $this->id; }
    
    public function setPaciente($paciente) { $this->paciente = $paciente; }
    public function getPaciente() { return $this->paciente; }
    
    public function setMedico($medico) { $this->medico = $medico; }
    public function getMedico() { return $this->medico; }
    
    public function setData($data) { $this->data = $data; }
    public function getData() { return $this->data; }
    
    public function setEspecialidade($especialidade) { $this->especialidade = $especialidade; }
    public function getEspecialidade() { return $this->especialidade; }
    
    public function setMotivo($motivo) { $this->motivo = $motivo; }
    public function getMotivo() { return $this->motivo; }
    
    public function setObservacoes($observacoes) { $this->observacoes = $observacoes; }
    public function getObservacoes() { return $this->observacoes; }

    // Salva o encaminhamento no banco de dados
    public function salvar() {
        $sql = "INSERT INTO encaminhamentos 
                (paciente, medico, data, especialidade, motivo, observacoes) 
                VALUES 
                (:paciente, :medico, :data, :especialidade, :motivo, :observacoes)";
        
        $params = [
            ':paciente' => $this->paciente,
            ':medico' => $this->medico,
            ':data' => $this->data,
            ':especialidade' => $this->especialidade,
            ':motivo' => $this->motivo,
            ':observacoes' => $this->observacoes
        ];
        
        try {
            Database::executar($sql, $params);
            $this->id = Database::getLastInsertId();
            return $this->id;
        } catch (Exception $e) {
            error_log("Erro ao salvar encaminhamento: " . $e->getMessage());
            throw new Exception("Não foi possível salvar o encaminhamento.");
        }
    }

    // Gera o HTML do encaminhamento
    public function gerarPDF() {
        $html = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Encaminhamento Médico</title>
            <style>
                body { font-family: Arial; margin: 20px; }
                .titulo { text-align: center; font-size: 18px; font-weight: bold; color: #693E7F; }
                .conteudo { margin-top: 20px; line-height: 1.6; }
                .assinatura { margin-top: 50px; text-align: center; border-top: 1px solid #000; padding-top: 10px; }
                .dados { margin-bottom: 20px; }
                .dados p { margin: 5px 0; }
            </style>
        </head>
        <body>
            <div class="titulo">ENCAMINHAMENTO MÉDICO</div>
            <div class="conteudo">
                <div class="dados">
                    <p><strong>Paciente:</strong> ' . htmlspecialchars($this->paciente) . '</p>
                    <p><strong>Data:</strong> ' . date('d/m/Y', strtotime($this->data)) . '</p>
                    <p><strong>Encaminhado para:</strong> ' . htmlspecialchars($this->especialidade) . '</p>
                </div>
                
                <div class="motivo">
                    <p><strong>Motivo do encaminhamento:</strong></p>
                    <p>' . nl2br(htmlspecialchars($this->motivo)) . '</p>
                </div>
                
                <div class="observacoes">
                    <p><strong>Observações:</strong></p>
                    <p>' . nl2br(htmlspecialchars($this->observacoes)) . '</p>
                </div>
                
                <div class="assinatura">
                    <p>________________________________________</p>
                    <p>' . htmlspecialchars($this->medico) . '</p>
                    <p>CRM: </p>
                </div>
            </div>
        </body>
        </html>';

        $pastaEncaminhamentos = dirname(__DIR__) . '/Encaminhamento/pdfs/';
        if (!file_exists($pastaEncaminhamentos)) {
            mkdir($pastaEncaminhamentos, 0777, true);
        }

        $nomeArquivo = 'Encaminhamento_' . $this->id . '.pdf';
        file_put_contents($pastaEncaminhamentos . $nomeArquivo, $html);

        return $nomeArquivo;
    }

    // Busca um encaminhamento pelo ID
    public static function buscarPorId($id) {
        $sql = "SELECT * FROM encaminhamentos WHERE id = :id";
        $params = [':id' => $id];
        
        try {
            $resultado = Database::executar($sql, $params);
            return $resultado->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Erro ao buscar encaminhamento: " . $e->getMessage());
            return false;
        }
    }

    // Lista todos os encaminhamentos
    public static function listarTodos() {
        $sql = "SELECT * FROM encaminhamentos ORDER BY data DESC";
        
        try {
            $resultado = Database::executar($sql);
            return $resultado->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Erro ao listar encaminhamentos: " . $e->getMessage());
            return false;
        }
    }
}