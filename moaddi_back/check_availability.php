<?php 
require_once("./admin/connect.php");
// Code for checking username availabilty
if(!empty($_POST["Username"])) {
$uname= $_POST["Username"];
$sql ="SELECT Username FROM  users WHERE Username=:uname";
$query= $con -> prepare($sql);
$query-> bindParam(':uname', $uname, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
echo "<span style='color:red'> اسم المستخدم غير متاح .. اختر اسم أخر</span>";
} else{	
echo "<span style='color:green'> اسم المستخدم متاح؛ استكمل ملأ البيانات </span>";
}
}