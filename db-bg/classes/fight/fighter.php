<?php
if($database == NULL)
{
	print 'This File ('.__FILE__.') should be after Datatabase!';
}

class Fighters
{
  
  private $data;
  
	function __construct($data)
	{
    $this->data = $data;
  }
  
  public function GetPatternValue($name)
  {
    return $this->data[$name];
  }
  
  public function GetID()
  {
    return $this->data['id'];
  }
  public function GetAcc()
  {
    return $this->data['acc'];
  }
  
  public function GetNPC()
  {
    return $this->data['npc'];
  }
  
  public function GetAttackCode()
  {
    return $this->data['attackcode'];
  }
  
  public function SetAttackCode($value)
  {
    $this->data['attackcode'] = $value;
  }
  
  public function GetPatterns()
  {
    return $this->data['patterns'];
  }
  
  public function GetRandomPatterns()
  {
    return $this->data['randompatterns'];
  }
  
  public function GetName()
  {
    return $this->data['name'];
  }
  
  public function GetBuffs()
  {
    return $this->data['buffs'];
  }
  
  public function SetBuffs($value)
  {
    $this->data['buffs'] = $value;
  }
  
  public function GetPatternID()
  {
    return $this->data['patternid'];
  }
  
  public function SetPatternID($value)
  {
    $this->data['patternid'] = $value;
  }
  
  public function GetPatternIDSuccess()
  {
    return $this->data['patternidsuccess'];
  }
  
  public function SetPatternIDSuccess($value)
  {
    $this->data['patternidsuccess'] = $value;
  }
  
  public function GetPatternIDFailed()
  {
    return $this->data['patternidfailed'];
  }
  
  public function SetPatternIDFailed($value)
  {
    $this->data['patternidfailed'] = $value;
  }
  
  public function GetPatternTriggered()
  {
    return $this->data['patterntriggered'];
  }
  
  public function SetPatternTriggered($value)
  {
    $this->data['patterntriggered'] = $value;
  }
  
  public function GetApeTail()
  {
    return $this->data['apetail'];
  }
  
  public function SetApeTail($value)
  {
    $this->data['apetail'] = $value;
  }
  
  public function GetApeControl()
  {
    return $this->data['apecontrol'];
  }
  
  public function SetApeControl($value)
  {
    $this->data['apecontrol'] = $value;
  }
  
  public function GetDOTS()
  {
    return $this->data['dots'];
  }
  
  public function SetDOTS($value)
  {
    $this->data['dots'] = $value;
  }
  
  public function GetTaunt()
  {
    return $this->data['taunt'];
  }
  
  public function SetTaunt($value)
  {
    $this->data['taunt'] = $value;
  }
  
  public function GetReflect()
  {
    return $this->data['reflect'];
  }
  
  public function SetReflect($value)
  {
    $this->data['reflect'] = $value;
  }
	
  public function SetName($value)
  {
    $this->data['name'] = $value;
  }
  
  public function GetFight()
  {
    return $this->data['fight'];
  }
  
  public function GetTeam()
  {
    return $this->data['team'];
  }
	
	public function GetImage()
	{
		return $this->data['charimage'];
	}
	public function GetLoadRounds()
	{
		return $this->data['loadrounds'];
	}
	
	public function SetLoadRounds($value)
	{
		$this->data['loadrounds'] = $value;
	}
  
  public function GetKickTimer()
  {
    return $this->data['kicktimer'];
  }
  
  public function SetKickTimer($value)
  {
    $this->data['kicktimer'] = $value;
  }
	
	public function GetFusedAcc()
	{
		return $this->data['fusedacc'];
	}
	
	public function GetLastAction()
	{
		return $this->data['lastaction'];
	}
	
	public function SetLastAction($value)
	{
		$this->data['lastaction'] = $value;
	}
	public function IsInactive()
	{
		return $this->data['inactive'] == 1;
	}
	
	public function SetInactive($value)
	{
		$this->data['inactive'] = $value;
	}
	
	public function GetActionCountdown()
	{
		$minutes = 2;
		$timestamp = strtotime($this->GetLastAction()) + ($minutes * 60) - $this->GetKickTimer();
		$currentTime = strtotime("now");
		$difference = $timestamp - $currentTime;
		return $difference;
	}
	
	public function CalculateKI()
	{
		$value = ($this->GetIncreasedLP()/10) + ($this->GetIncreasedKP()/10) + $this->GetAttack() + $this->GetDefense();
		$value = round($value / 4);
		return $value;
	}
	
	public function GetKI()
	{
    return $this->data['ki'];
	}
	
	public function GetMaxKI()
	{
    return $this->data['mki'];
	}
	
	public function SetKI($value)
	{
		$this->data['ki'] = $value;
	}
	
	public function GetLP()
	{
		return $this->data['lp'];
	}
	
	public function SetLP($value)
	{
		$this->data['lp'] = $value;
	}
	
	public function GetEnergy()
	{
		return $this->data['energy'];
	}
	
