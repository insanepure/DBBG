<?php
include_once 'classes/clan/clan.php';
include_once 'classes/bbcode/bbcode.php';
?>
<center>


	<div id="SideMenuBar" class="SideMenuBar" style="margin-left:0px;float:left;min-height:0px;">
		<?php
if ($player->IsLogged())
{
?>
			<div class="spacer"></div>
			<div class="SideMenuContainer borderL borderR">
				<div class="SideMenuKat catGradient borderB borderT">
					<div class="schatten">Charakter</div>
				</div>
				<a href="?p=profil" id="no-link">
					<div style="cursor:pointer;" class="SideMenuButton borderB">Profil</div>
				</a>
				<a href="?p=inventar" id="no-link">
					<div style="cursor:pointer;" class="SideMenuButton borderB">Inventar</div>
				</a>
				<a href="?p=ausruestung" id="no-link">
					<div style="cursor:pointer;" class="SideMenuButton borderB">Ausrüstung</div>
				</a>
				<a href="?p=skilltree" id="no-link">
					<div style="cursor:pointer;" class="SideMenuButton borderB">
          <?php
          if($player->GetSkillpoints() != 0)
          {
            ?>
              <font color="red">Skilltree</font>
            <?php
          }
          else
          {
            ?>
            Skilltree
            <?php
          }
          ?>
          </div>
				</a>
				<?php if($player->GetStats() != 0)
{
?>
				<a href="#" id="no-link" onclick="OpenPopupPage('Statspunkte Verteilen','skill/edit.php')">
					<div style="cursor:pointer;" class="SideMenuButton borderB">
						<font color="red">Statspunkte:
							<?php echo $player->GetStats(); ?>
						</font>
					</div>
				</a>
				<?php
}
?>
			</div>
					<div class="spacer"></div>
    
			<div class="SideMenuContainer borderL borderR">
				<div class="SideMenuKat catGradient borderB borderT">
					<div class="schatten">Nachrichten</div>
				</div>
				<a href="?p=pm" id="no-link">
					<div style="cursor:pointer;" class="SideMenuButton borderB">
						<?php
            $unreadPMS = $PMManager->GetUnreadPMs();
            if($unreadPMS > 0) echo '<font color="#ff0000">';
            echo 'Postfach: '.$unreadPMS;
            if($unreadPMS > 0) echo '</font>';
            ?>
					</div>
				</a>
				<a href="?p=pm2" id="no-link">
					<div style="cursor:pointer;" class="SideMenuButton borderB">
						<?php
            $unreadPMS = $PMManager->GetSystemPMs();
            if($unreadPMS > 0) echo '<font color="#ff0000">';
            echo 'System: '.$unreadPMS;
            if($unreadPMS > 0) echo '</font>';
            ?>
					</div>
				</a>
			</div>
					<div class="spacer"></div>
			<div class="SideMenuContainer borderL borderR">
				<div class="SideMenuKat catGradient borderB borderT">
					<div class="schatten">Ort</div>
				</div>
				<a href="?p=story" id="no-link">
					<div style="cursor:pointer;" class="SideMenuButton borderB">Story</div>
				</a>
				<a href="?p=training" id="no-link">
					<div style="cursor:pointer;" class="SideMenuButton borderB">Aktionen</div>
				</a>
        <?php if($player->GetRace() == 'Android' || $player->GetRace() == 'Kaioshin' || $player->GetRace() == 'Majin' || $player->GetRace() == 'Saiyajin')
        {
          ?>
				<a href="?p=raceaction" id="no-link">
					<div style="cursor:pointer;" class="SideMenuButton borderB">Rasse</div>
				</a>
          <?php
        }
        ?>
				<a href="?p=techtraining" id="no-link">
					<div style="cursor:pointer;" class="SideMenuButton borderB">Technik</div>
				</a>
				<a href="?p=shop" id="no-link">
					<div style="cursor:pointer;" class="SideMenuButton borderB">Shop</div>
				</a>
				<a href="?p=market" id="no-link">
					<div style="cursor:pointer;" class="SideMenuButton borderB">Marktplatz</div>
				</a>
        <?php if($player->GetPlanet() == 'Jenseits')
        {
          ?>
				<a href="?p=revive" id="no-link">
					<div style="cursor:pointer;" class="SideMenuButton borderB">Wiederbeleben</div>
				</a>
          <?php
        }
        ?>
			</div>
			<div class="spacer"></div>
    
      <?php
      /*
      $today = new DateTime(); // This object represents current date/time
      $today->setTime( 0, 0, 0 ); // reset time part, to prevent partial comparison   
      $christmas = new DateTime();
      $christmas->modify('2019-12-01 00:00:00');
  
      $christmasDiff = $christmas->diff( $today ); 
      $christmasDiff = (integer)$christmasDiff->format( "%R%a" ); // Extract days count in interval
 
      if($christmasDiff >= 0 && $christmasDiff <= 24)
      {
      ?>
			<div class="SideMenuContainer borderL borderR">
				<div class="SideMenuKat catGradient borderB borderT">
					<div class="schatten">Event</div>
				</div>
        <?php
        if($christmasDiff >= 0)
        {
          ?>
          <a href="?p=christmas" id="no-link">
            <div style="cursor:pointer;" class="SideMenuButton borderB">
              Weihnachten
            </div>
          </a>
          <?php
        }
        ?>
			</div>
			<div class="spacer"></div>
      <?php
      }
        */
      ?>
			<div class="SideMenuContainer borderL borderR">
				<div class="SideMenuKat catGradient borderB borderT">
					<div class="schatten">Kampf</div>
				</div>
				<a href="?p=npc" id="no-link">
					<div style="cursor:pointer;" class="SideMenuButton borderB">NPC</div>
				</a>
				<a href="?p=event" id="no-link">
					<div style="cursor:pointer;" class="SideMenuButton borderB">Event</div>
				</a>
				<a href="?p=boss" id="no-link">
					<div style="cursor:pointer;" class="SideMenuButton borderB">Boss</div>
				</a>
				<a href="?p=arena" id="no-link">
					<div style="cursor:pointer;" class="SideMenuButton borderB">Arena</div>
				</a>
				<a href="?p=tournament" id="no-link">
					<div style="cursor:pointer;" class="SideMenuButton borderB">Turnier</div>
				</a>
        <?php
        if(isset($fight) && $fight->IsValid() && $fight->GetID() == $player->GetFight() && $fight->IsStarted())
        {
          ?>
				<a href="?p=infight" id="no-link">
					<div style="cursor:pointer;" class="SideMenuButton borderB"><b><font color="#ff0000">Kampf</font></b></div>
				</a>
          <?php
        }
        else
        {
          ?>
				<a href="?p=fight" id="no-link">
					<div style="cursor:pointer;" class="SideMenuButton borderB">Kämpfe</div>
				</a>
          <?php
        }
        ?>
			</div>
			<div class="spacer"></div>
			<div class="SideMenuContainer borderL borderR">
				<div class="SideMenuKat catGradient borderB borderT">
					<div class="schatten">Reisen</div>
				</div>
				<a href="?p=map" id="no-link">
					<div style="cursor:pointer;" class="SideMenuButton borderB">Karte</div>
				</a>
        <?php
        if($player->GetPlanet() != 'Jenseits')
        {
        ?>
				<a href="?p=spacetravel" id="no-link">
					<div style="cursor:pointer;" class="SideMenuButton borderB">Raumschiff</div>
				</a>
				<?php
				}
        ?>
				<?php 
				if($player->HasRadar())
				{
				?>
				<a href="?p=radar" id="no-link">
					<div style="cursor:pointer;" class="SideMenuButton borderB">Radar</div>
				</a>
				<?php
				}
        ?>
				<?php 
				if($player->HasDBs())
				{
				?>
				<a href="?p=wish" id="no-link">
					<div style="cursor:pointer;" class="SideMenuButton borderB">Wunsch</div>
				</a>
				<?php
				}
        ?>
			</div>
			<div class="spacer"></div>
			<div class="SideMenuContainer borderL borderR">
				<div class="SideMenuKat catGradient borderB borderT">
					<div class="schatten">Clan</div>
				</div>
<?php if($player->GetClan() == 0)
{
	?>
				<a href="?p=clancreate" id="no-link">
					<div style="cursor:pointer;" class="SideMenuButton borderB">Clan Erstellen</div>
				</a>
				<a href="?p=clanjoin" id="no-link">
					<div style="cursor:pointer;" class="SideMenuButton borderB">Clan Beitreten</div>
				</a>
	<?php
}
 else
 {
	?>
				<a href="?p=clan&id=<?php echo $player->GetClan(); ?>" id="no-link">
					<div style="cursor:pointer;" class="SideMenuButton borderB">Clan Profil</div>
				</a>
				<a href="?p=clanmanage" id="no-link">
					<div style="cursor:pointer;" class="SideMenuButton borderB">Clan Verwaltung</div>
				</a>
	<?php
 }
?>
			</div>
			<div class="spacer"></div>
			<div class="SideMenuContainer borderL borderR">
				<div class="SideMenuKat catGradient borderB borderT">
					<div class="schatten">Community</div>
				</div>
				<a href="?p=user" id="no-link">
					<div style="cursor:pointer;" class="SideMenuButton borderB">Userliste</div>
				</a>
				<a href="?p=clans" id="no-link">
					<div style="cursor:pointer;" class="SideMenuButton borderB">Clanliste</div>
				</a>
				<a href="?p=ranglist" id="no-link">
					<div style="cursor:pointer;" class="SideMenuButton borderB">Rangliste</div>
				</a>
			</div>
	<?php
 $wartung = false;
 if($wartung)
 {
?>
			<div class="spacer"></div>
			<div class="SideMenuContainer borderL borderR">
				<div class="SideMenuKat catGradient borderB borderT">
					<div class="schatten">Wartungsarbeiten</div>
				</div>
 <img src="img/wartungsarbeiten.gif" alt="wartung" width="140" height="100"> 
				<font color="red"><b>WENN CHAT BUGT BITTE PM SENDEN!</b></font>
			</div>		
<?php
 }
 ?>


			<div class="spacer"></div>
			<?php
}
else
{   
?>
				<div class="spacer"></div>

				<div class="SideMenuContainer borderL borderR">
					<div class="SideMenuKat catGradient borderB borderT">
						<div class="schatten">Server Time</div>
					</div>
					<div class="SideMenuInfo borderB borderR">
          <?php
          echo date("d.m.Y H:i:s", time());
          ?>
					</div>
				</div>

				<div class="spacer"></div>

				<div class="SideMenuContainer borderL borderR">
					<div class="SideMenuKat catGradient borderB borderT">
						<div class="schatten">Universen</div>
					</div>
					<div class="SideMenuInfo borderB borderR">
						<div class="spacer"></div>
						<img src="img/welt1.png" alt="welt1" title="dragonball,browsergame" width="130" height="50">
						<div class="spacer"></div>
					</div>
				</div>
						<div class="spacer"></div>
				<div class="SideMenuContainer borderL borderR">
					<div class="SideMenuKat catGradient borderB borderT">
						<div class="schatten">Screenshots</div>
					</div>
					<div class="SideMenuInfo borderB borderR">
            <table height="100%" width="100%">
              <?php
              $screenUrl = 'img/screens/screen';
              $screenExt = '.png';
              $cols = 3;
              $rows = 2;
              $width = 50;
              $height = 50;
              for($col = 1; $col <= $cols; ++$col)
              {
                ?><tr><?php
                for($row = 1; $row <= $rows; ++$row)
                {
                  $screenID =  (($col-1) * $rows) + $row;
                  $screenImg = $screenUrl.$screenID.$screenExt;
                  ?><td align="center"><a href="<?php echo $screenImg; ?>" target="_blank"><img width="<?php echo $width; ?>px" height="<?php echo $height; ?>px" src="<?php echo $screenImg; ?>"></img></a></td><?php
                }
                  ?></tr><?php
              }
              ?>
            </table>
					</div>
				</div>
				<div class="spacer"></div>
		<div class="spacer"></div>
				<?php
}
?>
	</div>
</center>