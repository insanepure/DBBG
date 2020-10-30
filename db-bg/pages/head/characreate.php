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
    else if($rasse != $raceImage || !is_numeric($raceImageID) || $raceImageID < 1 || $raceImageID > 4)
    {
      $message = 'Das Bild ist ungültig.';
    }
    else
    {
      $raceImage = $raceImage.$raceImageID;
      $result = $player->CreateCharacter($rasse, $chara, $raceImage, $account->Get('id'));
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