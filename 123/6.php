<?php
$tid = $_POST['idTask'];
$login = $_POST['login'];
$comment = $_POST['textComment'];

$fp = fopen('log.txt', 'r+');
 fwrite($fp, $tid);
 fwrite($fp, $login);
 fwrite($fp, $comment);

$link = mysql_connect("mysql.hostinger.ru", "u539090709_root", "3photon2proton"); 
mysql_select_db("u539090709_db");

$query = "SELECT `idUser` FROM `user` WHERE `email` = '$login'";
$result = mysql_query($query, $link);
$ar = mysql_fetch_array($result);
$uid = $ar[0]['idUser'];
$query = "INSERT INTO `comment` (`idUser`, `idTask`, `commentary`) VALUES ('$uid', '$tid', '$comment')";
$result = mysql_query($query, $link);

?>