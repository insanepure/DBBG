<?php

if(!$playerPlanet->IsInJenseits())
{
	header('Location: ?p=index');
	exit();  
}

$reviveTime = $player->GetReviveTime();
if($reviveTime < 0) $reviveTime = 0;

if(isset($_GET['a']) && $_GET['a'] == 'revive')
{
  if($reviveTime != 0)
    $message = 'Du kannst dich noch nicht wiederbeleben.';
  else if($player->GetAction() != 0)
    $message = 'Du tust gerade etwas.';
  else if($player->GetFight() != 0)
    $message = 'Du kannst dich während eines Kampfes nicht wiederbeleben.';
  else
  {
    $player->Revive();
    $message = 'Du wurdest wiederbelebt.';
  }
}

?>