<?php
include_once '../../../classes/header.php';
if(!isset($_GET['id']) || !is_numeric($_GET['id']))
{
  exit();
}

if($_GET['id'] == $player->GetID())
{
  echo 'Du kannst dich nicht selbst herausfordern.';
  exit();
}
$otherPlayer = new Player($database, $_GET['id'], $actionManager);
if(!$otherPlayer->IsValid())
{
  exit();
}

?>
<div style="height:225px;">
<div class="spacer"></div> 
 
<div class="bplayer1"><div class="bplayer1name smallBG"><b><?php echo $player->GetName(); ?></b><img class="bplayer1image" src="img.php?url=<?php echo $player->GetImage(); ?>"></img></div></div>
<div class="bplayervs boxSchatten"></div>  
<div class="bplayer2"><div class="bplayer2name smallBG"><b><?php echo $otherPlayer->GetName(); ?></b><img class="bplayer2image" src="img.php?url=<?php echo $otherPlayer->GetImage(); ?>"></img></div></div>


<div class="bplayerkampf boxSchatten borderB borderR borderT borderL">
  <form method="POST" action="?p=profil&id=<?php echo $_GET['id']; ?>&a=challenge">
 <select style="height:40px;" class="select" name="type"><option value="0">Spaßkampf</option><option value="1">Wertungskampf</option><option value="2">Todeskampf</option></select>
  <input type="submit" value="Starten">
  </form>
</div>
<div class="spacer"></div> 
  
</div>

     <fieldset>
        <legend><b>Fakefightverbot:</b></legend>
       <table><tr><td>
         <b><font color="0066FF">§1:</font></b></td><td> Es gilt als Verstoß, einen Kampf absichtlich zu verlieren, mit der Absicht, einen Vorteil für den Gewinner zu erzielen. Kämpfe sollten immer ernst genommen werden. <br><center>Mehr Infos in den <a href="?p=info&info=regeln"><b><u></u>Regeln</u></b></a></center>
</td></tr><tr><td>	
</td></tr>
       </table>
</fieldset>