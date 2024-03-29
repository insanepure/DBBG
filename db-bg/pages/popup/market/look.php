<?php
include_once $_SERVER['DOCUMENT_ROOT'].'../../main/www/classes/session.php';
include_once '../../../classes/header.php';
include_once '../../../classes/items/itemmanager.php';
include_once '../../../classes/market/market.php';
$itemManager = new ItemManager($database);
$market = new Market($database);

if(!isset($_GET['item']) || !is_numeric($_GET['item']))
  exit();

$items = $market->GetItemsByStatsID($_GET['item']);
if(empty($items))
  exit();

$item = $items[0];
?>
<div style="width:100px; height:100px; position:relative; top:0px; left:0px;">
  <?php if($item->HasOverlay())
  {
    ?>
<img src="img/items/<?php echo $item->GetOverlay(); ?>.png" style="left:0px; top:0px; position:absolute; z-index:1;"></img><br/> 
    <?php
  }
  ?>
<img src="img/items/<?php echo $item->GetImage(); ?>.png" style="left:0px; top:0px; position:absolute; z-index:0;"></img><br/> 
  </div>
<br/>
<?php 
echo '<b>'.$item->GetOriginalName().'</b><br/>'; 
echo $item->GetDescription();
?>
<?php
foreach($items as &$item)
{
?>
<hr>
<div class="spacer"></div>
<?php 
echo 'Preis: <b>'.$item->GetPrice().' Zeni</b>'; 
?>
<div class="spacer"></div>
    <?php
    echo $item->DisplayEffect();
      if($item->GetLevel() != 0) echo 'Benötigt Level '.$item->GetLevel().'<br/>'; 
    ?>
<div class="spacer"></div>
Verkäufer: <a href="?p=profil&id=<?php echo $item->GetSellerID(); ?>"><?php echo $item->GetSeller(); ?></a>
<div class="spacer"></div>

<?php

if($item->GetSellerID() == $player->GetID())
{
  ?>
<form method="POST" action="?p=market&a=retake<?php if(isset($_GET['itemname'])) echo '&itemname='.$_GET['itemname']; if(isset($_GET['itemcategory'])) echo '&itemcategory='.$_GET['itemcategory']; ?>">
  <input type="hidden" name="id" value="<?php echo $item->GetID(); ?>">
  Anzahl: <select style="width:100px" class="select" name="amount">
    <?php
    $j = 1;
    $amount = $item->GetAmount();
    while($j <= $amount)
    {
    ?>
    <option value="<?php echo $j; ?>"><?php echo $j; ?></option>
    <?php
    ++$j;
    }
    ?>
  </select>
  <div class="spacer"></div>
	<input style="width:100px" type="submit" value="Nehmen">
</form>
  <?php
}
else
{
  ?>
<form method="POST" action="?p=market&a=buy<?php if(isset($_GET['itemname'])) echo '&itemname='.$_GET['itemname']; if(isset($_GET['itemcategory'])) echo '&itemcategory='.$_GET['itemcategory']; ?>">
  <input type="hidden" name="id" value="<?php echo $item->GetID(); ?>">
  Anzahl: <select style="width:100px" class="select" name="amount">
    <?php
    $j = 1;
    $amount = $item->GetAmount();
    while($j <= $amount)
    {
    ?>
    <option value="<?php echo $j; ?>"><?php echo $j; ?></option>
    <?php
    ++$j;
    }
    ?>
  </select>
  <div class="spacer"></div>
	<input style="width:100px" type="submit" value="Kaufen">
</form>
  <?php
}
?>
<?php
}
?>
<div class="spacer"></div>