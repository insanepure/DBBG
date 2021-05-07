<?php
if($database == NULL)
{
	print 'This File ('.__FILE__.') should be after Datatabase!';
}

class EventItem
{
	private $data;
  
	function __construct($data)
  {
    $this->data = $data;   
  }
  
  function GetID()
  {
    return $this->data['id'];
  }
  
  function GetImage()
  {
    return 'img/gameevents/'.$this->data['image'];
  }
  
  function GetX()
  {
    return $this->data['x'];
  }
  
  function GetY()
  {
    return $this->data['y'];
  }
  
  function GetZeni()
  {
    return $this->data['zeni'];
  }
  
  function GetItem()
  {
    return $this->data['item'];
  }
  
  function GetItemAmount()
  {
    return $this->data['itemamount'];
  }
  
}

class EventItems
{
	private $database;
  
	function __construct($db)
  {
    $this->database = $db;   
  }
  
  function LoadItem($url)
  {
    $url = $this->database->EscapeString($url);
    $result = $this->database->Select('*', 'eventitems', 'url="'.$url.'" AND NOW() BETWEEN starttime AND endttime', 1);
    $eventItem = null;
		if ($result) 
		{
			if ($result->num_rows > 0)
			{
				$row = $result->fetch_assoc();
        $eventItem = new EventItem($row);
			}
			$result->close();
		}
    
    return $eventItem;
  }
  
  function HasItem($acc, $eventItemID)
  {
    $url = $this->database->EscapeString($url);
    $result = $this->database->Select('*', 'eventitemsunlocked', 'acc='.$acc.' AND eventitem='.$eventItemID, 1);
    $hasItem = false;
		if ($result) 
		{
      $hasItem = $result->num_rows > 0;
			$result->close();
		}
    return $hasItem;
  }
  
  function AddItem($acc, $eventItemID)
  {
		$result = $this->database->Insert('acc, eventitem', '"'.$acc.'","'.$eventItemID.'"', 'eventitemsunlocked');
  }
}