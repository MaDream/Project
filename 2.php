<?php
 $idTask = $_POST['idTask'];
 $output = $_POST['output'];
 $parentTask = $_POST['parentTask'];
 $progress = $_POST['progress'];
 $done = $_POST['done'];
 $taskTime = $_POST['taskTime'];
 $theStartTime = $_POST['theStartTime'];
 $endTime = $_POST['endTime'];
 $name = $_POST['name'];
 $specification = $_POST['specification'];
$fp = fopen('log.txt', 'r+');
 fwrite($fp, $idTask.' ');
 fwrite($fp, $output.' ');
 fwrite($fp, $parentTask.' ');
 fwrite($fp, $progress.' ');
 fwrite($fp, $done.' ');
 fwrite($fp, $taskTime.' ');
 fwrite($fp, $theStartTime.' ');
 fwrite($fp, $endTime.' ');
 fwrite($fp, $name.' ');
 fwrite($fp, $specification);
 $link = mysql_connect("mysql.hostinger.ru", "u539090709_root", "3photon2proton")
         or die("Could not connect : " . mysql_error());
     mysql_select_db("u539090709_db") or die("Could not select database");
 $query = "UPDATE `task` SET `output` = '$output', `parentTask` = '$parentTask', `progress` = '$progress', `done` = '$done', `taskTime` = '$taskTime', `theStartTime` = '$theStartTime', `endTime` = '$endTime', `name` = '$name', `specification` = '$specification' WHERE `idTask` = '$idTask'";
 $result = mysql_query($query, $link);
 //fwrite($fp, mysql_error());
?>