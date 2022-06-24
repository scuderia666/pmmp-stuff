<?php
namespace core\utils;
use pocketmine\player\Player;
use pocketmine\entity\Human;
use pocketmine\entity\Skin;
class SkinManager{
    public $skins = [];
    private static $instance = null;
    public function __construct(){
        self::$instance = $this;
    }
    public static function getInstance(): self{
        return self::$instance;
    }
    public function getSkin(string $name): ?Skin{
        $skin = null;
        if(file_exists(Server::getInstance()->getDataPath()."models".DIRECTORY_SEPARATOR.$name.".png"))
            $skin = new Skin("Standard_CustomSlim", $this->create(Server::getInstance()->getDataPath()."models".DIRECTORY_SEPARATOR.$name.".png"), "", "geometry.".$name, file_get_contents(Server::getInstance()->getDataPath()."models".DIRECTORY_SEPARATOR.$name.".json"));
        else
            $skin = new Skin("Standard_CustomSlim", $this->create(Server::getInstance()->getDataPath()."skins".DIRECTORY_SEPARATOR.$name.".png"));
        return $skin;
    }
    public function setSkin(Human $p, string $name): void{
        if(!isset($this->skins[$p->getName()]))
            $this->skins[$p->getName()] = $p->getSkin();
        $p->setSkin($this->getSkin($name));
        $p->sendSkin();
    }
    public function setCape(Human $p, string $name): void{
        $skin = $p->getSkin();
        $skinWithCape = new Skin($skin->getSkinId(), $skin->getSkinData(), $this->create(Server::getInstance()->getDataPath()."capes".DIRECTORY_SEPARATOR.$name.".png"), $skin->getGeometryName(), $skin->getGeometryData());
        if(!isset($this->skins[$p->getName()]))
            $this->skins[$p->getName()] = $skin;
        $p->setSkin($skinWithCape);
        $p->sendSkin();
    }
    public function clearCape(Human $p): void{
        if(!isset($this->skins[$p->getName()]))
            return;
        $p->setSkin($this->skins[$p->getName()]);
        $p->sendSkin();
    }
    public function create(string $path){
        $img = @imagecreatefrompng($path);
        $bytes = '';
        $l = (int)@getimagesize($path)[1];
        for($y = 0; $y < $l; $y++){
            for($x = 0; $x < 64; $x++){
                $rgba = @imagecolorat($img, $x, $y);
                $a = ((~((int)($rgba >> 24))) << 1) & 0xff;
                $r = ($rgba >> 16) & 0xff;
                $g = ($rgba >> 8) & 0xff;
                $b = $rgba & 0xff;
                $bytes .= chr($r) . chr($g) . chr($b) . chr($a);
            }
        }
        @imagedestroy($img);
        return $bytes;
    }
}