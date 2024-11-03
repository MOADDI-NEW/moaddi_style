<?php

$dsn = 'mysql:host=localhost;dbname=moaddi';
$user = 'root';
$pass = '';
/*
$dsn = 'mysql:host=localhost;dbname=hefzmoy1_deoplomhefz';
$user = 'hefzmoy1_deplom';
$pass = 'sXF2RHpKn@ok';
 */
$option = array(
	PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8, time_zone = "+2:00"',
	PDO::ATTR_TIMEOUT => 5, // in seconds
	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);

try {
	$con = new PDO($dsn, $user, $pass, $option);
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//$con->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);
} catch (PDOException $e) {
	echo 'Faild to connect' . $e->getMessage();
}
