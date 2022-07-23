<?php
if($database == NULL)
{
	print 'This File ('.__FILE__.') should be after Datatabase!';
}

class Attack
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

  public function IsCostProcentual()
  {
    return $this->data['procentualcost'];
  }
  
  public function GetName()
  {
    return $this->data['name'];
  }
  
  public function GetDescription()
  {
    return $this->data['description'];
  }
  
  public function GetLevel()
  {
    return $this->data['level'];
  }
  
  public function IsPickableByNPC()
  {
    return $this->data['npcpickable'];
  }
  
  public function GetImage()
  {
    return 'img/attacks/'.$this->data['image'].'.png';
  }
  
	public static function GetTypeCount()
	{
    return 24;
  }
  
	public static function GetTypeName($type)
	{
		switch($type)
		{
			case 1:
      echo 'Schaden';
			break;
     	case 2:
     	echo 'Verteidigung';
     	break;
     	case 3:
     	echo 'Tod';
     	break;
     	case 4:
     	echo 'Verwandlung';
     	break;
     	case 5:
     	echo 'Heilung';
     	break;
     	case 6:
     	echo 'Lad-Angriff';
     	break;
     	case 7:
     	echo 'Ladung';
     	break;
     	case 8:
     	echo 'Beschwörung';
     	break;
     	case 9:
     	echo 'Betäubung';
     	break;
     	case 10:
     	echo 'Betäubt';
     	break;
     	case 11:
     	echo 'Regenerierung';
     	break;
     	case 12:
     	echo 'Absorbierung';
     	break;
     	case 13:
     	echo 'Fusion';
     	break;
     	case 14:
     	echo 'Wetter';
     	break;
     	case 15:
     	echo 'Sonstiges';
     	break;
		  case 16:
     	echo 'Aufgeben';
     	break;
		  case 17:
     	echo 'Beleben';
     	break;
		  case 18:
     	echo 'Buffs';
     	break;
		  case 19:
     	echo 'Befreiung';
     	break;
		  case 20:
     	echo 'Reflektion';
     	break;
		  case 21:
     	echo 'Selbst-Buffs';
     	break;
		  case 22:
     	echo 'DOTS';
     	break;
		  case 23:
     	echo '% Schaden';
     	break;
		  case 24:
     	echo '% Tech Schaden';
     	break;
		}
	}
	
	public function GetType()
	{
		return $this->data['type'];
	}
	
	public function GetItem()
	{
		return $this->data['item'];
	}
	
	public function GetLoadRounds()
	{
		return $this->data['loadrounds'];
	}
	
	public function GetBlockAttack()
	{
		return $this->data['blockattack'];
	}
	
	public function GetBlockedAttack()
	{
		return $this->data['blockedattack'];
	}
	
	public function BlockTargetOnly()
	{
		return $this->data['blocktargetonly'] == 1;
	}
	
	public function GetValue()
	{
		return $this->data['value'];
	}
	
	public function GetLPValue()
	{
		return $this->data['lpvalue'];
	}
	
	public function GetKPValue()
	{
		return $this->data['kpvalue'];
	}
	
	public function GetEPValue()
	{
		return $this->data['epvalue'];
	}
	
	public function GetAtkValue()
	{
		return $this->data['atkvalue'];
	}
	
	public function GetDefValue()
	{
		return $this->data['defvalue'];
	}
	
	public function GetTauntValue()
	{
		return $this->data['tauntvalue'];
	}
	
	public function GetReflectValue()
	{
		return $this->data['reflectvalue'];
	}
	
	public function GetMinValue()
	{
		return $this->data['minvalue'];
	}
	
	public function GetKP()
	{
		return $this->data['kp'];
	}
	
	public function GetLP()
	{
		return $this->data['lp'];
	}
	
	public function GetEnergy()
	{
		return $this->data['energy'];
	}
	
	public function IsProcentual()
	{
		return $this->data['procentual'];
	}
	
	public function GetCostProcentual()
	{
    return $this->data['procentualcost'];
	}
	
	public function GetAccuracy()
	{
		return $this->data['accuracy'];
	}
	
	public function GetText()
	{
		return $this->data['text'];
	}
	
	public function GetLoadText()
	{
		return $this->data['loadtext'];
	}
	
	public function GetTransformationID()
	{
		return $this->data['transformationid'];
	}
	
	public function GetMissText()
	{
		return $this->data['missText'];
	}
	
	public function GetDeadText()
	{
		return $this->data['deadText'];
	}
	
	public function GetLearnKI()
	{
		return $this->data['learnki'];
	}
	
	public function GetLearnLP()
	{
		return $this->data['learnlp'];
	}
	
	public function GetLearnKP()
	{
		return $this->data['learnkp'];
	}
	
	public function GetLearnAttack()
	{
		return $this->data['learnattack'];
	}
	
	public function GetLearnDefense()
	{
		return $this->data['learndefense'];
	}
	
	public function GetRace()
	{
		return $this->data['race'];
	}
	
	public function GetNPCID()
	{
		return $this->data['npcid'];
	}
	
	public function GetMaxNPCAmount()
	{
		return $this->data['maxnpcamount'];
	}
	
	public function GetLoadAttack()
	{
		return $this->data['loadattack'];
	}
	
	public function GetRounds()
	{
		return $this->data['rounds'];
	}
	
	public function GetLearnTime()
	{
		return $this->data['learntime'];
	}
	
	public function GetDisplayDied()
	{
		return $this->data['displaydied'];
	}
}