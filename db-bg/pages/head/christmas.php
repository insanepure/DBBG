<?php
include_once 'classes/items/itemmanager.php';
$itemManager = new ItemManager($database);

$senzu = 102;
$lolipop = 103;
$muffin = 99;
$kekse = 100;
$zuckerstange = 98;
$zuckersenzu = 101;
$kaffebonbon = 97;
$grosserbonbon = 96;
$bonbon = 95;
$hemd = 104;
$handschuhe = 105;
$schuhe = 106;
$hose = 107;

$day = 1;
$present[1] = $grosserbonbon;
$top[1] = 98;
$left[1] = 60;

$present[2] = $handschuhe; //Change
$top[2] = 126;
$left[2] = 200;

$present[3] = $senzu;
$top[3] = 80;
$left[3] = 326;

$present[4] = $lolipop;
$top[4] = 143;
$left[4] = 471;

$present[5] = $bonbon;
$top[5] = 101;
$left[5] = 551;

$present[6] = $zuckerstange;
$top[6] = 180;
$left[6] = 10;

$present[7] = $zuckersenzu;
$top[7] = 213;
$left[7] = 98;

$present[8] = $muffin;
$top[8] = 223;
$left[8] = 177;

$present[9] = $hose; // change
$top[9] = 182;
$left[9] = 312;

$present[10] = $kekse;
$top[10] = 183;
$left[10] = 381;

$present[11] = $muffin;
$top[11] = 250;
$left[11] = 483;

$present[12] = $grosserbonbon;
$top[12] = 208;
$left[12] = 571;

$present[13] = $kaffebonbon;
$top[13] = 323;
$left[13] = 77;

$present[14] = $lolipop;
$top[14] = 285;
$left[14] = 295;

$present[15] = $hemd;
$top[15] = 287;
$left[15] = 402;

$present[16] = $zuckersenzu;
$top[16] = 310;
$left[16] = 577;

$present[17] = $senzu;
$top[17] = 427;
$left[17] = 23;

$present[18] = $kekse;
$top[18] = 369;
$left[18] = 207;

$present[19] = $bonbon;
$top[19] = 379;
$left[19] = 309;

$present[20] = $zuckerstange;
$top[20] = 430;
$left[20] = 404;

$present[21] = $senzu;
$top[21] = 416;
$left[21] = 514;

$present[22] = $schuhe;
$top[22] = 502;
$left[22] = 188;

$present[23] = $zuckersenzu;
$top[23] = 480;
$left[23] = 295;

$present[24] = $senzu;
$top[24] = 515;
$left[24] = 548;

$date = new DateTime();
$date->modify('2019-12-01 00:00:00');

$today = new DateTime(); // This object represents current date/time
$today->setTime( 0, 0, 0 ); // reset time part, to prevent partial comparison   
    
$lastEventAction = new DateTime(); // This object represents current date/time
$lastEventAction->modify($player->GetLastEventAction());
$lastEventAction->setTime(0,0,0);
$lastEventDiff = $lastEventAction->diff( $today ); 
$lastEventDiffDays = (integer)$lastEventDiff->format( "%R%a" ); // Extract days count in interval
  
  $diff = $date->diff( $today ); 
  $diffDays = (integer)$diff->format( "%R%a" ); // Extract days count in interval

if(isset($_GET['a']) && $_GET['a'] == 'open')
{
  $today = new DateTime(); // This object represents current date/time
  $today->setTime( 0, 0, 0 ); // reset time part, to prevent partial comparison
  if($diffDays >= 0 && $diffDays <= 23)
  {
    $presentDay = $diffDays+1;
    $userPresent = $present[$presentDay];
    $presentItem = $itemManager->GetItem($present[$presentDay]);
    
    if($lastEventDiffDays > 0)
    {
      $player->AddItems($presentItem, $presentItem, 1);
      $player->UpdateLastEventAction();
      $message = 'Du hast '.$presentItem->GetName().' erhalten!';
      $lastEventDiffDays = 0;
    }
    else
      $message = 'Du hast die Tür schon geöffnet.';
    
  }
  
}


?>