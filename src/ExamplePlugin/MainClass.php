<?php

declare(strict_types=1);

namespace ExamplePlugin;

use pocketmine\plugin\PluginBase;
// Event when Player Joins
use pocketmine\event\player\PlayerJoinEvent;
// Event When Player Quits
use pocketmine\event\player\PlayerQuitEvent;
// Player "class"
use pocketmine\Player;
// Server "class"
use pocketmine\Server;
// Event Listener
use pocketmine\event\Listener;
// Text Format formats text and changes Color
use pocketmine\utils\TextFormat;
// Command
use pocketmine\command\Command;
// Person who does command
use pocketmine\command\CommandSender;

class MainClass extends PluginBase implements Listener{

	public function onLoad() : void{
		$this->getLogger()->info(TextFormat::WHITE . "Caricamento Mod");
	}

	public function onEnable() : void{
		$this->getServer()->getPluginManager()->registerEvents($this,$this);
		$this->getLogger()->info(TextFormat::DARK_GREEN . "Mod abilitata!");
		$this->saveDefaultConfig(); // Saves config.yml if not created.
		$this->reloadConfig(); // Fix bugs sometimes by getting configs values
		$keyFromConfig = $this->getConfig()->get("key"); // This will return the element "key" from the config.
	}

	public function onDisable() : void{
		$this->getLogger()->info(TextFormat::DARK_RED . "Mod disabilitata!");
	}
	
	public function onJoin(PlayerJoinEvent $event){
   		$player = $event->getPlayer();
   		$name = $player->getName();
   		$this->getServer()->broadcastMessage(TextFormat::GREEN."$name è diventato uno di noi!");
	}
	
	public function onQuit(PlayerQuitEvent $event){
		$player = $event->getPlayer();
   		$name = $player->getName();
   		$this->getServer()->broadcastMessage(TextFormat::RED."$name ci ha lasciati! Che pezzo di *****!");
	}
	
	public function onCommand(CommandSender $sender,Command $cmd,string $label,array $args) : bool{
		if($cmd->getName() == "test"){
     			if(!$sender instanceof Player){ // Basically this checks if the Command Sender is NOT a player
          			$sender->sendMessage("Esegui questo comando IN-GAME!"); // For Console Command Sender
     			}       
			else{ //if command sender is not a CONSOLE
				if(!isset($args[0]) or (is_int($args[0]) and $args[0] > 0)) { // Check if argument 0 is an integer and is more than 0.
                			$args[0] = 4; // Defining $args[0] with value 4
          			}
          			$sender->getInventory()->addItem(Item::get(364,0,$args[0]));
          			$sender->sendMessage("Hai ricevuto". count($args[0]) ."bistecche!");
				$task = new tasks\MyTask($this, $sender->getName()); // Create the new class Task by calling
                		$this->getServer()->getScheduler()->scheduleRepeatingTask($task, 10*20); // Counted in ticks (1 second = 20 ticks)
     			}
		}
		return true;
	}
	
	public function SaveData(){
		$this->getConfig()->set("key", "example"); // This will set the element "key" of the config to example.
		$this->getConfig()->save(); // Saves the config
	}
}
