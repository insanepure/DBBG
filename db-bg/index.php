<?php
if(isset($_COOKIE['userTracking']))
{
}
include_once $_SERVER['DOCUMENT_ROOT'].'../../main/www/classes/session.php';
ini_set("display_errors", 1);
ini_set("track_errors", 1);
ini_set("log_errors", 0);
ini_set("html_errors", 1);
error_reporting(E_ALL ^ E_DEPRECATED);
require_once "recaptchalib.php";
include_once 'classes/header.php';
include_once 'pages/main.php';

if (isset($_GET['p']) && file_exists('pages/head/'.$_GET['p'].'.php'))
{
	include_once 'pages/head/'.$_GET['p'].'.php';
}
else if(!isset($_GET['p']) ||isset($_GET['p']) && !file_exists('pages/content/'.$_GET['p'].'.php'))
{
	include_once 'pages/head/news.php';
}

if($account->IsLogged() && $player->IsLogged() && !$player->IsAdminLogged())
{
  LoginTracker::TrackUser($accountDB, $account->Get('id'), $player->GetName(), 'dbbg', $account->Get('password'), $account->Get('email'), session_id(), $account->GetIP(), $account->GetRealIP(), isset($_COOKIE['userTracking']));
}

//var_dump($_SESSION);
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
<head>
  <!-- Global site tag (gtag.js) - Google Analytics -->
<?php
$analyticsID = 'G-ZP59JY4Q6Y';
?>
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $analyticsID; ?>"></script>
<?php
$user_id_analytics = '';
$accountTag = '';
$charaTag = '';
if($account->IsLogged())
{
  $accountTag = $account->Get('id').' ('.$account->Get('login').')';
  $user_id_analytics = $account->Get('id');
  if($player->IsLogged())
  {
    $uid = $player->GetID();
    $uname = $player->GetName();
    $charaTag = $uid.' ('.$uname.')';
  }
}
?>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  
  <?php
  if(!isset($_COOKIE['userTracking']))
  {
  ?>
   // Default ad_storage to 'denied'.
  gtag('consent', 'default', {
    'ad_storage': 'denied',
  'analytics_storage': 'denied'
  });

  <?php
  }
  else
  {
    ?>
   gtag('consent', 'update', {
      'ad_storage': 'granted',
  'analytics_storage': 'granted'
    });
    <?php
  }
  ?>
  
  
  gtag('js', new Date());
  gtag('set','user_properties', {
  sessionid: '<?php echo session_id(); ?>',
  account: '<?php echo $accountTag; ?>',
  character: '<?php echo $charaTag; ?>'
  });
  gtag('config', '<?php echo $analyticsID; ?>' <?php if($user_id_analytics != '') { ?>,{ 'user_id': '<?php echo $user_id_analytics; ?>' } <?php } ?>);
</script>
<script src="https://www.google.com/recaptcha/api.js?render=6Lcd57wUAAAAAMqh2WE8_KEHveQ4Ycw1gRmbZQkI"></script>
<script>
grecaptcha.ready(function() {
  grecaptcha.execute('6Lcd57wUAAAAAMqh2WE8_KEHveQ4Ycw1gRmbZQkI', {action: 'homepage'}).then(function(token) {
              // Verify the token on the server.
              document.getElementById('g-recaptcha-response').value = token;
              document.getElementById("captcha").style.display="block";
              document.getElementById("captcha_text").style.display="none";
              });
          });
</script>
<link rel="shortcut icon" href="img/favicon.ico">
<link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="img/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="Author" content="PuRe">
<meta name="Page-topic" content="Browsergame, Dragonball, Onlinespiel">
<meta name="Keywords" content="DBBG,Das,Online,Browsergame,dbbg,das,online,browsergame,PuRe,umfrage,alpha,dragonball,google,twitter,aniflix,anime,facebook,dragonball,browsergame">
<meta name="Description" content="DBBG Das Online Dragonball Browsergame, db-bg.de ist ein kostenloses Online Browsergame, Du kannst trainieren, kämpfen, unterhalten, und stärker werden.">
<meta name="Content-language" content="DE">
<meta name="Page-type" content="HTML-Formular">
<meta name="Robots" content="INDEX,FOLLOW">
<meta name="Audience" content="Alle">
<meta name="viewport" content="width=device-width, initial-scale=0.41">
<meta property="og:title" content="DBBG Das Online Browsergame" />
<meta property="og:type" content="website" /> 
<meta property="og:url" content="" />
<meta property="og:image" content="img/defaultBanner.png" />
<meta property="og:description" content="DBBG Das Online Dragonball Browsergame, db-bg.de ist ein kostenloses Online Browsergame, Du kannst trainieren, kämpfen, unterhalten, und stärker werden." />
<meta property="og:site_name" content="DBBG Das Online Browsergame" />
<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="" />
<meta name="twitter:title" content="DBBG Das Online Browsergame" />
<meta name="twitter:description" content="DBBG Das Online Dragonball Browsergame, db-bg.de ist ein kostenloses Online Browsergame, Du kannst trainieren, kämpfen, unterhalten, und stärker werden." />
<meta name="twitter:image" content="img/defaultBanner.png" />
<title>
DBBG
<?php
if (isset($_GET['p']) && file_exists('pages/content/'.$_GET['p'].'.php'))
{
?>
 - <?php 
   if(isset($title))
     echo $title;
   else
    echo mb_convert_case($_GET['p'], MB_CASE_TITLE, 'UTF-8'); 
  ?>
<?php
}
else
{
?>
		- Das Online Browsergame
<?php
}
?>
</title>
<link rel="stylesheet" href="css/main.css?005">
<?php

