<?php
include_once $_SERVER['DOCUMENT_ROOT'].'../../main/www/classes/session.php';
include_once '../classes/header.php';

$inventory = $player->GetInventory();
if(isset($_GET['id']) && is_numeric($_GET['id']))
{
  $item = $inventory->GetItem($_GET['id']);
  ?>
  <?php echo $item->GetName(); ?>
  <div class="spacer"></div>
  <img class="boxSchatten borderT borderR borderL borderB" src="../img/items/<?php echo $item->GetImage(); ?>.png" style="width:80px;height:80px;"></img>
  <div class="spacer"></div>
  <?php echo $item->DisplayEffect(); ?>
  <?php
}
?>