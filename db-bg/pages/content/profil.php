<?php
include_once 'pages/itemzorder.php';

$displayedPlayer = null;
$displayedAccount = null;
$isLocalPlayer = false;
if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] != 0)
{
  $displayedPlayer = new Player($database, $_GET['id']);
  $displayedAccount = new Account($accountDB, $displayedPlayer->GetUserID());
}
if(!isset($displayedPlayer) || isset($displayedPlayer) && !$displayedPlayer->IsValid() || !isset($_GET['id']))
{
  $displayedPlayer = $player;
  $displayedAccount = $account;
  $isLocalPlayer = true;
}
$inventory = $displayedPlayer->GetInventory();
$displayedClan = null;
if($displayedPlayer->GetClan() != 0)
{
	$displayedClan = new Clan($database, $displayedPlayer->GetClan());
}

$displayedPlayerPlanet = new Planet($database, $displayedPlayer->GetPlanet());


  
$titel = $titelManager->GetTitel($displayedPlayer->GetTitel());
$titelText = '';
if($titel != null)
{
  $titelText = $titel->GetName();
  if($titel->GetColor() != '')
  {
    $titelText = '<font color="#'.$titel->GetColor().'">'.$titelText.'</font>';
  }
}
?>
<div style="height:600px; position:relative;">
<div class="spacer"></div>
<div class="profileBox boxSchatten"  style="position:absolute; left:10px; top:25px; width:250px; height:120px;">  
<center>
<table width="100%" cellspacing="0" border="0">
  <tr>
    <td class="catGradient borderB borderT" colspan="6" align="center"> <b>&#187; <?php echo $titelText.' '.$displayedPlayer->GetName(); ?> &#171;</b></td>
  </tr>
</table>   
</center>
</div>
	<?php
 if($displayedPlayer->GetImage() == '')
 {
	 $playerimagenw = "img/imagefail.png";
 }
 else
 {
	$playerimagenw = $displayedPlayer->GetImage();
 }
 ?>
<img class ="profileBox" style="position:absolute; left:20px; top:50px; width:75px; height:75px;" src="<?php echo $playerimagenw; ?>" width="100%" height="100%"></img> 
<div style="z-index:400001; position:absolute; left:100px; top:50px; width:150px; height:90px; text-align:left; font-size:15px;">  
  <b>Level:</b> <?php echo $displayedPlayer->GetLevel(); ?><br/>
	<b>Rasse:</b> <?php echo $displayedPlayer->GetRace(); ?><br/>
  <?php 
  if($isLocalPlayer || $player->GetArank() >= 3  || $player->GetTeamUser()  == 1)
  {
		  $money = $displayedPlayer->GetZeni();
  ?>
  <b>Zeni:</b> <?php echo number_format($money, 0, ',', '.'); ?><br/>
  <?php
  }
  ?>
  <?php
  if($displayedAccount->IsBannedInGame('DBBG'))
  {
    ?><b><font color="red">Gebannt</font></b><?php
  }
  else
  {
  if($displayedPlayer->IsOnline())
  {
	  if($displayedPlayer->Getvisible() == 0)
	  {
		  $userstatus = "<font color='green'>Online</font>";
	  }
	  else
	  {
		  $userstatus = "<font color='red'>Offline</font>";
	  }
    ?>
  <b>Status: <?php echo $userstatus ?></font></b><br>
  <?php
  }
	else
	{
		?>
	 <b>Status: <font color="red">Offline</font></b><br>	
	<?php	
	}
  ?><b>Aktiv vor:</b> <?php
  $userTime = strtotime($displayedPlayer->GetLastAction());
  $timeDiffSeconds = time()-$userTime;
  $timeDiffMinutes = $timeDiffSeconds/60;
  $timeDiffHours = $timeDiffMinutes/60;
  $timeDiffDays = $timeDiffHours/24;
  if($timeDiffSeconds < 60)
  {
    $timeDiffSeconds = floor($timeDiffSeconds);
    echo $timeDiffSeconds;
    if($timeDiffSeconds == 1) echo ' Sekunde'; else echo ' Sekunden';
  }
  else if($timeDiffMinutes < 60)
  {
    $timeDiffMinutes = floor($timeDiffMinutes);
    echo $timeDiffMinutes;
    if($timeDiffMinutes == 1) echo ' Minute'; else echo ' Minuten';
  }
  else if($timeDiffHours < 24)
  {
    $timeDiffHours = floor($timeDiffHours);
    echo $timeDiffHours;
    if($timeDiffHours == 1) echo ' Stunde'; else echo ' Stunden';
  }
  else
  {
    $timeDiffDays = floor($timeDiffDays);
    echo $timeDiffDays;
    if($timeDiffDays == 1) echo ' Tag'; else echo ' Tage';
  }
  }
  ?>
