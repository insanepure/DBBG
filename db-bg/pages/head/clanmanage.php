<?php
if($player->GetClan() == 0)
{
	header('Location: ?p=news');
  exit();
}

include_once 'classes/clan/clan.php';
include_once 'classes/bbcode/bbcode.php';
$clan = new Clan($database, $player->GetClan());

if(isset($_GET['a']) && $_GET['a'] == 'post' &&isset($_POST['shoutboxtext']) && $_POST['shoutboxtext'] != '')
{
	$text = htmlentities($database->EscapeString($_POST['shoutboxtext']));
  if($database->HasBadWords($text))
  {
    $message = 'Der Text enthält ungültige Wörter.';
  }
	else
	{
		$clan->PostShoutbox($player->GetID(), $player->GetName(), $text);
	}
}
else if(isset($_GET['a']) && $_GET['a'] == 'rundmail' && ($clan->GetLeader() == $player->GetID() || $clan->GetCoLeader() == $player->GetID()))
{
  $id = $player->GetID();
  $image = $player->GetImage();
  $name = $player->GetName();
  $text = $database->EscapeString($_POST['text']);
  $title = $database->EscapeString($_POST['title']);
	if($text == '')
	{
		$message = 'Der Text ist leer.';
	}
	else if($title == '')
	{
		$message = 'Der Titel ist leer.';
	}
	else
	{
		$i = 0;
		$list = new Generallist($database, 'accounts', 'name, clan', 'clan="'.$clan->GetID().'"', '', 999999, 'ASC');
		$entry = $list->GetEntry($i);
		while($entry != null)
		{
			$PMManager->SendPM($id, $image, $name, $title, $text, $entry['name']);
			$i++;
			$entry = $list->GetEntry($i);
		}
		$message = 'Du hast eine Rundmail abgesendet.';
	}
}
else if(isset($_GET['a']) && $_GET['a'] == 'pay')
{
	if(isset($_POST['zeni']) && is_numeric($_POST['zeni']) && $_POST['zeni'] > 0)
	{
		$zeni = $_POST['zeni'];
		if($player->GetZeni() < $zeni)
		{
			$message = 'Du hast nicht genügend Zeni.';
		}
		else
		{
			//$byacc, $byname, $toacc, $toname
			$clan->AddZeni($zeni, $player->GetID(), $player->GetName(), 0, 'Kasse');
			$player->RemoveZeni($zeni);
			$message = 'Du hast '.$zeni.' Zeni in die Kasse eingezahlt.';
		}
	}
}
if(isset($_GET['a']) && $_GET['a'] == 'decline' && ($clan->GetLeader() == $player->GetID() || $clan->GetCoLeader() == $player->GetID()))
{
	if(isset($_GET['id']) && is_numeric($_GET['id']))
	{
		$joiner = new Player($database, $_GET['id'], $actionManager);
		if(!$joiner->GetClanApplication() == $clan->GetID())
		{
			$message = 'Dieser Spieler hat keine Bewerbung an den Clan gesendet.';
		}
		else
		{
			$joiner->DeleteClanApplication();
			$message = 'Du hast die Bewerbung von '.$joiner->GetName().' abgelehnt.';
		}
	}
}
else if(isset($_GET['a']) && $_GET['a'] == 'leave' && $clan->GetLeader() != $player->GetID())
{
	$player->LeaveClan();
	$clan->PlayerLeaves();
	header('Location: ?p=clanjoin');
  exit();
}
else if(isset($_GET['a']) && $_GET['a'] == 'demote' && $clan->GetLeader() == $player->GetID())
{
	if(isset($_GET['id']) && is_numeric($_GET['id']))
	{
		$joiner = new Player($database, $_GET['id'], $actionManager);
		if(!$joiner->GetClan() == $clan->GetID())
		{
			$message = 'Dieser Spieler ist nicht in deinen Clan.';
		}
		else if($joiner->GetID() == $player->GetID())
		{
			$message = 'Du kannst dich nicht selbst zum Co-Leiter ernennen.';
		}
		else if($clan->GetCoLeader() == $joiner->GetID())
		{
			$clan->RemoveCoLeader();
			$message = 'Du hast den Spieler '.$joiner->GetName().' den Co-Leiter Titel abgenommen.';
		}
		else
		{
			$message = 'Der Spieler muss der Co-Leiter sein.';
		}
	}
}
else if(isset($_GET['a']) && $_GET['a'] == 'promote' && $clan->GetLeader() == $player->GetID())
{
	if(isset($_GET['id']) && is_numeric($_GET['id']))
	{
		$joiner = new Player($database, $_GET['id'], $actionManager);
		if(!$joiner->GetClan() == $clan->GetID())
		{
			$message = 'Dieser Spieler ist nicht in deinen Clan.';
		}
		else if($joiner->GetID() == $player->GetID())
		{
			$message = 'Du kannst dich nicht selbst zum Leiter ernennen.';
		}
		else
		{
			if($clan->GetCoLeader() == $joiner->GetID())
			{
				$clan->MakeLeader($joiner);
				$message = 'Du hast den Spieler '.$joiner->GetName().' zum Leiter ernannt.';
			}
			else
			{
				$clan->MakeCoLeader($joiner);
				$message = 'Du hast den Spieler '.$joiner->GetName().' zum Co-Leiter ernannt.';
			}
		}
	}
}
else if(isset($_GET['a']) && $_GET['a'] == 'payout' && ($clan->GetLeader() == $player->GetID() || $clan->GetCoLeader() == $player->GetID()))
{
	if(isset($_POST['playerid']) && is_numeric($_POST['playerid']))
	{
		$otherPlayer = new Player($database, $_POST['playerid'], $actionManager);
		if($otherPlayer->GetClan() != $clan->GetID())
		{
			$message = 'Dieser Spieler ist nicht in deinen Clan.';
		}
		else if(isset($_POST['zeni']) && is_numeric($_POST['zeni']) && $_POST['zeni'] > 0)
		{
        $zeni = $_POST['zeni'];
        if($clan->GetZeni() < $zeni)
        {
          $message = 'Der Clan hat nicht genügend Zeni.';
        }
        else
        {
          //$byacc, $byname, $toacc, $toname
          $clan->RemoveZeni($zeni, $player->GetID(), $player->GetName(), $otherPlayer->GetID(), $otherPlayer->GetName());
          $otherPlayer->RemoveZeni($zeni);
          $message = 'Du hast '.$zeni.' Zeni an '.$otherPlayer->GetName().' gezahlt.';
        }
		}
	}
}
else if(isset($_GET['a']) && $_GET['a'] == 'kick' && ($clan->GetLeader() == $player->GetID() || $clan->GetCoLeader() == $player->GetID()))
{
	if(isset($_GET['id']) && is_numeric($_GET['id']))
	{
		$joiner = new Player($database, $_GET['id'], $actionManager);
		if($joiner->GetClan() != $clan->GetID())
		{
			$message = 'Dieser Spieler ist nicht in deinen Clan.';
		}
		else if($joiner->GetID() == $player->GetID())
		{
			$message = 'Du kannst dich nicht selbst kicken.';
		}
		else if($clan->GetCoLeader() == $joiner->GetID())
		{
			$message = 'Du kannst den Co-Leiter nicht kicken.';	
		}
		else
		{
			$joiner->LeaveClan();
			$clan->PlayerLeaves();
			$message = 'Du hast den Spieler '.$joiner->GetName().' gekickt.';
		}
	}
}
else if(isset($_GET['a']) && $_GET['a'] == 'accept' && ($clan->GetLeader() == $player->GetID() || $clan->GetCoLeader() == $player->GetID()))
{
	if(isset($_GET['id']) && is_numeric($_GET['id']))
	{
		$joiner = new Player($database, $_GET['id'], $actionManager);
		if(!$joiner->GetClanApplication() == $clan->GetID())
		{
			$message = 'Dieser Spieler hat keine Bewerbung an den Clan gesendet.';
		}
		else
		{
			$joiner->JoinClan($clan);
			$clan->PlayerJoins();
			$message = 'Du hast die Bewerbung von '.$joiner->GetName().' angenommen.';
		}
	}
}
else if(isset($_GET['a']) && $_GET['a'] == 'change' && ($clan->GetLeader() == $player->GetID() || $clan->GetCoLeader() == $player->GetID()) && count($_POST) > 0)
{
  $image = $clan->GetImage();
  $banner = $clan->GetBanner();
  $text = '';
  $rules = '';
  $requirements = '';
  
  if(isset($_POST['image']) && isset($_FILES['file_upload']) && $_FILES['file_upload']['tmp_name'] != '')
  {
    $imgHandler = new ImageHandler('userdata/clanbilder/');
    $result = $imgHandler->Upload($_FILES['file_upload'], $image, 600, 480);
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
  
  if(isset($_POST['banner']) && isset($_FILES['file_upload2']) && $_FILES['file_upload2']['tmp_name'] != '')
  {
    $imgHandler = new ImageHandler('userdata/clanwappen/');
    $result = $imgHandler->Upload($_FILES['file_upload2'], $banner, 30, 30);
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
  if(!isset($message))
  {
    if(isset($_POST['text']))
    {
      $text = $_POST['text'];
    }
    if(isset($_POST['rules']))
    {
      $rules = $_POST['rules'];
    }
    if(isset($_POST['requirements']))
    {
      $requirements = $_POST['requirements'];
    }
    $clan->Change($image, $banner, $text, $rules, $requirements);
    $message = 'Du hast die Clandaten geändert.';
  }
}
else if(isset($_GET['a']) && $_GET['a'] == 'delete' && $clan->GetLeader() == $player->GetID())
{
	if($clan->GetMembers() > 1)
	{
		$message = 'Du kannst den Clan erst löschen, wenn du das letze Mitglied bist.';
	}
	else
	{
		$clan->Delete($player);
		header('Location: ?p=news');
		exit();
	}
}
?>