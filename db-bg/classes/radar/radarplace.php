<?php
if($database == NULL)
{
	print 'This File ('.__FILE__.') should be after Datatabase!';
}

class RadarPlace
{
	private $data;
  
	function __construct($data)
	{
		$this->data = $data;
	}
  
  public function GetID()
  {
    return $this->data['id'];
  }
  
  public function GetPlanet()
  {
    return $this->data['planet'];
  }
  
  public function GetName()
  {
    return $this->data['name'];
  }
  
  public function GetX()
  {
    return $this->data['x'];
  }
  
  public function GetY()
  {
    return $this->data['y'];
  }
  
}