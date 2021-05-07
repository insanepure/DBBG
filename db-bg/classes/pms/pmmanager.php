<?php
ini_set('memory_limit', '-1');
if($database == NULL)
{
	print 'This File ('.__FILE__.') should be after Datatabase!';
}

include_once 'pm.php';

class PMManager
{
	
	private $database;
  private $pms;
  private $playerID;
  private $unreadPMs;
	function __construct($db, $playerID)
	{
    $this->database = $db;
    $this->pms = array();
    $this->playerID = $playerID;
    $this->unreadPMs = 0;
	$this->unreadPMs2 = 0;
    $this->LoadUnreadPMs();
	$this->LoadSystemPMs();
  }
  
  public function GetUnreadPMs()
  {
    return $this->unreadPMs;
  }
   
  public function GetSystemPMs()
  {
    return $this->unreadPMs2;
  }
  private function LoadUnreadPMs()
  {
    //SELECT COUNT(id) as total FROM `pms` WHERE `receiverid` = 1 AND `read` = 0
    $result = $this->database->Select('COUNT(id) as total','pms','`receiverid` = '.$this->playerID.' AND `read` = 0 AND `senderid` != 0');
		if ($result) 
		{
      $row = $result->fetch_assoc();
	    $this->unreadPMs = $row['total'];

			$result->close();
		}
  }
  
  private function LoadSystemPMs()
  {
    //SELECT COUNT(id) as total FROM `pms` WHERE `receiverid` = 1 AND `read` = 0
    $result = $this->database->Select('COUNT(id) as total','pms','`receiverid` = '.$this->playerID.' AND `read` = 0 AND `senderid` = 0');
		if ($result) 
		{
      $row = $result->fetch_assoc();
	    $this->unreadPMs2 = $row['total'];

			$result->close();
		}
  }
	
	public function DeleteAll($systemPMs, $pid)
  {
    if(!$systemPMs)
    {
		  $result = $this->database->Delete('pms','`senderid` != 0 AND `receiverid`='.$pid.'',999999999);
	    $this->unreadPMs = 0;
    }
    else
    {
		  $result = $this->database->Delete('pms','`senderid` = 0 AND `receiverid`='.$pid.'',999999999);
	    $this->unreadPMs2 = 0;
    }
  }
	
	public function Delete($ids, $pid)
	{
		$where = '';
		$i = 0;
		while(isset($ids[$i]))
		{
			$id = $ids[$i];
			if(!is_numeric($id))
			{
				++$i;
				continue;
			}
			$pm = $this->LoadPM($id);
			if($pm == null)
			{
				++$i;
				continue;
			}
			if($pm->GetRead() == false)
			{
        if($pm->GetSenderID() != 0)
				  $this->unreadPMs = $this->unreadPMs-1;
        else
				  $this->unreadPMs2 = $this->unreadPMs2-1;
			}
			
			$whereText = '`id`='.$id.'';
			if($where == '')
			{
				$where = $whereText;
			}
			else
			{
				$where = $where.' OR '.$whereText;
			}
			
			++$i;
		}
		
		if($where == '')
		{
			return;
		}
		
		$result = $this->database->Delete('pms','('.$where.') AND `receiverid`='.$pid.'',1);
	}
	
	public function ReadAllOnly($ids, $pid)
	{
		$where = '';
		$i = 0;
    $count = 0;
		while(isset($ids[$i]))
		{
			$id = $ids[$i];
			if(!is_numeric($id))
			{
				++$i;
				continue;
			}
			$pm = $this->LoadPM($id);
			if($pm == null)
			{
				++$i;
				continue;
			}
			if($pm->GetRead())
			{
				++$i;
				continue;
			}
      
        if($pm->GetSenderID() != 0)
				  $this->unreadPMs = $this->unreadPMs-1;
        else
				  $this->unreadPMs2 = $this->unreadPMs2-1;
			
			$whereText = '`id`='.$id.'';
			if($where == '')
			{
				$where = $whereText;
			}
			else
			{
				$where = $where.' OR '.$whereText;
			}
      ++$count;
			
			++$i;
		}
		
		if($where == '')
		{
			return;
		}
		
		$result = $this->database->Update('`read`= !`read`','pms','('.$where.') AND `receiverid`='.$pid.'',$count);
	}
	
	public function ReadAll($ids, $pid)
	{
		$where = '';
		$i = 0;
    $count = 0;
		while(isset($ids[$i]))
		{
			$id = $ids[$i];
			if(!is_numeric($id))
			{
				++$i;
				continue;
			}
			$pm = $this->LoadPM($id);
			if($pm == null)
			{
				++$i;
				continue;
			}
			if($pm->GetRead() == false)
			{
        if($pm->GetSenderID() != 0)
				  $this->unreadPMs = $this->unreadPMs-1;
        else
				  $this->unreadPMs2 = $this->unreadPMs2-1;
			}
      else
      {
        if($pm->GetSenderID() != 0)
				  $this->unreadPMs = $this->unreadPMs+1;
        else
				  $this->unreadPMs2 = $this->unreadPMs2+1;
      }
			
			$whereText = '`id`='.$id.'';
			if($where == '')
			{
				$where = $whereText;
			}
			else
			{
				$where = $where.' OR '.$whereText;
			}
      ++$count;
			
			++$i;
		}
		
		if($where == '')
		{
			return;
		}
		
		$result = $this->database->Update('`read`= !`read`','pms','('.$where.') AND `receiverid`='.$pid.'',$count);
	}
	
