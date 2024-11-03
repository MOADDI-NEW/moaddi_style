<?php
ob_start();
session_start();
$noNavbar = '';
$main_header_edara = '';
$main_sidebar_edara = '';

if (isset($_SESSION['Edara30'])){
    $pageTitle = 'صفحة الاعدادات العامة ';  // this function to load page title
    include 'init.php';   //  Dirctory page


	$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
	$getUser->execute(array($_SESSION['Edara30']));
	$info = $getUser->fetch();
    
    include 'breadcrumb.php';
	if (array_search($info['role'], ['30']) !== false) { //   ادارة الجيم 
        
        $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';  // shor if 
        if($do == 'Manage'){  //==== Manage Page == 
            if (array_search($info['GroupID'], ['1','3']) !== false) {	   // مدير + مساعد
                $stmt = $con->prepare("SELECT * FROM settings ORDER BY id DESC");
                $stmt->execute();
                $rows = $stmt->fetchAll();
                if (! empty($rows)){ ?>
                    <div class="container-fluid">
                        <div class="row row-sm">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header"><h3 class="card-title text-center"> اعدادات الموقع العامة</h3></div>
                                    <div class="card-body">
                                        <div class="table-responsive export-table">
                                            <table id="example" class="table table-bordered table-striped" style= "width:98%; direction:rtl;">
                                            <thead>
                                                <tr>
                                                    <th> #</th>
                                                    <th> اسم الوقع</th>
                                                    <th> وصف الموقع</th>
                                                    <th> التحكم </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 1;
                                                    foreach($rows as $row){
                                                    echo "<tr>";
                                                        echo "<td>" . $i++ . "</td>";
                                                        echo "<td>" . $row['site_name'] . "</td>";
                                                        echo "<td>" . $row['site_desc'] . "</td>";
                                                        
                                                        echo "<td data-label='التحكم' style='text-align:center;'>";
                                                            if (array_search($info['GroupID'], ['1']) !== false) { // المدير
                                                                echo"<a href='settings?memberid=315&formerror=form&action=employee&emplyeeid=3265&action=grtstat&grtstat=359&formerror=9853&getid=63524&iteimid=32145&checksum=56821&cookie=30121&do=Edit&userid=" . $row['id'] ."&counksum=93214&action=421' class=''><i class='fas fa-cog' style='text-decoration: none;color:#0c0ff3;font-size:15px;'></i>  </a>";
                                                            }
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
                    }else{  echo '<div class="container">'. '<div class="nice-message"> لا يوجد اعدادات  للعرض</div>'. '</div>'; } 
            }
                
        }elseif($do == 'Edit'){   // === START Edit Page =====================
            $userid = isset($_GET['userid'])&& is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
                // Check if the Userid is numeric and  Exist in Database	
            $stmt = $con->prepare("SELECT * FROM settings WHERE id = ?  LIMIT 1");
            $stmt->execute(array($userid));
            $row = $stmt->fetch();
            $count = $stmt->rowCount();
            if ($stmt->rowCount() > 0 ){ ?>
                <div class="container-fluid">
                    <div class="row row-sm">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header"><h3 class="card-title text-center">تعديل اعدادات  الموقع</h3></div>
                                <div class="card-body">
                                    <form action="?do=Update" method="POST">
                                        <input type="hidden" name="userid" value="<?php echo $userid ?>" />
                                        <h3 class="card-title m-t-15" style="font-size: 15px;background-color: #022b09;color:#fff;padding:5px;margin-bottom:3px;">
                                            اسم الموقع و الوصف
                                        </h3>
                                        <div class="row p-t-20">
                                            <div class="col-md-12">
                                                <div class="form-group" style="text-align: right;">
                                                    <label class="control-label">اسم الموقع</label>
                                                    <input type="text" name="site_name"  class="form-control form-control-sm" value="<?php echo $row['site_name']?>" autocomplete="off" required="required" />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group has-danger" style="text-align: right;">
                                                    <label class="control-label">وصف الموقع </label>
                                                    <input type="text" name="site_desc" class="form-control form-control-sm" value="<?php echo $row['site_desc']?>" required="required" />
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <h3 class="card-title m-t-15" style="font-size: 15px;background-color: #022b09;color:#fff;padding:5px;margin-bottom:3px;">
                                            عن الموقع :
                                        </h3>
                                        <div class="row p-t-20">
                                            <div class="col-md-12">   
                                                <div class="form-group" style="text-align: right;">
                                                    <label class="control-label"> عن الموقع الجزء الأول</label>
                                                    <input type="text" name="about_1" class="form-control form-control-sm" value="<?php echo $row['about_1']?>"   required="required"/>
                                                </div>
                                            </div>
                                            <div class="col-md-12">   
                                                <div class="form-group" style="text-align: right;">
                                                    <label class="control-label"> عن الموقع الجزء الثاني</label>
                                                    <input type="text" name="about_2" class="form-control form-control-sm" value="<?php echo $row['about_2']?>"   required="required"/>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <h3 class="card-title m-t-15" style="font-size: 15px;background-color: #022b09;color:#fff;padding:5px;margin-bottom:3px;">
                                            مميزات الموقع :
                                        </h3>
                                        <div class="row">
                                            <div class="col-md-12">   
                                                <div class="form-group" style="text-align: right;">
                                                    <label class="control-label"> مقدمة عن الخدمات  </label>
                                                    <input type="text" name="about_3" class="form-control form-control-sm" value="<?php echo $row['about_3']?>"   required="required"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">   
                                                <div class="form-group" style="text-align: right;">
                                                    <label class="control-label">  عنوان الميزة 1 :   </label>
                                                    <input type="text" name="feature_1_title" class="form-control form-control-sm" value="<?php echo $row['feature_1_title']?>"   required="required"/>
                                                </div>
                                            </div>    
                                            <div class="col-md-12">   
                                                <div class="form-group" style="text-align: right;">
                                                    <label class="control-label"> نص الميزة 1 :</label>
                                                    <input type="text" name="feature_1" class="form-control form-control-sm" value="<?php echo $row['feature_1']?>"   required="required"/>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="col-md-6">   
                                                <div class="form-group" style="text-align: right;">
                                                    <label class="control-label">  عنوان الميزة 2 :   </label>
                                                    <input type="text" name="feature_2_title" class="form-control form-control-sm" value="<?php echo $row['feature_2_title']?>"   required="required"/>
                                                </div>
                                            </div>    
                                            <div class="col-md-12">   
                                                <div class="form-group" style="text-align: right;">
                                                    <label class="control-label"> نص الميزة 2 :</label>
                                                    <input type="text" name="feature_2" class="form-control form-control-sm" value="<?php echo $row['feature_2']?>"   required="required"/>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="col-md-6">   
                                                <div class="form-group" style="text-align: right;">
                                                    <label class="control-label">  عنوان الميزة 3 :   </label>
                                                    <input type="text" name="feature_3_title" class="form-control form-control-sm" value="<?php echo $row['feature_3_title']?>"   required="required"/>
                                                </div>
                                            </div>    
                                            <div class="col-md-12">   
                                                <div class="form-group" style="text-align: right;">
                                                    <label class="control-label"> نص الميزة 3 :</label>
                                                    <input type="text" name="feature_3" class="form-control form-control-sm" value="<?php echo $row['feature_3']?>"   required="required"/>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="col-md-6">   
                                                <div class="form-group" style="text-align: right;">
                                                    <label class="control-label">  عنوان الميزة 4 :   </label>
                                                    <input type="text" name="feature_4_title" class="form-control form-control-sm" value="<?php echo $row['feature_4_title']?>"   required="required"/>
                                                </div>
                                            </div>    
                                            <div class="col-md-12">   
                                                <div class="form-group" style="text-align: right;">
                                                    <label class="control-label"> نص الميزة 4 :</label>
                                                    <input type="text" name="feature_4" class="form-control form-control-sm" value="<?php echo $row['feature_4']?>"   required="required"/>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                        <h3 class="card-title m-t-15" style="font-size: 15px;background-color: #022b09;color:#fff;padding:5px;margin-bottom:3px;">
                                            البيانات الاساسية :
                                        </h3>
                                        <div class="row p-t-20">
                                            <div class="col-md-12">   
                                                <div class="form-group" style="text-align: right;">
                                                    <label class="control-label"> العنوان </label>
                                                    <input type="text" name="address" class="form-control form-control-sm" value="<?php echo $row['address']?>"   required="required"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">   
                                                <div class="form-group" style="text-align: right;">
                                                    <label class="control-label"> الأيميل</label>
                                                    <input type="email" name="email" class="form-control form-control-sm" value="<?php echo $row['email']?>"   required="required"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">   
                                                <div class="form-group" style="text-align: right;">
                                                    <label class="control-label"> الهاتف</label>
                                                    <input type="text" name="phone" class="form-control form-control-sm" value="<?php echo $row['phone']?>"   required="required"/>
                                                </div>
                                            </div>
                                        </div>
                                        <h3 class="card-title m-t-15" style="font-size: 15px;background-color: #022b09;color:#fff;padding:5px;margin-bottom:3px;">
                                            وسائل التواصل :
                                        </h3>
                                        <div class="row p-t-20">
                                            <div class="col-md-6">   
                                                <div class="form-group" style="text-align: right;">
                                                    <label class="control-label"> الفيسبوك </label>
                                                    <input type="text" name="facebook" class="form-control form-control-sm" value="<?php echo $row['facebook']?>"   required="required"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">   
                                                <div class="form-group" style="text-align: right;">
                                                    <label class="control-label"> اليوتيوب </label>
                                                    <input type="text" name="youtube" class="form-control form-control-sm" value="<?php echo $row['youtube']?>"   required="required"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">   
                                                <div class="form-group" style="text-align: right;">
                                                    <label class="control-label"> تويتر</label>
                                                    <input type="text" name="twitter" class="form-control form-control-sm" value="<?php echo $row['twitter']?>"   required="required"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">   
                                                <div class="form-group" style="text-align: right;">
                                                    <label class="control-label"> انستجرام</label>
                                                    <input type="text" name="instagram" class="form-control form-control-sm" value="<?php echo $row['instagram']?>"   required="required"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions pull-right">
                                            <i class="fa fa-check"></i> <input type="submit" class="btn btn-success swalDefaultSuccess"  value="حفظ التعديل" />  
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>	<?php	
            }else{
                echo "<div class='container'>";
                    echo "<div class= 'alert alert-danger text-center'>-------- خطأ في الادخال -------  </div>" ; echo '<a href="logout" class="btn btn-danger">عودة للسابقة</a>';
                echo "</div>";
            }
        
        }elseif($do == 'Update'){   // === strst of Update Page =================*
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Get Variabls from the Form
                $id    = $_POST['userid'];
                $site_name  = $_POST['site_name'];
                $site_desc  = $_POST['site_desc'];

                $about_1  = $_POST['about_1'];
                $about_2  = $_POST['about_2'];
                $about_3  = $_POST['about_3'];

                $feature_1_title  = $_POST['feature_1_title'];
                $feature_1  = $_POST['feature_1'];
                $feature_2_title  = $_POST['feature_2_title'];
                $feature_2  = $_POST['feature_2'];
                $feature_3_title  = $_POST['feature_3_title'];
                $feature_3  = $_POST['feature_3'];
                $feature_4_title  = $_POST['feature_4_title'];
                $feature_4  = $_POST['feature_4'];

                $address  = $_POST['address'];
                $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                $phone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);

                $facebook  = $_POST['facebook'];
                $youtube  = $_POST['youtube'];
                $twitter  = $_POST['twitter'];
                $instagram  = $_POST['instagram'];
                
                //Validate The Form
                $formErrors = array();
                if (strlen($site_name) < 4) {
                    $formErrors[] = '<span>  اسم الموقع يجب الا يقل عن اربعة احرف</span> </i>';
                }
                if (strlen($site_name) > 60) {
                    $formErrors[] = '<span> اسم الموقع يجب الا يزيد عن ستون حرف</span> </i>';
                }
                if (empty($site_name)) {
                    $formErrors[] = '<span> لا يمكنك ترك اسم الموقع فارغا</span> </i>';
                }
                if (empty($site_desc)) {
                    $formErrors[] = '<span> لا يمكن ترك وصف الموقع فارغ</span> </i>';
                }
                if (empty($facebook)) {
                    $formErrors[] = '<span> لا يمكنك ترك الفيسبوك فارغ</span> </i>';
                }
                if (empty($youtube)) {
                    $formErrors[] = '<span> لا يمكنك ترك يوتيوب فارغ</span> </i>';
                }
                if (empty($twitter)) {
                    $formErrors[] = '<span> لا يمكنك ترك تويتر فارغ</span> </i>';
                }
                if (empty($instagram)) {
                    $formErrors[] = '<span> لا يمكنك ترك انستجرام فارغ</span> </i>';
                }
                ?>
                
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
                //check if no error update operators
                
                if (empty($formErrors)){
                    
                        $stmt = $con->prepare("UPDATE settings SET 
                                                        site_name = ?, 
                                                        site_desc = ?, 
                                                        about_1 = ?, 
                                                        about_2 = ?, 
                                                        about_3 = ?, 
                                                        feature_1_title =?,  
                                                        feature_1 = ?,  
                                                        feature_2_title = ?,	
                                                        feature_2 = ?,	
                                                        feature_3_title = ?,	
                                                        feature_3 = ?,	
                                                        feature_4_title = ?,	
                                                        feature_4 = ?,	
                                                        address = ?,	
                                                        email = ?,
                                                        phone = ?,	
                                                        facebook = ?,	
                                                        youtube = ?,	
                                                        twitter = ?,	
                                                        instagram = ? 
                                                    WHERE id = ?");

                        $stmt->execute(array(
                                            $site_name, 
                                            $site_desc, 
                                            $about_1, 
                                            $about_2, 
                                            $about_3, 
                                            $feature_1_title,  
                                            $feature_1,  
                                            $feature_2_title,	
                                            $feature_2,	
                                            $feature_3_title,	
                                            $feature_3,	
                                            $feature_4_title,	
                                            $feature_4,	
                                            $address,	
                                            $email, 
                                            $phone,	
                                            $facebook,	
                                            $youtube,	
                                            $twitter,	
                                            $instagram, 
                                            $id));
                        //Echo Success Measage
                        if ($stmt) { // if it's true
                            sleep(1);?>
                            <script src="../layout/dist/js/sweetalert2.min.js"></script>
                            <script>
                                Swal.fire({
                                    title: 'تم تحديث  الاعدادات  بنجاح',
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
                    echo "<div class= 'alert alert-danger text-center'>-------- خطأ في الادخال -------  </div>" ; echo '<a href="logout" class="btn btn-danger">عودة للسابقة</a>';
                    $theMsg = isset($theMsg) ? $theMsg : '';
                    redirectHome($theMsg);
                echo "</div>";
            }
        


        }elseif($do == 'Edit2'){   // === START Edit Page =====================
            $userid = isset($_GET['userid'])&& is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
                // Check if the Userid is numeric and  Exist in Database	
            $stmt = $con->prepare("SELECT * FROM users WHERE UserID = ?  LIMIT 1");
            $stmt->execute(array($userid));
            $row = $stmt->fetch();
            $count = $stmt->rowCount();
            if ($stmt->rowCount() > 0 && $info['department'] == $row['department']){ ?>
                <div class="container-fluid">
                    <div class="row row-sm">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header"><h3 class="card-title text-center">  جدوال التعديل للمشترك</h3></div>
                                <div class="card-body">
                                    <form action="?do=Update2" method="POST">
                                        <input type="hidden" name="userid" value="<?php echo $userid ?>" />
                                        <div class="row p-t-20">
                                            <div class="col-md-3">
                                                <div class="form-group has-danger" style="text-align: right;"><label class="control-label">الاسم بالكامل</label>
                                                    <input type="text" class="form-control form-control-sm" value="<?php echo $row['FullName']?>"  readonly style="text-align: center;color: #fff;background-color: #0d0347;"/>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group" style="text-align: right;"><label class="control-label"> الحزمة التدريبية </label>
                                                    <input type="text"  class="form-control form-control-sm" value="<?php 
                                                     $stmt = $con->prepare("SELECT * FROM packages"); $stmt->execute();$users = $stmt->fetchAll();
                                                    foreach ($users as $user) { if ($row['stage'] == $user['id']){ echo  $user['package']; } }  ?>"  readonly style="text-align: center;color: #fff;background-color: #0d0347;"/>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group" style="text-align: right;"><label class="control-label">الهاتف</label>
                                                        <input type="text" class="form-control form-control-sm" value="<?php echo $row['phone']?>"  required="required" readonly style="text-align: center;color: #fff;background-color: #0d0347;" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group" style="text-align: right;"><label class="control-label">الايميل</label>
                                                        <input type="text" class="form-control form-control-sm" value="<?php echo $row['Email']?>"  required="required" readonly style="text-align: center;color: #fff;background-color: #0d0347;" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row p-t-20"><?php 
                                             if (array_search($row['stage'], ['1','2','3']) !== false) {   // ===========================   المستوى الأول  ================================ ?>
                                                <div class="table-responsive export-table">
                                                    <table  class="table table-bordered table-striped" style= "width:98%; direction:rtl;">
                                                        <thead><tr class="bg-navy"><th>شهر  1 </th><th>شهر 2 </th><th>شهر 3 </th><th>شهر 4 </th><th>شهر 5 </th><th>شهر 6 </th></tr></thead>
                                                        <tbody>
                                                            <tr>
                                                                <td> <select name="B30_1" class="form-control form-control-sm"><option value="1" <?php if ($row['B30_1'] == '1') {echo 'selected';}?>> تم السداد </option><option value="0" <?php if ($row['B30_1'] == '0') {echo 'selected';}?>> لم يتم </option> </select> </td>
                                                                <td> <select name="B30_2" class="form-control form-control-sm"><option value="1" <?php if ($row['B30_2'] == '1') {echo 'selected';}?>> تم السداد </option><option value="0" <?php if ($row['B30_2'] == '0') {echo 'selected';}?>> لم يتم </option> </select> </td>
                                                                <td> <select name="B30_3" class="form-control form-control-sm"><option value="1" <?php if ($row['B30_3'] == '1') {echo 'selected';}?>> تم السداد </option><option value="0" <?php if ($row['B30_3'] == '0') {echo 'selected';}?>> لم يتم </option> </select> </td>
                                                                <td> <select name="B30_4" class="form-control form-control-sm"><option value="1" <?php if ($row['B30_4'] == '1') {echo 'selected';}?>> تم السداد </option><option value="0" <?php if ($row['B30_4'] == '0') {echo 'selected';}?>> لم يتم </option> </select> </td>
                                                                <td> <select name="B30_5" class="form-control form-control-sm"><option value="1" <?php if ($row['B30_5'] == '1') {echo 'selected';}?>> تم السداد </option><option value="0" <?php if ($row['B30_5'] == '0') {echo 'selected';}?>> لم يتم </option> </select> </td>
                                                                <td> <select name="B30_6" class="form-control form-control-sm"><option value="1" <?php if ($row['B30_6'] == '1') {echo 'selected';}?>> تم السداد </option><option value="0" <?php if ($row['B30_6'] == '0') {echo 'selected';}?>> لم يتم </option> </select> </td>
                                                            </tr>
                                                        </tbody>
                                                        <thead><tr class="bg-navy"><th>شهر 7 </th><th>شهر 8 </th><th>شهر 9 </th><th>شهر 10 </th><th>شهر 11 </th><th>شهر 12 </th></tr></thead>
                                                        <tbody>
                                                            <tr>
                                                                <td> <select name="B30_7"  class="form-control form-control-sm"><option value="1" <?php if ($row['B30_7'] == '1') {echo 'selected';}?>> تم السداد </option><option value="0"  <?php if ($row['B30_7'] == '0') {echo 'selected';}?>> لم يتم </option> </select> </td>
                                                                <td> <select name="B30_8"  class="form-control form-control-sm"><option value="1" <?php if ($row['B30_8'] == '1') {echo 'selected';}?>> تم السداد </option><option value="0"  <?php if ($row['B30_8'] == '0') {echo 'selected';}?>> لم يتم </option> </select> </td>
                                                                <td> <select name="B30_9"  class="form-control form-control-sm"><option value="1" <?php if ($row['B30_9'] == '1') {echo 'selected';}?>> تم السداد </option><option value="0"  <?php if ($row['B30_9'] == '0') {echo 'selected';}?>> لم يتم </option> </select> </td>
                                                                <td> <select name="B30_10" class="form-control form-control-sm"><option value="1" <?php if ($row['B30_10'] == '1') {echo 'selected';}?>> تم السداد </option><option value="0" <?php if ($row['B30_10'] == '0') {echo 'selected';}?>> لم يتم </option> </select> </td>
                                                                <td> <select name="B30_11" class="form-control form-control-sm"><option value="1" <?php if ($row['B30_11'] == '1') {echo 'selected';}?>> تم السداد </option><option value="0" <?php if ($row['B30_11'] == '0') {echo 'selected';}?>> لم يتم </option> </select> </td>
                                                                <td> <select name="B30_12" class="form-control form-control-sm"><option value="1" <?php if ($row['B30_12'] == '1') {echo 'selected';}?>> تم السداد </option><option value="0" <?php if ($row['B30_12'] == '0') {echo 'selected';}?>> لم يتم </option> </select> </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div><?php
                                            }
                                            ?>
                                        </div>
                                        <hr>
                                        <div class="row p-t-20"> <!--  ===  department &&  Role ===  -->
                                            <div class="col-md-6">
                                                <div class="form-group" style="text-align: right;">
                                                    <input type="hidden" value="<?php echo $row['department']?>" name="department"  class="form-control"  />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" style="text-align: right;">
                                                    <input type="hidden" value="<?php echo $row['role']?>" name="role"  class="form-control"  />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions pull-right">
                                            <i class="fa fa-check"></i> <input type="submit" class="btn btn-success swalDefaultSuccess"  value="حفظ التعديل" />  
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>	<?php	
            }else{
                echo "<div class='container'>";
                    echo "<div class= 'alert alert-danger text-center'>-------- خطأ في الادخال -------  </div>" ; echo '<a href="logout" class="btn btn-danger">عودة للسابقة</a>';
                echo "</div>";
            }
        }elseif($do == 'Update2'){   // === strst of Update Page =================*
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Get Variabls from the Form
                $id    = $_POST['userid'];
                

                if (empty($_POST["B30_1"])) { $B30_1 = 0; } else { $B30_1  = $_POST['B30_1'];}
                if (empty($_POST["B30_2"])) { $B30_2 = 0; } else { $B30_2  = $_POST['B30_2'];}
                if (empty($_POST["B30_3"])) { $B30_3 = 0; } else { $B30_3  = $_POST['B30_3'];}
                if (empty($_POST["B30_4"])) { $B30_4 = 0; } else { $B30_4  = $_POST['B30_4'];}
                if (empty($_POST["B30_5"])) { $B30_5 = 0; } else { $B30_5  = $_POST['B30_5'];}
                if (empty($_POST["B30_6"])) { $B30_6 = 0; } else { $B30_6  = $_POST['B30_6'];}
                if (empty($_POST["B30_7"])) { $B30_7 = 0; } else { $B30_7  = $_POST['B30_7'];}
                if (empty($_POST["B30_8"])) { $B30_8 = 0; } else { $B30_8  = $_POST['B30_8'];}
                if (empty($_POST["B30_9"])) { $B30_9 = 0; } else { $B30_9  = $_POST['B30_9'];}
                if (empty($_POST["B30_10"])) { $B30_10 = 0; } else { $B30_10  = $_POST['B30_10'];}
                if (empty($_POST["B30_11"])) { $B30_11 = 0; } else { $B30_11  = $_POST['B30_11'];}
                if (empty($_POST["B30_12"])) { $B30_12 = 0; } else { $B30_12  = $_POST['B30_12'];}
                

                
                $department     = $_POST['department'];
                $role  			= $_POST['role'];
                
                //Validate The Form
                $formErrors = array();
                
                if ($role == 0) {
                    $formErrors[] = '<span> اختر الصلاحية</span> </i>';
                }
                ?>
                
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
                //check if no error update operators
                
                if (empty($formErrors)){
                    $stmt2 = $con->prepare("SELECT * FROM users WHERE Username = ?  AND UserID != ?");
                    $stmt2->execute(array($user, $id));
                    $count = $stmt2->rowCount();
                    if($count == 1){
                        echo "<div class='container'>";
                            echo "<div class= 'alert alert-danger text-center'>-------- المستخدم موجود مسبقا -------  </div>" ;
                            $theMsg = isset($theMsg) ? $theMsg : '';
                            redirectHome($theMsg, 'back');
                        echo "</div>";
                    }else{   //  the database with this Info
                        $stmt = $con->prepare("UPDATE users SET 
                                                            B30_1 = ?, 
                                                            B30_2 = ?, 
                                                            B30_3 = ?, 
                                                            B30_4 = ?, 
                                                            B30_5 = ?, 
                                                            B30_6 = ?, 
                                                            B30_7 = ?, 
                                                            B30_8 = ?, 
                                                            B30_9 = ?, 
                                                            B30_10 = ?, 
                                                            B30_11 = ?, 
                                                            B30_12 = ?, 
                                                            

                                                            department = ?,	
                                                            role = ? 
                                                    
                                                    WHERE UserID = ?");
                        $stmt->execute(array(
                                            $B30_1,  
                                            $B30_2,  
                                            $B30_3,  
                                            $B30_4,  
                                            $B30_5,  
                                            $B30_6,  
                                            $B30_7,  
                                            $B30_8,  
                                            $B30_9,  
                                            $B30_10,  
                                            $B30_11,  
                                            $B30_12,  

                                            $department, 
                                            $role, 
                                            $id));
                        //Echo Success Measage
                        if ($stmt) { // if it's true
                            sleep(1);?>
                            
                            <script src="../layout/dist/js/sweetalert2.min.js"></script>
                            <script>
                                Swal.fire({
                                    title: 'تم تحديث بيانات المشترك بنجاح',
                                    width: 600, icon: 'success',  padding: '4em',
                                    color: '#716add', showConfirmButton: false,
                                    background: '#fff',  backdrop: `rgba(0,80,123,0.8)`
                                });
                            </script>
                            <?php
                            $theMsg = isset($theMsg) ? $theMsg : '';
                            redirectHome($theMsg, 'back');
                        }
                    }
                }
            }else{
                echo "<div class='container'>";
                    echo "<div class= 'alert alert-danger text-center'>-------- خطأ في الادخال -------  </div>" ; echo '<a href="logout" class="btn btn-danger">عودة للسابقة</a>';
                    $theMsg = isset($theMsg) ? $theMsg : '';
                    redirectHome($theMsg);
                echo "</div>";
            }
        }elseif($do == 'Delete'){ // Delete members page==========
            if (array_search($info['GroupID'], ['1']) !== false) {	  
                echo "<h1 class='text-center'> حذف مستخدم</h1>";
                echo "<div class ='container'>";
                    $userid = isset($_GET['userid'])&& is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
                    // Check if the Userid is numeric and  Exist in Database	
                    $check = checkItem ('userid', 'users', $userid);
                    if ($check > 0){ 
                        $stmt = $con->prepare("DELETE FROM users WHERE UserID = :zuser");
                        $stmt->bindParam(":zuser",$userid);
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
</div>

<style>
.alert {
    background-color: #ab0f04;
    color: white;
    padding: 5px;
    border-radius: 5px 1px;
    font-size: 8px;
}
</style>
<script>
const inputs = document.querySelectorAll('.myInput');

inputs.forEach(input => {
    input.addEventListener('input', function() {
    const value = parseInt(input.value);

    if (isNaN(value) || value < 0 || value > 10) {
        const alert = document.createElement('div');
        alert.classList.add('alert');
        alert.textContent = 'الدرجة يجب ان تكون بين 0 و 10';
        input.parentNode.insertBefore(alert, input.nextSibling);
        input.value = '';
    } else {
        const alert = input.nextSibling;
        if (alert && alert.classList.contains('alert')) {
        alert.parentNode.removeChild(alert);
        }
    }
    });
});
</script>



<?php

}else{
	header ('location: ../index');
	exit();
}
include   $tpl . 'footer.php';
include   $tpl . 'footer-scripts.php';
ob_end_flush();
?>