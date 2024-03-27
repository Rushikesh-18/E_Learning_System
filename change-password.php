<?php 
include('lock.php');
include ("conn.php");
$error="";
$show="display:none;";
$alert="";
$sql1="SELECT * FROM end_user WHERE euid=$user_id";
$result = $conn->query($sql1);
if ($result->num_rows > 0){
	while($row = $result->fetch_assoc()) {
		$euname = $row["euname"];
		$eumob = $row["eumob"];
	}
}
if($_SERVER["REQUEST_METHOD"] == "POST")
{
$currpass=addslashes($_POST['currpass']);
$newpass=addslashes($_POST['inputPassword']); 
$confpass=addslashes($_POST['inputPasswordConfirm']); 
$uid=$user_id;

if($newpass===$confpass)
{
  $sql="SELECT eupass FROM end_user WHERE eupass='$currpass' and euid='$uid' and status=1";
 $result = $conn->query($sql);
  if ($result->num_rows > 0){
    $sqlupdate = "UPDATE end_user SET eupass='$newpass' WHERE eupass='$currpass' and euid='$uid' and status=1";
        // use exec() because no results are returned
        if ($conn->query($sqlupdate) === TRUE) {
         header("Location:./logout.php");
         die();
        $error="Your New Password is Change Successfully!";
        $show="display:show;";
        $alert="alert alert-success";
        }
  }
  else
  {
    $error="Your Current Password is Worng!";
    $show="display:show;";
    $alert="alert alert-danger";
  }

  
}
else
{
  $error="Your New Password and Confirm Password is Not Match!";
  $show="display:show;";
  $alert="alert alert-danger";
}
}
?>
<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from designing-world.com/suha-v2.1.0/change-password.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Sep 2020 08:35:01 GMT -->
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
    <title>Change Password</title>
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
	  <script type="text/javascript">
      function confpass(){
      var counter=0;
      var f1 = document.getElementById("inputPassword").value;
      var f2 = document.getElementById("inputPasswordConfirm").value;
      //var r= parseFloat(f1)*parseFloat(f2);
      if(f1==f2)
      {
          document.getElementById("msg").innerHTML="Password Is Match";
          document.getElementById("inputPassword").style.borderColor = "#008000";
          document.getElementById("inputPasswordConfirm").style.borderColor = "#008000";
          
      }
      else
      {
        document.getElementById("msg").innerHTML="Password Is Not Match";
        document.getElementById("inputPassword").style.borderColor = "#E34234";
        document.getElementById("inputPasswordConfirm").style.borderColor = "#E34234";
      
      }
   }
  </script>
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
        <!-- Back Button-->
        <div class="back-button"><a href="settings.php"><i class="lni lni-arrow-left"></i></a></div>
        <!-- Page Title-->
        <div class="page-heading">
          <h6 class="mb-0">Change Password</h6>
        </div>
        <!-- Navbar Toggler-->
        <div class="suha-navbar-toggler d-flex justify-content-between flex-wrap" id="suhaNavbarToggler"><span></span><span></span><span></span></div>
      </div>
    </div>
    <!-- Sidenav Black Overlay-->
<?php
	include('sidenav.php');
	?>
    <div class="page-content-wrapper">
      <div class="container">
        <!-- Profile Wrapper-->
        <div class="profile-wrapper-area py-3">
          <!-- User Information-->
          <div class="card user-info-card">
            <div class="card-body p-4 d-flex align-items-center">
              <div class="user-profile mr-3"><img src="img/bg-img/member.png" alt=""></div>
              <div class="user-info">
                <p class="mb-0 text-white">@<?php echo $euname?></p>
                <h5 class="mb-0"><?php echo $eumob?></h5>
              </div>
            </div>
          </div>
		  <div align="center" id="success-alert" class="<?php echo $alert; ?>" role="alert" style="color:green;<?php echo $show; ?>"><?php echo $error; ?></div>
          <!-- User Meta Data-->
          <div class="card user-data-card">
            <div class="card-body">
              <form action="" method="POST">
                <div class="mb-3">
                  <div class="title mb-2"><i class="lni lni-key"></i><span>Old Password</span></div>
                  <input class="form-control" id="currpass" name= "currpass" type="password" required />
                </div>
                <div class="mb-3">
                  <div class="title mb-2"><i class="lni lni-key"></i><span>New Password</span></div>
                  <input class="form-control" id="inputPassword" name="inputPassword" type="password" required />
                </div>
                <div class="mb-3">
                  <div class="title mb-2"><i class="lni lni-key"></i><span>Repeat New Password</span></div>
                  <input class="form-control" onkeyup="confpass();" id="inputPasswordConfirm" name= "inputPasswordConfirm" type="password" required />
				  <span ng-show="val2" id="msg">  </span>
                </div>
                <button class="btn btn-success w-100" type="submit">Update Password</button>
              </form>
			  
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Internet Connection Status-->
    <div class="internet-connection-status" id="internetStatus"></div>
    <!-- Footer Nav-->
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
    <script src="js/default/active.js"></script>
    <script src="js/pwa.js"></script>
  </body>

<!-- Mirrored from designing-world.com/suha-v2.1.0/change-password.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Sep 2020 08:35:01 GMT -->
</html>