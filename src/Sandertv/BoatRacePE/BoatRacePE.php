<?php
namespace Sandertv\BoatRacePE;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as Color;
use pocketmine\utils\Config;
use pocketmine\event\Listener;
use pocketmine\event\entity\{EntityDamageEvent, EntityDamageByEntityEvent};
use pocketmine\event\player\{PlayerDeathEvent, PlayerInteractEvent};
use pocketmine\math\Vector3;
use pocketmine\level\Position;
use pocketmine\command\{Command, CommandSender};
use pocketmine\Player;
use pocketmine\block\Block;
use pocketmine\item\Item;
use pocketmine\block\{WallSign, PostSign};
use pocketmine\scheduler\ServerScheduler;


class BoatRacePE extends PluginBase implements Listener
{

  // Colors
  public $reds = [];
  public $blues = [];
  public $gameStarted = false;
  public $yml;
  
  public function onEnable()
{
    // Initializing config files
    $this->saveResource("config.yml");
    $yml = new Config($this->getDataFolder() . "config.yml", Config::YAML);
    $this->yml = $yml->getAll();
    $this->getLogger()->debug("Config files have been saved!");
        
   $level = $this->yml["sign_world"];
    
  if(!$this->getServer()->isLevelGenerated($level)){
    $this->getLogger()->error("The level you used on the config ( " . $level . " ) doesn't exist! stopping plugin...");
    $this->getServer()->getPluginManager()->disablePlugin($this->getServer()->getPluginManager()->getPlugin("BoatRacePE"));
    }
}
