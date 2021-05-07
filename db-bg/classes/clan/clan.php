<?php
if($database == NULL)
{
	print 'This File ('.__FILE__.') should be after Datatabase!';
}

include_once 'clanlogmessage.php';
include_once 'clanshoutboxmsg.php';

function CreateClan($database, $name, $tag, $player)
{
	$name = $database->EscapeString($name);
  $result = $database->Select('*', 'clans', 'name="'.$name.'" OR tag="'.$tag.'"', 1);
	if ($result) 
	{
		if ($result->num_rows > 0)
		{
		  $result->close();
      return false;
		}
		$result->close();
	}
	$result = $database->Insert('name, tag, points, leader, members','"'.$name.'","'.$tag.'",0,'.$player->GetID().',1', 'clans');
  $clanID = $database->GetLastID();
  
  $player->SetClan($clanID);
  $player->SetClanName($name);
	
  $result = $database->Select('COUNT(id) as total','clans','');
	$rank = 0;
	if ($result) 
	{
    $row = $result->fetch_assoc();
    $rank = $row['total'];
		$result->close();
	}
	$result = $database->Update('rang="'.$rank.'"','clans','id = '.$clanID.'',1);
  
	$result = $database->Update('clan="'.$clanID.'",clanname="'.$name.'"','accounts','id = '.$player->GetID().'',1);
  return true;
}

class Clan
{
	private $database;
  private $data;
  private $valid;
	private $messages;
	private $shoutbox;
  
	function __construct($db, $id, $select = '*')
  {
    $this->database = $db;
    $this->valid = false;
		$this->messages = array();
		$this->shoutbox = array();
    $this->LoadData($id, $select);
  }
	
	public function LoadShoutbox($data)
	{
		if($data == '')
		{
			return;
		}
		$users = explode('@',$data);
		$i = 0;
		while(isset($users[$i]))
		{
			$msg = explode(';',$users[$i]);
			$clanmsg = new ClanShoutboxMSG($msg);
			array_push($this->shoutbox, $clanmsg);
			++$i;
		}
	}
	
	public function LoadMessages($data)
	{
		if($data == '')
		{
			return;
		}
		$users = explode('@',$data);
		$i = 0;
		while(isset($users[$i]))
		{
			$msg = explode(';',$users[$i]);
			$clanmsg = new ClanLogMessage($msg);
			array_push($this->messages, $clanmsg);
			++$i;
		}
	}
	
  public static function FindByName($database, $name) 
	{
    $result = $database->Select('id', 'clans', 'name="'.$name.'"', 1);
		if ($result) 
		{
			if ($result->num_rows > 0)
			{
				$row = $result->fetch_assoc();
				return $row['id'];
			}
			$result->close();
		}
		return 0;
	}
	
	public function PlayerJoins()
	{
		$members = $this->GetMembers();
		$members = $members+1;
		$this->SetMembers($members);
		$result = $this->database->Update('members="'.$members.'"','clans','id = '.$this->GetID().'',1);
	}
	
	public function PlayerLeaves()
	{
		$members = $this->GetMembers();
		$members = $members-1;
		$this->SetMembers($members);
		$result = $this->database->Update('members="'.$members.'"','clans','id = '.$this->GetID().'',1);
	}
	
	public function PostShoutbox($id, $name, $text)
	{
		$date = date('d.m.Y H:i', time());
    $text = html_entity_decode($text);
    $text = str_replace(";", "", $text);
    $text = str_replace("@", "", $text);
		
		$msg = $date.';'.$id.';'.$name.';'.$text;
		$clanmsg = new ClanShoutboxMSG(explode(';',$msg));
		array_unshift($this->shoutbox, $clanmsg);
		
		if($this->data['shoutbox'] == '')
		{
			$this->data['shoutbox'] = $msg;
		}
		else
		{
			$this->data['shoutbox'] = $msg.'@'.$this->data['shoutbox'];
		}
		
		$num = 1000;
		$log = '';
		$msgs = array();
		if(count($this->shoutbox) > $num)
		{
			for($i = 0; $i < $num; ++$i)
			{
				$smsg = $this->shoutbox[$i];
				if($log == '')
				{
					$log = $smsg->GetData();
				}
				else
				{
					$log = $log.'@'.$smsg->GetData();
				}
				array_push($msgs, $smsg);
			}
			$this->data['shoutbox'] = $log;
			$this->shoutbox = $msgs;
		}
		
		$result = $this->database->Update('shoutbox="'.$this->GetShoutbox().'"','clans','id = '.$this->GetID().'',1);
	}
	
