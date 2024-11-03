<?php 
ob_start();
session_start();
$noNavbar = '';
$main_header_edara = '';
$main_sidebar_edara = '';
$pageTitle = 'الصفحة الرئيسية';  // this function to load page title
include 'init.php';   //  Dirctory page

if (isset($_SESSION['Edara30'])){
	$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
	$getUser->execute(array($_SESSION['Edara30']));
	$info = $getUser->fetch();
	?>

	
		<?php include 'breadcrumb.php';?>

		<?php 
		if (array_search($info['GroupID'], ['1','2','3']) !== false) {
			include 'dashbord_stat_view_admin.php';							
		}
		?>


<?php
}else{
	header ('location: ../index');
	exit();
}
include   $tpl . 'footer.php';
include   $tpl . 'footer-scripts.php';
ob_end_flush();
?>