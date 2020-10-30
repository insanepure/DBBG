<?php
if($database == NULL)
{
	print 'This File ('.__FILE__.') should be after Datatabase!';
}

include_once 'marketitem.php';

class Market
{
	
	private $database;
  private $items;
	
	function __construct($db)
	{
    $this->database = $db;
    $this->items = array();
    $this->LoadItems();
  }
	
  public function HasItemInside($statsID, $visualID, $statstype, $upgrade, $seller)
  {
		$i = 0;
		$item = $this->GetItem($i);
		while(isset($item))
		{
			if($item->GetSellerID() == $seller && $item->GetStatsID() == $statsID && $item->GetVisualID() == $visualID
        && $item->GetStatsType() == $statstype && $item->GetUpgrade() == $upgrade)
			{
				return true;
			}
			++$i;
			$item = $this->GetItem($i);
		}
		return false;
	}
	
  public function TakeItem($id, $amount)
  {
		$itemIdx = $this->GetItemIndex($id);
		$item = $this->GetItem($itemIdx);
		$newAmount = $item->GetAmount() - $amount;
		if($newAmount == 0)
		{
			$result = $this->database->Delete('market','`id`="'.$item->GetID().'"',1);
  		array_splice($this->items,$itemIdx,1);
		}
		else
		{
			$result = $this->database->Update('`amount`="'.$newAmount.'"','market','`id`="'.$item->GetID().'"',1);
			$item->SetAmount($newAmount);
		}
	}
	
  public function AddItem($statsid, $visualid, $statstype, $upgrade, $amount, $price, $player)
  {
    foreach($this->items as &$item)
    {
      if($item->GetSellerID() != $player->GetID())
        continue;
      if($item->GetStatsID() != $statsid)
        continue;
      if($item->GetVisualID() != $visualid)
        continue;
      if($item->GetStatsType() != $statstype)
        continue;
      if($item->GetUpgrade() != $upgrade)
        continue;
      if($item->GetPrice() != $price)
        continue;
      
      $newAmount = $item->GetAmount()+$amount;
      $item->SetAmount($newAmount);
			$result = $this->database->Update('`amount`="'.$newAmount.'"','market','`id`="'.$item->GetID().'"',1);
      return;
    }
    
			$result = $this->database->Insert('`seller`, `sellerid`, `statsid`, `visualid`, `statstype`, `upgrade`, `amount`, `price`',
																				'"'.$player->GetName().'","'.$player->GetID().'","'.$statsid.'","'.$visualid.'","'.$statstype.'","'.$upgrade.'","'.$amount.'","'.$price.'"', 'market');
		$id = $this->database->GetLastID();
    $marketitem = $this->LoadItem($id);
		array_push($this->items, $marketitem);
	}
  
  private function LoadItem($id)
  {
    $select = 'market.id, 
    market.statsid, 
    market.visualid, 
    market.sellerid,
    market.statstype,
    market.upgrade,
    market.seller,
    market.amount,
    market.price,
    visualitem.name, 
    visualitem.image,
    visualitem.equippedimage,
    visualitem.description,
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
    statsitem.fightattack,
    statsitem.needitem,
    statsitem.race,
    statsitem.trainbonus,
    statsitem.upgradeid,
    statsitem.slot';
    $where = 'market.id = '.$id;
    $order = 'market.statsid, market.visualid, market.price, market.id';
    $join = 'items statsitem ON market.statsid = statsitem.id JOIN items visualitem ON market.visualid = visualitem.id';
    $from = 'market';
		$result = $this->database->Select($select,$from, $where,1, $order,'ASC', $join);
    
    $item = null;
		if ($result) 
		{
			if ($result->num_rows > 0)
			{
        while($row = $result->fetch_assoc()) 
        {
					$item = new MarketItem($row);
        }
			}
			$result->close();
    }
    
    return $item;
  }
  
  private function LoadItems()
  {
    $select = 'market.id, 
    market.statsid, 
    market.visualid, 
    market.sellerid,
    market.seller,
    market.statstype,
    market.upgrade,
    market.amount,
    market.price,
    visualitem.name, 
    visualitem.image,
    visualitem.equippedimage,
    visualitem.description,
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
    statsitem.fightattack,
    statsitem.needitem,
    statsitem.race,
    statsitem.trainbonus,
    statsitem.upgradeid,
    statsitem.slot';
    $where = '';
    $order = 'market.statsid, market.visualid, market.price, market.id';
    $join = 'items statsitem ON market.statsid = statsitem.id JOIN items visualitem ON market.visualid = visualitem.id';
    $from = 'market';
		$result = $this->database->Select($select,$from, $where,999999, $order,'ASC', $join);
		if ($result) 
		{
			if ($result->num_rows > 0)
			{
        while($row = $result->fetch_assoc()) 
        {
					$marketitem = new MarketItem($row);
					array_push($this->items, $marketitem);
        }
			}
			$result->close();
      
		}
  }
  
  public function GetItemIndex($id)
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
    return 0;
  }
  
  public function GetItemByID($id)
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
  
  public function GetItem($id)
  {
		if(count($this->items) > $id)
		{
			return $this->items[$id];
		}
		return null;
  }
  
}