<?php
 	$str = $_POST['login'];
	$fp = fopen('log.txt', 'r+');
	fwrite($fp, $str);	
	$str = stripslashes($str);
 	$arr = json_decode($str, true);
	$link = mysql_connect("mysql.hostinger.ru", "u539090709_root", "3photon2proton")
	        or die("Could not connect : " . mysql_error());
	mysql_select_db("u539090709_db") or die("Could not select database");
	for ($i = 0; $i < count($arr); $i++)
	{
		$name[$i] = $arr[$i]['name'];
		$login[$i] = $arr[$i]['log'];
		$output[$i] = $arr[$i]['output'];
		$parentTask[$i] = $arr[$i]['parentTask'];
		$progress[$i] = $arr[$i]['progress'];
		$done[$i] = $arr[$i]['done'];
		$taskTime[$i] = $arr[$i]['taskTime'];
		$theStartTime[$i] = $arr[$i]['theStartTime'];
		$endTime[$i] = $arr[$i]['endTime'];
		$specification[$i] = $arr[$i]['specification'];
		$query = "INSERT INTO `task` (`output`, `parentTask`, `progress`, `done`, `taskTime`, `thestartTime`, `endTime`, `name`, `specification`) VALUES ('$output[$i]', '$parentTask[$i]', '$progress[$i]', '$done[$i]', '$taskTime[$i]', '$theStartTime[$i]', '$endTime[$i]', '$name[$i]', '$specification[$i]')";
		$result = mysql_query($query, $link);
		//fwrite($fp, mysql_error());		

		$query = "SELECT `idTask` FROM `task` WHERE `name` = '$name[$i]' ORDER BY `idTask` DESC LIMIT 1";
		$result = mysql_query($query, $link);
		//fwrite($fp, mysql_error());			

		$ar = mysql_fetch_array($result);
		$query = "SELECT `idUser` FROM `user` WHERE `email` = '$login[$i]'";
		$result = mysql_query($query, $link);
		//fwrite($fp, mysql_error());	

		$at = mysql_fetch_array($result);
		$query = "INSERT INTO `taskuser` VALUES ('$ar[0]', '$at[0]', 1)";
		$result = mysql_query($query, $link);
		//fwrite($fp, mysql_error());	
	}
?>