<?php

echo $message;

if ($account->IsLogged())
{
?>
	<ul class = "topbarlist">
		<li class = "topbarbutton"><a class="topbarbuttontext" href="?p=login&a=logout">Logout</a></li>
<?php
}
?>