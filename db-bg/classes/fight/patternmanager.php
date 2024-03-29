<?php
if($database == NULL)
{
	print 'This File ('.__FILE__.') should be after Datatabase!';
}

include_once 'pattern.php';

class PatternManager
{
	
	private $database;
  private $patterns;
	
	function __construct($db)
	{
    $this->database = $db;
    $this->patterns = array();
    $this->LoadData();
  }
  
  private function LoadData()
  {
		$result = $this->database->Select('*','patterns','',99999);
		if ($result) 
		{
			if ($result->num_rows > 0)
			{
        while($row = $result->fetch_assoc()) 
        {
		      $pattern = new Pattern($row);
					array_push($this->patterns, $pattern);
        }
			}
			$result->close();
      
		}
  }
  
  private function CheckPattern($object, $fight, $pattern)
  {
    $valueName = $pattern->GetValueName();
    $value = $object->GetPatternValue($valueName);
    
    if($value == null)
      return false;
    
    
    $operator = $pattern->GetOperator();
    $fight->AddDebugLog(' - - - Value ('.$pattern->GetValueName().'): '.$value);
    
    if(!is_numeric($value) && $operator != 2 && $operator != 3)
      return false;
    
    if($pattern->IsProcent())
    {
    $fight->AddDebugLog(' - - - Value is Procentual');
      switch($valueName)
      {
        case 'ki':
          $value = ($value / $object->GetPatternValue('mki'))*100;
          break;
        case 'lp':
          $value = ($value / $object->GetPatternValue('ilp'))*100;
          break;
        case 'kp':
          $value = ($value / $object->GetPatternValue('ikp'))*100;
          break;
        case 'energy':
          $value = ($value / $object->GetPatternValue('menergy'))*100;
          break;
      }
    }
    
    $fight->AddDebugLog(' - - - Calculated Value: '.$value);
    
    $patternValues = $pattern->GetValue();
    
    $fight->AddDebugLog(' - - - PatternValue: '.$patternValues);
    
    $patternValuesORArray = explode('||', $patternValues);
    
    $returnValue = false;
    foreach ($patternValuesORArray as $patternValuesOR) 
    {
      $fight->AddDebugLog(' - - - Testing OR-Value: '.$patternValuesOR);
      $patternValuesANDArray = explode('&&', $patternValuesOR);
      $andValue = true;
      foreach ($patternValuesANDArray as $patternValueAND) 
      {
        $fight->AddDebugLog(' - - - - Testing AND-Value: '.$patternValueAND);
        if($operator == 6 && $patternValueAND == 0)
        {
          $fight->AddDebugLog(' - - - - - patternValue equal 0 at modulo');
          $andValue = false;
          break;
        }
        
        $operatorValue = false;
        $operatorName = '';
        switch($operator)
        {
          case 0: //Weniger Als
            $operatorValue = $value < $patternValueAND;
            $operatorName = '<';
            break;
          case 1: //Weniger Gleich
            $operatorValue = $value <= $patternValueAND;
            $operatorName = '<=';
            break;
          case 2: //Gleich
            $operatorValue = $value == $patternValueAND;
            $operatorName = '==';
            break;
          case 3: //Nicht Gleich
            $operatorValue = $value != $patternValueAND;
            $operatorName = '!=';
            break;
          case 4: //Mehr als
            $operatorValue = $value > $patternValueAND;
            $operatorName = '>';
            break;
          case 5: //Mehr Gleich
            $operatorValue = $value >= $patternValueAND;
            $operatorName = '>=';
            break;
          case 6: //Modulo
            $operatorValue = $value % $patternValueAND == 0;
            $operatorName = '%';
            break;
        }
        
        if($operatorValue == false)
        {
          $andValue = false;
          $fight->AddDebugLog(' - - - - - Value '.$value.' '.$operatorName.' patternValue '.$patternValueAND.' is false');
          break;
        }
      }
      
      if($andValue)
      {
        $fight->AddDebugLog(' - - - - All andValues are true!');
        $returnValue = true;
        break;
      }
    }
    return $returnValue;
  }
  
  
  public function IsPatternPossible($fighter, $fight, $attackManager, $pattern)
  {
    $fight->AddDebugLog(' - - Testing Pattern: '.$pattern->GetName());
    
    if($pattern->GetPatternNeed() != $fighter->GetPatternID())
    {
      $fight->AddDebugLog(' - - - PatternID ('.$fighter->GetPatternID().') != Need ('.$pattern->GetPatternNeed().')');
      return false;
    }
    
    $triggeredPatterns = explode(';', $fighter->GetPatternTriggered());
    $triggerCount = 0;
    foreach ($triggeredPatterns as &$triggeredPattern) 
    {
      if($triggeredPattern == $pattern->GetID())
        $triggerCount++;
    }
    
    $fight->AddDebugLog(' - - - has been triggered '.$triggerCount);
    
    $patternTriggerCount = $pattern->GetTriggerCount();
    if($patternTriggerCount != 0 && $patternTriggerCount <= $triggerCount)
    {
      $fight->AddDebugLog(' - - - has been triggered more often than '.$patternTriggerCount);
      return false;
    }
    
    $patternAttack = $pattern->GetAttack();
    
		//$attacks = explode(';',$fighter->GetAttacks());
    //if(!in_array($patternAttack, $attacks))
    //{
    //  $fight->AddDebugLog(' - - - Fighter does not have Attack: '.$patternAttack);
    //  return false;
    //}
    
    $patternValid = false;
    
    $valueName = $pattern->GetValueName();
    $patternType = $pattern->GetType();
    if($patternType == 0)
        $patternValid = $this->CheckPattern($fighter, $fight, $pattern);
    else if($patternType == 1)
        $patternValid = $this->CheckPattern($fight, $fight, $pattern);
    else
    {
      $fight->AddDebugLog(' - - - Checking Teams');
      $fight->AddDebugLog(' - - - PatternType: '.$patternType);
      $fight->AddDebugLog(' - - - FighterTeam: '.$fighter->GetTeam());
      $fightTeams = $fight->GetTeams();
      for($i = 0; $i < count($fightTeams); ++$i)
      {
        if($i == $fighter->GetTeam() && $patternType == 2 
           || $i != $fighter->GetTeam() && $patternType == 3)
        {
          continue;
        }
        
         $players = $fightTeams[$i];
        
        for($j = 0; $j < count($players); ++$j)
        {
          $fight->AddDebugLog(' - - - Checking Fighter: '.$players[$j]->GetName());
          $patternValid = $this->CheckPattern($players[$j], $fight, $pattern);
          if($patternValid)
            break;
        }
             
        if($patternValid)
             break;
      }
    }
    
    if(!$patternValid)
      return false;
    
    $fight->AddDebugLog(' - - - Pattern is true');
    
    if($attackManager == null)
      return false;
    
    $attack = $attackManager->GetAttack($patternAttack);
    
		if($attack->GetKP() > $fighter->GetKP())
     return false;
   
		if($attack->GetEnergy() > $fighter->GetRemainingEnergy())
     return false;
      
    $fight->AddDebugLog(' - - - Pattern is possible!');
    
    return true;
  }
	
  public function GetPattern($id)
  {
    $i = 0;
    while(isset($this->patterns[$i]))
    {
      if($this->patterns[$i]->GetID() == $id)
      {
        return $this->patterns[$i];
      }
     ++$i; 
    }
    return null;
  }
  
}