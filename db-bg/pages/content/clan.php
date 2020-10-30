<div class="spacer"></div>
<?php if($clan->GetImage() != '')
{
	?>
<div  class="catGradient borderT borderB" style="width:600px;">
	<h2>
		<?php echo $clan->GetName(); ?>
	</h2>
</div>
<img src="<?php echo $clan->GetImage(); ?>" style="width:600px; height:400px;"></img>
	<?php
}
else
{
?>
<div  class="catGradient borderT borderB" style="width:600px;">
	<h2>
		<?php echo $clan->GetName(); ?>
	</h2>
</div>
<div style="min-width:100%; max-width:100%;">
	<img src="img/clannoimage.png" style="width:600px; height:400px;"></img>
</div>
<?php
}
?>
<div class="spacer"></div>
<div  class="catGradient borderT borderB" style="width:600px;">
	<h2>
		Clan Text
	</h2>
</div>
<div class="profileBox " style="width:600px; min-height:200px; word-wrap: break-word; overflow:hidden;"?>
  <?php echo $bbcode->parse($clan->GetText()); ?>
</div>
<?php if($clan->GetRules() != '')
{
	?>
<div class="spacer"></div>
<div  class="catGradient borderT borderB" style="width:600px;">
	<h2>
		Clan Regeln
	</h2>
</div>
<div class="profileBox" style="width:600px; min-height:200px; word-wrap: break-word; overflow:hidden;"?>
  <?php echo $bbcode->parse($clan->GetRules()); ?>
</div>
	<?php
}
if($clan->GetRequirements() != '')
{
	?>
<div class="spacer"></div>
<div  class="catGradient borderT borderB" style="width:600px;">
	<h2>
		Clan Aufnahmebedingungen
	</h2>
</div>
<div class="profileBox" style="width:600px; min-height:200px; word-wrap: break-word; overflow:hidden;"?>
  <?php echo $bbcode->parse($clan->GetRequirements()); ?>
</div>
	<?php
}
?>
<div class="spacer"></div>
<div  class="catGradient borderT borderB" style="width:600px;">
	<h2>
		Clan Mitglieder 
	</h2>
</div>
<table width="90%" cellspacing="0" border="0" class="borderT borderR borderL borderB">
  <tr>
    <td width="10%"><b>Level</b></td>
    <td width="50%"><b>User</b></td>
    <td width="20%"><b>Rang</b></td>
    <td width="20%"><b>Rasse</b></td>
  </tr>
<?php
if(!isset($titelManager)) $titelManager = new TitelManager($database);
  
$id = 0;
$list = new Generallist($database, 'accounts', 'id,name,rank,race,arank,titel,level', 'clan="'.$clan->GetID().'"', 'rank', 999, 'ASC');
$entry = $list->GetEntry($id);
while($entry != null)
{
  $titel = $titelManager->GetTitel($entry['titel']);
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
  <tr>
    <td width="5%"><?php echo $entry['level']; ?></td>
    <td width="30%">
		<?php if($clan->GetLeader() == $entry['id']) { echo '<img src="../img/stern2.png" width="15px" height="15px"></img>'; } 
		else if($clan->GetCoLeader() == $entry['id']) { echo '<img src="../img/stern.png" width="15px" height="15px"></img>'; } ?> 
			<a href="?p=profil&id=<?php echo $entry['id']; ?>"><?php echo $titelText.' '.$entry['name']; ?></a></td>
    <td width="10%"><?php echo $entry['rank']; ?></td>
    <td width="15%"><?php echo $entry['race']; ?></td>
  </tr>
<?php
$id++;
$entry = $list->GetEntry($id);
}
?>
</table>
<div class="spacer"></div>