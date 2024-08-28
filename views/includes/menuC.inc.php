<?php
  // Menu cliente
  $usuario = $_SESSION["usuario"];
?>

<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
  <a href="index.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
    <img src="imagens/logo2.png">&nbsp;&nbsp;
    <h4> Loja Serviços</h4>
  </a>

  <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">

    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle link-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Serviços
      </a>
      <ul class="dropdown-menu">
        <?= $usuario->tipo == "U" ? "<li><a class=\"dropdown-item\" href=\"../controllers/controllerTipo.php?opcao=1\">Cadastrar</a></li>" : "" ?>
        <li><a class="dropdown-item" href="exibirServicos.php">Consultar</a></li>
      </ul>
    </li>

    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle link-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Usuario
      </a>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="../controllers/controllerUsuario.php?opcao=4">Visualizar cadastro</a></li>
        <li><a class="dropdown-item" href="../views/formUsuarioAtualizarSenha.php">Alterar senha</a></li>
      </ul>
    </li>

    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle link-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Vendas
      </a>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#">Vendas realizadas</a></li>
      </ul>
    </li>

    <li>
      <a class="nav-link px-2 link-dark" href="#">
        <img src="imagens/cart3.png" alt="">
      </a>
    </li>

  </ul>

  <div class="col-md-3 text-end">
    <?php
      include_once "modal.inc.php";
    ?>
  </div>
</header>