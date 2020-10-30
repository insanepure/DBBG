<div class="spacer"></div>
<table width="98%" cellspacing="0" border="1" class="borderB borderR borderL">
  <tr>
    <td class="catGradient borderB borderT" colspan="2" align="center"><b>User Meldungen</b></td>
  </tr>
  <tr>
	<td width="70%"><center><b>Text</b></center></td>
	<td width="30%"><center><b>Aktion</b></center></td>
  </tr>
	<?php
  $places = new Generallist($database, 'meldungen', '*', '', 'id', 99999, 'DESC');
  $id = 0;
  $place = $places->GetEntry($id);
  while($place != null)
  {
			?>
			<tr>
				<td width="70%"><center>Der User: <font color ="green"><?php echo $place['von']; ?></font> hat den Spieler : <font color="red"><b><?php echo $place['wen']; ?></b></font> Gemeldet.<br> Am: <b><?php echo $place['datum']; ?></b> Grund: <font color="red"><b><?php echo $place['betreff']; ?></b></font><br><hr><b><u>Nachricht</u></b><br><?php echo $place['text']; ?></center></td>
				<?php
				if($place['status'] == "Unbearbeitet")
				{
					?>
					<td width="30%"><center><a href="?p=report&id=<?php echo $place['id']; ?>&a=delete">Löschen </a><br><a href="?p=report&id=<?php echo $place['id']; ?>&a=edit">Bearbeiten</a></center></td>
					<?php
				}
				else
				{
					?>
					<td width="30%"><center>Status: <?php echo $place['status']; ?></a><br>Bearbeiter: <?php echo $place['bearbeiter']; ?><br>Datum: <?php echo $place['datum2']; ?><br><?php if($player->GetName() == $place['bearbeiter']){?><br><a href="?p=report&id=<?php echo $place['id']; ?>&a=delete">Löschen </a><br><?php } if($player->GetArank() == 3){ if($player->GetName() != $place['bearbeiter']){?> <br><a href="?p=report&id=<?php echo $place['id']; ?>&a=edit">Übernhemen</a><?php }} ?></center></td>
					<?php
				}
				?>
			</tr>
			<?php

		
		++$id;
  	$place = $places->GetEntry($id);
	}
	?>
</table>