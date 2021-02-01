<?php
if($database == NULL)
{
	print 'This File ('.__FILE__.') should be after Datatabase!';
}

include_once 'fighter.php';
include_once 'attackmanager.php';
include_once 'patternmanager.php';

class Fight
{
	private $database;
	private $data;
	private $valid;
	private $fighters;
	private $fighterCount;
	private $player;
	private $playerAccount;
	private $actionManager;
	private $attackManager;
	private $patternManager;
	private $defenseArray;
  private $titelManager = null;
  
  private $preAttacks;
  private $attacks;
  private $postAttcks;
  
  private $startLog = '';
  
	function __construct($db, $id, $player, $actionManager)
	{
		$id = $db->EscapeString($id);
    $this->database = $db;
		$this->valid = false;
		$this->teams = array();
		$this->player = null;
		$this->playerAccount = $player;
		$this->actionManager = $actionManager;
		$this->attackManager = new AttackManager($db);
		$this->patternManager = new PatternManager($db);
		$this->defenseArray = array();
    
		$this->preAttacks = array();
		$this->attacks = array();
		$this->postAttcks = array();
		
		$this->LoadFight($id);
		
		if(!$this->IsEnded())
		{
			$this->LoadFighters($player);
		}
		if($this->IsStarted() && !$this->IsEnded())
		{
			$this->DoRound();
		}
    
    $this->startLog = $this->GetDebugLog();
  }
  
 function __destruct()
 {
   $debuglog = $this->GetDebugLog();
   if($debuglog == $this->startLog)
     return;
   
	 $result = $this->database->Update('debuglog="'.$debuglog.'"','fights', 'id = "'.$this->GetID().'"',1);
 }
  
  public function GetPatternValue($name)
  {
    return $this->data[$name];
  }
  
  public function DebugSend($withText = false, $title='')
  {
    if($withText)
    {
      echo 'In Euren Kampf kam es zu einen Fehler. Der Fehler wird manuell behoben und PuRe hat den Log erhalten.<br/>';
      echo 'Falls du diese Nachricht siehst, melde es PuRe im Discord.<br/>';
    }
    
    $timestamp = date('Y-m-d H:i:s');
    if($title == '')
      $title = 'Error In Fight: '.$this->GetName().'('.$this->GetID().')';
    $isHTML = 1;
    $result = $this->database->Insert('`sendername`, `senderimage`, `senderid`, `receiverid`, `receivername`, `text`, `time`, `topic`, `read`, `ishtml`', 
																	'"System","img/battel2.png","0","1","PuRe","'.$this->GetDebugLog().'","'.$timestamp.'","'.$title.'", "0","'.$isHTML.'"', 'pms');
  }
	
	public function Kick($id)
	{
		$target = $this->GetFighter($id);
		$actionsLeft = 0;
		$this->CalculateLeftActions($actionsLeft);
		if($target == null || $target->IsNPC() || $target->GetAction() != 0 || $target->GetLP() == 0 || $target->GetActionCountdown() > 0 || $target->HasNPCControl())
		{
			return;
		}

		else if($this->GetType() == 6 || $this->GetType() == 8) // Tournament || Arena
		{		
		  $target->SetLP(0);
		  $result = $this->database->Update('lp="0"','fighters','id = "'.$target->GetID().'"',1);
		}
    else
    {				
		  $target->SetNPCControl(true);
      $result = $this->database->Update('npccontrol="1"','fighters','id = "'.$target->GetID().'"',1);
    }
    
    if($this->GetType() == 8)
    {
		  $result = $this->database->Delete('arenafighter','fighter = "'.$target->GetAcc().'"',1);
    }
    
		if($actionsLeft == 1)
		{
			$this->CalculateRound();
		}
	}
  
  private function getTitelManager()
  {
    if($this->titelManager == null)
      $this->titelManager = new TitelManager($this->database);
    
    return $this->titelManager;
  }
  
  private function getTitelsFromPlayer($player)
  {
		$result = $this->database->Select('id, titels','accounts','id = "'.$player->GetAcc().'"',1);
		if ($result) 
		{
			if ($result->num_rows > 0)
			{
				$row = $result->fetch_assoc();
			  $result->close();
        return explode(';',$row['titels']);
			}
			$result->close();
		}
    return array();
  }
  
  private function addAttackTitel($player, $attack)
  {
    if($player->IsNPC())
      return;
    
    $titels = $this->getTitelsFromPlayer($player);
    $progress = 1;
    $this->getTitelManager()->AddTitelAttack($player->GetAcc(), $titels, $progress, $attack->GetID(), $this->GetType());
  }
  
  private function addInAttackArray(&$array, $attack)
  {
    $isAdded = false;
    if(count($array) != 0)
    {
      $kp = $attack->GetKP();
      $isAdded = false;
      for($i =0; $i < count($array); ++$i)
      {
        if($array[$i]->GetKP() < $kp)
        {
          $isAdded = true;
          array_splice($array, $i, 0, [$attack]);
          break;
        }
      }
    }
    
    if(!$isAdded)
      array_push($array, $attack);
  }
  
  private function pickRandomAttack(&$array)
  {
    for($i =0; $i < count($array); ++$i)
    {
		  $aRand = rand(0, 4);
      if($aRand != 0)
      {
        return $array[$i];
      }
    }
    
    if(count($array) == 0)
      return null;
    
    return $array[0];
  }
  
  private function addInTargetArray(&$array, $target)
  {
    $isAdded = false;
    if(count($array) != 0)
    {
      $def = $target->GetDefense();
      $isAdded = false;
      for($i =0; $i < count($array); ++$i)
      {
        if($array[$i]->GetDefense() < $def)
        {
          $isAdded = true;
          array_splice($array, $i, 0, [$target]);
          break;
        }
      }
    }
    
    if(!$isAdded)
      array_push($array, $target);
  }
  
  private function pickRandomTarget($player, $targetType)
  {
    $targets = array();
    $this->AddDebugLog(' - - Pick Random Target based on Type: '.$targetType);
    
    $weakestTarget = null;
    
    for($i = 0; $i < count($this->teams); ++$i)
    {
			if($i == $player->GetTeam() && ($targetType == 1  || $targetType == 4)
				 || $i != $player->GetTeam() && ($targetType == 2  || $targetType == 3))
			{
				continue;
			}
			
      $players = $this->teams[$i];
			
			for($j = 0; $j < count($players); ++$j)
			{
				if($players[$j]->GetLP() != 0 && !$players[$j]->IsInactive())
				{
           $this->AddDebugLog(' - - Random Target can be: '.$players[$j]->GetName());
           $this->AddDebugLog(' - - Random Target LP: '.$players[$j]->GetLP());
           if($weakestTarget != null)
           {
            $this->AddDebugLog(' - - PreviousTarget: '.$weakestTarget->GetName());
            $this->AddDebugLog(' - - PreviousTarget LP: '.$weakestTarget->GetLP());
           }
          
          if($weakestTarget == null || $weakestTarget != null && $weakestTarget->GetLP() > $players[$j]->GetLP())
            $weakestTarget = $players[$j];
          
          $this->addInTargetArray($targets, $players[$j]);
				}
			}
    }
    
    $this->AddDebugLog(' - - Targets: '.count($targets));
    
    if(count($targets) == 0)
      return null;
    
    if($targetType == 3 || $targetType == 4) //Weakes
      return $weakestTarget;
    
    $tID = rand(0, count($targets)-1);
    return $targets[$tID];
  }
  
  private function CalculateRandomAttack($fighter)
  {
    $offensives = array();
		$defenses = array();
		$npcspawn = array();
		$trans = array();
		$heal = array();
		$kill = array();
		$paralyzes = array();
    
    
		$endAttacks = array();
		$i = 0;
    
		$attacks = explode(';',$fighter->GetAttacks());
    $fighterKP = $fighter->GetKP();
    $fighterMKP = $fighter->GetMaxKP();
                       
    $fighterEP = $fighter->GetRemainingEnergy();
                       
    $this->AddDebugLog(' - - KP: '.$fighterKP);
    $this->AddDebugLog(' - - EP: '.$fighterEP);
    
    $maxKPCost = 0;
    
		while(isset($attacks[$i]))
		{
			$aid = $attacks[$i];
			$attack = $this->GetAttack($aid);
      if($attack == null)
      {;
        $this->AddDebugLog(' - - Attack with ID '.$aid.' not found');
        $this->DebugSend(true);
				++$i;
				continue;
      }
      $this->AddDebugLog(' - - Test Attack: '.$attack->GetName());
      
      $attackKP = $attack->GetKP();
      
      if($attackKP > $maxKPCost)
        $maxKPCost = $attackKP;
      
      $this->AddDebugLog(' - - Attack KP: '.$attackKP);
      $this->AddDebugLog(' - - Attack EP: '.$attack->GetEnergy());
      
			if($attackKP > $fighterKP)
			{
				++$i;
				continue;
			}		
      
			if($attack->GetEnergy() > $fighterEP)
			{
				++$i;
				continue;
			}		
      
      if(!$attack->IsPickableByNPC())
      {
				++$i;
				continue;
      }
      
      $this->AddDebugLog(' - - Valid Attack: '.$attack->GetName());
      
      
      array_push($endAttacks, $attack);
      
			if($attack->GetType() == 1)
			{
        $this->addInAttackArray($offensives, $attack);
			}			
			else if($attack->GetType() == 2)
			{
				$this->addInAttackArray($defenses, $attack);
			}
			else if($attack->GetType() == 3)
			{
				$this->addInAttackArray($kill, $attack);
			}
			else if($attack->GetType() == 4)
			{
				$this->addInAttackArray($trans, $attack);
			}
			else if($attack->GetType() == 5)
			{
				$this->addInAttackArray($heal, $attack);
			}
			else if($attack->GetType() == 6)
			{
				$this->addInAttackArray($offensives, $attack);
			}
			else if($attack->GetType() == 7)
			{
				$this->addInAttackArray($defenses, $attack);
			}
			else if($attack->GetType() == 8)
			{
				$this->addInAttackArray($npcspawn, $attack);
			}
			else if($attack->GetType() == 9)
			{
				$this->addInAttackArray($paralyzes, $attack);
			}
			else if($attack->GetType() == 10)
			{
				$this->addInAttackArray($offensives, $attack);
			}
			else if($attack->GetType() == 11)
			{
				$this->addInAttackArray($heal, $attack);
			}
			else if($attack->GetType() == 12)
			{
				$this->addInAttackArray($offensives, $attack);
			}
			else if($attack->GetType() == 12) // Heal-Attack
			{
				$this->addInAttackArray($heal, $attack);
			}
			//else if($attack->GetType() == 13) // Fusion
			//{
			//	$this->addInAttackArray($trans, $attack);
			//}
			else if($attack->GetType() == 14) // Wetter
			{
				$this->addInAttackArray($offensives, $attack);
			}
			else if($attack->GetType() == 15) // Sonstiges
			{
				$this->addInAttackArray($offensives, $attack);
			}
			else if($attack->GetType() == 16) // Aufgeben
			{
				$this->addInAttackArray($offensives, $attack);
			}
			else if($attack->GetType() == 17) // Beleben
			{
				$this->addInAttackArray($heal, $attack);
			}
			else if($attack->GetType() == 18) // Buffs
			{
				$this->addInAttackArray($heal, $attack);
			}
			else if($attack->GetType() == 19) // UnParalyze
			{
				$this->addInAttackArray($heal, $attack);
			}
			else if($attack->GetType() == 20) // Reflect
			{
				$this->addInAttackArray($defenses, $attack);
			}
			else if($attack->GetType() == 21) // Taunt
			{
				$this->addInAttackArray($heal, $attack);
			}
			else if($attack->GetType() == 22) // Dots
			{
				$this->addInAttackArray($offensives, $attack);
			}
			++$i;
		}
		
		$attack = null;
		$defenseChance = rand(0,10);
		$transChance = 0;
		$killChance = rand(0,10);
		$healChance = rand(0,20);
    if($fighterKP < $maxKPCost)
		  $healChance = rand(0,1);
		$npcspawnChance = rand(0,10);
		$paraChance = rand(0,10);
    
		if($fighter->GetTransformations() == '' && count($trans) != 0)
		{
			$transChance = 1;
		}
    
		if(count($paralyzes) > 0 && $paraChance == 1)
		{
      $attack = $this->pickRandomAttack($paralyzes);
		}
		else if(count($npcspawn) > 0 && $npcspawnChance == 1)
		{
      $attack = $this->pickRandomAttack($npcspawn);
		}
		else if(count($kill) > 0 && $killChance == 1)
		{
      $attack = $this->pickRandomAttack($kill);
		}
		else if(count($trans) > 0 && $transChance == 1)
		{
      $attack = $this->pickRandomAttack($trans);
		}
		else if($fighter->GetLP() < ($fighter->GetMaxLP()*0.9) && count($heal) > 0 && $healChance == 1)
		{
      $attack = $this->pickRandomAttack($heal);
		}
		else if(count($defenses) > 0 && $defenseChance == 1)
		{
      $attack = $this->pickRandomAttack($defenses);
		}
		else
		{
      $attack = $this->pickRandomAttack($offensives);
		}
    
		if($attack == null)
		{
      if(count($endAttacks) == 0)
      {
        $failSafe = 1;
        $this->AddDebugLog(' - - no Attack for '.$fighter->GetName());
        $this->AddDebugLog(' - - Fallback to ID '.$failSafe);
        $this->DebugSend(true);
        $attack = $this->GetAttack($failSafe);
      }
      else
        $attack = $this->pickRandomAttack($endAttacks);
		}
    
    return $attack;
  }
	
	private function DoNPCAttack($fighter)
	{
    $this->AddDebugLog(' - DoNPCAttack for: '.$fighter->GetName());
    $this->AddDebugLog(' - - Attacks: '.$fighter->GetAttacks());
		$target = $fighter->GetID();
    
    $patterns = $fighter->GetPatterns();
    
    $pattern = null;
    if($patterns != '')
    {
      $this->AddDebugLog(' - - Pattern Test: '.$patterns);
      $patterns = explode(';', $patterns);
      
      for($i =0; $i < count($patterns); ++$i)
      {
        $patternID = $patterns[$i];
        $foundPattern = $this->patternManager->GetPattern($patternID);
        if($foundPattern != null && $this->patternManager->IsPatternPossible($fighter, $this, $this->attackManager, $foundPattern))
        {
          $pattern = $foundPattern;
          break;
        }
      }
    }
    
    $patternid = 0;
    
    //0 = self
    //1 = Random Enemy
    //2 = Random Team
    //3 = Schwächster Team
    //4 = Schwächster Gegner
    $targetType = 0;
    if($pattern != null)
    {
      $attack = $this->GetAttack($pattern->GetAttack());
      $targetType = $pattern->GetPatternTarget();
      $patternid = $pattern->GetPatternSet();
    }
    else
    {
      $attack = $this->CalculateRandomAttack($fighter);
      
      if($attack->GetType() == 5)
        $targetType = 2;
      else
        $targetType = 1;
    }
    
    if($targetType == 0)
      $target = $fighter;
    else
      $target = $this->pickRandomTarget($fighter, $targetType);
    
    if($target == null)
    {
      $target = $fighter;
      $this->DebugSend(true);
    }
		
    $tID = $target->GetID();
		$aid = $attack->GetID();
		$fighter->SetAction($aid);
		$fighter->SetTarget($tID);
		$fighter->SetPreviousTarget($tID);
    $fighter->SetPatternID($patternid);
    $timestamp = date('Y-m-d H:i:s');
		$result = $this->database->Update('action="'.$aid.'", target="'.$tID.'", previoustarget="'.$tID.'", lastaction="'.$timestamp.'", patternid="'.$patternid.'"','fighters','id = "'.$fighter->GetID().'"',1);
		
	}
  
  public function UpdateAttackCode($fighter)
  {
    $attackcode = md5($fighter->GetID()+time()+hexdec($fighter->GetAttackCode()));
		$result = $this->database->Update('attackcode="'.$attackcode.'"','fighters','id = "'.$fighter->GetID().'"',1);
    $fighter->SetAttackCode($attackcode);
  }
  
  public function AddDebugLog($text)
  {
    $debugLog = $this->GetDebugLog();
    if($debugLog == '')
      $debugLog = $text;
    else
      $debugLog = $debugLog.'<br/>'.$text;
    
    $this->SetDebugLog($debugLog);
  }
	
	private function CalculateLeftActions(&$actionsLeft)
	{
    $i = 0;
		$actionsLeft = 0;
    while(isset($this->teams[$i]))
    {
      $players = $this->teams[$i];
      $j = 0;
      while(isset($players[$j]))
      {
				if($players[$j]->GetAction() == 0 && $players[$j]->GetLP() != 0 && !$players[$j]->IsInactive())
				{
					if($players[$j]->IsNPC() || $players[$j]->HasNPCControl())
					{
						$this->DoNPCAttack($players[$j]);
					}
					else
					{
						$actionsLeft++;
					}
				}
        $j++;
      }
      ++$i;
    }
	}
	
	public function DoRound()
	{
		$actionsLeft = 0;
		$this->CalculateLeftActions($actionsLeft);
		if($actionsLeft == 0)
		{
			$this->CalculateRound();
		}
	}
	
	public function HasPlayerWithApetail()
	{		
    $i = 0;
		$actionsLeft = 0;
    while(isset($this->teams[$i]))
    {
      $players = $this->teams[$i];
      $j = 0;
      while(isset($players[$j]))
      {
        if($players[$j]->GetApeTail() == 3)
        {
          return true;
        }
        $j++;
      }
      ++$i;
    }
    return false;
  }
  
	public function GiveUp($fighter)
	{		
		if($fighter->GetAction() != 0 || $fighter->GetLP() == 0)
		{
			return;
		}
		$fighter->SetLP(0);
		
		$actionsLeft = 0;
		$this->CalculateLeftActions($actionsLeft);
		if($actionsLeft == 0)
		{
			$this->CalculateRound();
		}
		else
		{
		$result = $this->database->Update('lp="0"','fighters','id = "'.$fighter->GetID().'"',1);
		}
	}
	
	public function DoAttack($fighter, $aid, $tid)
	{
		if($fighter->GetAction() != 0 || $fighter->GetLP() == 0)
		{
			return;
		}
		
		$transformations = explode(';',$fighter->GetTransformations());

		$attack = $this->GetAttack($aid);
		if($attack == null)
		{
			return;
		}
    
    $cost = $this->CalculateCost($attack->GetKP(), $attack->IsCostProcentual(), $fighter->GetKI(), $fighter->GetRace());
		$energy = $attack->GetEnergy();
    
    if($energy < 0) 
      $energy = 0;
    
    if($energy > $fighter->GetRemainingEnergy())
    {
      return;
    }
    
		if($cost > $fighter->GetKP())
		{
			return;
		}
		
		$target = $this->GetFighter($tid);
		if($target == null || $target->IsInactive())
		{
			return;
    }
		
		$fighterAttacks = explode(';',$fighter->GetAttacks());
      
    if($target->GetApeTail() == 3)
      array_push($fighterAttacks, 296); //Affenschwanz abtrennen
    
		$i = 0;
		$gotAttack = false;
		while(isset($fighterAttacks[$i]))
		{
			if($fighterAttacks[$i] == $aid)
			{
				$gotAttack = true;
				break;
			}
			++$i;
		}
		
		if(!$gotAttack)
		{
			return;
		}
		
		$actionsLeft = 0;
		$this->CalculateLeftActions($actionsLeft);
		
		$loadRounds = $attack->GetLoadRounds();
		if($loadRounds > 0)
		{
			$loadRounds = $loadRounds+1;
		}
		
		--$actionsLeft;
		$fighter->SetAction($aid);
		$fighter->SetTarget($tid);
		$fighter->SetPreviousTarget($tid);
		$fighter->SetLoadRounds($loadRounds);
    
    $kickStartSeconds = 10;
    $timeDiff = (time() - strtotime($fighter->GetLastAction())) - $kickStartSeconds;
    if($timeDiff > 0)
    {
      $kickTimer = $fighter->GetKickTimer() + $timeDiff;
      $fighter->SetKickTimer($kickTimer);
    	$result = $this->database->Update('kicktimer="'.$kickTimer.'"','fighters','id = "'.$fighter->GetID().'"',1);
		}
		
		if($actionsLeft == 0)
		{
			$this->CalculateRound();
		}
		else
		{
			$timestamp = date('Y-m-d H:i:s');
			$result = $this->database->Update('action="'.$aid.'", target="'.$tid.'", previoustarget="'.$tid.'", lastaction="'.$timestamp.'", loadrounds="'.$loadRounds.'"','fighters','id = "'.$fighter->GetID().'"',1);
		}
	}
	
