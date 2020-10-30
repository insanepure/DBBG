<?php
if($diffDays >= 0)
{
  ?>
  <div class="spacer"></div>
  <h2>
    Weihnachten
  </h2>
  <a href="?p=christmas&a=open">
  <img src="img/gameevents/christmas/Kalender.png" width="650px;" style="position:relative;">
  <?php
  //$date defined in head
  $timestamp = $date->format('Y-m-d H:i:s');
  $day = 1;

  while($day <= 24)
  {
    $item = $itemManager->GetItem($present[$day]);
    $timeFormat = $date->format('Y-m-d H:i:s');


    $diff = $date->diff($today); 
    $diffDays = (integer)$diff->format( "%R%a" ); // Extract days count in interval

    if($diffDays > 0 || $diffDays == 0 && $lastEventDiffDays == 0)
    {
      ?><img src="img/items/<?php echo $item->GetImage(); ?>.png" width="66px" height="69px" style="position:absolute; top:<?php echo $top[$day]; ?>px; left:<?php echo $left[$day]; ?>px;"></img><?php
    }
    $date->modify('+1 day');
    ++$day;
  }
  ?>
  </img>
  </a>
  <?php
}
?>