<div class="newsspan"></div>  
<?php
include_once 'classes/bbcode/bbcode.php';
include_once 'classes/news/newsmanager.php';
$newsManager = new NewsManager($database, 5);

$newsCount = $newsManager->GetNewsCount();
for ($i = 0; $i < $newsCount; $i++) 
{
  $news = $newsManager->GetNews($i);
?>
<div class="newscontainer smallBG borderR borderL borderT borderB">
  <div class="newshead catGradient borderB">
    <div class="newsimage">
      <img src="<?php echo $news->GetAuthorImage(); ?>" width="40px" height="40px"></img>
    </div>
    <div class="newsauthortime">
      <a class="textColor" href="?p=profil&id=<?php echo $news->GetAuthorID(); ?>"><?php echo $news->GetAuthor(); ?></a><br/>
       <?php echo $news->GetDate(); ?>
    </div>
    <div class="newstitle"><h1 style="font-size: 94%; margin-top:3px; margin-right:150px; width: 350px; text-align: left;"><?php echo $news->GetTitle(); ?></h1></div>
  </div>
  <article>
  <div class="newscontent smallBG">
     <?php echo $bbcode->parse($news->GetText()); ?>
  </div>
  </article>
<table width="40%">
  <tr>
<?php
  echo '<td align="center">';
  $liked = $news->HasLiked($account->Get('id'));
if($liked)
  echo '<b>';
  
  $likeLink = $liked ? 'removelikes' : 'like';
  if($player->IsLogged())
  {
  ?>
  <a href="?p=news&a=<?php echo $likeLink; ?>&id=<?php echo $news->GetID(); ?>">
  <?php 
  }  
  echo $news->GetLikeCount(); ?> <img src="img/like.png?1"></img>
  <?php
  if($player->IsLogged())
  {
  ?>
  </a>
  <?php 
  }  
if($liked)
  echo '</b>';
  
  echo '</td><td align="center">';
  $disliked = $news->HasDisLiked($account->Get('id'));
if($disliked)
  echo '<b>';
  
  $dislikeLink = $disliked ? 'removelikes' : 'dislike';
  if($player->IsLogged())
  {
  ?>
  <a href="?p=news&a=<?php echo $dislikeLink; ?>&id=<?php echo $news->GetID(); ?>">
  <?php 
  }  
  echo $news->GetDisLikeCount(); ?> <img src="img/dislike.png?1"></img>
  <?php
  if($player->IsLogged())
  {
  ?>
  </a>
  <?php 
  }  
  
if($disliked)
  echo '</b>';
  
  echo '</td>';
?>
  </tr>
</table>
<hr>
   <details>
      <summary><b> <?php $commentCount = $news->GetCommentCount(); echo $commentCount; if($commentCount == 1) echo ' Kommentar'; else echo ' Kommentare'; ?></b></summary>  
  <?php 
  if($commentCount != 0)
  {
  ?>
     <table width="100%" cellspacing="0" border="0">
  <tr>
    <td class="catGradient borderB borderT" colspan="6" align="center"><b>User Antworten</b></td>
  </tr>  
       <?php
    {
      $comments = $news->GetComments();
      $j = 0;
      while(isset($comments[$j]))
       {
         $comment = explode(';',$comments[$j]);
         ?>
        <tr>
          <td width="25%"><center><b><a href="?p=profil&id=<?php echo $comment[1] ?>"><?php echo $comment[0]; ?></a>: </b></center></td>
        <td width="75%"><p style="
  overflow-wrap: break-word;
  word-wrap: break-word;
  -ms-word-break: break-all;
  word-break: break-all;
  word-break: break-word;
  -ms-hyphens: auto;
  -moz-hyphens: auto;
  -webkit-hyphens: auto;
  hyphens: auto;"><?php echo $comment[2] ?></p></td>
      </tr>
        <?php
         ++$j;
       }
    }
    ?>
  </table>
   <?php
  }
  ?>
     <?php
    if ($player->IsLogged())
{
?>
          <div class="spacer"></div>
     <form method="post" action="?p=news&a=post&id=<?php echo $news->GetID(); ?>">
<table width="100%" cellspacing="0" border="0">
  <tr>
    <td class="catGradient borderB borderT" colspan="6" align="center"><b>Kommentar Posten</b></td>
  </tr>
  <tr>
    <td width="100%"><div class="spacer"></div><center> <textarea class="textarea" name="text" maxlength="300000" style="resize: none; width:400px; height:100px;"></textarea> </center></td>
  </tr>
    <tr>
    <td width="100%"><center><input type="submit" value="Senden"><div class="spacer"></div></center></td>
  </tr>
  </table>
       
     </form>
     
     <fieldset>
        <legend><b>Kommentar Regeln:</b></legend>
       <table><tr><td>
<b><font color="0066FF">??1:</font></b></td><td> Dein Kommentar Soll sich nur auf den Aktuellen News Post beziehen.</td></tr><tr><td>
<b><font color="0066FF">??2:</font></b></td><td> Dein Kommentar darf keine Beleidigungen,Rassistischen oder Phonografischen Inhalte und/oder Texte enthalten.</td></tr><tr><td>
<b><font color="0066FF">??3:</font></b></td><td> Dein Kommentar darf kein duplicat eines anderen Kommentares sein.</td></tr><tr><td>
</td></tr>
       </table>
</fieldset>
     <?php
    }
  ?>
   </details>
  <div class="newsfooter"></div>
</div>
<div class="newsspanbig"></div>
<?php  
}
?>
