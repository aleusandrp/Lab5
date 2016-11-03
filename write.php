<?php
if (isset($_GET['area'])) {
	include('UserClass.php');
	$Area = $_GET['area'];
	
	$FirstArea = preg_replace('/(\d*)(.*?)(\d*)/', '$1', $Area)-1;
	$SecondArea = preg_replace('/(\d*)(.*?)(\d*)/', '$3', $Area);

	$handle = fopen("newbase.txt", "r");
	
	while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
        $base[] = new User($data[0],$data[1],$data[2],$data[3],$data[4],$data[5],$data[6],
        				   $data[7],$data[8],$data[9],$data[10],$data[11],$data[12],$data[13],
        				   $data[14],$data[15],$data[16]);
	}
	fclose($handle);

	function WriteArea($base,$FirstArea,$SecondArea){

		for ($i=$FirstArea; $i < $SecondArea; $i++) {
			if (!($base[$i]->Sex == " ")) {
				$NewBase[$i]['Id'] = $base[$i]->ID;
				$NewBase[$i]['Name'] = $base[$i]->Name;
				$NewBase[$i]['Sex'] = $base[$i]->Sex;
				$NewBase[$i]['Age'] = (2016 - (preg_replace('/^(\d*).(\d*).(\d*)$/','$3', $base[$i]->BirthDay)));
				$NewBase[$i]['Email'] = $base[$i]->Email;
			}
		}
		
		$items = [];
		foreach($NewBase as $NewBase) {
		  $items[$NewBase["Name"]][] = $NewBase;
		}

		ksort($items);

		echo "Вывод с ".($FirstArea+1)." по ".$SecondArea." ID<br>==================";
		foreach($items as $group) {
		  echo "<div>";
		  foreach($group as $filter) {
		  	if ($filter['Sex'] == "0") {
		    	echo
		    		"Имя: "."<span style=\"color: red\">".$filter['Name']."</span>"."<br>".
		    		"Возраст: ".$filter['Age']."<br>".
		    		"Email: ".$filter['Email']."<br>"."=================="."<br>";
		  	}else{
		    	echo
		    		"Имя: "."<span style=\"color: blue\">".$filter['Name']."</span>"."<br>".
		    		"Возраст: ".$filter['Age']."<br>".
		    		"Email: ".$filter['Email']."<br>"."=================="."<br>";
		  	}
		  }
		  echo "</div>";
		}
	}
	WriteArea($base,$FirstArea,$SecondArea);
	unset($base);	
} 
 ?>