<center>
<div class="spacer"></div>
<?php
$group = $player->GetGroup();
if(isset($group) && count($group) > 1)
{
foreach($group as &$gID)
{
  $gPlayer = new Player($database, $gID, $actionManager);
  if($gPlayer->GetPlace() == $player->GetPlace() && $gPlayer->GetPlanet() == $player->GetPlanet())
  {
    ShowPlayer($gPlayer);
  }
}
}
else
{
  ShowPlayer($player);
}
  
if($story->GetSupportNPC() != 0)
{
  $supportNPC = new NPC($database, $story->GetSupportNPC());
  ShowPlayer($supportNPC);
}
  
?>
<a href="?p=profil">Zurück</a>
</center>