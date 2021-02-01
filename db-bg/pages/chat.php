<?php
if(!$player->IsLogged())
{
  echo 'Du bist nicht eingeloggt!';
}
else
{
  $chat = new Chat($accountDB, session_id());
  $game = 'DBBG';
  $channel = $game;
  
  if(!isset($titelManager)) $titelManager = new TitelManager($database);
  
  
  $titel = $titelManager->GetTitel($player->GetTitel());
  $titelText = '';
  $titelColor = '';
  if($titel != null)
  {
    $titelText = $titel->GetName();
    $titelColor = $titel->GetColor();
  }
  
  if(!$player->IsAdminLogged())
    $chat->AddUser($player->GetID(), $player->GetUserID(), $game, $player->GetName(), $player->GetArank(), $channel, session_id(), $titelText, $titelColor);
  ?>
  <script type="text/javascript">
  function OnTextKeyDown()
  {
      if(event.keyCode != 13) 
        return;

     SendMessage();
  }
  </script>
  <div class="chat">
    <div class="chatfenster borderR">
      <div class="SideMenuKat catGradient borderR">
      <div class="schatten">Hinweis: Bugs und/oder Ideen etc Bitte im Forum oder Discord. Chat Clear um 00:00Uhr</div>
    </div>
      <div class="chattext" id="chat-text"></div>
      <div class="chatinput">
        <Button type="button" id="chatReportButton" onclick="Report()">Melden</Button>
        <Button type="button" id="chatMessageButton" onclick="ClearSave()">Clear</Button>
        <input type="text" id="chatChannel" style="width:100px; height:50%;" value="<?php echo $chat->GetChannel(); ?>" placeholder="Channel">
        <Button type="button" id="chatChannelButton" onclick="SwitchChannel()">Wechseln</Button>
        <input type="text" id="chatMessage" style="width:200px; height:50%;" placeholder="Nachricht" onkeydown="OnTextKeyDown()">
        <Button type="button" id="chatMessageButton" onclick="SendMessage()">Senden</Button>
      </div>
    </div>  

    <div class="chatuser">
       <div class="SideMenuKat catGradient">
      <div class="schatten">User Online</div>
    </div><br>
      <div class="chatusers" id="chat-users"></div>

    </div>
  </div>
<?php
}
?>
