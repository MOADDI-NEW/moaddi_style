<?php
include("../admin/connect.php");
// code user Email availablity
	if(!empty($_POST["em_01_01"])) {
		$em_01_01= $_POST["em_01_01"];
			//Validate The Form
				$formErrors = array();
				if (empty($em_01_01)) {
					$formErrors[] = '<span> لا يمكن ترك الرقم القومي فارغا</span> ';
				}
				if (strlen($em_01_01) < 14) {
					$formErrors[] = '<i class="fa fa-bomb" style="font-size:20px"></i> <span> خطأ في ادخال الرقم القومي </span>';
					echo "<script>$('#submit').prop('disabled',true);</script>";
				}
				if (strlen($em_01_01) > 14) {
					$formErrors[] = '<i class="fa fa-bomb" style="font-size:20px"></i> <span> خطأ في ادخال الرقم القومي </span>';
					echo "<script>$('#submit').prop('disabled',true);</script>";
				}
					if ( !ctype_digit($em_01_01)) { 
					$formErrors[] = '<i class="fa fa-bomb" style="font-size:20px"></i> <span> ادخال حروف او رموز غير معروفة </span>';
					echo "<script>$('#submit').prop('disabled',true);</script>";
					}
				foreach ($formErrors as $error) {
					echo '<div class="container">';
						echo '<div class="row">';
							echo '<div class="col-md-12">';
								echo '<div class="alert alert-danger">' . $error . '</div>' ;
							echo '</div>';	 
						echo '</div>';
					echo '</div>';
				}   
				if(empty($formErrors)){							   
							$sql ="SELECT em_01_01 FROM employee WHERE em_01_01=:em_01_01";
							$query= $con -> prepare($sql);
							$query-> bindParam(':em_01_01', $em_01_01, PDO::PARAM_INT);
							$query-> execute();
							$results = $query -> fetchAll(PDO::FETCH_OBJ);
							$cnt=1;
							if($query -> rowCount() > 0)
							{
								echo '<div class="alert alert-danger" role="alert">';
									echo "<span style=''> خطأ بالرقم القومي :: الرقم القومي  مسجل من قبل</span>";
								echo '</div>';
									
								echo "<script>$('#submit').prop('disabled',true);</script>";
							} else{
								echo '<div class="alert alert-success" role="alert">';
									echo '<span style="font-size: large;color: #483838;"> هذا الرقم القومي متاح للتسجيل </span>';
								echo '</div>';
								echo "<script>$('#submit').prop('disabled',false);</script>";
							}
					}
		}