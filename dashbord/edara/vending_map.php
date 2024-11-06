<?php
ob_start();
session_start();
$noNavbar = '';
$main_header_edara = '';
$main_sidebar_edara = '';

if (isset($_SESSION['Edara30'])){
    $pageTitle = 'أماكن المكائن ';  // this function to load page title
    include 'init.php';   //  Dirctory page


	$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
	$getUser->execute(array($_SESSION['Edara30']));
	$info = $getUser->fetch();
    
    include 'breadcrumb.php';
	if (array_search($info['role'], ['30']) !== false) { //   ادارة الجيم 
      $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';  // shor if 
      if($do == 'Manage'){  //==== Manage Page == 
			if (array_search($info['GroupID'], ['1','3']) !== false) {	   // مدير + مساعد
				$stmt = $con->prepare("SELECT * FROM vending_map  ORDER BY id DESC");
				$stmt->execute();
				$rows = $stmt->fetchAll();
				if (! empty($rows)){ ?>
					<div class="container-fluid">
						<div class="row row-sm">
							<div class="col-lg-12">
								<div class="card">
									<div class="card-header"><h3 class="card-title text-center">قوائم أماكن المكائن </h3></div>
											<?php
												if (isset($_SESSION['Edara30'])){
													$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
													$getUser->execute(array($_SESSION['Edara30']));
													$info = $getUser->fetch();
													if (array_search($info['GroupID'], ['1']) !== false) { // المدير  ?>
												<a href="vending_map?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i> اضافة مكينة جديد </a>
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
													<th> المكينة</th>
													<th> العنوان</th>
													<th> تعديل وحذف </th>
												</tr>
												</thead>
												<tbody>
														<?php
														$i = 1;
														foreach($rows as $row){
														echo "<tr>";
															echo "<td>" . $i++ . "</td>";
															echo "<td>" . $row['vending_name'] . "</td>";
															echo "<td>" . $row['vending_address'] . "</td>";
															
															echo "<td data-label='التحكم' style='text-align:center;'>";
																if (array_search($info['GroupID'], ['1']) !== false) { // المدير
																		echo "<a href='vending_map?do=Delete&userid=" . $row['id'] . "' class='deleteEmployee' title=\" حذف\"  ><i class='far fa-trash-alt' style='text-decoration: none;color: crimson;padding: 5px;'></i> </a>";
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
					}else{ echo '<div class="container">'. '<div class="nice-message"> لا يوجد مكائن للعرض</div>';
						echo '<a href="vending_map?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i> اضافة مكينة جديد </a>';
					echo '</div>';  } 
			}
                
		}elseif($do == 'Add'){  // ADD Members Page 
			if (array_search($info['GroupID'], ['1']) !== false) { // المدير  ?>
					<div class="container-fluid">
						<div class="row row-sm">
							<div class="col-lg-12">
									<div class="card">
										<div class="card-header"><h3 class="card-title text-center">اضافة مكينة جديد</h3></div>
										<div class="card-body">
											<form action="?do=Insert" method="POST" enctype="multipart/form-data">
                                    <div class="form-body">
                                          <div class="row p-t-20">
                                             <div class="col-md-12">
                                                <div class="form-group" style="text-align: right;">
                                                   <label class="control-label">اسم المكينة</label>
                                                   <input type="text" name="vending_name"  required="required" class="form-control form-control-sm" placeholder=" اسم المكينة" />
                                                </div>
                                             </div>
                                             <div class="col-md-12">
                                                <div class="form-group has-danger" style="text-align: right;">
                                                   <label class="control-label">العنوان </label>
                                                   <input type="text" name="vending_address"  required="required" class="form-control form-control-sm" placeholder="عنوان المكينة" />
                                                </div>
                                             </div>
                                          </div>
                                          <hr>
                                          <div class="row p-t-20">
                                                <div class="col-md-12">
                                                   <div class="form-group" style="text-align: right;">
                                                      <label class="control-label">الموقع على الخريطة </label>
                                                      <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
                                                      <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
                                                      <div id="map" style="height: 400px;"></div>
                                                      <script>
                                                      var map = L.map('map').setView([23.8859, 45.0792], 6); 
                                                      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                                         maxZoom: 18,
                                                         attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                                                      }).addTo(map);
                                                      var marker;
                                                      map.on('click', function(e) {
                                                         if (marker) {
                                                            map.removeLayer(marker); // إزالة المؤشر السابق
                                                         }
                                                         marker = L.marker(e.latlng).addTo(map);

                                                         // إرسال الإحداثيات إلى حقول مخفية في النموذج
                                                         document.getElementById('latitude').value = e.latlng.lat;
                                                         document.getElementById('longitude').value = e.latlng.lng;
                                                      });
                                                   </script>

                                                      <input type="hidden" id="latitude" name="latitude">
                                                      <input type="hidden" id="longitude" name="longitude">

                                                   </div>
                                                </div>
                                          </div>
                                       <div class="form-actions pull-right">
                                          <input type="submit" class="btn btn-success swalDefaultSuccess"  value="اضافة مكينة" />  
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
					$vending_name  = $_POST['vending_name'];
					$vending_address  = $_POST['vending_address'];
					$latitude  = $_POST['latitude'];
					$longitude  = $_POST['longitude'];

					//Validate The Form
					$formErrors = array();
					if (strlen($vending_name) < 4) {
						$formErrors[] = '<span>  اسم المكينة يجب الا يقل عن اربعة احرف</span> </i>';
					}
					if (strlen($vending_name) > 250) {
						$formErrors[] = '<span> اسم المكينة يجب الا يزيد عن 250 حرف</span> </i>';
					}
					if (empty($vending_name)) {
						$formErrors[] = '<span> لا يمكنك ترك اسم المستخدم فارغا</span> </i>';
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
						$check = checkItem ("vending_name", "vending_map", $vending_name);
						if ($check == 1){
							echo "<div class='container'>";
									echo "<div class= 'alert alert-danger text-center'>-------- المكينة موجود مسبقا -------  </div>" ;
									$theMsg = isset($theMsg) ? $theMsg : '';
									redirectHome($theMsg, 'back');
							echo "</div>";
							
						}else{
						
							// Inser Info to database *** مهم *** 
							$stmt = $con->prepare("INSERT INTO  vending_map
																	   (vending_name, vending_address, latitude, longitude )
															VALUES
																	(:zvending_name, :zvending_address, :zlatitude, :zlongitude)
                                                   "); 
							$stmt->execute(array(
									'zvending_name'  => $vending_name,
									'zvending_address'  => $vending_address,
									'zlatitude' => $latitude,
									'zlongitude' => $longitude
							));
							//Echo Success Measage
							if ($stmt) { // if it's true
									sleep(1);?>
									<script src="../layout/dist/js/sweetalert2.min.js"></script>
									<script>
										Swal.fire({
											title: 'تم إضافة المكينة بنجاح',
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




		

		}elseif($do == 'Delete'){ // Delete members page==========
			if (array_search($info['GroupID'], ['1']) !== false) {	  
					echo "<h1 class='text-center'> حذف مكينة</h1>";
					echo "<div class ='container'>";
						$userid = isset($_GET['userid'])&& is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
						// Check if the Userid is numeric and  Exist in Database	
						$check = checkItem ('id', 'vending_map', $userid);
						if ($check > 0){ 
							$stmt = $con->prepare("DELETE FROM vending_map WHERE id = :zuser");
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
		}elseif($do == 'Death'){   // === START Edit Page =====================
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
											<form action="?do=Update2" method="POST">
													<input type="hidden" name="userid" value="<?php echo $userid ?>" />
												
													<h3 class="card-title m-t-15" style="font-size: 15px;background-color: #022b09;color:#fff;padding:5px;margin-bottom:3px;">
														البيانات الاساسية
													</h3>
													<div class="row p-t-20">
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
														
													</div>
													<div class="row">
														<div class="col-md-6">
															<div class="form-group has-danger" style="text-align: right;">
																	<label class="control-label"> تاريخ الميلاد </label>
																	<input type="date" name="birthdate"  class="form-control form-control-sm" value="<?php echo $row['birthdate']?>" />
															</div>
														</div>
														
														<div class="col-md-6">
															<div class="form-group has-danger" style="text-align: right;">
																	<label class="control-label"> تاريخ الوفاه </label>
																	<input type="date" name="deathdate"  class="form-control form-control-sm" value="<?php echo $row['deathdate']?>" required />
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
																	<input type="hidden" value="2" name="RegStatus"  class="form-control"  />
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
					$name  = $_POST['full'];
					$job_title  = $_POST['job_title'];
					$birthdate  = $_POST['birthdate'];
					$deathdate  = $_POST['deathdate'];
					
					$department     = $_POST['department'];
					$role  			= $_POST['role'];
					$RegStatus  	= $_POST['RegStatus'];
					
					//Validate The Form
					$formErrors = array();
				
					if (empty($name)) {
						$formErrors[] = '<span> لا يمكنك ترك اسم المستخدم فارغ</span> </i>';
					}
					if (empty($deathdate)) {
						$formErrors[] = '<span> لا يمكنك ترك ت الوفاة  فارغ</span> </i>';
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
							$stmt = $con->prepare("UPDATE users SET  FullName = ?, job_title = ?,  birthdate = ?, deathdate = ?, RegStatus = ?, 
																	department = ?,	
																	role = ? WHERE UserID = ?");
							$stmt->execute(array($name, $job_title, $birthdate, $deathdate, $RegStatus,
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