<div class="spacer"></div>
<div  class="catGradient borderT borderB" style="width:90%;">
<h2>Item Sets</h2>
</div>
<div class="spacer"></div>

<?php 

$update = isset($_POST['update']) && isset($_POST['check']) && $_POST['update'] == 1;  
if(!$update)
{
?>
Wenn du updatest, dann werden alle user die unter "Equipped" stehen komplett ausgezogen.<br/><br/>
<form method="POST" action="?p=adminitemsets">
  <input type="checkbox" name="check"?> Sicher?<br/>
  <input type="hidden" name="update" value="1">
  <input type="submit" value="Updaten">
</form>
<?php
}
else
{
  ?>
  Du hast alle Items und User geupdated.<br/>
  Um die Änderung zu sehen, musst du die Seite aktualisieren.<br/>
  <br/>
  <a href="?p=adminitemsets">Aktualisieren</a><br/>
  <?php
}
?>
<div class="spacer"></div>
<table cellspacing="0">
<?php
  
function getValue(&$sets, $itemID)
{
  foreach($sets as &$set)
  {
    foreach($set as &$item)
    {
      if($item[0] == $itemID)
        return $item[1];
    }
  }
  
  return 0;
}
  
function updateItem(&$sets, $database, $itemid, $value, $updateEquippedPlayers)
{
  $result = $database->Select('*','items', 'id = '.$itemid.'',1);
  if ($result) 
  {
    if ($result->num_rows > 0)
    {
      $row = $result->fetch_assoc();
      
      $type = $row['type'];
      $preValue = $row['value'];
      if($type == 1)
        $preValue = $row['lp'] + $row['kp'];
      
      if($type == 3)
        $price = $value * 200;
      else if($type == 4)
        $price = $value * 500;
      else
        $price = $value * 5;
      
      if($value == 0)
        $price = $row['price'];
      
      if($row['price'] == 0)
        $price = 0;
      
      $arenaPoints = 100 + $value + ($row['lv']*10);
      if($type != 3 || $row['race'] != '' || $value == 0 || $row['arenapoints'] == 0)
        $arenaPoints = 0;
      
      echo '<tr>';
      
      echo '<td>';
      echo $row['id'];
      echo '</td>';
      
      echo '<td>';
      echo $row['name'];
      echo '</td>';
      
      echo '<td>';
      echo $row['slot'];
      echo '</td>';
      
      echo '<td>';
      echo $row['lv'];
      echo '</td>';
      
      echo '<td>';
      $diff = $value-$preValue;
      echo $value;
      if($diff > 0)
        echo ' <font color="green">(+'.$diff.')</font>';
      else if($diff < 0)
        echo ' <font color="red">('.$diff.')</font>';
      else
        echo '';
      echo '</td>';
      
      echo '<td>';
      echo $preValue;
      echo '</td>';
      
      echo '<td>';
      echo $row['price'];
      echo '</td>';
      
      echo '<td>';
      echo $price;
      echo '</td>';
      
      echo '<td>';
      echo $row['arenapoints'];
      echo '</td>';
      
      echo '<td>';
      echo $arenaPoints;
      echo '</td>';
      
      echo '</tr>';
      
      
      
      $result2 = $database->Update('value="'.$value.'",price="'.$price.'",arenapoints="'.$arenaPoints.'"','items','id = '.$row['id'].'',1);
      
      if($preValue != $value && $updateEquippedPlayers)
      {
        $where2 = 'statsid='.$row['id'].' AND equipped=1';
        $list2 = new Generallist($database, 'inventory', '*', $where2, 'id', 99999, 'ASC');
        $id2 = 0;
        $entry2 = $list2->GetEntry($id2);
        while($entry2 != null)
        {
          echo '<tr><td colspan="10">';
          echo '- Equipped by: '.$entry2['ownerid'];
          echo '</td></tr>';
          $result2 = $database->Update('equipped=0','inventory','ownerid = '.$entry2['ownerid'].'',9999999);
          $result2 = $database->Update('equippedstats=""','accounts','id = '.$entry2['ownerid'].'',1);
          ++$id2;
          $entry2 = $list2->GetEntry($id2);
        }
        
        
      }
      $result->close();
    }
  }
}
  
