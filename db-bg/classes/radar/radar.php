<?php
if($database == NULL)
{
	print 'This File ('.__FILE__.') should be after Datatabase!';
}

include_once 'dragonball.php';
include_once 'radarplace.php';
include_once 'radarplayer.php';

class Radar
{
	
	private $database;
	
  private $dragonballs;
  private $places;
  private $players;
	private $playerHasDB;
	
  private $planet;
  private $playerPosition;
  
  private $activeTime;
	
	function __construct($db, $player)
	{
    $this->database = $db;
		
    $this->playerHasDB = false;
    $this->dragonballs = array();
    $this->places = array();
    $this->players = array();
    
    $this->activeTime = 0;
		
    $this->planet = $player->GetPlanet();
    $this->LoadData($player);
		
    $this->playerPosition = $this->GetPlayerPosition($player);
    
  }
	
	public function HasPlayerDB()
	{
		return $this->playerHasDB;
	}
	
	public function EndWish()
	{
		$places = array();
		$result = $this->database->Select('*','places','planet="'.$this->planet.'" AND travelable="1"',99999);
		if ($result) 
		{
			if ($result->num_rows > 0)
			{
        while($row = $result->fetch_assoc()) 
        {
					array_push($places, $row['name']);
        }
			}
		}
		
		$wishes = 1;
    
    $oldDate = new DateTime($this->activeTime);
    $hour = $oldDate->format('H');
    $nextHour = $hour+4;
    
    if($nextHour >= 22) $nextHour = 10;
    
    $date = new DateTime();
    $date->modify('+3 day');
    $date->SetTime($nextHour, 0, 0);
    $timestamp = $date->format('Y-m-d H:i:s');
		
		for($i = 0; $i < count($this->dragonballs); ++$i)
		{
			$db = $this->dragonballs[$i];
			$placeID = rand() % count($places);
			$place = $places[$placeID];
			array_splice($places, $placeID, 1);
			$db->SetPlace($place);
			$db->SetPlayer(0);
			$result = $this->database->Update('wishes="'.$wishes.'",place="'.$place.'", player="0", activetime="'.$timestamp.'"','dragonballs','id="'.$db->GetID().'"',1);
		}
	  $result = $this->database->Update('wishcounter=wishcounter-1','accounts','wishcounter != 0',9999999);
	}
	
	public function Wished()
	{
		$result = $this->database->Update('wishes=wishes-1','dragonballs','planet="'.$this->planet.'"',7);
	}
	
	public function Drop($player, $db)
	{
		$x = 0;
		$y = 0;
		$place = '';
		
		$place = $player->GetPlace();
		$db->SetPlayer(0);
		$db->SetX($x);
		$db->SetY($y);
		$db->SetPlace($place);
		$db->SetRadarPlayer(null);
		$result = $this->database->Update('player="0",place="'.$place.'"','dragonballs','id="'.$db->GetID().'"',1);
	}
	
	public function Pickup($player, $db)
	{
		$found = false;
		$radarPlayer = null;
		for($i = 0; $i < count($this->players); ++$i)
		{
			$tempPlayer = $this->players[$i];
			if($tempPlayer->GetID() == $player->GetID())
			{
				$found = true;
				$radarPlayer = $tempPlayer;
				break;
			}
		}
		
		if(!$found)
		{
			$radarPlayer = new RadarPlayer($player->GetData(), $this->places);	
			array_push($this->players, $radarPlayer);
		}
		
		$x = 0;
		$y = 0;
		$place = '';
		$db->SetPlayer($player->GetID());
		$db->SetX($x);
		$db->SetY($y);
		$db->SetPlace($place);
		$db->SetRadarPlayer($radarPlayer);
		$result = $this->database->Update('player="'.$player->GetID().'",place="'.$place.'"','dragonballs','id="'.$db->GetID().'"',1);
	}
  
