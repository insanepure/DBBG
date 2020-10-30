<div class="spacer"></div>
<?php
if ($player->IsLogged())
{
if($player->GetArank() >= 2)
{
?>
  <div class="newseditbox1 smallBG borderR borderL borderT borderB">
    <div class="SideMenuKat catGradient borderB">
      <div class="schatten">News Erstellen</div>
    </div>
    <div class="spacer"></div>
    <div class="newseditbetreff">
    </div>
    <div class="spacer"></div>
    <div class="newsedittext"> </div>
    <div class="spacer"></div>
    <div class="newseditbetreff">
    </div>
    <div class="spacer"></div>
  </div>
  <div class="spacer"></div>
  <div class="newseditbox1 smallBG borderR borderL borderT borderB">
    <div class="SideMenuKat catGradient borderB">
      <div class="schatten">News Verlauf</div>
    </div>
    <div class="spacer"></div>
<table class ="schatten" width="100%" cellspacing="0" border="0" style="text-align: center;" >
  <tr>
    <td colspan=6 height="20px">
    </td>
  </tr>
  <tr>
    <td width="16%"><b>Autor</b></td>
    <td width="20%"><b>Datum</b></td>
    <td width="20%"><b>Betreff</b></td>
    <td width="16%"><b>Option 1</b></td>
    <td width="16%"><b>Option 2</b></td>
  </tr>
  <tr>
    <td width="16%">Madusanka2013</td>
    <td width="20%">16.12.2017 15:37</td>
    <td width="20%">Test</td>
    <td width="16%">Bearbeiten</td> 
    <td width="16%">Löschen</td>
  </tr>
</table>
  </div>

  <?php
}
}
?>