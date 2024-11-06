<?php
if (isset($_SESSION['user'])) {
	$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
	$getUser->execute(array($sessionUseer));
	$info = $getUser->fetch(); ?>

	<!-- Main Sidebar Container -->
	<aside class="main-sidebar sidebar-dark-primary elevation-4">
		<!-- Brand Logo -->
		<a href="./" class="brand-link navbar-white">
			<img src="../layout/dist/img/AdminLTELogo.png" alt="kfsedu Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
			<span class="brand-text font-weight-light text-wite"> Moaddi  </span>
		</a>
		<!-- Sidebar -->
		<div class="sidebar navbar-white">
			<div class="user-panel mt-3 pb-3 mb-3 d-flex">
				<div class="image">
					<img src="../../assets/images/about/img-1.jpg" class="img-circle elevation-2" alt="User Image">
				</div>
				<div class="info">
					<a href="index" class="d-block text-dark text-center"><?php echo $info['FullName']; ?></a>
					<a href="logout" class="d-block text-dark text-center mt-4"><small class="p-2 bg-navy">Log out </small></a>
				</div>
			</div><?php 
			if (array_search($info['RegStatus'], ['1']) !== false) { // مسجل بالدبلوم ?>
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<li class="nav-item">
						<a href="index"class="nav-link text-dark">
						<i class="nav-icon fas fa-th"></i>
							<p>  Home Page </p>
						</a>
					</li>
					<li class="nav-header text-dark">Elements</li>
					<li class="nav-item">
						<a href="school_basic" class="nav-link text-dark"><i class="nav-icon fas fa-th"></i>
							<p> My profile  <span class="right badge badge-danger">Edit</span></p>
						</a>
					</li>
					<li class="nav-item">
						<a href="web_rate"  class="nav-link text-dark">
						<i class="nav-icon fas fa-table"></i>
							<p>  Rate our services </p>
						</a>
					</li>
					
				</ul>
			</nav><?php
			} ?>

		</div>
	</aside>
<?php
}
?>