	public function GetShoutboxMSG()
	{
		return $this->shoutbox;
	}
	public function GetPlanet()
	{
		return $this->data['Planet'];
	}
	
	public function GetShoutbox()
	{
		return $this->data['shoutbox'];
	}
	
	
	public function AddToLog($msg)
	{
		$clanmsg = new ClanLogMessage(explode(';',$msg));
		array_unshift($this->messages, $clanmsg);
		
		if($this->data['log'] == '')
		{
			$this->data['log'] = $msg;
		}
		else
		{
			$this->data['log'] = $msg.'@'.$this->data['log'];
		}
		
		$num = 20;
		$log = '';
		$msgs = array();
		if(count($this->messages) > $num)
		{
			for($i = 0; $i < $num; ++$i)
			{
				$smsg = $this->messages[$i];
				if($log == '')
				{
					$log = $smsg->GetData();
				}
				else
				{
					$log = $log.'@'.$smsg->GetData();
				}
				array_push($msgs, $smsg);
			}
			$this->data['log'] = $log;
			$this->messages = $msgs;
		}
	}
	
	public function GetLogMSG()
	{
		return $this->messages;
	}
	
	public function GetLog()
	{
		return $this->data['log'];
  }
	
  
  public function HasApplicants()
  {
    $has = false;
    $result = $this->database->Select('*', 'accounts', 'clanapplication='.$this->GetID(), 1);
		if ($result) 
		{
      $has = $result->num_rows > 0;
			$result->close();
		}
    
    return $has;
  }
  
	public function AddZeni($zeni, $byacc, $byname, $toacc, $toname)
	{
		$date = date('d.m.Y H:i', time());
		$msg = $date.';'.$byacc.';'.$byname.';'.$toacc.';'.$toname.';'.$zeni;
		$this->AddToLog($msg);
		
		
		$zeni = $zeni + $this->GetZeni();
		$result = $this->database->Update('zeni='.$zeni.', log="'.$this->GetLog().'"','clans','id = '.$this->GetID().'',1);
		$this->SetZeni($zeni);
	}
	
	public function RemoveZeni($zeni, $byacc, $byname, $toacc, $toname)
	{
		$date = date('d.m.Y H:i', time());
		$msg = $date.';'.$byacc.';'.$byname.';'.$toacc.';'.$toname.';'.$zeni;
		$this->AddToLog($msg);
		
		$zeni = $this->GetZeni() - $zeni;
		$result = $this->database->Update('zeni='.$zeni.', log="'.$this->GetLog().'"','clans','id = '.$this->GetID().'',1);
		$this->SetZeni($zeni);
	}
	
	public function Change($image, $banner, $text, $rules, $requirements)
	{
		$image = $this->database->EscapeString($image);
		$banner = $this->database->EscapeString($banner);
		$text = $this->database->EscapeString($text);
		$rules = $this->database->EscapeString($rules);
		$requirements = $this->database->EscapeString($requirements);
		$this->SetImage($image);
		$this->SetBanner($banner);
		$this->SetText($text);
		$this->SetRules($rules);
		$this->SetRequirements($requirements);
		$result = $this->database->Update('image="'.$image.'",banner="'.$banner.'",text="'.$text.'",rules="'.$rules.'",requirements="'.$requirements.'"','clans','id = '.$this->GetID().'',1);
	}
	
