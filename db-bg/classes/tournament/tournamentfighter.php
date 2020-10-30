<?php
if($database == NULL)
{
	print 'This File ('.__FILE__.') should be after Datatabase!';
}

class TournamentFighter
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
	
  public function GetFighterID()
  {
    return $this->data['fighterid'];
  }
  
  public function GetName()
  {
    return $this->data['name'];
  }
  
  public function IsNPC()
  {
    return $this->data['npc'];
  }
  
  public function GetImage()
  {
    return $this->data['image'];
  }
  
  public function GetTournament()
  {
    return $this->data['tournament'];
  }
}