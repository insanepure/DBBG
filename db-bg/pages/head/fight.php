<?php
if(isset($_GET['a']) && $player->IsLogged())
{
  $a = $_GET['a'];
  $team = -1;
  $newFight = null;
  $fightes = null;
  $mode = null;
  
  if(isset($_REQUEST['team']))
  {
    $team = $_REQUEST['team'];
  }
  
  if(isset($_GET['fight']))
  {
    $newFight = new Fight($database, $_GET['fight'], $player, $actionManager);
    $teams = $newFight->GetTeams();
    $mode = $newFight->GetMode();
  }
  
  if($a == 'adminjoin' && $player->GetARank() == 3)
  {
    if(isset($fight))
    {
      $message = "Du befindest dich schon in einem Kampf";
    }
		else if($player->GetTournament() != 0)
		{
			$message = 'Du kannst während des Turnieres nichts kämpfen.';
		}
    else if(!isset($_GET['fight']) || !is_numeric($_GET['fight']))
    {
      $message = "Dieser Kampf ist ungültig.";
    }
    else if(!$newFight->IsValid())
    {
      $message = "Dieser Kampf existiert nicht.";
    }
    else if((!isset($team) || !is_numeric($team)))
    {
      $message = "Das Team ist ungültig.";
    }
    else if(!isset($mode[$team]))
    {
      $message = 'Das Team gibt es nicht.';
    }
    else
    {
      $newFight->ForceJoin($player, $team);
    }
  }
  else if($a == 'join')
  {
    
    $valid = true;
    if(isset($fight))
    {
      $message = "Du befindest dich schon in einem Kampf";
    }
		else if($player->GetTournament() != 0)
		{
			$message = 'Du kannst während des Turnieres nichts kämpfen.';
		}
    else if(!isset($_GET['fight']) || !is_numeric($_GET['fight']))
    {
      $message = "Dieser Kampf ist ungültig.";
    }
    else if(!$newFight->IsValid())
    {
      $message = "Dieser Kampf existiert nicht.";
    }
    else if($newFight->GetChallenge() != 0)
    {
      $message = "Dieser Kampf ist eine Herausforderung.";
    }
    else if((!isset($team) || !is_numeric($team)))
    {
      $message = "Das Team ist ungültig.";
    }
    else if(!isset($mode[$team]))
    {
      $message = 'Das Team gibt es nicht.';
    }
    else if($newFight->GetType() != 0 && $player->GetLP() < ($player->GetMaxLP() * 0.2))
    {
      $message = 'Du hast nicht genügend LP. Du benötigst mindestens 20% deiner maximalen LP.';
    }
    else
    {
      $planet = new Planet($database, $player->GetPlanet());
      if($newFight->GetType() != 0 && !$planet->IsSamePlanet($newFight->GetPlanet()))
      {
        $message = 'Du befindest dich nicht auf den richtigen Planeten.';
      }
      if(isset($teams[$team]) && count($teams[$team]) == $mode[$team])
      {
        $message = 'Das Team ist schon voll!';
      }
      else
      {
        $result = $newFight->Join($player, $team);
        
        if(!$result)
        {
          $message = 'Es gab Probleme beim Betreten zum Kampf.';
        }
        else
        {
          $fight = $newFight;

          if($newFight->IsStarted() && $newFight->GetType() != 0)
          {
            $charaids = array();
            array_push($charaids, $player->GetID());
            $i = 0;
            while(isset($teams[$i]))
            {
              $players = $teams[$i];
              $j = 0;
              while(isset($players[$j]))
              {
                if(!$players[$j]->IsNPC())
                  array_push($charaids, $players[$j]->GetAcc());
                $j++;
              }
              ++$i;
            }
            $fighttype = 'Unbekannter Kampf';
            switch($newFight->GetType())
            {
              case 1:
                $fighttype = 'Wertungskampf';
                break;
              case 3:
                $fighttype = 'NPCKampf';
                break;
              case 4:
                $fighttype = 'Storykampf';
                break;
              case 5:
                $fighttype = 'Eventkampf';
                break;
              case 6:
                $fighttype = 'Turnierkampf';
                break;
              case 7:
                $fighttype = 'Dragonballkampf';
                break;
              case 8:
                $fighttype = 'Arenakampf';
                break;
              case 9:
                $fighttype = 'Turmkampf';
                break;
            }
            LoginTracker::AddInteraction($accountDB, $charaids, $fighttype, 'dbbg');
          }
          
        }
      }
    }
    
  }
  else if($a == 'leave' && isset($fight))
  {
    $result = $fight->Leave($player); 
  }
  else if($a == 'start' && isset($_POST['type']) && isset($_POST['name']) && isset($_POST['mode']))
  {
    
    $type = $_POST['type'];
    $name = $_POST['name'];
    $mode = Fight::ValidateMode($_POST['mode']);
    if($name == '')
    {
      switch($type)
      {
        case 0:
          $name = 'Spaß';
          break;
        case 1:
          $name = 'Wertung';
          break;
        case 1:
          $name = 'Tod';
          break;
      }
    }
    
    if($database->HasBadWords($name))
    {
      $message = 'Der Name enthält ungültige Wörter.';
    }
    else if(strlen($name) >= 20)
    {
      $message = 'Der Name ist zu lang.';
    }
    else if(isset($fight))
    {
      $message = "Du befindest dich schon in einem Kampf.";
    }
		else if($player->GetTournament() != 0)
		{
			$message = 'Du kannst während des Turnieres nichts kämpfen.';
		}
	else if ($type < 0)
	{
      $message = 'Diese Art von Kampf gibt es nicht!';
    }
	else if ($type == 4)
	{
      $message = 'Diese Art von Kampf gibt es nicht!';
    }
	else if ($type == 5)
	{
      $message = 'Diese Art von Kampf gibt es nicht!';
    }
	else if ($type == 6)
	{
      $message = 'Diese Art von Kampf gibt es nicht!';
    }
	else if ($type == 7)
	{
      $message = 'Diese Art von Kampf gibt es nicht!';
    }
    else if($type == 1 && $mode != '1vs1')
    {
      $message = 'Ein Wertungskampf kann nur in ein 1vs1 ausgetragen werden.';
    }
    else if(!$mode)
    {
      $message = 'Der Mode ist ungültig';
    }
    else if($name == '' || $name == ' ')
    {
      $message = 'Der Name ist ungültig';
    }
    else if($type != 0 && $player->GetLP() < ($player->GetMaxLP() * 0.2))
    {
      $message = 'Du hast nicht genügend LP. Du benötigst mindestens 20% deiner maximalen LP.';
    }
    else
    {
      $createdFight = Fight::CreateFight($player, $database, $type, $name, $mode, 0, $actionManager);
      if(!$createdFight)
      {
        $message = 'Es gab Probleme bei der Erstellung des Kampfes.';
      }
      else
      {
        $createdFight->Join($player, 0, false);
        $fight = $createdFight;
      }
    }
  }
  
}
?>