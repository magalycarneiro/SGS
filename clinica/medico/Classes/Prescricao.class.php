<?php
require_once(__DIR__ . '/../../Classe/Database.class.php');

class Prescricao {
    private $id;
    private $paciente;
    private $medico;
    private $data;
    private $medicamentos;
    private $posologia;
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
    
    public function setMedicamentos($medicamentos) { $this->medicamentos = $medicamentos; }
    public function getMedicamentos() { return $this->medicamentos; }
    
    public function setPosologia($posologia) { $this->posologia = $posologia; }
    public function getPosologia() { return $this->posologia; }
    
    public function setObservacoes($observacoes) { $this->observacoes = $observacoes; }
    public function getObservacoes() { return $this->observacoes; }

    // Salva a prescrição no banco de dados
    public function salvar() {
        $sql = "INSERT INTO prescricoes 
                (paciente, medico, data, medicamentos, posologia, observacoes) 
                VALUES 
                (:paciente, :medico, :data, :medicamentos, :posologia, :observacoes)";
        
        $params = [
            ':paciente' => $this->paciente,
            ':medico' => $this->medico,
            ':data' => $this->data,
            ':medicamentos' => $this->medicamentos,
            ':posologia' => $this->posologia,
            ':observacoes' => $this->observacoes
        ];
        
        try {
            Database::executar($sql, $params);
            $this->id = Database::getLastInsertId();
            return $this->id;
        } catch (Exception $e) {
            error_log("Erro ao salvar prescrição: " . $e->getMessage());
            throw new Exception("Não foi possível salvar a prescrição.");
        }
    }

    // Gera o HTML da prescrição
    public function gerarPDF() {
        $html = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Prescrição Médica</title>
            <style>
                body { font-family: Arial; margin: 20px; }
                .titulo { text-align: center; font-size: 18px; font-weight: bold; color: #693E7F; }
                .conteudo { margin-top: 20px; line-height: 1.6; }
                .assinatura { margin-top: 50px; text-align: center; border-top: 1px solid #000; padding-top: 10px; }
                table { width: 100%; border-collapse: collapse; margin: 15px 0; }
                th { background-color: #f2f2f2; text-align: left; padding: 8px; }
                td { padding: 8px; border-bottom: 1px solid #ddd; }
            </style>
        </head>
        <body>
            <div class="titulo">PRESCRIÇÃO MÉDICA</div>
            <div class="conteudo">
                <p><strong>Paciente:</strong> ' . htmlspecialchars($this->paciente) . '</p>
                <p><strong>Data:</strong> ' . date('d/m/Y', strtotime($this->data)) . '</p>
                
                <table>
                    <tr>
                        <th>Medicamento</th>
                        <th>Posologia</th>
                    </tr>
                    <tr>
                        <td>' . nl2br(htmlspecialchars($this->medicamentos)) . '</td>
                        <td>' . nl2br(htmlspecialchars($this->posologia)) . '</td>
                    </tr>
                </table>
                
                <p><strong>Observações:</strong> ' . nl2br(htmlspecialchars($this->observacoes)) . '</p>
                
                <div class="assinatura">
                    <p>________________________________________</p>
                    <p>' . htmlspecialchars($this->medico) . '</p>
                    <p>CRM: </p>
                </div>
            </div>
        </body>
        </html>';

        $pastaPrescricoes = dirname(__DIR__) . '/Prescricao/pdfs/';
        if (!file_exists($pastaPrescricoes)) {
            mkdir($pastaPrescricoes, 0777, true);
        }

        $nomeArquivo = 'Prescricao_' . $this->id . '.pdf';
        file_put_contents($pastaPrescricoes . $nomeArquivo, $html);

        return $nomeArquivo;
    }

    // Busca uma prescrição pelo ID
    public static function buscarPorId($id) {
        $sql = "SELECT * FROM prescricoes WHERE id = :id";
        $params = [':id' => $id];
        
        try {
            $resultado = Database::executar($sql, $params);
            return $resultado->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Erro ao buscar prescrição: " . $e->getMessage());
            return false;
        }
    }
}