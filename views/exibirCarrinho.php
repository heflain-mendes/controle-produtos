<?php
require_once '../classes/model/item.php';
require_once '../classes/model/servico.php';
require_once '../classes/model/dataDisponivel.php';
require_once '../utils/funcoesUteis.php';
require_once 'includes/cabecalho.inc.php';


$carrinho = [];

if(isset($_SESSION["carrinho"])){
    $carrinho = $_SESSION["carrinho"];
}

?>

<h1 class="text-center">Carrinho de compra</h1>
<p>
    <?php
    if(sizeof($carrinho) == 0){
        include_once 'includes/carrinhoVazio.inc.php';
    }else{

    ?>
<div class="table-responsive">
    <table class="table table-ligth table-striped">
        <thead class="table-danger">
            <tr class="align-middle" style="text-align: center">
                <th witdh="10%">Item No</th>
                <th>Descricao</th>
                <th>Prestador</th>
                <th>Cidade</th>
                <th>Data</th>
                <th>Valor</th>
                <th>Remover</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
            $contador = 0;
            $soma = 0;
            foreach ($carrinho as $item) {
                foreach ($item->getDatas() as $data) {
                $contador++;
                $soma += $item->getServico()->valor;
            ?>
            <tr class="align-middle" style="text-align: center">
                <td><?= $contador ?></td>
                <td><?= $item->getServico()->descricao ?></td>
                <td><?= $item->getServico()->nomePrestador ?></td>
                <td><?= $item->getServico()->cidade ?></td>
                <td><?= formatarData($data->data) ?></td>
                <td>R$ <?= number_format($item->getServico()->valor, 2, ",", ".") ?></td>
                <td><a href="#" class='btn btn-danger btn-sm'>X</a></td>
            </tr>

            <?php }} ?>

            <tr align="right">
                <td colspan="8">
                    <font face="Verdana" size="4" color="red"><b>Valor Total = <?=number_format($soma, 2, ",", ".")?></b></font>
                </td>
            </tr>
    </table>
    <div class="container text-center">
        <div class="row">
            <div class="col">
                <a class="btn btn-warning" role="button" href="#"><b>Continuar comprando</b></a>
            </div>
            <div class="col">
                <a class="btn btn-danger" role="button" href="#"><b>Esvaziar carrinho</b></a>
            </div>
            <div class="col">
                <a class="btn btn-success" role="button" href="#"><b>Finalizar compra</b></a>
            </div>
        </div>
    </div>

    <?php
    }
    require_once 'includes/rodape.inc.php';
    ?>