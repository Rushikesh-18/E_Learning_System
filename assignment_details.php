<?php
include('lock.php');
include('conn.php');
if (isset($_GET['ass_id'])) {	
$ass_id=$_GET['ass_id'];
$sql1="SELECT * FROM classrooms cr, course c, end_user eu, user u, assignment ass, classroom_student cs WHERE cr.cr_id=cs.cr_id AND cr.cr_id=ass.cr_id AND u.uid=cr.uid AND eu.euid=cs.euid AND c.cid = cr.cid AND ass.ass_id=$ass_id";
$result = $conn->query($sql1);
if ($result->num_rows > 0){
	while($row = $result->fetch_assoc()) {
		$cr_id = $row["cr_id"];
			$uname = $row["uname"];
			$c_name = $row["c_name"];
			$cr_name = $row["cr_name"];
			$ass_name = $row["ass_name"];
			$ass_desc = $row["ass_desc"];
			$ass_path = $row["ass_path"];
			$ass_status = $row["ass_status"];
			$ass_date= $row["ass_date"];	
			$ass_sub_date= $row["ass_sub_date"];	
	}
	$error="Assignment Details Found successfully!";
	$show="display:none;";
	$alert="alert alert-success";
	$vis="show";
}
else 
{
	$error='<b>'.$ass_id.'</b>'." "."assignment Id Is Not Exist!";
	header('Location:./my_assignment.php');
	$show="display:show;";
	$alert="alert alert-danger";
}
}
else{
	header('Location:./home.php');
}
if (isset($_POST['sub_ass'])){
	if ($_SERVER["REQUEST_METHOD"] == "POST") {	
		 $ass_id = test_input($_POST["ass_id"]);
		 $uidsend=$user_id;
		 $today=date('Y-m-d');
		 $sql1="SELECT * FROM assignment_answer WHERE ass_id=$ass_id AND euid=$user_id AND aa_status=1";
		 $result = $conn->query($sql1);
		  if ($result->num_rows > 0){
			$error="Assignment Answer Sheet Is Already Exist!";
			$show="display:show;";
			$alert="alert alert-danger";
			header("Location:./assignment_details.php?ass_id=$ass_id&error=$error&show=$show&alert=$alert");
			exit;			
		  }
		  
		 else if ($ass_sub_date < $today){
			$error="Assignment Submission Date Expired!";
			$show="display:show;";
			$alert="alert alert-danger";
			header("Location:./assignment_details.php?ass_id=$ass_id&error=$error&show=$show&alert=$alert");
			exit;
		 }
		else if(!isset($_FILES['userfile']))
		{
			//$msg=upload_econtents($uidsend);
			$error=$msg;
			$show="display:show;";
			$alert="alert alert-danger";
			header("Location:./assignment_details.php?ass_id=$ass_id&error=$error&show=$show&alert=$alert");
		}
		else
		{
			try {
			$msg= upload($uidsend);  //this will upload your image
			$error=$msg;
			$show="display:show;";
			$alert="alert alert-info";
			header("Location:./assignment_details.php?ass_id=$ass_id&error=$error&show=$show&alert=$alert");
			//echo $msg;  //Message showing success or failure.
			}
			catch(Exception $e) {
			echo $e->getMessage();
			//echo 'Sorry, could not upload file';
			$error="Sorry, could not upload file";
			$show="display:show;";
			$alert="alert alert-danger";
			header("Location:./assignment_details.php?ass_id=$ass_id&error=$error&show=$show&alert=$alert");
			}
		}
	}
}
function upload($uidsend) {
	 $msg=null;
	 $ass_id = test_input($_POST["ass_id"]);	 
     include('./lock.php');
     $uid=$uidsend;
     $status=1; 
	 $type="application/pdf";	 
     $maxsize = 10000000; //set to approx 10 MB
    if($_FILES['userfile']['error']==UPLOAD_ERR_OK) {
        if(is_uploaded_file($_FILES['userfile']['tmp_name'])) {    

            if( $_FILES['userfile']['size'] < $maxsize) {  
                 $finfo = finfo_open(FILEINFO_MIME_TYPE);
                if(strpos(finfo_file($finfo, $_FILES['userfile']['tmp_name']),$type)===0) {    
                    $imgData =addslashes (file_get_contents($_FILES['userfile']['tmp_name']));
					$temp = explode(".", $_FILES["userfile"]["name"]);
					$newfilename = $uid."_".date("Ymdhis").'.' . end($temp);
					move_uploaded_file($_FILES["userfile"]["tmp_name"],"./uploads/answer_sheet/".$newfilename);
					$ans_path ="./uploads/answer_sheet/".$newfilename;
					 $sql = "INSERT INTO assignment_answer (ans_path, ass_id, euid, aa_date, aa_status)
						VALUES ( '$ans_path', $ass_id, $uid, @now := now(), '$status')";
						echo $sql;
                    include('../conn.php');
                    if($conn->query($sql)===TRUE){
                    $msg='<p>Contents is Uploaded successfully !</p>';
                    }                  
                }
                else
                    $msg="<p>Uploaded file is not Valid.</p>";
            }
             else {
                $msg='pdf File exceeds the Maximum File limit, Maximum File limit is '.$maxsize.' bytes, File '.$_FILES['userfile']['name'].' is '.$_FILES['userfile']['size'].' bytes';
                }
        }
        else
		{
            $msg="pdf File not uploaded successfully.";
		}

    }
    else {
        $msg= file_upload_error_message($_FILES['userfile']['error']);		
    }
    return $msg;
}