</div>



<div class="profileBox boxSchatten"  style="position:absolute; left:10px; top:170px; width:250px; height:80px;">  
<center>
<table width="100%" cellspacing="0" border="0">
  <tr>
    <td class="catGradient borderB borderT" colspan="6" align="center"><b>&#187; KI &#171;</b></td>
  </tr>
</table>  
  <b><font size="6"><?php echo $displayedPlayer->GetFakeKI(); ?></font></b><br/>
</center>
</div>

<div class="profileBox boxSchatten"  style="position:absolute; left:15px; top:280px; width:250px; height:80px;">  
<center>
<table width="100%" cellspacing="0" border="0">
  <tr>
    <td class="catGradient borderB borderT" colspan="6" align="center"><b>&#187; Aufenthaltsort &#171;</b></td>
  </tr>
</table>  
  <b><font size="6"><?php echo $displayedPlayer->GetPlanet();?></font></b><br/>
  <b>- <?php echo $displayedPlayer->GetPlace();?> -</b>
</center>
</div>

				<?php 
if($displayedClan != null)
{
?>
<div class="profileBox boxSchatten"  style="position:absolute; left:15px; top:390px; width:250px; height:110px;">  
<center>
<table width="100%" cellspacing="0" border="0">
  <tr>
    <td class="catGradient borderB borderT" colspan="6" align="center"> <b>&#187; <font color="#fffffff"><a style="color:#ffffff;" href="?p=clan&id=<?php echo $displayedClan->GetID(); ?>"><b>[<?php echo $displayedClan->GetTag(); ?>] <?php echo $displayedClan->GetName(); ?></b></a></font> &#171;</b></td>
  </tr>
</table>  
<?php if($displayedClan->GetImage() != '')
{
	?>
  <br/><img src="<?php echo $displayedClan->GetImage(); ?>" width="70px" height="60px"></img>
	<?php
}
 ?>
</center>
</div>
<?php } ?>
<div class="profilecharacter" style="top:20px; left:185px; z-index:<?php echo $zorders[0]; ?>; background-image: url('img/characters/<?php echo $displayedPlayer->GetRaceImage(); ?>.png'"></div>
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
        echo '<div class="profilecharacter" style="top:20px; left:185px; z-index:'.$zIndex."; background-image: url('"."img/characters/".$raceImage.$hairType.'.png'."'".')"'.'></div>';
        echo '<div class="profilecharacter" style="top:20px; left:185px; z-index:'.$zIndexBack."; background-image: url('"."img/characters/".$hairBack.'.png'."'".')"'.'></div>';
    }

    $itemObject = $inventory->GetItemAtSlot(8);
    if(empty($itemObject)) 
    {
      displayHair($displayedPlayer->GetRaceImage(), $zorders[13], $zorders[14], $displayedPlayer->GetStartingPowerup());
    } else 
    {
        $itemIsHelm = $itemObject->IsHelmet();
        $itemIsEquipt = $itemObject->IsEquipped();
        if ((!$itemIsHelm && $itemIsEquipt) || ($itemIsHelm && !$itemIsEquipt) || (!$itemIsHelm && !$itemIsEquipt)) 
        {
          displayHair($displayedPlayer->GetRaceImage(), $zorders[13], $zorders[14], $displayedPlayer->GetStartingPowerup());

        }
    }
    ?>

