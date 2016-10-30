<?php 
$uploaddir = 'C:/xampp/htdocs/Git/Lab5/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

class DataBase
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
		echo $this->ID.','.$this->Name.','.$this->Initial.','.$this->SurName.','.$this->Sex.','.$this->City.','.$this->Region.','.$this->Email.','.$this->Phone.','.$this->BirthDay.','.$this->Post.','.$this->Company.','.$this->Weight.','.$this->Height.','.$this->Address.','.$this->Index.','.$this->Code;
	}
}

class Parse{
	public $string;

	function __construct($string){
		$this->string = $string;
	}

	function write(){
		echo $this->string.'<br>';
	}
}

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {    
	//$string = file_get_contents(basename($_FILES['userfile']['name']));
	//$string = preg_replace('/\s/', '', $string);
	//echo $string;
	
	/*
	Email: 7
	Пол: 4
	Номер: 8
	Адрес: 14
	*/
	$row = 1;
	$handle = fopen("oldbase.txt", "r");
	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		$num = count($data);
	        echo $data[7] . "<br />\n";
	 		echo "<br>";

	          if(preg_match('/^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-zA-Z0-9\-.]+$/', $data[7])){
	          	echo "es";
	          }else{
	          	echo "no";
	          }
	 		echo "<br>";
	        echo $data[4] . "<br />\n";
	        echo $data[8] . "<br />\n";
	        echo $data[14] . "<br />\n";	    
	}
	fclose($handle);

} else {
    die();
}

 ?>