  public function GetPlayerPosition($player)
  {
    $position = array();
    if($player->GetPlace() == 'Auf Reise' && $player->GetPreviousPlace() != '')
    {
      $pX = $player->GetX();
      $pY = $player->GetY();
      $placePosition = $this->GetPlacePosition($player->GetTravelPlace());
		  $tempX = $placePosition[0] - $pX;
		  $tempY = $placePosition[1] - $pY;
      $secondsLeft = $player->GetActionCountdown();
      $maxSeconds = $player->GetActionTime() * 60;
      if($player->GetActionTime() == 0)
      {
        $secondsPassed = 0;
      }
      else
      {
        $secondsPassed = 1 - ($secondsLeft/$maxSeconds);
      }
      $position[0] = $pX + round($tempX * $secondsPassed);
      $position[1] = $pY + round($tempY * $secondsPassed);
      return $position;
    }
		else if($player->GetPlace() != 'Auf Reise')
		{
    	return $this->GetPlacePosition($player->GetPlace());
		}
		$position[0] = $player->GetX();
		$position[1] = $player->GetY();
		return $position;
  }
  
  public function GetPlacePosition($placeName)
  {
    $position = array();
		for($i = 0; $i < count($this->places); ++$i)
		{
			$place = $this->places[$i];
			if($place->GetName() == $placeName)
			{
        $position[0] = $place->GetX();
        $position[1] = $place->GetY();
				break;
			}
		} 
    return $position;
  }
  
  public function GetRelativePosition($db)
  {
    $position = array();
    $dist = 0.9;
    $position[0] = ($db->GetX() - $this->playerPosition[0]) / $dist;
    $position[1] = ($db->GetY() - $this->playerPosition[1]) / $dist;
    return $position;
  }
  
  public function GetDB($id)
  {
    if($this->GetDBCount() > $id)
    {
      return $this->dragonballs[$id];
    }
    return null;
  }
  
  public function GetDBCount()
  {
    return count($this->dragonballs);
  }
  
  public function LoadData($player)
  {
		
		$result = $this->database->Select('*','places','planet="'.$this->planet.'"',99999);
		if ($result) 
		{
			if ($result->num_rows > 0)
			{
        while($row = $result->fetch_assoc()) 
        {
		      $radarplace = new RadarPlace($row);
					array_push($this->places, $radarplace);
        }
			}
			$result->close();
		}
		
		$players = array();
		$dbinplayers = array();
		$result = $this->database->Select('*','dragonballs','planet="'.$this->planet.'"',99999);
		if ($result) 
		{
			if ($result->num_rows > 0)
			{
        while($row = $result->fetch_assoc()) 
        {
					if($row['player'] == $player->GetID())
					{
						$this->playerHasDB = true;
					}
		      $dragonball = new Dragonball($row, $this->places);
          
          $this->activeTime = $dragonball->GetActiveTime();
          
					if($dragonball->GetPlayer() != 0 && !in_array($dragonball->GetPlayer(), $players))
					{
						array_push($players, $dragonball->GetPlayer());
					}
					if($dragonball->GetPlayer() != 0)
					{
						array_push($dbinplayers, $dragonball);
					}
					array_push($this->dragonballs, $dragonball);
        }
			}
			$result->close();
		}
		
		$where = '';
		for($i = 0; $i < count($players); ++$i)
		{
			if($where == '')
			{
				$where = 'id="'.$players[$i].'"';
			}
			else
			{
				$where = $where.' OR id="'.$players[$i].'"';
			}
		}
		
		if($where == '')
		{
			return;
		}
		
		$result = $this->database->Select('*','accounts',$where,count($players));
		if ($result) 
		{
			if ($result->num_rows > 0)
			{
        while($row = $result->fetch_assoc()) 
        {
		      $radarplayer = new RadarPlayer($row, $this->places);
					for($i = 0; $i < count($dbinplayers); ++$i)
					{
						$db = $dbinplayers[$i];
						if($db->GetPlayer() == $row['id'])
						{
							$db->SetX($radarplayer->GetX());
							$db->SetY($radarplayer->GetY());
							$db->SetRadarPlayer($radarplayer);
						}
					}
					array_push($this->players, $radarplayer);
        }
			}
			$result->close();
		}
  }
  
}