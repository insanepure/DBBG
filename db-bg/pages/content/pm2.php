<?php

$start = 0;
$limit = 30;
$timeOut = 30;
if(isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0)
{
  $start = $limit * ($_GET['page']-1);
}
if(!isset($_GET['p2']) || isset($_GET['p2']) && $_GET['p2'] == 'inbox')
{
?>
<script language="JavaScript">
function toggle(source) {
  checkboxes = document.getElementsByName('deleteID[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
function toggle_sys(source) {
  //id = document.getElementById();
  checkboxes = document.getElementsByName('deleteID[]');
  //alert( checkboxes[i].getElementById('0'));
  //alert("Test");
  for(var i=0, n=checkboxes.length;i<n;i++) {
    if (document.getElementById('0'+i)) {
      document.getElementById('0'+i).checked = source.checked;
    }
  }
}
</script>
<form method="POST" action="?p=pm2<?php if(isset($_GET['page'])) echo '&page='.$_GET['page']; ?>&a=action">
<table width="98%" cellspacing="0" border="0">
  <tr>
    <td colspan=6 height="20px">
    </td>
  </tr>
  <tr>
    <td colspan=6 class="catGradient borderT borderB">
      <b><center><font color="white"><div class="schatten">Empfangene Nachrichten</div></font></center></b>
    </td>
  </tr>
  <tr class="boxSchatten">
    <td width="25%"><b><center>Datum</center></b></td>
    <td width="25%"><b><center>Von</center></b></td>
    <td width="30%"><b><center>Betreff</center></b></td>
    <td width="20%"><b><center>Aktion</center></b></td>
  </tr>
  <?php
  $PMManager->LoadInbox($start, $limit, true);
  $i = 0;
  $pm = $PMManager->GetPM($i);
  while($pm != null)
  {
    ?>
    <tr>
         <td width="25%" class="boxSchatten"><center><?php if($pm->GetRead() == 0) echo '<b>'; ?><?php if($pm->GetSenderName() == "Chat" OR $pm->GetSenderName() == "System" ) {echo "<font color='red'>".$pm->GetTime()."</font>";}else{echo $pm->GetTime();} ?><?php if($pm->GetRead() == 0) echo '</b>'; ?></center></td>
      <td width="25%" class="boxSchatten"><center><?php if($pm->GetRead() == 0) echo '<b>'; ?><a href="?p=profil&id=<?php echo $pm->GetSenderID(); ?>"><?php if($pm->GetSenderName() == "Madusanka2013" OR $pm->GetSenderName() == "Chat" OR $pm->GetSenderName() == "System") {echo "<font color='red'>",$pm->GetSenderName(),"</font>";} else {echo $pm->GetSenderName();} ?></a><?php if($pm->GetRead() == 0) echo '</b>'; ?></center></td>
      <td width="30%" class="boxSchatten"><center><?php if($pm->GetRead() == 0) echo '<b>'; ?><?php if($pm->GetSenderName() == "Chat" OR $pm->GetSenderName() == "System" ){echo "<font color='red'>".$pm->GetTopic()."</font>";}else{echo $pm->GetTopic();} ?><?php if($pm->GetRead() == 0) echo '</b>'; ?></center></td>
      <td width="20%" class="boxSchatten"><center>
        <?php if($pm->GetRead() == 0) echo '<b>'; ?>
        <a href="?p=pm2&p2=read&id=<?php echo $pm->GetID(); ?>"><?php if($pm->GetSenderName() == "Chat" OR $pm->GetSenderName() == "System" ){echo "<font color='red'>Lesen</font></a>";} else {echo "Lesen</a>";} ?>| 
        <input type="checkbox" id="<?php echo $pm->GetSenderID().$i; ?>" name="deleteID[]" value="<?php echo $pm->GetID(); ?>">
        <?php if($pm->GetRead() == 0) echo '</b>'; ?></center></td>
    </tr>
    <?php
    ++$i;
    $pm = $PMManager->GetPM($i);
  }
  ?>
</table>
<?php
  $total = $PMManager->LoadPMCount(true, true);
  $pages = ceil($total / $limit);
if($pages != 1)
{
  ?>
  <div class="spacer"></div>
  <?php
  $i = 0;
  while($i != $pages)
  {
    ?>
    <a href="?p=pm2&page=<?php echo $i+1; if(isset($_GET['p2'])) echo '&p2='.$_GET['p2']; ?>">Seite <?php echo $i+1; ?></a> 
    <?php
    ++$i;
  }
}
?>
<div class="spacer"></div>
<table width="98%" cellspacing="0" border="0">
  <tr>
    <td colspan=6 height="20px">
    </td>
  </tr>
  <tr>
    <td colspan=6 class="catGradient borderT borderB">
      <b><center><font color="white"><div class="schatten">Aktionen</div></font></center></b>
    </td>
  </tr>
    <tr>
      <td width="25%" class="boxSchatten"><center><input type="checkbox" name="deleteAll" onClick="toggle(this)" /> Alle Markieren<br/></center></td>
      <td width="30%" class="boxSchatten"><center>
        <button type="submit" name ="action" value="delete">
        Markierte Löschen
        </button>
        <br/><br/> 
        <button type="submit" name ="action" value="read">
        Markierte Lesen/Unlesen
        </button>
        <br/><br/> 
        <button type="submit" name ="action" value="markread">
        Ungelesene als gelesen markieren
        </button>
        <br/><br/> 
        <button type="submit" name ="action" value="deleteall">
        Alle löschen
        </button>
    </tr>
</table>
</form>
<?php
}
else if(isset($_GET['p2']) && $_GET['p2'] == 'read')
{
  $pm = null;
  if(isset($_GET['id']) && is_numeric($_GET['id']))
  {
    $id = $_GET['id'];
    $pm = $PMManager->LoadPM($id);
  }
  if($pm != null)
  {
?>
<table width="100%" class="boxSchatten borderT borderR borderL borderB" style="table-layout:fixed;" cellspacing="0">
  <tr>
    <td width="10%" height="50px" class="catGradient borderB">
      <img src="img.php?url=<?php echo $pm->GetSenderImage(); ?>" width="50px" height="50px"></img>
    </td>
    <td width="20%" class="catGradient borderB authortime">
      <a href="?p=profil&id=<?php echo $pm->GetSenderID(); ?>" class="textColor"><?php echo $pm->GetSenderName(); ?><br/></a>
      <?php echo $pm->GetTime(); ?>
    </td>
    <td width="70%" class="catGradient borderB headtext" align="center">
      <?php echo $pm->GetTopic(); ?>
    </td>
  </tr>
  <tr>
    <td colspan="3" style="width:610px; min-height:200px; word-wrap: break-word; overflow:hidden;">
      <?php 
      if($pm->IsHTML())
      {
        echo $pm->GetText();
      }
      else
      {
        echo $bbcode->parse(htmlspecialchars_decode($pm->GetText())); 
      }
      ?>
    </td>
  </tr>
  <tr>
    <td colspan="3" class="footer borderT" align="center">
      <a href="?p=pm2&p2=send&name=<?php echo $pm->GetSenderName(); ?>&topic=<?php echo $pm->GetTopic(); ?>">Antworten</a> / 
      <a href="?p=pm2&a=delete&deleteID=<?php echo $pm->GetID(); ?>">Löschen</a>
    </td>
  </tr>
</table>
<?php
  }
}
?>