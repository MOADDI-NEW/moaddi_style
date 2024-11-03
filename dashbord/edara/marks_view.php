<?php
ob_start();
session_start();
$noNavbar = '';
$main_header_edara = '';
$main_sidebar_edara = '';

$pageTitle = 'استعراض درجات طالب';
if (isset($_SESSION['Edara30'])){
include 'init.php';

	$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';     // shor if 
if($do == 'Manage'){ //=========== Start Manage Page ============
}elseif($do == 'Edit'){ 
	$itemid = isset($_GET['itemid'])&& is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;
	if (isset($_SESSION['Edara30'])){
		$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
		$getUser->execute(array($_SESSION['Edara30']));
		$info = $getUser->fetch();

		if (array_search($info['role'], ['30']) !== false) { // شرق
			// Check if the itemid is numeric and  Exist in Database	
			$stmt = $con->prepare("SELECT * FROM users WHERE UserID = ? ");
			$stmt->execute(array($itemid));
			$item = $stmt->fetch();
			$count = $stmt->rowCount();
			if ($stmt->rowCount() > 0){ ?>
		<div class="main-content app-content"> 
			<!-- breadcrumb -->
			<?php include 'breadcrumb.php';?>
			<!-- /breadcrumb -->
			<div class="container-fluid">
				<div class="row row-sm">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-header"><h3 class="card-title text-center">استعراض درجات طالب</h3></div>
							<div class="card-body">
								<div class="table-responsive export-table">
									<table id="" class="table table-bordered table-striped" style= "width:98%; direction:rtl;">
										<thead>
											<tr class="bg-fuchsia">
											  <th scope="col" style="font-family: 'Tajawal', sans-serif;">الاسم</th>
											  <th scope="col" style="font-family: 'Tajawal', sans-serif;">المستوى</th>
											  <th scope="col" style="font-family: 'Tajawal', sans-serif;">الحلقة</th>
											</tr>
										</thead>
										<tbody>
											<tr class="bg-indigo">
											  <td style="padding:10px 1px!important;font-size:13px"><?php echo $item['FullName']?></td>
											  <td style="padding:10px 1px!important;font-size:13px"><?php echo $item['stage']?></td>
											  <td style="padding:10px 1px!important;font-size:13px"><?php echo $item['position']?></td> 
											</tr>
										</tbody>
									</table>
								</div>
								<!--  script to print div by Alaa Amer -->
								<script type="text/javascript">function printDiv(n){var e=document.getElementById(n).innerHTML,t=document.body.innerHTML;document.body.innerHTML="<html><head><title></title></head><body>"+e+"</body>",window.print(),document.body.innerHTML=t}</script>
								<div id="printablediv">	<!--  Start div to print  -->	
									<form>
										<div class="section" style="padding: 5px;background-color:#090533;color:#fff;border:1px solid #000;"><span>1</span> البيانات الأساسية للطالب</div>
											<div class="row">
												<div class="col-md-3 col-sm-6">
													<label>الحلقة</label>
													<div class="shadow1"> 
														<?php echo $item['position'];?>
													</div>
												</div>
												<div class="col-md-3 col-sm-6">
													<label>المستوى</label>
													<div class="shadow1"> 
														<?php echo $item['stage'];?>
													</div>
												</div>
												<div class="col-md-6 col-sm-6">
													<label>اسم الطالب</label>
													<div class="shadow1"> 
														<?php echo $item['FullName'];?>
													</div>
												</div>
											</div>
											
											<div class="section" style="padding: 5px;background-color:#090533;color:#fff;border:1px solid #000;"><span>2</span> بيان الدرحات</div><?php
												if (  $item['stage'] == 1) {?>
														<!-- المستوى الأول -->
													<div class="col-md-12">
														<div class="table-responsive export-table">
															<table id="" class="table table-bordered table-striped" style= "width:100%; direction:rtl;">
																<thead>
																	<tr>
																		<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء</div></th>
																		<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الربع الأول</div></th>
																		<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الربع الثاني</div></th>
																		<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الربع الثالث</div></th>
																		<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الربع الرابع</div></th>
																		<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الربع الخامس</div></th>
																		<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الربع السادس</div></th>
																		<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الربع السابع</div></th>
																		<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الربع الثامن</div></th>
																	</tr>
																</thead>
																<tfoot>
																	<tr>
																		<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء</div></th>
																		<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الربع الأول</div></th>
																		<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الربع الثاني</div></th>
																		<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الربع الثالث</div></th>
																		<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الربع الرابع</div></th>
																		<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الربع الخامس</div></th>
																		<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الربع السادس</div></th>
																		<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الربع السابع</div></th>
																		<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الربع الثامن</div></th>
																	</tr>
																</tfoot>
																<tbody>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الأول </div></td>
																			<td> <?php if ($item['A1_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A1_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A1_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A1_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A1_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A1_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A1_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A1_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A1_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A1_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A1_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A1_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A1_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A1_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A1_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A1_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الثاني </div></td>
																			<td> <?php if ($item['A2_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A2_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A2_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A2_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A2_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A2_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A2_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A2_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A2_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A2_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A2_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A2_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A2_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A2_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A2_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A2_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الثالث </div></td>
																			<td> <?php if ($item['A3_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A3_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A3_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A3_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A3_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A3_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A3_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A3_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A3_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A3_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A3_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A3_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A3_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A3_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A3_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A3_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الرابع </div></td>
																			<td> <?php if ($item['A4_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A4_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A4_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A4_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A4_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A4_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A4_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A4_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A4_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A4_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A4_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A4_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A4_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A4_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A4_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A4_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الخامس </div></td>
																			<td> <?php if ($item['A5_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A5_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A5_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A5_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A5_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A5_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A5_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A5_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A5_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A5_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A5_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A5_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A5_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A5_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A5_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A5_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء السادس </div></td>
																			<td> <?php if ($item['A6_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A6_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A6_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A6_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A6_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A6_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A6_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A6_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A6_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A6_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A6_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A6_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A6_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A6_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A6_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A6_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء السابع </div></td>
																			<td> <?php if ($item['A7_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A7_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A7_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A7_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A7_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A7_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A7_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A7_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A7_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A7_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A7_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A7_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A7_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A7_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A7_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A7_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الثامن </div></td>
																			<td> <?php if ($item['A8_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A8_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A8_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A8_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A8_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A8_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A8_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A8_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A8_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A8_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A8_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A8_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A8_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A8_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A8_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A8_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء التاسع </div></td>
																			<td> <?php if ($item['A9_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A9_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A9_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A9_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A9_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A9_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A9_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A9_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A9_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A9_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A9_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A9_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A9_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A9_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A9_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A9_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء العاشر </div></td>
																			<td> <?php if ($item['A10_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A10_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A10_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A10_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A10_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A10_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A10_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A10_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A10_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A10_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A10_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A10_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A10_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A10_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A10_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A10_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الحادي عشر </div></td>
																			<td> <?php if ($item['A11_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A11_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A11_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A11_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A11_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A11_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A11_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A11_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A11_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A11_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A11_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A11_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A11_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A11_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A11_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A11_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الثاني عشر </div></td>
																			<td> <?php if ($item['A12_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A12_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A12_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A12_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A12_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A12_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A12_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A12_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A12_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A12_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A12_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A12_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A12_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A12_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A12_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A12_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الثالث عشر </div></td>
																			<td> <?php if ($item['A13_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A13_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A13_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A13_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A13_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A13_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A13_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A13_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A13_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A13_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A13_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A13_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A13_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A13_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A13_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A13_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الرابع عشر </div></td>
																			<td> <?php if ($item['A14_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A14_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A14_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A14_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A14_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A14_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A14_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A14_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A14_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A14_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A14_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A14_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A14_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A14_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A14_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A14_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الخامس عشر </div></td>
																			<td> <?php if ($item['A15_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A15_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A15_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A15_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A15_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A15_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A15_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A15_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A15_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A15_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A15_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A15_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A15_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A15_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A15_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A15_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء السادس عشر </div></td>
																			<td> <?php if ($item['A16_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A16_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A16_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A16_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A16_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A16_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A16_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A16_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A16_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A16_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A16_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A16_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A16_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A16_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A16_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A16_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء السابع عشر </div></td>
																			<td> <?php if ($item['A17_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A17_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A17_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A17_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A17_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A17_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A17_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A17_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A17_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A17_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A17_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A17_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A17_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A17_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A17_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A17_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;">  الجزء الثامن عشر  </div></td>
																			<td> <?php if ($item['A18_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A18_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A18_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A18_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A18_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A18_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A18_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A18_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A18_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A18_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A18_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A18_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A18_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A18_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A18_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A18_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء التاسع عشر  </div></td>
																			<td> <?php if ($item['A19_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A19_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A19_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A19_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A19_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A19_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A19_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A19_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A19_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A19_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A19_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A19_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A19_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A19_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A19_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A19_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء العشرون </div></td>
																			<td> <?php if ($item['A20_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A20_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A20_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A20_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A20_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A20_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A20_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A20_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A20_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A20_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A20_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A20_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A20_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A20_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A20_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A20_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الحادي والعشرون </div></td>
																			<td> <?php if ($item['A21_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A21_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A21_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A21_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A21_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A21_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A21_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A21_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A21_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A21_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A21_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A21_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A21_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A21_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A21_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A21_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الثاني والعشرون </div></td>
																			<td> <?php if ($item['A22_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A22_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A22_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A22_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A22_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A22_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A22_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A22_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A22_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A22_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A22_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A22_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A22_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A22_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A22_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A22_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;">  الجزء الثالث والعشرون </div></td>
																			<td> <?php if ($item['A23_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A23_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A23_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A23_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A23_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A23_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A23_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A23_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A23_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A23_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A23_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A23_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A23_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A23_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A23_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A23_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;">   الجزء الرابع والعشرون </div></td>
																			<td> <?php if ($item['A24_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A24_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A24_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A24_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A24_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A24_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A24_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A24_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A24_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A24_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A24_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A24_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A24_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A24_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A24_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A24_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;">    الجزء الخامس والعشرون </div></td>
																			<td> <?php if ($item['A25_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A25_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A25_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A25_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A25_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A25_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A25_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A25_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A25_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A25_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A25_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A25_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A25_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A25_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A25_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A25_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;">    الجزء السادس والعشرون </div></td>
																			<td> <?php if ($item['A26_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A26_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A26_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A26_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A26_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A26_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A26_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A26_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A26_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A26_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A26_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A26_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A26_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A26_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A26_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A26_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;">    الجزء السابع والعشرون </div></td>
																			<td> <?php if ($item['A27_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A27_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A27_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A27_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A27_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A27_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A27_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A27_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A27_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A27_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A27_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A27_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A27_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A27_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A27_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A27_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;">    الجزء الثامن والعشرون </div></td>
																			<td> <?php if ($item['A28_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A28_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A28_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A28_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A28_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A28_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A28_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A28_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A28_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A28_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A28_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A28_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A28_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A28_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A28_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A28_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;">  الجزء التاسع والعشرون </div></td>
																			<td> <?php if ($item['A29_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A29_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A29_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A29_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A29_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A29_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A29_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A29_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A29_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A29_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A29_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A29_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A29_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A29_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A29_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A29_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الثلاثون </div></td>
																			<td> <?php if ($item['A30_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A30_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A30_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A30_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A30_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A30_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A30_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A30_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A30_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A30_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A30_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A30_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A30_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A30_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																			<td> <?php if ($item['A30_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A30_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?> </td>
																		</tr>
																</tbody>
															</table>
														</div>
													</div>
													<div class="col-md-12">
															<center> <img src="../layout/deplom_img/1.png" alt="Alaa Amer" class="rounded" style="width:100%;"/></center>
													</div><?php	
												}
												if (  $item['stage'] == 2) {?>
															<!-- المستوى الثاني -->
														<div class="col-md-12">
															<div class="table-responsive export-table">
																<table id="" class="table table-bordered table-striped" style= "width:100%; direction:rtl;">
																	<thead>
																		<tr>
																			<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء </div></th>
																			<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;">  الربع الأول</div></th>
																			<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الربع الثاني</div></th>
																			<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الربع الثالث</div></th>
																			<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الربع الرابع</div></th>
																			<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الربع الخامس</div></th>
																			<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الربع السادس</div></th>
																			<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الربع السابع</div></th>
																			<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الربع الثامن</div></th>
																		</tr>
																	</thead>
																	<tfoot>
																		<tr>
																			<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء </div></th>
																			<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;">  الربع الأول</div></th>
																			<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الربع الثاني</div></th>
																			<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الربع الثالث</div></th>
																			<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الربع الرابع</div></th>
																			<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الربع الخامس</div></th>
																			<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الربع السادس</div></th>
																			<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الربع السابع</div></th>
																			<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الربع الثامن</div></th>
																		</tr>
																	</tfoot>
																	<tbody>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الأول </div></td>
																			<td> <?php if ($item['B1_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B1_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B1_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B1_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B1_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B1_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B1_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B1_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B1_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B1_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B1_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B1_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B1_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B1_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B1_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B1_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B1_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B1_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B1_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B1_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B1_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B1_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B1_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B1_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الثاني </div></td>
																			<td> <?php if ($item['B2_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B2_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B2_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B2_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B2_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B2_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B2_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B2_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B2_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B2_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B2_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B2_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B2_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B2_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B2_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B2_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B2_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B2_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B2_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B2_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B2_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B2_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B2_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B2_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الثالث </div></td>
																			<td> <?php if ($item['B3_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B3_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B3_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B3_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B3_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B3_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B3_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B3_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B3_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B3_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B3_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B3_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B3_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B3_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B3_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B3_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B3_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B3_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B3_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B3_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B3_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B3_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B3_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B3_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الرابع </div></td>
																			<td> <?php if ($item['B4_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B4_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B4_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B4_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B4_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B4_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B4_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B4_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B4_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B4_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B4_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B4_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B4_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B4_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B4_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B4_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B4_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B4_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B4_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B4_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B4_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B4_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B4_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B4_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الخامس </div></td>
																			<td> <?php if ($item['B5_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B5_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B5_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B5_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B5_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B5_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B5_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B5_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B5_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B5_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B5_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B5_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B5_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B5_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B5_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B5_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B5_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B5_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B5_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B5_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B5_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B5_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B5_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B5_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء السادس </div></td>
																			<td> <?php if ($item['B6_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B6_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B6_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B6_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B6_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B6_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B6_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B6_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B6_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B6_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B6_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B6_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B6_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B6_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B6_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B6_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B6_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B6_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B6_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B6_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B6_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B6_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B6_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B6_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء السابع </div></td>
																			<td> <?php if ($item['B7_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B7_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B7_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B7_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B7_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B7_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B7_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B7_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B7_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B7_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B7_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B7_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B7_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B7_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B7_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B7_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B7_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B7_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B7_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B7_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B7_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B7_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B7_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B7_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الثامن </div></td>
																			<td> <?php if ($item['B8_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B8_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B8_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B8_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B8_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B8_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B8_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B8_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B8_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B8_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B8_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B8_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B8_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B8_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B8_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B8_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B8_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B8_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B8_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B8_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B8_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B8_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B8_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B8_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء التاسع </div></td>
																			<td> <?php if ($item['B9_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B9_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B9_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B9_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B9_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B9_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B9_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B9_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B9_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B9_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B9_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B9_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B9_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B9_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B9_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B9_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B9_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B9_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B9_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B9_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B9_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B9_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B9_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B9_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء العاشر </div></td>
																			<td> <?php if ($item['B10_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B10_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B10_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B10_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B10_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B10_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B10_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B10_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B10_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B10_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B10_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B10_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B10_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B10_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B10_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B10_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B10_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B10_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B10_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B10_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B10_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B10_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B10_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B10_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الحادي عشر </div></td>
																			<td> <?php if ($item['B11_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B11_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B11_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B11_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B11_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B11_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B11_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B11_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B11_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B11_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B11_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B11_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B11_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B11_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B11_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B11_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B11_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B11_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B11_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B11_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B11_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B11_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B11_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B11_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الثاني عشر </div></td>
																			<td> <?php if ($item['B12_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B12_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B12_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B12_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B12_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B12_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B12_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B12_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B12_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B12_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B12_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B12_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B12_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B12_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B12_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B12_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B12_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B12_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B12_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B12_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B12_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B12_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B12_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B12_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الثالث عشر </div></td>
																			<td> <?php if ($item['B13_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B13_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B13_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B13_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B13_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B13_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B13_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B13_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B13_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B13_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B13_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B13_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B13_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B13_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B13_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B13_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B13_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B13_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B13_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B13_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B13_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B13_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B13_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B13_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الرابع عشر </div></td>
																			<td> <?php if ($item['B14_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B14_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B14_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B14_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B14_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B14_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B14_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B14_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B14_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B14_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B14_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B14_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B14_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B14_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B14_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B14_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B14_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B14_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B14_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B14_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B14_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B14_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B14_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B14_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الخامس عشر </div></td>
																			<td> <?php if ($item['B15_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B15_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B15_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B15_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B15_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B15_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B15_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B15_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B15_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B15_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B15_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B15_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B15_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B15_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B15_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B15_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B15_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B15_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B15_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B15_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B15_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B15_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B15_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B15_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء السادس عشر </div></td>
																			<td> <?php if ($item['B16_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B16_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B16_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B16_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B16_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B16_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B16_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B16_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B16_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B16_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B16_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B16_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B16_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B16_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B16_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B16_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B16_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B16_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B16_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B16_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B16_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B16_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B16_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B16_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء السابع عشر </div></td>
																			<td> <?php if ($item['B17_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B17_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B17_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B17_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B17_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B17_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B17_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B17_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B17_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B17_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B17_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B17_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B17_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B17_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B17_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B17_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B17_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B17_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B17_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B17_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B17_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B17_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B17_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B17_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الثامن عشر </div></td>
																			<td> <?php if ($item['B18_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B18_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B18_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B18_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B18_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B18_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B18_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B18_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B18_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B18_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B18_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B18_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B18_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B18_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B18_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B18_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B18_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B18_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B18_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B18_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B18_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B18_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B18_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B18_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء التاسع عشر </div></td>
																			<td> <?php if ($item['B19_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B19_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B19_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B19_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B19_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B19_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B19_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B19_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B19_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B19_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B19_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B19_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B19_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B19_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B19_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B19_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B19_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B19_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B19_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B19_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B19_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B19_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B19_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B19_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء العشرون </div></td>
																			<td> <?php if ($item['B20_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B20_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B20_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B20_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B20_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B20_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B20_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B20_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B20_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B20_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B20_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B20_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B20_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B20_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B20_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B20_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B20_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B20_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B20_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B20_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B20_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B20_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B20_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B20_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الحادي والعشرون </div></td>
																			<td> <?php if ($item['B21_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B21_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B21_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B21_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B21_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B21_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B21_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B21_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B21_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B21_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B21_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B21_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B21_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B21_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B21_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B21_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B21_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B21_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B21_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B21_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B21_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B21_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B21_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B21_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الثاني والعشرون </div></td>
																			<td> <?php if ($item['B22_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B22_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B22_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B22_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B22_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B22_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B22_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B22_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B22_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B22_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B22_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B22_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B22_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B22_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B22_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B22_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B22_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B22_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B22_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B22_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B22_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B22_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B22_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B22_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;">  الجزء الثالث والعشرون  </div></td>
																			<td> <?php if ($item['B23_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B23_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B23_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B23_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B23_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B23_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B23_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B23_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B23_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B23_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B23_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B23_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B23_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B23_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B23_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B23_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B23_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B23_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B23_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B23_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B23_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B23_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B23_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B23_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الرابع والعشرون </div></td>
																			<td> <?php if ($item['B24_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B24_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B24_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B24_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B24_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B24_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B24_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B24_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B24_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B24_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B24_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B24_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B24_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B24_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B24_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B24_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B24_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B24_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B24_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B24_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B24_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B24_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B24_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B24_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الخامس والعشرون </div></td>
																			<td> <?php if ($item['B25_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B25_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B25_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B25_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B25_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B25_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B25_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B25_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B25_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B25_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B25_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B25_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B25_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B25_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B25_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B25_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B25_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B25_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B25_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B25_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B25_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B25_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B25_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B25_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء السادس والعشرون </div></td>
																			<td> <?php if ($item['B26_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B26_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B26_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B26_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B26_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B26_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B26_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B26_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B26_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B26_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B26_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B26_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B26_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B26_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B26_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B26_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B26_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B26_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B26_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B26_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B26_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B26_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B26_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B26_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء السابع والعشرون </div></td>
																			<td> <?php if ($item['B27_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B27_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B27_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B27_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B27_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B27_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B27_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B27_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B27_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B27_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B27_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B27_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B27_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B27_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B27_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B27_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B27_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B27_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B27_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B27_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B27_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B27_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B27_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B27_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الثامن والعشرون </div></td>
																			<td> <?php if ($item['B28_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B28_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B28_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B28_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B28_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B28_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B28_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B28_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B28_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B28_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B28_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B28_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B28_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B28_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B28_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B28_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B28_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B28_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B28_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B28_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B28_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B28_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B28_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B28_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء التاسع والعشرون </div></td>
																			<td> <?php if ($item['B29_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B29_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B29_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B29_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B29_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B29_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B29_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B29_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B29_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B29_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B29_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B29_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B29_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B29_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B29_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B29_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B29_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B29_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B29_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B29_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B29_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B29_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B29_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B29_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الثلاثون </div></td>
																			<td> <?php if ($item['B30_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B30_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B30_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B30_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B30_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B30_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B30_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B30_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B30_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B30_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B30_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B30_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B30_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B30_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B30_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B30_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B30_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B30_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B30_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B30_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B30_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B30_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B30_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B30_8'] . '</span>';} ?> </td>
																		</tr>	
																	</tbody>
																</table>
															</div>
														</div>
														<div class="col-md-12">
															<center> <img src="../layout/deplom_img/2.png" alt="Alaa Amer" class="rounded" style="width:100%;"/></center>
														</div>	<?php
												}
												if (  $item['stage'] == 3) {?>
														<!-- المستوى الثالث -->
														<div class="col-md-12">
															<div class="table-responsive export-table">
																<table id="" class="table table-bordered table-striped" style= "width:100%; direction:rtl;">
																	<thead>
																		<tr>
																			<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء </div></th>
																			<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;">  الربع الأول</div></th>
																			<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الربع الثاني</div></th>
																			<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الربع الثالث</div></th>
																			<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الربع الرابع</div></th>
																			<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الربع الخامس</div></th>
																			<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الربع السادس</div></th>
																			<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الربع السابع</div></th>
																			<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الربع الثامن</div></th>
																		</tr>
																	</thead>
																	<tfoot>
																		<tr>
																			<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء </div></th>
																			<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;">  الربع الأول</div></th>
																			<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الربع الثاني</div></th>
																			<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الربع الثالث</div></th>
																			<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الربع الرابع</div></th>
																			<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الربع الخامس</div></th>
																			<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الربع السادس</div></th>
																			<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الربع السابع</div></th>
																			<th><div style="background-color:#800404;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الربع الثامن</div></th>
																		</tr>
																	</tfoot>
																	<tbody>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الأول </div></td>
																			<td> <?php if ($item['B1_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B1_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B1_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B1_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B1_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B1_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B1_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B1_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B1_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B1_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B1_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B1_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B1_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B1_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B1_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B1_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B1_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B1_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B1_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B1_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B1_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B1_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B1_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B1_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الثاني </div></td>
																			<td> <?php if ($item['B2_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B2_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B2_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B2_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B2_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B2_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B2_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B2_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B2_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B2_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B2_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B2_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B2_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B2_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B2_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B2_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B2_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B2_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B2_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B2_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B2_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B2_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B2_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B2_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الثالث </div></td>
																			<td> <?php if ($item['B3_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B3_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B3_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B3_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B3_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B3_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B3_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B3_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B3_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B3_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B3_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B3_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B3_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B3_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B3_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B3_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B3_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B3_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B3_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B3_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B3_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B3_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B3_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B3_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الرابع </div></td>
																			<td> <?php if ($item['B4_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B4_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B4_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B4_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B4_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B4_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B4_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B4_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B4_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B4_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B4_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B4_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B4_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B4_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B4_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B4_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B4_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B4_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B4_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B4_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B4_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B4_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B4_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B4_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الخامس </div></td>
																			<td> <?php if ($item['B5_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B5_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B5_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B5_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B5_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B5_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B5_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B5_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B5_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B5_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B5_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B5_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B5_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B5_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B5_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B5_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B5_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B5_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B5_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B5_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B5_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B5_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B5_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B5_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء السادس </div></td>
																			<td> <?php if ($item['B6_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B6_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B6_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B6_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B6_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B6_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B6_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B6_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B6_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B6_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B6_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B6_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B6_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B6_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B6_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B6_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B6_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B6_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B6_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B6_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B6_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B6_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B6_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B6_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء السابع </div></td>
																			<td> <?php if ($item['B7_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B7_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B7_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B7_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B7_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B7_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B7_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B7_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B7_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B7_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B7_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B7_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B7_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B7_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B7_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B7_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B7_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B7_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B7_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B7_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B7_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B7_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B7_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B7_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الثامن </div></td>
																			<td> <?php if ($item['B8_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B8_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B8_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B8_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B8_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B8_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B8_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B8_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B8_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B8_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B8_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B8_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B8_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B8_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B8_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B8_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B8_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B8_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B8_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B8_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B8_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B8_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B8_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B8_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء التاسع </div></td>
																			<td> <?php if ($item['B9_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B9_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B9_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B9_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B9_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B9_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B9_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B9_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B9_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B9_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B9_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B9_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B9_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B9_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B9_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B9_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B9_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B9_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B9_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B9_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B9_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B9_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B9_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B9_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء العاشر </div></td>
																			<td> <?php if ($item['B10_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B10_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B10_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B10_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B10_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B10_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B10_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B10_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B10_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B10_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B10_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B10_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B10_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B10_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B10_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B10_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B10_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B10_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B10_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B10_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B10_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B10_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B10_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B10_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الحادي عشر </div></td>
																			<td> <?php if ($item['B11_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B11_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B11_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B11_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B11_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B11_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B11_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B11_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B11_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B11_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B11_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B11_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B11_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B11_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B11_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B11_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B11_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B11_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B11_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B11_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B11_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B11_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B11_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B11_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الثاني عشر </div></td>
																			<td> <?php if ($item['B12_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B12_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B12_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B12_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B12_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B12_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B12_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B12_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B12_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B12_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B12_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B12_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B12_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B12_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B12_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B12_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B12_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B12_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B12_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B12_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B12_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B12_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B12_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B12_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الثالث عشر </div></td>
																			<td> <?php if ($item['B13_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B13_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B13_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B13_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B13_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B13_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B13_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B13_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B13_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B13_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B13_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B13_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B13_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B13_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B13_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B13_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B13_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B13_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B13_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B13_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B13_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B13_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B13_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B13_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الرابع عشر </div></td>
																			<td> <?php if ($item['B14_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B14_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B14_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B14_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B14_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B14_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B14_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B14_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B14_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B14_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B14_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B14_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B14_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B14_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B14_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B14_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B14_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B14_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B14_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B14_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B14_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B14_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B14_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B14_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الخامس عشر </div></td>
																			<td> <?php if ($item['B15_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B15_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B15_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B15_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B15_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B15_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B15_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B15_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B15_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B15_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B15_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B15_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B15_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B15_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B15_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B15_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B15_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B15_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B15_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B15_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B15_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B15_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B15_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B15_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء السادس عشر </div></td>
																			<td> <?php if ($item['B16_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B16_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B16_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B16_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B16_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B16_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B16_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B16_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B16_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B16_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B16_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B16_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B16_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B16_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B16_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B16_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B16_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B16_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B16_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B16_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B16_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B16_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B16_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B16_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء السابع عشر </div></td>
																			<td> <?php if ($item['B17_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B17_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B17_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B17_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B17_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B17_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B17_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B17_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B17_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B17_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B17_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B17_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B17_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B17_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B17_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B17_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B17_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B17_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B17_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B17_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B17_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B17_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B17_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B17_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الثامن عشر </div></td>
																			<td> <?php if ($item['B18_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B18_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B18_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B18_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B18_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B18_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B18_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B18_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B18_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B18_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B18_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B18_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B18_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B18_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B18_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B18_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B18_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B18_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B18_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B18_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B18_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B18_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B18_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B18_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء التاسع عشر </div></td>
																			<td> <?php if ($item['B19_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B19_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B19_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B19_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B19_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B19_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B19_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B19_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B19_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B19_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B19_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B19_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B19_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B19_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B19_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B19_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B19_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B19_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B19_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B19_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B19_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B19_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B19_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B19_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء العشرون </div></td>
																			<td> <?php if ($item['B20_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B20_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B20_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B20_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B20_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B20_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B20_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B20_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B20_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B20_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B20_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B20_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B20_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B20_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B20_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B20_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B20_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B20_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B20_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B20_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B20_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B20_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B20_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B20_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الحادي والعشرون </div></td>
																			<td> <?php if ($item['B21_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B21_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B21_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B21_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B21_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B21_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B21_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B21_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B21_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B21_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B21_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B21_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B21_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B21_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B21_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B21_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B21_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B21_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B21_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B21_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B21_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B21_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B21_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B21_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الثاني والعشرون </div></td>
																			<td> <?php if ($item['B22_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B22_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B22_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B22_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B22_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B22_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B22_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B22_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B22_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B22_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B22_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B22_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B22_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B22_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B22_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B22_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B22_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B22_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B22_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B22_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B22_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B22_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B22_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B22_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;">  الجزء الثالث والعشرون  </div></td>
																			<td> <?php if ($item['B23_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B23_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B23_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B23_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B23_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B23_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B23_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B23_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B23_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B23_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B23_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B23_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B23_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B23_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B23_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B23_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B23_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B23_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B23_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B23_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B23_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B23_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B23_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B23_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الرابع والعشرون </div></td>
																			<td> <?php if ($item['B24_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B24_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B24_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B24_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B24_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B24_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B24_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B24_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B24_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B24_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B24_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B24_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B24_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B24_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B24_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B24_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B24_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B24_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B24_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B24_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B24_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B24_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B24_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B24_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الخامس والعشرون </div></td>
																			<td> <?php if ($item['B25_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B25_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B25_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B25_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B25_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B25_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B25_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B25_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B25_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B25_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B25_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B25_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B25_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B25_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B25_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B25_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B25_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B25_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B25_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B25_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B25_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B25_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B25_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B25_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء السادس والعشرون </div></td>
																			<td> <?php if ($item['B26_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B26_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B26_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B26_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B26_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B26_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B26_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B26_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B26_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B26_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B26_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B26_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B26_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B26_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B26_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B26_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B26_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B26_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B26_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B26_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B26_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B26_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B26_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B26_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء السابع والعشرون </div></td>
																			<td> <?php if ($item['B27_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B27_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B27_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B27_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B27_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B27_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B27_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B27_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B27_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B27_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B27_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B27_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B27_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B27_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B27_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B27_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B27_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B27_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B27_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B27_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B27_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B27_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B27_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B27_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الثامن والعشرون </div></td>
																			<td> <?php if ($item['B28_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B28_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B28_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B28_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B28_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B28_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B28_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B28_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B28_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B28_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B28_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B28_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B28_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B28_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B28_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B28_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B28_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B28_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B28_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B28_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B28_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B28_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B28_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B28_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء التاسع والعشرون </div></td>
																			<td> <?php if ($item['B29_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B29_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B29_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B29_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B29_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B29_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B29_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B29_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B29_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B29_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B29_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B29_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B29_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B29_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B29_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B29_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B29_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B29_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B29_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B29_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B29_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B29_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B29_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B29_8'] . '</span>';} ?> </td>
																		</tr>	
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الثلاثون </div></td>
																			<td> <?php if ($item['B30_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B30_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B30_1'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B30_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B30_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B30_2'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B30_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B30_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B30_3'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B30_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B30_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B30_4'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B30_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B30_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B30_5'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B30_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B30_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B30_6'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B30_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B30_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B30_7'] . '</span>';} ?> </td>
																			<td> <?php if ($item['B30_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B30_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B30_8'] . '</span>';} ?> </td>
																		</tr>	
																	</tbody>
																</table>
															</div>
														</div>
														<div class="col-md-12">
															<center> <img src="../layout/deplom_img/3.png" alt="Alaa Amer" class="rounded" style="width:100%;"/></center>
														</div><?php
												}
												if ( $item['stage'] == 4) {?>
														<!-- المستوى الرابع -->
														<div class="col-md-12">
															<div class="table-responsive export-table">
																<table id="" class="table table-bordered table-striped" style= "width:100%; direction:rtl;">
																	<thead><tr><th><div style="background-color:#bc0000;width:100%;color:#fff;font-family:Cairo,sans-serif">رقم</div></th><th colspan="2"><div style="background-color:#bc0000;width:100%;color:#fff;font-family:Cairo,sans-serif">الربع الأول</div></th><th colspan="2"><div style="background-color:#bc0000;width:100%;color:#fff;font-family:Cairo,sans-serif">الربع الثاني</div></th><th colspan="2"><div style="background-color:#bc0000;width:100%;color:#fff;font-family:Cairo,sans-serif">الربع الثالث</div></th><th colspan="2"><div style="background-color:#bc0000;width:100%;color:#fff;font-family:Cairo,sans-serif">الربع الرابع</div></th><th colspan="2"><div style="background-color:#bc0000;width:100%;color:#fff;font-family:Cairo,sans-serif">الربع الخامس</div></th><th colspan="2"><div style="background-color:#bc0000;width:100%;color:#fff;font-family:Cairo,sans-serif">الربع السادس</div></th><th colspan="2"><div style="background-color:#bc0000;width:100%;color:#fff;font-family:Cairo,sans-serif">الربع السابع</div></th><th colspan="2"><div style="background-color:#bc0000;width:100%;color:#fff;font-family:Cairo,sans-serif">الربع الثامن</div></th></tr></thead><thead><tr><th><div style="background-color:#bc0000;width:100%;color:#fff;font-family:Cairo,sans-serif">الجزء</div></th><th><div style="background-color:#0f6472;width:100%;color:#fff;font-family:Cairo,sans-serif">تحريري</div></th><th><div style="background-color:#0f6472;width:100%;color:#fff;font-family:Cairo,sans-serif">شفوي</div></th><th><div style="background-color:#0f6472;width:100%;color:#fff;font-family:Cairo,sans-serif">تحريري</div></th><th><div style="background-color:#0f6472;width:100%;color:#fff;font-family:Cairo,sans-serif">شفوي</div></th><th><div style="background-color:#0f6472;width:100%;color:#fff;font-family:Cairo,sans-serif">تحريري</div></th><th><div style="background-color:#0f6472;width:100%;color:#fff;font-family:Cairo,sans-serif">شفوي</div></th><th><div style="background-color:#0f6472;width:100%;color:#fff;font-family:Cairo,sans-serif">تحريري</div></th><th><div style="background-color:#0f6472;width:100%;color:#fff;font-family:Cairo,sans-serif">شفوي</div></th><th><div style="background-color:#0f6472;width:100%;color:#fff;font-family:Cairo,sans-serif">تحريري</div></th><th><div style="background-color:#0f6472;width:100%;color:#fff;font-family:Cairo,sans-serif">شفوي</div></th><th><div style="background-color:#0f6472;width:100%;color:#fff;font-family:Cairo,sans-serif">تحريري</div></th><th><div style="background-color:#0f6472;width:100%;color:#fff;font-family:Cairo,sans-serif">شفوي</div></th><th><div style="background-color:#0f6472;width:100%;color:#fff;font-family:Cairo,sans-serif">تحريري</div></th><th><div style="background-color:#0f6472;width:100%;color:#fff;font-family:Cairo,sans-serif">شفوي</div></th><th><div style="background-color:#0f6472;width:100%;color:#fff;font-family:Cairo,sans-serif">تحريري</div></th><th><div style="background-color:#0f6472;width:100%;color:#fff;font-family:Cairo,sans-serif">شفوي</div></th></tr></thead>
																	<tfoot><tr><th><div style="background-color:#bc0000;width:100%;color:#fff;font-family:Cairo,sans-serif">رقم</div></th><th colspan="2"><div style="background-color:#bc0000;width:100%;color:#fff;font-family:Cairo,sans-serif">الربع الأول</div></th><th colspan="2"><div style="background-color:#bc0000;width:100%;color:#fff;font-family:Cairo,sans-serif">الربع الثاني</div></th><th colspan="2"><div style="background-color:#bc0000;width:100%;color:#fff;font-family:Cairo,sans-serif">الربع الثالث</div></th><th colspan="2"><div style="background-color:#bc0000;width:100%;color:#fff;font-family:Cairo,sans-serif">الربع الرابع</div></th><th colspan="2"><div style="background-color:#bc0000;width:100%;color:#fff;font-family:Cairo,sans-serif">الربع الخامس</div></th><th colspan="2"><div style="background-color:#bc0000;width:100%;color:#fff;font-family:Cairo,sans-serif">الربع السادس</div></th><th colspan="2"><div style="background-color:#bc0000;width:100%;color:#fff;font-family:Cairo,sans-serif">الربع السابع</div></th><th colspan="2"><div style="background-color:#bc0000;width:100%;color:#fff;font-family:Cairo,sans-serif">الربع الثامن</div></th></tr></tfoot>
																	<tbody>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الأول </div></td>
																			<td> 
																				<?php if ($item['B1_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B1_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B1_1'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A1_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A1_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B1_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B1_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B1_2'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A1_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A1_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B1_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B1_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B1_3'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A1_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A1_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B1_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B1_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B1_4'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A1_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A1_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B1_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B1_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B1_5'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A1_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A1_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B1_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B1_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B1_6'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A1_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A1_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B1_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B1_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B1_7'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A1_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A1_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B1_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B1_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B1_8'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A1_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A1_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الثاني </div></td>
																			<td> 
																				<?php if ($item['B2_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B2_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B2_1'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A2_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A2_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B2_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B2_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B2_2'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A2_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A2_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B2_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B2_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B2_3'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A2_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A2_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B2_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B2_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B2_4'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A2_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A2_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B2_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B2_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B2_5'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A2_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A2_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B2_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B2_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B2_6'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A2_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A2_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B2_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B2_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B2_7'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A2_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A2_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B2_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B2_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B2_8'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A2_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A2_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الثالث </div></td>
																			<td> 
																				<?php if ($item['B3_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B3_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B3_1'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A3_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A3_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B3_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B3_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B3_2'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A3_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A3_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B3_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B3_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B3_3'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A3_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A3_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B3_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B3_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B3_4'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A3_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A3_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B3_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B3_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B3_5'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A3_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A3_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B3_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B3_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B3_6'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A3_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A3_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B3_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B3_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B3_7'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A3_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A3_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B3_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B3_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B3_8'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A3_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A3_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الرابع </div></td>
																			<td> 
																				<?php if ($item['B4_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B4_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B4_1'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A4_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A4_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B4_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B4_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B4_2'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A4_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A4_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B4_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B4_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B4_3'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A4_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A4_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B4_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B4_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B4_4'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A4_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A4_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B4_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B4_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B4_5'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A4_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A4_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B4_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B4_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B4_6'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A4_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A4_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B4_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B4_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B4_7'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A4_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A4_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B4_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B4_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B4_8'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A4_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A4_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الخامس </div></td>
																			<td> 
																				<?php if ($item['B5_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B5_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B5_1'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A5_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A5_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B5_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B5_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B5_2'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A5_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A5_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B5_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B5_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B5_3'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A5_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A5_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B5_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B5_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B5_4'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A5_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A5_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B5_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B5_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B5_5'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A5_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A5_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B5_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B5_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B5_6'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A5_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A5_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B5_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B5_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B5_7'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A5_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A5_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B5_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B5_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B5_8'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A5_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A5_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء السادس </div></td>
																			<td> 
																				<?php if ($item['B6_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B6_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B6_1'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A6_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A6_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B6_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B6_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B6_2'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A6_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A6_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B6_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B6_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B6_3'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A6_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A6_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B6_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B6_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B6_4'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A6_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A6_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B6_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B6_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B6_5'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A6_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A6_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B6_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B6_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B6_6'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A6_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A6_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B6_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B6_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B6_7'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A6_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A6_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B6_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B6_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B6_8'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A6_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A6_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء السابع </div></td>
																			<td> 
																				<?php if ($item['B7_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B7_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B7_1'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A7_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A7_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B7_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B7_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B7_2'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A7_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A7_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B7_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B7_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B7_3'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A7_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A7_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B7_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B7_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B7_4'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A7_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A7_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B7_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B7_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B7_5'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A7_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A7_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B7_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B7_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B7_6'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A7_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A7_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B7_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B7_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B7_7'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A7_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A7_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B7_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B7_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B7_8'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A7_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A7_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الثامن </div></td>
																			<td> 
																				<?php if ($item['B8_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B8_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B8_1'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A8_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A8_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B8_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B8_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B8_2'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A8_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A8_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B8_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B8_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B8_3'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A8_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A8_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B8_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B8_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B8_4'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A8_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A8_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B8_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B8_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B8_5'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A8_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A8_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B8_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B8_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B8_6'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A8_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A8_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B8_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B8_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B8_7'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A8_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A8_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B8_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B8_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B8_8'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A8_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A8_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء التاسع </div></td>
																			<td> 
																				<?php if ($item['B9_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B9_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B9_1'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A9_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A9_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B9_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B9_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B9_2'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A9_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A9_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B9_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B9_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B9_3'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A9_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A9_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B9_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B9_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B9_4'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A9_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A9_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B9_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B9_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B9_5'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A9_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A9_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B9_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B9_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B9_6'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A9_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A9_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B9_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B9_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B9_7'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A9_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A9_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B9_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B9_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B9_8'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A9_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A9_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء العاشر </div></td>
																			<td> 
																				<?php if ($item['B10_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B10_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B10_1'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A10_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A10_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B10_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B10_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B10_2'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A10_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A10_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B10_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B10_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B10_3'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A10_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A10_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B10_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B10_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B10_4'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A10_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A10_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B10_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B10_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B10_5'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A10_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A10_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B10_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B10_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B10_6'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A10_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A10_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B10_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B10_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B10_7'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A10_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A10_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B10_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B10_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B10_8'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A10_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A10_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الحادي عشر </div></td>
																			<td> 
																				<?php if ($item['B11_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B11_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B11_1'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A11_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A11_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B11_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B11_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B11_2'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A11_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A11_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B11_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B11_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B11_3'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A11_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A11_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B11_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B11_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B11_4'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A11_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A11_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B11_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B11_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B11_5'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A11_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A11_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B11_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B11_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B11_6'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A11_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A11_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B11_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B11_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B11_7'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A11_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A11_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B11_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B11_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B11_8'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A11_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A11_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الثاني عشر </div></td>
																			<td> 
																				<?php if ($item['B12_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B12_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B12_1'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A12_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A12_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B12_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B12_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B12_2'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A12_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A12_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B12_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B12_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B12_3'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A12_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A12_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B12_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B12_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B12_4'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A12_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A12_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B12_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B12_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B12_5'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A12_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A12_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B12_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B12_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B12_6'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A12_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A12_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B12_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B12_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B12_7'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A12_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A12_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B12_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B12_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B12_8'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A12_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A12_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الثالث عشر </div></td>
																			<td> 
																				<?php if ($item['B13_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B13_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B13_1'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A13_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A13_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B13_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B13_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B13_2'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A13_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A13_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B13_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B13_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B13_3'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A13_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A13_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B13_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B13_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B13_4'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A13_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A13_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B13_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B13_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B13_5'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A13_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A13_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B13_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B13_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B13_6'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A13_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A13_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B13_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B13_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B13_7'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A13_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A13_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B13_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B13_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B13_8'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A13_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A13_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الرابع عشر </div></td>
																			<td> 
																				<?php if ($item['B14_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B14_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B14_1'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A14_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A14_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B14_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B14_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B14_2'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A14_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A14_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B14_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B14_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B14_3'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A14_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A14_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B14_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B14_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B14_4'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A14_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A14_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B14_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B14_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B14_5'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A14_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A14_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B14_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B14_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B14_6'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A14_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A14_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B14_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B14_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B14_7'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A14_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A14_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B14_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B14_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B14_8'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A14_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A14_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الخامس عشر </div></td>
																			<td> 
																				<?php if ($item['B15_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B15_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B15_1'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A15_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A15_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B15_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B15_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B15_2'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A15_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A15_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B15_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B15_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B15_3'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A15_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A15_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B15_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B15_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B15_4'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A15_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A15_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B15_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B15_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B15_5'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A15_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A15_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B15_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B15_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B15_6'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A15_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A15_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B15_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B15_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B15_7'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A15_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A15_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B15_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B15_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B15_8'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A15_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A15_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء السادس عشر </div></td>
																			<td> 
																				<?php if ($item['B16_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B16_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B16_1'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A16_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A16_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B16_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B16_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B16_2'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A16_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A16_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B16_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B16_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B16_3'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A16_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A16_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B16_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B16_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B16_4'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A16_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A16_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B16_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B16_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B16_5'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A16_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A16_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B16_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B16_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B16_6'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A16_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A16_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B16_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B16_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B16_7'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A16_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A16_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B16_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B16_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B16_8'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A16_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A16_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء السابع عشر </div></td>
																			<td> 
																				<?php if ($item['B17_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B17_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B17_1'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A17_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A17_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B17_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B17_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B17_2'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A17_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A17_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B17_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B17_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B17_3'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A17_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A17_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B17_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B17_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B17_4'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A17_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A17_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B17_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B17_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B17_5'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A17_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A17_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B17_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B17_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B17_6'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A17_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A17_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B17_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B17_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B17_7'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A17_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A17_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B17_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B17_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B17_8'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A17_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A17_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الثامن عشر </div></td>
																			<td> 
																				<?php if ($item['B18_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B18_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B18_1'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A18_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A18_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B18_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B18_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B18_2'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A18_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A18_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B18_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B18_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B18_3'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A18_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A18_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B18_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B18_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B18_4'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A18_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A18_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B18_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B18_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B18_5'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A18_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A18_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B18_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B18_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B18_6'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A18_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A18_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B18_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B18_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B18_7'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A18_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A18_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B18_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B18_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B18_8'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A18_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A18_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء التاسع عشر </div></td>
																			<td> 
																				<?php if ($item['B19_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B19_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B19_1'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A19_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A19_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B19_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B19_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B19_2'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A19_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A19_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B19_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B19_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B19_3'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A19_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A19_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B19_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B19_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B19_4'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A19_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A19_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B19_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B19_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B19_5'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A19_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A19_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B19_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B19_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B19_6'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A19_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A19_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B19_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B19_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B19_7'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A19_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A19_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B19_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B19_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B19_8'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A19_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A19_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء العشرون </div></td>
																			<td> 
																				<?php if ($item['B20_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B20_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B20_1'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A20_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A20_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B20_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B20_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B20_2'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A20_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A20_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B20_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B20_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B20_3'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A20_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A20_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B20_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B20_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B20_4'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A20_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A20_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B20_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B20_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B20_5'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A20_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A20_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B20_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B20_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B20_6'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A20_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A20_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B20_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B20_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B20_7'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A20_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A20_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B20_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B20_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B20_8'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A20_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A20_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الحادي والعشرون </div></td>
																			<td> 
																				<?php if ($item['B21_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B21_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B21_1'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A21_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A21_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B21_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B21_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B21_2'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A21_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A21_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B21_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B21_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B21_3'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A21_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A21_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B21_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B21_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B21_4'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A21_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A21_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B21_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B21_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B21_5'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A21_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A21_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B21_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B21_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B21_6'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A21_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A21_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B21_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B21_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B21_7'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A21_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A21_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B21_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B21_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B21_8'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A21_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A21_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الثاني والعشرون </div></td>
																			<td> 
																				<?php if ($item['B22_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B22_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B22_1'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A22_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A22_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B22_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B22_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B22_2'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A22_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A22_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B22_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B22_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B22_3'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A22_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A22_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B22_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B22_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B22_4'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A22_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A22_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B22_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B22_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B22_5'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A22_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A22_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B22_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B22_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B22_6'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A22_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A22_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B22_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B22_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B22_7'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A22_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A22_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B22_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B22_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B22_8'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A22_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A22_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الثالث والعشرون </div></td>
																			<td> 
																				<?php if ($item['B23_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B23_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B23_1'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A23_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A23_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B23_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B23_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B23_2'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A23_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A23_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B23_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B23_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B23_3'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A23_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A23_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B23_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B23_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B23_4'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A23_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A23_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B23_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B23_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B23_5'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A23_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A23_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B23_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B23_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B23_6'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A23_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A23_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B23_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B23_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B23_7'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A23_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A23_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B23_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B23_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B23_8'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A23_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A23_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الرابع والعشرون </div></td>
																			<td> 
																				<?php if ($item['B24_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B24_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B24_1'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A24_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A24_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B24_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B24_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B24_2'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A24_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A24_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B24_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B24_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B24_3'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A24_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A24_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B24_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B24_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B24_4'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A24_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A24_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B24_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B24_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B24_5'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A24_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A24_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B24_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B24_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B24_6'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A24_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A24_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B24_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B24_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B24_7'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A24_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A24_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B24_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B24_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B24_8'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A24_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A24_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الخامس والعشرون </div></td>
																			<td> 
																				<?php if ($item['B25_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B25_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B25_1'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A25_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A25_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B25_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B25_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B25_2'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A25_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A25_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B25_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B25_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B25_3'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A25_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A25_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B25_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B25_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B25_4'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A25_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A25_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B25_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B25_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B25_5'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A25_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A25_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B25_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B25_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B25_6'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A25_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A25_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B25_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B25_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B25_7'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A25_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A25_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B25_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B25_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B25_8'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A25_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A25_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء السادس والعشرون </div></td>
																			<td> 
																				<?php if ($item['B26_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B26_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B26_1'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A26_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A26_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B26_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B26_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B26_2'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A26_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A26_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B26_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B26_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B26_3'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A26_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A26_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B26_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B26_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B26_4'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A26_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A26_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B26_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B26_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B26_5'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A26_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A26_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B26_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B26_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B26_6'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A26_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A26_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B26_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B26_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B26_7'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A26_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A26_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B26_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B26_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B26_8'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A26_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A26_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء السابع والعشرون </div></td>
																			<td> 
																				<?php if ($item['B27_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B27_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B27_1'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A27_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A27_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B27_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B27_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B27_2'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A27_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A27_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B27_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B27_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B27_3'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A27_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A27_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B27_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B27_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B27_4'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A27_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A27_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B27_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B27_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B27_5'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A27_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A27_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B27_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B27_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B27_6'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A27_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A27_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B27_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B27_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B27_7'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A27_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A27_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B27_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B27_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B27_8'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A27_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A27_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الثامن والعشرون </div></td>
																			<td> 
																				<?php if ($item['B28_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B28_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B28_1'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A28_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A28_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B28_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B28_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B28_2'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A28_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A28_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B28_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B28_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B28_3'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A28_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A28_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B28_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B28_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B28_4'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A28_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A28_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B28_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B28_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B28_5'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A28_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A28_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B28_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B28_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B28_6'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A28_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A28_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B28_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B28_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B28_7'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A28_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A28_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B28_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B28_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B28_8'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A28_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A28_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء التاسع والعشرون </div></td>
																			<td> 
																				<?php if ($item['B29_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B29_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B29_1'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A29_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A29_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B29_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B29_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B29_2'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A29_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A29_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B29_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B29_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B29_3'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A29_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A29_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B29_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B29_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B29_4'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A29_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A29_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B29_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B29_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B29_5'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A29_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A29_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B29_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B29_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B29_6'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A29_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A29_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B29_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B29_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B29_7'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A29_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A29_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B29_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B29_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B29_8'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A29_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A29_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																		</tr>
																		<tr>
																			<td><div style="background-color:#0b5220;width:100%;color:#fff;font-family: 'Tajawal', sans-serif;"> الجزء الثلاثون </div></td>
																			<td> 
																				<?php if ($item['B30_1'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B30_1'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B30_1'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A30_1'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A30_1'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B30_2'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B30_2'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B30_2'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A30_2'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A30_2'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B30_3'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B30_3'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B30_3'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A30_3'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A30_3'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B30_4'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B30_4'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B30_4'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A30_4'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A30_4'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B30_5'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B30_5'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B30_5'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A30_5'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A30_5'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B30_6'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B30_6'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B30_6'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A30_6'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A30_6'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B30_7'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B30_7'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B30_7'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A30_7'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A30_7'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['B30_8'] >= 5) { echo '<span style="color:#0000ff;font-weight:700;">' . $item['B30_8'] . '</span>'; }else{echo '<span style="color:#f00;font-weight:700;">' . $item['B30_8'] . '</span>';} ?>
																			</td>
																			<td> 
																				<?php if ($item['A30_8'] == '10') { echo  '<span style="color:#2b8000;font-weight:700;"> ناجح </span>';}  if ($item['A30_8'] == '0')  { echo  '<span style="color:#f00;font-weight:700;"> <i class="far fa-times-circle"></i></span>';} ?>
																			</td>
																		</tr>
																	</tbody>
																	
																</table>
															</div>
														</div>
														<div class="col-md-12">
															<center> <img src="../layout/deplom_img/4.png" alt="Alaa Amer" class="rounded" style="width:100%;"/></center>
														</div>
														<?php
													}
													?>
												
										<style>@media print{.no-print,.no-print *{display:none!important}}</style>
										<br>		
										<div class="no-print">
											<div class="button-section">
												<input type="button" value="الطباعة" class="btn btn-primary btn-lg" onclick="javascript:printDiv('printablediv')" />
											</div>
										</div>	
									</form>	
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>		
		</div>		
			
			<?php
			}else{
				echo "<div class='container'>";
					$theMsg = "<div class= 'alert alert-danger text-center'>404 خطأ في الادخال </div>" ;
					redirectHome($theMsg);
				echo "</div>";
				}
			}
	}	
}
			
}else{
	header ('location: ../index');
	exit();
}
include   $tpl . 'footer.php';
include   $tpl . 'footer-scripts.php';
ob_end_flush();
?>	