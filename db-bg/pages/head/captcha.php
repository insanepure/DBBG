<?php

if(isset($_GET['a']) && $_GET['a'] == 'validate')
{
  // your secret key
  $secret = "6LfWD04UAAAAAF7cPHPlQnGRo42N2R-7MIpu1Av1";
  // empty response
  $response = null;
  // check secret key
  $reCaptcha = new ReCaptcha($secret);// if submitted check response
  if ($_POST["g-recaptcha-response"]) 
  {
      $response = $reCaptcha->verifyResponse($_SERVER["REMOTE_ADDR"],$_POST["g-recaptcha-response"]);
    if ($response != null && $response->success) 
    {
      $player->UpdateCaptcha();
			$page = '?p=news';
			if(isset($_GET['page']))
			{
				$page = '?p='.$_GET['page'];
			}
	    header('Location: '.$page);
    } 
  }
  else
  {
    $message = 'Du musst die Validierung ausführen.';
  }
  
}

?>