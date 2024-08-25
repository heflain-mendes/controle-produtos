<?php
require_once "../dao/servicoDAO.inc.php";
require_once "../dao/dataDisponivelDAO.inc.php";

$opcao = 0;

if(isset($_REQUEST["opcao"]) && is_numeric($_REQUEST["opcao"])){
    $opcao = (int)$_REQUEST["opcao"];
}

$servicoDAO = new ServicoDAO();
$datasDAO = new DataDisponivelDAO();
switch ($opcao) {
    case 1: //get all
        $servicos = $servicoDAO->getAll();
        
        
        break;
    case 2: //insert
        $servico = new Servico(
            $_REQUEST["nome"],
            $_REQUEST["valor"],
            $_REQUEST["descricao"],
            $_REQUEST["tipo"]
        );

        $idServico = $servicoDAO->insert(
           $servico
        );

        foreach($_REQUEST["datas"] as $data) {
            $data = new DataDisponivel($idServico, $data, true);
            $datasDAO->insert($data);
        }

        header("Location: ../views/exibirServicos.php");
        break;
    default:
        # code...
        break;
}
?>