<?php
if(!isset($fight) || $fight->IsEnded())
{
  include_once 'main.php';
}
else
{
?>
<!-- Team Anfang -->
<center>
<div class="spacer"></div>
<?php
$id = 1;
while(isset($teams[$id]))
{
  ShowTeam($teams[$id], $id, $pFighter, $fight);
  $id += 2;
}
?>
</center>
<!-- Team Ende -->
<?php
}
?>