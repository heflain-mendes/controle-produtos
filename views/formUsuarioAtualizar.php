<?php
require_once "includes/cabecalho.inc.php";
require_once "../utils/funcoesUteis.php";

$usuario = $_SESSION["usuario"];
?>

<!-- CONTEUDO -->
<h1 class="text-center">Informações do Usuário</h1>

<div class="row">
    <div class="col-lg-10 col-xl-9 mx-auto">
        <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
            <div class="card-img-left d-none d-md-flex">
                <!-- Background image for card set in CSS! -->
            </div>
            <div class="card-body p-4 p-sm-5">
                <h5 class="card-title text-center mb-5 fw-light fs-5">Veja suas informações de Cadastro</h5>
                <form onsubmit="return validarSubmit()" action="../controllers/controllerUsuario.php" method="get">

                    <div class="form-floating mb-3">

                        <input type="text" class="form-control" minlength="3" maxlength="50" id="floatingInputNome"
                            placeholder="José" name="nome" value="<?= $usuario->nome ?>">
                        <label for="floatingInputNome">Nome</label>
                    </div>

                    <hr>

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInputEmail" minlength="8" maxlength="50"
                            placeholder="nome@exemplo.com" name="email" value="<?= $usuario->email ?>">
                        <label for="floatingInputEmail">Email</label>
                    </div>

                    <hr>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInputEndereco" minlength="5" maxlength="50"
                            placeholder="rua, avenida, rodovia + nº" name="endereco" value="<?= $usuario->endereco ?>">
                        <label for="floatingInputEndereco">Endereço</label>
                    </div>

                    <hr>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInputTel" minlength="10" maxlength="20"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '');" placeholder="XXXXXXXXXXX" name="telefone"
                            value="<?= $usuario->telefone ?>">
                        <label for="floatingInputTel">Telefone</label>
                    </div>

                    <hr>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInputCPF" minlength="13" maxlength="13"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '');" placeholder="XXXXXXXXXXX" name="cpf"
                            value="<?= $usuario->cpf ?>">
                        <label for="floatingInputCPF">CPF</label>
                    </div>

                    <hr>

                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="floatingInputDtNasc" name="dt_nascimento" onblur="validarDataNascimento()"
                            value="<?= parseISO($usuario->dtNascimento) ?>">
                        <label for="floatingInputDtNasc">Data Nascimento</label>
                    </div>

                    <div id="erroDtNasc" class="alert alert-danger" role="alert" style="display: none;">
                        O usuário deve ter mais de 18 anos
                    </div>

                    <hr>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="floatingIsAdmin" name="tipo" <?= $usuario->tipo == "U" ? "checked" : "" ?>>
                        <label class="form-check-label" for="floatingIsAdmin">É Administrador</label>
                    </div>

                    <div class="d-grid mb-2">
                        <button class="btn btn-lg btn-primary btn-login fw-bold text-uppercase" type="submit">atualizar Cadastro</button>
                    </div>

                    <div class="d-grid mb-2">
                        <a href="../controllers/controllerUsuario.php?opcao=7&id=<?=$usuario->id?>" class="btn btn-lg btn-danger btn-login fw-bold text-uppercase">Remover conta</a>
                    </div>

                    <?php
                    if (isset($_REQUEST["erro"])) {
                        $msg = "";
                        $alert = "alert-danger";
                        switch ($_REQUEST["erro"]) {
                            case 0:
                                $msg = "usuário atualizado com sucesso";
                                $alert = "alert-success";
                                break;
                            case 1:
                                $msg = "Erro ao atualizar usuário";
                                break;
                            case 2:
                                $msg = "Erro ao excluir usuário";
                                break;
                        }

                        echo
                        '<div class="alert ' . $alert . '" role="alert">'
                            . $msg .
                            '</div>';
                    }
                    ?>

                    <input type="hidden" value="5" name="opcao">
                    <input type="hidden" value="<?= $usuario->id ?>" name="id">
                </form>
            </div>
        </div>
    </div>
</div>

<script src="includes/scripts/validacoes.js"></script>

<!-- Rodape -->

<?php require_once "includes/rodape.inc.php" ?>