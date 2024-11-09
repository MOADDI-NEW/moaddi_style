<?php 
ob_start(); //Output Buffering Start 
include 'dashbord/admin/connect.php';
include 'dashbord/functions/admin_functions.php';
include 'dashbord/functions/front_functions.php';
$settings = getSettingsToHomePage($con); 
$pageTitle = $settings[0] . ' _ ' .'FAQ';  
include 'front_temp/head.php';
include 'front_temp/navbar.php';
?>

   <main class="main">
      <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
         <div class="container">
            <h1 class="page-title">F.A.Q<span><?php echo $settings[0]; ?></span></h1>
         </div>
      </div>
      <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="./">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">FAQ</li>
               </ol>
            </div>
      </nav>
      <div class="page-content">
         <div class="container">
            <?php 
            $stmt = $con->prepare("SELECT * FROM faq ORDER BY faq_id DESC");
            $stmt->execute();
            $rows = $stmt->fetchAll();
            if (!empty($rows)) { ?>
         <h2 class="title text-center mb-3">Frequently Asked Questions</h2>
         <div class="accordion accordion-rounded" id="accordion-1">
               <?php 
               foreach ($rows as $index => $row) {
                  // Generate unique IDs for each accordion item using the index
                  $collapseId = "collapse-" . $index;
                  $headingId = "heading-" . $index;
                  $expanded = $index === 0 ? "true" : "false";  // Only expand the first tab initially
                  $show = $index === 0 ? "show" : "";  // Add 'show' class only to the first item for initial open state
               ?>
                  <div class="card card-box card-sm bg-light">
                     <div class="card-header" id="<?php echo $headingId; ?>">
                           <h2 class="card-title">
                              <a role="button" data-toggle="collapse" href="#<?php echo $collapseId; ?>" aria-expanded="<?php echo $expanded; ?>" aria-controls="<?php echo $collapseId; ?>">
                                 <?php echo $row['faq_Q']; ?>
                              </a>
                           </h2>
                     </div>
                     <div id="<?php echo $collapseId; ?>" class="collapse <?php echo $show; ?>" aria-labelledby="<?php echo $headingId; ?>" data-parent="#accordion-1">
                           <div class="card-body">
                              <?php echo $row['faq_An']; ?>
                           </div>
                     </div>
                  </div>
               <?php 
               } ?>
         </div><?php 
            } ?>
         </div>
      </div>

      <div class="cta cta-display bg-image pt-4 pb-4" style="background-image: url(assets/images/backgrounds/cta/bg-7.jpg);">
            <div class="container">
               <div class="row justify-content-center">
                  <div class="col-md-10 col-lg-9 col-xl-7">
                        <div class="row no-gutters flex-column flex-sm-row align-items-sm-center">
                           <div class="col">
                              <h3 class="cta-title text-white">If You Have More Questions</h3>
                              <p class="cta-desc text-white">Do not hesitate to ask and contact us immediately.</p>
                           </div>
                           <div class="col-auto">
                              <a href="contact" class="btn btn-outline-white"><span>CONTACT US</span><i class="icon-long-arrow-right"></i></a>
                           </div>
                        </div>
                  </div>
               </div>
            </div>
      </div>
   </main>
<?php
include 'front_temp/footer.php';
include 'front_temp/footer_script.php';
ob_end_flush();
