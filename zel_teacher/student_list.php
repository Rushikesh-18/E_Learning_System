<?php
$login_session="" ;
 $url="";
 $status="";
 $euname="";
 $mob="";
 include('lock.php');
 include ("conn.php");
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
 if (isset($_POST['submitbymob'])){
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$eumob = test_input($_POST["txtmob"]);
		$sql = "SELECT * FROM end_user WHERE eumob='$eumob'";
	}
}
else if (isset($_POST['submitbyname'])){
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$euname = test_input($_POST["txtname"]);
		$sql = "SELECT * FROM end_user WHERE euname='$euname'";
	}
}
else if (isset($_POST['submitbystatus'])){
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$status = test_input($_POST["status"]);
		if($status==0){
			$sql = "SELECT * FROM end_user ORDER BY euid DESC";
		}
		else{
		$sql = "SELECT * FROM end_user WHERE status=$status ORDER BY euid DESC";
		}
	}
}
else{
	$sql = "SELECT * FROM end_user WHERE status!=0 ORDER BY euid DESC";
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
<title> Student List </title>
<link rel="shortcut icon" type="image/x-icon" href="./images/favicon.ico" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="./resources/bootstrap-3.3.6-dist/css/bootstrap.min.css">
<script src="./resources/bootstrap-3.3.6-dist/js/jquery.min.js"></script>
<script src="./resources/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="./resources/jquery-ui.min.css" type="text/css" /> 
<script type="text/javascript" src="./resources/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="./resources/jquery-ui.min.js"></script>
<script type="text/javascript" src="./sss.js"></script>
<script type="text/javascript">
$(function() {
  //autocomplete
  $(".auto").autocomplete({
    source: "search.php",
    minLength: 1
  });       
});
</script>
<script type="text/javascript">
function printbill(){
//alert("hiiiiiiiiiiii");
var prtContent = document.getElementById("invoice");
var WinPrint = window.open('Todays Cases', 'Todays Cases', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
WinPrint.document.write(prtContent.innerHTML);
WinPrint.document.close();
WinPrint.focus();
WinPrint.print();
WinPrint.close();
}
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
		  <div class="panel-heading" align="center">Search Student User</div>
		  <div class="panel-body">
			<form class="form-inline" data-toggle="validator" name="sub" id="sub" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<div class="col-md-4" >
					<div class="form-group">
					<input class="form-control auto1" type="number" id="txtmob" name= "txtmob" placeholder="Mobile Number" value="<?php echo $eumob?>">
					</div>
					<div class="form-group" align="center">
					<button type="submit" class="btn btn-info" id ="submitbymob" name="submitbymob">Search By Mobile</button>
					</div>
				</div>
				<div class="col-md-4" >
					<div class="form-group">
					<input class="form-control auto" type="text" id="txtname" name= "txtname" placeholder="User Name" value="<?php echo $euname?>">
					</div>
					<div class="form-group" align="center">
					<button type="submit" class="btn btn-info" id ="submitbyname" name="submitbyname">Search By Name</button>
					</div>
				</div>
				<div class="col-md-4" >
					 <div class="form-group">
						<label class="control-label">Select Status </label>
							<select class="form-control" id="status" name="status">
							  <option value="">Select Status</option>    
							  <option value="1">Approved User</option>    
							  <option value="3">Rejected User</option>    
							  <option value="2">Pending User</option>    
							  <option value="0">All User</option>    
							</select>
					</div>
					<div class="form-group" align="center">
					<button type="submit" class="btn btn-info" id ="submitbystatus" name="submitbystatus">Search By Status</button>
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
      <div class="panel-heading" align="center">Student List <a class="pull-right" align="right" href="#" onclick=printbill(); >Print List</a></div>
      <div class="panel-body">
        <div class='table-responsive' style="padding-bottom:100px;">
      <?php
      //include('conn.php');
      error_reporting(E_ALL);
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        // output data of each row
          echo "<table class='table table-bordered table-striped'>
          <thead>
            <tr>
              <th>#</th>
              <th>Id</th>
			  <th>Student Name </th>
              <th>Mobile </th>
              <th>Password </th>
              <th>Email </th>
              <th>Birth Date </th>
			  <th>address</th>
			  <th>Date </th>			 
			  <th>Status </th>			 
			  <th>Action</th>
           </tr>
          </thead>
          <tbody>";
          $count=0;
          while($row = $result->fetch_assoc()) {
              $count++;              
			echo"<tr>";
			echo "<td>".$count."</td>";
			echo "<td>".$row['euid']."</td>";
              echo "<td>".$row['euname']."</td>";
              echo "<td>".$row['eumob']."</td>";
              echo "<td>".$row['eupass']."</td>";
              echo "<td>".$row['email']."</td>";
              echo "<td>".date( 'd/m/Y', strtotime($row['bdate']))."</td>";       
              echo "<td>".$row['address']."</td>";
			   echo "<td>".date( 'd/m/Y', strtotime($row['euregdate']))."</td>";
			   if($row['status']==1){echo "<td class='success'>Active</td>";}
			   else if ($row['status']==2){echo "<td class='warning'>Pending</td>";}			
			   else if($row['status']==3){echo "<td class='danger'>Rejected</td>";}			
			   else {echo "<td class='primary'>None</td>";}	
			echo"<td class='text-center'>
			<div class='btn-group'>
			<button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'>	Action <span class='caret'></span></button>
			<ul class='dropdown-menu'>			
			<li><a type='button' href='./edit_student.php?euid=".$row['euid']."'>Edit</a></li>
			<li><a type='button' href='./view_student.php?euid=".$row['euid']."'>View/Print</a></li>
			<li><a type='button' id='deletebtn' onclick='delete_student(".$row['euid'].")'>Delete</a></li>
			<li><a type='button' id='approvebtn' onclick='approve_student(".$row['euid'].")'>Approve</a></li>
			<li><a type='button' id='rejectbtn' onclick='reject_student(".$row['euid'].")'>Reject</a></li>
			</ul>
			</div></td>";
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
        <div id="invoice" style="border:1px solid #ccc; padding:20px; height:100%; width:580pt; display:none;">
		<div style="text-align:left; border:0px solid #ccc; float:left; width:300pt;">
			<b>&nbsp;<?php echo $comp_name; ?></b><br/>
			&nbsp;<?php echo "Address: ".$comp_add; ?><br />
			&nbsp;<?php echo "Mobile: ".$comp_mob." / ".$comp_mob1;?><br />
		</div>
        
            <br />
        
     
        <div style="text-align:left; border:1px solid #ccc; float:right; width:100pt;">
          
           &nbsp;Date: &nbsp;<?php echo date( 'd/m/Y') ?>
        </div>
           
         

         <div Style=" clear:both; float:none;"></div>
         <h3 align="center">Student Reports</h3><hr/>
           
      <?php
      include('conn.php');
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
          echo "<table style= 'font-size:13px; width:100%;' border-collapse: collapse; cellspacing='0'>
          <thead>
            <tr>
              <th style='text-align:left; border-bottom: 1px solid #ddd; padding: 3px;'>Sr. No </th>
              <th style='text-align:left; border-bottom: 1px solid #ddd; padding: 3px;'>Student Name </th>
              <th style='text-align:left; border-bottom: 1px solid #ddd; padding: 3px;'>Mobile </th>
              <th style='text-align:left; border-bottom: 1px solid #ddd; padding: 3px;'>Email </th>
              <th style='text-align:left; border-bottom: 1px solid #ddd; padding: 3px;'>Address</th>
           </tr>
          </thead>
          <tbody>";
		  $count=0;
          while($row = $result->fetch_assoc()) {
            $count++;
           echo"<tr>";
              echo "<td style='text-align:left; border-bottom: 1px solid #ddd; padding: 3px;'>".$count."</td>";
              echo "<td style='text-align:left; border-bottom: 1px solid #ddd; padding: 3px;'>".$row['euname']."</td>";
              echo "<td style='text-align:left; border-bottom: 1px solid #ddd; padding: 3px;'>".$row['eumob']."</td>"; 
              echo "<td style='text-align:left; border-bottom: 1px solid #ddd; padding: 3px;'>".$row['email']."</td>"; 
              echo "<td style='text-align:left; border-bottom: 1px solid #ddd; padding: 3px;'>".$row['address']."</td>"; 
           echo "</tr>";
         }
          echo"</tbody>
      </table>";
        
        }  
      
        else {
          echo"<tr>";
         echo "<td colspan='6' style='border-bottom: 1px solid #ddd; padding: 3px;'>No Record Found</td>";
         echo "</tr>";
        }

        $conn->close();
      
        ?> 
         <div style=" text-align:center; border:1px solid #ccc; float:left; margin-top:50px; width:130pt;">
          
            Thank You!

        </div>

        <div style=" text-align:center; border:1px solid #ccc; float:right; margin-bottom:10px;  margin-top:40px; width:250pt;">
           <br/>
            <br />
            <b> &nbsp;For <?php echo $pro_pra_name; ?></b>
        </div>

      </div> <!-- Close Invoice -->
</body>
</html>