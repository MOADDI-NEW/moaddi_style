<?php
ob_start();
session_start();
$noNavbar = '';
$main_header_edara = '';
$main_sidebar_edara = '';

if (isset($_SESSION['Edara30'])){
    $pageTitle = 'مقدمي الخدمات';  // this function to load page title
    include 'init.php';   //  Dirctory page


	$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
	$getUser->execute(array($_SESSION['Edara30']));
	$info = $getUser->fetch();
    
    include 'breadcrumb.php';
	if (array_search($info['role'], ['30']) !== false) { //   ادارة 
        
        

        $providerId = $_POST['providerId'];
        $imageName = $_POST['imageName'];
        
        // 1. Delete the image from the database
        $stmt = $con->prepare("UPDATE providers SET gallery = REPLACE(gallery, ?, '') WHERE id = ?");
        $stmt->execute([$imageName, $providerId]);
        
        // 2. Delete the image file from the folder
        $imagePath = '../admin/nsharat_uploads/gallery/' . $imageName;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        
        echo 'success';



    }
}