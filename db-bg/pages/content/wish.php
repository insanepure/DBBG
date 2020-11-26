<div class="spacer2"></div>
<img src="img/radar/<?php echo $dragon; ?>.png"></img>
<br/>
<br/>
<?php 
if($wishLeft == 0)
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
  Du hast noch <?php if($wishLeft == 1) echo '1 Wunsch'; else echo $wishes.' Wünsche'; ?> frei.<br/>
  Wähle weise, denn deine Wahl kann man nie wieder rückgängig machen.<br/>
  <div class="spacer"></div>
  <form method="POST" action="?p=wish&a=wish">
      <select class="select" name="wish">
    <?php
  
  
    $playerWishes = explode(';',$player->GetWishes());
    foreach($wishes as &$wishID)
    {
      $wish = $wishManager->GetWish($wishID);
      if($wish->IsRewishable() || !$wish->IsRewishable() && !in_array($wishID, $playerWishes))
      {
        ?><option value="<?php echo $wishID; ?>"><?php echo $wish->GetDisplayName(); ?></option><?php
      }
    }
    ?>
         </select><br>
   <input type="submit" value="Wünschen">
  </form>
  <?php
}
?>