<?php
$clan = null;
if($player->GetClan() != 0)
{
	$clan = new Clan($database, $player->GetClan());
}
	
$displayedPlayer = null;
$isLocalPlayer = false;
if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] != 0)
{
  $displayedPlayer = new Player($database, $_GET['id']);
}
if(!isset($displayedPlayer) || isset($displayedPlayer) && !$displayedPlayer->IsValid() || !isset($_GET['id']))
{
  $displayedPlayer = $player;
  $isLocalPlayer = true;
}
$inventory = $displayedPlayer->GetInventory();
 ?>
<!---Ausrüstung--->
<div class="spacer"></div>
<div style="position:relative;">
<div class="char">
	<div class="char2" style="z-index:1; background-image: url('img/races/<?php echo $displayedPlayer->GetRaceImage(); ?>.png')">
	</div>
 <?php if($clan != null && $clan->GetBanner() != '')
{
?>
 <div class="tooltip" style="z-index:5; position:absolute; left:119px; top:155px;"> 
	 <img src="<?php echo $clan->GetBanner(); ?>" style="z-index:5; position:absolute; left:50px; top:50px;" width="30px" height="30px"></img>
    <span class="tooltiptext"><?php echo $clan->GetName(); ?></span>
    </div> 
<?php
}
  ?>
<div class="SideMenuKat catGradient borderB"><div class="schatten">Charakter</div></div>
	<!-- Kleidung an Körper wie angezogen test -->
	<?php
  if($displayedPlayer->GetApeTail() == 3)
  {
    ?><div class="char2" style="z-index:0; background-image: url('img/races/saiyajintail.png'"></div><?php
  }
	ShowSlotEquippedImage(6, $inventory, $itemManager, 0);
	ShowSlotEquippedImage(1, $inventory, $itemManager, 3); 
	ShowSlotEquippedImage(5, $inventory, $itemManager, 4);
	ShowSlotEquippedImage(8, $inventory, $itemManager, 3);
	ShowSlotEquippedImage(2, $inventory, $itemManager, 3); 
	ShowSlotEquippedImage(3, $inventory, $itemManager, 3); 
	ShowSlotEquippedImage(7, $inventory, $itemManager, 2);
	ShowSlotEquippedImage(4, $inventory, $itemManager, 3);
  
if($clan != null && $clan->GetBanner() != '')
{
?>
 <div class="tooltip" style="position:absolute; left:137px; top:140px;"> 
	 <img src="img.php?url=<?php echo $clan->GetBanner(); ?>" style="position:absolute; left:40px; top:35px;" width="30px" height="30px"></img>
    <span class="tooltiptext"><?php echo $clan->GetName(); ?></span>
    </div> 
<?php
}
?>
</div>
<div class="kopfr borderB borderR borderT borderL">
<div class="SideMenuKat catGradient borderB"><div class="schatten">Kopf</div></div>
<?php ShowSlot(1, $inventory, $itemManager); ?>	
<div class="spacer"></div>
</div>

<div class="handr borderB borderR borderT borderL">
<div class="SideMenuKat catGradient borderB"><div class="schatten">Hände</div></div>	
<?php ShowSlot(2, $inventory, $itemManager); ?>
<div class="spacer"></div>
</div>

<div class="spr borderB borderR borderT borderL">
<div class="SideMenuKat catGradient borderB"><div class="schatten">Hose</div></div>	
<?php ShowSlot(3, $inventory, $itemManager); ?>
<div class="spacer"></div>
</div>

<div class="reise borderB borderR borderT borderL">
<div class="SideMenuKat catGradient borderB"><div class="schatten">Reise</div></div>	
<?php ShowSlot(4, $inventory, $itemManager); ?>
<div class="spacer"></div>
</div>

<div class="brustr borderB borderR borderT borderL">
<div class="SideMenuKat catGradient borderB"><div class="schatten">Brust</div></div>	
<?php ShowSlot(5, $inventory, $itemManager); ?>
<div class="spacer"></div>
</div>

<div class="waffer borderB borderR borderT borderL">
<div class="SideMenuKat catGradient borderB"><div class="schatten">Waffe</div></div>	
<?php ShowSlot(6, $inventory, $itemManager); ?>
<div class="spacer"></div>
</div>

<div class="schuhe borderB borderR borderT borderL">
<div class="SideMenuKat catGradient borderB"><div class="schatten">Schuhe</div></div>	
<?php ShowSlot(7, $inventory, $itemManager); ?>
<div class="spacer"></div>
</div>

<div class="panzr borderB borderR borderT borderL">
<div class="SideMenuKat catGradient borderB"><div class="schatten">Panzer</div></div>	
<?php ShowSlot(8, $inventory, $itemManager); ?>
<div class="spacer"></div>
</div>


