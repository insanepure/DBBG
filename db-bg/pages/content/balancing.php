<?php 
$attacks = new Generallist($database, 'attacks', '*', '', '', 99999999999, 'ASC');
if(isset($_GET['a']) && $_GET['a'] == 'fight')
{
	$fights = $_POST['fights'];
	$rounds = $_POST['rounds'];
  
  $amount1 = $_POST['amount1'];
  $amount2 = $_POST['amount2'];
  
  $log = $log.' <b>'.$amount1.'vs'.$amount2.'</b> Balancing mit <b>'.$rounds.'</b> Runden und <b>'.$fights.'</b> Kämpfen.<br/>';
  AddToLog($database, $ip, $accs, $log);
  
  
  include_once 'classes/npc/npc.php';
  include_once 'classes/fight/fight.php';
  include_once 'classes/items/itemmanager.php';
  $database->UpdateEnable(false);
  $database->InsertEnable(false);
  $database->DeleteEnable(false);
  $database->TruncateEnable(false);
  set_time_limit(600);
  //$database->Debug();
  
  $lp1 = $_POST['lp1'];
  $kp1 = $_POST['kp1'];
  $attack1 = $_POST['attack1'];
  $defense1 = $_POST['defense1'];
  $attacks1 = $_POST['attacks1'];
  
  $lp2 = $_POST['lp2'];
  $kp2 = $_POST['kp2'];
  $attack2 = $_POST['attack2'];
  $defense2 = $_POST['defense2'];
  $attacks2 = $_POST['attacks2'];
  
  $race1 = $_POST['race1'];
  $race2 = $_POST['race2'];
  
  $npc1 = new NPC($database, 0, 1);
  $npc1->SetID(0);
  $npc1->SetImageName("");
  $npc1->SetLP($lp1);
  $npc1->SetMaxLP($lp1);
  $npc1->SetKP($kp1);
  $npc1->SetMaxKP($kp1);
  $npc1->SetAttack($attack1);
  $npc1->SetDefense($defense1);
  $attacks1 = implode(';',$attacks1);
  $npc1->SetAttacks($attacks1);
  $npc1->SetAccuracy(100);
  $npc1->SetReflex(100);
  $npc1->SetRace($race1);
  
  $npc2 = new NPC($database, 0, 1);
  $npc2->SetID(1);
  $npc2->SetName("Player B");
  $npc2->SetImageName("");
  $npc2->SetLP($lp2);
  $npc2->SetMaxLP($lp2);
  $npc2->SetKP($kp2);
  $npc2->SetMaxKP($kp2);
  $npc2->SetAttack($attack2);
  $npc2->SetDefense($defense2);
  $attacks2 = implode(';',$attacks2);
  $npc2->SetAttacks($attacks2);
  $npc2->SetAccuracy(100);
  $npc2->SetReflex(100);
  $npc2->SetRace($race2);
  
  $type = 1; //Spaßkampf
  
  $mode = $amount1.'vs'.$amount2;
  $name = 'Balancingkampf';
  $zeni = 0;
  $items = 0;
  $survivalrounds = 0;
  $survivalteam = 0;
  $survivalwinner = 0;
  
  $resultLP1 = 0;
  $resultMLP1 = 0;
  $resultKP1 = 0;
  $resultMKP1 = 0;
  $resultAttack1 = 0;
  $resultMAttack1 = 0;
  $resultDefense1 = 0;
  $resultMDefense1 = 0;
  $resultAcc1 = 0;
  $resultMAcc1 = 0;
  $resultRef1 = 0;
  $resultMRef1 = 0;
  
  $resultLP2 = 0;
  $resultMLP2 = 0;
  $resultKP2 = 0;
  $resultMKP2 = 0;
  $resultAttack2 = 0;
  $resultMAttack2 = 0;
  $resultDefense2 = 0;
  $resultMDefense2 = 0;
  $resultAcc2 = 0;
  $resultMAcc2 = 0;
  $resultRef2 = 0;
  $resultMRef2 = 0;
  
  $resultWin1 = 0;
  $resultWin2 = 0;
  $resultDraw = 0;
  $resultText = '';
  
	for($f = 0; $f < $fights; ++$f)
  {
    $createdFight = Fight::CreateFight(null, $database, $type, $name, $mode, 0, $actionManager, $zeni, $items,0,0,$survivalteam,$survivalrounds,$survivalwinner);
    for($i = 0; $i < $amount1; ++$i)
    {
      $npc1->SetID($i);
      $npc1->SetName('Player A.'.($i+1));
      $createdFight->Join($npc1, 0, true);
    }
    for($i = 0; $i < $amount2; ++$i)
    {
      $npc2->SetID($i+$amount1);
      $npc2->SetName('Player B.'.($i+1));
      $createdFight->Join($npc2, 1, true);
    }

    for($i = 0; $i < $rounds; ++$i)
    {
      $createdFight->DoRound();
      if($createdFight->IsEnded())
      {
        break;
      }
    }
    $fighter1LP = 0;
    for($i = 0; $i < $amount1; ++$i)
    {
      $fighter1 = $createdFight->GetFighter($i);
      $fighter1LP += $fighter1->GetLP();
      
      $resultLP1 += $fighter1->GetLP();
      $resultMLP1 += $fighter1->GetMaxLP();
      $resultKP1 += $fighter1->GetKP();
      $resultMKP1 += $fighter1->GetMaxKP();
      $resultAttack1 += $fighter1->GetAttack();
      $resultMAttack1 += $fighter1->GetMaxAttack();
      $resultDefense1 += $fighter1->GetDefense();
      $resultMDefense1 += $fighter1->GetMaxDefense();
      $resultAcc1 += $fighter1->GetAccuracy();
      $resultMAcc1 += $fighter1->GetMaxAccuracy();
      $resultRef1 += $fighter1->GetReflex();
      $resultMRef1 += $fighter1->GetMaxReflex();
    }

    $fighter2LP = 0;
    for($i = 0; $i < $amount2; ++$i)
    {
      $fighter2 = $createdFight->GetFighter($i + $amount1);
      $fighter2LP += $fighter2->GetLP();
      
      $resultLP2 += $fighter2->GetLP();
      $resultMLP2 += $fighter2->GetMaxLP();
      $resultKP2 += $fighter2->GetKP();
      $resultMKP2 += $fighter2->GetMaxKP();
      $resultAttack2 += $fighter2->GetAttack();
      $resultMAttack2 += $fighter2->GetMaxAttack();
      $resultDefense2 += $fighter2->GetDefense();
      $resultMDefense2 += $fighter2->GetMaxDefense();
      $resultAcc2 += $fighter2->GetAccuracy();
      $resultMAcc2 += $fighter2->GetMaxAccuracy();
      $resultRef2 += $fighter2->GetReflex();
      $resultMRef2 += $fighter2->GetMaxReflex();
    }
    
    $resultText = $resultText.' '.$createdFight->GetText();
    if($fighter1LP == 0 && $fighter2LP != 0)
      $resultWin2++;
    else if($fighter1LP != 0 && $fighter2LP == 0)
      $resultWin1++;
    else
      $resultDraw++;
  }
  
  $resultLP1 /= $fights * $amount1;
  $resultMLP1 /= $fights * $amount1;
  $resultKP1 /= $fights * $amount1;
  $resultMKP1 /= $fights * $amount1;
  $resultAttack1 /= $fights * $amount1;
  $resultMAttack1 /= $fights * $amount1;
  $resultDefense1 /= $fights * $amount1;
  $resultMDefense1 /= $fights * $amount1;
  $resultAcc1 /= $fights * $amount1;
  $resultMAcc1 /= $fights * $amount1;
  $resultRef1 /= $fights * $amount1;
  $resultMRef1 /= $fights * $amount1;
  
  $resultLP2 /= $fights * $amount2;
  $resultMLP2 /= $fights * $amount2;
  $resultKP2 /= $fights * $amount2;
  $resultMKP2 /= $fights * $amount2;
  $resultAttack2 /= $fights * $amount2;
  $resultMAttack2 /= $fights * $amount2;
  $resultDefense2 /= $fights * $amount2;
  $resultMDefense2 /= $fights * $amount2;
  $resultAcc2 /= $fights * $amount2;
  $resultMAcc2 /= $fights * $amount2;
  $resultRef2 /= $fights * $amount2;
  $resultMRef2 /= $fights * $amount2;
	
  $database->UpdateEnable(true);
  $database->InsertEnable(true);
  $database->DeleteEnable(true);
  $database->TruncateEnable(true);
}
  
  $default = 10;
  $defaultRounds = 10;
  $defaultFights = 1;
