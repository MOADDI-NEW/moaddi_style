<?php 
ob_start();
session_start();
$noNavbar = '';
$main_header_school = '';
$main_sidebar_school = '';
$pageTitle = 'النشرات الوادة من الإدارة';  // this function to load page title
include 'init.php';   //  Dirctory page

if (isset($_SESSION['user'])){
$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
$getUser->execute(array($sessionUseer));
$info = $getUser->fetch(); ?>
			<?php include 'breadcrumb.php';
		$itemid = isset($_GET['itemid'])&& is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;
			$stmt = $con->prepare("SELECT * FROM items2, categories ,users
									WHERE categories.ID = items2.Cat_ID
									AND	 users.UserID = items2.Member_ID
									AND Item_ID = ?	");
						$stmt->execute(array($itemid));
						$item = $stmt->fetch(); ?>	

	<script type="text/javascript">function printDiv(n){var e=document.getElementById(n).innerHTML,t=document.body.innerHTML;document.body.innerHTML="<html><head><title></title></head><body>"+e+"</body>",window.print(),document.body.innerHTML=t}</script>
	<div id="printablediv">	<!--  Start div to print  -->
		<div class="container-fluid">		
			<div class="row row-sm row-deck">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header"><h3 class="card-title text-center"><?php echo $info['FullName']?></h3></div>
						<div class="card-body">
							<div class="table-responsive export-table">
								<table class="table table-bordered table-striped">
									<thead><tr><th scope="col">تاريخ النشرة</th><th scope="col">اسم الراسل</th><th scope="col">المرسل اليه</th></tr></thead>
									<tbody>
										<tr>
											<th scope="row" style="text-align:center;"><?php echo $item['nashra_date']?></th>
											<th scope="row" style="text-align:center;"><?php echo $item['FullName']?></th>
											<th scope="row" style="text-align:center;"><?php echo $info['FullName']?></th>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>	
			</div>
			<div class="row row-sm row-deck">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-body">
							<div class="col-md-12 col-sm-12">	
								<label>عنوان النشرة</label>
								<div class="shadow1"> 
									<?php echo $item['title']?> 
								</div>
							</div>
							<div class="col-md-12 col-sm-12">	
								<label>ملخص النشرة</label>
								<div class="shadow1" style="line-height:35px;"> 
									<?php echo $item['path']?> 
								</div>
							</div>
						</div>	
					</div>		
				</div>			
			</div>
			
					<style>@media print{.no-print,.no-print *{display:none!important}}</style>
					<br>		
					<div class="no-print">
						<div class="button-section">
							<input type="button" value="الطباعة" class="btn btn-primary btn-lg" onclick="javascript:printDiv('printablediv')" />
						</div>
					</div>		
		</div>
	</div>


	
	
<?php 
	}else{
	header ('location: index');
	exit();
		}
		include   $tpl . 'footer.php';
		include   $tpl . 'footer-scripts.php';
		ob_end_flush();
?>