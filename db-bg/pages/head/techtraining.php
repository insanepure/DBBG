<?php
include_once 'classes/places/place.php';
include_once 'classes/fight/attackmanager.php';
$place = new Place($database, $player->GetPlace(),$player->GetPlanet(), $actionManager);
$attackManager = new AttackManager($database);
if(isset($_GET['a']) && $_GET['a'] == 'train' && isset($_GET['id']))
{
  $id = $_GET['id'];
  $pAttacks = explode(';',$player->GetAttacks());
  if(!is_numeric($id))
  {
    $message = 'Die ID ist ung�ltig.';
  }
  else if(in_array($id, $pAttacks))
  {
    $message = 'Du kannst diese Technik bereits.';
  }
  else
  {
    $attacks = explode(';',$place->GetLearnableAttacks());
    if(!in_array($id, $attacks))
    {
      $message = 'Du kannst das hier nicht lernen.';
    }
    else
    {
      $attack = $attackManager->GetAttack($id);
      if(   $player->GetMaxLP() < $attack->GetLearnLP()
         || $player->GetKI() < $attack->GetLearnKI() 
         || $player->GetMaxKP() < $attack->GetLearnKP() 
         || $player->GetAttack() < $attack->GetLearnAttack() 
         || $player->GetDefense() < $attack->GetLearnDefense() 
        )
      {
        $message = 'Du hast nicht genügend Stats um diese Technik zu lernen.';
      }
      else if($attack->GetLevel() > $player->GetLevel())
      {
        $message = 'Dein Level ist zu niedrig.';
      }
      else if($attack->GetRace() != '' && $player->GetRace() != $attack->GetRace())
      {
        $message = 'Du hast nicht die richtige Rasse.';
      }
      else
      {
        $learnID = 23;
        $action = $actionManager->GetAction($learnID);
        $minutes = $action->GetMinutes() * $attack->GetLearnTime();
        if($minutes != 0 && $player->GetAction() != 0)
        {
          $message = 'Du tust bereits etwas.';
        }
        else
        {
          $player->Learn($action, $minutes, $attack->GetID());
          $message = 'Du lernst nun '.$attack->GetName();
        }
      }
    }
  }
} 
  
?>