$database->UpdateEnable($update);
$updateEquippedPlayers = true;
  
$itemsets = new Generallist($database, 'itemsets', '*', '', '', 99999999);
$id = 0;
$entry = $itemsets->GetEntry($id);
  
$sets = array();
while($entry != null)
{
  echo '<tr><td colspan="10" class="catGradient">';
  echo $entry['name'].' - Value: '.$entry['value'];
  echo '</td></tr>';
  echo '
 <tr class="catGradient">
  <td width="5%">ID</td> 
  <td width="35%">Name</td> 
  <td width="5%">Slot</td> 
  <td width="5%">Level</td> 
  <td width="10%">NewValue</td> 
  <td width="5%">PreValue</td> 
  <td width="5%">PrePreis</td> 
  <td width="5%">NewPreis</td> 
  <td width="5%">PreArena</td> 
  <td width="5%">NewArena</td> 
 </tr>';
  $value = $entry['value'];
  
  $auraValue = getValue($sets, $entry['aura']);
  if($auraValue == 0 && $entry['aura'] != 0)
    $auraValue = $entry['level'] * 4;
  
  updateItem($sets, $database, $entry['aura'], $auraValue, $updateEquippedPlayers);
  $value = $value - $auraValue;
  
  $waffeValue = getValue($sets, $entry['waffe']);
  if($waffeValue == 0)
    $waffeValue = round($value * 0.19);
  updateItem($sets, $database, $entry['waffe'], $waffeValue, $updateEquippedPlayers);
  $value = $value - $waffeValue;
  
  $hemdValue = getValue($sets, $entry['hemd']);
  if($hemdValue == 0)
    $hemdValue = round($value * 0.225);
  
  updateItem($sets, $database, $entry['hemd'], $hemdValue, $updateEquippedPlayers);
  $value = $value - $hemdValue;
  
  $hoseValue = getValue($sets, $entry['hose']);
  if($hoseValue == 0)
    $hoseValue = round($value * 0.275);
  
  updateItem($sets, $database, $entry['hose'], $hoseValue, $updateEquippedPlayers);
  $value = $value - $hoseValue;
  
  $handValue = getValue($sets, $entry['handschuhe']);
  if($handValue == 0)
    $handValue = round($value * 0.355);
  
  updateItem($sets, $database, $entry['handschuhe'], $handValue, $updateEquippedPlayers);
  $value = $value - $handValue;
  
  $schuheValue = getValue($sets, $entry['schuhe']);
  if($schuheValue == 0)
    $schuheValue = round($value * 0.525);
  
  updateItem($sets, $database, $entry['schuhe'], $schuheValue, $updateEquippedPlayers);
  $value = $value - $schuheValue;
  
  $accessoireValue = getValue($sets, $entry['accessoire']);
  if($accessoireValue == 0)
    $accessoireValue = round($value * 1.0);
  
  updateItem($sets, $database, $entry['accessoire'], $accessoireValue, $updateEquippedPlayers);
  $value = $value - $accessoireValue;
  
      
  $set = array(array($entry['schuhe'], $schuheValue)
              ,array($entry['hose'], $hoseValue)
              ,array($entry['hemd'], $hemdValue)
              ,array($entry['handschuhe'], $handValue)
              ,array($entry['waffe'], $waffeValue)
              ,array($entry['aura'], $auraValue)
              ,array($entry['accessoire'], $accessoireValue));
              
  $sets[count($sets)] = $set;
  
  ++$id;
  $entry = $itemsets->GetEntry($id);
}
?>
</table>