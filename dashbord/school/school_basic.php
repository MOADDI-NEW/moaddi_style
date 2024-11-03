<?php 
// Project Name  ::  Directorate of Education in Kafr El-Sheikh
// Created In    ::  01 - 01 - 2020                                      
// Developed by ::  Alaa Amer  - 01014714795  - Baltim - Kafr El-Sheikh 
ob_start();
session_start();
$noNavbar = '';
$main_header_school = '';
$main_sidebar_school = '';
$pageTitle = ' البيانات الاساسية ';  // this function to load page title
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
	$query = '';
	if (isset($_GET['page']) && $_GET['page'] == 'Panding'){
		$query = 'AND RegStatus = 0';
	}
		if (! empty($info)){ ?>
			<div class="container-fluid">
				<div class="row row-sm row-deck">
					<div class="col-md-12">
						<div class="card card-primary card-outline">
							<div class="content mb-5">
									<div class="homey">
										<div class="firstinfo">
										<?php echo'<img src="../admin/nsharat_uploads/user_avatar/' . $info['user_avatar'] . '" alt="'.$info['FullName'].'" style="width:100px">';?>
											<div class="profileinfo">
												<h4><?php echo $info['FullName']?></h4>
												<h5><?php echo $info['job_title']?></h5>
												<p class="bio"> 
													<span class="text-bold"> تاريخ الميلاد </span> : 
												<time datetime="<?php echo $info['birthdate']?>"><?php echo $info['birthdate']?></time>
											</p>
											</div>
										</div>
									</div>
									<div class="badgeshomey d-flex justify-content-center"><?php echo $info['al_city']?></div>
							</div>
							<a <?php echo "href='school_basic?formerror=9853&getid=6324&iteimid=3245&checksum=5681&cookie=3021&do=Edit&userid=" . $info['UserID'] ."&counksum=93214&action=421'";?> class="btn btn-primary btn-block"><b> تعديل البيانات </b></a>
						</div>
					</div>
				</div>
			</div><br><br><br><br><br><br><br><br><br><?php 
		}	
