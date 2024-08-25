<?php
require_once "dataDisponivel.php";
require_once "tipo.php";

final class Servico 
{
    private int $id;
    private Tipo $tipo;
    private $datasDisponiveis;
    
    public function __construct(
        private string $nome,
        private float $valor,
        private string $descricao,
        private int $idTipo
    ) {}

    public function __get ($name){
        return $this->$name;
    }

    public function __set($name, $value){
        $this->$name = $value;
    }
}
?>