	public function GetTeamColor($team)
	{
		$teamColor = '#000000';
		if($team == 0)
		{
			$teamColor = '#0000ff';
		}
		else if($team == 1)
		{
			$teamColor = '#ff0000';
		}
		else if($team == 2)
		{
			$teamColor = '#00ff00';
		}
		else if($team == 3)
		{
			$teamColor = '#ffaa22';
		}
		else if($team == 4)
		{
			$teamColor = '#00ffff';
		}
		else if($team == 5)
		{
			$teamColor = '#ff00ff';
		}
		else if($team == 6)
		{
			$teamColor = '#11bb55';
		}
		else if($team == 7)
		{
			$teamColor = '#0022aa';
		}
		else if($team == 8)
		{
			$teamColor = '#bb5599';
		}
		else if($team == 9)
		{
			$teamColor = '#aaaa00';
		}
		else if($team == 10)
		{
			$teamColor = '#00aaaa';
		}
		
		return $teamColor;
	}
	
	private function CheckForWonTeam()
	{
    $this->AddDebugLog('CheckForWonTeam');
    if($this->GetHealthRatio() != 0)
    {
      $this->AddDebugLog('- HealthRatio ('.$this->GetHealthRatio().') != 0');
      $healthTeam = $this->GetHealthRatioTeam();
      $players = $this->teams[$healthTeam];
      $j = 0;
      $hLP = 0;
      $hCount = 0;
      while(isset($players[$j]))
      {
        $player = $players[$j];
        $hLP += $player->GetLP() / $player->GetMaxLP();
        ++$j;
      }
      $hLP = round(($hLP / $j) * 100);
      if($hLP < $this->GetHealthRatio())
      {
        $this->AddDebugLog('- HealthRatioWinner: '.$this->GetHealthRatioWinner());
        return $this->GetHealthRatioWinner();
      }
    }
    
		if($this->GetSurvivalRounds() != 0 && $this->GetSurvivalRounds() == $this->GetRound())
		{
      $this->AddDebugLog(' - SurvivalRounds ( '.$this->GetSurvivalRounds().') != 0');
      //if rounds are over and we still have no team won, make the winner win
			return $this->GetSurvivalWinner();
		}
    
		$aliveTeam = -2; //Nobody won
    $this->AddDebugLog(' - Check alive');
		$i = 0;
    while(isset($this->teams[$i]))
    {
      $players = $this->teams[$i];
      $j = 0;
      while(isset($players[$j]))
      {
				$player = $players[$j];
        $this->AddDebugLog(' -- Player '.$player->GetName().' LP = '.$player->GetLP());
				if($player->GetLP() != 0)
				{
					if($aliveTeam != -2 && $aliveTeam != $player->GetTeam())
					{
            $this->AddDebugLog(' -- AliveTeam: '.$aliveTeam.' != PlayerTeam: '.$player->GetTeam().' => ALIVE');
            return -1;
					}
					else
					{
						$aliveTeam = $player->GetTeam();
            $this->AddDebugLog(' -- Set AliveTeam: '.$aliveTeam);
					}
				}
				
				++$j;
			}
			
			++$i;
		}
    
    $this->AddDebugLog(' - AliveTeam: '.$aliveTeam);
    
    //if one team is alive only, those lines will be executed
    //so if we are in a survival game, we have to check
    if($this->GetSurvivalRounds() != 0)
    {
      if($this->GetSurvivalTeam() == $aliveTeam)
      {
        //The team that should survive survived, so make the winner team win
        $aliveTeam = $this->GetSurvivalWinner();
      }
      else if($this->GetSurvivalTeam() != $this->GetSurvivalWinner())
      {
        //So here given is: SurvivalTeam (0) != AliveTeam (2)
        
        //Team 0 is survivalteam and winner, but aliveTeam = 1, so do not execute here, as aliveTeam can stay 1
        //Team 0 is survivalteam, winner is 1 and alive is 1 = aliveTeam = 0
        //Team 1 is survivalteam, winner is 0, alive is 1 = 1
        //Team 1 is survivalteam, winner is 0, but alive = 0, so aliveTeam = 1
        $aliveTeam = $this->GetSurvivalTeam();
      }
    }
    
		return $aliveTeam;
	}
	
	private function CalculateAndGetText($attack, $imageLeft)
	{
			$attackImage = $attack[2]->GetImage();
			$calculatedText = $this->CalculateAttack($attack[0], $attack[1], $attack[2]);
      return $this->DisplayAttackText($attackImage, $calculatedText, $imageLeft);
	}
  
  private function DisplayAttackText($attackImage, $text, $imageLeft)
  {
			$attackText = '<tr>';
			if($imageLeft)
			{
				$attackText = $attackText.'<td width=50><img width=50 height=50 src='.$attackImage.'></img></td>';
				$attackText = $attackText.'<td width=50% align=left>'.$text.'</td>';
				$attackText = $attackText.'<td colspan=2></td>';
			}
			else
			{
				$attackText = $attackText.'<td colspan=2></td>';
				$attackText = $attackText.'<td width=50% align=right>'.$text.'</td>';
				$attackText = $attackText.'<td width=50 align=right><img width=50 height=50 src='.$attackImage.'></img></td>';
			}
		$attackText = $attackText.'</tr>';
		return $attackText;
  }
	
	private function RemoveNPCSpawns()
	{
    $i = 0;
		$removeFighters = array();
		$removing = false;
    while(isset($this->teams[$i]))
    {
      $players = $this->teams[$i];
      $j = 0;
      while(isset($players[$j]))
      {
				$player = $players[$j];
				
				if($player->GetOwner() != 0)
				{
					array_push($removeFighters, $player);
					$removing = true;
				}
        $j++;
      }
      ++$i;
    }
		
		if(!$removing)
		{
			return;
		}
		
		$i = 0;
    while(isset($removeFighters[$i]))
    {
			$player = $removeFighters[$i];
			$this->RemoveNPCSpawn($player);
			++$i;
		}
	}
	
	private function RemoveNPCSpawn($fighter)
	{
		$this->RemoveFighter($fighter->GetID(), true);
		$result = $this->database->Delete('fighters','id="'.$fighter->GetID().'"',1);
	}
	
	private function ResetActions()
	{
    $i = 0;
		$removeFighters = array();
		$removing = false;
    while(isset($this->teams[$i]))
    {
      $players = $this->teams[$i];
      $j = 0;
      while(isset($players[$j]))
      {
				$player = $players[$j];
				
				if($player->GetLP() == 0 && $player->GetOwner() != 0)
				{
					array_push($removeFighters, $player);
					$removing = true;
				}
				
				$paralyzed = $player->GetParalyzed();
        $this->AddDebugLog(' - ResetAction of '.$player->GetName());
				if($paralyzed == 0 && $player->GetLoadRounds() == 0)
				{
          $this->AddDebugLog(' - - Reset!');
					$player->SetAction(0);
					$player->SetTarget(0);
					$timestamp = date('Y-m-d H:i:s');
					$player->SetLastAction($timestamp);
				}
        else
        {
          $this->AddDebugLog(' - - Paralyzed ('.$paralyzed.') or LoadRound('.$player->GetLoadRounds().')');
        }
				
        $j++;
      }
      ++$i;
    }
		
		if(!$removing)
		{
			return;
		}
		
		$i = 0;
    while(isset($removeFighters[$i]))
    {
			$player = $removeFighters[$i];
			$this->RemoveNPCSpawn($player);
			++$i;
		}
	}
  
  private function CalculateCost($value, $procentual, $ki, $race)
  {
    if($procentual)
      $cost = ($value / 100) * $ki;
    else
      $cost = $value; 
    $cost = round($cost);
    
    return $cost;
  }
	
	private function UpdateAllPlayers($wonTeam, $lpkp, $addzeni, $addstats, $addstory)
	{
      $this->AddDebugLog('-----------------');
      $this->AddDebugLog('UpdateAllPlayers');
			$itemManager = new ItemManager($this->database);
			$id = 0;
			if($this->playerAccount != null)
			{
				$id = $this->playerAccount->GetID();
			}
			$PMManager = new PMManager($this->database, $id);
			$i = 0;
			while(isset($this->teams[$i]))
			{
				$players = $this->teams[$i];
				$j = 0;
				while(isset($players[$j]))
				{
					$fighter = $players[$j];
					if($fighter->IsNPC() || $fighter->GetFusedAcc() != 0)
					{
						++$j;
						continue;
					}
          
          if($fighter->GetTransformations() != '')
					  $this->Revert($fighter, false);
					
					if($this->playerAccount != null && $this->playerAccount->GetID() == $fighter->GetAcc())
					{
						$player = $this->playerAccount;
					}
					else
					{
						$player = new Player($this->database, $fighter->GetAcc(), $this->actionManager);
					}
          $this->AddDebugLog(' - Update: '.$player->GetName());
						if($wonTeam == $i)
              $this->AddDebugLog(' - - Player won!');
            else
              $this->AddDebugLog(' - - Player lost!');
          
					$text = "<table width='100%'>";
					$text = $text.$this->GetText();
					$text = $text.'</table>';
					
					$player->UpdateFight(0);
					$update = 'fight = "0"';
					$inGainAccs = $this->IsInGainAccs($player->GetID());
					
					if($this->GetType() == 6 && $wonTeam != $i)
					{
            $this->AddDebugLog(' - - set Tournament to 0');
						$update = $update.', tournament="0"';
						$player->SetTournament(0);
					}
					else if($this->GetType() == 8)
					{
            $arenaPoints = $player->GetArenaPoints();
						if($wonTeam == $i)
              $arenaPoints += 2;
            else
              $arenaPoints += 1;
            
            $this->AddDebugLog(' - - add Arenapoints to: '.$arenaPoints);
					  //$update = $update.', arenapoints="'.$arenaPoints.'"';
            //$player->SetArenaPoints($arenaPoints);
					}
					//$this->database->Debug();
					
					$dailyFights = $player->GetDailyFights() + 1;
					if($this->GetType() == 1 && $dailyFights <= 5)
					{
            $this->AddDebugLog(' - - add dailyfights to: '.$dailyFights);
						$update = $update.', dailyfights="'.$dailyFights.'"';
					}
          
					if($wonTeam == -2)
					{
            $titleSort = 2;
            StatsList::AddDraw($this->database, $player->GetID(), $player->GetName(), $this->GetType());
					}
					else if($wonTeam == $i)
					{
            $titleSort = 0;
            StatsList::AddWin($this->database, $player->GetID(), $player->GetName(), $this->GetType());
					}
					else
					{
            $titleSort = 1;
            StatsList::AddLoose($this->database, $player->GetID(), $player->GetName(), $this->GetType());
					}
					
					if($lpkp)
					{
            $fLP = $fighter->GetLP();
            $fKP = $fighter->GetKP();
            if($player->GetRace() == 'Namekianer')
            {
              $fLP = floor($fLP * 1.1);
              $fKP = floor($fKP * 1.1);
            }
            if($fLP > $player->GetLP())
              $fLP = $player->GetLP();
            if($fKP > $player->GetKP())
              $fKP = $player->GetKP();
						if($fLP > $fighter->GetMaxLP())
						{
							$lpreset = $fighter->GetMaxLP();
						}
						else
						{
							$lpreset = $fLP;
						}
						if($fKP > $fighter->GetMaxKP())
						{
							$kpreset = $fighter->GetMaxKP();
						}
						else
						{
							$kpreset = $fKP;
						}
						$update = $update.', lp="'.$lpreset.'"';
						$player->SetLP($lpreset);
						$update = $update.', kp="'.$kpreset.'"';
						$player->SetKP($kpreset);
						//$inventory = $fighter->GetInventory();
						//$update = $update.', inventory="'.$inventory->Encode().'"';
						$update = $update.', apetail="'.$fighter->GetApeTail().'"';
						$player->SetApeTail($fighter->GetApeTail());
						//$player->SetInventory($inventory);
					}
          
          $gotSomething = false;
					
					$stats = 0;
					if($addstory && $wonTeam == $i && $inGainAccs && $player->GetStory() == $this->GetStory())
					{
						$story = $player->GetStory() + 1;
						$player->SetStory($story);
            $this->AddDebugLog(' - - add story to: '.$story);
						$update = $update.', story="'.$story.'"';
						if($this->GetLevelup())
						{
							$level = $player->GetLevel() + 1;
							$player->SetLevel($level);
              $this->AddDebugLog(' - - add level to: '.$level);
							$update = $update.', level="'.$level.'"';
							$stats = $stats+10;
						}
           $this->getTitelManager()->AddTitelStory($player, $story);
					}
					
					$zeni = 0;
					if($this->GetZeni() != 0 && ($wonTeam == $i || $wonTeam == -2) && $inGainAccs)
					{
            $gotSomething = true;
						$zeni = $zeni + $this->GetZeni();
					}
					
					$kampfWinPM = '';
					if($this->GetItems() != 0 && ($wonTeam == $i || $wonTeam == -2) && $inGainAccs)
					{
						$addItem = true;
						$items = explode(';',$this->GetItems());
						$k = 0;
						$wonItems = '';
						
						$randItem = rand(0, count($items)-1);
						
						$item = explode('@',$items[$randItem]);
						$itemID = $item[0];
						$chance = $item[1];
            
            if($player->GetRace() == 'Demon')
              $chance = $chance+10;
            
            if($chance > 100)
              $chance = 100;
            
            $randomChance = rand(0,100);
            $this->AddDebugLog(' - - Item random: '.$randomChance);
            $this->AddDebugLog(' - - Item chance: '.$chance);
						
						if($randomChance <= $chance)
						{
							$item = $itemManager->GetItem($itemID);
							$kampfWinPM = '<img src="img/items/'.$item->GetImage().'.png" width="80px" height="80px"></img>
							Du hast 1x '.$item->GetName().' gewonnen.';
              $gotSomething = true;

							$itemID = $item->GetID();
              $statstype = 0;
              
              if($item->GetType() == 3 || $item->GetID() == 184)
                $statstype = rand(0,14);
              
              $upgrade = 0;
              $amount = 1;
              $this->AddDebugLog(' - - add Item: '.$item->GetName());
              $this->AddDebugLog(' - - - StatsType: '.$statstype);
              
							$player->AddItems($item,$item, $amount, $statstype, $upgrade);
              $wonItem = $itemID.'@'.$amount.'@'.$statstype;
							if($wonItems == '')
							{
								$wonItems = $wonItem;
							}
							else
							{
								$wonItems = $wonItems.';'.$wonItem;
							}
							
							$player->SetNPCWonItems($wonItems);
							$update = $update.',npcwonitems="'.$wonItems.'"';
						}
					}
					
					if($addzeni && $inGainAccs)
					{
						$maxZeniFights = 5;
            
            $zeniRate = rand(2,4);
            $zeniGain = 200 + (25 * $zeniRate);
            $zeniBonus = $player->GetLevel()*$zeniGain;
            
						if($dailyFights <= $maxZeniFights)
						{
              $this->AddDebugLog(' - - add Bonus Zeni: '.$zeniBonus);
							$zeni = $zeni + $zeniBonus;
              $gotSomething = true;
						}
					}
          
          
              
          if($this->GetType() == 5 && $gotSomething) //Event
          {
            $event = new Event($this->database, $this->GetEvent());
            
            if($event->GetDecreaseNPCFight())
            {
              $newDailyFights = $player->GetDailyNPCFights()+1;
              $this->AddDebugLog(' - - Previous DailyNPCFights: '.$player->GetDailyNPCFights());
              $this->AddDebugLog(' - - Set DailyNPCFights: '.$newDailyFights);
              
              $player->SetDailyNPCFights($newDailyFights);
              $player->UpdateDailyNPCFights();
            }
            else
            {
              $this->AddDebugLog(' - - Add to Finished Players');
              $event->AddFinishedPlayers($player->GetID());
            }
          }
					
					
					if($zeni != 0)
					{
             if($player->GetRace() == 'Mensch')
             {
               $zeni = $zeni * 1.1;
             }
						if($kampfWinPM != '')
						{
							$kampfWinPM = $kampfWinPM.' und ';
						}
						else
						{
							$kampfWinPM = 'Du hast ';
						}
						$kampfWinPM = $kampfWinPM.$zeni.' Zeni';
					}
					
					if($kampfWinPM != '')
					{
						$kampfWinPM = '<center>'.$kampfWinPM.' bekommen.</center>';
						$text = $kampfWinPM.'<br/>'.$text;
					}
					$PMManager->SendPM(0, 'img/battel2.png', 'SYSTEM', 'Kampf: '.$this->GetName(), $text, $player->GetName(), 1);
		      if($this->GetType() == 7) //Dragonball
          {
            $this->DebugSend(false);
          }
					
					
					if($zeni != 0)
					{
              $this->AddDebugLog(' - - add Zeni: '.$zeni);
							$zeni = $player->GetZeni() + $zeni;
              $this->AddDebugLog(' - - - Zeni now: '.$zeni);
							$player->SetZeni($zeni);
							$update = $update.', zeni="'.$zeni.'"';
					}
					
          $fightsTillStats = 10;
          $statsBonus = 10;
					if($addstats && $inGainAccs)
					{
						$maxStatsFights = $player->GetMaxStatsFights();
						$totalStatsFights = $player->GetTotalStatsFights() + 1;
						if($totalStatsFights <= $maxStatsFights)
						{
              $this->AddDebugLog(' - - Previous Statsfight: '.$player->GetTotalStatsFights());
              $this->AddDebugLog(' - - Set Statsfight: '.$totalStatsFights);
							$player->SetTotalStatsFights($totalStatsFights);
							$update = $update.', totalstatsfights="'.$totalStatsFights.'"';

							if($totalStatsFights % $fightsTillStats == 0)
							{
								$stats = $stats + $statsBonus;
							}
						}
					}
					
					if($stats != 0)
					{
							$update = $update.', statspopup="1"';
							$player->SetStatsPopup(true);
              $this->AddDebugLog(' - - Add Stats: '.$stats);
							$stats = $stats + $player->GetStats();
              $this->AddDebugLog(' - - Stats now: '.$stats);
							$player->SetStats($stats);
							$update = $update.', stats="'.$stats.'"';
					}
          
          if($this->GetType() != 0) // NO Spaß
          {
            $k = 0;
            while(isset($this->teams[$k]))
            {
              if($i == $k)
              {
                ++$k;
                continue;
              }
              foreach($this->teams[$k] as &$titleFighter)
              {
                if(!$titleFighter->IsNPC())
                  continue;

                $this->getTitelManager()->AddTitelNPC($player, 1, $titleFighter->GetNPC(), $this->GetType(), $titleSort);
              }
              ++$k;
            }
          }
          $this->getTitelManager()->AddTitelFight($player, 1, $this->GetType(), $titleSort);
          
					$result = $this->database->Update($update,'accounts','id = "'.$player->GetID().'"',1);
					
					++$j;
				}
				++$i;
			}
    
      $debuglog = $this->GetDebugLog();
	    $result = $this->database->Update('debuglog="'.$debuglog.'"','fights', 'id = "'.$this->GetID().'"',1);
	}
	
