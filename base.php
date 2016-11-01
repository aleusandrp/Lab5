<?php 
$uploaddir = 'C:/xampp/htdocs/Git/Lab5/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

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
}

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {    
	//$string = file_get_contents(basename($_FILES['userfile']['name']));

	
	$handle = fopen("oldbase.txt", "r");
	
	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $base[] = new User($data[0],$data[1],$data[2],$data[3],$data[4],$data[5],$data[6],
        				   $data[7],$data[8],$data[9],$data[10],$data[11],$data[12],$data[13],
        				   $data[14],$data[15],$data[16]);    
        /*------------------------*/
        /*echo $data[7] . "<br />\n";
		    if(!(preg_match('/^(([a-zA-Z0-9_\-.]+)@([a-zA-Z0-9\-]+)\.[a-zA-Z0-9\-.]+)$/', $data[7]))){
		    	$Email_Errors++;
		    }
		//$data[7] = preg_replace('/[^a-zA-Z0-9_\-.]@/', '', $data[7]);
        //$data[7] = preg_replace('/([a-zA-Z0-9_\-.]+)@+/', '@', $data[7]);
        //$data[7] = preg_replace('/\.+/', '.', $data[7]);
		//echo $data[7]."<br>";
		/*Счетчик и удаление сбиых полей пол */
        /*echo $data[4] . "<br />\n";
	        if(!(preg_match('/^(male|female)$/', $data[4]))){
	          	$Sex_Errors++;
	          	$data[4] = "";
		        }
        /*Счетчик ошибок в номере и удаление лишних символов*/
        /*echo $data[8] . "<br />\n";
	        if(!(preg_match('/^\d+-\d+-\d+$/', $data[8]))){
	          	$Number_Errors++;
		        $data[8] = preg_replace('/[^0-9-]/', '', $data[8]);
		        $data[8] = preg_replace('/-+/', '-', $data[8]);
	        }
        /*-----------------------.*/
    	/*echo $data[14] . "<br />\n";
        if(!(preg_match('/^\d+\s[a-zA-Z]+\s?[a-zA-Z]*\s?[a-zA-Z]*\s?[a-zA-Z]*$/', $data[14]))){
          	$Address_Errors++;
        }
        $data[14] = preg_replace('#.+?\d#', '', $data[14]);
        echo $data[14];*/
	}
	// Поиск ошибок в поле Email исходной базы
	function ParseEmail($base){
		$Err = 0;
		for ($i = 0; $i < count($base); $i++) {
			if(!(preg_match('/^(([a-zA-Z0-9_\-.]+)@([a-zA-Z0-9\-]+)\.[a-zA-Z0-9\-.]+)$/', $base[$i]->Email))){
		    	$Err++;
		    }
		}
		return $Err;
	}
	// Поиск ошибок в поле Sex исходной базы
	function ParseSex($base){
		$Err = 0;
		for ($i = 0; $i < count($base); $i++) { 
			if(!(preg_match('/^(male|female)$/', $base[$i]->Sex))){
	          	$Err++;
		    }
		}
		return $Err;
	}
	// Поиск ошибок в поле Phone исходной базы
	function ParsePhone($base){
		$Err = 0;
		for ($i = 0; $i < count($base); $i++) { 
			if(!(preg_match('/^\d+-\d+-\d+$/', $base[$i]->Phone))){
	          	$Err++;
	        }
		}
		return $Err;
	}
	// Поиск ошибок в поле Address исходной базы
	function ParseAddress($base){
		$Err = 0;
		for ($i = 0; $i < count($base); $i++) { 
			if(!(preg_match('/^\d+\s[a-zA-Z]+\s?[a-zA-Z]*\s?[a-zA-Z]*\s?[a-zA-Z]*$/', $base[$i]->Address))){
          		$Err++;
        	}
		}
		return $Err;
	}
	//Вывод базы
	function EchoBase($base){
		for ($i=0; $i < count($base); $i++) { 
			$base[$i]->write();
		}
	}
	EchoBase($base);
	echo "В базе ошибок: <br>";
	echo "В поле Email: ".ParseEmail($base)."<br>";
	echo "В поле Sex: ".ParseSex($base)."<br>";
	echo "В поле Number: ".ParsePhone($base)."<br>";
	echo "В поле Address: ".ParseAddress($base)."<br>";
	fclose($handle);

} else {
    die();
}

 ?>
