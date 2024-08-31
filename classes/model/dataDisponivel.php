<?php
final class DataDisponivel {
    private int $id;
    
    public function __construct(
        private int $idServico,
        private int $data,
        private bool $disponivel = true,
    ) { }

    public function __set($name, $value){
        $this->$name = $value;
    }
    
    public function __get($name){
        return $this->$name;
    }

    public function setData(string $value) {
        $this->data = strtotime($value);
    }
}
?>