<?php
include_once $_SERVER['DOCUMENT_ROOT'].'../../main/www/classes/session.php';
include_once '../../../classes/header.php';
include_once '../../../classes/items/itemmanager.php';
include_once '../../../classes/bbcode/bbcode.php';
$itemManager = new ItemManager($database);

$inventory = $player->GetInventory();
$item = null;
if(isset($_GET['id']) && is_numeric($_GET['id']))
{
  $item = $inventory->GetItem($_GET['id']);
  if($item == null)
  {
    exit();
  }
}
else
{
  exit();
}


if($item->IsEquipped())
{
  exit();
}

$slotItem = null;
if(isset($_GET['slot']) && is_numeric($_GET['slot']))
{
  $slotItem = $inventory->GetItemAtSlot($_GET['slot']);
  if($slotItem == null)
  {
    exit();
  }
}
else
{
  exit();
}

if(!$slotItem->IsEquipped())
{
  exit();
}

if($item->GetSlot() != $slotItem->GetSlot())
{
  exit();
}
?>
<div class="spacer"></div>
<table width="100%" cellspacing="0">
  <tr>
  <td width="2%"></td>
  <td align="center" width="38%" class="catGradient borderT borderR borderL"><b>Angelegtes Item</b></td>
  <td width="10%"></td>
  <td align="center" width="38%" class="catGradient borderT borderR borderL"><b>Anzulegendes Item</b></td>
  <td width="2%"></td>
  </tr>
  <tr>
  <td></td>
    <td align="center" class="borderL borderR">
      <?php echo $slotItem->GetName(); ?>
      <div class="spacer"></div>
      <img class="boxSchatten borderT borderR borderL borderB" src="img/items/<?php echo $slotItem->GetImage(); ?>.png" style="width:80px;height:80px;"></img>
      <?php echo $bbcode->parse($slotItem->GetDescription()); ?>
      <?php echo $slotItem->DisplayEffect(); ?>
      
    </td>
    <td></td>
    <td align="center" class="borderL borderR">
      <?php echo $item->GetName(); ?>
      <div class="spacer"></div>
      <img class="boxSchatten borderT borderR borderL borderB" src="img/items/<?php echo $item->GetImage(); ?>.png" style="width:80px;height:80px;"></img>
      <?php echo $bbcode->parse($item->GetDescription()); ?>
      <?php echo $item->DisplayEffect(); ?>
    </td>
  <td></td>
  </tr>
  <tr>
    <td></td>
    <td class="borderL borderR borderB"></td>
    <td></td>
    <td class="borderL borderR borderB"></td>
    <td></td>
  </tr>
</table>
<div class="spacer"></div>
				<form method="POST" action="?p=ausruestung&a=equip">
				<input type="hidden" name="item" value="<?php echo $_GET['id']; ?>">
				<input type="hidden" name="slot" value="<?php echo $_GET['slot']; ?>">
				<input type="submit" value="Anlegen">
				</form>
<div class="spacer2"></div>