<?php if($displayedClan != null && $displayedClan->GetBanner() != '')
{
?>
 <div class="tooltip" style="z-index:<?php echo $zorders[12]; ?>; position:absolute; left:300px; top:135px;"> 
	 <img src="<?php echo $displayedClan->GetBanner(); ?>" style="z-index:<?php echo $zorders[11]; ?>; position:absolute; left:55px; top:30px;" width="30px" height="30px"></img>
    <span class="tooltiptext"><?php echo $displayedClan->GetName(); ?></span>
    </div> 
<?php
}
  if(date("Y-m-d") == '2021-04-01')
  {
    ?><div class="profilecharacter" style="top:20px; left:185px; z-index:999; background-image: url('img/characteritems/Huhnmaske.png'"></div><?php
  }

  if($displayedPlayerPlanet->IsInJenseits())
  {
    ?><div class="profilecharacter" style="top:20px; left:185px; z-index:<?php echo $zorders[10]; ?>; background-image: url('img/characteritems/heiligenschein.png'"></div><?php
  }
  if($displayedPlayer->GetApeTail() == 3)
  {
    $powerupID = $displayedPlayer->GetStartingPowerup();
    $tail = 'SaiyajinTail';
    if($powerupID == 23 || $powerupID == 24 || $powerupID == 25)
    {
      $tail = 'SaiyajinTailSSJ';
    }
    else if($powerupID == 26 || $powerupID == 28)
    {
      $tail = 'SaiyajinTailLSS';
    }
    ?><div class="profilecharacter" style="top:20px; left:185px; z-index:<?php echo $zorders[9]; ?>; background-image: url('img/characters/<?php echo $tail; ?>.png'"></div><?php
  }
	ShowSlotEquippedImage(6, $inventory, $zorders, $zordersOnTop); //Waffe
	ShowSlotEquippedImage(1, $inventory, $zorders, $zordersOnTop); //Aura 
	ShowSlotEquippedImage(5, $inventory, $zorders, $zordersOnTop); // Brust
	ShowSlotEquippedImage(8, $inventory, $zorders, $zordersOnTop); //Accessoire
	ShowSlotEquippedImage(2, $inventory, $zorders, $zordersOnTop); //Hände
	ShowSlotEquippedImage(3, $inventory, $zorders, $zordersOnTop); //Hose
	ShowSlotEquippedImage(7, $inventory, $zorders, $zordersOnTop); //Schuhe
	ShowSlotEquippedImage(4, $inventory, $zorders, $zordersOnTop); //Reise
?>

<div class="profileBox boxSchatten"  style="position:absolute; right:10px; top:25px; width:240px; height:120px;"> 
<table width="100%" cellspacing="0" border="0">
  <tr>
    <td class="catGradient borderB borderT" colspan="6" align="center"> <b>&#187; User Option &#171;</b></td>
  </tr>
</table> 
			<div class="tooltip" style="margin-left:-80px; position: absolute;"> 
			  <a href="#" id="kampf2" onclick="OpenPopupPage('Private Nachricht','profil/pmpopup.php?name=<?php echo $displayedPlayer->GetName(); ?>')"><img src="img/pm.png" width="45px" height="45px"></img></a>
			<span class="tooltiptext" style="width:180px; top:-20px; left:-70px;">Private Nachricht</span>
			</div>
			<div class="tooltip" style="margin-left:-20px; position: absolute;"> 
			<a href="#" id="kampf2" onclick="OpenPopupPage('Herausforderung','profil/challenge.php?id=<?php echo $displayedPlayer->GetID(); ?>')"><img src="img/battel2.png" width="45px" height="45px"></img></a>
			<span class="tooltiptext" style="width:180px; top:-20px; left:-70px;">Herausfordern</span>
			</div> 
   			<div class="tooltip" style="margin-left:40px; position: absolute;"> 
			<a href="#" id="kampf2" onclick="OpenPopupPage('Gruppeneinladung','profil/gruppe.php?id=<?php echo $displayedPlayer->GetID(); ?>')"><img src="img/gruppe.png" width="45px" height="45px"></img></a>
			<span class="tooltiptext" style="width:180px; top:-20px; left:-70px;">Gruppeneinladung</span>
			</div> 			
  <br style="line-height:120%"/><br>
			<div class="tooltip" style="margin-top:10px; margin-left:-80px; position: absolute;"> 
			  <a href="#" id="kampf2" onclick="OpenPopupPage('Sparring','profil/sparring.php?id=<?php echo $displayedPlayer->GetID(); ?>')"><img src="img/sparring.png" width="45px" height="45px"></img></a>
			<span class="tooltiptext" style="width:180px; top:-20px; left:-70px;">Sparring</span>
			</div>
			<div class="tooltip" style="margin-top:10px; margin-left:-20px; position: absolute;"> 
			  <a href="#" id="kampf2" onclick="OpenPopupPage('Blockieren','profil/block.php?id=<?php echo $displayedPlayer->GetID(); ?>&userid=<?php echo $displayedPlayer->GetUserID(); ?>')"><img src="img/block.png" width="45px" height="45px"></img></a>
			<span class="tooltiptext" style="width:180px; top:-20px; left:-70px;">Blockieren</span>
			</div>
  <br style="line-height:120%"/>
</div>

