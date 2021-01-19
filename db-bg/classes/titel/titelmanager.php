<?php
if($database == NULL)
{
	print 'This File ('.__FILE__.') should be after Datatabase!';
}

include_once 'titel.php';

class TitelManager
{
	
	private $database;
  private $titels;
	
	function __construct($db)
	{
    $this->database = $db;
    $this->titels = array();
    $this->LoadData();
  }
  
  private function LoadData()
  {
		$result = $this->database->Select('*','titel','',99999);
		if ($result) 
		{
			if ($result->num_rows > 0)
			{
        while($row = $result->fetch_assoc()) 
        {
		      $titel = new Titel($row);
					array_push($this->titels, $titel);
        }
			}
			$result->close();
      
		}
  }
  
  private function LoadProgress($playerid, $titleid)
  {
		$result = $this->database->Select('*','titelprogress','acc = "'.$playerid.'" AND titel="'.$titleid.'"',1);
		if ($result) 
		{
			if ($result->num_rows > 0)
			{
				$row = $result->fetch_assoc();
			  $result->close();
        return $row;
			}
			$result->close();
		} 
    return null;
  }
  
  public function AddTitelAttack($playerid, $playertitels, $progress, $attack, $fight)
  {
    foreach($this->titels as &$titel)
    {
      //TitleSort = 3 == Total
      if(!in_array($titel->GetID(), $playertitels) && $titel->GetType() == 7 && ($titel->GetFight() == $fight || $titel->GetFight() == -1) && $attack == $titel->GetAttack())
      {
        $this->AddTitelWithProgress($playerid, $playertitels, $progress, $titel);
      }
    }
  }
  
  public function AddTitelWish($player, $wish)
  {
    $titels = $player->GetTitels();
    foreach($this->titels as &$titel)
    {
      if(!$player->HasTitel($titel->GetID()) && $titel->GetType() == 4 && $titel->GetCondition()  == $wish)
      {
        $this->AddTitelWithProgress($player->GetID(), $titels, $progress, $titel);
      }
    }
  }
  
  public function AddTitelStory($player, $story)
  {
    $titels = $player->GetTitels();
    foreach($this->titels as &$titel)
    {
      if(!$player->HasTitel($titel->GetID()) && $titel->GetType() == 2 && $titel->GetCondition() < $story)
      {
        $this->AddTitelWithProgress($player->GetID(), $titels, $titel->GetCondition(), $titel);
      }
    }
  }
  
  public function AddTitelAction($player, $progress, $action)
  {
    $titels = $player->GetTitels();
    foreach($this->titels as &$titel)
    {
      if(!$player->HasTitel($titel->GetID()) && $titel->GetType() == 3 && $titel->GetAction() == $action)
      {
        $this->AddTitelWithProgress($player->GetID(), $titels, $progress, $titel);
      }
    }
  }
  
  public function AddTitelFight($player, $progress, $fight, $sort)
  {
    $titels = $player->GetTitels();
    foreach($this->titels as &$titel)
    {
      //TitleSort = 3 == Total
      if(!$player->HasTitel($titel->GetID()) && $titel->GetType() == 6 && ($titel->GetFight() == $fight || $titel->GetFight() == -1) && ($titel->GetSort() == $sort || $titel->GetSort() == 3))
      {
        $this->AddTitelWithProgress($player->GetID(), $titels, $progress, $titel);
      }
    }
   }
  
  
  public function AddTitelNPC($player, $progress, $npc, $fight, $sort)
  {
    $titels = $player->GetTitels();
    foreach($this->titels as &$titel)
    {
      //TitleSort = 3 == Total
      if(!$player->HasTitel($titel->GetID()) && $titel->GetType() == 1 && $titel->GetNPC() == $npc && ($titel->GetFight() == $fight || $titel->GetFight() == -1) && ($titel->GetSort() == $sort || $titel->GetSort() == 3))
      {
        $this->AddTitelWithProgress($player->GetID(), $titels, $progress, $titel);
      }
    }
  }
  
  private function AddTitelWithProgress($playerid, &$playertitels, $progress, $titel)
  {
    if(in_array($titel->GetID(), $playertitels))
      return;
    
    if($titel->GetCondition() != $progress)
    {
      $progress = $this->AddProgressForPlayer($playerid, $progress, $titel);
    }
    
    if($titel->GetCondition() == $progress)
      $this->AddTitel($playerid, $playertitels, $titel);
  }
  
  private function AddProgressForPlayer($playerid, $progress, $titel)
  {
      $titleprogress = $this->LoadProgress($playerid, $titel->GetID());
      if($titleprogress == null)
      {
          $result = $this->database->Insert('acc, titel, progress','"'.$playerid.'","'.$titel->GetID().'","'.$progress.'"', 'titelprogress');
          
          $titleprogress = array();
          $titleprogress['id'] = $this->database->GetLastID();
          $titleprogress['acc'] = $playerid;
          $titleprogress['titel'] = $titel->GetID();
          $titleprogress['progress'] = $progress;
      }
      else
      {
          $titleprogress['progress'] += $progress;
      }
    
    if($titleprogress['progress'] >= $titel->GetCondition())
    {
      $titleprogress['progress'] = $titel->GetCondition();
		  $result = $this->database->Delete('titelprogress','id = "'.$titleprogress['id'].'"',1);
    }
    else
    {
		  $result = $this->database->Update('progress = "'.$titleprogress['progress'].'"','titelprogress','id="'.$titleprogress['id'].'"',1);
    }
    
    return $titleprogress['progress'];
  }
  
  private function AddTitel($playerid, &$playertitels, $titel)
  {
	  $result = $this->database->Delete('titelprogress','acc = "'.$playerid.'" AND title="'.$titel->GetID().'"',1);
    
    array_push($playertitels, $titel->GetID());
    $playerTitelStr = implode(';',$playertitels);
    $set = 'titels = "'.$playerTitelStr.'"';
		$result = $this->database->Update($set,'accounts','id = "'.$playerid.'"',1);
    
    $itemID = $titel->GetItem();
    if($itemID != 0)
    {
      $addAmount = 1;
      $statstype = 0;
      $upgrade = 0;
		  $result = $this->database->Insert('statsid, visualid, ownerid, amount, statstype, upgrade',
                                        '"'.$itemID.'","'.$itemID.'","'.$playerid.'","'.$addAmount.'","'.$statstype.'","'.$upgrade.'"', 'inventory');
    }
  }
  
  public function GetTitels()
  {
    return $this->titels;
  }
	
  public function GetTitel($id)
  {
    $i = 0;
    while(isset($this->titels[$i]))
    {
      if($this->titels[$i]->GetID() == $id)
      {
        return $this->titels[$i];
      }
     ++$i; 
    }
    return null;
  }
  
}