<?php
require_once "../utils/funcoesUteis.php";

final class Cliente 
{
    private int $codCli;
    private string $nome;
    private string $endereco;
    private string $telefone;
    private string $CPF;
    private int $dtNascimeto;
    private string $email;
    private string $senha;

    function __get($name) {
        return $this->$name;
    }

    function __set($name, $value) {
        $this->$name = $value;
        return $this;
    }

    function getDtNascimento() : string {
        return parseTimestamp($this->dtNascimeto);
    }

    function setDtNascimento(string $value) : self {
        $this->dtNascimeto = strtotime($value);
        return $this;
    }
}
?>