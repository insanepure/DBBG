<?php
if($database == NULL)
{
	print 'This File ('.__FILE__.') should be after Datatabase!';
}

include_once 'item.php';

class ItemManager
{
	
	private $database;
  private $items;
	
	function __construct($db)
	{
    $this->database = $db;
    $this->items = array();
    $this->LoadItems();
  }
  
  private function LoadItems()
  {
		$result = $this->database->Select('*','items','',99999);
		if ($result) 
		{
			if ($result->num_rows > 0)
			{
        while($row = $result->fetch_assoc()) 
        {
					$item = new Item($row);
					array_push($this->items, $item);
        }
			}
			$result->close();
      
		}
  }
  
  public function GetItem($id)
  {
    $i = 0;
    while(isset($this->items[$i]))
    {
      if($this->items[$i]->GetID() == $id)
      {
        return $this->items[$i];
      }
     ++$i; 
    }
    return null;
  }
  
}