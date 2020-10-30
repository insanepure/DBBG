<?php
include_once $_SERVER['DOCUMENT_ROOT'].'../../main/www/classes/session.php';
include_once '../../../classes/header.php';
$fight = null;
if(isset($_GET['fight']))
{
  $fight = new Fight($database, $_GET['fight'], $player, $actionManager);
}

if($fight == null || !$fight->IsValid())
{
?>Dieser Kampf ist ungültig!<?php
}
else
{
  
?>
<table width="100%" cellspacing="0" border="0">
  <tr>
    <td width="10%" class="boxSchatten" align="center"><b>Anzahl</b></td>
    <td width="50%" class="boxSchatten" align="center"><b>Team</b></td>
    <td width="40%" class="boxSchatten" align="center"><b>Aktion</b></td>
  </tr>
  <?php
  $fightTeams = $fight->GetTeams();
  $mode = $fight->GetMode();
  $i = 0;
  while($i < count($mode))
  {
    $members = 0;
    ?>
    <tr>
    <td align="center" class="boxSchatten" height="30px"><?php echo $mode[$i]; ?></td>
    <td align="center" class="boxSchatten" height="30px">
    <?php
    if(isset($fightTeams[$i]))
    {
      $fightPlayers = $fightTeams[$i];
      $j = 0;
      while(isset($fightPlayers[$j]))
      {
        if($j != 0)
        {
          ?>, <?php
        }
        $fightPlayer = $fightPlayers[$j];
        ++$members;
        ?>
        <a href="?p=profil&id=<?php echo $fightPlayer->GetAcc(); ?>"><?php echo $fightPlayer->GetName(); ?></a>
        <?php
        ++$j;
      }
    }
    ?>
    </td>
    <td align="center" class="boxSchatten" height="30px">
    <?php
    if($members != $mode[$i])
    {
    ?>
      <form action="?p=fight&fight=<?php echo $_GET['fight']; ?>&a=join" method="post">
      <input type="hidden" name="team" value="<?php echo $i;?>" />
      <input type="submit" value="Beitreten">
      </form>
      <?php
    }
    else
    {
      ?>Voll<?php
    }
    ?>
    </td>
    </tr>
    <?php
    ++$i;
  }
  ?>
</table>
<?php
}
?>