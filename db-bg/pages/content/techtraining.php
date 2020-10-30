<div class="spacer"></div>
<?php
  if($place->GetLearnableAttacks() != '')
	{
    ?>
<table width="100%" cellspacing="0" class="boxSchatten">
  <tr>
    <td class="catGradient borderB borderT borderR borderL" colspan="9" align="center"><b>Training</b></td>
  </tr>
  <tr>
    <td width="20%" class="borderL" align="center"><b>Bild</b></td>
    <td width="20%" align="center"><b>Name</b></td>
    <td width="10%" align="center"><b>Typ</b></td>
    <td width="5%" align="center"><b>Stärke</b></td>
    <td width="5%" align="center"><b>Genauigkeit</b></td>
    <td width="10%" align="center"><b>Kosten</b></td>
		<td width="10%" align="center"><b>Dauer</b></td>
    <td width="20%" align="center"><b>Voraussetzung</b></td>
    <td width="10%" class="borderR" align="center"><b>Aktion</b></td>
  </tr>
  <?php 
		$attacks = explode(';',$place->GetLearnableAttacks());

		$j = 0;
		while(isset($attacks[$j]))
		{
			$attack = $attackManager->GetAttack($attacks[$j]);
			?>
			<form method="POST" action="?p=techtraining&a=train&id=<?php echo $attack->GetID(); ?>">
			<tr>
			<td width="50px" class="borderL borderB" align="center">
				<img src="<?php echo $attack->GetImage(); ?>" width="50px" height="50px"></img>
				</div> 
			</td>
			<td align="center" class="borderB"><?php echo $attack->GetName(); ?></td>
			<td align="center" class="borderB"><?php echo Attack::GetTypeName($attack->GetType()); ?></td>
			<td align="center" class="borderB"><?php echo $attack->GetValue(); if($attack->IsProcentual()) echo '%'; ?></td>
			<td align="center" class="borderB"><?php echo $attack->GetAccuracy(); ?>%</td>
			<td align="center" class="borderB">
				<?php 
				if($attack->GetLP() != 0)
				{
					echo $attack->GetLP();
					if($attack->IsCostProcentual()) echo '%';
					echo ' LP';
				}
				if($attack->GetKP() != 0)
				{
					echo $attack->GetKP();
					if($attack->IsCostProcentual()) echo '%';
					echo ' KP';
				}
				?>
			</td>
      <td class="borderB" align="center"><?php echo $attack->GetLearnTime(); ?> Stunden</td>
			<td class="borderB" align="center">
		<?php
    if($attack->GetLevel() != 0) echo 'Level: '.$attack->GetLevel().'</br>';
	  if($attack->GetLearnKI() != 0) echo 'KI: '.$attack->GetLearnKI().'<br/>'; 
		if($attack->GetLearnLP() != 0) echo 'LP: '.$attack->GetLearnLP().'<br/>'; 
		if($attack->GetLearnKP() != 0) echo 'KP: '.$attack->GetLearnKP().'<br/>'; 
		if($attack->GetLearnAttack() != 0) echo 'Attack: '.$attack->GetLearnAttack().'<br/>'; 
		if($attack->GetLearnDefense() != 0) echo 'Defense: '.$attack->GetLearnDefense().'<br/>'; 
     

		?>
		</td>
			<td class="borderR borderB" align="center"><input type="submit" value="Start"/></td>
			</tr>
			</form>
			<?php
			++$j;
		}
  ?>
</table>
<?php
  }
else
{
  ?>
  Du kannst hier nichts lernen.
  <?php
}
?>