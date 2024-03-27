<?php
include('./lock.php');
?>
<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from designing-world.com/suha-v2.1.0/home.php by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Sep 2020 08:33:53 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, viewport-fit=cover, shrink-to-fit=no">
    <meta name="description" content="Compliant Management System">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#004c91">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- The above tags *must* come first in the head, any other head content must come *after* these tags-->
    <!-- Title-->
    <title>Home | Cloud Education</title>
    <!-- Favicon-->
    <link rel="icon" href="img/icons/icon-72x72.png">
    <!-- Apple Touch Icon-->
    <link rel="apple-touch-icon" href="img/icons/icon-96x96.png">
    <link rel="apple-touch-icon" sizes="152x152" href="img/icons/icon-152x152.png">
    <link rel="apple-touch-icon" sizes="167x167" href="img/icons/icon-167x167.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/icons/icon-180x180.png">
    <!-- Stylesheet-->
    <link rel="stylesheet" href="style.css">
    <!-- Web App Manifest-->
    <link rel="manifest" href="manifest.json">
  </head>
  <body>
    <!-- Preloader-->
    <div class="preloader" id="preloader">
      <div class="spinner-grow text-secondary" role="status">
        <div class="sr-only">Loading...</div>
      </div>
    </div>
    <!-- Header Area-->
    <div class="header-area" id="headerArea">
      <div class="container h-100 d-flex align-items-center justify-content-between">
        <!-- Logo Wrapper-->
        <div class="logo-wrapper"><a href="home.php"><img src="img/core-img/logo-small.png" alt=""></a></div>
        <!-- Search Form-->
        <div class="top-search-form">
          <form action="#" method="">
            <input class="form-control" type="search" placeholder="Enter your keyword">
            <button type="submit"><i class="fa fa-search"></i></button>
          </form>
        </div>
        <!-- Navbar Toggler-->
        <div class="suha-navbar-toggler d-flex flex-wrap" id="suhaNavbarToggler"><span></span><span></span><span></span></div>
      </div>
    </div>
    <!-- Sidenav Black Overlay-->
    <?php
	include('sidenav.php');
	?>
    <!-- PWA Install Alert-->

    <div class="page-content-wrapper">
     
      <!-- Product Catagories-->
      <div class="product-catagories-wrapper py-3">
        <div class="container">
          <div class="section-heading">
            <h6 class="ml-1">Welcome To CloudED - E-Learning Smart Classroom!</h6>
          </div>
          <div class="product-catagory-wrap">
            <div class="row g-3">			
              <!-- Single Catagory Card-->			  
			  <div class='col-6'>
				<div class='card catagory-card'>
				  <div class='card-body'><a href="my_classroom.php"><i class='lni lni-gift'></i><span>My Classroom</span></a></div>
				</div>
			  </div>
			  <div class='col-6'>
				<div class='card catagory-card'>
				  <div class='card-body'><a href="my_meet.php"><i class='lni lni-gift'></i><span>Active Meets</span></a></div>
				</div>
			  </div>
			  <div class='col-6'>
				<div class='card catagory-card'>
				  <div class='card-body'><a href="my_assignment.php"><i class='lni lni-gift'></i><span>My Assignment</span></a></div>
				</div>
			  </div>
			  <div class='col-6'>
				<div class='card catagory-card'>
				  <div class='card-body'><a href="profile.php"><i class='lni lni-gift'></i><span>Profile</span></a></div>
				</div>
			  </div>			  
            </div>
          </div>
        </div>
      </div>
      <!-- Flash Sale Slide-->
      <!-- Cool Facts Area-->
      <!-- Discount Coupon Card-->
      <!-- Featured Products Wrapper-->

      <!-- Night Mode View Card-->

    </div>
    <?php
	include('footer.php');
	?>
    <!-- All JavaScript Files-->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/default/jquery.passwordstrength.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/jarallax.min.js"></script>
    <script src="js/jarallax-video.min.js"></script>
    <script src="js/default/dark-mode-switch.js"></script>
    <script src="js/default/no-internet.js"></script>
    <script src="js/default/active.js"></script>
    <script src="js/app.js"></script>
  </body>

<!-- Mirrored from designing-world.com/suha-v2.1.0/home.php by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Sep 2020 08:34:19 GMT -->
</html>