<?php
final class Venda
{
    private int $id;
    
    public function __construct(
        private int $idContratante,
        private float $valor,
        private string $formaPagamento
    ) {}

    public function __get ($name){ 
        return $this->$name;
    }

    public function __set($name, $value){
        $this->$name = $value;
    }
}
?>