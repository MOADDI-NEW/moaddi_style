<?php
ob_start();
session_start();
$noNavbar = '';
$main_header_edara = '';
$main_sidebar_edara = '';

if (isset($_SESSION['Edara30'])){
    $pageTitle = 'مشتركين قيد الانتظار';  // this function to load page title
    include 'init.php';   //  Dirctory page

    include 'member_panding_conc.php';


	$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
	$getUser->execute(array($_SESSION['Edara30']));
	$info = $getUser->fetch();
    
    //include 'breadcrumb.php';
	
        
        $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';  // shor if 
        if($do == 'Manage'){  //==== Manage Page ==  

                if(isset($_POST['but_update'])){
                    if(isset($_POST['update'])){
                        foreach($_POST['update'] as $updateid){
                                $RegStatus = $_POST['RegStatus_'.$updateid];
                                
                                if($RegStatus !=''  ){
                                    $updateUser = "UPDATE users SET RegStatus='".$RegStatus."'
                                    WHERE UserID=".$updateid;
                                    $query_run = mysqli_query($conn,$updateUser);
                                    if($query_run) {
                                            header("Location: index");
                                        } else {
                                            header("Location: member_panding");
                                        }
                                }
                                
                        }
                    }
                }  
                
                if(isset($_POST['stud_delete_multiple_btn'])) {
                    $all_id = $_POST['stud_delete_id'];
                    $extract_id = implode(',' , $all_id);
                    // echo $extract_id;

                    $query = "DELETE FROM users WHERE UserID IN($extract_id) ";
                    $query_run = mysqli_query($conn, $query);

                    if($query_run) {
                        header("Location: index");
                    } else {
                        header("Location: member_panding");
                    }
                }
                ?>
                
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header"><h3 class="card-title text-center">قوائم المشتركين قيد الانتظار</h3></div>
                            <form method='post' action=''>
                                <div class="card-body">
                                    <div class="table-responsive export-table">
                                        <table  class="table table-bordered table-striped" style= "width:98%; direction:rtl;">
                                            <thead>
                                                <tr style='background: whitesmoke;'>
                                                    <th><input type='submit' class="btn btn-sm btn-success swalDefaultSuccess" value='قبول الطلاب' name='but_update'></th>
                                                    <th><button type="submit" name="stud_delete_multiple_btn" class="btn btn-sm btn-danger swalDefaultSuccess">حذف</button></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                                <tr style='background: whitesmoke;'>
                                                    <th><input type='checkbox' id='checkAll' > تحديد</th>
                                                    <th></th>
                                                    <th>المستخدم</th>
                                                    <th>الاسم</th>
                                                    <th>الهاتف</th>
                                                </tr>
                                            </thead><?php 
                                                    $query = "SELECT * FROM users where RegStatus = 0";
                                                    $result = mysqli_query($conn, $query);
                                                    
                                                    while($row = mysqli_fetch_array($result)) {
                                                        $UserID = $row['UserID'];
                                                        $Username = $row['Username'];
                                                        $FullName = $row['FullName'];
                                                        $phone = $row['phone'];
                                                        $RegStatus = $row['RegStatus'];
                                            
                                            
                                                    // $query = "SELECT * FROM users where RegStatus = 0";
                                                    // $result = mysqli_query($conn,$query);

                                                    // while($row = mysqli_fetch_array($result) ){
                                                    //     $UserID = $row['UserID'];
                                                    //     $Username = $row['Username'];
                                                    //     $plan = $row['plan'];
                                                    //     $FullName = $row['FullName'];
                                                    //     $stage = $row['stage'];

                                                    //     $RegStatus = $row['RegStatus']; 
                                                        
                                                        
                                                        ?>
                                        
                                            <tbody>             
                                                <tr>
                                                    <!-- Checkbox -->
                                                    <td><input type='checkbox' name='update[]' value='<?= $UserID ?>' ></td>
                                                    <td><input type="checkbox" name="stud_delete_id[]" value="<?= $row['UserID']; ?>"></td>
                                                    <td><?= $Username ?></td>
                                                    <td><?= $FullName ?></td>
                                                    <td><?= $phone ?></td>
                                                    <input type='hidden' name='RegStatus_<?= $UserID ?>' value='1' >
                                                </tr>
                                            </tbody>  <?php
                                        }
                                    ?>
                                </table>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- Script -->
        <script src='jquery-3.3.1.min.js' type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function(){

                // Check/Uncheck ALl
                $('#checkAll').change(function(){
                    if($(this).is(':checked')){
                        $('input[name="update[]"]').prop('checked',true);
                    }else{
                        $('input[name="update[]"]').each(function(){
                            $(this).prop('checked',false);
                        }); 
                    }
                });

                // Checkbox click
                $('input[name="update[]"]').click(function(){
                    var total_checkboxes = $('input[name="update[]"]').length;
                    var total_checkboxes_checked = $('input[name="update[]"]:checked').length;

                    if(total_checkboxes_checked == total_checkboxes){
                        $('#checkAll').prop('checked',true);
                    }else{
                        $('#checkAll').prop('checked',false);
                    }
                });
            });
        </script><?php
                
    }

?>
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