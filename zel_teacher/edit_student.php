<?php
$login_session="" ;
 $url="";
 $status="";
 include('lock.php');
 include('conn.php');
$error="";
$show="display:none;";
$alert="";
if (isset($_GET['euid'])) {	
$euid=$_GET['euid'];
$sql1="SELECT * FROM end_user WHERE euid=$euid";
$result = $conn->query($sql1);
if ($result->num_rows > 0){
	while($row = $result->fetch_assoc()) {
		$euid = $row["euid"];
		$euname = $row["euname"];
		$eumob = $row["eumob"];
		$eupass = $row["eupass"];		
		$address = $row["address"];
		$cid = $row["cid"];
		$email = $row["email"];
		$bdate = $row["bdate"];
		$status = $row["status"];
		$euregdate= $row["euregdate"];
	}
	$error="Student Is Found successfully!";
	$show="display:none;";
	$alert="alert alert-success";
	$vis="show";
}
else 
{
	$error='<b>'.$euid.'</b>'." "."Student Id Is Not Exist!";
	$show="display:show;";
	$alert="alert alert-danger";
}
}
if (isset($_POST['submitcust'])){
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	 $euid = test_input($_POST["euid"]);
	 $euname = test_input($_POST["euname"]);
	 $eumob = test_input($_POST["eumob"]);
	 $eupass = test_input($_POST["eupass"]);
	 $altmob = test_input($_POST["altmob"]);
	 $address = test_input($_POST["address"]);
	 $cid = test_input($_POST["cid"]);
	 $email = test_input($_POST["email"]);
	 $bdate = test_input($_POST["bdate"]);
	 $status = test_input($_POST["status"]);
	 $euregdate= date("Y-m-d");
     $sql = "SELECT eumob FROM end_user WHERE eumob='$eumob' AND euid!=$euid AND status=1";
	 $query = $conn->query($sql);
	 $count = $query->num_rows;
      if ($count >0){
        $error="Student mobile Number Is Already Exist!";
        $show="display:show;";
        $alert="alert alert-danger";		
      }
	  else{
		$sql = "UPDATE end_user SET euname='$euname', eumob='$eumob', eupass='$eupass', altmob='$altmob', cid=$cid, email='$email', bdate='$bdate', address='$address',status=$status WHERE euid=$euid";
		if($conn->query($sql)===TRUE){
			$error="Student Is Updated Successfully!";
			$show="display:show;";
			$alert="alert alert-success";
		}
		else{
			$error="Process Is Invalid!";
			$show="display:show;";
			$alert="alert alert-success";
		}
	  }
	  header( "Refresh:1; url=./edit_student.php?euid=$euid&alert=$alert&show=$show&error=$error", true, 303);
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
 <title> Edit Student </title>
  <link rel="shortcut icon" type="image/x-icon" href="./images/favicon.ico" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="./resources/bootstrap-3.3.6-dist/css/bootstrap.min.css">
  <script src="./resources/bootstrap-3.3.6-dist/js/jquery.min.js"></script>
  <script src="./resources/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
</head>
<body>
<?php
include('./header.php');
?>
<div class="container" style="margin-top:20px">
	<div class="row">
		<!--<div class="alert alert-success alert-sm" role="alert" id="signalert" style="display:show;">Well done! You successfully Signup!</div> -->
		<div class="panel panel-info">
		    <div class="panel-heading" align="center"> Edit Student Details </div>
		    <div class="panel-body">
				<div class="<?php echo $alert; ?>" role="alert" style="<?php echo $show; ?>"><?php echo $error; ?></div>
				<form enctype="multipart/form-data" method="POST" action="./edit_student.php?euid=<?php echo $euid?>" onsubmit="return validation()">
					<div class="row">
						<div class="col-md-6">	
						<div class="form-group">
						  <label class="control-label">Student Name</label>
							<input class="form-control" type="hidden" id="euid" name= "euid" placeholder="Student Id" value="<?php echo $euid;?>" required>
							<input class="form-control" type="text" id="euname" name= "euname" value="<?php echo $euname;?>" placeholder="Student Name" required>
						</div>		
						  <div class="form-group">
						  <label class="control-label">Mobile Number</label>
							<input class="form-control" type="number" id="eumob" name= "eumob" value="<?php echo $eumob;?>" placeholder="Mobile Number" required>
						  </div>
						 <div class="form-group">
						  <label class="control-label">Password</label>
							<input class="form-control" type="password" id="eupass" name= "eupass" value="<?php echo $eupass;?>" placeholder="Password" required>
						  </div>
						  <div class="form-group">
							 <label class="control-label">Alt Mobile</label>
							<input class="form-control" type="number" id="altmob" name= "altmob" value="<?php echo $altmob;?>" placeholder="Alt Mobile Number" required>
						  </div>
						  <div class="form-group">
							<label class="control-label">Address</label>
							<textarea class="form-control" rows="2" id="address" name= "address" required><?php echo $address;?></textarea>
						  </div>
						</div> 
						<div class="col-md-6">	        	
						<div class="form-group">
						  <label class="control-label">Email Id </label>
							<input class="form-control" type="text" id="email" name= "email" value="<?php echo $email;?>" placeholder="Email Id" >
						</div>
						<div class="form-group">
						  <label class="control-label">Date Of Birth </label>
							<input class="form-control" type="date" id="bdate" name= "bdate" value="<?php echo $bdate;?>" placeholder="Date Of Birth" >
						  </div>
						<div class="form-group">
							<label class="control-label">Select Course </label>
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
							<label class="control-label">Customer Status </label>
							<select class="form-control" name="status" id="status" required >
								<option value="">Select Status</option>
								<option value="1" id="">Active</option>
								<option value="2" id="">Pending</option>
								<option value="3" id="">Rejected</option>
								<option value="0" id="">Deleted</option>
							</select>
						</div>
						</div>			
					</div>	
				  <div class="form-group" align="center">
				  <button type="submit" class="btn btn-info" name="submitcust" id="submitcust">Update Student</button>
				  </div>
				</form>
			</div> <!-- Close panel Body -->
		</div> <!-- Close Panel -->
	</div> <!-- Close Row -->
</div> <!-- Close Container -->
<?php
include('footer.php');
?>
</body>
</html>