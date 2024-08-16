<?php
final class DataDisponivel {
    private int $id;
    
    public function __construct(
        private int $idServico,
        private int $data,
        private bool $disponivel,
    ) { }

    public function __set($name, $value){
        $this->$name = $value;
    }
    
    public function __get($name){
        return $this->$name;
    }

    public function getData() : string {
        return $this->data;
    }

    public function setData(string $value) {
        $this->data = strtotime($value);
    }
}
?>