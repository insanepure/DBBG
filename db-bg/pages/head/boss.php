<?php
include_once 'classes/items/itemmanager.php';
if(isset($_GET['a']) && $_GET['a'] == 'start')
{
  if(!isset($_POST['id']) || !is_numeric($_POST['id']) || $_POST['id'] <= 0)
  {
    $message = 'Dieses Event ist ungültig.';
  }
  else
  {
    $event = new Event($database, $_POST['id']);
		if(!$event->IsDungeon())
		{
      $message = 'Das Event ist kein Bosskampf.';
		}
		else if($event->GetLevel() > $player->GetLevel())
		{
    $message = 'Dieses Event ist ungültig.';
		}
    else if(!isset($_POST['players']) || !is_numeric($_POST['players']) || $_POST['players'] < $event->GetMinPlayers())
    {
      $message = 'Das Event benötigt mehr Spieler.';
    }
    else if($_POST['players'] > $event->GetMaxPlayers())
    {
      $message = 'Das Event kann nicht mit sovielen Spielern starten.';
    }
    else if(!Event::IsToday($player->GetPlanet(), $player->GetPlace(), $event->GetPlaceAndTime()))
    {
      $message = 'Das Event ist nicht heute.';
    }
    else if($player->GetFight() != 0)
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
      //create Fight and invite group members if not enough, like challenge
      $group = $player->GetGroup();
      $validPlayers = $event->GetValidPlayers($player, $group);
      $players = $_POST['players'];
      if($validPlayers < $players)
      {
        $message = 'Es sind nicht genügend Spieler bereit für einen Kampf.';
      }
      else
      {
        $eventFight = $event->GetFight(0);
        $npcs = $eventFight->GetNPCs();
        $type = 5;
				$mode = $players.'vs'.count($npcs);
				$name = $event->GetName();
        $tournament=0;
        $dragonball=0;
        $npcid=0;
        $difficulty=0;
        $eventFightNum = 0;
				$createdFight = Fight::CreateFight($player, $database, $type, $name, $mode, 0, $actionManager, 0, '', 0, 0, $eventFight->GetSurvivalTeam(), $eventFight->GetSurvivalRounds()
                                           , $eventFight->GetSurvivalWinner()
                                           , $event->GetID(), $eventFight->IsHealing(), $eventFightNum
                                           , $tournament, $dragonball, $npcid, $difficulty, $eventFight->GetHealthRatio(), $eventFight->GetHealthRatioTeam(), $eventFight->GetHealthRatioWinner());
        
        $i = 0;
				$team = 1;
        $addedDifficulty = $event->GetDifficulty()/100;
        $npcDifficulty = round($players * $addedDifficulty);
        while($i != count($npcs))
        {
          $npc = new NPC($database, $npcs[$i], $npcDifficulty);
          $createdFight->Join($npc, $team, true);
          ++$i;
        }
				
				if($players > 1)
				{
					$event->Invite($createdFight->GetID(), $group, $player);
				}
        
        if($createdFight->IsStarted())
        {
          header('Location: ?p=infight');
				  exit();
        }
        $message = 'Der Bosskampf wurde gestartet.';
      }
    }
  }
}

?>