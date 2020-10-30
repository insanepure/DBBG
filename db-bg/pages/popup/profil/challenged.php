<?php
include_once $_SERVER['DOCUMENT_ROOT'].'../../main/www/classes/session.php';
include_once '../../../classes/header.php';
$fightID = $player->GetChallengeFight();
$challengeFight = new Fight($database, $fightID, $player, $actionManager);
if(!$challengeFight->IsValid())
{
?>
Du wurdest herausgefordert, der Kampf existiert jedoch nicht mehr.
<?php
exit();
}
if(!$player->IsLogged())
{
  echo 'Du bist nicht eingeloggt.';
  exit();
}

$teams = $challengeFight->GetTeams();
$target = $teams[0][0];
?>
<div style="height:225px;">
<div class="spacer"></div> 
 
<div class="bplayer1"><div class="bplayer1name smallBG"><b><?php echo $target->GetName(); ?></b><img class="bplayer1image" src="img.php?url=<?php echo $target->GetImage(); ?>"></img></div></div>
<div class="bplayervs boxSchatten"></div>  
<div class="bplayer2"><div class="bplayer2name smallBG"><b><?php echo $player->GetName(); ?></b><img class="bplayer2image" src="img.php?url=<?php echo $player->GetImage(); ?>"></img></div></div>


<div class="bplayerkampf">
  <div style="position:absolute; left:0px;">
  <form method="POST" action="?p=profil&a=acceptChallenge">
  <input type="submit" value="Akzeptieren">
  </form>
  </div>
  <?php if($challengeFight->GetType() != 7)
  {
  ?>
  <div style="position:absolute; right:0px;">
  <form method="POST" action="?p=profil&a=declineChallenge">
  <input type="submit" value="Ablehnen">
  </form>
  </div>
  <?php
  }
  ?>
<div class="spacer"></div> 
  <?php 
    switch($challengeFight->GetType())
    {
      case 0:
        echo 'Spaß';
        break;
      case 1:
        echo 'Wertung';
        break;
      case 2:
        echo 'Tod';
        break;
      case 7:
        echo 'Dragonball';
        break;
    } ?>
</div>
<div class="spacer"></div> 
<div style="position:absolute; height:50px; top:230px; width:100%;">
<center>
<?php if($challengeFight->GetType() == 7)
{
  $leftTime = (60*10)-$player->GetChallengeTimeSinceNow();
  if($leftTime > 0)
  {
    ?>Dir verbleiben noch <?php echo $leftTime; ?> Sekunden, bis der Herausforderer automatisch gewinnt.<?php
  }
  else
  {
    ?>Wenn du nicht annimmst, hat dein Herausforderer gewonnen.<?php
  }
}
?>
</center>
</div>
</div>