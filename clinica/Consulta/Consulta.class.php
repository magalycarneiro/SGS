<?php
require_once ("Database.class.php");

class Consulta {
    private $id;
    private $paciente;
    private $medico;
    private $data;
    private $clinica;
    private $anexos;

    // construtor da classe
    public function __construct($id, $paciente, $medico, $data, $clinica, $anexos) {
        $this->id = $id;
        $this->paciente = $paciente;
        $this->medico = $medico;
        $this->data = $data;
        $this->clinica = $clinica;
        $this->anexos = $anexos;
    }

    // métodos set
    public function setPaciente($paciente) {
        if ($paciente == "")
            throw new Exception("Erro, o nome do paciente deve ser informado!");
        else
            $this->paciente = $paciente;
    }

    public function setId($id) {
        if ($id < 0)
            throw new Exception("Erro, a ID deve ser maior que 0!");
        else
            $this->id = $id;
    }

    public function setMedico($medico) {
        if ($medico == "")
            throw new Exception("Erro, o médico responsável deve ser informado!");
        else
            $this->medico = $medico;
    }

    public function setData($data) {
        if ($data == "")
            throw new Exception("Erro, a data da consulta deve ser informada!");
        else
            $this->data = $data;
    }

    public function setClinica($clinica) {
        if ($clinica == "")
            throw new Exception("Erro, a clínica deve ser informada!");
        else
            $this->clinica = $clinica;
    }

    // Anexos pode ser em branco por isso o parâmetro é opcional
    public function setAnexos($anexos = '') {
        $this->anexos = $anexos;
    }

    // métodos get
    public function getId(): int {
        return $this->id;
    }
    public function getPaciente(): String {
        return $this->paciente;
    }
    public function getMedico(): String {
        return $this->medico;
    }
    public function getData(): String {
        return $this->data;
    }
    public function getClinica(): String {
        return $this->clinica;
    }
    public function getAnexos(): String {
        return $this->anexos;
    }

    // método mágico para imprimir uma consulta
    public function __toString(): String {  
        $str = "Consulta: $this->id - Paciente: $this->paciente
                 - Médico: $this->medico
                 - Data: $this->data
                 - Clínica: $this->clinica
                 - Anexos: $this->anexos";        
        return $str;
    }

    // insere uma consulta no banco 
    public function inserir(): Bool {
        $sql = "INSERT INTO consultas 
                    (paciente, medico, data, clinica, anexos)
                    VALUES(:paciente, :medico, :data, :clinica, :anexos)";
        
        $parametros = array(':paciente'=>$this->getPaciente(),
                            ':medico'=>$this->getMedico(),
                            ':data'=>$this->getData(),
                            ':clinica'=>$this->getClinica(),
                            ':anexos'=>$this->getAnexos());
        
        return Database::executar($sql, $parametros) == true;
    }

    public static function listar($tipo=0, $info=''): Array {
        $sql = "SELECT * FROM consultas";
        switch ($tipo) {
            case 0: break;
            case 1: $sql .= " WHERE id = :info ORDER BY id"; break; // filtro por ID
            case 2: $sql .= " WHERE paciente like :info ORDER BY paciente"; $info = '%'.$info.'%'; break; // filtro por nome do paciente
        }
        $parametros = array();
        if ($tipo > 0)
            $parametros = [':info'=>$info];

        $comando = Database::executar($sql, $parametros);
        $consultas = [];
        while ($registro = $comando->fetch()) {
            $consulta = new Consulta($registro['id'], $registro['paciente'], $registro['medico'], $registro['data'], $registro['clinica'], $registro['anexos']);
            array_push($consultas, $consulta);
        }
        return $consultas;
    }

    public function alterar(): Bool {       
       $sql = "UPDATE consultas
                  SET paciente = :paciente, 
                      medico = :medico,
                      data = :data,
                      clinica = :clinica,
                      anexos = :anexos
                WHERE id = :id";
         $parametros = array(':id'=>$this->getId(),
                        ':paciente'=>$this->getPaciente(),
                        ':medico'=>$this->getMedico(),
                        ':data'=>$this->getData(),
                        ':clinica'=>$this->getClinica(),
                        ':anexos'=>$this->getAnexos());
        return Database::executar($sql, $parametros) == true;
    }

    public function excluir(): Bool {
        $sql = "DELETE FROM consultas
                      WHERE id = :id";
        $parametros = array(':id'=>$this->getId());
        return Database::executar($sql, $parametros) == true;
     }
}
?>