?>
<div class="spacer"></div>
<form method="POST" action="?p=balancing&a=fight">
  
<table width="90%" cellspacing="0" class="borderT borderL borderR borderB">
  <tr class="catGradient">
    <td align="center" width="50%">Spieler A</td>
    <td align="center" width="50%">Spieler B</td>
  </tr>
  <tr>
    <td align="right" class="borderR">
    LP: <input type="text" name="lp1" value="<?php if(isset($_POST['lp1'])) echo $_POST['lp1']; else echo $default*10; ?>"><br/>  
    KP: <input type="text" name="kp1" value="<?php if(isset($_POST['kp1'])) echo $_POST['kp1']; else echo $default*10; ?>"><br/> 
    Attack: <input type="text" name="attack1" value="<?php if(isset($_POST['attack1'])) echo $_POST['attack1']; else echo $default; ?>"><br/> 
    Defense: <input type="text" name="defense1" value="<?php if(isset($_POST['defense1'])) echo $_POST['defense1']; else echo $default; ?>"><br/> 
      
          <select class="select" name="race1">
            <option value="">Keine</option>
           <option value="Saiyajin" <?php if(isset($_POST['race1']) && $_POST['race1'] == 'Saiyajin') echo 'selected'; ?>>Saiyajin</option>
            <option value="Mensch" <?php if(isset($_POST['race1']) && $_POST['race1'] == 'Mensch') echo 'selected'; ?>>Mensch</option>
            <option value="Freezer" <?php if(isset($_POST['race1']) && $_POST['race1'] == 'Freezer') echo 'selected'; ?>>Freezer</option>
            <option value="Kaioshin" <?php if(isset($_POST['race1']) && $_POST['race1'] == 'Kaioshin') echo 'selected'; ?>>Kaioshin</option>
            <option value="Android" <?php if(isset($_POST['race1']) && $_POST['race1'] == 'Android') echo 'selected'; ?>>Android</option>
            <option value="Majin" <?php if(isset($_POST['race1']) && $_POST['race1'] == 'Majin') echo 'selected'; ?>>Majin</option>
            <option value="Demon" <?php if(isset($_POST['race1']) && $_POST['race1'] == 'Demon') echo 'selected'; ?>>Demon</option>
            <option value="Namekianer" <?php if(isset($_POST['race1']) && $_POST['race1'] == 'Namekianer') echo 'selected'; ?>>Namekianer</option>
         </select>
          <select class="select" name="amount1">
            <?php
            for($i=1;$i <= 10;++$i)
            {
            ?><option value="<?php echo $i; ?>" <?php if(isset($_POST['amount1']) && $_POST['amount1'] == $i) echo 'selected'; ?>><?php echo $i; ?></option><?php
            }
            ?>
         </select>
    </td>
    <td align="right">
    LP: <input type="text" name="lp2" value="<?php if(isset($_POST['lp2'])) echo $_POST['lp2']; else echo $default*10; ?>"><br/>  
    KP: <input type="text" name="kp2" value="<?php if(isset($_POST['kp2'])) echo $_POST['kp2']; else echo $default*10; ?>"><br/> 
    Attack: <input type="text" name="attack2" value="<?php if(isset($_POST['attack2'])) echo $_POST['attack2']; else echo $default; ?>"><br/> 
    Defense: <input type="text" name="defense2" value="<?php if(isset($_POST['defense2'])) echo $_POST['defense2']; else echo $default; ?>"><br/> 
          <select class="select" name="race2">
            <option value="">Keine</option>
            <option value="Saiyajin" <?php if(isset($_POST['race2']) && $_POST['race2'] == 'Saiyajin') echo 'selected'; ?>>Saiyajin</option>
            <option value="Mensch" <?php if(isset($_POST['race2']) && $_POST['race2'] == 'Mensch') echo 'selected'; ?>>Mensch</option>
            <option value="Freezer" <?php if(isset($_POST['race2']) && $_POST['race2'] == 'Freezer') echo 'selected'; ?>>Freezer</option>
            <option value="Kaioshin" <?php if(isset($_POST['race2']) && $_POST['race2'] == 'Kaioshin') echo 'selected'; ?>>Kaioshin</option>
            <option value="Android" <?php if(isset($_POST['race2']) && $_POST['race2'] == 'Android') echo 'selected'; ?>>Android</option>
            <option value="Majin" <?php if(isset($_POST['race2']) && $_POST['race2'] == 'Majin') echo 'selected'; ?>>Majin</option>
            <option value="Demon" <?php if(isset($_POST['race2']) && $_POST['race2'] == 'Demon') echo 'selected'; ?>>Demon</option>
            <option value="Namekianer" <?php if(isset($_POST['race2']) && $_POST['race2'] == 'Namekianer') echo 'selected'; ?>>Namekianer</option>
         </select>
          <select class="select" name="amount2">
            <?php
            for($i=1;$i <= 10;++$i)
            {
            ?><option value="<?php echo $i; ?>" <?php if(isset($_POST['amount2']) && $_POST['amount2'] == $i) echo 'selected'; ?>><?php echo $i; ?></option><?php
            }
            ?>
         </select>
    </td>
  </tr>
  <tr>
    <td align="center" class="borderR">
    <?php
    $id = 0;
    $entry = $attacks->GetEntry($id);
    while($entry != null)
    {
      ?>
    <div style="height:60px; width:40px; display: inline-block;">
      <img width="40px" height="40px" src="img/attacks/<?php echo $entry['image']; ?>.png" class="attack"></img> <input type="checkbox" name="attacks1[]" value="<?php echo $entry['id']; ?>" <?php if(isset($_POST['attacks1']) && in_array($entry['id'], $_POST['attacks1']))  echo 'checked'; ?>>
      </div>
      <?php
    ++$id;
    $entry = $attacks->GetEntry($id);
    }
    ?>
    </td>
    <td align="center">
    <?php
    $id = 0;
    $entry = $attacks->GetEntry($id);
    while($entry != null)
    {
      ?>
    <div style="height:60px; width:40px; display: inline-block;">
      <img width="40px" height="40px" src="img/attacks/<?php echo $entry['image']; ?>.png" class="attack"></img> <input type="checkbox" name="attacks2[]" value="<?php echo $entry['id']; ?>" <?php if(isset($_POST['attacks2']) && in_array($entry['id'], $_POST['attacks2'])) echo 'checked'; ?>>
      </div>
      <?php
    ++$id;
    $entry = $attacks->GetEntry($id);
    }
    ?>
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center" class="borderT" height="40px">
      Runden: <input type="text" name="rounds" value="<?php if(isset($_POST['rounds'])) echo $_POST['rounds']; else echo $defaultRounds; ?>"><br/>
      Fights: <input type="text" name="fights" value="<?php if(isset($_POST['fights'])) echo $_POST['fights']; else echo $defaultFights; ?>"><br/>
      Text: <select class="select" name="displaytext">
            <option value="Ja">Ja</option>
            <option value="Nein" <?php if(isset($_POST['displaytext']) && $_POST['displaytext'] == 'Nein') echo 'selected'; ?>>Nein</option>
         </select>
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center" class="borderT footer">
      <input type="submit" value="Kämpfen">
    </td>
  </tr>
