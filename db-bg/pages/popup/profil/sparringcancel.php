<?php
include_once $_SERVER['DOCUMENT_ROOT'].'../../main/www/classes/session.php';
include_once '../../../classes/header.php';
$action = 31;
if(!$player->IsLogged())
{
  echo 'Du bist nicht eingeloggt.';
  exit();
}
if($player->GetSparringCancel() == 0 || $player->GetAction() != $action)
{
  $player->DenySparringCancel();
  echo 'Dein Partner wollte das Sparring abbrechen, es ist jedoch schon vorbei.';
  exit();
}
$otherPlayer = new Player($database, $player->GetSparringPartner(), $actionManager);
if(!$otherPlayer->IsValid())
{
  $player->DenySparringRequest();
  exit();
}
?>
<div style="height:225px;">
<div class="spacer"></div> 
 
<div class="bplayer1"><div class="bplayer1name smallBG"><b><?php echo $player->GetName(); ?></b><img class="bplayer1image" src="img.php?url=<?php echo $player->GetImage(); ?>"></img></div></div>
<div class="bplayer2"><div class="bplayer2name smallBG"><b><?php echo $otherPlayer->GetName(); ?></b><img class="bplayer2image" src="img.php?url=<?php echo $otherPlayer->GetImage(); ?>"></img></div></div>

<div class="bplayerkampf boxSchatten borderB borderR borderT borderL" style="height:60px">
  <?php echo $otherPlayer->GetName(); ?> möchte das Sparring abbrechen.<br/>
  <table width="100%">
   <tr>
    <td align="center">
  <form method="POST" action="?p=profil&a=acceptcancelsparring">
  <input type="submit" value="Annehmen">
  </form>
     </td>
    <td align="center">
  <form method="POST" action="?p=profil&a=declinecancelsparring">
  <input type="submit" value="Ablehnen">
  </form>
     </td>
    </tr>
  </table>
</div>