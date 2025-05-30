<?php
include_once(__DIR__ . '/../../config/config.inc.php');
include_once(__DIR__ . '/../Classes/Prontuario.class.php');

    $busca = isset($_GET['busca']) ? $_GET['busca'] : "";
    $tipo = isset($_GET['tipo']) ? $_GET['tipo'] : 0;
   
    $lista = Prontuario::listar($tipo, $busca);
    $itens = '';
    
    foreach($lista as $prontuario) {
        $item = file_get_contents('itens_listagem_prontuario.html');
        $item = str_replace('{idPRONTUARIO}', $prontuario->getIdPRONTUARIO(), $item);
        $item = str_replace('{nomepaciente}', htmlspecialchars($prontuario->getNomepaciente()), $item);
        $item = str_replace('{prescricao}', htmlspecialchars($prontuario->getPrescricao()), $item);
        $item = str_replace('{observacoes}', htmlspecialchars($prontuario->getObservacoes()), $item);
        $item = str_replace('{diagnostico}', htmlspecialchars($prontuario->getDiagnostico()), $item);
        $item = str_replace('{atestado}', htmlspecialchars($prontuario->getAtestado()), $item);
        $item = str_replace('{antecedentes}', htmlspecialchars($prontuario->getAntecedentes()), $item);
        $item = str_replace('{encaminhamento}', htmlspecialchars($prontuario->getEncaminhamento()), $item);
        $item = str_replace('{solicitacaoexames}', htmlspecialchars($prontuario->getSolicitacaoexames()), $item);
        $item = str_replace('{exames}', htmlspecialchars($prontuario->getExames()), $item);
        $itens .= $item;
    }
    
    $listagem = file_get_contents('listagem_prontuario.html');
    $listagem = str_replace('{itens}', $itens, $listagem);
    print($listagem);
?>