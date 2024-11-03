<?php 
ob_start();
session_start();
$noNavbar = '';
$main_header_school = '';
$main_sidebar_school = '';
$pageTitle = ' المناسبات  ';  // this function to load page title
include 'init.php';   //  Dirctory page

if (isset($_SESSION['user'])){
$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
$getUser->execute(array($sessionUseer));
$info = $getUser->fetch(); ?>

		<!-- breadcrumb -->
		<?php include 'breadcrumb.php';

$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';  // shor if 
if($do == 'Manage'){  //==== Manage Page == 

        $stmt = $con->prepare("SELECT * FROM events  ORDER BY event_id DESC");
        $stmt->execute();
        $rows = $stmt->fetchAll();
        if (! empty($rows)){ ?>
            <div class="container-fluid">
                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header"><h3 class="card-title text-center">قوائم مناسبات العائلة</h3></div>
                                 <a href="events?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i> اضافة مناسبة جديد </a>
                            <div class="card-body">
                                <div class="table-responsive export-table">
                                    <table id="example" class="table table-bordered table-striped" style= "width:98%; direction:rtl;">
                                    <thead>
                                        <tr>
                                            <th> #</th>
                                            <th> اسم المناسبة</th>
                                            <th> تاريخ المناسبة</th>
                                            <th>  المكان </th>
                                            <th>  بواسطة </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach($rows as $row){
                                            echo "<tr>";
                                                echo "<td>" . $i++ . "</td>";
                                                echo "<td>";
                                                   $stmt = $con->prepare("SELECT * FROM events_names ");
                                                   $stmt->execute();  $users = $stmt->fetchAll();
                                                   foreach ($users as $user) {
                                                      if ($row['event_name'] == $user['id']) {echo $user['event_name'];} 
                                                      }
                                                   echo"</td>";
                                                echo "<td>" . $row['event_date'] . "</td>";
                                                echo "<td>" . $row['location'] . "</td>";
                                                echo "<td>";  
                                                    $stmt = $con->prepare("SELECT * FROM users");
                                                    $stmt->execute();
                                                    $users = $stmt->fetchAll();
                                                    foreach ($users as $user) {
                                                       if ($row['created_by'] == $user['UserID']) {
                                                            echo $user['FullName'] ;
                                                       }
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
            }else{ echo '<div class="container">'. '<div class="nice-message"> لا يوجد مناسبات للعرض</div>';
                echo '<a href="events?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i> اضافة مناسبة جديد </a>';
            echo '</div>';  } 

        
}elseif($do == 'Add'){  // ADD Members Page ?>
        <div class="container-fluid">
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header"><h3 class="card-title text-center">اضافة مناسبة جديد</h3></div>
                        <div class="card-body">
                            <form action="?do=Insert" method="POST">
                                <div class="form-body">
                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group has-danger" style="text-align: right;">
                                                   <label class="control-label">اسم المناسبة</label>
                                                   <select class="form-control form-control-sm " name="event_name" style="width:100%;">
                                                            <option value="0">--اختر--</option><?php
                                                            $stmt = $con->prepare("SELECT * FROM events_names");
                                                            $stmt->execute();
                                                            $users = $stmt->fetchAll();
                                                            foreach ($users as $user) {
                                                               echo "<option value='" . $user['id'] . "'>" . $user['event_name'] . "</option>";
                                                               }  ?>
                                                   </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group has-danger" style="text-align: right;">
                                                    <label class="control-label"> تاريخ المناسبة</label>
                                                    <input type="date" name="event_date"   required="required" class="form-control form-control-sm"  />
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="row p-t-20">
                                            <div class="col-md-12">
                                                <div class="form-group has-danger" style="text-align: right;">
                                                    <label class="control-label"> مكان المناسبة </label>
                                                    <input type="text" name="location"  required="required" class="form-control form-control-sm" placeholder="مكان المناسبة" />
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group" style="text-align: right;">
                                                    <label class="control-label"> وصف الماسبة   </label>
                                                    <textarea name="description" id="description"  rows="4" required="required" class="form-control form-control-sm"></textarea>
                                                </div>
                                            </div>
                                            <input type="hidden" name="created_by"  required="required" class="form-control form-control-sm" value="<?php echo $info['UserID'];?> " />
                                        </div>
                                    <div class="form-actions pull-right">
                                        <input type="submit" class="btn btn-success swalDefaultSuccess"  value="اضافة مناسبة" />  
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><?php
      


}elseif($do == 'Insert'){  // Insert vew school  Page
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Get Variabls from the Form
        $event_name  = $_POST['event_name'];
        $event_date  = $_POST['event_date'];
        $location  = $_POST['location'];
        $description  = $_POST['description'];
       
        $created_by  = filter_var($_POST['created_by'], FILTER_SANITIZE_NUMBER_INT);
        
        //Validate The Form
        $formErrors = array();
        if ($event_name == 0) {
            $formErrors[] = '<span> لا يمكنك ترك اسم المناسبة فارغا</span> </i>';
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
            // check if user Exist in database
           
                // Inser Info to database *** مهم *** 
                $stmt = $con->prepare("INSERT INTO 
                                        events
                                            (event_name, event_date, location, description ,created_by)
                                        VALUES
                                            (:zevent_name, :zevent_date, :zlocation, :zdescription, :zcreated_by)"); 
                $stmt->execute(array(
                    'zevent_name'  => $event_name,
                    'zevent_date'  => $event_date,
                    'zlocation' => $location,
                    'zdescription' => $description,
                    'zcreated_by' => $created_by
                ));
                //Echo Success Measage
                if ($stmt) { // if it's true
                    sleep(1);?>
                    <script src="../layout/dist/js/sweetalert2.min.js"></script>
                    <script>
                        Swal.fire({
                            title: 'تم إضافة المناسبة بنجاح',
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
        echo "<div class='container'>"; echo "<div class= 'alert alert-danger text-center'>-------- خطأ في الادخال -------  </div>" ;
            echo '<a href="logout" class="btn btn-danger">عودة للسابقة</a>';
        echo "</div>";
    }

}
	
}else{
	header ('location: index');
	exit();
}
include   $tpl . 'footer.php';
include   $tpl . 'footer-scripts.php';
ob_end_flush();
?>