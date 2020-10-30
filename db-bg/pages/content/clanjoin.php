<div class="spacer"></div>
<h2>Clan Beitreten</h2>
<?php
$clans = new Generallist($database, 'clans', '*', '', '', 999999, 'ASC');
?>
<form method="POST" action="?p=clanjoin&a=join">
<select name="clanname" size="1">
<?php
  $id = 0;
  $cl = $clans->GetEntry($id);
  while($cl != null)
  {
	  $clname = $cl['name'];
	  echo "<option>".$clname."</option>";
		++$id;
  	$cl = $clans->GetEntry($id);
	}
?>

</select>
    <div class="spacer"></div>
<textarea class="textfield" name="text" maxlength="300000" style="width:400px; height:200px;"></textarea>
    <div class="spacer"></div>
  <input type="submit" value="Beitreten">
</form>
<?php 
if($clanapplication != null)
{
  
  ?>
    <div class="spacer2"></div>
Du hast eine Beitrittsanfrage an den Clan <b><a href="?p=clan&id=<?php echo $clanapplication->GetID(); ?>">[<?php echo $clanapplication->GetTag(); ?>] <?php echo $clanapplication->GetName(); ?></a></b> gesendet.<br/>
Möchtest du die Anfrage zurücknehmen?<br/>
    <div class="spacer"></div>
<form method="POST" action="?p=clanjoin&a=delete">
  <input type="submit" value="Zurücknehmen">
</form>
    <div class="spacer2"></div>
Dein Text lautet:
    <div class="spacer2"></div>
  <?php
  echo $bbcode->parse($player->GetClanApplicationText());
}
?>