<?php
if($database == NULL)
{
	print 'This File ('.__FILE__.') should be after Datatabase!';
}

include_once 'tournamentfighter.php';

class Tournament
{
	private $data;
	private $database;
	private $fighters;
	private $slotset;
	private $brackets;
  
	function __construct($data, $db)
	{
		$this->data = $data;
		$this->database = $db;
		$this->slotset = false;
		$this->fighters = array();
		$this->brackets = array();
		
		if($this->IsStarted() && $this->data['brackets'] == '')
		{
			//Initialize Player's and NPCs
			$this->AddReadyPlayers();
			
			if($this->GetParticipantSize() == 0)
			{
				//Not enough players
				return;
			}
			
			if($this->data['npcs'] != '')
			{
				$this->AddNPCs();
			}
		}
		else
		{
			$this->LoadFighters();
		}
		
		
		if($this->IsStarted() && $this->GetParticipantSize() != 0)
		{
			if($this->data['brackets'] == '')
			{
				$this->InitBrackets();
			}
			else
			{
				$this->LoadBrackets();
			}
		}
	}
	
	private function AddNPCs()
	{
		$npcs = $this->GetNPCs();
		$participants = $this->GetParticipantSize();
		$leftSize = $this->GetMaxPlayers() - $participants;
		if($leftSize == 0)
		{
			return;
		}
		
		$addSize = count($npcs);
		if($addSize > $leftSize)
		{
			$addSize = $leftSize;
		}
		for ($i = 0; $i < $addSize; $i++) 
		{
			$npcSize = count($npcs);
			$randomNPC = rand() % $npcSize;
			$npcID = $npcs[$randomNPC];
			array_splice($npcs, $randomNPC, 1);
			$npc = new NPC($this->database, $npcID, 1);
			$this->AddFighter($npc->GetID(), true, $npc->GetName(), $npc->GetImageName());
		}
		
	}
	
	private function AddReadyPlayers()
	{
		$where = 'pendingtournament="'.$this->GetID().'" AND tournament="0" AND place="'.$this->GetPlace().'" AND planet = "'.$this->GetPlanet().'" AND fight = "0"';
		
		$result = $this->database->Select('*','accounts',$where,99999);
		if ($result) 
		{
			if ($result->num_rows > 0)
			{
				while($row = $result->fetch_assoc()) 
				{
					$this->AddFighter($row['id'], false, $row['name'], $row['charimage']);
				}
			}
			$result->close();
		}
		
		$result = $this->database->Update('tournament="'.$this->GetID().'"','accounts',$where,9999999);
		$result = $this->database->Update('pendingtournament="0"','accounts','pendingtournament="'.$this->GetID().'" AND tournament != pendingtournament',9999999);
	}
	
	private function next_pow($number)
	{
		if($number && ($number & ($number - 1)) === 0)
		{
			return $number;
		}
		if($number < 2) return 1;
		for($i = 0 ; $number > 1 ; $i++)
		{
				$number = $number >> 1;
		}
		return 1<<($i+1);
	}
	
	public function MoveToNextBracket($cell)
	{
		$round = $this->GetRound();
		$bracket = $this->brackets[$round];
		$fighter = $bracket[$cell];
		$otherCell = $cell;
		if($cell % 2 == 0)
		{
			$otherCell++;
		}
		else
		{
			$otherCell--;
		}
		
		if(isset($bracket[$otherCell]))
		{
			$otherFighter = $bracket[$otherCell];
			$this->DefeatCell($otherCell);
		}
		
		$nextSlot = floor($cell / 2);
		$this->brackets[$round+1][$nextSlot] = $fighter;
		$this->brackets[$round+1][$nextSlot][2] = $nextSlot;
	}
	
	public function DefeatCell($cell)
	{
		$round = $this->GetRound();
		$this->brackets[$round][$cell][1] = false;
	}
  
  public function getSecondsSinceLastAction($fighter)
  {
		$where = 'id="'.$fighter->GetFighterID().'"';
		$result = $this->database->Select('id, lastaction','accounts',$where,1);
		if ($result) 
		{
			if ($result->num_rows > 0)
			{
				while($row = $result->fetch_assoc()) 
				{
		      $lastaction = strtotime($row['lastaction']);
		      return time() - $lastaction;
				}
			}
			$result->close();
		}
    return 0;
  }
	
