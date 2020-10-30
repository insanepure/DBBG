<?php
include_once 'classes/header.php';
if(!isset($_GET['p']))
  exit();


$p = $_GET['p'];
$database->UpdateEnable(false);
?>
<table>
<?php
  
  function updateAttacks($database, $type, $valueModifier, $energyModifier, $kpModifier, $accuracyModifier, $accuracyMax)
  {
    $where = 'type='.$type;
    $list = new Generallist($database, 'attacks', '*', $where, '', 99999, 'ASC');
    $id = 0;
    $entry = $list->GetEntry($id);
    //echo '<pre>';
    //print_r($list);
    //echo '</pre>';
    while($entry != null)
    {
      echo $entry['name'].' ('.$entry['id'].')';
      if(!$entry['costgenerated'])
      {
        echo ' - NOT GENERATED<br/>';
        ++$id;
        $entry = $list->GetEntry($id);
        continue;
      }
      
      $nValue = $entry['value'] * $valueModifier;
      
      echo ' - Val: '.$nValue.' ('.$entry['value'].')';
      $lpVal = abs($nValue) * ($entry['lpvalue']/100);
      $kpVal = abs($nValue) * ($entry['kpvalue']/100);
      $atkVal = abs($nValue) * ($entry['atkvalue']/100);
      $defVal = abs($nValue) * ($entry['defvalue']/100);
      $epVal = abs($nValue) * ($entry['epvalue']/100);
      $reflectVal = abs($nValue) * ($entry['reflectvalue']/100);
      $nEnergy = ($lpVal * $energyModifier);
      $nEnergy += ($kpVal * $energyModifier);
      $nEnergy += ($atkVal * $energyModifier);
      $nEnergy += ($defVal * $energyModifier);
      $nEnergy += ($epVal * $energyModifier);
      $nEnergy += ($reflectVal * $energyModifier);
      $nEnergy = floor($nEnergy);
      
      if($type == 18 && $entry['value'] < 0) $nEnergy = $nEnergy * 2;
      
      if($type == 9)
        $nEnergy = floor(abs($nValue) * $energyModifier);
      
      if($type == 1)
        $nEnergy = $nEnergy-10;
      if($type == 21)
        $nEnergy = $nEnergy-26;
      else if($type == 20)
        $nEnergy = $nEnergy-60;
      else if($type == 22)
        $nEnergy = $nEnergy+20;
      
      if($nEnergy < 0) $nEnergy = 0;
      
      if($type == 21)
      {
        $nEnergy = $nEnergy * $entry['rounds'];
      }
      
      if($type == 9)
        $nAccuracy = $accuracyMax;
      else if($entry['id'] == 299 || $entry['id'] == 292 || $entry['id'] == 291 || $entry['id'] == 290 || $entry['id'] == 289 || $entry['id'] == 285)
        $nAccuracy = 20;
      else if($type == 2)
        $nAccuracy = 100;
      else
        $nAccuracy = (($accuracyMax - abs($nValue)) / $accuracyModifier) * 100;
      echo ' - Acc: '.$nAccuracy.' ('.$entry['accuracy'].')';
      
      if($type == 1 && $entry['procentual'] == 0)
      {
        $nAccMod = 1;
        if($nAccuracy < 100) $nAccMod = ($nAccuracy/100);
        $nEnergy = floor(abs($nValue) / 25 * $nAccMod);
      }
      
      if($entry['id'] == 2 || $entry['id'] == 20 || $type == 18 && $entry['race'] != '')
        $nEnergy = 0;
      echo ' - Energy: '.$nEnergy.' ('.$entry['energy'].')';

      $nKP = 0;
      if($entry['id'] == 2 || $entry['id'] == 20)
        $nKP = 0;
      else if($type == 2 || $type == 20 || $type == 9 || $type == 12 || $type == 21 || $type == 18 || $type == 5)
        $nKP = abs($nEnergy) *  $kpModifier;
      else if(abs($nValue) > 1 && $type == 1 || $type == 4 || $type == 22)
      {
        $nKP = abs($nValue) * $kpModifier;
        $nKP = $nKP * abs($nValue);
        
        if($entry['procentual'] == 0)
          $nKP = $nEnergy * 62.5;
        else if(abs($nValue) >= 20)
          $nKP = $nKP / (abs($nValue)/10);
      }
      else
        $nKP = $nEnergy * $nEnergy * $kpModifier;
      
      if($entry['rounds'] != 0)
        $nKP = $nKP / $entry['rounds'];
      
      $nKP = round($nKP);
      echo ' - KP: '.$nKP.' ('.$entry['kp'].')';
      
      if($nAccuracy > 100) $nAccuracy = 100;
      echo '<br/>';
      $result = $database->Update('value="'.$nValue.'", energy="'.$nEnergy.'", kp="'.$nKP.'", accuracy="'.$nAccuracy.'"','attacks','id = "'.$entry['id'].'"',1);
      ++$id;
      $entry = $list->GetEntry($id);
    }
  }
  
  
