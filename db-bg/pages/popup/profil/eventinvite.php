<?php
include_once $_SERVER['DOCUMENT_ROOT'].'../../main/www/classes/session.php';
include_once '../../../classes/header.php';
$fightID = $player->GetEventInvite();
$eventFight = new Fight($database, $fightID, $player, $actionManager);
if(!$eventFight->IsValid())
{
?>
Du wurdest zu einem Event eingeladen, der Kampf existiert jedoch nicht mehr.
<?php
exit();
}
if(!$player->IsLogged())
{
  echo 'Du bist nicht eingeloggt.';
  exit();
}

$teams = $eventFight->GetTeams();
?>
<div style="height:80px;">
  <div class="spacer"></div> 
   Du wurdest zum Event "<?php echo $eventFight->GetName(); ?>" von deiner Gruppe eingeladen.
  <div class="spacer"></div> 
  <div style="position: relative; width:300px;">
    <div style="position:absolute; left:0px;">
    <form method="POST" action="?p=profil&a=acceptEvent">
    <input type="submit" value="Akzeptieren">
    </form>
    </div>
    <div style="position:absolute; right:0px;">
    <form method="POST" action="?p=profil&a=declineEvent">
    <input type="submit" value="Ablehnen">
    </form>
    </div>
  </div>
</div>