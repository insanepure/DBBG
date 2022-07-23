<?php
class PM
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
  
  public function IsHTML()
  {
    return $this->data['ishtml'];
  }
  
  public function GetSenderName()
  {
    return $this->data['sendername'];
  }
  
  public function GetSenderImage()
  {
    return $this->data['senderimage'];
  }
  
  public function GetSenderID()
  {
    return $this->data['senderid'];
  }
  
  public function GetReceiverID()
  {
    return $this->data['receiverid'];
  }
  
  public function GetReceiverName()
  {
    return $this->data['receivername'];
  }
  
  public function GetText()
  {
		if($this->IsHTML())
		{
			return $this->data['text'];
		}
    return htmlspecialchars($this->data['text']);
  }
  
  public function GetTopic()
  {
      if($this->IsHTML()) {
          return $this->data['topic'];
      }
      return htmlspecialchars($this->data['topic']);
  }
  
  public function GetTime()
  {
		$dateStr = strtotime( $this->data['time'] );
		$formatedDate = date( 'd.m.Y H:i', $dateStr );
    return $formatedDate;
  }
  
  public function GetRead()
  {
    return $this->data['read'];
  }
}
?>