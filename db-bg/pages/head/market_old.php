<?php
include_once 'classes/places/place.php';
include_once 'classes/items/itemmanager.php';
include_once 'classes/market/market.php';
include_once 'classes/bbcode/bbcode.php';
$itemManager = new ItemManager($database);
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
    $item = $market->GetItem($_POST['id']);
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
		  $itemData = $itemManager->GetItem($item->GetItemID());
      
      $player->AddItems($itemData, $amount);
      $market->TakeItem($_POST['id'], $amount);
      
      $message = 'Du hast '.$amount.'x '.utf8_encode($itemData->GetName()).' zurückgenommen.';
    }
  }
  
}
else if(isset($_GET['a']) && $_GET['a'] == 'buy')
{
	if(isset($_POST['buy']))
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
    $item = $market->GetItem($_POST['id']);
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
		  $itemData = $itemManager->GetItem($item->GetItemID());
      $price = $item->GetPrice() * $amount;
      $player->BuyItemFrom($itemData, $amount, $price, $item->GetSellerID());
      $market->TakeItem($_POST['id'], $amount);

			$PMManager = new PMManager($database, $player->GetID());
			$text = "<img src='img/items/".$itemData->GetImage().".png' width='80px' height='80px'></img> Du hast ".$amount."x ".$itemData->GetName().' für '.$price.' an '.$player->GetName().' verkauft.';		
			$PMManager->SendPM(0, 'img/money.png', 'SYSTEM', $itemData->GetName().' wurde verkauft.', $text, $item->GetSeller(), 1);
      
      $message = 'Du hast '.$amount.'x '.utf8_encode($itemData->GetName()).' von '.$item->GetSeller().' gekauft.';
    }
  }
  
}
else if(isset($_POST['delete']))
{
$item = $market->GetItem($_POST['id']);
$message = "Du hast das Item aus dem Marktplatz entfernt. Dem User Wurde eine Nachricht gesendet.";	
$PMManager = new PMManager($database, $player->GetID());
$text = "<center>Ein Item Wurde aus dem Marktplatz entfernt.<br> Dein Item wurde nicht zurückerstattet.<br> Grund: überteuerter Preis oder Marktplatz Spam.</center>";		
$PMManager->SendPM(0, 'img/money.png', 'SYSTEM','Ein Item auf dem MP wurde entfernt!', $text, $item->GetSeller(), 1);
$result = $database->Delete('market','id = "'.$item->GetID().'"',1);
      
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
		$inventory = $player->GetInventory();
		$itemData = $itemManager->GetItem($itemID);
		if($itemData == null)
		{
			$message = 'Das Item gibt es nicht.';
		}
		else
		{
			$i = 0;
			$item = $inventory->GetItem($i);
			$inventoryAmount = 0;
			while(isset($item))
			{
				if($item->GetSlot() == null && $item->GetID() == $itemID)
				{
					$inventoryAmount += $item->GetAmount();
				}
				++$i;
				$item = $inventory->GetItem($i);
			}
			if(!$itemData->IsSellable())
			{
				$message = 'Das Item kann nicht verkauft werden.';
			}
			else if($price < $itemData->GetPrice()/2)
			{
				$message = 'Der Preis ('.$price.') darf nicht geringer sein als die Hälfte ('.($itemData->GetPrice()/2).').';				
			}
			else if($price > $itemData->GetPrice()*2)
			{
				$message = 'Der Preis darf nicht höher sein als das Doppelte.';				
			}
			else if($market->HasItemInside($itemID, $player->GetID()))
			{
				$message = 'Du hast so ein Item schon eingestellt.';				
			}
			else if($inventoryAmount < $amount)
			{
				$message = 'Du besitzt nicht genügend davon.';
			}
			else
			{
				$player->RemoveItems($itemData, $amount);
        $market->AddItem($itemData, $amount, $price, $player);
        
				$message = 'Du hast '.$amount.'x '.$itemData->GetName().' für '.$price.' Zeni im Marktplatz gestellt.';
			}
		}
		
	}
}
?>