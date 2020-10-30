<center>
	<div class="spacer"></div>
	<?php
if ($player->IsLogged())
{
?>
		<div id="SideMenuBar" class="SideMenuBar" style="margin-left:0px;float:left;min-height:0px;">
			<div class="SideMenuContainer borderT borderL borderB borderR">
				<div class="SideMenuKat catGradient borderB">
					<div class="schatten">
						<?php echo $player->GetName(); ?>
					</div>
				</div>
				<div class="SideMenuInfo">
					<div class="char_main">
						<div class="char_image smallBG borderT borderB borderR borderL">
						<?php if($player->GetImage() == '')
						{
							$playernopic = "img/imagefail.png";
						}
						else
						{
							$playernopic = $player->GetImage();
						}
						?>
            <img src="<?php echo $playernopic; ?>" width="100%" height="100%"></img>
						</div>
					</div>
					<div class="spacer"></div>
					<div class="SideMenuKat catGradient borderB borderT">
						<div class="schatten">Infos</div>
					</div>
					<div class="spacer"></div>
					<div class="lpback" style="height:20px; width:90%;">
						<div class="lpbox smallBG borderT borderB borderR borderL boxSchatten"></div>
						<div class="lpanzeige" style="width:<?php echo $player->GetLPPercentage();?>%"></div>
						<div class="lptext">LP:
							<?php echo $player->GetLP();?>/
							<?php echo $player->GetMaxLP();?>
						</div>
					</div>
					<div class="spacer"></div>
					<div class="kpback" style="height:20px; width:90%;">
						<div class="kpbox smallBG borderT borderB borderR borderL boxSchatten"></div>
						<div class="kpanzeige" style="width:<?php echo $player->GetKPPercentage();?>%"></div>
						<div class="kptext">KP:
							<?php echo $player->GetKP();?>/
							<?php echo $player->GetMaxKP();?>
						</div>
					</div>
					<div class="spacer"></div>
					<div class="info smallBG borderT borderB borderR borderL boxSchatten">Rang :
						<?php echo $player->GetRank(); ?>
					</div>
					<div class="spacer"></div>
					<div class="info smallBG borderT borderB borderR borderL boxSchatten">KI :
						<?php echo $player->GetKI(); ?>
					</div>
					<div class="spacer"></div>
					<div class="info smallBG borderT borderB borderR borderL boxSchatten">Level:
						<?php echo $player->GetLevel(); ?>
					</div>
					<div class="spacer"></div>
					<div class="info smallBG borderT borderB borderR borderL boxSchatten">Rasse:
						<?php echo $player->GetRace(); ?>
					</div>
					<div class="spacer"></div>
					<div class="info smallBG borderT borderB borderR borderL boxSchatten">Zeni:
						<?php echo $player->GetZeni(); ?>
					</div>
					<div class="spacer"></div>
					<div class="info smallBG borderT borderB borderR borderL boxSchatten">Planet:
						<?php echo $player->GetPlanet(); ?>
					</div>
					<div class="spacer"></div>
					<div class="info smallBG borderT borderB borderR borderL boxSchatten">Ort:
						<?php echo $player->GetPlace(); ?>
					</div>
					<?php
					if($player->GetRVGUZTime() > 0)
					{
					?>
					<div class="spacer"></div>
					<div class="info smallBG borderT borderB borderR borderL boxSchatten">Verbleibende Zeit:<br/>
					<?php 
					$rvguztime = $player->GetRVGUZTime();
					$hours = floor($rvguztime / 60);
					$minutes = $rvguztime - ($hours*60);
					if($hours >= 1)
					{
						$hours = floor($hours);
						echo $hours.' Stunden ';
					}
					if($minutes != 0)
					{
						echo $minutes.' Minuten';
					}
					?>
					</div>
					<?php
					}
 					?>
					<div class="spacer"></div>
					<?php if($player->GetAction() != 0)
          {
            
          $ortTravelID = 12;
          $planetTravelID = 67;
            
          $action = $actionManager->GetAction($player->GetAction());
          ?>
					<div class="info smallBG borderT borderB borderR borderL boxSchatten">
						<?php 
            if($action->GetType() == 5)
            {
              echo $player->GetLearningAttack().' ';
            }
            
            echo $action->GetName();
            
            if($player->GetAction() == 31)
            {
              echo ' mit <a href="?p=profil&id='.$player->GetSparringPartner().'">'.$player->GetSparringPartnerName().'</a>';
            }
            
            if($action->GetType() == 4)
            {
              if($action->GetID() == $ortTravelID)
                echo '<br/>Ort: '.$player->GetTravelPlace();
              else if($action->GetID() == $planetTravelID)
                echo '<br/>Planet: '.$player->GetTravelPlanet();
            }
            ?>
						<br/>
						<div id="cID">Init
							<script>
								countdown(<?php echo $player->GetActionCountdown(); ?>, 'cID');
							</script>
						</div>
            <button onclick="OpenPopupPage('Skillpunkte Verteilen','action/cancel.php')">
              Abbrechen
            </button>
						<?php if($player->GetARank() >= 2)
            {
            ?>
						<div class="spacer"></div>
						<form method="post" action="<?php if(isset($_GET['p'])) echo '?p='.$_GET['p'].'&'; else echo '?';  ?>a=endAction">
							<input type="submit" value="beenden">
						</form>
						<?php
            }
            ?>
						<?php 
            if($action->GetType() == 4 && $ortTravelID == $action->GetID())
            {
            ?>
						<div class="spacer"></div>
            <button onclick="OpenPopupPage('Reise Beschleunigen','travel/speedup.php')">
              Beschleunigen
            </button>
						<?php
            }
            ?>
						<div class="spacer"></div>
					</div>
					<div class="spacer"></div>
					<?php
          }
          ?>
				</div>
			</div>
			<?php
      if($player->GetGroup() != null)
      {
        $group = $player->GetGroup();
      ?>
				<div class="spacer"></div>
				<div class="SideMenuContainer borderL borderR borderB borderT">
					<div class="SideMenuKat catGradient borderB ">
						<div class="schatten">Gruppe</div>
					</div>
					<?php
 					$i = 0;
					$limit = count($group);
					$where = '';
 					while(isset($group[$i]))
					{
						if($where == '')
						{
							$where = 'id = "'.$group[$i].'"';
						}
						else
						{
							$where = $where.' OR id = "'.$group[$i].'"';
						}
						++$i;
					}
					$list = new Generallist($database, 'accounts', '*', $where, '', $limit, 'ASC');
					$id = 0;
					$entry = $list->GetEntry($id);
					while($entry != null)
					{
					?>
					<div class="spacer"></div>
					<div class="gbox borderT borderL borderR borderB boxSchatten">
						<div class="catGradient borderB"><?php if($entry['groupleader'] == 1) {?> <img src="img/stern.png" width="15px" height="15px"></img> <?php } ?><a id="no-link" href="?p=profil&id=<?php echo $entry['id']; ?>" class="catGradient"><?php echo $entry['name']; ?></a></div>
						<div class="gbild borderB borderT borderR borderL"><img src="<?php echo $entry['charimage']; ?>" alt="gimage" width="100%" height="100%"> </div>

						<div class="lpback" style="top:5px; left:23px; height:15px; width:70px;">
							<div class="lpbox smallBG borderT borderB borderR borderL boxSchatten"></div>
							<div class="lpanzeige" style="width:<?php echo round(($entry['lp'] / $entry['mlp'])*100); ?>%"></div>
						</div>
						<div class="kpback" style="top:10px; left:23px; height:15px; width:70px;">
							<div class="kpbox smallBG borderT borderB borderR borderL boxSchatten"></div>
							<div class="kpanzeige" style="width:<?php echo round(($entry['kp'] / $entry['mkp'])*100); ?>%"></div>
						</div>

					</div>
					<?php
					if($player->IsGroupLeader())
					{
						?>
						<a id="no-link" href="?p=profil&id=<?php echo $entry['id']; ?>&a=grouppromote">
							<div style="cursor:pointer; width:90%;" class="boxSchatten SideMenuButton borderB borderL borderR">Leiter</div>
						</a>
						<a id="no-link" href="?p=profil&id=<?php echo $entry['id']; ?>&a=groupkick">
							<div style="cursor:pointer; width:90%;" class="boxSchatten SideMenuButton borderB borderL borderR">Kick</div>
						</a>
						<?php
					}
					$id++;
					$entry = $list->GetEntry($id);
					}
					?>
					<div class="spacer"></div>
					<a id="no-link" href="?<?php if(isset($_GET['p'])) echo 'p='.$_GET['p'].'&'; ?>a=groupleave">
						<div style="cursor:pointer;" class="SideMenuButton borderT">Verlassen</div>
					</a>
				</div>
				<?php
}
}
?>

				<div class="spacer"></div>
				<div class="SideMenuContainer borderL borderR">
					<div class="SideMenuKat catGradient borderB borderT">
						<div class="schatten">
							<div class="schatten">Server Info</div>
						</div>
					</div>
					<div class="SideMenuInfo borderB borderR">
						Version: 0.1<br> Spieler Online:
						<?php echo $gameData->GetOnline(); ?><br> Spieler:
						<?php echo $gameData->GetTotal(); ?><br> <?php $clanCount = $gameData->GetClans(); if($clanCount == 1) echo 'Clan: ' . $clanCount; else echo 'Clans: ' . $clanCount; ?><br>

					</div>
				</div>
				<div class="spacer"></div>
				<div id="SideMenuBar" class="SideMenuBar" style="margin-left:0px;float:left;min-height:0px;">
					<?php 
