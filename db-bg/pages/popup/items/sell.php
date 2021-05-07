<?php
include_once $_SERVER['DOCUMENT_ROOT'].'../../main/www/classes/session.php';
include_once '../../../classes/header.php';
$inventory = $player->GetInventory();

if(!isset($_GET['id']) || !is_numeric($_GET['id']))
  exit();

$item = $inventory->GetItem($_GET['id']);
if($item == null)
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
echo 'Preis: <b>'.$item->GetPrice().' Zeni</b>'; 
echo '<br/>';
echo 'Verkaufspreis: <b>'.($item->GetPrice()/2).' Zeni</b>'; 
?>
<hr>
<div class="spacer"></div>
    <?php
    echo $item->DisplayEffect();
      if($item->GetLevel() != 0) echo 'Benötigt Level '.$item->GetLevel().'<br/>'; 
    ?>
<hr>
<div class="spacer"></div>
  <form method="POST" action="?p=inventar&a=sell">
  <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
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
	<input style="width:100px" type="submit" value="Verkaufen">
</form>
<div class="spacer"></div>