<?php
include_once 'classes/items/itemmanager.php';
include_once 'classes/bbcode/bbcode.php';

$itemManager = new ItemManager($database);
include_once 'classes/npc/npc.php';
include_once 'classes/places/place.php';
$place = new Place($database, $player->GetPlace(),$player->GetPlanet(), $actionManager);
if(isset($_GET['a']) && $_GET['a'] == 'fight')
{
  if($player->GetFight() != 0)
  {
    $message = 'Du befindest dich schon in einem Kampf.';
  }
	else if($player->GetTournament() != 0)
	{
		$message = 'Du kannst während eines Turnieres nicht kämpfen.';
	}
  else if($player->GetLP() < $player->GetMaxLP() * 0.2)
  {
    $message = 'Du hast nicht genügend LP.';
  }
  else if(!isset($_GET['id']) || !is_numeric($_GET['id']))
  {
    $message = 'Dieser NPC ist ungültig.';
  }
  else if(!isset($_POST['type']) || !is_numeric($_POST['type']) || $_POST['type'] != 0 && $_POST['type'] != 3)
  {
    $message = 'Dieser Typ ist ungültig.';
  }
  else if(!isset($_POST['difficulty']) || !is_numeric($_POST['difficulty']) || $_POST['difficulty'] < 0 || $_POST['difficulty'] > 3)
  {
    $message = 'Diese Schwierigkeit ist ungültig.';
  }
  else
  {
      $difficulty = 1;
      if($_POST['difficulty'] == 1)
      {
        $difficulty = 2;
      }
      else if($_POST['difficulty'] == 2)
      {
        $difficulty = 3;
      }
      else if($_POST['difficulty'] == 3)
      {
        $difficulty = 4;
      }
      $npc = new NPC($database, $_GET['id'], $difficulty);
    
      $npcs = $place->GetNPCs();
      if(!$npc->IsValid() || !in_array($npc->GetID(), $npcs))
      {
        $message = 'Dieser NPC ist ungültig.';
      }
      else
      {
        $type = $_POST['type']; //NPCFight
        $mode = $difficulty.'vs1';
        if($type == 3)
		      $zeni = $npc->GetZeni();
        else
          $zeni = 0;
        $name = 'NPCKampf gegen '.$npc->GetName();
        $team = 1;
        if($type == 3)
          $items = $npc->GetItems();
        else
          $items = '';
        
        $survivalrounds = $npc->GetSurvivalRounds();
        $survivalteam = $npc->GetSurvivalTeam();
        $survivalwinner = $npc->GetSurvivalWinner();
        $healthRatio = $npc->GetHealthRatio();
        $healthRatioTeam = $npc->GetHealthRatioTeam();
        $healthRatioWinner = $npc->GetHealthRatioWinner();
        $createdFight = Fight::CreateFight($player, $database, $type, $name, $mode, 0, $actionManager, $zeni, $items,0,0,$survivalteam,$survivalrounds,
                                           $survivalwinner,0,0,0,0,0,$_GET['id'],$difficulty, $healthRatio, $healthRatioTeam, $healthRatioWinner);
        $createdFight->Join($npc, $team, true);
				if($createdFight->IsStarted())
        {
				  header('Location: ?p=infight');
          exit();
        }
        else
          $message = 'Der Kampf wurde eröffnet.';
      }
  }
}

?>