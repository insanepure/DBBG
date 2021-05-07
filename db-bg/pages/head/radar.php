<?php
if(!$player->HasRadar())
{
	header('Location: index.php');
	exit();  
}
include_once 'classes/radar/radar.php';
$planet = new Planet($database, $player->GetPlanet());

$dragon = $planet->GetDragon();
$wishNum = $planet->GetWishNum();
$wishes = $planet->GetWishes();

function GetStarName($stars)
{
	$name = 'star';
      switch($stars)
      {
        case 1:
          $name = 'one'.$name;
          break;
        case 2:
          $name = 'two'.$name;
          break;
        case 3:
          $name = 'three'.$name;
          break;
        case 4:
          $name = 'four'.$name;
          break;
        case 5:
          $name = 'five'.$name;
          break;
        case 6:
          $name = 'six'.$name;
          break;
        case 7:
          $name = 'seven'.$name;
          break;
      }
	return $name;
}
$radar = new Radar($database, $player);
if($player->CanWish())
{
  $dbCount = $radar->GetDBCount();

  $dbNums = array();
  $dbPositions = array();
  $pickables = array();
  $fights = array();
  $fightsPlayers = array();
  $drops = array();

  $isInactive = false;
  $activeTime = '';
  for($i = 0; $i < $dbCount; ++$i)
  {
    $db = $radar->GetDB($i);
    $position = $radar->GetRelativePosition($db);

    $length = sqrt(($position[0] * $position[0]) + ($position[1] * $position[1]));
    $position[0] += 140;
    $position[1] += 150;
    if($length >= 100 || !$db->IsActive())
    {
      if(!$db->IsActive())
      {
        $activeTime = $db->GetActiveTime();
        $isInactive = true;
      }
      continue;
    }

    if($length == 0 && $db->GetPlayer() == 0)
    {
      array_push($pickables, $db);
    }
    else if($length == 0 && $db->GetPlayer() == $player->GetID())
    {
      array_push($drops, $db);
    }
    else if($db->GetPlayer() != 0 && $db->GetPlayer() != $player->GetID())
    {
      $radarPlayer = $db->GetRadarPlayer();
      if($length < 10 || $radarPlayer->GetTravelPlace() == $player->GetTravelPlace() && $radarPlayer->GetPlace() == $player->GetPlace())
      {
        array_push($fights, $db);
      }
    }
    $positionIndex = implode(':',$position);
    $added = false;
    for($j = 0; $j < count($dbPositions); ++$j)
    {
      if($dbPositions[$j] == $positionIndex)
      {
        $dbNums[$j]++;
        $added = true;
        break;
      }
    }

    if(!$added)
    {
      $dbNums[count($dbNums)] = 1;
      $dbPositions[count($dbPositions)] = $positionIndex;
    }
  }
}

