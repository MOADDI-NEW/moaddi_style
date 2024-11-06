<?php 
ob_start(); //Output Buffering Start 
include 'dashbord/admin/connect.php';
include 'dashbord/functions/admin_functions.php';
include 'dashbord/functions/front_functions.php';
$settings = getSettingsToHomePage($con); 
$pageTitle = $settings[0] . ' _ ' .'About :';  
include 'front_temp/head.php';
include 'front_temp/navbar.php';
?>
   <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
      <div class="container">
         <h1 class="page-title">About us <span>Moaddi</span></h1>
      </div>
   </div>
   <nav aria-label="breadcrumb" class="breadcrumb-nav">
         <div class="container">
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="./">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">About us </li>
            </ol>
         </div>
   </nav>
   <div class="page-content pb-3">
      <div class="container">
         <div class="row">
            <div class="col-lg-10 offset-lg-1">
                  <div class="about-text text-center mt-3">
                     <h2 class="title text-center mb-2">Who We Are</h2>
                     <p class="lead text-primary mb-3"><?php echo $settings['2'];?></p>
                     <p class="mb-2"><?php echo $settings['3'];?></p>
                     <img src="assets/images/about/about-2/signature.png" alt="signature" class="mx-auto mb-5">
                  </div>
            </div>
         </div>
      </div>
      <div class="mb-2"></div>
      <div class="bg-image pt-7 pb-5 pt-md-12 pb-md-9" style="background-image: url(assets/images/backgrounds/bg-4.jpg)">
         <div class="container">
            <div class="row">
                  <div class="col-6 col-md-3">
                     <div class="count-container text-center">
                        <div class="count-wrapper text-white">
                              <span class="count" data-from="0" data-to="40" data-speed="3000" data-refresh-interval="50">0</span>k+
                        </div>
                        <h3 class="count-title text-white">Happy Customer</h3>
                     </div>
                  </div>

                  <div class="col-6 col-md-3">
                     <div class="count-container text-center">
                        <div class="count-wrapper text-white">
                              <span class="count" data-from="0" data-to="20" data-speed="3000" data-refresh-interval="50">0</span>+
                        </div>
                        <h3 class="count-title text-white">Years in Business</h3>
                     </div>
                  </div>

                  <div class="col-6 col-md-3">
                     <div class="count-container text-center">
                        <div class="count-wrapper text-white">
                              <span class="count" data-from="0" data-to="95" data-speed="3000" data-refresh-interval="50">0</span>%
                        </div>
                        <h3 class="count-title text-white">Return Clients</h3>
                     </div>
                  </div>

                  <div class="col-6 col-md-3">
                     <div class="count-container text-center">
                        <div class="count-wrapper text-white">
                              <span class="count" data-from="0" data-to="15" data-speed="3000" data-refresh-interval="50">0</span>
                        </div>
                        <h3 class="count-title text-white">Awards Won</h3>
                     </div>
                  </div>
            </div>
         </div>
      </div>
      <div class="container mt-5">
               <div class="row">
                  <div class="col-lg-10 offset-lg-1">
                        <div class="brands-text text-center mx-auto mb-6">
                           <h2 class="title"> Our Success partners </h2>
                        </div>
                        <?php 
                        $stmt = $con->prepare("SELECT * FROM clints  ORDER BY clint_id DESC");
                        $stmt->execute();
                        $items = $stmt->fetchAll();
                        if (! empty($items)){?>
                           <div class="brands-display">
                              <div class="row justify-content-center">
                              <?php 
                              foreach ($items as $item) { ?>
                                 <div class="col-6 col-sm-4 col-md-3">
                                       <a href="<?php echo $item['brand_url'];?>" class="brand">
                                          <img src="./dashbord/admin/nsharat_uploads/avatar55/<?php echo $item['avatar55'];?>" alt=<?php echo $item['clint_name'];?>">
                                       </a>
                                 </div>
                                 <?php 
                              } ?>
                              </div>
                           </div><?php  
                        } ?>

                  </div>
               </div>
            </div>
      </div>
   </div>   
<?php
include 'front_temp/footer.php';
include 'front_temp/footer_script.php';
ob_end_flush();
