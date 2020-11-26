<?php
include_once 'classes/places/place.php';
include_once 'classes/fight/attackmanager.php';
include_once 'classes/skilltree/skill.php';
$pAttacks = explode(';',$player->GetAttacks());
$skillpoints = $player->GetSkillPoints();
$race = $player->GetRace();
$topOffset = 0;
if(isset($_GET['a']) && $_GET['a'] == 'learn' && isset($_GET['attack']) && is_numeric($_GET['attack']))
{
  $attackManager = new AttackManager($database);
  $skill = new Skill($database, $_GET['attack']);
  $attack = $attackManager->GetAttack($skill->GetAttack());
  if($attack == null)
  {
		$message = 'Diese Attacke existiert nicht.';
  }
  else if(!$skill->IsLearnable())
  {
		$message = 'Diese Attacke ist hier nicht lernbar.';
  }
  else if($skill->GetRace() != '' && $skill->GetRace() != $player->GetRace())
  {
		$message = 'Diese Attacke gehört einer anderen Rasse.';
  }
  else if(in_array($skill->GetAttack(), $pAttacks))
  {
    $message = 'Du hast diese Attacke bereits gelernt.';
  }
  else if($attack->GetLevel() > $player->GetLevel())
  {
		$message = 'Du musst mindestens Level '.$attack->GetLevel().' sein.';
  }
  else if(!$skill->HasEnoughPoints($player->GetSkillPoints()))
  {
    $message = 'Du hast nicht genügend Skillpunkte.';
  }
  else
  {
    
    $canLearn = false;
    $attacksNeeded = '';
    $numAttacks = 0;
    if($skill->GetNeedAttacks() != '')
      $numAttacks = count($skill->GetNeedAttacks());
    
    if($numAttacks != 0)
    {
      foreach($skill->GetNeedAttacks() as $needAttack)
      {
        if(!in_array($needAttack, $pAttacks))
        {
          $otherAttack = $attackManager->GetAttack($needAttack);
          if($attacksNeeded == '')
            $attacksNeeded = $otherAttack->GetName();
          else
            $attacksNeeded = $attacksNeeded.' oder '.$otherAttack->GetName();
        }
        else
          $canLearn = true;
      }
    }
    else
      $canLearn = true;
    $learnID = 23;
    $action = $actionManager->GetAction($learnID);
    $minutes = $action->GetMinutes() * $attack->GetLearnTime();
    
    if(!$canLearn && $numAttacks >= 4)
        $message = 'Du musst zuvor eine der vorherigen Techniken lernen.';
    else if(!$canLearn)
        $message = 'Du musst zuvor '.$attacksNeeded.' lernen.';
    else if($player->GetAction() != 0)
      $message = 'Du tust bereits etwas.';
    else
    {
      $player->Learn($action, $minutes, $attack->GetID(), $skill->GetNeededPoints());
      $message = 'Du lernst nun '.$attack->GetName();
    }
  }
  
}
?>