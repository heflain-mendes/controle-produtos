<?php
final class Usuario 
{
    private int $id;
    private bool $possuiServicosFuturosAPrestar;
    private bool $possuiServicosFuturosContratados;

    public function __construct(
        private string $nome,
        private string $endereco,
        private string $telefone,
        private string $cpf,
        private int $dtNascimento,
        private string $email,
        private string $senha,
        private string $tipo
    ) {}

    function __get($name) {
        return $this->$name;
    }

    function __set($name, $value) {
        $this->$name = $value;
    }

    function setDtNascimento(string $value){
        $this->dt_nascimento = strtotime($value);
    }
}
?>