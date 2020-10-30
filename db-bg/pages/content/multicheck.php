<h2>
  MultiCheck
</h2>
<form method="GET" action="?p=multicheck">
  <input type="hidden" name="p" value="multicheck">
  <input type="text" name="chara" placeholder="Charaktername">
  <div class="spacer"></div>
  <input type="score" name="score" placeholder="Mindestscore" value=50>
  <div class="spacer"></div>
<input type="submit" style="width:50%" value="Überprüfen">
</form>
<?php
if(isset($_GET['chara']))
{
  set_time_limit(600);
  $score = $_GET['score'];
  if(!is_numeric($score))
    $score = 50;
  
  $log = $log.'Multiüberprüfung von Character <b>'.$_GET['chara'].'</b>.<br/>';
  AddToLog($database, $ip, $accs, $log);
  
  $result = LoginTracker::CheckCharacter($accountDB, $_GET['chara'], 'dbbg', $score);
  
  
  
  ?>
  <br/>
  <hr>
  Alle Multis von <?php echo $_GET['chara']; ?>:<br/><br/>
  <?php
  echo $result;
}
?>