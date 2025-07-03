<?php
require_once('../Classes/Agendamento.class.php');

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    if (Agendamento::excluir($id)) {
        header("Location: index.php?excluido=1");
        exit();
    } else {
        echo "Erro ao excluir o agendamento.";
    }
} else {
    echo "ID do agendamento não informado.";
}
