<?php

namespace NewZerosm;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\event\player\PlayerInteractEvent;

class PlayerList extends PluginBase{
	private static $instance = null;

	public static function getInstance(){
		return self::$instance;
	}

	public function onEnable(){
		foreach([
			"PlayerListUICommand"
		] as $class){
			$class = "\\NewZerosm\\commands\\" . $class;
			$this->getServer()->getCommandMap()->register("PlayerList", new $class($this));
		}
		
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		if($api === null){
			$this->getServer()->getPluginManager()->disablePlugin($this);			
		}
		
		$this->getLogger()->critical("ZS-PlayerList v1.0.0 | §e오르카 제작"); 
		$this->getLogger()->notice("해당 플러그인은 ZEROSM Network 서버 전용 플러그인으로 외부로 유출하실수 없습니다."); 
		$this->getLogger()->notice("해당 플러그인은 §eZEROSM Network Inc.§b 라이센스로 보호받고 있습니다.");
	}
}
