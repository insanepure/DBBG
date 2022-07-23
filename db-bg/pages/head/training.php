<?php
include_once 'classes/places/place.php';
include_once 'classes/bbcode/bbcode.php';
include_once 'classes/items/itemmanager.php';
$itemManager = new ItemManager($database);

$place = new Place($database, $player->GetPlace(),$player->GetPlanet(), $actionManager);

if(isset($_GET['a']) && $_GET['a'] == 'train' && isset($_GET['id']) && isset($_POST['hours']))
{
  $hours = $_POST['hours'];
  $id = $_GET['id'];
  if(!is_numeric($hours) && $hours != 0)
  {
    $message = 'Die Stundenzahl ist ungültig.';
  }
  else if(!is_numeric($id))
  {
    $message = 'Die ID ist ungültig.';
  }
  else if(!$place->HasAction($id))
  {
    $message = 'Der Ort kennt dieses Training nicht.';
  }
  else
  {
    $action = $actionManager->GetAction($id);
    $actionPossible = true;
    $actionHours = $action->GetMinutes() / 60;
    $isRound = false;
    if($action->GetMinutes() != 0)
      $isRound = $hours % $actionHours;
    
    $maxHours = 24 * 30;
    $price = $action->GetPrice() * $hours;
    $item = $action->GetItem();
    $race = $action->GetRace();
    
    if($item != 0 && !$player->HasItemWithID($item->GetID(), $item->GetID()))
    {
      $message = 'Du hast das benötigte Item nicht.';
    }
    else if($action->GetLevel() > $player->GetLevel())
    {
      $message = 'Dein Level ist zu niedrig.';
    }
    else if($isRound)
    {
      $message = 'Die Stundenzahl ist nicht gültig.';
    }
    else if($actionHours > $hours)
    {
      $message = 'Die Stundenzahl ist zu klein.';
    }
    else if($hours > $maxHours)
    {
      $message = 'Die Stundenzahl ist zu groß.';
    }
    else if($price > $player->GetZeni())
    {
      $message = 'Du hast nicht genug Zeni.';
    }
    else if($actionHours != 0 && $player->GetAction() != 0)
    {
      $message = 'Du tust bereits etwas.';
    }
    else if($race != '' && $player->GetRace() != $race)
    {
      $message = 'Du kannst diese Aktion nicht machen, sie gehört einer anderen Rasse.';
    }
	
    else if($actionPossible)
    {
      
      if($action->GetType() == 4)
      {
        include_once 'classes/radar/radar.php';
        $radar = new Radar($database, $player);
        if($radar->HasPlayerDB())
        {
          $message = 'Du kannst mit einem Dragonball nicht diese Aktion tätigen.';
        }
        else
        {
          $playerPlace = new Place($database, $player->GetPlace(), $player->GetPlanet(), null);

          if($player->GetX() != 0 && $player->GetY() != 0)
          {
            $x = $player->GetX();
            $y = $player->GetY();
          }
          else
          {
            $x = $playerPlace->GetX();
            $y = $playerPlace->GetY();
          }
          $player->Travel($action->GetPlace(), $hours*60, $action, $x, $y, false);
        }
      }
      else
      {
        $minutes = $hours*60;
        if( $player->GetRVGUZTime() != 0 && $minutes > $player->GetRVGUZTime())
        {
          $minutes = $player->GetRVGUZTime();
        }
        $player->DoAction($action, $minutes);
      }
    
      if($action->GetItem() != 0)
      {
        $statstype = 0;
        $upgrade = 0;
        $amount = 1;
        $player->RemoveItemsByID($action->GetItem(), $action->GetItem(), $statstype, $upgrade, $amount);
      }
    }
  }
  
  
}
?>