<?php
if($isLocalPlayer || $player->GetArank() >= 2 || $player->GetTeamUser()  == 1)
{
  $equippedStats = explode(';',$displayedPlayer->GetEquippedStats());
  if($isLocalPlayer || $player->GetArank() >= 3  || $player->GetTeamUser()  == 1)
  {
?>
<div class="profileBox boxSchatten"  style="position:absolute; right:10px; top:170px; width:240px; height:210px;"> 
<table width="100%" cellspacing="0" border="0">
  <tr>
    <td class="catGradient borderB borderT" colspan="6" align="center">  <b>&#187; Werte &#171;</b></td>
  </tr>
</table>  
  <span style="position:absolute; left:5px;">
    <b>LP: </b>
  </span>
  <span style="position:absolute; right:5px;">
    <?php 
			$plp = $displayedPlayer->GetLP();
			$pmlp = $displayedPlayer->GetMaxLP();
			echo $plp; ?>/<?php echo $pmlp;
			$count = 0;
			if($equippedStats[$count] > 0)
			{
			?>
			<font color="#00bb00">+<?php echo $equippedStats[$count]; ?></font>
			<?php
			}
			 else if($equippedStats[$count] < 0)
			{
			?>
			<font color="red">-<?php echo $equippedStats[$count]; ?></font>
			<?php
			}
    ?>
  </span>
  <br/>
  <span style="position:absolute; left:5px;">
    <b>KP: </b>
  </span>
  <span style="position:absolute; right:5px;">
    <?php 
		$pkp = $displayedPlayer->GetKP();
		$pmkp = $displayedPlayer->GetMaxKP();
		echo $pkp; ?>/<?php echo $pmkp;
		$count = 1;
		if($equippedStats[$count] > 0)
		{
		?>
		<font color="#00bb00">+<?php echo $equippedStats[$count]; ?></font>
		<?php
		}
		else if($equippedStats[$count] < 0)
    {
    ?>
    <font color="red">-<?php echo $equippedStats[$count]; ?></font>
    <?php
    }
    ?>
  </span>
  <br/>
  <span style="position:absolute; left:5px;">
    <b>Angriff: </b>
  </span>
  <span style="position:absolute; right:5px;">
    <?php 
		$pattackl = $displayedPlayer->GetAttack();
	  echo $pattackl;
    $count = 2;
    if($equippedStats[$count] > 0)
    {
    ?>
    <font color="#00bb00">+<?php echo $equippedStats[$count]; ?></font>
    <?php
    }
    if($equippedStats[$count] < 0)
    {
    ?>
    <font color="red">-<?php echo $equippedStats[$count]; ?></font>
    <?php
    }
    ?>
  </span>
  <br/>
  <span style="position:absolute; left:5px;">
    <b>Abwehr: </b>
  </span>
  <span style="position:absolute; right:5px;">
    <?php 
		$pattackl2 = $displayedPlayer->GetDefense();
	  echo $pattackl2; 
    $count = 3;
    if($equippedStats[$count] > 0)
    {
    ?>
    <font color="#00bb00">+<?php echo $equippedStats[$count]; ?></font>
    <?php
    }
	 if($equippedStats[$count] < 0)
    {
    ?>
    <font color="red">-<?php echo $equippedStats[$count]; ?></font>
    <?php
    }
    ?>
  </span>
  <br/>
  <?php
  $taley = "/10";	
  $taley2= "/5";	
  if($displayedPlayer->GetRace() == 'Saiyajin')
  {
  ?> 
  <span style="position:absolute; left:5px;"><b>Affenschwanz:</b></span>
  <span style="position:absolute; right:5px;">
  <?php
  if($displayedPlayer->GetApeTail() == 0) { ?> Ab <?php } 
  else if($displayedPlayer->GetApeTail() == 1) { ?> Stummel <?php } 
  else if($displayedPlayer->GetApeTail() == 2) { ?> Im Wachstum <?php } 
  else if($displayedPlayer->GetApeTail() == 3) { ?> Dran <?php } 
  else { ?> dran <?php } 
  ?>
  </span><br/>
  <?php
  }
  ?>
  <span style="position:absolute; left:5px;"><b>Tägliche Kämpfe: </b></span><span style="position:absolute; right:5px;"><?php echo $displayedPlayer->GetDailyFights(); ?><?php echo $taley2 ?></span><br/>
  <span style="position:absolute; left:5px;"><b>Tägliche NPC Kämpfe: </b></span><span style="position:absolute; right:5px;"><?php echo $displayedPlayer->GetDailyNPCFights(); ?><?php echo $taley ?></span><br/>
  <span style="position:absolute; left:5px;"><b>Stats Kämpfe: </b></span><span style="position:absolute; right:5px;"><?php echo $displayedPlayer->GetTotalStatsFights(); ?></span><br/>

</div>
	<?php
	}
	?>
	<?php if($player->GetArank() >= 2) 
		{
		?>	
<div class="profileBox boxSchatten"  style="position:absolute; right:10px; top:370px; width:300px; height:150px;">  
<table width="100%" cellspacing="0" border="0">
  <tr>
    <td class="catGradient borderB borderT" colspan="2" align="center"><b>Player Option</b></td>
  </tr>
  
	<?php if($player->GetArank() >= 3) 
		{
		?>	
  <tr>
    <td>
<form name="form1" action="?p=profil&id=<?php echo $displayedPlayer->GetID(); ?>&a=adminlogin" method="post" enctype="multipart/form-data">
<center><input type="submit" value="Einloggen"></center>
</form></td>
  <td>
	<center><a href="?p=admin&a=see&table=accounts&id=<?php echo $displayedPlayer->GetID(); ?>"><input type="submit" value="Editieren"></a></center>
</form></td>
    </tr>
  <?php
    }
    if($player->GetArank() >= 2) 
    {
      ?>
    <tr>
      <td colspan="2">
<form name="form1" action="?p=adminmod&user=<?php echo $displayedPlayer->GetID(); ?>" method="post" enctype="multipart/form-data">
<center><input type="submit" value="Moderieren"></center>
</form></td>
    </tr>
      <?php
    }
    ?>
  <!--
  <tr>
    <td width="20%"><br>
		<?php
if($displayedPlayer->GetPlayersChatban() == "0")
{
	?>
<form name="form1" action="?p=profil&a=chatban" method="post" enctype="multipart/form-data">
<input type="hidden" value="<?php echo $displayedPlayer->GetID(); ?>" name="playeridtoban">
<input type="hidden" value="<?php echo $displayedPlayer->GetName(); ?>" name="playernametoban">
<center><input type="submit" value="Chatban"></center>
</form>
<?php
}
else
{
?>
<form name="form1" action="?p=profil&a=chatunban" method="post" enctype="multipart/form-data">
<input type="hidden" value="<?php echo $displayedPlayer->GetID(); ?>" name="playeridtoban">
<input type="hidden" value="<?php echo $displayedPlayer->GetName(); ?>" name="playernametoban">
<center><input type="submit" value="Chatunban"></center>
</form>
<?php
}
?>
</td>
<td width="20%"><br>
<?php
if($player->GetARank() >=2)
{
?>	
	<form name="form2" action="?p=profil&a=warn" method="post" enctype="multipart/form-data">
	<input type="hidden" value="<?php echo $displayedPlayer->GetID(); ?>" name="playeridtoban">
	<input type="hidden" value="<?php echo $displayedPlayer->GetName(); ?>" name="playernametoban">
	<center><input type="submit" value="Verwarnen"></center>
	</form>
<?php } ?>
	</td>
  </tr>
   <tr>
<td width="20%"><br>	
	<?php
if($player->GetARank() >= 3)
{
?>	
<form name="form1" action="?p=profil&a=chatban" method="post" enctype="multipart/form-data">
<input type="hidden" value="<?php echo $displayedPlayer->GetID(); ?>" name="playeridtoban">
<input type="hidden" value="<?php echo $displayedPlayer->GetName(); ?>" name="playernametoban">
<center><input type="submit" value="IP Bann"></center>
</form>
<?php
}
?>
	</td>
  </tr>
-->
</table>		
		<span style="position:absolute; left:5px;"><b>Multi: </b>
    <?php
$select = "id, name";
$where = 'userid='.$displayedPlayer->GetUserID().'';
$order = 'id';
$from = 'accounts';
$list = new Generallist($database, $from, $select, $where, $order, 100, 'DESC');


//preSort the arrays, so that we can easily show them
$id = 0;
$entry = $list->GetEntry($id);
while($entry != null)
{
  ?> 
  <a href="?p=profil&id=<?php echo $entry['id']; ?>"><?php echo $entry['name']; ?></a> <?php
  ++$id;
  $entry = $list->GetEntry($id);
}
    
    ?>
    </span><br/>
</div>
<?php
  }
	}
