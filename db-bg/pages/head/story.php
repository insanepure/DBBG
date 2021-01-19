<?php
  include_once 'classes/story/story.php';
  include_once 'classes/items/itemmanager.php';
  include_once 'classes/npc/npc.php';
  include_once 'classes/bbcode/bbcode.php';
  $story = new Story($database, $player->GetStory());
if(isset($_GET['a']) && $_GET['a'] == 'jump' && $player->GetARank() >= 2 && is_numeric($_POST['storyid']))
{
  $player->JumpStory($_POST['storyid']);
  $story = new Story($database, $player->GetStory());
}
else if(isset($_GET['a']) && $_GET['a'] == 'continue' && $story->GetType() == 1)
{
  if($player->GetPlanet() != $story->Getplanet())
  {
    $message = 'Du befindest dich auf den falschen Planeten.';
  }
  else if($player->GetPlace() != $story->GetPlace())
  {
    $message = 'Du befindest dich am falschen Ort.';
  }
  else
  {
    $itemManager = new ItemManager($database);
    $player->ContinueStory($story->GetLevelup(), $story->GetZeni(), $story->GetItems(), $story->GetSkillpoints(), $itemManager);
    $story = new Story($database, $player->GetStory());
  }
}
else if(isset($_GET['a']) && $_GET['a'] == 'train' && $story->GetType() == 3)
{
  $itemManager = new ItemManager($database);
  if($player->HasDBs())
  {
    $message = 'Du musst dir zuerst etwas wünschen.';
  }
  else if($player->GetPlanet() != $story->Getplanet())
  {
    $message = 'Du befindest dich auf den falschen Planeten.';
  }
  else if($player->GetPlace() != $story->GetPlace())
  {
    $message = 'Du befindest dich am falschen Ort.';
  }
  else
  {
    $action = $actionManager->GetAction($story->GetAction());
    $minutes = $action->GetMinutes();
    $price = $action->GetPrice();
    $item = $action->GetItem();
    $race = $action->GetRace();
    if($item != 0 && !$player->HasItemWithID($item->GetID(), $item->GetID()))
    {
      $message = 'Du hast das benötigte Item nicht.';
    }
    else if($action->GetLevel() > $player->GetLevel())
    {
      $message = 'Dein Level ist zu niedrig.';
    }
    else if($price > $player->GetZeni())
    {
      $message = 'Du hast nicht genug Zeni.';
    }
    else if($player->GetAction() != 0)
    {
      $message = 'Du tust bereits etwas.';
    }
    else if($race != '' && $player->GetRace() != $race)
    {
      $message = 'Du kannst diese Aktion nicht machen, sie gehört einer anderen Rasse.';
    }
    else
    {
      if( $player->GetRVGUZTime() != 0 && $minutes > $player->GetRVGUZTime())
      {
        $minutes = $player->GetRVGUZTime();
      }
      $player->DoAction($action, $minutes);
      if($action->GetItem() != 0)
      {
        $statstype = 0;
        $upgrade = 0;
        $amount = 1;
        $player->RemoveItemsByID($action->GetItem(), $action->GetItem(), $statstype, $upgrade, $amount);
      }
      $message = 'Du führst die Aktion nun aus.';
    }
  }
}
else if(isset($_GET['a']) && $_GET['a'] == 'fight' && $story->GetType() == 2)
{
  if($player->GetPlanet() != $story->Getplanet())
  {
    $message = 'Du befindest dich auf den falschen Planeten.';
  }
  else if($player->GetPlace() != $story->GetPlace())
  {
    $message = 'Du befindest dich am falschen Ort.';
  }
  else if($player->GetFight() != 0)
  {
    $message = 'Du befindest dich schon in einem Kampf.';
  }
	else if($player->GetTournament() != 0)
	{
    $message = 'Du befindest dich in einem Turnier.';
	}
  else if($player->GetLP() < $player->GetMaxLP() * 0.2)
  {
    $message = 'Du hast nicht genügend LP.';
  }
  else
  {
    
    $gPlayers = array();
    $group = $player->GetGroup();
    if($group != null)
    {
      foreach($group as &$gID)
      {
        $gPlayer = new Player($database, $gID, $actionManager);
        if($gPlayer->GetPlace() == $player->GetPlace() && $gPlayer->GetPlanet() == $player->GetPlanet() 
           && $gPlayer->GetLP() > ($gPlayer->GetMaxLP() * 0.2)
           && $gPlayer->GetFight() == 0
           && $gPlayer->GetTournament() == 0
           && $gPlayer->GetID() != $player->GetID()
          )
        {
          array_push($gPlayers, $gPlayer);
        }
      }
    }
    array_push($gPlayers, $player);
    $difficulty = count($gPlayers);
    
    $supportNPCs = $story->GetSupportNPCs();
    $difficulty += count($supportNPCs);
    $npcs = $story->GetNPCs();
    
    $type = 4; //StoryFight
    $mode = $difficulty.'vs'.count($npcs);
    $name = $story->GetTitel();
    $survivalrounds = $story->GetSurvivalRounds();
    $survivalteam = $story->GetSurvivalTeam();
    $survivalwinner = $story->GetSurvivalWinner();
    $healthRatio = $story->GetHealthRatio();
    $healthRatioTeam = $story->GetHealthRatioTeam();
    $healthRatioWinner = $story->GetHealthRatioWinner();
    $startingHealthRatioPlayer = $story->GetStartingHealthRatioPlayer();
    $startingHealthRatioEnemy = $story->GetStartingHealthRatioEnemy();
    $team = 1;
    $event = 0;
    $healing = 0;
    $eventFight = 0;
    $tournament=0;
    $dragonball=0;
    $npcid=0;
    /*CreateFight($player, $database, $type, $name, $mode, $levelup=0, $actionManager=null, $zeni=0, 
															$items=0, $story=0, $challenge=0, $survivalteam=0, $survivalrounds=0, $survivalwinner=0, 
                              $event=0, $healing=0, $eventfight=0, $tournament=0, $dragonball=0, $npcid=0, $difficulty=0,
                              $healthRatio=0, $healthRatioTeam=0, $healthRatioWinner=0)
                              */
    
    $pLP = $player->GetLP() * ($startingHealthRatioPlayer/100);
    $pLP = floor($pLP);
    $player->SetLP($pLP);
    
    $difficulty = ceil($difficulty / count($npcs));
    
    $npcsArray = array();
    foreach($npcs as &$npcID)
    {
      $npc = new NPC($database, $npcID, $difficulty);
      $nLP = $npc->GetRawLP() * ($startingHealthRatioEnemy/100);
      $nLP = floor($nLP);
      $npc->SetLP($nLP);
      array_push($npcsArray, $npc);
      
    if($npc->GetPlayerAttack() != 0)
      $player->AddFightAttack($npc->GetPlayerAttack());
    }
    
    $createdFight = Fight::CreateFight($player, $database, $type, $name, $mode, $story->GetLevelup(), $actionManager, $story->GetZeni(), $story->GetItems(), 
                                       $story->GetID(), 0, $survivalteam, $survivalrounds, $survivalwinner, $event, $healing, $eventFight, 
                                       $tournament, $dragonball, $npcid, $difficulty, $healthRatio, $healthRatioTeam, $healthRatioWinner);
    
    foreach($npcsArray as &$npc)
    {
      $createdFight->Join($npc, $team, true);
    }
    
    if(count($supportNPCs) != 0)
    {
      foreach($supportNPCs as &$supportNPCID)
      {
        $supportNPC = new NPC($database, $supportNPCID, 1);
        $createdFight->Join($supportNPC, 0, true);
      }
    }
    
    $charaids = array();
    
    foreach($gPlayers as &$gPlayer)
    {
      array_push($charaids, $gPlayer->GetID());
      
      if($gPlayer->GetID() == $player->GetID())
        continue;
      
      $pLP = $gPlayer->GetLP() * ($startingHealthRatioPlayer/100);
      $pLP = floor($pLP);
      $gPlayer->SetLP($pLP);
      
      $createdFight->Join($gPlayer, 0, false);
    }
    
    if(count($charaids) > 1)
      LoginTracker::AddInteraction($accountDB, $charaids, 'Storykampf', 'dbbg');
    
		if($createdFight->IsStarted())
		  header('Location: ?p=infight');
    exit();
  }  
}

function ShowPlayer($player)
{
?>
<div id="SideMenuBar" class="SideMenuBar" style="margin-left:0px;float:left;min-height:0px;">
  <div class="SideMenuContainer borderT borderL borderB borderR">
    <div class="SideMenuKat catGradient borderB">
      <div class="schatten"><?php echo $player->GetName(); ?>
      </div>
    </div>
    <div class="SideMenuInfo">
      <div class="char_main">
            <div class="spacer"></div>
             <div class="char_image smallBG borderT borderB borderR borderL">
            <img src="<?php echo $player->GetImage(); ?>" width="100%" height="100%"></img></div>   
            <div class="spacer"></div>
            </div>
      </div>
  </div> 
</div>
<?php
}
?>