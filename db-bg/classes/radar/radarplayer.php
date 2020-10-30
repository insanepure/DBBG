<?php
if($database == NULL)
{
	print 'This File ('.__FILE__.') should be after Datatabase!';
}

class RadarPlayer
{
	private $data;
  
	function __construct($data, $places)
	{
		$this->data = $data;
    $this->CalculatePosition($places);
	}
  
  public function GetPlacePosition($places, $placeName)
  {
    $position = array();
		for($i = 0; $i < count($places); ++$i)
		{
			$place = $places[$i];
			if($place->GetName() == $placeName)
			{
        $position[0] = $place->GetX();
        $position[1] = $place->GetY();
				break;
			}
		} 
    return $position;
  }
  
  public function CalculatePosition($places)
  {
    if($this->GetPlace() == 'Auf Reise' && $this->data['previousplace'] != '')
    {
      $pX = $this->GetX();
      $pY = $this->GetY();
      $placePosition = $this->GetPlacePosition($places, $this->data['travelplace']);
		  $tempX = $placePosition[0] - $pX;
		  $tempY = $placePosition[1] - $pY;
      $secondsLeft = $this->GetActionCountdown();
      $maxSeconds = $this->data['actiontime'] * 60;
      if($this->data['actiontime'] == 0)
      {
        $secondsPassed = 0;
      }
      else
      {
        $secondsPassed = 1 - ($secondsLeft/$maxSeconds);
      }
      $this->data['x'] = $pX + round($tempX * $secondsPassed);
      $this->data['y'] = $pY + round($tempY * $secondsPassed);
      return;
    }
    else if($this->GetPlace() != 'Auf Reise')
    {
      $placePosition = $this->GetPlacePosition($places, $this->GetPlace());
      $this->data['x'] = $placePosition[0];
      $this->data['y'] = $placePosition[1];
    }
  }
  
  public function GetID()
  {
    return $this->data['id'];
  }
	
	public function GetImage()
	{
		return $this->data['charimage'];
	}
  
  public function GetName()
  {
    return $this->data['name'];
  }
  
  public function GetPlace()
  {
    return $this->data['place'];
  }
  
  public function GetX()
  {
    return $this->data['x'];
  }
  
  public function GetY()
  {
    return $this->data['y'];
  }
	
	public function GetTravelPlace()
	{
		return $this->data['travelplace'];
	}
	
	public function GetActionCountdown()
	{
		$timestamp = strtotime($this->data['actionstart']) + ($this->data['actiontime'] * 60);
		$currentTime = strtotime("now");
		$difference = $timestamp - $currentTime;
		return $difference;
	}
  
}