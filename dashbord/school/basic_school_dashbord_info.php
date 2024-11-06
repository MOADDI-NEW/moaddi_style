	<div class="container-fluid">
		<div class="col-12">
			<div class="card area">
				<ul class="circles"><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li></ul>
				<div class="card-body">
					<div class="row d-flex justify-content-center">
						<div class="col-md-6">
							<div class="content mb-5">
								<div class="homey">
									<div class="firstinfo">
									<?php echo'<img src="../../assets/images/about/img-1.jpg" alt="'.$info['FullName'].'" style="width:100px">';?>
										<div class="profileinfo">
											<h4><?php echo $info['FullName']?></h4>
										</div>
									</div>
								</div>
										<div class="badgeshomey d-flex justify-content-center">Moaddi</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>		
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-md-6">
								<div class="card direct-chat direct-chat-warning">
									<div class="card-header bg-navy">
										<h3 class="card-title"> Site Comments  <span  class="badge badge-success float-right ml-2"><?php echo countItems2("web_rete", "comments_site", "approve IN ('1') ") ?> Comment approved</span>  <span  class="badge badge-danger float-right"><?php echo countItems2("web_rete", "comments_site", "approve IN ('0') ") ?> Pending comment </span></h3>
									</div>
									<div class="card-body">
										<div class="direct-chat-messages"> <?php 
											$stmt = $con->prepare("SELECT c.*, u.UserID, u.FullName
											FROM comments_site c
											JOIN users u ON c.member_id = u.UserID 
											WHERE u.UserID = c.member_id  AND c.approve = 1 ");
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
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>