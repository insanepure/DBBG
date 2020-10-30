<?php
$currentTime = new DateTime();

function IsTimeNow($startTime, $endTime)
{
  $currentTime = new DateTime();
  $startTime = DateTime::createFromFormat('H:i', $startTime);
  $endTime = DateTime::createFromFormat('H:i', $endTime);
  return $currentTime > $startTime && $currentTime < $endTime;
}
?>

<h2>
  Arena
</h2>
Aktuelle Arenapunkte: <?php echo $player->GetArenaPoints(); ?><br/>
Aktuelle Teilnehmer: <?php echo $arena->GetFighterCount(); ?><br/>
<br/>
<?php 

if($arena->IsFighterIn($player->GetID()))
{
  ?>

  <div id="captcha_text">
    Lade ...
  </div>
  <form id="captcha" style="display:none" action="?p=arena&a=search" method="post">
  <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
  <input type="hidden" name="action" value="validate_captcha">   
  <input type="submit" value="Kampf suchen">
  </form>
  <br/>
  <a href="?p=arena&a=leave">Arena verlassen</a>
  <?php
}
else
{
  ?>
  <a href="?p=arena&a=join">Arena beitreten</a>
  <?php
}
?>
<div class="spacer"></div>

<table width="100%" cellspacing="0" border="0">
  <tr>
    <td colspan=6 height="20px">
    </td>
  </tr>
  <tr>
  <td colspan=6 class="catGradient borderT borderB" align="center">
      <b> <font color="white"><div class="schatten">Shop</div></font> </b>
    </td>
  </tr>
  <tr style ="boxSchatten">
    <td width="10%"  align="center"><b> Bild </b></td>
    <td width="20%"  align="center"><b> Name </b></td>
    <td width="30%"  align="center"><b> Wirkung </b></td>
    <td width="10%"  align="center"><b> Preis </b></td>
    <td width="10%"  align="center"><b> Anzahl </b></td>
    <td width="10%"  align="center"><b> Aktion </b></td>
  </tr>
  <?php
  $select = "*";
  $where = 'arenapoints != 0';
  $order = 'lv DESC, arenapoints';
  $from = 'items';
  $list = new Generallist($database, $from, $select, $where, $order, 9999999, 'DESC');
  $i = 0;
  $data = $list->GetEntry($i);
  while($data != null)
  {
    $item = $itemManager->GetItem($data['id']);
    if($item->GetLevel() > $player->GetLevel())
    {
      $data = $list->GetEntry(++$i);
      continue;
    }
    ?>
  <tr>
      <form method="POST" action="?p=arena&a=buy">
    <td style ="boxSchatten" align="center"> 
      <img class="boxSchatten borderT borderR borderL borderB" src="img/items/<?php echo $item->GetImage(); ?>.png" style="width:50px;height:50px;"> 
      <input type="hidden" name="item" value="<?php echo $item->GetID(); ?>">
    </td>
    <td style ="boxSchatten" align="center"> <b><?php echo $item->GetName(); ?></b> </td>
    <td style ="boxSchatten" align="center">
    <?php
    echo $item->DisplayEffect();
      if($item->GetLevel() != 0) echo 'Benötigt Level '.$item->GetLevel(); 
    ?>
    </td>
        
    <td style ="boxSchatten" align="center"> <?php echo $item->GetArenaPoints(); ?> Punkte </td>
    <td style ="boxSchatten" align="center">
      <select style="width:90%;" class="select" name="amount">
        <?php
        $j = 1;
			  $amount = 99;
        while($j <= $amount)
        {
        ?>
        <option value="<?php echo $j; ?>"><?php echo $j; ?></option>
        <?php
        ++$j;
        }
        ?>
      </select>
    </td>
    <td style ="boxSchatten"> 
      <input type="submit" style="width:90%" value="Kaufen">
    </td>
    </form>
  </tr>
    <?php
    $data = $list->GetEntry(++$i);
  }
  ?>
</table>

