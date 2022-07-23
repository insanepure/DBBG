<?php
if($database == NULL)
{
	print 'This File ('.__FILE__.') should be after Datatabase!';
}


include_once 'news.php';

class NewsManager
{
  private $database;
  private $news;
	
	function __construct($db, $num)
	{
    $this->database = $db;
    $this->news = array();
    $this->LoadNews($num);
	}
  
  public function GetNewsByID($id)
  {
		$newsCount = $this->GetNewsCount();
		$currentNews = null;
		for ($i = 0; $i < $newsCount; $i++) 
		{
			$news = $this->GetNews($i);
			if($news->GetID() == $id)
			{
				$currentNews = $news;
				break;
			}
		}
    return $currentNews;
  }
  
	public function Post($player, $id, $text)
	{
		$currentNews = $this->GetNewsByID($id);
		if($currentNews == null)
			return 0;
		
		if(!preg_match("/^[A-Za-z0-9,.\+\-!:;()\sß?äöüÄÖÜ]+$/", $text))
		{
		 return -1;
		}
		
		$comments = $currentNews->GetComments();
		$comment[0] = $player->GetName();
		$comment[1] = $player->GetID();
		$comment[2] = $this->database->EscapeString($text);
		$currentNews->AddComment($comment);
		
		$commentsString = $currentNews->GetCommentsString();
		$result = $this->database->Update('kommentare="'.$commentsString.'",likes="'.$currentNews->GetLikesString().'", dislikes="'.$currentNews->GetDisLikesString().'"','News','id = '.$id.'',1);
		
		return 1;
	}
  
	public function Like($accountID, $id)
	{
		$currentNews = $this->GetNewsByID($id);
		if($currentNews == null)
    {
			return 0;
    }
    
    $currentNews->RemoveLike($accountID);    
    $currentNews->RemoveDisLike($accountID);
    $currentNews->AddLike($accountID);
		$result = $this->database->Update('likes="'.$currentNews->GetLikesString().'", dislikes="'.$currentNews->GetDisLikesString().'"','News','id = '.$id.'',1);
  }
  
	public function DisLike($accountID, $id)
	{
		$currentNews = $this->GetNewsByID($id);
		if($currentNews == null)
			return 0;
    
    $currentNews->RemoveLike($accountID);    
    $currentNews->RemoveDisLike($accountID);
    $currentNews->AddDisLike($accountID);
		$result = $this->database->Update('likes="'.$currentNews->GetLikesString().'", dislikes="'.$currentNews->GetDisLikesString().'"','News','id = '.$id.'',1);
  }
  
	public function RemoveLikes($accountID, $id)
	{
		$currentNews = $this->GetNewsByID($id);
		if($currentNews == null)
			return 0;
    
    $currentNews->RemoveLike($accountID);    
    $currentNews->RemoveDisLike($accountID);
		$result = $this->database->Update('likes="'.$currentNews->GetLikesString().'", dislikes="'.$currentNews->GetDisLikesString().'"','News','id = '.$id.'',1);
  }
  
  private function LoadNews($num)
  {
		$result = $this->database->Select('*','News','',$num,'id','DESC');
		if ($result) 
		{
			if ($result->num_rows > 0)
			{
        while($row = $result->fetch_assoc()) 
        {
					$news = new News($row);
					array_push($this->news, $news);
        }
			}
			$result->close();
      
		}
  }
  
  public function GetNewsCount()
  {
    return count($this->news);
  }
  
  public function &GetNews($index)
  {
    return $this->news[$index];
  }
}
?>