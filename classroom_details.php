<?php
include('lock.php');
include('conn.php');
if (isset($_GET['cr_id'])) {	
$cr_id=$_GET['cr_id'];
$sql1="SELECT * FROM classrooms cr, course c, end_user eu, user u, classroom_student cs WHERE u.uid=cr.uid AND eu.euid=cs.euid AND c.cid = cr.cid AND cr.cr_id=$cr_id";
$result = $conn->query($sql1);
if ($result->num_rows > 0){
	while($row = $result->fetch_assoc()) {
		//$cr_id = $row["cr_id"];
			$uname = $row["uname"];
			$cr_name = $row["cr_name"];
			$c_name = $row["c_name"];
			$cr_desc = $row["cr_desc"];
			$cr_status = $row["cr_status"];
			$cr_regdate= $row["cr_regdate"];			
	}
	$error="Classroom Is Found successfully!";
	$show="display:none;";
	$alert="alert alert-success";
	$vis="show";
}
else 
{
	$error='<b>'.$cr_id.'</b>'." "."Classroom Id Is Not Exist!";
	header('Location:./my_classroom.php');
	$show="display:show;";
	$alert="alert alert-danger";
}
}
else{
	header('Location:./home.php');
}
 
if($cr_status==1){$cr_status_temp= "Active";}
else if ($cr_status==2){$cr_status_temp=  "Assigned";}			
else if ($cr_status==3){$cr_status_temp=  "Completed"; }			
else if($cr_status==4){$cr_status_temp=  "Closed";}			
else if($cr_status==0){$cr_status_temp=  "Deleted";}			
else {$cr_status_temp =  "None";}
if (isset($_POST['submitcumment'])){
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	 $chat_desc = test_input($_POST["comment"]);
	 $today=date("Y-m-d");
     $sql = "SELECT * FROM chat WHERE cr_id=$cr_id AND euid=$user_id AND chat_desc='$chat_desc' AND chat_date='$today' AND chat_status!=0";
	 $query = $conn->query($sql);
	 $count = $query->num_rows;
      if ($count >0){
        $error="Content Already Post";
        $show="display:show;";
        $alert="alert alert-danger";		
      }
	  else{
		$sql = "INSERT INTO chat (chat_desc,chat_date,chat_status,cr_id,euid) VALUES('$chat_desc', '$today', 1, $cr_id, $user_id)";
		if($conn->query($sql)===TRUE){
			$error="Message Sent successfully!";
			$show="display:show;";
			$alert="alert alert-success";
		}
		else{
			$error="Process Is Invalid!";
			$show="display:show;";
			$alert="alert alert-success";
		}
	  }	  
	}
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
  
<!-- Mirrored from designing-world.com/suha-v2.1.0/single-product.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Sep 2020 08:34:24 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, viewport-fit=cover, shrink-to-fit=no">
    <meta name="description" content="Compliant Management System">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#004c91">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta property="og:type" content="Product" />
	<meta property="og:locale" content="en_GB" />
    <!-- The above tags *must* come first in the head, any other head content must come *after* these tags-->
    <!-- Title-->
    <title>Classroom Details</title>
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
    <script src="./sss.js"></script>
		<script>
	//document.getElementById("cp_btn").addEventListener("click", copy_password);

function copy() {
    var copyText = document.getElementById("desc");
    var textArea = document.createElement("textarea");
    textArea.value = copyText.textContent;
    document.body.appendChild(textArea);
    textArea.select();
    document.execCommand("Copy");
    textArea.remove();
}
</script>
  </head>
  <body>
</span>
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
        <div class="back-button"><a href="my_classroom.php"><i class="lni lni-arrow-left"></i></a></div>
        <!-- Page Title-->
        <div class="page-heading">
          <h6 class="mb-0">Classroom Details</h6>
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
      <!-- Product Slides-->
      <div class="product-description pb-3" >
        <!-- Product Title & Meta Data-->
        <div class="specification bg-white mb-3 py-3" style="padding-top:50px;">
          <div class="container d-flex justify-content-between">
            <div class="p-title-price">
              <h6 class="mb-1"> Classroom : <?php echo $cr_name;?></h6>
              <p> <b>Course:</b>  <?php echo $c_name;?><span></span></p>
              <p> <b>Teacher Name:</b>  <?php echo $uname;?><span></span></p>
              <p> <b>Reg Date:</b> <?php echo $cr_regdate;?><span></span></p>              
              <p> <b>Current Status :</b><?php echo $cr_status_temp;?> </p>
            </div>    			
          </div>
          <!-- Ratings-->          
        </div>
        <!-- Product Specification-->
        <div class="p-specification bg-white mb-3 py-3">
          <div class="container">
            <h6>Classroom Details</h6>
            <p id="desc"><?php echo $cr_desc;?></p>            
          </div>
        </div>
		<?php
		if($cr_status == 1 OR $cr_status == 2){
		echo"<div class='ratings-submit-form bg-white py-3' style='display:none;'>
          <div class='container'>
            <button class='btn btn-danger ml-3' onclick='remove_classroom(<?php echo $cr_id;?>)' type='submit'>Leave Classroom</button>
          </div>
        </div>";
		}
		?>
		<!-- Ratings Submit Form-->
		<div align="center" id="success-alert" class="<?php echo $alert; ?>" role="alert" style="color:green;<?php echo $show; ?>"><?php echo $error; ?></div>
        <div class="ratings-submit-form bg-white py-3">
          <div class="container">
            <h6>Submit Message</h6>
            <form action="" method="post"> 			
              <textarea class="form-control mb-3" id="comments" name="comment" cols="30" rows="10" data-max-length="200" placeholder="Write your review..."></textarea>
              <button class="btn btn-sm btn-primary" name="submitcumment" type="submit">Send Message</button>
            </form>
          </div>
        </div>
        <!-- Rating & Review Wrapper-->
        <div class="rating-and-review-wrapper bg-white py-3 mb-3">
          <div class="container">
            <h6>Messages</h6>
            <div class="rating-review-content">
              <ul class="pl-0">
                <?php
				$sql_chat="SELECT c.chat_desc, e.euname, c.chat_date, c.chat_status FROM chat c, end_user e WHERE e.euid=c.euid AND c.chat_status!=0 AND c.cr_id=$cr_id ORDER BY chat_id desc;";
				$result = $conn->query($sql_chat);
				if ($result->num_rows > 0){
					while($row = $result->fetch_assoc()) {
						if($row['chat_status'] == 1){
						echo "<li class='single-user-review d-flex'>
							<div class='user-thumbnail'><img src='img/bg-img/member.png' alt=''></div>
							<div class='rating-comment'>
								<div class='rating'>".$row['euname']."</div>
								<p class='comment mb-0'>".$row['chat_desc']."</p><span class='name-date'>".$row['chat_date']."</span>
							</div>
						</li>";
						}
						else if($row['chat_status'] == 2){
							echo "<li class='single-user-review d-flex'>
							<div class='user-thumbnail'><img src='img/bg-img/member.png' alt=''></div>
							<div class='rating-comment'>
								<div class='rating' style='background-color:red;'>Teacher</div>
								<p class='comment mb-0'>".$row['chat_desc']."</p><span class='name-date'>".date('d-m-Y', strtotime($row['chat_date']))."</span>
							</div>
						</li>";
						}
					}					
				}
				else 
				{
					echo "No Messages!";
				}			
				?>                
              </ul>
            </div>
          </div>
        </div>        
      </div>
    </div>
    <!-- Internet Connection Status-->
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

<!-- Mirrored from designing-world.com/suha-v2.1.0/single-product.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Sep 2020 08:34:27 GMT -->
</html>