<?php 
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
	// Вывод базы
	function EchoBase($base){
		for ($i=0; $i < count($base); $i++) { 
			$base[$i]->write();
		}
	}
	// Вывод отчета об ошибках
	function EchoErrors($base){
		echo "В базе ошибок: <br>";
		echo "В поле Email: ".ParseEmail($base)."<br>";
		echo "В поле Sex: ".ParseSex($base)."<br>";
		echo "В поле Number: ".ParsePhone($base)."<br>";
		echo "В поле Address: ".ParseAddress($base)."<br>";
	}
	// Исправление ошибок в полях
    function CorrectFloor($base){
		for ($i=0; $i < count($base); $i++) { 
	        // Исправление поля Email
	        if(!(preg_match('/[@]/', $base[$i]->Email))){
		    	$base[$i]->Email = " ";
		    }
	        $base[$i]->Email = preg_replace('/[^a-zA-Z0-9@_\-.]/', '', $base[$i]->Email);
	        $base[$i]->Email = preg_replace('/(@+)/', '@', $base[$i]->Email);
	        $base[$i]->Email = preg_replace('/(\.+)/', '.', $base[$i]->Email);
			//Исправление поля Sex
			if(!(preg_match('/^(male|female|\s)$/', $base[$i]->Sex))){
	          	$base[$i]->Sex = " ";
		    }
		    // Исправление поля Phone
	        $base[$i]->Phone = preg_replace('/[^0-9-]/', '', $base[$i]->Phone);
	        $base[$i]->Phone = preg_replace('/(-+)/', '-', $base[$i]->Phone);
		    // Исправление поля Address
	        $base[$i]->Address = preg_replace('/(\d+)(.?)(.*)/', '$1 $3', $base[$i]->Address);
		}    	
	}
	// Приведение базы к новому виду
	function NewFormat($base){
    	for ($i=0; $i < count($base); $i++) { 
    		// Дополнить номер записи до 6-ти знаков в поле ID 
	        $base[$i]->ID = str_pad($base[$i]->ID, 6, '0', STR_PAD_LEFT);;
    		// Замена male на 1 female на 2 в поле Sex
	        $base[$i]->Sex = preg_replace('/\b(male)\b/', '1', $base[$i]->Sex);
	        $base[$i]->Sex = preg_replace('/\b(female)\b/', '0', $base[$i]->Sex);
	        // Какая то хуйня с телефоном

	        // Перевести из формата м/д/гггг в дд.мм.гггг
	        $base[$i]->BirthDay = preg_replace('/(\d{1,2})\/(\d{1,2})\/(\d{4})/', '$1.$2.$3', $base[$i]->BirthDay);
			if(strlen(preg_replace('/(\d*).(\d*).(\d*)/', '$1', $base[$i]->BirthDay)) == 1)
			    $base[$i]->BirthDay = preg_replace('/(\d*).(\d*).(\d*)/', '0$1.$2.$3', $base[$i]->BirthDay);
			if(strlen(preg_replace('/(\d*).(\d*).(\d*)/', '$2', $base[$i]->BirthDay)) == 1)
			    $base[$i]->BirthDay = preg_replace('/(\d*).(\d*).(\d*)/', '$1.0$2.$3', $base[$i]->BirthDay);
	        // Округлить вес до целой части в поле Weight
	        $base[$i]->Weight = preg_replace('/(\d+)(\.?)(\d*)/', '$1', $base[$i]->Weight);
	        //Перенести номер дома в конец адреса, отделив запятой
	        $base[$i]->Address = preg_replace('/(\d+).(.*)/', '$2, $1', $base[$i]->Address);
		}   
    } 
	// Создание нового файла с базой
	function CreateNewBase($base){
		$fp = fopen("newbase.txt", "a");
		for ($i=0; $i < count($base); $i++) { 
			fwrite($fp, $base[$i]->baseprint());
		} 
		fclose($fp);
	}
 ?>