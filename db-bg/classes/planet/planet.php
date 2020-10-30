<?php
if($database == NULL)
{
	print 'This File ('.__FILE__.') should be after Datatabase!';
}

class Planet
{
	private $database;
  private $data;
  private $valid;
  
	function __construct($db, $name)
  {
    $this->database = $db;
    $this->valid = false;
    $this->LoadData($name);
  }
  
  public function IsValid()
  {
    return $this->valid;
  }
  
  public function GetID()
  {
    return $this->data['id'];
  }
  
  public function GetName()
  {
    return $this->data['name'];
  }
  
  public function IsTravelable()
  {
    return $this->data['travelable'];
  }
  
  public function GetX()
  {
    return $this->data['x'];
  }
  
  public function GetY()
  {
    return $this->data['y'];
  }
  
  public function GetDescription()
  {
    return $this->data['description'];
  }
  
  public function GetStartingPlace()
  {
    return $this->data['startingplace'];
  }
  
  public function GetImage()
  {
    return $this->data['image'];
  }
  
  public function GetMinStory()
  {
    return $this->data['minstory'];
  }
  
  public function GetMaxStory()
  {
    return $this->data['maxstory'];
  }
  
  public function CanSee($playerStory)
  {
    return ($this->data['minstory'] == 0 || $playerStory >= $this->data['minstory']) && ($this->data['maxstory'] == 0 ||$playerStory <= $this->data['maxstory']);
  }
  
  private function LoadData($name)
  {
		$name = $this->database->EscapeString($name);
    $result = $this->database->Select('*', 'planet', 'name="'.$name.'"', 1);
		if ($result) 
		{
			if ($result->num_rows > 0)
			{
				$row = $result->fetch_assoc();
				$this->data = $row;
				$this->valid = true;
			}
			$result->close();
		}
  }
}