<div class="spacer"></div>
<div  class="catGradient borderT borderB" style="width:90%;">
<h2>Interaktionen</h2>
</div>
<div class="spacer"></div>
<?php
$start = 0;
$limit = 30;
$timeOut = 30;
if(isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0)
{
  $start = $limit * ($_GET['page']-1);
}

$where = 'game="dbbg"';
$list = new Generallist($accountDB, 'interactions', '*', $where, 'ID', $start.','.$limit, 'DESC');

?>
<div class="spacer"></div>
<table width="95%" cellspacing="0" border="1">
  <tr class="catGradient borderT borderB">
    <td width="10%"><b>ID</b></td>
    <td width="20%"><b>Zeit</b></td>
    <td width="30%"><b>Charaktere</b></td>
    <td width="10%"><b>Multi</b></td>
    <td width="30%"><b>Aktion</b></td>
  </tr>
<?php
////////// GET PLAYER IDS //////////
$playerIDs = array();
$id = 0;
$entry = $list->GetEntry($id);
while($entry != null)
{
  $charaIDs = explode(';', $entry['charaids']);
  $i = 0;
  while(isset($charaIDs[$i]))
  {
    array_push($playerIDs, $charaIDs[$i]);
    ++$i;
  }
  $id++;
  $entry = $list->GetEntry($id);
}
$playerIDs = array_unique($playerIDs);
  
 
////////// GET PLAYER DATAS //////////
$i = 0;
$limit2 = count($playerIDs);
$where2 = '';
foreach($playerIDs as &$playerID)
{
	if($where2 == '')
	{
		$where2 = 'id = '.$playerID.'';
	}
	else
	{
		$where2 = $where2.' OR id = '.$playerID.'';
	}
}
$playerAccs = new Generallist($database, 'accounts', 'id, name, userid', $where2, '', $limit2, 'ASC');

$pNames = array();  
$pMains = array();
  
foreach($playerIDs as &$playerID)
{
  $j = 0;
  $playerEntry = $playerAccs->GetEntry($j);
  while($playerEntry != null)
  {
    if($playerEntry['id'] == $playerID)
    {
      $pNames[$playerID] = $playerEntry['name'];
      $pMains[$playerID] = $playerEntry['userid'];
      break;
    }
    ++$j;
    $playerEntry = $playerAccs->GetEntry($j);
  }
}
  
$id = 0;
$entry = $list->GetEntry($id);
while($entry != null)
{
		$dateStr = strtotime( $entry['time'] );
		$formatedDate = date( 'd.m.Y H:i', $dateStr );
  
?>
  <tr>
    <td><?php echo $entry['id']; ?></td>
    <td><?php echo $formatedDate; ?></td>
    <td>
    <?php 
    $multi = false;
    $charaIDs = explode(';', $entry['charaids']);
    $i = 0;
    $multiMain = 0;
    while(isset($charaIDs[$i]))
    {
      $charaID = $charaIDs[$i];
      $pName = $pNames[$charaID];
      $pMain = $pMain[$charaID];
      
      if($multiMain == 0)
        $multiMain = $pMain;
      else if($pMain == $multiMain)
        $multi = true;
      
      ?><a href="?p=profil&id=<?php echo $charaID; ?>"><?php echo $pName; ?></a><br/><?php
      ++$i;
    }
    ?>
    </td>
    <td><?php if($multi) { echo '<font color="red">Ja</font>'; } else { echo '<font color="green">Nein</font>'; } ?></td>
    <td><?php echo $entry['action']; ?></td>
  </tr>
<?php
$id++;
$entry = $list->GetEntry($id);
}
?>
</table>
<br/>
<br/>
<?php
  $result = $accountDB->Select('COUNT(id) as total','interactions',$where);
  $total = 0;
  if ($result) 
  {
    $row = $result->fetch_assoc();
    $total = $row['total'];
    $result->close();
  }
  $pages = ceil($total / $limit);
if($pages != 1)
{
  ?>
  <div class="spacer"></div>
  <?php
  $i = 0;
  while($i != $pages)
  {
    ?>
    <a href="?p=admininteractions&page=<?php echo $i+1; ?>">Seite <?php echo $i+1; ?></a> 
    <?php
    ++$i;
  }
}
?>