?>		 
<div class="profileBox boxSchatten"  style="position:absolute; left:30px; top:520px; width:600px; height:70px;">  
<table width="100%" cellspacing="0" border="0">
  <tr>
    <td class="catGradient borderB borderT" colspan="6" align="center">  <b>Statistik</b></td>
  </tr>
</table> 
  <?php
  $totalFights = StatsList::GetEntryOrEmpty($database, $displayedPlayer->GetID(), -1);
  $sFights = StatsList::GetEntryOrEmpty($database, $displayedPlayer->GetID(), 0);
  $wFights = StatsList::GetEntryOrEmpty($database, $displayedPlayer->GetID(), 1);
  $tFights = StatsList::GetEntryOrEmpty($database, $displayedPlayer->GetID(), 2);
  $nFights = StatsList::GetEntryOrEmpty($database, $displayedPlayer->GetID(), 3);
  $aFights = StatsList::GetEntryOrEmpty($database, $displayedPlayer->GetID(), 8);
  ?>
  <b>
   Verloren: <?php echo $totalFights['loose']; ?> | Gewonnen: <?php echo $totalFights['win']; ?> | Unentschieden: <?php echo $totalFights['draw']; ?><br/>
   Spaß: <?php echo $sFights['total']; ?> | Wertung: <?php echo $wFights['total']; ?> | Tod: <?php echo $tFights['total']; ?> | NPC: <?php echo $nFights['total']; ?> | Arena: <?php echo $aFights['total']; ?><br/>
  </b>
