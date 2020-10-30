<?php
include_once $_SERVER['DOCUMENT_ROOT'].'../../main/www/classes/session.php';
include_once '../../../classes/header.php';
$otherPlayer = new Player($database, $inviter, $actionManager);
if($otherPlayer == null || !$otherPlayer->IsValid())
{
?>
Du wurdest zu einer Gruppe eingeladen, der Spieler existiert jedoch nicht mehr.
<?php
exit();
}
if(!$player->IsLogged())
{
  echo 'Du bist nicht eingeloggt.';
  exit();
}
?>
<div class="spacer"></div> 
<img width="100px" height="100px" src="img.php?url=<?php echo $otherPlayer->GetImage(); ?>"></img><br/>
<div class="spacer"></div> 
Möchtest du  die Gruppe von <?php echo $otherPlayer->GetName(); ?> beitreten?
<div class="spacer"></div> 
<div style="position:relative; width:300px">
  <div style="position:absolute; left:0px;">
<form method="POST" action="?p=profil&a=groupaccept">
  <input type="submit" value="Akzeptieren">
  </form>
  </div>
  <div style="position:absolute; right:0px;">
<form method="POST" action="?p=profil&a=groupdecline">
  <input type="submit" value="Ablehnen">
  </form>
  </div>
  
</div>
<div class="spacer2"></div> 