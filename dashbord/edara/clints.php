<?php
ob_start();
session_start();
$noNavbar = '';
$main_header_edara = '';
$main_sidebar_edara = '';
$pageTitle = 'Anvil clints';
	if (isset($_SESSION['Edara30'])){
   	include 'init.php'; ?>
     
      	<?php include 'breadcrumb.php';
         $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';  // shor if 
         if($do == 'Manage'){  //==== Manage Page == 
            if (isset($_SESSION['Edara30'])){
					$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
					$getUser->execute(array($_SESSION['Edara30']));
					$info = $getUser->fetch();

					if (array_search($info['GroupID'], ['1']) !== false) {
						$stmt = $con->prepare("SELECT * FROM clints  ORDER BY clint_id DESC");
						$stmt->execute();
						$items = $stmt->fetchAll();
						if (! empty($items)){?>
						<div class="container-fluid">
								<div class="row row-sm"> 
									<div class="col-lg-12">
										<div class="card"><?php
											if (array_search($info['role'], ['30']) !== false) {    
												echo '<a href="clints?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i> إضافة شريك جديد </a>';
											} ?>
											<div class="card-header"><h3 class="card-title text-center">  شركاء النجاح  </h3></div>
											<div class="card-body">
												<div class="table-responsive export-table">
													<table id="" class="table table-bordered table-striped" style= "width:98%; direction:rtl;">
															<thead>
																<tr>
																	<th> # </th>
																	<th> اسم الشريك</th>
																	<th> رابط الموقع </th>
																	<th>  الصورة </th>
																	<th> التحكم </th>
																</tr>
															</thead>
															<tbody>
																<?php
																	$i = 0;
																foreach($items as $item){
																	$i++;
																echo "<tr>";
																	echo "<td>" . $i . "</td>";
																	echo "<td>" . $item['clint_name'] . "</td>";
																	echo "<td>" . $item['brand_url'] . "</td>";
																	echo "<td><img src='../admin/nsharat_uploads/avatar55/" . $item['avatar55'] . "' alt='' style='width:30px;' /></td>";
																	echo "<td data-label='التحكم' style='text-align:center;'>";
																				if (isset($_SESSION['Edara30'])){
																					$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
																					$getUser->execute(array($_SESSION['Edara30']));
																					$info = $getUser->fetch();
																					if (array_search($info['GroupID'], ['1']) !== false) {   
																							echo "<a href='clints?do=Delete&itemid=" . $item['clint_id'] . "' class=''title=\"click for delete\" onclick=\"return confirm('Are You Sure to Delete ?')\" ><i class='far fa-trash-alt' style='text-decoration: none;color: crimson;padding: 5px;'></i> </a>";
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
						}else{
								echo '<div class="container">';
										echo '<div class="nice-message">  No clints to display  </div>';
										echo '<a href="clints?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i>  إضافة شريك جديد </a>';
								echo '</div>';
						}
					}
            }
      	}elseif($do == 'Add'){ ?>
				<div class="container-fluid">
					<div class="row row-sm">
						<div class="col-lg-12">
								<div class="card">
									<div class="card-header"><h3 class="card-title text-center"> إضافة شريك جديد  </h3></div>
									<div class="card-body">
										<form  action="?do=Insert" method="POST" enctype="multipart/form-data" dir="ltr">
											<div class="row">
												<div class="col-md-12 col-sm-12">
													<label> اسم الشريك </label>
													<input type="text" class="form-control form-control-sm"  name="clint_name"  placeholder="اسم الشريك"/>
												</div>
												<div class="col-md-6 col-sm-12">
														<label> رابط الموقع </label>
														<input type="text" class="form-control form-control-sm"  name="brand_url"  required="required" placeholder="رابط الموقع"/>
												</div>
												<div class="col-md-6 col-sm-6">
														<label> الصورة مقاس   400 * 150</label>
														<input type="file" name="avatar55"  class="form-control form-control-sm"  required="required"  />
												</div>
											</div>
											<br><br>
											<div class="button-section">
												<input type="submit" value="إضافة جديد" class="btn btn-primary btn-lg" />
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
					$clint_name  = $_POST['clint_name'];
					$brand_url     = $_POST['brand_url'];
					
					//$avatar    = $_POST['avatar'];
					$avatarName = $_FILES['avatar55']['name'];
					$avatarSize = $_FILES['avatar55']['size'];
					$avatarTmp  = $_FILES['avatar55']['tmp_name'];
					$avatarType = $_FILES['avatar55']['type'];
					$avatarAllowedExtension = array("jpeg", "jpg", "png", "gif");
					$tmp = explode('.', $avatarName);
					$avatarExtension = end($tmp);

                    //Validate The Form
					$formErrors = array();
						if (empty($clint_name)) {
								$formErrors[] = '<span> لا يمكن ترك اسم العميل فارغا</span> <i class="fa fa-bomb" style="font-size:30px"></i>';
						}
						if (! empty($avatarName) && ! in_array($avatarExtension, $avatarAllowedExtension)){
								$formErrors[] = '<span>  امتداد الصورة عير مسموح به </span> <i class="fa fa-bomb" style="font-size:30px"></i>';
						}
						if (empty($avatarName)) {
								$formErrors[] = '<span> يجب اختيار صور للنشرة</span> <i class="fa fa-bomb" style="font-size:30px"></i>';
						}
						if ($avatarSize > 9222621440) {
								$formErrors[] = '<span>  حجم الصورة يجب ان يكون اقل من 2.5 ميجا بايت</span> <i class="fa fa-bomb" style="font-size:30px"></i>';
						}?>
						<div class ="container" style="direction:rtl;">	
							<div class="row">
								<div class="col-md-12">
										<div class="card card-default">
											<div class="card-header">
												<h3 class="card-title"><i class="fas fa-exclamation-triangle"></i> تنبيه هام </h3>
											</div>
											<div class="card-body">
												<?php foreach ($formErrors as $error) { ?>  
														<div class="alert alert-danger alert-dismissible">
															<a type="button" class="close"  href="javascript:history.go(-3)">عودة</a>
															<h5 style="text-align: center;">
															<i class="icon fas fa-ban" style="margin-left:10px"></i> تحذير !!  <?php echo $error ;?> 
															</h5>
														</div>
												<?php 
												}
												?>		
											</div>
										</div>
								</div>
							</div> <?php
							if(empty($formErrors)){
								$avatar55 = $avatarName;
								move_uploaded_file($avatarTmp , "../admin/nsharat_uploads/avatar55//" . $avatar55);

                                    // Inser Info to database *** مهم *** 
                        $stmt = $con->prepare("INSERT INTO  clints
												(clint_name, 
												brand_url,
												avatar55)
									VALUES
												(:zclint_name, 
												:zbrand_url,
												:zavatar55)");
								$stmt->execute(array(
												'zclint_name'  => $clint_name,          
												'zbrand_url'   => $brand_url,     
												'zavatar55'  => $avatar55 ));
									//Echo Success Measage
										echo "<script>
										alert('Added Successfully');
										</script>";		
										$theMsg = isset($theMsg) ? $theMsg : '';				
									redirectHome($theMsg);
						}
                    }else{
                        echo "<div class='container'>";
                            $theMsg = "<div class= 'alert alert-danger'> خطأ في الادخال </div>" ;
                            redirectHome($theMsg);
                        echo "</div>";
                    }
                echo"</div>";
		        // === strst of Update Page =================*
				if($_SERVER['REQUEST_METHOD'] == 'POST'){
					// Get Variabls from the Form
					$id    = $_POST['itemid'];
					$book_name  = $_POST['book_name'];
					$author  = $_POST['author'];
					$tahkek  = $_POST['tahkek'];
					$section  = $_POST['section'];
					
					$sound_fileName = $_FILES['sound_file']['name'];
					$sound_fileSize = $_FILES['sound_file']['size'];
					$sound_fileTmp  = $_FILES['sound_file']['tmp_name'];
					$sound_fileType = $_FILES['sound_file']['type'];
					$sound_fileAllowedExtension = array("mp3");
					$tmp = explode('.', $sound_fileName);
					$sound_fileExtension = end($tmp);

					$vedio_file    = $_POST['vedio_file'];

					

					//Validate The Form
					$formErrors = array();
					if (empty($book_name)) {
						$formErrors[] = '<span> لا يمكن ترك اسم الكتاب فارغا</span> <i class="fa fa-bomb" style="font-size:30px"></i>';
					}
					if (empty($author)) {
						$formErrors[] = '<span> لا يمكن ترك اسم المؤلف فارغا</span> <i class="fa fa-bomb" style="font-size:30px"></i>';
					}?>
					<div class ="container" style="direction:rtl;">	
						<div class="row">
							<div class="col-md-12">
								<div class="card card-default">
									<div class="card-header"><h3 class="card-title"><i class="fas fa-exclamation-triangle"></i>تنبيه هام </h3></div>
									<div class="card-body">
										<?php foreach ($formErrors as $error) { ?>  
											<div class="alert alert-danger alert-dismissible">
												<a type="button" class="close"  href="javascript:history.go(-1)">عودة</a>
												<h5 style="text-align: center;"><i class="icon fas fa-ban" style="margin-left:10px"></i> تحذير !!  <?php echo $error ;?> </h5>
											</div><?php 
										} ?>		
									</div>
								</div>
							</div>
						</div><?php
							//check if no error update operators
					if (empty($formErrors)){
											$sound_file = $sound_fileName;
											move_uploaded_file($sound_fileTmp , "../nsharat_uploads/avatar//" . $sound_file);
											
                  $stmt = $con->prepare("UPDATE books 
								SET 
									book_name = ?, 
									author = ?,
									tahkek = ?,
									section = ?,
								
									sound_file = ?,
									vedio_file= ?
								WHERE
									book_id = ?");
						$stmt->execute(array(
								$book_name, 
								$author, 
								$tahkek, 
								$section,
						
								$sound_file,
								$vedio_file,
								$id));
							//Echo Success Measage
								echo "<script>
									alert('تم تحديث بيانات الكتاب بنجاح');
									</script>";		
									$theMsg = isset($theMsg) ? $theMsg : '';
						redirectHome($theMsg, 'back');	
					}
				
				}else{
					echo "<div class='container'>";
						$theMsg = "<div class= 'alert alert-danger'> You Cannot Browse This Page</div>" ;
					redirectHome($theMsg);
					echo "</div>";
					echo '';
					}
			echo"</div>"; 

        }elseif($do == 'Delete'){
            if (isset($_SESSION['Edara30'])){
                $getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
                $getUser->execute(array($_SESSION['Edara30']));
                $info = $getUser->fetch();
        
               if (array_search($info['role'], ['30']) !== false) {  // شرق
                    echo "<div class ='container'>";
                    echo "<h1 class='text-center'> Delete </h1>";
                        $itemid = isset($_GET['itemid'])&& is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;
                        // Check if the Userid is numeric and  Exist in Database	
                        $check = checkItem ('clint_id', 'clints', $itemid);
                        if ($check > 0){ 
                        $stmt = $con->prepare("DELETE FROM clints WHERE clint_id = :zid ");
                        $stmt->bindParam(":zid",$itemid);
                        $stmt->execute();
                            echo "<script>
                                alert('Deleted Successfully');
                            </script>";
									 $theMsg = isset($theMsg) ? $theMsg : '';
                            redirectHome($theMsg, 'back');
                        }else{
                        echo "<div class='container'>";
                            echo "<div class= 'alert alert-danger text-center'>-------- خطأ في الادخال -------  </div>" ;
                            echo '<a href="logout.php" class="btn btn-danger">عودة للسابقة</a>';
                            //redirectHome($theMsg);
                    echo "</div>";
                    }
                }   
            }
        } ?>
	 <?php	
}else{
	header ('location: ../../login');
	exit();
}
include   $tpl . 'footer.php';
include   $tpl . 'footer-scripts.php';
ob_end_flush();