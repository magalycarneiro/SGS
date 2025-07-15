<?php
require_once(__DIR__ . '/../../Classe/Database.class.php');

class SolicitacaoExame {
    private $id;
    private $paciente;
    private $medico;
    private $data;
    private $tipoExame;
    private $indicacao;
    private $urgente;
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
    
    public function setTipoExame($tipoExame) { $this->tipoExame = $tipoExame; }
    public function getTipoExame() { return $this->tipoExame; }
    
    public function setIndicacao($indicacao) { $this->indicacao = $indicacao; }
    public function getIndicacao() { return $this->indicacao; }
    
    public function setUrgente($urgente) { $this->urgente = $urgente; }
    public function getUrgente() { return $this->urgente; }
    
    public function setObservacoes($observacoes) { $this->observacoes = $observacoes; }
    public function getObservacoes() { return $this->observacoes; }

    // Salva a solicitação no banco
    public function salvar() {
        $sql = "INSERT INTO solicitacoes_exames 
                (paciente, medico, data, tipo_exame, indicacao, urgente, observacoes) 
                VALUES 
                (:paciente, :medico, :data, :tipoExame, :indicacao, :urgente, :observacoes)";
        
        $params = [
            ':paciente' => $this->paciente,
            ':medico' => $this->medico,
            ':data' => $this->data,
            ':tipoExame' => $this->tipoExame,
            ':indicacao' => $this->indicacao,
            ':urgente' => $this->urgente,
            ':observacoes' => $this->observacoes
        ];
        
        try {
            Database::executar($sql, $params);
            $this->id = Database::getLastInsertId();
            return $this->id;
        } catch (Exception $e) {
            error_log("Erro ao salvar solicitação: " . $e->getMessage());
            throw new Exception("Não foi possível salvar a solicitação de exame.");
        }
    }

    // Gera o PDF da solicitação
    public function gerarPDF() {
        $urgenteText = $this->urgente ? "SIM (Prioridade)" : "Não";
        
        $html = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Solicitação de Exame</title>
            <style>
                body { font-family: Arial; margin: 20px; }
                .header { text-align: center; margin-bottom: 20px; }
                .title { font-size: 18px; font-weight: bold; color: #693E7F; }
                .content { margin-top: 20px; line-height: 1.6; }
                .section { margin-bottom: 15px; }
                .signature { margin-top: 50px; text-align: center; border-top: 1px solid #000; padding-top: 10px; }
            </style>
        </head>
        <body>
            <div class="header">
                <div class="title">SOLICITAÇÃO DE EXAME MÉDICO</div>
                <div>ID: ' . $this->id . '</div>
            </div>
            
            <div class="content">
                <div class="section">
                    <p><strong>Paciente:</strong> ' . htmlspecialchars($this->paciente) . '</p>
                    <p><strong>Data:</strong> ' . date('d/m/Y', strtotime($this->data)) . '</p>
                </div>
                
                <div class="section">
                    <p><strong>Tipo de Exame:</strong> ' . htmlspecialchars($this->tipoExame) . '</p>
                    <p><strong>Urgente:</strong> ' . $urgenteText . '</p>
                </div>
                
                <div class="section">
                    <p><strong>Indicação Clínica:</strong></p>
                    <p>' . nl2br(htmlspecialchars($this->indicacao)) . '</p>
                </div>
                
                <div class="section">
                    <p><strong>Observações:</strong></p>
                    <p>' . nl2br(htmlspecialchars($this->observacoes)) . '</p>
                </div>
                
                <div class="signature">
                    <p>________________________________________</p>
                    <p>' . htmlspecialchars($this->medico) . '</p>
                    <p>CRM: </p>
                </div>
            </div>
        </body>
        </html>';

        $pasta = dirname(__DIR__) . '/SolicitacaoExame/pdfs/';
        if (!file_exists($pasta)) {
            mkdir($pasta, 0777, true);
        }

        $nomeArquivo = 'Solicitacao_' . $this->id . '.pdf';
        file_put_contents($pasta . $nomeArquivo, $html);

        return $nomeArquivo;
    }

    // Busca uma solicitação por ID
    public static function buscarPorId($id) {
        $sql = "SELECT * FROM solicitacoes_exames WHERE id = :id";
        $params = [':id' => $id];
        
        try {
            $resultado = Database::executar($sql, $params);
            return $resultado->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Erro ao buscar solicitação: " . $e->getMessage());
            return false;
        }
    }

    // Lista todas as solicitações
    public static function listarTodos() {
        $sql = "SELECT * FROM solicitacoes_exames ORDER BY data DESC";
        
        try {
            $resultado = Database::executar($sql);
            return $resultado->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Erro ao listar solicitações: " . $e->getMessage());
            return false;
        }
    }
}