<?php
include_once $_SERVER['DOCUMENT_ROOT'].'../../main/www/classes/session.php';
ini_set("display_errors", 1);
ini_set("track_errors", 1);
ini_set("html_errors", 1);
error_reporting(E_ALL & ~E_DEPRECATED);
require_once "recaptchalib.php";
include_once 'classes/header.php';
include_once 'pages/main.php';

if(!isset($_GET['fight']))
  exit();

		$result = $database->Select('*',$_GET['p'],'id="'.$_GET['fight'].'"',1);
		if ($result) 
		{
			if ($result->num_rows > 0)
			{
				while($row = $result->fetch_assoc()) 
				{
          echo $row['debuglog'];
				}
      }
		}
		$result->close();

?>