<?php
if($story == null)
{
  'Story not valid.<br/>';
}
?>
<div class="newsspan"></div>
<div class="newscontainer smallBG borderR borderL borderT borderB">
  <div class="SideMenuKat catGradient borderB">
    <div class="schatten">
      <?php 
      if($player->GetARank() >= 2)
      {
        echo '('.$story->GetID().') ';
      }
      echo $story->GetTitel(); 
      ?>
    </div>
  </div>
  <div class="newscontent smallBG">
    <?php
      $playername = '[color=red]'.$player->GetName().'[/color]';
		  $text = str_replace('!player',$playername,$story->GetText());
      echo $bbcode->parse($text); 
    ?>
  </div>
  <div class="spacer"></div>
  <?php
    if($story->GetPlace() == $player->GetPlace() && $story->GetPlanet() == $player->GetPlanet())
    {
      if($story->GetType() == 1)
      {
      ?>
      <form method="POST" action="?p=story&a=continue">
        <input type="submit" value="Weiter">
      </form>
      <?php
      }
      else if($story->GetType() == 2)
      {
      ?>
      <form method="POST" action="?p=story&a=fight">
        <input type="submit" value="KAMPF">
      </form>
      <?php
      }
      else if($story->GetType() == 3)
      {
      ?>
      <form method="POST" action="?p=story&a=train">
        <input type="submit" value="Aktion starten">
      </form>
      <?php
      }
    }
    else if($story->GetPlanet() == $player->GetPlanet())
    {
    ?>
    Reise nach "<?php echo $story->GetPlace(); ?>".
    <?php
    }
    else
    {
    ?>
    Reise zum Planeten "<?php echo $story->GetPlanet(); ?>".
    <?php
    }
  ?>
  <div class="spacer"></div>
</div>
  <div class="spacer"></div>

<?php
if($player->GetARank() >= 2)
{
$select = "id, titel";
$where = '';
$order = 'id';
$from = 'story';
$list = new Generallist($database, $from, $select, $where, $order, 1000, 'DESC');
?>
<form method="POST" action="?p=story&a=jump">
<select class="select" name="storyid" id="storyid">
<?php
//preSort the arrays, so that we can easily show them
$id = 0;
$entry = $list->GetEntry($id);
while($entry != null)
{
?> 
  <option value="<?php echo $entry['id']; ?>"><?php echo '('.$entry['id'].') '.$entry['titel']; ?></option><?php
  ++$id;
  $entry = $list->GetEntry($id);
}  
?>
</select>
<input type="submit" value="Springen">  
</form>
<br/>
<?php
}
?>