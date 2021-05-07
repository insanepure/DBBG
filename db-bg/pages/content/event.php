<script>
grecaptcha.ready(function() {
  grecaptcha.execute('6Lcd57wUAAAAAMqh2WE8_KEHveQ4Ycw1gRmbZQkI', {action: 'Event'});
});
</script>
<div class="spacer"></div>
<?php
$events = new Generallist($database, 'events', '*', 'isdungeon="0"', '', 9999, 'ASC');
$itemManager = new ItemManager($database);
$active = false;
$id = 0;
$entry = $events->GetEntry($id);
while($entry != null)
{
  //Erde;Wald;1:2:3:4:5;1-31;1-12;0-365;2018-3000
  $pandts = explode('@',$entry['placeandtime']);
  $i = 0;
  $weekDay = date('N');
  $monthDay = date('j');
  $yearDay = date('z')+1;
  $month = date('n');
  $year = date('Y');
  $isPlaceAndPlanet = Event::IsPlaceAndPlanet($player->GetPlanet(), $player->GetPlace(), $entry['placeandtime']);
  if($isPlaceAndPlanet && ($player->GetARank() >= 2 || $player->GetLevel() >= $entry['level']))
  {
    $active = true;
    $isToday = Event::IsToday($player->GetPlanet(), $player->GetPlace(), $entry['placeandtime']);
    $group = $player->GetGroup();
    $amount = 1;
    if($group != null)
    {
      $amount = count($group);
    }

    if($amount > $entry['maxplayers'])
    {
      $amount = $entry['maxplayers'];
    }
?>
<table width="25%" cellspacing="0" cellpadding="1" border="0">
  <tr>
    <td class="boxSchatten catGradient borderB borderT" colspan="6" align="center"><b><?php echo $entry['name']; ?></b></td>
  </tr>
  <tr>
    <tr>
      <td width="25%" class="boxSchatten borderT borderR borderL borderB">
        <center><img src="img/events/<?php echo $entry['image']; ?>.png" style="width:200px;height:300px;">
          <hr><b>Dropchance: <?php echo $entry['dropchance']; ?>%</b>
          <hr><b>
          <?php 
          if(!$entry['displayprice'])
          {
            echo '???';
          }
          else
          {
            if($entry['zeni'] != 0) echo $entry['zeni'].' Zeni<br/>'; 
            if($entry['item'] != '')
            {
                $items = explode(';',$entry['item']);
                foreach($items as $itemID)
                {
                  $item = $itemManager->GetItem($itemID);
                  echo $item->GetRealName().'<br/>';
                }
            }
          }
          ?>
          </b>
          <hr><b>Gruppenbeitritt ab +<?php echo $entry['minplayers']; ?></b>
					<?php 
          if($isToday)
          {
          if($entry['decreasenpcfight'])
          {
          	?><hr><?php echo 'Tägliche NPC Kämpfe: '.$player->GetDailyNPCFights().'/10';
          }
          else if($entry['winable'] != 0)
					{
						$wins = 0;
						$playersData = explode(';', $entry['finishedplayers']);
						$i = 0;
						while(isset($playersData[$i]))
						{
							$playerData = explode('@',$playersData[$i]);
							if($playerData[0] == $player->GetID())
							{
								$wins = $playerData[1];
								break;
							}
							++$i;
						}
						?>
          		<hr><?php if($entry['dailyreset']) echo 'Täglich: '; else echo 'Maximal: '; ?><b><?php echo $wins; ?> / <?php echo $entry['winable']; ?></b>
						<?php
					}
					?>
          <hr>
          <?php
          if($entry['minplayers'] > $amount)
          {
            ?>Zuwenig Spieler in der Gruppe.<?php
          }
          else
          {
            ?>
          <form method="POST" action="?p=event&a=start">
			      <select style="width:90%;" class="select" name="players">
              <?php
              $j = $entry['minplayers'];
              while($j <= $amount)
              {
              ?>
              <option value="<?php echo $j; ?>"><?php echo $j; ?> Spieler</option>
              <?php
              ++$j;
              }
              ?>
            </select>
			<input type="hidden" name="id" value="<?php echo $entry['id']; ?>"><input type="submit" value="Kampf Starten">
          </form>
          <?php
          }
          }
          else
          {
            ?><hr><?php
            echo $entry['schedule'];
          }
          ?>
        </center>
        <div class="spacer"></div>
      </td>
    </tr>
</table>
<?php
  }
$id++;
$entry = $events->GetEntry($id);
}


if(!$active)
{
  ?>
  Hier im Ort finden keine Events statt.
  <?php
}
?>