<?php
if($player->GetPlanet() == 'Jenseits')
{
	header('Location: ?p=index');
  exit();
}
$playerPlanet = new Planet($database, $player->GetPlanet());

$isAtTimeTravelPlanet = $player->IsTimeTravelled() == 0 && $player->GetPlanet() == 'Erde' || $player->IsTimeTravelled() == 1;
$isAtStartingPlace = $player->GetPlace() == $playerPlanet->GetStartingPlace();


if(isset($_GET['a']) && $_GET['a'] == 'travel')
{
	if(isset($_POST['destination']) )
	{
    if($player->HasDBs())
    {
      $message = 'Du kannst mit Dragonballs nicht dorthin reisen.';
    }
    else
    {
		  $planet = new Planet($database, $_POST['destination']);
      if($planet == null)
      {
        $message = 'Dieser Planet existiert nicht.';
      }
      else if(!$planet->IsTimeTravellable($player->GetStory()))
      {
        $message = 'Du kannst zu diesen Planet nicht reisen.';
      }
      else
      {
				if($player->GetFight() != 0)
				{
					$message = 'Du kannst im Kampf nicht reisen.';
				}
				else if($player->GetTournament() != 0)
				{
					$message = 'Du kannst im Turnier nicht reisen.';
				}
				else if($player->GetAction() != 0)
				{
					$message = 'Du tust bereits etwas.';
				}
        else
        {	
          $player->TimeTravel($planet->GetName(), $planet->GetStartingPlace());
          $message = 'Du bist durch die Zeit zum Planet '.$planet->GetName().' gereist.';
        }
      }
    }
  }
}