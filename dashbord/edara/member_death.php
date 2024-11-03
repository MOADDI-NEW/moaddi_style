<?php
ob_start();
session_start();
$noNavbar = '';
$main_header_edara = '';
$main_sidebar_edara = '';

if (isset($_SESSION['Edara30'])){
    $pageTitle = 'صفحة أعضاء وفيات ';  // this function to load page title
    include 'init.php';   //  Dirctory page


	$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
	$getUser->execute(array($_SESSION['Edara30']));
	$info = $getUser->fetch();
    
    include 'breadcrumb.php';
	if (array_search($info['role'], ['30']) !== false) { //   ادارة الجيم 
        
        $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';  // shor if 
        if($do == 'Manage'){  //==== Manage Page == 
            if (array_search($info['GroupID'], ['1','3']) !== false) {	   // مدير + مساعد
                $stmt = $con->prepare("SELECT * FROM users WHERE role = 44 AND RegStatus = 2 ORDER BY UserID DESC");
                $stmt->execute();
                $rows = $stmt->fetchAll();
                if (! empty($rows)){ ?>
                    <div class="container-fluid">
                        <div class="row row-sm">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header"><h3 class="card-title text-center">قوائم أعضاء العائلة - وفيات</h3></div>
                                    <div class="card-body">
                                        <div class="table-responsive export-table">
                                            <table id="example" class="table table-bordered table-striped" style= "width:98%; direction:rtl;">
                                            <thead>
                                                <tr>
                                                    <th> #</th>
                                                    <th> العضو</th>
                                                    <th> تاريخ الميلاد</th>
                                                    <th>  الوظيفة </th>
                                                    <th>  المدينة </th>
                                                    <th>  الصورة </th>
                                                    <th>  تاريخ الوفاة </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 1;
                                                    foreach($rows as $row){
                                                    echo "<tr>";
                                                        echo "<td>" . $i++ . "</td>";
                                                        echo "<td>" . $row['FullName'] . "</td>";
                                                        echo "<td>" . $row['birthdate'] . "</td>";
                                                        echo "<td>" . $row['job_title'] . "</td>";
                                                        echo "<td>" . $row['al_city'] . "</td>";
                                                        echo "<td><img src='../admin/nsharat_uploads/user_avatar/" . $row['user_avatar'] . "' alt='' style='width:75px;' /></td>";
                                                        echo "<td>" . $row['deathdate'] . "</td>";
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
                    }else{ echo '<div class="container">'. '<div class="nice-message"> لا يوجد مستخدمين للعرض</div>';
                        echo '<a href="member_client?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i> اضافة عضو جديد </a>';
                    echo '</div>';  } 
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