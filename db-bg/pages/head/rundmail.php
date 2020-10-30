<?php
function postToDiscord($message)
{
    $data = array("content" => $message, "username" => "DBBG-Spion");
    $curl = curl_init("https://discordapp.com/api/webhooks/461532421746327553/Wy6xHsaj1Opjbza6lZfBInlaEW0l0y3mxW8L1IasxAygbuB-uG1CfXllfGpNcRqVAI_f");
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    return curl_exec($curl);
}
if(!isset($player) || !$player->IsValid() || $player->GetArank() < 1)
{
	header('Location: ?p=news');
	exit();  
}
if(isset($_GET['a']) && $_GET['a'] == 'send')
{
  $sender = $_POST['sender'];
  if($sender == 'System')
  {
	  $image = "img/system.png";
  }
  else
  {
	  $image = $player->GetImage();
  }
  $text = $_POST['text'];
  $title = $_POST['title'];
  $PMManager->SendPMToAll(0, $image, $sender, $title, $text);
  $message2 = '@everyone ```'.chr(10).'Autor:'.$sender.chr(10).'Titel:'.$title.chr(10).'Nachricht:'.chr(10).$text.'```';
  //postToDiscord($message2);
}
?>