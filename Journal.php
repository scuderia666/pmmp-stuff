<?php
namespace core\utils;
class Journal {
	private static $data = [];
	public static function clear(): void{
		self::$data = [];
		self::send("journal is clean now.");
	}
	public static function send(string $stuff): void{
		$date = date('M-d H:i:s');
		self::$data[] = $date." >> ".$stuff;
	}
	public static function getEntryCount(): int{
		return count(self::$data);
	}
	public static function get(int $page, int $entryCount = 10): array{
		$arr = [];
		$a = count(self::$data);
		--$entryCount;
		if($page != 1)
			$a = $a-(($page-1)*$entryCount);
		for($i = 0; $i <= $entryCount; ++$i){
			$index = $a-$i-$page;
			if(isset(self::$data[$index]))
				$arr[] = self::$data[$index];
		}
		return $arr;
	}
}