	public function MakeLeader($player)
	{
		$result = $this->database->Update('leader="'.$player->GetID().'"','clans','id = '.$this->GetID().'',1);	
		$this->SetLeader($player->GetID());
	}
	
	public function MakeCoLeader($player)
	{
		$result = $this->database->Update('coleader="'.$player->GetID().'"','clans','id = '.$this->GetID().'',1);	
		$this->SetCoLeader($player->GetID());
	}
	
	public function RemoveCoLeader()
	{
		$result = $this->database->Update('coleader="0"','clans','id = '.$this->GetID().'',1);	
		$this->SetCoLeader(0);
	}
	
	public function MakeRandomLeader()
	{
		if($this->GetCoLeader() != 0)
		{
			$result = $this->database->Update('leader='.$this->GetCoLeader().' AND coleader="0"','clans','id = '.$this->GetID().'',1);	
			return;
		}
		
    $result = $this->database->Select('*', 'accounts', 'clan='.$this->GetID().' AND id != '.$this->GetLeader().'', 1);
		if ($result) 
		{
			if ($result->num_rows > 0)
			{
				$row = $result->fetch_assoc();
				$this->database->Update('leader="'.$row['id'].'"','clans','id = '.$this->GetID().'',1);	
			}
			$result->close();
		}
	}
	
	public function Delete($player)
	{
		$result = $this->database->Delete('clans','id = '.$this->GetID().'',1);
		$result = $this->database->Update('clan="0",clanname=""','accounts','id = '.$player->GetID().'',1);	
		$player->SetClan(0);
		$player->SetClanName('');
	}
  
  public function IsValid()
  {
    return $this->valid;
  }
  
  public function GetID()
  {
    return $this->data['id'];
  }
  
  public function GetName()
  {
    return $this->data['name'];
  }
  
  public function GetMembers()
  {
    return $this->data['members'];
  }
  
  public function SetMembers($value)
  {
    $this->data['members'] = $value;
  }
  
  public function GetTag()
  {
    return $this->data['tag'];
  }
  
  public function GetText()
  {
    return $this->data['text'];
  }
  
  public function SetText($value)
  {
    $this->data['text'] = $value;
  }
  
  public function GetRules()
  {
    return $this->data['rules'];
  }
  
  public function SetRules($value)
  {
    $this->data['rules'] = $value;
  }
  
  public function GetRequirements()
  {
    return $this->data['requirements'];
  }
  
  public function SetRequirements($value)
  {
    $this->data['requirements'] = $value;
  }
  
  public function GetLeader()
  {
    return $this->data['leader'];
  }
  
  public function SetLeader($value)
  {
    $this->data['leader'] = $value;
  }
  
  public function GetCoLeader()
  {
    return $this->data['coleader'];
  }
  
  public function SetCoLeader($value)
  {
    $this->data['coleader'] = $value;
  }
  
  public function GetZeni()
  {
    return $this->data['zeni'];
  }
  
  public function SetZeni($value)
  {
    $this->data['zeni'] = $value;
  }
  
  public function GetPoints()
  {
    return $this->data['points'];
  }
  
  public function SetPoints($value)
  {
    $this->data['points'] = $value;
  }
  
  public function GetImage()
  {
    return $this->data['image'];
  }
  
  public function SetImage($value)
  {
    $this->data['image'] = $value;
  }
  
  public function GetBanner()
  {
    return $this->data['banner'];
  }
  
  public function SetBanner($value)
  {
    $this->data['banner'] = $value;
  }
  
  private function LoadData($id, $select = '*')
  {
    $result = $this->database->Select($select, 'clans', 'id='.$id.'', 1);
		if ($result) 
		{
			if ($result->num_rows > 0)
			{
				$row = $result->fetch_assoc();
				$this->data = $row;
				$this->valid = true;
				$this->LoadMessages($row['log']);
				$this->LoadShoutbox($row['shoutbox']);
			}
			$result->close();
		}
  }
}