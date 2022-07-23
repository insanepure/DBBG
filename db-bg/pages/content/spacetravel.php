<script>
grecaptcha.ready(function() {
  grecaptcha.execute('6Lcd57wUAAAAAMqh2WE8_KEHveQ4Ycw1gRmbZQkI', {action: 'Map'});
});
</script>
<?php

  $where = 'injenseits = 0';
  $map = 'Space.png';
  $planet = new Planet($database, $player->GetPlanet());
  if($planet->IsInJenseits())
  {
    $where = 'injenseits = 1';
    $map = 'ewigkeit.png';
  }

?>
<div class="spacer"></div>
<div class="map boxSchatten borderL borderR borderT borderB" style=" border:1px solid black; background-image: url('img/planets/<?php echo $map; ?>?006')">
  <?php
  $planets = new Generallist($database, 'planet', 'id,name,description,display,x,y,travelable, minstory, maxstory, mapimage', $where, '', 99999, 'ASC');
  $id = 0;
  $entry = $planets->GetEntry($id);
  $x = 0;
  $y = 0;
  while($entry != null)
  {
    $placeCSS = 'mapplace';
    if($player->GetPlanet() == $entry['name'])
    {
      $x = $entry['x'];
      $y = $entry['y'];
    }
    
    $canSee = 
      $player->IsTimeTravelled() && $player->GetPlanet() == $entry['name'] || 
      !$player->IsTimeTravelled() && (($entry['minstory'] == 0 || $player->GetStory() >= $entry['minstory']) && ($entry['maxstory'] == 0 || $player->GetStory() <= $entry['maxstory']));
    
		if($entry['display'] == 1 && $canSee)
		{
				?>
			<div class="tooltip" style="position:absolute; left:<?php echo $entry['x']; ?>px; top:<?php echo $entry['y']; ?>px;"> 
			<a style="cursor:pointer;" onclick="OpenPopupPage('<?php echo $entry['name']; ?>','spacetravel/planet.php?name=<?php echo $entry['name']; ?>')"><div class="mapplace" style="left:40px; top:10px; width:50px; height:50px; background-image: url('img/space/<?php echo $entry['mapimage']; ?>.png?012')"></div></a>
			<span class="tooltiptext" style="width:180px; left:-23px;"><?php echo $entry['name']; ?></span>
			</div> 
			<?php
		}
    ++$id;
    $entry = $planets->GetEntry($id);
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
  ?>
  <img class="mapcharacter" style="left:<?php echo $x+55; ?>px; top:<?php echo $y+25; ?>px; height: 20px; width: 20px;" src="img/planets/Map_<?php echo $race; ?>.gif"></img>
</div>