<?php
namespace core\utils;
class CacheManager{
    private static $data = [];
    public static function putData(string $name, string $dataName, $data): void{
        self::$data[$name][$dataName] = $data;
    }
    public static function getData(string $name, string $data){
        if(isset(self::$data[$name][$data]))
            return self::$data[$name][$data];
        return null;
    }
    public static function remove(string $name, string $data): void{
        unset(self::$data[$name][$data]);
    }
    public static function free(): void{
        self::$data = [];
    }
}