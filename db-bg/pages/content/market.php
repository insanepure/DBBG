<script>
grecaptcha.ready(function() {
  grecaptcha.execute('6Lcd57wUAAAAAMqh2WE8_KEHveQ4Ycw1gRmbZQkI', {action: 'Markt'});
});
</script>
<table width="100%" cellspacing="0" border="0">
  <tr>
    <td colspan=6 height="20px">
    </td>
  </tr>
  <tr>
    <td colspan=6 class="catGradient borderT borderB" align="center">
      <b> <font color="white"><div class="schatten">Suchen</div></font> </b>
    </td>
  </tr>
  <tr style ="boxSchatten">
    <td width="40%"><b> Name </b></td>
    <td width="40%"><b> Kategorie </b></td>
    <td width="40%"><b> Aktion </b></td>
  </tr>
  <tr>
      <form method="GET" action="?p=market">
        <input type="hidden" name="p" value="market">
    <td width="40%" style ="boxSchatten"> 
      <input style="width:90%;" type="text" name="itemname" value="<?php if(isset($_GET['itemname'])) echo htmlentities($_GET['itemname']); ?>"> 
    </td>
    <td width="40%" style ="boxSchatten">  
      <select style="width:90%;" class="select" name="itemcategory">
        <option value="0" <?php if(isset($_GET['itemcategory']) && $_GET['itemcategory'] == 0) echo 'selected'; ?>>Alle</option>
        <option value="1" <?php if(isset($_GET['itemcategory']) && $_GET['itemcategory'] == 1) echo 'selected'; ?>>Tränke</option>
        <option value="2" <?php if(isset($_GET['itemcategory']) && $_GET['itemcategory'] == 2) echo 'selected'; ?>>Rüstungen</option>
        <option value="3" <?php if(isset($_GET['itemcategory']) && $_GET['itemcategory'] == 3) echo 'selected'; ?>>Waffen</option>
      </select>
    </td>
    <td width="20%" style ="boxSchatten"> 
      <input type="submit" style="width:90%" value="Suchen">
     </td>
    </form>
  </tr>
</table>

<table width="100%" cellspacing="0" border="0">
  <tr>
    <td colspan=4 height="20px">
    </td>
  </tr>
  <tr>
    <td colspan=4 class="catGradient borderT borderB" align="center">
      <b> <font color="white"><div class="schatten">Verkaufen</div></font> </b>
    </td>
  </tr>
  <tr style ="boxSchatten">
    <td width="40%"><b> Name </b></td>
    <td width="20%"><b> Anzahl </b></td>
    <td width="20%"><b> Preis </b></td>
    <td width="20%"><b> Aktion </b></td>
  </tr>
  <tr>
      <form method="POST" action="?p=market&a=sell">
    <td style ="boxSchatten"> 
    <select style="height:30px; width:100%" name="item" class="select">
      <?php
      $i = 0;
      $item = $inventory->GetItem($i);
      while(isset($item))
      {
        if(!$item->IsEquipped())
        {
          $item = $inventory->GetItem($i);
            ?>
            <option value="<?php echo $i; ?>"><?php echo $item->GetName().' ('.$item->GetAmount().')'; ?></option>
            <?php
        }
        ++$i;
        $item = $inventory->GetItem($i);
      }
      ?>
    </select>
    </td>
    <td style ="boxSchatten">  
    <input type="text" style="width:90%" name="amount" placeholder="0">
    </td>
    <td style ="boxSchatten">  
    <input type="text" style="width:90%"  name="price" placeholder="0">
    </td>
    <td style ="boxSchatten"> 
      <input type="submit" style="width:90%" value="Verkaufen">
     </td>
    </form>
  </tr>
</table>

<table width="100%" cellspacing="0" border="0">
  <tr>
    <td colspan=7 height="20px">
    </td>
  </tr>
  <tr>
  <td colspan=7 class="catGradient borderT borderB" align="center">
      <b> <font color="white"><div class="schatten">Marktplatz</div></font> </b>
    </td>
  </tr>
  <tr style ="boxSchatten">
    <td width="15%"  align="center"><b> Bild </b></td>
    <td width="15%"  align="center"><b> Name </b></td>
    <td width="30%"  align="center"><b> Wirkung </b></td>
    <td width="15%"  align="center"><b> Aktion </b></td>
  </tr>
   <?php
  $i = 0;
  $marketItem = $market->GetItem($i);
  $previousItemID = 0;
  while(isset($marketItem))
  {
    if (isset($_GET['itemname']) && $_GET['itemname'] != '' && strpos($marketItem->GetName(), $_GET['itemname']) === false) 
    {
      ++$i;
      $marketItem = $market->GetItem($i);
      continue;
    }
    if (isset($_GET['itemcategory']) && $_GET['itemcategory'] != 0 && $_GET['itemcategory'] != $marketItem->GetCategory()) 
    {
      ++$i;
      $marketItem = $market->GetItem($i);
      continue;
    }
    if($marketItem->GetStatsID() == $previousItemID)
    {
      ++$i;
      $marketItem = $market->GetItem($i);
      continue;
    }
    $previousItemID = $marketItem->GetStatsID();
    $marketItem->SetStatsType(0);
    ?>
  <tr>
    <td class="borderT" style ="boxSchatten" align="center"> 
      <div style="width:50px; height:50px; position:relative; top:0px; left:-25px;">
        <?php if($marketItem->HasOverlay())
        {
          ?>
        <img class="boxSchatten borderT borderR borderL borderB" src="img/items/<?php echo $marketItem->GetOverlay(); ?>.png" style="width:50px;height:50px; position:absolute; z-index:1;"> 
          <?php
        }
        ?>
        <img class="boxSchatten borderT borderR borderL borderB" src="img/items/<?php echo $marketItem->GetImage(); ?>.png" style="width:50px;height:50px; position:absolute; z-index:0;"> 
      </div>
      <input type="hidden" name="id" value="<?php echo $i; ?>">
    </td>
    <td class="borderT" style ="boxSchatten" align="center"> <b><?php echo $marketItem->GetOriginalName(); ?></b> </td>
        <td class="borderT" style ="boxSchatten" align="center"><?php 
      echo $marketItem->DisplayEffect(); 
      if($marketItem->GetLevel() != 0) echo 'Benötigt Level '.$marketItem->GetLevel();  ?> </td>
    <td class="borderT" style ="boxSchatten"> 
      <button onclick="OpenPopupPage('Item Betrachten','market/look.php?item=<?php echo $marketItem->GetStatsID(); if(isset($_GET['itemname'])) echo '&itemname='.$_GET['itemname']; if(isset($_GET['itemcategory'])) echo '&itemcategory='.$_GET['itemcategory']; ?>')">
      Betrachten
      </button>
    </td>
    </form>
  </tr>
    <?php
    ++$i;
    $marketItem = $market->GetItem($i);
  }
  ?>
</table>
<div class="spacer"></div>