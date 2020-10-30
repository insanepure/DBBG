<?php
if($database == NULL)
{
	print 'This File ('.__FILE__.') should be after Datatabase!';
}

class Place
{
	private $database;
  private $data;
  private $valid;
  private $actionManager;
  
	function __construct($db, $name, $planet, $actionManager)
  {
    $this->database = $db;
    $this->valid = false;
    $this->actionManager = $actionManager;
    $this->LoadData($name, $planet);
  }
  
  public function IsValid()
  {
    return $this->valid;
  }
  
  public function GetID()
  {
    return $this->data['id'];
  }
  
  public function GetPlanet()
  {
    return $this->data['planet'];
  }
  
  public function GetLearnableAttacks()
  {
    return $this->data['learnableattacks'];
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
  
  public function GetImage()
  {
    return $this->data['image'];
  }
  
  public function GetItems()
  {
    return explode(';',$this->data['items']);
  }
  
  public function GetNPCs()
  {
    return explode(';',$this->data['npcs']);
  }
  
  public function GetTrainers()
  {
    return explode(';',$this->data['trainers']);
  }
  
  public function GetActions()
  {
    $i = 0;
    $actionData = explode(';',$this->data['actions']);
    $actions = array();
    while(isset($actionData[$i]))
    {
      $action = $this->actionManager->GetAction($actionData[$i]);
      array_push($actions, $action);
      ++$i;
    }
    return $actions;
  }
  
  public function HasAction($id)
  {
    $i = 0;
    $actionData = explode(';',$this->data['actions']);
    
    while(isset($actionData[$i]))
    {
      if($actionData[$i] == $id)
      {
        return true;
      }
      ++$i;
    }
    return false;
  }
  
  
  private function LoadData($name, $planet)
  {
		$name = $this->database->EscapeString($name);
		$planet = $this->database->EscapeString($planet);
    $result = $this->database->Select('*', 'places', 'name="'.$name.'" AND planet="'.$planet.'"', 1);
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