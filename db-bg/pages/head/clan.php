<?php
include_once 'classes/bbcode/bbcode.php';

$displayClan = null;
if(isset($_GET['id']) && is_numeric($_GET['id']))
{
  $displayClan = new Clan($database, $_GET['id']);
  if(!$displayClan->IsValid())
  {
    $displayClan = null;
  }
}

if($displayClan == null)
{
  header('Location: ?p=news');
  exit();
}
?>