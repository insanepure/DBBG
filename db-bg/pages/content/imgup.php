<div class="spacer"></div>
<table width="100%" cellspacing="0" border="0">
  <tr>
    <td class="catGradient borderB borderT" colspan="6" align="center"><b>Image Uploader Only DBBG</b></td>
  </tr>
  <tr>
  <tr>
    <td width="50%"><center><b>Datei</b></center></td>
    <td width="50%"><center><b>Action</b></center></td>
  </tr>
  <tr>
    <td width="50%"><center><form action="?p=imgup" method="post" enctype="multipart/form-data"><input type="file" name="file_upload" /></center></td>
    <td width="50%"><center><input type="submit" name="upload"/></form></center></td>
  </tr>
</table>
<?php
if($image != '')
{         
?>
<td width='50%'><br><br><br><b>Vorschau Bild: 600x400</b><br><img style='width:600px;height:400px;' src='<?php echo $image; ?>'><br><a target='_blank' href='<?php echo $image; ?>'></a><br><b>BBCODE</b><br><b>[img width='600' height='400']<?php echo $image; ?>[/img]</b><br><br></td> 
<td width='50%'><br><b>Vorschau Bild: 600x200</b><br><img style='width:600px;height:200px;' src='<?php echo $image; ?>'><br><a target='_blank' href='<?php echo $image; ?>'></a><br><b>BBCODE</b><br><b>[img width='600' height='200']<?php echo $image; ?>[/img]</b><br><br></td>
<td width='50%'><br><b>Vorschau Bild: 400x200</b><br><img style='width:400px;height:200px;' src='<?php echo $image; ?>'><br><a target='_blank' href='<?php echo $image; ?>'></a><br><b>BBCODE</b><br><b>[img width='400' height='200']<?php echo $image; ?>[/img]</b><br><br></td>
<td width='50%'><br><b>Vorschau Bild: 200x200</b><br><img style='width:200px;height:200px;' src='<?php echo $image; ?>'><br><a target='_blank' href='<?php echo $image; ?>'></a><br><b>BBCODE</b><br><b>[img width='200' height='200']<?php echo $image; ?>[/img]</b><br><br></td>
<?php       
}
?>