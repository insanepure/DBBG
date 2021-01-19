<?php 
function postToDiscord($message)
{
    $data = array("content" => $message, "username" => "DBBG-Spion");
    $curl = curl_init("https://discordapp.com/api/webhooks/461508519666122773/iP_uTj5VkbQyOv1K4iwSeqidk_0IHUiyMreUcO1PWCHki2r6vrFeKVij87Blc4NGnEbX");
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    return curl_exec($curl);
}

if(!isset($player) || !$player->IsValid() || $player->GetARank() < 2)
{
	header('Location: ?p=news');
	exit();  
}

$limitedTables = array('actions', 'attacks', 'items', 'npcs', 'places', 'story', 'events', 'titel', 'patterns', 'planet', 'wishes');

if($player->GetARank() < 3 && isset($_GET['table']) && !in_array($_GET['table'], $limitedTables))
{
	header('Location: ?p=admin');
	exit();  
}

function AddToLog($database, $ip, $accs, $log)
{
   $timestamp = date('Y-m-d H:i:s');
  $insert = '"'.$ip.'","'.$accs.'","'.$database->EscapeString($log).'","'.$timestamp.'"';
  $result = $database->Insert('ip,accounts,log,time', $insert,'adminlog');
}



$ip = $account->GetIP();
$accs = $player->GetName().' ('.$player->GetID().')';
$log = '';


