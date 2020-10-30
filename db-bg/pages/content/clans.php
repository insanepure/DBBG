<div class="spacer"></div>
<div  class="catGradient borderT borderB" style="width:95%;">
  <b>Clan Suche</b>
</div>
<?php
$where = '';
$start = 0;
$limit = 30;
if(isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0)
{
  $start = $limit * ($_GET['page']-1);
}
if (isset($_GET['clanname']) && $_GET['clanname'] != '') 
{
  $clanname = $database->EscapeString($_GET['clanname']);
  $where = 'name LIKE "%'.$clanname.'%"';
}
$clans = new Generallist($database, 'clans', '*', $where, 'rang, points',  $start.','.$limit, 'ASC');
?>
<form method="GET" action="?p=clans">
<table width="95%" cellspacing="0" border="0" class="borderT borderR borderL borderB">
<tr>
  <td> <input type="hidden" name="p" value="clans"></td>
	<td width="45%"><center><input style="width:100%;" type="text" name="clanname" value="<?php if(isset($_GET['clanname'])) echo $_GET['clanname']; ?>"></center></td>
  <td width="45%"><center><input type="submit" style="width:50%" value="Suchen"></center></td>
	</tr>
</table>
</form>
<div class="spacer"></div>
<table width="95%" cellspacing="0" border="0">
  <tr>
    <td colspan=6 class="catGradient borderT borderB">
      <b><center><font color="white"><div class="schatten">Clans</div></font></center></b>
    </td>
  </tr>
  <tr>
    <td width="10%"><b>Rang</b></td>
    <td width="15%"><b>Stärke</b></td>
    <td width="5%"><b>Banner</b></td>
    <td width="10%"><b>TAG</b></td>
    <td width="40%"><b>Name</b></td>
    <td width="20%"><b>Mitglieder</b></td>
  </tr>
<?php
$id = 0;
$entry = $clans->GetEntry($id);
while($entry != null)
{
?>
  <tr>
    <td ><?php echo $entry['rang']; ?></td>
    <td ><?php echo $entry['memberki']; ?></td>
    <td>
    <?php if($entry['banner'] != '')
    {
    ?>
       <img src="<?php echo $entry['banner']; ?>" width="30px" height="30px"></img>
    <?php
    }
    ?>
  </td>
    <td >[<?php echo $entry['tag']; ?>]</td>
    <td ><a href="?p=clan&id=<?php echo $entry['id']; ?>"><?php echo $entry['name']; ?></a></td>
    <td><?php echo $entry['members']; ?></td>
  </tr>
<?php
$id++;
$entry = $clans->GetEntry($id);
}
?>
</table>
<?php
  $result = $database->Select('COUNT(id) as total','clans',$where);
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
    <a href="?p=clans&page=<?php echo $i+1; if(isset($_GET['clanname'])) echo '&clanname='.$_GET['clanname']; ?>">Seite <?php echo $i+1; ?></a> 
    <?php
    ++$i;
  }
}
?>