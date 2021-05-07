<h2>
  Changelog
</h2>
<table width="90%">
<?php
$changelog = new Generallist($database, 'changelog', '*', '', 'time', 9999, 'DESC');
$id = 0;
$entry = $changelog->GetEntry($id);
while($entry != null)
{
		$dateStr = strtotime( $entry['time'] );
		$formatedDate = date( 'd.m.Y H:i', $dateStr );
  ?>
  <tr>
  <td width="20%" align="center"><?php echo $formatedDate; ?></td>
  <td width="80%" align="center"><?php echo $entry['text']; ?></td>
  </tr>
  <?php
  ++$id;
  $entry = $changelog->GetEntry($id);
}
?>
</table>