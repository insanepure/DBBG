<?php
include_once 'classes/items/itemmanager.php';
include_once 'classes/bbcode/bbcode.php';
include_once 'classes/fight/attackmanager.php';
include_once 'classes/clan/clan.php';
$itemManager = new ItemManager($database);
$attackManager = new AttackManager($database);
$titelManager = new titelManager($database);
function postToDiscord($message)
{
    $data = array("content" => $message, "username" => "DBBG-Spion");
    $curl = curl_init("https://discordapp.com/api/webhooks/461508519666122773/iP_uTj5VkbQyOv1K4iwSeqidk_0IHUiyMreUcO1PWCHki2r6vrFeKVij87Blc4NGnEbX");
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    return curl_exec($curl);
}
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function ShowSlotEquippedImage($slot, $inventory, $zindex)
{
  $item = $inventory->GetItemAtSlot($slot);
  if($item != null)
  {
		?> 
		<div class="profilecharacter" style="top:20px; left:185px; z-index:<?php echo $zindex; ?>; background-image:url('img/ausruestung/<?php echo $item->GetEquippedImage(); ?>.png')"></div>
		<?php
  }
}

if($player->GetARank() >= 3 && isset($_GET['a']) && $_GET['a'] == 'adminlogin')
{
	$otherPlayer = new Player($database, $_GET['id'], $actionManager);
  $player->Logout();
  $otherPlayer->Login(false);
}
if(isset($_GET['a']) && $_GET['a'] == 'speedup')
{
    $action = $actionManager->GetAction($player->GetAction());
    $ortTravelID = 12;
    if($action == null || $action->GetID() != $ortTravelID)
    {
      $message = 'Du bist nicht auf Reise.';
    }
    else if(isset($_POST['factor']) && is_numeric($_POST['factor']) && $_POST['factor'] > 0 && $_POST['factor'] <= 100)
    {
      $factor = $_POST['factor'];
      $minutes = $factor * 10;
      $kp = $minutes * 10;
      $lp = $kp;
      if($player->GetLP() < $lp || $player->GetKP() < $kp)
      {
        $message = 'Du hast nicht genügend LP oder KP.';
      }
      else
      {
        $player->SpeedUpAction($minutes, $kp, $lp);
      }
    }
}
else if(isset($_GET['a']) && $_GET['a'] == 'block')
{
  if(!isset($_GET['id']) || !is_numeric($_GET['id']))
  {
    $message = 'Dieser Spieler ist ungültig.';
  }
  else
  {
	  $blockPlayer = new Player($database, $_GET['id'], $actionManager);
    $blocked = $player->IsBlocked($_GET['id']);
    if($blocked)
    {
      $player->UnBlock($_GET['id']);
      $message = 'Du hast '.$blockPlayer->GetName().' entblockiert.';
    }
    else
    {
      $player->Block($_GET['id']);
      $message = 'Du hast '.$blockPlayer->GetName().' blockiert.';
    }
  }
}
else if(isset($_GET['a']) && $_GET['a'] == 'meld' && $player != null)
{
  $meldPlayer = $player;
  if(isset($_GET['id']) && is_numeric($_GET['id']))
  {
	  $meldPlayer = new Player($database, $_GET['id'], $actionManager);
  }
  $title = 'Meldung von '.$player->GetName().' wegen '.$meldPlayer->GetName().' ('.$meldPlayer->GetID().')';
  $meldPlayer->DebugSend(false, $title);
  $message = 'Du hast einen Fehler bei '.$meldPlayer->GetName().' gemeldet.';
}
else if(isset($_GET['a']) && $_GET['a'] == 'acceptcancelsparring')
{
	$otherPlayer = new Player($database, $player->GetSparringPartner(), $actionManager);
	if($otherPlayer->IsValid())
	{
		$otherPlayer->DoSparringCancel();
		$player->DoSparringCancel();
		$message = 'Du hast das Sparring beendet.';
	}
}
else if(isset($_GET['a']) && $_GET['a'] == 'declinecancelsparring')
{
	$player->DenySparringCancel();
}
else if(isset($_GET['a']) && $_GET['a'] == 'acceptsparring')
{
	$otherPlayer = new Player($database, $player->GetSparringRequest(), $actionManager);
	if(!$otherPlayer->IsValid())
	{
		$message = 'Der andere Spieler ist ungültig.';
		$player->DenySparringRequest();
	}
	else if($player->GetARank() > 0)
	{
		$message = 'Als Admin kannst du kein Sparring machen.';
		$player->DenySparringRequest();
	}
	else if($otherPlayer->GetARank() > 0)
	{
		$message = 'Du kannst kein Sparring mit einen Admin machen.';
		$player->DenySparringRequest();
	}
	else if($otherPlayer->GetAction() != 0)
	{
		$message = 'Dein andere Spieler tut bereits etwas.';
		$player->DenySparringRequest();
	}
	else if($player->GetAction() != 0)
	{
		$message = 'Du tut bereits etwas.';
		$player->DenySparringRequest();
	}
	else
	{
		$time = $player->GetSparringTime();
		$player->DoSparring($otherPlayer->GetID(), $time);
		$otherPlayer->DoSparring($player->GetID(), $time);
    
    $charaids = array();
    array_push($charaids, $player->GetID());
    array_push($charaids, $otherPlayer->GetID());
    LoginTracker::AddInteraction($accountDB, $charaids, 'Sparring', 'dbbg');
    
		$message = 'Ihr trainiert nun zusammen.';
	}
}
else if(isset($_GET['a']) && $_GET['a'] == 'declinesparring')
{
	$player->DenySparringRequest();
}
else if(isset($_GET['a']) && $_GET['a'] == 'sparring')
{
    if($player->GetARank() > 0)
    {
      $message = 'Als Admin kannst du kein Sparring machen.';
    }
		else if($player->GetAction() != 0)
		{
			$message = 'Du tust bereits eine Aktion.';
		}
		else if(!is_numeric($_POST['hours']) || $_POST['hours'] < 1 || $_POST['hours'] > 24*30)
		{
			$message = 'Die Stunden sind ungültig.';
		}
		else if($player->GetSparringRequest() != 0)
		{
      //keine Message weil popup kommen sollt
		}
    else
    {
      $target = new Player($database, $_GET['id'], $actionManager);
			if(!$target->IsValid())
			{
				$message = 'Dein Partner ist ungültig.';
			}
      else if($target->GetARank() > 0)
      {
        $message = 'Du kannst kein Sparring mit einen Admin machen.';
      }
			else if($player->IsMulti($target))
			{
				$message = 'Du kannst mit einen deiner Charaktere kein Sparring machen.';
			}
			else if($target->GetAction() != 0)
			{
				$message = 'Dein Partner tut bereits etwas.';
			}
			else
			{
				$target->SparringRequest($player->GetID(), $_POST['hours']);
				$message = 'Du hast eine Sparring Anfrage an '.$target->GetName().' gesendet.';
			}
		}
}
else if(isset($_GET['a']) && $_GET['a'] == 'pwchange' && isset($_POST['realcheck']))
{
			$topic = 'Passwort ändern';
			$content ='
					Jemand hat eine Änderung des Passwortes für den Charakter <b>'.$player->GetName().'</b> beantragt.<br/>
					Wenn du Passwort wirklich ändern willst, dann folge den folgenden Link.<br/>
					<br/>
					Wenn du das Passwort nicht ändern willst, ignoriere diese Mail.<br/>
					<br/>
					<br/>
					<br/>
					<a href="'.$serverUrl.'/?p=pwforgot&id='.$player->GetID().'&code='.$player->GetPassword().'">Ich möchte das Passwort ändern.</a>
					<br/>
					<br/>';
			SendMail($player->GetEmail(), $topic, $content);
			$message = 'Es wurde eine Mail an deiner E-Mail Addresse gesendet. Schau auch im Spam Ordner nach.';
}
else if(isset($_GET['a']) && $_GET['a'] == 'delete')
{
	if($player->GetFight() != 0)
	{
		$message = 'Du kannst dich während eines Kampfes nicht löschen.';
	}
	else if($player->GetGroup() != null)
	{
		$message = 'Du musst zunächst die Gruppe verlassen.';
	}
	else if($player->GetTournament() != 0)
	{
		$message = 'Du kannst dich während eines Turnieres nicht löschen.';
	}
	else if($player->GetAction() != 0)
	{
		$message = 'Du musst zuerst deine Aktion beenden.';
	}
	else if(!isset($_GET['code']) && !isset($_POST['realcheck']))
	{
		$message = 'Du musst die Checkbox ankreuzen.';
	}
	else
	{
		
		$result = $database->Select('*','dragonballs','player="'.$player->GetID().'"',1);
		if ($result && $result->num_rows > 0) 
		{
				$message = 'Du musst die Dragonballs fallen lassen, bevor du dich löschen kannst.';
		}
		else
		{
      $codeHash = $player->GetName().'+'.$account->Get('id');
      $code = hash('sha256', 'thisisa'.$codeHash.'safepw');
			if(isset($_GET['code']) && $_GET['code'] == $code && isset($_GET['id']) && $_GET['id'] == $player->GetID())
			{
				$player->DeleteAccount();
				header('Location: ?p=news');
				exit();
			}
      else if(isset($_GET['id']) && $_GET['id'] != $player->GetID())
      {
        $message = 'Du musst dich mit dem Charakter einloggen, den du löschen willst.';
      }
			else
			{
				$topic = 'Charakter Löschung';
				$content ='
						Möchtest du wirklich deinen Charakter <b>'.$player->GetName().'</b> löschen?<br/>
						Wenn du deinen Charakter löschst, kann niemand den Charakter wiederherstellen.<br/>
						Alle deine Daten gehen verloren.<br/>
						<br/>
						Falls du den Charakter nicht löschen willst, dann ignoriere diese Mail.<br/>
						<br/>
						<br/>
						<br/>
						<a href="'.$serverUrl.'?p=profil&a=delete&code='.$code.'&id='.$player->GetID().'">Ich möchte den Charakter löschen.</a>
						<br/>
						<br/>';
				SendMail($account->Get('email'), $topic, $content);
				$message = 'Es wurde eine Mail an deiner E-Mail Addresse ('.$account->Get('email').') gesendet. Schau auch im Spam Ordner nach.';
			}
		}
	}
}
else if(isset($_GET['a']) && $_GET['a'] == 'powerup')
{
	if(!isset($_POST['powerup']))
	{
		$message = 'Du musst mindestens eine Technik auswählen.';
	}
	else if(!is_numeric($_POST['powerup']))
	{
		$message = 'Die Technik ist ungültig.';
	}
	else
	{
		  $allAttacks = explode(';',$player->GetFightAttacks());
			if($_POST['powerup'] != 0 && !in_array($_POST['powerup'], $allAttacks))
			{
        $message = 'Du hast dieses Powerup nicht ausgewählt für den Kampf.';
			}
    else
    {
		  $player->UpdateStartingPowerup($_POST['powerup']);
		  $message = 'Du hast deinen Powerup für den Kampf ausgewählt.';
    }
	}
}
else if(isset($_GET['a']) && $_GET['a'] == 'attacks')
{
	if(!isset($_POST['attacks']))
	{
		$message = 'Du musst mindestens eine Technik auswählen.';
	}
	else if(!in_array('1',$_POST['attacks']))
	{
		$message = 'Du musst Schlag als Technik wählen.';
	}
	else if(count($_POST['attacks']) > 18)
	{
		$message = 'Du kannst maximal 18 Techniken wählen.';
	}
	else
	{
		$player->UpdateFightAttacks($_POST['attacks']);
		$message = 'Du hast deine Techniken für den Kampf ausgewählt.';
	}
}
else if(isset($_GET['a']) && $_GET['a'] == 'fakeki' && isset($_POST['fakeki']) && $player->CanFakeKI())
{
	$fakeki = $_POST['fakeki'];
	if($fakeki > $player->GetKI() || $fakeki < 0)
	{
		$fakeki = 0;
	}
	$player->ChangeFakeKI($fakeki);
}
/*
else if(isset($_GET['a']) && $_GET['a'] == 'chatban')
{
$servername = "localhost";
$username = "root";
$password = "YZl3XUowy0";
$dbname = "dbbg";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error){
die("Connection failed: " . $conn->connect_error);
}
$sql = 'UPDATE accounts SET chatban="1" WHERE id="'.$_POST['playeridtoban'].'"';
if ($conn->query($sql) === TRUE) {
} else {echo "Error updating record: " . $conn->error;}

$conn->close();
$datumunban = date('Y-m-d H:i:s', time()+60*60*24*30);
$PMManager->SendPM(0, 'img/chatimage.png', 'Chat', 'Chat Ausschluss', 'Du Wurdest durch ein Regelbruch aus dem Chat ausgeschlossen!'.chr(10).chr(10).'§6: Chat.'.chr(10).chr(10).'Nr1: 	Das Provozieren anderer User im DBBG Chat ist strengstens untersagt'.chr(10).chr(10).'Nr2: 	Dazu gehören gezielte Provokationen die zu Konflikte führen.'.chr(10).chr(10).'Nr3: 	Moderatoren/Supporter sind berechtigt, bestimmte Diskussionen und Gesprächsthemen zu beenden oder zu verbieten, wenn diese sich negativ auf die Chat auswirken (In Form von verärgerte User, ungeeigneter Gesprächsstoff, anstößige Inhalte, Inhalte die nicht gern gesehen bzw. unpassend sind)'.chr(10).chr(10).'Bitte Lese dir die Regeln noch einmal durch um für die zukung weiter Strafen zu umgehen.'.chr(10).chr(10).'Hinweiß:'.chr(10).chr(10).'Diese Nachricht ist von System Erstellt worden wen du weitere fragen zur aufhebung oder fragen zu deinem Chat Ausschluss hast stell deine Fragen bitte über das Support Ticket System.', $_POST['playernametoban']);
$message2 = '```=============================================='.chr(10).'Der User '.$_POST['playernametoban'].' hat von '.$player->GetName().chr(10).'Am: '.$timestamp = date('Y-m-d H:i:s').' einen Chat Ausschluss bekommen.'.chr(10).'Hinweiß: Es wurde eine PM an den User Gesendet'.chr(10).'Entbannung: '.$datumunban.chr(10).'Info: Bitte Manuel in 30Tagen wieder freischalten.'.chr(10).'==============================================```';
//postToDiscord($message2);
$message = 'Du hast den User: '.$_POST['playernametoban'].' aus dem Chat entfernt und ein Chat Ausschluss eingetragen.';

}

else if(isset($_GET['a']) && $_GET['a'] == 'warn')
{
$servername = "localhost";
$username = "root";
$password = "YZl3XUowy0";
$dbname = "dbbg";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error){
die("Connection failed: " . $conn->connect_error);
}
$sql = 'UPDATE accounts SET warnung=warnung+"1" WHERE id="'.$_POST['playeridtoban'].'"';
if ($conn->query($sql) === TRUE) {
} else {echo "Error updating record: " . $conn->error;}

$conn->close();
$datumunban = date('Y-m-d H:i:s', time()+60*60*24*30);
$PMManager->SendPM(0, 'img/chatimage.png', 'SYSTEM', 'Verwarnung', 'Du hast durch ein Regelbruch eine Verwarnung bekommen!', $_POST['playernametoban']);
$message2 = '```=============================================='.chr(10).'Der User '.$_POST['playernametoban'].' hat von '.$player->GetName().chr(10).'Am: '.$timestamp = date('Y-m-d H:i:s').' eine Verwarnung bekommen.'.chr(10).'==============================================```';
//postToDiscord($message2);
$message = 'Du hast den User: '.$_POST['playernametoban'].' Eine Verwarnung eingetragen';

}

else if(isset($_GET['a']) && $_GET['a'] == 'chatunban')
{
$servername = "localhost";
$username = "root";
$password = "YZl3XUowy0";
$dbname = "dbbg";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error){
die("Connection failed: " . $conn->connect_error);
}
$sql = 'UPDATE accounts SET chatban="0" WHERE id="'.$_POST['playeridtoban'].'"';
if ($conn->query($sql) === TRUE) {
} else {echo "Error updating record: " . $conn->error;}

$conn->close();
$PMManager->SendPM(0, 'img/chatimage.png', 'Chat', 'Chat Freischaltung', 'Du Wurdest durch ein Supporter/Moderator wieder zum Chat zugelassen!'.chr(10).chr(10).'Bitte Beachte die Regeln:'.chr(10).chr(10).'§6: Chat.'.chr(10).chr(10).'Nr1: 	Das Provozieren anderer User im DBBG Chat ist strengstens untersagt'.chr(10).chr(10).'Nr2: 	Dazu gehören gezielte Provokationen die zu Konflikte führen.'.chr(10).chr(10).'Nr3: 	Moderatoren/Supporter sind berechtigt, bestimmte Diskussionen und Gesprächsthemen zu beenden oder zu verbieten, wenn diese sich negativ auf die Chat auswirken (In Form von verärgerte User, ungeeigneter Gesprächsstoff, anstößige Inhalte, Inhalte die nicht gern gesehen bzw. unpassend sind)'.chr(10).chr(10).'Bitte Lese dir die Regeln noch einmal durch um für die zukung weiter Strafen zu umgehen.'.chr(10).chr(10).'Hinweiß:'.chr(10).chr(10).'Diese Nachricht ist von System Erstellt worden wen du weitere fragen zur aufhebung oder fragen zu deinem Chat Ausschluss hast stell deine Fragen bitte über das Support Ticket System.', $_POST['playernametoban']);
$message2 = '```=============================================='.chr(10).'Der User '.$_POST['playernametoban'].' wurde von '.$player->GetName().' Am: '.$timestamp = date('Y-m-d H:i:s').' zum Chat wieder zugelassen.'.chr(10).'==============================================```';
//postToDiscord($message2);
}
*/
else if(isset($_GET['a']) && $_GET['a'] == 'style' && isset($_POST['design']))
{
	$design = $_POST['design'];
	$player->ChangeDesign($design);
}
else if(isset($_GET['a']) && $_GET['a'] == 'titel' && isset($_POST['titel']))
{
	$titel = $_POST['titel'];
	$player->ChangeTitel($titel);
}
else if(isset($_GET['a']) && $_GET['a'] == 'change')
{
  $text = $_POST['text']; 
  $image = $player->GetImage();
  if($database->HasBadWords($text))
  {
    $message = 'Der Text enthält ungültige Wörter.';
  }
	else
	{
		$imagepossible = true;   
    if(isset($_FILES['file_upload']) && $_FILES['file_upload']['size'] != 0)
    {
      $imgHandler = new ImageHandler('userdata/profilbilder/');
      $result = $imgHandler->Upload($_FILES['file_upload'], $image);
      switch($result)
      {
        case -1:
          $message = 'Die Datei ist zu groß.';
          break;
        case -2:
          $message = 'Die Datei ist ungültig.';
          break;
        case -3:
          $message = 'Es ist nur jpg, jpeg und png erlaubt.';
          break;
        case -4:
          $message = 'Es gab ein Problem beim generieren des Namens.';
          break;
        case -5:
          $message = 'Es gab ein Problem beim hochladen.';
          break;
      }
    }   
		$chatactivate = $_POST['chatactivate'];
		$player->ChangeProfile($text, $image, $chatactivate);
	}
  
}
else if(isset($_GET['a']) && $_GET['a'] == 'groupaccept' && $player->GetGroup() == null && $player->GetGroupInvite() != 0)
{
	if($otherPlayer == null || !$otherPlayer->IsValid())
	{
		$message = 'Der andere Spieler existiert nicht mehr.';
	}
	else
	{
		$group = $otherPlayer->GetGroup();
		$otherPlayer->AddToGroup($player->GetID());
		$group = implode(';',$otherPlayer->GetGroup());
		//SQL is updated by AddToGroup
		$player->SetGroup($group);
		$message = 'Du bist der Gruppe beigetreten.';
	}
	$player->DeclineGroupInvite();
}
else if(isset($_GET['a']) && $_GET['a'] == 'groupdecline' && $player->GetGroupInvite() != 0)
{
	$player->DeclineGroupInvite();
}
else if(isset($_GET['a']) && $_GET['a'] == 'groupkick')
{
  $target = null;
	if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] != $player->GetID())
	{
     $target = new Player($database, $_GET['id'], $actionManager);
	}
	
	if(isset($_GET['id']) && $_GET['id'] == $player->GetID())
	{
		$message = 'Du kannst dich nicht selber kicken.';
	}
	else if($target == null || !$target->IsValid())
	{
		$message = 'Dieser User gibt es nicht.';
	}
	else if($target->GetGroup() != $player->GetGroup())
	{
		$message = 'Der User ist nicht in deiner Gruppe.';
	}
	else if(!$player->IsGroupLeader() && $player->GetGroup() != null)
	{
		$message = 'Du musst Gruppenleiter sein um andere Spieler zu kicken.';
	}
	else
	{
		$groupSQL = $target->LeaveGroup();
		if($groupSQL == '')
		{
			$player->SetGroup(null);
			$player->GiveupGroupLeader();
		}
		else
		{
			$player->SetGroup($groupSQL);
		}
		$message = 'Du hast '.$target->GetName().' aus der Gruppe entfernt.';
	}
}
else if(isset($_GET['a']) && $_GET['a'] == 'grouppromote')
{
  $target = null;
	if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] != $player->GetID())
	{
     $target = new Player($database, $_GET['id'], $actionManager);
	}
	
	if(isset($_GET['id']) && $_GET['id'] == $player->GetID())
	{
		$message = 'Du kannst dich nicht selber zum Leiter ernennen.';
	}
	else if($target == null || !$target->IsValid())
	{
		$message = 'Dieser User gibt es nicht.';
	}
	else if($target->GetGroup() != $player->GetGroup())
	{
		$message = 'Der User ist nicht in deiner Gruppe.';
	}
	else if(!$player->IsGroupLeader() && $player->GetGroup() != null)
	{
		$message = 'Du musst Gruppenleiter sein um andere Spieler zu ernennen.';
	}
	else
	{
		$target->MakeGroupLeader();
		$player->GiveupGroupLeader();
		$message = 'Du hast '.$target->GetName().' zum Leiter ernannt.';
	}
}
else if(isset($_GET['a']) && $_GET['a'] == 'groupinvite')
{
  $target = null;
	if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] != $player->GetID())
	{
     $target = new Player($database, $_GET['id'], $actionManager);
	}
	
	if(isset($_GET['id']) && $_GET['id'] == $player->GetID())
	{
		$message = 'Du kannst dich nicht selber zur Gruppe einladen.';
	}
	else if($target == null || !$target->IsValid())
	{
		$message = 'Dieser User gibt es nicht.';
	}
	else if($player->GetARank() < 3 && $player->IsMulti($target))
	{
		$message = 'Du kannst mit einen deiner Charaktere keine Gruppe bilden machen.';
	}
	else if($target->GetGroup() != null)
	{
		$message = 'Der User ist schon in einer Gruppe.';
	}
	else if($target->GetGroupInvite() != 0)
	{
		$message = 'Der User wurde schon eingeladen.';
	}
	else if(!$player->IsGroupLeader() && $player->GetGroup() != null)
	{
		$message = 'Du musst Gruppenleiter sein um andere Spieler einzuladen.';
	}
	else
	{
		$target->InviteToGroup($player->GetID());
		$message = 'Du hast '.$target->GetName().' zur Gruppe eingeladen.';
	}
}
/*else if(false && isset($_GET['a']) && $_GET['a'] == 'trade')
{
  $target = null;
	if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] != $player->GetID())
	{
     $target = new Player($database, $_GET['id'], $actionManager);
	}
	
	if($player->GetLevel() < 4)
	{
		$message = 'Du kannst erst mit Level 4 handeln.';
	}
	else if(isset($_GET['id']) && $_GET['id'] == $player->GetID())
	{
		$message = 'Du kannst dir nichts selber schenken.';
	}
	else if($player->IsMulti($target))
	{
		$message = 'Du kannst mit einen deiner Charaktere kein Handel betreiben machen.';
	}
  else if($target->GetFight() != 0)
	{
		$message = 'Du kannst dem User im Kampf nichts schenken.';
	}
	else if($target == null || !$target->IsValid())
	{
		$message = 'Dieser User gibt es nicht.';
	}
	else if(!isset($_POST['item']) || !is_numeric($_POST['item']))
	{
		$message = 'Das Item ist ungültig.';
	}
	else if(!isset($_POST['amount']) || !is_numeric($_POST['amount']) || $_POST['amount'] <= 0)
	{
		$message = 'Die Anzahl ist ungültig.';
	}
	else
	{
		$itemID = $_POST['item'];
		$amount = $_POST['amount'];
		
		if($itemID == 0) // zeni
		{
			if($player->GetZeni() < $amount)
			{
				$message = 'Du hast nicht genügend Zeni.';
			}
			else
			{
				$target->AddZeni($amount);
				$player->RemoveZeni($amount);
				$message = 'Du hast '.$amount.' Zeni an '.$target->GetName().' verschenkt.';
					$PMManager->SendPM(0, 'img/geschenk.jpg', 'SYSTEM', 'Geschenk', 'Du hast '.$amount.' Zeni von '.$player->GetName().' bekommen.', $target->GetName());
			}
		}
		else
		{
			$inventory = $player->GetInventory();
			$itemData = $itemManager->GetItem($itemID);
			if($itemData == null)
			{
				$message = 'Das Item gibt es nicht.';
			}
			else
			{
				$i = 0;
				$item = $inventory->GetItem($i);
				$inventoryAmount = 0;
				while(isset($item))
				{
					if($item->GetSlot() == null && $item->GetID() == $itemID)
					{
						$inventoryAmount += $item->GetAmount();
					}
					++$i;
					$item = $inventory->GetItem($i);
				}
				if(!$itemData->IsSellable())
				{
					$message = 'Das Item kann nicht verschenkt werden.';
				}
				else if($inventoryAmount < $amount)
				{
					$message = 'Du besitzt nicht genügend davon.';
				}
				else
				{
					$target->AddItems($itemData, $amount);
					$player->RemoveItems($itemData, $amount);
					$message = 'Du hast '.$amount.' '.$itemData->GetName().' an '.$target->GetName().' verschenkt.';
					$PMManager->SendPM(0, 'img/geschenk.jpg', 'SYSTEM', 'Geschenk', '[img width=80 height=80]img/items/'.$itemData->GetImage().'.png[/img]
					'.$amount.'x '.$itemData->GetName().' von '.$player->GetName().' bekommen.', $target->GetName());
				}
			}
		}
		
	}
}*/
else if(isset($_GET['a']) && $_GET['a'] == 'declineEvent')
{
	if(isset($eventFight) && $eventFight->IsValid() && !$eventFight->IsStarted())
	{
		$eventFight->DeleteFightAndFighters();
	}
	$player->DeclineEvent();
}
else if(isset($_GET['a']) && $_GET['a'] == 'acceptEvent' && isset($eventFight) && $eventFight->IsValid())
{
		$player->DeclineEvent();
  	if(isset($fight))
    {
      $message = "Du befindest dich schon in einem Kampf";
    }
		else if($player->GetTournament() != 0)
		{
			$message = 'Du kannst während eines Turnieres nicht kämpfen.';
		}
    else if($player->GetLP() < ($player->GetMaxLP() * 0.2))
    {
      $message = 'Du hast nicht genügend LP. Du benötigst mindestens 20% deiner maximalen LP.';
    }
		else if($eventFight->IsStarted())
		{
      $message = 'Der Kampf hat schon begonnen.';
		}
		else
		{
    	$eventFight->Join($player, 0, false);
			header('Location: ?p=fight');
			exit();
		}
}
else if(isset($_GET['a']) && $_GET['a'] == 'declineChallenge' && (!isset($challengeFight) || isset($challengeFight) && $challengeFight->GetType() != 7))
{
	$player->DeclineChallenge();
	if(isset($challengeFight) && $challengeFight->IsValid() && $challengeFight->GetChallenge() == $player->GetID())
	{
		$challengeFight->DeleteFightAndFighters();
	}
}
else if(isset($_GET['a']) && $_GET['a'] == 'acceptChallenge' && isset($challengeFight) && $challengeFight->IsValid() && $challengeFight->GetChallenge() == $player->GetID())
{
  	if(isset($fight))
    {
      $message = "Du befindest dich schon in einem Kampf";
    }
		else if($player->GetTournament() != 0)
		{
			$message = 'Du kannst während eines Turnieres nicht kämpfen.';
		}
    else if($challengeFight->GetType() != 0 && $player->GetLP() < ($player->GetMaxLP() * 0.2))
    {
      $message = 'Du hast nicht genügend LP. Du benötigst mindestens 20% deiner maximalen LP.';
    }
		else
		{
			$player->DeclineChallenge();
    	$challengeFight->Join($player, 1, false);
			header('Location: ?p=fight');
			exit();
		}
}
else if(isset($_GET['a']) && $_GET['a'] == 'challenge')
{
  	if(isset($fight))
    {
      $message = "Du befindest dich schon in einem Kampf";
    }
		else if($player->GetTournament() != 0)
		{
			$message = 'Du kannst während eines Turnieres nicht kämpfen.';
		}
    else if(!isset($_POST['type']) || !is_numeric($_POST['type']) || $_POST['type'] < 0 || $_POST['type'] > 2)
    {
      $message = 'Diese Art von Kampf gibt es nicht!';
    }
    else if(!isset($_GET['id']) || !is_numeric($_GET['id']))
    {
      $message = "Dieser Gegner ist ungültig.";
    }
    else if($_POST['type'] != 0 && $player->GetLP() < ($player->GetMaxLP() * 0.2))
    {
      $message = 'Du hast nicht genügend LP. Du benötigst mindestens 20% deiner maximalen LP.';
    }
    else
    {
      $target = new Player($database, $_GET['id'], $actionManager);
			if($target->GetFight() != 0)
			{
				$message = 'Dein Gegner befindet sich schon im Kampf.';
			}
      else if($type != 0 && $player->IsMulti($target))
      {
        $message = 'Du kannst mit einen deiner Charaktere nicht kämpfen.';
      }
			else if($target->GetTournament() != 0)
			{
				$message = 'Dein Gegner kann während eines Turnieres nicht kämpfen.';
			}
			else if($target->GetChallengeFight() != 0)
			{
				$message = 'Dieser Spieler wurde schon herausgefordert.';
			}
			else if($_POST['type'] != 0 && $target->GetLP() < ($target->GetMaxLP() * 0.2))
			{
				$message = 'Dein Gegner hat nicht genügend LP.';
			}
			else
			{
				$type = $_POST['type'];
				$mode = '1vs1';
				$name = $player->GetName().' vs '.$target->GetName();
				$team = 1;
				$createdFight = Fight::CreateFight($player, $database, $type, $name, $mode, 0, $actionManager, 0, '', 0, $target->GetID());
				$target->Challenge($createdFight->GetID());
        if($createdFight->IsStarted())
        {
          header('Location: ?p=infight');
				  exit();
        }
        $message = 'Du hast '.$target->GetName().' herausgefordert.';
			}
    }
}
else if(isset($_GET['a']) && $_GET['a'] == 'statspopup')
{
  $player->CloseStatsPopup();
  
}
else if(isset($_GET['a']) && $_GET['a'] == 'stats')
{
  if($player->GetFight() != 0)
  {
    $message = 'Du kannst im Kampf deine Stats nicht ändern.';
  }
	else if($player->GetTournament() != 0)
	{
    $message = 'Du kannst im Turnier deine Stats nicht ändern.';
	}
  else if(isset($_POST['attack']) && is_numeric($_POST['attack'])
    && isset($_POST['lp']) && is_numeric($_POST['lp'])
    && isset($_POST['kp']) && is_numeric($_POST['kp'])
    && isset($_POST['defense']) && is_numeric($_POST['defense'])
    )
  {
    $totalStats = $player->GetStats();
    
    $lp = $_POST['lp'];
    $kp = $_POST['kp'];
    $attack = $_POST['attack'];
    $defense = $_POST['defense'];
    $stats = $lp+$kp+$attack+$defense;
    if($attack >= 0 
       && $lp >= 0
       && $kp >= 0
       && $defense >= 0
       && $totalStats >= $stats
      )
    {
      $player->IncreaseStats($lp, $kp, $attack, $defense);
    }
    else
    {
      $message = 'Diese Statswerte sind ungültig.';
    }
  }
}
?>