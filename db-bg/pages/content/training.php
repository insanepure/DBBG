<div class="spacer"></div>
<table width="100%" cellspacing="0">
  <tr>
    <td class="catGradient borderB borderT" colspan="6" align="center"><b>Aktionen</b></td>
  </tr>
  <tr>
    <td width="15%" align="center"><b>Bild</b></td>
    <td width="20%" align="center"><b>Name</b></td>
    <td width="35%" align="center"><b>Wirkung</b></td>
    <td width="10%" align="center"><b>Kosten</b></td>
    <td width="10%" align="center"><b>Stunden</b></td>
    <td width="10%" align="center"><b>Aktion</b></td>
  </tr>
  <?php
  $actions = $place->GetActions();
  $i = 0;
  while(isset($actions[$i]))
  {
    $action = $actions[$i];
    if($action->GetLevel() <= $player->GetLevel())
    {
    ?>
  <tr>
    <form method="POST" action="?p=training&a=train&id=<?php echo $action->GetID(); ?>">
    <td><img class="boxSchatten borderT borderR borderL borderB" src="img/actions/<?php echo $action->GetImage(); ?>.png" width="75px" height="75px" style="margin-left:5px; margin-top:5px;"></img></td>
    <td><?php echo $action->GetName(); ?></td>
    <td>
      <?php echo $bbcode->parse($action->GetDescription()); ?>
    </td>
    <td>
      <?php 
      if($action->GetPrice() != 0)
      {
        echo $action->GetPrice().' \h';
      }
      echo '<br/>';
      if($action->GetItem() != 0)
      {
		    $itemData = $itemManager->GetItem($action->GetItem());
        echo $itemData->GetName();
      }
      ?>
    </td>
    <td align="center"> 
      <select class="select" style="width:100px" name="hours">
        <?php
        $minutes = $action->GetMinutes();
        $startHours = $minutes / 60;
        $maxHours = 24 * 30;
        $j = 0;
        $hours = 0;
        while($maxHours > $hours)
        {
          if($j == $action->GetMaxTimes())
            break;
          $hours = $startHours + ($startHours * $j);
        ?>
          <option value="<?php echo $hours; ?>"><?php echo $hours; if($hours == 1) echo ' Stunde'; else echo ' Stunden';?></option>
        <?php
          ++$j;
        }
        ?>
      </select>   
    </td>
    <td align="center">    
      <input type="submit" value="Start"/>
    </td>
    </form>
  </tr>
  <?php
    }
    
    ++$i;
  }
  ?>
</table>