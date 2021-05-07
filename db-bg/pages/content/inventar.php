<div class="spacer"></div>
<table width="100%" cellspacing="0" border="0">
  <tr>
    <td class="catGradient borderB borderT" colspan="6" align="center"><b>Inventar</b></td>
  </tr>
  <tr>
  <tr>
    <td width="10%"><center><b>Bild</b></center></td>
    <td width="15%"><center><b>Item</b></center></td>
    <td width="25%"><center><b>Wirkung</b></center></td>
    <td width="10%"><center><b>Anzahl</b></center></td>
    <td width="40%"><center><b>Aktion</b></center></td>
  </tr>
  <?php
  $i = 0;
  $item = $inventory->GetItem($i);
  while(isset($item))
  {
	if($item->GetType() != 1 && $item->GetType() != 2 && $item->GetType() != 5 && $item->GetType() != 6)
	{
		++$i;
		$item = $inventory->GetItem($i);
		continue;
	}
    ?>
  <tr height="75px">
    <td class="borderT" style="position:absolute;"><center>
      <div style="position:relative; width:60px; height:60px">
      <div style="width:60px; height:60px; position:relative; top:10px; left:-25px;">
        <?php if($item->HasOverlay())
        {
          ?>
        <img class="boxSchatten borderT borderR borderL borderB" src="img/items/<?php echo $item->GetOverlay(); ?>.png" style="width:60px;height:60px; position:absolute; z-index:1;"> 
          <?php
        }
        ?>
        <img class="boxSchatten borderT borderR borderL borderB" src="img/items/<?php echo $item->GetImage(); ?>.png" style="width:60px;height:60px; position:absolute; z-index:0;"> 
      </div>
      <span style="position:absolute; right:0px; bottom:-10px; font-size:24px; color:#000;
      text-shadow:
        -1px -1px 0 #fff,
        1px -1px 0 #fff,
        -1px 1px 0 #fff,
        1px 1px 0 #fff;"><b><?php echo $item->GetAmount(); ?></b></span>
      </div>
      </img>
      </center></td>
    <td class="borderT"><center><?php echo $item->GetName(); ?></center></td>
    <td class="borderT"><center>
      <?php 
      echo $item->DisplayEffect(); 
      if($item->GetLevel() != 0) echo 'Benötigt Level '.$item->GetLevel(); 
      ?></center></td>
    <td class="borderT"><center>
      <?php 
      echo $item->GetAmount(); 
      ?></center></td>
    <td class="borderT"><center>
		<div class="spacer"></div>
			<?php 
			if($item->GetType() != 5)
			{
			?>
          <button onclick="OpenPopupPage('Item Benutzen','items/use.php?id=<?php echo $i; ?>')">
          Benutzen
          </button>
		<div class="spacer"></div>
			<?php 
			}
			if($item->IsSellable())
			{
			?>
          <button onclick="OpenPopupPage('Item Verkaufen','items/sell.php?id=<?php echo $i; ?>')">
          Verkaufen
          </button>
		<div class="spacer"></div>
		<?php
			}
      ?>
      </form>
      </center></td>
  </tr>
  
  <?php
    ++$i;
    $item = $inventory->GetItem($i);
  }
  
  ?>
</table>