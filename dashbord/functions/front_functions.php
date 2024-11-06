<?php
function getSettingsToHomePage($con)
{
    global $con;
    $stmt = $con->prepare("SELECT * FROM settings ORDER BY id DESC");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return array(
        $row['site_name'],          // 0
        $row['site_desc'],          // 1
        $row['about_1'],            // 2
        $row['about_2'],            // 3
        $row['about_vedio'],        // 4
        $row['about_3'],            // 5
        $row['address'],            // 6
        $row['email'],              // 7
        $row['phone'],              // 8
        $row['facebook'],           // 9
        $row['youtube'],            // 10
        $row['twitter'],            // 11
        $row['instagram']           // 12
    );
}



//============
function getSideMenuNews($con) {
    global $con;
    $stmt = $con->prepare("SELECT * FROM items ORDER BY Item_ID DESC LIMIT 3");
    $stmt->execute();
    $rows = $stmt->fetchAll();
    $html = "";
    if (!empty($rows)) {
        foreach ($rows as $item) {
            $html.= "<div class='col-md-4 mb-4'>";
                $html.= "<div class='card border-0 mb-2'>";
                    $html.= "<a href='single_news?do=View&NewsId=". $item['Item_ID']. "'><img src='halwany_back/admin/nsharat_uploads/avatar/". $item['news_img']. "' width='350' height='233' class='card-img-top' alt='' /></a>";
                    $html.= "<div class='card-body bg-white p-4'>";
                        $html.= "<div class='d-flex align-items-center mb-3'>";
                            $html.= "<a class='btn btn-primary' href='single_news?do=View&NewsId=". $item['Item_ID']. "'><i class='fa fa-link'></i></a>";
                            $html.= "<h5 class='m-0 mr-3 py-1 text-truncate'>". $item['title'] . "</h5>";
                        $html.= "</div>";

                            $path = $item['path'];
                            $shortpath = implode(' ', array_slice(explode(' ', $path), 0, 15));
                            $html.= "<p dir='rtl'>" .$shortpath." </p>";
                        $html.= "<div class='d-flex justify-content-around'>";
                            $html.= "<small class='mr-3'><i class='fa fa-user text-primary'></i> مدير الموقع </small>";
                            $html.= "<small class='mr-3'><i class='fa fa-folder text-primary'></i> ". $item['nashra_date']. " </small>";
                            $html.= "<small class='mr-3'><i class='fa fa-comments text-primary'></i> 15 </small>";
                        $html.= "</div>";
                    $html.= "</div>";
                $html.= "</div>";
            $html.= "</div>";
        }
        
    }
    return $html;
}

function getRelatedNews($con) {
    global $con;
    $stmt = $con->prepare("SELECT * FROM items ORDER BY Item_ID DESC LIMIT 5");
    $stmt->execute();
    $rows = $stmt->fetchAll();
    $html = "";
    if (!empty($rows)) {
        foreach ($rows as $item) {
            $html.= "<div class='card border-0 mx-3'>";
                $html.= "<a href='single_news?do=View&NewsId=". $item['Item_ID']. "'><img src='halwany_back/admin/nsharat_uploads/avatar/". $item['news_img']. "' width='349' height='233' class='card-img-top' alt='' /></a>";
                $html.= "<div class='card-body bg-light p-4'>";
                    $html.= "<div class='d-flex align-items-center mb-3' dir='rtl'>";
                        $html.= "<a class='btn btn-primary' href='single_news?do=View&NewsId=". $item['Item_ID']. "'><i class='fa fa-link'></i></a>";
                        $html.= "<h5 class='m-0 mr-3 text-truncate'>". $item['title'] . "</h5>";
                    $html.= "</div>";
                    $path = $item['path'];
                    $shortpath = implode(' ', array_slice(explode(' ', $path), 0, 15));
                    $html.= "<p dir='rtl'>" .$shortpath." </p>";
                    $html.= "<div class='d-flex' dir='rtl'>";
                        $html.= "<small class='mr-3'><i class='fa fa-user text-primary'></i> مدير الموقع  </small>";
                        $html.= "<small class='mr-3'><i class='fa fa-folder text-primary'></i> ". $item['nashra_date']. " </small>";
                        $html.= "<small class='mr-3'><i class='fa fa-comments text-primary'></i> 15</small>";
                    $html.= "</div>";
                $html.= "</div>";
            $html.= "</div>";
        }
        
    }
    return $html;
}

//========




// =============
function getNewsTitle($NewId, $con) {
    global $con;
    $stmt = $con->prepare("SELECT title FROM items WHERE Item_ID = ? LIMIT 1");
    $stmt->execute(array($NewId));
    $row = $stmt->fetch();

    if ($stmt->rowCount() > 0) {
        return $row['title'];
    } else {
        return null;
    }
}
//==========






