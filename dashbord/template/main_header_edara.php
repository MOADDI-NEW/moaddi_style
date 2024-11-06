<?php
if (isset($_SESSION['Edara30'])) {
	$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
	$getUser->execute(array($_SESSION['Edara30']));
	$info = $getUser->fetch();
?>
	<!-- Navbar -->
	<nav class="main-header navbar navbar-expand navbar-navy navbar-light">
		<!-- Left navbar links -->
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link text-white" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
			</li>
			<li class="nav-item d-none d-sm-inline-block">
				<a href="index" class="nav-link text-white">الرئيسية</a>
			</li>
			<li class="nav-item d-none d-sm-inline-block">
				<a href="logout" class="nav-link text-white">خروج</a>
			</li>
		</ul>

		<!-- Right navbar links -->
		
	</nav>
	<!-- /.navbar -->
<?php
}
?>