if ($player->IsLogged())
{
?>
<link rel="stylesheet" href="css/designs/<?php echo $player->GetDesign(); ?>/main.css?1338">
<?php
}
else
{
?>
<link rel="stylesheet" href="css/designs/default/main.css?001">
<?php
}
?>
<?php 
if (isset($_GET['p']) && file_exists('css/pages/'.$_GET['p'].'.css'))
{
?>
  <link rel="stylesheet" href="css/pages/<?php echo $_GET['p']; ?>.css?012">
<?php
}
else
{
?>
<?php
}
?>
</head>
<script type="text/javascript" src="js/main.js?00424"></script> 
<script type="text/javascript" src="js/timer.js?07"></script>
<?php
if($player->GetChatActive())
{
?>
<script type="text/javascript" src="chat/chat.js?00011"></script> 
<?php
}
?>
<body>
<center>
			<div id="popup" class="popup">
  			<div class="popup-container smallBG boxSchatten">
					<div class="catGradient borderT borderB">
						<div class="schatten">
							<span id="popup-header">Herausforderung</span>
							<div id="popup-close" class="popup-close"><a onclick="ClosePopup()">X</a></div>
						</div>
					</div>
					<div class="spacer"></div>
					<div id="popup-content">
						Test
					</div>
					<div class="spacer"></div>
					<div class="footer borderT" style="width:600px;">
					<Button onclick="ClosePopup()">Schließen</Button>
					</div>
    		</div>
			</div>
<div class = "maincontainer borderBigL borderBigR" style="position:relative">
  <?php
