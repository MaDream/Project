<?php // серверная часть вывода json
 $login = $_POST['login'];
 $pass = $_POST['pass'];

 $link = mysql_connect("mysql.hostinger.ru", "u539090709_root", "3photon2proton")
         or die("Could not connect : " . mysql_error());
     mysql_select_db("u539090709_db") or die("Could not select database");

$query = "SELECT * FROM `deleted`";
 $result = mysql_query($query);
if(mysql_num_rows($result))
{
 while($row=mysql_fetch_assoc($result))
 {
  $json['delete'][]=$row;
 }
}

 $query = "SELECT `task`.*, `email` FROM `task`, `taskuser`, `user` WHERE `email` = '$login' AND `password` = '$pass' AND `taskuser`.`iduser` = `user`.`id_user` AND `taskuser`.`idtask` = `task`.`idtask` AND `owner` = 1";
 $result = mysql_query($query);
if(mysql_num_rows($result))
{
 while($row=mysql_fetch_assoc($result))
 {
  $json['data'][]=$row;
 }
}

$query = "SELECT `email`,`idTask`,`commentary` FROM `comment`, `user` WHERE `user`.`id_user` = `comment`.`idUser`";
//$fp = fopen('log.txt', 'r+');
 $result = mysql_query($query);
//frwrite($fp, mysql_error());
if(mysql_num_rows($result))
{
 while($row = mysql_fetch_assoc($result))
 {
  $json['comments'][] = $row;
 }
}


echo json_encode($json);
mysql_close($link);

?>