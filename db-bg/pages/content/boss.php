<script>
grecaptcha.ready(function() {
  grecaptcha.execute('6Lcd57wUAAAAAMqh2WE8_KEHveQ4Ycw1gRmbZQkI', {action: 'Dungeon'});
});
</script>
<div class="spacer"></div>
     <fieldset>
        <legend><b>Hinweis</b></legend>
			 <table><tr><td align="center"><font color="red"><b><u>Achtung!</u></b></font><br/> Bosskämpfe kosten dich <font color="red"><b><u>tägliche NPC-Kämpfe</u></b></font> wenn du einen Gewinn erhältst.<br/>Du erhältst keine Items, wenn du alle täglichen NPC-Kämpfe aufgebraucht hast.</b></td></tr><tr><td>
</td></tr> 
       </table>
</fieldset>

<div class="spacer"></div>
<table>
<tr>
<?php
$events = new Generallist($database, 'events', '*', 'isdungeon="1"', '', '9999', 'ASC');
$itemManager = new ItemManager($database);
?>

<?php
$id = 0;
$num = 0;
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
  $isToday = Event::IsToday($player->GetPlanet(), $player->GetPlace(), $entry['placeandtime'], $entry['iseverywhere']);
  if($isToday && ($player->GetARank() >= 2 || $player->GetLevel() >= $entry['level']))
  {
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
  ++$num;
  if($num > 3)
  {
  ?></tr><tr><?php
    $num = 0;
  }
?>
  <td>
<table width="25%" cellspacing="0" cellpadding="1" border="0">
  <tr>
    <td class="boxSchatten catGradient borderB borderT" colspan="6" align="center"><b><?php echo $entry['name']; ?></b></td>
  </tr>
  <tr>
    <tr>
      <td width="25%" class="boxSchatten borderT borderR borderL borderB">
        <center><img src="img/events/<?php echo $entry['image']; ?>.png" style="width:200px;height:300px;">
          <hr><b><?php echo count(explode('@',$entry['fights'])); ?>x Kämpfe</b>
          <hr><b>Dropchance: <?php echo $entry['dropchance']; ?>%</b>
          <hr><b>
          <?php 
          if($entry['zeni'] != 0) echo $entry['zeni'].' Zeni<br/>'; 
          if($entry['dragoncoins'] != 0) echo $entry['dragoncoins'].' Dragoncoins<br/>'; 
          if($entry['item'] != '')
          {
				      $items = explode(';',$entry['item']);
              foreach($items as $itemID)
              {
                $item = $itemManager->GetItem($itemID);
                echo $item->GetRealName().'<br/>';
              }
          }
          ?>
          </b>
          <hr><b>Gruppenbeitritt ab +<?php echo $entry['minplayers']; ?></b>
					<?php 
          $wins = 0;
          if($entry['decreasenpcfight'])
          {
          	?><hr><?php echo 'Tägliche NPC Kämpfe: '.$player->GetDailyNPCFights().'/10';
          }
          else if($entry['winable'] != 0)
					{
            $wins = Event::GetPlayerWins($entry['finishedplayers'], $player->GetID());
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
          <form method="POST" action="?p=boss&a=start">
			<?php 
			if($wins >= $entry['winable'])
			{
			 echo "Du hast deine Täglichen versuche verbraucht!";
			 
			}
			else
			{
			?>
			            <select style="width:90%;" class="select" name="players">
              <?php
              $j = $entry['minplayers'];
              while($j <= $amount)
              {
              ?>
              <option value="<?php echo $j; ?>" <?php if($j == $amount) { ?> selected <?php } ?>><?php echo $j; ?> Spieler</option>
              <?php
              ++$j;
              }
              ?>
            </select>
			<input type="hidden" name="id" value="<?php echo $entry['id']; ?>"><input type="submit" value="Kampf Starten">
			<?php
			}
			?>
          </form>
          <?php
          }
          ?>
        </center>
        <div class="spacer"></div>
      </td>
    </tr>
</table>
  </td>
<?php
  }
$id++;
$entry = $events->GetEntry($id);
}
?>
  
</tr>
</table>