<?php
class Configuracao {
    private $notificacoes;
    private $tema;

    public function __construct($notificacoes = true, $tema = 'Claro') {
        $this->notificacoes = $notificacoes;
        $this->tema = $tema;
    }

    public function salvarPreferencias($notificacoes, $tema) {
        $this->notificacoes = $notificacoes;
        $this->tema = $tema;
    }

    public function getPreferencias() {
        return [
            'notificacoes' => $this->notificacoes,
            'tema' => $this->tema
        ];
    }
}
