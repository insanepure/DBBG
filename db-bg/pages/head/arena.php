<?php
exit();
include_once 'classes/arena/arena.php';
include_once 'classes/items/itemmanager.php';
$itemManager = new ItemManager($database);

$arena = new Arena($database);
if(isset($_GET['a']) && $_GET['a'] == 'buy')
{
  if(!isset($_POST['item']) || !is_numeric($_POST['item']))
  {
    $message = 'Das Item ist ungültig.';
  }
  if(!isset($_POST['amount']) || !is_numeric($_POST['amount'])|| floor($_POST['amount']) <= 0)
  {
    $message = 'Die Anzahl ist ungültig.';
  } 
  else if($player->GetFight() != 0) {
    $message = 'Du bist in einem Kampf und kannst das Item nicht kaufen.';
  }
  else
  {
    $amount = $_POST['amount'];
    $item = $itemManager->GetItem($_POST['item']);
    $arenaPoints = $item->GetArenaPoints() * $amount;
    if($item == null)
    {
      $message = 'Das Item gibt es nicht.';
    }
    else if($player->GetArenaPoints() < $arenaPoints)
    {
      $message = 'Du hast nicht genügend Arenapunkte.';
    }
    else if($arenaPoints == 0)
    {
      $message = 'Du kannst das item nicht kaufen.';
    }
    else if($item->GetNeedItem() != 0 && !$player->$player->HasItemWithID($item->GetNeedItem(), $item->GetNeedItem()))
    {
      $message = 'Du benötigst ein besonderes Item.';
    }
	  else
	  {
       $statstype = $item->GetDefaultStatsType();
       $upgrade = 0;
		   $player->BuyItem($item, $item, $statstype, $upgrade, $amount, 0, $arenaPoints);
		   $message = 'Du hast '.$amount.'x '.$item->GetName().' gekauft.';
	  }
  }
  
}
else if(isset($_GET['a']) && $_GET['a'] == 'search')
{
  if(!$arena->IsFighterIn($player->GetID()))
    $message = 'Du bist nicht in der Arena.';
  else
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
      // Build POST request:
      $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
      $recaptcha_secret = '6Lcd57wUAAAAAESxu56CVSwlLc2QcNZa31PD3tMr';
      $recaptcha_response = $_POST['g-recaptcha-response'];
      // Make and decode POST request:
      $recaptcha = file_get_contents($recaptcha_url.'?secret='.$recaptcha_secret.'&response='.$recaptcha_response);
      $recaptcha = json_decode($recaptcha);
      if($recaptcha && $recaptcha->success)
      {
        $account->UpdateRecaptcha($recaptcha);
        if($recaptcha->score < 0.7)
        {
          $text = $player->GetName().' hatte eine Score von '.$recaptcha->score.' in der Arena.';
          //$PMManager->SendPM(0, '', 'Recaptcha', $player->GetName(), $text, 'PuRe');
        }
      }
    }
    $enemyID = $arena->GetRandomFighter($player->GetID());
    if($enemyID == -1)
      $message = 'Es ist niemand sonst in der Arena kampfbereit.';
    else
    {
	    $otherPlayer = new Player($database, $enemyID, $actionManager);
      if(isset($fight))
      {
        $message = "Du befindest dich schon in einem Kampf";
        $arena->Leave($player->GetID());
      }
      else if($otherPlayer->GetFight() != 0)
      {
        $message = "Er befindest sich schon in einem Kampf";
        $arena->Leave($otherPlayer->GetID());
      }
      else if($player->GetTournament() != 0)
      {
        $message = 'Du kannst während des Turnieres nichts kämpfen.';
        $arena->Leave($player->GetID());
      }
      else if($otherPlayer->GetTournament() != 0)
      {
        $message = 'Er kann während des Turnieres nichts kämpfen.';
        $arena->Leave($otherPlayer->GetID());
      }
      else
      {
        $type = 8;
        $name = $player->GetName().' vs '.$otherPlayer->GetName();
        $mode = '1vs1';
				$createdFight = Fight::CreateFight($player, $database, $type, $name, $mode, 0, $actionManager);
				$createdFight->Join($player, 0, false);
				$createdFight->Join($otherPlayer, 1, false);
        $arena->UpdateFight($player->GetID(), $otherPlayer->GetID());
        if($createdFight->IsStarted())
          header('Location: ?p=infight');
				exit();
      }
    }
  }
}
else if(isset($_GET['a']) && $_GET['a'] == 'join')
{
  if($arena->IsFighterIn($player->GetID()))
    $message = 'Du bist schon in der Arena.';
  else
  {
    //$arena->Join($player->GetID());
    $message = 'Arena beitreten ist zurzeit deaktiviert.';
  }
}
else if(isset($_GET['a']) && $_GET['a'] == 'leave')
{
  if(!$arena->IsFighterIn($player->GetID()))
    $message = 'Du bist nicht in der Arena.';
  else
  {
    $arena->Leave($player->GetID());
    $message = 'Du hast die Arena verlassen.';
  }
}
?>