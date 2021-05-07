<?php
include_once $_SERVER['DOCUMENT_ROOT'].'../../main/www/classes/session.php';
include_once '../../../classes/header.php';


$inventory = $player->GetInventory();
$item = null;
if(isset($_GET['id']) && is_numeric($_GET['id']))
{
  $item = $inventory->GetItem($_GET['id']);
  if($item == null)
  {
    exit();
  }
}
else
{
  exit();
}


if($item->IsEquipped() || $item->GetRace() != '' || $item->GetType() != 3 && $item->GetType() != 4)
{
  exit();
}
?>
<form method="POST" action="?p=ausruestung&a=combine">
<div class="spacer"></div>
<table width="100%" cellspacing="0">
  <tr>
  <td width="2%"></td>
  <td align="center" width="38%" class="catGradient borderT borderR borderL"><b>Stats Item</b></td>
  <td width="10%"></td>
  <td align="center" width="38%" class="catGradient borderT borderR borderL"><b>Visuelles Item</b></td>
  <td width="2%"></td>
  </tr>
  <tr>
  <td></td>
    <td align="center" class="borderL borderR">
      <select name="statsitem" id="statslist" onchange="SetItemData('statsitem', 'statslist');">
        <?php
        $i = 0;
        $firstItem = null;
        $statsItem = $inventory->GetItem($i);
        while(isset($statsItem))
        {
          if($i == $_GET['id'] || $statsItem->GetType() != 3 && $statsItem->GetType() != 4 || $statsItem->IsEquipped() || $statsItem->GetRace() != '' || $statsItem->GetSlot() != $item->GetSlot())
          {
            ++$i;
            $statsItem = $inventory->GetItem($i);
            continue;
          }
          if($firstItem == null)
            $firstItem = $statsItem;
          
        ?><option value="<?php echo $i; ?>"><?php echo $statsItem->GetName(); ?></option>
        <?php 
          ++$i;
          $statsItem = $inventory->GetItem($i);
        }
        ?>
      </select>
    </td>
  <td align="center">
    </td>
    <td align="center" class="borderL borderR">
    </td>
  </tr>
  <tr>
  <td></td>
    <td align="center" class="borderL borderR" id="statsitem">
      <?php 
      if($firstItem == null)
      {
        ?>Du hast kein passendes Item.<?php
      }
      else
      {
        echo $firstItem->GetName(); 
      ?>
        <div class="spacer"></div>
        <div style="width:80px; height:80px; position:relative; top:0px; left:0px;">
        <?php if($firstItem->HasOverlay())
        {
          ?>
            <img src="img/items/<?php echo $firstItem->GetOverlay(); ?>.png" style="width:80px; height:80px; left:0px; top:0px; position:absolute; z-index:1;"></img><br/> 
          <?php
        }
        ?>
        <img src="img/items/<?php echo $firstItem->GetImage(); ?>.png" style="width:80px; height:80px; left:0px; top:0px; position:absolute; z-index:0;"></img><br/> 
        </div>
        <div class="spacer"></div>
      <?php 
        echo $firstItem->DisplayEffect();
      }
      ?>
    </td>
    <td align="center">
      <<== <br/>
      <<== <br/>
      <<== <br/>
      <<== <br/>
      <<== <br/>
      <<== <br/>
      <<== <br/>
      <<== <br/>
  </td>
    <td align="center" class="borderL borderR" id="visualitem">
      <?php echo $item->GetName(); ?>
      <div class="spacer"></div>
        <div style="width:80px; height:80px; position:relative; top:0px; left:0px;">
        <?php if($item->HasOverlay())
        {
          ?>
            <img src="img/items/<?php echo $item->GetOverlay(); ?>.png" style="width:80px; height:80px; left:0px; top:0px; position:absolute; z-index:1;"></img><br/> 
          <?php
        }
        ?>
        <img src="img/items/<?php echo $item->GetImage(); ?>.png" style="width:80px; height:80px; left:0px; top:0px; position:absolute; z-index:0;"></img><br/> 
        </div>
      <div class="spacer"></div>
      <?php echo $item->DisplayEffect(); ?>
    </td>
  <td></td>
  </tr>
  <tr>
    <td></td>
    <td class="borderL borderR borderB"></td>
    <td></td>
    <td class="borderL borderR borderB"></td>
    <td></td>
  </tr>
</table>
<div class="spacer"></div>
				<input type="hidden" name="visualitem" value="<?php echo $_GET['id']; ?>">
				<input type="submit" value="Kombinieren">
				</form>
<div class="spacer3"></div>
Achtung! Wenn du beide Items kombinierst hast du nunoch 1x Item!<br/>
Das Stats Item wird dann so aussehen wie das Visuelle Item!