function file_upload_error_message($error_code) {
    switch ($error_code) {
        case UPLOAD_ERR_INI_SIZE:
            return 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
        case UPLOAD_ERR_FORM_SIZE:
            return 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
        case UPLOAD_ERR_PARTIAL:
            return 'The uploaded file was only partially uploaded';
        case UPLOAD_ERR_NO_FILE:
            return 'No file was uploaded';
        case UPLOAD_ERR_NO_TMP_DIR:
            return 'Missing a temporary folder';
        case UPLOAD_ERR_CANT_WRITE:
            return 'Failed to write file to disk';
        case UPLOAD_ERR_EXTENSION:
            return 'File upload stopped by extension';
        default:
            return 'Unknown upload error';
    }
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
if (isset($_GET['error'])) {
      $error=$_GET['error'];
      $show=$_GET['show'];
      $alert=$_GET['alert'];
    }
?>
<?php 
if($ass_status==1){$ass_status_temp= "Active";}
else if ($ass_status==2){$ass_status_temp=  "Assigned";}			
else if ($ass_status==3){$ass_status_temp=  "Completed"; }			
else if($ass_status==4){$ass_status_temp=  "Closed";}			
else if($ass_status==0){$ass_status_temp=  "Deleted";}			
else {$ass_status_temp =  "None";}
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
    <title>Assignment Details</title>
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
        <div class="back-button"><a href="my_assignment.php"><i class="lni lni-arrow-left"></i></a></div>
        <!-- Page Title-->
        <div class="page-heading">
          <h6 class="mb-0">Assignment Details</h6>
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
	  <div class="<?php echo $alert; ?>" role="alert" style="text-align:center;<?php echo $show; ?>"><?php echo $error; ?></div>
        <!-- Product Title & Meta Data-->
        <div class="specification bg-white mb-3 py-3" style="padding-top:50px;">
          <div class="container d-flex justify-content-between">		  
            <div class="p-title-price">
              <h6 class="mb-1"> Assignment : <?php echo $ass_name;?></h6>
              <p> <b>Course:</b>  <?php echo $c_name;?><span></span></p>
              <p> <b>Classroom:</b>  <?php echo $cr_name;?><span></span></p>
              <p> <b>Teacher Name:</b>  <?php echo $uname;?><span></span></p>
              <p> <b>Assign Date:</b> <?php echo $ass_date;?><span></span></p>              
              <p> <b>Submission Date:</b> <?php echo $ass_sub_date;?><span></span></p>              
              <p> <b>Current Status :</b><?php echo $ass_status_temp;?> </p>
			  <a class="btn btn-danger btn-sm" target="self" href="./zel_teacher/<?php echo $ass_path?>">Download Assignment</a>
            </div>
			
          </div>
          <!-- Ratings-->          
        </div>
        <!-- Product Specification-->
        <div class="p-specification bg-white mb-3 py-3">
          <div class="container">
            <h6>Assignment Details</h6>
            <p id="desc"><?php echo $ass_desc;?></p>            
          </div>
        </div>
		<div class="p-specification bg-white mb-3 py-3">
          <div class="container">
            <h6>Marks Details</h6>
			<?php 
				$sql1="SELECT * FROM assignment_answer WHERE ass_id=$ass_id AND euid=$user_id AND aa_status=1";
				$result = $conn->query($sql1);
				if ($result->num_rows > 0){
					while($row = $result->fetch_assoc()) {
						$marks = $row["marks"];
						$remark = $row["remark"];
					}	
				}
				else 
				{
					$marks="Not Update";
					$remark="Not Updated";
				}?>
            <h5>Marks: <?php echo $marks;?></h5>            
            <p>Remark: <?php echo $remark;?></p>            
          </div>
        </div>
		<div class="ratings-submit-form bg-white py-3">
          <div class="container">
            <h6>Submit Assignment Answer Sheet</h6>
            <form enctype="multipart/form-data" action="./assignment_details.php?ass_id=<?php echo $ass_id?>" method="POST">
			<input class="form-control" type="hidden" name= "ass_id" value="<?php echo $ass_id?>" required />
				<div class="mb-3">
					  <div class="title mb-2"><span>Upload Answer Sheet File</span></div>
					  <input class="form-control" type="file" name= "userfile" required />
				</div>				             
              <button class="btn btn-sm btn-success" name="sub_ass" type="submit">Submit Answer Sheet</button>
            </form>
          </div>
        </div>
        <!-- Rating & Review Wrapper-->
       <!-- <div class="rating-and-review-wrapper bg-white py-3 mb-3">
          <div class="container">
            <h6>Ratings &amp; Reviews</h6>
            <div class="rating-review-content">
              <ul class="pl-0">
                <li class="single-user-review d-flex">
                  <div class="user-thumbnail"><img src="img/bg-img/7.jpg" alt=""></div>
                  <div class="rating-comment">
                    <div class="rating"><i class="lni lni-star-filled"></i><i class="lni lni-star-filled"></i><i class="lni lni-star-filled"></i><i class="lni lni-star-filled"></i><i class="lni lni-star-filled"></i></div>
                    <p class="comment mb-0">Very good product. It's just amazing!</p><span class="name-date">Designing World 12 Dec 2020</span>
                  </div>
                </li>
                <li class="single-user-review d-flex">
                  <div class="user-thumbnail"><img src="img/bg-img/8.jpg" alt=""></div>
                  <div class="rating-comment">
                    <div class="rating"><i class="lni lni-star-filled"></i><i class="lni lni-star-filled"></i><i class="lni lni-star-filled"></i><i class="lni lni-star-filled"></i><i class="lni lni-star-filled"></i></div>
                    <p class="comment mb-0">WOW excellent product. Love it.</p><span class="name-date">Designing World 8 Dec 2020</span>
                  </div>
                </li>
                <li class="single-user-review d-flex">
                  <div class="user-thumbnail"><img src="img/bg-img/9.jpg" alt=""></div>
                  <div class="rating-comment">
                    <div class="rating"><i class="lni lni-star-filled"></i><i class="lni lni-star-filled"></i><i class="lni lni-star-filled"></i><i class="lni lni-star-filled"></i><i class="lni lni-star-filled"></i></div>
                    <p class="comment mb-0">What a nice product it is. I am looking it's.</p><span class="name-date">Designing World 28 Nov 2020</span>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <!-- Ratings Submit Form-->
       <!-- <div class="ratings-submit-form bg-white py-3">
          <div class="container">
            <h6>Submit A Review</h6>
            <form action="#" method="">
              <div class="stars mb-3">
                <input class="star-1" type="radio" name="star" id="star1">
                <label class="star-1" for="star1"></label>
                <input class="star-2" type="radio" name="star" id="star2">
                <label class="star-2" for="star2"></label>
                <input class="star-3" type="radio" name="star" id="star3">
                <label class="star-3" for="star3"></label>
                <input class="star-4" type="radio" name="star" id="star4">
                <label class="star-4" for="star4"></label>
                <input class="star-5" type="radio" name="star" id="star5">
                <label class="star-5" for="star5"></label><span></span>
              </div>
              <textarea class="form-control mb-3" id="comments" name="comment" cols="30" rows="10" data-max-length="200" placeholder="Write your review..."></textarea>
              <button class="btn btn-sm btn-primary" type="submit">Save Review</button>
            </form>
          </div>
        </div> -->
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