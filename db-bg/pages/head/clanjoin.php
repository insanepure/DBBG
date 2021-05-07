<?php
include_once 'classes/bbcode/bbcode.php';


$clanapplication = null;
if($player->GetClanApplication() != 0)
{
  $clanapplication = new Clan($database, $player->GetClanApplication());
}

if(isset($_GET['a']) && $_GET['a'] == 'delete')
{
  $player->DeleteClanApplication();
  $clanapplication = null;
}
else if(isset($_GET['a']) && $_GET['a'] == 'join')
{
	if($player->GetLevel() < 4)
	{
		$message = 'Du kannst erst mit Level 4 einen Clan beitreten.';
	}
  else if($player->GetClan() != 0)
  {
    $message = 'Du bist bereits in einem Clan.';
  }
  else if(!isset($_POST['text']))
  {
    $message = 'Du hast keinen Text angegeben.';
  }
  else if(isset($_POST['clanname']))
  {
		$clanname = $database->EscapeString($_POST['clanname']);
		$clanID = Clan::FindByName($database, $clanname);
    if($clanID == 0)
    {
      $message = 'Dieser Clan gibt es nicht.';
    }
    else
    {
    	$applyClan = new Clan($database, $clanID);
      $player->SendClanApplication($applyClan, $_POST['text']);
      $clanapplication = $applyClan;
      $message = 'Du hast eine Beitrittsanfrage an den Clan '.$applyClan->GetName().' geschickt.';
    }
  }
}
?>