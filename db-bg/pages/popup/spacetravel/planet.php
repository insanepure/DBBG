<?php
include_once $_SERVER['DOCUMENT_ROOT'].'../../main/www/classes/session.php';
include_once '../../../classes/bbcode/bbcode.php';
include_once '../../../classes/header.php';
include_once '../../../classes/planet/planet.php';
$planet = null;
if(isset($_GET['name']))
{
  $planet = new Planet($database, $_GET['name']);
  if(!$planet->IsValid())
  {
	  $planet = null;
  }
}
if($planet == null || !$planet->CanSee($player->GetStory()))
{
	?>
	Dieser Planet existiert nicht.
	<?php
}
else
{
	?>
<div class="spacer"></div>
<div class="reise2">
<div class="reisebild"><img src="img/planets/<?php echo $planet->GetImage(); ?>.png?001" width="100%" height="100%"></img></div>
<div class="reisebeschreibung">
<?php
echo $bbcode->parse($planet->GetDescription());
?>
</div>
<div class="reisedauer">
	<?php
  if($planet->GetName() == $player->GetPlanet())
  {
    ?> Du befindest dich hier. <?php 
  }
	else if($planet->IsTravelable() && $player->GetPlanet() != 'Jenseits')
	{
		$playerPlanet = new Planet($database, $player->GetPlanet());
		$travelTime = 0;
    
		$x = $playerPlanet->GetX();
		$y = $playerPlanet->GetY();
		
		$travelTime = abs($planet->GetX() - $x) + abs($planet->GetY() - $y);
		$travelTime = round($travelTime * 4);
		if($travelTime < 10)
		{
			$travelTime = 10;
		}
		$statstrainintravel = floor(($travelTime +  $player->GetTravelTimeLeft()) / 60);
    
    $travelTimeDisplay = $travelTime;
    $travelTimeHours = floor($travelTimeDisplay / 60);
    $travelTimeMinutes = $travelTimeDisplay - ($travelTimeHours * 60);
    
    
		?> 
    Reisedauer: <?php echo $travelTimeHours.':'.$travelTimeMinutes.'H<br/>';?>
    Zeit bis Statspunkt: <?php echo (60-$player->GetTravelTimeLeft()); ?> Minuten<br/>
    <?php if($statstrainintravel > 0) echo "Reise Training: ".$statstrainintravel." Statspunkte";?>
		<form method="POST" action="?p=spacetravel&a=travel">
		<input type="hidden" name="destination" value="<?php echo $planet->GetName(); ?>">
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