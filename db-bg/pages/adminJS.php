<?php
include_once '../classes/header.php';
include_once '../classes/npc/npc.php';
$npcs = null;
if(isset($_GET['table']) && isset($_GET['delete']))
{
  ?><a onclick="RemoveTableRow(this)">X</a><?php
}
else if(isset($_GET['table']) && $_GET['table'] == 'playerinventory')
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
			<option value="<?php echo $entry['id']; ?>"><?php echo $entry['name'].'('.$entry['id'].')'; ?></option>
			<?php
			++$id;
			$entry = $items->GetEntry($id);
		}
		?>
		</select><?php
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
else if(isset($_GET['table']) && ($_GET['table'] == 'attacks' || $_GET['table'] == 'fightattacks' || $_GET['table'] == 'learnableattacks' || $_GET['table'] == 'needattacks' || $_GET['table'] == 'playerattack'))
{
  $row = $_GET['row'];
  if($_GET['cell'] == 0)
  {
		?>
		<select class="select" name="<?php echo $_GET['table']; ?>[<?php echo $row; ?>]" style="width:400px;" onchange="ChangeEdit('attackedit<?php echo $row; ?>', '?p=admin&a=see&table=attacks&id=', this)">
			<option value="0">Keine Attacke(0)</option>
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
			<option value="<?php echo $entry['id']; ?>"><?php echo $entry['name'].'('.$entry['id'].')'; ?></option>
			<?php
			++$id;
			$entry = $attacks->GetEntry($id);
		}
		?>
		</select>
	<?php
	}
  else if($_GET['cell'] == 1)
  {
		?>
    <a id="attackedit<?php echo $row; ?>" href="?p=admin&a=see&table=attacks" target="_blank">Bearbeiten</a>
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
			<option value="0">Kein Item(0)</option>
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
			<option value="<?php echo $entry['id']; ?>"><?php echo $entry['name'].'('.$entry['id'].')'; ?></option>
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
else if(isset($_GET['table']) && $_GET['table'] == 'attackpassives')
{
  $row = $_GET['row'];
  if($_GET['cell'] == 0)
  {
		?>
		<select class="select" name="attack_passives[<?php echo $i; ?>]" style="width:300px;">
		<?php
		if($passiveList == null)
		{
			$passiveList = new Generallist($database, 'passives', '*', '', '', 99999999999, 'ASC');
		}
		$id = 0;
		$entry = $passiveList->GetEntry($id);
		while($entry != null)
		{
		?>
			<option value="<?php echo $entry['id']; ?>"> <?php echo $entry['name'].'('.$entry['id'].')'; ?></option>
			<?php
			++$id;
			$entry = $passiveList->GetEntry($id);
		}
		?>
		</select>
		<?php
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
			<option value="<?php echo $entry['id']; ?>"> <?php echo $entry['name'].'('.$entry['id'].')'; ?></option>
			<?php
			++$id;
			$entry = $patternList->GetEntry($id);
		}
		?>
		</select>
		<?php
	}
  else if($_GET['cell'] == 1)
  {
		?>
   <a id="patternEdit<?php echo $row; ?>" href="?p=admin&a=see&table=patterns" target="_blank">Bearbeiten</a>
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
			<option value="<?php echo $entry['id']; ?>"> <?php echo $entry['name'].'('.$entry['id'].')'; ?></option>
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
			<option value="<?php echo $entry['id']; ?>"><?php echo $entry['name'].'('.$entry['id'].')'; ?></option>
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
			<option value="<?php echo $entry['id']; ?>"><?php echo $entry['name'].'('.$entry['id'].')'; ?></option>
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
else if(isset($_GET['table']) && ($_GET['table'] == 'supportnpcs' || $_GET['table'] == 'npcs' || $_GET['table'] == 'trainers' ))
{
  $row = $_GET['row'];
  if($_GET['cell'] == 0)
  {
    ?>
    <select class="select" name="<?php echo $_GET['table'] ?>[]" style="width:400px;">
    <?php 
    if($npcs == null)
    {
      $npcs = new Generallist($database, 'npcs', '*', '', '', 99999999999, 'ASC');
    }
    $id = 0;
    $entry = $npcs->GetEntry($id);
    while($entry != null)
    {
      ?>
      <option value="<?php echo $entry['id']; ?>"><?php echo $entry['name'].'('.$entry['id'].')'; ?></option>
      <?php
      ++$id;
      $entry = $npcs->GetEntry($id);
    }
    ?>
    </select>
    <?php
  }
}
else if(isset($_GET['table']) && substr($_GET['table'], 0, 9) == 'eventnpcs')
{
  $roundRow = substr($_GET['table'], 10, -1);
  $row = $_GET['row'];
  if($_GET['cell'] == 0)
  {
    ?>
    <select class="select" name="event_npcs[<?php echo $roundRow; ?>][]" style="width:400px;">
    <?php 
    if($npcs == null)
    {
      $npcs = new Generallist($database, 'npcs', '*', '', '', 99999999999, 'ASC');
    }
    $id = 0;
    $entry = $npcs->GetEntry($id);
    while($entry != null)
    {
      ?>
      <option value="<?php echo $entry['id']; ?>"><?php echo $entry['name'].'('.$entry['id'].')'; ?></option>
      <?php
      ++$id;
      $entry = $npcs->GetEntry($id);
    }
    ?>
    </select>
    <?php
  }
}
else if(isset($_GET['table']) && $_GET['table'] == 'eventrounds')
{
  $row = $_GET['row']+1;
  if($_GET['cell'] == 0)
  {
    ?>
    <td width="15%">Runde <?php echo $row+1; ?></td>
    <?php
  }
  else if($_GET['cell'] == 1)
  {
    ?>
      <table width="100%" cellspacing="0" id="eventnpcs[<?php echo $row; ?>]">
        <tr><td width="80%">
          <select class="select" name="event_npcs[<?php echo $row; ?>][0]" style="width:400px;">
          <?php 
          if($npcs == null)
          {
            $npcs = new Generallist($database, 'npcs', '*', '', '', 99999999999, 'ASC');
          }
          $id = 0;
          $entry = $npcs->GetEntry($id);
          while($entry != null)
          {
            ?>
          <option value="<?php echo $entry['id']; ?>"><?php echo $entry['name'].'('.$entry['id'].')'; ?></option>
            <?php
          ++$id;
          $entry = $npcs->GetEntry($id);
          }
          ?>
          </select>
        </td>
        <td><a onclick="RemoveTableRow(this)">X</a></td>
        </tr>
      </table>
      <br/>
      <a onclick="AddTableRow('eventnpcs[<?php echo $row; ?>]', 1)">NPC hinzufügen</a><br/><br/>
      <input type="checkbox" name="event_fhealing[<?php echo $row; ?>]" checked> Healing</br> 
      <input type="number" name="event_survivalteam[<?php echo $row; ?>]" value="0" style="width:50px"> SurvivalTeam</br> 
      <input type="number" name="event_survivalrounds[<?php echo $row; ?>]" value="0" style="width:50px"> SurvivalRounds</br> 
      <input type="number" name="event_survivalwinner[<?php echo $row; ?>]" value="0" style="width:50px"> SurvivalWinner</br> 
      <input type="number" name="event_healthratio[<?php echo $row; ?>]" value="0" style="width:50px"> HealthRatio</br> 
      <input type="number" name="event_healthratioteam[<?php echo $row; ?>]" value="0" style="width:50px"> HealthRatioTeam</br> 
      <input type="number" name="event_healthratiowinner[<?php echo $row; ?>]" value="0" style="width:50px"> HealthRatioWinner</br> 
    <?php
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