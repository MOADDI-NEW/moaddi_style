<?php 
ob_start();
session_start();
$noNavbar = '';
$main_header_edara = '';
$main_sidebar_edara = '';
$pageTitle = ' حسابات المشتركين';  // this function to load page title
include 'init.php';   //  Dirctory page

if (isset($_SESSION['Edara30'])){
	$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
	$getUser->execute(array($_SESSION['Edara30']));
	$info = $getUser->fetch();
	?>

	
    <?php include 'breadcrumb.php';
    if (array_search($info['GroupID'], ['1']) !== false) {	   // مدير + مساعد  ?>

        <script type="text/javascript">function printDiv(n){var e=document.getElementById(n).innerHTML,t=document.body.innerHTML;document.body.innerHTML="<html><head><title></title></head><body>"+e+"</body>",window.print(),document.body.innerHTML=t}</script>
        <div id="printablediv"> 
            <div class="card card-widget widget-user-2">
                <div class="widget-user-header" style="background-color: #0d88ed3b!important;"> <div class="widget-user-image"><img class="img-circle elevation-2" src="../../assets/img/faces/main_logo128.jpg" alt="User Avatar" style="border-radius:0px;"></div> <h3 class="widget-user-username"> World <b class="text-danger"> Of </b> Tech</b>  </h3> <h5 class="widget-user-desc"> حسابات المشتركين </h5> </div>
            </div><?php
                echo '<h4 class="text-center bg-dark py-2"> كشف المشتركين - <span style="color: #08f93f!important;font-weight:600;"> مسدد  </span> </h4>';
                $PaidSubscribers = getPaidSubscribers_01(1); echo $PaidSubscribers;

                echo '<h4 class="text-center bg-dark py-2"> كشف  - <span style="color: #11d4f3!important;font-weight:600;">  غير مشترك  </span> </h4>';
                $unPaidSubscribers = getPaidSubscribers_01(0); echo $unPaidSubscribers; 

                echo '<h4 class="text-center bg-dark py-2"> كشف المشتركين - <span style="color: #f00!important;font-weight:600;"> لم يسدد  </span> </h4>';
                $unSubscribers = getPaidSubscribers_01(2); echo $unSubscribers;?>

            <style>@media print{.no-print,.no-print *{display:none!important}}</style>
            <div class="no-print">
                <div class="button-section mt-4">
                    <input type="button" value="الطباعة" class="btn btn-primary" onclick="javascript:printDiv('printablediv')" />
                    <a href="javascript:history.go(-1)" class="btn btn-danger" style="margin-left: 5px;"> عودة للسابق </a>
                </div>
            </div>	
        </div><?php
    } ?>


<?php
}else{
	header ('location: ../index');
	exit();
}
include   $tpl . 'footer.php';
include   $tpl . 'footer-scripts.php';
ob_end_flush();
?>