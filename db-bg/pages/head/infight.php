<?php
include_once 'classes/items/itemmanager.php';
$itemManager = new ItemManager($database);

$pFighter = null;

if(isset($fight) && $fight->IsStarted())
{
 	$pFighter = $fight->GetPlayer();
	$firstpFighter = $pFighter;
  $attackCode = '';
  if($pFighter != null)
  {
    if($fight->GetRound() >= 100)
      $pFighter->AddAttack(606);
    $attackCode = $pFighter->GetAttackCode();
  }
	
	if(isset($_GET['a']) && $_GET['a'] == 'attack' && isset($_POST['attack']) && isset($_POST['target']) && 
     is_numeric($_POST['attack']) && is_numeric($_POST['target']) && isset($_GET['code']) && $pFighter->GetAttackCode() == $_GET['code'])
	{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
      // Build POST request:
      $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
      $recaptcha_secret = '6Lcd57wUAAAAAESxu56CVSwlLc2QcNZa31PD3tMr';
      $recaptcha_response = $_POST['g-recaptcha-response'];
      // Make and decode POST request:
      $recaptcha = file_get_contents($recaptcha_url.'?secret='.$recaptcha_secret.'&response='.$recaptcha_response);
      $recaptcha = json_decode($recaptcha);
      if($recaptcha && $recaptcha->success)
      {
        $account->UpdateRecaptcha($recaptcha);
        if($recaptcha->score < 0.7)
        {
          $text = $player->GetName().' hatte eine Score von '.$recaptcha->score.' im Kampf.';
          //$PMManager->SendPM(0, '', 'Recaptcha', $player->GetName(), $text, 'PuRe');
        }
      }
    }
    $fight->DoAttack($pFighter, $_POST['attack'], $_POST['target']);
  }
	else if(isset($_GET['a']) && $_GET['a'] == 'kick' && isset($_GET['id']) && is_numeric($_GET['id']))
	{
		$fight->Kick($_GET['id']);
	}
	else if(isset($_GET['a']) && $_GET['a'] == 'giveup' && isset($_POST['giveup']))
	{
		$fight->GiveUp($pFighter);
	}
  
  if($pFighter != null)
  {
    $fight->UpdateAttackCode($pFighter);
  }
	
 	$pFighter = $fight->GetPlayer();
	if($pFighter != null && $firstpFighter != null && $pFighter->GetID() != $firstpFighter->GetID())
	{
		$pFighter->CalculateItemAttacks($itemManager);
	}
}
else if(isset($_GET['fight']))
{
  $fight = new Fight($database, $_GET['fight'], $player, $actionManager);
}

if(isset($fight) && $fight->IsStarted())
{
  $teams = $fight->GetTeams();
}
else if(!isset($fight) || !$fight->IsStarted())
{
	header('Location: ?p=news');
	exit();  
}
    
if(isset($_GET['a']) && $_GET['a'] == 'meld' && $fight != null && $player->GetName() != 'Google')
{
  $title = 'Meldung von '.$player->GetName().' in Kampf '.$fight->GetName().' ('.$fight->GetID().')';
  $fight->DebugSend(false, $title);
  $message = 'Du hast den Kampf gemeldet.';
}

function interpolateColor($corA, $corB, $lerp)
{
  $redA = $corA & 0xFF0000;
  $greenA = $corA & 0x00FF00;
  $blueA = $corA & 0x0000FF;
  $redB = $corB & 0xFF0000;
  $greenB = $corB & 0x00FF00;
  $blueB = $corB & 0x0000FF;

  $redC = $redA + (($redB - $redA) * $lerp) & 0xFF0000;         // Only Red
  $greenC = $greenA + (($greenB - $greenA) * $lerp) & 0x00FF00; // Only Green
  $blueC = $blueA + (($blueB - $blueA) * $lerp) & 0x0000FF;     // Only Blue

  $result = dechex($redC | $greenC | $blueC);
  return str_pad($result, 6, "0", STR_PAD_LEFT);return $redC | $greenC | $blueC;
}

