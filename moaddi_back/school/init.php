<?php
// Error Reporting
//ini_set('display_errors', 'on');
//error_reporting(E_ALL);

include '../admin/connect.php';

$sessionUseer = '';
if (isset($_SESSION['user'])) {
	$sessionUseer = $_SESSION['user'];
}

// Routes المسارات

$tpl = '../template/';              // Tamplates Diractory    
$func = '../functions/';             // functions Diractory
$css = '../assets/';                 // css Diractory          
$js = '../assets/';                   // js Diractory      


// Incloud the important file
include $func . 'admin_functions.php';
include $tpl . 'head.php';


// Include Navbar on All Page exept  the one with Navbar varible

if (!isset($noNavbar)) {
	include $tpl . 'navbar.php';
}
if (isset($main_header_school)) {
	include $tpl . 'main_header_school.php';
}
if (isset($main_sidebar_school)) {
	include $tpl . 'main_sidebar_school.php';
}
