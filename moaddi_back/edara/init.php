<?php
include '../admin/connect.php';


// Routes المسارات
$tpl = '../template/';              // Tamplates Diractory
$func = '../functions/';            // functions Diractory
$css = '../assets/';                // css Diractory
$js = '../assets/';                 // js Diractory

// Incloud the important file
include $func . 'admin_functions.php';
include $func . 'front_functions.php';
include $tpl . 'head.php';

// Include Navbar on All Page exept  the one with Navbar varible

if (!isset($noNavbar)) {
	include $tpl . 'navbar.php';
}
if (isset($main_header_edara)) {
	include $tpl . 'main_header_edara.php';
}
if (isset($main_sidebar_edara)) {
	include $tpl . 'main_sidebar_edara.php';
}

