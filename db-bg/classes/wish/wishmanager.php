<?php
if($database == NULL)
{
	print 'This File ('.__FILE__.') should be after Datatabase!';
}


include_once 'wish.php';

class WishManager
{
  private $database;
  private $wishes;
	
	function __construct($db)
	{
    $this->database = $db;
    $this->wishes = array();
    $this->LoadWishes();
	}
  
  private function LoadWishes()
  {
		$result = $this->database->Select('*','wishes','',999999,'id','DESC');
		if ($result) 
		{
			if ($result->num_rows > 0)
			{
        while($row = $result->fetch_assoc()) 
        {
					$wish = new Wish($row);
					array_push($this->wishes, $wish);
        }
			}
			$result->close();
      
		}
  }
  
  public function GetWishCount()
  {
    return count($this->wishes);
  }
  
  public function GetWish($id)
  {
    $i = 0;
    while(isset($this->wishes[$i]))
    {
      if($this->wishes[$i]->GetID() == $id)
      {
        return $this->wishes[$i];
      }
     ++$i; 
    }
    return null;
  }
}
?>