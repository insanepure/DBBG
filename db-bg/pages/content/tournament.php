<?php
$tFound = false;
if(isset($_GET['tid']) && is_numeric($_GET['tid']))
{
  $i = 0;
  $tournament = $tournamentManager->GetTournament($i);
  while(isset($tournament))
  {
    if($tournament->GetID() == $_GET['tid'])
    {
      $tFound = true;
      break;
    }
    ++$i;
    $tournament = $tournamentManager->GetTournament($i);
  }
}

if($tFound)
{
  ?>
  <div class="spacer"></div>
  <table width="90%" cellspacing="0">
    <tr>
      <td class="catGradient borderT borderR borderL borderB schatten" align="center"><?php echo $tournament->GetName(); ?></td>
    </tr>
    <tr>
      <td class="borderR borderL" align="center" height="20px">
      </td>
    </tr>
    <tr>
      <td class="borderR borderL" height="200px" align="center" valign="top">
      <table width="100%" cellspacing="0">
      <?php
      if($tournament->GetParticipantSize() == 0)
      {
        ?>
        Das Turnier findet nicht statt, weil es zuwenig Teilnehmer sind.
        <?php
      }
      //rowCount needs to be power of 2!!
      $brackets = $tournament->GetBracketCount();
      $imgSize = 256 / $brackets;
      if($imgSize > 32)
      {
        $imgSize = 32;
      }
      $rounds = log($brackets,2);
      $cells = 1;
      $round = $rounds;
      while($round >= 0)
      {
        $currentRound = $rounds - $round;
        $colspan = $brackets / $cells;
        ?>
        <tr>
          <?php
          $cell = 0;
          $width = 100 / $cells;
          while($cell < $cells)
          {
            $isRight = $cell % 2;
            $cellclass = "left";
            if($isRight)
            {
              $cellclass = "right";
            }
          ?>
          <td style="position:relative;" height="50px" width="<?php echo $width; ?>%" colspan="<?php echo $colspan; ?>" align="center">
          <div class="bracketcell tooltip">
          <?php
          $fighterBracket = $tournament->GetBracket($cell, $round);
          if($fighterBracket != null)
          {
            $fighter = $fighterBracket[0];
            $alive = $fighterBracket[1];
            $imgSRC = '';
            if($fighter->IsNPC())
            {
              $imgSRC = 'img/npc/'.$fighter->GetImage().'.png';
            }
            else
            {
              $imgSRC = $fighter->GetImage();
            }
            if(!$fighter->IsNPC())
            {
              ?><a href="?p=profil&id=<?php echo $fighter->GetFighterID(); ?>"><?php
            }
            ?>
            <img width="<?php echo $imgSize; ?>px" height="<?php echo $imgSize; ?>px" class="borderT borderR borderL borderB boxSchatten <?php if(!$alive) { ?>bracketimage<?php } ?>" src="<?php echo $imgSRC; ?>"></img><br/>
            <?php
            if(!$fighter->IsNPC())
            {
            ?></a><?php
            }
            ?><span class="tooltiptext" style="width:100px; left:-65px; top:-30px;"><?php echo $fighter->GetName(); ?></span><?php
          }
          ?>
          </div>
          <?php 
          if($round != $rounds)
          {
          ?>
          <div class="bracketline" style="<?php echo $cellclass; ?>:49%; top:0px; width:0px; height:20px" >
          </div>
          <div class="bracketline" style="<?php echo $cellclass; ?>:49%; top:0px; width:51%; height:0px;" >
          </div> 
          <?php
          }
          if($round != 0)
          {
          ?>
            <div class="bracketline" style="<?php echo $cellclass; ?>:49%; top:20px; width:0px; height:30px" >
          <?php
          }
          ?>
          </div>
          </td>
          <?php
          ++$cell;
          }
          ?>
        </tr>
        <?php
        $cells = $cells * 2;
        $round--;
      }
      ?>
      </table>
      </td>
    </tr>
  <tr>
    <td class="borderR borderL borderB" align="center" height="50px">
    <?php 
    if(!$tournament->IsEnd() && $player->GetTournament() == $tournament->GetID())
    {
    ?>
      <form method="POST" action="?p=tournament&tid=<?php echo $_GET['tid']; ?>&a=fight">
      <input type="submit" value="Kämpfen">  
      </form>
    <?php 
    }
    ?>
    </td>
  </tr>
  </table>
  <?php
}
else
{
  $i = 0;
  $tournament = $tournamentManager->GetTournament($i);
  while(isset($tournament))
  {
    ?>
      <div class="spacer"></div>
      <table width="90%" cellspacing="0">
        <tr>
          <td class="catGradient borderT borderR borderL borderB schatten" align="center"><?php echo $tournament->GetName(); ?></td>
        </tr>
        <tr>
          <td class="borderR borderL" align="center"><img class="boxSchatten borderT borderR borderL borderB" width="500px" height="250px" src="img/tournaments/<?php echo $tournament->GetImage(); ?>.png"></img></td>
        </tr>
        <tr>
          <td class="borderR borderL" align="center" height="20px"></td>
        </tr
			  <?php 
        if($tournament->GetZeni() > 0 || $tournament->GetItems() != '') 
        { 
       ?>
        <tr>
          <td class="borderR borderL" align="center">
							<fieldset style="width:60%">
              <legend><b> Gewinn:</b></legend>
                <?php if($tournament->GetZeni() > 0)
                {
                 ?>
                  <?php echo $tournament->GetZeni().' Zeni'; ?><br/>
                <?php 
                } 
                ?>
                <?php if($tournament->GetItems() != '')
                {
                  $itemManager = new ItemManager($database);
                  $items = explode(';',$tournament->GetItems());
                  foreach($items as &$item)
                  {
                    $item = explode('@',$item);
                    $itemID = $item[0];
                    $amount = $item[1];
                    $item = $itemManager->GetItem($itemID);
                    echo $amount.'x '.$item->GetName(); ?><br/><?php
                  }
                } 
                ?>
            </fieldset>
            
        </tr>
			  <?php 
        } 
        ?>
            <?php
            if($tournament->IsStarted())
            {
              ?>
              <tr>
                <td class="borderR borderL" align="center"><a href="?p=tournament&tid=<?php echo $tournament->GetID(); ?>">Anschauen</a></td>
              </tr>
              <?php
            }
            else
            {
              ?>
			  <?php if($tournament->GetMaxPlayers() > 0) { ?>
              <tr>
                <td class="borderR borderL" align="center">Maximale Teilnehmer: <?php echo $tournament->GetMaxPlayers(); ?></td>
              </tr>
			  <?php } ?>
              <tr>
                <td class="borderR borderL" align="center">Start: <?php echo $tournament->GetStartTimeFormatted(); ?>Uhr</td>
              </tr>
              <tr>
                <td class="borderR borderL" align="center">
              <?php
              if($player->GetPendingTournament() == $tournament->GetID())
              {
                ?>
                <form method="POST" action="?p=tournament&a=leave">
                <input type="submit" value="Verlassen">
                </form>
							<div class="spacer2"></div>
							<fieldset style="width:60%">
              <legend><b> Teilnehmer:</b></legend>
              <table>
                <?php
								$fighters = new Generallist($database, 'accounts', '*', 'pendingtournament="'.$tournament->GetID().'"', '', 99999999999, 'ASC');
								$id = 0;
								$entry = $fighters->GetEntry($id);
								while($entry != null)
								{
									?>
									<tr>
										<td><a href="?p=profil&id=<?php echo $entry['id']; ?>"><?php echo $entry['name'].'<br/>'; ?></a></td>
									</tr>
									<?php
									++$id;
									$entry = $fighters->GetEntry($id);
								}
								?>
								</table>
									</fieldset>
								<?php
              }
              else
              {
                ?>
                <form method="POST" action="?p=tournament&a=join&id=<?php echo $tournament->GetID(); ?>">
                <input type="submit" value="Beitreten">
                </form>
                <?php
              }
            }
            ?>
          </td>
        </tr>
        <tr>
          <td class="borderR borderL borderB" height="20px"></td>
        </tr>
      </table>
    <?php
    ++$i;
    $tournament = $tournamentManager->GetTournament($i);
  }
}
?>