<?php
require_once(__DIR__ . '/../../Classe/Database.class.php');


class Consulta{
    private int $id;
    private $status;
    private $data_hora;
    private $medico;
    private $paciente;
    private $clinica;

    // construtor da classe
    public function __construct($id,$status,$data_hora){
        $this->id = $id;
        $this->status = $status;
        $this->data_hora = $data_hora;
        $this->medico = $medico;
        $this->paciente = $paciente;
        $this->clinica = $clinica;
    }

    // função / interface para aterar e ler
    public function setStatus($status){
        if ($status == "")
            throw new Exception("Erro, o status da consulta deve ser informado!");
        else
            $this->status = $status;
    }
    // cada atributo tem um método set para alterar seu valor
    public function setId($id){
        if ($id < 0)
            throw new Exception("Erro, a ID deve ser maior que 0!");
        else
            $this->id = $id;
    }

    public function setDataHora($data_hora){
            if ($data_hora == "")
                throw new Exception("Erro, a data e hora devem ser informadas!");
            else
                $this->data_hora = $data_hora;
    }

    public function setMedico($medico){
        if ($medico == "")
            throw new Exception("Erro, o médico deve ser informado!");
        else
            $this->medico = $medico;
    }

    public function setPaciente($paciente){
        if ($paciente == "")
            throw new Exception("Erro, o paciente deve ser informado!");
        else
            $this->paciente = $paciente;
    }

    public function setClinica($clinica){
        if ($clinica == "")
            throw new Exception("Erro, a clínica deve ser informada!");
        else
            $this->clinica = $clinica;
    }

    public function getId(): int{
        return $this->id;
    }
    public function getStatus(): String{
        return $this->status;
    }
    public function getDataHora(): String{
        return $this->data_hora;
    }
    public function getMedico(): String{
        return $this->medico;
    }
    public function getPaciente(): String{
        return $this->paciente;
    }
    public function getClinica(): String{
        return $this->clinica;
    }

    // método mágico para imprimir uma consulta
    public function __toString():String{  
        $str = "Consulta: $this->id - $this->status
                 - Data_hora: $this->peso,
                 - Medico: $this->medico,
                 - Paciente: $this->paciente,
                 - Clinica: $this->clinica";        
        return $str;
    }

    // insere uma consulta no banco 
    public function inserir():Bool{
        // montar o sql/ query
        $sql = "INSERT INTO consulta 
                    (status,data_hora, medico, paciente, clinica)
                    VALUES(:status, :data_hora, :medico, :paciente, :clinica)";
        
        $parametros = array(':status'=>$this->getStatus(),
                            ':data_hora'=>$this->getDataHora(),
                            ':medico'=>$this->getMedico(),
                            ':paciente'=>$this->getPaciente(),
                            ':clinica'=>$this->getClinica());
        
        return Database::executar($sql, $parametros) == true;
    }

    public static function listar($tipo=0, $info=''):Array{
        $sql = "SELECT * FROM consulta";
        switch ($tipo){
            case 0: break;
            case 1: $sql .= " WHERE id = :info ORDER BY id"; break; // filtro por ID
            case 2: $sql .= " WHERE status like :info ORDER BY status"; $info = '%'.$info.'%'; break; // filtro por descrição
        }
        $parametros = array();
        if ($tipo > 0)
            $parametros = [':info'=>$info];

        $comando = Database::executar($sql, $parametros);
        $consultas = [];
        while ($registro = $comando->fetch()){
            $consulta = new Consulta($registro['id'],$registro['status'],$registro['data_hora'],$medico['medico'],$paciente['paciente'],$clinica['clinica']);
            array_push($consultas,$consulta);
        }
        return $consultas;
    }

    public function alterar():Bool{       
       $sql = "UPDATE consulta
                  SET status = :status, 
                      data_hora = :data_hora,
                      medico = :medico,
                      paciente = :paciente,
                      clinica = :clinica
                WHERE id = :id";
         $parametros = array(':id'=>$this->getid(),
                        ':status'=>$this->getStatus(),
                        ':data_hora'=>$this->getDataHora(),
                        ':medico'=>$this->getMedico(),
                        ':paciente'=>$this->getPaciente(),
                        ':clinica'=>$this->getClinica());
        return Database::executar($sql, $parametros) == true;
    }

    public function excluir():Bool{
        $sql = "DELETE FROM consulta
                      WHERE id = :id";
        $parametros = array(':id'=>$this->getid());
        return Database::executar($sql, $parametros) == true;
     }
}

?>