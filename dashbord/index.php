<?php
ob_start();
session_start();
$noNavbar = '';  // No Navbar in this page
$pageTitle = 'تسجيل دخول ';  // this function to load page title

if (isset($_SESSION['user'])) {
	header('location: school/');  // Redirct to index.php
}
include 'login_init.php';

$settings = getSettingsToHomePage($con); 

//  =============================================== SCHOOL ROLE =========================================== //
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (isset($_POST['login'])) {
		$user = $_POST['username'];
		$pass = $_POST['password'];
		$hashedPass = sha1($pass);
		$role = null;
		// Check if the User Exist in Database	
		$stmt = $con->prepare("SELECT UserID, Username, Password FROM users
									WHERE   Username = ? AND Password = ? AND role = 44  LIMIT 1");
		$stmt->execute(array($user, $hashedPass));
		$get = $stmt->fetch();
		$count = $stmt->rowCount();
		// if count > 0 this mean the Database contain RECORD about Username 
		if ($count > 0) {
			$_SESSION['user'] = $user; // Register Session Name
			$_SESSION['uid'] = $get['UserID']; // Register Session User_ID
			header('location: school/');  // Redirct to dashboard
			exit();
		} else {
			header('location: error_login');  // Redirct to dashboard
		}
	}
}
//  =============================================== EDARA ROLE =========================================== //
if (isset($_SESSION['Edara30'])) {
	header('location: edara/');  // Redirct to dashboard
}
// Check If User Coming from HTTP Post Reqest ==========  shrk-kferelshekh ==================
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (isset($_POST['login'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$hashedPass = sha1($password);
		$role = null;
		// Check if the User Exist in Database	
		$stmt = $con->prepare("SELECT UserID, Username, Password, FullName FROM  users 
									WHERE Username = ? AND Password = ? 
									AND role between 30 and 42 LIMIT 1");
		$stmt->execute(array($username, $hashedPass));
		$row = $stmt->fetch();
		$count = $stmt->rowCount();
		// if count > 0 this mean the Database contain RECORD about Username 
		if ($count > 0) {
			$_SESSION['Edara30'] = $username; // Register Session Name
			$_SESSION['ID'] = $row['UserID'];  // Register Session ID
			header('location: edara/');  // Redirct to dashboard
			exit();
		} else {
			header('location: error_login');  // Redirct to dashboard
		}
	}
}
//  =============================================== ADMIN ROLE =========================================== //
?>




















<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'><meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="Description" content="<?php echo $settings[1]; ?>"><meta name="Author" content="Alaa Amer"><meta name="Keywords" content="سمارت جيم" />
	<!-- <meta http-equiv="refresh" content="0; URL=underconstruction" /> -->
	<title>  LOG IN - <?php echo $settings[0]; ?>   </title>
	<link rel="icon" href="../layout/img/favicon.png" type="image/x-icon" />
	<link rel="stylesheet" href="layout/plugins/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="layout/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<link rel="stylesheet" href="layout/dist/css/adminlte.min.css">
	<link rel="stylesheet" href="layout/dist/css/new_style.css">
</head>

<body class="hold-transition login-page area" >
	<ul class="circles"><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li></ul>
	<div class="login-box">
		<div class="card" style="margin-top:80px;box-shadow:7px 10px 16px -1px rgb(66 113 138 / 97%);">
			<div class="card-body login-card-body">
				<div class="login-logo d-flex justify-content-between" style="padding: 10px 5px;">
					<div class="input-group-append"><a href="../"><div class="input-group-text"><span class="fas fa-home"></span></div></a></div>
					<div class="input-group-append"><a href="../"><div class="input-group-text">  Moaddi  </div></a></div>
					<div class="input-group-append"><a href="signup"><div class="input-group-text"><span class="fas fa-user"></span></div></a></div>
				</div>
				<p class="login-box-msg text-primary"> LOG IN  </p>
				<form action="#" method="POST">
					<div class="input-group mb-3">
						<input class="form-control" type="text" name="username" placeholder="User Name" autocomplete="off">
						<div class="input-group-append"><div class="input-group-text"><span class="fas fa-envelope"></span></div></div>
					</div>
					<div class="input-group mb-3">
						<input class="form-control" type="password" name="password" placeholder="Password" autocomplete="new-password">
						<div class="input-group-append"><div class="input-group-text"><span class="fas fa-lock"></span></div></div>
					</div>
					<div class="row mt-3 mb-5">
						<div class="col">
							<input type="submit" name="login" class="btn btn-primary btn-block" value="LOG IN" />
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<a href="signup" class="btn btn-info btn-block"> New registration </a>
			</div>
		</div>
	</div>

	<div class="footer">
		Developed by <abbr title="برمجة علاء عامر "> <a href="https://api.whatsapp.com/send?phone=201014714795&amp;" target="_balnk"> Alaa Amer</a> </abbr>
	</div>
	<script src="layout/plugins/jquery/jquery.min.js"></script>
	<script src="layout/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<?php
ob_end_flush();
?>
</body>
</html>