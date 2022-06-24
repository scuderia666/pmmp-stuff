<?php
namespace core\utils;
use pocketmine\player\Player;
class Setting{
    private $delay;
    private $value = 0;
    public function __construct(int $delay){
        $this->delay = $delay;
    }
    public function getValue(): int{
        return $this->value;
    }
    public function start(): void{
        $this->value = $this->delay;
    }
    public function update(): void{
        if($this->value > 0)
            --$this->value;
    }
}
class CooldownManager{
    public $settings = [];
    public $data = [];
    public function newEntry(string $name, int $delay){
        $this->settings[$name] = new Setting($delay);
    }
    public function createPlayerData(Player $p): void{
        $n = $p->getName();
        $this->data[$n] = [];
        foreach($this->settings as $name => $s){
            $this->data[$n][$name] = $s;
        }
    }
    public function reset(): void{
        $this->data = [];
    }
    public function get(string $name, Player $p): int{
        return $this->data[$p->getName()][$name]->getValue();
    }
    public function start(string $name, Player $p){
        $this->data[$p->getName()][$name]->start();
    }
    public function check(string $name, Player $p): bool{
        return $this->data[$p->getName()][$name]->getValue() == 0;
    }
    public function tick(): void{
        foreach(array_keys($this->data) as $p){
            foreach($this->data[$p] as $d){
                $d->update();
            }
        }
    }
}