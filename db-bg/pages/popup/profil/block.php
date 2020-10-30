<?php
include_once $_SERVER['DOCUMENT_ROOT'].'../../main/www/classes/session.php';
include_once '../../../classes/header.php';
if(!isset($_GET['id']) || !is_numeric($_GET['id']))
{
  exit();
}
if(!isset($_GET['userid']) || !is_numeric($_GET['userid']))
{
  exit();
}
if(!$player->IsLogged())
{
  echo 'Du bist nicht eingeloggt.';
  exit();
}

$otherPlayer = new Player($database, $_GET['id'], $actionManager);
if(!$otherPlayer->IsValid())
{
  exit();
}

if($_GET['userid'] == $player->GetUserID())
{
  echo 'Du kannst dich nicht selbst blockieren.';
  exit();
}

$blocked = $player->IsBlocked($_GET['id']);
?>

<?php
if($blocked)
{
  ?>Willst du <?php echo $otherPlayer->GetName(); ?> wirklich entblockieren?<br/><?php
}
else
{
  ?>Willst du <?php echo $otherPlayer->GetName(); ?> wirklich blockieren?<br/> Er wird dir dann mit keinen Charakter mehr schreiben können.<br/><?php
}
?>
<br/>

<form action="?p=profil&a=block&id=<?php echo $_GET['id']; ?>" method="post">
<?php
if($blocked)
{
  ?><input type="submit" value="Entblockieren"><?php
}
else
{
  ?><input type="submit" value="Blockieren"><?php
}
?>
</form>