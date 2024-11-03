<?php
ob_start();
session_start();
$noNavbar = '';  // No Navbar in this page
$pageTitle = 'تسجيل طلب اشتراك بالجيم';  // this function to load page title

if (isset($_SESSION['user'])) {
	header('location: index');  // Redirct to index
}
include 'login_init.php';

 $settings = getSettingsToHomePage($con); 
// Check If User Coming from HTTP Post Reqest
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (isset($_POST['login'])) {
		$user = $_POST['username'];
		$pass = $_POST['password'];
		$hashedPass = sha1($pass);
		$role = $_POST['role'];
		// Check if the User Exist in Database	
		$stmt = $con->prepare("SELECT UserID, Username, Password FROM users WHERE Username = ? AND Password = ? AND role = 44 AND RegStatus = 1");
		$stmt->execute(array($user, $hashedPass));
		$get = $stmt->fetch();
		$count = $stmt->rowCount();
		// if count > 0 this mean the Database contain RECORD about Username 
		if ($count > 0) {
			$_SESSION['user'] = $user; // Register Session Name
			$_SESSION['uid'] = $get['UserID']; // Register Session User_ID

			header('location: school.php');  // Redirct to dashboard
			exit();
		}
	} else {
		$formErrors = array();
		$username  = $_POST['username'];
		$password  = $_POST['password'];
		$password2 = $_POST['password2'];
		$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

		$name = htmlspecialchars($_POST['full']);
		$phone  = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
		$al_city  = $_POST['al_city'];
		$job_title  = $_POST['job_title'];
		$birthdate  = $_POST['birthdate'];

		$user_avatarName = $_FILES['user_avatar']['name'];
		$user_avatarSize = $_FILES['user_avatar']['size'];
		$user_avatarTmp  = $_FILES['user_avatar']['tmp_name'];
		$user_avatarType = $_FILES['user_avatar']['type'];
		$user_avatarAllowedExtension = array("jpeg", "jpg", "png", "gif");
		$tmp = explode('.', $user_avatarName);
		$user_avatarExtension = end($tmp);

		$department  = filter_var($_POST['department'], FILTER_SANITIZE_NUMBER_INT);
		$role  = filter_var($_POST['role'], FILTER_SANITIZE_NUMBER_INT);


		if (isset($username)) {
			$filterdUser = filter_var($username, FILTER_SANITIZE_STRING);
			if (strlen($filterdUser) < 3) {
				$formErrors[] = "<div id='success-alert' class='alert alert-danger'> اسم المستحدم يجب ان يكون اكثر من 3 حروف</div>";
			}
			if (strlen($filterdUser) > 20) {
				$formErrors[] = "<div id='success-alert' class='alert alert-danger'> اسم المستحدم يجب ان يكون اقل من 20 حروف</div>";
			}
		}
		if (isset($password) && isset($password2)) {
			if (empty($password)) {
				$formErrors[] = "<div id='success-alert' class='alert alert-danger'> لا يمكن ترك كلمة المرور فارغة</div>";
			}
			$pass1 = sha1($_POST['password']);
			$pass2 = sha1($_POST['password2']);
			if ($pass1 !== $pass2) {
				$formErrors[] = "<div id='success-alert' class='alert alert-danger'> كلمة المرور غير متطابقة</div>";
			}
		}
		if (isset($email)) {
			$filterdEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
			if (filter_var($filterdEmail, FILTER_VALIDATE_EMAIL) != true) {
				$formErrors[] = "<div id='success-alert' class='alert alert-danger'> بريد الكتروني غير صالح</div>";
			}
		}
		
		if (isset($phone)) {
			$filterdPhone = filter_var($phone, FILTER_SANITIZE_STRING);
			if (empty($phone)) {
				$formErrors[] = "<div id='success-alert' class='alert alert-danger'> لا يمكن ترك رقم الهاتف</div>";
			}
		}
		if (isset($user_avatarName)) {
			if (! empty($user_avatarName) && ! in_array($user_avatarExtension, $user_avatarAllowedExtension)){
				$formErrors[] = "<div id='success-alert' class='alert alert-danger'> امتداد الصورة عير مسموح به</div>";
			}
			if (empty($user_avatarName)) {
					$formErrors[] = "<div id='success-alert' class='alert alert-danger'> يجب اختيار صور شخصية</div>";
			}
			if ($user_avatarSize > 2621440) {
					$formErrors[] = "<div id='success-alert' class='alert alert-danger'> حجم الصورة يجب ان يكون اقل من 2.5 ميجا بايت</div>";
			}
		}

		if (empty($formErrors)) {
								$user_avatar = rand(0, 1000000000)	. '_' . $user_avatarName;
                        move_uploaded_file($user_avatarTmp , "admin/nsharat_uploads/user_avatar//" . $user_avatar);

			$check = checkItem("Username", "users", $username);
			if ($check == 1) {
				$formErrors[] = "<div class='alert alert-danger'> اسم المستخدم موجود مسبقا</div>";
			} else {
				$stmt = $con->prepare("INSERT INTO users
										(Username, Password, Email, user_avatar,
										FullName,  phone, al_city, job_title, birthdate, department, role, 
										RegStatus, Date)
									VALUES(:zuser, :zpass, :zmail, :zuser_avatar,
											:zname, :zphone, :zal_city, :zjob_title, :zbirthdate, :zdepartment, :zrole,  
											0, now())");
				$stmt->execute(array(

					'zuser'  => $username,
					'zpass'  => sha1($password),
					'zmail' => $email,
					'zuser_avatar' => $user_avatar,
					'zname' => $name,
					'zphone' => $phone,
					'zal_city' => $al_city,
					'zjob_title' => $job_title,
					'zbirthdate' => $birthdate,
					'zdepartment' => $department,
					'zrole' => $role
				));
				//Echo Success Measage
				$succesMsg = 'تم تسجيل بياناتك بنجاح  <br> جاري مراجعة بياناتك  ... برجاء الانتظار لحين قبول الطلب من قبل الإدارة';
				header('Refresh: 5; URL=index');
			}
		}
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8"><meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'><meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>  طلب اشتراك  - <?php echo $settings[0]; ?> </title>
  	<meta content="<?php echo $settings[1]; ?>" name="description">
	<meta name="Author" content="Alaa Amer">
	<meta name="Keywords" content="سمارت جيم" />
	<!-- <meta http-equiv="refresh" content="0; URL=underconstruction" /> -->
	<link rel="icon" href="../assets/img/favicon.png" type="image/x-icon" />
	<link rel="stylesheet" href="layout/plugins/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="layout/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<link rel="stylesheet" href="layout/dist/css/adminlte.min.css">
	<link rel="stylesheet" href="layout/dist/css/new_style.css">
</head>

<body class="hold-transition register-page area">
	<ul class="circles"><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li></ul>
		<div class="container">
			<div class="row d-flex justify-content-center">
				<?php
				if (!empty($formErrors)) {
					foreach ($formErrors as $error) {
						echo '<div class="col text-center">';
						echo '<a href="signup" class="btn btn-warning btn-sm btn-block">' . 'عودة' . $error . '</a>';
						echo '</div>';
					}
				}
				if (isset($succesMsg)) {
					echo  "<div  class= 'alert alert-success'>" . '<a href="index" class="btn btn-success btn-sm btn-block">' . $succesMsg . '</a>' . "</div>";
				}?>
			</div>
		</div>
	<div class="register-box">
		<div class="card">
			<div class="card-body register-card-body">
				<div class="login-logo d-flex justify-content-between" style="padding: 10px 5px;">
					<div class="input-group-append"><a href="../"><div class="input-group-text"><span class="fas fa-home"></span></div></a></div>
					<div class="input-group-append"><a href="../"><div class="input-group-text"> عائلة الحلواني </div></a></div>
					<div class="input-group-append"><a href="./"><div class="input-group-text"><span class="fas fa-user"></span></div></a></div>
				</div>
				<p class="login-box-msg text-primary">طلب اشتراك </p>
				<form action="#" method="POST" enctype="multipart/form-data">
					<label style="font-family: 'Changa', sans-serif;color:#0162e8;float: right;"> المستخدم والمرور </label>
					<div class="input-group mb-3">
						<input class="form-control" type="text" name="username" id="username" autocomplete="off"  style="padding:0px;font-size:small;text-align:right;" placeholder="اسم المستخدم" required="required" onBlur="checkUsernameAvailability()"  value="<?php echo 'user'.(rand(100,999));?>"/>
							<script>
								function checkUsernameAvailability() {
									$("#loaderIcon").show();
									jQuery.ajax({
										url: "check_availability",
										data: 'Username=' + $("#username").val(),
										type: "POST",
										success: function(data) {
											$("#username-availability-status").html(data);
											$("#loaderIcon").hide();
										},
										error: function() {}
									});
								}
							</script>
						<div class="input-group-append"><div class="input-group-text"><span class="fas fa-user"></span></div></div>
					</div>
					<center> <span id="username-availability-status" style="font-size:12px;"></span> </center>
					<div class="input-group mb-3">
						<input minlength="4" class="form-control" type="password" name="password" autocomplete="new-password" style="padding:0px;font-size:small;text-align:right;" placeholder="اكتب كلمة السر" required="required" />
						<div class="input-group-append"><div class="input-group-text"><span class="fas fa-lock"></span></div></div>
					</div>
					<div class="input-group mb-3">
						<input minlength="4" class="form-control" type="password" name="password2" autocomplete="new-password" style="padding:0px;font-size:small;text-align:right;" placeholder="تأكيد كلمة السر" required="required" />
						<div class="input-group-append"><div class="input-group-text"><span class="fas fa-lock"></span></div></div>
					</div>
					<div class="form-group mb-3">
						<label style="font-family: 'Changa', sans-serif;color:#0162e8;float: right;">البيانات الأساسية</label>
						<input class="form-control" name="full" type="text" style="padding:0px;font-size:small;text-align:right;" placeholder="اسم العضو رباعي باللغة العربية" required="required" />
					</div>
					<div class="input-group mb-3">
						<input class="form-control" type="email" name="email" style="padding:0px;font-size:small;text-align:right;" placeholder="اكتب بريد الكتروني صالح" />
						<div class="input-group-append"><div class="input-group-text"><span class="fas fa-envelope"></span></div></div>
					</div>

					<div class="input-group mb-3">
						<input class="form-control" type="text" name="phone" style="padding:0px;font-size:small;text-align:right;" placeholder="رقم الهاتف" required="required"/>
						<div class="input-group-append"><div class="input-group-text"><span class="fas fa-phone"></span></div></div>
					</div>
					<div class="input-group mb-3">
						<input class="form-control" type="text" name="al_city" style="padding:0px;font-size:small;text-align:right;" placeholder="المدينة" required="required"/>
						<div class="input-group-append"><div class="input-group-text"><span class="fas fa-address-card"></span></div></div>
					</div>
					<div class="input-group mb-3">
						<input class="form-control" type="text" name="job_title" style="padding:0px;font-size:small;text-align:right;" placeholder="الوظيفة /  المهنه" required="required"/>
						<div class="input-group-append"><div class="input-group-text"><span class="fas fa-user"></span></div></div>
					</div>
					<div class="input-group mb-3">
						<input class="form-control" type="date" name="birthdate" style="padding:0px;font-size:small;text-align:right;"  required="required"/>
						<div class="input-group-append"><div class="input-group-text"><span class="fas fa-barcode"></span></div></div>
					</div>
					<label style="font-family: 'Changa', sans-serif;color:#0162e8;float: right;"> الصورة الشخصية   </label>
					<div class="input-group mb-3">
						<input class="form-control" type="file" name="user_avatar"   required="required"/>
					</div>

					
						<input type="hidden" value="10" name="department" class="form-control" />
						<input type="hidden" value="44" name="role" class="form-control" />
					<div class="row">
						<div class="col-12">
							<input type="submit" name="signup" class="btn btn-primary btn-block" value="تسجيل" />
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<a href="./" class="btn btn-info btn-block">  أمتلك حساب </a>
			</div>
		</div>
	</div>

	<!-- jQuery -->
	<script src="layout/plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="layout/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

	<style>
		* {
			font-family: 'Tajawal', sans-serif;;
		}

		.bg-primary-transparent {
			background-color: #3a5d8b !important;
		}
	</style>


	<?php
	// include 'template/footer.php';
	// include 'template/footer-scripts-login.php';
	ob_end_flush();
	?>

</body>

</html>