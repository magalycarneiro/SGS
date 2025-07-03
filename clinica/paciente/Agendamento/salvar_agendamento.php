<?php
require_once('../Classes/Agendamento.class.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $medico = $_POST['medico'];
    $data = $_POST['data'];
    $hora = $_POST['horario'];
    $especialidade = $_POST['especialidade'];

    Agendamento::salvar($medico, $data, $hora, $especialidade);

    header("Location: index.php?sucesso=1");
    exit();
}

?>
