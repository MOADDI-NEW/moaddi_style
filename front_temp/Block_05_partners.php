<div class="mb-6"></div>
<div class="container">
   <hr class="mt-3 mb-3">
   <h2 class="title-lg text-center mb-3 mb-md-4">Success partners</h2>
</div>
<?php 
$stmt = $con->prepare("SELECT * FROM clints  ORDER BY clint_id DESC");
$stmt->execute();
$items = $stmt->fetchAll();
if (! empty($items)){?>
   <div class="container mb-5 mt-3">
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