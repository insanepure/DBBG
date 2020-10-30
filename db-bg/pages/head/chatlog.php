<?php
if(!isset($player) || !$player->IsValid() || $player->GetARank() != 3)
{
	header('Location: ?p=news');
	exit();  
}
?>