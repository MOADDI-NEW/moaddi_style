<?php // Post Section  
$stmt = $con->prepare("SELECT * FROM items  ORDER BY Item_ID DESC LIMIT 8");
$stmt->execute();
$items = $stmt->fetchAll();
if (! empty($items)){?>

<div class="blog-posts pt-7 pb-7" style="background-color: #fafafa;">
   <div class="container">
      <h2 class="title-lg text-center mb-3 mb-md-4"> Moaddi News</h2>
      <div class="owl-carousel owl-simple carousel-with-shadow" data-toggle="owl" data-owl-options='{ "nav": false,  "dots": true, "items": 3, "margin": 20, "loop": false, "responsive": { "0": { "items":1 }, "600": { "items":2 }, "992": { "items":3 } }, "autoplay": true, "autoplayTimeout": 3000 }'>
         <?php 
         foreach($items as $item){  
            $sentence = $item['path'];
            ?>
            <article class="entry entry-display">
                  <figure class="entry-media">
                     <a href="single.html">
                        <img src="./dashbord/admin/nsharat_uploads/avatar/<?php echo $item['news_img'];?>" alt="image desc">
                     </a>
                  </figure>
                  <div class="entry-body pb-4 text-center">
                     <div class="entry-meta">
                        <a href="#"><?php echo $item['nashra_date']; ?></a>
                     </div>
                     <h3 class="entry-title">
                        <a href="single.html"><?php echo $item['title']; ?></a>
                     </h3>
                     <div class="entry-content">
                        <?php echo'<p> '. implode(' ', array_slice(explode(' ', $sentence), 0, 42)) . ' ' .'......'.' </p>';?>
                        <a href="single.html" class="read-more">Read More</a>
                     </div>
                  </div>
            </article>
            <?php 
         }?>

      </div>
   </div>
</div><?php  
}?>