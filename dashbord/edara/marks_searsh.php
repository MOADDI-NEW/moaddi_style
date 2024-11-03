<?php
ob_start();
session_start();
$noNavbar = '';
$main_header_edara = '';
$main_sidebar_edara = '';

$pageTitle = 'البحث عن مشترك بالاسم';
	if (isset($_SESSION['Edara30'])){
	include 'init.php';

if (isset($_SESSION['Edara30'])){
	$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
	$getUser->execute(array($_SESSION['Edara30']));
	$info = $getUser->fetch();

	if (array_search($info['role'], ['30']) !== false) { // شرق ?>
					<?php
					$con->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);	
					// (2) SEARCH
					$stmt = $con->prepare("SELECT *  FROM `users` WHERE `FullName` LIKE ?");
					$stmt->execute(["%" . $_POST['search'] . "%"]);
					$results = $stmt->fetchAll();
					if (isset($_POST['ajax'])) {
						echo json_encode($results);
					}?>
	<div class="main-content app-content"> 
		<!-- breadcrumb -->
		<?php include 'breadcrumb.php';?>
		<!-- /breadcrumb -->
		
		
		<div class="container-fluid">
			<div class="row row-sm">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header"><h3 class="card-title text-center">نتائج البحث عن مشترك</h3></div>
						<div class="card-body">
							<?php
							if (isset($_POST['search'])) {
								if (count($results) > 0) {
							?>
							<div class="table-responsive export-table">
								<table id="example" class="table table-bordered table-striped" style= "width:98%; direction:rtl;">
									<thead>
										<tr>
											<th> المشترك</th>
											<th> التحكم </th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($results as $r) {?>
										<tr>
											<td><?php echo   $r['FullName'] ; ?></td> 
											<td style="text-align: center;"><?php 
												echo"<a href='member_client?memberid=315&formerror=form&action=employee&emplyeeid=3265&action=grtstat&grtstat=359&formerror=9853&getid=63524&iteimid=32145&checksum=56821&cookie=30121&do=Edit2&userid=" . $r['UserID'] ."&counksum=93214&action=421' class='btn btn-block btn-sm btn-danger'>تعديل المدفوعات</a>"; ?>
											</td>
										</tr><?php 
										} ?>
									</tbody>
								</table>
							</div>
								<?php
								} else {
									echo '<div class="nice-message"> لا يوجد مشتركين للعرض</div>';
								}
							}
									?>
						</div>
					</div>
				</div>
			</div>
		</div>		
	</div>			
		<?php
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