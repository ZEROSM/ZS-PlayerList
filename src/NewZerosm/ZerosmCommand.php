<?php

namespace NewZerosm;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

interface IZerosmCommand{

  public function _execute(CommandSender $sender, string $label, array $args) : bool;

}

if(Server::getInstance()->getName() === "PocketMine-MP" && version_compare(\PocketMine\API_VERSION, "3.0.0-ALPHA7") >= 0){
  abstract class ZerosmCommand extends Command implements IZerosmCommand{
    public function execute(CommandSender $sender, string $label, array $args) : bool{
      return $this->_execute($sender, $label, $args);
    }
  }
}else{
  abstract class ZerosmCommand extends Command implements IZerosmCommand{
    public function execute(CommandSender $sender, $label, array $args){
      return $this->_execute($sender, $label, $args);
    }
  }
}
