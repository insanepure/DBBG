<?php
$year = 2019;
$month = 10;
$day = 12;
$hour = 15;
$minute = 0;
$second = 0;
$isReleaseNow = time() > mktime($hour, $minute, $second, $month, $day, $year);

$userRegisterActive = true;
$userLoginActive = true;
$charaCreationActive = $isReleaseNow;

//this is for login stuff
include_once 'serverurl.php';
include_once $_SERVER['DOCUMENT_ROOT'].'../../main/www/classes/header.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$db = 'DB';
$user = 'droot';
$pw = '';
$database = new Database($db, $user, $pw);

include_once 'generallist.php';
include_once 'statslist/statslist.php';
include_once 'actions/actionmanager.php';
include_once 'items/itemmanager.php';
include_once 'titel/titelmanager.php';
include_once 'pms/pmmanager.php';
include_once 'planet/planet.php';
include_once 'places/place.php';
include_once 'player/player.php';
include_once 'clan/clan.php';
include_once 'eventitems/eventitems.php';

if(!$userLoginActive && $account->IsLogged())
{
  $account->Logout();
}

/*if($player->GetARank() >=3) {
$database->Debug();
}*/

include_once 'events/events.php';
include_once 'tower/tower.php';
include_once 'npc/npc.php';
include_once 'fight/fight.php';
include_once 'gamedata.php';
//$database->Debug();
function SendMail($email, $topic, $message)
{
  $sender   = "info@animebg.de";

  $content = file_get_contents('mail.php');
  $content = str_replace("{0}", $topic, $content);
  $content = str_replace("{1}", $message, $content);

  $content = utf8_decode($content);
  // Instantiation and passing `true` enables exceptions
  $mail = new PHPMailer(true);
  
  try {
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'HOST';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'info@animebg.de';                     //SMTP username
    $mail->Password   = 'PASSWORT';                      //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 465;                                  //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    $mail->addCustomHeader("List-Unsubscribe",'<info@animebg.de>, <https://animebg.de/unsubscribe.php?email='.$email.'>');
    
    
    
    //Set who the message is to be sent from
    $mail->setFrom($sender, 'AnimeBG');
    //Set an alternative reply-to address
    $mail->addReplyTo($sender, 'AnimeBG');
    //Set who the message is to be sent to
    $mail->addAddress($email, 'User');
    //Set the subject line
    $mail->Subject = $topic;
    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    $mail->msgHTML($content);
    //Replace the plain text body with one created manually
    $mail->AltBody = $message;
    
    $mail->send();
    return true;
  } 
  catch (Exception $e) 
  {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    return false;
  }
  
}

$eventItems = null;
$playerPlanet = null;

if($player->IsLogged())
{
  $playerPlanet = new Planet($database, $player->GetPlanet());
  $eventItems = new EventItems($database);
  
  $eventItemURL = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
  $eventItemPickURL = '&a=eventitem';
  $eventItemURL = str_replace($eventItemPickURL, '', $eventItemURL);
  
  $eventItem = $eventItems->LoadItem($eventItemURL);
  
  if($eventItem != null)
  {
    if($eventItems->HasItem($player->GetID(), $eventItem->GetID()))
    {
      $eventItem = null;
    }
    else if(isset($_GET['a']) && $_GET['a'] == 'eventitem')
    {
      $eventItems->AddItem($player->GetID(), $eventItem->GetID());
      
      $itemID = $eventItem->GetItem();
      $itemAmount = $eventItem->GetItemAmount();
      $zeni = $eventItem->GetZeni();
      
      $message = 'Du erhältst';
      $itemMessage = '';
      $zeniMessage = '';
      if($itemID != 0)
      {
        $itemManager = new ItemManager($database);
        $item = $itemManager->GetItem($itemID);
        $player->AddItems($item, $item, $itemAmount);
        
        $itemMessage = $itemAmount.'x '.$item->GetName();
      }
      if($zeni != 0)
      {
        $player->AddZeni($zeni);
        
        $zeniMessage = $zeni.' Zeni';
      }
      
      if($itemMessage != '')
        $message = $message.' '.$itemMessage;
      if($itemMessage != '' && $zeniMessage != '')
        $message = $message.' und';      
      if($zeniMessage != '')
        $message = $message.' '.$zeniMessage;
      
        $message = $message.'.';
      $eventItem = null;
    }
  }
  
  $clan = null;
  if($player->GetClan() != 0)
  {
    $clan = new Clan($database, $player->GetClan());
  }
  $PMManager = new PMManager($database, $player->GetID());
  $tournamentManager = null;
  if($player->GetTournament() != 0)
  {
    include_once 'tournament/tournamentmanager.php';
    $tournamentManager = new TournamentManager($database, $player->GetPlace(), $player->GetPlanet());
    $pTournament = $tournamentManager->GetTournamentByID($player->GetTournament());
  }
  if($player->GetFight() != 0)
  {
    $fight = new Fight($database, $player->GetFight(), $player, $actionManager);
  }
  
  if($player->GetGroupInvite() != 0)
  {
    $inviter = $player->GetGroupInvite();
    $otherPlayer = new Player($database, $inviter, $actionManager);
    if($otherPlayer == null || !$otherPlayer->IsValid())
    {
      $player->DeclineGroupInvite();
    }
  }
  else if($player->GetChallengeFight() != 0)
  {
    $fightID = $player->GetChallengeFight();
    $challengeFight = new Fight($database, $fightID, $player, $actionManager);
    if(!$challengeFight->IsValid() || $challengeFight->IsStarted())
    {
      $player->DeclineChallenge();
    }
  }
  else if($player->GetEventInvite() != 0)
  {
    $fightID = $player->GetEventInvite();
    $eventFight = new Fight($database, $fightID, $player, $actionManager);
    if(!$eventFight->IsValid() || $eventFight->IsStarted())
    {
      $player->DeclineEvent();
    }
  }
}
?>