if(isset($_GET['a']) && $_GET['a'] == 'delete' && isset($_POST['sure']))
{
  $table = $_GET['table'];
  $id = $_POST['id'];
  $database->Delete($table,'id="'.$id.'"');
  $message = 'Die ID '.$id.' wurde aus Tabelle '.$table.' gelöscht.';
  $log = $log.'Die ID <b>'.$id.'</b> wurde aus Tabelle <b>'.$table.'</b> gelöscht.<br/>';
  AddToLog($database, $ip, $accs, $log);
}
else if(isset($_GET['a']) && $_GET['a'] == 'edit')
{
  $table = $_GET['table'];
  $result = $database->Select('*', $table, '');
  $finfo = $result->fetch_fields();
  
  
  $create = false;
  if(!isset($_POST['id']) || $_POST['id'] == '' || $_POST['id'] == 0)
  {
    $create = true;
  }
  
	if($table == 'npcs' || $table == 'fighters')
	{
		if(isset($_POST['fighter_patterns']))
		{
			$_POST['patterns'] = implode(';', $_POST['fighter_patterns']);
		}
		else
		{
			$_POST['patterns'] = '';
		}
	}
	
	if($table == 'events')
	{
		if(isset($_POST['event_items']))
		{
			$_POST['item'] = implode(';', $_POST['event_items']);
		}
		else
		{
			$_POST['item'] = '';
		}
	}
	if($table == 'accounts')
	{
		if(isset($_POST['player_titel']))
		{
			$_POST['titels'] = implode(';',$_POST['player_titel']);
		}
		else
		{
			$_POST['titels'] = '';
		}
    
		if(isset($_POST['multi_accs']))
		{
			$_POST['multiaccounts'] = implode(';',$_POST['multi_accs']);
		}
		else
		{
			$_POST['multiaccounts'] = '';
		}
	}
	if($table == 'npcs' || $table == 'story' || $table == 'fights')
	{
		if(isset($_POST['npcandstoryitems_item']))
		{
			$npcItems = array();
			$itemCount = count($_POST['npcandstoryitems_item']);
			$i = 0;
			while($i != $itemCount)
			{
				$item = array();

				$item[0] = $_POST['npcandstoryitems_item'][$i];
				$item[1] = $_POST['npcandstoryitems_itemchance'][$i];

				$npcItems[$i] = implode('@',$item);
				++$i;
			}
			$_POST['items'] = implode(';',$npcItems);
		}
		else
		{
			$_POST['items'] = '';
		}
		
	}
	if($table == 'tournaments' || $table == 'wishes')
	{
		if(isset($_POST['amountitems_item']))
		{
			$items = array();
			$itemCount = count($_POST['amountitems_item']);
			$i = 0;
			while($i != $itemCount)
			{
				$item = array();

				$item[0] = $_POST['amountitems_item'][$i];
				$item[1] = $_POST['amountitems_amount'][$i];

				$items[$i] = implode('@',$item);
				++$i;
			}
			$_POST['items'] = implode(';',$items);
		}
		else
		{
			$_POST['items'] = '';
		}
		
	}
	
	if($table == 'attacks')
	{
		if(isset($_POST['race']))
		{
			$_POST['race'] = implode(', ',$_POST['race']);
		}
		else
		{
			$_POST['race'] = '';
		}
	}
	
		if(isset($_POST['wishes']))
		{
			$_POST['wishes'] = implode(';',$_POST['wishes']);
		}
		else
		{
			$_POST['wishes'] = '';
		}
	
	if($table == 'events')
	{
		$fights = array();
		if(isset($_POST['event_npcs']))
		{
			$fightCount = count($_POST['event_npcs']);
			$i = 0;
			while($i != $fightCount)
			{
				$fightArray = array();

				$fightArray[0] = implode(':',$_POST['event_npcs'][$i]);
				if(isset($_POST['event_fhealing'][$i]))
				{
					$fightArray[1]  = 1;
				}
				else
				{
					$fightArray[1]  = 0;
				}
				$fightArray[2] = $_POST['event_survivalteam'][$i];
				$fightArray[3] = $_POST['event_survivalrounds'][$i];
				$fightArray[4] = $_POST['event_survivalwinner'][$i];
				$fightArray[5] = $_POST['event_healthratio'][$i];
				$fightArray[6] = $_POST['event_healthratioteam'][$i];
				$fightArray[7] = $_POST['event_healthratiowinner'][$i];

				$fights[$i] = implode(';',$fightArray);
				++$i;
			}
			$_POST['fights'] = implode('@',$fights);

			$pat = array();

			$patID = 0;
			if(isset($_POST['pat_planet']))
			{
				$pat[$patID] = $_POST['pat_planet'];
			}
			else
			{
				$pat[$patID] = '';
			}

			$patID++;
			if(isset($_POST['pat_place']))
			{
				$pat[$patID] = $_POST['pat_place'];
			}
			else
			{
				$pat[$patID] = '';
			}

			$patID++;
			if(isset($_POST['pat_weekday']))
			{
				$pat[$patID] = implode(':',$_POST['pat_weekday']);
			}
			else
			{
				$pat[$patID] = '';
			}
			$patID++;

			$monthdays = array();
			$patID++;
			if(isset($_POST['pat_monthday1']))
			{
				$monthdays[0] = $_POST['pat_monthday1'];
			}
			else
			{
				$monthdays[0] = 1;
			}
			if(isset($_POST['pat_monthday2']))
			{
				$monthdays[1] = $_POST['pat_monthday2'];
			}
			else
			{
				$monthdays[1] = 31;
			}
			$pat[$patID] = implode('-',$monthdays);

			$months = array();
			$patID++;
			if(isset($_POST['pat_months1']))
			{
				$months[0] = $_POST['pat_months1'];
			}
			else
			{
				$months[0] = 1;
			}
			if(isset($_POST['pat_months2']))
			{
				$months[1] = $_POST['pat_months2'];
			}
			else
			{
				$months[1] = 12;
			}
			$pat[$patID] = implode('-',$months);

			$yeardays = array();
			$patID++;
			if(isset($_POST['pat_yeardays1']))
			{
				$yeardays[0] = $_POST['pat_yeardays1'];
			}
			else
			{
				$yeardays[0] = 1;
			}
			if(isset($_POST['pat_yeardays2']))
			{
				$yeardays[1] = $_POST['pat_yeardays2'];
			}
			else
			{
				$yeardays[1] = 365;
			}
			$pat[$patID] = implode('-',$yeardays);

			$years = array();
			$patID++;
			if(isset($_POST['pat_years1']))
			{
				$years[0] = $_POST['pat_years1'];
			}
			else
			{
				$years[0] = 1;
			}
			if(isset($_POST['pat_years2']))
			{
				$years[1] = $_POST['pat_years2'];
			}
			else
			{
				$years[1] = 3000;
			}
			$pat[$patID] = implode('-',$years);

			$_POST['placeandtime'] = implode(';', $pat);
		}
		else
		{
			$_POST['placeandtime'] = '';
		}
	}
	
  if(isset($_POST['items']) && $table=='places')
  {
    $_POST['items'] = implode(';', $_POST['items']);
  }
  else if(!isset($_POST['items']))
  {
    $_POST['items'] = '';
  }
  if(isset($_POST['attacks']))
  {
    $_POST['attacks'] = implode(';', $_POST['attacks']);
  }
  else
  {
    $_POST['attacks'] = '';
  }
  if(isset($_POST['needattacks']))
  {
    $_POST['needattacks'] = implode(';', $_POST['needattacks']);
  }
  else
  {
    $_POST['needattacks'] = '';
  }
  
  if(isset($_POST['actions']))
  {
    $_POST['actions'] = implode(';', $_POST['actions']);
  }
  else
  {
    $_POST['actions'] = '';
  }
  
  if(isset($_POST['npcs']))
  {
    $_POST['npcs'] = implode(';', $_POST['npcs']);
  }
  else
  {
    $_POST['npcs'] = '';
  }
  
  if(isset($_POST['supportnpcs']))
  {
    $_POST['supportnpcs'] = implode(';', $_POST['supportnpcs']);
  }
  else
  {
    $_POST['supportnpcs'] = '';
  }
  
  if(isset($_POST['trainers']))
  {
    $_POST['trainers'] = implode(';', $_POST['trainers']);
  }
  else
  {
    $_POST['trainers'] = '';
  }
  
  if(isset($_POST['fightattacks']))
  {
    $_POST['fightattacks'] = implode(';', $_POST['fightattacks']);
  }
  else
  {
    $_POST['fightattacks'] = '';
  }
  
  if(isset($_POST['learnableattacks']))
  {
    $_POST['learnableattacks'] = implode(';', $_POST['learnableattacks']);
  }
  else
  {
    $_POST['learnableattacks'] = '';
  }
  
  $update = '';
  $names = '';
  
  $row = array();
	$result = $database->Select('*',$table,'id = "'.$_POST['id'].'"',1);
	if ($result) 
	{
    $row = $result->fetch_assoc();
		$result->close();
	}
  
  $changedValues = '';
  foreach ($finfo as $val) 
  {
		$name = $val->name;
		
		switch($val->type)
		{
			case 1: //tinyint
				if(!isset($_POST[$name]))
				{
					$_POST[$name] = 0;
				}
				else
				{
					$_POST[$name] = 1;
				}
				break;
		}
    
    if($row[$name] != $_POST[$name])
    {
      $changedValues = $changedValues.$name.' editiert von '.$row[$name].' zu '.$_POST[$name].chr(10);
    }
    
		
		$updateValue = $database->EscapeString($_POST[$name]);
    if(!$create)
    {
      $updatestr = '`'.$name.'`="'.$updateValue.'"';
      if($update == '')
      {
        $update = $updatestr;
      }
      else
      {
        $update = $update.', '.$updatestr;
      }
    }
    else
    {
      if($names == '')
      {
        $names = $name;
      }
      else
      {
        $names = $names.', '.$name;
      }
      
      if($update == '')
      {
        $update = '"'.$updateValue.'"';
      }
      else
      {
        $update = $update.', "'.$updateValue.'"';
      }
    }
  }
  
  if($create)
  {   
  $result = $database->Insert($names, $update,$table);
  $newID = $database->GetLastID();
  $message = 'Neuer Eintrag '.$newID.' in '.$table.' wurde erstellt.';
  $log = $log.'Neuer Eintrag <b>'.$newID.'</b> in <b>'.$table.'</b> wurde erstellt.';
    
  //postToDiscord($message);
?>
<?php
  }
  else
  {
    $log = $log.'ID <b>'.$_POST['id'].'</b> ';
    if(isset($row['name'])) $log = $log.' (<b>'.$row['name'].'</b>) ';
    
    $log = $log.'in Tabelle <b>'.$table.'</b> wurde bearbeitet.<br/>';
    
    $message = 'ID '.$_POST['id'].' in Tabelle '.$table.' wurde bearbeitet.';
    
    $result = $database->Select('*', $table, 'id="'.$_POST['id'].'"');
    $row = $result->fetch_assoc();
    foreach ($finfo as $val) 
    {
      $name = $val->name;
      $type = $val->type;
      if($row[$name] != $_POST[$name])
      {
        $log = $log.' Setze Wert <b>'.$name.'</b> von <b>'.$row[$name].'</b> zu <b>'.$_POST[$name].'</b><br/>';
      }
    }
    
	  $database->Update($update,$table,'id = "'.$_POST['id'].'"',1);
  }
  AddToLog($database, $ip, $accs, $log);
}
?>