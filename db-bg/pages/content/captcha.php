<?php
$page = '?p=captcha&a=validate';
if(isset($_GET['page']))
{
	$page = $page.'&page='.$_GET['page'];
}
?>
<div class="spacer"></div>
<table width="98%" cellspacing="0" border="0" class="borderB borderR borderL">
  <tr>
    <td class="catGradient borderB borderT" colspan="2" align="center"><b>Bot Überprüfung</b></td>
  </tr>
  <tr>
	<td width="30%"><center><img src="https://vignette.wikia.nocookie.net/dragonball/images/0/00/Kami-sama_Anime.png/revision/latest?cb=20150828154620&path-prefix=de" alt="Dragonball Browsergame" height="300" width="250"> </center></td>
	<td width="80%"><center><b>Guten Tag.<br>Ich wurde dazu verdonnert immer wieder mal nach zu sehen ob ihr keine Bots zum Kämpfen nutzt.<br><br>Daher Löse bitte das Captcha um deinen Kampf weiter zu führen.<br><br>MFG<br>[DBBG]Gott<br><br><form method="POST" action="<?php echo $page; ?>">
  <div class="g-recaptcha" data-sitekey="6LfWD04UAAAAADy4lBQyoo634rwuGDMKEAuMDaGA"></div>
  <input type="submit" value="Absenden">
</form></b></center></td>
  </tr>
  </table>