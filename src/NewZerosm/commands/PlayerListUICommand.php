<?php

namespace NewZerosm\commands;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\item\Item;

use NewZerosm\Plugin1;
use NewZerosm\ZerosmCommand;

class PlayerListUICommand extends ZerosmCommand{
	
	public function __construct(Plugin1 $owner){
		parent::__construct(
			"인원", 
			"서버에 접속한 유저 목록을 불러옵니다.", 
			"/인원", 
			[],
			[]
		
			);

		$this->owner = $owner;
	}

	public function _execute(CommandSender $sender, string $label, array $args) : bool{
		$player = $sender->getPlayer();
		
		if(!$sender instanceof Player){
			$sender->sendMessage("§c서버 내에서만 사용하실수 있는 명령어 입니다.");
			return true;
		}
		
		$online = "";
		$onlineCount = 0;
		$date = date("Y년 m월 d일 h시 i분");

		foreach($server->getServer()->getOnlinePlayers() as $players){
			if($players->isOnline() and (!($players instanceof Player) or $server->canSee($players))){
				if($players->isOP()){
					$online .= "§b" . $players->getDisplayName() . " ";
					++$onlineCount;
					
				}else{
					$online .= "§2" . $players->getDisplayName() . " ";
					++$onlineCount;
					
				}
			}
		}
			
		$api = $sender->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createCustomForm(function (Player $sender, array $data){
			$result = $data[0];
					
			if($result === null){
				return true;
			}
				
			switch($result){
				case 0:
				break;
							
				case 1:
				break;
              
									
			}
		});
		$form->setTitle("§l§6<< §aPlayerListUI §6>>");
		$form->addLabel("§7>> §e".$date."§f 기준 인원 목록 §7<<");
		$form->addLabel("현재 서버에 접속하고 있는 유저는 총 §e".$onlineCount."§f명 입니다.");
		$form->addLabel("서버에 접속중인 플레이어 목록:");
		$form->addLabel("". $online, 0, -2);
		$form->addLabel("");
		$form->addLabel("§c해당 내용은 해당 UI를 재접속하면 갱신됩니다.");
		
		$form->sendToPlayer($sender);
		return true;
	}
}