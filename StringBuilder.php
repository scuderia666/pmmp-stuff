<?php
namespace core\utils;
class StringBuilder{
    public $string = "";
    public function add($str, bool $reset = false): void{
        $this->string .= ($reset ? "§r" : "") . strval($str);
    }
    public function newLine(): void{
        $this->add("\n");
    }
    public function space(): void{
        $this->add(" ");
    }
    public function get(): string{
        return $this->string;
    }
}