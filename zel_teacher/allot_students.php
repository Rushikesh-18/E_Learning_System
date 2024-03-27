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
if (isset($_GET['cr_id'])) {	
	$cr_id=$_GET['cr_id'];
	$sql1="SELECT * FROM classrooms cr, course c WHERE c.cid = cr.cid AND cr.cr_id=$cr_id";
	$result = $conn->query($sql1);
	if ($result->num_rows > 0){
		while($row = $result->fetch_assoc()) {
			$cr_id = $row["cr_id"];
			$cr_name = $row["cr_name"];
			$cid = $row["cid"];
			$c_name = $row["c_name"];
			$cr_desc = $row["cr_desc"];
			$cr_status = $row["cr_status"];
			$cr_regdate= $row["cr_regdate"];
		}
		$error="Classroom Is Found successfully!";
		$show="display:none;";
		$alert="alert alert-success";
		$vis="show";
	}
	else 
	{
		$error='<b>'.$cr_id.'</b>'." "."Classroom Id Is Not Exist!";
		$show="display:show;";
		$alert="alert alert-danger";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Allot Students to Classroom </title>
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
</head>
<body id="addcutomer">
<?php
include('./header.php');
?>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <h2 align="center" class="page-title remove-top-padding">Classroom Details </h2>
         <div class="row">         
		<div class="col-sm-8 col-md-12 col-lg-12">
            <div class="panel panel-info light-pink">
              <div class="panel-heading action-box">
                <div class="panel-caption">
                  <h3 class="panel-title"> Classroom Details <a style="display:none;" class="pull-right" align="right" href="#" onclick=printbill(); >Print</a></h3>
                </div>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-12 col-lg-12">
                    <h4><?php echo $cr_name." ( ID ". $cr_id." )"; ?></h4>
                    <div class="row">
                      <div class="col-lg-6">
                        <table class="table table-condensed table-user-information">
                          <tbody>
						   <tr>
                              <td class="col-xs-4 col-sm-4">Course </td>
                              <td ><span>:</span> <?php echo $c_name; ?>  </td>
                            </tr>
                            <tr>
                              <td class="col-xs-4 col-sm-4">Classroom Details</td>
                              <td><span>:</span>  <?php echo $cr_desc; ?></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <div class="col-lg-6">
                        <table class="table table-condensed table-user-information">
                          <tbody>
						   
							
							<tr>
                              <td class="col-xs-4 col-sm-4">Register Date</td>
                              <td><span>:</span>  <?php echo date('d-m-Y', strtotime($cr_regdate)); ?></td>
                            </tr>                            
                            <tr>
                              <td class="col-xs-4 col-sm-4">Status</td>
                              <?php 
							  if($cr_status==1){echo "<td><span>:</span> Active</td>";}
							   else if ($cr_status==2){echo "<td><span>:</span> Suspended</td>";}						
							   else if ($cr_status==0){echo "<td><span>:</span> Deleted</td>";}						
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
      <div class="panel-heading" align="center">Allot Students</div>
      <div class="panel-body">
        <div class='table-responsive'>
      <?php
      error_reporting(E_ALL);
      $sql = "SELECT * FROM end_user e, course c WHERE c.cid = e.cid AND e.cid=$cid AND e.status = 1 ORDER BY e.euid ASC";
      //$sql = "SELECT * FROM end_user e, classroom_student cs WHERE e.euid=cs.euid AND cs.cr_id=$cr_id AND cr_st_status = 1 ORDER BY e.euid DESC";
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
			$sqlc = "SELECT * FROM classroom_student WHERE euid=".$row['euid']." AND cr_id=".$cr_id." AND cr_st_status = 1";
			$resultc = $conn->query($sqlc);
			if ($resultc->num_rows > 0) {
			}
			else{
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
				<button type='submit' class='btn btn-success btn-sm' onclick='add_allotment(".$row['euid'].",".$cr_id.")' name ='btndel' id='btndel'> <span class='glyphicon glyphicon-user'></span> Add</button>
				</td>";
				echo "</tr>";
			}
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
            <img src="./images/logo.png">
        </div>
        <div style="text-align:center; border:0px solid #ccc; padding-top:20px;  float:center; width:100%;">
            <b><?php echo $comp_name; ?></b><br/>
            <small><?php echo $comp_tag_line; ?></small><br/>
			<small><?php echo $comp_add.", ".$comp_mob; ?></small><br/>
        </div>       
         <div Style=" clear:both; float:none;"></div>
         <h4 align="center">Classroom Detail Card</h4><hr/>
         
		<div style="text-align:center; border:0px solid #ccc; float:left; width:690px;">
          <table style= 'width:100%; font-size:13px;' border-collapse: collapse; cellspacing='3'>
          <tbody>
			<tr>
              <td colspan="2" style='text-align:left; font-size:15px; font-style:bold; padding: 0px;'><b><?php echo $emp_name; ?></b></td>
			  <td width="100" style='text-align:left; font-size:15px; font-style:bold; padding: 0px;'><b>Classroom Id</b></td>
			  <td  style='text-align:left; font-size:15px; font-style:bold;  padding: 0px;'> <span>:</span> <b><?php echo $cr_id; ?></b></td>
			</tr>
			<tr>
              <td style='text-align:left;  padding: 3px;'>Mobile Number</td>
              <td style='text-align:left;  padding: 3px;'><span>:</span> <?php echo $emp_mob;?></td>
			  <td style='text-align:left;  padding: 3px;'>Password</td>
              <td style='text-align:left;  padding: 3px;'><span>:</span> <?php echo $emp_pass; ?></td>
			  </tr>			
			<tr>
			  <td style='text-align:left;  padding: 3px;'>Alt Mobile</td>
              <td style='text-align:left;  padding: 3px;'><span>:</span> <?php echo $altmob; ?></td>
			  <td style='text-align:left;  padding: 3px;'>Alt Mobile</td>
              <td style='text-align:left;  padding: 3px;'><span>:</span> <?php echo $altmob2; ?></td>
			</tr>
			<tr>
			  <td style='text-align:left;  padding: 3px;'>Email Id</td>
              <td style='text-align:left;  padding: 3px;'><span>:</span> <?php echo $email; ?></td>
			  <td style='text-align:left;  padding: 3px;'>Date Of Birth</td>
              <td style='text-align:left;  padding: 3px;'><span>:</span>  <?php echo date('d-m-Y', strtotime($bdate)); ?></td>
			</tr>
            <tr>
              <td style='text-align:left;  padding: 3px;'>Designation</td>
              <td style='text-align:left;  padding: 3px;'><span>:</span>  <?php echo $emp_desig; ?></td>
			  <td style='text-align:left;  padding: 3px;'>Status</td>
			  <?php 
			   if($estatus==1){echo "<td style='text-align:left;  padding: 3px;'><span>:</span> Active</td>";}
			   else if ($estatus==2){echo "<td style='text-align:left;  padding: 3px;'><span>:</span> Suspended</td>";}						
			   else {echo "<td style='text-align:left;  padding: 3px;'><span>:</span> None</td>";}
			  ?>	
              
            </tr>
            <tr>
              <td style='text-align:left;  padding: 3px;'>Address</td>
              <td style='text-align:left;  padding: 3px;'><span>:</span>  <?php echo $address; ?></td>
			  <td style='text-align:left;  padding: 3px;'>Register Date</td>
              <td style='text-align:left;  padding: 3px;'><span>:</span> <?php echo date('d-m-Y', strtotime($reg_date));?></td>
            </tr>								
          </tbody>
      </table>
	  </div>
	  <div style="text-align:center; border:0px solid #ccc; padding-top:50px;  float:right; width:150px;">
            <p><?php echo $pro_pra_name; ?><br/> Signature</p>
      </div>
</div> <!--Close Invoice-->
</body>
</html>