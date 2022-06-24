<?php
namespace core\utils;
class Utils {
    public static function formatTime(int $s): string{
        if($s == 0)
            return "";
        $sb = new StringBuilder();
        $hours = floor($s / 3600);
        $mins = floor(($s / 60) % 60);
        $secs = $s % 60;
        if($hours > 0)
            $sb->add($hours." hours");
        if($mins > 0){
            if($hours > 0)
                $sb->space();
            $sb->add($mins." minutes");
        }
        if($secs > 0){
            if($mins > 0)
                $sb->space();
            $sb->add($secs." seconds");
        }
        return $sb->get();
    }
    public static function formatTimeShort(int $s): string{
        if($s == 0)
            return "";
        $sb = new StringBuilder();
        $hours = floor($s / 3600);
        $mins = floor(($s / 60) % 60);
        $secs = $s % 60;
        if($hours > 0){
            if($hours < 10)
                $sb->add("0");
            $sb->add($hours.":");
        }
        if($mins < 10)
            $sb->add("0");
        $sb->add($mins.":");
        if($secs < 10)
            $sb->add("0");
        $sb->add($secs);
        return $sb->get();
    }
    public static function format(string $text): string{
        return str_replace("{line}", "\n§r", str_replace("&", "§", $text));
    }
    public static function placeholders(string $msg, ...$args): string{
        for($i = 0; $i < count($args); ++$i){
            $msg = str_replace("%".($i+1), $args[$i], $msg);
        }
        return self::format($msg);
    }
}