<?php

if(!isset($player) || !$player->IsValid() || $player->GetARank() < 2)
{
	header('Location: ?p=news');
	exit();  
}

?>