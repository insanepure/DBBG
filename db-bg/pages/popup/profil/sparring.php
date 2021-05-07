<?php
include_once $_SERVER['DOCUMENT_ROOT'].'../../main/www/classes/session.php';
include_once '../../../classes/header.php';
if(!isset($_GET['id']) || !is_numeric($_GET['id']))
{
  echo 'a';
  exit();
}

if(!$player->IsLogged())
{
  echo 'Du bist nicht eingeloggt.';
  exit();
}

if($_GET['id'] == $player->GetID())
{
  echo 'Du kannst kein Sparring mit dir selber betreiben.';
  exit();
}

$otherPlayer = new Player($database, $_GET['id'], $actionManager);
if(!$otherPlayer->IsValid())
{
  echo 'b';
  exit();
}
?>
<div style="height:225px;">
<div class="spacer"></div> 
 
<div class="bplayer1"><div class="bplayer1name smallBG"><b><?php echo $player->GetName(); ?></b><img class="bplayer1image" src="img.php?url=<?php echo $player->GetImage(); ?>"></img></div></div>
<div class="bplayer2"><div class="bplayer2name smallBG"><b><?php echo $otherPlayer->GetName(); ?></b><img class="bplayer2image" src="img.php?url=<?php echo $otherPlayer->GetImage(); ?>"></img></div></div>

<div class="bplayerkampf boxSchatten borderB borderR borderT borderL">
  <form method="POST" action="?p=profil&id=<?php echo $_GET['id']; ?>&a=sparring">
      <select class="select" style="width:200px" name="hours">
        <?php
		    $statsWin = Player::CalculateSparringWin($database, $player, $otherPlayer);
        $hours = 1;
        $maxHours = 24 * 10;
		    $zenis = 100;
        while($hours <= $maxHours)
        {
          $kosten = $zenis * $hours;
            if($hours == 1)
            {
              $time = $hours." Stunde";
            }
            else
            {
              $time = $hours." Stunden";
            }
          ?><option value="<?php echo $hours; ?>"><?php echo $time; ?></option><?php
          $hours++;
        }
        ?>
      </select> 
  <input type="submit" value="Starten">
  </form>
</div>
<div class="spacer"></div> 
</div>
<?php
?>
Gewinn pro Stunde bei gleichbleibender KI: <b><?php echo $statsWin; ?></b> Stats.
<div class="spacer2"></div> 

     <fieldset>
        <legend><b>Was ist Sparring:</b></legend>
       <table>
         <tr><td> Sparring ist eine Möglichkeit für schwächere Spieler, durch gemeinsames Training stärker zu werden und die stärkeren Spieler einzuholen.</td></tr>
         <tr><td>Du erhältst pro Stunde KI, abhängig von der Ki des stärksten Spieler.</td></tr>
         <tr><td>Die KI des stärksten Spieler ist abzüglich der Wertungs- und abzüglich der Level-Stats berechnet.</td></tr>
         <tr><td>Wenn du das Sparring länger als eine Stunde setzt, wird die gewonnene KI für jede Stunde neuberechnet.</td></tr>
         <tr><td>Die Formel lautet: (TopKI - DeineKI), maximal 100 (oder 10% der KI des Top Spielers), * 0.015 = Gewonnene Stats</td></tr>
         <tr><td>Beispiel: (300-100)=200, maximal 100, also 100*0.015 = 1.5 Stats, gerundet = 2 Stats</td></tr>
         <tr><td>Beispiel2: (333-150)=183*0.015 = 2,745, gerundet = 3 Stats</td></tr>
       </table>
</fieldset>