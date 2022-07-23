<div class="spacer"></div>
<?php
//$regi wird in der head/register.php gesetzt
if ($account->IsLogged() && $userLoginActive)
{
  $cID = 0;
  $charas = new Generallist($database, 'accounts', 'userid, id', 'userid="'.$account->Get('id').'"', 'id', 999);
  $id = 0;
  $entry = $charas->GetEntry($id);
  ?>
  Du musst die <b><a href="https://db-bg.de/index.php?p=info&info=regeln">Regeln</a></b> zum Thema "<b>Mehrere Charaktere/Accounts</b>" beachten, wenn du mehrere Charaktere erstellst und spielst.<br/>
  Bei missachten der Regeln kann es zu einer Sperrung deines kompletten Accounts kommen.<br/>
  <div class="spacer"></div>
  <hr></hr>
  <b>Charaktere</b><br/><br/>
  <table>
   <tr>
  <?php
  $idx = 0;
  while($entry != null)
  {
    $displayedPlayer = new Player($database, $entry['id']); 
    
    if($idx == 3)
    {
      $idx = 0;
      ?></tr><tr><?php
    }
    ++$idx;
    
     $image = "img/imagefail.png";
     if($displayedPlayer->GetImage() != '')
      $image = $displayedPlayer->GetImage();
  ?>
  <td>
  <table width="200px" cellspacing="0" border="0">
    <tr>
    <td class="catGradient borderT borderB" align="center">
      <b><div class="schatten"><?php echo $displayedPlayer->GetName(); ?></div></b>
    </td>
  </tr>
    <tr>
    <td class="SideMenuInfo borderL borderR borderB" align="center">
      <img width="75px" height="75px" src="<?php echo $image; ?>"></img>
    </td>
   </tr>
					<?php if($displayedPlayer->GetAction() != 0)
          {
          $action = $actionManager->GetAction($displayedPlayer->GetAction());
          ?>
          <tr>
          <td class="SideMenuInfo borderL borderR borderB" align="center">
						<?php 
            if($action->GetType() == 5)
            {
			        $attackName = 'invalidAttack';
              $result = $database->Select('id, name','attacks','id = '.$displayedPlayer->GetLearningAttack().'',1);
              $attackID = 0;
              if ($result) 
              {
                $row = $result->fetch_assoc();
                $attackName = $row['name'];
                $result->close();
              }
              echo $attackName.' ';
            }
            echo $action->GetName();
            if($action->GetType() == 4)
            {
            echo '<br/>Ort: '.$displayedPlayer->GetTravelPlace();
            }
            ?>
						<br/>
						<div id="cID<?php echo $cID; ?>">Init
							<script>
								countdown(<?php echo $displayedPlayer->GetActionCountdown(); ?>, 'cID<?php echo $cID; ?>');
							</script>
						</div>
						<div class="spacer"></div>
          </td>
        </tr>
					<?php
          ++$cID;
        }
        ?>
    <tr>
      <td class="SideMenuInfo borderL borderR borderB" align="center">
        <form method="POST" action="?p=charalogin&id=<?php echo $entry['id']; ?>">
          <input type="checkbox" name="logged" value="Ja">Eingeloggt bleiben<br>
				  <input type="submit" value="Einloggen">
       </form>
      </td>
   </tr>
  </table></td>
  <?php
  ++$id;
  $entry = $charas->GetEntry($id);
  }
  ?>
  </tr></table>
  <div class="spacer"></div>
  <hr></hr>
  <b>Neuer Charakter</b><br/><br/>
  <form method="POST" action="?p=characreate">
    <input type="submit" value="erstellen">
  </form>
  <div class="spacer"></div>
<hr></hr>
  <b>Passwort ändern</b><br/><br/>
  <form name="form1" action="?p=charalogin&a=changepw" method="post" enctype="multipart/form-data">
  <table>
    <tr><td>Passwort:</td><td><input type="password" name="pw" style="width:250px"></td></tr>
    <tr><td>Wiederholen:</td><td><input type="password" name="pw2" style="width:250px"></td></tr>
    </table>
  <input type="submit" value="Passwort ändern">
  </form>
  <div class="spacer"></div>
<hr></hr>
  <b>Account löschen</b><br/><br/>
  <form method="POST" action="?p=charalogin&a=accdelete">
          <input type="checkbox" name="logged" value="Ja">Ja ich bin sicher<br>
    <input type="submit" value="löschen">
  </form>
  <?php
}
?>