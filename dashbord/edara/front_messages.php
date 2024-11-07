<?php
ob_start();
session_start();
$noNavbar = '';
$main_header_edara = '';
$main_sidebar_edara = '';

if (isset($_SESSION['Edara30'])){
    $pageTitle = ' رسائل الموقع';  // this function to load page title
    include 'init.php';   //  Dirctory page


	$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
	$getUser->execute(array($_SESSION['Edara30']));
	$info = $getUser->fetch();
    
    include 'breadcrumb.php';
	if (array_search($info['role'], ['30']) !== false) { //   ادارة الجيم 
        
        $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';  // shor if 
        if($do == 'Manage'){  //==== Manage Page == 
            if (array_search($info['GroupID'], ['1','3']) !== false) {	   // مدير + مساعد
                $stmt = $con->prepare("SELECT * FROM messages ");
                $stmt->execute();
                $items = $stmt->fetchAll();
                if (! empty($items)){ ?>
                    <div class="container-fluid">
                        <div class="row row-sm">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header"><h3 class="card-title text-center"> رسائل الموقع </h3></div>
                                    <div class="card-body">
                                        <div class="table-responsive export-table">
                                            <table id="example" class="table table-bordered table-striped" style= "width:98%; direction:rtl;">
                                            <thead><tr> <th>#</th><th scope="col">التاريخ</th><th scope="col"> الاسم   </th><th scope="col">الايميل </th><th scope="col">الهاتف </th><th scope="col">الدولة </th><th scope="col">المدينة </th><th scope="col">الرسالة</th></tr></thead>
                                                <tbody>
                                                    <?php
                                                    $i = 1;
                                                    foreach($items as $item){
                                                    echo "<tr>";
                                                        echo "<td>" . $i++ . "</td>";
                                                        echo "<td>" . $item['mes_Date'] . "</td>";
                                                        echo "<td>" . $item['FullName'] . "</td>";
                                                        echo "<td>" . $item['Email'] . "</td>";
                                                        echo "<td>" . $item['phone'] . "</td>";
                                                        echo "<td>" . $item['Country'] . "</td>";
                                                        echo "<td>" . $item['City'] . "</td>";
                                                        echo "<td>" . $item['mes_1'] . "</td>";
                                                    echo "</tr>";
                                                    } 							
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><?php	
                    }else{  echo '<div class="container">'. '<div class="nice-message"> لا يوجد رسائل للعرض</div>'. '</div>'; } 
            }
                
        }
    }else{ 
        echo'<meta http-equiv = "refresh" content = "0; url = redirect" />';
    } ?>


</div><?php

}else{
	header ('location: ../index');
	exit();
}
include   $tpl . 'footer.php';
include   $tpl . 'footer-scripts.php';
ob_end_flush();
?>