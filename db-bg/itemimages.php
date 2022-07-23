<?php
include_once 'classes/header.php';

$where = 'equippedimage != ""';
$list = new Generallist($database, 'items', '*', $where, '', 99999, 'ASC');
$id = 0;
$entry = $list->GetEntry($id);
//echo '<pre>';
//print_r($list);
//echo '</pre>';

echo $list->GetCount().' Bilder<br/>';
?>
<table>
  <?php
  while($entry != null)
  {
    ?>
    <tr>
    <td><?php echo $entry['name'].' ('.$entry['id'].')'; ?></td>
    <td><img height="100px" src="img/items/<?php echo $entry['image']; ?>.png"></img></td>
    </tr>
    <?php
    ++$id;
    $entry = $list->GetEntry($id);
  }
  ?>
</table>