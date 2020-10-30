<?php
if(!isset($player) || !$player->IsValid() || $player->GetARank() < 3)
{
	header('Location: ?p=news');
	exit();  
}

$ip = $account->GetIP();
$accs = $player->GetName().' ('.$player->GetID().')';
$log = '';

function AddToLog($database, $ip, $accs, $log)
{
   $timestamp = date('Y-m-d H:i:s');
  $insert = '"'.$ip.'","'.$accs.'","'.$database->EscapeString($log).'","'.$timestamp.'"';
  $result = $database->Insert('ip,accounts,log,time', $insert,'adminlog');
}
?>