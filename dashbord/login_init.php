<?php
// Error Reporting
//ini_set('display_errors', 'on');
//error_reporting(E_ALL);

include 'admin/connect.php';

$sessionUseer = '';
if (isset($_SESSION['user'])) {
	$sessionUseer = $_SESSION['user'];
}



// Routes المسارات

$tpl = 'template/';              // Tamplates Diractory   مسار 
$func = 'functions/';                               // functions Diractory
$css = 'assets/';                        // css Diractory          مسار
$js = 'assets/';                        // js Diractory              مسار


// Incloud the important file
include $func . 'admin_functions.php';
include $func . 'front_functions.php';


// Include Navbar on All Page exept  the one with Navbar varible

if (!isset($noNavbar)) {
	include $tpl . 'navbar.php';
}
