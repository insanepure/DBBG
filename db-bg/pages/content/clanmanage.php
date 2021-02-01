<div class="spacer"></div>
<?php if($clan->GetImage() != '')
{
	?>
<div  class="catGradient borderT borderB" style="width:90%;">
	<h2>
		<?php echo $clan->GetName(); ?>
	</h2>
</div>
<div style="min-width:100%; max-width:100%;">
	<img src="img.php?url=<?php echo $clan->GetImage(); ?>" style="width:600px; height:400px;"></img>
</div>
<?php
}
else
{
?>
<div  class="catGradient borderT borderB" style="width:90%;">
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
<div  class="catGradient borderT" style="width:90%;">
			Mitglieder
</div>
<table width="90%" cellspacing="0" border="0" class="borderT borderR borderL borderB">
	<tr>
		<td width="5%"><b>Level</b></td>
		<td width="40%"><b>User</b></td>
		<td width="5%"><b>Rang</b></td>
		<td width="20%"><b>Rasse</b></td>
		<td width="30%"><b>Ort</b></td>
		<td width="20%"><b>Aktion</b></td>
	</tr>
	<?php
if(!isset($titelManager)) $titelManager = new TitelManager($database);
  
$id = 0;
$list = new Generallist($database, 'accounts', '*', 'clan="'.$clan->GetID().'"', 'rank', 999, 'ASC');
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
			<td>
				<?php echo $entry['level']; ?>
			</td>
			<td>
				<?php if($clan->GetLeader() == $entry['id']) { echo '<img src="../img/stern2.png" width="15px" height="15px"></img>'; } 
		          else if($clan->GetCoLeader() == $entry['id']) { echo '<img src="../img/stern.png" width="15px" height="15px"></img>'; } ?>
				<a href="?p=profil&id=<?php echo $entry['id']; ?>">
					<?php echo $titelText.' '.$entry['name']; ?>
				</a>
        <?php
        $timeOut = 30 * 60;
        $online = time() - strtotime($entry['lastaction']) < $timeOut;
        if($online)
	      {
		      $userstatus = "<font color='green'>⦿</font>";
	      }
        else
        {
          $userstatus = "<font color='red'>⦿</font>";
        }
    ?>
      <b> <?php echo $userstatus ?></font></b><br>
			</td>
			<td>
				<?php echo $entry['rank']; ?>
			</td>
			<td>
				<?php echo $entry['race']; ?>
			</td>
			<td>
				<?php echo $entry['place']; ?>
			</td>
			<td>
				<?php 
    if(($entry['id'] != $clan->GetColeader() && $entry['id'] != $clan->GetLeader()) && ($clan->GetLeader() == $player->GetID() || $clan->GetCoLeader() == $player->GetID()))
    { 
      ?><a href="?p=clanmanage&a=kick&id=<?php echo $entry['id']; ?>">Kick</a>
				<?php
    }
    if($entry['id'] != $clan->GetLeader() && $clan->GetLeader() == $player->GetID())
    { 
      ?><br/><a href="?p=clanmanage&a=promote&id=<?php echo $entry['id']; ?>">Befördern</a>
					<?php
			if($clan->GetCoLeader() == $entry['id'])
			{
				?><br/><a href="?p=clanmanage&a=demote&id=<?php echo $entry['id']; ?>">Degradieren</a>
						<?php
			}
    }
    ?>
			</td>
		</tr>
		<?php
$id++;
$entry = $list->GetEntry($id);
}
?>
</table>
<div class="spacer"></div>
<div  class="catGradient borderT" style="width:90%;">
Clan Shoutbox
</div>
<div class="clankasse2 borderT borderB borderL borderR" style="width:90%">
	<div class="clanshoutboxchat borderB">
<table width="100%" cellspacing="0" border="0" class="borderT borderR borderL borderB">
	<?php
	$msgs = $clan->GetShoutboxMSG();
	$i = 0;
	while(isset($msgs[$i]))
	{
		$msg = $msgs[$i];
		?>
  <tr>
    <td><center><?php echo $msg->GetFrom(); ?>:</center></td>
    <td align="left" width="70%"><?php echo htmlentities($msg->GetText()); ?></td>
  </tr>
		<?php
		++$i;
	}
	?>
		</table>
	</div>
	<div class="spacer"></div>
	<div class="clanshoutboxchat2">
		<form method="POST" action="?p=clanmanage&a=post">
	<input type="text" name="shoutboxtext" placeholder="Nachricht" style="height:30px; min-width:400px; max-width:400px;"><input style="height:38px;" type="submit" value="Senden">
		</form>
	</div>
