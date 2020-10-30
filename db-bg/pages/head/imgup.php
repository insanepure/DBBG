<?php

$image = '';
if(isset($_POST['upload']))
{
  $imgHandler = new ImageHandler('userdata/userbilder/');
  $result = $imgHandler->Upload($_FILES['file_upload'], $image);
  switch($result)
  {
    case -1:
      $message = 'Die Datei ist zu groß.';
      break;
    case -2:
      $message = 'Die Datei ist ungültig.';
      break;
    case -3:
      $message = 'Es ist nur jpg, jpeg und png erlaubt.';
      break;
    case -4:
      $message = 'Es gab ein Problem beim generieren des Namens.';
      break;
    case -5:
      $message = 'Es gab ein Problem beim hochladen.';
      break;
  }
}
?>