<?php 
if($player->GetArank() == 3 OR $player->GetArank() == 2 OR $player->GetArank() == 1)
{
}
else
{
	header('Location: ?p=news');  
}
if(isset($_GET['a']) && $_GET['a'] == 'delete')
{
	 $result = $database->Delete('meldungen','id = "'.$_GET['id'].'"',1);
	 $message= "Du hast Die Meldung Gelöscht!";
}
else if(isset($_GET['a']) && $_GET['a'] == 'edit')
{
	 $timestamp = date('Y-m-d H:i:s');
	 $result = $database->Update('status="In Bearbeitung",bearbeiter="'.$player->GetName().'",datum2="'.$timestamp.'"','meldungen','id = "'.$_GET['id'].'"',1);
	 $message= "Du Bearbeitest jetzt diese Meldung";
}
?>