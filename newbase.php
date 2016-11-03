<?php 
$uploaddir = 'C:/xampp/htdocs/Git/Lab5/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {    
	$string = file_get_contents(basename($_FILES['userfile']['name']));
	include('UserClass.php');
	include('NewbaseMethods.php');

	$handle = fopen("newbase.txt", "r");
	
	while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
        $base[] = new User($data[0],$data[1],$data[2],$data[3],$data[4],$data[5],$data[6],
        				   $data[7],$data[8],$data[9],$data[10],$data[11],$data[12],$data[13],
        				   $data[14],$data[15],$data[16]);
	}
	fclose($handle);

	
	WHOStats($base);
	OldNew($base);
	MailSort($base);
	HolyBirthDay($base);
	unset($base);
	include('write.php');
} else {
	echo "Ошибка";
}
?>
<form action="write.php" method="GET">
	<p><label for="name"> Диапазон вывода </label>
	<input type="text" name="area"></p>
	<p><input type="submit" value="Ввод"></p>
</form>