<?php
if($database == NULL)
{
	print 'This File ('.__FILE__.') should be after Datatabase!';
}
if($actionManager == NULL)
{
	print 'This File ('.__FILE__.') should be after ActionManager!';
}
if($account == NULL)
{
	print 'This File ('.__FILE__.') should be after Account!';
}

include_once 'playerinventory.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/classes/items/itemmanager.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/classes/fight/attackmanager.php';

class Player
{
	
	private $database;
	private $data;
	private $valid;
	private $inventory;
	private $actionManager;
	private $isChat;
	private $localplayer;
  
  private $startLog = '';
	
	function __construct($db, $id=0, $actionManager=null, $isChat=false, $userid = 0)
	{
		$id = $db->EscapeString($id);
		$this->actionManager = $actionManager;
		$this->valid = false;
		$this->localplayer = false;
		$this->database = $db;
		$this->isChat = $isChat;
		$this->data = array();
		$this->data['id'] = $id;
    $this->data['debuglog'] = '';
		$key = 'id';
		if($id == 0 && $userid != 0)
		{
			$key = 'session';
			$this->data[$key] = session_id();
      $id = session_id();
			$this->localplayer = true;
		}
		$this->LoadPlayer($key, '*', $id);

    if(!$this->valid && isset($_POST['GoogleCrawler']))
    {
      $googleChara = 962;
      $this->data['id'] = $googleChara;
      $this->Login(true);
		  $key = 'id';
		  $this->LoadPlayer($key, '*', $googleChara);
    }
    
    if(!$this->valid && isset($_COOKIE['charaid']) && is_numeric($_COOKIE['charaid']))
    {
      $id = $_COOKIE['charaid'];
      $result = $this->database->Select('userid, id','accounts','id = "'.$id.'" AND userid="'.$userid.'"',1);
      if ($result && $result->num_rows > 0) 
      {
		    $key = 'id';
        $this->data['id'] = $id;
		    $this->LoadPlayer($key, '*', $id);
      }
    }
    
		$this->CheckMulti();
    	
		if($this->valid && $this->IsBanned())
		{
      $this->Logout();
			$this->valid = false;
			$this->data['id'] = 0;
			return;
		}
		
    $this->startLog = $this->GetDebugLog();
	}
  
 function __destruct()
 {
   $debuglog = $this->GetDebugLog();
   if($debuglog == $this->startLog)
     return;
   
	 $result = $this->database->Update('debuglog="'.$debuglog.'"','accounts', 'id = "'.$this->GetID().'"',1);
 }
  
  public function DebugSend($withText = false, $title='')
  {
    if($withText)
    {
      echo 'Es kam zu einen Fehler deines Charakteres. Der Fehler wird manuell behoben und PuRe hat den Log erhalten.<br/>';
      echo 'Falls du diese Nachricht siehst, melde es PuRe im Discord.<br/>';
    }
    
    $timestamp = date('Y-m-d H:i:s');
    if($title == '')
      $title = 'Error In Player: '.$this->GetName().'('.$this->GetID().')';
    $isHTML = 1;
    $result = $this->database->Insert('`sendername`, `senderimage`, `senderid`, `receiverid`, `receivername`, `text`, `time`, `topic`, `read`, `ishtml`', 
																	'"System","img/battel2.png","0","1","PuRe","'.$this->GetDebugLog().'","'.$timestamp.'","'.$title.'", "0","'.$isHTML.'"', 'pms');
  }
  
  private function AddDebugLog($text)
  {
    $debugLog = $this->GetDebugLog();
    if($debugLog == '')
      $debugLog = $text;
    else
      $debugLog = $debugLog.'<br/>'.$text;
    
    $this->SetDebugLog($debugLog);
  }
  
  public function IsBlocked($id)
  {
    $blocked = explode(';', $this->data['blocked']);
    return in_array($id, $blocked);
  }
  
  public function Block($id)
  {
    $blocked = explode(';', $this->data['blocked']);
    if(!in_array($id, $blocked))
    {
      array_push($blocked, $id);
      $blocked = implode(';', $blocked);
		  $update = 'blocked="'.$blocked.'"';
		  $result = $this->database->Update($update,'accounts','id = "'.$this->data['id'].'"',1);
    }
  }
  
  public function UnBlock($id)
  {
    $blocked = explode(';', $this->data['blocked']);
    if(in_array($id, $blocked))
    {
      $key = array_search($id, $blocked);
      array_splice($blocked, $key, 1);
      $blocked = implode(';', $blocked);
		  $update = 'blocked="'.$blocked.'"';
		  $result = $this->database->Update($update,'accounts','id = "'.$this->data['id'].'"',1);
    }
  }
  
	
	public function IsMulti($otherPlayer)
	{
    return $otherPlayer->GetUserID() == $this->GetUserID();
	}
  
	public function GetUserID()
	{
		return $this->data['userid'];
	}
  
	public function GetDebugLog()
	{
		return $this->data['debuglog'];
	}
  
	public function SetDebugLog($value)
	{
		$this->data['debuglog'] = $value;
	}
	
	public function IsLocalPlayer()
	{
		return $this->localplayer;
	}
  
  public function Login($stayLogged)
  {
    if($stayLogged)
    {
      $date_of_expiry = time() + 60 * 60 * 24 * 30;
      setcookie( "charaid",  $this->data['id'], $date_of_expiry );
    }
    else
    {
      $date_of_expiry = time() - 10;
      setcookie( "charaid",  "", $date_of_expiry);
    }
		$result = $this->database->Update('session="'.session_id().'"','accounts','id = "'.$this->data['id'].'"',1);
  }
  
  public function Logout()
  {
    $date_of_expiry = time() - 10;
    setcookie( "charaid",  "", $date_of_expiry);
		$result = $this->database->Update('session=""','accounts','id = "'.$this->data['id'].'"',1);
  }
	
	public function CheckMulti()
	{
		if(!$this->IsLocalPlayer())
		{
			return;
		}
		
		$multis = 1;
		if(isset($this->data['multis']))
		{
			$multis = $this->GetMultis();
		}
		$multiWhere = '';
		if(isset($this->data['multiaccounts']))
		{
			$multiAccs = explode(';',$this->data['multiaccounts']);
			$i = 0;
			while(isset($multiAccs[$i]))
			{
				$multiString = 'chara != "'.$multiAccs[$i].'"';
				if($multiWhere == '')
				{
					$multiWhere = ' AND '.$multiString;
				}
				else
				{
					$multiWhere = $multiWhere.' AND '.$multiString;
				}
				++$i;
			}
		}
		/*$result = $this->database->Select('*','accounts','ip = "'.$this->GetIP().'" AND arank = 0 '.$multiWhere,999);
		if ($result) 
		{
			if ($result->num_rows > $multis)
			{
				$this->Ban('Multiaccounting');
			}
			$result->close();
		}*/ 
	}
	
	public function Ban($reason)
	{
		$banned = 1;
		$this->SetBanned($banned);
		$this->SetBanReason($reason);
		$result = $this->database->Update('banned="'.$banned.'",banreason="'.$reason.'"','accounts','id = "'.$this->data['id'].'"',1);
	}
  
	public function HasRadar()
	{
		return $this->GetInventory()->HasRadar();
	}
  
	public function HasDBs()
	{
		return $this->GetInventory()->HasDBs();
	}
	
	public function HasItem($id)
	{
		return $this->GetInventory()->HasItem($id);
	}
	
	public function HasItemWithID($statsid, $visualid)
	{
		return $this->GetInventory()->HasItemWithID($statsid, $visualid);
	}
	
	public function GetItemByIDOnly($statsid, $visualid)
	{
		return $this->GetInventory()->GetItemByIDOnly($statsid, $visualid);
	}
	
	public function SpeedUpAction($minutes, $lp, $kp)
	{
    $lp = $this->GetLP()-$lp;
    if($lp < 0) $lp = 0;
    $kp = $this->GetKP()-$kp;
    if($kp < 0) $kp = 0;
    $actionTime = $this->GetActionTime() - $minutes;
    if($actionTime < 0) $actionTime = 0;
    
    $this->SetLP($lp);
    $this->SetKP($kp);
    $this->SetActionTime($actionTime);
    $update = 'lp="'.$lp.'", kp="'.$kp.'", actiontime="'.$actionTime.'"';
		$result = $this->database->Update($update,'accounts','id = "'.$this->data['id'].'"',1);
  }
	
	public function ResetStats()
	{
    $stats = 10;
    $mStats = $stats*10;
    
    $statspoints = $this->GetStats();
    $statspoints += ($this->GetMaxLP()/10) - $stats;
    $statspoints += ($this->GetMaxKP()/10) - $stats;
    $statspoints += $this->GetAttack() - $stats;
    $statspoints += $this->GetDefense() - $stats;
    
    $this->SetStats($statspoints);
    
    $this->SetLP($mStats);
    $this->SetMaxLP($mStats);
    $this->SetKP($mStats);
    $this->SetMaxKP($mStats);
    $this->SetAttack($stats);
    $this->SetDefense($stats);
    
    $update = 'stats="'.$statspoints.'"
    , lp="'.$mStats.'"
    , mlp="'.$mStats.'"
    , kp="'.$mStats.'"
    , mkp="'.$mStats.'"
    , attack="'.$stats.'"
    , defense="'.$stats.'"
    ';
		$result = $this->database->Update($update,'accounts','id = "'.$this->data['id'].'"',1);
	}
	
	public function ResetSkills()
	{
		$allAttacks = explode(';',$this->GetAttacks());
    
    $skillPoints = $this->GetSkillPoints();
    
    $learnedSkillPoints = 0;
		$result = $this->database->Select('*','skilltree','attack != 0',99999);
		if ($result) 
		{
			if ($result->num_rows > 0)
			{
        while($row = $result->fetch_assoc()) 
        {
          $foundID = array_search($row['attack'], $allAttacks);
          if($foundID != false)
          {
            array_splice($allAttacks, $foundID, 1);
            $learnedSkillPoints++;
            $skillPoints++;
          }
        }
			}
			$result->close();
		}
    
		$attacks = implode(';',$allAttacks);
    
		$this->SetFightAttacks($attacks);
		$this->SetAttacks($attacks);
    $this->SetSkillPoints($skillPoints);
    $stats = $this->GetStats() + $learnedSkillPoints * 24;
    $this->SetStats($stats);
    
    $update = 'fightattacks="'.$attacks.'", attacks="'.$attacks.'", skillpoints="'.$skillPoints.'",stats="'.$stats.'"';
		$result = $this->database->Update($update,'accounts','id = "'.$this->data['id'].'"',1);
    
	}
	
	public function UpdateStartingPowerup($attack)
	{
    $this->SetStartingPowerup($attack);
		$result = $this->database->Update('powerupstart="'.$attack.'"','accounts','id = "'.$this->data['id'].'"',1);
  }
  
	public function UpdateFightAttacks($attacks)
	{
		$i = 0;
		$allAttacks = explode(';',$this->GetAttacks());
    $powerup = $this->GetStartingPowerup();
    $hasPowerup = false;
		while(isset($attacks[$i]))
		{
			if(!in_array($attacks[$i], $allAttacks))
			{
				return;
			}
      if($attacks[$i] == $powerup)
      {
        $hasPowerup = true;
      }
			++$i;
		}
		
		$attacks = implode(';',$attacks);
		$this->SetFightAttacks($attacks);
    $update = 'fightattacks="'.$attacks.'"';
    if(!$hasPowerup)
    {
      $update = $update.',powerupstart=0';
      $this->SetStartingPowerup(0);
    }
		$result = $this->database->Update($update,'accounts','id = "'.$this->data['id'].'"',1);
	}
	
