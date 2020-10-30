<?php
include_once '../classes/header.php';
include_once '../classes/npc/npc.php';
$npcs = null;
if(isset($_GET['table']) && $_GET['table'] == 'playerinventory')
{
  $row = $_GET['row'];
  if($_GET['cell'] == 0)
  {
		?>
		<select class="select" name="player_item[<?php echo $row; ?>]" style="width:300px;">
		<?php
		if($items == null)
		{
			$items = new Generallist($database, 'items', '*', '', '', 99999999999, 'ASC');
		}
		$id = 0;
		$entry = $items->GetEntry($id);
		while($entry != null)
		{
		?>
			<option value="<?php echo $entry['id']; ?>">(<?php echo $entry['id']; ?>) <?php echo $entry['name']; ?></option>
			<?php
			++$id;
			$entry = $items->GetEntry($id);
		}
		?>
		</select
			><?php
	}
  else if($_GET['cell'] == 1)
  {
		?><input type="text" name="player_itemamount[<?php echo $row; ?>]" value="0" style="width:70px"><?php
  }
  else if($_GET['cell'] == 2)
  {
		?>
		<select class="select" name="player_itemslot[<?php echo $row; ?>]" style="width:100px;">
			<option value="0">Kein</option>
			<option value="1">Kopf</option>
			<option value="2">Hand</option>
			<option value="3">Hose</option>
			<option value="4">Upgrade</option>
			<option value="5">Brust</option>
			<option value="6">Waffe</option>
			<option value="7">Schuhe</option>
		</select>
<?php
  }
  else if($_GET['cell'] == 3)
  {
		?>
		<td><input type="text" name="player_itemtime[<?php echo $row; ?>]" value="0" style="width:70px"></td>
<?php
  }
}
else if(isset($_GET['table']) && $_GET['table'] == 'needattacks')
{
  $row = $_GET['row'];
  if($_GET['cell'] == 0)
  {
		?>
		<select class="select" name="needattacks[<?php echo $i; ?>]" style="width:400px;">
			<option value="0">(0) Keine Attacke</option>
		<?php

		if($attacks == null)
		{
			$attacks = new Generallist($database, 'attacks', '*', '', '', 99999999999, 'ASC');
		}
		$id = 0;
		$entry = $attacks->GetEntry($id);
		while($entry != null)
		{
		?>
			<option value="<?php echo $entry['id']; ?>">(<?php echo $entry['id']; ?>) <?php echo $entry['name']; ?></option>
			<?php
			++$id;
			$entry = $attacks->GetEntry($id);
		}
		?>
		</select>
	<?php
	}
}
else if(isset($_GET['table']) && $_GET['table'] == 'eventitems')
{
  $row = $_GET['row'];
  if($_GET['cell'] == 0)
  {
		?>
		<select class="select" name="event_items[<?php echo $i; ?>]" style="width:400px;">
			<option value="0">(0) Kein Item</option>
		<?php

		if($items == null)
		{
			$items = new Generallist($database, 'items', '*', '', '', 99999999999, 'ASC');
		}
		$id = 0;
		$entry = $items->GetEntry($id);
		while($entry != null)
		{
		?>
			<option value="<?php echo $entry['id']; ?>">(<?php echo $entry['id']; ?>) <?php echo $entry['name']; ?></option>
			<?php
			++$id;
			$entry = $items->GetEntry($id);
		}
		?>
		</select>
	<?php
	}
  else if($_GET['cell'] == 1)
  {
		?><input type="text" name="npcandstoryitems_itemchance[<?php echo $row; ?>]" value="0" style="width:70px"><?php
  }
}
else if(isset($_GET['table']) && $_GET['table'] == 'fighterpatterns')
{
  $row = $_GET['row'];
  if($_GET['cell'] == 0)
  {
		?>
		<select class="select" name="fighter_patterns[<?php echo $i; ?>]" style="width:300px;">
		<?php
		if($patternList == null)
		{
			$patternList = new Generallist($database, 'patterns', '*', '', '', 99999999999, 'ASC');
		}
		$id = 0;
		$entry = $patternList->GetEntry($id);
		while($entry != null)
		{
		?>
			<option value="<?php echo $entry['id']; ?>"> <?php echo '('.$entry['id'].') '.$entry['name']; ?></option>
			<?php
			++$id;
			$entry = $patternList->GetEntry($id);
		}
		?>
		</select>
		<?php
	}
}
else if(isset($_GET['table']) && $_GET['table'] == 'playertitels')
{
  $row = $_GET['row'];
  if($_GET['cell'] == 0)
  {
		?>
		<select class="select" name="player_titel[<?php echo $i; ?>]" style="width:300px;">
		<?php
		if($titelList == null)
		{
			$titelList = new Generallist($database, 'titel', '*', '', '', 99999999999, 'ASC');
		}
		$id = 0;
		$entry = $titelList->GetEntry($id);
		while($entry != null)
		{
		?>
			<option value="<?php echo $entry['id']; ?>"> <?php echo '('.$entry['id'].') '.$entry['name']; ?></option>
			<?php
			++$id;
			$entry = $titelList->GetEntry($id);
		}
		?>
		</select>
		<?php
	}
}
else if(isset($_GET['table']) && $_GET['table'] == 'multiaccs')
{
  $row = $_GET['row'];
  if($_GET['cell'] == 0)
  {
		?>
		<select class="select" name="multi_accs[<?php echo $i; ?>]" style="width:300px;">
		<?php
		if($accounts == null)
		{
			$accounts = new Generallist($database, 'accounts', '*', '', '', 99999999999, 'ASC');
		}
		$id = 0;
		$entry = $accounts->GetEntry($id);
		while($entry != null)
		{
		?>
			<option value="<?php echo $entry['name']; ?>"> <?php echo $entry['name']; ?></option>
			<?php
			++$id;
			$entry = $accounts->GetEntry($id);
		}
		?>
		</select>
		<?php
	}
  else if($_GET['cell'] == 1)
  {
		?><input type="text" name="npcandstoryitems_itemchance[<?php echo $row; ?>]" value="0" style="width:70px"><?php
  }
}
else if(isset($_GET['table']) && $_GET['table'] == 'npcandstoryitems')
{
  $row = $_GET['row'];
  if($_GET['cell'] == 0)
  {
		?>
		<select class="select" name="npcandstoryitems_item[<?php echo $row; ?>]" style="width:300px;">
		<?php
		if($items == null)
		{
			$items = new Generallist($database, 'items', '*', '', '', 99999999999, 'ASC');
		}
		$id = 0;
		$entry = $items->GetEntry($id);
		while($entry != null)
		{
		?>
			<option value="<?php echo $entry['id']; ?>">(<?php echo $entry['id']; ?>) <?php echo $entry['name']; ?></option>
			<?php
			++$id;
			$entry = $items->GetEntry($id);
		}
		?>
		</select>
			<?php
	}
  else if($_GET['cell'] == 1)
  {
		?><input type="text" name="npcandstoryitems_itemchance[<?php echo $row; ?>]" value="0" style="width:70px"><?php
  }
}
else if(isset($_GET['table']) && $_GET['table'] == 'amountitems')
{
  $row = $_GET['row'];
  if($_GET['cell'] == 0)
  {
		?>
		<select class="select" name="amountitems_item[<?php echo $row; ?>]" style="width:300px;">
		<?php
		if($items == null)
		{
			$items = new Generallist($database, 'items', '*', '', '', 99999999999, 'ASC');
		}
		$id = 0;
		$entry = $items->GetEntry($id);
		while($entry != null)
		{
		?>
			<option value="<?php echo $entry['id']; ?>">(<?php echo $entry['id']; ?>) <?php echo $entry['name']; ?></option>
			<?php
			++$id;
			$entry = $items->GetEntry($id);
		}
		?>
		</select>
			<?php
	}
  else if($_GET['cell'] == 1)
  {
		?><input type="text" name="amountitems_amount[<?php echo $row; ?>]" value="0" style="width:70px"><?php
  }
}
else if(isset($_GET['table']) && $_GET['table'] == 'eventfights')
{
  $row = $_GET['row'];
  if($_GET['cell'] == 0)
  {
    if($npcs == null)
    {
      $npcs = new Generallist($database, 'npcs', '*', '', '', 99999999999, 'ASC');
    }
    $id = 0;
    $entry = $npcs->GetEntry($id);
    while($entry != null)
    {
      ?>
    <div style="height:60px; width:40px; display: inline-block;">
      <img width="40px" height="40px" src="img/npc/<?php echo $entry['image']; ?>.png" class="attack"></img> 
      <input type="checkbox" name="event_npcs[<?php echo $row; ?>][]" value="<?php echo $entry['id']; ?>">
      </div>
      <?php
    ++$id;
    $entry = $npcs->GetEntry($id);
    }
  }
  else if($_GET['cell'] == 1)
  {
		?><input type="checkbox" name="event_fhealing[<?php echo $row; ?>]" ><?php
  }
  else if($_GET['cell'] == 2)
  {
		?><input type="text" name="event_survivalteam[<?php echo $row; ?>]" value="0" style="width:70px"><?php
  }
  else if($_GET['cell'] == 3)
  {
		?><input type="text" name="event_survivalrounds[<?php echo $row; ?>]" value="0" style="width:70px"><?php
  }
  else if($_GET['cell'] == 4)
  {
		?><input type="text" name="event_survivalwinner[<?php echo $row; ?>]" value="0" style="width:70px"><?php
  }
  else if($_GET['cell'] == 5)
  {
		?><input type="text" name="event_healthratio[<?php echo $row; ?>]" value="0" style="width:70px"><?php
  }
  else if($_GET['cell'] == 6)
  {
		?><input type="text" name="event_healthratioteam[<?php echo $row; ?>]" value="0" style="width:70px"><?php
  }
  else if($_GET['cell'] == 7)
  {
		?><input type="text" name="event_healthratiowinner[<?php echo $row; ?>]" value="0" style="width:70px"><?php
  }
}
?>