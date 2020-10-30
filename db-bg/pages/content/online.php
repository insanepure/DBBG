<?php
$timeOut = 30;
$where = 'TIMESTAMPDIFF(MINUTE, lastaction, NOW()) < '.$timeOut;
$start = 0;
$limit = 30;
if(isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0)
{
  $start = $limit * ($_GET['page']-1);
}
$onlineList = new Generallist($database, 'accounts', 'userid,lastaction,id,name,rank,race,place,level,titel,planet,arank,clan,clanname,visible', $where, 'planet, rank, level', $start.','.$limit, 'ASC');
?>
<div class="spacer"></div>
<table width="100%" cellspacing="0" border="0">
<?php
$id = 0;
$previousPlanet = '';
$entry = $onlineList->GetEntry($id);
while($entry != null)
{
if($previousPlanet != $entry['planet'])
{
if($previousPlanet != '')
{
?>
  <tr>
    <td colspan=6 height="20px">
    </td>
  </tr>
<?php
}
?>
  <tr>
    <td colspan=6 class="catGradient borderT borderB">
	<?php
	if($entry['planet'] == "Himmel" OR $entry['planet'] == "Jenseits")
	{
	?>
      <b><center><font color="white"><div class="schatten">User im <?php echo $entry['planet']; ?></div></font></center></b>
	<?php
	}
	else
	{
	?>
	<b><center><font color="white"><div class="schatten">User auf dem Planeten <?php echo $entry['planet']; ?></div></font></center></b>
	<?php
	}
	?>
    </td>
  </tr>
  <tr>
    <td width="5%"><b>Level</b></td>
    <td width="30%"><b>User</b></td>
    <td width="5%"><b>Rang</b></td>
    <td width="15%"><b>Rasse</b></td>
    <td width="20%"><b>Clan</b></td>
    <td width="30%"><b>Ort</b></td>
  </tr>
<?php
if(!isset($titelManager)) $titelManager = new TitelManager($database);
  
$previousPlanet = $entry['planet'];
}
  
$titel = $titelManager->GetTitel($entry['titel']);
$titelText = '';
if($titel != null)
{
  $titelText = $titel->GetName();
  if($titel->GetColor() != '')
  {
    $titelText = '<font color="#'.$titel->GetColor().'">'.$titelText.'</font>';
  }
}
  
if($entry['visible'] == 0)
{
?>
  <tr>
    <td width="5%"><?php echo $entry['level']; ?></td>
    <td width="30%"><a href="?p=profil&id=<?php echo $entry['id']; ?>"><?php echo $titelText; ?> <?php echo $entry['name']; ?></a></td>
    <td width="10%"><?php echo $entry['rank']; ?></td>
    <td width="15%"><?php echo $entry['race']; ?></td>
    <td width="20%">
    <?php 
    if($entry['clan'] == 0)
    {
      ?><b>Clanlos</b><?php
    }
    else
    {
      ?><a href="?p=clan&id=<?php echo $entry['clan']; ?>"><?php echo $entry['clanname']; ?></a><?php
    }
    ?></td>
    <td width="30%"><?php echo $entry['place']; ?></td>
  </tr>
<?php
  }
$id++;
$entry = $onlineList->GetEntry($id);
}
?>
</table>
<?php
  $result = $database->Select('COUNT(id) as total','accounts',$where);
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
    <a href="?p=online&page=<?php echo $i+1; ?>">Seite <?php echo $i+1; ?></a> 
    <?php
    ++$i;
  }
}
?>