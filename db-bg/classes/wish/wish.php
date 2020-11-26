<?php
if($database == NULL)
{
	print 'This File ('.__FILE__.') should be after Datatabase!';
}

class Wish
{
	private $data;
  
	function __construct($data)
	{
		$this->data = $data;
	}
	
  public function GetID()
  {
    return $this->data['id'];
  }
  
  public function GetType()
  {
    return $this->data['type'];
  }
  
  public function GetDisplayName()
  {
    return $this->data['displayname'];
  }
  
  public function GetValue()
  {
    return $this->data['value'];
  }
  
  public function GetItems()
  {
    return $this->data['items'];
  }
  
  public function IsRewishable()
  {
    return $this->data['rewishable'] == 1;
  }
  
}