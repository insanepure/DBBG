<?php
include_once $_SERVER['DOCUMENT_ROOT'].'../../main/www/classes/session.php';
include_once '../../../classes/header.php';
include_once '../../../classes/items/itemmanager.php';
include_once '../../../classes/market/market.php';
$itemManager = new ItemManager($database);
$market = new Market($database);

if(!isset($_GET['item']) || !is_numeric($_GET['item']))
  exit();

$item = $market->GetItemByID($_GET['item']);
if($item == null)
  exit();

if($item->GetSellerID() != $player->GetID())
  exit();

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
echo '<b>'.$item->GetName().'</b><br/>'; 
echo $item->GetDescription();
?>
<hr>
<div class="spacer"></div>
    <?php
    echo $item->DisplayEffect();
      if($item->GetLevel() != 0) echo 'Benötigt Level '.$item->GetLevel().'<br/>'; 
    ?>
<hr>
<div class="spacer"></div>
Verkäufer: <a href="?p=profil&id=<?php echo $item->GetSellerID(); ?>"><?php echo $item->GetSeller(); ?></a>
<hr>
<div class="spacer"></div>

<form method="POST" action="?p=market&a=retake<?php if(isset($_GET['itemname'])) echo '&itemname='.$_GET['itemname']; if(isset($_GET['itemcategory'])) echo '&itemcategory='.$_GET['itemcategory']; ?>">
  <input type="hidden" name="id" value="<?php echo $_GET['item']; ?>">
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
<div class="spacer"></div>