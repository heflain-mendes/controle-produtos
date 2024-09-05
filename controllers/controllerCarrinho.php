<?php
require_once "../classes/model/item.php";
require_once "../classes/model/servico.php";


$opcao = (int)$_REQUEST["opcao"];

switch ($opcao) {
    //remover as dadas do serviços que estão no carrinho
    case 1: 
    case 2:
        session_start();

        $carrinho = $_SESSION["carrinho"];
        $servicos = $_SESSION["servicos"];

        foreach ($carrinho as $item) {
            $s = buscarServicoById($servicos, $item->getServico()->id);

            foreach ($item->getDatas() as $data) {
                $s->datasDisponiveis = array_filter($s->datasDisponiveis, function ($d) use ($data) {
                    return $d->id != $data->id;
                });
            }
        }

        $_SESSION["servicos"] = $servicos;

        if($opcao == 1){
            header("Location: ../views/servicosVenda.php");
        }else{
            header("Location: ../views/exibirCarrinho.php");
        }
        break;
    case 3: // adicionar as datas do serviço no carrinho
        session_start();

        $idServico = (int)$_REQUEST["id_servico"];
        $idDatas = $_REQUEST["id_datas"];

        if (!isset($idDatas) || sizeof($idDatas) == 0) {
            header("Location: ../views/exibirCarrinho.php");
            break;
        }

        $carrinho = [];
        if (isset($_SESSION["carrinho"])) {
            $carrinho = $_SESSION["carrinho"];
        }

        $item = buscarServicoNoCarrinhoById($carrinho, $idServico);
        $servicos = $_SESSION["servicos"];

        $servico = null;
        foreach ($servicos as $s) {
            if ($s->id == $idServico) {
                $servico = $s;
                break;
            }
        }

        if ($item == null) {
            $item = new Item($servico);
            foreach ($idDatas as $idData) {
                $item->addData($servico->getData($idData));
            }
            $carrinho[] = $item;
        } else {
            foreach ($idDatas as $idData) {
                $item->addData($servico->getData($idData));
            }
        }

        $_SESSION["carrinho"] = $carrinho;

        header("Location: controllerCarrinho.php?opcao=2");
        break;
}

function buscarServicoNoCarrinhoById($array, $id)
{
    foreach ($array as $item) {
        if ($item->getServico()->id == $id) {
            return $item;
        }
    }
    return null;
}
function buscarServicoById($array, $id)
{
    foreach ($array as $item) {
        if ($item->id == $id) {
            return $item;
        }
    }
    return null;
}
