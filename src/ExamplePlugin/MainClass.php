<?php

declare(strict_types=1);

namespace ExamplePlugin;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

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
}
