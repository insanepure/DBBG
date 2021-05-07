<div class="spacer"></div>
<img src="img/timetravel.png"></img>
<div class="spacer"></div>
<h2>Zeitreise</h2>

<?php
if(!$isAtTimeTravelPlanet)
{
  ?>Du kannst nur von der Erde aus die Zeitreise benutzen.<?php
}
else if(!$isAtStartingPlace)
{
  ?>Du kannst nur von dem Ort "<?php echo $playerPlanet->GetStartingPlace(); ?>" die Zeitreise benutzen.<?php
}
else
{
?>

<?php
$planets = new Generallist($database, 'planet', '*', 'cantimetravel=1 AND '.$player->GetStory().' >= maxstory', '', 999999, 'ASC');
?>
<form method="POST" action="?p=timetravel&a=travel">
<select name="destination">
<?php
  $id = 0;
  $planet = $planets->GetEntry($id);
  while($planet != null)
  {
    ?><option><?php echo $planet['name']; ?></option><?php
		++$id;
  	$planet = $planets->GetEntry($id);
	}
?>
</select>
 <div class="spacer"></div>
<input type="submit" value="Reisen">
</form>
<?php
}
?>