<?php
$sender="add_meet";
$login_session="" ;
 $url="";
 $status="";
 include('lock.php');
include ("conn.php");
// define variables and set to empty values
	  $error="";
	  $show="display:none;";
	  $alert="";
if (isset($_POST['submitmeet'])){
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	 $cr_id = test_input($_POST["cr_id"]);
	 $meet_name = test_input($_POST["meet_name"]);
	 $meet_desc = test_input($_POST["meet_desc"]);
	 $meet_link = test_input($_POST["meet_link"]);
	 $meet_date = test_input($_POST["meet_date"]);
	 $meet_time = test_input($_POST["meet_time"]);
     $sql = "SELECT meet_name FROM meet WHERE meet_name='$meet_name' AND meet_link='$meet_link' AND meet_status=1";
	 $query = $conn->query($sql);
	 $count = $query->num_rows;
	 $today=date("Y-m-d");
      if ($count >0){
        $error="Meet Is Already Exist!";
        $show="display:show;";
        $alert="alert alert-danger";		
      }
	  else{
		$sql = "INSERT INTO meet (meet_name, meet_desc, meet_link, meet_date, meet_time, meet_regdate, meet_status, cr_id, uid)
		VALUES ('$meet_name', '$meet_desc','$meet_link','$meet_date','$meet_time', '$today', 1, $cr_id, $user_id)";
		if($conn->query($sql)===TRUE){
			$error="Meet Is Added Successfully!";
			$show="display:show;";
			$alert="alert alert-success";
		}
		else{
			$error="Process Is Invalid!";
			$show="display:show;";
			$alert="alert alert-success";
		}
	  }
	  header( "Refresh:3; url=./add_meet.php?alert=$alert&show=$show&error=$error", true, 303);
	}
}
	if (isset($_GET['error'])) {
      $error=$_GET['error'];
      $show=$_GET['show'];
      $alert=$_GET['alert'];
    }
//**************************************************************************************************************************
if (isset($_GET['delalert'])) {
  $errorv="PDF No ".$_GET['delalert']." Is Deleted successfully!";
        $showv="display:show;";
        $alertv="alert alert-success";
  }
  if (isset($_GET['delfail'])) {
    $errorc="Password Invalid ! Transaction Is Not Deleted Try Again !";
    //$errorc='<b>'.$cname.'</b>'." "."Customer Name Is Not Exist!";
    $showc="display:show;";
    $alertc="alert alert-danger";
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
 <title> Add Meet </title>
  <link rel="shortcut icon" type="image/x-icon" href="./images/favicon.ico" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="./resources/bootstrap-3.3.6-dist/css/bootstrap.min.css">
  <script src="./resources/bootstrap-3.3.6-dist/js/jquery.min.js"></script>
  <script src="./resources/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
  <script src="./sss.js"></script>
  <script type="text/javascript">
	function changefile(obj){
    var selectedtype= (obj.options[obj.selectedIndex].value);
		if(selectedtype=="File" || selectedtype=="Photo" || selectedtype=="Video")
		{
			document.getElementById("div_userfile").style="display:show;";
			document.getElementById("div_txtlink").style="display:none;";
			document.getElementById("txtlink").innerHTML="";
		}
		else if(selectedtype=="Link")
		{
			document.getElementById("div_txtlink").style="display:show;";
			document.getElementById("div_userfile").style="display:none;";
			document.getElementById("txtlink").innerHTML="";
		}
		else
		{
			document.getElementById("div_txtlink").style="display:none;";
			document.getElementById("div_userfile").style="display:none;";
			document.getElementById("txtlink").innerHTML="#";			
		}
    }
</script>

</head>
<body>
<?php
include('./header.php');
?>
<div class="container" style="margin-top:20px">
<div class="row">
  
  <div class="<?php echo $alert; ?>" role="alert" style="<?php echo $show; ?>"><?php echo $error; ?></div>
  
<!--<div class="alert alert-success alert-sm" role="alert" id="signalert" style="display:show;">Well done! You successfully Signup!</div> -->
<div class="panel panel-info">
      <div class="panel-heading" align="center">Add Meets </div>
      <div class="panel-body">
 <form enctype="multipart/form-data" data-toggle="validator" role="form" method="post" action="">
	<div class = "col-md-6">
		<div class="form-group">
			<label>Select Classroom</label>
			<select class="form-control action" id="cr_id" name="cr_id" required>
			  <option value="">Select Classroom</option>
			<?php
				$query = "SELECT cr_id, cr_name from classrooms where cr_status=1 ORDER BY cr_name ASC";
				$result = $conn->query($query);  
				while($row = $result->fetch_assoc()) {                                                 
				echo "<option value='".$row['cr_id']."'>".$row['cr_name']."</option>";
				}
			?>		   
			</select>
		</div>
	  <div class="form-group">
		  <label class="control-label">Meet Title</label>
		<input type="text" class="form-control" id="meet_name" name= "meet_name" required />
		</div>
		<div class="form-group">
		  <label class="control-label">Meet Description</label>
		<textarea class="form-control" rows="3" id="meet_desc" name= "meet_desc" required></textarea>
	  </div>
	</div>
	<div class = "col-md-6">
		<div class="form-group">
		  <label class="control-label">Meet Date</label>
		<input type="date" class="form-control" id="meet_date" name= "meet_date" required />
		</div>
		<div class="form-group">
		  <label class="control-label">Meet Time</label>
		<input type="time" class="form-control" id="meet_time" name= "meet_time" required />
		</div>
		<div class="form-group">
			<label class="control-label">Enter Meet Link</label>
			<textarea class="form-control" rows="3" id="meet_link" name= "meet_link"></textarea>
		</div>
	</div>
  <div class="form-group" align="center">
    <button type="submit" class="btn btn-info" name="submitmeet">Submit Meet</button>
  </div>
</form>

</div> <!-- Close Panel body -->
</div> <!-- Close panel -->

</div> <!-- Close Row -->
</div> <!-- Close Container -->
<?php
include('./footer.php');
?>
</body>
</html>
