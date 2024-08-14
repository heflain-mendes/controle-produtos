<?php
final class Tipo
{
    private int $id;
    private string $nome;
    private float $valor;

    public function __get ($name){
        return $this->$name;
    }

    public function __set($name, $value) : self{
        $this->$name = $value;
        return $this;
    }

}
?>