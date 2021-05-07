<?php
if($database == NULL)
{
	print 'This File ('.__FILE__.') should be after Datatabase!';
}

class InventoryItem
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
  
  public function GetAmount()
  {
    return $this->data['amount'];
  }
  
  public function SetAmount($value)
  {
    $this->data['amount'] = $value;
  }
  
  public function GetStatsType()
  {
    return $this->data['statstype'];
  }
  
  public function SetStatsType($value)
  {
    $this->data['statstype'] = $value;
  }
  
  public function GetValue()
  {
    return $this->data['value'];
  }
  
  public function SetValue($value)
  {
    $this->data['value'] = $value;
  }
  
  public function GetUpgrade()
  {
    return $this->data['upgrade'];
  }
  
  public function GetCalculateUpgrade()
  {
    return $this->data['upgrade']+1;
  }
  
  public function SetUpgrade($value)
  {
    $this->data['upgrade'] = $value;
  }
  
  public function GetMaxUpgrade()
  {
    return $this->data['maxupgrade'];
  }
  
  public function GetVisualID()
  {
    return $this->data['visualid'];
  }
  
  public function SetVisualID($value)
  {
    $this->data['visualid'] = $value;
  }
  
  public function GetStatsID()
  {
    return $this->data['statsid'];
  }
  
  public function SetStatsID($value)
  {
    $this->data['statsid'] = $value;
  }
  
  public function CanChangeType()
  {
    return $this->data['changetype'];
  }
  
  public function CanUpgrade()
  {
    return $this->data['changeupgrade'];
  }
  
  public function GetUpgradeDivider()
  {
    return $this->data['upgradedivider'];
  }
  
  public function IsEquipped()
  {
    return $this->data['equipped'];
  }
  
  public function SetEquipped($value)
  {
    $this->data['equipped'] = $value;
  }
  
  private function GetTypeName()
  {
    switch($this->GetStatsType())
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
    $type = $this->GetType();;
        
    if($type == 3 && $this->data['value'] != 0|| $this->GetStatsID() == 184)
      $returnValue = $returnValue.' '.$this->GetTypeName();
    
    if($this->GetUpgrade() != 0)
      $returnValue = $returnValue.' Level '.$this->GetCalculateUpgrade();
    
    return $returnValue;
  }
  
  public function SetName($value)
  {
    $this->data['name'] = $value;
  }
  
  public function GetImage()
  {
    return $this->data['image'];
  }
  
  public function SetImage($value)
  {
    $this->data['image'] = $value;
  }
  
  public function IsSellable()
  {
    return $this->data['ItemSellable'];
  }
  
  public function IsMarketSellable()
  {
    return $this->data['ItemMarketSellable'];
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
  
  public function IsOnTop()
  {
    return $this->data['ontop'];
  }
  
  public function GetEquippedImage()
  {
    return $this->data['equippedimage'];
  }
  
  public function SetEquippedImage($value)
  {
    $this->data['equippedimage'] = $value;
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
    return $this->data['price'] + floor($this->data['price']/10 * $this->GetUpgrade());
  }
  
  public function GetArenaPoints()
  {
    return $this->data['arenapoints'];
  }
  
  public function GetType()
  {
    return $this->data['type'];
  }
  
  private function GetStatsValue($validTypes, $multiplier)
  {
    $value = $this->GetValue();
    $statsType = $this->GetStatsType();
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
    
    $upgradeDivider = $this->GetUpgradeDivider();
    if($upgradeDivider == 0)
      $upgradeDivider = 1;
    
    $addValue = $value/$upgradeDivider * $this->GetUpgrade();
    
    $value = $value + $addValue;
    $value = $value/$divider;
    $value = floor($value);

    $value = $value * $multiplier;
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
  
  public function DisplayEffect()
  {
    if($this->GetStatsID() == 184)
      echo 'Ändert den Typ auf "<b>Item '.$this->GetTypeName().'</b>"<br/>';
    
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


class Inventory
{
  private $database;
  private $ownerid = 0;
  private $items;
	private $equippedItems;
	private $hasRadar;
	private $hasDBs;
	private $radarID = 75;
	private $dbsID = 150;
  
  function __construct($database, $ownerid)
  {
    $this->database = $database;
    
    $this->ownerid = $ownerid;
    
    $this->items = array();
    $this->equippedItems = array();
		$this->hasRadar = false;
		$this->hasDBs = false;
    
    $this->LoadData($ownerid);
  }
  
  public function GetCount()
  {
    return count($this->items);
  }
  
  public function HasRadar()
  {
    return $this->hasRadar;
  }
  
  public function SetHasRadar($value)
  {
    $this->hasRadar = $value;
  }
  
  public function HasDBs()
  {
    return $this->hasDBs;
  }
  
  public function SetHasDBs($value)
  {
    $this->hasDBs = $value;
  }
  
  public function GetItem($id)
  {
    if(count($this->items) > $id && $id >= 0)
    {
      return $this->items[$id];
    }
    return null;
  }
  
  public function GetItemByIDOnly($statsid, $visualid)
  {
    for($i = 0; $i < count($this->items); ++$i)
    {
      if($this->items[$i]->GetStatsID() == $statsid && $this->items[$i]->GetVisualID() == $visualid)
        return $this->items[$i];
    }
    return null;
  }
  
  public function GetItemByID($statsid, $visualid, $statstype, $upgrade)
  {
    for($i = 0; $i < count($this->items); ++$i)
    {
      if($this->items[$i]->GetStatsID() == $statsid && $this->items[$i]->GetVisualID() == $visualid &&
         $this->items[$i]->GetStatsType() == $statstype && $this->items[$i]->GetUpgrade() == $upgrade)
        return $this->items[$i];
    }
    return null;
  }
  
  public function GetItemIndexByID($statsid, $visualid, $statstype, $upgrade)
  {
    for($i = 0; $i < count($this->items); ++$i)
    {
      if($this->items[$i]->GetStatsID() == $statsid && $this->items[$i]->GetVisualID() == $visualid &&
         $this->items[$i]->GetStatsType() == $statstype && $this->items[$i]->GetUpgrade() == $upgrade)
        return $i;
    }
    return -1;
  }
  
  public function GetItemID($id)
  {
    $i = 0;
		while(isset($this->items[$i]))
		{
			if($this->items[$i]->GetID() == $id)
			{
        return $i;
			}
			++$i;
		}
		return $i;
  }
  
  public function GetItemByDatabaseID($id)
  {
    $i = 0;
		while(isset($this->items[$i]))
		{
			if($this->items[$i]->GetID() == $id)
			{
        return $this->items[$i];
			}
			++$i;
		}
		return null;
  }
  
  public function GetItemAtSlot($slot)
  {
		if(isset($this->equippedItems[$slot]))
		{
			return $this->equippedItems[$slot];
		}
		return null;
  }
	
	public function HasItem($id)
	{
    $i = 0;
		while(isset($this->items[$i]))
		{
			if($this->items[$i]->GetID() == $id)
			{
				return true;
			}
			++$i;
		}
		return false;
	}
  
	
	public function HasItemWithID($statsid, $visualid)
	{
    $i = 0;
		while(isset($this->items[$i]))
		{
			if($this->items[$i]->GetStatsID() == $statsid && $this->items[$i]->GetVisualID() == $visualid)
			{
				return true;
			}
			++$i;
		}
		return false;
	}
  
  
  public function CombineItems($statsitem, $visualitem)
  {
    $visualID = $visualitem->GetID();
    $id = $this->GetItemID($visualID);
    
    $statsitem->SetVisualID($visualID);
    $statsitem->SetName($visualitem->GetRealName());
    $statsitem->SetImage($visualitem->GetImage());
    $statsitem->SetEquippedImage($visualitem->GetEquippedImage());
    
		$result = $this->database->Update('visualid='.$visualitem->GetVisualID().'','inventory','id = '.$statsitem->GetID().'',1);
    
    array_splice($this->items, $id, 1);
		$result = $this->database->Delete('inventory','id = '.$visualitem->GetID().'',1);
  }
  
  
  public function EquipItem($item)
  {
    $slot = $item->GetSlot();
    $item->SetEquipped(1);
    $this->equippedItems[$slot] = $item;
		$result = $this->database->Update('equipped="1"','inventory','id = '.$item->GetID().'',1);
  }
  
  public function UnequipItem($item)
  {
    $slot = $item->GetSlot();
    $item->SetEquipped(0);
    unset($this->equippedItems[$slot]);
		$result = $this->database->Update('equipped="0"','inventory','id = '.$item->GetID().'',1);
  }
  
  public function AddItem($statsitem, $visualitem, $amount, $statstype=0, $upgrade=0)
  {
    $i = 0;
		$slot = 0;
    $inventoryItem = null;
		
		if($statsitem->GetType() != 3 && $statsitem->GetType() != 4)
		{
      $inventoryItem = $this->GetItemByID($statsitem->GetID(), $visualitem->GetID(), $statstype, $upgrade);
		}
		
		if($statsitem->GetID() == $this->radarID)
		{
			$this->SetHasRadar(true);
		}
		
		if($statsitem->GetID() == $this->dbsID)
		{
			$this->SetHasDBs(true);
		}
		
		if($inventoryItem == null)
		{
			
			$i = 0;
			//Add only one if type == 3
			while($i != $amount)
			{
				$inventoryItem = null;
        $addAmount = 1;
				if($statsitem->GetType() == 3 || $statsitem->GetType() == 4)
				{
					++$i;
				}
				else
				{
          $addAmount = $amount;
					$i = $amount;
				}
		      $result = $this->database->Insert('statsid, visualid, ownerid, amount, statstype, upgrade',
                                            '"'.$statsitem->GetID().'","'.$visualitem->GetID().'","'.$this->ownerid.'","'.$addAmount.'","'.$statstype.'","'.$upgrade.'"', 'inventory');
          $id = $this->database->GetLastID();
          $inventoryItem = $this->LoadItem($id);
          $this->AddInventoryItem($inventoryItem);
			}
		}
		else
		{
      $itemAmount = $inventoryItem->GetAmount() + $amount;
			$inventoryItem->SetAmount($itemAmount);
		  $result = $this->database->Update('amount="'.$itemAmount.'"','inventory','id = '.$inventoryItem->GetID().'',1);
		}
    
    return $inventoryItem;
  }
  
  public function RemoveItem($id, $amount)
  {
    if(count($this->items) <= $id || $id < 0)
      return;
    
    $item = $this->items[$id];
    $itemAmount = $item->GetAmount() - $amount;
    
    if($itemAmount > 0)
    {
      $item->SetAmount($itemAmount);
		  $result = $this->database->Update('amount="'.$itemAmount.'"','inventory','id = '.$item->GetID().'',1);
    }
    else
    {
      if($item->GetID() == $this->radarID)
      {
        $this->SetHasRadar(false);
      }
      if($item->GetID() == $this->dbsID)
      {
        $this->SetHasDBs(false);
      }
      array_splice($this->items, $id, 1);
		  $result = $this->database->Delete('inventory','id = '.$item->GetID().'',1);
    }
  }
  
  private function LoadItem($id)
  {
    $select = 'inventory.id, 
    inventory.statsid, 
    inventory.visualid, 
    inventory.ownerid, 
    inventory.amount,
    inventory.equipped,
    inventory.statstype,
    inventory.upgrade,
    visualitem.name, 
    visualitem.image,
    visualitem.equippedimage,
    visualitem.description,
    visualitem.ontop,
    statsitem.type,
    statsitem.lp, 
    statsitem.kp,
    statsitem.attack,
    statsitem.defense,
    statsitem.value,
    statsitem.travelbonus,
    statsitem.lv,
    statsitem.sellable,
    statsitem.category,
    statsitem.price,
    statsitem.fightattack,
    statsitem.needitem,
    statsitem.race,
    statsitem.trainbonus,
    statsitem.upgradeid,
    statsitem.slot,
    CASE
    WHEN visualitem.sellable = 0 THEN 0
    WHEN statsitem.sellable = 0 THEN 0
    ELSE 1
    END as ItemSellable,
    CASE
    WHEN visualitem.marketsellable = 0 THEN 0
    WHEN statsitem.marketsellable = 0 THEN 0
    ELSE 1
    END as ItemMarketSellable';
    $where = 'inventory.id = '.$id;
    $order = 'inventory.id';
    $join = 'items statsitem ON inventory.statsid = statsitem.id JOIN items visualitem ON inventory.visualid = visualitem.id';
    $from = 'inventory';
		$result = $this->database->Select($select,$from, $where,1, $order,'ASC', $join);
    
    $item = null;
		if ($result) 
		{
			if ($result->num_rows > 0)
			{
        while($row = $result->fetch_assoc()) 
        {
					$item = new InventoryItem($row);
        }
			}
			$result->close();
    }
    
    return $item;
  }
  
  private function AddInventoryItem($item)
  {
    if($item->GetStatsID() == $this->radarID)
    {
      $this->SetHasRadar(true);
    }
    if($item->GetStatsID() == $this->dbsID)
    {
      $this->SetHasDBs(true);
    }
    if($item->IsEquipped())
    {
      $slot = $item->GetSlot();
      $this->equippedItems[$slot] = $item;
    }
    
    array_push($this->items, $item);
  }
  
  
  private function LoadData($ownerid)
  {
    $select = 'inventory.id, 
    inventory.statsid, 
    inventory.visualid, 
    inventory.ownerid, 
    inventory.amount,
    inventory.equipped,
    inventory.statstype,
    inventory.upgrade,
    visualitem.name, 
    visualitem.image,
    visualitem.equippedimage,
    visualitem.description,
    visualitem.ontop,
    visualitem.overlay,
    statsitem.type,
    statsitem.lp, 
    statsitem.kp,
    statsitem.attack,
    statsitem.defense,
    statsitem.value,
    statsitem.travelbonus,
    statsitem.lv,
    statsitem.sellable,
    statsitem.category,
    statsitem.price,
    statsitem.fightattack,
    statsitem.needitem,
    statsitem.race,
    statsitem.trainbonus,
    statsitem.upgradeid,
    statsitem.slot,
    statsitem.changetype,
    statsitem.changeupgrade,
    statsitem.maxupgrade,
    statsitem.upgradedivider,
    CASE
    WHEN visualitem.sellable = 0 THEN 0
    WHEN statsitem.sellable = 0 THEN 0
    ELSE 1
    END as ItemSellable,
    CASE
    WHEN visualitem.marketsellable = 0 THEN 0
    WHEN statsitem.marketsellable = 0 THEN 0
    ELSE 1
    END as ItemMarketSellable';
    $where = 'inventory.ownerid = '.$ownerid;
    $order = 'inventory.id';
    $join = 'items statsitem ON inventory.statsid = statsitem.id JOIN items visualitem ON inventory.visualid = visualitem.id';
    $from = 'inventory';
		$result = $this->database->Select($select,$from, $where,999999, $order,'ASC', $join);
		if ($result) 
		{
			if ($result->num_rows > 0)
			{
        while($row = $result->fetch_assoc()) 
        {
					$item = new InventoryItem($row);
          $this->AddInventoryItem($item);
        }
			}
			$result->close();
      
		}
    
  }
}