<?php
include_once $_SERVER['DOCUMENT_ROOT'].'../../main/www/classes/session.php';
include_once '../../../classes/header.php';
if(!isset($_GET['id']) || !is_numeric($_GET['id']))
{
  exit();
}
if(!$player->IsLogged())
{
  echo 'Du bist nicht eingeloggt.';
  exit();
}

if($_GET['id'] == $player->GetID())
{
  echo 'Du kannst dich nicht selbst zum Kampf herausfordern.';
  exit();
}

?>
<form action="?p=profil&a=challenge&id=<?php echo $_GET['id']; ?>" method="post">
<table width="100%" cellspacing="0" border="0">
  <tr>
    <td colspan="3" height="15px"></td>
  </tr>
<tr>
  <td width="30%"><center><select style="width:90%;" class="select" name="type"><option value="0">Spaßkampf</option><option value="1">Wertungskampf</option><option value="2">Todeskampf</option></select></center></td>
</tr>
  <tr>
    <td colspan="3" height="12px"></td>
  </tr>
<tr>
  <td colspan=3 width="30%" height="30px"><center><input type="submit" value="Starten"></center></td>
</tr>
</table>
</form>
     <fieldset>
        <legend><b>Fakefightverbot:</b></legend>
       <table><tr><td>
         <b><font color="0066FF">§1:</font></b></td><td> Es gilt als Verstoß, einen Kampf absichtlich zu verlieren, mit der Absicht, einen Vorteil für den Gewinner zu erzielen. Kämpfe sollten immer ernst genommen werden. <br><center>Mehr Infos in den <a href="?p=info&info=regeln"><b><u></u>Regeln</u></b></a></center>
</td></tr><tr><td>	
</td></tr>
       </table>
</fieldset>
<br/>