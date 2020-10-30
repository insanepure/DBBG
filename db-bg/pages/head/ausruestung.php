<?php
include_once 'classes/bbcode/bbcode.php';
include_once 'classes/clan/clan.php';
$inventory = $player->GetInventory();

if(isset($_GET['a']) && $_GET['a'] == 'combine')
{
  if(!isset($_POST['visualitem']) || !is_numeric($_POST['visualitem']))
  {
    $message = 'Diese ID ist ungültig.';
  }
  else if(!isset($_POST['statsitem']) || !is_numeric($_POST['statsitem']))
  {
    $message = 'Diese ID ist ungültig.';
  }
  else
  {
    $visualid = $_POST['visualitem'];
    $statsid = $_POST['statsitem'];
    $visualitem = $inventory->GetItem($visualid);
    $statsitem = $inventory->GetItem($statsid);
    if($visualitem == null)
    {
      $message = 'Das visuelle Item ist ungültig.';
    }
    else if($statsitem == null)
    {
      $message = 'Das stats Item ist ungültig.';
    }
    else if($visualitem->IsEquipped() || $statsitem->IsEquipped())
    {
      $message = 'Ein ausgerüstet Item kannst du nicht kombinieren.';
    }
    else if($visualitem->GetSlot() != $statsitem->GetSlot())
    {
      $message = 'Die Items müssen am selben Slot ausgerüstet werden können-';
    }
    else if($visualitem->GetRace() != '' || $statsitem->GetRace() != '')
    {
      $message = 'Rassenitems können nicht kombiniert werden.';
    }
    else if($visualitem->GetRace() != '' || $statsitem->GetRace() != '')
    {
      $message = 'Rassenitems können nicht kombiniert werden.';
    }
    else if($visualitem->GetType() != 3 && $visualitem->GetType() != 4 || $statsitem->GetType() != 3 && $statsitem->GetType() != 4)
    {
      $message = 'Die Items sind keine ausrüstbare Items.';
    }
    else
    {
      $player->CombineItems($statsitem, $visualitem);
      $message = 'Du hast zwei Items kombiniert.';
    }
  }
  
}
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
    else if($item->IsEquipped())
    {
      $message = 'Ein ausgerüstet Item kannst du nicht verkaufen.';
    }
    else
    {
      if(!$item->IsSellable())
      {
      $message = 'Das Item kann man nicht verkaufen.';
      }
      else
      {
        $player->SellItem($id, 1);
        $message = 'Du hast '.$item->GetName().' 1x verkauft.';
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
		
		if($player->GetFight() != 0)
		{
			$message = 'Du kannst während des Kampfes nichts anlegen.';
		}
		else if($player->GetAction() != 0 && $item->GetTrainbonus() > 0)
		{
			$message = 'Du kannst dies während einer Reise oder Training nicht anlegen.';
		}
		else if($item->GetLevel() > $player->GetLevel())
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
				if($item->GetSlot() == 0)
				{
					$message = 'Du kannst dieses Item nirgendwo anlegen.';
				}
				else if($item->GetRace() != '' && $item->GetRace() != $player->GetRace())
				{
					$message = 'Du hast nicht die richtige Rasse für das Item.';
				}
				else if($item->GetType() != 3 && $item->GetType() != 4)
				{
					$message = 'Du kannst dieses Item nicht ausrüsten.';
				}
				else
				{
					$player->EquipItem($item);
					$message = 'Du hast '.$item->GetName().'  ausgerüstet.';
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
			if($player->GetAction() != 0 && $item->GetTrainbonus() > 0) {
				$message = 'Du kannst dies während einer Reise oder Training nicht ablegen.';
			} 
      else 
			{
				$player->UnequipItem($item);
				$message = 'Du hast '.$item->GetName().'  abgelegt.';
			}
		}
  }
}

function ShowSlotEquippedImage($slot, $inventory, $zindex)
{
  $item = $inventory->GetItemAtSlot($slot);
  if($item != null)
  {
		?> 
		<div class="char2" style="z-index:<?php echo $zindex; ?>; background-image:url('img/ausruestung/<?php echo $item->GetEquippedImage(); ?>.png')"></div>
		<?php
  }
}

function ShowSlot($slot, $inventory)
{
  $item = $inventory->GetItemAtSlot($slot);
  if($item != null)
  {
    ?>
    <?php echo $item->GetName(); ?>
    <div class="spacer"></div>
    <img class="boxSchatten borderT borderR borderL borderB" src="/img/items/<?php echo $item->GetImage(); ?>.png" style="width:50px;height:50px;"></img>
				<form method="POST" action="?p=ausruestung&a=unequip">
				<input type="hidden" name="slot" value="<?php echo $slot; ?>">
				<input type="hidden" name="item" value="<?php echo $item->GetID(); ?>">
				<input type="submit" value="Ablegen">
				</form>
    <?php
  }
}
?>