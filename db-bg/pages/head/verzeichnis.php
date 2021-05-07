<?php
include_once 'classes/bbcode/bbcode.php';
include_once 'classes/verzeichnis/verzeichnis.php';

$verzeichnis = new Verzeichnis($database);

$entry = null;
if(isset($_GET['id']) && is_numeric($_GET['id']))
{
  $entry = $verzeichnis->LoadEntry($_GET['id']);
}
else if(isset($_GET['name']))
{
  $entry = $verzeichnis->LoadEntryName($_GET['name']);
}

?>