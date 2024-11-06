<?php
if (isset($_SESSION['user'])) {
	$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
	$getUser->execute(array($sessionUseer));
	$info = $getUser->fetch();
?>
	<nav class="main-header navbar navbar-expand navbar-purple navbar-light">
		<!-- Left navbar links -->
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link text-white" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
			</li>
			<li class="nav-item d-none d-sm-inline-block">
				<a href="./" class="nav-link text-white">Home</a>
			</li>
			<li class="nav-item d-none d-sm-inline-block">
				<a href="logout" class="nav-link text-white">Log out</a>
			</li>
		</ul><?php
		if (array_search($info['RegStatus'], ['1']) !== false) { // مسجل بالدبلوم  

			if ($info['role'] == 44) {  // المستوى الرابع
				$stmt = $con->prepare("SELECT * FROM items2, categories ,users 
													WHERE categories.ID = items2.Cat_ID 
													AND users.UserID = items2.Member_ID
						 							AND Cat_Group = 11 ORDER BY Item_ID DESC ");
				$stmt->execute();
				$items = $stmt->fetchAll();
				if (!empty($items)) { ?>
					<ul class="navbar-nav mr-auto-navbav">
						<li class="nav-item dropdown">
							<a class="nav-link text-white" data-toggle="dropdown" href="#">
								<i class="fas fa-bell"></i>
								<span class="badge badge-danger navbar-badge"><?php echo countItems2("Item_ID", "items2", "Item_ID > 0"); ?></span>
							</a>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right"><?php
									foreach ($items as $item) {  ?>
										<a href="<?php echo 'nashra_items?formerror=9853&getid=6324&iteimid=3245&checksum=5681&cookie=3021&itemid=' . $item['Item_ID'] . '&counksum=93214&action=421'; ?>" class="dropdown-item">
											<div class="media">
												<div class="media-body">
													<h3 class="dropdown-item-title">
														<?php echo $item['title']; ?>
														<span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
													</h3>
													<p class="text-sm"><?php if ($item['Cat_Group'] == 11) { echo " مدير الموقع"; } ?></p>
													<p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> <?php echo $item['nashra_date']; ?></p>
												</div>
											</div>
										</a><?php
									} ?>
								<div class="dropdown-divider"></div>
								<a href="" class="dropdown-item dropdown-footer">مشاهدة الكل</a>
							</div>
						</li>
					</ul><?php
				} 
			}
		} ?>

	</nav>
<?php } ?>