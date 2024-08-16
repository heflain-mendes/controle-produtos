<?php
final class Servico 
{
    private int $id;
    
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