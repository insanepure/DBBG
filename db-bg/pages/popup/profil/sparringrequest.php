<?php
include_once $_SERVER['DOCUMENT_ROOT'].'../../main/www/classes/session.php';
include_once '../../../classes/header.php';
if(!$player->IsLogged())
{
  echo 'Du bist nicht eingeloggt.';
  exit();
}
if($player->GetSparringRequest() == 0)
{
  exit();
}
$otherPlayer = new Player($database, $player->GetSparringRequest(), $actionManager);
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

<div class="bplayerkampf boxSchatten borderB borderR borderT borderL" style="height:70px">
<?php
			if($player->GetSparringTime() == 1)
			{
				$time = $player->GetSparringTime()." Stunde";
			}
			else
			{
				$time = $player->GetSparringTime()." Stunden";
			}
?>
  <?php echo $otherPlayer->GetName(); ?> möchte <?php echo $time ?> trainieren.<br/>
  <table width="100%">
   <tr>
    <td align="center">
  <form method="POST" action="?p=profil&a=acceptsparring">
  <input type="submit" value="Annehmen">
  </form>
     </td>
    <td align="center">
  <form method="POST" action="?p=profil&a=declinesparring">
  <input type="submit" value="Ablehnen">
  </form>
     </td>
    </tr>
  </table>
</div>

<div class="spacer"></div> 
</div>
<?php
$statsWin = Player::CalculateSparringWin($database, $player, $otherPlayer);
?>
<div class="spacer"></div> 
Gewinn pro Stunde bei gleichbleibender KI: <b><?php echo $statsWin; ?></b> Stats.<br>
Verlust: <?php echo $kosten; ?> Zenis.
<div class="spacer2"></div> 