	private function UpdatePlayersData($wonTeam)
	{
		$lpkp = false;
		$addzeni = false;
		$addstats = false;
		$addstory = false;
		$eventFight = null;
		$npcDifficulty = 0;
    
		if($this->GetType() == 0) //Spaß
		{
		}
		else if($this->GetType() == 1) //Wertung
		{
			$lpkp = true;
			$addzeni = true;
			$addstats = true;
		}
		else if($this->GetType() == 2) //Tod
		{
			$lpkp = true;
		}
		else if($this->GetType() == 3) //NPC
		{
			$lpkp = true;
		}
		else if($this->GetType() == 4) //Story
		{
			$addstory = true;
			$lpkp = true;
		}
		else if($this->GetType() == 5) //Event
		{
    	$event = new Event($this->database, $this->GetEvent());
      $eventFight = $event->GetFight($this->GetEventFight()+1);
			$heal = $this->IsHealing();
			$lpkp = !$heal;
      $npcDifficulty = $event->GetDifficulty()/100;
			//End
			if($eventFight == null && $wonTeam == 0)
			{
				$this->SetZeni($event->GetZeni());
				$chance = rand(0,100);
				$items = explode(';',$event->GetItem());
				$i = 0;
				$itemArray = array();
				while(isset($items[$i]))
				{
					$item = array();
					$item[0] = $items[$i];
					$item[1] = $event->GetDropChance();
					array_push($itemArray, implode('@',$item));
					++$i;
				}
				$setItem = implode(';', $itemArray);
				$this->SetItems($setItem);
			}
		}
		else if($this->GetType() == 6) //Tournament
		{
    	$tournamentManager = new TournamentManager($this->database, $this->GetPlace(), $this->GetPlanet());
    	$tournament = $tournamentManager->GetTournamentByID($this->GetTournament());
			$pFighter = null;
			$pAlive = false;
			$pRound = 0;
			$pCell = 0;
			if($tournament->GetPlayerInfo($this->playerAccount, $pFighter, $pAlive, $pRound, $pCell))
			{
				if($this->player->GetTeam() == $wonTeam)
				{
					$tournament->MoveToNextBracket($pCell);
				}
				else if($pCell % 2 == 0)
				{
					$tournament->MoveToNextBracket($pCell+1);
				}
				else
				{
					$tournament->MoveToNextBracket($pCell-1);
				}
				$tournament->UpdateBrackets();
			}
		}
		else if($this->GetType() == 7) //Dragonball
		{
    $this->AddDebugLog('----------------------------');
    $this->AddDebugLog(' ');
    $this->AddDebugLog('Dragonball Fight');
    $this->AddDebugLog(' ');
			$where = '';
			$lpkp = true;
      
      $dragonballs = array();
      $previousAcc = 0;
      $result = $this->database->Select('id, player', 'dragonballs', 'player != 0', 999);
      if ($result) 
      {
        if ($result->num_rows > 0)
        {
          while($row = $result->fetch_assoc()) 
          {
            $dragonballs[$row['player']] = $row['id'];
            $this->AddDebugLog('Dragonball '.$row['id'].' is owned by player '.$row['player']);
          }
        }
        $result->close();
      }
      
      $wonTeamArray = $this->teams[$wonTeam];
      $wonPlayer = null;
			for($i = 0; $i < count($wonTeamArray); ++$i)
			{
					$wonPlayer = $wonTeamArray[$i];
          if($wonPlayer->GetLP() > 0)
            break;
      }
      
      $wonID = 0;
      if($wonPlayer != null)
			  $wonID = $wonPlayer->GetAcc();
      
      $whereDragonball = 'player="'.$wonID.'"';
      $whereWish = 'id="'.$wonID.'"';
      
			for($i = 0; $i < count($this->teams); ++$i)
			{
				if($i == $wonTeam)
				{
					continue;
				}
				$team = $this->teams[$i];
				for($j = 0; $j < count($team); ++$j)
				{
					$teamPlayer = $team[$j];
          $playerID = $teamPlayer->GetAcc();
          if(isset($dragonballs[$playerID]))
          {
            $this->AddDebugLog('Dragonball '.$dragonballs[$playerID].' is in fight and will be added to '.$wonID.'.');
            
            $whereDBString = 'player="'.$playerID.'"';
            $whereDragonball = $whereDragonball.' OR '.$whereDBString;
            
            $whereWishString = 'id="'.$playerID.'"';
            $whereWish = $whereWish.' OR '.$whereWishString;
          }
				}
			}
      
      $this->AddDebugLog(' ');
			$result = $this->database->Update('player="'.$wonID.'"','dragonballs',$whereDragonball,999);
      
      $dateTime = new DateTime();
      $dateTime->modify('+10 minutes');
      $timestamp = $dateTime->format('Y-m-d H:i:s');
      
			$result = $this->database->Update('wishlastfight="'.$timestamp.'"','accounts',$whereWish,999);
		}
    else if($this->GetType() == 8) //Arena
    {
			$where = '';
			
			for($i = 0; $i < count($this->teams); ++$i)
			{
				$team = $this->teams[$i];
				for($j = 0; $j < count($team); ++$j)
				{
					$teamPlayer = $team[$j];
					$whereString = 'fighter="'.$teamPlayer->GetAcc().'"';
					if($where == '')
					{
						$where = '('.$whereString;
					}
					else
					{
						$where = $where.' OR '.$whereString;
					}
				}
			}
			
			$where = $where.')';
			$result = $this->database->Update('infight=0','arenafighter',$where,2);
    }
		
		$this->UpdateAllPlayers($wonTeam, $lpkp, $addzeni, $addstats, $addstory);
		if($eventFight != null && $wonTeam == 0)
		{
      $npcs = $eventFight->GetNPCs();
      $players = count($this->teams[0]);
			$type = 5;
			$mode = $players.'vs'.count($npcs);
			$name = $this->GetName();
      $tournament=0;
      $dragonball=0;
      $npcid=0;
      $difficulty=0;
			$createdFight = Fight::CreateFight($this->playerAccount, $this->database, $type, $name, $mode, 0, $this->actionManager, 0, '', 0, 0, $eventFight->GetSurvivalTeam()
                                         ,$eventFight->GetSurvivalRounds(),$eventFight->GetSurvivalWinner(), $event->GetID(), $eventFight->IsHealing(), $this->GetEventFight()+1
                                         , $tournament, $dragonball, $npcid, $difficulty, $eventFight->GetHealthRatio(), $eventFight->GetHealthRatioTeam(), $eventFight->GetHealthRatioWinner());
      $createdFight->UpdateGainAcc($this->GetGainAccs());
      $i = 0;
			$team = 1;
      $npcDifficulty = round($players * $npcDifficulty);
      while($i != count($npcs))
      {
        $npc = new NPC($this->database, $npcs[$i], $npcDifficulty);
        $createdFight->Join($npc, $team, true);
        ++$i;
      }
			
			$i = 0;
			$groupString = $this->playerAccount->GetGroup();
			$group = $this->playerAccount->GetGroup();
			while(isset($group[$i]))
			{
				if($group[$i] != $this->playerAccount->GetID())
				{
					$groupPlayer = new Player($this->database, $group[$i], $this->actionManager);
        	$createdFight->Join($groupPlayer, 0, false);
				}
				++$i;
			}
			
			//header('Location: ?p=fight');
		}
	}
	
	private function CalculateRound()
	{
    $this->AddDebugLog('----------------------------');
    $this->AddDebugLog(' ');
    $this->AddDebugLog('New Round '.$this->GetRound());
		//presort attacks
		$this->defenseArray = array();
		
		$this->preAttacks = array();
		$this->attacks = array();
		$this->postAttacks = array();
    $i = 0;
		
    
    $teamAttacks = array();
    $singleAttacks = array();
    $tID = 0;
    $sID = 0;
    
    while(isset($this->teams[$i]))
    {
      $players = $this->teams[$i];
      $j = 0;
      while(isset($players[$j]))
      {
				$player = $players[$j];
				if($player->GetAction() == 0)
				{
					$j++;
					continue;
				}
        
          /*
        if($player->GetLP() != 0)
        {
          if($player->GetRace() == 'Freezer' && rand(0,100) <= 15)
          {
            $rTransAtkID = 295;
            $tIsAlready = false;
            foreach($teamAttacks as &$teamAttack)
            {
              if($teamAttack[0]->GetTeam() == $player->GetTeam())
              {
                $tIsAlready = true;
                break;
              }
            }
            if(!$tIsAlready)
            {
              $teamAttacks[$tID] = array($player, $rTransAtkID);
              ++$tID;
            }
          }
          else if($player->GetRace() == 'Demon' && $player->GetLP() == 1)
          {
            $rTransAtkID = 304;
            $singleAttacks[$sID] = array($player, $rTransAtkID);
            ++$sID;
          }
          else if($player->GetRace() == 'Kaioshin' && rand(0,100) <= 15)
          {
            $rTransAtkID = 294;
            $tIsAlready = false;
            foreach($teamAttacks as &$teamAttack)
            {
              if($teamAttack[0]->GetTeam() == $player->GetTeam())
              {
                $tIsAlready = true;
                break;
              }
            }
            if(!$tIsAlready)
            {
              $teamAttacks[$tID] = array($player, $rTransAtkID);
              ++$tID;
            }
          }
          else if($player->GetLP() <= ($player->GetMaxLP() * 0.2) && $player->GetRace() == 'Saiyajin' && rand(0,100) <= 10)
          {
            $rTransAtkID = 299;
            $rTrans = explode(';', $player->GetTransformations());
            if(!in_array($rTransAtkID, $rTrans))
            {
              $singleAttacks[$sID] = array($player, $rTransAtkID);
              ++$sID;
            }
          }
        }
        
        $oozaruID = 22;
        $rTrans = explode(';', $player->GetTransformations());
        if(in_array($oozaruID, $rTrans) && ($this->GetWeather() != 4 || $player->GetApeTail() != 3))
        {
            $player->SetAction($oozaruID);
        }
        else if(in_array($oozaruID, $rTrans) && $player->GetApeControl() == 0 && rand(0,1) == 0)
        {
            $player->SetAction(300); //randale
            //do Dots
            foreach($this->teams as &$team)
            {
              for($k = 0; $k < count($team); ++$k)
              {
                $fighter = &$team[$k];
                $rand = rand(1,4);
                if($fighter->GetLP() != 0 && $rand == 1)
                {
                  $player->SetTarget($fighter->GetID());
                }
              }
            }
        }
        else if($player->GetApeTail() == 3 && $this->GetWeather() == 4)
        {
          $pTrans = explode(';', $player->GetTransformations());
          if(!in_array($oozaruID, $pTrans))
            $player->SetAction($oozaruID);
        }
        */
        
				
				$attack = $this->GetAttack($player->GetAction());
				$target = $this->GetFighter($player->GetTarget());
				//Hotfix wenn target kapput ist
				if($target == null)
				{
					$target = $player;
				}
				
				$attackEntry = array();
				$attackEntry[0] = $player;
				$attackEntry[1] = $target;
				$attackEntry[2] = $attack;
				
				if($attack->GetType() == 1) // Damage
				{
					array_push($this->attacks, $attackEntry);
				}
				else if($attack->GetType() == 2) // Defense
				{
					array_push($this->preAttacks, $attackEntry);
				}
				else if($attack->GetType() == 3) // Tod
				{
					array_push($this->attacks, $attackEntry);
				}
				else if($attack->GetType() == 4) // Transformation
				{
					array_push($this->preAttacks, $attackEntry);
				}
				else if($attack->GetType() == 5) // Heal
				{
					array_push($this->preAttacks, $attackEntry);
				}
				else if($attack->GetType() == 6) // Load-Damage
				{
					array_push($this->attacks, $attackEntry);
				}
				else if($attack->GetType() == 7) // Load
				{
					array_push($this->preAttacks, $attackEntry);
				}
				else if($attack->GetType() == 8) // NPC-Spawn
				{
					array_push($this->postAttacks, $attackEntry);
				}
				else if($attack->GetType() == 9) // Paralyze
				{
					array_push($this->attacks, $attackEntry);
				}
				else if($attack->GetType() == 10) // Paralyzed
				{
					array_push($this->postAttacks, $attackEntry);
				}
				else if($attack->GetType() == 11) // Self-Heal
				{
					array_push($this->preAttacks, $attackEntry);
				}
				else if($attack->GetType() == 12) // Heal-Attack
				{
					array_push($this->attacks, $attackEntry);
				}
				else if($attack->GetType() == 13) // Fusion
				{
					array_push($this->postAttacks, $attackEntry);
				}
				else if($attack->GetType() == 14) // Wetter
				{
					array_push($this->postAttacks, $attackEntry);
				}
				else if($attack->GetType() == 15) // Sonstiges
				{
					array_push($this->attacks, $attackEntry);
				}
				else if($attack->GetType() == 16) // Aufgeben
				{
					array_push($this->postAttacks, $attackEntry);
				}
				else if($attack->GetType() == 17) // Beleben
				{
					array_push($this->postAttacks, $attackEntry);
				}
				else if($attack->GetType() == 18) // Buffs
				{
					array_push($this->preAttacks, $attackEntry);
				}
				else if($attack->GetType() == 19) // UnParalyze
				{
					array_push($this->preAttacks, $attackEntry);
				}
				else if($attack->GetType() == 20) // Reflect
				{
					array_push($this->preAttacks, $attackEntry);
				}
				else if($attack->GetType() == 21) // Taunt
				{
					array_push($this->preAttacks, $attackEntry);
				}
				else if($attack->GetType() == 22) // Dots
				{
					array_push($this->attacks, $attackEntry);
				}
        $j++;
      }
      ++$i;
    }
		
		$i = 0;
		$roundText = '<tr><td align=center colspan=4><h2>Runde '.$this->GetRound().'</h2></td></tr>';
		$imageLeft = true;
		$attackTexts = '';
    
    foreach($singleAttacks as &$singleAttack)
    {
      $rPlayer = $singleAttack[0];
      $rPlayerTeam = $rPlayer->GetTeam();
      $rAttack = $this->GetAttack($singleAttack[1]);
      $rText = '';
      if($singleAttack[1] == 304) //HellBoost Demon
      {
        $rText = $this->Buff($rPlayer, $rPlayer, $rAttack);
      }
      else if($singleAttack[1] == 299) //Saiyajin Power
      {
        $rText = $this->Transform($rPlayer, $rAttack);
      }
      $rText = $this->ReplaceTextValues($rText, $rPlayer, null, 0, '');
      $rText = $this->DisplayAttackText($rAttack->GetImage(), $rText, $imageLeft);
			$attackTexts = $attackTexts.$rText;
      $imageLeft = !$imageLeft;
    }
    
    foreach($teamAttacks as &$teamAttack)
    {
      $rPlayer = $teamAttack[0];
      $rPlayerTeam = $rPlayer->GetTeam();
      $rAttack = $this->GetAttack($teamAttack[1]);
      $rText = '';
      if($teamAttack[1] == 295) //Angst Freezer
      {
        for($i = 0; $i < count($this->teams); ++$i)
        {
          if($i != $rPlayerTeam)
          {
            $rTeam = $this->teams[$i];
            for($i = 0; $i < count($rTeam); ++$i)
            {
              $rFighter = &$rTeam[$i];
              $rText = $this->Buff($rPlayer, $rFighter, $rAttack);
            }
          }
        }
      }
      else if($teamAttack[1] == 294) //Telepathy Kaioshin
      {
        $rTeam = $this->teams[$rPlayerTeam];
        for($i = 0; $i < count($rTeam); ++$i)
        {
				  $rFighter = &$rTeam[$i];
          $rText = $this->Buff($rPlayer, $rFighter, $rAttack);
        }
      }
      $rText = $this->ReplaceTextValues($rText, $rPlayer, null, 0, '');
      $rText = $this->DisplayAttackText($rAttack->GetImage(), $rText, $imageLeft);
			$attackTexts = $attackTexts.$rText;
      $imageLeft = !$imageLeft;
    }
    
    $teamTaunts = array();
    
		//do Taunt
		for($ti =0; $ti < count($this->teams); ++$ti)
		{
      $team = &$this->teams[$ti];
			for($i = 0; $i < count($team); ++$i)
			{
				$iFighter = &$team[$i];
        if($iFighter->GetLP() == 0 || $iFighter->GetTaunt() == 0)
          continue;
        
        $this->AddDebugLog('Taunt of '.$iFighter->GetName().' is '.$iFighter->GetTaunt());
        
        $newTaunt = true;
        if(isset($teamTaunts[$ti]))
        {
          if($teamTaunts[$ti]->GetTaunt() > $iFighter->GetTaunt())
            $newTaunt = false;
        }
        
        if($newTaunt)
        {
          $this->AddDebugLog('Set Taunt of Team '.$ti.' to '.$iFighter->GetName());
          $teamTaunts[$ti] = $iFighter;
        }
			}
		}
    
    $i = 0;
		while(isset($this->preAttacks[$i]))
		{
			$attack = $this->preAttacks[$i];
      
      $attackFighter = $attack[0];      
      
			$attackText = $this->CalculateAndGetText($attack, $imageLeft);
        
      if($attackFighter->GetTaunt() != 0)
      {
        $this->AddDebugLog($attackFighter->GetName().' Taunt is: '.$attackFighter->GetTaunt());
        $attackTeam = $attackFighter->GetTeam();
        $newTaunt = true;
        if(isset($teamTaunts[$attackTeam]))
        {
          if($teamTaunts[$attackTeam]->GetTaunt() > $attackFighter->GetTaunt())
            $newTaunt = false;
        }
        
        if($newTaunt)
        {
          $this->AddDebugLog('Set Taunt of Team '.$attackTeam.' to '.$attackFighter->GetName());
          $teamTaunts[$attackTeam] = $attackFighter;
        }
      }
      
			$imageLeft = !$imageLeft;
			$attackTexts = $attackTexts.$attackText;
			++$i;
		}
		
		$i = 0;
		while(isset($this->attacks[$i]))
		{
			$attack = $this->attacks[$i];
      
      $enemyPlayer = $attack[0];
      $enemyTarget = $attack[1];
      
      if(isset($teamTaunts[$enemyTarget->GetTeam()]))
      {
        $tauntPlayer = &$teamTaunts[$enemyTarget->GetTeam()];
        $this->AddDebugLog('Taunt exists for Team '.$enemyTarget->GetTeam().' which is '.$tauntPlayer->GetName());
        $miss = rand(0,100);
        $hit = ($enemyPlayer->GetAccuracy() / $tauntPlayer->GetReflex()) * 100;
        if($hit >= $miss)
        {
          $this->AddDebugLog('Changing Target of '.$enemyPlayer->GetName().' to '.$tauntPlayer->GetName());
          $attack[1] = $tauntPlayer;
        }
      }
      
			$attackText = $this->CalculateAndGetText($attack, $imageLeft);
			$imageLeft = !$imageLeft;
			$attackTexts = $attackTexts.$attackText;
			++$i;
		}
		
		$i = 0;
		while(isset($this->postAttacks[$i]))
		{
			$attack = $this->postAttacks[$i];
			$attackText = $this->CalculateAndGetText($attack, $imageLeft);
			$imageLeft = !$imageLeft;
			$attackTexts = $attackTexts.$attackText;
			++$i;
		}
    
    
    //Do DOTS DMG
		for($ti =0; $ti < count($this->teams); ++$ti)
		{
      $team = &$this->teams[$ti];
			for($i = 0; $i < count($team); ++$i)
			{
				$iFighter = &$team[$i];
        if($iFighter->GetLP() == 0 || $iFighter->GetDots() == '')
          continue;
        
				$attackText = $this->DoDotsDmg($iFighter, $imageLeft);
        $imageLeft = !$imageLeft;
			  $attackTexts = $attackTexts.$attackText;
			}
		}
    
    
		$i = 0;
		while(isset($this->defenseArray[$i]))
		{
			$attackData = $this->defenseArray[$i];
			$attackPlayer = $attackData[0];
			$attack = $attackData[1];
      
      $defenseValue = $attackPlayer->GetDefense();
      $reflectValue = $attackPlayer->GetReflect();

      if($attack->GetDefValue() != 0)
        $defenseValue = $attackPlayer->GetDefense() / ($attack->GetValue() * $attack->GetDefValue()/100);
      if($attack->GetReflectValue() != 0)
        $reflectValue = $attackPlayer->GetReflect() - ($attack->GetValue() * $attack->GetReflectValue()/100);
      
			$attackPlayer->SetDefense($defenseValue);
			$attackPlayer->SetReflect($reflectValue);
			++$i;
		}
    
		//revert all buffs
		foreach($this->teams as &$team)
		{
			for($i = 0; $i < count($team); ++$i)
			{
				$fighter = &$team[$i];
				if($fighter->GetLP() != 0 && $fighter->GetBuffs() != '')
				{
					$this->DoBuffCost($fighter);
				}
				if($fighter->GetLP() != 0 && $fighter->GetDots() != '')
				{
					$this->DoDotsCost($fighter);
				}
				if($fighter->GetLP() == 0 && $fighter->GetTransformations() != '')
        {
					$this->Revert($fighter, true);
				}
			}
		}
    
		
		$this->RemoveFusions();
		$wonTeam = $this->CheckForWonTeam();
		
		if($wonTeam != -1)
		{
      $this->AddDebugLog(' A Team won: '.$wonTeam);
			$wonTeamText = '';
			if($wonTeam == -2)
			{
				$wonTeamText = 'Kein Team hat gewonnen.';
			}
			else
			{
				$wonTeamText = '<b><font color='.$this->GetTeamColor($wonTeam).'>Team '.($wonTeam+1).'</font></b> hat den Kampf gewonnen!';
			}
			$roundText = $roundText.'<tr><td align=center colspan=4>'.$wonTeamText.'</td></tr>';
		}
		$roundText = $roundText.$attackTexts;
		
		$newText = $this->database->EscapeString($roundText.$this->GetText());
		$this->SetText($newText);
		
		if($wonTeam != -1)
		{
      $this->AddDebugLog('End Fight');
		  $this->RemoveFusions(true);
			$this->UpdatePlayersData($wonTeam);
			$this->RemoveNPCSpawns();
				
			$result = $this->database->Delete('fighters','fight = "'.$this->GetID().'"',999);
			$this->SetState(2);
		}
		else
		{
    	$timestamp = date('Y-m-d H:i:s');
			$result = $this->database->Update('action="0", target="0", lastaction="'.$timestamp.'"','fighters','fight = "'.$this->GetID().'" AND paralyzed=0 AND loadrounds="0"',999);
			$this->ResetActions();
			$this->SetRound($this->GetRound()+1);
		}
    
    $this->AddDebugLog(' Round End ');
    $this->AddDebugLog('----------------------------');
    $this->AddDebugLog(' ');
    
		$result = $this->database->Update('text="'.$newText.'",round="'.$this->GetRound().'",state="'.$this->GetState().'"','fights','id = "'.$this->GetID().'"',1);
	}
	
