<div class="spacer"></div>
<div  class="catGradient borderT borderB" style="width:95%;">
  <b>Ranglisten</b>
</div>
<?php
$start = 0;
$limit = 30;
if(isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0)
{
  $start = $limit * ($_GET['page']-1);
}

$where = '';
$sort = 'total';
$type = -1;
if (isset($_GET['type']) && $_GET['type'] != '') 
{
  $type = $database->EscapeString($_GET['type']);
}

if($where != '') $where = $where.' AND ';
$where = $where.'type="'.$type.'"';

if (isset($_GET['username']) && $_GET['username'] != '') 
{
  $username = $database->EscapeString($_GET['username']);
}

if (isset($_GET['sort']) && $_GET['sort'] != '') 
{
  $sort = $database->EscapeString($_GET['sort']);
  if($sort != 'win' && $sort != 'loose' && $sort != 'draw' && $sort != 'total' 
     && $sort != 'dailywin' && $sort != 'dailyloose' && $sort != 'dailydraw' && $sort != 'dailytotal')
    $sort = 'total';
}

if($where != '') $where = $where.' AND ';
$where = $where.$sort.'!=0';
$list = new Generallist($database, 'statslist', '*', $where, $sort, $start.','.$limit, 'DESC');
?>

<form method="GET" action="?p=ranglist">
<table width="95%" cellspacing="0" border="0" class="borderT borderR borderL borderB">
<tr>
  <td></td>
  <td>Username</td>
  <td>Kampfart</td>
  <td>Sortierung</td>
  <td></td>
</tr>
<tr>
  <td><input type="hidden" name="p" value="ranglist"></td>
	<td width="70%"><center><input style="width:95%;" type="text" name="username" value="<?php if(isset($_GET['username'])) echo $_GET['username']; ?>"></center></td>
    <td width="20%" style ="boxSchatten">  
    <select class="select" name="type">
        <option value="-1" <?php if($type == -1) echo 'selected'; ?>>Alle</option>
        <option value="0" <?php if($type == 0) echo 'selected'; ?>>Spaß</option>
        <option value="1" <?php if($type == 1) echo 'selected'; ?>>Wertung</option>
        <option value="2" <?php if($type == 2) echo 'selected'; ?>>Tod</option>
        <option value="3" <?php if($type == 3) echo 'selected'; ?>>NPC</option>
        <option value="4" <?php if($type == 4) echo 'selected'; ?>>Story</option>
        <option value="5" <?php if($type == 5) echo 'selected'; ?>>Event</option>
        <option value="6" <?php if($type == 6) echo 'selected'; ?>>Tournament</option>
        <option value="7" <?php if($type == 7) echo 'selected'; ?>>Dragonball</option>
        <option value="8" <?php if($type == 8) echo 'selected'; ?>>Arena</option>
       </select>
    </td>
    <td width="10%" style ="boxSchatten">  
    <select class="select" name="sort">
        <option value="win" <?php if($sort == 'win') echo 'selected'; ?>>Siege</option>
        <option value="loose" <?php if($sort == 'loose') echo 'selected'; ?>>Niederlagen</option>
        <option value="draw" <?php if($sort == 'draw') echo 'selected'; ?>>Unentschieden</option>
        <option value="total" <?php if($sort == 'total') echo 'selected'; ?>>Total</option>
        <option value="dailywin" <?php if($sort == 'dailywin') echo 'selected'; ?>>Tägliche Siege</option>
        <option value="dailyloose" <?php if($sort == 'dailyloose') echo 'selected'; ?>>Tägliche Niederlagen</option>
        <option value="dailydraw" <?php if($sort == 'dailydraw') echo 'selected'; ?>>Tägliche Unentschieden</option>
        <option value="dailytotal" <?php if($sort == 'dailytotal') echo 'selected'; ?>>Täglich Total</option>
       </select>
    </td>
  <td width="40%"><center> <input type="submit" style="width:100%" value="Suchen"></center></td>
	</tr>
</table>
</form>

<div class="spacer"></div>
<table width="95%" cellspacing="0" border="0">
  <tr class="catGradient borderT borderB">
    <td width="5%"><b>Rang</b></td>
    <td width="50%"><b>User</b></td>
    <td width="45%"><b>Anzahl</b></td>
  </tr>
<?php
$id = 0;
$entry = $list->GetEntry($id);
while($entry != null)
{
  $rang = $start + $id + 1;
  if(isset($username) && strpos($entry['name'], $username) === FALSE) 
  {
    $id++;
    $entry = $list->GetEntry($id);
    continue;
  }
?>
  <tr>
    <td><?php echo $rang; ?></td>
    <td><a href="?p=profil&id=<?php echo $entry['acc']; ?>"><?php echo $entry['name']; ?></a></td>
    <td><?php echo $entry[$sort]; ?></td>
  </tr>
<?php
$id++;
$entry = $list->GetEntry($id);
}
?>
</table>
<?php
  $result = $database->Select('COUNT(id) as total','statslist',$where);
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
    <a href="?p=ranglist&page=<?php echo $i+1; if(isset($_GET['type'])) echo '&type='.$_GET['type']; if(isset($_GET['username'])) echo '&username='.$_GET['username']; if(isset($_GET['sort'])) echo '&sort='.$_GET['sort']; ?>">Seite <?php echo $i+1; ?></a> 
    <?php
    ++$i;
  }
}
?>