	public function Read($id, $pid)
	{
		$pm = $this->LoadPM($id);
		if($pm == null || $pm->GetRead() || $pm->GetReceiverID() != $pid)
		{
			return;
		}
    if($pm->GetSenderID() != 0)
		  $this->unreadPMs = $this->unreadPMs-1;
    else
		  $this->unreadPMs2 = $this->unreadPMs2-1;
		$result = $this->database->Update('`read`=1','pms','`id`='.$id.' AND `receiverid`='.$pid.'',1);
	}
	
	public function SendPMToAll($id, $image, $name, $title, $text, $isHTML=0)
	{
    $result = $this->database->Select('*','accounts','', 9999999);
		$tid = 0;
		if ($result) 
		{
    	$timestamp = date('Y-m-d H:i:s');
      while($row = $result->fetch_assoc()) 
      {
				$tid = $row['id'];
				$tname = $row['name'];
				$result2 = $this->database->Insert('`sendername`, `senderimage`, `senderid`, `receiverid`, `receivername`, `text`, `time`, `topic`, `read`, `ishtml`', 
																	'"'.$name.'","'.$image.'","'.$id.'","'.$tid.'","'.$tname.'","'.$text.'","'.$timestamp.'","'.$title.'", "0", "'.$isHTML.'"', 'pms');
      }
			$result->close();
			
		}
		else
		{
			return false;
		}
		
		return true;
	}
	
	public function SendPM($id, $image, $name, $title, $text, $tname, $isHTML=0)
	{
    $result = $this->database->Select('*','accounts','name="'.$tname.'"', 1);
		$tid = 0;
		if ($result) 
		{
      $row = $result->fetch_assoc();
			$tid = $row['id'];
      $blocked = explode(';', $row['blocked']);
			$result->close();
			
			if($tid == 0 || $tid == '' || $id != 0 && in_array($id, $blocked))
			{
				return false;
			}
    	$timestamp = date('Y-m-d H:i:s');
			
			$result = $this->database->Insert('`sendername`, `senderimage`, `senderid`, `receiverid`, `receivername`, `text`, `time`, `topic`, `read`, `ishtml`', 
																	'"'.$name.'","'.$image.'","'.$id.'","'.$tid.'","'.$tname.'","'.$text.'","'.$timestamp.'","'.$title.'", "0", "'.$isHTML.'"', 'pms');
			if($id == $tid)
			{
    		$this->unreadPMs = $this->unreadPMs+1;
			}
			if(!$result)
			{
				return false;
			}
			
		}
		else
		{
			return false;
		}
		
		return true;
	}
  
  public function LoadOutbox($start, $limit)
  {
    $this->LoadPMs(false, $start, $limit, false);
  }
  
  public function LoadInbox($start, $limit, $system)
  {
    $this->LoadPMs(true, $start, $limit, $system);
  }
  
  public function LoadPM($id)
  {
    $pm = null;
		$result = $this->database->Select('*','pms','`id` = '.$id.' AND (`receiverid` = '.$this->playerID.' OR `senderid` = '.$this->playerID.')',1);
		if ($result) 
		{
			if ($result->num_rows > 0)
			{
				$row = $result->fetch_assoc();
        $pm = new PM($row);
			}
			$result->close();
		} 
    return $pm;
  }
  
  public function GetPM($id)
  {
    if(count($this->pms) > $id && $id >= 0)
    {
      return $this->pms[$id];
    }
    return null;
  }
  
  private function LoadPMs($inbox, $start, $limit, $system)
  {
    $where = '';
    if($inbox)
    {
      $where = 'receiverid='.$this->playerID.'';
      if($system)
      {
        $where = $where.' AND senderid=0';
      }
      else
      {
        $where = $where.' AND senderid != 0';
      }
    }
    else
    {
      $where = 'senderid='.$this->playerID.'';
    }
		$result = $this->database->Select('*','pms',$where,$start.','.$limit,'time','DESC');
		if ($result) 
		{
			if ($result->num_rows > 0)
			{
        while($row = $result->fetch_assoc()) 
        {
					$pm = new PM($row);
					array_push($this->pms, $pm);
        }
			}
			$result->close();
		}
  }
  
  
  public function LoadPMCount($inbox, $system)
  {
    $where = '';
    if($inbox)
    {
      $where = 'receiverid='.$this->playerID.'';
      if($system)
      {
        $where = $where.' AND senderid=0';
      }
      else
      {
        $where = $where.' AND senderid != 0';
      }
    }
    else
    {
      $where = 'senderid='.$this->playerID.'';
    }
    $total = 0;
    //SELECT COUNT(id) as total FROM `pms` WHERE `receiverid` = 1 AND `read` = 0
    $result = $this->database->Select('COUNT(id) as total','pms', $where);
		if ($result) 
		{
      $row = $result->fetch_assoc();
	    $total = $row['total'];

			$result->close();
		}
    return $total;
  }
  
}