<?php
include_once 'classes/bbcode/bbcode.php';
$inventory = $player->GetInventory();

if(isset($_GET['a']) && $_GET['a'] == 'use')
{
  if(!isset($_POST['id']) || !is_numeric($_POST['id']))
  {
    $message = 'Diese ID ist ungültig.';
  }
  else if($player->GetFight() != 0)
  {
    $message = 'Im Kampf kannst du das Item nicht nutzen.';
  }
  else if($player->GetTournament() != 0)
  {
    $message = 'Im Turnier kannst du das Item nicht nutzen.';
  }
  else
  {
    $id = $_POST['id'];
    $item = $inventory->GetItem($id);
    if($item == null)
    {
      $message = 'Du besitzt dieses Item nicht.';
    }
		else if(!isset($_POST['amount']) || $_POST['amount'] <= 0 || $_POST['amount'] > $item->GetAmount())
		{
			$message = 'Die Anzahl ist ungültig.';
		}
    else
    {
			if($item->GetType() != 5 && ($item->GetType() == 1 || $item->GetType() == 2 || $item->GetType() == 6))
			{
        if(isset($_POST['item']))
        {
          if(!is_numeric($_POST['item']))
            $message = 'Das Item auf den du es anwenden willst existiert nicht.';
          else
          {
            $onItem = $inventory->GetItemByDatabaseID($_POST['item']);
            if($onItem == null)
              $message = 'Das Item auf den du es anwenden willst existiert nicht.';
            else if($item->GetStatsID() == 184 && !$onItem->CanChangeType())
              $message = 'Du kannst den Typ von diesen Item nicht ändern.';
            else if($item->GetStatsID() == 185 && !$onItem->CanUpgrade())
              $message = 'Du kannst den Level von diesen Item nicht ändern.';
            else if(($item->GetStatsID() == 184 || $item->GetStatsID() == 185) && ($onItem->GetType() != 3 && $onItem->GetType() != 4 || $onItem->IsEquipped() ))
              $message = 'Das Item auf den du es anwenden willst ist ungültig.';
            else
				      $player->UseItem2($id, $_POST['amount'], $_POST['item']);
          }
        }
        else
				  $player->UseItem2($id, $_POST['amount']);
				$message = 'Du hast '.$_POST['amount'].'x '.$item->GetName().' benutzt.';
			}
    }
    
  }
}
else if(isset($_GET['a']) && $_GET['a'] == 'sell')
{
  if(!isset($_POST['id']) || !is_numeric($_POST['id']))
  {
    $message = 'Diese ID ist ungültig.';
  }
  else if($player->GetFight() != 0)
  {
    $message = 'Im Kampf kannst du das Item nicht verkaufen.';
  }
  else if($player->GetTournament() != 0)
  {
    $message = 'Im Turnier kannst du das Item nicht verkaufen.';
  }
  else
  {
    $id = $_POST['id'];
    $item = $inventory->GetItem($id);
    if($item == null)
    {
      $message = 'Du besitzt dieses Item nicht.';
    }
    else if($item->IsEquipped())
    {
      $message = 'Ein ausgerüstet Item kannst du nicht verkaufen.';
    }
    else if(!isset($_POST['amount']) || $_POST['amount'] <= 0 || $_POST['amount'] > $item->GetAmount())
    {
      $message = 'Die Anzahl ist ungültig.';
    }
    else
    {
      $player->SellItem($id, $_POST['amount']);
	    $message = 'Du hast '.$_POST['amount'].'x '.$item->GetName().' verkauft.';
    }
    
  }
}
?>