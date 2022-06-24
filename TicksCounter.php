<?php
namespace core\utils;
class TickCounter{
	private $currentCounter = 0;
	private $maxCounter = 100;
	public function __construct(int $maxCounter){
		$this->maxCounter = $maxCounter;
	}
	public function isTicksExpired($tickDiff = 1): bool{
		if($this->currentCounter >= $this->maxCounter){
			$this->currentCounter = 0;
			return true;
		}
		$this->currentCounter += $tickDiff;
		return false;
	}
	public function setMaxCounter($maxCounter){
		$this->maxCounter = $maxCounter;
	}
	public function setCurrentCounter(int $currentCounter){
		$this->currentCounter = $currentCounter;
	}
	public function getCurrentCounter(): int{
		return $this->currentCounter;
	}
	public function getMaxCounter(): int{
		return $this->maxCounter;
	}
}