// =============================================================================== START Edit New school ======================================
	
	}elseif($do == 'Edit'){   // === START Edit Page =====================
			$userid = isset($_GET['userid'])&& is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
			// Check if the Userid is numeric and  Exist in Database	
			$stmt = $con->prepare("SELECT * FROM users WHERE UserID = ? AND Username = ? LIMIT 1");
			$stmt->execute(array($userid,  $sessionUseer));
			$row = $stmt->fetch();
			$count = $stmt->rowCount();
		if ($stmt->rowCount() > 0){ ?>
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="card card-primary">
							<div class="card-header"><h3 class="card-title">تعديل البيانات الاساسية </h3></div>
							<form action="?do=Update" method="POST">
								<input type="hidden" name="userid" value="<?php echo $userid ?>" />
								<div class="card-body">
									<div class="row">
										<div class="col-6">
												<label class="control-label">اسم المستخدم</label>
												<input type="text" name="username"id="firstName" class="form-control form-control-sm" value="<?php echo $row['Username']?>" autocomplete="off" required="required" readonly style="background-color:#000;color:#fff;" />
										</div>
										<div class="col-6">
												<label class="control-label">كلمة المرور</label>
												<input type="hidden" name="oldpassword" value="<?php echo $row['Password']?>" />
												<input type="password" name="newpassword" class="form-control form-control-sm" autocomplete="new-password" placeholder="اتركه فارغا في حالة عدم الرغبة للتغير" />
										</div>
										<div class="col-6">
											<label class="control-label">البريد الالكتروني</label>
											<input type="email" name="email" class="form-control form-control-sm" value="<?php echo $row['Email']?>"   required="required"  />
										</div>
										<div class="col-6">
											<label class="control-label">الاسم بالكامل</label>
											<input type="text" name="full" class="form-control form-control-sm" value="<?php echo $row['FullName']?>"  required="required" readonly style="background-color:#000;color:#fff;"  />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label">الهاتف</label>
										<input type="text" name="phone" required="required" class="form-control form-control-sm" value="<?php echo $row['phone']?>"   />
									</div>
									<div class="form-group">
										<input type="hidden" value="10" name="department"  class="form-control"  />
										<input type="hidden" value="44" name="role"  class="form-control"  />
									</div>
								</div>
								<div class="card-footer">
									<input type="submit" class="btn btn-success swalDefaultSuccess"  value="حفظ التعديل" /> 
								</div>
							</form>
						</div>
					</div>
				</div>
			</div><?php
				// if ther's No such ID show the error message
		}else{
				echo "<div class='container'>";echo "<div class= 'alert alert-danger text-center'> خطأ في الادخال الرقم المدخل غير مووووووووووجود  </div>" ;
					echo '<a href="logout.php" class="btn btn-danger">عودة للسابقة</a>';
				echo "</div>";
		}
					
	}elseif($do == 'Update'){       // === strst of Update Page =================*
						if($_SERVER['REQUEST_METHOD'] == 'POST'){
							// Get Variabls from the Form
							$id  = $_POST['userid'];
							$user  = $_POST['username'];
							$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
							$name  = $_POST['full'];
								// Password TRICK
							$pass = empty ($_POST['newpassword']) ? $_POST['oldpassword'] :sha1($_POST['newpassword']);
							
							$phone  		= filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
							
							$department     = $_POST['department'];
							$role  			= $_POST['role'];
							
							//Validate The Form
							$formErrors = array();
							
							if (strlen($user) < 4) {
								$formErrors[] = '<span>  اسم المستخدم يجب الا يقل عن اربعة احرف</span> ';
							}
							if (strlen($user) > 60) {
								$formErrors[] = '<span> اسم المستخدم يجب الا يزيد عن اربعون حرف</span> ';
							}
							if (empty($user)) {
								$formErrors[] = '<span> لا يمكنك ترك اسم المستخدم فارغا</span> ';
							}
							if (empty($pass)) {
								$formErrors[] = '<span> لا يمكنك ترك كلمة المرور فارغة</span> ';
							}
							if (empty($name)) {
								$formErrors[] = '<span> لا يمكنك ترك اسم المستخدم فارغ</span> ';
							}
								?>
							<div class ="container" style="direction:rtl;">	
								<div class="row">
									<div class="col-md-12">
										<div class="card card-default">
											<div class="card-header">
											<h3 class="card-title">
												<i class="fas fa-exclamation-triangle"></i>
												تنبيه هام 
											</h3>
											</div>
											<div class="card-body">
											<?php foreach ($formErrors as $error) { ?>  
												<div class="alert alert-danger alert-dismissible">
													<a type="button" class="close"  href="javascript:history.go(-1)">عودة</a>
													<h5 style="text-align: right;">
													<i class="icon fas fa-ban" style="margin-left:10px"></i> تحذير !!  <?php echo $error ;?> 
													</h5>
												</div>
											<?php 
											}
											?>		
											</div>
										</div>
									</div>
								</div>
								<?php
							//check if no error update operators
							
							if (empty($formErrors)){
								
								$stmt2 = $con->prepare("SELECT
															* 
														FROM
															users
														WHERE 
															Username = ? 
														AND
															UserID != ?");
								$stmt2->execute(array($user, $id));
								$count = $stmt2->rowCount();
								if($count == 1){

									echo '<div class= "alert alert-danger">Sorry This User is Exist</div>';
									redirectHome($theMsg, 'back');
								}else{
									
										// Update the database with this Info
							
									$stmt = $con->prepare("UPDATE users SET  
																			Username = ?, Email = ?, FullName = ?, Password = ?, 
																			phone = ?, department = ?,	
																			role = ? WHERE UserID = ?");
															
									$stmt->execute(array($user, $email, $name, $pass, $phone, $department, 

														$role, $id));
									
									//Echo Success Measage
									if ($stmt) { // if it's true
										sleep(1);?>
										<script src="../layout/dist/js/sweetalert2.min.js"></script>
										<script>
											Swal.fire({
												title: 'تم التعديل بنجاح',
												width: 600, icon: 'success',  padding: '4em',
												color: '#716add', showConfirmButton: false,
												background: '#fff',  backdrop: `rgba(0,80,123,0.8)`
											});
										</script><?php
										$theMsg = isset($theMsg) ? $theMsg : '';
										redirectHome($theMsg);
									}
								}
							}
							
						}else{
						echo "<div class='container'>";
								echo "<div class= 'alert alert-danger'> خطأ في الادخال</div>" ;
							redirectHome($theMsg);
							
							echo "</div>";
							echo '';
							}
							echo"</div>";
						

}
	
}else{
	header ('location: index');
	exit();
}
include   $tpl . 'footer.php';
include   $tpl . 'footer-scripts.php';
ob_end_flush();
?>