	private function RemoveFusions($force = false)
	{
		$deletes = array();
		
		$inactives = array();
		$inactivesID = array();
    $i = 0;
    while(isset($this->teams[$i]))
    {
      $players = $this->teams[$i];
      $j = 0;
      while(isset($players[$j]))
      {
				$player = $players[$j];
				if(!$player->IsInactive())
				{
					$j++;
					continue;
				}
				array_push($inactives, $player);
				array_push($inactivesID, $player->GetAcc());
				++$j;
			}
			++$i;
		}
		
    $i = 0;
    while(isset($this->teams[$i]))
    {
      $players = $this->teams[$i];
      $j = 0;
      while(isset($players[$j]))
      {
				$player = $players[$j];
        
				if($player->GetFusedAcc() != 0 && !$force && $player->GetLP() != 0 && $player->GetFuseTimer() != 0)
				{
          $fuseTimer = $player->GetFuseTimer();
          if($fuseTimer > 0)
          {
            $fuseTimer = $fuseTimer-1;
            $player->SetFuseTimer($fuseTimer);
		        $result = $this->database->Update('fusetimer="'.$fuseTimer.'"','fighters','id="'.$player->GetID().'"',1);
          }
          
					$searchID = array_search($player->GetAcc(), $inactivesID);
					array_splice($inactivesID, $searchID, 1);
					array_splice($inactives, $searchID, 1);
					
					$searchID = array_search($player->GetFusedAcc(), $inactivesID);
					array_splice($inactivesID, $searchID, 1);
					array_splice($inactives, $searchID, 1);
					$j++;
					continue;
				}
				else if($player->GetFusedAcc() == 0)
				{
					$j++;
					continue;
				}
				
				array_push($deletes, $player);
				
				++$j;
			}
			++$i;
		}
		if(count($deletes) == 0)
		{
			return;
		}

    
    $lpPercentage = 0;
    $kpPercentage = 0;
		$deleteWhere = '';
		for($i = 0; $i < count($deletes); ++$i)
		{
      $deleteID = $deletes[$i]->GetID();
			$deleteStr = 'id="'.$deleteID.'"';
			if($deleteWhere == '')
			{
				$deleteWhere = $deleteStr;
			}
			else
			{
				$deleteWhere = $deleteWhere.' OR '.$deleteStr;
			}
      $lpPercentage = $deletes[$i]->GetLPPercentage();
      $kpPercentage = $deletes[$i]->GetKPPercentage();
			$this->RemoveFighter($deleteID, true);
		}
    
    $lpPercentage = ($lpPercentage/100);
    $kpPercentage = ($kpPercentage/100);
		
		for($i = 0; $i < count($inactives); ++$i)
		{
			$inactives[$i]->SetInactive(false);
      $lp = $inactives[$i]->GetMaxLP() * $lpPercentage;
      $kp = $inactives[$i]->GetMaxKP() * $kpPercentage;
			$inactives[$i]->SetLP($lp);
			$inactives[$i]->SetKP($kp);
		  $result = $this->database->Update('inactive="0",lp="'.$lp.'",kp="'.$kp.'"','fighters','id="'.$inactives[$i]->GetID().'"', 1000);
		}
		
		$result = $this->database->Delete('fighters',$deleteWhere,count($deletes));
	}
	
	private function TeamHasLoadAttack($player, $team, $loadAttack)
	{
		$team = $player->GetTeam();
		$j = 0;
		$teamMembers = $this->teams[$team];
		while(isset($teamMembers[$j]))
		{
			$teamMember = $teamMembers[$j];
			if($player->GetID() != $teamMember->GetID() && $teamMember->GetLoadAttack() == $loadAttack)
			{
				return true;
			}
			++$j;
		}
		return false;
	}
  
	private function DoDotsDmg(&$fighter, $imageLeft)
	{
		//Berechne die Kosten der VWs
		$dots = explode(';',$fighter->GetDots());
		foreach($dots as &$dot)
		{
			$dotData = explode('@',$dot);
			$dotUser = $dotData[0];
			$dotID = $dotData[1];
			$dotRound = $dotData[2];
		
			$dotAtk = $this->GetAttack($dotID);
			$dotCaster = $this->GetFighter($dotUser);
      
		
      if($dotAtk->IsProcentual())
      {
        $atkVal = $dotCaster->GetKI() * ($dotAtk->GetValue() / 100);
        if(abs($atkVal) < abs($dotAtk->GetMinValue()))
        {
          $atkVal = $dotAtk->GetMinValue();
        }
      }
      else
      {
        $atkVal = $dotAtk->GetValue();
      }
      
      $damage = 0;
      
      $lpDamage = round($atkVal * ($dotAtk->GetLPValue()/100));
      $newLP = $fighter->GetLP() + $lpDamage;
      $damage += $lpDamage;
      if($newLP < 0)
        $newLP = 0;
      else if($fighter->GetLP() > $fighter->GetIncreasedLP() && $lpDamage > 0)
        $newLP = $fighter->GetLP();
      else if($newLP > $fighter->GetIncreasedLP()) 
        $newLP = $fighter->GetIncreasedLP();
      
      $kpDamage = round($atkVal * ($dotAtk->GetKPValue()/100));
      $newKP = $fighter->GetKP() + $kpDamage;
      $damage += $kpDamage;
      if($newKP < 0)
        $newKP = 0;
      else if($fighter->GetKP() > $fighter->GetIncreasedKP() && $kpDamage > 0)
        $newKP = $fighter->GetKP();
      else if($newKP > $fighter->GetIncreasedKP()) 
        $newKP = $fighter->GetIncreasedKP();
      
      
      $epDamage = round($atkVal * ($dotAtk->GetEPValue()/100));
      $newEP = $fighter->GetEnergy() + $epDamage;
      $damage += $epDamage;
      if($newEP < 0)
        $newEP = 0;
      else if($fighter->GetEnergy() > $fighter->GetMaxEnergy() && $epDamage > 0)
        $newEP = $fighter->GetEnergy();
      else if($newEP > $fighter->GetMaxEnergy()) 
        $newEP = $fighter->GetMaxEnergy();
      
			$fighter->SetLP($newLP);
			$fighter->SetKP($newKP);
			$fighter->SetEnergy($newEP);
			$result = $this->database->Update('lp="'.$newLP.'",kp="'.$newKP.'",energy="'.$newEP.'"','fighters','id = "'.$fighter->GetID().'"',1);
      
      $type = '';
			$attackImage = $dotAtk->GetImage();
      $calculatedText = $dotAtk->GetLoadText();
      if($damage < 0)
        $damage = -$damage;
      $calculatedText = $this->ReplaceTextValues($calculatedText, $dotCaster, $fighter, $damage, $type);
      return $this->DisplayAttackText($attackImage, $calculatedText, $imageLeft);
		}
    return '';
	}
  
	private function DoDotsCost(&$fighter)
	{
		//Berechne die Kosten der VWs
		$dots = explode(';',$fighter->GetDots());
		foreach($dots as &$dot)
		{
			$dotData = explode('@',$dot);
			$dotUser = $dotData[0];
			$dotID = $dotData[1];
			$dotRound = $dotData[2];
		
			$dotAtk = $this->GetAttack($dotID);
			$dotCaster = $this->GetFighter($dotUser);
			if($dotCaster == null)
			{
				$this->ReverseDots($fighter, $dotAtk);
				continue;
			}
			
      $cost = $this->CalculateCost($dotAtk->GetKP(), $dotAtk->IsCostProcentual(), $dotCaster->GetKI(), $dotCaster->GetRace());
			$kp = $dotCaster->GetKP() - $cost;
			if($kp < 0)
			{
				$kp = 0;
			}
			$dotCaster->SetKP($kp);
			$result = $this->database->Update('kp="'.$kp.'"','fighters','id = "'.$dotCaster->GetID().'"',1);
			
			if($kp == 0 || $dotRound == 0)
			{
				$this->ReverseDots($fighter, $dotAtk);
			}
		}
		
    $dots = $fighter->GetDots();
		if($dots != '')
		{
      $dots = explode(';',$dots);

      $newDots = array();
      foreach($dots as &$dot)
      {
        $dotData = explode('@',$dot);
        $dotData[2]--;
        array_push($newDots, implode('@',$dotData));
      }
      $fighter->SetDots(implode(';', $newDots));
    }
    
		$result = $this->database->Update('dots="'.$fighter->GetDots().'"','fighters','id = "'.$fighter->GetID().'"',1);
	}

	private function DoBuffCost(&$fighter)
	{
        $this->AddDebugLog(' - DoBuffCost of: '.$fighter->GetName());
		//Berechne die Kosten der VWs
		$buffs = explode(';',$fighter->GetBuffs());
		foreach($buffs as &$buff)
		{
			$buffData = explode('@',$buff);
			$buffUser = $buffData[0];
			$buffID = $buffData[1];
			$buffRound = $buffData[2];
		
			$buffAtk = $this->GetAttack($buffID);
        $this->AddDebugLog(' - - Check Buff: '.$buffAtk->GetName().' ('.$buffID.')');
			$buffCaster = $this->GetFighter($buffUser);
			if($buffCaster == null)
			{
        $this->AddDebugLog(' - - ReverseBuff because of no caster');
				$this->ReverseBuff($fighter, $buffAtk);
				continue;
			}
        $this->AddDebugLog(' - - Caster: '.$buffCaster->GetName());
			
      $cost = $this->CalculateCost($buffAtk->GetKP(), $buffAtk->IsCostProcentual(), $buffCaster->GetKI(), $buffCaster->GetRace());
			$kp = $buffCaster->GetKP() - $cost;
			if($kp < 0)
			{
				$kp = 0;
			}
			$buffCaster->SetKP($kp);
			$result = $this->database->Update('kp="'.$kp.'"','fighters','id = "'.$buffCaster->GetID().'"',1);
			
			if($kp == 0 || $buffRound == 0)
			{
        $this->AddDebugLog(' - - ReverseBuff because round ('.$buffRound.') or kp ('.$kp.') is 0');
				$this->ReverseBuff($fighter, $buffAtk);
			}
		}
		
    $buffs = $fighter->GetBuffs();
    $this->AddDebugLog(' - - Previous Buffs of: '.$fighter->GetName().': '.$buffs);
		if($buffs != '')
		{
      $buffs = explode(';',$buffs);

      $newBuffs = array();
      foreach($buffs as &$buff)
      {
        $buffData = explode('@',$buff);
        $this->AddDebugLog(' - - - check buff: '.$buffData[1]);
        $this->AddDebugLog(' - - - decrease round: '.$buffData[2]);
        $buffData[2]--;
        $this->AddDebugLog(' - - - new round: '.$buffData[2]);
        array_push($newBuffs, implode('@',$buffData));
      }
      $fighter->SetBuffs(implode(';', $newBuffs));
    }
    
    $this->AddDebugLog(' - - Update Buffs to: '.$fighter->GetBuffs());
		$result = $this->database->Update('buffs="'.$fighter->GetBuffs().'"','fighters','id = "'.$fighter->GetID().'"',1);
	}
	
	private function CalculateAttack($player, $target, $attack)
	{
		//Deal Damage
		$damage = 0;
		$type = '';
		$text = '';
		
		$died = false;
		$lpminus = 0;
		$kpminus = 0;
		$removeLoadAttack = false;
      
      $this->AddDebugLog('Calculate Attack '.$attack->GetName().' of '.$player->GetName().' on '.$target->GetName());
		
		
		if($player->GetLoadAttack() != 0)
		{
			$loadAttack = $this->GetAttack($player->GetLoadAttack());
			if($loadAttack->GetLoadAttack() != $attack->GetID())
			{
				$team = $player->GetTeam();
				if(!$this->TeamHasLoadAttack($player, $team, $loadAttack->GetID()))
				{
					$j = 0;
					$teamMembers = $this->teams[$team];
					while(isset($teamMembers[$j]))
					{
						$teamMember = $teamMembers[$j];
						$teamMember->RemoveAttack($loadAttack->GetLoadAttack());
						$result = $this->database->Update('attacks="'.$teamMember->GetAttacks().'"','fighters','id = "'.$teamMember->GetID().'"',1);
						++$j;
					}
					$removeLoadAttack = true;
				}
			}
		}
		$loadRounds = $player->GetLoadRounds();
		if($loadRounds != 0)
		{
			$loadRounds = $loadRounds-1;
			$result = $this->database->Update('loadrounds="'.$loadRounds.'"','fighters','id = "'.$player->GetID().'"',1);
			$player->SetLoadRounds($loadRounds);
		}
		
		if($loadRounds != 0)
		{
			$text = $attack->GetLoadText();
		}
		else if($attack->GetBlockAttack() != 0 && $attack->GetBlockAttack() == $target->GetAction())
		{
			$text = $attack->GetMissText();
		}
		else if($attack->GetBlockedAttack() != 0 && $attack->GetBlockedAttack() != $target->GetAction())
		{
			$text = $attack->GetMissText();
		}
		else if($attack->GetType() == 1)
		{
			$alive = $target->GetLP() != 0;
			$text = $this->DealDamage($player, $target, $attack, $damage, $type, true);
			if($alive && $target->GetLP() == 0 && $this->GetType() == 2)
			{
				$died = true;
			}
		}
		else if($attack->GetType() == 2)
		{
			$text = $this->Defend($player, $attack);
		}
		else if($attack->GetType() == 3)
		{
			$alive = $target->GetLP() != 0;
      $killed = false;
			$text = $this->Kill($player, $target, $attack, $killed, $damage);
        
			if($alive && $killed && $this->GetType() != 0)
			{
				$died = true;
			}
		}
		else if($attack->GetType() == 4)
		{
			$text = $this->Transform($player, $attack);
			
		}
		else if($attack->GetType() == 5)
		{
			$text = $this->Heal($player, $target, $attack, $damage, $type);
		}
		else if($attack->GetType() == 6)
		{
			$alive = $target->GetLP() != 0;
			$text = $this->LoadDamage($player, $target, $attack, $damage, $type);
			if($alive && $target->GetLP() == 0 && $this->GetType() == 2)
			{
				$died = true;
			}
		}
		else if($attack->GetType() == 7)
		{
			$alive = $target->GetLP() != 0;
			if($attack->GetLoadAttack() == $player->GetLoadAttack())
			{
				$target = $player;
			}
			$text = $this->LoadAttack($player, $target, $attack);
		}
		else if($attack->GetType() == 8)
		{
			$text = $this->SpawnNPC($player, $attack);
		}
		else if($attack->GetType() == 9)
		{
			$text = $this->Paralyze($player, $target, $attack);
		}
		else if($attack->GetType() == 10)
		{
			$text = $this->DeParalyze($player, $attack);
		}
		else if($attack->GetType() == 11)
		{
			$text = $this->SelfHeal($player, $attack, $damage, $type);
		}
		else if($attack->GetType() == 12)
		{
			$alive = $target->GetLP() != 0;
			$text = $this->DealDamage($player, $target, $attack, $damage, $type, false);
			if($alive && $target->GetLP() == 0 && $this->GetType() == 2)
			{
				$died = true;
			}
      if($player->GetLP() != 0)
			  $this->AbsoluteHeal($player, $damage, $attack);
		}
		else if($attack->GetType() == 13)
		{
			$text = $this->Fuse($player, $target, $attack);
		}
		else if($attack->GetType() == 14)
		{
			$text = $this->ChangeWeather($player, $attack);
		}
		else if($attack->GetType() == 15)
		{
			$text = $this->DoMiscAttacks($player, $target, $attack);
		}
		else if($attack->GetType() == 16)
		{
			$text = $this->DoGiveUP($player, $attack);
		}
		else if($attack->GetType() == 17)
		{
			$text = $this->Revive($player, $target, $attack, $damage);	
		}
		else if($attack->GetType() == 18)
		{
			$text = $this->Buff($player, $target, $attack);	
		}
		else if($attack->GetType() == 19)
		{
			$text = $this->UnParalyze($player, $target, $attack);
		}
		else if($attack->GetType() == 20)
		{
			$text = $this->Defend($player, $attack);
		}
		else if($attack->GetType() == 21)
		{
			$text = $this->Buff($player, $player, $attack);
		}
		else if($attack->GetType() == 22)
		{
			$text = $this->Dots($player, $target, $attack);
		}
    
		if($attack->GetType() != 4 && $attack->GetType() != 21 && $attack->GetType() != 22)
    {
      $lpminus = $this->CalculateCost($attack->GetLP(), $attack->IsCostProcentual(), $player->GetKI(), $player->GetRace());
      $kpminus = $this->CalculateCost($attack->GetKP(), $attack->IsCostProcentual(), $player->GetKI(), $player->GetRace());
		}
    
    $energyMinusConstant = 10;
    
    $energyMinus = $attack->GetEnergy() - $energyMinusConstant;
		
    /*
		if($attack->GetItem() != 0)
		{
			$inventory = $player->GetInventory();
			$item = $attack->GetItem();
			$inventory->RemoveItemsByID($item, 1);
			if(!$inventory->HasItem($item))
			{
				$player->RemoveAttack($attack->GetID());
			}
			$result = $this->database->Update('inventory="'.$inventory->Encode().'"','fighters','id = "'.$player->GetID().'"',1);
		}
    */
		
		if($removeLoadAttack)
		{
			$player->SetLoadAttack(0);
			$result = $this->database->Update('loadattack="0"','fighters','id = "'.$player->GetID().'"',1);
		}
		
		$trans = array_filter(explode(';',$player->GetTransformations()));
		$i = 0;
		
		$revertKP = false;
		$revertLP = false;
		while(isset($trans[$i]))
		{
			$transAttack = $this->GetAttack($trans[$i]);
      if($transAttack->GetLP() != 0)
      {
        $cost = $this->CalculateCost($transAttack->GetLP(), $transAttack->IsCostProcentual(), $player->GetKI(), $player->GetRace());
        $lpminus += $cost;
        $revertLP = true;
      }
      if($transAttack->GetKP() != 0)
      {
        $cost = $this->CalculateCost($transAttack->GetKP(), $transAttack->IsCostProcentual(), $player->GetKI(), $player->GetRace());
        $kpminus += $cost;
        $revertKP = true;
      }
			++$i;
		}
		
		$reverts = false;
    
    /*
    if($player->GetRace() == 'Android' && rand(0,1) == 0 && $player->GetKP() < $player->GetMaxKP())
    {
      $kpIncrease = round($player->GetMaxKP() * 0.01);
      if($kpIncrease < 0) $kpIncrease = 1;
      $kpminus -= $kpIncrease;
      $text = $text.'<br/>!source regeneriert KP.';
    }
    else if($player->GetRace() == 'Namekianer' && rand(0,100) <= 15)
    {
      $team = $player->GetTeam();
      $j = 0;
      $teamMembers = $this->teams[$team];
      while(isset($teamMembers[$j]))
      {
        $teamMember = $teamMembers[$j];
        if($teamMember->GetLP() > 0 && $teamMember->GetLP() < $teamMember->GetMaxLP())
        {
          $lpIncrease = $teamMember->GetMaxLP() * 0.01;
          $pLP = round($teamMember->GetLP()+$lpIncrease);
          if($pLP > $teamMember->GetMaxLP()) $pLP = $teamMember->GetMaxLP();
          $teamMember->SetLP($pLP);
				  $result = $this->database->Update('lp="'.$pLP.'"','fighters','id = "'.$teamMember->GetID().'"',1);
        }
        ++$j;
      }
      $text = $text.'<br/>!source heilt die LP aller Teammitglieder.';
    }
    */
    
    
		if($kpminus != 0)
		{
			$kp = $player->GetKP() - $kpminus;
      
			if($kp < 0) $kp = 0;
      else if($player->GetKP() <= $player->GetIncreasedKP() && $kp > $player->GetIncreasedKP()) $kp = $player->GetIncreasedKP();
			$player->SetKP($kp);
			if($revertKP && $kp == 0)
			{
				$reverts = true;
			}
		}
		if($lpminus != 0)
		{
			$lp = $player->GetLP() - $lpminus;
			if($lp < 0) $lp = 0;
      else if($player->GetLP() <= $player->GetIncreasedLP() && $lp > $player->GetIncreasedLP()) $lp = $player->GetIncreasedLP();
			$player->SetLP($lp);
			if($revertLP && $lp == 0)
			{
				$reverts = true;
			}
		}
    
    $energy = $player->GetEnergy() + $energyMinus;
    if($energy < 0)
      $energy = 0;
		else if($energy >= $player->GetMaxEnergy()) 
      $energy = $player->GetMaxEnergy();
    $player->SetEnergy($energy);
		
		if($reverts)
		{
				$this->Revert($player);
		}
		else
		{
      $update = '';
			if($kpminus != 0)
			{
        $updateVal = 'kp="'.$player->GetKP().'"';
        if($update != '')
        {
          $update = $update.', '.$updateVal;
        }
        else
        {
          $update = $updateVal;
        }
			}
			if($lpminus != 0)
			{
        $updateVal = 'lp="'.$player->GetLP().'"';
        if($update != '')
        {
          $update = $update.', '.$updateVal;
        }
        else
        {
          $update = $updateVal;
        }
			}
      
      $updateVal = 'energy="'.$player->GetEnergy().'"';
      if($update != '')
      {
        $update = $update.', '.$updateVal;
      }
      else
      {
        $update = $updateVal;
      }
      
      if($update != '')
      {
				$result = $this->database->Update($update,'fighters','id = "'.$player->GetID().'"',1);
      }
		}
		
    $text = $this->ReplaceTextValues($text, $player, $target, $damage, $type);
		
		if($died)
		{
			$planet = 'Jenseits';	
			$place = 'Check-In Station';	
			$deadPlayer = null;
			if($this->playerAccount != null && $target->GetAcc() == $this->playerAccount->GetID())
			{
				$deadPlayer = $this->playerAccount;
			}
			else
			{
				$deadPlayer = new Player($this->database, $target->GetAcc(), $this->actionManager);
			}
			if($deadPlayer->GetAction() != 0)
			{
				$deadPlayer->CancelAction(true); //force it
			}
      if($deadPlayer->GetPlanet() != 'Jenseits')
      {
        if($this->GetType() != 7)
        {
			    $result = $this->database->Update('player="0", place="'.$deadPlayer->GetPlace().'"','dragonballs','player="'.$deadPlayer->GetID().'"',999);
        }
        
        $deadPlayer->SetPlanet($planet);
        $deadPlayer->SetPlace($place);
        $timestamp = date('Y-m-d H:i:s');
        $result = $this->database->Update('deathplace=place, deathplanet=planet, deathtime= "'.$timestamp.'", place="'.$place.'", planet="'.$planet.'"','accounts','id = "'.$target->GetAcc().'"',1);
      }
		}
		
		return $text;
	}
  
