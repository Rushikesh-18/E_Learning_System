<?php
$error="";
$login_session="";
$show="display:none;";
$alert="";
include("./conn.php");
include('./sms.php');
include('./otpgenerator.php');
require_once('./mail/class.phpmailer.php');
require_once('./mail/class.smtp.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//check up
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
 if(isset($_SESSION['login_euser']))
{
  header("Location:./index.php");
  exit;
}
else
{
  //header("Location:login.php");
  //exit;
}
if (isset($_POST['submitsignup']))
{
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{ 
		$euname=test_input($_POST['eusername']); 
		$myusername=test_input($_POST['mobile']); 
		$mypassword=test_input($_POST['registerPassword']); 
		$email=test_input($_POST['email']);
		$gender=test_input($_POST['gender']); 
		$cid=test_input($_POST['cid']); 		
		$dd=test_input($_POST['dd']); 
		$mm=test_input($_POST['mm']); 
		$yyyy=test_input($_POST['yyyy']); 
		$bdate=$yyyy."-".$mm."-".$dd; 
		$address=test_input($_POST['address']);
		$today=date('Y-m-d');
		$sql="SELECT status FROM end_user WHERE status=1 AND eumob='$myusername' AND eupass='$mypassword'"; 
		$result = $conn->query($sql);
		if($result->num_rows>0){
				$_SESSION['login_euser']=$myusername;
				header("location:./index.php");
				die();
		}
		else{
			$sql1="SELECT eumob FROM end_user WHERE eumob='$myusername' and status=1 "; 
			$result = $conn->query($sql1);
			if ($result->num_rows > 0){
				$error=$myusername." "."User Name Is Already Exist! Please Click On Forgot Password!";
				$show="display:show;";
				$alert="alert alert-danger";
				header("Location:./register.php?alert=$alert&show=$show&error=$error");
			}
			else{
				$sql = "INSERT INTO end_user ( euname, eumob, eupass, email, gender, bdate, address, cid, euregdate, status)
				VALUES ('$euname', '$myusername','$mypassword','$email','$gender','$bdate','$address', $cid, '$today', 0)";
				if ($conn->query($sql) === TRUE) {
					$_SESSION['last_id']= $conn->insert_id;				
				}
				else{
				$error="Your signup is invalid";
				$show="display:show;";
				$alert="alert alert-danger";
				header("Location:./register.php?alert=$alert&show=$show&error=$error");
				}
			}
		}
	}
}					
if (isset($_GET['alert']) && $_GET['alert']=='true') {
$error="User Account Created successfully! <a href='./login.php'><u>Click here for login! </u></a>";
$show="display:show;";
$alert="alert alert-success";
}
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>
<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from designing-world.com/suha-v2.1.0/otp.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Sep 2020 08:35:01 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, viewport-fit=cover, shrink-to-fit=no">
    <meta name="description" content="Compliant Management System">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#100DD1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- The above tags *must* come first in the head, any other head content must come *after* these tags-->
    <!-- Title-->
    <title>OTP Generator</title>
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
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-sm-9 col-md-7 col-lg-6 col-xl-5">
            <div class="text-left px-4">
              <h5 class="mb-1 text-white">Email Verification</h5>
              <p class="mb-4 text-white">We will send you an OTP on this email id.</p>
            </div>
            <!-- OTP Send Form-->
            <div class="otp-form mt-5 mx-4">
              <form action="./otp-confirm.php" method="POST">
                <div class="mb-4 d-flex">
                  <select class="form-select" name="" aria-label="Default select example">
                    <option value="">+91</option>
                  </select>
                  <input class="form-control pl-0" name="email" id="email" type="hidden" value="<?php echo $email;?>" placeholder="Enter phone number" required readonly>
                  <input class="form-control pl-0" name="mobile" id="phone_number" type="text" value="<?php echo $myusername;?>" placeholder="Enter phone number" required readonly>
                </div>
                <button class="btn btn-warning btn-lg w-100" name="sendotp" type="submit">Send OTP</button>
              </form>
            </div>
            <!-- Term & Privacy Info-->
            <div class="login-meta-data px-4">
              <p class="mt-3 mb-0">By providing my phone number, I hereby agree the<a class="mx-1" href="#">Term of Services</a>and<a class="mx-1" href="#">Privacy Policy.</a></p>
            </div>
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

<!-- Mirrored from designing-world.com/suha-v2.1.0/otp.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Sep 2020 08:35:01 GMT -->
</html>