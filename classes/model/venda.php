<?php
final class Venda
{
    private int $codVenda;
    private int $codCliente;
    private float $valorTotal;
    private int $qtdItens;

    public function __get ($name){
        return $this->$name;
    }

    public function __set($name, $value) : self{
        $this->$name = $value;
        return $this;
    }
}
?>