  private function ReplaceTextValues($text, $player, $target, $damage, $type)
  {
    if($player != null)
		  $playerText = '<b><font color='.$this->GetTeamColor($player->GetTeam()).'>'.$player->GetName().'</font></b>';
    else
      $playerText = '';
    
    if($target != null)
		  $targetText = '<b><font color='.$this->GetTeamColor($target->GetTeam()).'>'.$target->GetName().'</font></b>';
    else
      $targetText = '';
    
		$damageText = '<b>'.$damage.'</b>';
		$typeText = '<b>'.$type.'</b>';
		$text = str_replace('!source',$playerText,$text);
		$text = str_replace('!target',$targetText,$text);
		$text = str_replace('!damage',$damageText,$text);
		$text = str_replace('!type',$typeText,$text);
    
    return $text;
  }
	
	private function ChangeWeather($player, $attack)
	{
		$miss = rand(0,100);
		$hit = $attack->GetAccuracy();
		
		if($hit < $miss)
		{
			return $attack->GetMissText();
		}
    
		$this->SetWeather($attack->GetValue());
		$result = $this->database->Update('weather="'.$attack->GetValue().'"','fights','id = "'.$this->GetID().'"',1);
    $this->addAttackTitel($player, $attack);
		return $attack->GetText();
	}
  
  private function DoGiveUP($player, $action)
	{
    $this->addAttackTitel($player, $attack);
    $player->SetLP(0);
		$result = $this->database->Update('lp="0"','fighters','id = "'.$player->GetID().'"',1);
		return $action->GetText();
	}
  
	private function DoMiscAttacks($player, $target, $attack)
	{
    if($attack->GetID() == 457) // Freezer 100% Todesball
    {
      for($i = 0; $i < count($this->teams); ++$i)
      {
        $team = $this->teams[$i];
        if($i == $player->GetTeam())
          continue;
        
        for($j = 0; $j < count($team); ++$j)
        {
          $fighter = $team[$j];
          $this->AddDebugLog(' - '.$fighter->GetName().' is using: '.$fighter->GetAction());
          $fighter->SetLP(0);
          $this->AddDebugLog(' - '.$fighter->GetName().' is dead.');
          
        }
      }
			return $attack->GetText();
    }
    else if($attack->GetID() == 527) // Selbstzerstörung
    {
      $this->AddDebugLog(' - '.$target->GetName().' is using: '.$target->GetAction());
      if($target->GetAction() != 2) //  Verteidigen
      {
        $target->SetLP(0);
        $this->AddDebugLog(' - '.$target->GetName().' is dead.');
      }
      $player->SetLP(0);
			return $attack->GetText();
    }
    else if($attack->GetID() == 337) // Saibaman Explosion
    {
      for($i = 0; $i < count($this->teams); ++$i)
      {
        $team = $this->teams[$i];
        if($i == $player->GetTeam())
          continue;
        for($j = 0; $j < count($team); ++$j)
        {
          $fighter = $team[$j];
          $this->AddDebugLog(' - '.$fighter->GetName().' is using: '.$fighter->GetAction());
          if($fighter->GetAction() == 2) // Verteidigen
            continue;
          
          $fighter->SetLP(0);
          $this->AddDebugLog(' - '.$fighter->GetName().' is dead.');
          
        }
      }
      $player->SetLP(0);
			return $attack->GetText();
    }
    else if($attack->GetID() == 338) // Banana Hit
    {
      if($target->GetLPPercentage() > $attack->GetValue())
			  return $attack->GetMissText();
      else
      {
          $this->AddDebugLog(' - '.$target->GetName().' wurde gefangen.');
        $target->SetLP(0);
			  return $attack->GetText();
      }
    }
    
		if($attack->GetID() == 296) //Affenschwanz abtrennen
		{
      $miss = rand(0,100);
      $hit = $attack->GetAccuracy() * ($player->GetAccuracy() / $target->GetReflex());
      
      if($target->GetLP() > 0 && $target->GetParalyzed() == 0 && $hit < $miss)
      {
        return $attack->GetMissText();
      }
      
      $target->SetApeTail(1);
			$result = $this->database->Update('apetail="1"','fighters','id = "'.$target->GetID().'"',1);
      $this->addAttackTitel($player, $attack);
			return $attack->GetText();
		}
    
	  return $attack->GetText();
	}
  
	private function Fuse($player, $target, $action)
	{
		if($target->GetTarget() != $player->GetID() || $target->GetAction() != $action->GetID())
		{
			return $action->GetMissText();
		}
		if($target->GetID() == $player->GetID())
		{
			return $action->GetMissText();
		}
		else if($target->GetTeam() != $player->GetTeam())
		{
			return $action->GetMissText();
		}
		else if($player->GetFusedAcc() != 0 || $target->GetFusedAcc() != 0)
		{
			return $action->GetMissText();
		}
		else if($target->GetLP() == 0)
		{
			return $action->GetMissText();
		}
		else if($target->IsInactive())
		{
		  return $action->GetText();
		}
		
		$this->Revert($player, true);
		$this->Revert($target, true);

		$fusedPlayer = new Player($this->database, $player->GetAcc(), $this->actionManager);
    
		$miss = rand(0,100);
		$hit = $action->GetAccuracy();
    
    
		$increase = ($action->GetValue()/100);
    if($hit < $miss)
    {
      $increase = 0.75;
    }
    
    
		$lp = ($player->GetLP() + $target->GetLP());
    $lp = round($lp * $increase);
		$mlp = ($player->GetMaxLP() + $target->GetMaxLP());
    $mlp = round($mlp * $increase);
		$kp = ($player->GetKP() + $target->GetKP());
    $kp = round($kp * $increase);
		$mkp = ($player->GetMaxKP() + $target->GetMaxKP());
    $mkp = round($mkp * $increase);
		
		$attack = (( $player->GetMaxAttack() + $target->GetMaxAttack() )/2);
    $attack = round($attack * $increase);
		$defense = (( $player->GetMaxDefense() + $target->GetMaxDefense() )/2);
    $defense = round($defense * $increase);
		
		$fusedPlayer->SetLP($lp);
		$fusedPlayer->SetMaxLP($mlp);
		$fusedPlayer->SetKP($kp);
		$fusedPlayer->SetMaxKP($mkp);
		$fusedPlayer->SetAttack($attack);
		$fusedPlayer->SetDefense($defense);
		
		$halfPlayerName = substr($player->GetName(), 0, strlen($player->GetName())/2);
		$halfTargetName = substr($target->GetName(), strlen($target->GetName())/2, strlen($target->GetName()));
    
    
		$name = $halfPlayerName.$halfTargetName;
    if($hit < $miss)
    {
		  if(rand(0,1) == 0)
        $name = 'Fetter '.$name;
      else
        $name = 'Dünner '.$name;
    }
    
    
		$fusedPlayer->SetName($name);
		$this->CreateFighter($fusedPlayer, $player->GetTeam(), false, 0, $target->GetAcc(), $action->GetRounds());
		$result = $this->database->Update('inactive="1"','fighters','id = "'.$player->GetID().'" OR id="'.$target->GetID().'"',2);
		$target->SetInactive(true);
		$player->SetInactive(true);
		
    if($hit < $miss)
    {
		  return $action->GetDeadText();
    }
    $this->addAttackTitel($player, $attack);
		return $action->GetText();
	}

	private function Paralyze($player, $target, $attack)
	{
		if($target->GetLP() == 0)
		{
			return $attack->GetDeadText();
		}
		
		$miss = rand(0,100);
		$hit = $attack->GetAccuracy() * ($player->GetAccuracy() / $target->GetReflex());
		
		if($hit < $miss || $target->GetParalyzed() != 0)
		{
			return $attack->GetMissText();
		}
		$returnText = $attack->GetText();
		$target->SetAction($attack->GetLoadAttack());
		$target->SetParalyzed($attack->GetValue());
     $this->AddDebugLog(' - Paralyze: '.$attack->GetValue());
		$result = $this->database->Update('action="'.$attack->GetLoadAttack().'",paralyzed="'.$attack->GetValue().'"','fighters','id = "'.$target->GetID().'"',1);
    $this->addAttackTitel($player, $attack);
		return $returnText;
	}
	
	private function DeParalyze($player, $attack)
	{
		$paralyzed = $player->GetParalyzed() - 1;
    if($paralyzed < 0)
      $paralyzed = 0;
    
		$returnText = $attack->GetText();
		if($paralyzed == 0)
		{
			$returnText = $attack->GetMissText();
		}
		$player->SetParalyzed($paralyzed);
     $this->AddDebugLog(' - DeParalyze: '.$paralyzed);
		$result = $this->database->Update('paralyzed="'.$paralyzed.'"','fighters','id = "'.$player->GetID().'"',1);
    $this->addAttackTitel($player, $attack);
		return $returnText;
	}
	
	private function Kill($player, $target, $attack, &$killed, &$damage)
	{
    $killed = false;
		if($target->GetLP() == 0)
		{
			return $attack->GetDeadText();
		}
		
		$miss = rand(0,100);
		$hit = $attack->GetAccuracy() * ($player->GetAccuracy() / $target->GetReflex());
    
    if($hit < $miss || $target->IsNPC() || $target->GetLPPercentage() > $attack->GetValue())
    {
      $atkVal = $player->GetAttack() / $target->GetDefense();
      $this->AddDebugLog(' - $atkVal: '.$atkVal);
      $atkStrength = 1;
      $playerValue = $player->GetKI() * ($atkStrength / 100);
      $this->AddDebugLog(' - $playerValue: '.$playerValue);
      $atkVal = round($playerValue * $atkVal);
      $damage = $atkVal;
      $this->AddDebugLog(' - $damage: '.$damage);
      
      $lp = $target->GetLP() - $damage;
      if($lp < 0)
        $lp = 0;
      $target->SetLP($lp);
		  $result = $this->database->Update('lp="'.$lp.'"','fighters','id = "'.$target->GetID().'"',1);
      
      return $attack->GetMissText();
    }	
    
		$returnText = $attack->GetText();
		$lp = 0;
		$returnText = $returnText.'<br/>!target sackt zu Boden.';
		
		$target->SetLP($lp);
		$result = $this->database->Update('lp="'.$lp.'"','fighters','id = "'.$target->GetID().'"',1);
    $this->addAttackTitel($player, $attack);
		$killed = true;
    
		return $returnText;
	}
	
	private function SpawnNPC($player, $attack)
	{
		$team = $player->GetTeam();
		$teamMembers = $this->teams[$team];
		$j = 0;
		while(isset($teamMembers[$j]))
		{
			$teamMember = $teamMembers[$j];
			if($teamMember->GetOwner() == $player->GetID())
			{
				return $attack->GetMissText();
			}
			++$j;
		}
		
		$stats = $attack->GetValue();
		if($attack->IsProcentual())
		{
			$stats = ceil($player->GetKI() * ($attack->GetValue() / 100));
		}
		
		$npcID = $attack->GetNPCID();
    $npc = new NPC($this->database, $npcID, $stats);
		$name = $player->GetName();
		$maxLength = 3;
		if(strlen($name) > $maxLength)
		{
			$name = substr($name, 0, $maxLength);
		}
		$name = $name.'bim';
		$npcName = $npc->SetName($name);
		$this->CreateFighter($npc, $team, true, $player->GetID());
    $this->addAttackTitel($player, $attack);
		
		return $attack->GetText();
	}
	
	public function IncMode($team)
	{
		//Increase mode
		$mode = $this->GetMode();
		$mode[$team] = $mode[$team]+1;
		$mode = implode('vs',$mode);
		$this->SetMode($mode);
		$result = $this->database->Update('mode="'.$mode.'"','fights','id = "'.$this->GetID().'"',1);
	}
	
	public function DecMode($team)
	{
		//Increase mode
		$mode = $this->GetMode();
		$mode[$team] = $mode[$team]-1;
		$mode = implode('vs',$mode);
		$this->SetMode($mode);
		$result = $this->database->Update('mode="'.$mode.'"','fights','id = "'.$this->GetID().'"',1);
	}
	
	private function LoadAttack($player, $target, $attack)
	{
		if($target->GetLoadAttack() != $attack->GetLoadAttack())
		{
			return $attack->GetMissText();
		}
		
		if($attack->IsProcentual())
		{
			$damage = ceil($player->GetKI() * ($attack->GetValue() / 100));
		}
    else
		  $damage = $attack->GetValue();
		
		$newLoadValue = $target->GetLoadValue() + $damage;
		$target->SetLoadValue($newLoadValue);
		$result = $this->database->Update('loadvalue="'.$newLoadValue.'"','fighters','id = "'.$target->GetID().'"',1);
    $this->addAttackTitel($player, $attack);
		return $attack->GetText();
	}
	
	private function StartLoadDamage($player, $target, $attack, &$damage, &$type)
	{
		$loadAttack = $attack->GetID();
		$player->SetLoadAttack($loadAttack);
		$player->SetLoadValue(1);
		$result = $this->database->Update('loadvalue="0",loadattack="'.$loadAttack.'"','fighters','id = "'.$player->GetID().'"',1);
		
		$team = $player->GetTeam();
		$j = 0;
		$teamMembers = $this->teams[$team];
		while(isset($teamMembers[$j]))
		{
			$teamMember = $teamMembers[$j];
			$teamMember->AddAttack($attack->GetLoadAttack());
			$result = $this->database->Update('attacks="'.$teamMember->GetAttacks().'"','fighters','id = "'.$teamMember->GetID().'"',1);
			++$j;
		}
    
    $this->addAttackTitel($player, $attack);
		return $attack->GetLoadText();
		
	}
	
	private function FireLoadDamage($player, $target, $attack, &$damage, &$type)
	{
		if($target->GetLP() == 0)
		{
			return $attack->GetDeadText();
		}
		
		$miss = rand(0,100);
		$hit = $attack->GetAccuracy() * ($player->GetAccuracy() / $target->GetReflex());
		
		if($target->GetParalyzed() == 0 && $hit < $miss)
		{
			return $attack->GetMissText();
		}
		
		$returnText = $attack->GetText();
    
		$atkVal = $player->GetAttack() / $target->GetDefense();
		
		$damage = $player->GetLoadValue() * ($attack->GetValue()/100) * $atkVal;
		
		//if($player->GetRace() == 'Mensch')
    //  $crit = rand(0,1);
    //else
      $crit = rand(0,10);
    
		if($crit == 1)
		{
		  //if($player->GetRace() == 'Mensch')
			//  $damage = $damage * 1.45;
      //else
			  $damage = $damage * 1.2;
			$type = 'kritische';
		}
		
		$damage = round($damage);
		
		$lp = $target->GetLP();
		$lp = $lp-$damage;
		
		if($lp <= 0)
		{
			$lp = 0;
			$returnText = $returnText.'<br/>!target kippt um.';
		}
		
		$target->SetLP($lp);
		$player->SetLoadValue(0);
		$player->SetLoadAttack(0);
		$result = $this->database->Update('lp="'.$lp.'"','fighters','id = "'.$target->GetID().'"',1);
		$result = $this->database->Update('loadvalue="0", loadattack="0"','fighters','id = "'.$player->GetID().'"',1);
		
    $this->addAttackTitel($player, $attack);
		return $returnText;
	}
	
