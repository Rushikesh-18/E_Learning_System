<?php
$login_session="";
$error="";
$show="display:none;";
$alert="";
include("./conn.php");
include('./sms.php');
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
if (isset($_POST['forgotpass']))
{
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$myusername=addslashes($_POST['mobile']); 		
		$sql="SELECT euname, eumob, eupass, email FROM end_user WHERE status=1 AND eumob='$myusername'"; 
		$result = $conn->query($sql);
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()) {
			$euname = $row["euname"];				
			$eumob = $row["eumob"];				
			$eupass = $row["eupass"];				
			$email = $row["email"];	
			$emails = explode (",", $email);			
			}			
			//$message="Hi, ".$euname."! Thank You for Visit on CloudED. Your User Name: ".$eumob." and password:".$eupass." Thank You.";
			//$mobile_number=$myusername;
			//$temp_id="1207161780992346170";
			//$message1= sms_unicode($message);
			//sentsms($message, $mobile_number, $temp_id);
			//Email Code
			$subject="Password Recovery | Welcome Back ".$euname." to CloudED.";
			$body="Hi <b>".$euname."</b>, <br/> Your Account Details of CloudED <br/>	Your Username:<b>  ".$eumob." </b><br/> Password: <b>".$eupass." </b><br/><br/><br/><br/><b>Thank and Regards<br/>
			CloudED,<br/>
			E-Learning Smart Classroom<br/>
			Technical Support<br/>
			91309 75938<br/>
			91309 75938<br/>
			Whatsapp No: 91309 75938<br/></b>";
			$mail = new PHPMailer;
			$mail->isSMTP();
			$mail->SMTPDebug = 1;
			$mail->Host = 'smtp.hostinger.com';
			$mail->Port = 587;
			$mail->SMTPAuth = true;
			$mail->Username = 'contacttemp@zelosit.com';
			$mail->Password = 'Contact@121$';
			$mail->setFrom('contacttemp@zelosit.com', 'Contact CloudED');
			$mail->addReplyTo('zelosinfotech@gmail.com', 'Zelos Infotech');
			$mail->Subject = $subject;
			$mail->msgHTML($body);
			$mail->Body = $body;
			foreach($emails as $val){		
				$mail->addAddress($val, $euname);								
				if (!$mail->send()) {
					echo 'Mailer Error: ' . $mail->ErrorInfo;
				} 
				else {
					$error="Your password is sent on your registered mobile number! ";
					$show="display:show;";
					$alert="alert alert-success";					
				}
			}
			header("Location:./forget-password-success.php?alert=$alert&show=$show&error=$error");
		}
		else{
			$error="Your Mobile Number is not exist please create <a style='color:white;' href='./register.php'><u>New Account</a></u>! ";
			$show="display:show;";
			$alert="alert alert-danger";
			header("Location:./forget-password-success.php?alert=$alert&show=$show&error=$error");
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from designing-world.com/suha-v2.1.0/forget-password.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Sep 2020 08:35:01 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, viewport-fit=cover, shrink-to-fit=no">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#100DD1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- The above tags *must* come first in the head, any other head content must come *after* these tags-->
    <!-- Title-->
    <title>Forgot Password</title>
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
          <div class="col-12 col-sm-9 col-md-7 col-lg-6 col-xl-5"><img class="big-logo" src="img/core-img/logo-small.png" alt="">
            <!-- Register Form-->
            <div class="register-form mt-5 px-4">
              <form action="" method="POST">
                <div class="form-group text-left mb-4"><span>Mobile</span>
                  <label for="email"><i class="lni lni-user"></i></label>
                  <input class="form-control" name="mobile" id="mobile" type="number" placeholder="Mobile Number" required>
                </div>
                <button class="btn btn-warning btn-lg w-100" name="forgotpass" type="submit">Reset Password</button>
              </form>
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

<!-- Mirrored from designing-world.com/suha-v2.1.0/forget-password.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Sep 2020 08:35:01 GMT -->
</html>