<?php
if($database == NULL)
{
	print 'This File ('.__FILE__.') should be after Datatabase!';
}

class GeneralList
{
  
  private $database;
  private $entries;
  
	function __construct($db, $table, $select, $where, $order = '', $limit = 9999, $desc='DESC', $join='', $group='')
	{
    $this->entries = array();
    $this->database = $db;
    $this->AddEntries($table, $select, $where, $order, $limit, $desc, $join, $group);
  }
  
  public function AddEntries($table, $select, $where, $order = '', $limit = 9999, $desc='DESC', $join='', $group='')
  {
    $result = $this->database->Select($select, $table, $where, $limit, $order, $desc, $join, $group);
		if ($result) 
		{
			if ($result->num_rows > 0)
			{
        while($row = $result->fetch_assoc()) 
        {
					array_push($this->entries, $row);
        }
			}
			$result->close();
		}
  }
  
	public function GetCount()
	{
		return count($this->entries);
	}
	
  public function GetEntry($id)
  {
    if($id >= $this->GetCount())
    {
      return null;
    }
		$entry = $this->entries[$id];
    return $entry;
  }
  
}


?>