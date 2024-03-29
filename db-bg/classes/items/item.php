<?php
class Item
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
  
  private function GetTypeName()
  {
    switch($this->GetDefaultStatsType())
    {
      case 0: //Alle
        return 'der Balance';
        break;
      case 1: //Angriff
        return 'des Angriffes';
        break;
      case 2: //Abwehr
        return 'der Verteidigung';
        break;
      case 3: //LP
        return 'des Lebens';
        break;
      case 4: //KP
        return 'der Kraft';
        break;
      case 5: //Angriff+Abwehr
        return 'der Kontrolle';
        break;
      case 6: //Angriff+LP
        return 'der Stärke';
        break;
      case 7: //Angriff+KP
        return 'der Zerstörung';
        break;
      case 8: //Abwehr+LP
        return 'der Ehre';
        break;
      case 9: //Abwehr+KP
        return 'des Schutzes';
        break;
      case 10: //LP+KP
        return 'der Energie';
        break;
      case 11: //Angriff+Abwehr+LP
        return 'des Ausgleiches';
        break;
      case 12: //Angriff+Abwehr+KP
        return 'der Macht';
        break;
      case 13: //Angriff+LP+KP
        return 'der Offensive';
        break;
      case 14: //Abwehr+LP+KP
        return 'der Defensive';
        break;
    }
  }
  
  public function GetRealName()
  {
    return $this->data['name'];
  }
  
  public function GetName()
  {
    $returnValue = $this->data['name'];
    $type = $this->GetType();
    
    if($type == 3 && $this->data['value'] != 0 || $this->GetID() == 184)
      $returnValue = $returnValue.' '.$this->GetTypeName();
    
    return $returnValue;
  }
  
  public function GetImage()
  {
    return $this->data['image'];
  }

    public function IsHelmet()
    {
        return $this->data['IsHelmet'];
    }
  
  public function IsSellable()
  {
    return $this->data['sellable'];
  }
  
  public function IsMarketSellable()
  {
    return $this->data['marketsellable'];
  }
  
  public function GetNeedItem()
  {
    return $this->data['needitem'];
  }
  
  public function GetRace()
  {
    return $this->data['race'];
  }
  
  public function GetFightAttack()
  {
    return $this->data['fightattack'];
  }
  
  public function GetEquippedImage()
  {
    return $this->data['equippedimage'];
  }
  
  public function GetEquippedBGImage()
  {
    return $this->data['equippedbgimage'];
  }
  
  public function GetSlot()
  {
    return $this->data['slot'];
  }
  
  public function GetTravelBonus()
  {
    return $this->data['travelbonus'];
  }
  
  public function GetDescription()
  {
    return $this->data['description'];
  }
  
  public function GetCategory()
  {
    return $this->data['category'];
  }
  
  public function GetPrice()
  {
    return $this->data['price'];
  }
  
  public function GetDragonCoins()
  {
    return $this->data['dragoncoins'];
  }
  
  public function GetArenaPoints()
  {
    return $this->data['arenapoints'];
  }
  
  public function GetType()
  {
    return $this->data['type'];
  }
  
  public function GetValue()
  {
    return $this->data['value'];
  }
  
  public function GetExpirationDays()
  {
    return $this->data['expirationdays'];
  }
  private function GetStatsValue($validTypes, $multiplier)
  {
    $value = $this->GetValue();
    $statsType = $this->GetDefaultStatsType();
    
    if(!in_array($statsType, $validTypes) || $value == 0)
      return 0;
    
    $divider = 1;
    switch($statsType)
    {
      case 0:
        $divider = 4;
        break;
      case 1:
      case 2:
      case 3:
      case 4:
        $divider = 1;
        break;
      case 5:
      case 6:
      case 7:
      case 8:
      case 9:
      case 10:
        $divider = 2;
        break;
      case 11:
      case 12:
      case 13:
      case 14:
        $divider = 3;
        break;
    }
    
    $value = $value * $multiplier;
    $value = floor($value/$divider);
    
    return $value;
  }
  
  public function GetLP()
  {
    if($this->GetType() == 3)
      $value = $this->GetStatsValue(array(0,3,6,8,10,11,13,14), 10);
    else
      $value = $this->data['lp'];
    
    return $value;
  }
  
  public function GetKP()
  {
    if($this->GetType() == 3)
    $value = $this->GetStatsValue(array(0,4,7,9,10,12,13,14), 10);
    else
      $value = $this->data['kp'];
    return $value;
  }
  
  public function GetAttack()
  {
    if($this->GetType() == 3)
    $value = $this->GetStatsValue(array(0,1,5,6,7,11,12,13), 1);
    else
      $value = $this->data['atk'];
    return $value;
  }
	
  public function GetDefense()
  {
    if($this->GetType() == 3)
    $value = $this->GetStatsValue(array(0,2,5,8,9,11,12,14), 1);
    else
      $value = $this->data['def'];
    return $value;
  }
	
	public function GetTrainbonus()
  {
    return $this->data['trainbonus'];
  }
	
	public function GetLevel()
  {
    return $this->data['lv'];
  }
	
	public function GetUpgradeID()
  {
    return $this->data['upgradeid'];
  }
	
	public function GetDefaultStatsType()
  {
    return $this->data['defaultstatstype'];
  }
	
	public function SetDefaultStatsType($value)
  {
    $this->data['defaultstatstype'] = $value;
  }
  
  public function DisplayEffect()
  {
    switch($this->GetType())
    {
      case 1:
        {
          if($this->GetLP() != 0) echo 'Heilt <b>'.$this->GetLP().'</b> <b>LP</b><br/>';
          if($this->GetKP() != 0) echo 'Heilt <b>'.$this->GetKP().'</b> <b>KP</b><br/>';
        }
        break;
      case 2:
        {
          if($this->GetLP() != 0) echo 'Heilt <b>'.$this->GetLP().'%</b> <b>LP</b><br/>';
          if($this->GetKP() != 0) echo 'Heilt <b>'.$this->GetKP().'%</b> <b>KP</b><br/>';
        }
        break;
      case 3:
        {
          if($this->GetLP() != 0) echo 'Erhöht <b>LP</b> um '.$this->GetLP().'</b><br/>';
          if($this->GetKP() != 0) echo 'Erhöht <b>KP</b> um '.$this->GetKP().'</b><br/>';
          if($this->GetAttack() != 0) echo 'Erhöht <b>Angriff</b> um '.$this->GetAttack().'</b><br/>';
          if($this->GetDefense() != 0) echo 'Erhöht <b>Verteidigung</b> um '.$this->GetDefense().'</b><br/>';
        }
        break;
      case 4:
        {
          if($this->GetTravelBonus() != 0) echo 'Verringert <b>Reisedauer um <b>'.$this->GetTravelBonus().'%</b>';
        }
        break;
    }
  }
  
  public function HasOverlay()
  {
    return $this->data['overlay'] != 0;
  }
  
  public function GetOverlay()
  {
    switch($this->data['overlay'])
    {
      case 1:
        return 'OverlayEvent';
        break;
    }
    return '';
  }
  
}
?>