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

<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
   <div class="container">
      <h1 class="page-title">Contact us<span>keep in touch with us </span></h1>
   </div>
</div>
<nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
   <div class="container">
      <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Contact us</li>
      </ol>
   </div>
</nav>
<div class="page-content pb-0">
      <div class="container">
         <div class="row">
            <div class="col-lg-6 mb-2 mb-lg-0">
               <h2 class="title mb-1">Contact Information</h2>
               <p class="mb-3"><?php echo $settings['3'];?></p>
               <div class="row">
                  <div class="col-lg-12">
                     <div class="contact-info">
                        <h3>The Office</h3>
                        <ul class="contact-list">
                           <li><i class="icon-map-marker"></i><?php echo $settings['6'];?></li>
                           <!-- <li><i class="icon-phone"></i><a href="tel:<?php echo $settings['8'];?>"><?php echo $settings['8'];?></a></li> -->
                           <li><i class="icon-envelope"></i><a href="mailto:<?php echo $settings['7'];?>"><?php echo $settings['7'];?></a></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-6">
               <h2 class="title mb-1">Got Any Questions?</h2>
               <p class="mb-2">Use the form below to get in touch with the sales team</p>
               <?php
                  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                     $formErrors = array();

                     $FullName  = $_POST['FullName'];
                     $Email = filter_var($_POST['Email'], FILTER_SANITIZE_EMAIL);
                     $phone  = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
                     $Country  = $_POST['Country'];
                     $City  = $_POST['City'];
                     $mes_1  = $_POST['mes_1'];
                     if (isset($FullName)) {
                           $filterdUser = filter_var($FullName, FILTER_SANITIZE_STRING);
                           if (strlen($filterdUser) < 3) {
                              $formErrors[] = "<div id='success-alert' class='alert alert-danger'> Name must be more than 3 letters </div>";
                           }
                           if (strlen($filterdUser) > 50) {
                              $formErrors[] = "<div id='success-alert' class='alert alert-danger'> Name must be less than 50 characters. </div>";
                           }
                     }
                     if (isset($email)) {
                           $filterdEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
                           if (filter_var($filterdEmail, FILTER_VALIDATE_EMAIL) != true) {
                              $formErrors[] = "<div id='success-alert' class='alert alert-danger'> Invalid email </div>";
                           }
                     }
                     if (isset($phone)) {
                           $filterdPhone = filter_var($phone, FILTER_SANITIZE_STRING);
                           if (empty($phone)) {
                              $formErrors[] = "<div id='success-alert' class='alert alert-danger'> Phone number cannot be left </div>";
                           }
                     }
                     if (isset($mes_1)) {
                           $filterdmes_1 = filter_var($mes_1, FILTER_SANITIZE_STRING);
                           if (empty($mes_1)) {
                              $formErrors[] = "<div id='success-alert' class='alert alert-danger'> Message cannot be left blank. </div>";
                           }
                     }

                     if (empty($formErrors)) {
                           $stmt = $con->prepare("INSERT INTO messages (FullName, Email, phone, Country, City, mes_1, mes_Date) 
                                                         VALUES(:zFullName, :zEmail, :zphone, :zCountry, :zCity, :zmes_1, now())");
                           $stmt->execute(array(

                              'zFullName'  => $FullName,
                              'zEmail' => $Email,
                              'zphone' => $phone,
                              'zCountry' => $Country,
                              'zCity' => $City,
                              'zmes_1' => $mes_1
                           ));
                           //Echo Success Measage
                           $succesMsg = 'The message was sent successfully.';
                           header('Refresh: 5; URL=./');
                     }
                  }
                  ?>

               <form action="#" method="POST" class="contact-form mb-3">
                  <div class="row">
                     <div class="col-12">
                         <div id="success"><?php
									if (!empty($formErrors)) {
										foreach ($formErrors as $error) {
											echo '<div class="col-12 text-center">';
											echo  $error;
											echo '</div>';
										}
										header('Refresh: 3; URL=contact');
									}
									if (isset($succesMsg)) {
										echo  "<div  class= 'alert alert-success'>" . $succesMsg . "</div>";
										header('Refresh: 3; URL=./');
									} ?>
								</div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12">
                        <label for="cname" class="sr-only">Name</label>
                        <input type="text" class="form-control" name="FullName" placeholder="Name *" required>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-sm-6">
                        <label for="cemail" class="sr-only">Email</label>
                        <input type="email" class="form-control" name="Email" placeholder="Email *" required>
                     </div>
                     <div class="col-sm-6">
                        <label for="cphone" class="sr-only">Phone</label>
                        <input type="tel" class="form-control" name="phone" placeholder="Phone">
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-6">
                        <label for="cemail" class="sr-only">Country</label>
                        <input type="text" class="form-control" name="Country" placeholder="Country *" required>
                     </div>
                     <div class="col-sm-6">
                        <label for="cphone" class="sr-only">City</label>
                        <input type="text" class="form-control" name="City" placeholder="City *" required>
                     </div>
                  </div>

                  <label for="cmessage" class="sr-only">Message</label>
                  <textarea class="form-control" cols="30" rows="4" name="mes_1" required placeholder="Message *"></textarea>
                  <input type="submit" class="btn btn-outline-primary-2 btn-minwidth-sm" value="SUBMIT" />
               </form>
            </div>
         </div>
      <hr class="mt-4 mb-5">
      <div class="stores mb-4 mb-lg-5">
         <h2 class="title text-center mb-5">Our vending Machines</h2><!-- End .title text-center mb-2 -->
         <div class="row">
   <?php
   // vending Section  
   $stmt = $con->prepare("SELECT * FROM vending_map ORDER BY id DESC ");
   $stmt->execute();
   $vendings = $stmt->fetchAll();
   if (!empty($vendings)) {
      foreach ($vendings as $vending) {
         ?>
         <div class="col-lg-6">
            <div class="store">
               <div class="row">
                  <div class="col-sm-5 col-xl-6">
                     <figure class="store-media mb-2 mb-lg-0">
                        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
                        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

                        <!-- Give each map a unique ID -->
                        <div id="map-<?php echo $vending['id']; ?>" style="height: 300px; width: 100%;"></div>

                        <script>
                           // Use PHP to set the unique ID for each map
                           var mapId = 'map-<?php echo $vending['id']; ?>';
                           var latitude = <?php echo $vending['latitude']; ?>;
                           var longitude = <?php echo $vending['longitude']; ?>;
                           // Initialize the map with the unique ID
                           var map = L.map(mapId).setView([latitude, longitude], 15);
                           // Add the OpenStreetMap tile layer
                           L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                              maxZoom: 18,
                              attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                           }).addTo(map);

                           // Add a marker at the specified coordinates
                           L.marker([latitude, longitude]).addTo(map)
                              .bindPopup('موقع الماكينة هنا')
                              .openPopup();
                        </script>
                     </figure>
                  </div>
                  <div class="col-sm-7 col-xl-6">
                     <div class="store-content">
                        <h3 class="store-title"><?php echo $vending['vending_name']; ?></h3>
                        <address><?php echo $vending['vending_address']; ?></address>
                        <a href="https://www.google.com/maps/dir/?api=1&destination=<?php echo $vending['latitude']; ?>,<?php echo $vending['longitude']; ?>" 
                           class="btn btn-link" 
                           target="_blank">
                           <span>Get Direction</span><i class="icon-long-arrow-right"></i>
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <?php
      }
   }
   ?>
</div>

      </div>
      </div>
   
</div>


<?php
include 'front_temp/footer.php';
include 'front_temp/footer_script.php';
ob_end_flush();
