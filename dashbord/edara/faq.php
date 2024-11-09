<?php
ob_start();
session_start();
$noNavbar = '';
$main_header_edara = '';
$main_sidebar_edara = '';

if (isset($_SESSION['Edara30'])){
    $pageTitle = 'صفحة  الاسئبة الشائعة ';  // this function to load page title
    include 'init.php';   //  Dirctory page


	$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
	$getUser->execute(array($_SESSION['Edara30']));
	$info = $getUser->fetch();
    
    include 'breadcrumb.php';
	if (array_search($info['role'], ['30']) !== false) { //   ادارة الجيم 
      $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';  // shor if 
      if($do == 'Manage'){  //==== Manage Page == 
			if (array_search($info['GroupID'], ['1','3']) !== false) {	   // مدير + مساعد
				$stmt = $con->prepare("SELECT * FROM faq  ORDER BY faq_id DESC");
				$stmt->execute();
				$rows = $stmt->fetchAll();
				if (! empty($rows)){ ?>
					<div class="container-fluid">
						<div class="row row-sm">
							<div class="col-lg-12">
								<div class="card">
									<div class="card-header"><h3 class="card-title text-center">  قائمة الاسئلة الشائعة </h3></div>
											<?php
												if (isset($_SESSION['Edara30'])){
													$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
													$getUser->execute(array($_SESSION['Edara30']));
													$info = $getUser->fetch();
													if (array_search($info['GroupID'], ['1']) !== false) { // المدير  ?>
												<a href="faq?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i> اضافة سؤال جديد </a>
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
													<th> السؤال</th>
													<th> تعديل وحذف </th>
												</tr>
												</thead>
												<tbody>
														<?php
														$i = 1;
														foreach($rows as $row){
														echo "<tr>";
															echo "<td>" . $i++ . "</td>";
															echo "<td>" . $row['faq_Q'] . "</td>";
															
															echo "<td data-label='التحكم' style='text-align:center;'>";
																if (array_search($info['GroupID'], ['1']) !== false) { // المدير
																		echo"<a href='faq?memberid=315&formerror=form&action=employee&emplyeeid=3265&action=grtstat&grtstat=359&formerror=9853&getid=63524&iteimid=32145&checksum=56821&cookie=30121&do=Edit&userid=" . $row['faq_id'] ."&counksum=93214&action=421' class=''><i class='fas fa-user-edit' style='text-decoration: none;color:#0c0ff3;font-size:15px;'></i>  </a>";
																		echo "<a href='faq?do=Delete&userid=" . $row['faq_id'] . "' class='deleteEmployee' title=\" حذف\"  ><i class='far fa-trash-alt' style='text-decoration: none;color: crimson;padding: 5px;'></i> </a>";
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
					}else{ echo '<div class="container">'. '<div class="nice-message"> لا يوجد أسئلة للعرض</div>';
						echo '<a href="faq?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i> اضافة سؤال جديد </a>';
					echo '</div>';  } 
			}
                
		}elseif($do == 'Add'){  // ADD Members Page 
			if (array_search($info['GroupID'], ['1']) !== false) { // المدير  ?>
					<div class="container-fluid">
						<div class="row row-sm">
							<div class="col-lg-12">
									<div class="card">
										<div class="card-header"><h3 class="card-title text-center">اضافة سؤال جديد</h3></div>
										<div class="card-body">
											<form action="?do=Insert" method="POST" >
													<div class="form-body">
														<div class="row p-t-20">
															<div class="col-md-12">
																<div class="form-group" style="text-align: right;">
																	<label class="control-label"> السؤال</label>
																	<input type="text" name="faq_Q" autocomplete="off" required="required" id="firstName" class="form-control form-control-sm" placeholder="نص السؤال" />
																</div>
															</div>
															<div class="col-md-12">
																<div class="form-group has-danger" style="text-align: right;">
																	<label class="control-label">الإجابة </label>
																	<textarea name="faq_An" rows="10"  class="form-control form-control-sm" required="required"></textarea>
																</div>
															</div>
														</div>
														<div class="form-actions pull-right">
															<input type="submit" class="btn btn-success swalDefaultSuccess"  value="اضافة سؤال" />  
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
					$faq_Q  = $_POST['faq_Q'];
					$faq_An  = $_POST['faq_An'];

					//Validate The Form
					$formErrors = array();
					if (strlen($faq_Q) < 4) {
						$formErrors[] = '<span>   السؤال  يجب الا يقل عن اربعة احرف</span> </i>';
					}
					if (empty($faq_Q)) {
						$formErrors[] = '<span> لا يمكنك ترك  السؤال فارغا</span> </i>';
					}
					if (strlen($faq_An) < 4) {
						$formErrors[] = '<span>   الاجابة يجب الا يقل عن اربعة احرف</span> </i>';
					}
					if (empty($faq_An)) {
						$formErrors[] = '<span> لا يمكنك ترك الاجابة  فارغا</span> </i>';
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
							// Inser Info to database *** مهم *** 
							$stmt = $con->prepare("INSERT INTO faq (faq_Q, faq_An) VALUES (:zfaq_Q, :zfaq_An)"); 
							$stmt->execute(array( 'zfaq_Q'  => $faq_Q, 'zfaq_An'  => $faq_An ));
							//Echo Success Measage
							if ($stmt) { // if it's true
									sleep(1);?>
									<script src="../layout/dist/js/sweetalert2.min.js"></script>
									<script>
										Swal.fire({
											title: 'تم إضافة السؤال بنجاح',
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




		}elseif($do == 'Edit'){   // === START Edit Page =====================
			$userid = isset($_GET['userid'])&& is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
					// Check if the Userid is numeric and  Exist in Database	
			$stmt = $con->prepare("SELECT * FROM faq WHERE faq_id = ?  LIMIT 1");
			$stmt->execute(array($userid));
			$row = $stmt->fetch();
			$count = $stmt->rowCount();
			if ($stmt->rowCount() > 0 ){ ?>
					<div class="container-fluid">
						<div class="row row-sm">
							<div class="col-lg-12">
									<div class="card">
										<div class="card-header"><h3 class="card-title text-center">تعديل بيانات سؤال</h3></div>
										<div class="card-body">
											<form action="?do=Update" method="POST">
													<input type="hidden" name="userid" value="<?php echo $userid ?>" /><?php
													if (array_search($info['GroupID'], ['1']) !== false) { // مدير?>	
															<div class="row p-t-20">
																	<div class="col-md-12">
																		<div class="form-group" style="text-align: right;">
																			<label class="control-label"> السؤال</label>
																			<input type="text" name="faq_Q"id="firstName" class="form-control form-control-sm" value="<?php echo $row['faq_Q']?>" autocomplete="off" required="required" />
																		</div>
																	</div>
																	<div class="col-md-12">
																		<div class="form-group has-danger" style="text-align: right;">
																			<label class="control-label"> الاجابة</label>
																			<textarea name="faq_An" rows="10" class="form-control form-control-sm" > <?php echo $row['faq_An']?> </textarea>
																		</div>
																	</div>
															</div>
													<?php   }   ?>
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
					$faq_Q  = $_POST['faq_Q'];
					$faq_An  = $_POST['faq_An'];


					//Validate The Form
					$formErrors = array();
					if (strlen($faq_Q) < 4) {
						$formErrors[] = '<span>   السؤال  يجب الا يقل عن اربعة احرف</span> </i>';
					}
					if (empty($faq_Q)) {
						$formErrors[] = '<span> لا يمكنك ترك  السؤال فارغا</span> </i>';
					}
					if (strlen($faq_An) < 4) {
						$formErrors[] = '<span>   الاجابة يجب الا يقل عن اربعة احرف</span> </i>';
					}
					if (empty($faq_An)) {
						$formErrors[] = '<span> لا يمكنك ترك الاجابة  فارغا</span> </i>';
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
							$stmt = $con->prepare("UPDATE faq SET faq_Q = ?, faq_An = ? WHERE faq_id = ?");
							$stmt->execute(array($faq_Q, $faq_An, $id));
							//Echo Success Measage
							if ($stmt) { // if it's true
									sleep(1);?>
									<script src="../layout/dist/js/sweetalert2.min.js"></script>
									<script>
										Swal.fire({
											title: 'تم تحديث بيانات السؤال بنجاح',
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
		


		}elseif($do == 'Delete'){ // Delete members page==========
			if (array_search($info['GroupID'], ['1']) !== false) {	  
					echo "<h1 class='text-center'> حذف سؤال</h1>";
					echo "<div class ='container'>";
						$userid = isset($_GET['userid'])&& is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
						// Check if the Userid is numeric and  Exist in Database	
						$check = checkItem ('faq_id', 'faq', $userid);
						if ($check > 0){ 
							$stmt = $con->prepare("DELETE FROM faq WHERE faq_id = :zuser");
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
		}elseif($do == 'DeRegStatus'){
			$userid = isset($_GET['userid'])&& is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
			// Check if the Userid is numeric and  Exist in Database	
					$check = checkItem ('UserID', 'users', $userid);
					if ($check > 0){ 
						$stmt = $con->prepare("UPDATE users SET RegStatus = 0 WHERE UserID = ?");
						$stmt->execute(array($userid));
						if ($stmt) { // if it's true
							sleep(1);?>
							<script src="../layout/dist/js/sweetalert2.min.js"></script>
							<script>
									Swal.fire({
										title: ' تمت الموافقة على تعطيل المستخدم بنجاح',
										width: 600, icon: 'success',  padding: '4em',
										color: '#716add', showConfirmButton: false,
										background: '#fff',  backdrop: `rgba(0,80,123,0.8)`
									});
							</script>
							<?php
							$theMsg = isset($theMsg) ? $theMsg : '';
							redirectHome($theMsg, 'back');
						}
					}else{
					echo "<div class='container'>";
						$theMsg = "<div class= 'alert alert-danger'>خطأ في الادخال</div>" ;
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