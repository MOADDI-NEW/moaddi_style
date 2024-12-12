<?php 
// Project Name  ::  Directorate of Education in Kafr El-Sheikh
// Created In    ::  01 - 01 - 2020                                      
// Developed by ::  Alaa Amer  - 01014714795  - Baltim - Kafr El-Sheikh 
ob_start();
session_start();
$noNavbar = '';
$main_header_school = '';
$main_sidebar_school = '';
$pageTitle = 'My companies';  // this function to load page title
include 'init.php';   //  Dirctory page

if (isset($_SESSION['user'])){
$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
$getUser->execute(array($sessionUseer));
$info = $getUser->fetch(); ?>

		<!-- breadcrumb -->
		<?php include 'breadcrumb.php';

$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';  // shor if 
	// Statr Manage Page
	if($do == 'Manage'){  //==== Manage Page == 
      $stmt = $con->prepare("SELECT * FROM my_companies ,users
      WHERE  users.UserID = my_companies.Member_ID
         AND Username = ? ");
         $stmt->execute(array($sessionUseer));
         $rows = $stmt->fetchAll();

      if (! empty($rows)){ ?>
         <div class="container-fluid">
            <div class="row row-sm">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><h3 class="card-title text-center">  My companies  </h3></div>
                           <a href="my_companies?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i>   Add New Company  </a>
                        <div class="card-body">
                              <div class="table-responsive export-table">
                                 <table id="example" class="table table-bordered table-striped" style= "width:98%; direction:rtl;">
                                 <thead>
                                    <tr>
                                          <th> #</th>
                                          <th> Company Name </th>
                                          <th> company activity  </th>
                                          <th> Country </th>
                                          <th>  phone</th>
                                          <th>  Image </th>
                                          <th>  Approve </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                          <?php
                                          $i = 1;
                                          foreach($rows as $row){
                                          echo "<tr>";
                                             echo "<td>" . $i++ . "</td>";
                                             echo "<td>" . $row['Company_name'] . "</td>";
                                             echo "<td>" . $row['company_activity'] . "</td>";
                                             echo "<td>" . $row['Country'] . "</td>";
                                             echo "<td>" . $row['phone'] . "</td>";
                                             echo "<td>";
                                             $images = explode(',', $row['products_img']); // Split the image string into an array
                                             foreach ($images as $image) {
                                                echo '<img src="../admin/nsharat_uploads/products_img/' . trim($image) . '" alt="Product Image" class="img-rounded img-thumbnail" style="width:50px; margin-right:2px;">';
                                             }
                                             echo "</td>";
                                             echo "<td>";
                                             if ($row['Approve'] == 0) {
                                                echo'<span class="text-danger"> Prossing...  </span>';
                                             }else{
                                                echo'<span class="text-success"> Approved  </span>';
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
         }else{   echo '<div class="container">'. '<div class="nice-message"> There NO companies TO view  </div>';
                  echo '<a href="my_companies?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i>  Add New Company  </a>';
                  echo '</div>'; 
      } 
         

   }elseif($do == 'Add'){ ?>
      <div class="container-fluid">
         <div class="row">
            <div class="col-lg-12">
               <div class="card card-outline-primary" style="background: #fff  none repeat scroll 0 0;">
                  <div class="card-header">
                     <h4 class="m-b-0 text-dark" style="text-align:center;">  Add New Company  </h4>
                  </div>
                  <div class="card-body">
                     <form action="?do=Insert" method="POST" enctype="multipart/form-data">
                        <div class="row p-t-20">
                           <div class="col-md-6">
                              <div class="form-group" style="text-align: right;">
                                    <label class="control-label"> Company name  </label>
                                    <input type="text" name="Company_name"  class="form-control form-control-sm"    placeholder="Company name" required="required" style="text-align:left;"/>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group" style="text-align: right;">
                                    <label class="control-label">Company activity</label>
                                    <input type="text" name="company_activity"  class="form-control form-control-sm"  required="required"  placeholder=" company activity" style="text-align:left;"/>
                              </div>
                           </div>
                        </div>
                        <div class="row p-t-20">
                           <div class="col-md-6">
                              <div class="form-group" style="text-align: right;">
                                    <label class="control-label">Country</label>
                                    <input type="text" name="Country"  class="form-control form-control-sm"  required="required"  placeholder="Country" style="text-align:left;"/>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group" style="text-align: right;">
                                    <label class="control-label">City</label>
                                    <input type="text" name="al_city"  class="form-control form-control-sm"  required="required"  placeholder="City" style="text-align:left;"/>
                              </div>
                           </div>
                        </div>
                        <div class="row p-t-20">
                           <div class="col-md-6">
                              <div class="form-group" style="text-align: right;">
                                    <label class="control-label">Email</label>
                                    <input type="text" name="Email"  class="form-control form-control-sm"  required="required"  placeholder="Email" style="text-align:left;"/>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group" style="text-align: right;">
                                    <label class="control-label">Phone</label>
                                    <input type="text" name="phone"  class="form-control form-control-sm"  required="required"  placeholder="Phone" style="text-align:left;"/>
                              </div>
                           </div>
                        </div>
                        <div class="row p-t-20">
                           <div class="col-md-6">
                              <div class="form-group" style="text-align: right;">
                                    <label class="control-label">Website</label>
                                    <input type="text" name="website"  class="form-control form-control-sm"  required="required"  placeholder="Website" style="text-align:left;"/>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group" style="text-align: right;">
                                    <label class="control-label">Communication officer Name</label>
                                    <input type="text" name="Communication_officer_name"  class="form-control form-control-sm"  required="required"  placeholder="Communication officer Name" style="text-align:left;"/>
                              </div>
                           </div>
                        </div>
                        <div class="row p-t-20">
                           <div class="col-md-6">
                              <div class="form-group" style="text-align: right;">
                                    <label class="control-label">Communication officer Phone</label>
                                    <input type="text" name="communication_phone"  class="form-control form-control-sm"  required="required"  placeholder="Communication officer Phone" style="text-align:left;"/>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group" style="text-align: right;">
                                    <label class="control-label">Communication officer Email</label>
                                    <input type="text" name="Communication_officer_Email"  class="form-control form-control-sm"  required="required"  placeholder="Communication officer Email" style="text-align:left;"/>
                              </div>
                           </div>
                        </div>
                        <div class="row p-t-20">
                              <div class="col-md-12">
                              <div class="form-group has-danger" style="text-align: right;">
                                    <label class="control-label"> some simple products  Images </label>
                                    <input type="file" name="products_img[]"  class="form-control form-control-sm"  required="required"  multiple/>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group" style="text-align: right;">
                                       <!-- school to send to -->
                                       <?php //مدخل البيان
                                                if (isset($_SESSION['user'])){
                                                $getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
                                                $getUser->execute(array($_SESSION['user']));
                                                $info = $getUser->fetch();
                                                if (array_search($info['role'], ['45']) !== false) { // شرق?>
                                                <input type="hidden" name="Member_ID"   value="<?php echo $info['UserID'];?>"/>
                                                <?php
                                                }
                                          }
                                       ?>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group" style="text-align: right;">
                                    <label class="control-label"> </label>
                                    <input type="hidden" name="Cat_ID" class="form-control"  value="11" />
                                    <input type="hidden" name="Approve" class="form-control"  value="0" />
                              </div>
                           </div>
                        </div>
                        <div class="form-actions pull-right">
                              <i class="fa fa-check"></i> <input type="submit" class="btn btn-success"  value="Save" />  
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div><?php


}elseif($do == 'Insert'){

   if($_SERVER['REQUEST_METHOD'] == 'POST'){
      // Get Variabls from the Form
      $Company_name  = $_POST['Company_name'];
      $company_activity  = $_POST['company_activity'];
      $Country  = $_POST['Country'];
      $al_city  = $_POST['al_city'];
      $Email  = $_POST['Email'];
      $phone  = $_POST['phone'];
      $website  = $_POST['website'];
      $Communication_officer_name  = $_POST['Communication_officer_name'];
      $communication_phone  = $_POST['communication_phone'];
      $Communication_officer_Email  = $_POST['Communication_officer_Email'];
      
      $products_img = array();
      $products_img_tmp = array();
      $products_img_size = array();
      $products_img_type = array();
      $products_img_ext = array();
      $products_img_allowed_ext = array('jpg', 'jpeg', 'png', 'gif');
      if(isset($_FILES['products_img'])) {
          $products_img = $_FILES['products_img']['name'];
          $products_img_tmp = $_FILES['products_img']['tmp_name'];
          $products_img_size = $_FILES['products_img']['size'];
          $products_img_type = $_FILES['products_img']['type'];
          foreach($products_img as $key => $value) {
              $products_img_ext[$key] = strtolower(pathinfo($value, PATHINFO_EXTENSION));
          }
      }
      $Approve   = $_POST['Approve'];

      $Member_ID   = $_POST['Member_ID'];
      $Cat_ID   	  = $_POST['Cat_ID'];
     
      //Validate The Form
      $formErrors = array();
      if (strlen($Company_name) < 4) {
          $formErrors[] = '<span>  اسم البراند يجب الا يقل عن اربعة احرف</span> </i>';
      }
      if (strlen($Company_name) > 200) {
          $formErrors[] = '<span> اسم البراند يجب الا يزيد عن مائة وخمسون حرف</span> </i>';
      }
      if (empty($Company_name)) {
          $formErrors[] = '<span> لا يمكنك ترك اسم البراند فارغا</span> </i>';
      }
      
      if (! empty($products_img)) {
          foreach($products_img as $key => $value) {
              if (! in_array($products_img_ext[$key], $products_img_allowed_ext)) {
                  $formErrors[] = '<span> امتداد الصورة غير مسموح به</span> <i class="fa fa-bomb" style="font-size:30px"></i>';
              }
              if ($products_img_size[$key] > 10621440) {
                  $formErrors[] = '<span> حجم الصورة يجب أن يكون أقل من 10.5 ميجا بايت</span> <i class="fa fa-bomb" style="font-size:30px"></i>';
              }
          }
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
      if(empty($formErrors)){
          

          if (! empty($products_img)) {
              foreach($products_img as $key => $value) {
                  $products_img_name = $phone . '_' . rand(0, 100) . '_' . $value;
                  move_uploaded_file($products_img_tmp[$key], '../admin/nsharat_uploads/products_img/'. $products_img_name);
                  $products_img_names[] = $products_img_name;
              }
              $products_img_names = implode(',', $products_img_names);
          }
        

          // check if user Exist in database
          $check = checkItem ("Company_name", " my_companies", $Company_name);

          if ($check == 1){
              echo "<div class='container'>";
                  echo "<div class= 'alert alert-danger text-center'>-------- القسم موجود مسبقا -------  </div>" ;
                  $theMsg = isset($theMsg) ? $theMsg : '';
                  redirectHome($theMsg, 'back');
              echo "</div>";
              
          }else{
              // Inser Info to database *** مهم *** 
              $stmt = $con->prepare("INSERT INTO  my_companies ( 
                                          Company_name,
                                          company_activity,
                                          Country,
                                          al_city,
                                          Email,
                                          phone,
                                          website,
                                          Communication_officer_name,
                                          communication_phone,
                                          Communication_officer_Email,
                                          products_img,
                                          Approve,
                                          Cat_ID, 
                                          Member_ID
                                          )
                                      VALUES
                                          (
                                          :zCompany_name,
                                          :zcompany_activity,
                                          :zCountry,
                                          :zal_city,
                                          :zEmail,
                                          :zphone,
                                          :zwebsite,
                                          :zCommunication_officer_name,
                                          :zcommunication_phone,
                                          :zCommunication_officer_Email,
                                          :zproducts_img,
                                          :zApprove, 
                                          :zCat_ID, 
                                          :zMember_ID
                                          )"); 
              $stmt->bindParam(':zCompany_name', $Company_name);
              $stmt->bindParam(':zcompany_activity', $company_activity);
              $stmt->bindParam(':zCountry', $Country);
              $stmt->bindParam(':zal_city', $al_city);
              $stmt->bindParam(':zEmail', $Email);
              $stmt->bindParam(':zphone', $phone);
              $stmt->bindParam(':zwebsite', $website);
              $stmt->bindParam(':zCommunication_officer_name', $Communication_officer_name);
              $stmt->bindParam(':zcommunication_phone', $communication_phone);
              $stmt->bindParam(':zCommunication_officer_Email', $Communication_officer_Email);
              $stmt->bindParam(':zproducts_img', $products_img_names);
              $stmt->bindParam(':zApprove', $Approve);
              $stmt->bindParam(':zCat_ID', $Cat_ID);
              $stmt->bindParam(':zMember_ID', $Member_ID);
              
              
              $stmt->execute();
              //Echo Success Measage
              if ($stmt) { // if it's true
                  sleep(1);?>
                  <script src="../layout/dist/js/sweetalert2.min.js"></script>
                  <script>
                      Swal.fire({
                          title: 'Company added Successfuly',
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

	
	}
	
}else{
	header ('location: index');
	exit();
}
include   $tpl . 'footer.php';
include   $tpl . 'footer-scripts.php';
ob_end_flush();
?>