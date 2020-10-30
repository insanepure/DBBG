<?php
function getUserIP()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}

if (isset($_GET['a']))
{
  $user_ip = getUserIP();
	$a = $_GET['a'];	
	if($a == 'login' && isset($_POST['name']) && isset($_POST['pw']))
	{
    if($userLoginActive)
    {
      $stayLogged = isset($_POST['staylogged']);
      $result = $account->Login($_POST['name'], $_POST['pw'], $stayLogged);  
      if (!$result)
      { 
        $message = 'Der Account oder das Passwort ist falsch.';
      }
      else
      {
	      header('Location: index.php');
      }
    }
    else
    {
      $message = 'Der Login ist zurzeit deaktiviert.';
    }
	}
	else if($a == 'charlogout')
	{
		$player->Logout();
	  header('Location: ?p=charalogin');
	  exit();  
	}
	else if($a == 'userlogout')
	{
		$account->Logout();
	  header('Location: index.php');
	  exit();  
	}
}

if ($account->IsLogged())
{
	header('Location: index.php');
	exit();  
}
?>