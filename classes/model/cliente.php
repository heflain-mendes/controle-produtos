<?php
final class Cliente 
{
    private int $id;
    private string $nome;
    private string $endereco;
    private string $telefone;
    private string $cpf;
    private int $dtNascimeto;
    private string $email;
    private string $senha;

    function __get($name) {
        return $this->$name;
    }

    function __set($name, $value) {
        $this->$name = $value;
    }

    function getDtNascimento() : string {
        return $this->dt_nascimento;
    }

    function setDtNascimento(string $value){
        $this->dt_nascimento = strtotime($value);
    }
}
?>