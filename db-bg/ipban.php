<?PHP
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
$user_ip = getUserIP();
if(filter_var($user_ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) 
{
      echo "<font color='green'><b>Willkommen!</b></font> Auf DBBG Proxy/VPN Check Test!";
}
else 
{
$ip = file_get_contents("http://proxy.mind-media.com/block/proxycheck.php?ip=$user_ip");
if($ip == "Y")
{
  echo "<font color='red'><b>Proxy/VPN Gefunden!</b></font> Bitte Trenne alle Verbindungen zu deinem Proxy/VPN um unserer Website nutzen zu können";
}
else if($ip == "N")
{
  echo "<font color='green'><b>Willkommen!</b></font> Auf DBBG Proxy/VPN Check Test!";
}
}
?>