	public function LeaveGroup()
	{
		$group = $this->GetGroup();
		$where = '';
		$i = 0;
		
		$newGroup = array();
		while(isset($group[$i]))
		{
			if($group[$i] == $this->GetID())
			{
				++$i;
				continue;
			}
			
			if($where == '')
			{
				$where = 'id = "'.$group[$i].'"';
			}
			else
			{
				$where = $where.' OR id = "'.$group[$i].'"';
			}
			++$i;
		}
		
		$key = array_search($this->GetID(), $group);
		array_splice($group, $key, 1);
		
		$groupSQL = '';
		$limit = 1;
		
		$leaderID = 0;
		if(count($group) != 1)
		{
			$groupSQL = implode(';', $group);
			$limit = count($group);
			$leaderID = $group[0];
		}
		$result = $this->database->Update('`group`="'.$groupSQL.'"','accounts',$where, $limit);
		$result = $this->database->Update('`group`="", `groupleader`="0"','accounts','id = "'.$this->data['id'].'"',1);
		if($this->IsGroupLeader() && $leaderID != 0)
		{
			$result = $this->database->Update('`groupleader`=1','accounts','id = "'.$leaderID.'"',1);
		}
		$this->SetGroup('');
		$this->SetGroupLeader(false);
		return $groupSQL;
	}
	
	public function MakeGroupLeader()
	{
			$this->SetGroupLeader(true);
			$result = $this->database->Update('`groupleader`="1"','accounts','id = "'.$this->data['id'].'"',1);
	}
	public function GiveupGroupLeader()
	{
			$this->SetGroupLeader(false);
			$result = $this->database->Update('`groupleader`="0"','accounts','id = "'.$this->data['id'].'"',1);
	}
	
	public function AddToGroup($playerID)
	{
		$group = $this->GetGroup();
		if($group == null)
		{
			$group = array();
			$group[0] = $this->GetID();
			$this->SetGroupLeader(true);
			$result = $this->database->Update('`groupleader`="1"','accounts','id = "'.$this->data['id'].'"',1);
		}
		array_push($group, $playerID);
		$groupSQL = implode(';',$group);
		$where = '';
		
		$i = 0;
		while(isset($group[$i]))
		{
			if($where == '')
			{
				$where = 'id = "'.$group[$i].'"';
			}
			else
			{
				$where = $where.' OR id = "'.$group[$i].'"';
			}
			++$i;
		}
		$limit = count($group);
		
		$this->SetGroup($groupSQL);
		$result = $this->database->Update('`group`="'.$groupSQL.'"','accounts',$where, $limit);
	}
	
	public function InviteToGroup($inviter)
	{
		$this->SetGroupInvite($inviter);
		$result = $this->database->Update('groupinvite="'.$inviter.'"','accounts','id = "'.$this->data['id'].'"',1);
	}
	
	public function DeclineGroupInvite()
	{
		$this->SetGroupInvite(0);
		$result = $this->database->Update('groupinvite="0"','accounts','id = "'.$this->data['id'].'"',1);
	}
	
	public function UpdateWish($wish, $counter)
	{
    $this->AddDebugLog('Update Wish');
    $this->AddWish($wish);
    $wishes = $this->GetWishes();
		$this->SetWishCounter($counter);
    $this->AddDebugLog(' - Add Wish: '.$wish);
    $this->AddDebugLog(' - New Wishes: '.$wishes);
    $this->AddDebugLog(' - New counter: '.$counter);
    $this->AddDebugLog(' ');
		$result = $this->database->Update('wishcounter="'.$counter.'", wishes="'.$wishes.'"','accounts','id = "'.$this->data['id'].'"',1);
	}
	
	public function AddArenaPoints($amount)
	{
    $this->AddDebugLog('Add Arenapoints');
		$points = $this->GetArenaPoints() + $amount;
		$this->SetArenaPoints($points);
    $this->AddDebugLog(' - Add Arenapoints: '.$amount);
    $this->AddDebugLog(' - New Arenapoints: '.$points);
    $this->AddDebugLog(' ');
		$result = $this->database->Update('arenapoints="'.$points.'"','accounts','id = "'.$this->data['id'].'"',1);
	}
	
	public function RenoveArenaPoints($amount)
	{
    $this->AddDebugLog('Remove Arenapoints');
		$points = $this->GetArenaPoints() - $amount;
		$this->SetArenaPoints($points);
    $this->AddDebugLog(' - Remove Arenapoints: '.$amount);
    $this->AddDebugLog(' - New Arenapoints: '.$points);
    $this->AddDebugLog(' ');
		$result = $this->database->Update('arenapoints="'.$points.'"','accounts','id = "'.$this->data['id'].'"',1);
	}
	
	public function AddZeni($amount)
	{
    $this->AddDebugLog('Add Zeni');
		$zeni = $this->GetZeni() + $amount;
		$this->SetZeni($zeni);
    $this->AddDebugLog(' - Add Zeni: '.$amount);
    $this->AddDebugLog(' - New Zeni: '.$zeni);
    $this->AddDebugLog(' ');
		$result = $this->database->Update('zeni="'.$zeni.'"','accounts','id = "'.$this->data['id'].'"',1);
	}
	
	public function RemoveZeni($amount)
	{
    $this->AddDebugLog('Remove Zeni');
		$zeni = $this->GetZeni() - $amount;
		$this->SetZeni($zeni);
    $this->AddDebugLog(' - Remove Zeni: '.$amount);
    $this->AddDebugLog(' - New Zeni: '.$zeni);
    $this->AddDebugLog(' ');
		$result = $this->database->Update('zeni="'.$zeni.'"','accounts','id = "'.$this->data['id'].'"',1);
	}
  
  public function CombineItems($statsitem, $visualitem)
  {
    $this->AddDebugLog('CombineItems');
    $this->AddDebugLog(' - Stats: '.$statsitem->GetName().' ('.$statsitem->GetID().')');
    $this->AddDebugLog(' - Visual: '.$visualitem->GetName().' ('.$visualitem->GetID().')');
    $this->AddDebugLog(' ');
    
		$this->GetInventory()->CombineItems($statsitem, $visualitem);
  }
	
	public function AddItems($statsitem, $visualitem, $amount, $statstype=0, $upgrade=0)
	{
    $this->AddDebugLog('AddItems');
    $this->AddDebugLog(' - Stats: '.$statsitem->GetName().' ('.$statsitem->GetID().')');
    $this->AddDebugLog(' - Visual: '.$visualitem->GetName().' ('.$visualitem->GetID().')');
    $this->AddDebugLog(' - Statstype: '.$statstype);
    $this->AddDebugLog(' - Upgrade: '.$upgrade);
    $this->AddDebugLog(' ');
    
		$inventoryItem = $this->GetInventory()->AddItem($statsitem, $visualitem, $amount, $statstype, $upgrade);
    return $inventoryItem;
	}
	
	public function RemoveItemsByID($statsid, $itemsid, $statstype, $upgrade, $amount)
	{
    $itemid = $this->GetInventory()->GetItemIndexByID($statsid, $itemsid, $statstype, $upgrade);
		$this->GetInventory()->RemoveItem($itemid, $amount);
	}
	
	public function RemoveItems($itemid, $amount)
	{
		$this->GetInventory()->RemoveItem($itemid, $amount);
	}
	
	public function BuyItemFrom($statsitem, $visualitem, $statstype, $upgrade, $amount, $price, $sellerid)
	{
		$this->BuyItem($statsitem, $visualitem, $statstype, $upgrade, $amount, $price);
		$result = $this->database->Update('zeni=zeni+'.$price,'accounts','id = "'.$sellerid.'"',1);
	}
	
	public function BuyItem($statsitem, $visualitem, $statstype, $upgrade, $amount, $price, $arenaprice=0)
	{
		$this->GetInventory()->AddItem($statsitem, $visualitem, $amount, $statstype, $upgrade);
    
		$zeni = $this->GetZeni() - $price;
		$this->SetZeni($zeni);
		$arenapoints = $this->GetArenaPoints() - $arenaprice;
		$this->SetArenaPoints($arenapoints);
    
    $this->AddDebugLog('Buy Item');
    $this->AddDebugLog(' - Stats: '.$statsitem->GetName().' ('.$statsitem->GetID().')');
    $this->AddDebugLog(' - Visual: '.$visualitem->GetName().' ('.$visualitem->GetID().')');
    $this->AddDebugLog(' - Amount: '.$amount);
    $this->AddDebugLog(' - Statstype: '.$statstype);
    $this->AddDebugLog(' - Upgrade: '.$upgrade);
    $this->AddDebugLog(' - Price Zeni: '.$price);
    $this->AddDebugLog(' - Price Arenapoints: '.$arenaprice);
    $this->AddDebugLog(' - New Arenapoints: '.$arenaprice);
    $this->AddDebugLog(' - New Zeni: '.$zeni);
    $this->AddDebugLog(' ');
		$result = $this->database->Update('zeni="'.$zeni.'", arenapoints="'.$arenapoints.'"','accounts','id = "'.$this->data['id'].'"',1);
	}
	
	public function SellItem($id, $amount=1)
	{
		$item = $this->GetInventory()->GetItem($id);
		$this->GetInventory()->RemoveItem($id, $amount);
		
		$zeni = $this->GetZeni() + (round($item->GetPrice() * 0.5) * $amount);
		$this->SetZeni($zeni);
		$result = $this->database->Update('zeni="'.$zeni.'"','accounts','id = "'.$this->data['id'].'"',1);
	}
	
	public function GetIP()
	{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }
    $ip = hash('sha256', 'itsa'.$ip.'ip');
    
