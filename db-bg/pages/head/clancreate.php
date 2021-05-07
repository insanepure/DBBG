<?php

if(isset($_GET['a']) && $_GET['a'] == 'create')
{
	$cost = 2000;
  if($player->GetClan() != 0)
  {
    $message = 'Du bist bereits in einem Clan.';
  }
  else if($player->GetClanApplication() != 0)
  {
    $message = 'Du hast eine Clan Beitrittsanfrage noch offen.';
  }
  else if($player->GetZeni() < $cost)
  {
    $message = 'Du hast nicht genügend Zeni.';
  }
  else if(isset($_POST['name']) && isset($_POST['tag']))
  {
    $name = htmlentities($database->EscapeString($_POST['name']));
    $tag = htmlentities($database->EscapeString($_POST['tag']));
		
    if($database->HasBadWords($name))
    {
      $message = 'Der Name enthält ungültige Wörter.';
    }
    else if($database->HasBadWords($tag))
    {
      $message = 'Der Tag enthält ungültige Wörter.';
    }
		else if($player->GetLevel() < 4)
		{
			$message = 'Du kannst erst mit Level 4 einen Clan erstellen.';
		}
    else if($name == '')
    {
      $message = 'Du hast keinen Namen angegeben.';
    }
    else if($name == 'Clanlos')
    {
      $message = 'Der Name ist ungültig.';
    }
    else if($tag == '')
    {
      $message = 'Du hast keinen Tag angegeben.';
    }
		else if (!preg_match("/^[a-zA-Z0-9 ]+$/", $name))
		{
			$message = 'Der Name darf nur aus Buchstaben und Zahlen bestehen.';
		}
		else if (!preg_match("/^[a-zA-Z0-9]+$/", $tag))
		{
			$message = 'Der Tag darf nur aus Buchstaben und Zahlen bestehen.';
		}
    else
    {
      if(!CreateClan($database, $name, $tag, $player))
      {
        $message = 'Der Name oder der Tag ist schon vergeben.';
      }
      else
      {
				$player->RemoveZeni($cost);
        header('Location: ?p=clanmanage');
        exit();
      }
    }
  }
}

?>