<?php
include_once $_SERVER['DOCUMENT_ROOT'].'../../main/www/classes/session.php';
include_once '../../../classes/header.php';
include_once '../../../classes/items/itemmanager.php';
$itemManager = new ItemManager($database);
$items = explode(';',$player->GetNPCWonItems());
?>Du hast <?php
$i = 0;
while(isset($items[$i]))
{
  $item = explode('@',$items[$i]);
	$itemData = $itemManager->GetItem($item[0]);
  $itemData->SetDefaultStatsType($item[2]);
	if($i != 0) 
    echo ', ';
	echo $item[1]; ?>x <?php echo $itemData->GetName(); ?> <?php
	++$i;
}
?> gewonnen!
<br/>
<br/>
<form method="POST" action="?p=profil&a=acceptitem">
  <input type="submit" value="Annehmen">
</form>