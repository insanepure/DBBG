<?php 
if($player->GetARank() < 3)
{
	header('Location: ?p=news');
}
$id = 0;
$messages = new Generallist($database, 'chatmessages', '*', '', 'id', 99999, 'DESC');
$entry = $messages->GetEntry($id);
?>
<div class="spacer"></div>
<table width="90%" class="borderT borderB borderR borderL">
  <tr><td class="catGradient" colspan="3">ChatLog</td></tr>
<?php
while($entry != null)
{
  ?><tr>
  <?php
  $time = date('H:i', strtotime($entry['time']));
  echo '<td>['.$time.']</td>';
	if($entry['channel'] != '')
  	echo '<td>['.$entry['channel'].']</td>';
	else
		echo '<td></td>';
  ?>
  <td>
  <b><a href="?p=profil&id=<?php echo $entry['acc']; ?>"><?php echo $entry['titel']; ?> <?php echo $entry['name']; ?></a></b>:
  <?php
  echo ' '.$entry['text']; ?></td></tr>
  <?php
  ++$id;
  $entry = $messages->GetEntry($id);
}
?>
</table>