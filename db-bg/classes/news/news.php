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
}
?>