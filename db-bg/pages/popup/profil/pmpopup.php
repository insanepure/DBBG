<?php
$name = null;
if(isset($_GET['name']))
{
  $name = $_GET['name'];
}

if($name == null)
{
?>
Diese Aktion ist ungültig.
<?php
}
else
{
?>
<br/>
<form method="POST" action="?p=pm&a=send">
<input type="hidden" name="to" value="<?php echo $_GET['name']; ?>">
<table width="100%" cellspacing="0" border="0">
  <tr>
    <td><center><input style="width:90%;" type="text" name="topic" placeholder="Betreff"></center></td>
  </tr>
  <tr>
    <td><center><textarea name="text"></textarea></center></td>
  </tr>
  <tr>
    <td><center><input type="submit" value="senden" style="width:150px;"></center></td>
  </tr>
</table>
</form>
<br/>
<?php
}
?>