	private function LoadDamage($player, $target, $attack, &$damage, &$type)
	{
		if($player->GetLoadAttack() != $attack->GetID())
		{
			return $this->StartLoadDamage($player, $target, $attack, $damage, $type);
		}
		
		return $this->FireLoadDamage($player, $target, $attack, $damage, $type);
	}
	
	private function DealDamage($player, $target, $attack, &$damage, &$type, $useAtkVal)
	{
		if($target->GetLP() == 0)
		{
      $this->AddDebugLog(' - '.$player->GetName().' targeted dead '.$target->GetName());
			return $attack->GetDeadText();
		}
		
		$miss = rand(0,100);
    
    $accuracy = $player->GetAccuracy();
    $reflex = $target->GetReflex();
   // if($target->GetRace() == 'Demon')
    //  $accuracy = $accuracy-15;
    
		$hit = $attack->GetAccuracy() * ($accuracy / $reflex);
		
		if($target->GetParalyzed() == 0 && $hit < $miss)
		{
      $this->AddDebugLog(' - '.$player->GetName().' missed '.$target->GetName());
			return $attack->GetMissText();
		}
		
		$returnText = $attack->GetText();
    $this->AddDebugLog(' - Player '.$player->GetName().' has Attack: <b>'.$player->GetAttack().'</b>');
    $this->AddDebugLog(' - Target '.$target->GetName().' has Defense: <b>'.$target->GetDefense().'</b>');
		
		$atkVal = $player->GetAttack() / $target->GetDefense();
    if(!$useAtkVal)
		$atkVal = 1;
    $this->AddDebugLog(' - AtkVal is: <b>'.$atkVal.'</b>');
    $this->AddDebugLog(' - Attack Value is: <b>'.$attack->GetValue().'</b>');
    
		
		if($attack->IsProcentual())
		{
      $this->AddDebugLog(' - Attack is procentual');
      $this->AddDebugLog(' - Player '.$player->GetName().' has KI: <b>'.$player->GetKI().'</b>');
			$playerValue = $player->GetKI() * ($attack->GetValue() / 100);
      $this->AddDebugLog(' - Playervalue is: <b>'.$playerValue.'</b>');
      $this->AddDebugLog(' - Attackminvalue is: <b>'.$attack->GetMinValue().'</b>');
      
			if($playerValue < $attack->GetMinValue())
			{
				$playerValue = $attack->GetMinValue();
			}
      $atkVal2 = $playerValue * $atkVal;
			$atkVal = $playerValue * $atkVal;
		}
		else
		{
      $this->AddDebugLog(' - Attack is not procentual');
			$atkVal = $atkVal * $attack->GetValue();
		}
    $this->AddDebugLog(' - $atkVal now is: <b>'.$atkVal.'</b>');
		
    $crit = rand(0,100);
    $critChance = 10;
		//if($player->GetRace() == 'Mensch')
    //  $critChance = 30;
      
		if($crit <= $critChance)
		{
		 // if($player->GetRace() == 'Mensch')
			//  $atkVal = $atkVal * 1.8;
      //else
			$atkVal = $atkVal * 1.2;
      $this->AddDebugLog(' - Attack is critical! <b>'.$atkVal.'</b>');
      
			$type = 'kritische';
		}
		
		$atkVal = round($atkVal);
		if($atkVal < 1)
		{
			$atkVal = 1;
		}
    $this->AddDebugLog(' - Attackval rounded is: <b>'.$atkVal.'</b>');
		
    $damage = 0;
    
		$lp = $target->GetLP();
    $this->AddDebugLog(' - Attack LP Value is: <b>'.$attack->GetLPValue().'</b>');
    $lpDamage = round($atkVal * ($attack->GetLPValue()/100));
    $damage += $lpDamage;
		$lp = $lp - $lpDamage;
    
    $this->AddDebugLog(' - '.$player->GetName().' dealt <b>'.$damage.'</b> DMG to '.$target->GetName());
    
    
    $update = '';
    /*
    if($lp <= 0 && $target->GetRace() == 'Demon')
    {
      $surviveChance = rand(0,1);
      if($surviveChance == 0)
      {
        $lp = 1;
			  $returnText = $returnText.'<br/>!target kippt um, steht jedoch dann wieder auf.';
      }
    }
    else if($lp < ($target->GetMaxLP() * 0.1) && $lp > 0 && $target->GetRace() == 'Majin')
    {
      $healChance = rand(0,100);
      if($healChance <= 10)
      {
        $lpCounter = pow(2,$target->GetMajinCounter());
        $lpIncrease = 0.15 / $lpCounter;
        $healLP = round($target->GetMaxLP() * $lpIncrease);
        $lp = $lp + $healLP;
        
        $counter = ($target->GetMajinCounter()+1);
        $target->SetMajinCounter($counter);
        $update = 'majincounter="'.$counter.'"';
        
			  $returnText = $returnText.'<br/>!target regeneriert LP.';
      }
    }
    */
    
		if($lp <= 0)
		{
			$lp = 0;
      $this->AddDebugLog(' - '.$target->GetName().' is dead.');
      if($attack->GetDisplayDied())
			  $returnText = $returnText.'<br/>!target kippt um.';
		}
    
		$kp = $target->GetKP();
    $kpDamage = round($atkVal * ($attack->GetKPValue()/100));
    $damage += $kpDamage;
		$kp = $kp - $kpDamage;
		if($kp <= 0)
		{
			$kp = 0;
		}
    
		$ep = $target->GetEnergy();
    $epDamage = round($atkVal * ($attack->GetEPValue()/100));
    $damage += $epDamage;
		$ep = $ep + $epDamage;
		if($ep <= 0)
			$ep = 0;
		else if($ep >= $target->GetMaxEnergy()) 
      $ep = $target->GetMaxEnergy();
    
    
    
    if($target->GetReflect() != 0)
    {
      $reflectVal = $target->GetDefense() / $player->GetAttack();
      if(!$useAtkVal)
        $reflectVal = 1;
      $reflectLP = round($lpDamage * $reflectVal * $target->GetReflect()/100);
      $reflectKP = round($kpDamage * $reflectVal * $target->GetReflect()/100);
      $reflectEP = round($epDamage * $reflectVal * $target->GetReflect()/100);
      
      $totalReflect = $reflectLP + $reflectKP + $reflectLP;
      if($totalReflect != 0)
      {
        $this->AddDebugLog(' - '.$target->GetName().' reflected <b>'.$totalReflect.'</b> DMG.');
        $this->AddDebugLog(' - - Reflect - LP: '.$reflectLP.' - KP: '.$reflectKP.' - EP: '.$reflectEP);
        $this->AddDebugLog(' - - ReflectVal: '.$reflectVal);
        $this->AddDebugLog(' - - Target Reflect: '.$target->GetReflect());
			  $returnText = $returnText.'<br/>!target reflektiert <b>'.$totalReflect.'</b> Schaden.';
      }
      
      if($reflectLP != 0 || $reflectKP != 0 || $reflectEP != 0)
      {
        $newLP = $player->GetLP() - $reflectLP;
        if($newLP <= 0)
        {
          $newLP = 0;
          $this->AddDebugLog(' - '.$player->GetName().' died.');
			    $returnText = $returnText.'<br/>!source kippt um.';
        }
        $player->SetLP($newLP);
        $newKP = $player->GetKP() - $reflectKP;
        if($newKP <= 0)
          $newKP = 0;
        $player->SetKP($newKP);
        $newEP = $player->GetEnergy() + $reflectEP;
        if($newEP <= 0)
          $newEP = 0;
        else if($newEP >= $player->GetMaxEnergy()) 
          $newEP = $player->GetMaxEnergy();
        $player->SetEnergy($newEP);
		    $result = $this->database->Update('lp="'.$newLP.'",kp="'.$newKP.'",energy="'.$newEP.'"','fighters','id = "'.$player->GetID().'"',1);
      }
    }
		
		$target->SetLP($lp);
		$target->SetKP($kp);
		$target->SetEnergy($ep);
    
    if($update != '')
      $update = $update.',';
    $update = $update.'lp="'.$lp.'"';
		$result = $this->database->Update($update,'fighters','id = "'.$target->GetID().'"',1);
    
    $this->addAttackTitel($player, $attack);
		return $returnText;
	}
	
	private function UpdateTransform($player)
	{
    $this->AddDebugLog(' - UpdateTransform '.$player->GetName());
    $this->AddDebugLog(' - -  buffs: '.$player->GetBuffs());
    $this->AddDebugLog(' - -  Taunt: '.$player->GetTaunt());
    $this->AddDebugLog(' - -  Transformations: '.$player->GetTransformations());
    $this->AddDebugLog(' - -  lp: '.$player->GetLP());
    $this->AddDebugLog(' - -  kp: '.$player->GetKP());
    $this->AddDebugLog(' - -  ilp: '.$player->GetIncreasedLP());
    $this->AddDebugLog(' - -  ikp: '.$player->GetIncreasedKP());
    $this->AddDebugLog(' - -  attack: '.$player->GetAttack());
    $this->AddDebugLog(' - -  defense: '.$player->GetDefense());
    $this->AddDebugLog(' - -  ki: '.$player->GetKI());
    $sql = 'lp="'.$player->GetLP().'"
																			,kp="'.$player->GetKP().'"
																			,ilp="'.$player->GetIncreasedLP().'"
																			,ikp="'.$player->GetIncreasedKP().'"
																			,attack="'.$player->GetAttack().'"
																			,defense="'.$player->GetDefense().'"
																			,ki="'.$player->GetKI().'"
																			,taunt="'.$player->GetTaunt().'"
																			,reflect="'.$player->GetReflect().'"
																			,transformations="'.$player->GetTransformations().'"
																			,buffs="'.$player->GetBuffs().'"';
		$result = $this->database->Update($sql,'fighters','id = "'.$player->GetID().'"',1);
	}
	
	private function Revert($player, $update=true)
	{
    $this->AddDebugLog(' - Revert '.$player->GetName());
		$i = 0;
		while(isset($this->defenseArray[$i]))
		{
			$defense = $this->defenseArray[$i];
			if($defense[0]->GetID() == $player->GetID())
			{
        $attack = $defense[1];
        $defenseValue = $player->GetDefense();
        $reflectValue = $player->GetReflect();

        if($attack->GetDefValue() != 0)
          $defenseValue = $player->GetDefense() / ($attack->GetValue() * $attack->GetDefValue()/100);
        if($attack->GetReflectValue() != 0)
          $reflectValue = $player->GetReflect() - ($attack->GetValue() * $attack->GetReflectValue()/100);
        
				$player->SetDefense($defenseValue);
				$player->SetReflect($reflectValue);
				break;
			}
			++$i;
		}
		
		$trans = array_filter(explode(';',$player->GetTransformations()));
		$i = 0;
		while(isset($trans[$i]))
		{
			$transAttack = $this->GetAttack($trans[$i]);
			$player->Transform($transAttack, true);
			++$i;
		}
		
		if(!$update)
		{
			return;
		}
		
		$this->UpdateTransform($player);
		
		$i = 0;
		while(isset($this->defenseArray[$i]))
		{
			$defense = $this->defenseArray[$i];
			if($defense[0]->GetID() == $player->GetID())
			{
        $attack = $defense[1];
        $defenseValue = $player->GetDefense();
        $reflectValue = $player->GetReflect();

        if($attack->GetDefValue() != 0)
          $defenseValue = $player->GetDefense() * ($attack->GetValue() * $attack->GetDefValue()/100);
        if($attack->GetReflectValue() != 0)
          $reflectValue = $player->GetReflect() + ($attack->GetValue() * $attack->GetReflectValue()/100);
        
				$player->SetDefense($defenseValue);
				$player->SetReflect($reflectValue);
				break;
			}
			++$i;
		}
	}
	
	private function Transform($player, $attack)
	{
		$trans = array_filter(explode(';',$player->GetTransformations()));
		
		$i = 0;
		while(isset($trans[$i]))
		{
			if($trans[$i] == $attack->GetID())
			{
				$player->Transform($attack, true);
				$this->UpdateTransform($player);
				//Revert
				return $attack->GetMissText();
			}
			$transAttack = $this->GetAttack($trans[$i]);

			if($transAttack->GetTransformationID() == $attack->GetTransformationID())
			{
				//revert
				$player->Transform($transAttack, true);
			}
			++$i;
		}
		
		$player->Transform($attack, false);
		$this->UpdateTransform($player);
    
    $this->addAttackTitel($player, $attack);
		
		return $attack->GetText();
	}
	
	private function Defend($player, $attack)
	{
    $defense = $player->GetDefense();
    $reflect = $player->GetReflect();
    
    if($attack->GetDefValue() != 0)
		  $defense = $player->GetDefense() * ($attack->GetValue() * $attack->GetDefValue()/100);
    if($attack->GetReflectValue() != 0)
		  $reflect = $player->GetReflect() + ($attack->GetValue() * $attack->GetReflectValue()/100);
		
		$defensePlayer = array();
		$defensePlayer[0] = $player;
		$defensePlayer[1] = $attack;
		
		array_push($this->defenseArray, $defensePlayer);
		$player->SetDefense($defense);
		$player->SetReflect($reflect);
    
    $this->addAttackTitel($player, $attack);
		
		return $attack->GetText();
	}
	
	private function AbsoluteHeal($player, $damage, $attack)
	{
		$lp = $player->GetLP();
		if($lp < $player->GetIncreasedLP())
    {
		  $lp = $lp + round($damage * ($attack->GetLPValue()/100));
      $lp = min($lp, $player->GetIncreasedLP());
		  $player->SetLP($lp);
    }
    
		$kp = $player->GetKP();
		if($kp < $player->GetIncreasedKP())
    {
		  $kp = $kp + round($damage * ($attack->GetKPValue()/100));
      $kp = min($kp, $player->GetIncreasedKP());
		  $player->SetKP($kp);
    }
    
		$ep = $player->GetEnergy();
		if($ep < $player->GetMaxEnergy())
    {
		  $ep = $ep + round($damage * ($attack->GetEPValue()/100));
      $ep = min($ep, $player->GetMaxEnergy());
		  $player->SetEnergy($ep);
    }
    
    $this->addAttackTitel($player, $attack);
    
		$result = $this->database->Update('lp="'.$lp.'",kp="'.$kp.'",energy="'.$ep.'"','fighters','id = "'.$player->GetID().'"',1);
	}
	
	private function Heal($player, $target, $attack, &$damage, &$type)
	{
		if($target->GetLP() == 0)
		{
			return $attack->GetDeadText();
		}
    
    $enemyKI = 0;
    
		$i = 0;
		$fighter = null;
		while(isset($this->teams[$i]))
		{
      if($i == $target->GetTeam())
      {
        ++$i;
        continue;
      }
      $this->AddDebugLog(' - Heal Checking Team '.$i);
      
			$j = 0;
			$teamMembers = $this->teams[$i];
			while(isset($teamMembers[$j]))
			{
        
        $this->AddDebugLog(' - Heal Fighter: '.$teamMembers[$j]->GetName());
        $this->AddDebugLog(' - Heal FighterKI: '.$teamMembers[$j]->GetKI());
        
        if($teamMembers[$j]->GetKI() > $enemyKI)
          $enemyKI = $teamMembers[$j]->GetKI();
				++$j;
			}
			++$i;
		}
    
    $this->AddDebugLog(' - Heal EnemyKI: '.$enemyKI);
    
    if($enemyKI == 0)
    {
      $this->DebugSend(true);
      $enemyKI = $target->GetKI();
    }
    
		
		$miss = rand(0,100);
		$hit = $attack->GetAccuracy() * ($player->GetAccuracy() / $target->GetReflex());
		
		if($target->GetParalyzed() == 0 && $hit < $miss)
		{
			return $attack->GetMissText();
		}
		
		$returnText = $attack->GetText();
    
		
    
    $enemyKI = $player->GetKI();
    
		if($attack->IsProcentual())
		{
      $enemyValue = $enemyKI * ($attack->GetValue() / 100);
      $constValue = 0.2;
			$playerValue = $enemyValue + ($player->GetKI() * $constValue);
      
			if($playerValue < $attack->GetMinValue())
			{
				$playerValue = $attack->GetMinValue();
			}
      $atkVal = $playerValue;
		}
		else
		{
			$atkVal = $attack->GetValue();
		}
    
    $damage = 0;
		
    $lpVal = $attack->GetLPValue();
    $lp = $target->GetLP();
    $count = 0;
    if($lpVal != 0)
    {
      $lpDamage = round($atkVal * ($lpVal/100));
      if($lp < $target->GetIncreasedLP() || $lpDamage < 0)
      {
        $damage += $lpDamage;
        $lp = $lp + $lpDamage;
        $lp = min($lp, $target->GetIncreasedLP());
        $target->SetLP($lp);
        $count++;
      }
    }
    
    $kpVal = $attack->GetKPValue();
    
    $kp = $target->GetKP();
    if($kpVal != 0)
    {
      $kpDamage = round($atkVal * ($kpVal/100));
      if($kp < $target->GetIncreasedKP() || $kpDamage < 0)
      {
        $damage += $kpDamage;
        $kp = $kp + $kpDamage;
        $kp = min($kp, $target->GetIncreasedKP());
        $target->SetKP($kp);
        $count++;
      }
    }
    
    $epVal = $attack->GetEPValue();
    
		$ep = $target->GetEnergy();
    if($epVal != 0)
    {
      $epDamage = round($atkVal * ($epVal/100));
      if($ep < $target->GetMaxEnergy() || $epDamage < 0)
      {
        $damage += $epDamage;
        $ep = $ep + $epDamage;
        $ep = min($ep, $target->GetMaxEnergy());
        $target->SetEnergy($ep);
        $count++;
      }
    }
		
		//if($player->GetRace() == 'Mensch')
     // $crit = rand(0,1);
    //else
      $crit = rand(0,10);
    
		if($crit == 1)
		{
		 // if($player->GetRace() == 'Mensch')
			//  $damage = $damage * 1.45;
     // else
			  $damage = $damage * 1.2;
			$type = 'kritische';
		}
    
    $damage = round($damage/$count);
    
    
		$result = $this->database->Update('lp="'.$lp.'",kp="'.$kp.'",energy="'.$ep.'"','fighters','id = "'.$target->GetID().'"',1);
    
    $this->addAttackTitel($player, $attack);
		
		return $returnText;
	}
	
