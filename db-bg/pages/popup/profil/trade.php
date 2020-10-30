<?php
/*php
include_once $_SERVER['DOCUMENT_ROOT'].'../../main/www/classes/session.php';
include_once '../../../classes/header.php';
if(!isset($_GET['id']) || !is_numeric($_GET['id']))
{
  exit();
}
include_once '../../../classes/items/itemmanager.php';
$itemManager = new ItemManager($database);
$inventory = $player->GetInventory();

if($_GET['id'] == $player->GetID())
{
  echo 'Du kannst dir nichts selbst schenken.';
  exit();
}
?>
<form method="POST" action="?p=profil&id=<?php echo $_GET['id']; ?>&a=trade">
    <select style="height:30px;" name="item" class="select">
          <option value="0">Zeni</option>
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
    <input type="text" name="amount" placeholder="0">
  <input type="submit" value="Schenken">
</form>
*/
?>