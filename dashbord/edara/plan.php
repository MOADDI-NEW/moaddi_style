<?php
ob_start();
session_start();
$noNavbar = '';
$main_header_edara = '';
$main_sidebar_edara = '';

if (isset($_SESSION['Edara30'])){
    $pageTitle = 'الخطط التدريبية';  // this function to load page title
    include 'init.php';   //  Dirctory page


	$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
	$getUser->execute(array($_SESSION['Edara30']));
	$info = $getUser->fetch();
    
    include 'breadcrumb.php';
	if (array_search($info['role'], ['30']) !== false) { //   ادارة الجيم 
        
        $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';  // shor if 
        if($do == 'Manage'){  //==== Manage Page == 
            if (array_search($info['GroupID'], ['1']) !== false) {	   // مدير د
                $stmt = $con->prepare("SELECT * FROM plan_package  ORDER BY id ASC");
                $stmt->execute();
                $rows = $stmt->fetchAll();
                if (! empty($rows)){ ?>
                    <div class="container-fluid">
                        <div class="row row-sm">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header"><h3 class="card-title text-center"> الخطط التدريبية</h3></div>
                                        <?php
                                            if (isset($_SESSION['Edara30'])){
                                                $getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
                                                $getUser->execute(array($_SESSION['Edara30']));
                                                $info = $getUser->fetch();
                                                if (array_search($info['GroupID'], ['1']) !== false) { // المدير  ?>
                                            <a href="plan?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i> اضافة خطة تدريبية جديدة </a>
                                            <?php
                                                }
                                            }
                                        ?>
                                    <div class="card-body">
                                        <div class="table-responsive export-table">
                                            <table id="example" class="table table-bordered table-striped" style= "width:98%; direction:rtl;">
                                            <thead>
                                                <tr>
                                                    <th> #</th>
                                                    <th> الحزمة</th>
                                                    <th> الخطة</th>
                                                    <th> السبت </th>
                                                    <th>  من </th>
                                                    <th>  الى </th>
                                                    <th> الأحد </th>
                                                    <th>  من </th>
                                                    <th>  الى </th>
                                                    <th> الأثنين </th>
                                                    <th>  من </th>
                                                    <th>  الى </th>
                                                    <th> الثلاثاء </th>
                                                    <th>  من </th>
                                                    <th>  الى </th>
                                                    <th> الأربعاء </th>
                                                    <th>  من </th>
                                                    <th>  الى </th>
                                                    <th> الخميس </th>
                                                    <th>  من </th>
                                                    <th>  الى </th>
                                                    <th> الجمعة </th>
                                                    <th>  من </th>
                                                    <th>  الى </th>
                                                    <th> التحكم </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 1;
                                                    foreach($rows as $row){
                                                        $time_from_1 = substr($row["time_from_1"], 0, 5);
                                                        $time_from_2 = substr($row["time_from_2"], 0, 5);
                                                        $time_from_3 = substr($row["time_from_3"], 0, 5);
                                                        $time_from_4 = substr($row["time_from_4"], 0, 5);
                                                        $time_from_5 = substr($row["time_from_5"], 0, 5);
                                                        $time_from_6 = substr($row["time_from_6"], 0, 5);
                                                        $time_from_7 = substr($row["time_from_7"], 0, 5);

                                                        $time_to_1 = substr($row["time_to_1"], 0, 5);
                                                        $time_to_2 = substr($row["time_to_2"], 0, 5);
                                                        $time_to_3 = substr($row["time_to_3"], 0, 5);
                                                        $time_to_4 = substr($row["time_to_4"], 0, 5);
                                                        $time_to_5 = substr($row["time_to_5"], 0, 5);
                                                        $time_to_6 = substr($row["time_to_6"], 0, 5);
                                                        $time_to_7 = substr($row["time_to_7"], 0, 5);

                                                    echo "<tr>";
                                                        echo "<td>" . $i++ . "</td>";
                                                        echo "<td>"; 
                                                            $stmt = $con->prepare("SELECT * FROM packages");
                                                            $stmt->execute();
                                                            $users = $stmt->fetchAll();
                                                            foreach ($users as $user) {
                                                                if ($row['package_id'] == $user['id']){ echo  $user['package']; }
                                                                }  
                                                        echo "</td>";
                                                        echo "<td>" . $row['paln_name'] . "</td>";

                                                        echo "<td>" ; if (!empty($row["dow_1"])) { echo '<span class="text-green"> ✓ </span>'; } else { echo '<span class="text-red"> X </span>'; } echo "</td>" ;
                                                        echo "<td>" ; if (!empty($row["time_from_1"])) { echo $time_from_1; } else { echo '<span class="text-red"> - </span>'; } echo "</td>" ;
                                                        echo "<td>" ; if (!empty($row["time_to_1"])) { echo $time_to_1; } else { echo '<span class="text-red"> - </span>'; } echo "</td>" ;

                                                        echo "<td>" ; if (!empty($row["dow_2"])) { echo '<span class="text-green"> ✓ </span>'; } else { echo '<span class="text-red"> X </span>'; } echo "</td>" ;
                                                        echo "<td>" ; if (!empty($row["time_from_2"])) { echo $time_from_2; } else { echo '<span class="text-red"> - </span>'; } echo "</td>" ;
                                                        echo "<td>" ; if (!empty($row["time_to_2"])) { echo $time_to_2; } else { echo '<span class="text-red"> - </span>'; } echo "</td>" ;
                                                        
                                                        echo "<td>" ; if (!empty($row["dow_3"])) { echo '<span class="text-green"> ✓ </span>'; } else { echo '<span class="text-red"> X </span>'; } echo "</td>" ;
                                                        echo "<td>" ; if (!empty($row["time_from_3"])) { echo $time_from_3; } else { echo '<span class="text-red"> - </span>'; } echo "</td>" ;
                                                        echo "<td>" ; if (!empty($row["time_to_3"])) { echo $time_to_3; } else { echo '<span class="text-red"> - </span>'; } echo "</td>" ;

                                                        echo "<td>" ; if (!empty($row["dow_4"])) { echo '<span class="text-green"> ✓ </span>'; } else { echo '<span class="text-red"> X </span>'; } echo "</td>" ;
                                                        echo "<td>" ; if (!empty($row["time_from_4"])) { echo $time_from_4; } else { echo '<span class="text-red"> - </span>'; } echo "</td>" ;
                                                        echo "<td>" ; if (!empty($row["time_to_4"])) { echo $time_to_4; } else { echo '<span class="text-red"> - </span>'; } echo "</td>" ;

                                                        echo "<td>" ; if (!empty($row["dow_5"])) { echo '<span class="text-green"> ✓ </span>'; } else { echo '<span class="text-red"> X </span>'; } echo "</td>" ;
                                                        echo "<td>" ; if (!empty($row["time_from_5"])) { echo $time_from_5; } else { echo '<span class="text-red"> - </span>'; } echo "</td>" ;
                                                        echo "<td>" ; if (!empty($row["time_to_5"])) { echo $time_to_5; } else { echo '<span class="text-red"> - </span>'; } echo "</td>" ;

                                                        echo "<td>" ; if (!empty($row["dow_6"])) { echo '<span class="text-green"> ✓ </span>'; } else { echo '<span class="text-red"> X </span>'; } echo "</td>" ;
                                                        echo "<td>" ; if (!empty($row["time_from_6"])) { echo $time_from_6; } else { echo '<span class="text-red"> - </span>'; } echo "</td>" ;
                                                        echo "<td>" ; if (!empty($row["time_to_6"])) { echo $time_to_6; } else { echo '<span class="text-red"> - </span>'; } echo "</td>" ;

                                                        echo "<td>" ; if (!empty($row["dow_7"])) { echo '<span class="text-green"> ✓ </span>'; } else { echo '<span class="text-red"> X </span>'; } echo "</td>" ;
                                                        echo "<td>" ; if (!empty($row["time_from_7"])) { echo $time_from_7; } else { echo '<span class="text-red"> - </span>'; } echo "</td>" ;
                                                        echo "<td>" ; if (!empty($row["time_to_7"])) { echo $time_to_7; } else { echo '<span class="text-red"> - </span>'; } echo "</td>" ;
                                                        
                                                        echo "<td data-label='التحكم' style='text-align:center;'>";
                                                            if (array_search($info['GroupID'], ['1']) !== false) { // المدير
                                                                echo"<a href='plan?memberid=315&formerror=form&action=employee&emplyeeid=3265&action=grtstat&grtstat=359&formerror=9853&getid=63524&iteimid=32145&checksum=56821&cookie=30121&do=Edit&userid=" . $row['id'] ."&counksum=93214&action=421' class=''><i class='fas fa-user-edit' style='text-decoration: none;color:#0c0ff3;font-size:15px;'></i>  </a>";
                                                                echo "<a href='plan?do=Delete&userid=" . $row['id'] . "' class='deleteEmployee' title=\" حذف\"  ><i class='far fa-trash-alt' style='text-decoration: none;color: crimson;padding: 5px;'></i> </a>";
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
                    }else{  echo '<div class="container">'. '<div class="nice-message"> لا يوجد حلقات تدريبية للعرض </div>'. '</div>'; } 
            }
                
        }elseif($do == 'Add'){  // ADD Members Page 
            if (array_search($info['GroupID'], ['1']) !== false) { // المدير  ?>
                <div class="container-fluid">
                    <div class="row row-sm">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header"><h3 class="card-title text-center">اضافة حلقة تدريبية جديدة </h3></div>
                                <div class="card-body">
                                    <form action="?do=Insert" method="POST">
                                        <div class="form-body">
                                                <div class="row p-t-20">
                                                    <div class="col-md-6">
                                                        <div class="form-group" style="text-align: right;">
                                                            <label class="control-label"> اسم الحلقة التدريبية</label>
                                                            <input type="text" name="paln_name" required="required" class="form-control form-control-sm" placeholder="اسم الحلقة التدريبية"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group" style="text-align: right;">
                                                            <label class="control-label"> الحزمة التدريبية </label>
                                                            <select name="package_id" class="form-control form-control-sm" data-placeholder="Choose a Category" tabindex="1">
                                                                <option value="-1"> اختر</option><?php
                                                                $stmt = $con->prepare("SELECT * FROM packages");
                                                                $stmt->execute();
                                                                $users = $stmt->fetchAll();
                                                                foreach ($users as $user) {
                                                                    echo "<option value='" . $user['id'] . "'"; 
                                                                    echo ">" . $user['package'] . "</option>";
                                                                } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group has-danger" style="text-align: right;">
                                                            <div class="table-responsive export-table">
                                                                <table id="" class="table table-bordered table-striped" style="width:98%; direction:rtl;">
                                                                    <thead>
                                                                        <tr class="bg-info">
                                                                            <th class="text-center py-2"> اليوم </th>
                                                                            <th class="text-center py-2"> الوقت من </th>
                                                                            <th class="text-center py-2"> الوقت الى </th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th> <input type="checkbox" id="dow_1" name="dow_1" value="السبت"> السبت </th>
                                                                            <th> <input type="time" id="time_from_1" name="time_from_1" disabled  required="required" class="form-control form-control-sm" /></th>
                                                                            <th> <input type="time" id="time_to_1" name="time_to_1" disabled  required="required" class="form-control form-control-sm" /> </th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th> <input type="checkbox" id="dow_2" name="dow_2" value="الأحد"> الأحد </th>
                                                                            <th> <input type="time" id="time_from_2" name="time_from_2" disabled  required="required" class="form-control form-control-sm" /></th>
                                                                            <th> <input type="time" id="time_to_2" name="time_to_2" disabled  required="required" class="form-control form-control-sm" /> </th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th> <input type="checkbox" id="dow_3" name="dow_3" value="الأثنين"> الأثنين </th>
                                                                            <th> <input type="time" id="time_from_3" name="time_from_3" disabled  required="required" class="form-control form-control-sm" /></th>
                                                                            <th> <input type="time" id="time_to_3" name="time_to_3" disabled  required="required" class="form-control form-control-sm" /> </th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th> <input type="checkbox" id="dow_4" name="dow_4" value="الثلاثاء"> الثلاثاء </th>
                                                                            <th> <input type="time" id="time_from_4" name="time_from_4" disabled  required="required" class="form-control form-control-sm" /></th>
                                                                            <th> <input type="time" id="time_to_4" name="time_to_4" disabled  required="required" class="form-control form-control-sm" /> </th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th> <input type="checkbox" id="dow_5" name="dow_5" value="الأربعاء"> الأربعاء </th>
                                                                            <th> <input type="time" id="time_from_5" name="time_from_5" disabled  required="required" class="form-control form-control-sm" /></th>
                                                                            <th> <input type="time" id="time_to_5" name="time_to_5" disabled  required="required" class="form-control form-control-sm" /> </th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th> <input type="checkbox" id="dow_6" name="dow_6" value="الخميس"> الخميس </th>
                                                                            <th> <input type="time" id="time_from_6" name="time_from_6" disabled  required="required" class="form-control form-control-sm" /></th>
                                                                            <th> <input type="time" id="time_to_6" name="time_to_6" disabled  required="required" class="form-control form-control-sm" /> </th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th> <input type="checkbox" id="dow_7" name="dow_7" value="الجمعة"> الجمعة </th>
                                                                            <th> <input type="time" id="time_from_7" name="time_from_7" disabled  required="required" class="form-control form-control-sm" /></th>
                                                                            <th> <input type="time" id="time_to_7" name="time_to_7" disabled  required="required" class="form-control form-control-sm" /> </th>
                                                                        </tr>


                                                                        
                                                                    </thead>
                                                                </table>
                                                                <script>
                                                                    const dow_1 = document.getElementById('dow_1'); const time_from_1 = document.getElementById('time_from_1'); const time_to_1 = document.getElementById('time_to_1');
                                                                    const dow_2 = document.getElementById('dow_2'); const time_from_2 = document.getElementById('time_from_2'); const time_to_2 = document.getElementById('time_to_2');
                                                                    const dow_3 = document.getElementById('dow_3'); const time_from_3 = document.getElementById('time_from_3'); const time_to_3 = document.getElementById('time_to_3');
                                                                    const dow_4 = document.getElementById('dow_4'); const time_from_4 = document.getElementById('time_from_4'); const time_to_4 = document.getElementById('time_to_4');
                                                                    const dow_5 = document.getElementById('dow_5'); const time_from_5 = document.getElementById('time_from_5'); const time_to_5 = document.getElementById('time_to_5');
                                                                    const dow_6 = document.getElementById('dow_6'); const time_from_6 = document.getElementById('time_from_6'); const time_to_6 = document.getElementById('time_to_6');
                                                                    const dow_7 = document.getElementById('dow_7'); const time_from_7 = document.getElementById('time_from_7'); const time_to_7 = document.getElementById('time_to_7');

                                                                    dow_1.addEventListener('change', () => { time_from_1.disabled = !dow_1.checked; time_to_1.disabled = !dow_1.checked; });
                                                                    dow_2.addEventListener('change', () => { time_from_2.disabled = !dow_2.checked; time_to_2.disabled = !dow_2.checked; });
                                                                    dow_3.addEventListener('change', () => { time_from_3.disabled = !dow_3.checked; time_to_3.disabled = !dow_3.checked; });
                                                                    dow_4.addEventListener('change', () => { time_from_4.disabled = !dow_4.checked; time_to_4.disabled = !dow_4.checked; });
                                                                    dow_5.addEventListener('change', () => { time_from_5.disabled = !dow_5.checked; time_to_5.disabled = !dow_5.checked; });
                                                                    dow_6.addEventListener('change', () => { time_from_6.disabled = !dow_6.checked; time_to_6.disabled = !dow_6.checked; });
                                                                    dow_7.addEventListener('change', () => { time_from_7.disabled = !dow_7.checked; time_to_7.disabled = !dow_7.checked; });
                                                                </script>
                                                                <style>
                                                                    .export-table .table th {
                                                                        text-align: right;
                                                                    }
                                                                </style>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <div class="form-actions pull-right">
                                                <input type="submit" class="btn btn-success swalDefaultSuccess"  value="اضافة حلقة" />  
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
                $paln_name  = $_POST['paln_name'];
                $package_id  = $_POST['package_id'];

                $dow_1 = isset($_POST['dow_1']) ? $_POST['dow_1'] : '';
                $dow_2 = isset($_POST['dow_2']) ? $_POST['dow_2'] : '';
                $dow_3 = isset($_POST['dow_3']) ? $_POST['dow_3'] : '';
                $dow_4 = isset($_POST['dow_4']) ? $_POST['dow_4'] : '';
                $dow_5 = isset($_POST['dow_5']) ? $_POST['dow_5'] : '';
                $dow_6 = isset($_POST['dow_6']) ? $_POST['dow_6'] : '';
                $dow_7 = isset($_POST['dow_7']) ? $_POST['dow_7'] : '';

                $time_from_1 = isset($_POST['time_from_1']) ? $_POST['time_from_1'] : Null;
                $time_from_2 = isset($_POST['time_from_2']) ? $_POST['time_from_2'] : Null;
                $time_from_3 = isset($_POST['time_from_3']) ? $_POST['time_from_3'] : Null;
                $time_from_4 = isset($_POST['time_from_4']) ? $_POST['time_from_4'] : Null;
                $time_from_5 = isset($_POST['time_from_5']) ? $_POST['time_from_5'] : Null;
                $time_from_6 = isset($_POST['time_from_6']) ? $_POST['time_from_6'] : Null;
                $time_from_7 = isset($_POST['time_from_7']) ? $_POST['time_from_7'] : Null;

                $time_to_1 = isset($_POST['time_to_1']) ? $_POST['time_to_1'] : NULL;
                $time_to_2 = isset($_POST['time_to_2']) ? $_POST['time_to_2'] : NULL;
                $time_to_3 = isset($_POST['time_to_3']) ? $_POST['time_to_3'] : NULL;
                $time_to_4 = isset($_POST['time_to_4']) ? $_POST['time_to_4'] : NULL;
                $time_to_5 = isset($_POST['time_to_5']) ? $_POST['time_to_5'] : NULL;
                $time_to_6 = isset($_POST['time_to_6']) ? $_POST['time_to_6'] : NULL;
                $time_to_7 = isset($_POST['time_to_7']) ? $_POST['time_to_7'] : NULL;

                
                
                //Validate The Form
                $formErrors = array();
                if (strlen($paln_name) < 4) {
                    $formErrors[] = '<span>  اسم الخطة يجب الا يقل عن اربعة احرف</span> </i>';
                }
                if (strlen($paln_name) > 150) {
                    $formErrors[] = '<span> اسم الخطة يجب الا يزيد عن مائة وخمسون حرف</span> </i>';
                }
                if (empty($paln_name)) {
                    $formErrors[] = '<span> لا يمكنك ترك اسم الخطة فارغا</span> </i>';
                }
                if ($package_id == -1) {
                    $formErrors[] = '<span> لا يمكنك ترك اسم الخطة فارغا</span> </i>';
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
                    $check = checkItem ("paln_name", "plan_package", $paln_name);
                    if ($check == 1){
                        echo "<div class='container'>";
                            echo "<div class= 'alert alert-danger text-center'>-------- الحزمة موجودة مسبقا -------  </div>" ;
                            $theMsg = isset($theMsg) ? $theMsg : '';
                            redirectHome($theMsg, 'back');
                        echo "</div>";
                        
                    }else{
                        // Inser Info to database *** مهم *** 
                        $stmt = $con->prepare("INSERT INTO 
                                                plan_package
                                                    (paln_name, package_id, dow_1, dow_2, dow_3, dow_4, dow_5, dow_6, dow_7, 
                                                    time_from_1, time_from_2, time_from_3, time_from_4, time_from_5, time_from_6, time_from_7, 
                                                    time_to_1, time_to_2, time_to_3, time_to_4, time_to_5, time_to_6, time_to_7)
                                                VALUES
                                                    (:zpaln_name, :zpackage_id, :zdow_1, :zdow_2, :zdow_3, :zdow_4, :zdow_5, :zdow_6, :zdow_7,
                                                    :ztime_from_1, :ztime_from_2, :ztime_from_3, :ztime_from_4, :ztime_from_5, :ztime_from_6, :ztime_from_7, 
                                                    :ztime_to_1, :ztime_to_2, :ztime_to_3, :ztime_to_4, :ztime_to_5, :ztime_to_6, :ztime_to_7 )"); 
                        $stmt->execute(array(
                            'zpaln_name'  => $paln_name,
                            'zpackage_id'  => $package_id,
                            'zdow_1'  => $dow_1,
                            'zdow_2'  => $dow_2,
                            'zdow_3'  => $dow_3,
                            'zdow_4'  => $dow_4,
                            'zdow_5'  => $dow_5,
                            'zdow_6'  => $dow_6,
                            'zdow_7'  => $dow_7,

                            'ztime_from_1'  => $time_from_1,
                            'ztime_from_2'  => $time_from_2,
                            'ztime_from_3'  => $time_from_3,
                            'ztime_from_4'  => $time_from_4,
                            'ztime_from_5'  => $time_from_5,
                            'ztime_from_6'  => $time_from_6,
                            'ztime_from_7'  => $time_from_7,

                            'ztime_to_1'  => $time_to_1,
                            'ztime_to_2'  => $time_to_2,
                            'ztime_to_3'  => $time_to_3,
                            'ztime_to_4'  => $time_to_4,
                            'ztime_to_5'  => $time_to_5,
                            'ztime_to_6'  => $time_to_6,
                            'ztime_to_7'  => $time_to_7

                        ));
                        //Echo Success Measage
                        if ($stmt) { // if it's true
                            sleep(1);?>
                            <script src="../layout/dist/js/sweetalert2.min.js"></script>
                            <script>
                                Swal.fire({
                                    title: 'تم إضافة الخطة بنجاح',
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
            $stmt = $con->prepare("SELECT * FROM plan_package WHERE id = ?  LIMIT 1");
            $stmt->execute(array($userid));
            $row = $stmt->fetch();
            $count = $stmt->rowCount();
            if ($stmt->rowCount() > 0 ){ ?>
                <div class="container-fluid">
                    <div class="row row-sm">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header"><h3 class="card-title text-center">تعديل بيانات حلقة تدريبية</h3></div>
                                <div class="card-body">
                                    <form action="?do=Update" method="POST">
                                        <input type="hidden" name="userid" value="<?php echo $userid ?>" /><?php
                                            if (array_search($info['GroupID'], ['1']) !== false) { // مدير?>	
                                                <div class="row p-t-20">
                                                    <div class="col-md-12">
                                                        <div class="form-group" style="text-align: right;">
                                                            <label class="control-label"> اسم الحلقة التدريبية</label>
                                                            <input type="text" name="paln_name" required="required" class="form-control form-control-sm" value="<?php echo $row['paln_name']?>" autocomplete="off"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group has-danger" style="text-align: right;">
                                                            <div class="table-responsive export-table">
                                                                <table id="" class="table table-bordered table-striped" style="width:98%; direction:rtl;">
                                                                    <thead>
                                                                        <tr class="bg-info">
                                                                            <th class="text-center py-2"> اليوم </th>
                                                                            <th class="text-center py-2"> الوقت من </th>
                                                                            <th class="text-center py-2"> الوقت الى </th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th> <input type="checkbox"  name="dow_1" value="السبت" <?php if ($row['dow_1'] == 'السبت') {echo 'checked';}?> > السبت </th>
                                                                            <th> <input type="time"  name="time_from_1"  class="form-control form-control-sm" value="<?php echo $row['time_from_1']?>"/></th>
                                                                            <th> <input type="time"  name="time_to_1"  class="form-control form-control-sm" value="<?php echo $row['time_to_1']?>"/> </th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th> <input type="checkbox"  name="dow_2" value="الأحد" <?php if ($row['dow_2'] == 'الأحد') {echo 'checked';}?>> الأحد </th>
                                                                            <th> <input type="time"  name="time_from_2"  class="form-control form-control-sm" value="<?php echo $row['time_from_2']?>"/></th>
                                                                            <th> <input type="time"  name="time_to_2"  class="form-control form-control-sm" value="<?php echo $row['time_to_2']?>"/> </th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th> <input type="checkbox"  name="dow_3" value="الأثنين" <?php if ($row['dow_3'] == 'الأثنين') {echo 'checked';}?>> الأثنين </th>
                                                                            <th> <input type="time"  name="time_from_3"  class="form-control form-control-sm" value="<?php echo $row['time_from_3']?>"/></th>
                                                                            <th> <input type="time"  name="time_to_3"  class="form-control form-control-sm" value="<?php echo $row['time_to_3']?>"/> </th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th> <input type="checkbox"  name="dow_4" value="الثلاثاء" <?php if ($row['dow_4'] == 'الثلاثاء') {echo 'checked';}?>> الثلاثاء </th>
                                                                            <th> <input type="time"  name="time_from_4"  class="form-control form-control-sm" value="<?php echo $row['time_from_4']?>"/></th>
                                                                            <th> <input type="time"  name="time_to_4"  class="form-control form-control-sm" value="<?php echo $row['time_to_4']?>"/> </th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th> <input type="checkbox"  name="dow_5" value="الأربعاء" <?php if ($row['dow_5'] == 'الأربعاء') {echo 'checked';}?>> الأربعاء </th>
                                                                            <th> <input type="time"  name="time_from_5"  class="form-control form-control-sm" value="<?php echo $row['time_from_5']?>"/></th>
                                                                            <th> <input type="time"  name="time_to_5"  class="form-control form-control-sm" value="<?php echo $row['time_to_5']?>"/> </th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th> <input type="checkbox"  name="dow_6" value="الخميس" <?php if ($row['dow_6'] == 'الخميس') {echo 'checked';}?>> الخميس </th>
                                                                            <th> <input type="time"  name="time_from_6"  class="form-control form-control-sm" value="<?php echo $row['time_from_6']?>"/></th>
                                                                            <th> <input type="time"  name="time_to_6"  class="form-control form-control-sm" value="<?php echo $row['time_to_6']?>"/> </th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th> <input type="checkbox"  name="dow_7" value="الجمعة" <?php if ($row['dow_7'] == 'الجمعة') {echo 'checked';}?>> الجمعة </th>
                                                                            <th> <input type="time"  name="time_from_7"  class="form-control form-control-sm" value="<?php echo $row['time_from_7']?>"/></th>
                                                                            <th> <input type="time"  name="time_to_7"  class="form-control form-control-sm" value="<?php echo $row['time_to_7']?>"/> </th>
                                                                        </tr>
                                                                    </thead>
                                                                </table>
                                                                <style>
                                                                    .export-table .table th {
                                                                        text-align: right;
                                                                    }
                                                                </style>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><?php   
                                            }   ?>
                                        <hr>
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

                $paln_name  = $_POST['paln_name'];

                $dow_1 = isset($_POST['dow_1']) ? $_POST['dow_1'] : '';
                $dow_2 = isset($_POST['dow_2']) ? $_POST['dow_2'] : '';
                $dow_3 = isset($_POST['dow_3']) ? $_POST['dow_3'] : '';
                $dow_4 = isset($_POST['dow_4']) ? $_POST['dow_4'] : '';
                $dow_5 = isset($_POST['dow_5']) ? $_POST['dow_5'] : '';
                $dow_6 = isset($_POST['dow_6']) ? $_POST['dow_6'] : '';
                $dow_7 = isset($_POST['dow_7']) ? $_POST['dow_7'] : '';

                $time_from_1 = isset($_POST['time_from_1']) ? $_POST['time_from_1'] : Null;
                $time_from_2 = isset($_POST['time_from_2']) ? $_POST['time_from_2'] : Null;
                $time_from_3 = isset($_POST['time_from_3']) ? $_POST['time_from_3'] : Null;
                $time_from_4 = isset($_POST['time_from_4']) ? $_POST['time_from_4'] : Null;
                $time_from_5 = isset($_POST['time_from_5']) ? $_POST['time_from_5'] : Null;
                $time_from_6 = isset($_POST['time_from_6']) ? $_POST['time_from_6'] : Null;
                $time_from_7 = isset($_POST['time_from_7']) ? $_POST['time_from_7'] : Null;

                $time_to_1 = isset($_POST['time_to_1']) ? $_POST['time_to_1'] : NULL;
                $time_to_2 = isset($_POST['time_to_2']) ? $_POST['time_to_2'] : NULL;
                $time_to_3 = isset($_POST['time_to_3']) ? $_POST['time_to_3'] : NULL;
                $time_to_4 = isset($_POST['time_to_4']) ? $_POST['time_to_4'] : NULL;
                $time_to_5 = isset($_POST['time_to_5']) ? $_POST['time_to_5'] : NULL;
                $time_to_6 = isset($_POST['time_to_6']) ? $_POST['time_to_6'] : NULL;
                $time_to_7 = isset($_POST['time_to_7']) ? $_POST['time_to_7'] : NULL;
                
                //Validate The Form
                $formErrors = array();
                if (strlen($paln_name) < 4) {
                    $formErrors[] = '<span>  اسم الحلقة يجب الا يقل عن اربعة احرف</span> </i>';
                }
                if (strlen($paln_name) > 150) {
                    $formErrors[] = '<span> اسم الحلقة يجب الا يزيد عن مائة وخمسون حرف</span> </i>';
                }
                if (empty($paln_name)) {
                    $formErrors[] = '<span> لا يمكنك ترك اسم الحلقة فارغا</span> </i>';
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
                    $stmt2 = $con->prepare("SELECT * FROM plan_package WHERE paln_name = ?  AND id != ?");
                    $stmt2->execute(array($paln_name, $id));
                    $count = $stmt2->rowCount();
                    if($count == 1){
                        echo "<div class='container'>";
                            echo "<div class= 'alert alert-danger text-center'>-------- الجزمة موجودة  مسبقا -------  </div>" ;
                            $theMsg = isset($theMsg) ? $theMsg : '';
                            redirectHome($theMsg, 'back');
                        echo "</div>";
                    }else{   //  the database with this Info

                        $stmt = $con->prepare("UPDATE plan_package SET paln_name = :paln_name, 
                                                                        dow_1 = :dow_1, dow_2 = :dow_2, dow_3 = :dow_3, dow_4 = :dow_4, dow_5 = :dow_5, dow_6 = :dow_6, dow_7 = :dow_7, 
                                                                        time_from_1 = :time_from_1, time_from_2 = :time_from_2, time_from_3 = :time_from_3, time_from_4 = :time_from_4, time_from_5 = :time_from_5, time_from_6 = :time_from_6, time_from_7 = :time_from_7, 
                                                                        time_to_1 = :time_to_1, time_to_2 = :time_to_2, time_to_3 = :time_to_3, time_to_4 = :time_to_4, time_to_5 = :time_to_5, time_to_6 = :time_to_6, time_to_7 = :time_to_7 
                                                                        WHERE id = :id");

                        $stmt->bindParam(":paln_name", $paln_name);
                        $stmt->bindParam(":dow_1", $dow_1);
                        $stmt->bindParam(":dow_2", $dow_2);
                        $stmt->bindParam(":dow_3", $dow_3);
                        $stmt->bindParam(":dow_4", $dow_4);
                        $stmt->bindParam(":dow_5", $dow_5);
                        $stmt->bindParam(":dow_6", $dow_6);
                        $stmt->bindParam(":dow_7", $dow_7);

                        $stmt->bindParam(":time_from_1", $time_from_1);
                        $stmt->bindParam(":time_from_2", $time_from_2);
                        $stmt->bindParam(":time_from_3", $time_from_3);
                        $stmt->bindParam(":time_from_4", $time_from_4);
                        $stmt->bindParam(":time_from_5", $time_from_5);
                        $stmt->bindParam(":time_from_6", $time_from_6);
                        $stmt->bindParam(":time_from_7", $time_from_7);

                        $stmt->bindParam(":time_to_1", $time_to_1);
                        $stmt->bindParam(":time_to_2", $time_to_2);
                        $stmt->bindParam(":time_to_3", $time_to_3);
                        $stmt->bindParam(":time_to_4", $time_to_4);
                        $stmt->bindParam(":time_to_5", $time_to_5);
                        $stmt->bindParam(":time_to_6", $time_to_6);
                        $stmt->bindParam(":time_to_7", $time_to_7);

                        $stmt->bindParam(":id", $id);


                        

                        if (empty($_POST['time_from_1'])) { $time_from_1 = null; } else { $time_from_1 = $_POST['time_from_1']; }
                        if (empty($_POST['time_from_2'])) { $time_from_2 = null; } else { $time_from_2 = $_POST['time_from_2']; }
                        if (empty($_POST['time_from_3'])) { $time_from_3 = null; } else { $time_from_3 = $_POST['time_from_3']; }
                        if (empty($_POST['time_from_4'])) { $time_from_4 = null; } else { $time_from_4 = $_POST['time_from_4']; }
                        if (empty($_POST['time_from_5'])) { $time_from_5 = null; } else { $time_from_5 = $_POST['time_from_5']; }
                        if (empty($_POST['time_from_6'])) { $time_from_6 = null; } else { $time_from_6 = $_POST['time_from_6']; }
                        if (empty($_POST['time_from_7'])) { $time_from_7 = null; } else { $time_from_7 = $_POST['time_from_7']; }

                        if (empty($_POST['time_to_1'])) { $time_to_1 = null; } else { $time_to_1 = $_POST['time_to_1']; }
                        if (empty($_POST['time_to_2'])) { $time_to_2 = null; } else { $time_to_2 = $_POST['time_to_2']; }
                        if (empty($_POST['time_to_3'])) { $time_to_3 = null; } else { $time_to_3 = $_POST['time_to_3']; }
                        if (empty($_POST['time_to_4'])) { $time_to_4 = null; } else { $time_to_4 = $_POST['time_to_4']; }
                        if (empty($_POST['time_to_5'])) { $time_to_5 = null; } else { $time_to_5 = $_POST['time_to_5']; }
                        if (empty($_POST['time_to_6'])) { $time_to_6 = null; } else { $time_to_6 = $_POST['time_to_6']; }
                        if (empty($_POST['time_to_7'])) { $time_to_7 = null; } else { $time_to_7 = $_POST['time_to_7']; }

                        $stmt->execute();
                        //Echo Success Measage
                        if ($stmt) { // if it's true
                            sleep(1);?>
                            <script src="../layout/dist/js/sweetalert2.min.js"></script>
                            <script>
                                Swal.fire({
                                    title: 'تم تحديث بيانات الحلقة بنجاح',
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
                echo "<h1 class='text-center'> حذف حلقة</h1>";
                echo "<div class ='container'>";
                    $userid = isset($_GET['userid'])&& is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
                    // Check if the Userid is numeric and  Exist in Database	
                    $check = checkItem ('id', 'plan_package', $userid);
                    if ($check > 0){ 
                        $stmt = $con->prepare("DELETE FROM plan_package WHERE id = :zuser");
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





<?php

}else{
	header ('location: ../index');
	exit();
}
include   $tpl . 'footer.php';
include   $tpl . 'footer-scripts.php';
ob_end_flush();
?>