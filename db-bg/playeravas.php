<?php
exit();
$players = 600;
$width = 200;
$height = 200;

for($i = 1; $i <= $players; ++$i)
{
?><img src="playerava.php?id=<?php echo $i; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>"></img><?php
}

?>