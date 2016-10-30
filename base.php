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
	$Email_Errors = 0;
	$Sex_Errors = 0;
	$Number_Errors = 0;
	$Address_Errors = 0;
	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		//$num = count($data);
        echo $data[0] . "<br />\n";
        echo $data[7] . "<br />\n";
		    if(!(preg_match('/^(([a-zA-Z0-9_\-.]+)@([a-zA-Z0-9\-]+)\.[a-zA-Z0-9\-.]+)$/', $data[7]))){
		    	$Email_Errors++;
		    }
        echo $data[4] . "<br />\n";
	        if(!(preg_match('/^(male|female)$/', $data[4]))){
	          	$Sex_Errors++;
	        }
        echo $data[8] . "<br />\n";
	        if(!(preg_match('/^\d+-\d+-\d+$/', $data[8]))){
	          	$Number_Errors++;
	        }
        echo $data[14] . "<br />\n";
	        if(!(preg_match('/^\d+\s[a-zA-Z]+\s?[a-zA-Z]*\s?[a-zA-Z]*\s?[a-zA-Z]*$/', $data[14]))){
	          	$Address_Errors++;
	        }
	    //$data[14] = preg_replace('/^\d+\s[a-zA-Z]+\s?[a-zA-Z]*\s?[a-zA-Z]*\s?[a-zA-Z]*$/', " ", $data[14]);

        //echo $data[14] . "<br />\n";	    
	}
	echo "В базе ошибок: <br>";
	echo "В поле Email: ".$Email_Errors."<br>";
	echo "В поле Sex: ".$Sex_Errors."<br>";
	echo "В поле Number: ".$Number_Errors."<br>";
	echo "В поле Address: ".$Address_Errors."<br>";
	fclose($handle);

} else {
    die();
}

 ?>
