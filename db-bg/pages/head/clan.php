<?php
include_once 'classes/clan/clan.php';
include_once 'classes/bbcode/bbcode.php';

$clan = null;
if(isset($_GET['id']) && is_numeric($_GET['id']))
{
  $clan = new Clan($database, $_GET['id']);
  if(!$clan->IsValid())
  {
    $clan = null;
  }
}

if($clan == null)
{
  header('Location: ?p=news');
  exit();
}
?>