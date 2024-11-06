<?php
ob_start();
session_start();
$noNavbar = '';
$main_header_edara = '';
$main_sidebar_edara = '';

if (isset($_SESSION['Edara30'])){
    $pageTitle = 'صفحة الاعدادات العامة ';  // this function to load page title
    include 'init.php';   //  Dirctory page


	$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
	$getUser->execute(array($_SESSION['Edara30']));
	$info = $getUser->fetch();
    
    include 'breadcrumb.php';
	if (array_search($info['role'], ['30']) !== false) { //   ادارة الجيم 
		$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';  // shor if 
		if($do == 'Manage'){  //==== Manage Page == 
			if (array_search($info['GroupID'], ['1','3']) !== false) {	   // مدير + مساعد
				$stmt = $con->prepare("SELECT * FROM settings ORDER BY id DESC");
				$stmt->execute();
				$rows = $stmt->fetchAll();
				if (! empty($rows)){ ?>
					<div class="container-fluid">
						<div class="row row-sm">
							<div class="col-lg-12">
								<div class="card">
									<div class="card-header"><h3 class="card-title text-center"> اعدادات الموقع العامة</h3></div>
									<div class="card-body">
											<div class="table-responsive export-table">
												<table id="example" class="table table-bordered table-striped" style= "width:98%; direction:rtl;">
												<thead>
													<tr>
															<th> #</th>
															<th> اسم الوقع</th>
															<th> وصف الموقع</th>
															<th> التحكم </th>
													</tr>
													</thead>
													<tbody>
															<?php
															$i = 1;
															foreach($rows as $row){
															echo "<tr>";
																echo "<td>" . $i++ . "</td>";
																echo "<td>" . $row['site_name'] . "</td>";
																echo "<td>" . $row['site_desc'] . "</td>";
																
																echo "<td data-label='التحكم' style='text-align:center;'>";
																	if (array_search($info['GroupID'], ['1']) !== false) { // المدير
																			echo"<a href='settings?memberid=315&formerror=form&action=employee&emplyeeid=3265&action=grtstat&grtstat=359&formerror=9853&getid=63524&iteimid=32145&checksum=56821&cookie=30121&do=Edit&userid=" . $row['id'] ."&counksum=93214&action=421' class=''><i class='fas fa-cog' style='text-decoration: none;color:#0c0ff3;font-size:15px;'></i>  </a>";
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
					}else{  echo '<div class="container">'. '<div class="nice-message"> لا يوجد اعدادات  للعرض</div>'. '</div>'; } 
			}
					
		}elseif($do == 'Edit'){   // === START Edit Page =====================
			$userid = isset($_GET['userid'])&& is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
					// Check if the Userid is numeric and  Exist in Database	
			$stmt = $con->prepare("SELECT * FROM settings WHERE id = ?  LIMIT 1");
			$stmt->execute(array($userid));
			$row = $stmt->fetch();
			$count = $stmt->rowCount();
			if ($stmt->rowCount() > 0 ){ ?>
					<div class="container-fluid">
						<div class="row row-sm">
							<div class="col-lg-12">
									<div class="card">
										<div class="card-header"><h3 class="card-title text-center">تعديل اعدادات  الموقع</h3></div>
										<div class="card-body">
											<form action="?do=Update" method="POST">
													<input type="hidden" name="userid" value="<?php echo $userid ?>" />
													<h3 class="card-title m-t-15" style="font-size: 15px;background-color: #022b09;color:#fff;padding:5px;margin-bottom:3px;">
														اسم الموقع و الوصف
													</h3>
													<div class="row p-t-20">
														<div class="col-md-12">
															<div class="form-group" style="text-align: right;">
																	<label class="control-label">اسم الموقع</label>
																	<input type="text" name="site_name"  class="form-control form-control-sm" value="<?php echo $row['site_name']?>" autocomplete="off" required="required" style="text-align:left;" />
															</div>
														</div>
														<div class="col-md-12">
															<div class="form-group has-danger" style="text-align: right;">
																	<label class="control-label">وصف الموقع </label>
																	<textarea rows="5" name="site_desc" class="form-control form-control-sm"  required="required" style="text-align:left;"><?php echo $row['site_desc']?></textarea>
															</div>
														</div>
													</div>
													<hr>
													<h3 class="card-title m-t-15" style="font-size: 15px;background-color: #022b09;color:#fff;padding:5px;margin-bottom:3px;">
														عن الموقع :
													</h3>
													<div class="row p-t-20">
														<div class="col-md-12">   
															<div class="form-group" style="text-align: right;">
																	<label class="control-label"> عن الموقع الجزء الأول</label>
																	<textarea rows="5" name="about_1" class="form-control form-control-sm"  required="required" style="text-align:left;"><?php echo $row['about_1']?></textarea>
															</div>
														</div>
														<div class="col-md-12">   
															<div class="form-group" style="text-align: right;">
																	<label class="control-label"> عن الموقع الجزء الثاني</label>
																	<textarea rows="5" name="about_2" class="form-control form-control-sm"  required="required" style="text-align:left;"><?php echo $row['about_2']?></textarea>
															</div>
														</div>
														<div class="col-md-12">   
															<div class="form-group" style="text-align: right;">
																	<label class="control-label">   رابط فيديو المقدمة  </label>
																	<input type="text" name="about_vedio" class="form-control form-control-sm" value="<?php echo $row['about_vedio']?>"   required="required" style="text-align:left;"/>
															</div>
														</div>
														
													</div>
													<h3 class="card-title m-t-15" style="font-size: 15px;background-color: #022b09;color:#fff;padding:5px;margin-bottom:3px;">
														مميزات الموقع :
													</h3>
													<div class="row">
														<div class="col-md-12">   
															<div class="form-group" style="text-align: right;">
																<label class="control-label">   الخدمات  </label>
																<script src="https://cdn.tiny.cloud/1/qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc/tinymce/7/tinymce.min.js"></script>
														            <textarea id="menu1" name="about_3" required="required" style="text-align:left;"><?php echo $row['about_3']?></textarea>
														            <script> 
                                                      tinymce.init({
                                                      selector: 'textarea#menu1',
                                                      menu: {
                                                         edit: { title: 'Edit', items: 'undo redo | selectall' }
                                                      }
                                                      }); 
                                                      </script>
															</div>
														</div>
														<hr>
													</div>
													<h3 class="card-title m-t-15" style="font-size: 15px;background-color: #022b09;color:#fff;padding:5px;margin-bottom:3px;">
														البيانات الاساسية :
													</h3>
													<div class="row p-t-20">
														<div class="col-md-12">   
															<div class="form-group" style="text-align: right;">
																	<label class="control-label"> العنوان </label>
																	<input type="text" name="address" class="form-control form-control-sm" value="<?php echo $row['address']?>"   required="required" style="text-align:left;"/>
															</div>
														</div>
														<div class="col-md-6">   
															<div class="form-group" style="text-align: right;">
																	<label class="control-label"> الأيميل</label>
																	<input type="email" name="email" class="form-control form-control-sm" value="<?php echo $row['email']?>"   required="required" style="text-align:left;"/>
															</div>
														</div>
														<div class="col-md-6">   
															<div class="form-group" style="text-align: right;">
																	<label class="control-label"> الهاتف</label>
																	<input type="text" name="phone" class="form-control form-control-sm" value="<?php echo $row['phone']?>"   required="required" style="text-align:left;"/>
															</div>
														</div>
													</div>
													<h3 class="card-title m-t-15" style="font-size: 15px;background-color: #022b09;color:#fff;padding:5px;margin-bottom:3px;">
														وسائل التواصل :
													</h3>
													<div class="row p-t-20">
														<div class="col-md-6">   
															<div class="form-group" style="text-align: right;">
																	<label class="control-label"> الفيسبوك </label>
																	<input type="text" name="facebook" class="form-control form-control-sm" value="<?php echo $row['facebook']?>"   required="required" style="text-align:left;"/>
															</div>
														</div>
														<div class="col-md-6">   
															<div class="form-group" style="text-align: right;">
																	<label class="control-label"> اليوتيوب </label>
																	<input type="text" name="youtube" class="form-control form-control-sm" value="<?php echo $row['youtube']?>"   required="required" style="text-align:left;"/>
															</div>
														</div>
														<div class="col-md-6">   
															<div class="form-group" style="text-align: right;">
																	<label class="control-label"> تويتر</label>
																	<input type="text" name="twitter" class="form-control form-control-sm" value="<?php echo $row['twitter']?>"   required="required" style="text-align:left;"/>
															</div>
														</div>
														<div class="col-md-6">   
															<div class="form-group" style="text-align: right;">
																	<label class="control-label"> انستجرام</label>
																	<input type="text" name="instagram" class="form-control form-control-sm" value="<?php echo $row['instagram']?>"   required="required" style="text-align:left;"/>
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
					$site_name  = $_POST['site_name'];
					$site_desc  = $_POST['site_desc'];

					$about_1  = $_POST['about_1'];
					$about_2  = $_POST['about_2'];
					$about_vedio  = $_POST['about_vedio'];
					$about_3  = $_POST['about_3'];

					

					$address  = $_POST['address'];
					$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
					$phone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);

					$facebook  = $_POST['facebook'];
					$youtube  = $_POST['youtube'];
					$twitter  = $_POST['twitter'];
					$instagram  = $_POST['instagram'];
					
					//Validate The Form
					$formErrors = array();
					if (strlen($site_name) < 4) {
						$formErrors[] = '<span>  اسم الموقع يجب الا يقل عن اربعة احرف</span> </i>';
					}
					if (strlen($site_name) > 60) {
						$formErrors[] = '<span> اسم الموقع يجب الا يزيد عن ستون حرف</span> </i>';
					}
					if (empty($site_name)) {
						$formErrors[] = '<span> لا يمكنك ترك اسم الموقع فارغا</span> </i>';
					}
					if (empty($site_desc)) {
						$formErrors[] = '<span> لا يمكن ترك وصف الموقع فارغ</span> </i>';
					}
					if (empty($facebook)) {
						$formErrors[] = '<span> لا يمكنك ترك الفيسبوك فارغ</span> </i>';
					}
					if (empty($youtube)) {
						$formErrors[] = '<span> لا يمكنك ترك يوتيوب فارغ</span> </i>';
					}
					if (empty($twitter)) {
						$formErrors[] = '<span> لا يمكنك ترك تويتر فارغ</span> </i>';
					}
					if (empty($instagram)) {
						$formErrors[] = '<span> لا يمكنك ترك انستجرام فارغ</span> </i>';
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
						
							$stmt = $con->prepare("UPDATE settings SET 
																		site_name = ?, 
																		site_desc = ?, 
																		about_1 = ?, 
																		about_2 = ?, 
																		about_vedio = ?, 
																		about_3 = ?, 
																		address = ?,	
																		email = ?,
																		phone = ?,	
																		facebook = ?,	
																		youtube = ?,	
																		twitter = ?,	
																		instagram = ? 
																	WHERE id = ?");

							$stmt->execute(array(
														$site_name, 
														$site_desc, 
														$about_1, 
														$about_2, 
														$about_vedio, 
														$about_3, 
														$address,	
														$email, 
														$phone,	
														$facebook,	
														$youtube,	
														$twitter,	
														$instagram, 
														$id));
							//Echo Success Measage
							if ($stmt) { // if it's true
									sleep(1);?>
									<script src="../layout/dist/js/sweetalert2.min.js"></script>
									<script>
										Swal.fire({
											title: 'تم تحديث  الاعدادات  بنجاح',
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




<?php

}else{
	header ('location: ../index');
	exit();
}
include   $tpl . 'footer.php';
include   $tpl . 'footer-scripts.php';
ob_end_flush();
?>