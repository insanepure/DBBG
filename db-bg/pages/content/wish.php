<div class="spacer2"></div>
<img src="img/radar/<?php echo $dragon; ?>.png"></img>
<br/>
<br/>
<?php 
if($wishes == 0)
{
  ?>
  <?php echo $dragon; ?> verschwindet wieder in den Dragonballs.<br/>
  Daraufhin fliegen die Dragonballs in die Luft und verstreuen sich in alle Himmelsrichtungen.<br/>
  <?php
}
else
{
  ?>
  Sei gegrüßt, <?php echo $player->GetName(); ?>.<br/>
  Du hast noch <?php if($wishes == 1) echo '1 Wunsch'; else echo $wishes.' Wünsche'; ?> frei.<br/>
  Wähle weise, denn deine Wahl kann man nie wieder rückgängig machen.<br/>
  <div class="spacer"></div>
  <form method="POST" action="?p=wish&a=wish">
      <select class="select" name="wish">
    <?php
    $wishes = explode(';',$player->GetWishes());
    if(!in_array(1, $wishes))
    {
      ?><option value="1">Zeni</option><?php
    }
    if(!in_array(2, $wishes))
    {
      ?><option value="2">Statspunkte</option><?php
    }
    if(!in_array(3, $wishes))
    {
      ?><option value="3">Statspunkte resetten</option><?php
    }
    if(!in_array(4, $wishes))
    {
      ?><option value="4">Skills resetten</option><?php
    }
    ?>
         </select><br>
   <input type="submit" value="Wünschen">
  </form>
  <?php
}
?>