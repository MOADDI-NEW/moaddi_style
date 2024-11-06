<?php 
ob_start(); //Output Buffering Start 
include 'dashbord/admin/connect.php';
include 'dashbord/functions/admin_functions.php';
include 'dashbord/functions/front_functions.php';
$settings = getSettingsToHomePage($con); 
$pageTitle = $settings[0] . ' _ ' .'الرئيسية';  
include 'front_temp/head.php';
include 'front_temp/navbar.php';
?>

<?php 
$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';     // shor if 
   if($do == 'Manage'){ //=========== Start Manage Page ============
   }elseif($do == 'View'){
      $itemid = isset($_GET['itemid'])&& is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;
		$stmt = $con->prepare("SELECT * FROM items WHERE Item_ID = ?");
		$stmt->execute(array($itemid));
		$item = $stmt->fetch();
		$count = $stmt->rowCount();
		if ($stmt->rowCount() > 0 ){ ?> 
         <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
            <div class="container">
               <h1 class="page-title">Moaddi News<span><?php echo $item['title'];?> </span></h1>
            </div>
         </div>
         <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
            <div class="container">
               <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="./">Home</a></li>
                     <li class="breadcrumb-item active" aria-current="page"><?php echo $item['title'];?></li>
               </ol>
            </div>
         </nav>
         <div class="page-content">
            <div class="container">
               <div class="row">
                  <div class="col-lg-9">
                        <article class="entry single-entry">
                           <figure class="entry-media">
                                 <img src="./dashbord/admin/nsharat_uploads/avatar/<?php echo $item['news_img'];?>" alt="image desc">
                           </figure>

                           <div class="entry-body">
                                 <div class="entry-meta">
                                    <span class="entry-author">
                                       by <a href="">Admin</a>
                                    </span>
                                    <span class="meta-separator">|</span>
                                    <a href=""><?php echo $item['nashra_date'];?></a>
                                 </div>

                                 <h2 class="entry-title"><?php echo $item['title'];?></h2>

                                 <div class="entry-content editor-content">
                                    <p><?php echo $item['path'];?></p>
                                    <div class="pb-1"></div>

                                 <div class="entry-footer row no-gutters flex-column flex-md-row">
                                    <div class="col-md-auto mt-2 mt-md-0">
                                       <div class="social-icons social-icons-color">
                                             <span class="social-label">Share this post:</span>
                                             <a href="#" class="social-icon social-facebook" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                             <a href="#" class="social-icon social-twitter" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                             <a href="#" class="social-icon social-pinterest" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                                             <a href="#" class="social-icon social-linkedin" title="Linkedin" target="_blank"><i class="icon-linkedin"></i></a>
                                       </div>
                                    </div>
                                 </div>
                           </div>
                        </article>


                        <div class="related-posts">
                           <h3 class="title">Related Posts</h3><!-- End .title -->
                           <div class="owl-carousel owl-simple" data-toggle="owl" data-owl-options='{ "nav": false,  "dots": true, "margin": 20, "loop": false, "responsive": { "0": { "items":1 }, "480": { "items":2 }, "768": { "items":3 } }, "autoplay": true, "autoplayTimeout": 3000 }'>
                              <?php // Post Section  
                              $stmt = $con->prepare("SELECT * FROM items  ORDER BY Item_ID DESC LIMIT 8");
                              $stmt->execute();
                              $posts = $stmt->fetchAll();
                              if (! empty($posts)){
                                 foreach($posts as $post){  ?>
                                    <article class="entry entry-grid">
                                       <figure class="entry-media">
                                          <a href="single.html">
                                                <img src="./dashbord/admin/nsharat_uploads/avatar/<?php echo $post['news_img'];?>" alt="image desc">
                                          </a>
                                       </figure>
                                       <div class="entry-body">
                                          <div class="entry-meta"><a href=""><?php echo $post['nashra_date'];?></a></div>
                                          <h2 class="entry-title">
                                                <?php echo '<a href="?do=View&itemid='.$post['Item_ID'].'">'. $post['title'].'></a>'; ?>
                                          </h2>
                                       </div>
                                    </article><?php
                                 }
                              } ?>

                           </div>
                        </div>
                  </div><!-- End .col-lg-9 -->

                  <aside class="col-lg-3">
                     <div class="sidebar">
                           <div class="widget">
                              <h3 class="widget-title">Popular Posts</h3>
                              <ul class="posts-list">
                                 <?php // Post Section  
                                 $stmt = $con->prepare("SELECT * FROM items  ORDER BY Item_ID DESC LIMIT 8");
                                 $stmt->execute();
                                 $posts = $stmt->fetchAll();
                                 if (! empty($posts)){
                                    foreach($posts as $post){  ?>
                                       <li>
                                          <?php echo '<figure><a href="?do=View&itemid='.$post['Item_ID'].'"><img src="./dashbord/admin/nsharat_uploads/avatar/'. $post['news_img'].'" alt="post"></a></figure>';?>
                                          <div><span><?php echo $post['nashra_date'];?></span><h4>
                                          <?php echo '<a href="?do=View&itemid='.$post['Item_ID'].'">'. $post['title'].'></a>'; ?>
                                          </h4></div>
                                       </li><?php 
                                    } 
                                 } ?>
                              </ul>
                           </div>

                           <div class="widget widget-banner-sidebar">
                                 <div class="banner-sidebar-title">Brand companies & Factories</div>
                                 
                                 <div class="banner-sidebar">
                                    <a href="brand">
                                       <img src="assets/images/blog/sidebar/banner.jpg" alt="banner">
                                    </a>
                                 </div>
                           </div>
                     </div>
                  </aside>
               </div>
            </div>
         </div> <?php 
      }
   } ?>



<?php
include 'front_temp/footer.php';
include 'front_temp/footer_script.php';
ob_end_flush();