</table>
  
</form>
<?php 
if(isset($createdFight))
{
	$fighter1 = $createdFight->GetFighter(0);
	$fighter2 = $createdFight->GetFighter(1);
	?>
 <br/>
<table width="90%" cellspacing="0" class="borderT borderL borderR borderB">
  <tr class="catGradient">
    <td align="center" colspan="2">Results</td>
  </tr>
  <tr class="catGradient">
    <td align="center" width="50%">Spieler A</td>
    <td align="center" width="50%">Spieler B</td>
  </tr>
  <tr>
    <td align="left" class="borderR">
    LP: <?php echo $resultLP1.'/'.$resultMLP1; ?><br/>  
    KP: <?php echo $resultKP1.'/'.$resultMKP1; ?><br/>  
    Attack: <?php echo $resultAttack1.'/'.$resultMAttack1; ?><br/>  
    Defense: <?php echo $resultDefense1.'/'.$resultMDefense1; ?><br/>   
    Accuracy: <?php echo $resultAcc1.'/'.$resultMAcc1; ?><br/>  
    Reflex: <?php echo $resultRef1.'/'.$resultMRef1; ?><br/>  
    </td>
    <td align="left">
    LP: <?php echo $resultLP2.'/'.$resultMLP2; ?><br/>  
    KP: <?php echo $resultKP2.'/'.$resultMKP2; ?><br/>  
    Attack: <?php echo $resultAttack2.'/'.$resultMAttack2; ?><br/>  
    Defense: <?php echo $resultDefense2.'/'.$resultMDefense2; ?><br/>   
    Accuracy: <?php echo $resultAcc2.'/'.$resultMAcc2; ?><br/>  
    Reflex: <?php echo $resultRef2.'/'.$resultMRef2; ?><br/>  
    </td>
  </tr>
  <tr class="catGradient">
    <td align="center" colspan="2">Kampf</td>
  </tr>
  <tr><td colspan="2" align="center">
    Win Spieler A: <?php echo $resultWin1; ?><br/>
    Win Spieler B: <?php echo $resultWin2; ?><br/>
    Draw: <?php echo $resultDraw; ?><br/>
    </td></tr>
</table>
<br/>
  <table width="100%">
  <?php if(!isset($_POST['displaytext']) || isset($_POST['displaytext']) && $_POST['displaytext'] != 'Nein') echo $resultText; ?>
  </table>
	<?php
}
?>