</div>
<div class="spacer"></div>
<div  class="catGradient borderT" style="width:90%;">
Clan Kasse Infos
</div>
<table width="90%" cellspacing="0" border="0" class="borderT borderR borderL borderB">
	<tr>
	<td width="20%">Punkte:</td>
	<td width="80%"><?php echo $clan->GetPoints(); ?></td>
	</tr>
	<tr>
	<td width="20%">Zeni:</td>
	<td width="80%"><?php echo $clan->GetZeni(); ?></td>
	</tr>
</table>
<div class="spacer"></div>
<div  class="catGradient borderT" style="width:90%;">
<b>Clan Kasse Log</b>
</div>
	<div class="clankasse" style="width:90%">
<table width="100%" cellspacing="0" border="0" class="borderT borderR borderL borderB">
  <tr>
    <td width="15%"><center><b>Datum</b></center></td>
    <td width="20%"><center><b>Von</b></center></td>
    <td width="20%"><center><b>An</b></center></td>
    <td width="10%"><center><b>Betrag</b></center></td>
  </tr>
	<?php
	$msgs = $clan->GetLogMSG();
	$i = 0;
	while(isset($msgs[$i]))
	{
		$msg = $msgs[$i];
		?>
  <tr>
    <td width="15%"><center><?php echo $msg->GetDate(); ?></center></td>
    <td width="20%"><center><?php echo $msg->GetFrom(); ?></center></td>
    <td width="20%"><center><?php echo $msg->GetTo(); ?></center></td>
    <td width="10%"><center><?php echo $msg->GetAmount(); ?></center></td>
  </tr>
		<?php
		++$i;
	}
	?>
</table>
</div>
<table width="90%" cellspacing="0" border="0" class="borderB borderR borderL">
  <tr>
    <td class="catGradient borderB borderT" colspan="3" align="center">Zeni Verwaltung</td>
  </tr>
  <tr>
  <form method="POST" action="?p=clanmanage&a=pay">
	<td width="50%"><center><input type="number" name="zeni" placeholder="0"></center></td>
		<td width="50%"><center>Zeni in die Kasse</center></td>
	<td width="50%"><center><input type="submit" value="Einzahlen"></center></td>
  </form>
  </tr>
<?php 
if($clan->GetLeader() == $player->GetID() || $clan->GetCoLeader() == $player->GetID())
{ 
?>
  <tr>
  <form method="POST" action="?p=clanmanage&a=payout">
	<td width="50%"><center><input type="number" name="zeni" placeholder="0"></center></td>
		<td width="50%"><center><select name="playerid">
      <?php
      $list = new Generallist($database, 'accounts', '*', 'clan="'.$clan->GetID().'"', 'rank', 30, 'ASC');
      $id = 0;
      $entry = $list->GetEntry($id);
      while($entry != null)
      {
        ?><option value="<?php echo $entry['id']; ?>"><?php echo $entry['name']; ?></option><?php
        ++$id;
        $entry = $list->GetEntry($id);
      }
      ?>
      </select></center></td>
	<td width="50%"><center><input type="submit" value="Auszahlen"></center></td>
  </form>
  </tr>
<?php 
}
?>
</table>
<?php 
if($clan->GetLeader() == $player->GetID() || $clan->GetCoLeader() == $player->GetID())
{ 
?>
<div class="spacer"></div>

<form method="POST" action="?p=clanmanage&a=rundmail">
<div  class="catGradient borderT" style="width:90%;">
Clan Rundmail
</div>
<table width="90%" cellspacing="0" border="0" class="borderT borderR borderL borderB">
	<tr>
	<td colspan="2" height="20px"></td>
	</tr>
	<tr>
	<td width="20%">Betreff:</td>
	<td width="80%"><input type="text" name="title" placeholder="Betreff" style="width:400px;"></td>
	</tr>
	<tr>
	<td width="20%">Text:</td>
	<td width="80%"><textarea class="textfield" name="text" maxlength="300000" style="width:400px; height:200px;"></textarea></td>
	</tr>
	<tr>
	<td colspan="2"><center><input type="submit" value="Senden"></center></td>
	</tr>
</table>
</form>
<?php 
}
?>
<?php 
$list = new Generallist($database, 'accounts', '*', 'clanapplication="'.$clan->GetID().'"', 'rank', 30, 'ASC');

