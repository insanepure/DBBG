<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'../../main/www/classes/session.php';
  include_once '../../../classes/header.php';
?>
<div class="spacer2"></div>
<div class="mutonbox">
  <div class="muton"></div>
  <div class="muton2">
    <form action="?p=profil&a=stats" method="post">
    <table width="100%" cellspacing="0" border="0">
      <tr>
        <td colspan=6 height="20px" align="center">
            <h2>Skillpunkte: <span id="totalStats"><?php echo $player->GetStats(); ?></span></h2>
        </td>
      </tr>
      <tr>
        <td width="25%" align="center">
          <b>LP:</b>
        </td>
        <td width="25%" align="center">
           <Button type="button" onclick="statsDecrease('lp');"><</Button>
        </td>
        <td width="25%" align="center">
          <input type="number" id="lp" name="lp" value="0" min="0" style="width:80%;" onkeyup="statsChanged('lp');" onChange="statsChanged('lp');">
        </td>
        <td width="25%" align="center">
           <Button type="button" onclick="statsIncrease('lp');">></Button>
        </td>
      </tr>
      <tr>
        <td width="25%" align="center">
          <b>KP:</b>
        </td>
        <td width="25%" align="center">
           <Button type="button" onclick="statsDecrease('kp');"><</Button>
        </td>
        <td width="25%" align="center">
          <input type="number" id="kp" name="kp" value="0" min="0" style="width:80%;" onkeyup="statsChanged('kp');" onChange="statsChanged('kp');">
        </td>
        <td width="25%" align="center">
           <Button type="button" onclick="statsIncrease('kp');">></Button>
        </td>
      </tr>
      <tr>
        <td width="25%" align="center">
          <b>Angriff:</b>
        </td>
        <td width="25%" align="center">
           <Button type="button" onclick="statsDecrease('attack');"><</Button>
        </td>
        <td width="25%" align="center">
          <input type="number" id="attack" name="attack" value="0" min="0" style="width:80%;" onkeyup="statsChanged('attack');" onChange="statsChanged('attack');">
        </td>
        <td width="25%" align="center">
           <Button type="button" onclick="statsIncrease('attack');">></Button>
        </td>
      </tr>
      <tr>
        <td width="25%" align="center">
          <b>Abwehr:</b>
        </td>
        <td width="25%" align="center">
           <Button type="button" onclick="statsDecrease('defense');"><</Button>
        </td>
        <td width="25%" align="center">
          <input type="number" id="defense" name="defense" value="0" min="0" style="width:80%;" onkeyup="statsChanged('defense');" onChange="statsChanged('defense');">
        </td>
        <td width="25%" align="center">
           <Button type="button" onclick="statsIncrease('defense');">></Button>
        </td>
      </tr>
      <tr>
        <td colspan=2 height="20px" align="center">
          <div class="spacer"></div>
          <input type="submit" value="Benutzen">
          </form>
        </td>
        <td colspan=4 height="20px" align="center">
          <div class="spacer"></div>
          <form action="?p=profil&a=statspopup" method="post">
            <input type="submit" type="button" value="Popup schließen">
          </form>
        </td>
      </tr>
    </table>
  </div>
</div>
<div class="spacer2"></div>