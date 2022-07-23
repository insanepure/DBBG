<?php
include_once $_SERVER['DOCUMENT_ROOT'].'../../main/www/classes/session.php';
include_once '../../../classes/bbcode/bbcode.php';
include_once '../../../classes/header.php';
include_once '../../../classes/places/place.php';
$place = null;
if(isset($_GET['name']) && isset($_GET['planet']))
{
  $place = new Place($database, $_GET['name'], $_GET['planet'], null);
  if(!$place->IsValid() || $place->GetPlanet() != $player->GetPlanet())
  {
	  $place = null;
  }
}
if($place == null)
{
	?>
	Dieser Ort befindet sich nicht auf diesen Planeten.
	<?php
}
else
{
	?>
<div class="spacer"></div>
<div class="reise2">
<div class="reisebild"><img src="img/places/<?php echo $place->GetImage(); ?>.png" width="100%" height="100%"></img></div>
<div class="reisebeschreibung">
	<?php
	echo $bbcode->parse($place->GetDescription());
  
  
  $events = new Generallist($database, 'events', '*', 'isdungeon="0"', '', 9999, 'ASC');
   $eid = 0;
   $eventEntry = $events->GetEntry($eid);
   while($eventEntry != null)
   {
     $isPlaceAndPlanet = Event::IsPlaceAndPlanet($place->GetPlanet(), $place->GetName(), $eventEntry['placeandtime']);
     if($isPlaceAndPlanet || $eventEntry['iseverywhere'])
     {
       $isToday = Event::IsToday($place->GetPlanet(), $place->GetName(), $eventEntry['placeandtime'], $eventEntry['iseverywhere']);
       if($isToday)
       {
         echo '<br><hr> Hier findet heute ein Event statt!';
         break;
       }
     }
     ++$eid;
     $eventEntry = $events->GetEntry($eid);
   }
	?>
</div>
<div class="reisedauer">
	<?php
	if(($place->IsTravelable() || !$place->IsTravelable() && $player->GetARank() >= 2) && $place->GetName() != $player->GetPlace())
	{
		$playerPlace = new Place($database, $player->GetPlace(), $player->GetPlanet(), null);
		$travelTime = 0;
		
		if($player->GetX() != 0 && $player->GetY() != 0)
		{
			$x = $player->GetX();
			$y = $player->GetY();
		}
		else
		{
			$x = $playerPlace->GetX();
			$y = $playerPlace->GetY();
		}
		
		$travelTime = round(abs($place->GetX() - $x) + abs($place->GetY() - $y) / 1.5);
		if($travelTime < 10)
		{
			$travelTime = 10;
		}
		$travelBonus = floor($travelTime * ($player->GetTravelBonus()/100));
		$travelTime2 = $travelTime - $travelBonus;
		$statstrainintravel = floor(($travelTime2 +  $player->GetTravelTimeLeft()) / 60);
    
    
    $travelTimeOriginalHours = floor($travelTime / 60);
    $travelTimeOriginalMinutes = $travelTime - ($travelTimeOriginalHours * 60);
    
    $travelTimeDisplay = $travelTime - $travelBonus;
    $travelTimeHours = floor($travelTimeDisplay / 60);
    $travelTimeMinutes = $travelTimeDisplay - ($travelTimeHours * 60);
		?> 
    Reisedauer: <?php echo $travelTimeHours.':'.$travelTimeMinutes.'H<br/>';?>
    Zeit bis Statspunkt: <?php echo (60-$player->GetTravelTimeLeft()); ?>M<br/>
    <?php if($statstrainintravel > 0) echo "Reise Training: ".$statstrainintravel." Statspunkte";?>
		<form method="POST" action="?p=map&a=travel">
		<input type="hidden" name="destination" value="<?php echo $place->GetName(); ?>">
		<input type="hidden" name="planet" value="<?php echo $place->GetPlanet(); ?>">
		<input type="submit" value="Reisen">
		</form>
<div class="spacer"></div>
		<?php
	}
?>
</div>
</div>
<?php
	}
?>