	public function UpdateFights()
	{
		$needUpdate = false;
		
		$round = $this->GetRound();
		$bracket = $this->brackets[$round];
	//	echo "<pre>";
//print_r($this->brackets);
//echo  '</pre>';
//echo '<br/>';
//echo $round;
		$j = 0;
		
		while(isset($bracket[$j]))
		{
			$fighter = $bracket[$j][0];
			$alive = $bracket[$j][1];
      if($alive && !$this->FindInBracket($fighter->GetID(), $round+1))
      {
        $otherFighter = null;
        if(isset($bracket[$j+1]))
        {
          $otherFighter = $bracket[$j+1][0];
          if($fighter->IsNPC() && $otherFighter->IsNPC())
          {
            //Determine who is stronger
            $npc = new NPC($this->database, $fighter->GetFighterID(), 1);
            $otherNPC = new NPC($this->database, $otherFighter->GetFighterID(), 1);

            if($npc->GetKI() > $otherNPC->GetKI())
            {
              $this->MoveToNextBracket($j);
            }
            else
            {
              $this->MoveToNextBracket($j+1);
            }
            $needUpdate = true;
          }
          else
          {
            $fighterTime = 0;
            $otherTime = 0;
            if(!$fighter->IsNPC())
              $fighterTime = $this->getSecondsSinceLastAction($fighter);
            if(!$otherFighter->IsNPC())
              $otherTime = $this->getSecondsSinceLastAction($otherFighter);
            
            $timeout = 60 * 5; //5 minutes
            
            if($fighterTime > $timeout)
              $this->MoveToNextBracket($j+1);
            else if($otherTime > $timeout)
              $this->MoveToNextBracket($j);
          }
        }
        else
        {
          $this->MoveToNextBracket($j);
          $needUpdate = true;
        }
      }
			$j = $j + 2; // we don't need to look for every fighter, just every 2
		}
		
		if(!$needUpdate)
		{
			return;	
		}
		$this->UpdateBrackets();
	}
	
	private function FindInBracket($id, $index)
	{
		if(!isset($this->brackets[$index]))
		{
			return false;
		}
		$bracket = $this->brackets[$index];
		foreach($bracket as &$fighterBracket)
		{
			$fighter = $fighterBracket[0];
			if($fighter->GetID() == $id)
			{
				return true;
			}
		}
		return false;
	}
	
	public function GetBracketCount()
	{
		return $this->next_pow($this->GetParticipantSize());
	}
	
  public function GetID()
  {
    return $this->data['id'];
  }
	
  public function GetRound()
  {
    return $this->data['round'];
  }
  public function SetRound($value)
  {
    $this->data['round'] = $value;
  }
	
  public function IsEnd()
  {
    return $this->data['end'];
  }
  public function SetEnd($value)
  {
    $this->data['end'] = $value;
  }
  
  public function GetName()
  {
    return $this->data['name'];
  }
  
  public function GetMaxPlayers()
  {
    return $this->data['maxplayers'];
  }
  
  public function GetNPCs()
  {
    return explode(';',$this->data['npcs']);
  }
  
  public function GetImage()
  {
    return $this->data['image'];
  }
  
  public function GetZeni()
  {
    return $this->data['zeni'];
  }
  
  public function GetItems()
  {
    return $this->data['items'];
  }
  
  public function GetPlayerInfo($player, &$pFighter, &$pAlive, &$pRound, &$pCell)
  {
		$i = count($this->brackets)-1;
		while($i >= 0)
		{
			$bracket = $this->brackets[$i];
			
			foreach($bracket as &$fighterBracket)
			{
				$fighter = $fighterBracket[0];
				$alive = $fighterBracket[1];
				if($fighter->GetFighterID() == $player->GetID() && !$fighter->IsNPC())
				{
					$pFighter = $fighter;
					$pAlive = $alive;
					$pRound = $i;
					$pCell = $fighterBracket[2];
					return true;
				}
			}
			
			--$i;
		}
		return false;
  }
	
	private function LoadBrackets()
	{
		$brackets = explode('@',$this->data['brackets']);
		$i = 0;
		while(isset($brackets[$i]))
		{
			$this->brackets[$i] = array();
			
			$bracket = explode(';',$brackets[$i]);
			$j = 0;
			while(isset($bracket[$j]))
			{
				
				$fighterBracket = explode(':',$bracket[$j]);
				$fighter = $this->GetFighter($fighterBracket[0]);
				$cell = $fighterBracket[2];
				$this->brackets[$i][$cell] = array();
				
				$this->brackets[$i][$cell][0] = $fighter;
				$this->brackets[$i][$cell][1] = $fighterBracket[1];
				$this->brackets[$i][$cell][2] = $cell;
				
				++$j;
			}
			++$i;
		}
	}
	
	private function InitBrackets()
	{
		$this->brackets[0] = array();
		
		$tmpFighters = $this->fighters;
		shuffle($tmpFighters);
		
		$slot = 0;
		foreach($tmpFighters as &$fighter)
		{
			$this->brackets[0][$slot] = array();
			
			$this->brackets[0][$slot][0] = $fighter;
			$this->brackets[0][$slot][1] = 1;
			$this->brackets[0][$slot][2] = $slot;
			++$slot;
		}
		
		$this->UpdateBrackets();
	}
	