if ($player->IsLogged())
{

}
else
{
?>
					<div class="SideMenuContainer borderL borderR">
						<div class="SideMenuKat catGradient borderB borderT">
							<div class="schatten">
								<div class="schatten">Vote</div>
							</div>
						</div>
						<div class="SideMenuInfo borderB borderR">
							<div class="spacer"></div>
							<a id="no-link" title="dragonball,browsergame" href="http://de.mmofacts.com/dbbg-das-online-browsergame-7363#track" target="_blank"><img src="img/mmofacts.png" width="120" height="30" alt="dragonball,browsergame" title="dragonball,browsergame"/></a>
							<a id="no-link" title="dragonball,browsergame" href="https://www.webwiki.de/db-bg.de" target="_blank"><img src="img/webwiki.png" width="120" height="30" alt="dragonball,browsergame"  title="dragonball,browsergame"/></a>
							<a id="no-link" title="dragonball,browsergame" href="https://www.browsergames.info" target="_blank"><img src="img/browsergames.png" width="120" height="30" alt="dragonball,browsergame" title="dragonball,browsergame"/></a>
							<div class="spacer"></div>
						</div>
					</div>
					<div class="spacer"></div>
					<div class="SideMenuContainer borderL borderR">
						<div class="SideMenuKat catGradient borderB borderT">
							<div class="schatten">
								<div class="schatten">Besucher Counter</div>
							</div>
						</div>
						<div class="SideMenuInfo borderB borderR">
							<div class="spacer"></div>
							<a id="no-link" href="" title="dragonball,browsergame"><img 
src="//c.andyhoppe.com/1558437514" style="border:none" alt="Besucherzaehler" title="Besucherzaehler"/></a>
							<div class="spacer"></div>
						</div>
					</div>
					<div class="spacer"></div>
					<!--<div class="SideMenuContainer borderL borderR">
						<div class="SideMenuKat catGradient borderB borderT">
							<div class="schatten">
								<div class="schatten">Partner</div>
							</div>
						</div>
						<<div class="SideMenuInfo borderB borderR">
							<div class="spacer"></div>
							<a id="no-link" title="dragonball,browsergame" href="http://anime-junkies.tv/" target="_blank"><img src="img/anime.png" width="140" height="30" alt="dragonball,browsergame" title="dragonball,browsergame" /></a>
							<a id="no-link" title="dragonball,browsergame" href="http://www.aniflix.org/" target="_blank"><img src="img/aniflix.png" width="140" height="30" alt="dragonball,browsergame" title="dragonball,browsergame" /></a>
							<div class="spacer"></div>
						</div>
					</div>-->
					<div class="spacer"></div>
					<?php }?>
          
					<?php
