<?php
include_once 'classes/bbcode/bbcode.php';
include_once 'classes/news/newsmanager.php';
$newsManager = new NewsManager($database, 5);

if(isset($_GET['a']) && $_GET['a'] == 'like' && isset($_GET['id']) && is_numeric($_GET['id']))
{
  $newsManager->Like($account->Get('id'), $_GET['id']);
}
else if(isset($_GET['a']) && $_GET['a'] == 'dislike' && isset($_GET['id']) && is_numeric($_GET['id']))
{
  $newsManager->DisLike($account->Get('id'), $_GET['id']);
}
else if(isset($_GET['a']) && $_GET['a'] == 'removelikes' && isset($_GET['id']) && is_numeric($_GET['id']))
{
  $newsManager->RemoveLikes($account->Get('id'), $_GET['id']);
}
else if(isset($_GET['a']) && $_GET['a'] == 'post')
{
  
  if(isset($_GET['id']) && is_numeric($_GET['id']) && isset($_POST['text']) && $_POST['text'] != '')
  {
    $hasBadWords = 0;
    $text = $database->EscapeString($_POST['text']);
    if($database->HasBadWords($text))
    {
      $message = 'Der Text enthält ungültige Wörter.';
    }
    else
    {
      $return = $newsManager->Post($player, $_GET['id'], $text);
      if($return == 0)
      {
        $message = 'Die News wurde nicht gefunden.';
      }
      else if($return == -1)
      {
        $message = 'Der Text darf nur aus Buchstaben und Zahlen bestehen.';
      }
      else
      {
        $message = 'Du hast ein Kommentar gepostet.';
      }
    }
  }
}
?>