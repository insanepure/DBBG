<?php
class EventFight
{
  private $npcs;
  private $healing;
  private $survivalteam;
  private $survivalrounds;
  private $survivalwinner;
  private $healthratio;
  private $healthratioteam;
  private $healthratiowinner;
  
	function __construct($data)
  {
    $data = explode(';', $data);
    $this->npcs = explode(':', $data[0]);
    $this->healing = $data[1];
    $this->survivalteam = $data[2];
    $this->survivalrounds = $data[3];
    $this->survivalwinner = $data[4];
    $this->healthratio = $data[5];
    $this->healthratioteam = $data[6];
    $this->healthratiowinner = $data[7];
  }
  
  public function GetNPCs()
  {
    return $this->npcs;
  }
  
  public function IsHealing()
  {
    return $this->healing;
  }
  
  public function GetSurvivalTeam()
  {
    return $this->survivalteam;
  }
  
  public function GetSurvivalRounds()
  {
    return $this->survivalrounds;
  }
  
  public function GetSurvivalWinner()
  {
    return $this->survivalwinner;
  }
  
  public function GetHealthRatio()
  {
    return $this->healthratio;
  }
  
  public function GetHealthRatioTeam()
  {
    return $this->healthratioteam;
  }
  
  public function GetHealthRatioWinner()
  {
    return $this->healthratiowinner;
  }
  
}