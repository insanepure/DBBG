<script>
grecaptcha.ready(function() {
  grecaptcha.execute('6Lcd57wUAAAAAMqh2WE8_KEHveQ4Ycw1gRmbZQkI', {action: 'NPC'});
});
</script>
<div class="spacer"></div>
Tägliche NPC-Kämpfe: <?php echo $player->GetDailyNPCFights(); ?>/10
<div class="spacer"></div>
<table width="100%" cellspacing="0">
  <tr>
    <td class="catGradient borderB borderT" colspan="4" align="center"><b>NPC-Kampf</b></td>
  </tr>
  <tr>
    <td width="15%" class="boxSchatten"><center><b>Bild</b></center></td>
    <td width="50%" class="boxSchatten"><center><b>Beschreibung</b></center></td>
    <td width="30%" class="boxSchatten"><center><b>Gewinn</b></center></td>
    <td width="10%" class="boxSchatten"><center><b>Aktion</b></center></td>
  </tr>
<?php
$id = 0;
$npcList = new Generallist($database, 'npcs', '*', '', '', 9999, 'ASC');
$entry = $npcList->GetEntry($id);
$npcs = $place->GetNPCs();
while($entry != null)
{
  if(in_array($entry['id'], $npcs) && ($player->GetARank() >= 2 || $player->GetLevel() >= $entry['level']))
  {
  ?>
  <tr>
    <td class="boxSchatten"><center><b><?php if($player->GetArank() == 3){echo $entry['name'];} ?></b><img src="img/npc/<?php echo $entry['image']; ?>.png" style="width:100%;height:100%;"></center></td>
    <td class="boxSchatten"><center>
      <?php echo $bbcode->parse($entry['description']); ?><br/>
      <b><?php
      $typefight = 3; //NPC
      $titels = $titelManager->GetTitelsOfNPC($entry['id'], $typefight); 
      $hasTitel = count($titels) != 0;
      $lowestTitel = null;
      $i = 0;
      for($i = 0; $i < count($titels); ++$i)
      {
        $titel = $titels[$i];
        if(!$player->HasTitel($titel->GetID()))
        {
          if($lowestTitel == null || $lowestTitel->GetCondition() > $titel->GetCondition())
            $lowestTitel = $titel;
        }
      }
      
      if(!$hasTitel)
      {
        ?>Dieser NPC hat keine Titel<?php
      }
      else if($lowestTitel != null)
      {
        $titelProgress = $titelManager->LoadProgress($player->GetID(), $lowestTitel->GetID());
        $progress = 0;
        if(isset($titelProgress))
          $progress = $titelProgress['progress'];
        ?>Nächster Titel: <?php echo $progress.'/'.$lowestTitel->GetCondition(); 
      }
      else
      {
        ?>Du hast alle Titel<?php
      }
      ?>
      </b></center></td>
    <td class="boxSchatten">
      <center>
      <?php
      if($entry['zeni'] != 0)
      {
        echo $entry['zeni'].' Zeni<br/>';
      }
      if($entry['dragoncoins'] != 0)
      {
        echo $entry['dragoncoins'].' Dragoncoins<br/>';
      }
      if($entry['items'] != '')
      {
        $items = explode(';',$entry['items']);
        $i = 0;
        while(isset($items[$i]))
        {
          $item = explode('@',$items[$i]);
          $itemID = $item[0];
          $chance = $item[1];
          $itemData = $itemManager->GetItem($itemID);
          echo $itemData->GetName().' '.$chance.'%<br/>';
          ++$i;
        }
      }
      ?>
      </center>
    </td>
    <td class="boxSchatten">
      <center>
       <form method="POST" action="?p=npc&a=fight&id=<?php echo $entry['id']; ?>">
        <select class="select" name="type">
          <option value="0">Spaß</option>
          <option value="3" selected>NPC</option>
        </select> 
        <select class="select" name="difficulty">
          <option value="0">Alleine</option>
          <option value="1">2vs1</option>
          <option value="2">3vs1</option>
          <option value="3">4vs1</option>
        </select> 
        <button style="width:90px;">Starten</button>
      </form>
      </center>
    </td>
  </tr> 
<?php
  }
  ++$id;
$entry = $npcList->GetEntry($id);
}
?>
</table>