</div>

</div>
<div class="profileBox boxSchatten"  style="width:600px; min-height:100px; word-wrap: break-word; overflow:hidden; position:relative;">  
<table width="100%" cellspacing="0" border="0">
  <tr>
    <td class="catGradient borderB borderT" colspan="6" align="center">  <b>Sterne</b></td>
  </tr>
</table> 
<table>
<tr>
<?php 
$titels = $titelManager->GetTitels();
$playerTitels = $displayedPlayer->GetTitels();
  
$star1Titles = array();
$star2Titles = array();
$star3Titles = array();
foreach ($playerTitels as &$pTitel) 
{
  $titel = $titelManager->GetTitel($pTitel);
  if($titel != null)
  {
    if($titel->GetStar() == 'stern')
      array_push($star1Titles, $titel);
    else if($titel->GetStar() == 'stern1')
      array_push($star2Titles, $titel);
    else
      array_push($star3Titles, $titel);
  }
}
  
$titleArray = array();
$titleArray = array_merge($titleArray, $star1Titles);
$titleArray = array_merge($titleArray, $star2Titles);
$titleArray = array_merge($titleArray, $star3Titles);
  
$idx = 0;
foreach ($titleArray as &$titel) 
{
  if($titel != null && $titel->GetStar() != '')
  {
    if($idx % 8 == 0)
    {
      ?></tr><tr><?php
    }
  ?>
  <td style="z-index:0; position:relative; width:50px; height:50px;">
     <img src="img/<?php echo $titel->GetStar(); ?>.png" width="50px" height="50px"></img>
  </td>
  <?php
  }
  ++$idx;
}
?>
  
</tr>
</table>
</div>
<div class="spacer"></div>
<div class="profileBox boxSchatten"  style="width:600px; min-height:200px; word-wrap: break-word; overflow:hidden;">  
<table width="100%" cellspacing="0" border="0">
  <tr>
    <td class="catGradient borderB borderT" colspan="6" align="center">  <b>Beschreibung</b></td>
  </tr>
</table> 
<?php 
  if(!$displayedAccount->IsBannedInGame('DBBG'))
  {
    echo $bbcode->parse($displayedPlayer->GetText()); 
  }
  else
  {
    ?><b><font color="#ff0000">Dieser Spieler ist gebannt.</font></b><?php
  }
  ?>
</div>
<div class="spacer"></div>
<div class="spacer"></div>
<div class="profileBox boxSchatten"  style="width:600px; min-height:100px; word-wrap: break-word; overflow:hidden;">  
<table width="100%" cellspacing="0" border="0">
    <tr>
    <td colspan=5 class="catGradient borderT borderB">
      <b><center><font color="white"><div class="schatten">Vergangene Kämpfe</div></font></center></b>
    </td>
  </tr>
  <tr>
    <td class="boxSchatten" align="center"><b>ID</b></td>
    <td class="boxSchatten" align="center"><b>Name</b></td>
    <td class="boxSchatten" align="center"><b>Art</b></td>
    <td class="boxSchatten" align="center"><b>Modus</b></td>
    <td class="boxSchatten" align="center"><b>Aktion</b></td>
  </tr>
<?php
$select = "id, name, type, mode, fighters, state";
$pID = '['.$displayedPlayer->GetID().']';
$where = 'fights.fighters LIKE "%'.$pID.'%" AND state = 2';
$order = 'id';
$from = 'fights';
$list = new Generallist($database, $from, $select, $where, $order, 10, 'DESC');


//preSort the arrays, so that we can easily show them
$id = 0;
$entry = $list->GetEntry($id);
while($entry != null && $displayedPlayer->GetARank() < 2)

