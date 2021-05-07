<?php
include_once $_SERVER['DOCUMENT_ROOT'].'../../main/www/classes/session.php';
ini_set("display_errors", 1);
ini_set("track_errors", 1);
ini_set("log_errors", 0);
ini_set("html_errors", 1);
error_reporting(E_ALL & ~E_DEPRECATED);
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
  LoginTracker::TrackUser($accountDB, $account->Get('id'), $player->GetName(), 'dbbg', $account->Get('password'), $account->Get('email'), session_id(), $account->GetIP(), $account->GetRealIP());
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
  <link rel="stylesheet" href="css/pages/<?php echo $_GET['p']; ?>.css?009">
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
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
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

<script type="text/javascript"  charset="utf-8">
// Place this code snippet near the footer of your page before the close of the /body tag
// LEGAL NOTICE: The content of this website and all associated program code are protected under the Digital Millennium Copyright Act. Intentionally circumventing this code may constitute a violation of the DMCA.
                            
eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}(';q O=\'\',27=\'1Z\';1O(q i=0;i<12;i++)O+=27.X(C.J(C.N()*27.G));q 2v=1,2Y=4z,2R=4A,2I=4B,2l=D(e){q i=!1,o=D(){z(k.1g){k.2V(\'2P\',t);F.2V(\'1S\',t)}Q{k.2U(\'2O\',t);F.2U(\'24\',t)}},t=D(){z(!i&&(k.1g||4C.2B===\'1S\'||k.2K===\'2Q\')){i=!0;o();e()}};z(k.2K===\'2Q\'){e()}Q z(k.1g){k.1g(\'2P\',t);F.1g(\'1S\',t)}Q{k.2N(\'2O\',t);F.2N(\'24\',t);q n=!1;32{n=F.4E==4F&&k.1W}39(r){};z(n&&n.34){(D d(){z(i)H;32{n.34(\'13\')}39(t){H 4G(d,50)};i=!0;o();e()})()}}};F[\'\'+O+\'\']=(D(){q e={e$:\'1Z+/=\',4y:D(t){q d=\'\',a,n,i,c,s,l,o,r=0;t=e.t$(t);1e(r<t.G){a=t.16(r++);n=t.16(r++);i=t.16(r++);c=a>>2;s=(a&3)<<4|n>>4;l=(n&15)<<2|i>>6;o=i&63;z(37(n)){l=o=64}Q z(37(i)){o=64};d=d+10.e$.X(c)+10.e$.X(s)+10.e$.X(l)+10.e$.X(o)};H d},11:D(t){q n=\'\',a,l,c,s,r,o,d,i=0;t=t.1q(/[^A-4H-4J-9\\+\\/\\=]/g,\'\');1e(i<t.G){s=10.e$.1L(t.X(i++));r=10.e$.1L(t.X(i++));o=10.e$.1L(t.X(i++));d=10.e$.1L(t.X(i++));a=s<<2|r>>4;l=(r&15)<<4|o>>2;c=(o&3)<<6|d;n=n+S.T(a);z(o!=64){n=n+S.T(l)};z(d!=64){n=n+S.T(c)}};n=e.n$(n);H n},t$:D(e){e=e.1q(/;/g,\';\');q n=\'\';1O(q i=0;i<e.G;i++){q t=e.16(i);z(t<1z){n+=S.T(t)}Q z(t>4K&&t<4L){n+=S.T(t>>6|4M);n+=S.T(t&63|1z)}Q{n+=S.T(t>>12|2H);n+=S.T(t>>6&63|1z);n+=S.T(t&63|1z)}};H n},n$:D(e){q i=\'\',t=0,n=4N=1m=0;1e(t<e.G){n=e.16(t);z(n<1z){i+=S.T(n);t++}Q z(n>4O&&n<2H){1m=e.16(t+1);i+=S.T((n&31)<<6|1m&63);t+=2}Q{1m=e.16(t+1);2m=e.16(t+2);i+=S.T((n&15)<<12|(1m&63)<<6|2m&63);t+=3}};H i}};q a=[\'4P==\',\'4Q\',\'4I=\',\'4w\',\'4m\',\'4v=\',\'4e=\',\'4f=\',\'4g\',\'4h\',\'4i=\',\'4j=\',\'4k\',\'4d\',\'4l=\',\'4n\',\'4o=\',\'4p=\',\'4q=\',\'4r=\',\'4s=\',\'4t=\',\'4u==\',\'4R==\',\'4x==\',\'4S==\',\'5g=\',\'5i\',\'5j\',\'5k\',\'5l\',\'5m\',\'5n\',\'5o==\',\'5p=\',\'5h=\',\'5q=\',\'5s==\',\'5t=\',\'5u\',\'5v=\',\'5w=\',\'5x==\',\'5y=\',\'5z==\',\'5r==\',\'5f=\',\'55=\',\'5e\',\'4V==\',\'5A==\',\'4W\',\'4X==\',\'4Y=\'],y=C.J(C.N()*a.G),Y=e.11(a[y]),w=Y,A=1,W=\'#4Z\',r=\'#51\',g=\'#52\',f=\'#53\',L=\'\',b=\'4U 54 56 2E.\',p=\'57 58 59 5a 5b, 5c 5d 4T 4c. 47 4a 3c 3i 3u 3A 3a 3y.\',v=\'3l 3k 3g 3f 3d, 3z 3m 3n 3q: 3j://3r.3t/3o\',s=\'3x 3w 3v 2E 3s.\',i=0,u=0,n=\'3p.3b\',l=0,Z=t()+\'.2M\';D h(e){z(e)e=e.1K(e.G-15);q i=k.2z(\'3h\');1O(q n=i.G;n--;){q t=S(i[n].1H);z(t)t=t.1K(t.G-15);z(t===e)H!0};H!1};D m(e){z(e)e=e.1K(e.G-15);q t=k.3e;x=0;1e(x<t.G){1l=t[x].1o;z(1l)1l=1l.1K(1l.G-15);z(1l===e)H!0;x++};H!1};D t(e){q n=\'\',i=\'1Z\';e=e||30;1O(q t=0;t<e;t++)n+=i.X(C.J(C.N()*i.G));H n};D o(i){q o=[\'3T\',\'3V==\',\'3W\',\'3X\',\'2d\',\'3Y==\',\'3Z=\',\'41==\',\'3U=\',\'42==\',\'44==\',\'45==\',\'46\',\'3B\',\'48\',\'2d\'],r=[\'2J=\',\'49==\',\'43==\',\'3S==\',\'3D=\',\'3R\',\'3Q=\',\'3P=\',\'2J=\',\'3O\',\'3N==\',\'3M\',\'3L==\',\'3K==\',\'3J==\',\'3I=\'];x=0;1Q=[];1e(x<i){c=o[C.J(C.N()*o.G)];d=r[C.J(C.N()*r.G)];c=e.11(c);d=e.11(d);q a=C.J(C.N()*2)+1;z(a==1){n=\'//\'+c+\'/\'+d}Q{n=\'//\'+c+\'/\'+t(C.J(C.N()*20)+4)+\'.2M\'};1Q[x]=21 23();1Q[x].1T=D(){q e=1;1e(e<7){e++}};1Q[x].1H=n;x++}};D M(e){};H{36:D(e,r){z(3H k.K==\'3G\'){H};q i=\'0.1\',r=w,t=k.1a(\'1w\');t.14=r;t.j.1k=\'1I\';t.j.13=\'-1h\';t.j.V=\'-1h\';t.j.1b=\'29\';t.j.U=\'3F\';q a=k.K.2c,d=C.J(a.G/2);z(d>15){q n=k.1a(\'2b\');n.j.1k=\'1I\';n.j.1b=\'1u\';n.j.U=\'1u\';n.j.V=\'-1h\';n.j.13=\'-1h\';k.K.3E(n,k.K.2c[d]);n.1c(t);q o=k.1a(\'1w\');o.14=\'2e\';o.j.1k=\'1I\';o.j.13=\'-1h\';o.j.V=\'-1h\';k.K.1c(o)}Q{t.14=\'2e\';k.K.1c(t)};l=5C(D(){z(t){e((t.1V==0),i);e((t.1X==0),i);e((t.1R==\'2u\'),i);e((t.1F==\'2n\'),i);e((t.1J==0),i)}Q{e(!0,i)}},26)},1N:D(t,c){z((t)&&(i==0)){i=1;F[\'\'+O+\'\'].1B();F[\'\'+O+\'\'].1N=D(){H}}Q{q v=e.11(\'7q\'),u=k.7o(v);z((u)&&(i==0)){z((2Y%3)==0){q l=\'7n=\';l=e.11(l);z(h(l)){z(u.1P.1q(/\\s/g,\'\').G==0){i=1;F[\'\'+O+\'\'].1B()}}}};q y=!1;z(i==0){z((2R%3)==0){z(!F[\'\'+O+\'\'].2k){q a=[\'72==\',\'6X==\',\'7f=\',\'7h=\',\'7j=\'],m=a.G,r=a[C.J(C.N()*m)],d=r;1e(r==d){d=a[C.J(C.N()*m)]};r=e.11(r);d=e.11(d);o(C.J(C.N()*2)+1);q n=21 23(),s=21 23();n.1T=D(){o(C.J(C.N()*2)+1);s.1H=d;o(C.J(C.N()*2)+1)};s.1T=D(){i=1;o(C.J(C.N()*3)+1);F[\'\'+O+\'\'].1B()};n.1H=r;z((2I%3)==0){n.24=D(){z((n.U<8)&&(n.U>0)){F[\'\'+O+\'\'].1B()}}};o(C.J(C.N()*3)+1);F[\'\'+O+\'\'].2k=!0};F[\'\'+O+\'\'].1N=D(){H}}}}},1B:D(){z(u==1){q R=2p.7g(\'2j\');z(R>0){H!0}Q{2p.7e(\'2j\',(C.N()+1)*26)}};q h=\'7b==\';h=e.11(h);z(!m(h)){q c=k.1a(\'78\');c.1Y(\'77\',\'76\');c.1Y(\'2B\',\'1f/75\');c.1Y(\'1o\',h);k.2z(\'74\')[0].1c(c)};73(l);k.K.1P=\'\';k.K.j.17+=\'P:1u !19\';k.K.j.17+=\'1t:1u !19\';q Z=k.1W.1X||F.38||k.K.1X,y=F.71||k.K.1V||k.1W.1V,d=k.1a(\'1w\'),A=t();d.14=A;d.j.1k=\'2r\';d.j.13=\'0\';d.j.V=\'0\';d.j.U=Z+\'1y\';d.j.1b=y+\'1y\';d.j.2g=W;d.j.1U=\'70\';k.K.1c(d);q a=\'<a 1o="6Z://5B.6Y"><2w 14="2x" U="2y" 1b="40"><2D 14="2s" U="2y" 1b="40" 7m:1o="7a:2D/7r;7I,7J+7K+7L+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+B+7H+7N+7G/7x/7E/7F/7s/7t+/7u/7v+7p/7w+7y/7z/7A/7B/7C/7D/7c+6W/6j+6U+5X+5Y+5Z+61/62+66/67+5W/68+6a+6b+6c+6V/6d+6e/6f/6g/69+5U+5L/5T+5E+5F+5G+E+5H/5I/5J/5D/5K/5M/+5N/5O++5P/5Q/5R+5S/6h+5V+6i==">;</2w></a>\';a=a.1q(\'2x\',t());a=a.1q(\'2s\',t());q o=k.1a(\'1w\');o.1P=a;o.j.1k=\'1I\';o.j.1x=\'1M\';o.j.13=\'1M\';o.j.U=\'6E\';o.j.1b=\'6F\';o.j.1U=\'2h\';o.j.1J=\'.6\';o.j.2i=\'2f\';o.1g(\'6G\',D(){n=n.6H(\'\').6I().6J(\'\');F.2q.1o=\'//\'+n});k.1E(A).1c(o);q i=k.1a(\'1w\'),M=t();i.14=M;i.j.1k=\'2r\';i.j.V=y/7+\'1y\';i.j.6D=Z-6L+\'1y\';i.j.6N=y/3.5+\'1y\';i.j.2g=\'#6O\';i.j.1U=\'2h\';i.j.17+=\'I-1v: "6P 6Q", 1n, 1s, 1r-1p !19\';i.j.17+=\'6R-1b: 6T !19\';i.j.17+=\'I-1j: 6M !19\';i.j.17+=\'1f-1C: 1A !19\';i.j.17+=\'1t: 6B !19\';i.j.1R+=\'2X\';i.j.2S=\'1M\';i.j.6s=\'1M\';i.j.6A=\'2C\';k.K.1c(i);i.j.6m=\'1u 6o 6p -6q 6k(0,0,0,0.3)\';i.j.1F=\'2t\';q x=30,w=22,Y=18,L=18;z((F.38<35)||(6r.U<35)){i.j.2L=\'50%\';i.j.17+=\'I-1j: 6t !19\';i.j.2S=\'6u;\';o.j.2L=\'65%\';q x=22,w=18,Y=12,L=12};i.1P=\'<2T j="1i:#6v;I-1j:\'+x+\'1D;1i:\'+r+\';I-1v:1n, 1s, 1r-1p;I-1G:6w;P-V:1d;P-1x:1d;1f-1C:1A;">\'+b+\'</2T><2W j="I-1j:\'+w+\'1D;I-1G:6x;I-1v:1n, 1s, 1r-1p;1i:\'+r+\';P-V:1d;P-1x:1d;1f-1C:1A;">\'+p+\'</2W><6y j=" 1R: 2X;P-V: 0.2Z;P-1x: 0.2Z;P-13: 28;P-33: 28; 2F:6z 7M #4b; U: 25%;1f-1C:1A;"><p j="I-1v:1n, 1s, 1r-1p;I-1G:2G;I-1j:\'+Y+\'1D;1i:\'+r+\';1f-1C:1A;">\'+v+\'</p><p j="P-V:6n;"><2b 6l="10.j.1J=.9;" 6S="10.j.1J=1;"  14="\'+t()+\'" j="2i:2f;I-1j:\'+L+\'1D;I-1v:1n, 1s, 1r-1p; I-1G:2G;2F-6K:2C;1t:1d;6C-1i:\'+g+\';1i:\'+f+\';1t-13:29;1t-33:29;U:60%;P:28;P-V:1d;P-1x:1d;" 79="F.2q.7d();">\'+s+\'</2b></p>\'}}})();F.2A=D(e,t){q n=7i.7k,i=F.7l,d=n(),o,r=D(){n()-d<t?o||i(r):e()};i(r);H{3C:D(){o=1}}};q 2o;z(k.K){k.K.j.1F=\'2t\'};2l(D(){z(k.1E(\'2a\')){k.1E(\'2a\').j.1F=\'2u\';k.1E(\'2a\').j.1R=\'2n\'};2o=F.2A(D(){F[\'\'+O+\'\'].36(F[\'\'+O+\'\'].1N,F[\'\'+O+\'\'].4D)},2v*26)});',62,484,'|||||||||||||||||||style|document||||||var|||||||||if||vr6|Math|function||window|length|return|font|floor|body|||random|HZLRBVxmnEis|margin|else||String|fromCharCode|width|top||charAt|||this|decode||left|id||charCodeAt|cssText||important|createElement|height|appendChild|10px|while|text|addEventListener|5000px|color|size|position|thisurl|c2|Helvetica|href|serif|replace|sans|geneva|padding|0px|family|DIV|bottom|px|128|center|BvGmnhiLuw|align|pt|getElementById|visibility|weight|src|absolute|opacity|substr|indexOf|30px|UxsyxGUtOJ|for|innerHTML|spimg|display|load|onerror|zIndex|clientHeight|documentElement|clientWidth|setAttribute|ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789||new||Image|onload||1000|bDBZWnFPYT|auto|60px|babasbmsgx|div|childNodes|cGFydG5lcmFkcy55c20ueWFob28uY29t|banner_ad|pointer|backgroundColor|10000|cursor|babn|ranAlready|sUnKsLrnef|c3|none|JQSoXdnbso|sessionStorage|location|fixed|FILLVECTID2|visible|hidden|apfGCsOLej|svg|FILLVECTID1|160|getElementsByTagName|XevcLXvAIz|type|15px|image|Adblocker|border|300|224|LAIUFevvQk|ZmF2aWNvbi5pY28|readyState|zoom|jpg|attachEvent|onreadystatechange|DOMContentLoaded|complete|JVKCjIFxJX|marginLeft|h3|detachEvent|removeEventListener|h1|block|SLZoOLljlU|5em|||try|right|doScroll|640|RKievBQMOU|isNaN|innerWidth|catch|eine|kcolbdakcolb|weder|hast|styleSheets|Fragen|hierzu|script|ein|https|du|Falls|dich|im|PUC5MwT|moc|Discord|discord|deaktiviert|gg|Popup|den|habe|Ich|Weiterleitung|melde|noch|YWRzYXR0LmVzcG4uc3RhcndhdmUuY29t|clear|c2t5c2NyYXBlci5qcGc|insertBefore|468px|undefined|typeof|YWR2ZXJ0aXNlbWVudC0zNDMyMy5qcGc|d2lkZV9za3lzY3JhcGVyLmpwZw|bGFyZ2VfYmFubmVyLmdpZg|YmFubmVyX2FkLmdpZg|ZmF2aWNvbjEuaWNv|c3F1YXJlLWFkLnBuZw|YWQtbGFyZ2UucG5n|Q0ROLTMzNC0xMDktMTM3eC1hZC1iYW5uZXI|YWRjbGllbnQtMDAyMTQ3LWhvc3QxLWJhbm5lci1hZC5qcGc|MTM2N19hZC1jbGllbnRJRDI0NjQuanBn|NzIweDkwLmpwZw|YWRuLmViYXkuY29t|Y2FzLmNsaWNrYWJpbGl0eS5jb20|YWQubWFpbC5ydQ|anVpY3lhZHMuY29t|YWQuZm94bmV0d29ya3MuY29t|YS5saXZlc3BvcnRtZWRpYS5ldQ|YWdvZGEubmV0L2Jhbm5lcnM||YWR2ZXJ0aXNpbmcuYW9sLmNvbQ|cHJvbW90ZS5wYWlyLmNvbQ|NDY4eDYwLmpwZw|YWRzLnlhaG9vLmNvbQ|YWRzLnp5bmdhLmNvbQ|YWRzYXR0LmFiY25ld3Muc3RhcndhdmUuY29t|Dies|YXMuaW5ib3guY29t|YmFubmVyLmpwZw|ist|CCC|Werbung|QWQzMDB4MjUw|YWQtbGFiZWw|YWQtbGI|YWQtZm9vdGVy|YWQtY29udGFpbmVy|YWQtY29udGFpbmVyLTE|YWQtY29udGFpbmVyLTI|QWQzMDB4MTQ1|QWQ3Mjh4OTA|YWQtaW1n|QWRBcmVh|QWRGcmFtZTE|QWRGcmFtZTI|QWRGcmFtZTM|QWRGcmFtZTQ|QWRMYXllcjE|QWRMYXllcjI|QWRzX2dvb2dsZV8wMQ|YWQtaW5uZXI|YWQtaGVhZGVy|QWRzX2dvb2dsZV8wMw|encode|103|217|112|event|htEhkZdpaQ|frameElement|null|setTimeout|Za|YWQtZnJhbWU|z0|127|2048|192|c1|191|YWQtbGVmdA|YWRCYW5uZXJXcmFw|QWRzX2dvb2dsZV8wMg|QWRzX2dvb2dsZV8wNA|eingebettete|Du|cG9wdXBhZA|Z29vZ2xlX2Fk|b3V0YnJhaW4tcGFpZA|c3BvbnNvcmVkX2xpbms|444444||000000|5ab878|FFFFFF|nutzt|YmFubmVyaWQ|einen|Um|die|Server|zu|bezahlen|zeigen|wir|YWRzbG90|YWRzZXJ2ZXI|RGl2QWQ|QWRCb3gxNjA|RGl2QWQx|RGl2QWQy|RGl2QWQz|RGl2QWRB|RGl2QWRC|RGl2QWRD|QWRJbWFnZQ|QWREaXY|QWRDb250YWluZXI|YWRfY2hhbm5lbA|Z2xpbmtzd3JhcHBlcg|YWRUZWFzZXI|YmFubmVyX2Fk|YWRCYW5uZXI|YWRiYW5uZXI|YWRBZA|YmFubmVyYWQ|IGFkX2JveA|YWRzZW5zZQ|blockadblock|setInterval|UIWrdVPEp7zHy7oWXiUgmR3kdujbZI73kghTaoaEKMOh8up2M8BVceotd|j9xJVBEEbWEXFVZQNX9|1HX6ghkAR9E5crTgM|0t6qjIlZbzSpemi|MjA3XJUKy|SRWhNsmOazvKzQYcE0hV5nDkuQQKfUgm4HmqA2yuPxfMU1m4zLRTMAqLhN6BHCeEXMDo2NsY8MdCeBB6JydMlps3uGxZefy7EO1vyPvhOxL7TPWjVUVvZkNJ|CGf7SAP2V6AjTOUa8IzD3ckqe2ENGulWGfx9VKIBB72JM1lAuLKB3taONCBn3PY0II5cFrLr7cCp|BNyENiFGe5CxgZyIT6KVyGO2s5J5ce|bTplhb|14XO7cR5WV1QBedt3c|QhZLYLN54|e8xr8n5lpXyn|u3T9AbDjXwIMXfxmsarwK9wUBB5Kj8y2dCw|Kq8b7m0RpwasnR|uJylU|dEflqX6gzC4hd1jSgz0ujmPkygDjvNYDsU0ZggjKBqLPrQLfDUQIzxMBtSOucRwLzrdQ2DFO0NDdnsYq0yoJyEB0FHTBHefyxcyUy8jflH7sHszSfgath4hYwcD3M29I5DMzdBNO2IFcC5y6HSduof4G5dQNMWd4cDcjNNeNGmb02|E5HlQS6SHvVSU0V|F2Q|3eUeuATRaNMs0zfml|iqKjoRAEDlZ4soLhxSgcy6ghgOy7EeC2PI4DHb7pO7mRwTByv5hGxF|CXRTTQawVogbKeDEs2hs4MtJcNVTY2KgclwH2vYODFTa4FQ|1FMzZIGQR3HWJ4F1TqWtOaADq0Z9itVZrg1S6JLi7B1MAtUCX1xNB0Y0oL9hpK4|YbUMNVjqGySwrRUGsLu6||uWD20LsNIDdQut4LXA|KmSx||||0nga14QJ3GOWqDmOwJgRoSme8OOhAQqiUhPMbUGksCj5Lta4CbeFhX9NN0Tpny|BKpxaqlAOvCqBjzTFAp2NFudJ5paelS5TbwtBlAvNgEdeEGI6O6JUt42NhuvzZvjXTHxwiaBXUIMnAKa5Pq9SL3gn1KAOEkgHVWBIMU14DBF2OH3KOfQpG2oSQpKYAEdK0MGcDg1xbdOWy|I1TpO7CnBZO|x0z6tauQYvPxwT0VM1lH9Adt5Lp|QcWrURHJSLrbBNAxZTHbgSCsHXJkmBxisMvErFVcgE|h0GsOCs9UwP2xo6|UimAyng9UePurpvM8WmAdsvi6gNwBMhPrPqemoXywZs8qL9JZybhqF6LZBZJNANmYsOSaBTkSqcpnCFEkntYjtREFlATEtgxdDQlffhS3ddDAzfbbHYPUDGJpGT|uI70wOsgFWUQCfZC1UI0Ettoh66D|szSdAtKtwkRRNnCIiDzNzc0RO|kmLbKmsE|pyQLiBu8WDYgxEZMbeEqIiSM8r|Uv0LfPzlsBELZ|gkJocgFtzfMzwAAAABJRU5ErkJggg|RUIrwGk|rgba|onmouseover|boxShadow|35px|14px|24px|8px|screen|marginRight|18pt|45px|999|200|500|hr|1px|borderRadius|12px|background|minWidth|160px|40px|click|split|reverse|join|radius|120|16pt|minHeight|fff|Arial|Black|line|onmouseout|normal|qdWy60K14k|UADVgvxHBzP9LUufqQDtV|EuJ0GtLUjVftvwEYqmaR66JX9Apap6cCyKhiV|Ly93d3cuZ3N0YXRpYy5jb20vYWR4L2RvdWJsZWNsaWNrLmljbw|com|http|9999|innerHeight|Ly93d3cuZ29vZ2xlLmNvbS9hZHNlbnNlL3N0YXJ0L2ltYWdlcy9mYXZpY29uLmljbw|clearInterval|head|css|stylesheet|rel|link|onclick|data|Ly95dWkueWFob29hcGlzLmNvbS8zLjE4LjEvYnVpbGQvY3NzcmVzZXQvY3NzcmVzZXQtbWluLmNzcw|0idvgbrDeBhcK|reload|setItem|Ly9hZHZlcnRpc2luZy55YWhvby5jb20vZmF2aWNvbi5pY28|getItem|Ly9hZHMudHdpdHRlci5jb20vZmF2aWNvbi5pY28|Date|Ly93d3cuZG91YmxlY2xpY2tieWdvb2dsZS5jb20vZmF2aWNvbi5pY28|now|requestAnimationFrame|xlink|Ly9wYWdlYWQyLmdvb2dsZXN5bmRpY2F0aW9uLmNvbS9wYWdlYWQvanMvYWRzYnlnb29nbGUuanM|querySelector|cIa9Z8IkGYa9OGXPJDm5RnMX5pim7YtTLB24btUKmKnZeWsWpgHnzIP5UucvNoDrl8GUrVyUBM4xqQ|aW5zLmFkc2J5Z29vZ2xl|png|aa2thYWHXUFDUPDzUOTno0dHipqbceHjaZ2dCQkLSLy|v7|b29vlvb2xn5|ejIzabW26SkqgMDA7HByRAADoM7kjAAAAInRSTlM6ACT4xhkPtY5iNiAI9PLv6drSpqGYclpM5bengkQ8NDAnsGiGMwAABetJREFUWMPN2GdTE1EYhmFQ7L339rwngV2IiRJNIGAg1SQkFAHpgnQpKnZBAXvvvXf9mb5nsxuTqDN|ISwIz5vfQyDF3X|Ly8vKysrDw8O4uLjkt7fhnJzgl5d7e3tkZGTYVlZPT08vLi7OCwu|MgzNFaCVyHVIONbx1EDrtCzt6zMEGzFzFwFZJ19jpJy2qx5BcmyBM|oGKmW8DAFeDOxfOJM4DcnTYrtT7dhZltTW7OXHB1ClEWkPO0JmgEM1pebs5CcA2UCTS6QyHMaEtyc3LAlWcDjZReyLpKZS9uT02086vu0tJa|Lnx0tILMKp3uvxI61iYH33Qq3M24k|VOPel7RIdeIBkdo|HY9WAzpZLSSCNQrZbGO1n4V4h9uDP7RTiIIyaFQoirfxCftiht4sK8KeKqPh34D2S7TsROHRiyMrAxrtNms9H5Qaw9ObU1H4Wdv8z0J8obvOo|wd4KAnkmbaePspA|v792dnbbdHTZYWHZXl7YWlpZWVnVRkYnJib8|PzNzc3myMjlurrjsLDhoaHdf3|fn5EREQ9PT3SKSnV1dXks7OsrKypqambmpqRkZFdXV1RUVHRISHQHR309PTq4eHp3NzPz8|sAAADMAAAsKysKCgokJCRycnIEBATq6uoUFBTMzMzr6urjqqoSEhIGBgaxsbHcd3dYWFg0NDTmw8PZY2M5OTkfHx|base64|iVBORw0KGgoAAAANSUhEUgAAAKAAAAAoCAMAAABO8gGqAAAB|1BMVEXr6|sAAADr6|solid|enp7TNTUoJyfm5ualpaV5eXkODg7k5OTaamoqKSnc3NzZ2dmHh4dra2tHR0fVQUFAQEDPExPNBQXo6Ohvb28ICAjp19fS0tLnzc29vb25ubm1tbWWlpaNjY3dfX1oaGhUVFRMTEwaGhoXFxfq5ubh4eHe3t7Hx8fgk5PfjY3eg4OBgYF'.split('|'),0,{}));
</script>
<script type="text/javascript" src="https://cookiegenerator.eu/cookie.js?position=top&amp;skin=cookielaw4&amp;animation=shake&amp;delay=0&amp;msg=Wir%20benutzen%20Cookies%20um%20das%20Einloggen%20im%20Spiel%20zu%20erm%C3%B6glichen%2C%20Infos%20dazu%20findest%20du%20%5Burl%3Dhttps%3A%2F%2Fdb-bg.de%2F%3Fp%3Dinfo%26info%3Dcookies%5Dhier%5B%2Furl%5D.%20Wenn%20du%20die%20Seite%20weiter%20nutzt%20stimmst%20du%20den%20%5Burl%3Dhttps%3A%2F%2Fdb-bg.de%2F%3Fp%3Dinfo%26info%3Dregeln%5DRegeln%5B%2Furl%5D%20und%20der%20%5Burl%3Dhttps%3A%2F%2Fdb-bg.de%2F%3Fp%3Dinfo%26info%3Ddsgvo%5DDatenschutzverordnung%5B%2Furl%5D%20zu.&amp;accept_radius=20"></script>
</body>
</html>
