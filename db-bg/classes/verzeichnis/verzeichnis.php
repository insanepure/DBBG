<?php
if($database == NULL)
{
	print 'This File ('.__FILE__.') should be after Datatabase!';
}

class VerzeichnisEntry
{
	private $data;
	
	function __construct($initialData)
	{
		$this->data = $initialData;
	}
  
  function GetID()
  {
    return $this->data['id'];
  }
  
  function GetName()
  {
    return $this->data['name'];
  }
  
  function GetOriginalName()
  {
    return $this->data['originalname'];
  }
  
  function GetImage()
  {
    return $this->data['image'];
  }
  
  function GetVoiceActorGer()
  {
    return $this->data['voiceactorger'];
  }
  
  function GetVoiceActorJap()
  {
    return $this->data['voiceactorjap'];
  }
  
  function GetUniverse()
  {
    return $this->data['universe'];
  }
  
  function GetBirthDay()
  {
    return $this->data['birthday'];
  }
  
  function GetBirthPlace()
  {
    return $this->data['birthplace'];
  }
  
  function GetHeight()
  {
    return $this->data['height'];
  }
  
  function GetWeight()
  {
    return $this->data['weight'];
  }
  
  function GetFamily()
  {
    return $this->data['family'];
  }
  
  function GetAnime()
  {
    return $this->data['anime'];
  }
  
  function GetManga()
  {
    return $this->data['manga'];
  }
  
  function GetDescription()
  {
    return $this->data['description'];
  }
  
  
}

class Verzeichnis
{
  private $database;
	
	function __construct($db)
	{
    $this->database = $db;
	}
  
  function LoadEntryName($name)
  {
    $name = $this->database->EscapeString($name);
    $entry = null;
    $result = $this->database->Select('*','verzeichnis','name="'.$name.'"');
		if ($result) 
		{
      $row = $result->fetch_assoc();
      if(isset($row))
      {
        $entry = new VerzeichnisEntry($row);
      }
			$result->close();
		}
    
    return $entry;
  }
  
  function LoadEntry($id)
  {
    $entry = null;
    $result = $this->database->Select('*','verzeichnis','id='.$id);
		if ($result) 
		{
      $row = $result->fetch_assoc();
      if(isset($row))
      {
        $entry = new VerzeichnisEntry($row);
      }
			$result->close();
		}
    
    return $entry;
  }
}

?>