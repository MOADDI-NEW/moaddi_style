<?php
ob_start();
session_start();
$noNavbar = '';  // No Navbar in this page
$pageTitle = 'تسجيل طلب اشتراك ';  // this function to load page title

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

		$department  = filter_var($_POST['department'], FILTER_SANITIZE_NUMBER_INT);
		$role  = filter_var($_POST['role'], FILTER_SANITIZE_NUMBER_INT);


		if (isset($username)) {
			$filterdUser = filter_var($username, FILTER_SANITIZE_STRING);
			if (strlen($filterdUser) < 3) {
				$formErrors[] = "<div id='success-alert' class='alert alert-danger'> Username must be more than 3 characters </div>";
			}
			if (strlen($filterdUser) > 20) {
				$formErrors[] = "<div id='success-alert' class='alert alert-danger'> Username must be less than 20 characters. </div>";
			}
		}
		if (isset($password) && isset($password2)) {
			if (empty($password)) {
				$formErrors[] = "<div id='success-alert' class='alert alert-danger'> Password cannot be left blank. </div>";
			}
			$pass1 = sha1($_POST['password']);
			$pass2 = sha1($_POST['password2']);
			if ($pass1 !== $pass2) {
				$formErrors[] = "<div id='success-alert' class='alert alert-danger'> Password does not match </div>";
			}
		}
		if (isset($email)) {
			$filterdEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
			if (filter_var($filterdEmail, FILTER_VALIDATE_EMAIL) != true) {
				$formErrors[] = "<div id='success-alert' class='alert alert-danger'> Invalid email </div>";
			}
		}
		
		if (isset($role)) {
			if ($role == 0) {
					$formErrors[] = "<div id='success-alert' class='alert alert-danger'>  Choose who you re? </div>";
			}
		}

		if (empty($formErrors)) {

			$check = checkItem("Username", "users", $username);
			if ($check == 1) {
				$formErrors[] = "<div class='alert alert-danger'> اسم المستخدم موجود مسبقا</div>";
			} else {
				$stmt = $con->prepare("INSERT INTO users
										(Username, Password, Email, 
										FullName,  department, role, 
										RegStatus, Date)
									VALUES(:zuser, :zpass, :zmail, 
											:zname,  :zdepartment, :zrole,  
											0, now())");
				$stmt->execute(array(

					'zuser'  => $username,
					'zpass'  => sha1($password),
					'zmail' => $email,
					'zname' => $name,
					'zdepartment' => $department,
					'zrole' => $role
				));
				//Echo Success Measage
				$succesMsg = 'Your data has been successfully registered <br> Your data is being reviewed... Please wait until the request is accepted by the administration';
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
	<title>  New registration   - <?php echo $settings[0]; ?> </title>
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
					<div class="input-group-append"><a href="../"><div class="input-group-text"> Moaddi  </div></a></div>
					<div class="input-group-append"><a href="./"><div class="input-group-text"><span class="fas fa-user"></span></div></a></div>
				</div>
				<p class="login-box-msg text-primary"> New registration  </p>
				<form action="#" method="POST" enctype="multipart/form-data">
					<label style="font-family: 'Changa', sans-serif;color:#0162e8;">  Username & Password </label>
					<div class="input-group mb-3">
						<input class="form-control" type="text" name="username" id="username" autocomplete="off"  style="padding:0px;font-size:small;" placeholder="اسم المستخدم" required="required" onBlur="checkUsernameAvailability()"  value="<?php echo 'user'.(rand(100,999));?>"/>
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
						<input minlength="4" class="form-control" type="password" name="password" autocomplete="new-password" style="padding:0px;font-size:small;" placeholder="Password" required="required" />
						<div class="input-group-append"><div class="input-group-text"><span class="fas fa-lock"></span></div></div>
					</div>
					<div class="input-group mb-3">
						<input minlength="4" class="form-control" type="password" name="password2" autocomplete="new-password" style="padding:0px;font-size:small;" placeholder="Re-Password" required="required" />
						<div class="input-group-append"><div class="input-group-text"><span class="fas fa-lock"></span></div></div>
					</div>
					<label style="font-family: 'Changa', sans-serif;color:#0162e8;"> Basic information </label>
					<div class="input-group mb-3">
						<input class="form-control" type="text" name="full" style="padding:0px;font-size:small;" placeholder="Your Name" />
						<div class="input-group-append"><div class="input-group-text"><span class="fas fa-user"></span></div></div>
					</div>
					<div class="input-group mb-3">
						<input class="form-control" type="email" name="email" style="padding:0px;font-size:small;" placeholder="Your Email" />
						<div class="input-group-append"><div class="input-group-text"><span class="fas fa-envelope"></span></div></div>
					</div>
					<label style="font-family: 'Changa', sans-serif;color:#0162e8;">  Who you are </label>
					<div class="input-group mb-3">
						<select name="role" class="form-control">
							<option value="0">  -Select-  </option>
							<option value="44"> Brand companies & Factories </option>
							<option value="45"> Advertising & Marketing </option>
						</select>
					</div>

						<input type="hidden" value="10" name="department" class="form-control" />
					<div class="row">
						<div class="col-12">
							<input type="submit" name="signup" class="btn btn-primary btn-block" value="Registr" />
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<a href="./" class="btn btn-info btn-block">  I already have account  </a>
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