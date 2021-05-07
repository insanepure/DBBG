<div class="spacer"></div>
<div  class="catGradient borderT borderB" style="width:95%;">
  <b>User Suche</b>
</div>
<?php
$start = 0;
$limit = 30;
$timeOut = 30;
if(isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0)
{
  $start = $limit * ($_GET['page']-1);
}

$where = '';
if (isset($_GET['username']) && $_GET['username'] != '') 
{
  $username = $database->EscapeString($_GET['username']);
  
  if($where != '')
    $where = $where.' AND ';
  $where = 'name LIKE "%'.$username.'%"';
}
if (isset($_GET['race']) && $_GET['race'] != '') 
{
  $race = $database->EscapeString($_GET['race']);
  
  if($where != '')
    $where = $where.' AND ';
  $where = $where.'race LIKE "%'.$race.'%"';
  
  if($_GET['race'] == 'Saiyajin')
  {
    $where = $where.' AND race NOT LIKE "Halb-Saiyajin"';
  }
  
}
if (isset($_GET['place']) && $_GET['place'] != '') 
{
  $place = $database->EscapeString($_GET['place']);
  
  if($where != '')
    $where = $where.' AND ';
  $where = $where.'place="'.$place.'"';
}
if (isset($_GET['planet']) && $_GET['planet'] != '') 
{
  $planet = $database->EscapeString($_GET['planet']);
  
  if($where != '')
    $where = $where.' AND ';
  $where = $where.'planet="'.$planet.'"';
}
$list = new Generallist($database, 'accounts', 'userid,id,name,rank,race,place,level,titel,planet,arank,clan,clanname, lastaction', $where, 'rank', $start.','.$limit, 'ASC');

?>

<form method="GET" action="?p=user">
<table width="95%" cellspacing="0" border="0" class="borderT borderR borderL borderB">
<tr>
  <input type="hidden" name="p" value="user">
	<td width="40%" align="left"><input style="width:95%;" type="text" name="username" value="<?php if(isset($_GET['username'])) echo $_GET['username']; ?>"></td>
    <td width="20%" style ="boxSchatten">  
    <select class="select" name="race" id="racelist"  style="width:100%">
        <option value="" <?php if(isset($_GET['race']) && $_GET['race'] == '') echo 'selected'; ?>>Rassen</option>
        <option value="Saiyajin" <?php if(isset($_GET['race']) && $_GET['race'] == 'Saiyajin') echo 'selected'; ?>>Saiyajin</option>
        <option value="Mensch" <?php if(isset($_GET['race']) && $_GET['race'] == 'Mensch') echo 'selected'; ?>>Mensch</option>
        <option value="Freezer" <?php if(isset($_GET['race']) && $_GET['race'] == 'Freezer') echo 'selected'; ?>>Freezer</option>
        <option value="Kaioshin" <?php if(isset($_GET['race']) && $_GET['race'] == 'Kaioshin') echo 'selected'; ?>>Kaioshin</option>
        <option value="Android" <?php if(isset($_GET['race']) && $_GET['race'] == 'Android') echo 'selected'; ?>>Android</option>
        <option value="Majin" <?php if(isset($_GET['race']) && $_GET['race'] == 'Majin') echo 'selected'; ?>>Majin</option>
        <option value="Demon" <?php if(isset($_GET['race']) && $_GET['race'] == 'Demon') echo 'selected'; ?>>Demon</option>
        <option value="Namekianer" <?php if(isset($_GET['race']) && $_GET['race'] == 'v') echo 'selected'; ?>>Namekianer</option>
       </select>
    </td>
    <td width="20%" style ="boxSchatten">  
    <select class="select" name="place" id="racelist"  style="width:100%">
      <option value="" <?php if(isset($_GET['place']) && $_GET['place'] == '') echo 'selected'; ?>>Orte</option>
      <?php
      $places = new Generallist($database, 'places', '*', 'display="1"', '', 99999999999, 'ASC');
      $id = 0;
      $entry = $places->GetEntry($id);
      while($entry != null)
      {
      ?>
        <option value="<?php echo $entry['name']; ?>" <?php if(isset($_GET['place']) && $_GET['place'] == $entry['name']) echo 'selected'; ?>><?php echo $entry['name']; ?></option>
        <?php
        ++$id;
        $entry = $places->GetEntry($id);
      }
      ?>
    </td>
  
    <td width="20%" style ="boxSchatten">  
    <select class="select" name="planet" id="racelist"  style="width:100%">
      <option value="" <?php if(isset($_GET['planet']) && $_GET['planet'] == '') echo 'selected'; ?>>Planeten</option>
      <?php
      $planets = new Generallist($database, 'planet', '*', 'display="1"', '', 99999999999, 'ASC');
      $id = 0;
      $entry = $planets->GetEntry($id);
      while($entry != null)
      {
      ?>
        <option value="<?php echo $entry['name']; ?>" <?php if(isset($_GET['planet']) && $_GET['planet'] == $entry['name']) echo 'selected'; ?>><?php echo $entry['name']; ?></option>
        <?php
        ++$id;
        $entry = $planets->GetEntry($id);
      }
      ?>
    </td>
  <td width="20%"><center> <input type="submit" style="width:100%" value="Suchen"></center></td>
	</tr>
</table>
</form>

<div class="spacer"></div>
<table width="95%" cellspacing="0" border="0">
  <tr class="catGradient borderT borderB">
    <td width="5%"><b>Level</b></td>
    <td width="30%"><b>User</b></td>
    <td width="5%"><b>Rang</b></td>
    <td width="15%"><b>Rasse</b></td>
    <td width="20%"><b>Clan</b></td>
    <td width="30%"><b>Ort</b></td>
  </tr>
<?php
  
if(!isset($titelManager)) $titelManager = new TitelManager($database);
  
$id = 0;
$entry = $list->GetEntry($id);
while($entry != null)
{
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
?>
  <tr>
    <td width="5%"><?php echo $entry['level']; ?></td>
    <td width="30%"><a href="?p=profil&id=<?php echo $entry['id']; ?>"><?php echo $titelText.' '.$entry['name']; ?></a></td>
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
$id++;
$entry = $list->GetEntry($id);
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
    <a href="?p=user&page=
    <?php echo $i+1; 
    if(isset($_GET['race'])) echo '&race='.$_GET['race']; 
    if(isset($_GET['username'])) echo '&username='.$_GET['username']; 
    if(isset($_GET['place'])) echo '&place='.$_GET['place']; 
    if(isset($_GET['planet'])) echo '&planet='.$_GET['planet']; 
             
             ?> ">Seite <?php echo $i+1; ?></a> 
    <?php
    ++$i;
  }
}
?>