	public function GetMaxEnergy()
	{
		return $this->data['menergy'];
	}
	
	public function GetRemainingEnergy()
	{
		return $this->GetMaxEnergy() - $this->GetEnergy();
	}
	
	public function SetEnergy($value)
	{
		//$this->data['energy'] = $value;
	}
	
	public function GetParalyzed()
	{
		return $this->data['paralyzed'];
	}
	
	public function SetParalyzed($value)
	{
		$this->data['paralyzed'] = $value;
	}
	
	public function GetOwner()
	{
		return $this->data['owner'];
	}
	
	public function GetRace()
	{
		return $this->data['race'];
	}
	
	public function SetOwner($value)
	{
		$this->data['owner'] = $value;
	}
	
	public function GetIncreasedLP()
	{
		return $this->data['ilp'];
	}
	
	public function SetIncreasedLP($value)
	{
		$this->data['ilp'] = $value;
	}
	
	public function GetMaxLP()
	{
		return $this->data['mlp'];
	}
	
	public function SetMaxLP($value)
	{
		$this->data['mlp'] = $value;
	}
	
	public function GetLPPercentage()
	{ 
		$value = ceil(($this->GetLP() / $this->GetMaxLP())*100);
		if($value > 100)
		{
			return 100;
		}
		return $value;
	}
	
	public function GetTotalLPPercentage()
	{ 
		$value = ceil(($this->GetLP() / $this->GetMaxLP())*100);
		return $value;
	}
	
	
	public function GetKP()
	{
		return $this->data['kp'];
	}
	
	public function SetKP($value)
	{
		$this->data['kp'] = $value;
	}
	
	public function GetIncreasedKP()
	{
		return $this->data['ikp'];
	}
	
	public function SetIncreasedKP($value)
	{
		$this->data['ikp'] = $value;
	}
	
	public function GetMaxKP()
	{
		return $this->data['mkp'];
	}
	
	public function SetMaxKP($value)
	{
		$this->data['mkp'] = $value;
	}
	
	public function GetKPPercentage()
	{
		$value = round(($this->GetKP() / $this->GetMaxKP())*100);
		if($value > 100)
		{
			return 100;
		}
		return $value;
	}
	public function GetTotalKPPercentage()
	{
		$value = round(($this->GetKP() / $this->GetMaxKP())*100);
		return $value;
	}
	
	public function GetEPPercentage()
	{
		$value = round(($this->GetEnergy() / $this->GetMaxEnergy())*100);
		if($value > 100)
		{
			return 100;
		}
		return $value;
	}
	public function GetTotalEPPercentage()
	{
		$value = round(($this->GetEnergy() / $this->GetMaxEnergy())*100);
		return $value;
	}
	
	public function GetAttack()
	{
		return $this->data['attack'];
	}
	
	public function SetAttack($value)
	{
		$this->data['attack'] = $value;
	}
	
	public function GetDefense()
	{
		return $this->data['defense'];
	}
	
	public function SetDefense($value)
	{
		$this->data['defense'] = $value;
	}
	
	public function GetReflex()
	{
		return $this->data['reflex'];
	}
	
	public function SetReflex($value)
	{
		$this->data['reflex'] = $value;
	}
	
	public function GetAccuracy()
	{
		return $this->data['accuracy'];
	}
	
	public function SetAccuracy($value)
	{
		$this->data['accuracy'] = $value;
	}
	
	public function GetMaxAttack()
	{
		return $this->data['mattack'];
	}
	
	public function SetMaxAttack($value)
	{
		$this->data['mattack'] = $value;
	}
	
	public function GetMaxDefense()
	{
		return $this->data['mdefense'];
	}
	
	public function SetMaxDefense($value)
	{
		$this->data['mdefense'] = $value;
	}
	
	public function GetMaxAccuracy()
	{
		return $this->data['maccuracy'];
	}
	
	public function SetMaxAccuracy($value)
	{
		$this->data['maccuracy'] = $value;
	}
  
	public function GetMaxReflex()
	{
		return $this->data['mreflex'];
	}
	
	public function SetMaxReflex($value)
	{
		$this->data['mreflex'] = $value;
	}
  
	public function GetAction()
	{
		return $this->data['action'];
	}
  
	public function SetAction($action)
	{
		$this->data['action'] = $action;
	}
  
	public function GetFireLoadValue()
	{
		return $this->data['fireloadvalue'];
	}
  
	public function GetLoadAttack()
	{
		return $this->data['loadattack'];
	}
  
	public function SetLoadAttack($action)
	{
		$this->data['loadattack'] = $action;
	}
  
	public function GetLoadValue()
	{
		return $this->data['loadvalue'];
	}
  
	public function SetLoadValue($action)
	{
		$this->data['loadvalue'] = $action;
	}
  
	public function GetTransformations()
	{
		return $this->data['transformations'];
	}
  
	public function SetTransformations($value)
	{
		$this->data['transformations'] = $value;
	}
	
