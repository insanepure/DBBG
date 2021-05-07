<?php
class News
{
	private $data;
	
	function __construct($initialData)
	{
		$this->data = $initialData;
	}
  
  public function GetID()
  {
    return $this->data['id'];
  }
  
  public function GetAuthor()
  {
    return $this->data['authorname'];
  }
  
  public function GetAuthorID()
  {
    return $this->data['author'];
  }
  
  public function GetAuthorImage()
  {
    return $this->data['authorimage'];
  }
  
  public function GetTitle()
  {
    return $this->data['title'];
  }
  
  public function GetComments()
  {
		if($this->data['kommentare'] == '')
		{
			return array();
		}
		else
		{
			return explode('@',$this->data['kommentare']);
		}
  }
	
  public function GetCommentsString()
  {
    return $this->data['kommentare'];
  }
	
  public function GetCommentCount()
  {
		return count($this->GetComments());
  }
	
	public function AddComment($comment)
	{
		$comments = $this->GetComments();
		array_push($comments, implode(';', $comment));
		$this->data['kommentare'] = htmlspecialchars(implode('@',$comments));
	}
  
  public function GetDate()
  {
		$dateStr = strtotime( $this->data['date'] );
		$formatedDate = date( 'd.m.Y H:i', $dateStr );
    return $formatedDate;
  }
  
  public function GetText()
  {
    return $this->data['text'];
  }
  
  public function GetLikes()
  {
    if($this->data['likes'] == '')
      return array();
    
    return explode(';',$this->data['likes']);
  }
  
  public function GetLikesString()
  {
    return $this->data['likes'] ;
  }
  
  public function GetDisLikes()
  {
    if($this->data['dislikes'] == '')
      return array();
    
    return explode(';',$this->data['dislikes']);
  }
  
  public function GetDisLikesString()
  {
    return $this->data['dislikes'] ;
  }
  
  public function GetLikeCount()
  {
    return count($this->GetLikes());
  }
  
  public function GetDisLikeCount()
  {
    return count($this->GetDisLikes());
  }
  
  public function HasLiked($accountID)
  {
    return in_array($accountID, $this->GetLikes());
  }
  
  public function HasDisLiked($accountID)
  {
    return in_array($accountID, $this->GetDisLikes());
  }
	
	public function AddLike($accountID)
	{
		$likes = $this->GetLikes();
		array_push($likes, $accountID);
    $this->data['likes'] = implode(';',$likes);
	}
	
	public function AddDisLike($accountID)
	{
		$dislikes = $this->GetDisLikes();
		array_push($dislikes, $accountID);
    $this->data['dislikes'] = implode(';',$dislikes);
	}
	
	public function RemoveLike($accountID)
	{
		$likes = $this->GetLikes();
    $key = array_search($accountID, $likes);
    if($key === false)
      return;
    
		array_splice($likes, $key, 1);
    $this->data['likes'] = implode(';',$likes);
	}
	
	public function RemoveDisLike($accountID)
	{
		$dislikes = $this->GetDisLikes();
    $key = array_search($accountID, $dislikes);
    if($key === false)
      return;
    
		array_splice($dislikes, $key, 1);
    $this->data['dislikes'] = implode(';',$dislikes);
	}
  
}
?>