	private function SelfHeal($player, $attack, &$damage, &$type)
	{
		if($player->GetLP() == 0)
		{
			return $attack->GetDeadText();
		}
    
		$miss = rand(0,100);
		$hit = $attack->GetAccuracy();
		
		if($player->GetParalyzed() == 0 && $hit < $miss)
		{
			return $attack->GetMissText();
		}
		
		$returnText = $attack->GetText();
    
		if($attack->IsProcentual())
		{
      $playerValue = $player->GetKI() * ($attack->GetValue() / 100);
			if($playerValue < $attack->GetMinValue())
			{
				$playerValue = $attack->GetMinValue();
			}
      $atkVal = $playerValue;
		}
		else
		{
			$atkVal = $attack->GetValue();
		}
    
    $damage = 0;
		
    $lpVal = $attack->GetLPValue();
    $lp = $player->GetLP();
    $count = 0;
    if($lpVal != 0)
    {
      $lpDamage = round($atkVal * ($lpVal/100));
      if($lp < $player->GetIncreasedLP() || $lpDamage < 0)
      {
        $damage += $lpDamage;
        $lp = $lp + $lpDamage;
        $lp = min($lp, $player->GetIncreasedLP());
        $player->SetLP($lp);
        $count++;
      }
    }
    
    $kpVal = $attack->GetKPValue();
    
    $kp = $player->GetKP();
    if($kpVal != 0)
    {
      $kpDamage = round($atkVal * ($kpVal/100));
      if($kp < $player->GetIncreasedKP() || $kpDamage < 0)
      {
        $damage += $kpDamage;
        $kp = $kp + $kpDamage;
        $kp = min($kp, $player->GetIncreasedKP());
        $player->SetKP($kp);
        $count++;
      }
    }
    
    $epVal = $attack->GetEPValue();
    
		$ep = $player->GetEnergy();
    if($epVal != 0)
    {
      $epDamage = round($atkVal * ($epVal/100));
      if($ep < $player->GetMaxEnergy() || $epDamage < 0)
      {
        $damage += $epDamage;
        $ep = $ep + $epDamage;
        $ep = min($ep, $player->GetMaxEnergy());
        $player->SetEnergy($ep);
        $count++;
      }
    }
    
    if($count != 0)
    {
      $damage = round($damage/$count);
		  $result = $this->database->Update('lp="'.$lp.'",kp="'.$kp.'",energy="'.$ep.'"','fighters','id = "'.$player->GetID().'"',1);
    }
    
    $this->addAttackTitel($player, $attack);
		
		return $returnText;
	}
  
private function Revive($player, $target, $attack, &$damage)
{
    if($target->GetLP() != 0)
    {
      return $attack->GetDeadText();
    }
  
		$miss = rand(0,100);
		$hit = $attack->GetAccuracy() * ($player->GetAccuracy() / $target->GetReflex());
		
		if($target->GetParalyzed() == 0 && $hit < $miss)
		{
			return $attack->GetMissText();
		}
		
		$returnText = $attack->GetText();
		
		$atkVal = $attack->GetValue();
		if($attack->IsProcentual())
		{
			$atkVal = $player->GetKI() * ($attack->GetValue() / 100);
		}
    
    $damage = 0;
		
		$lp = $target->GetLP();
    $lpDamage = round($atkVal * ($attack->GetLPValue()/100));
    $damage += $lpDamage;
		$lp = $lp + $lpDamage;
		if($lp >= $target->GetIncreasedLP()) $lp = $target->GetIncreasedLP();
		$target->SetLP($lp);
    
		$kp = $target->GetKP();
    $kpDamage = round($atkVal * ($attack->GetKPValue()/100));
    $damage += $kpDamage;
		$kp = $kp + $kpDamage;
		if($kp >= $target->GetIncreasedKP()) $kp = $target->GetIncreasedKP();
		$target->SetKP($kp);
    
		$ep = $target->GetEnergy();
    $epDamage = round($atkVal * ($attack->GetEPValue()/100));
    $damage += $epDamage;
		$ep = $ep + $epDamage;
		if($ep >= $target->GetMaxEnergy()) $ep = $target->GetMaxEnergy();
		$target->SetEnergy($ep);
    
    
		$result = $this->database->Update('lp="'.$lp.'",kp="'.$kp.'",energy="'.$ep.'"','fighters','id = "'.$target->GetID().'"',1);
  
    $this->addAttackTitel($player, $attack);
  
		return $returnText;		
	}
  
	
	private function Buff(&$player, &$target, &$attack)
	{
    $this->AddDebugLog(' - Buff by: '.$player->GetName().' on '.$target->GetName());
    $this->AddDebugLog(' - - Buffs: '.$target->GetBuffs());
		$buffs = array();
		if($target->GetBuffs() != '')
		{
			$buffs = explode(';',$target->GetBuffs());
		}
		$newBuffs = array();
		
		foreach($buffs as &$buff)
		{
			$buffData = explode('@',$buff);
			if($buffData[0] == $player->GetID() && $buffData[1] == $attack->GetID())
			{
        $this->AddDebugLog(' - - ReverseBuff because recasted');
				$this->ReverseBuff($target, $attack);
				$text = '!source beendet '.$attack->GetName().' bei !target.';
				return $text;
			}
			else
			{
        $this->AddDebugLog(' - - Add Buff');
				array_push($newBuffs, $buff);
			}
		}
    
    $miss = rand(0,100);
    $hit = $attack->GetAccuracy() * ($player->GetAccuracy() / $target->GetReflex());

		if($target->GetParalyzed() == 0 && $hit < $miss)
    {
        $this->AddDebugLog(' - - Missed');
      return $attack->GetMissText();
    }
		
    $buffKI = min($target->GetKI(), $player->GetKI());
    
		$atkVal = round($buffKI * $attack->GetValue()/100);
		
		$returnText = $attack->GetText();
		
		//Füge die Werte zusammen
		$atkDiff = round($atkVal * ($attack->GetAtkValue()/100));
		$atk = $target->GetAttack() + $atkDiff;
		if($atk < 1)
		{
			$atkDiff -= $atk-1;
			$atk = 1;
		}
		$defDiff = round($atkVal * ($attack->GetDefValue()/100));
		$def = $target->GetDefense() + $defDiff;
		if($def < 1)
		{
			$defDiff -= $def-1;
			$def = 1;
		}
		$lpDiff = round($atkVal * ($attack->GetLPValue()/100));
		$lp = $target->GetLP() + $lpDiff;
		if($lp < 0)
		{
			$lpDiff -= $lp;
			$lp = 0;
		}
		$ilpDiff = round($atkVal * ($attack->GetLPValue()/100));
		$ilp = $target->GetIncreasedLP() + $ilpDiff;
		if($ilp < 0)
		{
			$ilpDiff -= $ilp;
			$ilp = 0;
		}
		$kpDiff = round($atkVal * ($attack->GetKPValue()/100));
		$kp = $target->GetKP() + $kpDiff;
		if($kp < 0)
		{
			$kpDiff -= $kp;
			$kp = 0;
		}
		$ikpDiff = round($atkVal * ($attack->GetKPValue()/100));
		$ikp = $target->GetIncreasedKP() + $ikpDiff;
		if($ikp < 0)
		{
			$ikpDiff -= $ikp;
			$ikp = 0;
		}
		$itauntDiff = round($atkVal * ($attack->GetTauntValue()/100));
    $this->AddDebugLog(' - - $itauntDiff: '.$itauntDiff);
    $this->AddDebugLog(' - - Target Taunt: '.$target->GetTaunt());
		$itaunt = $target->GetTaunt() + $itauntDiff;
    $this->AddDebugLog(' - - $itaunt: '.$itaunt);
		if($itaunt < 0)
		{
			$itauntDiff -= $itaunt;
			$itaunt = 0;
		}
		$ireflectDiff = $attack->GetReflectValue();
		$ireflect = $target->GetReflect() + $ireflectDiff;
		if($ireflect < 0)
		{
			$ireflectDiff -= $ireflect;
			$ireflect = 0;
		}
		$buffData = $player->GetID().'@'.$attack->GetID().
					'@'.$attack->GetRounds().
					'@'.$atkDiff.
					'@'.$defDiff.
					'@'.$lpDiff.
					'@'.$ilpDiff.
					'@'.$kpDiff.
					'@'.$ikpDiff.
					'@'.$itauntDiff.
					'@'.$ireflectDiff;
		
		//Noch nicht ausgewählt, also füge sie hinzu
		array_push($newBuffs, $buffData);
		
		//Setzte die Werte
		$target->SetAttack($atk);
		$target->SetDefense($def);
		$target->SetLP($lp);
		$target->SetIncreasedLP($ilp);
		$target->SetKP($kp);
		$target->SetIncreasedKP($ikp);
    $this->AddDebugLog(' -- - Set Taunt of '.$target->GetName().' to '.$itaunt);
    if($itaunt < 0)
    {
      $this->DebugSend(true);
      $itaunt = 0;
    }
		$target->SetTaunt($itaunt);
		$target->SetReflect($ireflect);
    $buffString = implode(';', $newBuffs);
		$target->SetBuffs($buffString);
    $this->AddDebugLog(' - - SetBuff: '.$buffString);
		$this->UpdateTransform($target);
    
    $this->addAttackTitel($player, $attack);
		
		return $returnText;
	}
	
	private function ReverseBuff(&$target, &$attack)
	{
    $this->AddDebugLog(' - - ReverseBuff');
    $this->AddDebugLog(' - - - Buffs: '.$target->GetBuffs());
    
		//Speichere die neuen VWs ab, falls der Spieler noch welche hat
		$buffs = array();
		if($target->GetBuffs() != '')
		{
			$buffs = explode(';',$target->GetBuffs());
		}
		$newBuffs = array();
		foreach($buffs as &$buff)
		{
      $this->AddDebugLog(' - - - Buff - '.$buff);
			$buffData = explode('@',$buff);
      $this->AddDebugLog(' - - - Attack: '.$buffData[1]);
			
			if($buffData[0] != $target->GetID() && $buffData[1] != $attack->GetID())
			{
				array_push($newBuffs, $buff);
			}
			else
			{
		//Füge die Werte zusammen
				$atk = $target->GetAttack() - $buffData[3];
				$def = $target->GetDefense() - $buffData[4];
				$lp = $target->GetLP() - $buffData[5];
				$ilp = $target->GetIncreasedLP() - $buffData[6];
				$kp = $target->GetKP() - $buffData[7];
				$ikp = $target->GetIncreasedKP() - $buffData[8];
				$itaunt = $target->GetTaunt() - $buffData[9];
				$ireflect = $target->GetReflect() - $buffData[10];
				//Wenn der Spieler dadurch stirbt, setzte Leben auf 0
				if($lp < 0)
				{
					$lp = 0;
				}
				if($kp < 0)
				{
					$kp = 0;
				}
        $target->SetAttack($atk);
        $target->SetDefense($def);
        $target->SetLP($lp);
        $target->SetIncreasedLP($ilp);
        $target->SetKP($kp);
        $target->SetIncreasedKP($ikp);
        $this->AddDebugLog(' - - - Set Taunt of '.$target->GetName().' to '.$itaunt);
        $target->SetTaunt($itaunt);
        $target->SetReflect($ireflect);
			}
		}
    $buffString = implode(';', $newBuffs);
    $this->AddDebugLog(' - - - SetBuff: '.$buffString);
		$target->SetBuffs($buffString);
		$this->UpdateTransform($target);
	}
	
	private function UnParalyze($player, $target, $attack)
	{
		$miss = rand(0,100);
		$hit = $attack->GetAccuracy() * ($player->GetAccuracy() / $target->GetReflex());
		
		if($target->GetParalyzed() == 0 && $hit < $miss)
		{
			return $attack->GetMissText();
		}
    
		$paralyzed = $target->GetParalyzed() - $attack->GetValue();
    if($paralyzed < 0) 
      $paralyzed = 0;

		$returnText = $attack->GetText();
		$target->SetParalyzed($paralyzed);
     $this->AddDebugLog(' - UnParalyze: '.$paralyzed);
		$result = $this->database->Update('paralyzed="'.$paralyzed.'"','fighters','id = "'.$target->GetID().'"',1);
    
    $this->addAttackTitel($player, $attack);
		return $returnText;
	}
	
	private function Dots(&$fighter, &$target, &$attack)
	{
		$dots = array();
		if($target->GetDots() != '')
		{
			$dots = explode(';',$target->GetDots());
		}
		$newDots = array();
		
		foreach($dots as &$dot)
		{
			$dotData = explode('@',$dot);
			if($dotData[0] == $fighter->GetID() && $dotData[1] == $attack->GetID())
			{
				$this->ReverseDots($target, $attack);
				$text = '!source beendet '.$attack->GetName().' bei !target.';
				return $text;
			}
			else
			{
				array_push($newDots, $dot);
			}
		}
    
    $miss = rand(0,100);
    $hit = $attack->GetAccuracy() * ($fighter->GetAccuracy() / $target->GetReflex());

		if($target->GetParalyzed() == 0 && $hit < $miss)
    {
      return $attack->GetMissText();
    }
    
		$returnText = $attack->GetText();
    
		$dotData = $fighter->GetID().'@'.$attack->GetID().'@'.$attack->GetRounds();
		
		//Noch nicht ausgewählt, also füge sie hinzu
		array_push($newDots, $dotData);
		
		//Setzte die Werte
		$target->SetDots(implode(';', $newDots));
		$result = $this->database->Update('dots="'.$target->GetDots().'"','fighters','id = "'.$target->GetID().'"',1);
    
    $this->addAttackTitel($fighter, $attack);
		
		return $returnText;
	}
	
	private function ReverseDots(&$target, &$attack)
	{
		$dots = array();
		if($target->GetDots() != '')
		{
			$dots = explode(';',$target->GetDots());
		}
		$newDots = array();
		foreach($dots as &$dot)
		{
			$dotData = explode('@',$dot);
			
			if($dotData[0] != $target->GetID() && $dotData[1] != $attack->GetID())
			{
				array_push($newDots, $dot);
			}
		}
		$target->SetDots(implode(';', $newDots));
		$result = $this->database->Update('dots="'.$target->GetDots().'"','fighters','id = "'.$target->GetID().'"',1);
	}
	
	private function LoadFight($id)
	{
    $result = $this->database->Select('*', 'fights', 'id="'.$id.'"', 1);
		if ($result) 
		{
			if ($result->num_rows > 0)
			{
				$row = $result->fetch_assoc();
				$this->data = $row;
				$this->valid = true;
			}
			$result->close();
		}
	}
	
	private function LoadFighters($player)
	{
		$result = $this->database->Select('*','fighters','fight="'.$this->GetID().'"',999, 'team');
		if ($result) 
		{
			if ($result->num_rows > 0)
			{
        while($row = $result->fetch_assoc()) 
				{
					$this->AddFighter($row,$player);
        }
			}
			$result->close();
      
		}
	}
	
	private function AddFighter($data,$player = null)
	{
		$fighter = new Fighters($data);
		$fighterTeam = $fighter->GetTeam();
		if(!isset($this->teams[$fighterTeam]))
		{
			$this->teams[$fighterTeam] = array();
		}
    if($player != null && !$fighter->IsInactive() && ($player->GetID() == $fighter->GetAcc() || $player->GetID() == $fighter->GetFusedAcc()) )
		{
			$this->player = $fighter;
		}
		array_push($this->teams[$fighterTeam], $fighter);
		return $fighter;
	}
	
	private function RemoveFighter($playerID, $isNPC = false)
	{
		$i = 0;
		$fighter = null;
		while(isset($this->teams[$i]))
		{
			$j = 0;
			$teamMembers = $this->teams[$i];
			while(isset($teamMembers[$j]))
			{
        $fighter = $teamMembers[$j];
				if($fighter->GetAcc() == $playerID && !$isNPC || $fighter->GetID() == $playerID && $isNPC)
				{
          
					//Remove fighter from Team
					array_splice($this->teams[$i], $j, 1);
					//count teamMembers, if zero, this team is empty and can be removed
					if(count($this->teams[$i]) == 0)
					{
						unset($this->teams[$i]);
					}
					break;
				}
				++$j;
			}
			++$i;
		}
	}
  
  public function GetMembersOfTeam($team)
  {
		$teams = count($this->teams);
    if($team >= $teams)
      return 0;

    return count($this->teams[$team]);
  }
	
	public function GetTeamOfGroup($group)
	{
		$i = 0;
		$team = count($this->teams);
		if($group == null)
		{
			return $team;
		}
		
		while(isset($this->teams[$i]))
		{
			$players = $this->teams[$i];
			$j = 0;
			while(isset($players[$j]))
			{
				$playerFighter = $players[$j];
				if(in_array($playerFighter->GetAcc(), $group))
				{
					return $i;
				}
				$j++;
			}
			++$i;
		}
		return $team;
	}
	
	public function ForceJoin($player, $team)
	{
		$this->CreateFighter($player, $team, false);
		$this->IncMode($team);
	}
  
	public function Join($joiningPlayer, $team, $isNPC=false)
	{
    if(!$isNPC && $joiningPlayer->GetFight() != 0 || $this->IsStarted())
    {
      return false;
    }
    
		$this->CreateFighter($joiningPlayer, $team, $isNPC);

		$mode = $this->GetMode();
		$teams = $this->GetTeams();
		$i = 0;
		$full = true;
		while(isset($mode[$i]))
		{
			if(!isset($teams[$i]) || $mode[$i] != count($teams[$i]))
			{
				$full = false;
				break;
			}
			++$i;
		}
    
		$roundText = '<tr><td align=center colspan=4><h2>Kampf Beginn</h2></td></tr>';
		
		if($full)
		{
		  $imageLeft = true;
      $i = 0;
      while(isset($this->teams[$i]))
      {
        $players = $this->teams[$i];
        $j = 0;
        while(isset($players[$j]))
        {
          $teamPlayer = $players[$j];
          $trans = $teamPlayer->GetTransformations();
          $teamPlayer->SetTransformations('');
          $playerText = '';
          if($trans != '')
          {
            $transformations = explode(';',$trans);
            $powerup = $transformations[0];
            $attack = $this->attackManager->GetAttack($powerup);
			      $attackImage = $attack->GetImage();
			      $playerText = $this->Transform($teamPlayer, $attack);
          }
          else
          {
            $playerText = "!source macht sich zum Kampf bereit.";
            $attackImage = 'img/attacks/fightready.png';
          }
          $playerText = $this->ReplaceTextValues($playerText, $teamPlayer, $teamPlayer, 0, 4);
          $attackText = $this->DisplayAttackText($attackImage, $playerText, $imageLeft);
          $roundText = $roundText.$attackText;
          $imageLeft = !$imageLeft;
          $j++;
        }
        ++$i;
      }
    
      $newText = $this->database->EscapeString($roundText.$this->GetText());
      $this->SetText($newText);
      
			$this->SetState(1);
			$result = $this->database->Update('state="'.$this->GetState().'",text="'.$newText.'"','fights','id = "'.$this->GetID().'"',1);		
    	$timestamp = date('Y-m-d H:i:s');
			$result = $this->database->Update('lastaction="'.$timestamp.'"','fighters','fight = "'.$this->GetID().'"',9999999);
			$this->attackManager = new AttackManager($this->database);
		}
		
		return true;
		
	}
	
  public function DeleteFightAndFighters()
  {
			$result = $this->database->Update('fight="0"','accounts','fight = "'.$this->GetID().'"',9999);		
    	$this->database->Delete('fights','id="'.$this->GetID().'"');
    	$this->database->Delete('fighter','fight="'.$this->GetID().'"');
	}
	
  public function Leave($leavingPlayer)
  {
    if($leavingPlayer->GetFight() != $this->GetID() || $this->IsStarted())
    {
      return false;
    }
		
		$this->DeleteFighter($leavingPlayer);
		if($this->GetType() == 3 && $this->IsInGainAccs($leavingPlayer->GetID())) //NPC
		{
        $leavingPlayer->SetDailyNPCFights($leavingPlayer->GetDailyNPCFights()-1);
        $leavingPlayer->UpdateDailyNPCFights();
		}
    else if($this->GetType() == 5 && $this->IsInGainAccs($leavingPlayer->GetID()))
    {
			$event = new Event($this->database, $this->GetEvent());
			$event->RemoveFinishedPlayers($leavingPlayer->GetID());
    }
		$this->RemoveGainAcc($leavingPlayer->GetID());
		
		$leftTeams = count($this->GetTeams());
		if($this->GetType() == 3 && $leftTeams == 1 || $this->GetType() != 3 && $leftTeams == 0)
		{
    	$this->database->Delete('fights','id="'.$this->GetID().'"');
			
			if($this->GetType() == 2)
			{
    	$this->database->Delete('fighter','fight="'.$this->GetID().'"');
			}
		}
		
    return true;
  }
	
	public function GetAttack($id)
	{
		return $this->attackManager->GetAttack($id);
	}
	
	public function IsInGainAccs($id)
	{
		$gainAccs = explode(';',$this->GetGainAccs());
		if(in_array($id,$gainAccs))
			return true;
    
		return false;
	}
	
	public function UpdateGainAcc($gainAccs)
	{
		$this->SetGainAccs($gainAccs);
		$result = $this->database->Update('gainaccs="'.$gainAccs.'"','fights','id = "'.$this->GetID().'"',1);		
	}
	
