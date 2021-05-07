<?php
if($database == NULL)
{
	print 'This File ('.__FILE__.') should be after Datatabase!';
}

class TowerFloor
{
  private $data;
	
	function __construct($initialData)
	{
		$this->data = $initialData;
	}
  
  function GetID()
  {
    return $this->data['id'];
  }
  
  function GetZeni()
  {
    return $this->data['zeni'];
  }
  
  function GetNPCs()
  {
    return explode(';', $this->data['npcs']);
  }
  
}

class Tower
{
	private $database;
  
	function __construct($db)
  {
    $this->database = $db;
  }
  
  public function GetFloorCount()
  {
    $floors = 0;
    $result = $this->database->Select('COUNT(id) as total','towerfloors','');
    if ($result) 
    {
      $row = $result->fetch_assoc();
      $floors = $row['total'];
      $result->close();
    }
    return $floors;
  }
  
  public function GetFloor($id)
  {
    $towerfloor = null;
    $result = $this->database->Select('*', 'towerfloors', 'id='.$id.'', 1);
		if ($result) 
		{
			if ($result->num_rows > 0)
			{
				$row = $result->fetch_assoc();
        $towerfloor = new TowerFloor($row);
			}
			$result->close();
		}
    return $towerfloor;
  }
  
}
  
  ?>