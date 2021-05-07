<?php
$start = 0;
$end = 0;

if(isset($_GET['start']))
  $start = $_GET['start'];
if(isset($_GET['end']))
  $end = $_GET['end'];


if($start == 0 || $end == 0)
  exit();

if(isset($_GET['ava']))
{
  $width = 200;
  $height = 200;
}
else
{
  $width = 360 / 4;
  $height = 648 / 4;
}

for($i = $start; $i <= $end; ++$i)
{
?><img src="player.php?id=<?php echo $i; ?><?php if(isset($_GET['ava'])) { echo '&ava'; } ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>"></img><?php
}

?>