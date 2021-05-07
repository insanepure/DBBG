<?php
if(!$player->HasRadar() && !$player->HasAllDBs())
{
	header('Location: index.php');
	exit();  
}
include_once 'classes/radar/radar.php';
include_once 'classes/items/itemmanager.php';
include_once 'classes/wish/wishmanager.php';

$wishManager = new WishManager($database);
$itemManager = new ItemManager($database);
$planet = new Planet($database, $player->GetPlanet());
$radar = new Radar($database, $player);

$dragon = $planet->GetDragon();
$wishNum = $planet->GetWishNum();
$wishLeft = 0;
$wishes = $planet->GetWishes();

$dbCount = $radar->GetDBCount();
$drops = array();

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
    $wishLeft = $db->GetWishLeft();
	}
}

if(!$player->HasAllDBs() && count($drops) != 7)
{
	header('Location: ?p=radar');
	exit();  
}

if($player->HasAllDBs())
  $wishLeft += 1;

if(isset($_GET['a']) && $_GET['a'] == 'wish')
{
  
  if(!isset($_POST['wish']) || !is_numeric($_POST['wish']))
  {
    $message = 'Du hast keinen gültigen Wunsch gewählt.';
  }
  else if(!in_array($_POST['wish'], $wishes))
  {   
    $message = 'Du kannst dir das hier nicht wünschen.';
  }
  else if($wishLeft <= 0)
  {
    $message = 'Du hast keinen Wunsch mehr mehr frei.';
  }
  else if($player->GetFight() != 0)
  {
    $message = 'Du kannst dir während eines Kampfes nichts wünschen.';
  }
  else
  {
    $wishID = $_POST['wish'];
    $wish = $wishManager->GetWish($wishID);
    
    if($player->HasWish($wishID) && !$wish->isRewishable())
    {
      $message = 'Du hast diesen Wunsch schon gewünscht!';
    }
    else
    {
      $type = $wish->GetType();
      if($type == 0) // Zeni
      {
          $player->AddZeni($wish->GetValue());
          $wished = true;
      }
      else if($type == 1) // Stats
      {
          $player->AddStats($wish->GetValue());
          $wished = true;
      }
      else if($type == 2) // Stats Reset
      {
          $player->ResetStats();
          $wished = true;
      }
      else if($type == 3) // Skills Reset
      {
          $player->ResetSkills();
          $wished = true;
      }
      else if($type == 4) // Items
      {
          $items = explode(';', $wish->GetItems());
          foreach($items as &$itemDataArray)
          {
            $itemData = explode('@',$itemDataArray);
            $itemID = $itemData[0];
            $itemAmount = $itemData[1];
            $item = $itemManager->GetItem($itemID);
		        $player->BuyItem($item, $item, 0, 0, $itemAmount, 0);
          }
          $wished = true;
      }
      
      if($wished)
      {
        $titelManager = new titelManager($database);
        $titelManager->AddTitelWish($player, $wishID);
        
        $message = 'Dein Wunsch wurde gewährt.';
        $wishLeft = $wishLeft-1;
        
        if(count($drops) == 7)
        {
          if($wishLeft == 0)
          {
            $radar->EndWish($wishNum);
          }
          else
          {
            $radar->Wished();
          }
          $player->UpdateWish($wishID, 12); // Block for 12 wishes
        }
        else if($player->HasAllDBs())
        {
          $dbID = 150;
          $statstype = 0;
          $upgrade = 0;
          $amount = 1;
          $player->RemoveItemsByID($dbID, $dbID, $statstype, $upgrade, $amount);
          $player->UpdateWish($wishID, $player->GetWishCounter());
        }
      }
    }
  }
  
}

?>