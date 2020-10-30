<?php
  include_once '../../../classes/header.php';
?>
Willst du deine Aktion wirklich abbrechen?
<div class="spacer"></div>
<form method="post" action="<?php if(isset($_GET['p'])) echo '?p='.$_GET['p'];  ?>">
	<input type="hidden" name="a" value="cancelAction">
	<input type="submit" value="Abbrechen">
</form>
<div class="spacer"></div>