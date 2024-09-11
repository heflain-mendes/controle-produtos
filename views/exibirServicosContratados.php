<?php
require_once '../classes/model/item.php';
require_once '../classes/model/servico.php';
require_once '../classes/model/dataDisponivel.php';
require_once '../utils/funcoesUteis.php';
require_once 'includes/cabecalho.inc.php';


$servicos = [];

if(isset($_SESSION["servicos"])){
    $servicos = $_SESSION["servicos"];
}

?>

<h1 class="text-center">Servicos contratados</h1>
<?php include_once "includes/mensagens.inc.php" ?>
<p>
<div class="table-responsive">
    <table class="table table-ligth table-striped">
        <thead class="table-danger">
            <tr class="align-middle" style="text-align: center">
                <th witdh="10%">Nº</th>
                <th>Nome</th>
                <th>Prestador</th>
                <th>Cidade</th>
                <th>Data</th>
                <th>Valor</th>
                <th>Pagamento</th>
                <th>Serviço</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
            $contador = 0;
            foreach ($servicos as $servico) {
                foreach ($servico->datasDisponiveis as $data) {
                $contador++;
            ?>
            <tr class="align-middle" style="text-align: center">
                <td><?= $contador ?></td>
                <td><?= $servico->nome ?></td>
                <td><?= $servico->nomePrestador ?></td>
                <td><?= $servico->cidade ?></td>
                <td><?= formatarData($data->data) ?></td>
                <td>R$ <?= number_format($servico->valor, 2, ",", ".") ?></td>
                <td><?= $servico->formaPagamento ?></td>
                <?php
                if($data->prestado){
                    echo "<td>serviço prestado</td>";
                }else{
                    echo "<td><a href='../controllers/controllerServico.php?opcao=11&id=". $data->id . "' class='btn btn-success btn-sm'>Prestado?</a></td>";
                }
                ?>
            </tr>

            <?php }} ?>
    </table>

    <?php
    require_once 'includes/rodape.inc.php';
    ?>