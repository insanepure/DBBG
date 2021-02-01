<script>
grecaptcha.ready(function() {
  grecaptcha.execute('6Lcd57wUAAAAAMqh2WE8_KEHveQ4Ycw1gRmbZQkI', {action: 'Map'});
});
</script>
<div class="spacer"></div>
<div class="map boxSchatten borderL borderR borderT borderB" style=" border:1px solid black; background-image: url('img/planets/<?php echo $player->GetPlanet(); ?>.png?004')">
  <?php
  $events = new Generallist($database, 'events', '*', 'isdungeon="0"', '', 9999, 'ASC');
  
  
  $story = new Story($database, $player->GetStory());
  /*if($player->GetARank() >=3) {
    $database->Debug();
  }*/
  $places = new Generallist($database, 'places', 'id,name,description,display,x,y,image,planet,travelable, adminplace', 'planet = "'.$player->GetPlanet().'"', '', 99999, 'ASC');
  $id = 0;
  $entry = $places->GetEntry($id);
  $x = 0;
  $y = 0;
	$tX = 0;
	$tY = 0;
	$pX = 0;
	$pY = 0;
  while($entry != null)
  {
		if($entry['name'] == $player->GetPreviousPlace())
		{
			$pX = $entry['x'];
			$pY = $entry['y'];
		}
		if($entry['name'] == $player->GetTravelPlace())
		{
			$tX = $entry['x'];
			$tY = $entry['y'];
		}
		if($entry['name'] == $player->GetPlace())
		{
			$x = $entry['x'];
			$y = $entry['y'];
		}
    $placeCSS = 'mapplace';
    
    
    $eid = 0;
    $eventEntry = $events->GetEntry($eid);
    while($eventEntry != null)
    {
      $isPlaceAndPlanet = Event::IsPlaceAndPlanet($entry['planet'], $entry['name'], $eventEntry['placeandtime']);
      if($isPlaceAndPlanet && $player->GetLevel() >= $eventEntry['level'])
      {
        $isToday = Event::IsToday($entry['planet'], $entry['name'], $eventEntry['placeandtime']);
        if($isToday)
        {
          $placeCSS = 'mapplaceevent';
          break;
        }
      }
      ++$eid;
      $eventEntry = $events->GetEntry($eid);
    }
    
    if($story->GetPlace() == $entry['name'] && $story->GetPlanet() == $player->GetPlanet())
      $placeCSS = 'mapplacestory';
    
		if($entry['display'] == 1 || $player->GetArank() >= 2 && $entry['adminplace'] == 1)
		{
				?>
			<div class="tooltip" style="position:absolute; left:<?php echo $entry['x']; ?>px; top:<?php echo $entry['y']; ?>px;"> 
			<a style="cursor:pointer;" onclick="OpenPopupPage('<?php echo $entry['name']; ?>','map/place.php?name=<?php echo $entry['name']; ?>&planet=<?php echo $entry['planet']; ?>')"><div class="<?php echo $placeCSS; ?>" style="left:59px; top:30px;"></div></a>
			<span class="tooltiptext" style="width:200px; left:-35px;"><?php echo $entry['name']; ?></span>
			</div> 
			<?php
		}
    ++$id;
    $entry = $places->GetEntry($id);
  }
  if($player->GetRace() == "Saiyajin")
  {
	  $race = 'Saiyajin';  
  }
  else if($player->GetRace() == "Mensch")
  {
	  $race = 'Mensch';  
  }
  else if($player->GetRace() == "Namekianer")
  {
	  $race = 'Namekianer';  
  }
   else if($player->GetRace() == "Kaioshin")
  {
	  $race = 'Kaioshin';  
  }
   else if($player->GetRace() == "Freezer")
  {
	  $race = 'Freezer';  
  }
   else if($player->GetRace() == "Majin")
  {
	  $race = 'Majin';  
  }
   else if($player->GetRace() == "Android")
  {
	  $race = 'Android';
  }
   else if($player->GetRace() == "Demon")
  {
	  $race = 'Demon';  
  }
  else
  {
	  $race = 'Saiyajin'; 
  }
	
	if($player->GetPreviousPlace() != '')
	{
		if($player->GetPreviousPlace() == 'Auf Reise')
		{
			$pX = $player->GetX();
			$pY = $player->GetY();
		}
		$tempX = $tX - $pX;
		$tempY = $tY - $pY;
		$secondsLeft = $player->GetActionCountdown();
		$maxSeconds = $player->GetActionTime() * 60;
		if($player->GetActionTime() == 0)
		{
			$secondsPassed = 0;
		}
		else
		{
			$secondsPassed = 1 - ($secondsLeft/$maxSeconds);
		}
		$x = $pX + round($tempX * $secondsPassed);
		$y = $pY + round($tempY * $secondsPassed);
	}
	else if($player->GetX() != 0 && $player->GetY() != 0)
	{
		$x = $player->GetX();
		$y = $player->GetY();
	}
  ?>
  <img class="mapcharacter" style="left:<?php echo $x+55; ?>px; top:<?php echo $y+27; ?>px; height: 20px; width: 20px;" src="img/planets/Map_<?php echo $race; ?>.gif"></img>
