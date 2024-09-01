<?php
include_once '../utils/funcoesUteis.php';
include_once '../classes/model/servico.php';
include_once '../classes/model/tipo.php';
include_once '../classes/model/dataDisponivel.php';
include_once 'includes/cabecalho.inc.php';

$servicos = $_SESSION["servicos"];

$tamanhoMaxDescricao = 50;
?>
<h1 class="text-center">Serviços Disponíveis</h1>
<p>

<div class="row row-cols-1 row-cols-md-5 g-4">

  <?php
  foreach ($servicos as $servico) {
    $c = $tamanhoMaxDescricao - strlen($servico->descricao);
    $c = $c > 0 ? $c : 0;
  ?>

    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><?= $servico->tipo->nome ?></h5>
          <p class="card-text" style="white-space: pre-wrap;"><?=$servico->descricao . str_repeat('&nbsp;', $c)?></p>
          <h6 class="card-text">Prestador: <?=$servico->nomePrestador?></h6>
          <h6 class="card-text text-end"><?= $servico->cidade ?></h6>
          <h4 class="card-title">R$ <?= number_format($servico->valor, 2, ',', '.') ?></h4>

          <!-- Datas para seleção com lista suspensa -->
          <p class="card-text"><strong>Datas Disponíveis:</strong></p>
          <div class="dropdown">
            <button class="btn w-100 btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
              Selecionar Datas
            </button>
            <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
              <?php foreach ($servico->datasDisponiveis as $data) { ?>
                <li>
                  <div class="form-check px-3">
                    <input class="form-check-input" type="checkbox" value="" id="date1">
                    <label class="form-check-label" for="date1">
                      <?= formatarData($data->data) ?>
                    </label>
                  </div>
                </li>
              <?php } ?>
            </ul>
          </div>
              
        <!-- Botão de ação -->
        <div class="text-end mt-3">
          <a href="#" class="btn btn-danger">Comprar</a>
        </div>
        </div>
      </div>
    </div>

  <?php
  }
  ?>
</div>

<?php require_once "includes/rodape.inc.php" ?>