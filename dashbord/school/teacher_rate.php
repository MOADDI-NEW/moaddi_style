<?php 
// Project Name  ::  Directorate of Education in Kafr El-Sheikh
// Created In    ::  01 - 01 - 2020                                      
// Developed by ::  Alaa Amer  - 01014714795  - Baltim - Kafr El-Sheikh 
ob_start();
session_start();
$noNavbar = '';
$main_header_school = '';
$main_sidebar_school = '';
$pageTitle = ' تقيم المدرب';  // this function to load page title
include 'init.php';   //  Dirctory page

if (isset($_SESSION['user'])){
$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
$getUser->execute(array($sessionUseer));
$info = $getUser->fetch();
	

if (array_search($info['RegStatus'], ['1']) !== false) { // مسجل بالدبلوم 
	
		include 'breadcrumb.php';?>
        <div class="container-fluid">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <label> بيانات التدريب </label>
                                <div class="direct-chat-messages" style="height: auto;">
                                    <div class="direct-chat-msg right">
                                        <div class="direct-chat-infos clearfix">
                                            <span class="direct-chat-name float-right"><?php $stmt = $con->prepare("SELECT * FROM plan_package"); $stmt->execute(); $users = $stmt->fetchAll(); foreach ($users as $user) { if ($info['plan'] == $user['id']) { echo  $user['paln_name']; } } ?> </span> <span class="direct-chat-timestamp float-left"> <?php  $stmt = $con->prepare("SELECT * FROM packages"); $stmt->execute(); $users = $stmt->fetchAll(); foreach ($users as $user) { if ($info['stage'] == $user['id']){ echo  $user['package']; } }   ?>  </span>
                                        </div><br><?php 
                                        $stmt = $con->prepare("SELECT FullName, role, plan, avatar FROM users WHERE role = 30"); $stmt->execute(); $users = $stmt->fetchAll(); foreach ($users as $user) { if ($info['plan'] == $user['plan']) { echo "<img class='direct-chat-img' src='../admin/nsharat_uploads/teacher/" . $user['avatar'] . "' alt='message user image'>"; echo '<div class="direct-chat-text bg-warning">'. $user['FullName'] .'</div>';	 } } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <?php
            $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';  // shor if 
            if($do == 'Manage'){
                $stmt = $con->prepare("SELECT c.*, u.UserID, u.FullName
                                        FROM comments c
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
                                        <h4 class="card-title text-center"> تقيماتي </h4>
                                        <div class="table-responsive export-table">
                                            <table id="example" class="table table-bordered table-striped" style= "width:99%; direction:rtl;">
                                                <thead><tr> <th scope="col">التاريخ</th><th scope="col"> اسم المدرب  </th><th scope="col">التقييم </th><th scope="col">التعليق </th><th scope="col">الحالة</th></tr></thead>
                                                <tbody>
                                                    <?php
                                                    foreach($items as $item){
                                                        echo "<tr>";
                                                            echo "<td>" . $item['rate_date'] . "</td>";
                                                            echo "<td>"; 
                                                                $stmt = $con->prepare("SELECT UserID, FullName, role  FROM users WHERE role = 30"); 
                                                                $stmt->execute(); 
                                                                $users = $stmt->fetchAll(); 
                                                                foreach ($users as $user) { 
                                                                    if ($item['teacher_id'] == $user['UserID']) {
                                                                        echo $user['FullName'] ;
                                                                } }
                                                            echo "</td>";
                                                            echo "<td>" . $item['teacher_rete'] . "</td>";
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
                                                echo '<div class="nice-message"> لا توجد أي تقيمات متاحة للمدرب </div>';
                                                echo '<a href="teacher_rate?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i>  إضافة تقيم </a>';
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
                                    <h4 class="m-b-0 text-dark" style="text-align:center;">اضافة تقيم  للمدرب</h4>
                                </div>
                                <div class="card-body">
                                        <form action="?do=Insert" method="POST" >
                                            <div class="form-body">
                                                <div class="row p-t-20">
                                                    <div class="col-md-12">
                                                        <div class="form-group has-danger" style="text-align: right;">
                                                            <label class="control-label">  اكتب تعليق للمدرب</label>
                                                            <textarea type="textarea" name="comment" autocomplete="off" required="required" placeholder="نص التعليق...."  style="width: 100%;height: 200px;" ></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row p-t-20">
                                                    <div class="col-md-12">
                                                        <div class="form-group" style="text-align: right;">
                                                            <label class="control-label">  تقييم المدرب </label>
                                                            <div class="rating-stars">
                                                                <input type="radio" name="teacher_rete" value="0" id="rs0" checked><label for="rs0"></label>
                                                                <input type="radio" name="teacher_rete" value="20" id="rs1"><label for="rs1"></label>
                                                                <input type="radio" name="teacher_rete" value="40" id="rs2"><label for="rs2"></label>
                                                                <input type="radio" name="teacher_rete" value="60" id="rs3"><label for="rs3"></label>
                                                                <input type="radio" name="teacher_rete" value="80" id="rs4"><label for="rs4"></label>
                                                                <input type="radio" name="teacher_rete" value="100" id="rs5"><label for="rs5"></label>
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
                                                    <div class="col-md-6">
                                                        <div class="form-group" style="text-align: right;">
                                                            <label class="control-label"> </label><?php 
                                                            $stmt2 = $con->prepare("SELECT * FROM users WHERE role = 30");
                                                            $stmt2->execute();
                                                            $teachers = $stmt2->fetchAll();
                                                            foreach ($teachers as $teacher) { 
                                                                if ($info['plan'] == $teacher['plan']) { ?>
                                                                <input type="hidden" name="teacher_id" class="form-control"  value="<?php echo $teacher['UserID']  ?>" /><?php
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
                    $teacher_rete  = $_POST['teacher_rete'];
                    $teacher_id  = $_POST['teacher_id'];
                    $member_id  = $_POST['member_id'];
                    


                    //Validate The Form
                    $formErrors = array();
                    
                    if (empty($comment)) {
                        $formErrors[] = '<span>  لا يمكنك ارسال التقييم بدون تعليق</span> <i class="fa fa-bomb" style="font-size:30px"></i>';
                    }
                    if ($teacher_rete == 0) {
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
                        $stmt = $con->prepare("INSERT INTO  comments
                                (comment, teacher_rete, teacher_id, member_id, rate_date, approve )
                                VALUES
                                (:zcomment, :zteacher_rete, :zteacher_id, :zmember_id, now(), 0)"); 
                            $stmt->execute(array(
                                'zcomment'  => $comment,
                                'zteacher_rete'  => $teacher_rete,
                                'zteacher_id' => $teacher_id,
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