<?php 
// Project Name  ::  Directorate of Education in Kafr El-Sheikh
// Created In    ::  01 - 01 - 2020                                      
// Developed by ::  Alaa Amer  - 01014714795  - Baltim - Kafr El-Sheikh 
ob_start();
session_start();
$noNavbar = '';
$main_header_school = '';
$main_sidebar_school = '';
$pageTitle = ' تقيم الموقع';  // this function to load page title
include 'init.php';   //  Dirctory page

if (isset($_SESSION['user'])){
$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
$getUser->execute(array($sessionUseer));
$info = $getUser->fetch();
	

if (array_search($info['RegStatus'], ['1']) !== false) { // مسجل بالدبلوم 
	
		include 'breadcrumb.php';?>
        <div class="container-fluid"><?php
            $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';  // shor if 
            if($do == 'Manage'){
                $stmt = $con->prepare("SELECT c.*, u.UserID, u.FullName
                                        FROM comments_site c
                                        JOIN users u ON c.member_id = u.UserID 
                                        WHERE  `Username`=:Username ");
                $stmt->execute(array(':Username' => $_SESSION['user']));
                $items = $stmt->fetchAll();
                if (! empty($items)){?>
                    <div class="container-fluid">	
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title text-center"> تقيمي للموقع </h4>
                                        <div class="table-responsive export-table">
                                            <table id="example" class="table table-bordered table-striped" style= "width:99%; direction:rtl;">
                                                <thead><tr> <th scope="col">التاريخ</th><th scope="col">التقييم </th><th scope="col">التعليق </th><th scope="col">الحالة</th></tr></thead>
                                                <tbody>
                                                    <?php
                                                    foreach($items as $item){
                                                        echo "<tr>";
                                                            echo "<td>" . $item['rate_date'] . "</td>";
                                                            echo "<td>" . $item['web_rete'] . "</td>";
                                                            echo "<td>" . $item['comment'] . "</td>";
                                                        
                                                            echo "<td data-label='التحكم'>";
                                                                if ($item['approve'] == 0 ) { echo '<span class="text-red"> جاري نشر التقييم بعد المراجعة </span>'; } else { echo '<span class="text-green"> تم نشر التقيم </span>';}
                                                            echo "</td>";
                                                        echo "</tr>";
                                                    } ?>						
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>	<?php		
                                    }else{
                                        echo '<div class="container">';
                                                echo '<div class="nice-message"> لا توجد أي تقيمات متاحة للموقع </div>';
                                                echo '<a href="web_rate?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i>  إضافة تقيم </a>';
                                        echo '</div>';
                                    } ?>
                                </div>		
                            </div>
                        </div>
                    </div><?php
            

            } elseif ($do == 'Add'){ //=========== Start Add item Page ============ ?>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-outline-primary" style="background: #fff  none repeat scroll 0 0;">
                                <div class="card-header">
                                    <h4 class="m-b-0 text-dark" style="text-align:center;">اضافة تقيم  للموقع</h4>
                                </div>
                                <div class="card-body">
                                        <form action="?do=Insert" method="POST" >
                                            <div class="form-body">
                                                <div class="row p-t-20">
                                                    <div class="col-md-12">
                                                        <div class="form-group has-danger" style="text-align: right;">
                                                            <label class="control-label">  اكتب تعليق للموقع</label>
                                                            <textarea type="textarea" name="comment" autocomplete="off" required="required" placeholder="نص التعليق...."  style="width: 100%;height: 200px;" ></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row p-t-20">
                                                    <div class="col-md-12">
                                                        <div class="form-group" style="text-align: right;">
                                                            <label class="control-label">  تقييم المركز </label>
                                                            <div class="rating-stars">
                                                                <input type="radio" name="web_rete" value="0" id="rs0" checked><label for="rs0"></label>
                                                                <input type="radio" name="web_rete" value="20" id="rs1"><label for="rs1"></label>
                                                                <input type="radio" name="web_rete" value="40" id="rs2"><label for="rs2"></label>
                                                                <input type="radio" name="web_rete" value="60" id="rs3"><label for="rs3"></label>
                                                                <input type="radio" name="web_rete" value="80" id="rs4"><label for="rs4"></label>
                                                                <input type="radio" name="web_rete" value="100" id="rs5"><label for="rs5"></label>
                                                                <span class="rating-counter"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group" style="text-align: right;"><?php //مدخل البيان
                                                            if (isset($_SESSION['user'])){
                                                                $getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
                                                                $getUser->execute(array($sessionUseer));
                                                                $info = $getUser->fetch();
                                                                if (array_search($info['role'], ['44']) !== false) { ?>
                                                                <input type="hidden" name="member_id"  value="<?php echo $info['UserID'];?>"/><?php
                                                                }
                                                            } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <div class="form-actions pull-right">
                                                <i class="fa fa-check"></i> <input type="submit" class="btn btn-success swalDefaultSuccess"  value="أضافة تقييم " />  
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>	
                </div><?php 

            }elseif($do == 'Insert'){
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    // Get Variabls from the Form
                    $comment     = $_POST['comment'];
                    $web_rete  = $_POST['web_rete'];
                    $member_id  = $_POST['member_id'];
                    
                    //Validate The Form
                    $formErrors = array();
                    
                    if (empty($comment)) {
                        $formErrors[] = '<span>  لا يمكنك ارسال التقييم بدون تعليق</span> <i class="fa fa-bomb" style="font-size:30px"></i>';
                    }
                    if ($web_rete == 0) {
                        $formErrors[] = '<span>  اختر رقم اكبر من صفر</span> <i class="fa fa-bomb" style="font-size:30px"></i>';
                    }?>
                        <div class ="container-fluid" style="direction:rtl;">	
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-default">
                                        <div class="card-body">
                                            <div class="table-responsive export-table">
                                                <table class="table table-bordered table-sm" style= "width:98%; direction:rtl;">
                                                    <thead><?php
                                                        foreach ($formErrors as $error) { ?> 
                                                            <tr>
                                                                <th class="bg-danger" style="width:90%;vertical-align:middle;font-size:small;"><?php echo $error ;?></th>
                                                                <th><a type="button" class="btn btn-block btn-sm bg-navy"  href="javascript:history.go(-1)">عودة</a></th>
                                                            </tr><?php 
                                                        }?>	
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><?php
                    if(empty($formErrors)){
                        // Inser Info to database *** مهم ***   now(),
                        $stmt = $con->prepare("INSERT INTO  comments_site
                                (comment, web_rete, member_id, rate_date, approve )
                                VALUES
                                (:zcomment, :zweb_rete, :zmember_id, now(), 0)"); 
                            $stmt->execute(array(
                                'zcomment'  => $comment,
                                'zweb_rete'  => $web_rete,
                                'zmember_id' => $member_id
                            ));
                        //Echo Success Measage
                        if ($stmt) { // if it's true
                            sleep(1);?>
                            <script src="../layout/dist/js/sweetalert2.min.js"></script>
                            <script>
                                Swal.fire({
                                    title: 'تم إضافة التقييم بنجاح',
                                    width: 600, icon: 'success',  padding: '4em',
                                    color: '#716add', showConfirmButton: false,
                                    background: '#fff',  backdrop: `rgba(0,80,123,0.8)`
                                });
                            </script>
                            <?php
                            $theMsg = isset($theMsg) ? $theMsg : '';
                            redirectHome($theMsg);
                        }
                    }
                }else{
                    echo "<div class='container'>";
                    $theMsg = "<div class= 'alert alert-danger'> You Cannot Browse This Page </div>" ;
                    redirectHome($theMsg);
                    echo "</div>";
                }
            }
            ?>
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