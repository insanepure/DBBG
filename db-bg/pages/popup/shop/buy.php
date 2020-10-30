<?php
include_once $_SERVER['DOCUMENT_ROOT'].'../../main/www/classes/session.php';
include_once '../../../classes/header.php';
include_once '../../../classes/items/itemmanager.php';
$itemManager = new ItemManager($database);

if(!isset($_GET['item']) || !is_numeric($_GET['item']))
  exit();

$item = $itemManager->GetItem($_GET['item']);
if($item == null)
  exit();



?>
<img src="img/items/<?php echo $item->GetImage(); ?>.png"></img><br/>
<?php 
echo '<b>'.$item->GetName().'</b><br/>'; 
echo $item->GetDescription();
?>
<hr>
<div class="spacer"></div>
<?php 
echo 'Preis: <b>'.$item->GetPrice().' Zeni</b>'; 
?>
<hr>
<div class="spacer"></div>
    <?php
    echo $item->DisplayEffect();
      if($item->GetLevel() != 0) echo 'Benötigt Level '.$item->GetLevel().'<br/>'; 
    ?>
<hr>
<div class="spacer"></div>
<form method="POST" action="?p=shop&a=buy<?php if(isset($_GET['itemname'])) echo '&itemname='.$_GET['itemname']; if(isset($_GET['itemcategory'])) echo '&itemcategory='.$_GET['itemcategory']; ?>">
  <input type="hidden" name="item" value="<?php echo $item->GetID(); ?>">
  Anzahl: <select style="width:100px" class="select" name="amount">
    <?php
    $j = 1;
	  $amount = 99;
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
<div class="spacer"></div>