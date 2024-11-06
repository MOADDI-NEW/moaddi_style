<div class="container-fluid"><?php 
	if (array_search($info['GroupID'], ['1']) !== false) { ?>
		<div class="row">
			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box">
					<span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
					<div class="info-box-content">
						<span class="info-box-text text-center">  المكائن </span>
						<span class="info-box-number text-center"> <?php echo countItems2("id", "vending_map", "id > 0 ") ?>  </span>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box mb-3">
					<span class="info-box-icon bg-danger elevation-1"><i class="fas fa-envelope"></i></span>
					<div class="info-box-content">
						<span class="info-box-text text-center">   الرسائل </span>
						<span class="info-box-number text-center"> <?php echo countItems2("mes_id", "messages", "mes_id > 0") ?>  </span>
					</div>
				</div>
			</div>
			<div class="clearfix hidden-md-up"></div>
			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box mb-3">
					<span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>
					<div class="info-box-content">
						<span class="info-box-text text-center"> المشتركين </span>
						<span class="info-box-number text-center"> <?php echo countItems2("Username", "users", "role = 44  AND department = 10 AND RegStatus = 1") ?> </span>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box mb-3">
					<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-user"></i></span>
					<div class="info-box-content">
						<span class="info-box-text text-center"> مشترك قيد الانتظار  </span>
						<span class="info-box-number text-center"> <?php echo countItems2("Username", "users", "RegStatus = 0 ") ?> </span>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header bg-navy">
						<h3 class="card-title">   رسائل الموقع  <span class="badge badge-danger float-right"><?php echo countItems2("mes_id", "messages", "mes_id > 0") ?> رسالة</span></h3>
					</div>
					<div class="card-body table-responsive p-0" style="height: 300px;"> <?php 
						$stmt = $con->prepare("SELECT * FROM messages ORDER BY mes_Date DESC limit 5 ");
						$stmt->execute();
						$items = $stmt->fetchAll();
						if (! empty($items)){ ?>
							<div class="table-responsive main-dash">
								<table class="table table-head-fixed table-bordered table-striped">
									<thead>
										<tr>
											<th> التاريخ</th>
											<th> الاسم </th>
											<th>  الهاتف </th>
											<th> عرض الرسالة  </th>
										</tr>
									</thead>
									<tbody><?php
										foreach($items as $item){
										echo "<tr>";
											echo "<td>" . $item['mes_Date'] . "</td>";
											echo "<td>" . $item['FullName'] . "</td>";
											echo "<td>" . $item['phone'] . "</td>";
											echo "<td><a href='front_messages' class='btn btn-sm btn-danger w-100'>عرض الرسالة</a></td>";
										echo "</tr>";
										} 							
										?>
									</tbody>
								</table>
							</div><?php 
						}?>
					</div>
				</div>
			</div>
			
			<div class="col-md-6">
				<div class="card direct-chat direct-chat-warning">
					<div class="card-header bg-navy">
						<h3 class="card-title">تعليقات للموقع   <span  class="badge badge-success float-right ml-2"><?php echo countItems2("web_rete", "comments_site", "approve IN ('1') ") ?> تم الموافقة</span>  <span  class="badge badge-danger float-right"><?php echo countItems2("web_rete", "comments_site", "approve IN ('0') ") ?> تعليق قيد الانتظار</span></h3>
					</div>
					<div class="card-body">
						<div class="direct-chat-messages"> <?php 
							$stmt = $con->prepare("SELECT c.*, u.UserID, u.FullName
							FROM comments_site c
							JOIN users u ON c.member_id = u.UserID 
							WHERE u.UserID = c.member_id  AND c.approve IN ('0','1') ");
							$stmt->execute();
							$rows = $stmt->fetchAll();
							if (! empty($rows)){ 
								foreach($rows as $row){  ?>
									<div class="direct-chat-msg right">
										<div class="direct-chat-infos clearfix d-flex justify-content-around mb-2">
											<span class="direct-chat-name float-right"><?php  
													$stmt = $con->prepare("SELECT UserID, FullName, role  FROM users WHERE role = 44"); 
													$stmt->execute(); 
													$users = $stmt->fetchAll(); 
													foreach ($users as $user) { 
														if ($row['member_id'] == $user['UserID']) {
															echo $user['FullName'] ;
													} } ?>
											</span>
											<span class="direct-chat-timestamp float-none"><?php 
												$rating = $row['web_rete'];
												$star_value = $rating / 20; // Divide the rating by 5 to get the value for each star
												$full_stars = floor($star_value); // Round down to nearest integer to get number of full stars
												$half_star = ceil($star_value - $full_stars); // Round up to get number of half stars
												$empty_stars = 5 - $full_stars - $half_star; // Calculate number of empty stars

												for ($i = 0; $i < $full_stars; $i++) { echo '<span class="float-start"><i class="text-warning fa fa-star"></i></span>'; }
												if ($half_star) { echo '<span class="float-start"><i class="text-warning fa fa-star-half-o"></i></span>'; }
												for ($i = 0; $i < $empty_stars; $i++) { echo '<span class="float-start"><i class="text-muted fa fa-star"></i></span>'; } ?>
											</span>
											<span class="direct-chat-timestamp float-left"> <?php echo $row['rate_date']; ?> </span>
										</div>
										<img class="direct-chat-img" src="../layout/dist/img/avatar5.png" alt="message user image">
										<div class="direct-chat-text <?php if ($row['approve'] == 1 ){ echo 'bg-warinng'; } else {echo 'bg-light text-muted text-decoration-line-through';}?>"> <?php  echo $row['comment']; ?> </div>
									</div> <?php 
								}
							} ?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card">
					<div class="card-header bg-navy">
						<h3 class="card-title">مشتركين قيد الانتظار  <span class="badge badge-danger float-right"><?php echo countItems2("Username", "users", "role  IN ('44','45')  AND RegStatus = 0") ?> مشترك</span> </h3>
					</div>
					<div class="card-body p-0">
						<ul class="users-list clearfix"> <?php
							$stmt = $con->prepare("SELECT * FROM users WHERE role IN ('44','45') AND RegStatus = 0 ORDER BY UserID DESC LIMIT 8");
							$stmt->execute();
							$rows = $stmt->fetchAll();
							if (! empty($rows)){ 
								foreach($rows as $row){ ?>
									<li>
										<img src="../layout/dist/img/avatar5.png" alt="User Image" style="max-width:60%;">
										<a class="users-list-name" href="member_panding"><?php echo $row['FullName']; ?></a>
										<span class="users-list-date"><?php echo $row['Date']; ?></span>
									</li> <?php 
								}
							}else{ echo '<p class="py-3 px-0 text-center text-danger"> لا يوجد مشتركين للعرض </p>'; } ?>
						</ul>
					</div>
					<div class="card-footer text-center">
						<a href="member_panding">عرض الكل</a>
					</div>
				</div>
			</div>
		</div><?php 
	} 

		 ?>
</div>