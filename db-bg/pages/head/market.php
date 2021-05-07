<?php
include_once 'classes/places/place.php';
include_once 'classes/items/itemmanager.php';
include_once 'classes/market/market.php';
include_once 'classes/bbcode/bbcode.php';
$market = new Market($database);
$inventory = $player->GetInventory();

if(isset($_GET['a']) && $_GET['a'] == 'retake')
{
  if(!isset($_POST['id']) || !is_numeric($_POST['id']))
  {
    $message = 'Das Item ist ungültig.';
  }
  if(!isset($_POST['amount']) || !is_numeric($_POST['amount'])|| floor($_POST['amount']) <= 0)
  {
    $message = 'Die Anzahl ist ungültig.';
  }
  else
  {
    $item = $market->GetItemByID($_POST['id']);
    $amount = floor($_POST['amount']);
    if($item == null)
    {
      $message = 'Das Item gibt es nicht auf dem Markt.';
    }
    else if($item->GetSellerID() != $player->GetID())
    {
      $message = 'Das item gehört dir nicht.';
    }
    else if($amount > $item->GetAmount())
    {
      $message = 'Soviele Items werden im Markt nicht angeboten.';
    }
    else
    {
      $itemManager = new ItemManager($database);
      $statsItem = $itemManager->GetItem($item->GetStatsID());
      $visualItem = $itemManager->GetItem($item->GetVisualID());
      $player->AddItems($statsItem, $visualItem, $amount, $item->GetStatsType(), $item->GetUpgrade());
      $market->TakeItem($_POST['id'], $amount);
      
      $message = 'Du hast '.$amount.'x '.$item->GetName().' zurückgenommen.';
    }
  }
  
}
else if(isset($_GET['a']) && $_GET['a'] == 'buy')
{
	if($player->GetLevel() < 4)
	{
		$message = 'Du kannst erst mit Level 5 etwas im Markt kaufen.';
	}
  else if(!isset($_POST['id']) || !is_numeric($_POST['id']))
  {
    $message = 'Das Item ist ungültig.';
  }
  else if(!isset($_POST['amount']) || !is_numeric($_POST['amount'])|| floor($_POST['amount']) <= 0)
  {
    $message = 'Die Anzahl ist ungültig.';
  } else if($player->GetFight() != 0) {
    $message = 'Du bist in einem Kampf und kannst das Item nicht kaufen.';
  }
  else
  {
    $amount = floor($_POST['amount']);
    $item = $market->GetItemByID($_POST['id']);
    if($item == null)
    {
      $message = 'Das Item gibt es nicht auf dem Markt.';
    }
    else if($player->GetZeni() < $item->GetPrice() * $amount)
    {
      $message = 'Du hast nicht genügend Zeni.';
    }
    else if($amount > $item->GetAmount())
    {
      $message = 'Soviele Items werden im Markt nicht angeboten.';
    }
    else if($item->GetSellerID() == $player->GetID())
    {
      $message = 'Du kannst dir nichts selber verkaufen.';
    }
    else
    {
      $itemManager = new ItemManager($database);
      $price = $item->GetPrice() * $amount;
      $statstype = $item->GetStatsType();
      $upgrade = $item->GetUpgrade();
      $player->BuyItemFrom($itemManager->GetItem($item->GetStatsID()), $itemManager->GetItem($item->GetVisualID()), $statstype, $upgrade, $amount, $price, $item->GetSellerID());
      $market->TakeItem($_POST['id'], $amount);

			$PMManager = new PMManager($database, $player->GetID());
			$text = "<img src='img/items/".$item->GetImage().".png' width='80px' height='80px'></img> Du hast ".$amount."x ".$item->GetName().' für '.$price.' an '.$player->GetName().' verkauft.';		
			$PMManager->SendPM(0, 'img/money.png', 'SYSTEM', $item->GetName().' wurde verkauft.', $text, $item->GetSeller(), 1);
    
      $charaids = array();
      array_push($charaids, $player->GetID());
      array_push($charaids, $item->GetSellerID());
      LoginTracker::AddInteraction($accountDB, $charaids, 'Marktkauf', 'dbbg');
      
      $message = 'Du hast '.$amount.'x '.utf8_encode($item->GetName()).' von '.$item->GetSeller().' gekauft.';
    }
  }
  
}
else if(isset($_GET['a']) && $_GET['a'] == 'sell')
{
	if($player->GetLevel() < 4)
	{
		$message = 'Du kannst erst mit Level 4 etwas im Markt verkaufen.';
	}
	else if(!isset($_POST['item']) || !is_numeric($_POST['item']))
	{
		$message = 'Das Item ist ungültig.';
	}
	else if(!isset($_POST['amount']) || !is_numeric($_POST['amount']) || floor($_POST['amount']) <= 0)
	{
		$message = 'Die Anzahl ist ungültig.';
	}
	else if(!isset($_POST['price']) || !is_numeric($_POST['price']) || floor($_POST['price']) <= 0)
	{
		$message = 'Der Preis ist ungültig.';
	}
	else
	{
		$itemID = $_POST['item'];
		$amount = floor($_POST['amount']);
		$price = floor($_POST['price']);
    $item = $inventory->GetItem($itemID);
    $itemPrice = $item->GetPrice();
		if($item == null)
		{
			$message = 'Das Item gibt es nicht.';
		}
		else
		{
			$i = 0;
			if(!$item->IsMarketSellable())
			{
				$message = 'Das Item kann nicht auf den Markt verkauft werden.';
			}
      else if($item->IsEquipped())
      {
        $message = 'Ein ausgerüstet Item kannst du nicht verkaufen.';
      }
			else if($item->GetAmount() < $amount)
			{
				$message = 'Du besitzt nicht genügend davon.';
			}
			else if($market->HasItemInside($item->GetStatsID(), $item->GetVisualID(), $item->GetStatsType(), $item->GetUpgrade(), $player->GetID()))
			{
				$message = 'Du hast so ein Item schom im Markt.';
			}
			else
			{
				$player->RemoveItems($itemID, $amount);
        $market->AddItem($item->GetStatsID(), $item->GetVisualID(), $item->GetStatsType(), $item->GetUpgrade(), $amount, $price, $player);
        
				$message = 'Du hast '.$amount.'x '.$item->GetName().' für '.$price.' Zeni im Marktplatz gestellt.';
			}
		}
		
	}
}
?>