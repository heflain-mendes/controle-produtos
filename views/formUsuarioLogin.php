<?php require_once "includes/cabecalho.inc.php" ?>

<!-- CONTEUDO -->
<h1 class="text-center">Login de Usuário</h1>

<div class="row">
    <div class="col-lg-10 col-xl-9 mx-auto">
        <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
            <div class="card-img-left d-none d-md-flex">
                <!-- Background image for card set in CSS! -->
            </div>
            <div class="card-body p-4 p-sm-5">
                <h5 class="card-title text-center mb-5 fw-light fs-5">Entre com suas informações de Login</h5>
                <form onsubmit="return validarSubmit()" action="../controllers/controllerUsuario.php" method="get">

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInputEmail" minlength="8" maxlength="50"
                         placeholder="nome@exemplo.com" name="email" required>
                        <label for="floatingInputEmail">Endereço de Email</label>
                    </div>

                    <hr>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingPassword" minlength="4" maxlength="8"
                         placeholder="Senha" name="senha" required>
                        <label for="floatingPassword">Senha</label>
                    </div>

                    <div class="d-grid mb-2">
                        <button class="btn btn-lg btn-primary btn-login fw-bold text-uppercase" type="submit">Efetuar Login</button>
                    </div>

                    <?php
                    if (isset($_REQUEST["erro"])) {
                        $msg = "";
                        $alert = "";
                        switch ($_REQUEST["erro"]) {
                            case 0:
                                $msg = "Usuário cadastrado com sucesso";
                                $alert = "alert-success";
                                break;
                            case 1:
                                $msg = "Usuário não encontrado";
                                $alert = "alert-danger";
                                break;
                            case 2:
                                $msg = "Erro ao fazer o login";
                                $alert = "alert-danger";
                                break;
                        }

                        echo
                        '<div class="alert ' . $alert . '" role="alert">'
                            . $msg .
                            '</div>';
                    }
                    ?>

                    <a class="d-block text-center mt-2 small" href="formUsuario.php">Não possui uma conta? Cadastre-se aqui</a>

                    <input type="hidden" value="1" name="opcao">
                </form>
            </div>
        </div>
    </div>
</div>

<script src="includes/scripts/validacoes.js"></script>

<!-- Rodape -->

<?php require_once "includes/rodape.inc.php" ?>