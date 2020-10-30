<?php
include_once 'classes/places/place.php';
include_once 'classes/fight/attackmanager.php';
$place = new Place($database, $player->GetPlace(),$player->GetPlanet(), $actionManager);
$attackManager = new AttackManager($database);
if(isset($_GET['a']) && $_GET['a'] == 'train' && isset($_GET['id']) && isset($_GET['npcid']))
{
  $id = $_GET['id'];
  $npcid = $_GET['npcid'];
  $pAttacks = explode(';',$player->GetAttacks());
  if(!is_numeric($id))
  {
    $message = 'Die ID ist ungültig.';
  }
  else if(in_array($id, $pAttacks))
  {
    $message = 'Du kannst diese Technik bereits.';
  }
  else if(!is_numeric($npcid))
  {
    $message = 'Diese NPC-ID ist ungültig.';
  }
  else
  {
    $trainers = $place->GetTrainers();
    if(!in_array($npcid, $trainers))
    {
      $message = 'Der NPC befindet sich nicht an diesen Ort.';
    }
    else
    {
      $npc = new NPC($database, $npcid, 1);
      if(!$npc->IsValid())
      {
      $message = 'Diese NPC existiert nicht.';
      }
      $attacks = explode(';',$npc->GetAttacks());
      if(!in_array($id, $attacks))
      {
        $message = 'Dieser NPC kennt diese Attacke nicht.';
      }
      else
      {
        $attack = $attackManager->GetAttack($id);
        if(   $player->GetMaxLP() < $attack->GetLearnLP() 
           || $player->GetMaxKP() < $attack->GetLearnKP() 
           || $player->GetKI() < $attack->GetLearnKI()
           || $player->GetAttack() < $attack->GetLearnAttack() 
           || $player->GetDefense() < $attack->GetLearnDefense() 
          )
        {
          $message = 'Du hast nicht genügend Stats um diese Technik zu lernen.';
        }
        else if($attack->GetRace() != '' && $player->GetRace() != $attack->GetRace())
        {
          $message = 'Du hast nicht die richtige Rasse.';
        }
        else
        {
          $learnID = 23;
          $action = $actionManager->GetAction($learnID);
          $minutes = $action->GetMinutes();
          if($player->GetAction() != 0)
          {
            $message = 'Du tust bereits etwas.';
          }
          else
          {
            $player->Learn($action, $minutes, $attack->GetName());
            $message = 'Du lernst nun '.$attack->GetName();
          }
        }
      }
    }
  }
  
  
}
?>