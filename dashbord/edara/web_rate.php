<?php
ob_start();
session_start();
$noNavbar = '';
$main_header_edara = '';
$main_sidebar_edara = '';

if (isset($_SESSION['Edara30'])){
    $pageTitle = 'تقيمات المركز';  // this function to load page title
    include 'init.php';   //  Dirctory page


	$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
	$getUser->execute(array($_SESSION['Edara30']));
	$info = $getUser->fetch();
    
    include 'breadcrumb.php';
	if (array_search($info['role'], ['30']) !== false) { //   ادارة الجيم 
        
        $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';  // shor if 
        if($do == 'Manage'){  //==== Manage Page == 
            if (array_search($info['GroupID'], ['1','3']) !== false) {	   // مدير + مساعد
                $stmt = $con->prepare("SELECT c.*, u.UserID, u.FullName
                                            FROM comments_site c
                                            JOIN users u ON c.member_id = u.UserID 
                                            WHERE u.UserID = c.member_id ");
                $stmt->execute();
                $items = $stmt->fetchAll();
                if (! empty($items)){ ?>
                    <div class="container-fluid">
                        <div class="row row-sm">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header"><h3 class="card-title text-center"> تقيمات الموقع </h3></div>
                                    <div class="card-body">
                                        <div class="table-responsive export-table">
                                            <table id="example" class="table table-bordered table-striped" style= "width:98%; direction:rtl;">
                                            <thead><tr> <th>#</th><th scope="col">التاريخ</th><th scope="col"> اسم المشترك  </th><th scope="col">التقييم </th><th scope="col">التعليق </th><th scope="col">الحالة</th><th scope="col">التحكم</th></tr></thead>
                                                <tbody>
                                                    <?php
                                                    $i = 1;
                                                    foreach($items as $item){
                                                    echo "<tr>";
                                                        echo "<td>" . $i++ . "</td>";
                                                        echo "<td>" . $item['rate_date'] . "</td>";
                                                            echo "<td>"; 
                                                                $stmt = $con->prepare("SELECT UserID, FullName, role  FROM users WHERE role = 44"); 
                                                                $stmt->execute(); 
                                                                $users = $stmt->fetchAll(); 
                                                                foreach ($users as $user) { 
                                                                    if ($item['member_id'] == $user['UserID']) {
                                                                        echo $user['FullName'] ;
                                                                } }
                                                            echo "</td>";
                                                            echo "<td>" . $item['web_rete'] . "</td>";
                                                            echo "<td>" . $item['comment'] . "</td>";
                                                        
                                                            echo "<td>";
                                                                if ($item['approve'] == 0 ) { echo '<span class="text-red"> جاري نشر التقييم بعد المراجعة </span>'; } else { echo '<span class="text-green"> تم نشر التقيم </span>';}
                                                            echo "</td>";
                                                            echo "<td data-label='التحكم'>";
                                                                echo"<a href='web_rate?memberid=315&formerror=form&action=employee&emplyeeid=3265&action=grtstat&grtstat=359&formerror=9853&getid=63524&iteimid=32145&checksum=56821&cookie=30121&do=Approve&userid=" . $item['id'] ."&counksum=93214&action=421' class=''><i class='fas fa-user-edit' style='text-decoration: none;color:#0c0ff3;font-size:15px;'></i>  </a>";
                                                                echo "<a href='web_rate?do=Delete&userid=" . $item['id'] . "' class='deleteEmployee' title=\" حذف\"  ><i class='far fa-trash-alt' style='text-decoration: none;color: crimson;padding: 5px;'></i> </a>";
                                                            echo "</td>";
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
                    }else{  echo '<div class="container">'. '<div class="nice-message"> لا يوجد تقيمات للعرض</div>'. '</div>'; } 
            }
                
        }elseif($do == 'Approve'){   // === strst of Update Page =================*
            $userid = isset($_GET['userid'])&& is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
            // Check if the Userid is numeric and  Exist in Database	
                $check = checkItem ('id', 'comments_site', $userid);
                if ($check > 0){ 
                    $stmt = $con->prepare("UPDATE comments_site SET Approve = 1 WHERE id = ?");
                    $stmt->execute(array($userid));
                    if ($stmt) { // if it's true
                        sleep(1);?>
                        <script src="../layout/dist/js/sweetalert2.min.js"></script>
                        <script>
                            Swal.fire({
                                title: ' تمت الموافقة على التقيم بنجاح',
                                width: 600, icon: 'success',  padding: '4em',
                                color: '#716add', showConfirmButton: false,
                                background: '#fff',  backdrop: `rgba(0,80,123,0.8)`
                            });
                        </script>
                        <?php
                        $theMsg = isset($theMsg) ? $theMsg : '';
                        redirectHome($theMsg, 'back');
                    }
                }else{
                echo "<div class='container'>";
                    $theMsg = "<div class= 'alert alert-danger'>خطأ في الادخال</div>" ;
                        redirectHome($theMsg);
                    echo "</div>";
                }
        
        }elseif($do == 'Delete'){ // Delete members page==========
            if (array_search($info['GroupID'], ['1']) !== false) {	  
                echo "<h1 class='text-center'> حذف تقييم</h1>";
                echo "<div class ='container'>";
                    $userid = isset($_GET['userid'])&& is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
                    // Check if the Userid is numeric and  Exist in Database	
                    $check = checkItem ('id', 'comments_site', $userid);
                    if ($check > 0){ 
                        $stmt = $con->prepare("DELETE FROM comments_site WHERE id = :zid");
                        $stmt->bindParam(":zid",$userid);
                        $stmt->execute();
                            if ($stmt) { // if it's true
                                sleep(1);
                                $theMsg = isset($theMsg) ? $theMsg : '';
                                redirectHome($theMsg, 'back');
                            }
                    }else{
                        echo "<div class='container'>";
                            $theMsg = isset($theMsg) ? $theMsg : '';
                            $theMsg = "<div class= 'alert alert-danger'> THIS ID IS NOT EXIST</div>" ;
                            redirectHome($theMsg);
                        echo "</div>";
                    }
                echo '</div>';
            }else{
                echo "<div class='container'>";
                    $theMsg = isset($theMsg) ? $theMsg : '';
                    $theMsg = "<div class= 'alert alert-danger'> غير مصرح لك بالحذف</div>" ;
                    redirectHome($theMsg);
                echo "</div>";
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