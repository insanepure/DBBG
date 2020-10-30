<?php $blacklist = array("162.158.91.238", "456.789.123", "789.123.456");

if(in_array($_SERVER['REMOTE_ADDR'], $blacklist)) {

	//header("Location: https://www.google.de");

	//exit();
} 
?>