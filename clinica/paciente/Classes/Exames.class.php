<?php
class Exame {
    private $tipo;
    private $data;

    public function __construct($tipo, $data) {
        $this->tipo = $tipo;
        $this->data = $data;
    }

    public static function listarTodos() {
        return [
            new Exame('Hemograma', '2025-06-25'),
            new Exame('Raio-X Tórax', '2025-06-20')
        ];
    }

    public function getInfo() {
        return "{$this->data} - {$this->tipo}";
    }
}
