<?php
if (isset($_SESSION['Edara30'])) {
	$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
	$getUser->execute(array($_SESSION['Edara30']));
	$info = $getUser->fetch(); 
	
	//$settings = getSettingsToHomePage($con); 
	?>


	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-md-12">
						<div class="card card-widget widget-user">
							<div class="widget-user-header bg-navy">
								<h3 class="widget-user-username"><?php echo $info['FullName']; ?></h3>
								<h5 class="widget-user-desc text-warning">
								<span> Moaddi   </span>
								</h5>
							</div>
							<div class="widget-user-image">
								<img class="img-circle elevation-2" src="../../assets/images/about/img-1.jpg" alt="depolm logo hefzmoyaser">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
		<!-- /.content-header -->
		<section class="content">
