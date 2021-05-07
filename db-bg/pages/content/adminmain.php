<div class="spacer"></div>
<div  class="catGradient borderT borderB" style="width:90%;">
<h2>System Main Menu</h2>
</div>
<div class="spacer"></div>
<?php
if($player->GetArank() >= 2) {

  if(!isset($_GET['table']))
  {
    ?>
    <table width="90%">
    <?php
    $i = 0;
    $result = $accountDB->ShowTables();
    while($tableName = mysqli_fetch_row($result))
    {
      if($player->GetArank() < 3 && !in_array($tableName[0], $limitedTables))
      {
        continue;
      }
      
      
      if($i % 2 == 0)
      {
        ?><tr><?php
      }
        $table = $tableName[0];
      ?>
      <td width="50%" height="25px" align="center"><a href="?p=adminmain&table=<?php echo $table; ?>"><input type="submit" value="<?php echo $table; ?>" style="width:150px;"></a></td>
      <?php
      if($i % 2 == 1)
      {
      ?></tr><?php
      }
      ++$i;
    }
    $result->Close();
    ?>
    </table>
    <?php
  }
  else if($player->GetArank() < 3 && !in_array($_GET['table'], $limitedTables))
  {
    ?>Diese Tabelle ist nicht verfügbar.<br/><?php
  }
  else if(isset($_GET['a']) && $_GET['a'] == 'see')
  {
    $attacks = null;
    $npcs = null;
    $items = null;
    $actions = null;
    $places = null;

    $table = $_GET['table'];
    $id = 0;
    $where = '';
    if(isset($_GET['id']))
    {
      $id = $_GET['id'];
      $where = 'id="'.$id.'"';
    }
    echo '<h3>' ,$table, '</h3>';
    $result = $accountDB->Select('*', $table, $where);
    /* Get field information for all columns */
    $finfo = $result->fetch_fields();
    $row = $result->fetch_assoc();

    $action = '?p=adminmain&table='.$table.'&a=edit';
    ?>
    <form method="POST" action="<?php echo $action; ?>">
    <table width="100%">
    <?php
    foreach ($finfo as $val) 
    {
      $name = $val->name;
      $type = $val->type;
      $value = '';
      if($id != 0 && isset($row[$name]))
      {
        $value = $row[$name];
      }
      ?>
      <tr><td>
        <fieldset>
          <legend><b><?php echo $name; ?></b></legend>
         <table width="100%"><tr><td align="center">
         <?php
          switch($type)
          {
            case 1: //tinyint
              ?><input type="checkbox"  name="<?php echo $name; ?>" <?php if($value == 1) echo 'checked'; ?>><?php
              break;
            case 3: //int
              ?><input type="number" name="<?php echo $name; ?>" value="<?php echo $value; ?>" style="width:400px"><?php
              break;
            case 4: //float
              ?><input type="number" name="<?php echo $name; ?>" value="<?php echo $value; ?>" step="0.01" style="width:400px"><?php
              break;
            case 253: //varchar
              ?><input type="text" name="<?php echo $name; ?>" value="<?php echo $value; ?>" style="width:400px"><?php
              break;
            case 252: //longtext
          ?><textarea name="<?php echo $name; ?>" style="width:400px; height:100px;"><?php echo $value; ?></textarea><?php
              break;
            case 12: //Datum
              ?><input type="datetime-local" name="<?php echo $name; ?>" value="<?php echo date('Y-m-d\TH:i', strtotime($value)); ?>" style="width:400px"><?php
              break;
            case 10: //Datum
              ?><input type="date" name="<?php echo $name; ?>" value="<?php echo $value; ?>" style="width:400px"><?php
              break;
          }
        ?>
  </td></tr>
         </table>
</fieldset></td></tr>
      <?php
    }
    ?>
    </table>
    <input type="submit" value="ändern">
    </form>
    <?php
    $result->Close();
  }
  else
  {
    $table = $_GET['table'];
    ?>
  <div class="spacer"></div>
      <hr>
<h2>
  Bearbeiten
</h2>
Wenn du das ID Feld leer lässt, dann wird mit den Werten ein neuer Eintrag erstellt.<br/>
<br/>
    <form method="GET" action="?p=adminmain">
      <input type="hidden" name="p" value="adminmain">
      <input type="hidden" name="a" value="see">
      <input type="hidden" name="table" value="<?php echo $table; ?>">
      <select class="select" name="id">
      <?php
      $result = $accountDB->Select('*',$table,'',999999, 'id', 'DESC');
      if ($result) 
      {
        if ($result->num_rows > 0)
        {
          while($row = $result->fetch_assoc()) 
          {
            $pid = (isset($row['id']))?$row['id']:$row['ID'];
            ?>
            <option value="<?php echo $pid; ?>">
              
            <?php
            if(isset($row['name'])) echo $row['name'];
            if(isset($row['login'])) echo $row['login'];
            if(isset($row['survey'])) echo ' | Survey: '.$row['survey'].'';
            echo ' | ['.$pid.']';
            ?>
            </option>
            <?php
          }
        }
        $result->close();

      }
      ?>
      </select>
      <br/><br/>
      <input type="submit" value="Bearbeiten">
  </form>
  <br/>
  <br/>
      <hr>
<h2>
  Löschen
</h2>
  Du solltest nur Einträge löschen, wenn diese wirklich nicht mehr benötigt werden!<br/>
  Dies kann nämlich zu Problemen führen, wenn der Eintrag in einer anderen Tabelle genutzt wird.<br/>
<br/>
  Man kann auch nicht mehr benötigte Einträge später auf die Werte eines neuen Eintrages anpassen, statt einen neuen Eintrag zu nutzen.<br/>
<br/>
    <form method="POST" action="?p=adminmain&a=delete&table=<?php echo $table; ?>">
      <select class="select" name="id">
      <?php
      $result = $accountDB->Select('*',$table,'',999999);
      if ($result) 
      {
        if ($result->num_rows > 0)
        {
          while($row = $result->fetch_assoc()) 
          {
            $pid = (isset($row['id']))?$row['id']:$row['ID'];
            ?>
            <option value="<?php echo $pid; ?>">
            <?php
            if(isset($row['name'])) echo $row['name'];
            echo ' | ['.$pid.']';
            ?>
            </option>
            <?php
          }
        }
        $result->close();

      }
      ?>
      </select>
      <br/><br/>
      <input type="checkbox" name="sure"> Sicher?
      <br/>
      <br/>
      <input type="submit" value="Löschen">
  </form>
<br/>
      <hr>
<h2>
  Erstellen
</h2>
  Es wird nur ein neuer Eintrag erstellt, wenn das ID Feld leer ist.
<br/>
  <br/>
    <form method="GET" action="?p=adminmain">
      <input type="hidden" name="p" value="adminmain">
      <input type="hidden" name="a" value="see">
      <input type="hidden" name="table" value="<?php echo $table; ?>">
      <input type="submit" value="Erstellen">
  </form>
  <?php
  }
}
?>