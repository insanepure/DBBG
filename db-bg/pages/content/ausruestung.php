<?php
include_once 'pages/itemzorder.php';

$displayedClan = null;
if($player->GetClan() != 0)
{
	$displayedClan = new Clan($database, $player->GetClan());
}
 ?>
<!---Ausrüstung--->
<script type="text/javascript" src="js/combine.js?5"></script>
<div class="spacer"></div>
<div style="position:relative;">
<div class="char">
	<div class="char2" style="z-index:<?php echo $zorders[0]; ?>; background-image: url('img/characters/<?php echo $player->GetRaceImage(); ?>.png')">
	</div>
 <?php if($displayedClan != null && $displayedClan->GetBanner() != '')
{
?>
 <div class="tooltip" style="z-index:<?php echo $zorders[12]; ?>; position:absolute; left:115px; top:145px;"> 
	 <img src="<?php echo $displayedClan->GetBanner(); ?>" style="z-index:<?php echo $zorders[11]; ?>; position:absolute; left:55px; top:30px;" width="30px" height="30px"></img>
    <span class="tooltiptext"><?php echo $displayedClan->GetName(); ?></span>
    </div> 
<?php
}
  ?>
<div class="SideMenuKat catGradient borderB"><div class="schatten">Charakter</div></div>
    <?php
  
  
    
    function displayHair($raceImage, $zIndex, $zIndexBack, $powerupID)
    {
        $hairType = 'Hair';
        $hairBack = '';
        if(substr($raceImage, 0,-1) == 'Saiyajin')
        {
            if($powerupID == 23)
            {
              $hairType = 'SSJ';
              if($raceImage == 'Saiyajin5')
              {
                $hairBack = $raceImage.$hairType.'Back';
              }
            }
            else if($powerupID == 24 || $powerupID == 25)
            {
              $hairType = 'SSJ2';
              if($raceImage == 'Saiyajin5')
              {
                $hairBack = $raceImage.$hairType.'Back';
              }
            }
            else if($powerupID == 26 || $powerupID == 28)
            {
              $hairType = 'SSJ3';
              if($raceImage != 'Saiyajin5')
              {
                $hairBack = 'SSJ3Back';
              }
              else
              {
                $hairBack = $raceImage.$hairType.'Back';
              }
            }
        }
        echo '<div class="char2" style="z-index:'.$zIndex."; background-image: url('"."img/characters/".$raceImage.$hairType.'.png'."'".')"'.'></div>';
        echo '<div class="char2" style="z-index:'.$zIndexBack."; background-image: url('"."img/characters/".$hairBack.'.png'."'".')"'.'></div>';
    }
  
    $itemObject = $inventory->GetItemAtSlot(8);
    if(empty($itemObject)) {
      displayHair($player->GetRaceImage(), $zorders[13], $zorders[14], $player->GetStartingPowerup());
    } else {
        $itemIsHelm = $itemObject->IsHelmet();
        $itemIsEquipt = $itemObject->IsEquipped();
        if ((!$itemIsHelm && $itemIsEquipt) || ($itemIsHelm && !$itemIsEquipt) || (!$itemIsHelm && !$itemIsEquipt)) {
      displayHair($player->GetRaceImage(), $zorders[13], $zorders[14], $player->GetStartingPowerup());

        }
    }
    ?>

    <!-- Kleidung an Körper wie angezogen test -->
	<?php
  if(date("Y-m-d") == '2021-04-01')
  {
    ?><div class="char2" style="z-index:999; background-image: url('img/characteritems/Huhnmaske.png'"></div><?php
  }
  
  if($playerPlanet->IsInJenseits())
  {
    ?><div class="char2" style="z-index:<?php echo $zorders[10]; ?>; background-image: url('img/characteritems/heiligenschein.png'"></div><?php
  }
  if($player->GetApeTail() == 3)
  {
    $powerupID = $player->GetStartingPowerup();
    $tail = 'SaiyajinTail';
    if($powerupID == 23 || $powerupID == 24 || $powerupID == 25)
    {
      $tail = 'SaiyajinTailSSJ';
    }
    else if($powerupID == 26 || $powerupID == 28)
    {
      $tail = 'SaiyajinTailLSS';
    }
    ?><div class="char2" style="z-index:<?php echo $zorders[9]; ?>; background-image: url('img/characters/<?php echo $tail; ?>.png'"></div><?php
  }
	ShowSlotEquippedImage(6, $inventory, $zorders, $zordersOnTop); //Waffe
	ShowSlotEquippedImage(1, $inventory, $zorders, $zordersOnTop); //Aura 
	ShowSlotEquippedImage(5, $inventory, $zorders, $zordersOnTop); //Brust
	ShowSlotEquippedImage(8, $inventory, $zorders, $zordersOnTop); //Accessoire
	ShowSlotEquippedImage(2, $inventory, $zorders, $zordersOnTop); //Hände
	ShowSlotEquippedImage(3, $inventory, $zorders, $zordersOnTop); //Hose
	ShowSlotEquippedImage(7, $inventory, $zorders, $zordersOnTop); //Schuhe
	ShowSlotEquippedImage(4, $inventory, $zorders, $zordersOnTop); //Reise
  
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
<div class="SideMenuKat catGradient borderB"><div class="schatten">Accessoire</div></div>	
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
    <td class="borderT"><center>
      <div style="width:80px; height:80px; position:relative; top:-5px; left:-40px;">
        <?php if($item->HasOverlay())
        {
          ?>
        <img class="boxSchatten borderT borderR borderL borderB" src="img/items/<?php echo $item->GetOverlay(); ?>.png" style="width:80px;height:80px; position:absolute; z-index:1;"> 
          <?php
        }
        ?>
        <img class="boxSchatten borderT borderR borderL borderB" src="img/items/<?php echo $item->GetImage(); ?>.png" style="width:80px;height:80px; position:absolute; z-index:0;"> 
      </div>
  </center></td>
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