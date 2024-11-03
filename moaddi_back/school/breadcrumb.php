<?php
if (isset($_SESSION['user'])) {
	$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
	$getUser->execute(array($sessionUseer));
	$info = $getUser->fetch(); ?>
	<div class="content-wrapper">
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-md-12">
						<div class="card card-widget widget-user">
							<div class="widget-user-header bg-navy">
								<h3 class="widget-user-username"><?php echo $info['FullName']; ?></h3>
								
							</div>
							<div class="widget-user-image"><img class="img-circle elevation-2" src="../../layout/img/logo128.jpg" alt="depolm logo hefzmoyaser"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php
} ?>
	<section class="content">