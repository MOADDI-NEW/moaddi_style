<?php
ob_start();
session_start();
$noNavbar = '';
$main_header_edara = '';
$main_sidebar_edara = '';

if (isset($_SESSION['Edara30'])){
    $pageTitle = 'النشرات والتعليمات';  // this function to load page title
    include 'init.php';   //  Dirctory page

	$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
	$getUser->execute(array($_SESSION['Edara30']));
	$info = $getUser->fetch(); ?>

<div class="main-content app-content"> 
	<?php include 'breadcrumb.php';
    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';     // shor if 
    if($do == 'Manage'){ //=========== Start Manage Page ============
        if (isset($_SESSION['Edara30'])){
            $getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
            $getUser->execute(array($_SESSION['Edara30']));
            $info = $getUser->fetch();
            if (array_search($info['GroupID'], ['1']) !== false) { // مدير ومساعد مدير
                $stmt = $con->prepare("SELECT * FROM items2, categories ,users
                                    WHERE categories.ID = items2.Cat_ID
                                        AND	 users.UserID = items2.Member_ID
                                        AND Cat_Group = 11 AND department = 10
                                        ORDER BY Item_ID DESC ");
                $stmt->execute();
                $items = $stmt->fetchAll();
                if (! empty($items)){ ?>
                    <div class="container-fluid">	
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title text-center"> تعليمات المركز</h4>
                                        <a href="nashra_to_students?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i> اضافة جديدة </a>
                                        <div class="table-responsive export-table">
                                            <table id="example" class="table table-bordered table-striped" style= "width:99%; direction:rtl;">
                                                <thead><tr><th scope="col">مسلسل</th> <th scope="col">التاريخ</th><th scope="col">العنوان </th><th scope="col">اسم الراسل</th><th scope="col">التحكم</th></tr></thead>
                                                <tbody>
                                                    <?php
                                                    foreach($items as $item){
                                                        echo "<tr>";
                                                        echo "<td style='line-height: 20px;vertical-align: middle;'>" . $item['Item_ID'] . "</td>";
                                                        echo "<td style='line-height: 20px;vertical-align: middle;'>" . $item['nashra_date'] . "</td>";
                                                        echo "<td style='line-height: 20px;vertical-align: middle;'>" . $item['title'] . "</td>";
                                                        echo "<td style='line-height: 20px;vertical-align: middle;'>" . $item['FullName'] . "</td>";
                                                            if ($item['Cat_Group'] == 11){
                                                            echo "<td data-label='التحكم'>
                                                                <a href='nashra_to_students?memberid=315&formerror=form&action=employee&emplyeeid=3265&action=grtstat&grtstat=359&formerror=9853&getid=63524&iteimid=32145&checksum=56821&cookie=30121&do=Edit&itemid=" . $item['Item_ID'] ."&counksum=93214&action=421' class=''><i class='fa fa-edit' style='color: #046e1f;margin-right: 5px;'></i> </a>
                                                                <a href='nashra_to_students?memberid=315&formerror=form&action=employee&emplyeeid=3265&action=grtstat&grtstat=359&formerror=9853&getid=63524&iteimid=32145&checksum=56821&cookie=30121&do=Delete&itemid=" . $item['Item_ID'] ."&counksum=93214&action=421' class=''><i class='far fa-trash-alt' style='color: #f21a6d;margin-right: 5px;'></i> </a> ";
                                                                echo "</td>";
                                                        }
                                                            echo "</tr>";
                                                        } 	?>						
                                                        </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>	<?php		
                                    }else{
                                        echo '<div class="container">';
                                                echo '<div class="nice-message"> لم ترسل اي تعليمات الى المركز</div>';
                                                echo '<a href="nashra_to_students?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i> تعليمات جديدة </a>';
                                        echo '</div>';
                                    } ?>
                                </div>		
                            </div>
                        </div>
                    </div><?php
            }
        }

    }elseif($do == 'Add'){ //=========== Start Add item Page ============ ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-outline-primary" style="background: #d5d3f9eb  none repeat scroll 0 0;">
                        <div class="card-header">
                            <h4 class="m-b-0 text-white" style="font-family: 'Amiri', serif; font-size:16px; text-align:center;">اضافة تعليمات جديدة</h4>
                        </div>
                        <div class="card-body">
                                <form action="?do=Insert" method="POST" enctype="multipart/form-data">
                                    <div class="form-body">
                                        <h3 class="card-title m-t-15" style="font-size: 15px;background-color: #b4f6c0;">العنوان</h3>
                                        <hr>
                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group" style="text-align: right;">
                                                    <label class="control-label">اسم التقرير</label>
                                                    <input type="text" name="name"  class="form-control form-control-sm"  readonly="readonly"  value="تعليمات" />
                                                </div>
                                            </div>
                                                <div class="col-md-6">
                                                <div class="form-group" style="text-align: right;">
                                                    <label class="control-label">العنوان</label>
                                                    <input type="text" name="title"  class="form-control form-control-sm"  required="required"  placeholder="العنوان " />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row p-t-20">
                                                <div class="col-md-12">
                                                <div class="form-group has-danger" style="text-align: right;">
                                                    <label class="control-label"> نص التعليمات</label>
                                                    <textarea type="textarea" name="path" autocomplete="off" required="required" placeholder="نص التعليمات"  style="width: 100%;height: 200px;" ></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group" style="text-align: right;">
                                                        <!-- school to send to -->
                                                        <?php //مدخل البيان
                                                                if (isset($_SESSION['Edara30'])){
                                                                $getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
                                                                $getUser->execute(array($_SESSION['Edara30']));
                                                                $info = $getUser->fetch();
                                                                if (array_search($info['role'], ['30']) !== false) { // شرق?>
                                                                <input type="hidden" name="member"   value="<?php echo $info['UserID'];?>"/>
                                                                <?php
                                                                }
                                                            }
                                                        ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" style="text-align: right;">
                                                    <label class="control-label"> </label>
                                                            <?php 
                                                                $stmt2 = $con->prepare("SELECT * FROM categories WHERE Cat_Group = 11");
                                                                $stmt2->execute();
                                                                $cats = $stmt2->fetchAll();
                                                                foreach ($cats as $cat) { ?>
                                                                    <input type="hidden" name="category" class="form-control"  value="<?php echo $cat['ID']  ?>" />
                                                                    <?php
                                                                    }
                                                                ?>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="form-actions pull-right">
                                        <i class="fa fa-check"></i> <input type="submit" class="btn btn-success"  value="اضافة" />  
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>	
        </div>	<?php

    }elseif($do == 'Insert'){
        if (isset($_SESSION['Edara30'])){
            $getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
            $getUser->execute(array($_SESSION['Edara30']));
            $info = $getUser->fetch();
            if (array_search($info['role'], ['30']) !== false) { // شرق
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        echo "<div class ='container'>";
                        // Get Variabls from the Form
                        $name     = $_POST['name'];
                        $title  = $_POST['title'];
                        $path  = $_POST['path'];
                        
                        
                        $member   = $_POST['member'];
                        $cat   	  = $_POST['category'];
                        
                        //Validate The Form
                        $formErrors = array();
                        //if (empty($name)) {
                            //$formErrors[] = 'Name cant be <strong>Empty</strong>';
                        //}
                    
                        if (empty($title)) {
                            $formErrors[] = '<span>  لا يمكنك ارسال التعليمات بدون عنوان</span> <i class="fa fa-bomb" style="font-size:30px"></i>';
                        }
                        if ($member == 0) {
                            $formErrors[] = '<span>  يجب عليك اختيار المستخدم الذي قام بارسال التعليمات</span> <i class="fa fa-bomb" style="font-size:30px"></i>';
                        }
                        if ($cat == 0) {
                            $formErrors[] = '<span>  يجب عليك اختيار نوع التعليمات المرسل</span> <i class="fa fa-bomb" style="font-size:30px"></i>';
                        }
                        
                        foreach ($formErrors as $error) { // error Message
                            echo '<div class="container">';
                                echo '<div class="row">';
                                    echo '<div class="col-md-12">';
                            echo '<div class="alert alert-danger pull-right">' . $error . '</div>' ;
                            echo '</div>';	 
                                echo '</div>';
                                    echo '</div>';
                            echo '<div class="container">';
                                echo '<div class="row">';
                                    echo '<div class="col-md-12">';
                                        echo '<a href="javascript:history.go(-1)">عودة للسابقة</a>';
                                    echo '</div>';	 
                                echo '</div>';
                            echo '</div>';
                        }
                        if(empty($formErrors)){
                        
                        // Inser Info to database *** مهم *** 
                            $stmt = $con->prepare("INSERT INTO 
                                                items2
                                (Name, title,  path, 
                                nashra_date, Cat_ID, Member_ID)
                                            VALUES
                                (:zname, :ztitle, :zpath, 
                                now(), :zcat, :zmember)");
                            $stmt->execute(array(
                            
                            'zname'    => $name,    'ztitle'  => $title,       'zpath'  => $path,
                            'zcat'  => $cat,   'zmember'  => $member ));
                                            //Echo Success Measage
                                            echo "<script>
                                                alert('تمت اضافة تعليمات المشتركين بنجاح');
                                                </script>";										
                                        redirectHome($theMsg, 'back');
                                    }
                }else{
                    echo "<div class='container'>";
                    $theMsg = "<div class= 'alert alert-danger'> You Cannot Browse This Page </div>" ;
                    redirectHome($theMsg);
                    echo "</div>";
                }
            echo"</div>";
            }
        }

    }elseif($do == 'Edit'){ 
        $itemid = isset($_GET['itemid'])&& is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;
        if (isset($_SESSION['Edara30'])){
            $getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
            $getUser->execute(array($_SESSION['Edara30']));
            $info = $getUser->fetch();
            }
            $stmt = $con->prepare("SELECT * FROM items2 WHERE Item_ID = ?");
            $stmt->execute(array($itemid));
            $item = $stmt->fetch();
            $count = $stmt->rowCount();
            if ($stmt->rowCount() > 0 && $info['UserID'] == $item['Member_ID']){ ?>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-outline-primary" style="background: #c3e7e8 none repeat scroll 0 0;">
                                <div class="card-header">
                                    <h4 class="m-b-0 text-white" style="font-family: 'Amiri', serif; font-size:16px; text-align:center;">اضافة نشرة جديدة</h4>
                                </div>
                                <div class="card-body">
                                    <form action="?do=Update" method="POST">
                                        <input type="hidden" name="itemid" value="<?php echo $itemid ?>" />
                                        <div class="form-body">
                                            <h3 class="card-title m-t-15" style="font-size: 15px;background-color: #b4f6c0;">العنوان</h3>
                                            <hr>
                                            <div class="row p-t-20">
                                                <div class="col-md-6">
                                                    <div class="form-group" style="text-align: right;">
                                                        <label class="control-label">اسم التقرير</label>
                                                        <input type="text" name="name" class="form-control form-control-sm" readonly="readonly" required="required" value="<?php echo $item['Name']?>" />
                                                    </div>
                                                </div>
                                                    <div class="col-md-6">
                                                    <div class="form-group" style="text-align: right;">
                                                        <label class="control-label">العنوان</label>
                                                        <input type="text" name="title" class="form-control form-control-sm" required="required" value="<?php echo $item['title']?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row p-t-20">
                                                    <div class="col-md-12">
                                                    <div class="form-group has-danger" style="text-align: right;">
                                                        <label class="control-label">نص التعليمات</label>
                                                        <?php echo '<textarea type="textarea" name="path"  style="width: 100%;height: 200px;">' .$item['path']. '</textarea>';  ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group" style="text-align: right;"><?php //مدخل البيان
                                                            if (isset($_SESSION['Edara30'])){
                                                            $getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
                                                            $getUser->execute(array($_SESSION['Edara30']));
                                                            $info = $getUser->fetch();
                                                            if (array_search($info['role'], ['30']) !== false) { // شرق?>
                                                            <input type="hidden" name="member"   value="<?php echo $info['UserID'];?>"/>
                                                            <?php
                                                            }
                                                        } ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" style="text-align: right;">
                                                        <label class="control-label"></label> <?php 
                                                            $stmt2 = $con->prepare("SELECT * FROM categories WHERE Cat_Group = 11");
                                                            $stmt2->execute();
                                                            $cats = $stmt2->fetchAll();
                                                            foreach ($cats as $cat) { ?>
                                                                <input type="hidden" name="category" class="form-control"  value="<?php echo $cat['ID']  ?>" />
                                                                <?php
                                                                } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <div class="form-actions pull-right">
                                            <i class="fa fa-check"></i> <input type="submit" class="btn btn-success"  value="حفظ التعديل" />  
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>	<?php
            }else{
                echo "<div class='container'>";
                    echo "<div class= 'alert alert-danger text-center'>-------- خطأ في الادخال -------  </div>" ;
                    echo '<a href="logout.php" class="btn btn-danger">عودة للسابقة</a>';
                    //redirectHome($theMsg);
                echo "</div>";		
            }

    }elseif($do == 'Update'){
                                // === strst of Update Page =================*
                        echo "<h1 class='text-center'> تحديث النشرة </h1>";
                        echo "<div class ='container'>";
                        if($_SERVER['REQUEST_METHOD'] == 'POST'){
                            // Get Variabls from the Form
                            $id       = $_POST['itemid'];
                            $name     = $_POST['name'];
                            $title     = $_POST['title'];
                            $path      = $_POST['path'];

                            $member   = $_POST['member'];
                            $cat   	  = $_POST['category'];
                                
                            //Validate The Form
                        $formErrors = array();
                    //if (empty($name)) {
                        //$formErrors[] = 'Name cant be <strong>Empty</strong>';
                    //}
                
                    if (empty($title)) {
                        $formErrors[] = '<span>  لا يمكنك ارسال التعليمات بدون عنوان</span> <i class="fa fa-bomb" style="font-size:30px"></i>';
                    }
                    if ($member == 0) {
                        $formErrors[] = '<span>  يجب عليك اختيار المستخدم الذي قام بارسال التعليمات</span> <i class="fa fa-bomb" style="font-size:30px"></i>';
                    }
                    if ($cat == 0) {
                        $formErrors[] = '<span>  يجب عليك اختيار نوع التعليمات المرسل</span> <i class="fa fa-bomb" style="font-size:30px"></i>';
                    }
                    foreach ($formErrors as $error) { // error Message 
                        echo '<div class="container">';
                            echo '<div class="row">';
                                echo '<div class="col-md-12">';
                        
                        echo '<div class="alert alert-danger pull-right">' . $error . '</div>' ;
                        
                        echo '</div>';	 
                            echo '</div>';
                                echo '</div>';
                        
                        echo '<div class="container">';
                            echo '<div class="row">';
                                echo '<div class="col-md-12">';
                                    echo '<a href="javascript:history.go(-1)">عودة للسابقة</a>';
                                echo '</div>';	 
                            echo '</div>';
                        echo '</div>';
                    }
                            //check if no error update operators
                            if (empty($formErrors)){
                                // Update the database with this Info
                                $stmt = $con->prepare("UPDATE 
                                                            items2 
                                                        SET 
                                Name = ?, title = ?, path = ?,
                                Cat_ID = ?,	Member_ID = ?						
                                                        WHERE
                                                            Item_ID = ?");
                                                            
                        $stmt->execute(array($name, $title, $path, 
                                        $cat, $member, $id));
                                //Echo Success Measage
                                        echo "<script>
                                            alert('تم تحديث بيانات تعليمات المركز  بنجاح');
                                            </script>";						
                                redirectHome($theMsg, 'back');	
                            }
                        }else{
                            echo "<div class='container'>";
                                $theMsg = "<div class= 'alert alert-danger'> You Cannot Browse This Page</div>" ;
                            redirectHome($theMsg);
                            
                            echo "</div>";
                            echo '';
                            }
                            echo"</div>";
        
    }elseif($do == 'Delete'){
                            // Delete members page==========
                        echo "<h1 class='text-center'> Delet Item</h1>";
                        echo "<div class ='container'>";
                    $itemid = isset($_GET['itemid'])&& is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;
                    // Check if the Userid is numeric and  Exist in Database	
                        $check = checkItem ('Item_ID', 'items2', $itemid);
                        if ($check > 0){ 
                        $stmt = $con->prepare("DELETE FROM items2 WHERE Item_ID = :zid");
                        $stmt->bindParam(":zid",$itemid);
                        $stmt->execute();
                            echo "<script>
                            alert('تم الحذف بنجاح');
                            </script>";
                            redirectHome($theMsg, 'back');
                        }else{
                            echo "<div class='container'>";
                            $theMsg = "<div class= 'alert alert-danger'> THIS ID IS NOT EXIST</div>" ;
                            redirectHome($theMsg);
                            echo "</div>";
                        }
    }
	
}else{
	header ('location: ../index');
	exit();
}
include   $tpl . 'footer.php';
include   $tpl . 'footer-scripts.php';
ob_end_flush();