
<?php 
if ($player->IsLogged())
{
if($player->GetArank() == 3 OR $player->GetTitel() == "[Writer]")
{
?>
<div class="spacer"></div>
<div  class="catGradient borderT borderB" style="width:100%;">
<h2>Story Image Upload</h2>
</div>
<div class="spacer"></div>
<?php
  function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
  if(isset($_POST['upload']))
    {
        $maxsize=2097152;
        $format=array('image/jpeg','image/png','image/jpg');
    if($_FILES['file_upload']['size']>=$maxsize)
    {
        $error_1='File Size too large';
        echo '<script>alert("'.$error_1.'")</script>';
    }
    elseif($_FILES['file_upload']['size']==0)
    {
        $error_2='Invalid File';
        echo '<script>alert("'.$error_2.'")</script>';
    }
    elseif(!in_array($_FILES['file_upload']['type'],$format))
    {
        $error_3='Format Not Supported.Only .jpeg files are accepted';
        echo '<script>alert("'.$error_3.'")</script>';
        }

        else
        {
           if (file_exists("storyimages/" . $_FILES["file_upload"]["name"]))
          {
          echo $_FILES["file_upload"]["name"]. " already exists. ";
          }
        else
          {
            $newfilename=basename($_FILES["file_upload"]["name"]);
            if(move_uploaded_file($_FILES["file_upload"]["tmp_name"], "storyimages/". $newfilename))
            { 
            list($width, $height, $type, $attr) = getimagesize('storyimages/'. $newfilename);
            echo "<td width='50%'><br><br><br><b>Vorschau Bild: 600x400</b><br><img style='width:600px;height:400px;' src='storyimages/". $newfilename. "'><br><a target='_blank' href='storyimages/". $newfilename. "'></a><br><b>BBCODE</b><br><b>[img width='600' height='400']storyimages/". $newfilename. "[/img]</b><br><br></td>";

            }
            else
            {
            echo "Fehler beim Hochladen des Bildes.";
            }
          }
          }
    }
?>
<center><form action="?p=storyupload" method="post" enctype="multipart/form-data">
<input type="file" name="file_upload" />
<input type="submit" name="upload"/>
</form></center>
<br>
<div class="spacer"></div>
<table width="100%" cellspacing="0" border="1">
  <tr>
    <td class="catGradient borderB borderT" colspan="6" align="center"><b>Story Images</b></td>
  </tr>
  <tr>
  <tr>
    <td width="20%"><center><b>Bild</b></center></td>
    <td width="80%"><center><b>BBCODE</b></center></td>
  </tr>
  <tr>
<?php
  $dirname = "storyimages/";
$dir = opendir($dirname);
while(false != ($file = readdir($dir)))
{
if(($file != ".") and ($file != "..") and ($file != "index.php"))
{
  $list[] = $file;
}
}

sort($list);

foreach($list as $item) 
{
?>
    <tr>
    <td style="min-width:20%; max-width:20%; width:20%;"><center>Story:<?php echo $item?><img src="storyimages/<?php echo $item;?>" style="width:100px;height:100px;"></center></td>
    <td style="min-width:80%; max-width:80%; width:80%;">[img width='500' height='300']storyimages/<?php echo $item;?>[/img]</td>
    </tr>
<?php
}
  ?>
  </tr>

</table>
<?php
}
}
?>
<div class="spacer"></div>
