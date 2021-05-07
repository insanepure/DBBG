<?php
  include_once 'classes/story/story.php';
$planet = new Planet($database, $player->GetPlanet());
if(isset($_GET['a']) && $_GET['a'] == 'travel')
{
	if(isset($_POST['destination']) && isset($_POST['planet']))
	{
		$name = $_POST['destination'];
		$destPlanet = $_POST['planet'];
		$place = new Place($database, $name, $destPlanet, null);
		if($place->IsValid() && $place->GetPlanet() == $player->GetPlanet())
		{
			if(($place->IsTravelable() || !$place->IsTravelable() && $player->GetARank() >= 2) && $place->GetName() != $player->GetPlace())
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
					$playerPlace = new Place($database, $player->GetPlace(), $player->GetPlanet(), null);
					
					$travelTime = 0;

					if($player->GetX() != 0 && $player->GetY() != 0)
					{
						$x = $player->GetX();
						$y = $player->GetY();
					}
					else
					{
						$x = $playerPlace->GetX();
						$y = $playerPlace->GetY();
					}

					$travelTime = round(abs($place->GetX() - $x) + abs($place->GetY() - $y) / 1.5);
					$travelBonus = $player->GetTravelBonus();
					$travelBonus = floor($travelTime * ($travelBonus / 100));
					$travelTime = $travelTime - $travelBonus;
					$travelActionID = 12;
					if($travelTime < 5)
					{
						$travelTime = 5;
					}
					$action = $actionManager->GetAction($travelActionID);
					$player->Travel($place->GetName(), $travelTime, $action, $x, $y);
					$message = 'Du reist nun zum Ort "'.$place->GetName().'".';
				}
				
			}
		}
	}
}
?>