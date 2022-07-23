<?php
include_once $_SERVER['DOCUMENT_ROOT'].'../../main/www/classes/session.php';
include_once 'classes/header.php';
include_once 'pages/itemzorder.php';

if(!isset($_GET['id']) || !is_numeric($_GET['id']))
  exit();

$pID = $_GET['id'];
if($pID < 0)
  exit();

$player = new Player($database, $pID);
if($player == null)
  exit();

$debug = false;

function getSlotFromZOrder($zindex, $zorders, $zordersOnTop, &$onTop)
{
  $maxSlots = 13;
  for($i = 0; $i < $maxSlots; ++$i)
  {
    
    if(isset($zorders[$i]) && $zorders[$i] == $zindex)
    {
      $onTop = false;
      return $i;
    }
    else if(isset($zordersOnTop[$i]) && $zordersOnTop[$i] == $zindex)
    {
      $onTop = true;
      return $i;
    }
    
  }
  
  return -1;
}

function GetSlotImage($slot, $inventory)
{
  $item = $inventory->GetItemAtSlot($slot);
  if($item != null)
  {
    return 'img/characteritems/'.$item->GetEquippedImage();
  }
  return null;
}

$raceUrl = 'img/characters/'.$player->GetRaceImage().'.png';

if(!$debug)
{
  $raceImg = imagecreatefrompng($raceUrl);
  $src_x = imagesx($raceImg);
  $src_y = imagesy($raceImg);
  
  $newWidth = $src_x/2.5;
  $newHeight = $src_y/2.5;
  
  if(isset($_GET['ava']))
    $dst = imagecreatetruecolor(200, 200);
  else
    $dst = imagecreatetruecolor($newWidth, $newHeight);
  $alpha = imagecolorallocatealpha($dst, 0, 0, 0, 127);
  imagefill($dst,0,0,$alpha); 
  imagealphablending($dst, true);
  imagesavealpha($dst, true);
  
  if(isset($_GET['ava']))
  {
    $dstX = -80;
    $dstY = -25;
  }
}

$inventory = $player->GetInventory();


$onTop = false;
$maxVisuals = 15;
for($i = 0; $i < $maxVisuals; ++$i)
{
  $slot = getSlotFromZOrder($i, $zorders, $zordersOnTop, $onTop);
  if($slot == -1)
    continue;
  
  if($debug)
  {
    echo 'Visual: '.$i.'<br/>';
    echo ' - Slot: '.$slot.'<br/>';
  }
  
  if($slot == 0)
  {
    if(!$debug)
    {
        imagecopyresized($dst, $raceImg, $dstX, $dstY, 0, 0, $newWidth, $newHeight, $src_x, $src_y);
        $raceUrl2 = 'img/characters/'.$player->GetRaceImage().'Hair.png';
        $img = imagecreatefrompng($raceUrl2);
        imagecopyresized($dst, $img, $dstX, $dstY, 0, 0, $newWidth, $newHeight, imagesx($img), imagesy($img));
        imagedestroy($img); 
    }
    else
    {
      echo ' - Image: <img src="'.$raceUrl.'" width="100px" height="100px"></img><br/>';
    }
  }
  else
  {
    $itemImage = null;
    if($slot == 9 && $player->GetRace() == 'Saiyajin')
      $itemImage = 'img/characters/SaiyajinTail.png';
    else if($slot == 10&& $player->GetPlanet() == 'Jenseits')
      $itemImage = 'img/characteritems/heiligenschein.png';
    else
      $itemImage = GetSlotImage($slot, $inventory);
    if($itemImage != null)
    {
      if(!$debug)
      {
        $img = imagecreatefrompng($itemImage);
        imagecopyresized($dst, $img, $dstX, $dstY, 0, 0, $newWidth, $newHeight, imagesx($img), imagesy($img));
        imagedestroy($img); 
      }
      else
      {
        echo ' - Image: <img src="'.$itemImage.'" width="100px" height="100px"></img><br/>';
      }
    }
    else if($debug)
    {
      echo ' - Image: None<br/>';
    }
    
  }
}

if(!$debug)
{
  header('Content-Type: image/png');
  imagepng($dst);
  
  imagedestroy($raceImg);
  imagedestroy($dst); 
}
?>