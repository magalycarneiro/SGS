<?php
class Exame {
    private $tipo;
    private $data;
    private $resultado;

    public function __construct($tipo, $data, $resultado) {
        $this->tipo = $tipo;
        $this->data = $data;
        $this->resultado = $resultado;
    }

    public static function listarTodos() {
        return [
            new Exame('Hemograma', '2025-06-25', 'Normal'),
            new Exame('Raio-X Tórax', '2025-06-20', 'Sem alterações')
        ];
    }

    public function getInfo() {
        return "{$this->data} - {$this->tipo}: {$this->resultado}";
    }
}
