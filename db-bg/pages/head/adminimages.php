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

$ip = $account->GetIP();
$accs = $player->GetName().' ('.$player->GetID().')';
$log = '';


if(isset($_GET['a']) && $_GET['a'] == 'delete')
{
  $path = 'img/'.$_GET['directory'].'/';
  $fileWithPath = $path.$_POST['file'];
if (!unlink($fileWithPath)) {  
  $message = 'Das Bild '.$_POST['file'].' in '.$path.' konnte nicht gelöscht werden.';
}  
else 
{  
  $message = 'Das Bild '.$_POST['file'].' in '.$path.' wurde gelöscht.';
  
  $log = 'Das Bild <b>'.$_POST['file'].'</b> in <b>'.$path.'</b> wurde gelöscht.';
  AddToLog($database, $ip, $accs, $log);
}  
  
}
else if(isset($_GET['a']) && $_GET['a'] == 'upload' && isset($_GET['directory']))
{
    if(isset($_FILES['file_upload']) && $_FILES['file_upload']['size'] != 0)
    {
      $path = 'img/'.$_GET['directory'].'/';
      $imgHandler = new ImageHandler($path);
      $result = $imgHandler->Upload($_FILES['file_upload'], $image, 2000, 2000, false);
      $imagename = $_FILES['file_upload']['name'];
      
      $message = 'Bild '.$imagename.' wurde erfolgreich hochgeladen.';
      switch($result)
      {
        case -1:
          $message = 'Die Datei ist zu groß.';
          break;
        case -2:
          $message = 'Die Datei ist ungültig.';
          break;
        case -3:
          $message = 'Es ist nur jpg, jpeg und png erlaubt.';
          break;
        case -4:
          $message = 'Der Name ist schon vergeben.';
          break;
        case -5:
          $message = 'Es gab ein Problem beim hochladen.';
          break;
      }
      if($result == 1)
      {
        $log = 'Bild <b>'.$imagename.'</b> wurde erfolgreich in <b>'.$path.'</b> hochgeladen.';
        AddToLog($database, $ip, $accs, $log);
      }
    }   
}

?>