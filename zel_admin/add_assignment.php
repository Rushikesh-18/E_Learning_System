<?php
$sender="add_assignment";
$login_session="" ;
 $url="";
 $status="";
 include('lock.php');
  //session_start();
// import connection file
include ("conn.php");
// define variables and set to empty values
   $uname = "";
   $pass = "";
   $currdate= ""; 
   $status=null;
   $errorc="";
  $showc="display:none;";
   $errorv="";
  $showv="display:none;";
  $alertc="";
  $alertv="";
  $error="";
  $show="display:none;";
  $alert="";
// define variables and set to empty values
	  $error="";
	  $show="display:none;";
	  $alert="";
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
 <title> Add Assignment </title>
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
    <div class="col-md-12">
      <div align="center" class="<?php echo $alertc; ?>" role="alert" style="<?php echo $showc; ?>"><?php echo $errorc; ?></div>
      <div align="center" class="<?php echo $alertv; ?>" role="alert" style="<?php echo $showv; ?>"><?php echo $errorv; ?></div>
    </div> <!-- close col-->
  </div> <!--close row-->
<div class="row">
  
  <div class="<?php echo $alert; ?>" role="alert" style="<?php echo $show; ?>"><?php echo $error; ?></div>
  
<!--<div class="alert alert-success alert-sm" role="alert" id="signalert" style="display:show;">Well done! You successfully Signup!</div> -->
<div class="panel panel-info">
      <div class="panel-heading" align="center">Add Assignment </div>
      <div class="panel-body">
 <form enctype="multipart/form-data" data-toggle="validator" role="form" method="post" action="./php_action/add_assignment.php?sender=<?php echo $sender?>">
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
		  <label class="control-label">Assignment Title</label>
		<input type="text" class="form-control" id="ass_name" name= "ass_name" required />
		</div>
		<div class="form-group">
		  <label class="control-label">Assignment Description</label>
		<textarea class="form-control" rows="3" id="ass_desc" name= "ass_desc" required></textarea>
	  </div>
	</div>
	<div class = "col-md-6">
		<div class="form-group">
		  <label class="control-label">Assignment Submit Date</label>
		<input type="date" class="form-control" id="ass_sub_date" name= "ass_sub_date" required />
		</div>
	  
		<div class="form-group">
			<label class="control-label">Select Content Type</label>
				<select class="form-control" name="ass_type" id="ass_type" onChange="changefile(this)" required>
					<option value="">Select Type</option>
					<option value="File"> PDF File </option>
					<option value="Photo">Image </option>
					<option value="Video">Video</option>
					<option value="Link">Link</option>
					<option value="None">None </option>
				</select>
		</div>	
		<div class="form-group" id="div_userfile" style="display:none;">
			<label class="control-label">Upload File</label>
			<input class="form-control" id="userfile" name="userfile" type="file" />
		</div>
		<div class="form-group" id="div_txtlink" style="display:none;">
			<label class="control-label">Enter Link</label>
			<textarea class="form-control" rows="3" id="txtlink" name= "txtlink"></textarea>
		</div>
	</div>
  <div class="form-group" align="center">
    <button type="submit" class="btn btn-info" name="submitlink">Submit Assignment</button>
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

<div class="col-md-12" style="display:none;">
<div class="panel panel-info" >
      <div class="panel-heading"  align="center">Assignment Details</div>
      <div class="panel-body">
        <div class='table-responsive'>
      <?php
      //include('conn.php');
      error_reporting(E_ALL); 
$sql="SELECT * FROM assignment WHERE ass_status=1 ORDER BY ass_name DESC";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        // output data of each row
       
          echo "<table class='table table-striped'>
          <thead>
            <tr>
			  <th>Sr.No.</th>
			  <th>Post Description</th>
              <th>Post Type </th>
              <th>Post Privacy </th>
              <th>Date </th>              
              <th>Submit Date </th>              
			  <th>File/Link</th>
			  <th>Status</th>			  			
			  <th>Action</th>
           </tr>
          </thead>
          <tbody>";
		  $count=0;
          while($row = $result->fetch_assoc()) {
			  $count++;
              echo"<tr>";             
              echo "<td>".$count."</td>";
              echo "<td>".$row['ass_name']."</td>";
              echo "<td>".$row['ass_desc']."</td>";
              echo "<td>".$row['ass_type']."</td>";
			   echo "<td>".date( 'd/m/Y', strtotime($row['ass_date']))."</td>";
			   echo "<td>".date( 'd/m/Y', strtotime($row['ass_sub_date']))."</td>";
			   if($row['ass_path']=='File' || $row['ass_path']=='Photo' || $row['ass_type']=='Video'){
			   echo"<td><u><a href='".$row['ass_path']."' target='self' >Download OR View (".$row['ass_type'].")</a></u></td>";
			   }
			   else{
			   echo"<td><u><a href='".$row['ass_path']."' target='self' >Download OR View (".$row['ass_type'].")</a></u></td>";
			   }
			   if($row['ass_status']==1){echo "<td class='success'>Active</td>";}
			   else if ($row['ass_status']==2){echo "<td class='warning'>Pending</td>";}			
			   else if($row['ass_status']==0){echo "<td class='danger'>Rejected</td>";}			
			   else {echo "<td class='primary'>None</td>";}	
			echo"<td class='text-center'>
			<div class='btn-group'>
			<button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'>	Action <span class='caret'></span></button>
			<ul class='dropdown-menu'>
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