<?php
include_once 'classes/bbcode/bbcode.php';
if(isset($_GET['p2']) && $_GET['p2'] == 'read')
{
  if(isset($_GET['id']) && is_numeric($_GET['id']))
  {
    $id = $_GET['id'];
    $PMManager->Read($id, $player->GetID());
  }
}
else if(isset($_GET['a']) && $_GET['a'] == 'action')
{
  $deleteIDs = array();
  if(isset($_GET['deleteID']))
  {
    array_push($deleteIDs, $_GET['deleteID']);
  }
  else
  {
    $deleteIDs = $_POST['deleteID'];
  }
  
  if(isset($_POST['action']))
  {
    if($_POST['action'] == 'delete')
    {
      $PMManager->Delete($deleteIDs, $player->GetID());
    }
    else if($_POST['action'] == 'read')
    {
      $PMManager->ReadAll($deleteIDs, $player->GetID());
    }
    else if($_POST['action'] == 'markread')
    {
      $PMManager->ReadAllOnly($deleteIDs, $player->GetID());
    }
    else if($_REQUEST['action'] == 'deleteall')
    {
      $PMManager->DeleteAll(true, $player->GetID());
    }
  }
}
else if(isset($_GET['a']) && $_GET['a'] == 'send')
{
  if(!isset($_POST['to']))
  {
    $message = 'Du hast keinen Namen angegeben!';
  }
  else if(!isset($_POST['text']) || $_POST['text'] == '')
  {
    $message = 'Du hast keinen Text angegeben!';
  }
  else if(!isset($_POST['topic']) || $_POST['topic'] == '')
  {
    $message = 'Du hast keinen Betreff angegeben!';
  }
  else
  {
    $tname = $database->EscapeString($_POST['to']);
    $text = $database->EscapeString($_POST['text']);
    $title = $database->EscapeString($_POST['topic']);
    
    if($database->HasBadWords($title))
    {
      $message = 'Der Betreff enth�lt ung�ltige W�rter.';
    }
    else if($database->HasBadWords($text))
    {
      $message = 'Der Text enth�lt ung�ltige W�rter.';
    }
    if($tname == '')
    {
      $message = 'Du hast keinen Namen angegeben.';
    }
    else if($text == '')
    {
      $message = 'Du hast keinen Text angegeben.';
    }
    else if($title == '')
    {
      $message = 'Du hast keinen Betreff angegeben.';
    }
    else
    {
      $id = $player->GetID();
      $image = $player->GetImage();
      $name = $player->GetName();
      if($PMManager->SendPM($id, $image, $name, $title, $text, $tname))
      {
        $message = 'PM wurde erfolgreich gesendet.';
      }
      else
      {
        $message = 'Der Spieler existiert nicht.';
      }
    }
  }
  
}

?>