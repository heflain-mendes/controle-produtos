<?php
require_once "../classes/model/tipo.php";
require_once "includes/cabecalho.inc.php";

$tipos = $_SESSION["tipos"];
?>
<p>
<h1 class="text-center">Inclusão de serviço</h1>
<p>

<form class="row g-3" action="../controllers/controllerServico.php" method="post">
  <div class="col-md-6">
    <label for="nome" class="form-label">Nome: </label>
    <input type="text" class="form-control" name="nome">
  </div>
  <div class="col-md-3">
    <label for="valor" class="form-label">Valor: </label>
    <input type="number" class="form-control" name="valor">
  </div>
  <div class="col-md-3">
    <label for="tipo" class="form-label">Tipo: </label>
    <select name="tipo" class="form-select">
      <option selected value="0">Escolha...</option>
      <?php
      foreach ($tipos as $t) {
        echo "<option value=$t->id>$t->nome</option>";
      }
      ?>
    </select>
  </div>
  <div class="col-12">
    <label for="descricao" class="form-label">Descrição do serviço: </label>
    <textarea class="form-control" name="descricao" rows="6" style="resize: none"></textarea>
  </div>

  <div class="col-md-8 col-lg-6" id="datas">
    <div class="d-flex">
      <label for="dates" class="form-label me-auto">Datas: </label>
      <button type="button" onclick="addDate()" class="mb-2 btn btn-primary mx-1" style="min-width: 100px;">Adicionar</button>
    </div>
    <div class="d-flex" id="data0">
      <input type="datetime-local" name="datas[]" class="form-control mb-2">
      <button type="button" onclick="removeDate(0)" class="mb-2 btn btn-outline-danger mx-1" style="min-width: 100px;">Remover</button>
    </div>
  </div>

  <input type="hidden" name="opcao" value="2">

  <div class="col-12">
    <button type="submit" class="btn btn-primary">Incluir</button>
    <button type="reset" class="btn btn-danger">Cancelar</button>
  </div>
</form>

<script>
  var inputAppend = `
    <div class="d-flex" id="data$">
      <input type="datetime-local" name="datas[]" class="form-control mb-2">
      <button type="button" onclick="removeDate($)" class="mb-2 btn btn-outline-danger mx-1" style="min-width: 100px;">Remover</button>
    </div>
  `;

  const divDateInput = document.querySelector("#datas");

  function addDate() {
    const lenghtDateInput = divDateInput.querySelectorAll("input").length;
    if (lenghtDateInput < 5) {
      divDateInput.insertAdjacentHTML("beforeend", inputAppend.replaceAll('$', lenghtDateInput));
    }
  }

  function removeDate(index) {
    divDateInput.querySelector("#data" + index).remove();

    divDateInput.querySelectorAll("div:has(input)").forEach((item, index) => {
      item.id = "data" + index;
      item.querySelector("button").setAttribute("onclick", `removeDate(${index})`);
    })
  }
</script>

<?php
require_once 'includes/rodape.inc.php';
?>