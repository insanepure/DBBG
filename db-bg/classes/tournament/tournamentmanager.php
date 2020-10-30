<?php
if($database == NULL)
{
	print 'This File ('.__FILE__.') should be after Datatabase!';
}

include_once 'tournament.php';

class TournamentManager
{
	
	private $database;
  private $tournaments;
	
	function __construct($db, $place, $planet)
	{
    $this->database = $db;
    $this->tournaments = array();
    $this->LoadData($place, $planet);
  }
  
  private function LoadData($place, $planet)
  {
		$result = $this->database->Select('*','tournaments','planet="'.$planet.'" AND place="'.$place.'"',99999);
		if ($result) 
		{
			if ($result->num_rows > 0)
			{
        while($row = $result->fetch_assoc()) 
        {
		      $tournament = new Tournament($row, $this->database);
					array_push($this->tournaments, $tournament);
        }
			}
			$result->close();
		}
  }
  
  public function GetTournamentByID($id)
  {
		$i = 0;
		while(isset($this->tournaments[$i]))
		{
			if($this->tournaments[$i]->GetID() == $id)
			{
				return $this->tournaments[$i];
			}
			++$i;
		}
		return null;
	}
  public function GetTournament($id)
  {
    if(isset($this->tournaments[$id]))
    {
      return $this->tournaments[$id];
    }
    return null;
  }
  
}