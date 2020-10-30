<?php
include_once $_SERVER['DOCUMENT_ROOT'].'../../main/www/classes/session.php';
include_once 'classes/header.php';

if(!isset($_GET['id']) || !is_numeric($_GET['id']))
  exit();

$pID = $_GET['id'];
if($pID < 0)
  exit();

$player = new Player($database, $pID);
if($player == null)
  exit();


function GetSlotImage($slot, $inventory)
{
  $item = $inventory->GetItemAtSlot($slot);
  if($item != null)
  {
    return 'img/ausruestung/'.$item->GetEquippedImage().'.png';
  }
  return null;
}

$raceUrl = 'img/races/'.$player->GetRaceImage().'.png';


$raceImg = imagecreatefrompng($raceUrl);
$src_x = imagesx($raceImg);
$src_y = imagesy($raceImg);

$newWidth = $src_x/2.5;
$newHeight = $src_y/2.5;

$dst = imagecreatetruecolor($newWidth, $newHeight);
$alpha = imagecolorallocatealpha($dst, 0, 0, 0, 127);
imagefill($dst,0,0,$alpha); 
imagealphablending($dst, true);
imagesavealpha($dst, true);

$inventory = $player->GetInventory();


$head = GetSlotImage(1, $inventory);
if($head != null)
{
  $img = imagecreatefrompng($head);
  imagecopyresized($dst, $img, 0, 0, 0, 0, $newWidth, $newHeight, $src_x, $src_y);
  imagedestroy($img); 
}

$back = GetSlotImage(8, $inventory);
if($back != null)
{
  $img = imagecreatefrompng($back);
  imagecopyresized($dst, $img, 0, 0, 0, 0, $newWidth, $newHeight, $src_x, $src_y);
  imagedestroy($img); 
}
$weapon = GetSlotImage(6, $inventory);
if($weapon != null)
{
  $img = imagecreatefrompng($weapon);
  imagecopyresized($dst, $img, 0, 0, 0, 0, $newWidth, $newHeight, $src_x, $src_y);
  imagedestroy($img); 
}


if($player->GetApeTail() == 3)
{
  $tail = 'img/races/saiyajintail.png';
  $img = imagecreatefrompng($tail);
  imagecopyresized($dst, $img, 0, 0, 0, 0, $newWidth, $newHeight, $src_x, $src_y);
  imagedestroy($img); 
}
imagecopyresized($dst, $raceImg, 0, 0, 0, 0, $newWidth, $newHeight, $src_x, $src_y);

$shoes = GetSlotImage(7, $inventory);
if($shoes != null)
{
  $img = imagecreatefrompng($shoes);
  imagecopyresized($dst, $img, 0, 0, 0, 0, $newWidth, $newHeight, $src_x, $src_y);
  imagedestroy($img); 
}
$pants = GetSlotImage(3, $inventory);
if($pants != null)
{
  $img = imagecreatefrompng($pants);
  imagecopyresized($dst, $img, 0, 0, 0, 0, $newWidth, $newHeight, $src_x, $src_y);
  imagedestroy($img); 
}
$travel = GetSlotImage(4, $inventory);
if($pants != null)
{
  $img = imagecreatefrompng($travel);
  imagecopyresized($dst, $img, 0, 0, 0, 0, $newWidth, $newHeight, $src_x, $src_y);
  imagedestroy($img); 
}
$body = GetSlotImage(5, $inventory);
if($body != null)
{
  $img = imagecreatefrompng($body);
  imagecopyresized($dst, $img, 0, 0, 0, 0, $newWidth, $newHeight, $src_x, $src_y);
  imagedestroy($img); 
}
$hands = GetSlotImage(2, $inventory);
if($hands != null)
{
  $img = imagecreatefrompng($hands);
  imagecopyresized($dst, $img, 0, 0, 0, 0, $newWidth, $newHeight, $src_x, $src_y);
  imagedestroy($img); 
}

header('Content-Type: image/png');
imagepng($dst);

imagedestroy($raceImg);
imagedestroy($dst); 
?>