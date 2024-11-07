<?php 
ob_start(); //Output Buffering Start 
include 'dashbord/admin/connect.php';
include 'dashbord/functions/admin_functions.php';
include 'dashbord/functions/front_functions.php';
$settings = getSettingsToHomePage($con); 
$pageTitle = $settings[0] . ' _ ' .'الرئيسية';  
include 'front_temp/head.php';
include 'front_temp/navbar.php'; ?>
   <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
      <div class="container">
         <h1 class="page-title">Moaddi <span> Brand companies & Factories </span></h1>
      </div>
   </div>
   <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
      <div class="container">
         <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="./">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Brand companies & Factories</li>
         </ol>
      </div>
   </nav>


   <main class="main">
      <link rel="stylesheet" href="assets/css/demos/demo-4.css">
      <div class="intro-slider-container mb-5">
            <div class="intro-slider owl-carousel owl-theme owl-nav-inside owl-light" data-toggle="owl" data-owl-options='{ "dots": true, "nav": false,  "responsive": { "1200": { "nav": true, "dots": false } }, "autoplay": true, "autoplayTimeout": 4000 }'>

               <div class="intro-slide" style="background-image: url(assets/images/demos/demo-4/slider/slide-1.png);">
                  <div class="container intro-content">
                        <div class="row justify-content-end">
                           <div class="col-auto col-sm-7 col-md-6 col-lg-5">
                              <h3 class="intro-subtitle text-primary"> Unlock new markets and boost sales with Moaddi vending solutions </h3>
                              <h1 class="intro-title text-primary">Moaddi</h1>
                              <a href="./dashbord/" class="btn btn-primary btn-round"><span>JOIN NOW !</span><i class="icon-long-arrow-right"></i>
                              </a>
                           </div>
                        </div>
                  </div>
               </div>
               <div class="intro-slide" style="background-image: url(assets/images/demos/demo-4/slider/slide-2.png);">
                  <div class="container intro-content">
                        <div class="row justify-content-end">
                           <div class="col-auto col-sm-7 col-md-6 col-lg-5">
                              <h3 class="intro-subtitle text-primary"> Your products, our machines – a powerful partnership for success! </h3>
                              <h1 class="intro-title text-primary">Moaddi</h1>
                              <a href="./dashbord/" class="btn btn-primary btn-round"><span>JOIN NOW !</span><i class="icon-long-arrow-right"></i>
                              </a>
                           </div>
                        </div>
                  </div>
               </div>

            </div>
            <span class="slider-loader"></span>
      </div>
   </main>





   <div class="page-content">
      <div class="container">
         <div class="row mb-5 mt-5">
            <div class="col-lg-12 col-md-12">
                  <div class="banner banner-display mb-0">
                     <a href="dashbord/">
                        <img src="assets/images/backgrounds/bg-4.jpg" alt="Banner">
                     </a>
                     <div class="banner-content">
                        <h4 class="banner-subtitle text-darkwhite"><a href="#">Moaddi</a></h4>
                        <h3 class="banner-title text-white"><a href="#">Brand companies & Factories</a></h3>
                        <a href="dashbord/" class="btn btn-outline-white banner-link"> Join Now !<i class="icon-long-arrow-right"></i></a>
                     </div>
                  </div>
            </div>
         </div>
         <div class="row">
            <?php
            $stmt = $con->prepare("SELECT * FROM brand_front_page ORDER BY id DESC");
				$stmt->execute();
				$rows = $stmt->fetchAll();
				if (! empty($rows)){ ?>
               <div class="col-lg-12">
                  <?php foreach ($rows as $row ) {
                     echo "<div>".$row['text_page']."</div>";
                  }?>
               </div><?php
            } ?>
         </div>
      </div>
      <?php 
         $stmt = $con->prepare("SELECT * FROM clints  ORDER BY clint_id DESC");
         $stmt->execute();
         $items = $stmt->fetchAll();
         if (! empty($items)){?>
            <div class="mb-6"></div>
            <div class="container">
               <hr class="mt-3 mb-3">
               <h2 class="title-lg text-center mb-3 mb-md-4">Success partners</h2>
            </div>
            <div class="container mb-5 mt-5">
               <div class="owl-carousel owl-simple" data-toggle="owl" data-owl-options='{ "nav": false,  "dots": false, "margin": 30, "loop": true, "responsive": { "0": { "items":2 }, "420": { "items":3 }, "600": { "items":4 }, "900": { "items":5 }, "1024": { "items":6 } }, "autoplay": true, "autoplayTimeout": 4000 }'>
                  <?php 
                  foreach ($items as $item) { ?>
                     <a href="<?php echo $item['brand_url'];?>" class="brand">
                        <img src="./dashbord/admin/nsharat_uploads/avatar55/<?php echo $item['avatar55'];?>" alt="<?php echo $item['clint_name'];?>">
                     </a><?php 
                  } ?>
               </div>
            </div><?php 
         } ?>
   </div>






<?php
include 'front_temp/footer.php';
include 'front_temp/footer_script.php';
ob_end_flush();
