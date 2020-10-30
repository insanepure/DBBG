<?php
exit();
$players = 600;
$width = 360 / 4;
$height = 648 / 4;

for($i = 1; $i <= $players; ++$i)
{
?><img src="player.php?id=<?php echo $i; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>"></img><?php
}

?>