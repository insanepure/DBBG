<?php

class ClanShoutboxMSG
{
  private $data;
  
	function __construct($data)
  {
    $this->data = $data;
  }
  
  public function GetData()
  {
    return implode(';',$this->data);
  }
  
  public function GetDate()
  {
    return $this->data[0];
  }
  
  public function GetFrom()
  {
    if($this->data[1] == 0)
    {
      return $this->data[2];
    }
    return '<a href="?p=profil&id='.$this->data[1].'">'.$this->data[2].'</a>';
  }
  
  public function GetText()
  {
    return $this->data[3];
  }
  
  
}

?>