<?php 
ob_start(); //Output Buffering Start 
include 'dashbord/admin/connect.php';
include 'dashbord/functions/admin_functions.php';
include 'dashbord/functions/front_functions.php';
$settings = getSettingsToHomePage($con); 
$pageTitle = $settings[0] . ' _ ' .'الرئيسية';  
include 'front_temp/head.php';
include 'front_temp/navbar.php';

include 'front_temp/Block_01_Hero.php';
include 'front_temp/Block_02_Who_we_are.php';
include 'front_temp/Block_03_Services.php';
include 'front_temp/Block_04_2banners.php';
include 'front_temp/Block_05_partners.php';
include 'front_temp/Block_06_News.php';
include 'front_temp/Block_07_ads.php';


include 'front_temp/footer.php';
include 'front_temp/footer_script.php';
ob_end_flush();