{
?>
<tr>
  <td class="boxSchatten" align="center">
    <?php
    echo $entry['id'];
    ?>
  </td>
  <td class="boxSchatten" align="center">
    <?php
    echo $entry['name'];
    ?>
  </td>
  <td class="boxSchatten" align="center">
    <?php
    echo Fight::GetTypeName($entry['type']);
    ?>
  </td>
  <td class="boxSchatten" align="center">
    <?php
    echo $entry['mode'];
    ?>
  </td>
  <td class="boxSchatten">
    <center>
      <a href="?p=infight&fight=<?php echo $entry['id'];?>">Betrachten</a>
    </center></td>
</tr>
<?php
$id++;
$entry = $list->GetEntry($id);
}
?>
</table> 
</div>

<?php if($isLocalPlayer)
{
?>
<div class="spacer"></div>
<table style="text-align: center;" width="100%" cellspacing="0" border="0">
    <tr>
    <td class="catGradient borderB borderT" colspan="6" align="center"><b>Einstellungen</b></td>
  </tr>
<form name="form1" action="?p=profil&a=change" method="post" enctype="multipart/form-data">   
  	<tr>
		<td width="50%"><b>Profilbild (200x200)</b></td>
    <td width="50%"><input type="file" name="file_upload" /><input type="hidden" name="image"/></td>
  </tr>
	<tr>
		<td width="20%"><b>Profiltext</b></td>
    <td width="80%">
<textarea class="textfield" name="text" maxlength="300000" style="width:400px; height:200px;"><?php echo $player->GetText(); ?></textarea>
		</td>
  </tr>
		<tr>
		<td width="20%"><b>Chat</b></td>
    <td width="80%">
			<select style="height:30px; width:310px;" name="chatactivate" id="chatactivate" class="select">
			<option value="1" <?php if($player->GetChatActive()) echo 'selected'; ?>>Aktivieren</option>
				<option value="0" <?php if(!$player->GetChatActive()) echo 'selected'; ?>>Deaktivieren</option>
			</select>
			</td>
  </tr>
	<tr>
		<td colspan="2"><input type="submit" value="ändern">  </td>
	</tr>
</table>
</form>
<?php 
 if($displayedPlayer->CanFakeKI())
{
	?>
	<div class="spacer2"></div>
	<form name="form1" action="?p=profil&a=fakeki" method="post" enctype="multipart/form-data">
	Ki Unterdrücken: <input type="number" name="fakeki" style="width:300px;" value="<?php echo $player->GetRealFakeKI(); ?>"><br/>
	<input type="submit" value="Ändern">
	</form>
	<?php
}
?>
<div class="spacer2"></div>
<hr></hr>
<b>Titel</b><br/><br/>
<form name="form1" action="?p=profil&a=titel" method="post" enctype="multipart/form-data">
<select style="height:30px; width:310px;" name="titel" class="select" selected="<?php echo $player->GetTitel(); ?>">
<option value="0" <?php if($player->GetTitel() == 0) { ?> selected <?php } ?> > Kein Titel</option>
<?php
$titels = $titelManager->GetTitels();
$playerTitels = $player->GetTitels();
foreach ($playerTitels as &$pTitel) 
{
  $titel = $titelManager->GetTitel($pTitel);
  if($titel != null)
  {
	 ?><option value="<?php echo $titel->GetID(); ?>" <?php if($player->GetTitel() == $titel->GetID()) { ?> selected <?php } ?> > <?php echo $titel->GetName(); ?></option><?php
  }
}
?>
</select>
<input type="submit" value="Ändern">
</form>

<div class="spacer2"></div>
<hr></hr>
<b>Design</b><br/><br/>
<form name="form1" action="?p=profil&a=style" method="post" enctype="multipart/form-data">
<select style="height:30px; width:310px;" name="design" id="design" class="select" selected="<?php echo $player->GetDesign(); ?>">
	<option value="default" <?php if($player->GetDesign() == 'default') { ?> selected <?php } ?> >Standard - Hell</option>
	<option value="darkdefault" <?php if($player->GetDesign() == 'darkdefault') { ?> selected <?php } ?> >Standard - Dunkel</option>
	<option value="lightblue" <?php if($player->GetDesign() == 'lightblue') { ?> selected <?php } ?> >Vegito - Hell</option>
	<option value="darkblue" <?php if($player->GetDesign() == 'darkblue') { ?> selected <?php } ?> >Vegito - Dunkel</option>
	<option value="lightred" <?php if($player->GetDesign() == 'lightred') { ?> selected <?php } ?> >Jiren - Hell</option>
	<option value="darkred" <?php if($player->GetDesign() == 'darkred') { ?> selected <?php } ?> >Jiren - Dunkel</option>
	<option value="lightdark" <?php if($player->GetDesign() == 'lightdark') { ?> selected <?php } ?> >Black - Hell</option>
	<option value="darkdark" <?php if($player->GetDesign() == 'darkdark') { ?> selected <?php } ?> >Black - Dunkel</option>
	<option value="lightgreen" <?php if($player->GetDesign() == 'lightgreen') { ?> selected <?php } ?> >Shenlong - Hell</option>
	<option value="darkgreen" <?php if($player->GetDesign() == 'darkgreen') { ?> selected <?php } ?> >Shenlong - Dunkel</option>
	<option value="lightpink" <?php if($player->GetDesign() == 'lightpink') { ?> selected <?php } ?> >Buu - Hell</option>
	<option value="darkpink" <?php if($player->GetDesign() == 'darkpink') { ?> selected <?php } ?> >Buu - Dunkel</option>
	<option value="lightyellow" <?php if($player->GetDesign() == 'lightyellow') { ?> selected <?php } ?> >C18 - Hell</option>
	<option value="darkyellow" <?php if($player->GetDesign() == 'darkyellow') { ?> selected <?php } ?> >C18 - Dunkel</option>
</select>
<input type="submit" value="Ändern">
</form>

<div class="spacer2"></div>
<hr></hr>
<b>Kampf Techniken</b><br/><br/>
Du hast die Techniken im Kampf zur Verfügung, die farbig sind.<br/>Klicke auf eine Technik um sie im Kampf hinzuzufügen oder zu entfernen.
<div class="spacer"></div>
<?php
$attacks = explode(';',$player->GetAttacks());
$fightAttacks = explode(';',$player->GetFightAttacks());
$powerups = array();
$id = 0;
while(isset($attacks[$id]))
{
  $attack = $attackManager->GetAttack($attacks[$id]);
  if($attack != null)
  {
    $isSelected = in_array($attack->GetID(), $fightAttacks);
    if($isSelected && $attack->GetType() == 4)
    {
      array_push($powerups, $attack);
    }
    ?>
        <div class="tooltip" style="position:relative; height:60px; width:60px; display:inline-block">
    <a href="?p=profil&a=fightattack&aid=<?php echo $attack->GetID(); ?>"><img class="attack" width="40px" height="40px" src="<?php echo $attack->GetImage(); ?>" style="
                                                                      <?php
                                                                      if(!$isSelected)
                                                                      {
                                                                      ?>
                                                                      filter: gray; /* IE6-9 */
                                                                      -webkit-filter: grayscale(1); /* Google Chrome, Safari 6+ & Opera 15+ */
                                                                      filter: grayscale(1); /* Microsoft Edge and Firefox 35+ */
                                                                      <?php
                                                                      }
                                                                      ?>
                                                                      "></img></a>
    
 <span class="tooltiptext" style="position:absolute; z-index:5; width:220px; top:-30px; left:-80px;">
  <?php
  echo $attack->GetName();
  ?>
  </span>
  </div>
    <?php
  }
  ++$id;
}
?>
<div class="spacer2"></div>
<hr></hr>
<b>Start-Verwandlung</b><br/><br/>
Mit welcher Verwandlung möchtest du starten?
<form name="form1" action="?p=profil&a=powerup" method="post" enctype="multipart/form-data">
<select style="height:30px; width:310px;" name="powerup" id="powerup" class="select" selected="0">
  <option value="0">Keine Verwandlung</option>
   <?php
   foreach($powerups as &$powerup)
   {
      ?><option value="<?php echo $powerup->GetID(); ?>" <?php if($player->GetStartingPowerup() == $powerup->GetID()) { ?>selected<?php } ?>><?php echo $powerup->GetName(); ?></option><?php
   }
   ?>
  </select>
	<br/>
<input type="submit" value="ändern">
</form>
<div class="spacer2"></div>
<hr></hr>
<b>Charakter löschen</b><br/><br/>
<form name="form1" action="?p=profil&a=delete" method="post" enctype="multipart/form-data">
Möchtest du dich wirklich löschen? <input type="checkbox" name="realcheck"><br/>
<input type="submit" value="Löschen">
</form>
<div class="spacer2"></div>
<?php
}
?>
<hr></hr>
<b>Fehler Melden</b><br/><br/>
<?php 
if(isset($_GET['id']))
{
  ?><form name="form1" action="?p=profil&<?php echo 'id='.$_GET['id']; ?>&a=meld" method="post" enctype="multipart/form-data"><?php
}
else
{
  ?><form name="form1" action="?p=profil&a=meld" method="post" enctype="multipart/form-data"><?php
}
?>
<input type="submit" value="Melden">
</form>
<div class="spacer2"></div>
