<?php ob_start(); ?>

<?php
$login_session="" ;
 $url="";
 $status="";
 include('lock.php');
 include ("conn.php");
?>
<?php
// define variables and set to empty values
$errorv="";
$showv="display:none;";
$alertv="";
$vis="hide";
$comp_id ="";
$comp_name = "";
$comp_tag_line = "";
$pro_pra_name = "";
$comp_add = "";
$comp_mob= "";
$comp_mob1= "";
$comp_web= "";

//fetch Company Details
$compsql = "SELECT * FROM company_profile WHERE comp_id = 1";
$compQuery = $conn->query($compsql);
while ($compResult = $compQuery->fetch_assoc()) {
	$comp_id = $compResult['comp_id'];
	$comp_name = $compResult['comp_name'];
	$comp_tag_line = $compResult['comp_tag_line'];
	$pro_pra_name = $compResult['pro_pra_name'];
	$comp_add = $compResult['comp_add'];
	$comp_mob= $compResult['comp_mob'];
	$comp_mob1= $compResult['comp_mob1'];
	$comp_web= $compResult['comp_web'];
}
		
if (isset($_POST['submitcomp']))
{
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$uid=$user_id;
		$comp_id= test_input($_POST["txtcomp_id"]);
		$comp_name=test_input($_POST["txtcomp_name"]);
		$comp_tag_line=test_input($_POST["txtcomp_tag"]);
		$pro_pra_name=test_input($_POST["txtpro_pra_name"]);
		$comp_add=test_input($_POST["txtcomp_add"]);
		$comp_mob=test_input($_POST["txtcomp_mob"]);
		$comp_mob1=test_input($_POST["txtcomp_mob1"]);
		$comp_web=test_input($_POST["txtcomp_web"]);
		$sql= "UPDATE company_profile SET comp_name='$comp_name', comp_tag_line='$comp_tag_line', pro_pra_name='$pro_pra_name', comp_add='$comp_add', comp_mob='$comp_mob', comp_mob1='$comp_mob1', comp_web='$comp_web' WHERE comp_id=$comp_id";
		if ($conn->query($sql) === TRUE) {
			// echo $say;
			$errorv="Company Profile Updated successfully!";
			$showv="display:show;";
			$alertv="alert alert-success";
		}
		else{
			$errorv="Your Process is invalid Try Again!";
			$showv="display:show;";
			$alertv="alert alert-danger";
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
<?php ob_end_flush(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Company Profile</title>
  <link rel="shortcut icon" type="image/x-icon" href="./images/favicon.ico" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="./resources/bootstrap-3.3.6-dist/css/bootstrap.min.css">
  <script src="./resources/bootstrap-3.3.6-dist/js/jquery.min.js"></script>
  <script src="./resources/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="./resources/jquery-ui.min.css" type="text/css" /> 
  <script type="text/javascript" src="./resources/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="./resources/jquery-ui.min.js"></script>

<script src="./resources/angular.min.js"></script>
<script src="./sss.js"></script>

<script type="text/javascript">
$(function() {
  
  //autocomplete
  $(".auto").autocomplete({
    source: "search.php",
    minLength: 1
  });       

});
</script>
</head>
<body ng-app="simpleApp">
<?php
include('header.php');
?>

<div class="container">
<div class="row">
<div class="col-md-3">
</div>
<div class="col-md-6">
<div align="center" class="<?php echo $alertv; ?>" role="alert" style="<?php echo $showv; ?>"><?php echo $errorv; ?></div>
<div class="panel panel-info">
      <div class="panel-heading" align="center">Company Profile Update </div>
      <div class="panel-body">
  <form data-toggle="validator" name="main" id="main" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <div class="form-group">
	  <label  class =" control-label"> Company Name</label>
      <input class="form-control" type="hidden" id="txtcomp_id" name= "txtcomp_id" value="<?php echo $comp_id; ?>" placeholder="Company ID" readonly required>
      <input class="form-control" type="text" id="txtcomp_name" name= "txtcomp_name" value="<?php echo $comp_name; ?>" placeholder="Company Name" required>
      </div>
	  <div class="form-group">
	  <label  class =" control-label"> Company Tag Line</label>
      <input class="form-control" type="text" id="txtcomp_tag" name= "txtcomp_tag" value="<?php echo $comp_tag_line; ?>" placeholder="Company Tag Line" required>
      </div>
	  <div class="form-group">
	  <label  class =" control-label"> Proprietor Name</label>
      <input class="form-control" type="text" id="txtpro_pra_name" name= "txtpro_pra_name" value="<?php echo $pro_pra_name; ?>" placeholder="Proprietor Name" required>
      </div>
	  <div class="form-group">
	  <label  class =" control-label"> Company Address</label>
      <input class="form-control" type="text" id="txtcomp_add" name= "txtcomp_add" value="<?php echo $comp_add; ?>" placeholder="Company Address" required>
      </div>
	  <div class="form-group">
	  <label  class =" control-label"> Company Mobile</label>
      <input class="form-control" type="text" id="txtcomp_mob" name= "txtcomp_mob" value="<?php echo $comp_mob; ?>"placeholder="Mobile Number" required>
      </div>
	  <div class="form-group">
	  <label  class =" control-label"> Company Alternate Mobile</label>
      <input class="form-control" type="text" id="txtcomp_mob1" name= "txtcomp_mob1" value="<?php echo $comp_mob1; ?>" placeholder="Alternate Mobile Number" required>
      </div>
	  <div class="form-group">
	  <label  class =" control-label"> Company Website / Email Id</label>
      <input class="form-control" type="text" id="txtcomp_web" name= "txtcomp_web" value="<?php echo $comp_web; ?>" placeholder="Company Website / email" required>
      </div>

  <div class="form-group" align="center">
    <button type="submit" class="btn btn-info" id ="submitcomp" name="submitcomp">Update Company Profile</button>
  </div>  
</form>
</div> <!-- Close panel Body -->
</div> <!-- Close Panel -->
</div> <!-- Close Col -->
</div> <!-- Close Row -->
</div> <!-- Close Container -->
<?php
include('./footer.php');
?>
</body>
</html>