</div>
<?php
$enabled = false;
if($enabled)
{
?>
<div class="spacer"></div>
<table width="98%" cellspacing="0" border="0" class="borderB borderR borderL">
  <tr>
    <td class="catGradient borderB borderT" colspan="7" align="center"><b>Aktive Events</b></td>
  </tr>
  <tr>
    <td width="15%"><center><b>Name</b></center></td>
    <td width="20%"><center><b>Ort</b></center></td>
    <td width="15%"><center><b>Beginn</b></center></td>
    <td width="15%"><center><b>Ende</b></center></td>
		<td width="10%"><center><b>Drop Chance</b></center></td>
		<td width="20%"><center><b>Versuche</b></center></td>
    <td width="10%"><center><b>Gruppe</b></center></td>
  </tr>
	<?php
  $events = new Generallist($database, 'events', 'name, begin, end, dropchance, minplayers, winable, placeandtime', '', '', 99999, 'ASC');
  $id = 0;
  $entry = $events->GetEntry($id);
  while($entry != null)
  {
		
		$pandts = explode('@',$entry['placeandtime']);
		$i = 0;
		while(isset($pandts[$i]))
		{
			$pandt = explode(';',$pandts[$i]);
			$planet = $pandt[0];
			$place = $pandt[1];
		
			$isToday = Event::IsToday($player->GetPlanet(), $place, $entry['placeandtime']);
			if(!$isToday || $place == 'Admin Island')
			{
				++$i;
				continue;
			}

			?>
			<tr>
				<td width="16%"><center><?php echo $entry['name']; ?></center></td>
				<td width="20%"><center><?php echo $place; ?> </center></td>
				<td width="15%"><center><?php echo $entry['begin']; ?></center></td>
				<td width="15%"><center><?php echo $entry['end']; ?></center></td> 
				<td width="16%"><center><?php echo $entry['dropchance']; ?></center></td> 
				<td width="20%"><center><?php echo $entry['winable']; ?></center></td> 
				<td width="16%"><center><?php echo $entry['minplayers']; ?>+</center></td> 
			</tr>
			<?php
			++$i;
		}
		
		++$id;
  	$entry = $events->GetEntry($id);
	}
	?>
</table>
<div class="spacer"></div>
<table width="98%" cellspacing="0" border="0" class="borderB borderR borderL">
  <tr>
    <td class="catGradient borderB borderT" colspan="3" align="center"><b>Bekannte Orte</b></td>
  </tr>
  <tr>
    <td width="15%"><center><b>Name</b></center></td>
    <td width="15%"><center><b>NPCs</b></center></td>
		<td width="15%"><center><b>Erreichbar</b></center></td>
  </tr>
	<?php
  $places = new Generallist($database, 'places', 'npcs, name, travelable', 'display=1 AND planet = "'.$player->GetPlanet().'"', '', 99999, 'ASC');
  $id = 0;
  $place = $places->GetEntry($id);
  while($place != null)
  {
		
		$npc = explode(';',$place['npcs']);
		
		$count = ($place['npcs'] == '')?0:count($npc);
		if($place['name'] == 'Admin Island') {
			++$id;
			$place = $places->GetEntry($id);
			continue;
		}

			?>
			<tr>
				<td width="15%"><center><?php echo $place['name']; ?></center></td>
				<td width="15%"><center><?php echo $count; ?> Aktiv</center></td>
				<td width="15%"><center><?php echo ($place['travelable'] == 1)?'Ja':'Nein'; ?></center></td>
			</tr>
			<?php

		
		++$id;
  	$place = $places->GetEntry($id);
	}
	?>
</table>
<div class="spacer"></div>
<?php
if($player->GetArank() >= 2 || $player->GetTeamUser() == "1")
{
?>
<table width="98%" cellspacing="0" border="1" class="borderB borderR borderL">
  <tr>
    <td class="catGradient borderB borderT" colspan="2" align="center"><b>NPCs in den Orten</b></td>
  </tr>
  <tr>
    <td width="20%"><center><b>Ort</b></center></td>
    <td width="80%"><center><b>NPCs</b></center></td>
  </tr>
	<?php
  $places = new Generallist($database, 'places', 'npcs, name', 'display=1 AND planet = "'.$player->GetPlanet().'"', '', 99999, 'ASC');
  $id = 0;
  $place = $places->GetEntry($id);
  while($place != null)
  {
		
		$npc = explode(';',$place['npcs']);
		$npc = implode(",", $npc);
		$i = 0;
    $npcs = '';
		if($place['npcs'] != '') {
      $npc_names = new Generallist($database, 'npcs', 'attack, lp, kp, name, defense', 'id IN ('.$npc.')', '', 99999, 'ASC');
			$npc_found = $npc_names->GetEntry($i);
      while($npc_found != null) {
				$ki = round(($npc_found['lp']/10+$npc_found['kp']/10+$npc_found['attack']+$npc_found['defense'])/4);
        $npcs .= $npc_found['name'].' [KI: '.$ki.']<br />';
        ++$i;
				
					$npc_found = $npc_names->GetEntry($i);
      }
    }
		if($place['name'] == 'Admin Island') {
			++$id;
			$place = $places->GetEntry($id);
			continue;
		}
			?>
			<tr>
				<td width="20%"><center><?php echo $place['name']; ?></center></td>
				<td width="80%"><center><?php echo $npcs; ?> </center></td>
			</tr>
			<?php

		
		++$id;
  	$place = $places->GetEntry($id);
	}
	?>
</table>

<div class="spacer"></div>
<table width="98%" cellspacing="0" border="1" class="borderB borderR borderL">
  <tr>
    <td class="catGradient borderB borderT" colspan="2" align="center"><b>Items in den Orten</b></td>
  </tr>
  <tr>
    <td width="20%"><center><b>Name</b></center></td>
    <td width="80%"><center><b>Items</b></center></td>
  </tr>
<?php
  $places = new Generallist($database, 'places', 'npcs, name, items', 'planet = "'.$player->GetPlanet().'"', '', 99999, 'ASC');
  $id = 0;
  $place = $places->GetEntry($id);
  while($place != null)
  {
		
		$npc = explode(';',$place['items']);
		$npc = implode(",", $npc);
		$i = 0;
    $npcs = '';
		if($place['items'] != '') 
		{
      $npc_names = new Generallist($database, 'items', 'attack, lp, kp, name, defense', 'id IN ('.$npc.')', '', 99999, 'ASC');
			$npc_found = $npc_names->GetEntry($i);
      while($npc_found != null)
		  {
        $npcs .= $npc_found['name'].'<br />';
        ++$i;
		$npc_found = $npc_names->GetEntry($i);
      }
    }
		if($place['name'] == 'Admin Island') {
			++$id;
			$place = $places->GetEntry($id);
			continue;
		}
			?>
			<tr>
				<td width="20%"><center><?php echo $place['name']; ?></center></td>
				<td width="80%"><center><?php echo $npcs; ?> </center></td>
			</tr>
			<?php

		
		++$id;
  	$place = $places->GetEntry($id);
	}
	?>
</table>

<div class="spacer"></div>
<table width="98%" cellspacing="0" border="1" class="borderB borderR borderL">
  <tr>
    <td class="catGradient borderB borderT" colspan="2" align="center"><b>Techniken in den Orten</b></td>
  </tr>
  <tr>
    <td width="20%"><center><b>Name</b></center></td>
    <td width="80%"><center><b>Technik</b></center></td>
  </tr>
<?php
  $places = new Generallist($database, 'places', 'npcs, name, items, learnableattacks', 'planet = "'.$player->GetPlanet().'"', '', 99999, 'ASC');
  $id = 0;
  $place = $places->GetEntry($id);
  while($place != null)
  {
		
		$npc = explode(';',$place['learnableattacks']);
		$npc = implode(",", $npc);
		$i = 0;
    $npcs = '';
		if($place['learnableattacks'] != '') 
		{
      $npc_names = new Generallist($database, 'attacks', 'id, name', 'id IN ('.$npc.')', '', 99999, 'ASC');
			$npc_found = $npc_names->GetEntry($i);
      while($npc_found != null)
		  {
        $npcs .= $npc_found['name'].'<br />';
        ++$i;
		$npc_found = $npc_names->GetEntry($i);
      }
    }
		if($place['name'] == 'Admin Island') {
			++$id;
			$place = $places->GetEntry($id);
			continue;
		}
			?>
			<tr>
				<td width="20%"><center><?php echo $place['name']; ?></center></td>
				<td width="80%"><center><?php echo $npcs; ?> </center></td>
			</tr>
			<?php

		
		++$id;
  	$place = $places->GetEntry($id);
	}
	?>
</table>

<div class="spacer"></div>
<table width="98%" cellspacing="0" border="1" class="borderB borderR borderL">
  <tr>
    <td class="catGradient borderB borderT" colspan="3" align="center"><b>Trainer in den Orten</b></td>
  </tr>
  <tr>
    <td width="20%"><center><b>Name</b></center></td>
		<td width="20%"><center><b>Trainer</b></center></td>
  </tr>
<?php
  $places = new Generallist($database, 'places', 'npcs, name, items, learnableattacks, trainers', 'display=1 AND planet = "'.$player->GetPlanet().'"', '', 99999, 'ASC');
  $id = 0;
  $place = $places->GetEntry($id);
  while($place != null)
  {
		
		$npc = explode(';',$place['trainers']);
		$npc = implode(",", $npc);
		$i = 0;
    $npcs = '';
		if($place['trainers'] != '') 
		{
      $npc_names = new Generallist($database, 'npcs', 'id, name', 'id IN ('.$npc.')', '', 99999, 'ASC');
			$npc_found = $npc_names->GetEntry($i);
      while($npc_found != null)
		  {
        $npcs .= $npc_found['name'].'<br />';
        ++$i;
		$npc_found = $npc_names->GetEntry($i);
      }
    }
		if($place['name'] == 'Admin Island') {
			++$id;
			$place = $places->GetEntry($id);
			continue;
		}
			?>
			<tr>
				<td width="20%"><center><?php echo $place['name']; ?></center></td>
				<td width="80%"><center><?php echo $npcs; ?> </center></td>
			</tr>
			<?php

		
		++$id;
  	$place = $places->GetEntry($id);
	}
	?>
</table>
<div class="spacer"></div>
<?php
}
}
?>