<?php
$clan = null;
if($player->GetClan() != 0)
{
	$clan = new Clan($database, $player->GetClan());
}
 ?>
<!---Ausrüstung--->
<script type="text/javascript" src="js/combine.js?5"></script>
<div class="spacer"></div>
<div style="position:relative;">
<div class="char">
	<div class="char2" style="z-index:3; background-image: url('img/races/<?php echo $player->GetRaceImage(); ?>.png')">
	</div>
 <?php if($clan != null && $clan->GetBanner() != '')
{
?>
 <div class="tooltip" style="z-index:7; position:absolute; left:119px; top:155px;"> 
	 <img src="<?php echo $clan->GetBanner(); ?>" style="z-index:5; position:absolute; left:50px; top:50px;" width="30px" height="30px"></img>
    <span class="tooltiptext"><?php echo $clan->GetName(); ?></span>
    </div> 
<?php
}
  ?>
<div class="SideMenuKat catGradient borderB"><div class="schatten">Charakter</div></div>
	<!-- Kleidung an Körper wie angezogen test -->
	<?php
  
  if($player->GetPlanet() == 'Jenseits')
  {
    ?><div class="char2" style="z-index:1; background-image: url('img/ausruestung/heiligenschein.png'"></div><?php
  }
  if($player->GetApeTail() == 3)
  {
    ?><div class="char2" style="z-index:2; background-image: url('img/races/saiyajintail.png'"></div><?php
  }
	ShowSlotEquippedImage(6, $inventory, 1);
	ShowSlotEquippedImage(1, $inventory, 0); 
	ShowSlotEquippedImage(5, $inventory, 6);
	ShowSlotEquippedImage(8, $inventory, 5);
	ShowSlotEquippedImage(2, $inventory, 6); 
	ShowSlotEquippedImage(3, $inventory, 5); 
	ShowSlotEquippedImage(7, $inventory, 4);
	ShowSlotEquippedImage(4, $inventory, 5);
  
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
<div class="SideMenuKat catGradient borderB"><div class="schatten">Zusatz</div></div>
<?php ShowSlot(1, $inventory); ?>	
<div class="spacer"></div>
</div>

<div class="handr borderB borderR borderT borderL">
<div class="SideMenuKat catGradient borderB"><div class="schatten">Hände</div></div>	
<?php ShowSlot(2, $inventory); ?>
<div class="spacer"></div>
</div>

<div class="spr borderB borderR borderT borderL">
<div class="SideMenuKat catGradient borderB"><div class="schatten">Hose</div></div>	
<?php ShowSlot(3, $inventory); ?>
<div class="spacer"></div>
</div>

<div class="reise borderB borderR borderT borderL">
<div class="SideMenuKat catGradient borderB"><div class="schatten">Reise</div></div>	
<?php ShowSlot(4, $inventory); ?>
<div class="spacer"></div>
</div>

<div class="brustr borderB borderR borderT borderL">
<div class="SideMenuKat catGradient borderB"><div class="schatten">Brust</div></div>	
<?php ShowSlot(5, $inventory); ?>
<div class="spacer"></div>
</div>

<div class="waffer borderB borderR borderT borderL">
<div class="SideMenuKat catGradient borderB"><div class="schatten">Waffe</div></div>	
<?php ShowSlot(6, $inventory); ?>
<div class="spacer"></div>
</div>

<div class="schuhe borderB borderR borderT borderL">
<div class="SideMenuKat catGradient borderB"><div class="schatten">Schuhe</div></div>	
<?php ShowSlot(7, $inventory); ?>
<div class="spacer"></div>
</div>

<div class="panzr borderB borderR borderT borderL">
<div class="SideMenuKat catGradient borderB"><div class="schatten">Panzer</div></div>	
<?php ShowSlot(8, $inventory); ?>
<div class="spacer"></div>
</div>


<div class="panzr2 borderB borderR borderT borderL">
<div class="SideMenuKat catGradient borderB"><div class="schatten">Werte</div></div>	
  <span style="position:absolute; left:5px;">
    <b>Angriff: </b>
  </span>
  <span style="position:absolute; right:5px;">
		<?php
    $equippedStats = explode(';',$player->GetEquippedStats());
	  ?>
    <?php echo $player->GetAttack(); ?>
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
    <?php echo $player->GetDefense(); ?>
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
		echo $player->GetLP(); ?>/<?php echo $player->GetMaxLP();
		$count = 0;
		if($equippedStats[$count] != 0)
		{
		?>
		<font color="#00bb00">+<?php echo $equippedStats[$count]; ?></font>
		<?php
		}
    ?>
  </span><br>
	  <span style="position:absolute; left:5px;">
    <b>KP: </b>
  </span>
  <span style="position:absolute; right:5px;">
    <?php 
		echo $player->GetKP(); ?>/<?php echo $player->GetMaxKP();
		$count = 1;
		if($equippedStats[$count] != 0)
		{
		?>
		<font color="#00bb00">+<?php echo $equippedStats[$count]; ?></font>
		<?php
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
  
</div>
<div class="spacer"></div>
<div class="ausr borderB borderR borderT borderL">
<div class="SideMenuKat catGradient borderB"><div class="schatten">Ausrüstung</div></div>	
	

	
	<div class="spacer"></div>
<table width="100%" cellspacing="0">
  <tr>
    <td width="15%"><center><b>Bild</b></center></td>
    <td width="20%"><center><b>Item</b></center></td>
    <td width="30%"><center><b>Wirkung</b></center></td>
    <td width="10%"><center><b>Wert</b></center></td>
    <td width="20%"><center><b>Aktion</b></center></td>
  </tr>
  
  <?php
  $i = 0;
  $item = $inventory->GetItem($i);
  while(isset($item))
  {
    if($item->GetType() != 3 && $item->GetType() != 4 || $item->IsEquipped())
    {
      ++$i;
      $item = $inventory->GetItem($i);
      continue;
    }
    ?>
  <tr height="120px">
    <td class="borderT"><center><img class="boxSchatten borderT borderR borderL borderB" src="img/items/<?php echo $item->GetImage(); ?>.png" style="width:80px;height:80px;"></img></center></td>
    <td class="borderT"><center><?php echo $item->GetName(); ?></center></td>
    <td class="borderT"><center>
      <?php 
      echo $item->DisplayEffect(); 
      if($item->GetLevel() != 0) echo 'Benötigt Level '.$item->GetLevel(); 
      ?></center></td>
    <td class="borderT"><center><?php echo $item->GetPrice(); ?></center></td>
    <td class="borderT"><center>
			<?php 
			$slotItem = $inventory->GetItemAtSlot($item->GetSlot());
			if($slotItem != null)
			{
				?>
				<Button onclick="OpenPopupPage('Ausrüsten','ausruestung/equip.php','id=<?php echo $i; ?>&slot=<?php echo $item->GetSlot(); ?>')">Anlegen</Button>
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
    if($item->IsSellable())
    {
		?>
		<div class="spacer3"></div>
     <button onclick="OpenPopupPage('Item Verkaufen','ausruestung/sell.php?id=<?php echo $i; ?>')">
     Verkaufen
     </button>
    <?php
    }
    if($item->GetRace() == '')
    {
		?>
		<div class="spacer3"></div>
		<Button onclick="OpenPopupPage('Item Kombinieren','ausruestung/combine.php','id=<?php echo $i; ?>')">Kombinieren</Button>
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