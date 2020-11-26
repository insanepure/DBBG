<?php
if($database == NULL)
{
	print 'This File ('.__FILE__.') should be after Datatabase!';
}

class Dragonball
{
	private $data;
	private $radarplayer;
  
  
	function __construct($data, $places)
	{
		$this->data = $data;
		$this->radarplayer = null;
		$this->data['x'] = 0;
		$this->data['y'] = 0;
		$this->CalculatePosition($places);
	}
  
	public function CalculatePosition($places)
	{
		if($this->GetPlayer() != 0)
		{
			return;
		}
		
		for($i = 0; $i < count($places); ++$i)
		{
			$place = $places[$i];
			if($place->GetName() == $this->GetPlace())
			{
				$this->SetX($place->GetX());
				$this->SetY($place->GetY());
			}
		}
	}
	
	public function GetRadarPlayer()
	{
		return $this->radarplayer;
	}
	
	public function SetRadarPlayer($value)
	{
		$this->radarplayer = $value;
	}
	
  public function GetID()
  {
    return $this->data['id'];
  }
  
  public function GetWishNum()
  {
    return $this->data['wishnum'];
  }
  
  public function GetWishes()
  {
    return explode(';', $this->data['wishes']);
  }
	
  public function GetActiveTime()
  {
    return $this->data['activetime'];
  }
	
  public function IsActive()
  {
    return (strtotime($this->data['activetime']) - time()) <= 0;
  }
	
  public function GetPlanet()
  {
    return $this->data['planet'];
  }
  
  public function GetPlace()
  {
    return $this->data['place'];
  }
  
  public function SetPlace($value)
  {
    $this->data['place'] = $value;
  }
  
  public function GetX()
  {
    return $this->data['x'];
  }
  
  public function GetY()
  {
    return $this->data['y'];
  }
  
  public function SetX($value)
  {
    $this->data['x'] = $value;
  }
  
  public function SetY($value)
  {
    $this->data['y'] = $value;
  }
  
  public function GetStars()
  {
    return $this->data['stars'];
  }
  
  public function GetWishLeft()
  {
    return $this->data['wishleft'];
  }
  
  public function GetPlayer()
  {
    return $this->data['player'];
  }
  
  public function SetPlayer($value)
  {
    $this->data['player'] = $value;
  }
  
}