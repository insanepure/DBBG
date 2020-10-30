<?php
if($player->GetArank() >= 2) 
{
?>
<div class="spacer"></div>
<div  class="catGradient borderT borderB" style="width:90%;">
<h2>Admin Log</h2>
</div>
<table width="90%" border="1">
  <tr>
  <td>ID</td>
  <td>Zeit</td>
  <td>Accounts</td>
  <td>Log</td>
  </tr>
<?php
$start = 0;
if(isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] >= 0)
{
  $start = 30 * $_GET['page'];
}
$limit = 30;
$result = $database->Select('*', 'adminlog', '', $start.','.$limit, 'id', 'DESC');
if ($result) 
{
	if ($result->num_rows > 0)
	{
     while($row = $result->fetch_assoc()) 
     {
       ?>
       <tr>
       <td><?php echo $row['id']; ?></td>
       <td><?php echo $row['time']; ?></td>
       <td><?php echo $row['accounts']; ?></td>
       <td><?php echo $row['log']; ?></td>
       </tr>
      <?php
     }
	}
	$result->close();
}

?>  
  
  
  
</table>
<?php
  $result = $database->Select('COUNT(id) as total','adminlog','');
  $total = 0;
  if ($result) 
  {
    $row = $result->fetch_assoc();
    $total = $row['total'];
    $result->close();
  }
  $pages = ceil($total / $limit);
  if($pages != 1)
  {
    ?>
    <div class="spacer"></div>
    <?php
    $i = 0;
    while($i != $pages)
    {
      ?>
      <a href="?p=adminlog&page=<?php echo $i; ?>">Seite <?php echo $i+1; ?></a> 
      <?php
      ++$i;
    }
  }
  ?>
    <div class="spacer"></div>
  <?php
  
}
?>