    return $ip;
	}
	
	public function SendClanApplication($clan, $text)
	{
		$text = $this->database->EscapeString($text);
		$this->SetClanApplication($clan->GetID());
		$this->SetClanApplicationText($text);
		$result = $this->database->Update('clanapplication="'.$clan->GetID().'",clanapplicationtext="'.$text.'"','accounts','id = "'.$this->data['id'].'"',1);
	}
	
	public function JoinClan($clan)
	{
		$this->SetClanApplication(0);
		$this->SetClanApplicationText('');
		$this->SetClan($clan->GetID());
		$this->SetClanName($clan->GetName());
		$result = $this->database->Update('clanapplication="0",clanapplicationtext="", clan="'.$clan->GetID().'", clanname="'.$clan->GetName().'"','accounts','id = "'.$this->data['id'].'"',1);
	}
	
	public function LeaveClan()
	{
		$this->SetClan(0);
		$this->SetClanName('');
		$result = $this->database->Update('clan="0", clanname=""','accounts','id = "'.$this->data['id'].'"',1);
	}
	
	public function DeleteClanApplication()
	{
		$this->SetClanApplication(0);
		$this->SetClanApplicationText('');
		$result = $this->database->Update('clanapplication="0",clanapplicationtext=""','accounts','id = "'.$this->data['id'].'"',1);
	}
	
	public function AcceptNPCWonItems()
	{
		$this->SetNPCWonItems('');
		$result = $this->database->Update('npcwonitems=""','accounts','id = "'.$this->data['id'].'"',1);
	}
	
	public function UnequipItem($item)
  {
    $equippedStats = $this->GetEquippedStats();
		$travelBonus = $this->GetTravelBonusInternal();
		$trainBonus = $this->GetTrainBonus();
		
		if($item->GetType() == 3)
		{
			$equippedStats = $this->RemoveEquippedStats($item);
		}
		else if($item->GetType() == 4)
		{
			$travelBonus = $travelBonus - $item->GetTravelBonus();
			$this->SetTravelBonus($travelBonus);
		}
		
		$trainBonus = $trainBonus - $item->GetTrainBonus();
		$this->SetTrainBonus($trainBonus);
    
		$this->GetInventory()->UnequipItem($item);
		$result = $this->database->Update('equippedstats="'.$equippedStats.'", travelbonus="'.$travelBonus.'", trainingstats="'.$trainBonus.'"','accounts','id = "'.$this->data['id'].'"',1);
	}
	
	public function AddEquippedStats($item)
	{
		//$this->database->Debug();
		$equippedStats = explode(';', $this->GetEquippedStats());
		if($item->GetLP() != 0)
		{
			$equippedStats[0] += $item->GetLP();
		}
		if($item->GetKP() != 0)
		{
			$equippedStats[1] += $item->GetKP();
		}
		if($item->GetAttack() != 0)
		{
			$equippedStats[2] += $item->GetAttack();
		}
		if($item->GetDefense() != 0)
		{
			$equippedStats[3] += $item->GetDefense();
		}

		$newEquippedStats = implode(';', $equippedStats);
		$this->SetEquippedStats($newEquippedStats);
		return $newEquippedStats;
	}
	
	public function RemoveEquippedStats($item)
	{
		$equippedStats = explode(';', $this->GetEquippedStats());
		if($item->GetLP() != 0)
		{
			$equippedStats[0] -= $item->GetLP();
		}
		if($item->GetKP() != 0)
		{
			$equippedStats[1] -= $item->GetKP();
		}
		if($item->GetAttack() != 0)
		{
			$equippedStats[2] -= $item->GetAttack();
		}
		if($item->GetDefense() != 0)
		{
			$equippedStats[3] -= $item->GetDefense();
		}
		
		$newEquippedStats = implode(';', $equippedStats);
		$this->SetEquippedStats($newEquippedStats);
		return $newEquippedStats;
	}
	
	public function EquipItem($item)
	{
		$slotItem = $this->GetInventory()->GetItemAtSlot($item->GetSlot());
    
		$equippedStats = $this->GetEquippedStats();
		$travelBonus = $this->GetTravelBonusInternal();
		$trainBonus = $this->GetTrainBonus();
    
		if($slotItem != null)
		{
			$this->GetInventory()->UnequipItem($slotItem);
			if($slotItem->GetType() == 3)
			{
				$equippedStats = $this->RemoveEquippedStats($slotItem);
			}
			else if($slotItem->GetType() == 4)
			{
				$travelBonus = $travelBonus - $slotItem->GetTravelBonus();
				$this->SetTravelBonus($travelBonus);
			}
			$trainBonus = $trainBonus - $slotItem->GetTrainBonus();
			$this->SetTravelBonus($trainBonus);
		}
		
		$this->GetInventory()->EquipItem($item);
		if($item->GetType() == 3)
		{
			$equippedStats = $this->AddEquippedStats($item);
		}
		else if($item->GetType() == 4)
		{
				$travelBonus = $travelBonus + $item->GetTravelBonus();
				$this->SetTravelBonus($travelBonus);
		}
		
		$trainBonus = $trainBonus + $item->GetTrainBonus();
		$this->SetTrainBonus($trainBonus);
		
		$result = $this->database->Update('equippedstats="'.$equippedStats.'", travelbonus="'.$travelBonus.'", trainingstats="'.$trainBonus.'"','accounts','id = "'.$this->data['id'].'"',1);
	}
	
	public function DeleteAccount()
	{
		$result = $this->database->Delete('accounts','id = "'.$this->GetID().'"',1);
		$result = $this->database->Delete('market','sellerid = "'.$this->GetID().'"',999999999);
		$result = $this->database->Delete('statslist','acc = "'.$this->GetID().'"',999999999);
		$result = $this->database->Delete('inventory','ownerid = "'.$this->GetID().'"',999999999);
	}
  
  public function UpgradeChip()
  {
    $chipID = 198;
    $itemManager = new itemManager($this->database);
    $item = $this->GetItemByIDOnly($chipID, $chipID);
    if($item == null)
    {
      $chipItem = $itemManager->GetItem($chipID);
      $this->AddItems($chipItem, $chipItem, 1, $chipItem->GetDefaultStatsType(), 0);
      $this->UpgradeChip();
      return;
    }
    
    $chipLevel = $item->GetCalculateUpgrade();
    if($chipLevel == $this->GetLevel())
      return;
    
    $isEquipped = $item->isEquipped();
    if($isEquipped)
      $this->UnequipItem($item);
    
    
    
    
    $newLevel = $this->GetLevel()-1;
    $item->SetUpgrade($newLevel);
		$result = $this->database->Update('upgrade="'.$newLevel.'"','inventory','id = "'.$item->GetID().'"',1);
    
    if($isEquipped)
      $this->EquipItem($item);
  }
	
	public function UseItem($id, $item, $amount=1)
	{
		$inventoryItem = $this->GetInventory()->GetItem($id);
		$newAmount = $inventoryItem->GetAmount();
		$newAmount = $newAmount-$amount;
		if($newAmount == 0)
		{
		  $this->GetInventory()->RemoveItem($id);
		}
		else
		{
		  $inventoryItem->SetAmount($newAmount);
		}
		
		$type = $item->GetType();
		$lpHeal = 0;
		$kpHeal = 0;
    
    $healPercentage = 1;
    if($this->GetRace() == 'Saiyajin')
    {
      $healPercentage = 1.1;
    }
		if($type == 1)
		{
			$lpHeal = $item->GetLP() * $amount * $healPercentage;
			$kpHeal = $item->GetKP() * $amount * $healPercentage;
		}
		else if($type == 2)
		{
			$lpHeal = (($item->GetLP() * $amount * $healPercentage) / 100) * $this->GetMaxLP();
			$kpHeal = (($item->GetKP() * $amount * $healPercentage)/ 100) * $this->GetMaxKP();
		}
		
		$newLP = $this->GetLP() + floor($lpHeal);
		$newKP = $this->GetKP() + floor($kpHeal);
		
		if($newLP > $this->GetMaxLP())
		{
			$newLP = $this->GetMaxLP();
		}
		
		if($newKP > $this->GetMaxKP())
		{
			$newKP = $this->GetMaxKP();
		}
		
		$this->SetLP($newLP);
		$this->SetKP($newKP);
		
		$items = $this->inventory->Encode();
		$result = $this->database->Update('inventory="'.$items.'",lp="'.$newLP.'",kp="'.$newKP.'"','accounts','id = "'.$this->data['id'].'"',1);
		
	}
	
	public function UseItem2($id, $amount=1, $onItem=null)
	{
		$item = $this->GetInventory()->GetItem($id);
		$this->GetInventory()->RemoveItem($id, $amount);
		
		$type = $item->GetType();
		$lpHeal = 0;
		$kpHeal = 0;
    
    $healPercentage = 1;
    if($this->GetRace() == 'Saiyajin')
    {
      $healPercentage = 1.1;
    }
		if($type == 1)
		{
			$lpHeal = $item->GetLP() * $amount * $healPercentage;
			$kpHeal = $item->GetKP() * $amount * $healPercentage;
		}
		else if($type == 2)
		{
			$lpHeal = (($item->GetLP() * $amount * $healPercentage) / 100) * $this->GetMaxLP();
			$kpHeal = (($item->GetKP() * $amount * $healPercentage)/ 100) * $this->GetMaxKP();
		}
    else if($type == 6)
    {
      if($item->GetStatsID() == 172) //StatsReset
      {
        $this->ResetStats();
      }
      else if($item->GetStatsID() == 204 && $this->GetPlanet() == 'Jenseits') //Revive
      {
        $this->Revive();
      }
      else if($item->GetStatsID() == 173) //SkillReset
      {
        $this->ResetSkills();
      }
      else if($item->GetStatsID() == 184) //Type Stone
      {
		    $onItem = $this->GetInventory()->GetItemByDatabaseID($onItem);
        if($onItem != null && $onItem->CanChangeType())
		      $result = $this->database->Update('statstype="'.$item->GetStatsType().'"','inventory','id = "'.$onItem->GetID().'"',1);
      }
      else if($item->GetStatsID() == 185) // Level Stone
      {
		    $onItem = $this->GetInventory()->GetItemByDatabaseID($onItem);
        if($onItem != null && $onItem->CanUpgrade())
        {
          $upgrade = $onItem->GetUpgrade() + $amount;
          if($upgrade >= $onItem->GetMaxUpgrade()) $upgrade = $onItem->GetMaxUpgrade();
		        $result = $this->database->Update('upgrade="'.$upgrade.'"','inventory','id = "'.$onItem->GetID().'"',1);
        }
      }
    }
		
		$newLP = $this->GetLP() + $lpHeal;
		$newKP = $this->GetKP() + $kpHeal;
		
		if($newLP > $this->GetMaxLP())
		{
			$newLP = $this->GetMaxLP();
		}
		
		if($newKP > $this->GetMaxKP())
		{
			$newKP = $this->GetMaxKP();
		}
		
		$this->SetLP($newLP);
		$this->SetKP($newKP);
		
		$result = $this->database->Update('lp="'.$newLP.'",kp="'.$newKP.'"','accounts','id = "'.$this->data['id'].'"',1);
		
	}
	
	public function GetChallengeTimeSinceNow()
	{
		$seconds = time() - strtotime($this->GetChallengeTime());
		return $seconds;
	}
	
	private function UpdateLastAction()
	{
		$lastaction = strtotime($this->GetLastAction());
		$difference = time() - $lastaction;

    $timestamp = date('Y-m-d H:i:s');
		$update = 'lastaction="'.$timestamp.'"';
		$this->SetLastAction($timestamp);
		
		if($difference <= 3)
		{
			$clickCount = $this->GetClickCount()+1;
			$update = $update.', clickcount="'.$clickCount.'"';
			$this->SetClickCount($clickCount);
		}
		
		if($this->GetClickCount() > 90)
		{
			$time = '0000-00-00 00:00:00';
			$this->SetCaptchaTime($time);
			$update = $update.', captchatime="'.$time.'"';
		}
		
		$result = $this->database->Update($update,'accounts','id = "'.$this->data['id'].'"',1);
	}
	
	public function UpdateLastEventAction()
	{
    $timestamp = date('Y-m-d H:i:s');
		$update = 'lasteventaction="'.$timestamp.'"';
		$this->SetLastEventAction($timestamp);
		
		$result = $this->database->Update($update,'accounts','id = "'.$this->data['id'].'"',1);
	}
	
	public function UpdateCaptcha($alsoClickCount=true)
	{
    $timestamp = date('Y-m-d H:i:s');
		
		$update = 'captchatime="'.$timestamp.'"';
		$this->SetCaptchaTime($timestamp);
		
		if($alsoClickCount)
		{
			$update = $update.', clickcount="0"';
			$this->SetClickCount(0);
		}
		
		$result = $this->database->Update($update,'accounts','id = "'.$this->data['id'].'"',1);
	}
  
  public function GetStartingPowerup()
  {
    return $this->data['powerupstart'];
  }
  
  public function SetStartingPowerup($value)
  {
    $this->data['powerupstart'] = $value;
  }
	
	public function GetCaptchaTime()
	{
		return $this->data['captchatime'];
	}
		public function Getvisible()
	{
		return $this->data['visible'];
	}
	public function SetCaptchaTime($value)
	{
		$this->data['captchatime'] = $value;
	}
	
	public function GetClickCount()
	{
		return $this->data['clickcount'];
	}
	
	public function SetClickCount($value)
	{
		$this->data['clickcount'] = $value;
	}
	
	public function GetLastAction()
	{
		return $this->data['lastaction'];
	}
  
	public function SetLastAction($value)
	{
		$this->data['lastaction'] = $value;
	}
	
	public function GetLastEventAction()
	{
		return $this->data['lasteventaction'];
	}
  
	public function SetLastEventAction($value)
	{
		$this->data['lasteventaction'] = $value;
	}
	
	public function GetRVGUZTime()
	{
		return $this->data['rvguztime'];
	}
	
	public function SetRVGUZTime($value)
	{
		$this->data['rvguztime'] = $value;
	}
	
	public function GetClan()
	{
		return $this->data['clan'];
	}
	
	public function SetClan($value)
	{
		$this->data['clan'] = $value;
	}
	
	public function GetClanName()
	{
		return $this->data['clanname'];
	}
	public function GetChatbann()
	{
		return $this->data['chatban'];
	}
	public function SetClanName($value)
	{
		$this->data['clanname'] = $value;
	}
	
	public function GetClanApplication()
	{
		return $this->data['clanapplication'];
	}
	
	public function SetClanApplication($value)
	{
		$this->data['clanapplication'] = $value;
	}
	
	public function GetClanApplicationText()
	{
		return $this->data['clanapplicationtext'];
	}
	
	public function SetClanApplicationText($value)
	{
		$this->data['clanapplicationtext'] = $value;
	}
	  public function GetTeamUser()
	{
		return $this->data['team'];
	}
	private function LoadPlayer($key, $select = '*', $id = -1)
	{
    if($key == '' || $this->data[$key] == '')
    {
      return;
    }
    
    if($key == 'id')
    {
		  $result = $this->database->Select($select,'accounts','id = "'.$id.'"',1);
    }
    else
    {
		  $result = $this->database->Select($select,'accounts',$key.' = "'.$id.'"',1);
    }
    
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
			
		if($this->valid)
		{
      $this->inventory = new Inventory($this->database, $this->GetID());
		}
		
		if($this->IsLocalPlayer() && $this->valid && !$this->isChat)
		{
			$this->UpdateLastAction();
			$this->CalculateAction();
		}
	}
	
	public function DoSparringCancel()
	{
		$this->CancelAction();
		
		$this->SetSparringPartner(0);
		$this->SetSparringCancel(0);
		
		$result = $this->database->Update('sparringpartner="0", sparringcancel="0"','accounts','id = "'.$this->data['id'].'"',1);
	}
	
	public function DoSparringCancelRequest()
	{
		$this->SetSparringCancel(1);
		$result = $this->database->Update('sparringcancel ="1"','accounts','id = "'.$this->data['id'].'"',1);
	}
	
	public function DenySparringCancel()
	{
		$this->SetSparringCancel(0);
		$result = $this->database->Update('sparringcancel ="0"','accounts','id = "'.$this->data['id'].'"',1);
	}
	
	public function DoSparring($otherID, $time)
	{
		$action = 31;
		$this->SetSparringRequest(0);
		$this->SetSparringTime(0);
		
		$this->SetSparringPartner($otherID);
		
		$timestamp = date("Y-m-d H:i:s");

		$this->SetAction($action);
		
		$minutes = $time * 60;
		$this->SetActionTime($minutes);
		$this->SetActionStart($timestamp);
		
		$result = $this->database->Update('sparringrequest ="0", sparringtime ="0", sparringpartner="'.$otherID.'", action="'.$action.'", actiontime="'.$minutes.'", actionstart="'.$timestamp.'"','accounts','id = "'.$this->data['id'].'"',1);
	}
	
	public function SparringRequest($id, $time)
	{
		$this->SetSparringRequest($id);
		$this->SetSparringTime($time);
		$result = $this->database->Update('sparringrequest ="'.$id.'", sparringtime ="'.$time.'"','accounts','id = "'.$this->data['id'].'"',1);
	}
	
	public function DenySparringRequest()
	{
		$this->SetSparringRequest(0);
		$this->SetSparringTime(0);
		$result = $this->database->Update('sparringrequest ="0", sparringtime ="0"','accounts','id = "'.$this->data['id'].'"',1);
	}
	
	public function Challenge($fightID)
	{
		$this->SetChallengeFight($fightID);
		
		$timestamp = $this->GetChallengeTime();
		if(strtotime($this->GetChallengeTime()) < time() - (60*10))
		{
			$timestamp = date('Y-m-d H:i:s');
			$this->SetChallengeTime($timestamp);
		}
		$result = $this->database->Update('challengefight ="'.$fightID.'", challengedtime="'.$timestamp.'"','accounts','id = "'.$this->data['id'].'"',1);
	}
	
	public function DeclineEvent()
	{
		$this->SetEventInvite(0);
		$result = $this->database->Update('eventinvite="0"','accounts','id = "'.$this->data['id'].'"',1);
	}
	
	public function DeclineChallenge()
	{
		$this->SetChallengeFight(0);
		$result = $this->database->Update('challengefight="0", challengedtime="0"','accounts','id = "'.$this->data['id'].'"',1);
	}
	
	static public function CalculateSparringWin($database, $player1, $player2)
	{
		$attackManager = new AttackManager($database);
		$actionManager = new ActionManager($database);
    
    if(!$player2->IsValid()) $player2 = $player1;
		$ki = Player::GetSparringKI($player2->GetKI(), $player2->GetTotalStatsFights(), $player2->GetLevel(), $player2->GetStats(), $player2->GetWishes(), $player2->GetStory(), $player2->GetAttacks(), $attackManager, $actionManager, $database);

    if(!$player1->IsValid()) $player1 = $player2;
		$playerKI = Player::GetSparringKI($player1->GetKI(), $player1->GetTotalStatsFights(), $player1->GetLevel(), $player1->GetStats(), $player1->GetWishes(), $player1->GetStory(), $player1->GetAttacks(), $attackManager, $actionManager, $database);
    
		$kiDiff = ($ki - $playerKI);
		$statsWin = round($kiDiff * 0.015); //Aim KI is 100, 100 x 0.015 = 1.5 Stats
		if($statsWin < 1)
		{
			$statsWin = 1;
		}
		
		return $statsWin;
	}
	
	static public function GetSparringKI($ki, $totalStatsFights, $level, $stats, $wishes, $story, $attacks, $attackManager, $actionManager, $database)
	{
    $attacks = explode(';',$attacks);
    $learnTime = 0;
    foreach($attacks as &$attack)
    {
      $attack = $attackManager->GetAttack($attack);
      $learnTime += $attack->GetLearnTime();
    }
    
    if($learnTime != 0)
    {
      $ki = $ki + floor($learnTime/4);
    }
    

		$WKStats = floor($totalStatsFights/10)*10;

		$levelStats = $level*10;

		$leftStats = $stats;

		$ki = $ki - floor($levelStats/4) - floor($WKStats/4);
		$ki = $ki + floor($leftStats/4);
    
    $wishes = explode(';',$wishes);
    $result = $database->Select('*', 'wishes', '', 99999, 'id', 'ASC');
    if ($result) 
    {
      if ($result->num_rows > 0)
      {
         while($row = $result->fetch_assoc()) 
         {
           if($row['type'] == 2 && in_array($row['id'], $wishes))
           {
              $ki = $ki - $row['value']/4;
           }
         }
      }
      $result->close();
    }
    
    $storyGain = 0;
    $result = $database->Select('*', 'story', 'action != 0 AND id < '.$story, 99999, 'id', 'ASC');
    if ($result) 
    {
      if ($result->num_rows > 0)
      {
         while($row = $result->fetch_assoc()) 
         {
            $action = $actionManager->GetAction($row['action']);
            $storyGain += $action->GetStats();
         }
      }
      $result->close();
    }
    
    $storyGain = ceil($storyGain/4);
    $ki = $ki - $storyGain;
		
		return $ki;
	}
	
	
	public function CalculateAction($cancel = false, $force=false)
	{
		if($this->GetTournament() != 0 && !$force || $this->GetFight() != 0 && !$force || !$cancel && ($this->GetAction() == 0 || $this->GetActionCountdown() > 0))
		{
			return;
		}
    
    
    $this->AddDebugLog('CalculateAction');
    
		$action = $this->actionManager->GetAction($this->GetAction());
    $this->AddDebugLog(' - Action: '.$action->GetName());
    $this->AddDebugLog(' - ActionStart: '.$this->GetActionStart().' = '.strtotime($this->GetActionStart()));
    $this->AddDebugLog(' - Time Now: '.date("Y-m-d H:i:s").' = '.strtotime("now"));
    
    if($cancel)
      $this->AddDebugLog(' - Canceled!');
    if($force)
      $this->AddDebugLog(' - Forced!');
		
		$countdown = $this->GetActionCountdown();
		$actionTimes = 0;
		$elapsedMinutes = 0;
		if($countdown <= 0)
		{
			$elapsedMinutes = $this->GetActionTime();
		}
		else
		{
			$actionTimes = $this->GetActionTime();
      $this->AddDebugLog(' - actionTimes: '.$actionTimes);
			$leftMinutes = floor($countdown / 60);
			$elapsedMinutes = $actionTimes - $leftMinutes;
		}
    
		if($elapsedMinutes < 0)
		{
			$elapsedMinutes = 0;
		}
    
		
		$actionMinutes = $action->GetMinutes();
		$times = 0;
		if($actionMinutes != 0)
			$times = floor($elapsedMinutes / $actionMinutes);
    else
      $times = 1;
		$update = 'action="0",actiontime="0"';
    
    $this->AddDebugLog(' - countdown: '.$countdown);
    $this->AddDebugLog(' - elapsedMinutes: '.$elapsedMinutes);
    $this->AddDebugLog(' - actionMinutes: '.$actionMinutes);
    $this->AddDebugLog(' - times: '.$times);
    
    if($times != 0 && $action->IsStory())
    {
      $newStory = $this->GetStory()+1;
      $this->AddDebugLog(' - Update Story to: '.$newStory);
      $update = $update.',story="'.$newStory.'"';
      $this->SetStory($newStory);
    }
    
    if($cancel && $this->GetSkillPointLearn() != 0)
    {
      $newPoints = $this->GetSkillPoints()+$this->GetSkillPointLearn();
      $this->AddDebugLog(' - Update Skillpoints to: '.$newPoints);
      $update = $update.',skillpoints="'.$newPoints.'"';
      $this->SetSkillPoints($newPoints);
    }
    $update = $update.',skillpointlearn="0"';
    $this->SetSkillPointLearn(0);
    
		if($times != 0 && $action->GetType() == 1)
		{
      if($action->GetStats() != 0)
      {
        if($this->GetStats() == 0)
        {
          $update = $update.',statspopup="1"';
		      $this->SetStatsPopup(true);
        }
        $this->AddDebugLog(' - Action Stats: '.$action->GetStats());
        $statsGain = $action->GetStats() * $times;
        $newPoints = $this->GetStats()+$statsGain;
        $this->AddDebugLog(' - Statsgain: '.$statsGain);
        $this->AddDebugLog(' - Update Stats to: '.$newPoints);
        $update = $update.',stats="'.$newPoints.'"';
        $this->SetStats($newPoints);
      }
      if($action->GetPlanet() != '' && $action->GetPlace() != '')
      {
        $place = $action->GetPlace();
        $planet = $action->GetPlanet();
        if($this->GetPlanet() != $planet)
        {
			    $result = $this->database->Update('player="0", place="'.$this->GetPlace().'"','dragonballs','player="'.$this->GetID().'"',999);
        }
        $this->AddDebugLog(' - Action Move Player to: '.$planet.' - '.$place);
        $update = $update.',planet="'.$planet.'",place="'.$place.'"';
        $this->SetPlace($place);
        $this->SetPlanet($planet);
      }
			$statsTraining = explode(';',$this->GetStatsTraining());
			$maxStats = $this->GetMaxStatsTrain();
			if($action->GetLP() != 0)
			{
				$addValue = ($action->GetLP()+($this->GetTrainBonus()*10)) * $times;
				
				$count = 0;
				$statsTraining[$count] += $addValue;
				$max = $maxStats * 10;
				//if($statsTraining[$count] >= $max)
				//{
					//$addValue = $addValue - ($statsTraining[$count] - $max);
					//$statsTraining[$count] = $max;
				//}
				
				$newLP = $this->GetLP() + $addValue;
				$newMLP = $this->GetMaxLP() + $addValue;
				
        $this->AddDebugLog(' - LP from '.$this->GetLP().' to: '.$newLP);
        $this->AddDebugLog(' - MLP from '.$this->GetMaxLP().' to: '.$newMLP);
				$update = $update.',lp="'.$newLP.'",mlp="'.$newMLP.'"';
				$this->SetLP($newLP);
				$this->SetMaxLP($newMLP);
			}
			if($action->GetKP() != 0)
			{
				$addValue = ($action->GetKP()+($this->GetTrainBonus()*10)) * $times;
				
				$count = 1;
				$statsTraining[$count] += $addValue;
				$max = $maxStats * 10;
				//if($statsTraining[$count] >= $max)
				//{
					//$addValue = $addValue - ($statsTraining[$count] - $max);
					//$statsTraining[$count] = $max;
				//}
				
				$newKP = $this->GetKP() + $addValue;
				$newMKP = $this->GetMaxKP() + $addValue;
				
        $this->AddDebugLog(' - KP from '.$this->GetKP().' to: '.$newKP);
        $this->AddDebugLog(' - MKP from '.$this->GetMaxKP().' to: '.$newMKP);
				$update = $update.',kp="'.$newKP.'",mkp="'.$newMKP.'"';
				$this->SetKP($newKP);
				$this->SetMaxKP($newMKP);
			}
			if($action->GetAttack() != 0)
			{
				$addValue = ($action->GetAttack()+$this->GetTrainBonus()) * $times;
				
				$count = 2;
				$statsTraining[$count] += $addValue;
				//if($statsTraining[$count] >= $maxStats)
				//{
					//$addValue = $addValue - ($statsTraining[$count] - $maxStats);
					//$statsTraining[$count] = $maxStats;
				//}
				
				$newAttack = $this->GetAttack() + $addValue;
        $this->AddDebugLog(' - Attack from '.$this->GetAttack().' to: '.$newAttack);
				$update = $update.',attack="'.$newAttack.'"';
				$this->SetAttack($newAttack);
			}
			if($action->GetDefense() != 0)
			{
				$addValue = ($action->GetDefense()+$this->GetTrainBonus()) * $times;
				
				$count = 4;
				$statsTraining[$count] += $addValue;
				//if($statsTraining[$count] >= $maxStats)
				//{
					//$addValue = $addValue - ($statsTraining[$count] - $maxStats);
					//$statsTraining[$count] = $maxStats;
				//}
				
				$newDefense = $this->GetDefense() + $addValue;
        $this->AddDebugLog(' - Defense from '.$this->GetDefense().' to: '.$newDefense);
				$update = $update.',defense="'.$newDefense.'"';
				$this->SetDefense($newDefense);
			}
			
			$newStatsTraining = implode(';', $statsTraining);
			$this->SetStatsTraining($newStatsTraining);
			$update = $update.',statstraining="'.$newStatsTraining.'"';
		}
		else if($times != 0 && $action->GetType() == 2 && !$force) //Not allow if cancel was forced, like when the player died
		{
			$place = "Wald";
			$planet = "Erde";
      $this->AddDebugLog(' - travel to place '.$place.' and planet '.$planet);
			$update = $update.',place="'.$place.'",planet="'.$planet.'"';
			$this->SetPlace($place);
			$this->SetPlanet($planet);
			$lp = $this->GetMaxLP();
			$kp = $this->GetMaxKP();
      $this->AddDebugLog(' - reset lp to '.$lp.' and kp to '.$kp);
			$update = $update.',lp="'.$lp.'",kp="'.$kp.'"';
			$this->SetLP($lp);
			$this->SetKP($kp);
		}
		else if($times != 0 && $action->GetType() == 3)
		{
			$lp = $action->GetLP() * $times;
			if($lp > 100)
			{
				$lp = 100;
			}
			$kp = $action->GetKP() * $times;
			if($kp > 100)
			{
				$kp = 100;
			}
			$lp = $lp / 100;
			$kp = $kp / 100;
			$lp = $this->GetLP() + ($this->GetMaxLP() * $lp);
			$kp = $this->GetKP() + ($this->GetMaxKP() * $kp);
			if($lp > $this->GetMaxLP())
			{
				$lp = $this->GetMaxLP();
			}
			if($kp > $this->GetMaxKP())
			{
				$kp = $this->GetMaxKP();
			}
			
      $this->AddDebugLog(' - heal lp from '.$this->GetLP().' to '.$lp);
      $this->AddDebugLog(' - heal kp from '.$this->GetKP().' to '.$kp);
			$update = $update.',lp="'.$lp.'",kp="'.$kp.'"';
			$this->SetLP($lp);
			$this->SetKP($kp);
		}
		else if($action->GetType() == 4)
    {
      $ortTravelID = 12;
      $planetTravelID = 67;
      if($action->GetID() == $planetTravelID)
      {
        $secondsLeft = $this->GetActionCountdown();
        if($secondsLeft <= 0)
        {
          $travelPlanet = new Planet($this->database, $this->GetTravelPlanet());
          $x = 0;
          $y = 0;
          $this->AddDebugLog(' - travel to planet '.$travelPlanet->GetName());
          $this->AddDebugLog(' - travel to place '.$travelPlanet->GetStartingPlace());
          $this->SetTravelPlanet('');
          $this->SetPlanet($travelPlanet->GetName());
          $this->SetPlace($travelPlanet->GetStartingPlace());
          $this->SetX($x);
          $this->SetY($y);
          $update = $update.',planet="'.$travelPlanet->GetName().'", travelplanet="",x="'.$x.'",y="'.$y.'",place="'.$travelPlanet->GetStartingPlace().'"';
          
          $traveledTime = $this->GetActionTime() - round($secondsLeft/60);
          if($traveledTime > 0)
          {
            $travelTimeLeft = $this->GetTravelTimeLeft() + $traveledTime;
            $statsInTraining = floor($travelTimeLeft/60);
            if($statsInTraining > 0)
            {
              $travelTimeLeft = $travelTimeLeft - ($statsInTraining*60);
              $stats = $this->GetStats() + $statsInTraining;
              if($this->GetStats() == 0)
              {
                $update = $update.',statspopup="1"';
                $this->SetStatsPopup(true);
              }
              $this->AddDebugLog(' - set Stats from '.$this->GetStats().' to '.$stats);
              $this->SetStats($stats);
              $update = $update.',stats="'.$stats.'"';
            }
            $update = $update.',traveltimeleft="'.$travelTimeLeft.'"';
          }
        }
      }
      else if($action->GetID() == $ortTravelID)
      {
        $place = $this->GetTravelPlace();
        $x = 0;
        $y = 0;
        $secondsLeft = $this->GetActionCountdown();
        if($secondsLeft > 0 && ($cancel || $force))
        {
          $place = $this->GetPlace();
          
          $previousPlace = new Place($this->database, $this->GetPreviousPlace(), $this->GetPlanet(), null);
          $travelPlace = new Place($this->database, $this->GetTravelPlace(), $this->GetPlanet(), null);
          
          $pX = $previousPlace->GetX();
          $pY = $previousPlace->GetY();
          if($this->GetPreviousPlace() == 'Auf Reise')
          {
            $pX = $this->GetX();
            $pY = $this->GetY();
          }
          $travelTime = abs($travelPlace->GetX() - $pX) + abs($travelPlace->GetY() - $pY);
          $tempX = $travelPlace->GetX() - $pX;
          $tempY = $travelPlace->GetY() - $pY;
          
          $maxSeconds = $this->GetActionTime() * 60;
          $secondsPassed = 0;
          if($maxSeconds != 0)
          {
            $secondsPassed = 1 - ($secondsLeft/$maxSeconds);
          }
          $xAdd = round($tempX * $secondsPassed);
          $yAdd = round($tempY * $secondsPassed);
          if($xAdd == 0 && $yAdd == 0)
          {
            $x = $this->GetX();
            $y = $this->GetY();
          }
          else
          {
            $x = $pX + $xAdd;
            $y = $pY + $yAdd;
          }
			  }
			
        $this->AddDebugLog(' - travel to place '.$place);
        $this->AddDebugLog(' - travel to x '.$x);
        $this->AddDebugLog(' - travel to y '.$y);
        $this->SetPreviousPlace('');
        $this->SetPlace($place);
        $this->SetX($x);
        $this->SetY($y);
        $update = $update.',previousplace="",x="'.$x.'",y="'.$y.'",place="'.$place.'"';
        
        $traveledTime = $this->GetActionTime() - round($secondsLeft/60);
        if($traveledTime > 0)
        {
          $leftTime = $this->GetTravelTimeLeft();
          if(!is_numeric($leftTime))
            $leftTime = 0;
          $travelTimeLeft = $leftTime + $traveledTime;
          $statsInTraining = floor($travelTimeLeft/60);
          if($statsInTraining > 0)
          {
            $travelTimeLeft = $travelTimeLeft - ($statsInTraining*60);
            $stats = $this->GetStats() + $statsInTraining;
            if($this->GetStats() == 0)
            {
              $update = $update.',statspopup="1"';
              $this->SetStatsPopup(true);
            }
            $this->AddDebugLog(' - set Stats from '.$this->GetStats().' to '.$stats);
            $this->SetStats($stats);
            $update = $update.',stats="'.$stats.'"';
          }
          $update = $update.',traveltimeleft="'.$travelTimeLeft.'"';
        }
      }
		}
		else if($countdown <= 0 && $action->GetType() == 5 && !$force)
		{
			$attacks = $this->GetAttacks();
			$attackID = $this->GetLearningAttack();
			
      $this->AddDebugLog(' - add Attack '.$attackID.' to '.$attacks);
			$attacks = $attacks.';'.$attackID;
      $this->AddDebugLog(' - Attacks now: '.$attacks);
			$update = $update.',learningattack="",attacks="'.$attacks.'"';
			$this->SetAttacks($attacks);
		}
		else if($times != 0 && $action->GetType() == 6)
		{
			if($action->GetID() == 30) //KI Unterdrücken
			{
        $this->AddDebugLog(' - KI Unterdrücken');
        $this->SetCanFakeKI(1);
			  $update = $update.',canfakeki="1"';
      }
			else if($action->GetID() == 48) //Affenschwanz ab
			{
        $this->AddDebugLog(' - Apetail off');
        $this->SetApeTail(0);
			  $update = $update.',apetail="0"';
      }
			else if($action->GetID() == 49) //Affenschwanz an
			{
        $this->AddDebugLog(' - Apetail on');
        $this->SetApeTail(1);
			  $update = $update.',apetail="1"';
      }
			else if($action->GetID() == 50) //Oozaru Kontrollieren
			{
        $this->AddDebugLog(' - Apecontrol on');
        $this->SetApeControl(1);
			  $update = $update.',apecontrol="1"';
      }
			else if($action->GetID() == 41) //Upgrade
			{
        $this->AddDebugLog(' - UpgradeChip');
        $this->UpgradeChip();
			}
			else if($action->GetID() == 31) //Sparring
			{
				for($i = 0; $i < $times; ++$i)
				{
          $otherPlayerID = $this->GetSparringPartner();
          $otherPlayer = new Player($this->database, $otherPlayerID, $this->actionManager);
          $this->AddDebugLog(' - Sparringpartner: '.$otherPlayer->GetName().' ('.$otherPlayerID.')');
					$statsWin = Player::CalculateSparringWin($this->database, $this, $otherPlayer);
          $this->AddDebugLog(' - SparringWin: '.$statsWin);
					$this->SetStats($this->GetStats()+$statsWin);
				}
				$update = $update.',stats="'.$this->GetStats().'"';
			}
		}
		else if($times != 0 && $action->GetType() == 7)
		{
      $itemManager = new itemManager($this->database);
      $itemID = $action->GetEarnItem();  
      $item = $itemManager->GetItem($itemID);
      $this->AddDebugLog(' - Earn item '.$item->GetName().' ('.$itemID.')');
      $this->AddItems($item, $item, $times);
    }
    
    
    if($times != 0)
    {
      $titelManager = new titelManager($this->database);
      $titelManager->AddTitelAction($this, $times, $action->GetID());
    }
			
		$this->SetAction(0);
		$this->SetActionTime(0);
		
		
		$rvguztime = 1440;
		if($this->GetPlace() == 'Raum von Geist und Zeit' || $this->GetPlace() == 'Trainingsberg')
		{
			$newPlace = '';
			if($this->GetPlace() == 'Raum von Geist und Zeit')
			{
				$newPlace = 'Gottespalast';
			}
			else if($this->GetPlace() == 'Trainingsberg')
			{
				$newPlace = 'Training Insel';
			}
			
			
			if($this->GetRVGUZTime() == 0)
			{
				$rvguztime = 1440;
				$update = $update.', rvguztime="'.$rvguztime.'"';
				$this->SetRVGUZTime($rvguztime);
			}
			else
			{
				$rvguztime = $this->GetRVGUZTime() - $elapsedMinutes;
				if($rvguztime <= 0)
				{
					$rvguztime = 0;
					$this->SetPlace($newPlace);
					$update = $update.', place="'.$newPlace.'"';
				}
				$update = $update.', rvguztime="'.$rvguztime.'"';
				$this->SetRVGUZTime($rvguztime);
			}
			
		}
		else if($this->GetRVGUZTime() != 0)
		{
				$update = $update.', rvguztime="0"';
				$this->SetRVGUZTime(0);
		}
    
    $this->AddDebugLog(' ');
    $debuglog = $this->GetDebugLog();
    $update = $update.',debuglog="'.$debuglog.'"';
		$result = $this->database->Update($update,'accounts','id = "'.$this->data['id'].'"',1);
	}
	
	public function GetInventory()
	{
		return $this->inventory;
	}
	
	public function SetInventory($inventory)
	{
		$this->inventory = $inventory;
	}
	
	public function IsLogged()
	{
		return $this->data['id'] != 0;
	}
	
	public function IsOnline()
	{
		$lastaction = strtotime($this->GetLastAction());
		$difference = time() - $lastaction;
    $hours = 30 * 60;
    return $difference < $hours;
	}
	
	public function IsBanned()
	{
		return $this->data['banned'] == 1;
	}
	
	public function GetBanReason()
	{
		return $this->data['banreason'];
	}
  
	public function GetTravelTimeLeft()
	{
		return $this->data['traveltimeleft'];
	}
  
	public function SetTravelTimeLeft($value)
	{
		$this->data['traveltimeleft'] = $value;
	}
	
	public function SetBanned($value)
	{
		$this->data['banned'] = $value;
	}
	
	public function SetBanReason($value)
	{
		$this->data['banreason'] = $value;
	}
	
	public function CreateCharacter($rasse, $chara, $raceimage, $mainID)
	{
    $rasse = $this->database->EscapeString($rasse);
    $chara = $this->database->EscapeString($chara);
    $raceimage = $this->database->EscapeString($raceimage);
		
		if($chara == '')
		{
			return 2;
		}
		
		$result = $this->database->Select('name','accounts','name = "'.$chara.'"',1);
		if ($result) 
		{
			$exist = $result->num_rows > 0;
			$result->close();
			if ($exist)
			{
				return 1;
			}
		}
		
		$place = 'Wald';
		$planet = 'Erde';
		$attacks = '1;2;20;307';
    $apeTail = 0;
    if($rasse == 'Namekianer')
      $attacks = $attacks.';293';
    else if($rasse == 'Saiyajin')
      $apeTail = 3;
		$fightAttacks = $attacks;
    $zeni = 1000;
		$stats = 10;
		$result = $this->database->Insert('name,userid,race,attacks, zeni, lp, mlp, kp, mkp, attack, defense,accuracy,reflex, fightattacks, place, planet, raceimage, apetail', 
																			'"'.$chara.'","'.$mainID.'","'.$rasse.'","'.$attacks.'","'.$zeni.'","'
																			.($stats*10).'","'.($stats*10).'","'.($stats*10).'","'.($stats*10).'","'.$stats.'","'.$stats.'","'.($stats*10).'","'.($stats*10).'"
                                      ,"'.$fightAttacks.'","'
																			.$place.'","'.$planet.'","'.$raceimage.'","'.$apeTail.'"', 'accounts');
		
		$id = $this->database->GetLastID();
    $result = $this->database->Select('COUNT(id) as total','accounts','');
		$rank = 0;
		if ($result) 
		{
      $row = $result->fetch_assoc();
      $rank = $row['total'];
			$result->close();
		}
		$this->SetRank($rank);
		
		$result = $this->database->Update('rank="'.$rank.'"','accounts','id = "'.$id.'"',1);
    return 0;
	}
	
	public function RegisterAcc($id, $code)
	{
		if(!is_numeric($id))
			return false;
    
		$acc = '';
		$email = '';
		$pw = '';
		$regID = 0;
		$id = $this->database->EscapeString($id);
		$result = $this->database->Select('*','registers','id = "'.$id.'"',1);
		if ($result) 
		{
      $row = $result->fetch_assoc();
			if(md5($row['password']) == $code)
			{
				$acc = $row['login'];
				$email = $row['email'];
				$pw = $row['password'];
				$regID = $row['id'];
			}
			else
			{
				return false;
			}
			$result->close();
		}
    else
    {
      return false;
    }
		
		$result = $this->database->Insert('LoginName,Password,Email,IP,Datum','"'.$acc.'","'.$pw.'","'.$email.'","'.$this->GetIP().'",NOW()', 'z_user');
		
		$id = $this->database->GetLastID();
    
		$result = $this->database->Delete('registers','login = "'.$acc.'"',1);
		
		return true;
	}
	
	public function ChangeFakeKI($ki)
	{
		$this->SetFakeKI($ki);
		$set = 'fakeki="'.$ki.'"';
		$result = $this->database->Update($set,'accounts','id = "'.$this->data['id'].'"',1);
	}
	
	public function ChangeDesign($design)
	{
		$design = $this->database->EscapeString($design);
		$this->SetDesign($design);
		$set = 'design="'.$design.'"';
		$result = $this->database->Update($set,'accounts','id = "'.$this->data['id'].'"',1);
	}
	
	public function ChangeTitel($titel)
	{
		$titel = $this->database->EscapeString($titel);
		$this->SetTitel($titel);
		$set = 'titel="'.$titel.'"';
		$result = $this->database->Update($set,'accounts','id = "'.$this->data['id'].'"',1);
	}
	
	public function AddTitel($titel)
	{
    $titels = $this->GetTitels();
    
    array_push($titels, $titel);
    
    if($titels[0] == 0)
      array_splice($titels, 0, 1);
    
    $titels = implode(';',$titels);
		$this->SetTitels($titels);
		$set = 'titels="'.$titels.'"';
		$result = $this->database->Update($set,'accounts','id = "'.$this->data['id'].'"',1);
	}
	
	public function ChangeProfile($text, $image, $chatactivate)
	{
		$formatedText = $this->database->EscapeString($text);
		$image = $this->database->EscapeString($image);
		$chatActive = 0;
		if($chatactivate == 1)
		{
			$chatActive = 1;
		}
		$set = 'text="'.$formatedText.'", charimage="'.$image.'", chatactive="'.$chatActive.'"';
		$result = $this->database->Update($set,'accounts','id = "'.$this->data['id'].'"',1);
		$this->SetText($text);
		$this->SetImage($image);
		$this->SetChatActive($chatActive);
	}
	
	public function UpdateFight($id)
	{
		$result = $this->database->Update('fight="'.$id.'"','accounts','id = "'.$this->data['id'].'"',1);
		$this->SetFight($id);
	}
	
	public function CloseStatsPopup()
	{
		$result = $this->database->Update('statspopup="0"','accounts','id = "'.$this->data['id'].'"',1);
		$this->SetStatsPopup(false);
	}
	
	public function IncreaseStats($lp, $kp, $attack, $defense)
	{
		$nlp = $this->GetLP() + ($lp * 10);
		$this->SetLP($nlp);
		$nmlp = $this->GetMaxLP() + ($lp * 10);
		$this->SetMaxLP($nmlp);
		
		$nkp = $this->GetKP() + ($kp * 10);
		$this->SetKP($nkp);
		$nmkp = $this->GetMaxKP() + ($kp * 10);
		$this->SetMaxKP($nmkp);
		
		$nattack = $this->GetAttack() + $attack;
		$this->SetAttack($nattack);
		
		$ndefense = $this->GetDefense() + $defense;
		$this->SetDefense($ndefense);
		
		$stats = $this->GetStats();
		$stats = $stats-$lp;
		$stats = $stats-$kp;
		$stats = $stats-$attack;
		$stats = $stats-$defense;
		$this->SetStats($stats);
		$this->SetStatsPopup(false);
		
		$update = 'statspopup="0"';
		$update = $update.', stats="'.$stats.'"';
		$update = $update.', lp="'.$nlp.'"';
		$update = $update.', mlp="'.$nmlp.'"';
		$update = $update.', kp="'.$nkp.'"';
		$update = $update.', mkp="'.$nmkp.'"';
		$update = $update.', attack="'.$nattack.'"';
		$update = $update.', defense="'.$ndefense.'"';
		$result = $this->database->Update($update,'accounts','id = "'.$this->data['id'].'"',1);
	}
	
	public function SwitchChannel($channel)
	{
		$channel = $this->database->EscapeString($channel);
		$result = $this->database->Update('chatchannel="'.$channel.'"','accounts','id = "'.$this->data['id'].'"',1);
		$this->SetChatChannel($channel);
	}
	
	public function EndAction()
	{
		$this->SetActionStart(0);
		$this->CalculateAction(false, false);
	}
	
	public function CancelAction($force=false)
	{
		$sparringAction = 31;
    if($force && $this->GetAction() == $sparringAction)
      return;
    
		$this->CalculateAction(true, $force);
	}
	
	public function Learn($action, $minutes, $attack, $skillpoints=0)
	{
    $newPoints = $this->GetSkillPoints()-$skillpoints;
    $newPointLearn = $this->GetSkillPointLearn()+$skillpoints;
		$this->DoAction($action, $minutes,',learningattack="'.$attack.'",skillpointlearn="'.$newPointLearn.'",skillpoints="'.$newPoints.'"');
		$this->SetLearningAttack($attack);
		$this->SetSkillPoints($newPoints);
		$this->SetSkillPointLearn($newPointLearn);
	}
	
	public function TravelPlanet($planet, $minutes, $action)
	{
		$update = ',travelplanet="'.$planet.'"';
		$this->DoAction($action, $minutes, $update);
		$this->SetTravelPlanet($planet);
	}
	
	public function Travel($place, $minutes, $action, $x, $y, $setAufReise=true)
	{
		$previousPlace = $this->GetPlace();
		$newPlace = $this->GetPlace();
		if($setAufReise)
		{
			$newPlace = 'Auf Reise';
		}
		$update = ',x="'.$x.'",y="'.$y.'",previousplace="'.$previousPlace.'", place="'.$newPlace.'", travelplace="'.$place.'"';
		$this->DoAction($action, $minutes,$update);
		$this->SetTravelPlace($place);
		$this->SetPreviousPlace($previousPlace);
		$this->SetPlace($newPlace);
	}
	
	public function DoAction($action, $minutes,$updateArgs='')
	{
		$timestamp = date("Y-m-d H:i:s");
		
		$hours = $minutes / 60;
		$price = round($action->GetPrice() * $hours);
		$zeni = $this->GetZeni() - $price;
		$this->SetZeni($zeni);
		
		$this->SetAction($action->GetID());
		
		$this->SetActionTime($minutes);
		$this->SetActionStart($timestamp);
		
		$result = $this->database->Update('zeni="'.$zeni.'",action="'.$action->GetID().'",actionstart="'.$timestamp.'",actiontime="'.$minutes.'"'.$updateArgs,'accounts','id = "'.$this->data['id'].'"',1);
	}
	
	public function UpdateDailyNPCFights()
	{
		$result = $this->database->Update('dailynpcfights="'.$this->GetDailyNPCFights().'"','accounts','id = "'.$this->data['id'].'"',1);
	}
	
	public function AddStats($stats)
	{
			if($this->GetStats() == 0)
			{
				$this->SetStatsPopup(true);
			}
			$this->SetStats($this->GetStats()+$stats);
		$result = $this->database->Update('statspopup="'.$this->GetStatsPopup().'",stats="'.$this->GetStats().'"','accounts','id = "'.$this->data['id'].'"',1);
	}
	public function AddTechnique($technique)
	{
		$attacks = explode(';',$this->GetAttacks());
		if(in_array($technique, $attacks))
		{
			return false;
		}
		array_push($attacks, $technique);
		$attacks = implode(';',$attacks);
		$this->SetAttacks($attacks);
		$result = $this->database->Update('attacks="'.$attacks.'"','accounts','id = "'.$this->data['id'].'"',1);
		return true;
	}
	
	public function JumpStory($story)
	{
		$this->SetStory($story);
		$result = $this->database->Update('story="'.$this->GetStory().'"','accounts','id = "'.$this->data['id'].'"',1);
	}
	
	public function ContinueStory($levelup, $zeni, $items, $skillpoints, $itemManager)
	{
		$this->SetStory($this->GetStory()+1);
		if($levelup)
		{
			$this->SetLevel($this->GetLevel()+1);
			if($this->GetStats() == 0)
			{
				$this->SetStatsPopup(true);
			}
			$this->SetStats($this->GetStats()+10);
		}
		if($zeni != 0)
		{
			$this->SetZeni($this->GetZeni()+$zeni);
		}
    if($skillpoints != 0)
    {
      $this->SetSkillPoints($this->GetSkillPoints()+$skillpoints);
    }
    
    if(isset($items) && count($items) > 0)
    {
      foreach($items as &$item)
      {
        $itemData = explode('@',$item);
        $itemObject = $itemManager->GetItem($itemData[0]);
        $this->AddItems($itemObject, $itemObject, $itemData[1]);
      }
    }
    $titelManager = new titelManager($this->database);
    $titelManager->AddTitelStory($this, $this->GetStory());
		$result = $this->database->Update('skillpoints=skillpoints+'.$skillpoints.',statspopup="'.$this->GetStatsPopup().'",stats="'.$this->GetStats().'",story="'.$this->GetStory().'",level="'.$this->GetLevel().'",zeni="'.$this->GetZeni().'"','accounts','id = "'.$this->data['id'].'"',1);
	}
	
	public function JoinTournament($tid)
	{
		$this->SetPendingTournament($tid);
		$result = $this->database->Update('pendingtournament="'.$tid.'"','accounts','id = "'.$this->data['id'].'"',1);
	}
	public function LeaveTournament()
	{
		$tid = 0;
		$this->SetPendingTournament($tid);
		$result = $this->database->Update('pendingtournament="'.$tid.'"','accounts','id = "'.$this->data['id'].'"',1);
	}
	
	public function IsValid()
	{
		return $this->valid;
	}
	
	public function GetData()
	{
		return $this->data;
	}
	
	public function GetChatChannel()
	{
		return $this->data['chatchannel'];
	}
	
	public function SetChatChannel($value)
	{
		$this->data['chatchannel'] = $value;
	}
	
	public function GetChatActive()
	{
		return $this->IsLogged() && $this->data['chatactive'] || isset($_POST['chatactive']);
	}
	
	public function SetChatActive($value)
	{
		$this->data['chatactive'] = $value;
	}
	
	public function GetID()
	{
		return $this->data['id'];
	}
	
	public function GetName()
	{
		return $this->data['name'];
	}
	public function SetName($value)
	{
		$this->data['name'] = $value;
	}
	
	public function GetPassword()
	{
		return $this->data['password'];
	}
	public function GetLogin()
	{
		return $this->data['login'];
	}
	
	public function GetGroup()
	{
    //return null;
    
		if($this->data['group'] == '')
		{
			return null;
		}
		return explode(';',$this->data['group']);
	}
	
	public function SetGroup($value)
	{
		$this->data['group'] = $value;
	}
	
	public function GetMultis()
	{
		return $this->data['multis'];
	}
	
	public function SetMultis($value)
	{
		$this->data['multis'] = $value;
	}
	
	public function GetGroupInvite()
	{
		return $this->data['groupinvite'];
	}
	
	public function SetGroupInvite($value)
	{
		$this->data['groupinvite'] = $value;
	}
	
	public function GetNPCWonItems()
	{
		return $this->data['npcwonitems'];
	}
	
	public function SetNPCWonItems($value)
	{
		$this->data['npcwonitems'] = $value;
	}
	
	public function GetPendingTournament()
	{
		return $this->data['pendingtournament'];
	}
	
	public function SetPendingTournament($value)
	{
		$this->data['pendingtournament'] = $value;
	}
	
	public function GetDeathTime()
	{
		return $this->data['deathtime'];
	}
	
	public function SetDeathTime($value)
	{
		$this->data['deathtime'] = $value;
	}
  
  public function GetReviveTime()
  {
    $deathTime = strtotime($this->GetDeathTime());
    $timeDiffSeconds = time()-$deathTime;
    
    $neededSeconds = 7 * 24 * 60 * 60; // 7 Days
    return $neededSeconds - $timeDiffSeconds;
  }
  
  public function Revive()
  {
    $deathPlanet = $this->GetDeathPlanet();
    if($deathPlanet == '')
      $deathPlanet = 'Erde';
    $deathPlace = $this->GetDeathPlace();
    if($deathPlace == '')
      $deathPlace = 'Wald';
    $this->SetPlanet($deathPlanet);
    $this->SetPlace($deathPlace);
	 $result = $this->database->Update('planet="'.$deathPlanet.'", place="'.$deathPlace.'"','accounts', 'id = "'.$this->GetID().'"',1);
  }
	
	public function GetSparringPartner()
	{
		return $this->data['sparringpartner'];
	}
  
  public function GetSparringPartnerName()
  {
    $partnerName = '';
    $result = $this->database->Select('id, name','accounts','id = "'.$this->GetSparringPartner().'"',1);
    if ($result) 
    {
      $row = $result->fetch_assoc();
      $partnerName = $row['name'];
      $result->close();
    }
    
    return $partnerName;
  }
	
	public function SetSparringPartner($value)
	{
		$this->data['sparringpartner'] = $value;
	}
	
	public function GetSparringCancel()
	{
		return $this->data['sparringcancel'];
	}
	
	public function SetSparringCancel($value)
	{
		$this->data['sparringcancel'] = $value;
	}
	
	public function GetSparringRequest()
	{
		return $this->data['sparringrequest'];
	}
	
	public function SetSparringRequest($value)
	{
		$this->data['sparringrequest'] = $value;
	}
	
	public function GetSparringTime()
	{
		return $this->data['sparringtime'];
	}
	
	public function SetSparringTime($value)
	{
		$this->data['sparringtime'] = $value;
	}
	
	public function GetTournament()
	{
		return $this->data['tournament'];
	}
	
	public function SetTournament($value)
	{
		$this->data['tournament'] = $value;
	}
	
	public function IsGroupLeader()
	{
		return $this->data['groupleader'];
	}
	
	public function SetGroupLeader($value)
	{
		$this->data['groupleader'] = $value;
	}
	
	public function GetStory()
	{
		return $this->data['story'];
	}
	
	public function SetStory($value)
	{
		$this->data['story'] = $value;
	}
	
	public function GetEventInvite()
	{
		return $this->data['eventinvite'];
	}
	
	public function SetEventInvite($value)
	{
		$this->data['eventinvite'] = $value;
	}
	
	public function GetAction()
	{

				return $this->data['action'];	
	}
	
	public function GetY()
	{
		return $this->data['y'];
	}
	
	public function SetY($value)
	{
		$this->data['y'] = $value;
	}
	
	public function GetX()
	{
		return $this->data['x'];
	}
	
	public function SetX($value)
	{
		$this->data['x'] = $value;
	}
	
	public function GetTravelPlace()
	{
		return $this->data['travelplace'];
	}
	
	public function SetTravelPlace($value)
	{
		$this->data['travelplace'] = $value;
	}
	
	public function GetTravelPlanet()
	{
		return $this->data['travelplanet'];
	}
	
	public function SetTravelPlanet($value)
	{
		$this->data['travelplanet'] = $value;
	}
	
	public function GetLearningAttack()
	{
		return $this->data['learningattack'];
	}
	
	public function SetLearningAttack($value)
	{
		$this->data['learningattack'] = $value;
	}
	
	public function GetDeathPlace()
	{
		return $this->data['deathplace'];
	}
	
	public function GetDeathPlanet()
	{
		return $this->data['deathplanet'];
	}
	
	public function GetStatsTraining()
	{
		if($this->data['statstraining'] == '')
		{
			return '0;0;0;0;0;0';
		}
		return $this->data['statstraining'];
	}
	
	public function SetStatsTraining($value)
	{
		$this->data['statstraining'] = $value;
	}
	
	public function GetEquippedStats()
	{
		if($this->data['equippedstats'] == '')
		{
			return '0;0;0;0;0;0';
		}
		return $this->data['equippedstats'];
	}
	
	public function SetEquippedStats($value)
	{
		$this->data['equippedstats'] = $value;
	}
	
	public function GetSkillPoints()
	{
		return $this->data['skillpoints'];
	}
	
	public function SetSkillPoints($value)
	{
		$this->data['skillpoints'] = $value;
	}
	
	public function GetSkillPointLearn()
	{
		return $this->data['skillpointlearn'];
	}
	
	public function SetSkillPointLearn($value)
	{
		$this->data['skillpointlearn'] = $value;
	}
	
	public function GetChallengeFight()
	{
		return $this->data['challengefight'];
	}
	
	public function SetChallengeFight($value)
	{
		$this->data['challengefight'] = $value;
	}
	
	public function GetChallengeTime()
	{
		return $this->data['challengedtime'];
	}
	
	public function SetChallengeTime($value)
	{
		$this->data['challengedtime'] = $value;
	}
	
	public function GetActionCountdown()
	{
		$timestamp = strtotime($this->GetActionStart()) + ($this->GetActionTime() * 60);
		$currentTime = strtotime("now");
		$difference = $timestamp - $currentTime;
    if($difference < 0) $difference = 0;
		return $difference;
	}
	
	public function SetAction($value)
	{
		$this->data['action'] = $value;
	}
	
	public function GetActionStart()
	{
		return $this->data['actionstart'];
	}
	
	public function SetActionStart($value)
	{
		$this->data['actionstart'] = $value;
	}
	
	public function GetActionTime()
	{
		return $this->data['actiontime'];
	}
	
	public function SetActiontime($value)
	{
		$this->data['actiontime'] = $value;
	}
	
	public function GetTravelBonus()
	{
    $travelBonus = $this->data['travelbonus'];
    if($this->GetRace() == 'Freezer')
      $travelBonus = $travelBonus+10;
		return $travelBonus;
	}
	
	public function GetTravelBonusInternal()
	{
    $travelBonus = $this->data['travelbonus'];
		return $travelBonus;
	}
	
	public function SetTravelBonus($value)
	{
		$this->data['travelbonus'] = $value;
	}
	
	public function GetTrainBonus()
	{
		return $this->data['trainingstats'];
	}
	
	public function SetTrainBonus($value)
	{
		$this->data['trainingstats'] = $value;
	}
	
	public function GetFightAttacks()
	{
		return $this->data['fightattacks'];
	}
	
	public function SetFightAttacks($value)
	{
		$this->data['fightattacks'] = $value;
	}
  
	public function GetAttacks()
	{
		return $this->data['attacks'];
	}
  
	public function GetSpielerKills()
	{
		return $this->data['spielertotungen'];
	}
	
	public function SetAttacks($value)
	{
		$this->data['attacks'] = $value;
	}
  
  public function AddFightAttack($technique)
  {
		$attacks = explode(';',$this->GetFightAttacks());
		if(in_array($technique, $attacks))
		{
			return;
		}
		array_push($attacks, $technique);
		$attacks = implode(';',$attacks);
    $this->SetFightAttacks($attacks);
  }
	
	public function GetStatsPopup()
	{
		return $this->data['statspopup'];
	}
	
	public function SetStatsPopup($value)
	{
		$this->data['statspopup'] = $value;
	}
	
	public function GetLP()
	{
		return $this->data['lp'];
	}
	
	public function SetLP($value)
	{
		$this->data['lp'] = $value;
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
		return round(($this->GetLP() / $this->GetMaxLP())*100);
	}
	
	public function GetKP()
	{
		return $this->data['kp'];
	}
	
	public function SetKP($value)
	{
		$this->data['kp'] = $value;
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
		return  round(($this->GetKP() / $this->GetmaxKP())*100);
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
	
	public function GetAccuracy()
	{
		return $this->data['accuracy'];
	}
	
	public function SetAccuracy($value)
	{
		$this->data['accuracy'] = $value;
	}
	
	public function GetReflex()
	{
		return $this->data['reflex'];
	}
	
	public function SetReflex($value)
	{
		$this->data['reflex'] = $value;
	}
	
	public function GetKI()
	{
		$value = ($this->GetMaxLP()/10) + ($this->GetMaxKP()/10) + $this->GetAttack() + $this->GetDefense();
		$value = round($value / 4);
		return $value;
	}
	
	public function GetRace()
	{
		return $this->data['race'];
	}
	
	public function GetRaceImage()
	{
		return $this->data['raceimage'];
	}
	
	public function GetLevel()
	{
		return $this->data['level'];
	}
	
	public function SetLevel($value)
	{
		$this->data['level'] = $value;
	}
	
	public function GetZeni()
	{
		return $this->data['zeni'];
	}
	
	public function SetZeni($value)
	{
		$this->data['zeni'] = $value;
	}
	
	public function GetArenaPoints()
	{
		return $this->data['arenapoints'];
	}
	
	public function SetArenaPoints($value)
	{
		$this->data['arenapoints'] = $value;
	}
  
  public function AddWish($wish)
  {
    $wishes = $this->GetWishes();
    
    if($wishes == '')
      $wishes = $wish;
    else
      $wishes = $wishes.';'.$wish;
    
    $this->SetWishes($wishes);
  }
	
	public function GetWishes()
	{
		return $this->data['wishes'];
	}
	
	public function SetWishes($value)
	{
		$this->data['wishes'] = $value;
	}
	
	public function GetWishLastFight()
	{
		return $this->data['wishlastfight'];
	}
	
	public function SetWishLastFight($value)
	{
		$this->data['wishlastfight'] = $value;
	}
  
  public function GetWishFightLeftSeconds()
  {
    return strtotime($this->GetWishLastFight()) - time();
  }
  
  public function HasWish($value)
  {
    $wishes = explode(';',$this->GetWishes());
    if(in_array($value, $wishes))
      return true;
    
    return false;
  }
	
	public function GetWishCounter()
	{
    $result = $this->database->Select('userid, wishcounter', 'accounts', 'wishcounter != 0 AND userid="'.$this->GetUserID().'"', 1);
		if ($result) 
		{
			if ($result->num_rows > 0)
			{
				$row = $result->fetch_assoc();
        return $row['wishcounter'];
			}
			$result->close();
		}
		return $this->data['wishcounter'];
	}
	
	public function CanWish()
	{
    return $this->GetWishCounter() == 0;
	}
	
	public function SetWishCounter($value)
	{
		$this->data['wishcounter'] = $value;
	}
	
	public function GetStats()
	{
		return $this->data['stats'];
	}
	
	public function SetStats($value)
	{
		$this->data['stats'] = $value;
	}
	
	public function GetWon()
	{
		return $this->data['won'];
	}
	
	public function SetWon($value)
	{
		$this->data['won'] = $value;
	}
	
	public function GetDraws()
	{
		return $this->data['draws'];
	}
	
	public function SetDraws($value)
	{
		$this->data['draws'] = $value;
	}
	
	public function GetLost()
	{
		return $this->data['lost'];
	}
	
	public function SetLost($value)
	{
		$this->data['lost'] = $value;
	}
	
	public function GetTFights()
	{
		return $this->data['tfights'];
	}
	
	public function SetTFights($value)
	{
		$this->data['tfights'] = $value;
	}
	
	public function GetSFights()
	{
		return $this->data['sfights'];
	}
	
	public function SetSFights($value)
	{
		$this->data['sfights'] = $value;
	}
	
	public function GetWFights()
	{
		return $this->data['wfights'];
	}
	
	public function SetWFights($value)
	{
		$this->data['wfights'] = $value;
	}
	
	public function GetDailyfights()
	{
		return $this->data['dailyfights'];
	}
	
	public function SetDailyfights($value)
	{
		$this->data['dailyfights'] = $value;
	}
	
	public function GetDailyNPCFights()
	{
		return $this->data['dailynpcfights'];
	}
	
	public function SetDailyNPCFights($value)
	{
		$this->data['dailynpcfights'] = $value;
	}
	
	public function GetTotalStatsFights()
	{
		return $this->data['totalstatsfights'];
	}
	public function GetPlayerIPadress()
	{
		return $this->data['ip'];
	}
	public function GetPlayersMulti()
	{
		return $this->data['multiaccounts'];
	}
	public function GetPlayersChatban()
	{
		return $this->data['chatban'];
	}
	public function GetPlayersWarnung()
	{
		return $this->data['warnung'];
	}
	public function GetMaxStatsFights()
	{
		return $this->GetLevel() * 10;
	}
	
	public function GetMaxStatsTrain()
	{
		return $this->GetLevel() * 100;
		
	}
	
	public function SetTotalStatsFights($value)
	{
		$this->data['totaldailyfights'] = $value;
	}
	
	public function GetPlanet()
	{
		return $this->data['planet'];
	}
	
	public function SetPlanet($value)
	{
		$this->data['planet'] = $value;
	}
	
	public function GetPreviousPlace()
	{
		return $this->data['previousplace'];
	}
	
	public function SetPreviousPlace($value)
	{
		$this->data['previousplace'] = $value;
	}
	
	public function GetPlace()
	{
		return $this->data['place'];
	}
  
	public function SetPlace($value)
	{
		$this->data['place'] = $value;
	}
	
	public function GetImage()
	{
    if($this->data['charimage'] == '')
    {
      return 'img/imagefail.png';
    }
		return $this->data['charimage'];
	}
	
	public function SetImage($value)
	{
		$this->data['charimage'] = $value;
	}
	
	public function GetDesign()
	{
		return $this->data['design'];
	}
	
	public function GetRealFakeKI()
	{
		return $this->data['fakeki'];
	}
	
	public function CanFakeKI()
	{
		return $this->data['canfakeki'];
	}
	
	public function SetCanFakeKI($value)
	{
		$this->data['canfakeki'] = $value;
	}
	
	public function GetFakeKI()
	{
		if($this->data['fakeki'] == 0)
		{
			return $this->GetKI();
		}
		return $this->data['fakeki'];
	}
	
	public function GetEmail()
	{
		return $this->data['email'];
	}
	
	public function SetEmail($value)
	{
		$this->data['email'] = $value;
	}
	
	public function GetArank()
	{
		return $this->data['arank'];
	}
  	public function GetCanJoin()
	{
		return $this->data['canjoin'];
	}
	
	public function GetTitel()
	{
		return $this->data['titel'];
	}
	
	public function GetTitels()
	{
    if($this->data['titels'] == '')
      return array();
    
		return explode(';',$this->data['titels']);
	}
	
	public function HasTitel($titel)
	{
    return in_array($titel, $this->GetTitels());
	}
	
	public function SetTitels($titels)
	{
		$this->data['titels'] = $titels;
	}
	
	public function GetRank()
	{
		return $this->data['rank'];
	}
	
	public function SetRank($value)
	{
		$this->data['rank'] = $value;
	}
	
	public function GetText()
	{
		return $this->data['text'];
	}
	
	public function SetText($value)
	{
		$this->data['text'] = $value;
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
	
	public function GetFight()
	{
		return $this->data['fight'];
	}
	
	public function SetFight($value)
	{
		$this->data['fight'] = $value;
	}
	
	public function SetDesign($design)
	{
		$this->data['design'] = $design;
	}
	
	public function SetTitel($titel)
	{
		$this->data['titel'] = $titel;
	}
	
	public function SetFakeKI($value)
	{
		$this->data['fakeki'] = $value;
	}
	
}

if(!isset($isChat))
{
	$isChat = false;
}
$id = 0;
if($account->IsLogged())
{
  $id = $account->Get('id');
}
$player = new Player($database, 0, $actionManager, $isChat, $id);
?>