function GetLPCSS($value)
{
  $downColor = interpolateColor(0xffaf00, 0x00fafa, $value);
  $upColor = interpolateColor(0xfffa00, 0x00afaf, $value);
  return "background: #$downColor;
  background: -moz-linear-gradient(#$upColor ,#$downColor);
  background: -webkit-linear-gradient(#$upColor ,#$downColor);
  background: linear-gradient(#$upColor ,#$downColor);
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#$upColor', endColorstr='#$downColor',GradientType=0 );";
}

function GetKPCSS($value)
{
  $downColor = interpolateColor(0x00aaff, 0xffffff, $value);
  $upColor = interpolateColor(0x55aabb, 0x00aaff, $value);
  return "background: #$downColor;
  background: -moz-linear-gradient(#$upColor ,#$downColor);
  background: -webkit-linear-gradient(#$upColor ,#$downColor);
  background: linear-gradient(#$upColor ,#$downColor);
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#$upColor', endColorstr='#$downColor',GradientType=0 );";
}

function ShowTeam($team, $id, $player, $fight)
{
  if($player != null && $player->GetTeam() == $id)
  {
    $sortTeam = array();
    $i = 0;
    while(isset($team[$i]))
    {
      $fighter = $team[$i];
      if(!$fighter->IsInactive() && $player != $fighter)
      {
        array_push($sortTeam, $fighter);
      }
      ++$i;
    }
    
    array_unshift($sortTeam, $player);
    $team = $sortTeam;
  }
  
  
?>  
<div class="SideMenuContainer borderT borderL borderB borderR">
  <div class="SideMenuKat catGradient borderB">
		<div class="schatten"><font color="<?php echo $fight->GetTeamColor($id); ?>">Team: <?php echo $id+1; ?></font></div>
  </div>
  <div class="SideMenuInfo">
    <div class="spacer"></div>
    <!-- Player Anfang -->
    <?php
    $i = 0;
    while(isset($team[$i]))
    {
      $fighter = $team[$i];
			if($fighter->IsInactive())
			{
				++$i;
				continue;
			}
    ?>
    <div class="SideMenuContainer2 borderT borderL borderB borderR">
      <div class="SideMenuKat catGradient">
        <div class="schatten">
          <?php echo $fighter->GetName(); ?>
        </div>
      </div>
      <div class="SideMenuInfo2">
        <div class="char_main2">
          <div class="spacer"></div>
          <?php	
          $playerimagenew = $fighter->GetImage();	  
          ?>
          <div class="char_image2 smallBG borderT borderB borderR borderL"><img src="<?php echo $playerimagenew; ?>" width="100%" height="100%"></img></div>
		  <div class="spacer"></div>
          <div class="char_live">
            <div class="lpback" style="height:20px; width:100%;">
              <div class="lpbox smallBG borderT borderB borderR borderL boxSchatten"></div>
              
              <div class="lpanzeige" style="width:<?php echo $fighter->GetLPPercentage();?>%"></div>
							<?php 
              $maxLP = $fighter->GetMaxLP();
              $tempLP = $fighter->GetLP() - $maxLP;
              $lpInc = 0.1;
							while($tempLP > 0)
							{
                $lpProc = min(100, ($tempLP / $maxLP * 100));
								?>
              	<div style="position: absolute; height:100%; top:1px; left:1px; <?php echo GetLPCSS($lpInc); ?> width:<?php echo $lpProc; ?>%"></div>
								<?php
                $tempLP = $tempLP - $maxLP;
                $lpInc += 0.1;
							}
              if($player != null && $player->GetTeam() == $id)
              {
              ?>
              <div class="lptext" style="font-size: 10px;">LP:
                <?php echo $fighter->GetLP();?>
              </div>
              <?php
              }
              else
              {
              ?>
              <div class="lptext" style="font-size: 10px;">LP: <?php echo $fighter->GetLPPercentage();?>%</div>
              <?php
              }
              ?>
            </div>
            <div class="spacer"></div>
            <div class="kpback" style="height:20px; width:100%;">
              <div class="kpbox smallBG borderT borderB borderR borderL boxSchatten"></div>
              <div class="kpanzeige" style="width:<?php echo $fighter->GetKPPercentage();?>%"></div>
							<?php 
              $maxKP = $fighter->GetMaxKP();
              $tempKP = $fighter->GetKP() - $maxKP;
              $kpInc = 0.1;
							while($tempKP > 0)
							{
                $kpProc = min(100, ($tempKP / $maxKP * 100));
								?>
              	<div style="position: absolute; height:100%; top:1px; left:1px; <?php echo GetKPCSS($kpInc); ?> width:<?php echo $kpProc; ?>%"></div>
								<?php
                $tempKP = $tempKP - $maxKP;
                $kpInc += 0.1;
							}
              if($player != null && $player->GetTeam() == $id)
              {
              ?>
              <div class="kptext" style="font-size: 10px;">KP:
                <?php echo $fighter->GetKP();?>
              </div>
              <?php
              }
              else
              {
              ?>
              <div class="kptext" style="font-size: 10px;">KP: <?php echo $fighter->GetKPPercentage();?>%</div>
              <?php
              }
              ?>
            </div>
            <div class="spacer"></div>
            <div class="epback" style="height:20px; width:100%;">
              <div class="epbox smallBG borderT borderB borderR borderL boxSchatten"></div>
              <div class="epanzeige" style="width:<?php echo $fighter->GetEPPercentage();?>%"></div>
							<?php 
							if($fighter->GetEnergy() > $fighter->GetMaxEnergy())
							{
								?>
              	<div class="epanzeige2" style="width:<?php echo $fighter->GetTotalEPPercentage()-100;?>%"></div>
								<?php
							}
              if($player != null && $player->GetTeam() == $id)
              {
              ?>
              <div class="eptext" style="font-size: 10px;">EP:
                <?php echo $fighter->GetEnergy();?>
              </div>
              <?php
              }
              else
              {
              ?>
              <div class="eptext" style="font-size: 10px;">EP: <?php echo $fighter->GetEPPercentage();?>%</div>
              <?php
              }
              ?>
            </div>
          </div>
        </div>
        <?php
        if($player != null && $player->GetTeam() == $id)
        {
        ?>
        <div class="info smallBG borderT borderB borderR borderL boxSchatten">KI: <?php echo $fighter->GetKI(); ?></div>
        <div class="spacer"></div>
        <?php
        }
        ?>
        <div class="info smallBG borderT borderB borderR borderL boxSchatten">
        <?php
        if($fighter->GetLP() == 0)
        {
          ?>Besiegt<?php
        }
        else if($fighter->GetAction() == 0)
        {
          ?>Keine Aktion<?php
        }
        else if($player != null && $player->GetTeam() == $id)
        {
					$attack = $fight->GetAttack($fighter->GetAction());
          echo $attack->GetName();
        }
        else
        {
          ?>Wartet<?php
        }
        ?>
        </div>
				<?php
				if($player != null && $player->GetTeam() == $id && $fighter->GetTarget() != 0)
				{
					?>
        	<div class="spacer"></div>
        	<div class="info smallBG borderT borderB borderR borderL boxSchatten">
					<?php 
						$target = $fight->GetFighter($fighter->GetTarget());
						echo $target->GetName();
					?>
        	</div>
					<?php
				}
				?>
        <div class="spacer"></div>
			<?php
				if($fighter->GetTransformations() != '')
				{
					$trans = explode(';',$fighter->GetTransformations());
					$j = 0;
					while(isset($trans[$j]))
					{
						$transAttack = $fight->GetAttack($trans[$j]);
						?>
						<div class="info smallBG borderT borderB borderR borderL boxSchatten">
						<?php 
							echo $transAttack->GetName();
						?>
						</div>
						<div class="spacer"></div>
						<?php
						++$j;
					}
				}
				if($player != null)
				{
				if($fighter->GetAction() == 0 && $fighter->GetLP() != 0 && !$fighter->IsNPC() && !$fighter->HasNPCControl())
				{
					$cooldown = $fighter->GetActionCountdown();
				?>
        <div class="info smallBG borderT borderB borderR borderL boxSchatten">
					<?php 
					if($cooldown <= 0)
					{
					?>
              <form method="post" action="?p=infight&a=kick&id=<?php echo $fighter->GetID(); ?>">
                <input type="submit" value="Kick">
              </form>
					<?php
					}
					else
					{
					?>
					
            <div id="cID<?php echo $fighter->GetID(); ?>">Init<script>countdown(<?php echo $cooldown; ?>,'cID<?php echo $fighter->GetID(); ?>', 'Aktualisieren');</script></div>
					<?php
					}
      	  ?></div><?php
					}
					?>
        <div class="spacer"></div>
				<?php
				}
				?>
    	</div>
		</div>  
    	<div class="spacer"></div>
    <?php
      ++$i;
    }
    ?>
    <!-- Player Ende -->
  </div>
</div>  <!-- SideMenuContainer -->
<div class="spacer"></div>
<?php  
}
?>