if($list->GetCount() > 0)
{
	?>
<div class="spacer"></div>
<div  class="catGradient borderT borderB" style="width:90%;">
	<h3>
				Bewerbungen
	</h3>
</div>
<table width="90%" cellspacing="0" border="0" class="borderT borderR borderL borderB">
	<tr>
		<td width="5%"><b>Level</b></td>
		<td width="20%"><b>User</b></td>
    <td width="60%"><b>Text</b></td>
		<td width="15%"><b>Aktion</b></td>
	</tr>
	<?php
$id = 0;
$entry = $list->GetEntry($id);
while($entry != null)
{
  $titel = '';
  if($entry['arank'] === "0")
  {  
    $titel = $entry['titel'];
		if($entry['titel'] === "[GFXer]")
    {
     $titel = "<font color='#A901DB'>".$entry['titel']."</font>";  
    }
		else if($entry['titel'] === "[Writer]")
    {
     $titel = "<font color='#04B4AE'>".$entry['titel']."</font>";  
    }
		else if($entry['titel'] === "[ChatMod]")
    {
     $titel = "<font color='#DBA901'>".$entry['titel']."</font>";  
    }
  }
  else if ($entry['arank'] === "1")
  {   
    $titel = "<font color='#088A29'>".$entry['titel']."</font>"; 
  }
  else if ($entry['arank'] === "2")
  {
    $titel = "<font color='blue'>".$entry['titel']."</font>";   
  }
  else if ($entry['arank'] === "3")
  {
    $titel = "<font color='red'>".$entry['titel']."</font>";  
  }
?>
		<tr>
			<td>
				<?php echo $entry['level']; ?>
			</td>
			<td>
				<a href="?p=profil&id=<?php echo $entry['id']; ?>">
					<?php echo $titel.' '.$entry['name']; ?>
				</a>
			</td>
			<td>
				<?php echo $bbcode->parse($entry['clanapplicationtext']); ?>
			</td>
			<td>
				<?php 
    if($clan->GetLeader() == $player->GetID() || $clan->GetCoLeader() == $player->GetID())
    { 
      ?><a href="?p=clanmanage&a=accept&id=<?php echo $entry['id']; ?>">Annehmen</a><br/><a href="?p=clanmanage&a=decline&id=<?php echo $entry['id']; ?>">Ablehnen</a>
				<?php
    }
    ?>
			</td>
		</tr>
		<?php
$id++;
$entry = $list->GetEntry($id);
}
?>
</table>
<div class="spacer"></div>
<?php
}
?>
<div class="spacer"></div>
<table width="90%" cellspacing="0" border="0" style="text-align: center;" class="borderT borderR borderB borderL">
	<tr>
		<td class="catGradient borderB borderT" colspan="6" align="center"><h2>Verwaltung</h2></td>
	</tr>
	<?php 
if($clan->GetLeader() == $player->GetID() || $clan->GetCoLeader() == $player->GetID())
{ 
?>
	<form action="?p=clanmanage&a=change" method="post" enctype="multipart/form-data">
    <tr>
			<td width="20%"><b>Banner (600x480)</b></td>
			<td width="80%"><input type="file" name="file_upload" /><input type="hidden" name="image"></td>
		</tr>
		<tr>
			<td width="20%"><b>Wappen (30x30)</b></td>
			<td width="80%"><input type="file" name="file_upload2" /><input type="hidden" name="banner"></td>
		</tr>
		<tr>
			<td width="20%"><b>Text</b></td>
			<td width="80%">
				<textarea class="textfield" name="text" maxlength="300000" style="width:400px; height:200px;"><?php echo $clan->GetText(); ?></textarea>
			</td>
		</tr>
		<tr>
			<td width="20%"><b>Regeln</b></td>
			<td width="80%">
				<textarea class="textfield" name="rules" maxlength="300000" style="width:400px; height:200px;"><?php echo $clan->GetRules(); ?></textarea>
			</td>
		</tr>
		<tr>
			<td width="20%"><b>Aufnahmebedingungen</b></td>
			<td width="80%">
				<textarea class="textfield" name="requirements" maxlength="300000" style="width:400px; height:200px;"><?php echo $clan->GetRequirements(); ?></textarea>
			</td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" value="ändern"> </td>
		</tr>
	</form>
	<?php 
}
if($clan->GetLeader() == $player->GetID())
{ 
?>
	<form action="?p=clanmanage&a=delete" method="post" enctype="multipart/form-data">
		<tr>
			<td colspan="6" align="center" height="50px"></td>
		</tr>
		<tr>
			<td colspan="2"><input type="checkbox" name="realcheck"> <input type="submit" value="Clan Löschen"> </td>
		</tr>
		<tr>
			<td colspan="6" align="center" height="20px"></td>
		</tr>
	</form>
	<?php
}
else
{
  ?>
		<form action="?p=clanmanage&a=leave" method="post" enctype="multipart/form-data">
			<tr>
				<td colspan="6" align="center" height="20px"></td>
			</tr>
			<tr>
				<td colspan="2"><input type="checkbox" name="realcheck"> <input type="submit" value="Clan verlassen"> </td>
			</tr>
			<tr>
				<td colspan="6" align="center" height="20px"></td>
			</tr>
		</form>
		<?php
}
?>
</table>
<div class="spacer"></div>