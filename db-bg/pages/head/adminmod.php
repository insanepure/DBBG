<?php


if(!isset($player) || !$player->IsValid() || $player->GetARank() < 2)
{
	header('Location: ?p=news');
	exit();  
}

function AddToLog($database, $ip, $accs, $log)
{
   $timestamp = date('Y-m-d H:i:s');
  $insert = '"'.$ip.'","'.$accs.'","'.$database->EscapeString($log).'","'.$timestamp.'"';
  $result = $database->Insert('ip,accounts,log,time', $insert,'adminlog');
}

if(isset($_GET['a']) && $_GET['a'] == 'edit' && isset($_POST['main']) && is_numeric($_POST['main']))
{
  $mainID = $_POST['main'];
  
  $preBanned = 0;
  $preReason = '';
  $preBannedGames = array();
	$result = $accountDB->Select('id, bannedgames, banreason','users', 'id = '.$mainID.'',1);
  $gameName = 'dbbg';
	if ($result) 
	{
	  if ($result->num_rows > 0)
		{
			$row = $result->fetch_assoc();
      if($row['bannedgames'] != '')
        $preBannedGames = explode(';',$row['bannedgames']);
      $preBanned = in_array($gameName, $preBannedGames);
      $preReason = $row['banreason'];
		}
		$result->close();
	}
  
  $banned = 0;
  if(isset($_POST['banned']))
    $banned = 1;
  $banreason = $accountDB->EscapeString($_POST['banreason']);
  
  if($preBanned)
  {
    $key = array_search($gameName, $preBannedGames);
    unset($preBannedGames[$key]);
    $preBannedGames = array_values($preBannedGames);
  }
  
  if($banned)
  {
    array_push($preBannedGames, $gameName);
    $preBannedGames = array_values($preBannedGames);
  }
  
  $preBannedGames = implode(';', $preBannedGames);
  
  
	$result = $accountDB->Update('bannedgames="'.$preBannedGames.'",banreason="'.$banreason.'"','users','id = '.$mainID.'',1);
  
  
  $ip = $account->GetIP();
  $accs = $player->GetName().' ('.$player->GetID().')';
  $log = '';
  
  if($preBanned != $banned)
  {
    $log = 'Der Ban vom MainAccount <b>'.$mainID.'</b> wurde von "<b>'.$preBanned.'</b>" zu "<b>'.$banned.'</b>" gesetzt.';
    AddToLog($database, $ip, $accs, $log);
  }
  if($preReason != $banreason)
  {
    $log = 'Der Bangrund vom MainAccount <b>'.$mainID.'</b> wurde von "<b>'.$preReason.'</b>" zu "<b>'.$banreason.'</b>" gesetzt.';
    AddToLog($database, $ip, $accs, $log);
  }
  $message = 'Du hast den Account '.$mainID.' moderiert.';
}
?>