<center>
  <script>
grecaptcha.ready(function() {
  grecaptcha.execute('6Lcd57wUAAAAAMqh2WE8_KEHveQ4Ycw1gRmbZQkI', {action: 'Radar'});
});
</script>
  <div class="spacer"></div>
<div class="catGradient borderB borderT"><b>Dragonball Radar</b></div>  
<div class="spacer2"></div>
<div class="radarinner">
<div class="radarborder"></div>
  <?php
  if($player->CanWish())
  {
    for($i = 0; $i < count($dbNums); ++$i)
    {
      $position = explode(':',$dbPositions[$i]);
      ?>
      <div class="radarDB blink" style="left:<?php echo $position[0]; ?>px; top:<?php echo $position[1]; ?>px">
      <p class="radarnum"><?php echo $dbNums[$i]; ?></p>
      </div>
      <?php
    }
  }
  ?>
</div>
  
<?php 
if(!$isInactive && $dbNums != null && count($dbNums) == 0 && $player->CanWish() && count($drops) != 7)
{
  ?><br/>Es sind keine Dragonballs in der Nähe, du solltest woanders hinreisen.<br/><?php
}
  if(!$player->CanWish())
  {
    $wishCounter = $player->GetWishCounter();
    ?><b>Der Radar scheint für <?php echo $wishCounter; if($wishCounter == 1) { ?> Wunsch <?php } else { ?> Wünsche <?php } ?>  nicht zu funktionieren.</b><?php
  }
  else if(count($pickables) > 0)
  {
    ?><b>Dragonballs auf den Boden</b><br/><?php
    for($i = 0; $i < count($pickables); ++$i)
    {
      ?>
      <div style="position:relative; width:100px; height:140px; display:inline-block;" class="borderT borderR borderL borderB boxSchatten">
        <img width="100px" height="100px" src="img/radar/<?php echo GetStarName($pickables[$i]->GetStars()); ?>.png"></img>
      <form method="POST" action="?p=radar&a=pickup&id=<?php echo $pickables[$i]->GetID(); ?>">
      <input type="submit" value="Aufheben">
      </form>
      </div>
      <?php
    }
    ?>
    <div class="spacer2"></div>
    <?php
  }
  ?>
  <div class="spacer2"></div>
  <?php
  if($player->CanWish() && count($drops) > 0)
  {
    ?><div class="catGradient borderB borderT"><b>Dragonballs im Besitz</b></div><div class="spacer"></div><?php
    for($i = 0; $i < count($drops); ++$i)
    {
      ?>
      <div style="position:relative; width:100px; height:140px; display:inline-block;" class="borderT borderR borderL borderB boxSchatten">
        <img width="100px" height="100px" src="img/radar/<?php echo GetStarName($drops[$i]->GetStars()); ?>.png"></img>
      <form method="POST" action="?p=radar&a=drop&id=<?php echo $drops[$i]->GetID(); ?>">
      <input type="submit" value="Ablegen">
      </form>
      </div>
      <?php
    }
  }
  ?>
  <div class="spacer2"></div>
  <?php
  if($player->CanWish() && count($fights) > 0)
  {
    ?><b>Kämpfe</b><br/><?php
    for($i = 0; $i < count($fights); ++$i)
    {
      $db = $fights[$i];
      $radarplayer = $db->GetRadarPlayer();
      ?>
      <div style="position:relative; width:150px; height:240px; display:inline-block;" class="borderT borderR borderL borderB boxSchatten">
      <img width="100px" height="100px" src="img/radar/<?php echo GetStarName($fights[$i]->GetStars()); ?>.png"></img>
      <img src="img.php?url=<?php echo $radarplayer->GetImage(); ?>" width="75px" height="75px"></img><br/> 
      <a href="?p=profil&id=<?php echo $radarplayer->GetID(); ?>"><?php echo $radarplayer->GetName(); ?></a>
      <form method="POST" action="?p=radar&a=fight&id=<?php echo $fights[$i]->GetID(); ?>">
      <input type="submit" value="Kämpfen">
      </form>
      </div>
      <?php
    }
    ?>
    <div class="spacer2"></div>
    <?php
  }
  if($player->CanWish() && count($drops) == 7)
  {
    ?>
    <a href="?p=wish"><?php echo $dragon; ?> Rufen</a>
    <?php
  }

  if($player->CanWish() && $isInactive)
  {
  ?>
  Die Dragonballs sind aktuell inaktiv.<br/>
  Wieder aktiv: <?php echo date('d.m.Y H:i:s',strtotime($activeTime)); ?>
  <?php
  }
?>
</center>