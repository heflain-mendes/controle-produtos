<?php
final class Venda
{
    private int $id;
    private int $idCliente;
    private int $idServico;
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