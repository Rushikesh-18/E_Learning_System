<?php
$login_session="" ;
 $url="";
 $status="";
 $euname="";
 $cid="";
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
 if (isset($_POST['submitbycr'])){
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$cr_id = test_input($_POST["cr_id"]);
		$sql = "SELECT * FROM Assignment ass, classrooms cr WHERE cr.cr_id=ass.cr_id AND ass.cr_id=$cr_id AND ass.ass_status=1 AND cr.uid=$user_id ORDER BY ass.ass_id DESC";
	}
}
else if (isset($_POST['submitbyname'])){
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$ass_name = test_input($_POST["txtname"]);
		$sql = "SELECT * FROM Assignment ass, classrooms cr WHERE cr.cr_id=ass.cr_id AND ass.ass_name='$ass_name' AND ass.ass_status=1 AND cr.uid=$user_id ORDER BY ass.ass_id DESC";
	}
}
else if (isset($_POST['submitbystatus'])){
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$status = test_input($_POST["status"]);
		if($status==3){
			$sql = "SELECT * FROM Assignment ass, classrooms cr WHERE cr.cr_id=ass.cr_id AND cr.uid=$user_id ORDER BY ass.ass_id DESC";
		}
		else{
		$sql = "SELECT * FROM Assignment ass, classrooms cr WHERE cr.cr_id=ass.cr_id AND ass.ass_status=$status AND cr.uid=$user_id ORDER BY ass.ass_id DESC";
		}
	}
}
else{
	$sql = "SELECT * FROM Assignment ass, classrooms cr WHERE cr.cr_id=ass.cr_id AND ass.ass_status=1 AND cr.uid=$user_id ORDER BY ass.ass_id DESC";
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
<title> Assignment List </title>
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
		  <div class="panel-heading" align="center">Search Assignment</div>
		  <div class="panel-body">
			<form class="form-inline" data-toggle="validator" name="sub" id="sub" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<div class="col-md-4" >
					<div class="form-group">
					<select class="form-control" name="cr_id" id="cr_id">
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
					<div class="form-group" align="center">
					<button type="submit" class="btn btn-info" id ="submitbycr" name="submitbycr">Search By Classroom</button>
					</div>
				</div>
				<div class="col-md-4" >
					<div class="form-group">
					<input class="form-control auto" type="text" id="txtname" name= "txtname" placeholder="Assignment Name" value="<?php echo $euname?>">
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
							  <option value="1">Active</option>    
							  <option value="2">Suspended</option>    
							  <option value="0">Deleted</option>       
							  <option value="3">All</option>    
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
      <div class="panel-heading" align="center">Assignment List <a style="display:none;" class="pull-right" align="right" href="#" onclick=printbill(); >Print List</a></div>
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
			  <th>Assignment Name </th>              
              <th>Classroom </th>
			  <th>Description</th>
			  <th>Created Date </th>			 
			  <th>Submit Date </th>			 
			  <th>Link </th>			 
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
			echo "<td>".$row['ass_id']."</td>";
              echo "<td>".$row['ass_name']."</td>";
              echo "<td>".$row['cr_name']."</td>";              
              echo "<td>".$row['ass_desc']."</td>";
			   echo "<td>".date( 'd/m/Y', strtotime($row['ass_date']))."</td>";
			   echo "<td>".date( 'd/m/Y', strtotime($row['ass_sub_date']))."</td>";
			   if($row['ass_path']=='File' || $row['ass_path']=='Photo' || $row['ass_type']=='Video'){
			   echo"<td><u><a href='".$row['ass_path']."' target='self' >Download OR View (".$row['ass_type'].")</a></u></td>";
			   }
			   else{
			   echo"<td><u><a href='".$row['ass_path']."' target='self' >Download OR View (".$row['ass_type'].")</a></u></td>";
			   }
			   if($row['ass_status']==1){echo "<td class='success'>Active</td>";}
			   else if ($row['ass_status']==2){echo "<td class='warning'>Suspended</td>";}						
			   else if ($row['ass_status']==0){echo "<td class='danger'>Deleted</td>";}						
			   else {echo "<td class='primary'>None</td>";}	
			echo"<td class='text-center'>
			<div class='btn-group'>
			<button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'>	Action <span class='caret'></span></button>
			<ul class='dropdown-menu'>
			<li><a type='button' href='./view_answer.php?ass_id=".$row['ass_id']."'>View Answers</a></li>
			<li><a type='button' id='deletebtn' onclick='delete_assignment(".$row['ass_id'].")'>Delete</a></li>
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
         <h3 align="center">Classrooms Reports</h3><hr/>
           
      <?php
      include('conn.php');
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
          echo "<table style= 'font-size:13px; width:100%;' border-collapse: collapse; cellspacing='0'>
          <thead>
            <tr>
              <th style='text-align:left; border-bottom: 1px solid #ddd; padding: 3px;'>Sr. No </th>
              <th style='text-align:left; border-bottom: 1px solid #ddd; padding: 3px;'> Id </th>
              <th style='text-align:left; border-bottom: 1px solid #ddd; padding: 3px;'>Classroom Name </th>
              <th style='text-align:left; border-bottom: 1px solid #ddd; padding: 3px;'>Course </th>
              <th style='text-align:left; border-bottom: 1px solid #ddd; padding: 3px;'>Description </th>
              <th style='text-align:left; border-bottom: 1px solid #ddd; padding: 3px;'>Date</th>
           </tr>
          </thead>
          <tbody>";
		  $count=0;
          while($row = $result->fetch_assoc()) {
            $count++;
           echo"<tr>";
              echo "<td style='text-align:left; border-bottom: 1px solid #ddd; padding: 3px;'>".$count."</td>";
              echo "<td style='text-align:left; border-bottom: 1px solid #ddd; padding: 3px;'>".$row['cr_id']."</td>";
              echo "<td style='text-align:left; border-bottom: 1px solid #ddd; padding: 3px;'>".$row['cr_name']."</td>";
              echo "<td style='text-align:left; border-bottom: 1px solid #ddd; padding: 3px;'>".$row['c_name']."</td>";
              echo "<td style='text-align:left; border-bottom: 1px solid #ddd; padding: 3px;'>".$row['cr_desc']."</td>"; 
              echo "<td style='text-align:left; border-bottom: 1px solid #ddd; padding: 3px;'>".date( 'd/m/Y', strtotime($row['cr_regdate']))."</td>"; 
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