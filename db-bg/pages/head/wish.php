<?php
if(!$player->HasRadar() && !$player->HasDBs())
{
	header('Location: index.php');
	exit();  
}
include_once 'classes/radar/radar.php';
$radar = new Radar($database, $player);


$dragon = 'Shenlong';
if($player->GetPlanet() == 'Namek') 
  $dragon = 'Porunga';

$dbCount = $radar->GetDBCount();
$drops = array();
$wishes = 0;

for($i = 0; $i < $dbCount; ++$i)
{
  $db = $radar->GetDB($i);
  $position = $radar->GetRelativePosition($db);
  
  $length = sqrt(($position[0] * $position[0]) + ($position[1] * $position[1]));
  $position[0] += 140;
  $position[1] += 150;
  if($length >= 100)
  {
    continue;
  }

	if($length == 0 && $db->GetPlayer() == $player->GetID())
	{
		array_push($drops, $db);
    $wishes = $db->GetWishes();
	}
}

if($player->HasDBs())
  $wishes += 1;

if(!$player->HasDBs() && count($drops) != 7)
{
	header('Location: ?p=radar');
	exit();  
}

if(isset($_GET['a']) && $_GET['a'] == 'wish')
{
  
  if(!isset($_POST['wish']) || !is_numeric($_POST['wish']))
  {
    $message = 'Du hast keinen gültigen Wunsch gewählt.';
  }
  if($wishes <= 0)
  {
    $message = 'Du hast keinen Wünsche mehr frei.';
  }
  else
  {
    $wish = $_POST['wish'];
    $wished = true;
    $wishZeni = 1000000;
    $wishStats = 200;
    
    if($player->HasWish($wish))
    {
      $message = 'Du hast diesen Wunsch schon gewünscht!';
    }
    else
    {
      switch($wish)
      {
        case 1: // Zeni
          $player->AddZeni($wishZeni);
          $wished = true;
          break;
        case 2: //Stats
          $player->AddStats($wishStats);
          $wished = true;
          break;
        case 3: //Statspunkte reset
            $player->ResetStats();
            $wished = true;
          break;
        case 4: //Skillpunkte reset
            $player->ResetSkills();
            $wished = true;
          break;
        default:
          $message = 'Du hast keinen gültigen Wunsch gewählt.';
          break;
      }
      if($wished)
      {
        $titelManager = new titelManager($database);
        $titelManager->AddTitelWish($player, $wish);
        
        $message = 'Dein Wunsch wurde gewährt.';
        $wishes = $wishes-1;
        
        if(count($drops) == 7)
        {
          if($wishes == 0)
          {
            $radar->EndWish();
          }
          else
          {
            $radar->Wished();
          }
          $player->UpdateWish($wish, 12); // Block for 12 wishes
        }
        else if($player->HasDBs())
        {
          $dbID = 150;
          $statstype = 0;
          $upgrade = 0;
          $amount = 1;
          $player->RemoveItemsByID($dbID, $dbID, $statstype, $upgrade, $amount);
          $player->UpdateWish($wish, $player->GetWishCounter());
        }
      }
    }
  }
  
}

?>