<?php

//Cron Style ist 
//  *      *         *       *        *
//  0,30  15         *       *        2        // jeden Dienstag um 15:00 und 15:30
// */5     *         *       *        *        // alle 5 Minuten
//Minute Stunde Tag (Monat) Monat Tag (Woche)
//
//
//a=ranking - */10 * * * * //Jede 10 Minuten
//a=logout - 0,30 * * * * //jede Stunde um 0 und 30
//a=update - 59 23 * * * //Jeden Tag um 23:59


include_once '/home/users/main/www/classes/session.php';
include_once '/home/users/main/www/classes/header.php';
error_reporting(0);

$db = 'DB';
$user = 'droot';
$pw = '';
$database = new Database($db, $user, $pw);

include_once 'classes/clan/clan.php';
include_once 'classes/titel/titelmanager.php';
include_once 'classes/generallist.php';
$database->Debug();

$page = $argv[1];

if($page == 'logout')
{
  echo 'Logging out users which were inactive for more than 60 minutes<br/>';
  $timeOut = 60;
  $where = 'session != "" AND TIMESTAMPDIFF(MINUTE, lastaction, NOW()) < '.$timeOut;
	//$database->Update('session=""','accounts',$where,999999999999);
}
else if($page == 'test')
{
  
  $titelManager = new titelManager($this->database);
  foreach($titelManager->GetTitels() as &$titel)
  {
    if($titel->GetType() != 5)
      continue;
    
    $where = '';
    $sort = $titel->GetSort();
    $type = $titel->GetFight();
    
    $where = 'type="'.$type.'" AND '.$sort.' != 0';
    $list = new Generallist($database, 'statslist', '*', $where, $sort, 1, 'DESC');
    $id = 0;
    $entry = $list->GetEntry($id);
    if($entry != null)
    {
      echo $row['name'].' '.$row['id'].' erhält '.$titel->GetName().'<br/>';
      $acc = $row['acc'];
    }
    
  }
}
else if($page == 'deleteaccs')
{
  echo 'Deleting Accounts<br/>';
  /*
	$result = $database->Select('*','accounts','lastaction < DATE_SUB(CURDATE(), INTERVAL 30 DAY)',99999);
	if ($result) 
	{
		if ($result->num_rows > 0)
		{
      while($row = $result->fetch_assoc()) 
      {
				$id = $row['id'];
				$database->Delete('market','`sellerid`="'.$id.'',9999999999);
				$database->Update('player="0"','dragonballs','player="'.$id.'"',999999999999);
				
				if($row['clan'] != 0)
				{
					$clan = new Clan($database, $row['clan']);
					if($clan->IsValid())
					{
						if($clan->GetLeader() == $row['id'])
						{
							if($clan->GetMembers() == 1)
							{
								$this->database->Delete('clans','id = "'.$clan->GetID().'"',1);
							}
							else
							{
								$clan->MakeRandomLeader();
								$clan->PlayerLeaves();
							}
						}
						else
						{
							$clan->PlayerLeaves();
						}
					}
				}
				$database->Delete('accounts','id = "'.$id.'"',1);
				
				
      }
		}
		$result->close();
	}
  */
	
}
else if($page == 'update')
{
	echo 'Doing Update<br/>';
	$database->Truncate('lastfights');
	$database->Copy('fights', 'lastfights');
	$database->Truncate('fights');
	$database->Truncate('fighters');
	$database->Truncate('chatmessages');
	$database->Truncate('registers');
	$database->Truncate('arenafighter');

	$database->Update('lp=mlp, kp=mkp, fight="0", dailyfights="0", dailynpcfights="0", challengefight="0", debuglog=""','accounts','',999999999999);
	$database->Update('apetail=apetail+1','accounts','apetail != 0 AND apetail != 3',999999999999);
	$database->Update('finishedplayers=""','events','dailyreset="1"',999999999999);

  $titelManager = new titelManager($database);
  foreach($titelManager->GetTitels() as &$titel)
  {
    if($titel->GetType() != 5)
      continue;
    
    $where = '';
    $sort = $titel->GetSort();
    
    switch($sort)
    {
      case 0:
        $sort = 'win';
        break;
      case 1:
        $sort = 'loose';
        break;
      case 2:
        $sort = 'draw';
        break;
      case 3:
        $sort = 'total';
        break;
      case 4:
        $sort = 'dailywin';
        break;
      case 5:
        $sort = 'dailyloose';
        break;
      case 6:
        $sort = 'dailydraw';
        break;
      case 7:
        $sort = 'dailytotal';
        break;
    }
    
    $type = $titel->GetFight();
    
    $where = 'type="'.$type.'" AND '.$sort.' != 0';
    $list = new Generallist($database, 'statslist', '*', $where, $sort, ($titel->GetCondition()-1).','.$titel->GetCondition(), 'DESC');
    $id = 0;
    $entry = $list->GetEntry($id);
    if($entry != null)
    {
      echo $entry['name'].' ('.$entry['acc'].') erhält mit '.$entry[$sort].': '.$titel->GetName().'<br/>';
      $result = $database->Select('*','accounts','id="'.$entry['acc'].'"',1);
      if ($result) 
      {
        if ($result->num_rows > 0)
        {
          $row = $result->fetch_assoc();
          if($row['titels'] == '')
            $titels = array();
          else
            $titels = explode(';',$row['titels']);
          if(in_array($titel->GetID(), $titels))
          {
            echo ' - hat aber den Titel schon....<br/>';
          }
          else
          {
            array_push($titels, $titel->GetID());
            $titels = implode(';',$titels);
	          $database->Update('titels="'.$titels.'"','accounts','id="'.$entry['acc'].'"',1);
            
            echo ' - erfolgreich hinzugefügt.<br/>';
          }
        }
        $result->close();
      } 
    }
    
  }
  
	$database->Update('dailywin="0", dailyloose="0", dailydraw="0", dailytotal="0"','statslist','',999999999999);
}
else if($page == 'ranking')
{
  echo 'Doing Ranking<br/>';
	
	$set = 'SET @counter = 0;';
	$order = 'arank ASC, inranking DESC, (((mlp / 10)+( mkp / 10) +attack+defense) / 4)';

	$result = $database->Update('rank= @counter := @counter + 1','accounts','',999999,$order,'DESC', $set);
	
  $result = $database->Select('*','clans','', 9999999);
	if ($result) 
	{
		if ($result->num_rows > 0)
		{
      while($row = $result->fetch_assoc()) 
      {
				$id = $row['id'];
				$members = $row['members'];
        echo $members;
				$result2 = $database->Select('((mlp/10)+(mkp/10)+attack+defense)/4 as total','accounts','clan="'.$id.'" AND arank = "0" AND banned = "0"', 9999999);
				$total = 0;
      	while($row2 = $result2->fetch_assoc()) 
				{	
					$total += $row2['total'];
				}
        if($members >= 3) {
          $total2 = round($total / $members) + $members;
        } else {
          $total2 = 0;
        }
				$result2->close();
				$database->Update('memberki="'.$total2.'"','clans','id="'.$id.'"',1);
			}
		}
		$result->close();
	}
	
	$set = 'SET @counter = 0;';
	$order = 'memberki';

	$result = $database->Update('rang= @counter := @counter + 1','clans','',999999,$order,'DESC', $set);
}
?>