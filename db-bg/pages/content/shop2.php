<table width="100%" cellspacing="0" border="0">
  <tr>
    <td colspan=3 height="20px">
    </td>
  </tr>
  <tr>
    <td colspan=3 class="catGradient borderT borderB" align="center">
      <b> <font color="white"><div class="schatten">Suchen</div></font> </b>
    </td>
  </tr>
  <tr style ="boxSchatten">
    <td width="40%"><b> Name </b></td>
    <td width="40%"><b> Kategorie </b></td>
    <td width="40%"><b> Aktion </b></td>
  </tr>
  <tr>
      <form method="GET" action="?p=shop">
        <input type="hidden" name="p" value="shop">
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
    <td colspan=6 height="20px">
    </td>
  </tr>
  <tr>
  <td colspan=6 class="catGradient borderT borderB" align="center">
      <b> <font color="white"><div class="schatten">Shop</div></font> </b>
    </td>
  </tr>
  <tr style ="boxSchatten">
    <td width="10%"  align="center"><b> Bild </b></td>
    <td width="20%"  align="center"><b> Name </b></td>
    <td width="30%"  align="center"><b> Wirkung </b></td>
    <td width="10%"  align="center"><b> Preis </b></td>
    <td width="10%"  align="center"><b> Anzahl </b></td>
    <td width="10%"  align="center"><b> Aktion </b></td>
  </tr>
  <?php
  $items = $place->GetItems();
  $i = 0;
  while(isset($items[$i]))
  {
    if($items[$i] == '')
    {
      ++$i;
      continue;
    }
    $item = $itemManager->GetItem($items[$i]);
    if($item == null)
    {
      echo 'Item: '.$items[$i].' not valid.<br/>';
      ++$i;
      continue;
    }
    if (isset($_GET['itemname']) && $_GET['itemname'] != '' && strpos($item->GetName(), $_GET['itemname']) === false) 
    {
      ++$i;
      continue;
    }
    if (isset($_GET['itemcategory']) && $_GET['itemcategory'] != 0 && $_GET['itemcategory'] != $item->GetCategory()) 
    {
      ++$i;
      continue;
    }
    
    if($item->GetNeedItem() != 0 && !$player->HasItem2($item->GetNeedItem()))
    {
      ++$i;
      continue;
    }
    ?>
  <tr>
      <form method="POST" action="?p=shop2&a=buy<?php if(isset($_GET['itemname'])) echo '&itemname='.$_GET['itemname']; if(isset($_GET['itemcategory'])) echo '&itemcategory='.$_GET['itemcategory']; ?>">
    <td style ="boxSchatten" align="center"> 
      <img class="boxSchatten borderT borderR borderL borderB" src="img/items/<?php echo $item->GetImage(); ?>.png" style="width:50px;height:50px;"> 
      <input type="hidden" name="item" value="<?php echo $item->GetID(); ?>">
    </td>
    <td style ="boxSchatten" align="center"> <b><?php echo $item->GetName(); ?></b> </td>
    <td style ="boxSchatten" align="center">
    <?php
    echo $item->DisplayEffect();
      if($item->GetLevel() != 0) echo 'Benötigt Level '.$item->GetLevel(); 
    ?>
    </td>
        
    <td style ="boxSchatten" align="center"> <?php echo $item->GetPrice(); ?> Zeni </td>
    <td style ="boxSchatten" align="center">
      <select style="width:90%;" class="select" name="amount">
        <?php
        $j = 1;
			  $amount = 99;
        while($j <= $amount)
        {
        ?>
        <option value="<?php echo $j; ?>"><?php echo $j; ?></option>
        <?php
        ++$j;
        }
        ?>
      </select>
    </td>
    <td style ="boxSchatten"> 
      <input type="submit" style="width:90%" value="Kaufen">
    </td>
    </form>
  </tr>
    <?php
    ++$i;
  }
  ?>
</table>
<div class="spacer"></div>