<?php
if($database == NULL)
{
	print 'This File ('.__FILE__.') should be after Datatabase!';
}

class GameData
{
  private $database;
  private $playerOnline;
  private $playerTotal;
  private $clans;
  private $days;
  
	function __construct($db)
	{
    $this->database = $db;
    $this->LoadOnline();
    $this->LoadTotal();
    $this->LoadClans();
  }
    
  private function LoadOnline()
  {
    $timeOut = 30;
    $where = 'visible = 0 AND TIMESTAMPDIFF(MINUTE, lastaction, NOW()) < '.$timeOut;
    $result = $this->database->Select('COUNT(visible) as total','accounts',$where);
		if ($result) 
		{
      $row = $result->fetch_assoc();
      $this->playerOnline = $row['total'];
			$result->close();
		}
  }
  
  private function LoadTotal()
  {
    $result = $this->database->Select('COUNT(id) as total','accounts','');
		if ($result) 
		{
      $row = $result->fetch_assoc();
      $this->playerTotal = $row['total'];
			$result->close();
		}
  }
  
  private function LoadClans()
  {
    $result = $this->database->Select('COUNT(id) as total','clans','');
		if ($result) 
		{
      $row = $result->fetch_assoc();
      $this->clans = $row['total'];
			$result->close();
		}
  }
  
  public function GetOnline()
  {
    return $this->playerOnline;
  }
  
  public function GetTotal()
  {
    return $this->playerTotal;
  }
  
  public function GetClans()
  {
    return $this->clans;
  }
}
$gameData = new GameData($database);