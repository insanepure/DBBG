<?php
$start = 0;
$limit = 30;
if(isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0)
{
  $start = $limit * ($_GET['page']-1);
}
$fightList = new Generallist($database, 'fights', '*', 'state = 2', 'id', $start.','.$limit, 'DESC');
?>
<div class="spacer"></div>
<a href="?p=fight">Zurück</a>
<div class="spacer"></div>
<table width="100%" cellspacing="0" border="0">
    <tr>
    <td colspan=5 class="catGradient borderT borderB">
      <b><center><font color="white"><div class="schatten">Vergangene Kämpfe</div></font></center></b>
    </td>
  </tr>
  <tr>
    <td class="boxSchatten" align="center"><b>ID</b></td>
    <td class="boxSchatten" align="center"><b>Name</b></td>
    <td class="boxSchatten" align="center"><b>Art</b></td>
    <td class="boxSchatten" align="center"><b>Modus</b></td>
    <td class="boxSchatten" align="center"><b>Aktion</b></td>
  </tr>
<?php
$id = 0;
$entry = $fightList->GetEntry($id);
while($entry != null)
{
?>
<tr>
  <td class="boxSchatten" align="center">
    <?php
    echo $entry['id'];
    ?>
  </td>
  <td class="boxSchatten" align="center">
    <?php
    echo $entry['name'];
    ?>
  </td>
  <td class="boxSchatten" align="center">
    <?php
    switch($entry['type'])
    {
      case 0:
        echo 'Spaß';
        break;
      case 1:
        echo 'Wertung';
        break;
      case 2:
        echo 'Tod';
        break;
      case 3:
        echo 'NPC';
        break;
      case 4:
        echo 'Story';
        break;
      case 5:
        echo 'Event';
        break;
      case 6:
        echo 'Turnier';
        break;
      case 7:
        echo 'Dragonball';
        break;
      case 8:
        echo 'Arena';
        break;
    }
    ?>
  </td>
  <td class="boxSchatten" align="center">
    <?php
    echo $entry['mode'];
    ?>
  </td>
  <td class="boxSchatten">
    <center>
      <a href="?p=infight&fight=<?php echo $entry['id'];?>">Betrachten</a>
    </center></td>
</tr>
<?php
$id++;
$entry = $fightList->GetEntry($id);
}
?>
</table>

<?php
  $result = $database->Select('COUNT(id) as total','fights','');
  $total = 0;
  if ($result) 
  {
    $row = $result->fetch_assoc();
    $total = $row['total'];
    $result->close();
  }
  $pages = ceil($total / 30);
if($pages != 1)
{
  ?>
  <div class="spacer"></div>
  <?php
  $i = 0;
  while($i != $pages)
  {
    ?>
    <a href="?p=fights&page=<?php echo $i+1; ?>">Seite <?php echo $i+1; ?></a> 
    <?php
    ++$i;
  }
}
?>