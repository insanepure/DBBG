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
      $ids = array();
      while(isset($item))
      {
        if($item->GetSlot() == null)
        {
          $itemData = $itemManager->GetItem($item->GetID());
          $item = $inventory->GetItem($i);
          if(!in_array($itemData->GetID(),$ids) && $itemData->IsSellable())
          {
            array_push($ids, $itemData->GetID());
            ?>
            <option value="<?php echo $itemData->GetID(); ?>"><?php echo $itemData->GetName(); ?></option>
            <?php
          }
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
    <td width="15%"  align="center"><b> Wirkung </b></td>
    <td width="15%"  align="center"><b> Besitzer </b></td>
    <td width="15%"  align="center"><b> Preis </b></td>
    <td width="15%"  align="center"><b> Anzahl </b></td>
    <td width="15%"  align="center"><b> Aktion </b></td>
  </tr>
   <?php
  $i = 0;
  $marketItem = $market->GetItem($i);
  while(isset($marketItem))
  {
    $item = $itemManager->GetItem($marketItem->GetItemID());
    if (isset($_GET['itemname']) && $_GET['itemname'] != '' && strpos($item->GetName(), $_GET['itemname']) === false) 
    {
      ++$i;
      $marketItem = $market->GetItem($i);
      continue;
    }
    if (isset($_GET['itemcategory']) && $_GET['itemcategory'] != 0 && $_GET['itemcategory'] != $item->GetCategory()) 
    {
      ++$i;
      $marketItem = $market->GetItem($i);
      continue;
    }
    ?>
  <tr>
    <?php if($marketItem->GetSellerID() == $player->GetID())
    {
    ?>
       <form method="POST" action="?p=market&a=retake<?php if(isset($_GET['itemname'])) echo '&itemname='.$_GET['itemname']; if(isset($_GET['itemcategory'])) echo '&itemcategory='.$_GET['itemcategory']; ?>">
   <?php
    }
    else
    {
    ?>
      <form method="POST" action="?p=market&a=buy<?php if(isset($_GET['itemname'])) echo '&itemname='.$_GET['itemname']; if(isset($_GET['itemcategory'])) echo '&itemcategory='.$_GET['itemcategory']; ?>">
    <?php
    }
    ?>
    <td style ="boxSchatten" align="center"> 
      <img class="boxSchatten borderT borderR borderL borderB" src="img/items/<?php echo $item->GetImage(); ?>.png" style="width:50px;height:50px;"> 
      <input type="hidden" name="id" value="<?php echo $i; ?>">
    </td>
    <td style ="boxSchatten" align="center"> <b><?php echo $item->GetName(); ?></b> </td>
        <td style ="boxSchatten" align="center"><?php 
      echo $item->DisplayEffect(); 
      if($item->GetLevel() != 0) echo 'Benötigt Level '.$item->GetLevel();  ?> </td>
        <td style ="boxSchatten" align="center"> <a href="?p=profil&id=<?php echo $marketItem->GetSellerID(); ?>"><?php echo $marketItem->GetSeller(); ?></a></td>
    <td wstyle ="boxSchatten" align="center"> <?php echo $marketItem->GetPrice(); ?> Zeni </td>
    <td style ="boxSchatten" align="center">
      <select style="width:90%;" class="select" name="amount">
        <?php
        $j = 1;
        $amount = $marketItem->GetAmount();
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
      <?php if($marketItem->GetSellerID() == $player->GetID())
      {
      ?>
      <input type="submit" style="width:90%" value="Nehmen">
     <?php
      }
      else
      {
      ?>
      <input type="submit" name="buy" style="width:90%" value="Kaufen">
      <?php
	  if($player->GetARank() >= 2)
	  {
		  ?>
		  <div class="spacer"></div>
		 <input type="submit" name="delete" style="width:90%" value="Entfernen"> 
		  <?php
	  }
      }
      ?>
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