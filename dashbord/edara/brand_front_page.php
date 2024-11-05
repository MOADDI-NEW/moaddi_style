<?php
ob_start();
session_start();
$noNavbar = '';
$main_header_edara = '';
$main_sidebar_edara = '';

if (isset($_SESSION['Edara30'])){
    $pageTitle = 'صفحة الاعدادات لفحة الشركات ';  // this function to load page title
    include 'init.php';   //  Dirctory page


	$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
	$getUser->execute(array($_SESSION['Edara30']));
	$info = $getUser->fetch();
    
    include 'breadcrumb.php';
	if (array_search($info['role'], ['30']) !== false) { //   ادارة الجيم 
		$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';  // shor if 
		if($do == 'Manage'){  //==== Manage Page == 
			if (array_search($info['GroupID'], ['1','3']) !== false) {	   // مدير + مساعد
				$stmt = $con->prepare("SELECT * FROM brand_front_page ORDER BY id DESC");
				$stmt->execute();
				$rows = $stmt->fetchAll();
				if (! empty($rows)){ ?>
					<div class="container-fluid">
						<div class="row row-sm">
							<div class="col-lg-12">
								<div class="card">
									<div class="card-header"><h3 class="card-title text-center"> اعدادات  صفحة الشركات</h3></div>
									<div class="card-body">
											<div class="table-responsive export-table">
												<table id="example" class="table table-bordered table-striped" style= "width:98%; direction:rtl;">
												<thead>
													<tr>
															<th> #</th>
															<th> التحكم </th>
													</tr>
													</thead>
													<tbody>
															<?php
															$i = 1;
															foreach($rows as $row){
															echo "<tr>";
																echo "<td>" . $i++ . "</td>";
																echo "<td data-label='التحكم' style='text-align:center;'>";
																	if (array_search($info['GroupID'], ['1']) !== false) { // المدير
																			echo"<a href='brand_front_page?memberid=315&formerror=form&action=employee&emplyeeid=3265&action=grtstat&grtstat=359&formerror=9853&getid=63524&iteimid=32145&checksum=56821&cookie=30121&do=Edit&userid=" . $row['id'] ."&counksum=93214&action=421' class=''><i class='fas fa-cog' style='text-decoration: none;color:#0c0ff3;font-size:15px;'></i>  </a>";
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
			$stmt = $con->prepare("SELECT * FROM brand_front_page WHERE id = ?  LIMIT 1");
			$stmt->execute(array($userid));
			$row = $stmt->fetch();
			$count = $stmt->rowCount();
			if ($stmt->rowCount() > 0 ){ ?>
					<div class="container-fluid">
						<div class="row row-sm">
							<div class="col-lg-12">
									<div class="card">
										<div class="card-header"><h3 class="card-title text-center"> تعديل اعدادات  صفحة الشركاء</h3></div>
										<div class="card-body">
											<form action="?do=Update" method="POST">
													<input type="hidden" name="userid" value="<?php echo $userid ?>" />
													<h3 class="card-title m-t-15" style="font-size: 15px;background-color: #022b09;color:#fff;padding:5px;margin-bottom:3px;">
                                          تعديل اعدادات  صفحة الشركاء      
													</h3>
													
													<div class="row p-t-20">
														<div class="col-md-12">   
															<div class="form-group" style="text-align: right;">
																	<label class="control-label">  Intro  </label>
                                                   <script src="https://cdn.tiny.cloud/1/qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc/tinymce/7/tinymce.min.js"></script>
														            <textarea id="menu1" name="text_page" required="required" style="text-align:left;"><?php echo $row['text_page']?></textarea>
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
					$text_page  = $_POST['text_page'];
					
					//Validate The Form
					$formErrors = array();
					if (strlen($text_page) < 4) {
						$formErrors[] = '<span>  اسم الموقع يجب الا يقل عن اربعة احرف</span> </i>';
					}
					if (empty($text_page)) {
						$formErrors[] = '<span> لا يمكنك ترك اسم الموقع فارغا</span> </i>';
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
						
							$stmt = $con->prepare("UPDATE brand_front_page SET 
																		text_page = ?  WHERE id = ?");

							$stmt->execute(array(
														$text_page, $id));
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