if($player->CanWish() && isset($_GET['a']) && $_GET['a'] == 'pickup' && count($pickables) > 0 && isset($_GET['id']) && is_numeric($_GET['id']))
{
	$db = null;
	for($i = 0; $i < count($pickables); ++$i)
	{
		if($pickables[$i]->GetID() == $_GET['id'])
		{
			$db = $pickables[$i];
			break;
		}
	}
	if($db != null)
	{
		$radar->Pickup($player, $db);
		array_push($drops, $db);
		array_splice($pickables, array_search($db, $pickables), 1);
		$message = 'Du hast einen Dragonball aufgehoben.';
	}
}
else if($player->CanWish() && isset($_GET['a']) && $_GET['a'] == 'drop' && count($drops) > 0)
{
	if($player->GetPlace() == 'Auf Reise')
	{
		$message = 'Du kannst auf der Reise keine Dragonballs ablegen.';
	}
	else
	{
		$db = null;
		for($i = 0; $i < count($drops); ++$i)
		{
			if($drops[$i]->GetID() == $_GET['id'])
			{
				$db = $drops[$i];
				break;
			}
		}
		if($db != null)
		{
			$radar->Drop($player, $db);
			array_push($pickables, $db);
			array_splice($drops, array_search($db, $drops), 1);
			$message = 'Du hast einen Dragonball abgelegt.';
		}
	}
}
else if($player->CanWish() && isset($_GET['a']) && $_GET['a'] == 'fight' && count($fights) > 0)
{
		$db = null;
		for($i = 0; $i < count($fights); ++$i)
		{
			if($fights[$i]->GetID() == $_GET['id'])
			{
				$db = $fights[$i];
				break;
			}
		}
		if($db != null)
		{
			$targetID = $db->GetPlayer();
			$target = new Player($database, $targetID, $actionManager);
			if(isset($fight) && $fight->GetID() != $target->GetChallengeFight())
			{
				$message = "Du befindest dich schon in einem Kampf";
			}
			else if($player->GetTournament() != 0)
			{
				$message = 'Du kannst während eines Turnieres nicht kämpfen.';
			}
			else if($player->GetLP() < ($player->GetMaxLP() * 0.2))
			{
				$message = 'Du hast nicht genügend LP. Du benötigst mindestens 20% deiner maximalen LP.';
			}
			else
			{
				$type = 7;
				$mode = '1vs1';
				$name = 'Dragonballkampf';
        $targetLeftWishFightSeconds = $target->GetWishFightLeftSeconds();
        $playerLeftWishFightSeconds = $player->GetWishFightLeftSeconds();
        if($targetLeftWishFightSeconds > 0 || $playerLeftWishFightSeconds > 0)
        {
          $value = 0;
          $name = '';
          if($targetLeftWishFightSeconds > 0)
          {
            $value = $targetLeftWishFightSeconds;
            $name = 'Das Ziel ist';
          }
          else
          {
            $value = $playerLeftWishFightSeconds;
            $name = 'Du bist';
          }
          
          
          $minutes = floor($value / 60);
          $seconds = $value - ($minutes*60);
          $message = $name.' noch für ';
          
          if($minutes != 0)
          {
            if($minutes == 1)
              $message = $message.$minutes.' Minute ';
            else
              $message = $message.$minutes.' Minuten ';
            $message = $message.'und ';
          }
          
          if($seconds == 1)
            $message = $message.$seconds.' Sekunde ';
          else
            $message = $message.$seconds.' Sekunden ';
          $message = $message.' geschützt.';
        }
				else if($target->GetFight() != 0)
				{
    			$targetFight = new Fight($database, $target->GetFight(), $target, $actionManager);
					if($targetFight->IsStarted() && $targetFight->GetType() == 7)
					{
						//Get team based on group
						$group = $player->GetGroup();
						$team = $targetFight->GetTeamOfGroup($group);
            if($targetFight->GetMembersOfTeam($team) >= 5)
            {
              $message = 'Es sind schon die maximale Anzahl an Mitglieder deines Teams im Kampf.';
            }
            else
            {
              $targetFight->ForceJoin($player, $team);
              if($targetFight->IsStarted())
              {
                
                $charaids = array();
                array_push($charaids, $player->GetID());
                $i = 0;
                $teams = $targetFight->GetTeams();
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
                $fighttype = 'Dragonballkampf';
                LoginTracker::AddInteraction($accountDB, $charaids, $fighttype, 'dbbg');
                
                header('Location: ?p=infight');
                exit();
              }
            }
						
					}
					else if($targetFight->IsStarted() && $target->GetChallengeFight() != 0 && $target->GetChallengeFight() == $player->GetFight())
					{
						//Challenged him already but he is still in fight
						$leftTime = (60*10) - $target->GetChallengeTimeSinceNow();
						if($leftTime <= 0)
						{
							//Take it directly
							$radar->Pickup($player, $db);
							array_push($drops, $db);
							array_splice($fights, array_search($db, $fights), 1);
							$message = 'Der Gegner brauch zu lange für den Kampf, du hast dir den Dragonball genommen.';
						}
						else
						{
							$message = 'Du musst noch '.$leftTime.' Sekunden warten, bis der Timer vorbei ist.';
						}
					}
					else if($targetFight->IsStarted())
					{
						//Challenge
						$createdFight = Fight::CreateFight($player, $database, $type, $name, $mode, 0, $actionManager, 0, '', 0, $target->GetID(), 0, 0, 0, 0, 0, 0, 0, $db->GetID());
            $createdFight->Join($player, 0, false);
						$target->Challenge($createdFight->GetID());
						$message = 'Der Gegner befindet sich im Kampf. Er hat 10 Minuten Zeit die Herausforderung anzunehmen.';
					}
					else
					{
    				$result = $targetFight->Leave($target); 
						$createdFight = null;
						if(isset($fight))
						{
							//It's a challenge which is open
							$createdFight = $fight;
						}
						else
						{
																	 //CreateFight($player, $database, $type, $name, $mode, $levelup=0, $actionManager=null, $zeni=0,$items=0, $story=0, $challenge=0, $survivalteam=0, $survivalrounds=0, $survivalwinner=0, $event=0, $healing=0, $eventfight=0, $tournament=0
							$createdFight = Fight::CreateFight($player, $database, $type, $name, $mode, 0, $actionManager, 0, '', 0, $target->GetID(), 0, 0, 0, 0, 0, 0, 0, $db->GetID());
              $createdFight->Join($player, 0, false);
						}
						$createdFight->Join($target, 1, false);
            if($createdFight->IsStarted())
            {
                $charaids = array();
                array_push($charaids, $target->GetID());
                $i = 0;
                $teams = $createdFight->GetTeams();
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
                $fighttype = 'Dragonballkampf';
                LoginTracker::AddInteraction($accountDB, $charaids, $fighttype, 'dbbg');
              
              
                header('Location: ?p=infight');
						    exit();
            }
					}
				}
				else if($target->GetLP() < ($target->GetMaxLP() * 0.2))
				{
					//Take it directly
					$radar->Pickup($player, $db);
					array_push($drops, $db);
					array_splice($fights, array_search($db, $fights), 1);
					$message = 'Der Gegner ist besiegt, du hast dir den Dragonball genommen.';
				}
				else
				{
					$createdFight = null;
					if(isset($fight))
					{
						//It's a challenge which is open
						$createdFight = $fight;
					}
					else
					{
						$createdFight = Fight::CreateFight($player, $database, $type, $name, $mode, 0, $actionManager, 0, '', 0, $target->GetID(), 0, 0, 0, 0, 0, 0, 0, $db->GetID());
            $createdFight->Join($player, 0, false);
					}
    			$createdFight->Join($target, 1, false);
          if($createdFight->IsStarted())
          {
            
            $charaids = array();
            array_push($charaids, $target->GetID());
            $i = 0;
            $teams = $createdFight->GetTeams();
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
            $fighttype = 'Dragonballkampf';
            LoginTracker::AddInteraction($accountDB, $charaids, $fighttype, 'dbbg');
            
            header('Location: ?p=infight');
					  exit();
          }
				}
			}
		}
}
?>