<div class="spacer"></div>
<?php
$trainers = $place->GetTrainers();
$where = '';
$i = 0;
while(isset($trainers[$i]))
{
	$string = 'id='.$trainers[$i].'';
	if($where == '')
	{
		$where = $string;
	}
	else
	{
		$where = $where.' OR '.$string;
	}
	++$i;
}

$where = '('.$where.') AND race="'.$player->GetRace().'"';
$start = 0;
$limit = 10;
$list = new Generallist($database, 'npcs', 'description, name, image, attacks, id', $where, 'id', $start.','.$limit, 'ASC');

$id = 0;
$entry = $list->GetEntry($id);
while($entry != null)
{
  ?>
  <table width="90%" cellspacing="0" class="boxSchatten">
      <tr>
        <td class="catGradient borderB borderT borderR borderL" colspan="2" align="center"><b>Training bei <?php echo $entry['name']; ?></b></td>
      </tr>
      <tr>
        <td class="borderL borderR borderB" width="180px"><img class="boxSchatten" width="180px" height="250px" src="img/npc/<?php echo $entry['image']; ?>.png"></img></td>
        <td class="borderL borderR borderB"><?php echo $entry['description']; ?></td>
      </tr>
  </table>
  <div class="spacer"></div>
  <table width="90%" cellspacing="0" class="boxSchatten">
    <tr>
      <td class="catGradient borderB borderT borderR borderL" colspan="8" align="center"><b>Spezialtraining</b></td>
    </tr>
    <tr>
      <td width="10%" class="borderL" align="center"><b>Bild</b></td>
      <td width="10%" align="center"><b>Name</b></td>
	  <td width="30%" align="center"><b>Beschreibung</b></td>
      <td width="20%" align="center"><b>Voraussetzung</b></td>
      <td width="10%" class="borderR" align="center"><b>Aktion</b></td>
    </tr>
    <?php 
    $attacks = explode(';',$entry['attacks']);
    $j = 0;
    while(isset($attacks[$j]))
    {
      $attack = $attackManager->GetAttack($attacks[$j]);
      ?>
      <form method="POST" action="?p=specialtraining&a=train&npcid=<?php echo $entry['id']; ?>&id=<?php echo $attack->GetID(); ?>">
      <tr>
      <td width="50px" class="borderL borderB" align="center">
        <img src="<?php echo $attack->GetImage(); ?>" width="50px" height="50px"></img>
        </div> 
      </td>
      <td align="center" class="borderB"><?php echo $attack->GetName(); ?></td>
      <td align="center" class="borderB"><?php echo $attack->GetDescription();?></td>
      <td class="borderB" align="center">
	  <?php
	  if($attack->GetLearnKI() != 0) if($player->GetKI() < $attack->GetLearnKI()) {echo '<font color="red">KI: '.$attack->GetLearnKI().'</font><br/>';}else{echo '<font color="green">KI: '.$attack->GetLearnKI().'</font><br/>';} 
	  if($attack->GetLearnLP() != 0) if($player->GetLP() < $attack->GetLearnLP()) {echo '<font color="red">LP: '.$attack->GetLearnLP().'</font><br/>';}else{echo '<font color="green">LP: '.$attack->GetLearnLP().'</font><br/>';} 
	  if($attack->GetLearnKP() != 0) if($player->GetKP() < $attack->GetLearnKP()) {echo '<font color="red">KP: '.$attack->GetLearnKP().'</font><br/>';}else{echo '<font color="green">KP: '.$attack->GetLearnKP().'</font><br/>';} 
	  if($attack->GetLearnAttack() != 0) if($player->GetAttack() < $attack->GetLearnAttack()) {echo '<font color="red">Attack: '.$attack->GetLearnAttack().'</font><br/>';}else{echo '<font color="green">Attack: '.$attack->GetLearnAttack().'</font><br/>';} 
	  if($attack->GetLearnDefense() != 0) if($player->GetDefense() < $attack->GetLearnDefense()) {echo '<font color="red">Defense: '.$attack->GetLearnDefense().'</font><br/>';}else{echo '<font color="green">Defense: '.$attack->GetLearnDefense().'</font><br/>';} 
	  
	  ?>
	  </td>
      <td class="borderR borderB" align="center"><input type="submit" value="Start"/></td>
      </tr>
      </form>
      <?php
      ++$j;
    }
    ?>
  </table>
  <div class="spacer2"></div>
<?php
	++$id;
	$entry = $list->GetEntry($id);
}
?>
