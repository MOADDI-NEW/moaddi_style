<?php

$host = "localhost";    /* Host name */
$user = "root";         /* User */
$password = "";         /* Password */
$dbname = "moaddi";   /* Database name */

$conn = mysqli_connect($host, $user, $password,$dbname);
$conn->set_charset('utf8');
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}