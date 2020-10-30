<?php
include_once 'classes/tournament/tournamentmanager.php';
if(!isset($tournamentManager))
{
  $tournamentManager = new TournamentManager($database, $player->GetPlace(), $player->GetPlanet());
}

if(isset($_GET['a']) && $_GET['a'] == 'join' && isset($_GET['id']) && is_numeric($_GET['id']))
{
  $tournament = $tournamentManager->GetTournamentByID($_GET['id']);
  if($tournament->IsStarted())
  {
    $message = 'Das Turnier hat schon begonnen.';
  }
  else if($tournament->GetParticipantSize() >= $tournament->GetMaxPlayers())
  {
	  $message = 'Das Turnier hat schon die maximale Anzahl an Spieler.';
  }
  else if($player->GetPendingTournament() != 0)
  {
    $message = 'Du nimmst schon an einem Turnier teil.';
  }
  else
  {
    $player->JoinTournament($tournament->GetID());
    $message = 'Du nimmst nun am Turnier teil.';
  }
}
else if(isset($_GET['a']) && $_GET['a'] == 'fight' && $player->GetTournament() != 0)
{
  if($pTournament == null || !$pTournament->IsStarted())
  {
    $message = 'Das Turnier hat noch nicht begonnen.';
  }
  else if($pTournament->IsEnd())
  {
    $message = 'Das Turnier ist schon vorbei.';
  }
  else if($player->GetFight() != 0)
  {
    $message = 'Du befindest dich schon im Kampf.';
  }
  else
  {
    $pTournament->UpdateFights();
    
    $pFighter = null;
    $pAlive = false;
    $pRound = 0;
    $pCell = 0;
    if(!$pTournament->GetPlayerInfo($player, $pFighter, $pAlive, $pRound, $pCell))
    {
      $message = 'Du befindest dich nicht im Turnier.';
    }
    if($pAlive && $pRound == $pTournament->GetRound())
    {
      $otherCell = $pCell;
      if($pCell % 2 == 0)
      {
        $otherCell = $otherCell + 1;
      }
      else
      {
        $otherCell = $otherCell - 1;
      }
      $fighter = $pTournament->GetBracket($otherCell, $pRound)[0];
      $other = null;
      if($fighter->IsNPC())
      {
        $other = new NPC($database, $fighter->GetFighterID(), 1);
      }
      else
      {
        $other = new Player($database, $fighter->GetFighterID(), $actionManager);
      }
      
      $type = 6;
      $mode = '1vs1';
      $name = $pTournament->GetName();
		  
      $levelup = 0;
      $zeni = 0;
      $items = '';
      $story = 0;
      $challenge = 0;
      $survivalteam = 0;
      $survivalrounds = 0;
      $survivalwinner = 0;
      $event = 0;
      $healing = 0;
      $eventfight = 0;
      
      $createdFight = Fight::CreateFight($player, $database, $type, $name, $mode, $levelup, $actionManager, $zeni, $items, $story, $challenge, 
                                         $survivalteam, $survivalrounds, $survivalwinner, $event, $healing, $eventfight, $pTournament->GetID());
      
      $createdFight->Join($other, 1, $fighter->IsNPC());
      if($createdFight->IsStarted())
        header('Location: ?p=infight');
			exit();
    }
  }
}
else if(isset($_GET['a']) && $_GET['a'] == 'leave' && $player->GetPendingTournament() != 0)
{
  $tournament = $tournamentManager->GetTournamentByID($player->GetPendingTournament());
  if($tournament == null)
  {
    $message = 'Das Turnier gibt es nicht.';
  }
  else if($tournament->IsStarted())
  {
    $message = 'Das Turnier hat schon begonnen.';
  }
  else
  {
    $player->LeaveTournament();
    $message = 'Du nimmst nun nicht mehr am Turnier teil.';
  }
}
?>