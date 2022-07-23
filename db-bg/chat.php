<?php
include_once $_SERVER['DOCUMENT_ROOT'].'../../main/www/classes/session.php';
ini_set("display_errors", 1);
ini_set("track_errors", 1);
ini_set("html_errors", 1);
error_reporting(E_ALL ^ E_DEPRECATED);
include_once 'classes/header.php';
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
<head title="dragoball,browsergame">
<link rel="icon" href="img/dbbg4.png">
<link rel="apple-touch-icon" href="img/dbbg4.png"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>DB-BG.de Das Online Dragonball Browsergame zur Serie</title>	
<meta name="Author" content="PuRe">
<meta name="Page-topic" content="Browsergame, Dragonball, Onlinespiel">
<meta name="Keywords" content="DBBG,Das,Online,Browsergame,dbbg,das,online,browsergame,Madusanka2013,Pure,umfrage,alpha,dragonball,google,twitter,aniflix,anime,facebook,dragonball,browsergame">
<meta name="Description" content="DBBG Das Online Dragonball Browsergame, db-bg.de ist ein kostenloses Online Browsergame, Du kannst trainieren, kämpfen, unterhalten, und stärker werden.">
<meta name="Content-language" content="DE">
<meta name="Page-type" content="HTML-Formular">
<meta name="Robots" content="INDEX,FOLLOW">
<meta name="Audience" content="Alle">
<meta name="viewport" content="width=device-width, initial-scale=0.5">
<meta property="og:title" content="DBBG Das Online Browsergame" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?php echo $serverUrl; ?>" />
<meta property="og:image" content="<?php echo $serverUrl; ?>img/defaultBanner.png" />
<meta property="og:description" content="DBBG Das Online Dragonball Browsergame, db-bg.de ist ein kostenloses Online Browsergame, Du kannst trainieren, kämpfen, unterhalten, und stärker werden." />
<meta property="og:site_name" content="DBBG Das Online Browsergame" />
<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="<?php echo $serverUrl; ?>" />
<meta name="twitter:title" content="DBBG Das Online Browsergame" />
<meta name="twitter:description" content="DBBG Das Online Dragonball Browsergame, db-bg.de ist ein kostenloses Online Browsergame, Du kannst trainieren, kämpfen, unterhalten, und stärker werden." />
<meta name="twitter:image" content="<?php echo $serverUrl; ?>img/defaultBanner.png" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>DBBG
				- Das Online Browsergame
		</title>
 <link rel="stylesheet" href="css/main.css">
	<?php
	if ($player->IsLogged())
	{
	?>
  <link rel="stylesheet" href="css/designs/<?php echo $player->GetDesign(); ?>/main.css">
	<?php
	}
	else
	{
	?>
  <link rel="stylesheet" href="css/designs/default/main.css">
	<?php
		
	}
	?>
</head>
<script type="text/javascript" src="chat/chat.js?0009"></script> 
<script type="text/javascript">
var timerStart = Date.now();
window.onload = function()
{
	InitChat('');
}
</script>
<body>
<center>		
	<div class="chatcontainer menuBG borderT">
		<?php include 'pages/chat.php'; ?>
	</div>