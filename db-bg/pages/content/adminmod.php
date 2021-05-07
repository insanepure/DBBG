<div class="spacer"></div>
<div  class="catGradient borderT borderB" style="width:90%;">
<h2>Moderation</h2>
</div>
<div class="spacer"></div>
<div class="spacer"></div>


<?php
if(isset($_GET['user']) && is_numeric($_GET['user']))
{
    $userid = 0;
    $username = '';
		$result = $database->Select('id, name, userid','accounts', 'id = '.$_GET['user'].'',1);
		if ($result) 
		{
		  if ($result->num_rows > 0)
			{
				$row = $result->fetch_assoc();
        $userid = $row['userid'];
        $username = $row['name'];
			}
			$result->close();
		}
  
    $banned = false;
    $banreason = '';
		$result = $accountDB->Select('id, banned, banreason','users', 'id = '.$userid.'',1);
		if ($result) 
		{
		  if ($result->num_rows > 0)
			{
				$row = $result->fetch_assoc();
        $banned = $row['banned'];
        $banreason = $row['banreason'];
			}
			$result->close();
		}
 
  ?>
    <h2><?php echo $username; ?></h2>
    <form method="POST" action="?p=adminmod&user=<?php echo $_GET['user']; ?>&a=edit">
      <input type="hidden" name="main" value="<?php echo $userid; ?>">
      <input type="checkbox" name="banned" <?php if($banned) echo 'checked'; ?>><br/>
      Grund: <textarea name="banreason" style="width:400px; height:100px;"><?php echo $banreason; ?></textarea><br/>
      <input type="submit" value="Moderieren">
    </form>
  <?php
}
else
{
  ?>
    <form method="GET" action="?p=adminmod">
      <input type="hidden" name="p" value="adminmod">
      <select class="select" name="user">
        <?php
        $users = new Generallist($database, 'accounts', 'name, id', '', '', 99999999);
        $id = 0;
        print_r($users);
        $entry = $users->GetEntry($id);
        while($entry != null)
        {
          
          ?><option value="<?php echo $entry['id']; ?>"><?php echo $entry['name'].' ['.$entry['id'].']'; ?></option><?php
          ++$id;
          $entry = $users->GetEntry($id);
        }
        ?>
      </select>
<div class="spacer"></div>
      <input type="submit" value="Moderieren">
</form>
  <?php
}
?>