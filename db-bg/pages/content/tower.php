<div class="spacer"></div>
<div class="catGradient borderB borderT" style="width:500px">
  Turm
</div>
<div class="borderL borderR borderB" style="width:500px; text-align:left;">
  <img src="https://static.comicvine.com/uploads/original/11122/111225835/4810702-muscle%20tower.png" width="500px" height="400px"></img>
  <div class="spacer"></div>
  Etagen: <?php echo $totalFloors; ?>
  <div class="spacer"></div>
  <form method="POST" action="?p=tower&a=start">
    <?php
  $towerfloors = new Generallist($database, 'towerfloors', '*', '', '', 999999, 'ASC');
  ?>
  TestEtage: <select name="towerfloor" size="1">
  <option>Alle</option>
  <?php
    $id = 0;
    $entry = $towerfloors->GetEntry($id);
    while($entry != null)
    {
      $etage = $entry['id'];
      echo "<option>".$etage."</option>";
      ++$id;
      $entry = $towerfloors->GetEntry($id);
    }
  ?>
  </select><br/>
    <button>
      Beginnen
    </button>
</form>
</div>