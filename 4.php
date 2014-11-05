<?php
 	$str = $_POST['login'];
	//$fp = fopen('log.txt', 'r+');
	//fwrite($fp, $str);
	$str = stripslashes($str);
 	$arr = json_decode($str, true);
	$link = mysql_connect("mysql.hostinger.ru", "u539090709_root", "3photon2proton")
	        or die("Could not connect : " . mysql_error());
	mysql_select_db("u539090709_db") or die("Could not select database");
	for ($i = 0; $i < count($arr); $i++)
	{
		$tid[$i] = $arr[$i]['idTask'];
		$query = "DELETE FROM `task` WHERE `idTask` = '$tid[$i]'";
		$result = mysql_query($query, $link);
		//fwrite($fp, mysql_error());		

		$query = "DELETE FROM `taskuser` WHERE `idTask` = '$tid[$i]'";
		$result = mysql_query($query, $link);
		//fwrite($fp, mysql_error());			
	}
?>