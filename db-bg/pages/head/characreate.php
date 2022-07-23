<?php
if (isset($_GET['a']) && $charaCreationActive && !$player->IsLogged())
{
	$a = $_GET['a'];
	if($a == 'register')
	{
    $result = 4;
    
    $chara = $_POST['chara'];
    $rasse = $_POST['rasse'];
    $raceImage = $_POST['raceimage'];
    $raceImageID = substr($raceImage, -1);
    $raceImage = substr($raceImage, 0, -1);
    
    $minRaceID = 4;
    if($rasse == 'Saiyajin' || $rasse == 'Demon')
      $minRaceID = 5;

    if($database->HasBadWords($chara))
    {
      $message = 'Der Name enthält ungültige Wörter.';
    }
    else if (!preg_match("/^[a-zA-Z0-9]+$/", $chara))
    {
      $message = 'Der Name darf nur aus Buchstaben und Zahlen bestehen.';
    }
    else if (strtolower($chara) == 'system')
    {
      $message = 'Den Namen darfst du nicht benutzen.';
    }
	  else if (strtolower($chara) == 'bot')
    {
      $message = 'Den Namen darfst du nicht benutzen.';
    }
	  else if (strtolower($chara) == 'gott')
    {
      $message = 'Den Namen darfst du nicht benutzen.';
    }
	  else if (strtolower($chara) == 'dbbg')
    {
      $message = 'Den Namen darfst du nicht benutzen.';
    }
    else if($rasse != 'Saiyajin' && $rasse != 'Mensch' && $rasse != 'Freezer' && $rasse != 'Kaioshin' && $rasse != 'Android' && $rasse != 'Majin' && $rasse != 'Demon' && $rasse != 'Namekianer')
    {
      $message = 'Die Rasse ist ungültig.';
    }
    else if($rasse != $raceImage || !is_numeric($raceImageID) || $raceImageID < 1 || $raceImageID > $minRaceID)
    {
      $message = 'Das Bild ist ungültig.';
    }
    else
    {
      $raceImage = $raceImage.$raceImageID;
      $result = $player->CreateCharacter($rasse, $chara, $raceImage, $account->Get('id'));
      $id = 0;
	    $image = "img/system.png";
      $name = 'System';
      $title = 'Anleitung';
      $text = 'Willkommen beim [b]Dragonball Browsergame[/b]!
      
      Du solltest dir zunächst im [b][url=?p=shop]Shop[/url][/b] neue Ausrüstung kaufen.
      Diese kannst du dann unter [b][url=?p=ausruestung]Ausrüstung[/url][/b] anlegen.
      Wenn du das gemacht hast, kannst du die [b][url=?p=story]Story[/url][/b] anfangen.
      Wir empfehlen dir außerdem, sobald du durch die [b][url=?p=story]Story[/url][/b] Level 2 erreicht hast, gegen den [b][url=?p=boss]Boss[/url][/b] zu kämpfen,
      dort erhältst du bessere Ausrüstung als die aus dem Shop.
      Jeden Tag kannst du durch [b][url=?p=fight]5 Wertungskämpfe[/url][/b] und [b][url=?p=npc]10 NPC-Kämpfen[/url][/b] Zeni gewinnen.
      Ebenfalls kannst du Stats durch Wertungskämpfe erhalten. 
      Für jeden Level erhältst du [b]10 Statspunkte[/b], wenn du [b]10 Wertungskämpfe[/b] gewonnen oder verloren hast. 
      Auf Level 1 erhältst du 10 Statspunkte nach 10 Wertungskämpfen.
      Auf Level 2 erhälst du erneut 10 Statspunkte, wenn du erneut 10 Wertungskämpfe machst, womit du auf insgesamt 20 Wertungskämpfen kommst.
      Dies gilt für jedes weitere Level.
      Falls du sonstige Fragen hast, dann zögere nicht unten im [b]Chat[/b] zu schreiben oder die [b][url=?p=support]Supporter[/url][/b] anzuschreiben.
      
      Ich wünsche dir viel Spaß!';
			$PMManager = new PMManager($database, $id);
			$PMManager->SendPM($id, $image, $name, $title, $text, $chara);
    }
		
  
    if($result == 0)
    {
      header('Location: ?p=charalogin');
      exit(); 
    }
    else if($result == 2)
    {
      $message = 'Der Charaktername ist ungültig.';
    }
    else if($result == 1)
    {
      $message = 'Der Charaktername existiert bereits.';
    }
  }
}

if ($player->IsLogged())
{
	header('Location: index.php');
	exit();  
}
?>