<?php
include('conn.php');
include('lock.php');
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
if (isset($_GET['ass_id'])) {	
	$ass_id=$_GET['ass_id'];
	$sql1="SELECT * FROM assignment ass, classrooms cr WHERE cr.cr_id = ass.cr_id AND ass.ass_id=$ass_id";
	$result = $conn->query($sql1);
	if ($result->num_rows > 0){
		while($row = $result->fetch_assoc()) {
			$cr_id = $row["cr_id"];
			$cr_name = $row["cr_name"];
			$ass_id = $row["ass_id"];
			$ass_name = $row["ass_name"];
			$ass_desc = $row["ass_desc"];
			$ass_status = $row["ass_status"];
			$ass_date= $row["ass_date"];
			$ass_sub_date= $row["ass_sub_date"];
		}
		$error="Assignment Is Found successfully!";
		$show="display:none;";
		$alert="alert alert-success";
		$vis="show";
	}
	else 
	{
		$error='<b>'.$ass_id.'</b>'." "."Classroom Id Is Not Exist!";
		$show="display:show;";
		$alert="alert alert-danger";
	}
}
if (isset($_POST['sub_marks']))
{
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{ 
		$aa_id=test_input($_POST['txt_aa_id']); 
		$marks=test_input($_POST['marks']); 
		$remark=test_input($_POST['remark']);
		$sql="UPDATE assignment_answer SET marks='$marks', remark='$remark' WHERE aa_id=$aa_id";
		if ($conn->query($sql) === TRUE) {	
			$error="Marks Updated Successfully";
			$show="display:show;";
			$alert="alert alert-success";
		}
		else{
			$error="Process Invalid";
			$show="display:show;";
			$alert="alert alert-danger";
						
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
<head>
  <title>View Answer sheet </title>
  <link rel="shortcut icon" type="image/x-icon" href="./images/favicon.ico" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./resources/bootstrap-3.3.6-dist/css/bootstrap.min.css">
  <script src="./resources/bootstrap-3.3.6-dist/js/jquery.min.js"></script>
  <script src="./resources/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
   <script src="./printreceipt.js"></script>
   <script src="./sss.js"></script>
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
<script type="text/javascript">
function update_mark(aa_id){
	document.getElementById('txt_aa_id').value=aa_id;
	$("#myModal").modal('show');
}
</script>
</head>
<body id="addcutomer">
<?php
include('./header.php');
?>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <h2 align="center" class="page-title remove-top-padding">Assignment Details </h2>
         <div class="row">         
		<div class="col-sm-8 col-md-12 col-lg-12">
            <div class="panel panel-info light-pink">
              <div class="panel-heading action-box">
                <div class="panel-caption">
                  <h3 class="panel-title"> Assignment Details <a style="display:none;" class="pull-right" align="right" href="#" onclick=printbill(); >Print</a></h3>
                </div>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-12 col-lg-12">
                    <h4><?php echo $ass_name." ( ID ". $ass_id." )"; ?></h4>
                    <div class="row">
                      <div class="col-lg-6">
                        <table class="table table-condensed table-user-information">
                          <tbody>
						   <tr>
                              <td class="col-xs-4 col-sm-4">Classroom </td>
                              <td ><span>:</span> <?php echo $cr_name; ?>  </td>
                            </tr>
                            <tr>
                              <td class="col-xs-4 col-sm-4">Assignment Details</td>
                              <td><span>:</span>  <?php echo $ass_desc; ?></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <div class="col-lg-6">
                        <table class="table table-condensed table-user-information">
                          <tbody>
						   
							
							<tr>
                              <td class="col-xs-4 col-sm-4">Assignment Date</td>
                              <td><span>:</span>  <?php echo date('d-m-Y', strtotime($ass_date)); ?></td>
                            </tr>
							<tr>
                              <td class="col-xs-4 col-sm-4">Assignment Submit Date</td>
                              <td><span>:</span>  <?php echo date('d-m-Y', strtotime($ass_sub_date)); ?></td>
                            </tr>                            
                            <tr>
                              <td class="col-xs-4 col-sm-4">Status</td>
                              <?php 
							  if($ass_status==1){echo "<td><span>:</span> Active</td>";}
							   else if ($ass_status==2){echo "<td><span>:</span> Suspended</td>";}						
							   else if ($ass_status==0){echo "<td><span>:</span> Deleted</td>";}						
							   else {echo "<td><span>:</span> None</td>";}
								?>							                                 
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>            
			 </div>
            </div>
				<div class="panel panel-info">
      <div class="panel-heading" align="center">Assignment Submitted Student List <a class="pull-right" align="right" href="#" onclick=printbill(); >Print</a></div>
      <div class="panel-body">
        <div class='table-responsive'>
      <?php
      error_reporting(E_ALL);
      $sql = "SELECT * FROM end_user e, assignment_answer aa WHERE e.euid=aa.euid AND aa.ass_id=$ass_id AND aa.aa_status = 1 ORDER BY e.euname ASC";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        // output data of each row
          echo "<table class='table table-striped'>
          <thead>
            <tr>
              <th>#</th>
              <th>Id</th>
			  <th>Student Name </th>
              <th>Mobile </th>
              <th>Marks </th>
              <th>Remark </th>
			  <th>Answer Sheet</th>
			  <th>Date </th>			 
			  <th>Status </th>			 
			  <th>Update</th>
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
			echo "<td>".$row['marks']."</td>";
			echo "<td>".$row['remark']."</td>";       
			echo "<td><a href='.".$row['ans_path']."' target='self'>View Answer Sheet</a></td>";
			echo "<td>".date( 'd/m/Y', strtotime($row['euregdate']))."</td>";
			if($row['status']==1){echo "<td class='success'>Active</td>";}
			else if ($row['status']==2){echo "<td class='warning'>Pending</td>";}			
			else if($row['status']==3){echo "<td class='danger'>Rejected</td>";}			
			else {echo "<td class='primary'>None</td>";}	
			echo"<td class='text-center'>
			<button type='submit' class='btn btn-success btn-sm' onclick='update_mark(".$row['aa_id'].")' name ='btndel' id='btndel'> <span class='glyphicon glyphicon-pencil'></span> Update</button>
			</td>";
			echo"<td class='text-center'>
			<button type='submit' class='btn btn-default btn-sm' onclick='delete_answer(".$row['aa_id'].")' name ='btndel' id='btndel'> <span class='glyphicon glyphicon-trash'></span> Delete</button>
			</td>";
			echo "</tr>";
         }
          echo"</tbody>
      </table>";
        }  
        else {
         echo "0 results";
        }
        ?> 
      </div>
      </div><!-- Close panel Body -->
</div> <!-- Close Panel -->
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
<!--Footer-->
<?php
include('./footer.php');
?>  
         <div  id="invoice"  style="border:1px solid #ccc; padding:10px; height:100%; width:590pt; display:none;">
		<div style="text-align:left; border:0px solid #ccc; padding-top:20px; float:left; width:70px;">
            <img height="150" width="150" src="./images/logo.png">
        </div>
        <div style="text-align:center; border:0px solid #ccc; padding-top:20px;  float:center; width:100%;">
            <b><?php echo $comp_name; ?></b><br/>
            <small><?php echo $comp_tag_line; ?></small><br/>
			<small><?php echo $comp_add.", ".$comp_mob; ?></small><br/>
        </div>       
         <div Style=" clear:both; float:none;"></div>
         <h4 align="center">Classroom Assignment Answer Details</h4><hr/>
         
		<div style="text-align:center; border:0px solid #ccc; float:left; width:690px;">
          <table style= 'width:100%; font-size:13px;' border-collapse: collapse; cellspacing='3'>
          <tbody>
			<tr>
			  <td width="100" style='text-align:left; font-size:15px; font-style:bold; padding: 0px;'><b>Name:</b></td>
              <td style='text-align:left; font-size:15px; font-style:bold; padding: 0px;'><b><?php echo $cr_name; ?></b></td>
			  <td width="100" style='text-align:left; font-size:15px; font-style:bold; padding: 0px;'><b>Id:</b></td>
			  <td  style='text-align:left; font-size:15px; font-style:bold;  padding: 0px;'> <span>:</span> <b><?php echo $cr_id; ?></b></td>
			</tr>										
          </tbody>
      </table><hr/>
	  <?php
      error_reporting(E_ALL);
      $sql = "SELECT * FROM end_user e, assignment_answer aa WHERE e.euid=aa.euid AND aa.ass_id=$ass_id AND aa.aa_status = 1 ORDER BY e.euname ASC";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        // output data of each row
          echo "<table style= 'margin-top:20px;width:100%; font-size:13px;' border-collapse: collapse; cellspacing='3'>
          <thead>
            <tr>
              <th style='text-align:left; font-size:15px; font-style:bold; padding: 0px;'>#</th>
              <th style='text-align:left; font-size:15px; font-style:bold; padding: 0px;'>Id</th>
			  <th style='text-align:left; font-size:15px; font-style:bold; padding: 0px;'>Student Name </th>
              <th style='text-align:left; font-size:15px; font-style:bold; padding: 0px;'>Mobile </th>
              <th style='text-align:left; font-size:15px; font-style:bold; padding: 0px;'>Marks </th>
              <th style='text-align:left; font-size:15px; font-style:bold; padding: 0px;'>Remark </th>
			  <th style='text-align:left; font-size:15px; font-style:bold; padding: 0px;'>Date </th>			 
			  <th style='text-align:left; font-size:15px; font-style:bold; padding: 0px;'>Status </th>			 
           </tr>
          </thead>
          <tbody>";
		  $count=0;
          while($row = $result->fetch_assoc()) {
			$count++;
			echo"<tr>";
			echo "<td style='text-align:left; font-size:15px; font-style:bold; padding: 0px;'>".$count."</td>";
			echo "<td style='text-align:left; font-size:15px; font-style:bold; padding: 0px;'>".$row['euid']."</td>";
			echo "<td style='text-align:left; font-size:15px; font-style:bold; padding: 0px;'>".$row['euname']."</td>";
			echo "<td style='text-align:left; font-size:15px; font-style:bold; padding: 0px;'>".$row['eumob']."</td>";
			echo "<td style='text-align:left; font-size:15px; font-style:bold; padding: 0px;'>".$row['marks']."</td>";
			echo "<td style='text-align:left; font-size:15px; font-style:bold; padding: 0px;'>".$row['remark']."</td>";       
			echo "<td style='text-align:left; font-size:15px; font-style:bold; padding: 0px;'>".date( 'd/m/Y', strtotime($row['euregdate']))."</td>";
			if($row['status']==1){echo "<td style='text-align:left; font-size:15px; font-style:bold; padding: 0px;'>Active</td>";}
			else if ($row['status']==2){echo "<td style='text-align:left; font-size:15px; font-style:bold; padding: 0px;'>Pending</td>";}			
			else if($row['status']==3){echo "<td style='text-align:left; font-size:15px; font-style:bold; padding: 0px;'>Rejected</td>";}			
			else {echo "<td style='text-align:left; font-size:15px; font-style:bold; padding: 0px;'>None</td>";}	
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
	  <div style="text-align:center; border:0px solid #ccc; padding-top:50px;  float:right; width:150px;">
            <p><?php echo $pro_pra_name; ?><br/> Signature</p>
      </div>
</div> <!--Close Invoice-->
    <div id="myModal" class="modal modal-wide fade" style="width:100%;">
		<div class="modal-dialog modal-default">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title"> Update Marks</h4>
				</div>
				<div class="modal-body">
				    <form enctype="multipart/form-data" action="./view_answer.php?ass_id=<?php echo $ass_id?>" method="POST">
						<input class="form-control" type="hidden" id= "txt_aa_id" name= "txt_aa_id" value="" required />
							<div class="mb-3">
								  <div class="title mb-2"><span>Update Marks</span></div>
								  <input class="form-control" type="text" name= "marks" placeholder="marks" required />
							</div>
							<div class="mb-3">
								  <div class="title mb-2"><span>Add Remark</span></div>
								  <input class="form-control" type="text" name= "remark" placeholder="Remark" required />
							</div>
							<div class="mb-3" style="margin-top:10px;" align="center">
								  <button class="btn btn-sm btn-success" name="sub_marks" type="submit">Submit Marks</button>
							</div>				             
						  
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</body>
</html>