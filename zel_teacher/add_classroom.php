<?php
$login_session="" ;
 $url="";
 $status="";
 include('lock.php');
 include('conn.php');
$error="";
$show="display:none;";
$alert="";
if (isset($_POST['submit'])){
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	 $cr_name = test_input($_POST["cr_name"]);
	 $cid = test_input($_POST["cid"]);
	 $cr_desc = test_input($_POST["cr_desc"]);
     $sql = "SELECT cr_name FROM classrooms WHERE cr_name='$cr_name' AND cr_status=1";
	 $query = $conn->query($sql);
	 $count = $query->num_rows;
	 $today=date("Y-m-d");
      if ($count >0){
        $error="classroom Name Is Already Exist!";
        $show="display:show;";
        $alert="alert alert-danger";		
      }
	  else{
		$sql = "INSERT INTO classrooms (cr_name, cr_desc, cr_regdate, cr_status, cid, uid) VALUES ('$cr_name', '$cr_desc', '$today', 1, $cid, $user_id)";
		if($conn->query($sql)===TRUE){
			$error="Classroom Name Is Added Successfully!";
			$show="display:show;";
			$alert="alert alert-success";
		}
		else{
			$error="Process Is Invalid!";
			$show="display:show;";
			$alert="alert alert-success";
		}
	  }
	  header( "Refresh:3; url=./add_classroom.php?alert=$alert&show=$show&error=$error", true, 303);
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
<head>
 <title> Add Classroom </title>
  <link rel="shortcut icon" type="image/x-icon" href="./images/favicon.ico" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="./resources/bootstrap-3.3.6-dist/css/bootstrap.min.css">
  <script src="./resources/bootstrap-3.3.6-dist/js/jquery.min.js"></script>
  <script src="./resources/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
  <script src="./sss.js"></script>
</head>
<body>
<?php
include('./header.php');
?>
<div class="container" style="margin-top:20px">
<div class="row">
    <div class="col-md-12">
      <div align="center" class="<?php echo $alert; ?>" role="alert" style="<?php echo $show; ?>"><?php echo $error; ?></div>
    </div> <!-- close col-->
  </div> <!--close row-->
<div class="row">
  <div class = "col-md-6 col-md-offset-3">
<!--<div class="alert alert-success alert-sm" role="alert" id="signalert" style="display:show;">Well done! You successfully Signup!</div> -->
<div class="panel panel-info">
      <div class="panel-heading" align="center">Add Classroom </div>
      <div class="panel-body">
 <form enctype="multipart/form-data" data-toggle="validator" role="form" method="post" action="">
  <div class="form-group">
   <label class="control-label">Enter Classroom Name</label>
    <input class="form-control" type="text" id="cr_name" name= "cr_name" placeholder="Enter Classroom Name" required>
  </div>
  <div class="form-group">
   <label class="control-label">Select Course</label>
    <select class="form-control" name="cid" id="cid" required>
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
  <div class="form-group">
   <label class="control-label">Enter Description</label>
    <textarea class="form-control" rows="3" id="cr_desc" name= "cr_desc" placeholder="Enter Description" required></textarea>
  </div>
  <div class="form-group" align="center">
    <button type="submit" class="btn btn-info" name="submit">Add Classroom</button>
  </div>
</form>
</div> <!-- Close panel Body -->
</div> <!-- Close Panel -->
</div> <!-- Close Col -->

</div> <!-- Close Row -->
</div> <!-- Close Container -->
<?php
include('footer.php');
?>
</body>
</html>