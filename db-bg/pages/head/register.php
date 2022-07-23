<?php
$title = 'Registrierung';
if (isset($_GET['a']) && $userRegisterActive)
{
	$a = $_GET['a'];
	if($a == 'registrieren')
	{
		if(isset($_GET['id']) && isset($_GET['code']))
		{
			$result = $account->Activate($_GET['id'], $_GET['code']);
      if($result)
      {
        $message = 'Die Registrierung ist abgeschlossen. Du kannst dich nun einloggen.';
        header("refresh: 2; url=index.php");
      }
      else
      {
        $message = 'Der Code oder die ID ist ungültig.';
      }
		}
		else
		{
			$acc = $_POST['acc'];
			$email = $_POST['email'];
			$email2 = $_POST['email2'];
      $valid = true;
      
      //Do all validation checks
    	if(!isset($_POST['regeln']))
			{
				$message = 'Du hast die Regeln nicht akzeptiert!';
        $valid = false;
			}
			else if($safedPW != $safedPW2)
			{
			  $message = 'Die Passwörter stimmen nicht überein.';
        $valid = false;
			}
			else if($email != $email2)
			{
				$message = 'Die E-Mails stimmen nicht überein.';
        $valid = false;
			}
			else
			{
        $resultID = $account->RegisterSafe($acc, $safedPW, $email);
        if($resultID > 0)
        {
          $code = $account->GetCode($acc, $email);
          $topic = 'Registrierung';
          $content ='
              Du hast dich bei dem <a href="'.$serverUrl.'">Dragonball Browsergame</a> mit den Account <b>'.$acc.'</b> registriert.<br/>
              Um die Registrierung abzuschließen, musst du den folgenden Link klicken.<br/>
              Wenn du den Link nicht bis zum nächsten Tag öffnest, ist der Account verschwunden und du musst dich erneut registrieren.<br/>
              <br/>
              <a href="'.$serverUrl.'/?p=register&a=registrieren&code='.$code.'&id='.$resultID.'">Account aktivieren.</a>
              <br/>
              <br/>';

          SendMail($email, $topic, $content);
          $message = 'Es wurde eine Mail an deiner E-Mail Addresse gesendet. Schau auch im Spam Ordner nach.';
        }
        else if($resultID == -1)
        {
          $message = 'Dein Accountname ist ungültig.';
        }
        else if($resultID == -2)
        {
          $message = 'Deine E-Mail ist ungültig.';
        }
        else if($resultID == -3)
        {
          $message = 'Dieser Accountname existiert bereits.';
        }
        else if($resultID == -4)
        {
          $message = 'Dieser E-Mail existiert bereits.';
        }
      }
		} // id&&code == empty
  } // a == register
}
?>