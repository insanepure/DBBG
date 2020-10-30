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

if(!$userLoginActive && $account->IsLogged())
{
  $account->Logout();
}

/*if($player->GetARank() >=3) {
$database->Debug();
}*/

include_once 'events/events.php';
include_once 'npc/npc.php';
include_once 'fight/fight.php';
include_once 'gamedata.php';

//Import the PHPMailer class into the global namespace
use PHPMailer\PHPMailer\PHPMailer;

//$database->Debug();
function SendMail($email, $topic, $message)
{
  $sender   = "noreply@db-bg.de";

  $content = file_get_contents('mail.php');
  $content = str_replace("{0}", $topic, $content);
  $content = str_replace("{1}", $message, $content);

  
// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);
//Create a new PHPMailer instance
$mail = new PHPMailer;
//Set who the message is to be sent from
$mail->setFrom($sender, 'DBBG - das Dragonball Browsergame');
//Set an alternative reply-to address
$mail->addReplyTo($sender, 'DBBG - das Dragonball Browsergame');
//Set who the message is to be sent to
$mail->addAddress($email, 'User');
//Set the subject line
$mail->Subject = $topic;
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML($content);
//Replace the plain text body with one created manually
$mail->AltBody = $message;

return $mail->send();
  
//send the message, check for errors
//if (!$mail->send()) {
//    echo 'Mailer Error: '. $mail->ErrorInfo;
//} else {
//    echo 'Message sent!';
//}
  
}

if($player->IsLogged())
{
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