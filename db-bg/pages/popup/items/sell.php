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