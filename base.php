<?php 
$uploaddir = 'C:/xampp/htdocs/Git/Lab5/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {    
	//$string = file_get_contents(basename($_FILES['userfile']['name']));
	include('UserClass.php');
	include('UserMethods.php');
	$handle = fopen("oldbase.txt", "r");
	
	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $base[] = new User($data[0],$data[1],$data[2],$data[3],$data[4],$data[5],$data[6],
        				   $data[7],$data[8],$data[9],$data[10],$data[11],$data[12],$data[13],
        				   $data[14],$data[15],$data[16]);
	}

    function NewFormat($base){
    	for ($i=0; $i < count($base); $i++) { 
    		// Дополнить номер записи до 6-ти знаков в поле ID 
	        //$base[$i]->ID = preg_replace('/\b(male)\b/', '1', $base[$i]->ID);
    		// Замена male на 1 female на 2 в поле Sex
	        $base[$i]->Sex = preg_replace('/\b(male)\b/', '1', $base[$i]->Sex);
	        $base[$i]->Sex = preg_replace('/\b(female)\b/', '0', $base[$i]->Sex);
	        // Округлить вес до целой части в поле Weight
	        $base[$i]->Weight = preg_replace('/(\d+)(\.?)(\d*)/', '$1', $base[$i]->Weight);
		}   
    }   


	
	EchoBase($base);
	EchoErrors($base);
	CorrectFloor($base);
	EchoBase($base);
	NewFormat($base);
	fclose($handle);

} else {
    die();
}

 ?>
