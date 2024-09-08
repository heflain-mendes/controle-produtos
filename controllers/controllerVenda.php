<?php
require_once '../classes/model/venda.php';
require_once '../dao/vendaDAO.inc.php';
require_once '../utils/funcoesUteis.php';
require_once '../dao/dataDisponivelDAO.inc.php';
require_once '../classes/model/dataDisponivel.php';
require_once '../classes/model/usuario.php';
require_once '../classes/model/item.php';


$opcao = 0;

if(isset($_REQUEST["opcao"]) && is_numeric($_REQUEST["opcao"])){
    $opcao = (int)$_REQUEST["opcao"];
}

$vendaDAO = new VendaDAO();
$datasDAO = new DataDisponivelDAO();

switch ($opcao) {
    case 1: //insert
        session_start();
        $venda = new Venda(
            $_SESSION["usuario"]->id,
            $_SESSION["soma"],
            $_REQUEST["pag"]
        );

        $id_venda = $vendaDAO->insert($venda);

        foreach ($_SESSION["carrinho"] as $item) {
            foreach ($item->getDatas() as $data) {
                $datasDAO->vendaEfetuada($data->id, $id_venda);
            }
        }

        $_SESSION["carrinho"] = [];

        $_SESSION["sucessos"][] = "Compra realizada com sucesso!";
        header("Location: ../views/exibirCarrinho.php");
        break;
    case 2:
        session_start();

        if(isset($_SESSION["usuario"])){
            header("Location: ../views/dadosCompra.php");
        }else{
            header("Location: ../views/formUsuarioLogin.php?em_compra=1");
        }
        break;
}

?>