if ($player->IsLogged())
{
?>
						<?php
if($player->GetArank() >= 1)
{
?>
							<div class="SideMenuContainer borderL borderR">
								<div class="SideMenuKat catGradient borderB borderT">
									<div class="schatten"> DBBG Team Menu
									</div>
								</div>
								<?php 
if($player->GetArank() >= 3)
{
?>
										<a id="no-link" href="?p=multicheck">
											<div style="cursor:pointer;" class="SideMenuButton borderB">Multicheck</div>
										</a>
	<?php
}
  ?>
								<?php 
if($player->GetArank() >= 2)
{
?>
										<a id="no-link" href="?p=balancing">
											<div style="cursor:pointer;" class="SideMenuButton borderB">Balancing</div>
										</a>
										<a id="no-link" href="?p=admin">
											<div style="cursor:pointer;" class="SideMenuButton borderB">Admin Menu</div>
										</a>
										<a id="no-link" href="?p=adminlog">
											<div style="cursor:pointer;" class="SideMenuButton borderB">Admin Log</div>
										</a>
										<a id="no-link" href="?p=adminimages">
											<div style="cursor:pointer;" class="SideMenuButton borderB">Bilder Verwaltung</div>
										</a>
	<?php
}
if($player->GetArank() >= 3)
{
?>
										<a id="no-link" href="?p=rundmail">
											<div style="cursor:pointer;" class="SideMenuButton borderB">Rundmail</div>
										</a>
										<a id="no-link" href="?p=report">
											<div style="cursor:pointer;" class="SideMenuButton borderB">User Meldungen</div>
										</a>
	<?php
}
  ?>
							</div>
							<div class="spacer"></div>
							<?php
}
?>
				</div>
		</div>
		<?php
}
?>
</center>