if($player->IsLogged() && $eventItem)
{
  ?>
  <div style="z-index:10; position:absolute; top:<?php echo $eventItem->GetY(); ?>px; left:<?php echo $eventItem->GetX(); ?>px;">
  <a href="?<?php echo $eventItemURL.$eventItemPickURL; ?>">  
    <img src="<?php echo $eventItem->GetImage(); ?>"></img>
  </a> 
  </div>
  <?php
}  
?>
	<header>
	<div class = "header" role="banner" itemscope itemtype="">
	<?php
		//Wartungsarbeiten Einschalten Change Logo to DBBG Wartungsarbeiten
		$wartung = 0;
		if($wartung == 1)
		{
      if ($player->IsLogged() && $player->GetCanJoin() == '0')
      { 
          //$player->Logout();
      }
      ?>
       <div class="logo2"></div>
		<?php
		}
		?>
   </div>
	</header>
	<nav>
	<div class = "navigationbar catGradient borderB borderT">
    <ul class = "navigationbarlist">
			<li class = "navigationbarbutton borderR"><a class="navigationbarbuttontext" title="dragonball,browsergame" href="index.php">News</a></li>
			<li class = "navigationbarbutton borderR"><a class="navigationbarbuttontext" title="dragonball,browsergame" id="no-link" target="_blank" href="https://n-bg.de/" rel="nofollow">N-BG</a></li>
			<!--<li class = "navigationbarbutton borderR"><a class="navigationbarbuttontext" title="dragonball,browsergame" id="no-link" target="_blank" href="/forum/" rel="nofollow">Forum</a></li>-->
			<li class = "navigationbarbutton borderR"><a class="navigationbarbuttontext" title="dragonball,browsergame" id="no-link" target="_blank" href="https://discord.gg/Nw9f8cJawv" rel="nofollow">Discord</a></li>
			<li class = "navigationbarbutton borderR"><a class="navigationbarbuttontext" title="dragonball,browsergame" id="no-link" href="?p=info" >Infos</a></li>
			<li class = "navigationbarbutton borderR"><a class="navigationbarbuttontext" title="dragonball,browsergame" id="no-link" href="?p=partner" >Partner</a></li>
      <?php
      if($account->IsLogged() && $player->IsLogged())
      {
       ?>
			 <li class = "navigationbarbutton borderR"><a class="navigationbarbuttontext" title="dragonball,browsergame" id="no-link" href="?p=support" >Support</a></li>	 
       <?php
      }
      ?>
      
      
			<li class = "navigationbarbutton borderR"><a class="navigationbarbuttontext" title="dragonball,browsergame" id="no-link" href="?p=clans">&nbsp;&nbsp;
				<?php $clanCount = $gameData->GetClans(); if($clanCount == 1) echo $clanCount.' Clan'; else echo $clanCount.' Clans'; ?>&nbsp;&nbsp;</a></li>
			<li class = "navigationbarbutton borderR"><a class="navigationbarbuttontext" title="dragonball,browsergame" id="no-link" href="?p=online">&nbsp;&nbsp;<?php echo $gameData->GetOnline(); ?>&nbsp;Online&nbsp;&nbsp;</a></li>
			<?php
      if($account->IsLogged())
      {
        ?>
        <?php
        if (!$player->IsLogged())
        {
          ?>
          <li class = "navigationbarbutton borderL" style="float:right"><a class="navigationbarbuttontext" href="?p=login&a=userlogout">Logout</a></li>
          <li class = "navigationbarbutton borderL" style="float:right"><a class="navigationbarbuttontext" title="dragonball,browsergame" href="?p=charalogin">Charaktere</a></li>
          <?php
        }
        else
        {
          ?>		
          <li class = "navigationbarbutton borderL" style="float:right"><a class="navigationbarbuttontext" href="?p=login&a=charlogout">Logout</a></li>
          <?php
        }
      }
      else
      {
        ?>
			  <li class = "navigationbarbutton borderL" style="float:right"><a class="navigationbarbuttontext" title="dragonball,browsergame" href="?p=login">Login</a></li>
			  <li class = "navigationbarbutton borderL" style="float:right"><a class="navigationbarbuttontext" title="dragonball,browsergame" href="?p=register">Registrieren</a></li>
        <?php
      }
      ?>
		</ul>
	</div>
	</nav>
	
  
  
  <?php
  if($account->IsLogged() && $account->Get('id') != 1 && $account->Get('id') != 20 && $player->IsLogged())
  {
    ?>
    <div class="menuBG borderB" style="width:auto; height:110px;">
    <div style="height:10px;"></div>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7145796878009968"
     crossorigin="anonymous"></script>
    <?php
    if(!isset($_COOKIE['personalizedAds']))
    {
    ?>
    <script>(adsbygoogle=window.adsbygoogle||[]).requestNonPersonalizedAds=1;</script>
    <?php
    }
    ?>
    <!-- AboveContent -->
    <ins class="adsbygoogle"
         style="display:inline-block;width:1000px;height:90px"
         data-ad-client="ca-pub-7145796878009968"
         data-ad-slot="2481574054"></ins>
    <script>
         (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
    </div>
  <?php
  }
  ?>
	<div class="contentcontainer">
		
		<div class="leftbar sidebar menuBG">
		<?php
		if (isset($_GET['p']) && file_exists('pages/left/'.$_GET['p'].'.php'))
		{
			include 'pages/left/'.$_GET['p'].'.php';
		}
		else
		{
			include 'pages/left/main.php';
		}
		?>
		</div>
		
		<div class="content menuBG borderL borderR">
    <!--<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>-->
    <!-- AboveContent -->
    <!--<ins class="adsbygoogle"
         style="display:inline-block;width:667px;height:90px"
         data-ad-client="ca-pub-7145796878009968"
         data-ad-slot="2481574054"></ins>
    <script>
         (adsbygoogle = window.adsbygoogle || []).push({});
    </script>-->
    <!-- ADC Rota 202960 PRE BK 468x60 -->
    <!--<script type="text/javascript" language="Javascript" src="https://bk.adcocktail.com/pre_bk_rota.php?format=468x60&uid=89196&wsid=202960"></script>
    <!-- ADC Rota 202960 PRE BK 468x60 -->

		<?php
		if (isset($_GET['p']) && file_exists('pages/content/'.$_GET['p'].'.php'))
		{
			include 'pages/content/'.$_GET['p'].'.php';
		}
		else
		{
			include 'pages/content/news.php';
		}
		?>
		<br/>
		</div>
		<div class = "rightbar sidebar menuBG">
		<?php
		if (isset($_GET['p']) && file_exists('pages/right/'.$_GET['p'].'.php'))
		{
			include 'pages/right/'.$_GET['p'].'.php';
		}
		else
		{
			include 'pages/right/main.php';
		}
		?>
		</div>
		
	</div>
	<?php
	if ($player->IsLogged())
	{
	?>
	<!--<div class="footer borderT">
		<form action="?<?php if(isset($_GET['p'])){ echo 'p='.$_GET['p'].'&'; } ?>a=design" method="POST">
    <select style="height:30px;" name="design" id="design" class="select" onchange="this.form.submit()" selected="<?php echo $player->GetDesign(); ?>">
        <option value="default" <?php if($player->GetDesign() == 'default') { ?> selected <?php } ?> >Standard</option>
        <option value="dark" <?php if($player->GetDesign() == 'dark') { ?> selected <?php } ?>>Dark</option>
        <option value="gruen" <?php if($player->GetDesign() == 'gruen') { ?> selected <?php } ?>>Grün</option>
        <option value="pink" <?php if($player->GetDesign() == 'pink') { ?> selected <?php } ?>>Pink</option>
    </select>
</form></div>-->
	<!--<div class="footer borderT"><center><font color="red"><b><u>Vorschläge,Ideen und Bugs Bitte im Forum oder Discord nicht hier im Chat |<a href="/forum/index.php?board/5-ideen/">>> Zum Forum <<</a> | <a href="https://discord.gg/TMZrxCn">>> Zum Discord <<</a>|</u></b></font></center></div>-->
	<?php 
  if($player->GetChatActive() && (!isset($_GET['p']) || $_GET['p'] != 'infight' || $player->GetFight() == 0) && $player->GetChatbann() == 0)
	{
	
    echo '<div class="chatcontainer menuBG borderT">';
		include 'pages/chat.php';
	  echo '</div>';
	
	}
	} //PlayerLogged
	?>
	<footer>
	<div class="footer borderT" style="font-size:14px;">
		<?php
  $time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$finish = $time;
$total_time = round(($finish - $start),3);
echo '<span id="loadingtime">'.$total_time.'</span> Sekunden. ';
if($player->IsLogged() && $player->GetArank() == 3)
{
	$selects = $database->GetSelects();
		if($selects != 0)
		{
			echo $selects.' Selects ';
		}
	$updates = $database->GetUpdates();
		if($updates != 0)
		{
			echo $updates.' Updates ';
		}
	$inserts = $database->GetInserts();
		if($inserts != 0)
		{
			echo $inserts.' Inserts ';
		}
	$deletes = $database->GetDeletes();
		if($deletes != 0)
		{
			echo $deletes.' Deletes ';
		}
}
    ?>
Alle Urheberrechte zu Dragon Ball liegen bei FUNimation, Toei, Bird Studios, Akira Toriyama und Shueisha.
	</div>
	</footer>
</div>
</center>
<script type="text/javascript">
var timerStart = Date.now();
<?php
$googleChara = 962;  
if($player->GetID() != $googleChara)
{
  ?>LoadPopup();	<?php
}
?>
	
<?php 
if($player->GetChatActive())
{
	$channel = $player->GetChatChannel();
	?>
	InitChat('<?php echo $channel; ?>');
	<?php
}
  
if($player->GetID() == $googleChara)
{
}
else if(isset($message))
{
?>
	OpenPopupMessage('System','<?php echo $message; ?>'); 
<?php
}
else if($player->GetSparringCancel() != 0)
{
?>
	OpenPopupPage('Sparring Abbrechen','profil/sparringcancel.php');
<?php
}
else if($player->GetSparringRequest() != 0)
{
?>
	OpenPopupPage('Sparring Anfrage','profil/sparringrequest.php');
<?php
}
else if($player->GetFight() == 0 &&$player->GetStatsPopup())
{
?>
	OpenPopupPage('Skillpunkte Verteilen','skill/edit.php');
<?php
}
else if($player->GetFight() == 0 && $player->GetChallengeFight() != 0)
{
?>
	OpenPopupPage('Herausforderung','profil/challenged.php');
<?php
}
else if($player->GetFight() == 0 && $player->GetEventInvite() != 0)
{
?>
	OpenPopupPage('Event Einladung','profil/eventinvite.php');
<?php
}
else if($player->GetGroupInvite() != 0)
{
?>
	OpenPopupPage('Gruppeneinladung','profil/groupinvite.php');
<?php
}
else if($player->GetNPCWonItems() != '')
{
?>
	OpenPopupPage('Gewinn','profil/wonitem.php');
<?php
}
?>
	document.getElementById('loadingtime').innerHTML = (Date.now()-timerStart) / 1000;
</script>
</body>
</html>