if($p == 'items')
{
    $list = new Generallist($database, 'items', '*', $where, 'lv, type', 99999, 'ASC');
    $id = 0;
    $entry = $list->GetEntry($id);
    //echo '<pre>';
    //print_r($list);
    //echo '</pre>';
  
  
  
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
  
    function addSet(&$sets, $value, $level, $schuhe, $hose, $hemd, $hand, $waffe, $aura)
    {
      $auraValue = getValue($sets, $aura);
      if($auraValue == 0 && $aura != 0)
        $auraValue = $level * 4;
        
      $value = $value - $auraValue;
      
      $waffeValue = getValue($sets, $waffe);
      if($waffeValue == 0)
        $waffeValue = round($value * 0.3);
      
      $value = $value - $waffeValue;
      
      $hemdValue = getValue($sets, $hemd);
      if($hemdValue == 0)
        $hemdValue = round($value * 0.35);
      
      $value = $value - $hemdValue;
      
      $hoseValue = getValue($sets, $hose);
      if($hoseValue == 0)
        $hoseValue = round($value * 0.4);
      
      $value = $value - $hoseValue;
      
      $handValue = getValue($sets, $hand);
      if($handValue == 0)
        $handValue = round($value * 0.6);
      
      $value = $value - $handValue;
      
      $schuheValue = getValue($sets, $schuhe);
      if($schuheValue == 0)
        $schuheValue = round($value * 1.0);
        
      $value = $value - $schuheValue;
      
      $set = array(array($schuhe, $schuheValue)
                  ,array($hose, $hoseValue)
                  ,array($hemd, $hemdValue)
                  ,array($hand, $handValue)
                  ,array($waffe, $waffeValue)
                  ,array($aura, $auraValue));
                  
      $sets[count($sets)] = $set;
    }
  
    $sets = array();
  
    $value = 30;
    $level = 1;
    $schuhe = 29;
    $hose = 30;
    $hemd = 31;
    $handschuhe = 32;
    $waffe = 18;
    $aura = 0;
    addSet($sets, $value, $level, $schuhe, $hose, $hemd, $handschuhe, $waffe, $aura); //Lumpen
  
    $value = 50;
    $level = 1;
    $schuhe = 14;
    $hose = 15;
    $hemd = 16;
    $handschuhe = 17;
    addSet($sets, $value, $level, $schuhe, $hose, $hemd, $handschuhe, $waffe, $aura); //Tiger
  
    $value = 40;
    $level = 4;
    $schuhe = 37;
    $hose = 38;
    $hemd = 38;
    $handschuhe = 40;
    $waffe = 28;
    addSet($sets, $value, $level, $schuhe, $hose, $hemd, $handschuhe, $waffe, $aura); //Zerfetzer Stoff
  
    $value = 60;
    $level = 4;
    $schuhe = 19;
    $hose = 20;
    $hemd = 21;
    $handschuhe = 22;
    $waffe = 23;
    addSet($sets, $value, $level, $schuhe, $hose, $hemd, $handschuhe, $waffe, $aura); //Pterodactyl
  
    $value = 50;
    $level = 5;
    $schuhe = 33;
    $hose = 34;
    $hemd = 35;
    $handschuhe = 36;
    $waffe = 41;
    addSet($sets, $value, $level, $schuhe, $hose, $hemd, $handschuhe, $waffe, $aura); //Stoff
  
    $value = 70;
    $level = 5;
    $schuhe = 24;
    $hose = 25;
    $hemd = 26;
    $handschuhe = 27;
    $waffe = 41;
    addSet($sets, $value, $level, $schuhe, $hose, $hemd, $handschuhe, $waffe, $aura); //Dieb
  
    $value = 90;
    $level = 7;
    $schuhe = 42;
    $hose = 43;
    $hemd = 44;
    $handschuhe = 45;
    addSet($sets, $value, $level, $schuhe, $hose, $hemd, $handschuhe, $waffe, $aura); //Oolong
  
    $value = 120;
    $level = 9;
    $schuhe = 51;
    $hose = 52;
    $hemd = 53;
    $handschuhe = 54;
    $waffe = 76;
    addSet($sets, $value, $level, $schuhe, $hose, $hemd, $handschuhe, $waffe, $aura); //Yamchu
  
    $value = 140;
    $level = 12;
    $schuhe = 46;
    $hose = 47;
    $hemd = 48;
    $handschuhe = 49;
    $waffe = 50;
    addSet($sets, $value, $level, $schuhe, $hose, $hemd, $handschuhe, $waffe, $aura); //Shu
  
    $value = 200;
    $level = 13;
    $schuhe = 81;
    $hose = 80;
    $hemd = 78;
    $handschuhe = 79;
    $waffe = 77;
    $aura = 190;
    addSet($sets, $value, $level, $schuhe, $hose, $hemd, $handschuhe, $waffe, $aura); //Schildkrötenschule
  
    $value = 210;
    $level = 13;
    $schuhe = 85;
    $hose = 83;
    $hemd = 84;
    addSet($sets, $value, $level, $schuhe, $hose, $hemd, $handschuhe, $waffe, $aura); //MutenRoshi
  
    $value = 220;
    $level = 15;
    $schuhe = 87;
    $hose = 86;
    $handschuhe = 88;
    addSet($sets, $value, $level, $schuhe, $hose, $hemd, $handschuhe, $waffe, $aura); //Bakterian
  
    $value = 240;
    $level = 18;
    $schuhe = 91;
    $hose = 90;
    $hemd = 89;
    $handschuhe = 92;
    addSet($sets, $value, $level, $schuhe, $hose, $hemd, $handschuhe, $waffe, $aura); //Mönch
  
    $value = 320;
    $level = 22;
    $schuhe = 110;
    $hose = 109;
    $hemd = 108;
    $handschuhe = 111;
    $waffe = 112;
    $aura = 191;
    addSet($sets, $value, $level, $schuhe, $hose, $hemd, $handschuhe, $waffe, $aura); //Ninja
  
    $value = 330;
    $level = 27;
    $schuhe = 118;
    $hose = 119;
    $hemd = 116;
    $handschuhe = 119;
    addSet($sets, $value, $level, $schuhe, $hose, $hemd, $handschuhe, $waffe, $aura); //Kappute Red Ribbon
  
    $value = 360;
    $level = 27;
    $schuhe = 126;
    $hose = 125;
    $hemd = 128;
    $handschuhe = 127;
    $aura = 192;
    addSet($sets, $value, $level, $schuhe, $hose, $hemd, $handschuhe, $waffe, $aura); //Red Ribbon
  
    $value = 380;
    $level = 27;
    $schuhe = 130;
    $hose = 129;
    $hemd = 131;
    $waffe = 132;
    addSet($sets, $value, $level, $schuhe, $hose, $hemd, $handschuhe, $waffe, $aura); //Arale
  
    $value = 400;
    $level = 30;
    $schuhe = 134;
    $hose = 133;
    $hemd = 135;
    $waffe = 136;
    addSet($sets, $value, $level, $schuhe, $hose, $hemd, $handschuhe, $waffe, $aura); //TaoBaiBai
  
    $value = 420;
    $level = 32;
    $schuhe = 148;
    $hose = 149;
    $hemd = 147;
    addSet($sets, $value, $level, $schuhe, $hose, $hemd, $handschuhe, $waffe, $aura); //Black
  
    $value = 450;
    $level = 34;
    $schuhe = 156;
    $hose = 157;
    $hemd = 155;
    $handschuhe = 154;
    $waffe = 158;
    addSet($sets, $value, $level, $schuhe, $hose, $hemd, $handschuhe, $waffe, $aura); //Incognito
  
    $value = 520;
    $level = 40;
    $schuhe = 153;
    $hose = 152;
    $hemd = 151;
    $aura = 193;
    addSet($sets, $value, $level, $schuhe, $hose, $hemd, $handschuhe, $waffe, $aura); //Kranich / Tenshinhan
  
    $value = 530;
    $level = 44;
    $schuhe = 161;
    $hose = 160;
    $hemd = 159;
    addSet($sets, $value, $level, $schuhe, $hose, $hemd, $handschuhe, $waffe, $aura); //Oberteufel
  
    $value = 600;
    $level = 45;
    $schuhe = 168;
    $hose = 167;
    $hemd = 166;
    $handschuhe = 169;
    $waffe = 170;
    addSet($sets, $value, $level, $schuhe, $hose, $hemd, $handschuhe, $waffe, $aura); //Königliche Wache
  
    $value = 640;
    $level = 50;
    $schuhe = 188;
    $hose = 187;
    $hemd = 186;
    $handschuhe = 189;
    addSet($sets, $value, $level, $schuhe, $hose, $hemd, $handschuhe, $waffe, $aura); //Piccolo
  
    $value = 720;
    $level = 53;
    $schuhe = 201;
    $hose = 202;
    $hemd = 199;
    $handschuhe = 200;
    $waffe = 203;
    $aura = 204;
    addSet($sets, $value, $level, $schuhe, $hose, $hemd, $handschuhe, $waffe, $aura); //Radditz
  
    $value = 840;
    $level = 60;
    $schuhe = 209;
    $hose = 207;
    $hemd = 206;
    $handschuhe = 208;
    $aura = 210;
    addSet($sets, $value, $level, $schuhe, $hose, $hemd, $handschuhe, $waffe, $aura); //Vegeta
    
    while($entry != null)
    {
      echo $entry['name'].' ('.$entry['id'].')';
      echo ' - LVL: '.$entry['lv'].' ';
      $preValue = $entry['value'];
      if($entry['type'] == 1)
        $preValue = $entry['lp'] + $entry['kp'];
      $value = $preValue;
      
      $newValue = getValue($sets, $entry['id']);
      
      if($newValue != 0)
        $value = $newValue;
      else if($entry['slot'] == 6)
        $value = round($value / 4);
      
      if($entry['type'] == 3)
        $price = $value * 200;
      else if($entry['type'] == 4)
        $price = $value * 500;
      else
        $price = $value * 5;
      
      if($value == 0)
        $price = $entry['price'];
      
      if($entry['price'] == 0)
        $price = 0;
      
      echo ' - Value: '.$value.' ('.$preValue.')';
      echo ' - Price: '.$price.' ('.$entry['price'].')';
      
      $arenaPoints = 100 + $value + ($entry['lv']*10);
      if($entry['type'] != 3 || $row['race'] != '' || $value == 0 || $entry['arenapoints'] == 0)
        $arenaPoints = 0;
      
      echo ' - Arena: '.$arenaPoints.' ('.$entry['arenapoints'].')';
      echo '<br/>';
      $result = $database->Update('value="'.$value.'",price="'.$price.'",arenapoints="'.$arenaPoints.'"','items','id = "'.$entry['id'].'"',1);
      ++$id;
      $entry = $list->GetEntry($id);
    }
}
else if($p == 'itemrework')
{
    $database->Debug();
  
    //$list = new Generallist($database, 'inventory', '*', '', '', 99999, 'ASC');
    //$id = 0;
    //$entry = $list->GetEntry($id);
    //while($entry != null)
    //{
    //
    //  $row = null;
    //  $result = $database->Select('*','items','id = "'.$entry['statsid'].'"',1);
    //  if ($result) 
    //  {
    //    if ($result->num_rows > 0)
    //    {
    //      $row = $result->fetch_assoc();
    //    }
    //    $result->close();
    //  } 
    //  
    //    echo $entry['id'].' - '.$entry['statsid'].'/'.$entry['visualid'].' ';
    //    echo $row['name'].': ';
    //    echo $entry['ownerid'].' ';
    //    echo '<br/>';
    //    $result = $database->Update('statstype="'.$row['defaultstatstype'].'"','inventory','id="'.$entry['id'].'"',1);
    //    echo '<br/>';
    //  
    //  ++$id;
    //  $entry = $list->GetEntry($id);
    //}
  $result = $database->Update('equippedstats="",travelbonus="0"','accounts','',99999999);
  $result = $database->Update('equipped="0"','inventory','',99999999);
}
else if($p == 'arena')
{
  $result = $database->Update('arenapoints = 100 + ((lp + kp + defense + attack)) + (lv*10)','items','arenapoints != 0',99999999);
}
else if($p == 'attacks')
{
  $type = 1;
  $valueModifier = 1;
  $energyModifier = 0.5;
  $kpModifier = 2.0;
  $accuracyModifier = 400;
  $accuracyMax = 600;
  //$type = 2;
  //$valueModifier = 1;
  //$energyModifier = 4;
  //$kpModifier = 50;
  //$accuracyModifier = 1;
  $type = 4;
  $valueModifier = 1;
  $energyModifier = 0;
  $kpModifier = 0.5;
  $accuracyModifier = 1000000;
  $accuracyMax = 1000000;
  //$type = 5;
  //$valueModifier = 1;
  //$energyModifier = 0.8;
  //$kpModifier = 50;
  //$accuracyModifier = 400;
  //$accuracyMax = 600;
  //$type = 9;
  //$valueModifier = 1;
  //$energyModifier = 5.5;
  //$kpModifier = 100;
  //$accuracyModifier = 10;
  //$accuracyMax = 90;
  //$type = 12;
  //$valueModifier = 1;
  //$energyModifier = 0.8;
  //$kpModifier = 50;
  //$accuracyModifier = 400;
  //$accuracyMax = 500;
  //$type = 18;
  //$valueModifier = 1;
  //$energyModifier = 0.4;
  //$kpModifier = 50;
  //$accuracyModifier = 200;
  //$accuracyMax = 600;
  //$type = 20;
  //$valueModifier = 1;
  //$energyModifier = 2.8;
  //$kpModifier = 50;
  //$accuracyModifier = 400;  
  //$accuracyMax = 600;
  //$type = 21;
  //$valueModifier = 1;
  //$energyModifier = 0.17;
  //$kpModifier = 37.5;
  //$accuracyModifier = 400;
  //$accuracyMax = 600;
  //$type = 22;
  //$valueModifier = 1;
  //$energyModifier = 0.5;
  //$kpModifier = 4;
  //$accuracyModifier = 400;
  //$accuracyMax = 600;
  updateAttacks($database, $type, $valueModifier, $energyModifier, $kpModifier, $accuracyModifier, $accuracyMax);
}
else if($p == 'story')
{
  ?>
  <tr>
  <td><b>ID</b></td>
  <td><b>Name</b></td>
  <td><b>NPC</b></td>
  <td><b>KI</b></td>
  <td><b>LevelUP</b></td>
  <td><b>Level</b></td>
  <td><b>Zeni</b></td>
  <td><b>Ort</b></td>
  <td><b>OrtTech</b></td>
  <td><b>OrtNPCs</b></td>
  <td><b>ZeniProTag</b></td>
  <td><b>StundenBisKI</b></td>
  </tr>
  <?php
  $where = '';
  $onlineList = new Generallist($database, 'story', '*', $where, '', 99999, 'ASC');
  $id = 0;
  $entry = $onlineList->GetEntry($id);
  $level = 1;
  while($entry != null)
  {
    $maxZeni = 0;
    $kiNeeded = 0;
    ?>
    <tr>
    <?php 
    echo '<td>'.$entry['id'].'</td>';  
    echo '<td>'.$entry['titel'].'</td>';  
    if($entry['type'] == 2)
    {
      $npc = new NPC($database, $entry['npc']);
      echo '<td>'.$npc->GetName().'</td>';  
      echo '<td>'.$npc->GetKI().'</td>';  
      $kiNeeded = $npc->GetKI();
    }
    else
    {
      echo '<td></td>';  
      echo '<td></td>';  
    }
    if($entry['levelup'])
      echo '<td>+1</td>';  
    else
      echo '<td></td>';
    echo '<td>'.$level.'</td>';  
    echo '<td>'.$entry['zeni'].'</td>';  
    echo '<td>'.$entry['place'].'</td>';  
    
    $place = new Place($database, $entry['place'], $entry['planet'], $actionManager);
    echo '<td>'.$place->GetLearnableAttacks().'</td>';  
    echo '<td>';
    $npcs = $place->GetNPCs();
    foreach($npcs as &$placeNPC)
    {
      $npc = new NPC($database, $placeNPC);
      if(!$npc->IsValid())
        continue;
      
      echo $npc->GetName().' ('.$npc->GetKI().' & '.$npc->GetZeni().' & '.$npc->GetAttacks().') ';
      if($npc->GetZeni() > $maxZeni)
        $maxZeni = $npc->GetZeni();
    }
    echo '</td>';
    echo '<td>'.($maxZeni*10).'</td>';
    $statsNeededHours = floor((($kiNeeded-10) * 4) / 3);
    $statsNeededDays = round($statsNeededHours / 24, 2);
    if($statsNeededHours > 0)
      echo '<td>'.$statsNeededHours.'H = '.$statsNeededDays.' Tage </td>';
    else
      echo '<td>0</td>';
    
    if($entry['levelup'])
    {
      ++$level;
    }
    ?>
    </tr>
    <?php
    ++$id;
    $entry = $onlineList->GetEntry($id);
  }
}
?>
</table>