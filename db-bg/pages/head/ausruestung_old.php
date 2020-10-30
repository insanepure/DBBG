<?php
include_once 'classes/items/itemmanager.php';
include_once 'classes/bbcode/bbcode.php';
include_once 'classes/clan/clan.php';
$itemManager = new ItemManager($database);
$inventory = $player->GetInventory();
if(isset($_GET['a']) && $_GET['a'] == 'sell')
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
    else if($item->GetSlot() != null)
    {
      $message = 'Ein ausgerüstet Item kannst du nicht verkaufen.';
    }
    else
    {
			$itemData = $itemManager->GetItem($item->GetID());
      if(!$itemData->IsSellable())
      {
      $message = 'Das Item kann man nicht verkaufen.';
      }
      else
      {
        $player->SellItem($id, $itemData);
        $message = 'Du hast '.$itemData->GetName().' 1x verkauft.';
      }
    }
    
  }
}
else if(isset($_GET['a']) && $_GET['a'] == 'equip')
{
  if(!isset($_POST['item']) || !is_numeric($_POST['item']))
  {
    $message = 'Dieses Item ist ungültig.';
  } else {
		$id = $_POST['item'];
    $item = $inventory->GetItem($id);
		$itemData = $itemManager->GetItem($item->GetID());
		
		if($player->GetFight() != 0)
		{
			$message = 'Du kannst während des Kampfes nichts anlegen.';
		}
		else if($player->GetAction() != 0 && $itemData->GetTrainbonus() > 0)
		{
			$message = 'Du kannst dies während einer Reise oder Training nicht anlegen.';
		}
		else if($itemData->GetLevel() > $player->GetLevel())
		{
			$message = 'Dein Level is zu niedrig.';
		}
		else if($player->GetTournament() != 0)
		{
			$message = 'Du kannst während des Turnieres nichts anlegen.';
		}
		else
		{
			if($item == null)
			{
				$message = 'Du bestitzt dieses Item nicht.';
			}
			else
			{
				if($itemData->GetSlot() == 0)
				{
					$message = 'Du kannst dieses Item nirgendwo anlegen.';
				}
				else if($itemData->GetRace() != '' && $itemData->GetRace() != $player->GetRace())
				{
					$message = 'Du hast nicht die richtige Rasse für das Item.';
				}
				else if($itemData->GetType() != 3 && $itemData->GetType() != 4)
				{
					$message = 'Du kannst dieses Item nicht ausrüsten.';
				}
				else
				{
					$slotItem = $inventory->GetItemAtSlot($itemData->GetSlot());
					$slotItemData = null;
					if($slotItem != null)
					{
						$slotItemData = $itemManager->GetItem($slotItem->GetID());
					}
					$player->EquipItem($id, $itemData, $slotItemData);
					$message = 'Du hast '.$itemData->GetName().'  ausgerüstet.';
				}
			}
		}
	}
}
else if(isset($_GET['a']) && $_GET['a'] == 'unequip')
{
  if(!isset($_POST['slot']) || !is_numeric($_POST['slot']))
  {
    $message = 'Dieses Slot ist ungültig.';
  }
  else if($player->GetFight() != 0)
  {
    $message = 'Du kannst während des Kampfes nichts ablegen.';
  }
  else if($player->GetTournament() != 0)
  {
    $message = 'Du kannst während des Turnieres nichts ablegen.';
  }
  else
  {
    $slot = $_POST['slot'];
    $item = $inventory->GetItemAtSlot($slot);
    if($item == null)
    {
      $message = 'Dort befindet sich kein Item.';
    }
    else
    {
      $itemData = $itemManager->GetItem($item->GetID());
			if($player->GetAction() != 0 && $itemData->GetTrainbonus() > 0) {
				$message = 'Du kannst dies während einer Reise oder Training nicht ablegen.';
			} 
      else 
			{
				$player->UnequipItem($slot, $itemData);
				$message = 'Du hast '.$itemData->GetName().'  abgelegt.';
			}
		}
  }
}

function ShowSlotEquippedImage($slot, $inventory, $itemManager, $zindex)
{
  $item = $inventory->GetItemAtSlot($slot);
  if($item != null)
  {
    $itemData = $itemManager->GetItem($item->GetID());
		if($itemData == null)
		{
			echo 'Item im Slot nicht gefunden.';
			return;
		}
		?> 
		<div class="char2" style="z-index:<?php echo $zindex; ?>; background-image:url('img/ausruestung/<?php echo $itemData->GetEquippedImage(); ?>.png')"></div>
		<?php
  }
}

function ShowSlot($slot, $inventory, $itemManager)
{
  $item = $inventory->GetItemAtSlot($slot);
  if($item != null)
  {
    $itemData = $itemManager->GetItem($item->GetID());
		if($itemData == null)
		{
			echo 'Item im Slot nicht gefunden.';
			return;
		}
    ?>
    <?php echo $itemData->GetName(); ?>
    <div class="spacer"></div>
    <img class="boxSchatten borderT borderR borderL borderB" src="/img/items/<?php echo $itemData->GetImage(); ?>.png" style="width:50px;height:50px;"></img>
				<form method="POST" action="?p=ausruestung&a=unequip">
				<input type="hidden" name="slot" value="<?php echo $slot; ?>">
				<input type="hidden" name="item" value="<?php echo $itemData->GetID(); ?>">
				<input type="submit" value="Ablegen">
				</form>
    <?php
  }
}
?>