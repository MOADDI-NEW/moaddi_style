<?php
ob_start();
session_start();
$noNavbar = '';
$main_header_edara = '';
$main_sidebar_edara = '';
$pageTitle = 'معرض الصور';
	if (isset($_SESSION['Edara30'])){
   	include 'init.php'; ?>
      <div class="main-content app-content"> 
      	<?php include 'breadcrumb.php';
         $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';  // shor if 
         if($do == 'Manage'){  //==== Manage Page == 
            if (isset($_SESSION['Edara30'])){
					$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
					$getUser->execute(array($_SESSION['Edara30']));
					$info = $getUser->fetch();

					if (array_search($info['GroupID'], ['1']) !== false) {
						$stmt = $con->prepare("SELECT * FROM gallery  ORDER BY gallery_id DESC");
						$stmt->execute();
						$items = $stmt->fetchAll();
						if (! empty($items)){?>
						<div class="container-fluid">
								<div class="row row-sm"> 
									<div class="col-lg-12">
										<div class="card"><?php
											if (array_search($info['role'], ['30']) !== false) {    
												echo '<a href="gallery?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i> اضافة صورة جديدة  </a>';
											} ?>
											<div class="card-header"><h3 class="card-title text-center">  معرض الصور  </h3></div>
											<div class="card-body">
												<div class="table-responsive export-table">
													<table id="" class="table table-bordered table-striped" style= "width:98%; direction:rtl;">
															<thead>
																<tr>
																	<th> # </th>
																	<th> gallery Name</th>
																	<th> gallery Image</th>
																	<th> Control </th>
																</tr>
															</thead>
															<tbody>
																<?php
																	$i = 0;
																foreach($items as $item){
																	$i++;
																echo "<tr>";
																	echo "<td>" . $i . "</td>";
																	echo "<td>" . $item['gallery_name'] . "</td>";
																	echo "<td><img src='../admin/nsharat_uploads/gallery/" . $item['avatar7'] . "' alt='' style='width:30px;' /></td>";
																	echo "<td data-label='التحكم' style='text-align:center;'>";
																				if (isset($_SESSION['Edara30'])){
																					$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
																					$getUser->execute(array($_SESSION['Edara30']));
																					$info = $getUser->fetch();
																					if (array_search($info['GroupID'], ['1']) !== false) {   
																							echo "<a href='gallery?do=Delete&itemid=" . $item['gallery_id'] . "' class=''title=\"click for delete\" onclick=\"return confirm('Are You Sure to Delete ?')\" ><i class='far fa-trash-alt' style='text-decoration: none;color: crimson;padding: 5px;'></i> </a>";
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
										echo '<div class="nice-message">  لا يوجد صور للعرض </div>';
										echo '<a href="gallery?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i>  اضافة صورة جديدة </a>';
								echo '</div>';
						}
					}
            }
      	}elseif($do == 'Add'){ ?>
				<div class="container-fluid">
					<div class="row row-sm">
						<div class="col-lg-12">
								<div class="card">
									<div class="card-header"><h3 class="card-title text-center"> اضافة صورة جديدة </h3></div>
									<div class="card-body">
										<form  action="?do=Insert" method="POST" enctype="multipart/form-data" dir="ltr">
											<div class="row">
												<div class="col-md-12 col-sm-12">
													<label> اسم الصورة </label>
													<input type="text" class="form-control form-control-sm"  name="gallery_name"  placeholder="اسم الصورة"/>
												</div>
												<div class="col-md-6 col-sm-6">
														<label>  ملف الصورة </label>
														<input type="file" name="avatar7"  class="form-control form-control-sm"  required="required"  />
												</div>
											</div>
											<br><br>
											<div class="button-section">
												<input type="submit" value="اضافة جديد" class="btn btn-primary btn-lg" />
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
					$gallery_name  = $_POST['gallery_name'];
					
					//$avatar    = $_POST['avatar'];
					$avatarName = $_FILES['avatar7']['name'];
					$avatarSize = $_FILES['avatar7']['size'];
					$avatarTmp  = $_FILES['avatar7']['tmp_name'];
					$avatarType = $_FILES['avatar7']['type'];
					$avatarAllowedExtension = array("jpeg", "jpg", "png", "gif");
					$tmp = explode('.', $avatarName);
					$avatarExtension = end($tmp);

                    //Validate The Form
					$formErrors = array();
						if (empty($gallery_name)) {
								$formErrors[] = '<span> لا يمكن ترك اسم الصورة فارغا</span> <i class="fa fa-bomb" style="font-size:30px"></i>';
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
								$avatar = $avatarName;
								move_uploaded_file($avatarTmp , "../admin/nsharat_uploads/gallery//" . $avatar);

                                    // Inser Info to database *** مهم *** 
                        $stmt = $con->prepare("INSERT INTO  gallery
												(gallery_name, 
												avatar7)
									VALUES
												(:zgallery_name, 
												:zavatar7)");
								$stmt->execute(array(
												'zgallery_name'  => $gallery_name,          
												'zavatar7'  => $avatar ));
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
                        $check = checkItem ('gallery_id', 'gallery', $itemid);
                        if ($check > 0){ 
                        $stmt = $con->prepare("DELETE FROM gallery WHERE gallery_id = :zid ");
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
    </div>	 <?php	
}else{
	header ('location: ../../login');
	exit();
}
include   $tpl . 'footer.php';
include   $tpl . 'footer-scripts.php';
ob_end_flush();
