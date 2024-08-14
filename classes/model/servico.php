<?php
final class Servico 
{
    private int $id;
    private string $nome;
    private float $valor;
    private string $descricao;
    private int $idTipo;
    private Tipo $tipo;
    private $datas;

    public function __get ($name){
        return $this->$name;
    }

    public function __set($name, $value) : self{
        $this->$name = $value;
        return $this;
    }
}
?>