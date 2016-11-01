<?php 
class User
{
	public $ID;
	public $Name;
	public $Initial;
	public $SurName;
	public $Sex;
	public $City;
	public $Region;
	public $Email;
	public $Phone;
	public $BirthDay;
	public $Post;
	public $Company;
	public $Weight;
	public $Height;
	public $Address;
	public $Index;
	public $Code;
	
	function __construct($ID,$Name,$Initial,$SurName,$Sex,$City,$Region,$Email,$Phone,$BirthDay,$Post,$Company,$Weight,$Height,$Address,$Index,$Code){
	$this->ID = $ID;	
	$this->Name = $Name;	
	$this->Initial = $Initial;	
	$this->SurName = $SurName;	
	$this->Sex = $Sex;	
	$this->City = $City;
	$this->Region = $Region;	
	$this->Email = $Email;	
	$this->Phone = $Phone;	
	$this->BirthDay = $BirthDay;	
	$this->Post = $Post;	
	$this->Company = $Company;	
	$this->Weight = $Weight;	
	$this->Height = $Height;	
	$this->Address = $Address;	
	$this->Index = $Index;	
	$this->Code = $Code;	
	}

	function write(){
		echo $this->ID.';'.$this->Name.';'.$this->Initial.';'.$this->SurName.';'.$this->Sex.';'.$this->City.';'.$this->Region.';'.$this->Email.';'.$this->Phone.';'.$this->BirthDay.';'.$this->Post.';'.$this->Company.';'.$this->Weight.';'.$this->Height.';'.$this->Address.';'.$this->Index.';'.$this->Code.'<br>';
	}
	function baseprint(){
		return $this->ID.';'.$this->Name.';'.$this->Initial.';'.$this->SurName.';'.$this->Sex.';'.$this->City.';'.$this->Region.';'.$this->Email.';'.$this->Phone.';'.$this->BirthDay.';'.$this->Post.';'.$this->Company.';'.$this->Weight.';'.$this->Height.';'.$this->Address.';'.$this->Index.';'.$this->Code.PHP_EOL;
	}
}

?>