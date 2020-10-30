<?php 
$valid = false;
if(isset($_GET['id']) && isset($_GET['code']))
{
	$id = $accountDB->EscapeString($_GET['id']);
	$result = $accountDB->Select('*','users','id = "'.$id.'"',1);
	if ($result) 
	{
    $row = $result->fetch_assoc();
    if($row['password'] == $_GET['code'])
    {
      $valid = true;
    }
	}
}

if($valid)
{
  ?>
  <div class="spacer2"></div>
  Du musst nun dein neues Passwort im oberen Feld eingeben und im unteren Feld wiederholen.
  <form method="post" action="?p=pwforgot&a=change&id=<?php echo $_GET['id']; ?>&code=<?php echo $_GET['code']; ?>">
    <input type="password" name="pw1" placeholder="Passwort">
    <div class="spacer"></div>
    <input type="password" name="pw2" placeholder="Passwort wiederholen">
  <div class="spacer"></div>
    <div class="spacer"></div>
    <input type="submit" value="Passwort ändern">
  </form>
  <?php
}
else
{
  ?>
  <div class="spacer2"></div>
  Du kannst dir hier eine E-Mail senden, um dein Passwort zu ändern.
    <div class="spacer"></div>
  <form method="post" action="?p=pwforgot&a=mail">
    <input type="text" name="email" placeholder="E-Mail">
    <div class="spacer"></div>
    <input type="submit" value="Passwort vergessen">
  </form>
  <br/>
  <a href="?p=login">Zurück</a>
  <?php
}
?>
