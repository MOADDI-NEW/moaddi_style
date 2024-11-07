<?php
ob_start(); //Output Buffering Start 
/* Title Function that echo version */
function jsVersion()
{
	return "v3-0-0-8";
}
/* Title Function that echo the page title */
function getTitle()
{
	global $pageTitle;
	if (isset($pageTitle)) {
		echo $pageTitle;
	} else {
		echo 'Moaddi';
	}
}

/* Redirct Function */
function redirectHome($theMsg, $url = null, $seconds = 3)
{
	if ($url === null) {
		$url = 'index';
		$link = 'Home Page';
	} else {
		if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== '') {
			$url = $_SERVER['HTTP_REFERER'];
		} else {
			$url = 'index';
			$link = 'Previous Page';
		}
	}
	echo $theMsg;
	echo "<div class= 'alert alert-info' style='text-align: center;'>  ثم يتم تحويلك تلقائيا في غضون  <span style='font-size:20px;color:#fb6109;padding:10px;background-color:#000000a3;'> $seconds </span>   ثواني ... برجاء الانتظار  </div>";
	header("refresh:$seconds;url=$url");
	exit();
}


/* Function to check Item In Data Base */

function checkItem($select, $from, $value)
{
	global $con;
	$statement = $con->prepare("SELECT $select FROM $from WHERE $select = ?");
	$statement->execute(array($value));
	$count = $statement->rowCount();
	return $count;
}


/* Function to count items2 Item In Data Base */
function countItems2($item, $table, $where)
{
	global $con;
	$stmt2 = $con->prepare("SELECT COUNT($item) FROM $table Where $where");
	$stmt2->execute();
	return $stmt2->fetchColumn();
}

/* Function to Sum items2 Item In Data Base */
function sumItems2($item, $table, $where)
{
	global $con;
	$stmt2 = $con->prepare("SELECT SUM($item) FROM $table Where $where");
	$stmt2->execute();
	return $stmt2->fetchColumn();
}

function get_total_amounts($column_name) {
    global $con;
    $sql = "SELECT SUM(CASE WHEN $column_name = 2 THEN ($column_name * p.amount) / 2 ELSE $column_name * p.amount END) AS total_amounts
            FROM packages p
            INNER JOIN users u ON u.stage = p.id 
            WHERE u.RegStatus = 1;";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_amounts = $result['total_amounts'];

    return $total_amounts;
}

function getAmountsPaid($column_name) {
	global $con;
    $sql = "SELECT SUM(CASE WHEN $column_name = 2 THEN ($column_name * p.amount) / 0 ELSE $column_name * p.amount END) AS amounts_paid
            FROM users u
            INNER JOIN packages p ON u.stage = p.id WHERE u.RegStatus = 1;";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $amounts_paid = $result['amounts_paid'];
    return $amounts_paid;
}

function getDueFromClients($column_name) {
    global $con;
    $sql = "SELECT SUM(p.amount) AS due_from_clients
            FROM users u
            INNER JOIN packages p ON u.stage = p.id
            WHERE $column_name = 2 AND u.RegStatus = 1";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $due_from_clients = $result['due_from_clients'];
    return $due_from_clients;
}


function getPaidSubscribers_01($B30_1) {
    global $con;
    $stmt = $con->prepare("SELECT * FROM users WHERE role = 44 AND B30_1 = :B30_1 AND RegStatus = 1 ORDER BY UserID DESC");
    $stmt->bindParam(':B30_1', $B30_1); $stmt->execute(); $rows = $stmt->fetchAll();
    if (! empty($rows)){
        echo '<div class="container-fluid"><div class="row row-sm"><div class="col-lg-12"><div class="card"><div class="card-header"></div><div class="card-body"><div class="table-responsive export-table"><table id="" class="table table-bordered table-striped" style= "width:100%; direction:rtl;">
        <thead><th> #</th><th> المشترك</th><th> المدينة</th><th> الحزمة </th><th> المبلغ </th><th> - الحالة - </th></tr></thead><tbody>';
        $i = 1;
        foreach($rows as $row){
            echo "<tr>";
            echo "<td>". $i++. "</td>";
            echo "<td>". $row['FullName']. "</td>";
            echo "<td>";  
                if($row['al_city'] == 1){ echo "كفر الشيخ";} if($row['al_city'] == 2){ echo "بيلا";} if($row['al_city'] == 3){ echo "الحامول";} if($row['al_city'] == 4){ echo "بلطيم";} if($row['al_city'] == 5){ echo "مطوبس";} if($row['al_city'] == 6){ echo "دسوق";} if($row['al_city'] == 7){ echo "فوه";} if($row['al_city'] == 8){ echo "برج البرلس";} if($row['al_city'] == 9){ echo "سيدي سالم";} if($row['al_city'] == 10){ echo "قلين";} if($row['al_city'] == 11){ echo "سيدي غازي";} if($row['al_city'] == 12){ echo "الرياض";}
            echo "</td>";
            echo "<td>";  $stmt = $con->prepare("SELECT * FROM packages"); $stmt->execute(); $users = $stmt->fetchAll(); foreach ($users as $user) { if ($row['stage'] == $user['id']){ echo  $user['package']; } }   echo "</td>";
            echo "<td>";  $stmt = $con->prepare("SELECT * FROM packages"); $stmt->execute(); $users = $stmt->fetchAll(); foreach ($users as $user) { if ($row['stage'] == $user['id']){ echo  $user['amount']; } }   echo "</td>";
            echo "<td>"; if ($row['B30_1'] == 2){  echo '<span class="btn btn-sm btn-danger w-100 text-dark"> لم يسدد </span>'; }  if ($row['B30_1'] == 1){ echo '<span class="btn btn-sm btn-success w-100 text-dark"> سدد </span>';  } if ($row['B30_1'] == 0){  echo '<span class="btn btn-sm btn-info w-100 text-dark">  غير مشترك </span>'; }echo "</td>"; 
            echo "</tr>";
        } 
        echo '</tbody>';
		echo '<tfooter><tr><th></th><th></th><th></th><th></th>'; if ($row['B30_1'] == 2){ echo '<th class="bg-danger text-dark">'; $due_from_clients = getDueFromClients('u.B30_1'); echo $due_from_clients; echo'</th>'; } if ($row['B30_1'] == 1){  echo '<th class="bg-success text-dark">'; $amounts_paid = getAmountsPaid('u.B30_1'); echo $amounts_paid; echo'</th>'; } if ($row['B30_1'] == 0){  echo '<th class="bg-info text-dark">';  echo 'غير مشترك';  echo'</th>'; }
		echo '<th></th></tr></tfooter></table></div></div></div></div></div></div>';
    } else{ echo '<div class="container">'. '<div class="nice-message"> لا يوجد مستخدمين للعرض</div>'. '</div>'; } 
}


