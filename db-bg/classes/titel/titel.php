<?php
if($database == NULL)
{
	print 'This File ('.__FILE__.') should be after Datatabase!';
}

class Titel
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
  
  public function GetName()
  {
    return $this->data['name'];
  }
  
  public function GetDescription()
  {
    return $this->data['description'];
  }
  
  public function GetColor()
  {
    return $this->data['color'];
  }
  
  public function GetType()
  {
    return $this->data['type'];
  }
  
  public function GetCondition()
  {
    return $this->data['typecondition'];
  }
  
  public function GetNPC()
  {
    return $this->data['typenpc'];
  }
  
  public function GetFight()
  {
    return $this->data['typefight'];
  }
  
  public function GetAction()
  {
    return $this->data['typeaction'];
  }
  
  public function GetItem()
  {
    return $this->data['item'];
  }
  
  public function GetSort()
  {
    return $this->data['typesort'];
  }
  
  public function GetAttack()
  {
    return $this->data['typeattack'];
  }
  
  public function GetStar()
  {
    return $this->data['star'];
  }
}