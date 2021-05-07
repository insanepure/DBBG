<?php
class Action
{
	private $data;
	
	function __construct($initialData)
	{
		$this->data = $initialData;
	}
  
  public function GetID()
  {
    return $this->data['id'];
  }
  
  public function GetName()
  {
    return $this->data['name'];
  }
  
  public function GetType()
  {
    return $this->data['type'];
  }
  
  public function GetDescription()
  {
    return $this->data['description'];
  }
  
  public function GetMaxTimes()
  {
    return $this->data['maxtimes'];
  }
  
  public function GetImage()
  {
    return $this->data['image'];
  }
  
  public function GetPrice()
  {
    return $this->data['price'];
  }
  
  public function GetRace()
  {
    return $this->data['race'];
  }
  
  public function GetItem()
  {
    return $this->data['item'];
  }
  
  public function GetEarnItem()
  {
    return $this->data['earnitem'];
  }
  
  public function GetMinutes()
  {
    return $this->data['minutes'];
  }
  
  public function GetLP()
  {
    return $this->data['lp'];
  }
  
  public function GetKP()
  {
    return $this->data['kp'];
  }
  
  public function GetAttack()
  {
    return $this->data['attack'];
  }
  
  public function GetDefense()
  {
    return $this->data['defense'];
  }
  
  public function GetLevel()
  {
    return $this->data['level'];
  }
  
  public function GetStats()
  {
    return $this->data['stats'];
  }
  
  public function GetSkillPoints()
  {
    return $this->data['skillpoints'];
  }
  
  public function GetPlace()
  {
    return $this->data['place'];
  }
  
  public function GetPlanet()
  {
    return $this->data['planet'];
  }
  
  public function IsStory()
  {
    return $this->data['isstory'];
  }
}
?>