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

		<!-- SEARCH FORM -->
		<?php if (array_search($info['GroupID'], ['1', '3']) !== false) {	 ?>
			<form class="form-inline ml-3"  method="post" action="marks_searsh">
				<div class="input-group input-group-sm">
					<input class="form-control form-control-navbar" name="search" type="search"  placeholder="البحث عن مشترك .."  aria-label="Search">
					<div class="input-group-append">
						<button class="btn btn-navbar" type="submit">
							<i class="fas fa-search"></i>
						</button>
					</div>
				</div>
			</form>
		<?php }?>

		<!-- Right navbar links -->
		
	</nav>
	<!-- /.navbar -->
<?php
}
?>