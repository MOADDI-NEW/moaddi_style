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
									<?php echo'<img src="../admin/nsharat_uploads/user_avatar/' . $info['user_avatar'] . '" alt="'.$info['FullName'].'" style="width:100px">';?>
										<div class="profileinfo">
											<h4><?php echo $info['FullName']?></h4>
											<h5><?php echo $info['job_title']?></h5>
											<p class="bio"> 
												<span class="text-bold"> تاريخ الميلاد </span> : 
											<time datetime="<?php echo $info['birthdate']?>"><?php echo $info['birthdate']?></time>
										</p>
										</div>
									</div>
								</div>
										<div class="badgeshomey d-flex justify-content-center"><?php echo $info['al_city']?></div>
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
							<div class="col-md-12">
								<div class="card direct-chat direct-chat-warning">
										<div class="card-header bg-navy">
											<h3 class="card-title"> المسابقة   <span  class="badge badge-success float-right ml-2"><?php echo countItems2("id", "questions", "id > 0") ?>   سؤال  </span>  </h3>
										</div>
										<div class="card-body">
												<?php 
													$stmt = $con->prepare("SELECT * FROM questions ");
													$stmt->execute();
													$rows = $stmt->fetchAll(); ?>
														<table class="table table-head-fixed table-bordered table-striped">
															<thead>
																<tr>
																	<th> #</th>
																	<th>  السؤال  </th>
																	<th> الدرجة  </th>
																</tr>
															</thead>
															<tbody>
																<?php
																	$i = 1;
																	foreach($rows as $row){
																	echo "<tr>";
																		echo "<td>" . $i++ . "</td>";
																		echo "<td>" . $row['question'] . "</td>";
																		echo "<td>";
																			$_SESSION['user_id'] = $info['UserID'];
																			$stmt = $con->prepare("SELECT * FROM user_answers WHERE user_id = ? AND question_id = ?");
																			$stmt->execute(array($_SESSION['user_id'], $row['id']));
																			$answer = $stmt->fetch();
											
																			if ($answer) {
																				if ($row['correct_option'] == $answer['answer'] ) {
																					echo'10';
																				}else{
																					echo'0';
																				}
																			} else { 
																				echo'<a href="questions?do=View&quetionid=' . $row['id'] . '" class="btn btn-sm btn-danger w-100"> عرض السؤال </a>';
																			}
																		echo"</td>";
																	echo "</tr>";
																	} 							
																	?>
															</tbody>
														</table>
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
							<div class="col-md-6">
								<div class="card">
									<div class="card-header bg-navy">
										<h3 class="card-title">   مناسبات الموقع  <span class="badge badge-danger float-right"><?php echo countItems2("event_id", "events", "event_id > 0") ?> مناسبة</span></h3>
									</div>
									<div class="card-body table-responsive p-0" style="height: 300px;"> <?php 
										$stmt = $con->prepare("SELECT * FROM events WHERE aporove = 1 ORDER BY event_date DESC limit 5 ");
										$stmt->execute();
										$items = $stmt->fetchAll();
										if (! empty($items)){ ?>
											<div class="table-responsive main-dash">
												<table class="table table-head-fixed table-bordered table-striped">
													<thead>
														<tr>
															<th> التاريخ</th>
															<th>  نوع المناسبة </th>
															<th> صاحب الماسبة </th>
															<th>  صورة </th>
														</tr>
													</thead>
													<tbody><?php
														foreach($items as $item){
														echo "<tr>";
															echo "<td>" . $item['event_date'] . "</td>";
															echo "<td>";
															$stmt = $con->prepare("SELECT * FROM events_names ");
															$stmt->execute();  $users = $stmt->fetchAll();
															foreach ($users as $user) {
																if ($item['event_name'] == $user['id']) {echo $user['event_name'];} 
																}
															echo"</td>";
																$stmt = $con->prepare("SELECT * FROM users ");
																$stmt->execute();  $users = $stmt->fetchAll();
																foreach ($users as $user) {
																	if ($item['created_by'] == $user['UserID']) {
																	echo "<td>" . $user['FullName'] . "</td>";
																	echo "<td><img class='direct-chat-img' src='../admin/nsharat_uploads/user_avatar/" . $user['user_avatar'] . "' alt='' /></td>";
																	} 
																}
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
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>