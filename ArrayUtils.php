<?php
namespace core\utils;
class ArrayUtils{
    public static function removeFromArray($element, array $array): array{
        foreach($array as $key => $e){
            if($e == $element)
                unset($array[$key]);
        }
        return $array;
    }
}