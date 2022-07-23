<?php
$title = 'Passwort vergessen';
if(isset($_GET['a']) && $_GET['a'] == 'change')
{
  if(isset($_GET['id']) && isset($_GET['code']))
  {
		$id = $accountDB->EscapeString($_GET['id']);
		$result = $accountDB->Select('*','users','id = '.$id.'',1);
		if ($result) 
		{
      $row = $result->fetch_assoc();
      if($row['password'] == $_GET['code'])
      {
        if($safedPW == $safedPW2)
        {
		      $safedPW = $accountDB->EscapeString($safedPW);
		      $accountDB->Update('password="'.$safedPW.'"','users','id = '.$id.'',1);
          $message = 'Das Passwort wurde geändert.';
        }
        else
        {
          $message = 'Die Passwörter stimmen nicht überein!';
        }
      }
			$result->close();
		}
  }
}
else if(isset($_GET['a']) && $_GET['a'] == 'mail')
{
  if(isset($_POST['email']))
  {
		$email = $accountDB->EscapeString($_POST['email']);
		$result = $accountDB->Select('*','users','email = "'.$email.'"',1);
		if ($result && $result->num_rows > 0) 
		{
      $row = $result->fetch_assoc();
			$topic = 'Passwort ändern';
			$content ='
					Jemand hat eine Änderung des Passwortes für deinen Account <b>'.$row['login'].'</b> beantragt.<br/>
					Wenn du Passwort wirklich ändern willst, dann folge den folgenden Link.<br/>
					<br/>
					Wenn du das Passwort nicht ändern willst, ignoriere diese Mail.<br/>
					<br/>
					<br/>
					<br/>
					<a href="'.$serverUrl.'/?p=pwforgot&id='.$row['id'].'&code='.$row['password'].'">Ich möchte das Passwort ändern.</a>
					<br/>
					<br/>';
			SendMail($email, $topic, $content);
			$result->close();
		}
			$message = 'Es wurde eine Mail an deiner E-Mail Addresse gesendet. Schau auch im Spam Ordner nach.';
  }
}
?>