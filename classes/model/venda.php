<?php
final class Venda
{
    private int $id;
    
    public function __construct(
        private int $idUsuario,
        private int $idDatasDisponiveis,
        private float $valorTotal,
        private int $qtdItens
    ) {}

    public function __get ($name){
        return $this->$name;
    }

    public function __set($name, $value){
        $this->$name = $value;
    }
}
?>