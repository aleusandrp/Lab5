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
	
	EchoBase($base);
	EchoErrors($base);
	CorrectFloor($base);
	NewFormat($base);
	//EchoBase($base);
	CreateNewBase($base);

	unset($base);

	fclose($handle);
} else {
    die();
}
?>
<br>
<form enctype="multipart/form-data" action="newbase.php" method="POST">
    <input type="hidden" name="mas" value="30000" />
    Загрузить новую базу: <br><input name="userfile" type="file" />
    <input type="submit" value="Отправить" />
</form>