	public function AddGainAcc($id)
	{
		$gainAccs = $id;
		if($this->GetGainAccs() != '')
		{
			$gainAccs = explode(';',$this->GetGainAccs());
			if(in_array($id,$gainAccs))
			{
				return;
			}
			array_push($gainAccs, $id);
			$gainAccs = implode(';',$gainAccs);
		}
		
		$this->SetGainAccs($gainAccs);
		$result = $this->database->Update('gainaccs="'.$gainAccs.'"','fights','id = "'.$this->GetID().'"',1);		
	}
	
	public function RemoveGainAcc($id)
	{
		$gainAccs = '';
		if($this->GetGainAccs() == '')
		{
			return;
		}
		else if($this->GetGainAccs() != $id)
		{
			$gainAccs = explode(';',$this->GetGainAccs());
			if(!in_array($id,$gainAccs))
			{
				return;
			}
			array_splice($gainAccs, array_search($id, $gainAccs), 1);
			$gainAccs = implode(';',$gainAccs);
		}
		
		$this->SetGainAccs($gainAccs);
		$result = $this->database->Update('gainaccs="'.$gainAccs.'"','fights','id = "'.$this->GetID().'"',1);		
	}
	
	public function GetFighter($id)
	{
    $i = 0;
    while(isset($this->teams[$i]))
    {
      $players = $this->teams[$i];
      $j = 0;
      while(isset($players[$j]))
      {
				if($players[$j]->GetID() == $id)
				{
					return $players[$j];
				}
        $j++;
      }
      ++$i;
    }
		
		return null;
	}
  
  public function DeleteFight()
  {
    $this->database->Delete('fights','id="'.$this->GetID().'"');
  }
  
  public function GetID()
  {
    return $this->data['id'];
  }
  
  public function SetID($value)
  {
    $this->data['id'] = $value;
  }
  
  public function GetName()
  {
    return $this->data['name'];
  }
  
  public function SetName($value)
  {
    $this->data['name'] = $value;
  }
  
  public function GetTournament()
  {
    return $this->data['tournament'];
  }
  
  public function SetTournament($value)
  {
    $this->data['tournament'] = $value;
  }
  
  public function GetDragonball()
  {
    return $this->data['dragonball'];
  }
  
  public function SetDragonball($value)
  {
    $this->data['dragonball'] = $value;
  }
  
  public function GetPlace()
  {
    return $this->data['place'];
  }
  
  public function SetPlace($value)
  {
    $this->data['place'] = $value;
  }
  
  public function GetPlanet()
  {
    return $this->data['planet'];
  }
  
  public function SetPlanet($value)
  {
    $this->data['planet'] = $value;
  }
  
  public function GetStory()
  {
    return $this->data['story'];
  }
  
  public function SetStory($value)
  {
    $this->data['story'] = $value;
  }
  
  public function GetMode()
  {
    return explode('vs',$this->data['mode']);
  }
  
  public function SetMode($value)
  {
		$this->data['mode'] = $value;
  }
	
	public function GetType()
	{
		return $this->data['type'];
	}
  
  public function SetType($value)
  {
    $this->data['type'] = $value;
  }
	
	public function GetTeams()
	{
		return $this->teams;
	}
	
	public function IsHealing()
	{
		return $this->data['healing'];
	}
	
	public function IsValid()
	{
		return $this->valid;
	}
  
  public function IsStarted()
  {
    return $this->data['state'] != 0;
  }
  
  public function IsEnded()
  {
    return $this->data['state'] == 2;
  }
	
	public function GetState()
	{
		return $this->data['state'];
	}
	
	public function GetSurvivalRounds()
	{
		return $this->data['survivalrounds'];
	}
	
	public function SetSurvivalRounds($value)
	{
		$this->data['survivalrounds'] = $value;
	}
	
	public function GetSurvivalTeam()
	{
		return $this->data['survivalteam'];
	}
	
	public function SetSurvivalTeam($value)
	{
		$this->data['survivalteam'] = $value;
	}
	
	public function GetSurvivalWinner()
	{
		return $this->data['survivalwinner'];
	}
	
	public function SetSurvivalWinner($value)
	{
		$this->data['survivalwinner'] = $value;
	}
	
	public function GetChallenge()
	{
		return $this->data['challenge'];
	}
	
	public function SetChallenge($value)
	{
		$this->data['challenge'] = $value;
	}
	
	public function SetState($value)
	{
		$this->data['state'] = $value;
	}
	
	public function GetRound()
	{
		return $this->data['round'];
	}
	
	public function GetEvent()
	{
		return $this->data['event'];
	}
	
	public function GetEventFight()
	{
		return $this->data['eventfight'];
	}
	
	public function GetLevelup()
	{
		return $this->data['levelup'];
	}
	
	public function SetLevelup($value)
	{
		$this->data['levelup'] = $value;
	}
	
	public function GetZeni()
	{
		return $this->data['zeni'];
	}
	
	public function SetZeni($value)
	{
		$this->data['zeni'] = $value;
	}
	
	public function GetWeather()
	{
		return $this->data['weather'];
	}
	
	public function SetWeather($value)
	{
		$this->data['weather'] = $value;
	}
	
	public function GetGainAccs()
	{
		return $this->data['gainaccs'];
	}
	
	public function SetGainAccs($value)
	{
		$this->data['gainaccs'] = $value;
	}
	
	public function GetItems()
	{
		return $this->data['items'];
	}
	
	public function SetItems($value)
	{
		$this->data['items'] = $value;
	}
	
	public function SetRound($value)
	{
		$this->data['round'] = $value;
	}
	
	public function GetText()
	{
		return $this->data['text'];
	}
	
	public function SetText($text)
	{
		$this->data['text'] = $text;
	}
	
	public function GetHealthRatio()
	{
		return $this->data['healthratio'];
	}
	
	public function SetHealthRatio($text)
	{
		$this->data['healthratio'] = $text;
	}
	
	public function GetHealthRatioTeam()
	{
		return $this->data['healthratioteam'];
	}
	
	public function SetHealthRatioTeam($text)
	{
		$this->data['healthratioteam'] = $text;
	}
	
	public function GetHealthRatioWinner()
	{
		return $this->data['healthratiowinner'];
	}
	
	public function SetHealthRatioWinner($text)
	{
		$this->data['healthratiowinner'] = $text;
	}
	
	public function GetDebugLog()
	{
		return $this->data['debuglog'];
	}
	
	public function SetDebugLog($text)
	{
		$this->data['debuglog'] = $text;
	}
	
	public function GetFighters()
	{
		return $this->data['fighters'];
	}
	
	public function SetFighters($text)
	{
		$this->data['fighters'] = $text;
	}
	
	public function GetPlayer()
	{
		return $this->player;
	}
  
  public function GetNPCInFight()
  {
    $npc = null;
    $i = 0;
		$npcFighter = null;
		while(isset($this->teams[$i]))
		{
			$j = 0;
			$teamMembers = $this->teams[$i];
			while(isset($teamMembers[$j]))
			{
				if($teamMembers[$j]->GetNPC() != 0)
				{
          $npc = new NPC($this->database, $teamMembers[$j]->GetNPC(), 1);
          return $npc;
				}
				++$j;
			}
      ++$i;
    }
    
    return $npc;
  }
	
	public function CreateFighter($player, $team, $isNPC, $owner=0, $fusion=0, $fusetimer=0)
	{
    
    if($this->GetStory() != 0)
    {
      $npc = $this->GetNPCInFight();
      if($npc != null && $npc->GetPlayerAttack() != 0)
        $player->AddFightAttack($npc->GetPlayerAttack());
    }
    
		$mlp = $player->GetMaxLP();
		$mkp = $player->GetMaxKP();
		$id = $player->GetID();
		if($isNPC)
		{
			$id = -1;
		}
    
    $ilp = $mlp;
    $ikp = $mkp;
		

		$lp = $player->GetLP();
		$kp = $player->GetKP();
    if($fusion == 0 && ($this->GetType() == 0 || $this->GetType() == 6 || $this->GetType() == 8)) // Spaß oder Turnier oder Arena
    {
		  $lp = $mlp;
      $kp = $mkp;
    }
		$atk = $player->GetAttack();
		$def = $player->GetDefense();
		if(!$isNPC)
		{
			$equippedStats = explode(';',$player->GetEquippedStats());
			$lp += $equippedStats[0];
      $ilp += $equippedStats[0];
			$kp += $equippedStats[1];
      $ikp += $equippedStats[1];
			$atk += $equippedStats[2];
			$def += $equippedStats[3];
		}
    
    $attacks = explode(';', $player->GetAttacks());
    $powerup = '';
    if(!$isNPC)
      $powerup = $player->GetStartingPowerup();
    
    if(!in_array($powerup, $attacks))
      $powerup = '';
		
    $timestamp = date('Y-m-d H:i:s');
		$row['id'] = $player->GetID();
		$row['acc'] = $id;
		$row['fight'] = $this->GetID();
		$row['team'] = $team;
		$row['name'] = $player->GetName();
		$row['charimage'] = $player->GetImage();
		//$row['inventory'] = $inventory;
    $ki = $player->GetKI();
		if($isNPC)
		{
		  $row['npc'] = $player->GetID();
      $row['apetail'] = 0;
      $row['apecontrol'] = 0;
			$row['attacks'] = $player->GetAttacks();
			$row['patterns'] = $player->GetPatterns();
		}
		else
		{
		  $row['patterns'] = '';
		  $row['npc'] = 0;
      $row['apetail'] = $player->GetApeTail();
      $row['apecontrol'] = $player->GetApeControl();
      $row['race'] = $player->GetRace();
			$row['attacks'] = $player->GetFightAttacks();
		  $ki = ($ilp/10) + ($ikp/10) + $atk + $def;
		  $ki = round($ki / 4);
		}
    $row['ki'] = $ki;
    $row['mki'] = $ki;
		$row['lp'] = $lp;
		$row['ilp'] = $ilp;
		$row['mlp'] = $mlp;
		$row['kp'] = $kp;
		$row['ikp'] = $ikp;
		$row['mkp'] = $mkp;
		$row['attack'] = $atk;
		$row['mattack'] = $player->GetAttack();
		$row['defense'] = $def;
		$row['mdefense'] = $player->GetDefense();
		$row['accuracy'] = $player->GetAccuracy();
		$row['maccuracy'] = $player->GetAccuracy();
		$row['reflex'] = $player->GetReflex();
		$row['mreflex'] = $player->GetReflex();
		$row['transformations'] = $powerup;
		$row['owner'] = $owner;
		$row['fusedacc'] = $fusion;
		$row['fusetimer'] = $fusetimer;
		$row['majincounter'] = 0;
		$row['reflect'] = 0;
		$row['taunt'] = 0;
		if($isNPC)
		{
		$row['isnpc'] = 1;
		}
		else
		{
		$row['isnpc'] = 0;
		}
		$row['lastaction'] = $timestamp;
		$row['action'] = 0;
		$row['inactive'] = false;
		$row['paralyzed'] = false;
		$row['npccontrol'] = false;
		$row['loadattack'] = 0;
		$row['loadrounds'] = 0;
		$row['gainaccs'] = '';
		$row['buffs'] = '';
		$row['dots'] = '';
		$row['energy'] = 0;
		$row['menergy'] = 100;
		$row['race'] = $player->GetRace();
		$row['kicktimer'] = 0;
		
    
    
    $this->AddDebugLog('Create Fighter: '.$player->GetName());
    
    
    foreach ($row as $key => $value) 
    {
      $this->AddDebugLog(' - '.$key.' = '.$value);
    }
    
		$result = $this->database->Insert(
		'acc
    , npc
		, fight
		, team
		, name
		, charimage
		, attacks
		, ki
		, mki
		, lp
		, ilp
		, mlp
		, kp
		, ikp
		, mkp
		, attack
		, mattack
		, defense
		, mdefense
		, accuracy
		, maccuracy
		, reflex
		, mreflex
		, energy
		, menergy
		, isnpc
		, owner
		, lastaction
		, fusedacc
		, transformations
		, buffs
		, dots
		, apetail
		, apecontrol
		, fusetimer
		, patterns
		, race'
		,'"'.$row['acc'].'"
		,"'.$row['npc'].'"
		,"'.$row['fight'].'"
		,"'.$row['team'].'"
		,"'.$row['name'].'"
		,"'.$row['charimage'].'"
		,"'.$row['attacks'].'"
		,"'.$row['ki'].'"
		,"'.$row['mki'].'"
		,"'.$row['lp'].'"
		,"'.$row['ilp'].'"
		,"'.$row['mlp'].'"
		,"'.$row['kp'].'"
		,"'.$row['ikp'].'"
		,"'.$row['mkp'].'"
		,"'.$row['attack'].'"
		,"'.$row['mattack'].'"
		,"'.$row['defense'].'"
		,"'.$row['mdefense'].'"
		,"'.$row['accuracy'].'"
		,"'.$row['maccuracy'].'"
		,"'.$row['reflex'].'"
		,"'.$row['mreflex'].'"
		,"'.$row['energy'].'"
		,"'.$row['menergy'].'"
		,"'.$row['isnpc'].'"
		,"'.$row['owner'].'"
		,"'.$row['lastaction'].'"
		,"'.$row['fusedacc'].'"
		,"'.$row['transformations'].'"
		,"'.$row['buffs'].'"
		,"'.$row['dots'].'"
		,"'.$row['apetail'].'"
		,"'.$row['apecontrol'].'"
		,"'.$row['fusetimer'].'"
		,"'.$row['patterns'].'"
		,"'.$row['race'].'"','fighters');
		
    $result = $this->database->Select('*', 'fighters', 'id="'.$this->database->GetLastID().'"', 1);
		if ($result) 
		{
			if ($result->num_rows > 0)
			{
				$row = $result->fetch_assoc();
			}
			$result->close();
		}
		$fighter = $this->AddFighter($row);
    
    if(!$isNPC)
    {
      
      if($this->GetFighters() == '')
        $fighters = array();
      else
        $fighters = explode(';',$this->GetFighters());
      
      array_push($fighters, '['.$player->GetID().']');
      $fighters = implode(';', $fighters);
      $this->SetFighters($fighters);
		  $result = $this->database->Update('fighters="'.$fighters.'"','fights','id = "'.$this->GetID().'"',1);
    }
		
		if(!$isNPC && $fusion == 0)
		{
    	$player->UpdateFight($this->GetID());
			if($this->GetType() == 3) //NPC
			{
				if($player->GetDailyNPCFights() < 10)
				{
        	$player->SetDailyNPCFights($player->GetDailyNPCFights()+1);
        	$player->UpdateDailyNPCFights();
					$this->AddGainAcc($player->GetID());
				}
			}
			else if($this->GetType() == 4 && $this->GetStory() == $player->GetStory()) //Story
			{
		    $this->AddGainAcc($player->GetID());
			}
      else if($this->GetType() == 5 && $this->GetEventFight() == 0)
      {
				$event = new Event($this->database, $this->GetEvent());
				if($event->GetDecreaseNPCFight() && $player->GetDailyNPCFights() < 10)
        {
            $this->AddGainAcc($player->GetID());
				}
        else if((!$event->GetDecreaseNPCFight() && $event->GetWinable() > $event->GetFinishedTimes($player->GetID())))
        {
            $this->AddGainAcc($player->GetID());
        }
      }
			else if($this->GetType() != 5 && $this->GetType() != 4)
			{
				$this->AddGainAcc($player->GetID());
			}
		}
		return $fighter;
	}
	
	public function DeleteFighter($player)
	{
    if($player->GetID() != -1)
    {
      $newFighterArray = array();
      $fighters = explode(';',$this->GetFighters());
      
      $rFighterID = '['.$player->GetID().']';
      foreach ($fighters as &$fighterID) 
      {
        if($fighterID != $rFighterID)
          array_push($newFighterArray, $fighterID);
      }
      
      $newFighterArray = implode(';', $newFighterArray);
      $this->SetFighters($newFighterArray);
      $result = $this->database->Update('fighters="'.$newFighterArray.'"','fights','id = "'.$this->GetID().'"',1);
    }
    
    
    $this->database->Delete('fighters','acc="'.$player->GetID().'"');
		$this->RemoveFighter($player->GetID());
    $player->UpdateFight(0);
	}
	
  static function CreateFight($player, $database, $type, $name, $mode, $levelup=0, $actionManager=null, $zeni=0, 
															$items=0, $story=0, $challenge=0, $survivalteam=0, $survivalrounds=0, $survivalwinner=0, 
                              $event=0, $healing=0, $eventfight=0, $tournament=0, $dragonball=0, $npcid=0, $difficulty=0,
                              $healthRatio=0, $healthRatioTeam=0, $healthRatioWinner=0)
  {
    if($player != null && $player->GetFight() != 0)
    {
      echo 'Player is invalid!<br/>';
      return false;
    }
		
		$place = '';
		$planet = '';
		if($player != null)
		{
			$place = $player->GetPlace();
			$planet = $player->GetPlanet();
		}
		
		//1 = Sonne
		//2 = Wolken
		//3 = Sternen
		//4 = Mond
		$weather = rand(1,10);
		if($weather > 4)
		{
			$weather = 1;
		}
    $name = $database->EscapeString($name);
	  $name = htmlentities($name, ENT_QUOTES | ENT_XML1);
    
	  $type = $database->EscapeString($type);
	  $mode = $database->EscapeString($mode);
    
		$result = $database->Insert('name, type, mode, place, levelup, planet, zeni, 
                                items, story, challenge, survivalteam, survivalrounds, survivalwinner, 
                                event, healing, eventfight, tournament, dragonball, weather, npcid
                                , npcmode, healthratio, healthratioteam, healthratiowinner', 
																'"'.$name.'","'.$type.'","'.$mode.'", "'.$place.'", "'.$levelup.'", "'.$planet.'","'.$zeni.'",
																"'.$items.'","'.$story.'","'.$challenge.'","'.$survivalteam.'","'.$survivalrounds.'","'.$survivalwinner.'",
																"'.$event.'","'.$healing.'","'.$eventfight.'","'.$tournament.'","'.$dragonball.'","'.$weather.'","'.$npcid.'"
                                ,"'.$difficulty.'","'.$healthRatio.'","'.$healthRatioTeam.'","'.$healthRatioWinner.'"', 'fights');
    
		if(!$result)
    {
			echo 'Could not create Fight<br/>';
      return false;
    }
		
		$lastID = $database->GetLastID();
    $fight = new Fight($database, $lastID, $player, $actionManager);
		$fight->SetID($lastID);
		$fight->SetName($name);
		$fight->SetTournament($tournament);
		$fight->SetType($type);
		$fight->SetMode($mode);
		$fight->SetPlace($place);
		$fight->SetLevelup($levelup);
		$fight->SetPlanet($planet);
		$fight->SetZeni($zeni);
		$fight->SetItems($items);
		$fight->SetStory($story);
		$fight->SetChallenge($challenge);
		$fight->SetSurvivalTeam($survivalteam);
		$fight->SetSurvivalRounds($survivalrounds);
		$fight->SetSurvivalWinner($survivalwinner);
		$fight->SetHealthRatio($healthRatio);
		$fight->SetHealthRatioTeam($healthRatioTeam);
		$fight->SetHealthRatioWinner($healthRatioWinner);
		$fight->SetState(0);
		$fight->SetRound(1);
		$fight->SetText('');
		$fight->SetWeather($weather);
		$fight->SetDebugLog('');
		$fight->SetFighters('');
		if($player != null)
		{
			$fight->CreateFighter($player, 0, false);
		}
    return $fight;
  }
  
  static function ValidateMode($mode)
  {
    if(strlen($mode) > 30)
    {
      return false;
    }
    
    $teams = explode('vs', $mode);
    $i = 0;
    
    $returnMode = '';
    while(isset($teams[$i]))
    {
      if(!is_numeric($teams[$i]) || $teams[$i] <= 0 || $teams[$i] > 100)
      {
        return false;
      }
      
      if($returnMode == '')
      {
        $returnMode = $teams[$i];
      }
      else
      {
        $returnMode = $returnMode.'vs'.$teams[$i];
      }
      ++$i;
    }
    
    return $returnMode;
  }
  
  
}