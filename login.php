<?php
$login_session="";
$error="";
$show="display:none;";
$alert="";
include("./conn.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
 if(isset($_SESSION['login_euser']))
{
  header("Location:./home.php");
  exit;
}
else
{
  //header("Location:login.php");
  //exit;
}
//include("./lock.php");
if (isset($_POST['submitlogin']))
{
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$myusername=addslashes($_POST['mobile']); 
		$mypassword=addslashes($_POST['password']); 
		$sql="SELECT status FROM end_user WHERE eumob='$myusername' AND eupass='$mypassword' AND status=1"; 
		$result = $conn->query($sql);
		if($result -> num_rows > 0){
			$_SESSION['login_euser']=$myusername;
			$_SESSION['login_password']=$mypassword;
			setcookie ("member_login",$myusername,time()+ (10 * 365 * 24 * 60 * 60));  
			setcookie ("member_password",$mypassword,time()+ (10 * 365 * 24 * 60 * 60));
			header("location:./home.php");
			die();
		}
		else{
			$error="Your Login Name or Password is invalid";
			$show="display:show;";
			$alert="alert alert-danger";
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from designing-world.com/suha-v2.1.0/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Sep 2020 08:35:01 GMT -->
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
    <title>Login</title>
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
    <!-- Login Wrapper Area-->
    <div class="login-wrapper d-flex align-items-center justify-content-center text-center">
      <!-- Background Shape-->
      <div class="background-shape"></div>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-sm-9 col-md-7 col-lg-6 col-xl-5"><img class="big-logo" src="img/core-img/logo-small.png" alt="">
		  <div class="alert <?php echo $alert; ?>" role="alert" style="<?php echo $show; ?>"><?php echo $error; ?></div>
            <!-- Register Form-->
            <div class="register-form mt-5 px-4">
              <form action="" method="POST">
                <div class="form-group text-left mb-4"><span>Mobile Number</span>
                  <label for="username"><i class="lni lni-user"></i></label>
                  <input class="form-control" name="mobile" id="mobile" type="number" autocomplete="off" placeholder="Mobile Number">
                </div>
                <div class="form-group text-left mb-4"><span>Password</span>
                  <label for="password"><i class="lni lni-lock"></i></label>
                  <input class="form-control" name="password" id="password" type="password" placeholder="********************">
                </div>
                <button class="btn btn-success btn-lg w-100" name="submitlogin" type="submit">Log In</button>
              </form>
            </div>
            <!-- Login Meta-->
            <div class="login-meta-data"><a class="forgot-password d-block mt-3 mb-1" href="forget-password.php">Forgot Password?</a>
              <p class="mb-0">Didn't have an account?<a class="ml-1" href="register.php">Register Now</a></p>
            </div>
            <!-- View As Guest-->
            <!--<div class="view-as-guest mt-3"><a class="btn" href="home.php">View as Guest</a></div>-->
          </div>
        </div>
      </div>
    </div>
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
    <script src="js/default/active.js"></script>
    <script src="js/pwa.js"></script>
  </body>

<!-- Mirrored from designing-world.com/suha-v2.1.0/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Sep 2020 08:35:01 GMT -->
</html>