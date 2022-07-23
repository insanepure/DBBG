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

  <br />
  <hr>
  <br />

<form method="GET" action="?p=multicheck">
  <input type="hidden" name="p" value="multicheck">
  <input type="hidden" name="a" value="cookiecheck">
  <input type="submit" style="width:50%" value="Cookies Prüfen">
</form>
  <br />
  <hr>
  <br />
  <hr>
  <br />

<?php
if (isset($_GET['a']) && $_GET['a'] == 'cookiecheck')
{
  set_time_limit(600);
  $score = $_GET['score'];

  $log = $log . 'Multiüberprüfung durch Cookies.<br/>';
  AddToLog($database, $ip, $accs, $log);

  $result = LoginTracker::CheckCookies($accountDB, 'dbbg');
?>
  Users deren UserID nicht den selben Cookie hat:<br /><br />
<?php
  echo $result;
}
else if (isset($_GET['chara']))
{
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
}
?>