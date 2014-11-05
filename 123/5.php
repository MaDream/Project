<?php
$idTask = $_POST['idTask'];
$login = $_POST['log'];
$link = mysql_connect("mysql.hostinger.ru", "u539090709_root", "3photon2proton");
mysql_select_db("u539090709_db");
$query = "SELECT `id_user` FROM `user` WHERE `email` = '$login'";
$result = mysql_query($query);
$ar = mysql_fetch_array($result);
$idUser = $ar[0]['id_user'];
$query = "INSERT INTO `taskuser` VALUES ('$idTask', '$idUser', 0)";
$result = mysql_query($query);
?>