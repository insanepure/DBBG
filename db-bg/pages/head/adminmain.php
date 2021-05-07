<?php 
if(!isset($player) || !$player->IsValid() || $player->GetARank() < 2)
{
	header('Location: ?p=news');
	exit();  
}

$limitedTables = array('survey', 'survey_option');

if($player->GetARank() < 3 && isset($_GET['table']) && !in_array($_GET['table'], $limitedTables))
{
	header('Location: ?p=adminmain');
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
  $accountDB->Delete($table,'id='.$id.'');
  $message = 'Die ID '.$id.' wurde aus Tabelle '.$table.' gelöscht.';
  $log = $log.'Die ID <b>'.$id.'</b> wurde aus Tabelle <b>'.$table.'</b> gelöscht.<br/>';
  AddToLog($database, $ip, $accs, $log);
}
else if(isset($_GET['a']) && $_GET['a'] == 'edit')
{
  $table = $_GET['table'];
  $result = $accountDB->Select('*', $table, '');
  $finfo = $result->fetch_fields();
  
  
  
  $create = false;
  if(!isset($_POST['id']) || $_POST['id'] == '' || $_POST['id'] == 0)
  {
    $create = true;
  }
  
  $update = '';
  $names = '';
  
  $row = array();
	$result = $accountDB->Select('*',$table,'id = '.$_POST['id'].'',1);
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
    
		
		$updateValue = $accountDB->EscapeString($_POST[$name]);
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
  $result = $accountDB->Insert($names, $update,$table);
  $newID = $accountDB->GetLastID();
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
    
    $result = $accountDB->Select('*', $table, 'id='.$_POST['id'].'');
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
    
	  $accountDB->Update($update,$table,'id = '.$_POST['id'].'',1);
  }
  AddToLog($database, $ip, $accs, $log);
}
?>