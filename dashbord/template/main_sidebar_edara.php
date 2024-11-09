<?php
if (isset($_SESSION['Edara30'])) {
	$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
	$getUser->execute(array($_SESSION['Edara30']));
	$info = $getUser->fetch(); ?>
	<!-- Main Sidebar Container -->
	<aside class="main-sidebar sidebar-dark-primary elevation-4">
		<!-- Brand Logo -->
		<a href="./" class="brand-link navbar-navy">
			<img src="../layout/dist/img/AdminLTELogo.png" alt="kfsedu Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
			<span class="brand-text font-weight-light text-wite"> Moaddi </span>
		</a>
		<!-- Sidebar -->
		<div class="sidebar navbar-white">
			<div class="user-panel mt-3 pb-3 mb-3 d-flex">
				<div class="image">
					<img src="../../assets/images/about/img-1.jpg" class="img-circle elevation-2" alt="User Image">
				</div>
				<div class="info">
					<a href="./" class="d-block text-dark text-center">
						<?php echo $info['FullName']; ?></a>
					<a href="logout" class="d-block text-dark text-center mt-4"><small class="p-2 bg-navy">تسجيل خروج</small></a>
				</div>
			</div>
			<!-- Sidebar Menu -->
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false"><?php
				 	if (array_search($info['GroupID'], ['1']) !== false) { // ادارة فقط ?> 
						
						
						<?php
					}
					if (array_search($info['GroupID'], ['1']) !== false) { // ادارة الجيم?> 
						<li class="nav-item">
							<a href="member_client" class="nav-link text-dark">
								<i class="nav-icon fas fa-users"></i>
								<p>  مستخدمي الشركات <span class="right badge badge-danger">A</span> </p>
							</a>
						</li>
						<li class="nav-item">
							<a href="member_markting" class="nav-link text-dark">
								<i class="nav-icon fas fa-users"></i>
								<p>  مستخدمي المسوقين <span class="right badge badge-danger">A</span> </p>
							</a>
						</li>
						
						<?php
					}
					if (array_search($info['GroupID'], ['1']) !== false) { // ادارة فقط ?> 
						<li class="nav-item">
							<a href="member_panding" class="nav-link text-dark">
							<i class="nav-icon fas fa-tree"></i>
								<p> مشتركين قيد الانتظار <span class="right badge badge-danger">A</span> </p>
							</a>
						</li><?php
					} 
					if (array_search($info['GroupID'], ['1']) !== false) { // ادارة فقط ?> 
						<?php
					} ?>
					
					<li class="nav-header">العناصر</li><?php
					if (array_search($info['GroupID'], ['1']) !== false) { // مدير فقط ?>
						<li class="nav-item">
							<a href="settings" class="nav-link text-dark"><i class="nav-icon fas fa-cog"></i>
								<p>  اعدادات الموقع </p>
							</a>
						</li>
						<li class="nav-item">
							<a href="nashra_to_school" class="nav-link text-dark"><i class="nav-icon fas fa-calendar-alt"></i>
								<p> اللوحة الاخبارية </p>
							</a>
						</li>
						<li class="nav-item">
							<a href="vending_map" class="nav-link text-dark"><i class="nav-icon fas fa-calendar-alt"></i>
								<p>   أماكن المكائن </p>
							</a>
						</li>
						<li class="nav-item">
							<a href="clints" class="nav-link text-dark"><i class="nav-icon far fa-bell"></i>
								<p class="text"> براند شركات </p>
							</a>
						</li>
						<li class="nav-item">
							<a href="brand_front_page" class="nav-link text-dark"><i class="nav-icon far fa-bell"></i>
								<p class="text">   صفحة الشركات واجهة  </p>
							</a>
						</li>
						<li class="nav-item">
							<a href="marketing_front_page" class="nav-link text-dark"><i class="nav-icon far fa-bell"></i>
								<p class="text">   صفحة المسوقين واجهة  </p>
							</a>
						</li>
						<li class="nav-item">
							<a href="faq" class="nav-link text-dark"><i class="nav-icon far fa-bell"></i>
								<p class="text">الاسئلة الشائعة </p>
							</a>
						</li>
						<li class="nav-item">
							<a href="nashra_to_students" class="nav-link text-dark"><i class="nav-icon far fa-bell"></i>
								<p class="text">تعليمات للمشتركين</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="web_rate" class="nav-link text-dark"><i class="nav-icon fas fa-user"></i>
								<p>   تقيمات الموقع </p>
							</a>
						</li>
						<li class="nav-item">
							<a href="front_messages" class="nav-link text-dark"><i class="nav-icon fas fa-calendar-alt"></i>
								<p> رسائل الموقع  </p>
							</a>
						</li>
						
						<?php
					} ?>
					
				</ul>
			</nav>
		</div>
	</aside>
<?php
} ?>