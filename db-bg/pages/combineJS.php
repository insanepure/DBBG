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
  <div style="width:80px; height:80px; position:relative; top:0px; left:0px;">
  <?php if($item->HasOverlay())
  {
    ?>
      <img src="img/items/<?php echo $item->GetOverlay(); ?>.png" style="width:80px; height:80px; left:0px; top:0px; position:absolute; z-index:1;"></img><br/> 
    <?php
  }
  ?>
  <img src="img/items/<?php echo $item->GetImage(); ?>.png" style="width:80px; height:80px; left:0px; top:0px; position:absolute; z-index:0;"></img><br/> 
  </div>
  <div class="spacer"></div>
  <?php echo $item->DisplayEffect(); ?>
  <?php
}
?>