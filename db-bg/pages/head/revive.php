<?php

if($player->GetPlanet() != 'Jenseits')
{
	header('Location: ?p=index');
	exit();  
}

$reviveTime = $player->GetReviveTime();
if($reviveTime < 0) $reviveTime = 0;

if(isset($_GET['a']) && $_GET['a'] == 'revive' && $player->GetPlanet() == 'Jenseits')
{
  if($reviveTime != 0)
    $message = 'Du kannst dich noch nicht wiederbeleben.';
  else if($player->GetAction() != 0)
    $message = 'Du tust gerade etwas.';
  else
  {
    $player->Revive();
    $message = 'Du wurdest wiederbelebt.';
  }
}

?>