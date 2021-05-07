<?php
if($player->GetArank() >= 2) 
{
  
$validDirectories = array('actions', 'attacks', 'ausruestung', 'events', 'items', 'npc', 'places', 'storyimages', 'planets', 'space', 'marketing', 'verzeichnis', 'gameevents'); 
?>
<div class="spacer"></div>
<div  class="catGradient borderT borderB" style="width:90%;">
<h2>Bilder Verwaltung</h2>
</div>
<div class="spacer"></div>

<?php
foreach ($validDirectories as &$directory) 
{
  if(isset($_GET['directory']) && $_GET['directory'] == $directory)
  {
  ?>- <b><a href="?p=adminimages&directory=<?php echo $directory; ?>"><?php echo ucwords($directory); ?></a></b> -<?php
  }
  else
  {
  ?>- <a href="?p=adminimages&directory=<?php echo $directory; ?>"><?php echo ucwords($directory); ?></a> -<?php
  }
}
?>
<div class="spacer"></div>
<hr>
<div class="spacer"></div>
<?php
if(isset($_GET['directory']) && in_array($_GET['directory'], $validDirectories))
{
?>

<form name="form1" action="?p=adminimages&directory=<?php echo $_GET['directory']; ?>&a=upload" method="post" enctype="multipart/form-data">   
<input type="file" name="file_upload" accept=".png"/><input type="hidden" name="image"/>
<br/>
<br/>
<input type="submit" value="Hochladen">
</form>

<div class="spacer"></div>
<hr>
<div class="spacer"></div>
<?php
  $path    = 'img/'.$_GET['directory'];
  $files = scandir($path);
  $files = array_diff(scandir($path), array('.', '..'));
  foreach ($files as &$file) 
  {
    ?>
    <div style="height:200px; width:200px; float:left; ">
      <img src="<?php echo $path.'/'.$file; ?>" width="100px" height="100px"></img><br/>
      <?php echo $file; ?> <br/>
      <form method="POST" action="?p=adminimages&directory=<?php echo $_GET['directory']; ?>&a=delete">
        <input type="hidden" value="<?php echo $file; ?>" name="file">
        <input type="submit" value="Löschen">
      </form>
    </div>
    <?php
  }
}
}
?>