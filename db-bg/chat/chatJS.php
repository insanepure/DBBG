<?php
if(!isset($_GET['a']))
{
  exit();
}

$messageSeperator = '{@BGMSG@}';
$singleSepperator = '{@BG@}';

$isChat = true;
include_once $_SERVER['DOCUMENT_ROOT'].'../../main/www/classes/session.php';
include_once $_SERVER['DOCUMENT_ROOT'].'../../main/www/classes/header.php';
include_once $_SERVER['DOCUMENT_ROOT'].'../../main/www/classes/chat/chat.php';

if($account->IsBanned())
{
  exit();
}

$chat = new Chat($accountDB, session_id());
if($_GET['a'] == 'report')
{
  echo $chat->Report($account->Get('login'));
}
if($_GET['a'] == 'sendMessage' && isset($_POST['message']))
{
  $message = $_POST['message'];
	$message = str_replace($messageSeperator, '', $message);
	$message = str_replace($singleSepperator, '', $message);
  if(!$accountDB->HasBadWords($message))
  {
    $chat->SendMessage($message);
  }
}
if($_GET['a'] == 'switchChannel' && isset($_POST['channel']))
{
  $channel = $_POST['channel'];
    $chat->SwitchChannel($channel);
}
else if($_GET['a'] == 'deleteMessage' && is_numeric($_POST['id']))
{
  $id = $_POST['id'];
  $chat->DeleteMessage($id);
}
else if($_GET['a'] == 'messages')
{
  $chat->ReloadMessages();
  $lasttime = $_POST['lasttime'];
  if(!isset($lasttime))
    $lasttime = 0;
  if(!$chat->ReloadMessages($lasttime))
  {
    exit();
  }
  $messages = $chat->GetMessages();
  for($i = 0; $i < count($messages); ++$i)
  {
    if($i != 0)
    {
      echo $singleSepperator;
    }
    $message = $messages[$i];
    
    echo $message->GetID();
    echo $messageSeperator;
    echo $message->GetType();
    echo $messageSeperator;
    echo $message->GetTime();
    echo $messageSeperator;
    if($message->GetType() == 2)
    {
      echo $message->GetText();
    }
    else
    {
      if($chat->IsAdmin())
      {
        ?>
		[<a onclick="DeleteMessage(<?php echo $message->GetID(); ?>)">X</a>]
		<?php
      }
      if($message->GetAcc() == -2)
      {
      ?> <b><font color="#00aa00">EVENT: <?php echo $message->GetText(); ?></font></b><br/> <?php
      }
      else if($message->GetAcc() == -1)
      {
      ?> <b><font color="#ff0000">SYSTEM: <?php echo $message->GetText(); ?></font></b><br/> <?php
      }
      else if($message->GetAcc() == -4)
      {
      ?> <b><font color="#0000FF">[HANDEL] <?php echo $message->GetName(); ?>: <?php echo $message->GetText(); ?></font></b><br/> <?php
      }
      else
      {
        $titel = $message->GetTitel();
        $titelcolor = $message->GetTitelColor();
        if($titelcolor != '')
        {
          $titel = '<font color="#'.$titelcolor.'">'.$titel.'</font>';
        }
        $time = date('H:i', strtotime($message->GetTime()));
        echo '['.$time.'] ';
        if($message->GetGame() != '')
        {
          echo '<b>['.$message->GetGame().']</b> ';
        }
        ?>
        <b>
        <?php if($message->GetAcc() > 0)
        {
          if($message->GetGame() == 'DBBG')
          {
            $url = 'https://db-bg.de?p=profil&id='.$message->GetAcc();
          }
          else
          {
            $url = 'https://n-bg.de/user.php?id='.$message->GetAcc();
          }
          ?><a target="_blank" href="<?php echo $url; ?>"><?php echo $titel.' '.$message->GetName(); ?></a></b>: <?php
        }
        else
        {
          echo $titel.' '.$message->GetName().'</b>:';
        }

        echo ' '.$message->GetText(); ?><br/>
        <?php
      }
    }
  }
}
else if($_GET['a'] == 'users')
{
  $chat->ReloadUsers();
  $users = $chat->GetUsers();
  $i = 0;
  while(isset($users[$i]))
  {
    $user = $users[$i];
    $titel = $user->GetTitel();
    $titelcolor = $user->GetTitelColor();
    if($titelcolor != '')
    {
      $titel = '<font color="#'.$titelcolor.'">'.$titel.'</font>';
    }
    if($user->GetGame() == 'DBBG')
    {
      $url = 'https://db-bg.de?p=profil&id='.$user->GetAcc();
    }
    else
    {
      $url = 'https://n-bg.de/user.php?id='.$user->GetAcc();
    }
    ?><a target="_blank" href="<?php echo $url; ?>"><?php echo '<b>['.$user->GetGame().']</b> '.$titel.' '.$user->GetName(); ?></a>
    <br/>
  <?php
    ++$i;
  }
}
?>