	public function AddAttacks($attacks)
	{
		$userAttacks = explode(';',$this->GetAttacks());
		$i = 0;
		while(isset($attacks[$i]))
		{
			if(in_array($attacks[$i], $userAttacks))
			{
				++$i;
				continue;
			}
			array_push($userAttacks, $attacks[$i]);
			++$i;
		}
		$this->SetAttacks(implode(';',$userAttacks));
	}
	public function RemoveAttacks($attacks)
	{
		$userAttacks = explode(';',$this->GetAttacks());
		$i = 0;
		while(isset($attacks[$i]))
		{
			if(!in_array($attacks[$i], $userAttacks))
			{
				++$i;
				continue;
			}
			array_splice($userAttacks, array_search($attacks[$i], $userAttacks), 1);
			++$i;
		}
		$this->SetAttacks(implode(';',$userAttacks));
	}
	
	public function AddAttack($attackID)
	{
		$attacks = explode(';',$this->GetAttacks());
		if(in_array($attackID, $attacks))
		{
			return;
		}
		
		array_push($attacks, $attackID);
		
		$this->SetAttacks(implode(';',$attacks));
	}
	public function RemoveAttack($attackID)
	{
		$attacks = explode(';',$this->GetAttacks());
		if(!in_array($attackID, $attacks))
		{
			return;
		}
		
		array_splice($attacks, array_search($attackID, $attacks), 1);
		
		$this->SetAttacks(implode(';',$attacks));
	}
	
	public function Transform($transAttack, $revert)
	{
		$value = $transAttack->GetValue() / 100;
    $lpkpValue = 1 + $value;
		if($revert)
		{
			$value = -$value;
		}
    
    if($revert)
    {
      $lpkpValue = 1 / $lpkpValue;
    }
    $lp = round($this->GetLP() * $lpkpValue * ($transAttack->GetLPValue()/100));
    $kp = round($this->GetKP() * $lpkpValue * ($transAttack->GetKPValue()/100));
		//$lp = $this->GetLP() + round($this->GetMaxLP() * $value * ($transAttack->GetLPValue()/100));
		$ilp = round($this->GetIncreasedLP() * $lpkpValue * ($transAttack->GetLPValue()/100));
		//$kp = $this->GetKP() + round($this->GetMaxKP() * $value * ($transAttack->GetKPValue()/100));
		$ikp = round($this->GetIncreasedKP() * $lpkpValue * ($transAttack->GetKPValue()/100));
		$attack = $this->GetAttack() + round($this->GetMaxAttack() * $value * ($transAttack->GetAtkValue()/100));
		$defense = $this->GetDefense() + round($this->GetMaxDefense() * $value * ($transAttack->GetDefValue()/100));
		$ki = $this->GetKI() + round($this->GetMaxKI() * $value);
		if($lp < 0) $lp = 0;
		if($kp < 0) $kp = 0;
		//because there can't be a division of 0, we have to set it to 1
		if($attack < $attack) $attack = 1;
		if($defense < $defense) $defense = 1;
		$this->SetLP($lp);
		$this->SetIncreasedLP($ilp);
		$this->SetKP($kp);
		$this->SetIncreasedKP($ikp);
		$this->SetAttack($attack);
		$this->SetDefense($defense);
		$this->SetKI($ki);
		
		$trans = array_filter(explode(';',$this->GetTransformations()));
		if($revert)
		{
			array_splice($trans, array_search($transAttack->GetID(), $trans), 1);
		}
		else
		{
			array_push($trans, $transAttack->GetID());
		}
		
		$this->data['transformations'] = implode(';',$trans);
	}
  
	public function GetTarget()
	{
		return $this->data['target'];
	}
  
	public function SetTarget($target)
	{
		$this->data['target'] = $target;
	}
  
	public function GetPreviousTarget()
	{
		return $this->data['previoustarget'];
	}
  
	public function SetPreviousTarget($target)
	{
		$this->data['previoustarget'] = $target;
	}
  
	public function GetAttacks()
	{
		return $this->data['attacks'];
	}
  
	public function SetAttacks($value)
	{
		$this->data['attacks'] = $value;
	}
  
	public function GetFuseTimer()
	{
		return $this->data['fusetimer'];
	}
  
	public function SetFuseTimer($value)
	{
		$this->data['fusetimer'] = $value;
	}
  
	public function GetMajinCounter()
	{
		return $this->data['majincounter'];
	}
  
	public function SetMajinCounter($value)
	{
		$this->data['majincounter'] = $value;
	}
  
	public function IsNPC()
	{
		return $this->data['isnpc'];
	}
  
	public function HasNPCControl()
	{
		return $this->data['npccontrol'];
	}
  
	public function SetNPCControl($value)
	{
		$this->data['npccontrol'] = $value;
	}
	
	public function IsStatsProcentual()
	{
		return $this->data['isstatsprocentual'] == 1;
	}
	
}


?>