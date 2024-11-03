<?php
ob_start();
session_start();
$noNavbar = '';
$main_header_edara = '';
$main_sidebar_edara = '';

if (isset($_SESSION['Edara30'])){
    $pageTitle = 'صفحة درجات مسابقة العائلة ';  // this function to load page title
    include 'init.php';   //  Dirctory page


	$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
	$getUser->execute(array($_SESSION['Edara30']));
	$info = $getUser->fetch();
    
    include 'breadcrumb.php';
	if (array_search($info['role'], ['30']) !== false) { //   ادارة الجيم 
        
        $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';  // shor if 
        if($do == 'Manage'){  //==== Manage Page == 
         if (array_search($info['GroupID'], ['1','3']) !== false) {   // مدير + مساعد
            $stmt = $con->prepare("SELECT ua.id, ua.user_id, ua.question_id, ua.answer,
                                                          u.UserID, u.FullName,
                                                          q.id, q.correct_option, q.question 
                                                 FROM user_answers ua
                                                 JOIN users u
                                                 ON u.UserID = ua.user_id
                                                 JOIN questions q
                                                 ON q.id = ua.question_id
                                                 ");
            $stmt->execute();
            $rows = $stmt->fetchAll();
        
            if (!empty($rows)) {
                // Associative array to store the total score per user
                $userScores = [];
        
                // Loop through the rows and calculate scores
                foreach ($rows as $row) {
                    if (!isset($userScores[$row['FullName']])) {
                        $userScores[$row['FullName']] = 0;  // Initialize score for the user
                    }
                    
                    // Check if the answer is correct and add 10 marks
                    if ($row['answer'] == $row['correct_option']) {
                        $userScores[$row['FullName']] += 10;
                    }
                }
                ?>
        
                <div class="container-fluid">
                    <div class="row row-sm">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title text-center">قوائم الدرجات</h3>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive export-table">
                                        <table id="example" class="table table-bordered table-striped" style="width:98%; direction:rtl;">
                                            <thead>
                                                <tr>
                                                    <th>العضو</th>
                                                    <th>الدرجة</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Output the scores for each user
                                                foreach ($userScores as $fullName => $totalScore) {
                                                    echo "<tr>";
                                                    echo "<td>" . $fullName . "</td>";
                                                    echo "<td>" . $totalScore . "</td>";
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
                </div>
                <?php
            } else {
                echo '<div class="container"><div class="nice-message">لا يوجد مستخدمين للعرض</div></div>';
            }
        }
        
                
        }elseif($do == 'Add'){  // ADD Members Page 
            if (array_search($info['GroupID'], ['1']) !== false) { // المدير  ?>
                <div class="container-fluid">
                    <div class="row row-sm">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header"><h3 class="card-title text-center">اضافة عضو جديد</h3></div>
                                <div class="card-body">
                                    <form action="?do=Insert" method="POST" enctype="multipart/form-data">
                                        <div class="form-body">
                                                <h3 class="card-title m-t-15" style="font-size: 15px;background-color: #022b09;color:#fff;">اسم المستخدم & كلمة المرور</h3>
                                                <hr>
                                                <div class="row p-t-20">
                                                    <div class="col-md-6">
                                                        <div class="form-group" style="text-align: right;">
                                                            <label class="control-label">اسم المستخدم</label>
                                                            <input type="text" name="username" autocomplete="off" required="required" id="firstName" class="form-control form-control-sm" placeholder=" اسم الدخول" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-danger" style="text-align: right;">
                                                            <label class="control-label">كلمة المرور</label>
                                                            <input type="password" name="password"  autocomplete="new-password"  required="required" class="form-control form-control-sm" placeholder=" كلمة مرور قوية" />
                                                            </div>
                                                    </div>
                                                </div>
                                                <h3 class="card-title m-t-15" style="font-size: 15px;background-color: #022b09;color:#fff;">البيانات الاساسية</h3>
                                                <hr>
                                                    <div class="row p-t-20">
                                                    <div class="col-md-6">
                                                        <div class="form-group" style="text-align: right;">
                                                            <label class="control-label">البريد الالكتروني</label>
                                                            <input type="email" name="email" required="required" class="form-control form-control-sm" placeholder="البريدالاكتروني"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-danger" style="text-align: right;">
                                                            <label class="control-label">الاسم بالكامل</label>
                                                            <input type="text" name="full"  required="required" class="form-control form-control-sm" placeholder="الاسم بالكامل" />
                                                            </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group" style="text-align: right;">
                                                            <label class="control-label"> الوظيفة  </label>
                                                            <input type="text" name="job_title"  required="required" class="form-control form-control-sm" placeholder="الوظيفة" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group" style="text-align: right;">
                                                            <label class="control-label"> المدينة</label>
                                                            <input type="text" name="al_city"  required="required" class="form-control form-control-sm" placeholder="المدينة" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-danger" style="text-align: right;">
                                                            <label class="control-label">الهاتف</label>
                                                            <input type="text" name="phone"  required="required" class="form-control form-control-sm" placeholder="الهاتف" />
                                                            </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group has-danger" style="text-align: right;">
                                                            <label class="control-label">  تاريخ الميلاد </label>
                                                            <input type="date" name="birthdate"  required="required" class="form-control form-control-sm" placeholder="تاريخ الميلاد" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-danger" style="text-align: right;">
                                                            <label class="control-label">   الصورة الشخصية </label>
                                                            <input type="file" name="user_avatar"  required="required" class="form-control form-control-sm"  />
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <div class="row p-t-20"> 
                                                <?php // ====   department &&  Role   hidden inputs === 
                                                    if (isset($_SESSION['Edara30'])){
                                                    $getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
                                                    $getUser->execute(array($_SESSION['Edara30']));
                                                    $info = $getUser->fetch();
                                                        if (array_search($info['role'], ['30']) !== false) { // شرق?>	
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <input type="hidden" value="10" name="department"  class="form-control"  />
                                                                    <input type="hidden" value="44" name="role"  class="form-control"  />
                                                                </div>
                                                            </div><?php
                                                        }
                                                    }?>
                                                </div>
                                            <div class="form-actions pull-right">
                                                <input type="submit" class="btn btn-success swalDefaultSuccess"  value="اضافة عضو" />  
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><?php
            }   


        }elseif($do == 'Insert'){  // Insert vew school  Page
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Get Variabls from the Form
                $user  = $_POST['username'];
                $pass  = $_POST['password'];
                $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                $name  = $_POST['full'];
                $hashPass = sha1($_POST['password']);

                $job_title  = $_POST['job_title'];
                $al_city  = $_POST['al_city'];
                $birthdate  = $_POST['birthdate'];
                $phone  = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);

                $user_avatarName = $_FILES['user_avatar']['name'];
                $user_avatarSize = $_FILES['user_avatar']['size'];
                $user_avatarTmp  = $_FILES['user_avatar']['tmp_name'];
                $user_avatarType = $_FILES['user_avatar']['type'];
                $user_avatarAllowedExtension = array("jpeg", "jpg", "png", "gif");
                $tmp = explode('.', $user_avatarName);
                $user_avatarExtension = end($tmp);

                
                $department  = filter_var($_POST['department'], FILTER_SANITIZE_NUMBER_INT);
                $role  = filter_var($_POST['role'], FILTER_SANITIZE_NUMBER_INT);
                
                //Validate The Form
                $formErrors = array();
                if (strlen($user) < 4) {
                    $formErrors[] = '<span>  اسم المستخدم يجب الا يقل عن اربعة احرف</span> </i>';
                }
                if (strlen($user) > 40) {
                    $formErrors[] = '<span> اسم المستخدم يجب الا يزيد عن اربعون حرف</span> </i>';
                }
                if (empty($user)) {
                    $formErrors[] = '<span> لا يمكنك ترك اسم المستخدم فارغا</span> </i>';
                }
                if (empty($pass)) {
                    $formErrors[] = '<span> لا يمكنك ترك كلمة المرور فارغة</span> </i>';
                }
                if (empty($name)) {
                    $formErrors[] = '<span> لا يمكنك ترك اسم المستخدم فارغ</span> </i>';
                }
                if (! empty($user_avatarName) && ! in_array($user_avatarExtension, $user_avatarAllowedExtension)){
                    $formErrors[] = '<span> امتداد الصورة عير مسموح به</span> </i>';
                }
                if (empty($user_avatarName)) {
                        $formErrors[] = '<span> يجب اختيار صور شخصية </span> </i>';
                }
                if ($user_avatarSize > 2621440) {
                        $formErrors[] = '<span> حجم الصورة يجب ان يكون اقل من 2.5 ميجا بايت </span> </i>';
                }
               
                if (empty($al_city)) {
                    $formErrors[] = '<span> اختر المدينة</span> </i>';
                } ?>
                
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

                        $user_avatar = rand(0, 1000000000)	. '_' . $user_avatarName;
                        move_uploaded_file($user_avatarTmp , "../admin/nsharat_uploads/user_avatar//" . $user_avatar);

                    // check if user Exist in database
                    $check = checkItem ("Username", "users", $user);
                    if ($check == 1){
                        echo "<div class='container'>";
                            echo "<div class= 'alert alert-danger text-center'>-------- المستخدم موجود مسبقا -------  </div>" ;
                            $theMsg = isset($theMsg) ? $theMsg : '';
                            redirectHome($theMsg, 'back');
                        echo "</div>";
                        
                    }else{
                    
                        // Inser Info to database *** مهم *** 
                        $stmt = $con->prepare("INSERT INTO 
                                                users
                                                    (Username, Password, Email, FullName ,RegStatus, Date,  job_title, al_city, 
                                                    birthdate, user_avatar,
                                                    phone, 
                                                    department, role)
                                                VALUES
                                                    (:zuser, :zpass, :zmail, :zname, 1, now(), :zjob_title, :zal_city,
                                                        :zbirthdate, :zuser_avatar,
                                                        :zphone,   :zdepartment, :zrole)"); 
                        $stmt->execute(array(
                            'zuser'  => $user,
                            'zpass'  => $hashPass,
                            'zmail' => $email,
                            'zname' => $name,
                            'zjob_title' => $job_title,
                            'zal_city' => $al_city,
                            'zbirthdate' => $birthdate,
                            'zuser_avatar' => $user_avatar,
                            'zphone' => $phone,
                            
                            'zdepartment' => $department,
                            'zrole' => $role
                        ));
                        //Echo Success Measage
                        if ($stmt) { // if it's true
                            sleep(1);?>
                            <script src="../layout/dist/js/sweetalert2.min.js"></script>
                            <script>
                                Swal.fire({
                                    title: 'تم إضافة العضو بنجاح',
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
                }
            }else{
                echo "<div class='container'>"; echo "<div class= 'alert alert-danger text-center'>-------- خطأ في الادخال -------  </div>" ;
                    echo '<a href="logout" class="btn btn-danger">عودة للسابقة</a>';
                echo "</div>";
            }




        }elseif($do == 'Edit'){   // === START Edit Page =====================
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
                                <div class="card-header"><h3 class="card-title text-center">تعديل بيانات مشترك</h3></div>
                                <div class="card-body">
                                    <form action="?do=Update" method="POST">
                                        <input type="hidden" name="userid" value="<?php echo $userid ?>" /><?php
                                        if (array_search($info['GroupID'], ['1']) !== false) { // مدير?>	
                                                <h3 class="card-title m-t-15" style="font-size: 15px;background-color: #022b09;color:#fff;padding:5px;margin-bottom:3px;">
                                                    اسم المستخدم & كلمة المرور
                                                </h3>
                                                <div class="row p-t-20">
                                                    <div class="col-md-6">
                                                        <div class="form-group" style="text-align: right;">
                                                            <label class="control-label">اسم المستخدم</label>
                                                            <input type="text" name="username"id="firstName" class="form-control form-control-sm" value="<?php echo $row['Username']?>" autocomplete="off" required="required" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group has-danger" style="text-align: right;">
                                                            <label class="control-label">كلمة المرور</label>
                                                            <input type="hidden" name="oldpassword" value="<?php echo $row['Password']?>" />
                                                            <input type="password" name="newpassword" class="form-control form-control-sm" autocomplete="new-password" placeholder="اتركه فارغا في حلة عدم الرغبة للتغير" />
                                                            </div>
                                                    </div>
                                                </div>
                                        <?php   }   ?>
                                        <hr>
                                        <h3 class="card-title m-t-15" style="font-size: 15px;background-color: #022b09;color:#fff;padding:5px;margin-bottom:3px;">
                                            البيانات الاساسية
                                        </h3>
                                        <div class="row p-t-20">
                                            <div class="col-md-6">   
                                                    <div class="form-group" style="text-align: right;">
                                                        <label class="control-label">البريد الالكتروني</label>
                                                        <input type="email" name="email" class="form-control form-control-sm" value="<?php echo $row['Email']?>"   required="required"/>
                                                    </div>
                                            </div>
                                            <div class="col-md-6">
                                                    <div class="form-group has-danger" style="text-align: right;">
                                                    <label class="control-label">الاسم بالكامل</label>
                                                    <input type="text" name="full" class="form-control form-control-sm" value="<?php echo $row['FullName']?>"  required="required" />
                                                    </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" style="text-align: right;">
                                                    <label class="control-label"> الوظيفة  </label>
                                                    <input type="text" name="job_title"  required="required"  value="<?php echo $row['job_title']?>" class="form-control form-control-sm"  />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" style="text-align: right;">
                                                    <label class="control-label"> المدينة</label>
                                                    <input type="text" name="al_city"  required="required"  value="<?php echo $row['al_city']?>" class="form-control form-control-sm"  />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group has-danger" style="text-align: right;">
                                                    <label class="control-label">الهاتف</label>
                                                    <input type="text" name="phone" required="required" class="form-control form-control-sm" value="<?php echo $row['phone']?>" />
                                                    </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group has-danger" style="text-align: right;">
                                                    <label class="control-label"> تاريخ الميلاد </label>
                                                    <input type="date" name="birthdate"  class="form-control form-control-sm" value="<?php echo $row['birthdate']?>" />
                                                </div>
                                            </div>
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
        
        }elseif($do == 'Update'){   // === strst of Update Page =================*
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Get Variabls from the Form
                $id    = $_POST['userid'];
                $user  = $_POST['username'];
                $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                $name  = $_POST['full'];
                    // Password TRICK
                $pass = empty ($_POST['newpassword']) ? $_POST['oldpassword'] :sha1($_POST['newpassword']);

                $job_title  = $_POST['job_title'];
                $al_city  = $_POST['al_city'];
                $birthdate  = $_POST['birthdate'];
                $phone  = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
                
                $department     = $_POST['department'];
                $role  			= $_POST['role'];
                
                //Validate The Form
                $formErrors = array();
                if (strlen($user) < 4) {
                    $formErrors[] = '<span>  اسم المستخدم يجب الا يقل عن اربعة احرف</span> </i>';
                }
                if (strlen($user) > 40) {
                    $formErrors[] = '<span> اسم المستخدم يجب الا يزيد عن اربعون حرف</span> </i>';
                }
                if (empty($user)) {
                    $formErrors[] = '<span> لا يمكنك ترك اسم المستخدم فارغا</span> </i>';
                }
                if (empty($pass)) {
                    $formErrors[] = '<span> لا يمكنك ترك كلمة المرور فارغة</span> </i>';
                }
                if (empty($name)) {
                    $formErrors[] = '<span> لا يمكنك ترك اسم المستخدم فارغ</span> </i>';
                }
                if ($al_city == 0) {
                    $formErrors[] = '<span> اختر المدينة</span> </i>';
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
                        $stmt = $con->prepare("UPDATE users SET Username = ?, Email = ?, FullName = ?, Password = ?, 
                                                    phone = ?,  
                                                    job_title = ?, al_city = ?, 
                                                    birthdate = ?, 
                                                    department = ?,	
                                                    role = ? WHERE UserID = ?");
                        $stmt->execute(array($user, $email, $name, $pass,  $phone, 
                                            $job_title, $al_city,  $birthdate,  
                                            $department, 
                                            $role, $id));
                        //Echo Success Measage
                        if ($stmt) { // if it's true
                            sleep(1);?>
                            <script src="../layout/dist/js/sweetalert2.min.js"></script>
                            <script>
                                Swal.fire({
                                    title: 'تم تحديث بيانات العضو بنجاح',
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