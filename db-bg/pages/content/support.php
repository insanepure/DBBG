<?php
function displaySupport($database, $titel)
{
  $players = new Generallist($database, 'accounts', 'id, name, titel, charimage', 'titel='.$titel, 'id', 10);
  $id = 0;
  $entry = $players->GetEntry($id);
  while($entry != null)
  {
    ?>
    <td align="center">
        <div class="SideMenuContainer borderT borderL borderB borderR">
          <div class="SideMenuKat catGradient borderB">
            <div class="schatten">
              <?php echo $entry['name']; ?>
            </div>
          </div>
          <div class="SideMenuInfo">
            <div class="char_main">
              <div class="char_image smallBG borderT borderB borderR borderL">
                <a href="?p=profil&id=<?php echo $entry['id']; ?>">
              <img src="<?php echo $entry['charimage']; ?>" width="100%" height="100%"></img>
                </a>
              </div>
            </div>
          </div>
        </div>
    </td>
    <?php
    ++$id;
    $entry = $players->GetEntry($id);
  }
}
?>

<h2>
  Support
</h2>

Falls du Hilfe im Spiel benötigst, so zögere nicht einen der Supporter privat anzuschreiben.<br/>

<hr>

<h3>
  Administratoren
</h3>
<table width="90%">
  <tr>
    <?php
    displaySupport($database, 1);
    ?>
  </tr>
</table>

<hr>

<h3>
  Moderatoren
</h3>
<table width="90%">
  <tr>
    <?php
    displaySupport($database, 3);
    ?>
  </tr>
</table>


<hr>

<h3>
  Artists
</h3>
<table width="90%">
  <tr>
    <?php
    displaySupport($database, 4);
    ?>
  </tr>
</table>

<hr>

<h3>
  Writer
</h3>
<table width="90%">
  <tr>
    <?php
    displaySupport($database, 593);
    ?>
  </tr>
</table>

<hr>

<h3>
  Balancer
</h3>
<table width="90%">
  <tr>
    <?php
    displaySupport($database, 610);
    ?>
  </tr>
</table>

<hr>

<h3>
  Integrator
</h3>
<table width="90%">
  <tr>
    <?php
    displaySupport($database, 2);
    ?>
  </tr>
</table>