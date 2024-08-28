<?php
include_once 'includes/cabecalho.inc.php';
?>
<h1 class="text-center">Show room de produtos</h1>
<p>

<div class="row row-cols-1 row-cols-md-5 g-4">

  <?php
  //percurso inicia aqui  
  ?>

  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">TIPO</h5>
        <p class="card-text">DESCRIÇÃO</p>
        <h6 class="card-text">Prestador: PRESTADOR</h6>
        <h6 class="card-text text-end">CIDADE</h6>
        <h4 class="card-title">R$ 000,00</h4>

        <!-- Datas para seleção com lista suspensa -->
        <p class="card-text"><strong>Datas Disponíveis:</strong></p>
        <div class="dropdown">
          <button class="btn w-100 btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            Selecionar Datas
          </button>
          <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
            <li>
              <div class="form-check px-3">
                <input class="form-check-input" type="checkbox" value="" id="date1">
                <label class="form-check-label" for="date1">
                  01/09/2024
                </label>
              </div>
            </li>
            <li>
              <div class="form-check px-3">
                <input class="form-check-input" type="checkbox" value="" id="date2">
                <label class="form-check-label" for="date2">
                  02/09/2024
                </label>
              </div>
            </li>
            <li>
              <div class="form-check px-3">
                <input class="form-check-input" type="checkbox" value="" id="date3">
                <label class="form-check-label" for="date3">
                  03/09/2024
                </label>
              </div>
            </li>
            <!-- Adicione mais datas conforme necessário -->
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
  // percurso termina aqui
  ?>
</div>

<?php require_once "includes/rodape.inc.php" ?>