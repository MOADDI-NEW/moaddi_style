   <footer class="footer footer-dark">
      <div class="footer-bottom">
            <div class="container">
               <p class="footer-copyright">Copyright © 2025 Moaddi Markting Line. All Rights Reserved.</p>
               
            </div>
      </div>
   </footer>
</div>
<button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

<!-- Mobile Menu -->
<div class="mobile-menu-overlay"></div>

<div class="mobile-menu-container">
      <div class="mobile-menu-wrapper">
         <span class="mobile-menu-close"><i class="icon-close"></i></span>


         
         <nav class="mobile-nav">
            <ul class="mobile-menu">
                <li class="active"><a href="./" >Home</a></li>
                <li><a href="about">About Us</a></li>
                <li><a href="contact">Contact Us</a></li>
                <?php if (isset($_SESSION['user']) || isset($_SESSION['Edara30'])) { 
                        echo '<li><a href="./dashbord/">My account</a></li>';
                }else  {
                echo'<li><a href="./dashbord/">Login</a></li>';
                }?>
            </ul>
         </nav>
      </div>
</div>

<?php


if (!isset($_COOKIE['newsletter_popup_displayed'])) {
    // Set a cookie to expire in 30 days
    setcookie('newsletter_popup_displayed', 'true', time() + (30 * 24 * 60 * 60), "/"); // Expires in 30 days
    $showPopup = true; // Popup should show on the first visit
} else {
    $showPopup = false; // Popup should not show if the cookie exists
}
?>

<?php if ($showPopup): ?>
<div class="container newsletter-popup-container mfp-hide" id="newsletter-popup-form">
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="row no-gutters bg-white newsletter-popup-content">
                <div class="col-xl-3-5col col-lg-7 banner-content-wrap">
                    <div class="banner-content text-center">
                        <img src="assets/images/popup/newsletter/logo.png" class="logo" alt="logo" width="60" height="15">
                        <h2 class="banner-title">We <span>are</span> ahead</h2>
                        <p>Subscribe to the Moaddi Marketing Line newsletter to receive timely updates from your favorite products.</p>
                        <form action="#">
                            <div class="input-group input-group-round">
                                <input type="email" class="form-control form-control-white" placeholder="Your Email Address" aria-label="Email Address" required>
                                <div class="input-group-append">
                                    <button class="btn" type="submit"><span>go</span></button>
                                </div>
                            </div>
                        </form>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="register-policy-2" required>
                            <label class="custom-control-label" for="register-policy-2">Do not show this popup again</label>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2-5col col-lg-5">
                    <img src="assets/images/popup/newsletter/img-1.jpg" class="newsletter-img" alt="newsletter">
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<script>
   document.addEventListener("DOMContentLoaded", function() {
    if (document.cookie.indexOf("newsletter_popup_displayed=true") === -1) {
        // Show the popup
        document.getElementById("newsletter-popup-form").classList.remove("mfp-hide");
    }
});

</script>