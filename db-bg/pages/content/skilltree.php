<?php 

$debugTree = false;
if(!isset($p))
{
  ?>
  <div class="spacer"></div>
  Du hast noch
  <?php
  echo $player->GetSkillPoints();
  if($player->GetSkillPoints() == 1)
  {
    ?> Skillpoint.<?php
  }
  else
  {
    ?> Skillpoints.<?php
  }
}
?>
  
<div class="spacer"></div>
<table width="600px">
  <tr>
  <td align="center"><a href="?p=<?php if(isset($p)) echo $p; ?>skilltree&tree=1<?php if(isset($p)) echo '&race='.$race; ?>"><div class="SideMenuButton">Verwandlungen</div></a></td>
  <td align="center"><a href="?p=<?php if(isset($p)) echo $p; ?>skilltree&tree=2<?php if(isset($p)) echo '&race='.$race; ?>"><div class="SideMenuButton">Offensive</div></a></td>
  <td align="center"><a href="?p=<?php if(isset($p)) echo $p; ?>skilltree&tree=3<?php if(isset($p)) echo '&race='.$race; ?>"><div class="SideMenuButton">Defensive</div></a></td>
  <td align="center"><a href="?p=<?php if(isset($p)) echo $p; ?>skilltree&tree=4<?php if(isset($p)) echo '&race='.$race; ?>"><div class="SideMenuButton">Positive</div></a></td>
  <td align="center"><a href="?p=<?php if(isset($p)) echo $p; ?>skilltree&tree=5<?php if(isset($p)) echo '&race='.$race; ?>"><div class="SideMenuButton">Negative</div></a></td>
  </tr>
</table>
<?php
$tree = 1;
if(isset($_GET['tree']) && is_numeric($_GET['tree']) && $_GET['tree'] >= 1 && $_GET['tree'] <= 5)
{
  $tree = $database->EscapeString($_GET['tree']);
}

$select = "skilltree.*, attacks.id as atkID, attacks.name as atkName, attacks.image as atkImage";
$where = 'attacks.id = skilltree.attack AND skilltree.type="'.$tree.'" AND (skilltree.race="" OR skilltree.race="'.$race.'")';
$order = 'id';
$join = 'attacks';
$from = 'skilltree';
$group = 'skilltree.attack';
$skilltreeData = new Generallist($database, $from, $select, $where, $order, 100, 'ASC', $join, $group);

$select = 'id, type, attack, angle, col, row, learnable';
$where = 'attack=0 AND type="'.$tree.'" AND (race="" OR race="'.$race.'")';
$skilltreeData->AddEntries('skilltree', $select, $where, '', 100, 'ASC');

$height = 800;
$width = 640;
$leftOffset = 25;
?>
<div style="margin-top:3px;
            width:<?php echo $width; ?>px; height:<?php echo $height; ?>px; 
            border: 2px solid #ffd700;
            outline: 1px solid #000;
            background-image: radial-gradient(#222, #111);">
<?php
$id = 0;
$entry = $skilltreeData->GetEntry($id);
while($entry != null)
{
  $image = '';
  $isAttack = $entry['attack'] != 0;
  if($isAttack)
    $image = $entry['atkImage'];
  else
    $image = 'cellline';
  $left = ($entry['col'] * 35) + $leftOffset;
  $top = $height - $topOffset - ($entry['row'] * 35);
  $hasAttack = true;
  if(!isset($p))
    $hasAttack = in_array($entry['attack'], $pAttacks);
  ?>
  <div style="position:absolute; left:<?php echo $left;?>px; top:<?php echo $top; ?>px; width:50px; height:50px;">
    
  <?php 
  if($isAttack)
  {
    ?>
	<div class="tooltip" style="z-index:1; position:absolute; left:0px; top:0px;"> 
  <?php
  if($entry['learnable'] && !$hasAttack)
  {
  ?>
  <a href="?p=skilltree&a=learn&attack=<?php echo $entry['id']; ?>">
  <?php
  } 
  else if($entry['learnable'] && isset($p))
  {
  ?>
  <a href="?p=info&info=techniken#<?php echo $entry['attack']; ?>">
  <?php
  }
  if($debugTree)
  {
  ?>
    <div style="position:absolute; left:0px; top:20px; width:50px; height:50px;  z-index:3;">
      <b><font color="#ff0000"><?php echo $entry['id']; ?></font></b>
    </div>
  <?php
  }
  ?>
    <img src="img/attacks/<?php echo $image; ?>.png" style="position:absolute; z-index:1; left:3px; top:3px; width:45px; height:45px;
                                                                        <?php
                                                                        if(!$hasAttack)
                                                                        {
                                                                        ?>
                                                                        filter: gray; /* IE6-9 */
                                                                        -webkit-filter: grayscale(1); /* Google Chrome, Safari 6+ & Opera 15+ */
                                                                        filter: grayscale(1); /* Microsoft Edge and Firefox 35+ */
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                        "/>
    <img src="img/skilltree/cell.png" style="position:absolute; left:0px; top:0px; width:50px; height:50px;  z-index:2;"/>
    <?php
    if(($entry['learnable'] && !$hasAttack) || ($entry['learnable'] && isset($p)))
    {
    ?>
    </a>
    <?php
    } 
    ?>
	  <span class="tooltiptext" style="position:absolute; z-index:5; width:180px; top:-20px; left:-65px;">
    <?php
    echo $entry['atkName'];
    echo ' '.$entry['neededpoints'].' SP';
    if($debugTree)
    {
      echo ' ('.$entry['attack'].')';
      echo ' NeedAtk: '.$entry['needattacks'];
      echo ' NeedPts: '.$entry['neededpoints'];
    }
    ?>
    </span>
    <?php
    if(isset($p))
    {
      echo '</a>';
    }
    ?>
			</div>
    <?php
  }
  else
  {
    $left = 0;
    $top = 0;
	$cellHeight = 50;
    if($entry['angle'] != 0)
    {
      $left = 5;
      $top = -15;
	  $cellHeight = 85;
    }
    if($debugTree)
    {
    ?>
    <div style="position:absolute; z-index:0; left:<?php echo $left-25; ?>px; top:<?php echo $top+15 + ($entry['angle']/5); ?>px; width:100px; z-index:3;">
      <b><font color="#fff"><?php echo $entry['id']; ?></font></b>
    </div>
    <?php
    }
    ?>
    <img src="img/skilltree/<?php echo $image; ?>.png" style="transform: rotate(<?php echo $entry['angle']; ?>deg); position:absolute; z-index:0; left:<?php echo $left; ?>px; top:<?php echo $top; ?>px; width:45px; height:<?php echo $cellHeight; ?>px;"/>
    <?php
  }
    ?>
  </div>
  <?php
  ++$id;
  $entry = $skilltreeData->GetEntry($id);
}
?>
</div>