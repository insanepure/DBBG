<?php

$tower = new Tower($database);
$totalFloors = $tower->GetFloorCount();

if(isset($_GET['a']) && $_GET['a'] == 'start')
{
    if($player->GetFight() != 0)
    {
      $message = 'Du befindest dich schon in einem Kampf.';
    }
		else if($player->GetTournament() != 0)
		{
			$message = 'Du kannst während des Turnieres nichts kämpfen.';
		}
    else if($player->GetLP() < $player->GetMaxLP() * 0.2)
    {
      $message = 'Du hast nicht genügend LP.';
    }
    else
    {
      $players = 1;
      $towerfloor = $_POST['towerfloor'];
      $startFloor = 1;
      if($towerfloor != 'Alle')
        $startFloor = $towerfloor;
      $towerFloor = $tower->GetFloor($startFloor);
      if($towerfloor != 'Alle')
        $startFloor = 0;
      $npcs = $towerFloor->GetNPCs();
      $type = 9;
      if($towerfloor != 'Alle')
        $type = 1;
			$mode = $players.'vs'.count($npcs);
			$name = 'Turmkampf';
      $tournament=0;
      $dragonball=0;
      $npcid=0;
      $difficulty=0;
      $survivalTeam = 0;
      $survivalRounds = 0;
      $survivalWinner = 0;
      $isHealing = 0;
      $healthRatio = 100;
      $healthRatioTeam = 0;
      $healthRatioWinner = 0;
      $fightNum = 0;
      $eventid = 0;
			$createdFight = Fight::CreateFight($player, $database, $type, $name, $mode, 0, $actionManager, 0, '', 0, 0,$survivalTeam
                                         ,$survivalRounds, $survivalWinner, $eventid, $isHealing, $startFloor
                                         , $tournament, $dragonball, $npcid, $difficulty, $healthRatio,$healthRatioTeam, $healthRatioWinner);
      
      $i = 0;
			$team = 1;
      $npcDifficulty = $players;
      while($i != count($npcs))
      {
        $npc = new NPC($database, $npcs[$i], $npcDifficulty);
        $createdFight->Join($npc, $team, true);
        ++$i;
      }
      $createdFight->Join($player, 0, false);
      
      if($createdFight->IsStarted())
      {
        header('Location: ?p=infight');
			  exit();
      }
      $message = 'Du hast den Turm betreten.';
    }
}
?>