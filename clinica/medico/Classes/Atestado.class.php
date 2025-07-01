<?php
require_once(__DIR__ . '/../../Classe/Database.class.php');

class Atestado {
    private $id;
    private $paciente;
    private $medico;
    private $data;
    private $cid;
    private $dias;
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
    
    public function setCid($cid) { $this->cid = $cid; }
    public function getCid() { return $this->cid; }
    
    public function setDias($dias) { $this->dias = $dias; }
    public function getDias() { return $this->dias; }
    
    public function setObservacoes($observacoes) { $this->observacoes = $observacoes; }
    public function getObservacoes() { return $this->observacoes; }

    // Salva o atestado no banco de dados
    public function salvar() {
        $sql = "INSERT INTO atestados 
                (paciente, medico, data, cid, dias, observacoes) 
                VALUES 
                (:paciente, :medico, :data, :cid, :dias, :observacoes)";
        
        $params = [
            ':paciente' => $this->paciente,
            ':medico' => $this->medico,
            ':data' => $this->data,
            ':cid' => $this->cid,
            ':dias' => $this->dias,
            ':observacoes' => $this->observacoes
        ];
        
        try {
            Database::executar($sql, $params);
            $this->id = Database::getLastInsertId();
            return $this->id;
        } catch (Exception $e) {
            error_log("Erro ao salvar atestado: " . $e->getMessage());
            throw new Exception("Não foi possível salvar o atestado.");
        }
    }

    // Gera um HTML como se fosse PDF (sem bibliotecas externas)
    public function gerarPDF() {
        // Gera o conteúdo HTML
        $html = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Atestado Médico</title>
            <style>
                body { font-family: Arial; margin: 20px; }
                .titulo { text-align: center; font-size: 18px; font-weight: bold; color: #693E7F; }
                .conteudo { margin-top: 20px; line-height: 1.6; }
                .assinatura { margin-top: 50px; text-align: center; border-top: 1px solid #000; padding-top: 10px; }
            </style>
        </head>
        <body>
            <div class="titulo">ATESTADO MÉDICO</div>
            <div class="conteudo">
                <p>Atesto que o(a) Sr(a). <strong>' . htmlspecialchars($this->paciente) . '</strong> esteve sob meus cuidados médicos.</p>
                <p>Diagnóstico: CID ' . htmlspecialchars($this->cid) . '</p>
                <p>Recomenda-se repouso por ' . htmlspecialchars($this->dias) . ' dias.</p>
                <p>Observações: ' . htmlspecialchars($this->observacoes) . '</p>
                <p>Local e Data: ' . date('d/m/Y', strtotime($this->data)) . '</p>
                
                <div class="assinatura">
                    <p>________________________________________</p>
                    <p>' . htmlspecialchars($this->medico) . '</p>
                    <p>CRM: </p>
                </div>
            </div>
        </body>
        </html>';

        // Define o caminho de salvamento
        $pastaAtestados = dirname(__DIR__) . '/Atestado/pdfs/';
        if (!file_exists($pastaAtestados)) {
            mkdir($pastaAtestados, 0777, true);
        }

        // Salva como arquivo .pdf (na verdade, é HTML)
        $nomeArquivo = 'Atestado_' . $this->id . '.pdf';
        file_put_contents($pastaAtestados . $nomeArquivo, $html);

        return $nomeArquivo;
    }

    // Busca um atestado pelo ID
    public static function buscarPorId($id) {
        $sql = "SELECT * FROM atestados WHERE id = :id";
        $params = [':id' => $id];
        
        try {
            $resultado = Database::executar($sql, $params);
            return $resultado->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Erro ao buscar atestado: " . $e->getMessage());
            return false;
        }
    }

    // Lista todos os atestados
    public static function listarTodos() {
        $sql = "SELECT * FROM atestados ORDER BY data DESC";
        
        try {
            $resultado = Database::executar($sql);
            return $resultado->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Erro ao listar atestados: " . $e->getMessage());
            return [];
        }
    }
}