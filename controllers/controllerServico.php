<?php
require_once "../classes/model/usuario.php";
require_once "../dao/servicoDAO.inc.php";
require_once "../dao/dataDisponivelDAO.inc.php";
require_once "../dao/tipoDAO.inc.php";

$opcao = 0;

if(isset($_REQUEST["opcao"]) && is_numeric($_REQUEST["opcao"])){
    $opcao = (int)$_REQUEST["opcao"];
}

$servicoDAO = new ServicoDAO();
$datasDAO = new DataDisponivelDAO();
$tipoDAO = new TipoDAO();

switch ($opcao) {
    case 1: //get all
        session_start();
        $idUsuario = $_SESSION["usuario"]->id;
        $servicos = $servicoDAO->getByIdUsuario($idUsuario);
        
        foreach($servicos as $servico) {
            $servico->tipo = $tipoDAO->getById($servico->idTipo);
            $datasDisponiveis = $datasDAO->findByIdServico($servico->id);
            foreach ($datasDisponiveis as $d) {
                if(!$d->disponivel && $d->data > strtotime('today')) {
                    $servico->possuiServicoAFazer = true;
                    continue;
                }
            }
        }   

        $_SESSION["servicos"] = $servicos;

        header("Location: ../views/exibirServicos.php");
        break;
    case 2: //insert
        session_start();
        $servico = new Servico(
            $_REQUEST["nome"],
            $_REQUEST["valor"],
            $_REQUEST["cidade"],
            $_REQUEST["descricao"],
            $_REQUEST["tipo"],
            $_SESSION["usuario"]->id
        );

        $idServico = $servicoDAO->insert(
           $servico
        );

        foreach($_REQUEST["datas"] as $data) {
            $data = new DataDisponivel($idServico, strtotime($data), true);
            $datasDAO->insert($data);
        }

        header("Location: controllerServico.php?opcao=1");
        break;
    case 3: //atualizar
        session_start();
        $servico = $servicoDAO->getById($_REQUEST["id"]);
        $servico->tipo = $tipoDAO->getById($servico->idTipo);
        $datasDisponiveis = $datasDAO->findByIdServico($servico->id);
        $servico->datasDisponiveis = $datasDisponiveis ?? [];

        $_SESSION["servico"] = $servico;

        header("Location: controllerTipo.php?opcao=2");
    default:
        # code...
        break;
}
?>