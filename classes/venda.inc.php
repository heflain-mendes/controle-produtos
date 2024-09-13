<?php
require_once "item.inc.php";
final class Venda
{
    private int $id;
    private int $data;
    private array $itens = [];
    
    public function __construct(
        private int $idContratante,
        private float $valor,
        private string $formaPagamento
    ) {
        $this->data = strtotime("now");
    }

    public function __get ($name){ 
        return $this->$name;
    }

    public function __set($name, $value){
        $this->$name = $value;
    }

    public function addItem(Item $item){
        $this->itens[] = $item;
    }
}
?>