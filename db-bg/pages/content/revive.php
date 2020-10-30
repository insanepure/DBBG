<div class="spacer"></div>
<div class="catGradient borderB borderT"><b>Wiederbeleben</b></div>
<div class="spacer"></div>
<?php
if($reviveTime == 0)
{
  ?>Du kannst dich jetzt wiederbeleben.<br/>
  Möchtest du wiederbelebt werden?<br/><br/>
  <form method="POST" action="?p=revive&a=revive">
    <input type="submit" value="Ja">
  </form>
  <?php
}
else
{
  ?> Deine Zeit ist noch nicht soweit.<br/>
  Du musst noch <b>
  <?php
  $timeDiffMinutes = $reviveTime/60;
  $timeDiffHours = $timeDiffMinutes/60;
  $timeDiffDays = $timeDiffHours/24;
  if($reviveTime < 60)
  {
    $timeDiffSeconds = floor($reviveTime);
    echo $timeDiffSeconds;
    if($timeDiffSeconds == 1) echo ' Sekunde'; else echo ' Sekunden';
  }
  else if($timeDiffMinutes < 60)
  {
    $timeDiffMinutes = floor($timeDiffMinutes);
    echo $timeDiffMinutes;
    if($timeDiffMinutes == 1) echo ' Minute'; else echo ' Minuten';
  }
  else if($timeDiffHours < 24)
  {
    $timeDiffHours = floor($timeDiffHours);
    echo $timeDiffHours;
    if($timeDiffHours == 1) echo ' Stunde'; else echo ' Stunden';
  }
  else
  {
    $timeDiffDays = floor($timeDiffDays);
    echo $timeDiffDays;
    if($timeDiffDays == 1) echo ' Tag'; else echo ' Tage';
  }
  ?></b>
  warten.<br/>
  <?php
}
?>