<div class="panzr2 borderB borderR borderT borderL">
<div class="SideMenuKat catGradient borderB"><div class="schatten">Werte</div></div>	
  <span style="position:absolute; left:5px;">
    <b>Angriff: </b>
  </span>
  <span style="position:absolute; right:5px;">
		<?php
 if($isLocalPlayer || $player->GetArank() >= 2)
{
  $equippedStats = explode(';',$displayedPlayer->GetEquippedStats());
	 ?>
    <?php echo $displayedPlayer->GetAttack(); ?>
    <?php 
    $count = 2;
    if($equippedStats[$count] != 0)
    {
    ?>
    <font color="#00bb00">+<?php echo $equippedStats[$count]; ?></font>
    <?php
 }
    ?>
  </span><br>
	  <span style="position:absolute; left:5px;">
    <b>Abwehr: </b>
  </span>
  <span style="position:absolute; right:5px;">
    <?php echo $displayedPlayer->GetDefense(); ?>
    <?php 
    $count = 3;
    if($equippedStats[$count] != 0)
    {
    ?>
    <font color="#00bb00">+<?php echo $equippedStats[$count]; ?></font>
    <?php
    }
    ?>
  </span><br>
	  <span style="position:absolute; left:5px;">
    <b>LP: </b>
  </span>
  <span style="position:absolute; right:5px;">
    <?php 
		if($isLocalPlayer || $player->GetArank() >= 2)
		{
			echo $displayedPlayer->GetLP(); ?>/<?php echo $displayedPlayer->GetMaxLP();
			$count = 0;
			if($equippedStats[$count] != 0)
			{
			?>
			<font color="#00bb00">+<?php echo $equippedStats[$count]; ?></font>
			<?php
			}
		}
		else
		{
			if($displayedPlayer->GetRealFakeKI() == 0)
			{
				echo $displayedPlayer->GetMaxLP();
			}
			else
			{
				echo $displayedPlayer->GetFakeKI()*10;
			}
		}
    ?>
  </span><br>
	  <span style="position:absolute; left:5px;">
    <b>KP: </b>
  </span>
  <span style="position:absolute; right:5px;">
    <?php 
		if($isLocalPlayer || $player->GetArank() >= 2)
		{
			echo $displayedPlayer->GetKP(); ?>/<?php echo $displayedPlayer->GetMaxKP();
			$count = 1;
			if($equippedStats[$count] != 0)
			{
			?>
			<font color="#00bb00">+<?php echo $equippedStats[$count]; ?></font>
			<?php
			}
		}
		else
		{
			if($displayedPlayer->GetRealFakeKI() == 0)
			{
				echo $displayedPlayer->GetMaxKP();
			}
			else
			{
				echo $displayedPlayer->GetFakeKI()*10;
			}
		}
    ?>
  </span><br>
		  <span style="position:absolute; left:5px;">
    <b>Panzer: </b>
  </span>
  <span style="position:absolute; right:5px;">
  <?php
if($player->GetTrainBonus() == 1)
{
echo "Normal(1) + 1";
}
else if ($player->GetTrainBonus() == 2)
{
	echo "Normal(1) + 2";
}
else if($player->GetTrainBonus() == 3)
{
	echo "Normal(1) + 3";
}
  ?>
  </span>
<div class="spacer"></div>
</div>
<?php
 }
?>
  
</div>
<div class="spacer"></div>
<div class="ausr borderB borderR borderT borderL">
<div class="SideMenuKat catGradient borderB"><div class="schatten">Ausrüstung</div></div>	
	

	
	<div class="spacer"></div>
<table width="100%" cellspacing="0">
  <tr>
    <td width="15%"><center><b>Bild</b></center></td>
    <td width="20%"><center><b>Item</b></center></td>
    <td width="20%"><center><b>Wirkung</b></center></td>
    <td width="10%"><center><b>Wert</b></center></td>
		<td width="10%"><center><b>Ablaufsdatum</b></center></td>
    <td width="20%"><center><b>Aktion</b></center></td>
  </tr>
  
  <?php
  $i = 0;
  $item = $inventory->GetItem($i);
  while(isset($item))
  {
    $itemData = $itemManager->GetItem($item->GetID());
	if($itemData->GetType() != 3 && $itemData->GetType() != 4 || $item->GetSlot() != null)
	{
		++$i;
		$item = $inventory->GetItem($i);
		continue;
	}
    ?>
  <tr>
    <td><center><img class="boxSchatten borderT borderR borderL borderB" src="img/items/<?php echo $itemData->GetImage(); ?>.png" style="width:80px;height:80px;"></img></center></td>
    <td><center><?php echo $itemData->GetName(); ?></center></td>
    <td><center>
      <?php 
      echo $itemData->DisplayEffect(); 
      if($itemData->GetLevel() != 0) echo 'Benötigt Level '.$itemData->GetLevel(); 
      ?></center></td>
    <td><center><?php echo $itemData->GetPrice(); ?></center></td>
	  <td width="16%"><center><?php 
		if($item->GetExpirationDate() != null)
		{
			echo date('d.m.Y',strtotime($item->GetExpirationDate()));
		}
		?></center></td> 
    <td><center>
			<?php 
			$slotItem = $inventory->GetItemAtSlot($itemData->GetSlot());
			if($slotItem != null)
			{
				?>
				<Button onclick="OpenPopupPage('Ausrüsten','ausruestung/equip.php','id=<?php echo $i; ?>&slot=<?php echo $itemData->GetSlot(); ?>')">Anlegen</Button>
				<?php
			}
			else
			{
				?>
				<form method="POST" action="?p=ausruestung&a=equip">
				<input type="hidden" name="item" value="<?php echo $i; ?>">
				<input type="submit" value="Anlegen">
				</form>
				<?php
			}
    if($itemData->IsSellable())
    {
		?>
		<div class="spacer3"></div>
    <form method="POST" action="?p=ausruestung&a=sell">
      <input type="hidden" name="id" value="<?php echo $i; ?>">
      <input type="submit" value="Verkaufen">
    </form>
    <?php
    }
    ?>
	</center>
	</td>
  </tr>
  
  <?php
    ++$i;
    $item = $inventory->GetItem($i);
  }
  
  ?>
</table>
</div>
<div class="spacer"></div>
<!---Ausrüstung ende--->