	public function UpdateBrackets()
	{
		$round = $this->GetRound();
		$totalCount = count($this->brackets[$round]);
		$deadCount = 0;
		$winner = 0;
    
		$string = '';
		$i = 0;
		while(isset($this->brackets[$i]))
		{
			$bracket = $this->brackets[$i];
			$substring = '';
			
			foreach($bracket as &$fighterBracket)
			{
				$fighter = $fighterBracket[0];
				$alive = $fighterBracket[1];
				$slot = $fighterBracket[2];
				$fighterString = $fighter->GetID();
				if($alive)
				{
          $winner = $fighter;
					$fighterString = $fighterString.':1:'.$slot;
				}
				else
				{
					$fighterString = $fighterString.':0:'.$slot;
					if($i == $round)
					{
						$deadCount++;
					}
				}
				
				if($substring == '')
				{
					$substring = $fighterString;
				}
				else
				{
					$substring = $substring.';'.$fighterString;
				}
			}
			
			if($string == '')
			{
				$string = $substring;
			}
			else
			{
				$string = $string.'@'.$substring;
			}
			++$i;
		}
		
		$update = '`brackets`="'.$string.'"';
		if($deadCount == floor($totalCount/2))
		{
			$update = $update.',`round`="'.($round+1).'"';
			$this->SetRound($round+1);
			
			//One is dead and it's the next round, so end the tournament
			if($deadCount == 1 && $totalCount == 2)
			{
				$this->SetEnd(true);
				$update = $update.',`end`="1"';
				$result = $this->database->Update('tournament="0", pendingtournament="0"','accounts','`tournament`="'.$this->GetID().'"',9999999);
        
        $fighterID = $winner->GetFighterID();
        
			  $itemManager = new ItemManager($this->database);
				$player = new Player($this->database, $fighterID, NULL);
        
        $zeni = $this->GetZeni();
				$zeni = $player->GetZeni() + $zeni;
				$player->SetZeni($zeni);
        
				$items = explode(';',$this->GetItems());
        $wonItems = '';
        $pUpdate = 'zeni='.$zeni;
        foreach($items as &$item)
        {
				  $item = explode('@',$item);
				  $itemID = $item[0];
				  $amount = $item[1];
				  $item = $itemManager->GetItem($itemID);
				  $player->AddItems($item,$item, $amount);
          $wonItem = $itemID.'@'.$itemID;
					if($wonItems == '')
					{
						$wonItems = $wonItem;
					}
					else
					{
						$wonItems = $wonItems.';'.$wonItem;
					}
					
					$player->SetNPCWonItems($wonItems);
					$pUpdate = $pUpdate.',npcwonitems="'.$wonItems.'"';
        }
        
		    $result = $this->database->Update($pUpdate,'accounts','`id`="'.$player->GetID().'"',1);
			}
		}
		
		$result = $this->database->Update($update,'tournaments','`id`="'.$this->GetID().'"',1);
	}
	
	public function GetFighter($id)
	{
				return $this->fighters[$id];	
	}
	
	public function GetBracket($cell, $round)
	{
		if(!isset($this->brackets[$round]))
		{
		 	return null;
		}
		if(!isset($this->brackets[$round][$cell]))
		{
			return null;
		}
		return $this->brackets[$round][$cell];
	}
	
	public function LoadFighters()
	{
		$result = $this->database->Select('*','tournamentfighter','tournament="'.$this->GetID().'"',99999);
		if ($result) 
		{
			if ($result->num_rows > 0)
			{
        while($row = $result->fetch_assoc()) 
        {
					$fighter = new TournamentFighter($row);
					$this->fighters[$fighter->GetID()] = $fighter;
        }
			}
			$result->close();
		}
	}
	
	public function IsStarted()
	{
		$startTime = strtotime($this->GetStartTime());
		$currentTime = strtotime("now");
		return $currentTime > $startTime;
	}
	
	public function AddFighter($id, $npc, $name, $image)
	{
		$result = $this->database->Insert('`fighterid`, `name`, `image`, `npc`, `tournament`',
																				'"'.$id.'","'.$name.'","'.$image.'","'.$npc.'","'.$this->GetID().'"', 'tournamentfighter');
		$id = $this->database->GetLastID();
		$row['id'] = $id;
		$row['fighterid'] = $id;
		$row['name'] = $name;
		$row['npc'] = $npc;
		$row['image'] = $image;
		$row['tournament'] = $this->GetID();
		$fighter = new TournamentFighter($row);
		$this->fighters[$fighter->GetID()] = $fighter;
	}
	
	public function RemoveFighter($id, $npc)
	{
		foreach ($this->fighters as &$fighter) 
		{
			if($fighter->GetFighterID() == $id && $fighter->IsNPC() == $npc)
			{
				$id = $fighter->GetID();
				unset($this->fighters[$id]);
				$result = $this->database->Delete('tournamentfighter','`id`="'.$id.'"',1);
				return;
			}
		}
	}
  
  public function GetParticipantSize()
  {
		return count($this->fighters);
  }
  
  public function GetStartTimeFormatted()
  {
    return date('d.M H:i',strtotime($this->data['starttime']));
  }
  
  public function GetStartTime()
  {
    return $this->data['starttime'];
  }
  
  public function GetPlanet()
  {
    return $this->data['planet'];
  }
  
  public function GetPlace()
  {
    return $this->data['place'];
  }
  
}