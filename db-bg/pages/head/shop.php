<?php
include_once 'classes/places/place.php';
include_once 'classes/items/itemmanager.php';
include_once 'classes/bbcode/bbcode.php';
$itemManager = new ItemManager($database);
$place = new Place($database, $player->GetPlace(),$player->GetPlanet(), $actionManager);

if(isset($_GET['a']) && $_GET['a'] == 'buy')
{
  if(!isset($_POST['item']) || !is_numeric($_POST['item']))
  {
    $message = 'Das Item ist ungültig.';
  }
  if(!isset($_POST['amount']) || !is_numeric($_POST['amount'])|| floor($_POST['amount']) <= 0)
  {
    $message = 'Die Anzahl ist ungültig.';
  } else if($player->GetFight() != 0) {
    $message = 'Du bist in einem Kampf und kannst das Item nicht kaufen.';
  }
  else
  {
    $items = $place->GetItems();
    $i = 0;
    $item = null;
    $amount = floor($_POST['amount']);
    while(isset($items[$i]))
    {
      $idItem = $itemManager->GetItem($items[$i]);
      if($idItem->GetID() == $_POST['item'])
      {
        $item = $idItem;
        $price = $item->GetPrice() * $amount;
        break;
      }
      ++$i;
    }
    
    if($item == null)
    {
      $message = 'Das Item gibt es an diesen Ort nicht.';
    }
    else if($player->GetZeni() < $price)
    {
      $message = 'Du hast nicht genügend Zeni.';
    }
    else if($item->GetNeedItem() != 0 && !$player->HasItem2($item->GetNeedItem()))
    {
      $message = 'Du benötigst ein besonderes Item.';
    }
	  else
	  {
       $statstype = $item->GetDefaultStatsType();
       $upgrade = 0;
		   $player->BuyItem($item, $item, $statstype, $upgrade, $amount, $price);
		   $message = 'Du hast '.$amount.'x '.$item->GetName().' gekauft.';
	  }
  }
  
}
?>