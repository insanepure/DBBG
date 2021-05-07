<?php
if($database == NULL)
{
	print 'This File ('.__FILE__.') should be after Datatabase!';
}

class StatsList
{
  public static function AddWin($database, $id, $name, $type)
  {
    $typeEntry = StatsList::GetEntryOrAdd($database, $id, $name, $type);
    $totalEntry = StatsList::GetEntryOrAdd($database, $id, $name, -1);
    StatsList::UpdateWin($database, $typeEntry);
  }
  
  public static function AddLoose($database, $id, $name, $type)
  {
    $typeEntry = StatsList::GetEntryOrAdd($database, $id, $name, $type);
    $totalEntry = StatsList::GetEntryOrAdd($database, $id, $name, -1);
    StatsList::UpdateLoose($database, $typeEntry);
  }
  public static function Adddraw($database, $id, $name, $type)
  {
    $typeEntry = StatsList::GetEntryOrAdd($database, $id, $name, $type);
    $totalEntry = StatsList::GetEntryOrAdd($database, $id, $name, -1);
    StatsList::UpdateDraw($database, $typeEntry);
  }
  
  private static function UpdateWin($database, $entry)
  {
    $select = 'win=win+1, total=total+1, dailywin=dailywin+1, dailytotal=dailytotal+1';
    $where = 'acc = '.$entry['acc'].' AND (type='.$entry['type'].' OR type=-1)';
		$result = $database->Update($select,'statslist',$where,2);
  }
  
  private static function UpdateLoose($database, $entry)
  {
    $select = 'loose=loose+1, total=total+1, dailyloose=dailyloose+1, dailytotal=dailytotal+1';
    $where = 'acc = '.$entry['acc'].' AND (type='.$entry['type'].' OR type=-1)';
		$result = $database->Update($select,'statslist',$where,2);
  }
  
  private static function UpdateDraw($database, $entry)
  {
    $select = 'draw=draw+1, total=total+1, dailydraw=dailydraw+1, dailytotal=dailytotal+1';
    $where = 'acc = '.$entry['acc'].' AND (type='.$entry['type'].' OR type=-1)';
		$result = $database->Update($select,'statslist',$where,2);
  }
  
  public static function GetEntryOrEmpty($database, $id, $type)
  {
    $entry = StatsList::GetEntry($database,$id,$type);
    if($entry == null)
    {
    $entry = array();
    $entry['id'] = 0;
    $entry['acc'] = $id;
    $entry['type'] = $type;
    $entry['win'] = 0;
    $entry['loose'] = 0;
    $entry['draw'] = 0;
    $entry['total'] = 0;
    $entry['dailywin'] = 0;
    $entry['dailyloose'] = 0;
    $entry['dailydraw'] = 0;
    $entry['dailytotal'] = 0;
    }
    
    return $entry;
  }
  
  private static function GetEntryOrAdd($database, $id, $name, $type)
  {
    $entry = StatsList::GetEntry($database,$id,$type);
    if($entry == null)
    {
		$result = $database->Insert('acc, name, type, win, loose, draw, total, dailywin, dailyloose, dailydraw, dailytotal', 
																			'"'.$id.'","'.$name.'","'.$type.'","0","0","0","0","0","0","0","0"', 'statslist');
    
    $entry = array();
    $entry['id'] = $database->GetLastID();
    $entry['acc'] = $id;
    $entry['name'] = $name;
    $entry['type'] = $type;
    $entry['win'] = 0;
    $entry['loose'] = 0;
    $entry['draw'] = 0;
    $entry['total'] = 0;
    $entry['dailywin'] = 0;
    $entry['dailyloose'] = 0;
    $entry['dailydraw'] = 0;
    $entry['dailytotal'] = 0;
    }
    
    return $entry;
  }
  
  private static function GetEntry($database, $id, $type)
  {
		$result = $database->Select('*','statslist','acc = '.$id.' AND type='.$type.'',1);
		if ($result) 
		{
			if ($result->num_rows > 0)
			{
				$row = $result->fetch_assoc();
			  $result->close();
        return $row;
			}
			$result->close();
		} 
    
    return null;
  }
}