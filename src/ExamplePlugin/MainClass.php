<?php

declare(strict_types=1);

namespace ExamplePlugin;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityLevelChangeEvent;
use pocketmine\event\entity\EntityTeleportEvent;
use pocketmine\event\player\PlayerBedEnterEvent;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerCommandPreprocessEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerPreLoginEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\lang\TextContainer;
use pocketmine\Player;

class MainClass extends PluginBase{

	public function onLoad() : void{
		$this->getLogger()->info(TextFormat::WHITE . "Mod caricata!");
	}

	public function onEnable() : void{
		$this->getServer()->getPluginManager()->registerEvents(new ExampleListener($this), $this);
		$this->getScheduler()->scheduleRepeatingTask(new BroadcastTask($this->getServer()), 120);
		$this->getLogger()->info(TextFormat::DARK_GREEN . "Mod abilitata!");
	}

	public function onDisable() : void{
		$this->getLogger()->info(TextFormat::DARK_RED . "Mod disabilitata!");
	}

	public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
		switch($command->getName()){
			case "saluta":
				$sender->sendMessage($sender->getName() . "é un coglione");

				return true;
			default:
				return false;
		}
	}
     	/**
     	* @param PlayerJoinEvent $event
     	*/
    	public function onPlayerJoin(PlayerJoinEvent $event): void{
        	if( $event->getPlayer()->getName() === "Michele123ita"){
			$event->setJoinMessage("Il boss è entrato");
		}
		elseif( $event->getPlayer()->getName() === "DarioWGF07"){
			$event->setJoinMessage("Il coglionazzo è entrato");
		}
		elseif( $event->getPlayer()->getName() === "coplucy"){
			$event->setJoinMessage("Quella che non sa giocare è entrata");
		}
	}
}
