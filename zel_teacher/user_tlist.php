<?php
$login_session="" ;
 $url="";
 $status="";
 $euname="";
 include('lock.php');
 include ("conn.php");
  if (isset($_POST['submitbymob'])){
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$eumob = test_input($_POST["txtmob"]);
		$sql = "SELECT * FROM end_user eu WHERE eu.eumob='$eumob' AND eu.status=1 ORDER BY eu.euname ASC";
	}
}
else if (isset($_POST['submitbyname'])){
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$euname = test_input($_POST["txtname"]);
			$sql = "SELECT * FROM end_user eu WHERE eu.euname='$euname' AND eu.status=1 ORDER BY eu.euname ASC";
	}
}
else if (isset($_POST['submitbycid'])){
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$cid = test_input($_POST["cid"]);
	    $sql = "SELECT * FROM end_user eu, mycourses mc, courses c WHERE eu.euid=mc.euid AND c.cid=mc.cid AND mc.status=1 AND c.cid=$cid ORDER BY mc.date ASC";
	}
}
else{
    $sql = "SELECT * FROM end_user eu WHERE eu.status=1 ORDER BY eu.euname ASC";
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
 <title> End User List</title>
  <link rel="shortcut icon" type="image/x-icon" href="./images/favicon.ico" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

 <link rel="stylesheet" href="./resources/bootstrap-3.3.6-dist/css/bootstrap.min.css">
  <script src="./resources/bootstrap-3.3.6-dist/js/jquery.min.js"></script>
  <script src="./resources/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="./resources/jquery-ui.min.css" type="text/css" /> 
<script type="text/javascript" src="./resources/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="./resources/jquery-ui.min.js"></script>
  <script src="./sss.js"></script>
  <script type="text/javascript">
$(function() {
  //autocomplete
  $(".auto1").autocomplete({
    source: "searchmob.php",
    minLength: 1
  });       
});
</script>
<script type="text/javascript">
$(function() {
  //autocomplete
  $(".auto").autocomplete({
    source: "searchname.php",
    minLength: 1
  });       
});
</script>
</head>
<body>
<?php
include('./header.php');
?>




<div class="container-fluid" style="margin-top:20px">
    <div class="row">
	<div class="col-md-12">
	<div class="panel panel-info">
		  <div class="panel-heading" align="center">Search User</div>
		  <div class="panel-body">
			<form class="form-inline" data-toggle="validator" name="sub" id="sub" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<div class="col-md-6" >
					<div class="form-group">
					<input class="form-control auto1" type="number" id="txtmob" name= "txtmob" placeholder="Mobile Number" value="<?php echo $eumob?>">
					</div>
					<div class="form-group" align="center">
					<button type="submit" class="btn btn-info" id ="submitbymob" name="submitbymob">Search By Mobile</button>
					</div>
				</div>
				<div class="col-md-6" >
					<div class="form-group">
					<input class="form-control auto" type="text" id="txtname" name= "txtname" placeholder="User Name" value="<?php echo $euname?>">
					</div>
					<div class="form-group" align="center">
					<button type="submit" class="btn btn-info auto" id ="submitbyname" name="submitbyname">Search By Name</button>
					</div>
				</div>
			</form>
	</div> <!-- Close panel Body -->
	</div> <!-- Close Panel -->
	</div> <!-- Close Col -->
</div>
<div class="row">
<div class="col-md-12">

<div class="panel panel-info">
      <div class="panel-heading" align="center">User Details</div>
      <div class="panel-body">
        <div class='table-responsive'>
      <?php
      //include('conn.php');
      error_reporting(E_ALL);
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        // output data of each row
       
          echo "<table class='table table-striped'>
          <thead>
            <tr>
              <th>User Id </th>
              <th>User Name </th>
              <th>Mobile </th>
			  <th>Password </th>
              <th>Email </th>
              <th>Birth Date </th>              
              <th>Address </th>                          
			   <th>Date</th>
           </tr>
          </thead>


          <tbody>";
          while($row = $result->fetch_assoc()) {
            
           echo"<tr>";
		   echo "<td>".$row['euid']."</td>";
		   echo "<td>".$row['euname']."</td>";
              echo "<td>".$row['eumob']."</td>";
              echo "<td>".$row['eupass']."</td>";
              echo "<td>".$row['email']."</td>";
              echo "<td>".date( 'd/m/Y', strtotime($row['bdate']))."</td>";
			   echo "<td>".$row['address']."</td>";
			   echo "<td>".date( 'd/m/Y', strtotime($row['euregdate']))."</td>";
				echo "</tr>";
         }
           
          echo"</tbody>
      </table>";
        
        }  
        else {
         echo "0 results";
        }
        $conn->close();
        ?> 
      </div>
      </div><!-- Close panel Body -->

</div> <!-- Close Panel -->
</div>


</div> <!-- Close Row -->


</div> <!-- Close Container -->
<?php
include('footer.php');
?>
</body>
</html>