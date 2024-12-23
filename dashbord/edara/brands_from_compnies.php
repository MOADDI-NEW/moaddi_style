<?php
ob_start();
session_start();
$noNavbar = '';
$main_header_edara = '';
$main_sidebar_edara = '';

if (isset($_SESSION['Edara30'])){
    $pageTitle = 'شركات مرشحة مجموعة منتجات ';  // this function to load page title
    include 'init.php';   //  Dirctory page


	$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
	$getUser->execute(array($_SESSION['Edara30']));
	$info = $getUser->fetch();
    
    include 'breadcrumb.php';
	if (array_search($info['role'], ['30']) !== false) { //   ادارة الجيم 
      $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';  // shor if 
      if($do == 'Manage'){  //==== Manage Page == 
			if (array_search($info['GroupID'], ['1','3']) !== false) {	   // مدير + مساعد
				$stmt = $con->prepare("SELECT c.*, u.UserID, u.Username, u.FullName, u.country, u.phone, u.role, u.RegStatus
                                          FROM my_brnds c
                                          JOIN users u ON u.UserID = c.Member_ID
                                          WHERE u.role = 44 AND u.RegStatus = 1 ORDER BY u.UserID DESC");
				$stmt->execute();
				$rows = $stmt->fetchAll();
				if (! empty($rows)){ ?>
					<div class="container-fluid">
						<div class="row row-sm">
							<div class="col-lg-12">
								<div class="card">
									<div class="card-header"><h3 class="card-title text-center">  شركات مرشحة منتجاتها </h3></div>
									<div class="card-body">
										<div class="table-responsive export-table">
											<table id="example" class="table table-bordered table-striped" style= "width:98%; direction:rtl;">
											<thead>
												<tr>
													<th> #</th>
													<th class="bg-warning" > الشركة </th>
													<th class="bg-warning" > مجال العمل </th>
													<th class="bg-warning" >  الهاتف </th>
													<th class="bg-warning" >  الدولة </th>
													
													<th class="bg-info" >  مرشحة من خلال </th>
													<th class="bg-info" >    رقم المسوق </th>
													<th class="bg-info" >     اسم المسوق </th>

													<th>  طباعة </th>
													<th>  الموافقة  </th>
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
															echo "<td>" . $row['phone'] . "</td>";
															echo "<td>" . $row['Country'] . "</td>";

															echo "<td>" . $row['come_from'] . "</td>";
															echo "<td>";  if (empty($row['markter_n'])) { echo '--'; }else{ echo $row['markter_n']; } echo "</td>";
															echo "<td>"; 
																$stmt = $con->prepare("SELECT * FROM users WHERE role = 45 AND RegStatus = 1 ORDER BY UserID DESC");
																$stmt->execute();
																$items = $stmt->fetchAll();
																foreach($items as $item){
																	if ($item['Username'] == $row['markter_n']) {
																		echo $item['FullName'];
																	}
																}
															echo "</td>";
														
															
															echo "<td data-label='التحكم' style='text-align:center;'>";
																if (array_search($info['GroupID'], ['1']) !== false) { // المدير
																		echo"<a href='brands_from_compnies?memberid=315&formerror=form&action=employee&emplyeeid=3265&action=grtstat&grtstat=359&formerror=9853&getid=63524&iteimid=32145&checksum=56821&cookie=30121&do=Print&userid=" . $row['Item_ID'] ."&counksum=93214&action=421' class=''><i class='fas fa-print pl-2' style='text-decoration: none;color:#0c0ff3;font-size:15px;'></i>  </a>";
																		echo "<a href='brands_from_compnies?do=Delete&userid=" . $row['Item_ID'] . "' class='deleteEmployee' title=\" حذف\"  ><i class='far fa-trash-alt' style='text-decoration: none;color: crimson;padding: 5px;'></i> </a>";
																}
															echo "</td>";
															echo "<td data-label='التحكم' style='text-align:center;'>";
																if (array_search($info['GroupID'], ['1']) !== false) { // المدير
                                                   if ($row['Approve'] == 0 ) {
                                                    	echo"<a href='brands_from_compnies?memberid=315&formerror=form&action=employee&emplyeeid=3265&action=grtstat&grtstat=359&formerror=9853&getid=63524&iteimid=32145&checksum=56821&cookie=30121&do=Approve&userid=" . $row['Item_ID'] ."&counksum=93214&action=421' class=''> موافقة </a>   ";
                                                   } else{
                                                      echo "تمت الموافقة";
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
					}else{ echo '<div class="container">'. '<div class="nice-message"> لا يوجد شركات للعرض</div>'; echo '</div>';  } 
			}
                
		

		}elseif($do == 'Print'){   // === START Edit Page =====================
			$userid = isset($_GET['userid'])&& is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
					// Check if the Userid is numeric and  Exist in Database	
			$stmt = $con->prepare("SELECT c.*, u.UserID, u.FullName, u.country As mark_country, u.phone AS mark_phone, u.role, u.RegStatus, u.user_avatar
                                          FROM my_brnds c
                                          JOIN users u ON u.UserID = c.Member_ID
                                           WHERE c.Item_ID = ?  LIMIT 1");
			$stmt->execute(array($userid));
			$row = $stmt->fetch();
			$count = $stmt->rowCount();
			if ($stmt->rowCount() > 0 ){ ?>
					
					<script type="text/javascript">function printDiv(n){var e=document.getElementById(n).innerHTML,t=document.body.innerHTML;document.body.innerHTML="<html><head><title></title></head><body>"+e+"</body>",window.print(),document.body.innerHTML=t}</script>
					<div id="printablediv"> <!--  Start div to print  -->
						<div class="container-fluid" style="direction:ltr !important;">
							<div class="form-style-10 px-2 py-2" style="background:repeating-linear-gradient(#f8efde38,#f8efde0d 20px,#f8efde00 20px,#e5d0a2 22px ); border: 10px dotted rgb(0 0 0 / 18%);">
									
									<div class="row">
										
										<div class="col-12">
										<div class="section"> Companiey with branding </div>
											<div class="card card-widget widget-user-2">
												<div class="widget-user-header bg-warning">
													<div class="widget-user-image">
														<img class="img-circle elevation-2" src="../admin/nsharat_uploads/user_avatar/<?php echo $row['user_avatar'];?>" alt="User Avatar" >
													</div>
													<h3 class="widget-user-username"><?php echo $row['FullName'];?></h3>
													<h5 class="widget-user-desc"><?php  
                                          if ($row['role'] == 44 ){echo "Brand companies & Factories"; } if ($row['role'] == 45 ){echo "Advertising & Marketing"; } ?>
                                          - <?php echo $row['mark_country'];?> - <?php echo $row['mark_phone'];?>
                                       </h5>
												</div>
												<div class="card-footer p-0">
													<ul class="nav flex-column">
														<li class="nav-item">
														<a href="#" class="nav-link">
														<?php echo $row['Company_name'];?> <span class="float-right badge bg-light"> Company Name</span>
														</a>
														</li>
														<li class="nav-item">
														<a href="#" class="nav-link">
														<?php echo $row['company_activity'];?> <span class="float-right badge bg-light">company activity</span>
														</a>
														</li>
														<li class="nav-item">
														<a href="#" class="nav-link">
														<?php echo $row['Country'];?> <span class="float-right badge bg-light">company Country</span>
														</a>
														</li>
														<li class="nav-item">
														<a href="#" class="nav-link">
														<?php echo $row['al_city'];?> <span class="float-right badge bg-light">company City</span>
														</a>
														</li>
														<li class="nav-item">
														<a href="#" class="nav-link">
														<?php echo $row['Email'];?> <span class="float-right badge bg-light">company Email</span>
														</a>
														</li>
														<li class="nav-item">
														<a href="#" class="nav-link">
														<?php echo $row['phone'];?> <span class="float-right badge bg-light">Company phone</span>
														</a>
														</li>
														<li class="nav-item">
														<a href="#" class="nav-link">
														<?php echo $row['website'];?> <span class="float-right badge bg-light">Company website</span>
														</a>
														</li>
                                          <li class="nav-item">
														<a href="#" class="nav-link">
														<?php echo $row['Communication_officer_name'];?> <span class="float-right badge bg-light"> Communication officer name</span>
														</a>
														</li>
                                          <li class="nav-item">
														<a href="#" class="nav-link">
														<?php echo $row['communication_phone'];?> <span class="float-right badge bg-light"> Communication officer Phone</span>
														</a>
														</li>
                                          <li class="nav-item">
														<a href="#" class="nav-link">
														<?php echo $row['Communication_officer_Email'];?> <span class="float-right badge bg-light"> Communication officer Email</span>
														</a>
														</li>
                                         
													</ul>
												</div>
                                    <div class="row d-flex justify-content-center">
                                       <?php 
                                        $images = explode(',', $row['products_img2']); // Split the image string into an array
                                        foreach ($images as $image) { ?>
                                        <div class="col-3">
                                          <?php echo '<img src="../admin/nsharat_uploads/products_img2/' . trim($image) . '" alt="Product Image" class="img-rounded img-thumbnail" style="width:150px;">'; ?>
                                        </div><?php
                                           
                                        }?>
                                    </div>

											</div>
										</div>
									</div>
									<style>@media print { .no-print, .no-print * { display: none !important; } }</style><br>
									<div class="no-print">
										<div class="button-section mt-4">
											<input type="button" value="الطباعة" class="btn btn-primary btn-lg" onclick="javascript:printDiv('printablediv')" />
										</div>
									</div>
							</div>
						</div>
					</div>
					<?php
			}else{
				echo "<div class='container'>";
					echo "<div class= 'alert alert-danger text-center'>-------- خطأ في الادخال -------  </div>" ; echo '<a href="logout" class="btn btn-danger">عودة للسابقة</a>';
					$theMsg = isset($theMsg) ? $theMsg : '';
					redirectHome($theMsg);
				echo "</div>";
			}
		}elseif($do == 'Delete'){ // Delete members page==========
			if (array_search($info['GroupID'], ['1']) !== false) {	  
					echo "<h1 class='text-center'> حذف ترشيح </h1>";
					echo "<div class ='container'>";
						$userid = isset($_GET['userid'])&& is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
						// Check if the Userid is numeric and  Exist in Database	
						$check = checkItem ('Item_ID', 'my_brnds', $userid);
						if ($check > 0){ 
							$stmt = $con->prepare("DELETE FROM my_brnds WHERE Item_ID = :zuser");
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
		}elseif($do == 'Approve'){
			$userid = isset($_GET['userid'])&& is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
			// Check if the Userid is numeric and  Exist in Database	
					$check = checkItem ('Item_ID', 'my_brnds', $userid);
					if ($check > 0){ 
						$stmt = $con->prepare("UPDATE my_brnds SET Approve = 1 WHERE Item_ID = ?");
						$stmt->execute(array($userid));
						if ($stmt) { // if it's true
							sleep(1);?>
							<script src="../layout/dist/js/sweetalert2.min.js"></script>
							<script>
									Swal.fire({
										title: ' تمت الموافقة على  الشركة بنجاح',
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