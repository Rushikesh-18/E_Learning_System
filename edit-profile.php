<?php
include('./lock.php');
include('./conn.php');
$error="";
$show="display:none;";
$alert="";
$sql1="SELECT * FROM end_user WHERE euid=$user_id";
$result = $conn->query($sql1);
if ($result->num_rows > 0){
	while($row = $result->fetch_assoc()) {
		$euid = $row["euid"];
		$euname = $row["euname"];
		$eumob = $row["eumob"];
		$eupass = $row["eupass"];
		$altmob = $row["altmob"];
		$address = $row["address"];
		$cid = $row["cid"];
		$email = $row["email"];
		$bdate = $row["bdate"];
		$gender = $row["gender"];
		$cstatus = $row["status"];
		$euregdate= $row["euregdate"];
	}	
}
if (isset($_POST['submitcust'])){
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	 $euname = test_input($_POST["euname"]);
	 $eumob = test_input($_POST["eumob"]);
	 $altmob = test_input($_POST["altmob"]);
	 $address = test_input($_POST["address"]);
	 $cid = test_input($_POST["cid"]);
	 $email = test_input($_POST["email"]);
	 $bdate = test_input($_POST["bdate"]);
	 $gender = test_input($_POST["gender"]);
     $sql = "SELECT eumob FROM end_user WHERE eumob='$eumob' AND euid!=$user_id AND status=1";
	 $query = $conn->query($sql);
	 $count = $query->num_rows;
      if ($count >0){
        $error="Profile mobile Number Is Already Exist!";
        $show="display:show;";
        $alert="alert alert-danger";		
      }
	  else{
		$sql = "UPDATE end_user SET euname='$euname', eumob='$eumob', altmob='$altmob', cid=$cid, email='$email', bdate='$bdate', address='$address', gender='$gender' WHERE euid=$user_id";
		if($conn->query($sql)===TRUE){
			$error="Profile Is Updated Successfully!";
			$show="display:show;";
			$alert="alert alert-success";
		}
		else{
			$error="Proccess Is Invalid!";
			$show="display:show;";
			$alert="alert alert-success";
		}
	  }	  
	}
}
if (isset($_GET['alert'])) {
 $alert=$_GET['alert'];
 $error=$_GET['error'];
 $show=$_GET['show'];
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
  
<!-- Mirrored from designing-world.com/suha-v2.1.0/edit-profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Sep 2020 08:34:46 GMT -->
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
    <title>Edit Profile</title>
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
        <!-- Back Button-->
        <div class="back-button"><a href="profile.php"><i class="lni lni-arrow-left"></i></a></div>
        <!-- Page Title-->
        <div class="page-heading">
          <h6 class="mb-0">Edit Profile</h6>
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
              <div class="user-profile mr-3"><img src="img/bg-img/member.png" alt="">
                <div class="change-user-thumb">
                  <form>
                    <input class="form-control-file" type="file">
                    <button><i class="lni lni-pencil"></i></button>
                  </form>
                </div>
              </div>
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
                  <div class="title mb-2"><i class="lni lni-user"></i><span>User Name</span></div>
                  <input class="form-control" type="text" name= "euname" value="<?php echo $euname?>" required>
                </div>
                <div class="mb-3">
                  <div class="title mb-2"><i class="lni lni-handshake"></i><span>Select Gender</span></div>
                  <select class="mb-3 form-control form-select" id="gender"  name="gender" required>
					  <option value="">Select Type</option>
					<option selected value="<?php echo $gender?>" id=""><?php echo $gender?></option>
					<option value="Male" id="">Male</option>
					<option value="Female" id="">Female</option>
					</select>
                </div>
                <div class="mb-3">
                  <div class="title mb-2"><i class="lni lni-phone"></i><span>Mobile</span></div>
                  <input class="form-control" type="number" name= "eumob" value="<?php echo $eumob?>" required />
                </div>
				<div class="mb-3">
                  <div class="title mb-2"><i class="lni lni-phone"></i><span>Alt Mobile</span></div>
                  <input class="form-control" type="number" name= "altmob" value="<?php echo $altmob?>" required />
                </div>
				<div class="mb-3">
                  <div class="title mb-2"><i class="lni lni-book"></i><span>Select Course</span></div>
                  <select class="mb-3 form-control form-select" id="cid"  name="cid" required>
					  <option value="">Select Course</option>
					  <?php
						$query = "SELECT cid, c_name from course where status=1 ORDER BY c_name ASC";
						$result = $conn->query($query);  
							while($row = $result->fetch_assoc()) {                                                 
							echo "<option value='".$row['cid']."'>".$row['c_name']."</option>";
							}
						?> 
					</select>
                </div>
                <div class="mb-3">
                  <div class="title mb-2"><i class="lni lni-envelope"></i><span>Email Address</span></div>
                  <input class="form-control" type="email" name= "email" value="<?php echo $email?>" />
                </div>
                <div class="mb-3">
                  <div class="title mb-2"><i class="lni lni-map-marker"></i><span>Birth Date</span></div>
                  <input class="form-control" type="date" name= "bdate" value="<?php echo $bdate?>" required />
                </div>
				<div class="mb-3">
                  <div class="title mb-2"><i class="lni lni-map-marker"></i><span> Address</span></div>
                  <textarea class="form-control" rows="3" name="address" required><?php echo $address?></textarea>
                </div>
                <button class="btn btn-success w-100" type="submit" name="submitcust">Save All Changes</button>
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
    <script src="js/default/no-internet.js"></script>
    <script src="js/default/active.js"></script>
    <script src="js/pwa.js"></script>
  </body>

<!-- Mirrored from designing-world.com/suha-v2.1.0/edit-profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Sep 2020 08:34:46 GMT -->
</html>