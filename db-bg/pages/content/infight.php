<?php 
if(isset($fight) && $fight->IsEnded())
{
?>
<script>
grecaptcha.ready(function() {
  grecaptcha.execute('6Lcd57wUAAAAAMqh2WE8_KEHveQ4Ycw1gRmbZQkI', {action: 'Kampf'});
});
</script>
<div class="spacer"></div>
<a href="?p=fights">Zurück</a>
<div class="spacer"></div>
<?php
}
if(isset($fight) && $fight->GetID() == $player->GetFight() && !$fight->IsEnded())
{
?>
<div class="spacer"></div>
<div class="fightBox boxSchatten smallBG">
  <div class="SideMenuKat catGradient borderB">
    <div class="schatten">Aktionen</div>
  </div>
  <div class="spacer"></div>
  <div class="attacks">
    <div class="spacer"></div>
    <?php
    if($pFighter->GetAction() == 0 && $pFighter->GetLP() != 0)
    {
    ?>
    <form id="captcha" action="?p=infight&a=attack&code=<?php echo $pFighter->GetAttackCode(); ?>" method="post">
    <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
    <input type="hidden" name="action" value="validate_captcha">    
    <select style="min-width:300px;" name="target">
      <?php
        $i = 0;
        $selected = false;
        $pTarget = $pFighter->GetPreviousTarget();
        while(isset($teams[$i]))
        {
          $players = $teams[$i];
          $j = 0;
          while(isset($players[$j]))
          {
            $fighter = $players[$j];
            if($pFighter->GetTeam() != $fighter->GetTeam() && $fighter->GetLP() == 0 && $fighter->GetID() == $pTarget)
            {
              $pTarget = 0;
            }
            ++$j;
            
          }
          ++$i;
        }
      
        $i = 0;
        while(isset($teams[$i]))
        {
          $players = $teams[$i];
          $j = 0;
          while(isset($players[$j]))
          {
            $fighter = $players[$j];
            if($fighter->IsInactive() || $pFighter->GetTeam() != $fighter->GetTeam() && $fighter->GetLP() == 0)
            {
              ++$j;
              continue;
            }
            ?>
            <option value="<?php echo $fighter->GetID(); ?>" 
            <?php 
            if($pTarget == $fighter->GetID() || $pTarget == 0 && !$selected && $fighter->GetTeam() != $pFighter->GetTeam() && $fighter->GetLP() != 0)
            {
              ?> selected<?php
              $selected = true;
            }
            ?>
            ><?php echo $fighter->GetName(); ?></option>
            <?php
            $j++;
          }
          ++$i;
        }
      ?>
    </select>
    <div class="spacer"></div>
    <?php
    $i = 0;
    $attacks = explode(';',$pFighter->GetAttacks());
    if($fight->HasPlayerWithApetail())
      array_push($attacks, 296); //Affenschwanz abtrennen
      
    while(isset($attacks[$i]))
    {
      $attack = $fight->GetAttack($attacks[$i]);
    ?>
    <div class="tooltip" style="height:55px;"> 
    <button type="submit" class="attackButton boxSchatten" name="attack" value="<?php echo $attack->GetID(); ?>"><input type="hidden" name="kampfid" value="<?php echo $fight->GetID();?>"><img src="<?php echo $attack->GetImage(); ?>" class="attack"></img></button> 
    <span class="tooltiptext"><?php echo $attack->GetName(); ?></span>
    </div> 
    <?php
      ++$i;
    }
    ?>
    </form>
  <div class="spacer"></div>
    <?php
    }
    else
    {
    ?>
  Warte auf andere Spieler.<br/>
  <a href="?p=infight&kampfid=<?php echo $fight->GetID();?>">Aktualisieren</a>      
  <?php
    }
    ?>
  </div>
  <div class="spacer"></div>
</div>
<?php if($player->GetChatActive() && $player->GetChatbann() == 0)
{
 /*
 ?>
 <div class="spacer"></div>
  <div class="fightBox boxSchatten smallBG">
    <div class="SideMenuKat catGradient borderB">
      <div class="schatten">Chat</div>
    </div>
    <div class="spacer"></div>
    <div class="inkampfchat" id="chat-text">


    </div>
    <div class="spacer"></div>
    <div class="inkampfchats" style="width:600px">
        <input type="text" onkeydown = "if (event.keyCode == 13) document.getElementById('chatChannelButton').click()" id="chatChannel" style="width:140px; height:15px;" value="<?php echo $chat->GetChannel(); ?>" placeholder="Channel">
        <Button type="button" id="chatChannelButton" onclick="SwitchChannel()">Wechseln</Button>
      <input type="text" onkeydown = "if (event.keyCode == 13) document.getElementById('chatMessageButton').click()" id="chatMessage" style="height:60%; width:35%;"> 
      <input style="height:90%" id="chatMessageButton" type="submit" onclick="SendMessage()" value="Senden">
    </div>
    <div class="spacer"></div>
  </div>
  <?php
  */
}
  else
  {
    echo "";
  }
  ?>
<div class="spacer"></div>
<?php
}
else
{
?>
<div class="spacer"></div>
<?php
}
?>
<div class="spacer"></div>
<div class="fightBox boxSchatten smallBG">
  <div class="SideMenuKat catGradient borderB">
    <div class="schatten">Verlauf</div>
  </div>
  <div class="spacer"></div>
  <?php 
  $weather = $fight->GetWeather();
  switch($weather)
  {
    case 1:
      $weather = 'sunny';
      break;
    case 2:
      $weather = 'cloudy';
      break;
    case 3:
      $weather = 'stars';
      break;
    case 4:
      $weather = 'moon';
      break;
  }
  ?>
  <img src="img/weather/<?php echo $weather; ?>.jpg"></img>
  <table width="100%">
  <?php echo $fight->GetText(); ?>
  </table>
  <div class="spacer"></div>
</div>

<div class="spacer"></div>
<?php if($player->GetARank() >= 2 || $fight->IsEnded())
{
  ?>
Die Melde-Funktion ist nur zum Melden von Fehlern.
<div class="spacer"></div>
<form method="post" action="?p=infight&fight=<?php echo $fight->GetID(); ?>&a=meld">
<input class="submit" type="submit" value="Melden">
</form>
<div class="spacer"></div>
  <?php
}
?>
