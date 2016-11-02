<?php 
	// Вывод базы
	function EchoBase($base){
		for ($i=0; $i < count($base); $i++) { 
			$base[$i]->write();
		}
	}
	function WHOStats($base){
		$male = 0;
		$maleWeight = 0;
		$maleHeight = 0;
		$maleOld = 0;
		$female = 0;
		$femaleWeight = 0;
		$femaleHeight = 0;
		$femaleOld = 0;

		//Считаем кол-во М и Ж, и их суммарный рост, вес и возраст
		for ($i=0; $i < count($base); $i++) { 
			if(preg_match('/^1$/', $base[$i]->Sex)){
	          	$male++;
	          	$maleWeight += $base[$i]->Weight;
	          	$maleHeight += $base[$i]->Height;
	          	$maleOld += (2016 - preg_replace('/^(\d*).(\d*).(\d*)$/','$3', $base[$i]->BirthDay));
	        }
		    elseif(preg_match('/^0$/', $base[$i]->Sex)){
		    	$female++;
	          	$femaleWeight += $base[$i]->Weight;
	          	$femaleHeight += $base[$i]->Height;
	          	$femaleOld += (2016 - preg_replace('/^(\d*).(\d*).(\d*)$/','$3', $base[$i]->BirthDay));
		    }
		}

		$maleWeight = $maleWeight/$male;
	 	$maleHeight = $maleHeight/$male;
	 	$maleOld = $maleOld/$male;
	 	$femaleHeight = $femaleHeight/$female;
		$femaleWeight = $femaleWeight/$female;
		$femaleOld = $femaleOld/$female;

	 	// Рост вес возраст М 
	 	$HmaleX = 0;
	 	$HmaleXX = 0;
	 	$HmaleXXX = 0;
	 	$WmaleX = 0;
	 	$WmaleXX = 0;
	 	$WmaleXXX = 0;
	 	$OmaleX = 0;
	 	$OmaleXX = 0;
	 	$OmaleXXX = 0;
	 	// Рост вес возраст Ж
	 	$HfemaleX = 0;
	 	$HfemaleXX = 0;
	 	$HfemaleXXX = 0;
	 	$WfemaleX = 0;
	 	$WfemaleXX = 0;
	 	$WfemaleXXX = 0;
	 	$OfemaleX = 0;
	 	$OfemaleXX = 0;
	 	$OfemaleXXX = 0;

		for ($i=0; $i < count($base); $i++) {
		if(preg_match('/^1$/', $base[$i]->Sex)){
			$Age = (2016 - preg_replace('/^(\d*).(\d*).(\d*)$/','$3', $base[$i]->BirthDay))."<br>"; 
			// Статистика по среднему росту М
			if($base[$i]->Height > $maleHeight)
				$HmaleXXX++;
			elseif($base[$i]->Height == $maleHeight)
				$HmaleXX++;
			elseif ($base[$i]->Height < $maleHeight)
				$HmaleX++;
			// Статистика по среднему весу М
			if($base[$i]->Weight > $maleWeight)
				$WmaleXXX++;
			elseif($base[$i]->Weight == $maleWeight)
				$WmaleXX++;
			elseif ($base[$i]->Weight < $maleWeight)
				$WmaleX++;
			// Статистика по среднему возрасту М
			if($Age > $maleOld)
				$OmaleXXX++;
			elseif($Age == $maleOld)
				$OmaleXX++;
			elseif ($Age < $maleOld)
				$OmaleX++;
			unset($Age);
	    }
	    elseif(preg_match('/^0$/', $base[$i]->Sex)){
			$Age = (2016 - preg_replace('/^(\d*).(\d*).(\d*)$/','$3', $base[$i]->BirthDay))."<br>"; 
			// Статистика по среднему росту Ж
			if($base[$i]->Height > $femaleHeight)
				$HfemaleXXX++;
			elseif($base[$i]->Height == $femaleHeight)
				$HfemaleXX++;
			elseif ($base[$i]->Height < $femaleHeight)
				$HfemaleX++;
			// Статистика по среднему весу Ж
			if($base[$i]->Weight > $femaleWeight)
				$WfemaleXXX++;
			elseif($base[$i]->Weight == $femaleWeight)
				$WfemaleXX++;
			elseif ($base[$i]->Weight < $femaleWeight)
				$WfemaleX++;
			// Статистика по среднему возрасту Ж
			if($Age > $maleOld)
				$OfemaleXXX++;
			elseif($Age == $femaleOld)
				$OfemaleXX++;
			elseif ($Age < $femaleOld)
				$OfemaleX++;
			unset($Age);
	    	}
		}

		echo "<br>Мужчин: ".$male.
			 "<br>Женщин: ".$female.
			 "<br>Средний вес мужчин: ".$maleWeight.
			 "<br>Средний рост мужчин: ".$maleHeight.
			 "<br>Средний возраст мужчин: ".$maleOld.
			 "<br>Средний вес женщин: ".$femaleWeight.
			 "<br>Средний рост женщин: ".$femaleHeight.
			 "<br>Средний возраст женщин: ".$femaleOld."<br>"
			 ;
		echo "<br>Мужчин выше среднего роста: ".$HmaleXXX.
			 "<br>Мужчин среднего роста: ".$HmaleXX.
			 "<br>Мужчин меньше среднего роста: ".$HmaleX.
			 "<br>Мужчин выше среднего веса: ".$WmaleXXX.
			 "<br>Мужчин среднего веса: ".$WmaleXX.
			 "<br>Мужчин меньше среднего веса: ".$WmaleX.
			 "<br>Мужчин выше среднего возраств: ".$OmaleXXX.
			 "<br>Мужчин среднего возраств: ".$OmaleXX.
			 "<br>Мужчин меньше среднего возраств: ".$OmaleX."<br>"
			 ;
		echo "<br>Женщин выше среднего роста: ".$HfemaleXXX.
			 "<br>Женщин среднего роста: ".$HfemaleXX.
			 "<br>Женщин меньше среднего роста: ".$HfemaleX.
			 "<br>Женщин выше среднего веса: ".$WfemaleXXX.
			 "<br>Женщин среднего веса: ".$WfemaleXX.
			 "<br>Женщин меньше среднего веса: ".$WfemaleX.
			 "<br>Женщин выше среднего возраств: ".$OfemaleXXX.
			 "<br>Женщин среднего возраств: ".$OfemaleXX.
			 "<br>Женщин меньше среднего возраств: ".$OfemaleX
			 ;
	}
 ?>