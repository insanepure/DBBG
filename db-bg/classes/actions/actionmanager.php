<?php
if($database == NULL)
{
	print 'This File ('.__FILE__.') should be after Datatabase!';
}


include_once 'action.php';

class ActionManager
{
  private $database;
  private $actions;
	
	function __construct($db)
	{
    $this->database = $db;
    $this->actions = array();
    $this->LoadActions();
	}
  
  private function LoadActions()
  {
		$result = $this->database->Select('*','actions','',9999999999);
		if ($result) 
		{
			if ($result->num_rows > 0)
			{
        while($row = $result->fetch_assoc()) 
        {
					$action = new Action($row);
					array_push($this->actions, $action);
        }
			}
			$result->close();
      
		}
  }
  
  public function GetAction($id)
  {
    $i = 0;
    while(isset($this->actions[$i]))
    {
      if($this->actions[$i]->GetID() == $id)
      {
        return $this->actions[$i];
      }
     ++$i; 
    }
    return null;
  }
}
  $actionManager = new ActionManager($database);
?>