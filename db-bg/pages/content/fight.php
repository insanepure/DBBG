<?php
$select = "fights.*, GROUP_CONCAT(CONCAT(fighters.acc,';',fighters.name,';',fighters.team,';',fighters.isnpc) ORDER BY fighters.team SEPARATOR '@') as fighters";
$where = 'fights.id = fighters.fight';
$order = 'state, id, fighters.team';
$join = 'fighters';
$from = 'fights';
$group = 'fights.id';
$list = new Generallist($database, $from, $select, $where, $order, 9999999, 'ASC', $join, $group);
$currentFights = array();
$openFights = array();
$openID = 0;
$currentID = 0;

//preSort the arrays, so that we can easily show them
$id = 0;
$entry = $list->GetEntry($id);
while($entry != null)
{
  if($entry['challenge'] != 0 && $player->GetFight() == $entry['id'] ||
     $entry['event'] != 0 && $player->GetFight() == $entry['id'] ||
    $entry['challenge'] == 0 && $entry['state'] == 0 && $entry['event'] == 0 && 
     ($entry['type'] != 3 && $entry['type'] != 4 || ($entry['type'] == 3 || $entry['type'] == 4) && $entry['place'] == $player->GetPlace() && $entry['planet'] == $player->GetPlanet()))
  {
    $openFights[$openID] = $entry;
    $openID++;
  }
  else if($entry['state'] != 0)
  {
    $currentFights[$currentID] = $entry;
    $currentID++;
  } 
  $id++;
  $entry = $list->GetEntry($id);
}

//function to easily display one entry
function ShowEntry($entry, $player)
{
?>
<tr>
  <td width="15%" class="boxSchatten" align="center">
    <?php
    echo $entry['name'];
    ?>
  </td>
  <td width="15%" class="boxSchatten" align="center">
    <?php
    switch($entry['type'])
    {
      case 0:
        echo 'Spaß';
        break;
      case 1:
        echo 'Wertung';
        break;
      case 2:
        echo 'Tod';
        break;
      case 3:
        echo 'NPC';
        break;
      case 4:
        echo 'Story';
        break;
      case 5:
        echo 'Event';
        break;
      case 6:
        echo 'Turnier';
        break;
      case 7:
        echo 'Dragonball';
        break;
      case 8:
        echo 'Arena';
        break;
    }
    ?>
  </td>
  <td width="15%" class="boxSchatten" align="center">
    <?php
    echo $entry['mode'];
    ?>
  </td>
  <td width="40%" class="boxSchatten">
   <center>
   <?php
   $mode = explode('vs',$entry['mode']);
   $fightPlayers = explode('@', $entry['fighters']);
   $teamCount = count($mode);
  
   $i = 0;
   $currentTeam = 0;
   $teamPlayers = 0;
   while(isset($fightPlayers[$i]))
   {
      $playerData = explode(';', $fightPlayers[$i]);
     if($playerData[2] != $currentTeam)
     {
       ?> vs <?php
       $currentTeam = $playerData[2];
       $teamPlayers = 0;
     }
     if($teamPlayers != 0)
     {
       ?>, <?php
     }
     
     if($playerData[3])
     {
       echo $playerData[1];
     }
     else
     {
       
     ?>
     <a href="?p=profil&id=<?php echo $playerData[0]; ?>"><?php echo $playerData[1]; ?></a>
     <?php
       
     }
     ++$teamPlayers;
     ++$i;
   }
  
   ++$currentTeam;
   while($currentTeam < $teamCount)
   {
     ?> vs <?php
     ++$currentTeam;
   }
   ?>
     
   </center></td>
  <td width="15%" class="boxSchatten">
    <center>
    <?php 

    if($entry['state'] == 0) 
    { 
      if($player->GetFight() == $entry['id'])
      {
        ?> <a href="?p=fight&a=leave">Verlassen</a> <?php
      }
      else
      {
      ?> <a href="#" onclick="OpenPopupPage('Kampf Beitreten','fight/join.php','fight=<?php echo $entry['id']; ?>')">Beitreten</a> <?php 
      }
    } 
    else
    { 
      ?> <a href="?p=infight&fight=<?php echo $entry['id']; ?>">Zuschauen</a> <?php  
      if($player->GetARank() == 3) 
      { 
        ?><br/><?php
        for($i =0; $i < $teamCount; ++$i)
        {
          ?><br/><a href="?p=fight&a=adminjoin&team=<?php echo $i; ?>&fight=<?php echo $entry['id']; ?>">Team <?php echo $i+1; ?> Beitreten</a><?php
        }
      }
    } 

    ?>
    </center></td>
</tr>
<?php
}
?>
<div class="spacer"></div>
<table width="98%" cellspacing="0" border="0">
  <tr>
    <td colspan=6 height="20px">
    </td>
  </tr>
  <tr>
    <td colspan=6 class="catGradient borderT borderB">
      <b><center><font color="white"><div class="schatten">Kampf Option</div></font></center></b>
    </td>
  </tr>
    <tr>
      <td width="50%" class="boxSchatten"><center><a href="#" onclick="OpenPopupPage('Kampf Erstellen','fight/create.php')">Kampf Erstellen</a></center></td>
      <td width="50%" class="boxSchatten"><center><a href="?p=fights">Vergangene Kämpfe</a></center></td>
       
    </tr>
</table>
<div class="spacer"></div>


<table width="98%" cellspacing="0" border="0">
  <tr>
    <td colspan=6 height="20px">
    </td>
  </tr>
  <tr>
    <td colspan=6 class="catGradient borderT borderB">
      <b><center><div class="schatten">Offene Kämpfe</div></center></b>
    </td>
  </tr>
  <?php
  $id = 0;
  while(isset($openFights[$id]))
  {
    ShowEntry($openFights[$id], $player);
    ++$id;
  }
  ?>
</table>

<table width="98%" cellspacing="0" border="0">
  <tr>
    <td colspan=6 height="20px">
    </td>
  </tr>
  <tr>
    <td colspan=6 class="catGradient borderT borderB">
      <b><center><div class="schatten">Laufende Kämpfe</div></center></b>
    </td>
  </tr>
  <?php
  $id = 0;
  while(isset($currentFights[$id]))
  {
    ShowEntry($currentFights[$id], $player);
    ++$id;
  }
  ?>
</table>