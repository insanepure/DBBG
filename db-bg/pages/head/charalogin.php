<?php
if (isset($_GET['id']) && is_numeric($_GET['id']) && $userLoginActive && !$player->IsLogged())
{
 $loginPlayer = new Player($database, $_GET['id']); 
 if($loginPlayer->GetUserID() == $account->Get('id'))
 {
   $stayLogged = isset($_POST['logged']);
   $loginPlayer->Login($stayLogged);
   header('Location: index.php');
   exit();  
 }
}
else if(isset($_GET['a']) && $_GET['a'] == 'accdelete')
{      
  if($account->HasAnyCharacter())
  {
    $message = 'Du musst zuerst alle Charaktere in DB-BG und N-BG löschen.';
  }
  else if(!isset($_GET['code']) && isset($_POST['logged']))
  {
    $message = 'Es wurde eine Mail an deine E-Mail geschickt. Schau auch im Spam Ordner nach.';
    $email = $account->Get('email'); 
    $topic = 'Account löschen';
    $content ='
        Jemand möchte deinen Account <b>'.$account->Get('login').'</b> löschen.<br/>
        Wenn du deinen Account wirklich löschen willst, dann folge den folgenden Link.<br/>
        <br/>
        Wenn du den Account nicht löschen willst, ignoriere diese Mail.<br/>
        <br/>
        <br/>
        <br/>
        <a href="'.$serverUrl.'/?p=charalogin&a=accdelete&code='.md5($account->Get('password')).'">Ich möchte den Account löschen.</a>
        <br/>
        <br/>';
			SendMail($email, $topic, $content);
  }
  else if($_GET['code'] == md5($account->Get('password')))
  {
    $account->DeleteAccount();
    $message = 'Dein Account wurde gelöscht.';
    header('Location: index.php');
    exit();  
  }
}
else if(isset($_GET['a']) && $_GET['a'] == 'changepw')
{        
  if($safedPW == $safedPW2)
  {
    $account->ChangePasswordSafe($safedPW);
    $message = 'Du hast dein Passwort geändert.';
  }
  else
  {
    $message = "Die Passwörter stimmen nicht überein.";
  }
}

if ($player->IsLogged())
{
	header('Location: index.php');
	exit();  
}