<?php
if(isset($_GET['a']) && $_GET['a'] == 'travel' || isset($_GET['a']) && $_GET['a'] == 'teleport')
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
      if($player->IsTimeTravelled())
      {
        $message = 'Du musst zunächst in die Gegenwart reisen.';
      }
      else if($planet == null || !$planet->CanSee($player->GetStory()))
      {
        $message = 'Dieser Planet existiert nicht.';
      }
      else if(!$planet->IsTravelable())
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
          $travelTime = 0;
          
          $x = $playerPlanet->GetX();
          $y = $playerPlanet->GetY();
          
          $travelTime = abs($planet->GetX() - $x) + abs($planet->GetY() - $y);
          $travelTime = round($travelTime * 4);
          if($travelTime < 10)
          {
            $travelTime = 10;
          }					
          if($_GET['a'] == 'travel')
          {
            $travelActionID = 67;
            $action = $actionManager->GetAction($travelActionID);
            $player->TravelPlanet($planet->GetName(), $travelTime, $action);
            $message = 'Du reist nun nach '.$planet->GetName().'.';
          }		
          else if($_GET['a'] == 'teleport')
          {
            $cost = $travelTime;
            if(!$player->CanTeleport())
            {
              $message = 'Du kannst die Momentane Teleportation nicht.';
            }
            else if($player->GetKP() < $cost)
            {
              $message = 'Du benötigst '.$cost.' KP zum Teleportieren.';
            }
            else
            {
              $playerPlanet = new Planet($database, $player->GetPlanet());
              $player->Teleport($planet->GetName(), $planet->GetStartingPlace(), $cost);
              $message = 'Du hast dich zu den Planeten '.$planet->GetName().' teleportiert.';
            }
          }
        }
      }
    }
  }
}