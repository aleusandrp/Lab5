<?php  
$text = "PHP - язык программирования для web...";  
echo preg_replace("!.+(?<=про)!is", "", $text);  
echo "<br>";
echo $text."<br>";
echo $text."<br>";
echo "<br>";echo "<br>";echo "<br>";?> 





<form enctype="multipart/form-data" action="base.php" method="POST">
    <input type="hidden" name="mas" value="30000" />
    Отправить этот файл: <input name="userfile" type="file" />
    <input type="submit" value="Отправить" />
</form>