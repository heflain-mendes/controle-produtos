<?php 
require_once "../classes/model/usuario.php";
session_start();

if(isset($_SESSION["usuario"]) && $_SESSION["usuario"] instanceof Usuario){
    header("Location: exibirServicos.php");
}else {
    header("Location: formUsuarioLogin.php");
}

 ?>