<?php
include_once $_SERVER['DOCUMENT_ROOT'].'../../main/www/classes/session.php';
include_once '../../../classes/header.php';
if(!$player->IsLogged())
{
  echo 'Du bist nicht eingeloggt.';
  exit();
}

$leftMinutes = ceil($player->GetActionCountdown() / 600);

$maxMinutes = floor(min($player->GetLP(), $player->GetKP()) / 100);
$maxMinutes = min($leftMinutes, $maxMinutes);
if($maxMinutes > 100) $maxMinutes = 100;

?>


Möchtest du die Reise beschleunigen?<br/>
Dadurch verringert sich die Reisezeit um <b id="reduceminutes">10</b> Minuten<br/>
Es kostet dich aber <b id="cost1">100</b> KP und <b id="cost2">100</b> LP.<br/>
Zudem erhältst du weniger Statspunkte!<br/>



<br/>
<form action="?p=profil&a=speedup" method="post">
Beschleunigungsfaktor: <span id="factor">1</span><br/>
<input type="range" min="1" max="<?php echo $maxMinutes; ?>" value="1" class="slider" id="myRange" name="factor"><br/>
<input type="submit" value="Beschleunigen">
</form>