<?php 
// Project Name  ::  Directorate of Education in Kafr El-Sheikh
// Created In    ::  01 - 01 - 2020                                      
// Developed by ::  Alaa Amer  - 01014714795  - Baltim - Kafr El-Sheikh 
ob_start();
session_start();
$noNavbar = '';
$main_header_school = '';
$main_sidebar_school = '';
$pageTitle = 'Moaddi - Home page';  // this function to load page title
include 'init.php';   //  Dirctory page

if (isset($_SESSION['user'])){
$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
$getUser->execute(array($sessionUseer));
$info = $getUser->fetch();
	

if (array_search($info['RegStatus'], ['1']) !== false) { // مسجل بالدبلوم 
	
		include 'breadcrumb.php';?>
			<div class="container-fluid">
				<div class="row row-sm row-deck">
						<?php include 'basic_school_dashbord_info.php';?>
				</div>
			</div>
			
			
			<?php
	}else{
		echo'<meta http-equiv = "refresh" content = "0; url = redirect" />';
	}


}else{
	header ('location: ../index');
	exit();
}
include   $tpl . 'footer.php';
include   $tpl . 'footer-scripts.php';
ob_end_flush();
?>