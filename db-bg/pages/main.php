<?php
//pages you can access when you are not logged in
if (!$account->IsLogged() && isset($_GET['p']) 
		&& $_GET['p'] != '' 
		&& $_GET['p'] != 'login' 
		&& $_GET['p'] != 'pwforgot' 
		&& $_GET['p'] != 'regeln'  
		&& $_GET['p'] != 'info'
		&& $_GET['p'] != 'online'
		&& $_GET['p'] != 'register'
		&& $_GET['p'] != 'partner'
		&& $_GET['p'] != 'changelog'
	 )
{
	header('Location: ?p=login');
	exit();  
}
else if ($account->IsLogged() && !$player->IsLogged() && isset($_GET['p']) 
		&& $_GET['p'] != '' 
		&& $_GET['p'] != 'login' 
		&& $_GET['p'] != 'pwforgot' 
		&& $_GET['p'] != 'regeln'  
		&& $_GET['p'] != 'info'
		&& $_GET['p'] != 'register'
		&& $_GET['p'] != 'online'
		&& $_GET['p'] != 'characreate'
		&& $_GET['p'] != 'charalogin'
		&& $_GET['p'] != 'partner'
		&& $_GET['p'] != 'changelog'
	 )
{
	header('Location: ?p=login');
	exit();  
}
else if($account->IsValid() && $account->IsBanned())
{
  $message = 'Du wurdest aus folgendem Grund vom Spiel gebannt: '.$account->GetBanReason().'.';
  $account->Logout();
  if($player->IsValid())
    $player->Logout();
}
/*else if($player->IsLogged() && $player->GetClickCount() % 100 == 0 && isset($_GET['p']) && $_GET['p'] != 'captcha' && $_GET['p'] != 'login' && $_GET['p'] == 'infight' && $player->GetFight() != 0)
{
	$page = '?p=captcha';
	if(isset($_GET['p']))
	{
		$page = $page.'&page='.$_GET['p'];
	}
	header('Location: '.$page);
	exit();
}*/
else
{
	if(isset($_GET['a']) && $_GET['a'] == 'groupleave' && $player->GetGroup() != null)
	{
		$player->LeaveGroup();
		$message = 'Du hast deine Gruppe verlassen.';
	}
	else if(isset($_GET['a']) && $_GET['a'] == 'acceptitem')
	{
		$player->AcceptNPCWonItems();
	}
	else if(isset($_GET['a']) && $_GET['a'] == 'design' && isset($_POST['design']))
	{
		$design = $_POST['design'];
			
		if($design != 'default' && $design != 'dark' && $design != 'gruen' && $design != 'pink')
		{
			return;
		}
		
		$player->SetDesign($design);
	}
	else if(isset($_GET['a']) && $_GET['a'] == 'endAction' && $player->GetARank() >= 2)
	{
		if($player->GetFight() != 0)
		{
			$message = 'Du kannst in einem Kampf die Aktion nicht abbrechen.';
		}
		else if($player->GetAction() != 0)
		{
			$player->EndAction();
		}
	}
	else if(isset($_POST['a']) && $_POST['a'] == 'cancelAction')
	{
		if($player->GetFight() != 0)
		{
			$message = 'Du kannst in einem Kampf die Aktion nicht abbrechen.';
		}
		else if($player->GetAction() != 0)
		{
			$sparringID = 31;
			if($player->GetAction() == $sparringID) //Sparring
			{
				$otherPlayer = new Player($database, $player->GetSparringPartner(), $actionManager);
				if(!$otherPlayer->IsValid())
				{
					$player->CancelAction();
				}
				else
				{
					$otherPlayer->DoSparringCancelRequest();
					$message = 'Du hast eine Anfrage an '.$otherPlayer->GetName().' gesendet, damit ihr das Sparring abbricht.';
				}
			}
			else
			{
				$player->CancelAction();
			}
		}
	}
}
?>