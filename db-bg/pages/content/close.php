<div class="spacer"></div>
<table width="98%" cellspacing="0" border="1" class="borderB borderR borderL">
  <tr>
    <td class="catGradient borderB borderT" colspan="8" align="center"><b>Kampf Info</b></td>
  </tr>
  <tr>
    <td width="20%"><center><b>Kampf ID</b></center></td>
    <td width="20%"><center><b>Spieler ID</b></center></td>
	<td width="20%"><center><b>NPC Kampf</b></center></td>
	<td width="20%"><center><b>NPC ID</b></center></td>
							
  </tr>
	<?php
	$id = $_GET['id'];
$places = new Generallist($database, 'fights', '*', 'id = "'.$id.'"', '', 99999, 'ASC');
  $id = 0;
  $place = $places->GetEntry($id);
  while($place != null)
  {if ($place['npcid'] > 0)
  {$npcfight = "Ja";}else{$npcfight = "Nein";}?>
			<tr>
				<td width="20%"><center><?php echo $place['id']; ?></center></td>
				<td width="20%"><center><?php echo $place['gainaccs']; ?> </center></td>
				<td width="20%"><center><?php echo $npcfight; ?> </center></td>
				<td width="20%"><center><?php echo $place['npcid']; ?> </center></td>
			</tr>
			<?php
		++$id;
  	$place = $places->GetEntry($id);
	}
	?>
</table>