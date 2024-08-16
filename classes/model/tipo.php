<?php
final class Tipo
{
    private int $id;
   
    public function __construct(
        private string $nome
    ) {}

    public function __get ($name){
        return $this->$name;
    }

    public function __set($name, $value){
        $this->$name = $value;
    }
}
?>