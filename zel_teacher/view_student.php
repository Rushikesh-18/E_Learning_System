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
		$altmob = $row["altmob"];
		$address = $row["address"];
		$gender = $row["gender"];
		$email = $row["email"];
		$bdate = $row["bdate"];
		$cid = $row["cid"];
		$cstatus = $row["status"];
		$euregdate= $row["euregdate"];
	}
	$error="Customer Is Found successfully!";
	$show="display:none;";
	$alert="alert alert-success";
	$vis="show";
}
else 
{
	$error='<b>'.$euid.'</b>'." "."Customer Id Is Not Exist!";
	$show="display:show;";
	$alert="alert alert-danger";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>View Student </title>
  <link rel="shortcut icon" type="image/x-icon" href="./images/favicon.ico" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./resources/bootstrap-3.3.6-dist/css/bootstrap.min.css">
  <script src="./resources/bootstrap-3.3.6-dist/js/jquery.min.js"></script>
  <script src="./resources/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
   <script src="./printreceipt.js"></script>
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
        <h2 align="center" class="page-title remove-top-padding">Student Details </h2>
         <div class="row">         
		<div class="col-sm-8 col-md-12 col-lg-12">
            <div class="panel panel-info light-pink">
              <div class="panel-heading action-box">
                <div class="panel-caption">
                  <h3 class="panel-title"> Student Details <a class="pull-right" align="right" href="#" onclick=printbill(); >Print</a></h3>
                </div>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-12 col-lg-12">
                    <h4><?php echo $euname." ( ID ". $euid." )"; ?></h4>
                    <div class="row">
                      <div class="col-lg-6">
                        <table class="table table-condensed table-user-information">
                          <tbody>
						    <tr>
                              <td class="col-xs-4 col-sm-4">Mobile</td>
                              <td><span>:</span>  <?php echo $eumob; ?></td>
                            </tr>
							<tr>
                              <td class="col-xs-4 col-sm-4">Password</td>
                              <td><span>:</span>  <?php echo $eupass; ?></td>
                            </tr>
							<tr>
                              <td class="col-xs-4 col-sm-4">Alt Mobile</td>
                              <td><span>:</span>  <?php echo $altmob; ?></td>
                            </tr>	
							<tr>
                              <td class="col-xs-4 col-sm-4">Email Id </td>
                              <td ><span>:</span> <?php echo $email; ?>  </td>
                            </tr>                            
                            <tr>
                              <td class="col-xs-4 col-sm-4">Address Details</td>
                              <td><span>:</span>  <?php echo $address; ?></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <div class="col-lg-6">
                        <table class="table table-condensed table-user-information">
                          <tbody>
						    <tr>
                              <td class="col-xs-4 col-sm-4">Gender</td>
                              <td><span>:</span>  <?php echo $gender; ?></td>
                            </tr>
							<tr>
                              <td class="col-xs-4 col-sm-4">Course</td>
                              <td><span>:</span>  <?php echo $cid; ?></td>
                            </tr>
							<tr>
                              <td class="col-xs-4 col-sm-4">Date of Birth </td>
                              <td ><span>:</span> <?php echo date('d-m-Y', strtotime($bdate)); ?>  </td>
                            </tr>
							<tr>
                              <td class="col-xs-4 col-sm-4">Register Date</td>
                              <td><span>:</span>  <?php echo date('d-m-Y', strtotime($euregdate)); ?></td>
                            </tr>                            
                            <tr>
                              <td class="col-xs-4 col-sm-4">Status</td>
                              <?php 
							  if($cstatus==1){echo "<td><span>:</span> Active</td>";}
							   else if ($cstatus==2){echo "<td><span>:</span> Pending</td>";}			
							   else if($cstatus==3){echo "<td><span>:</span> Rejected</td>";}			
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
            <img src="./images/logo.png" height="80">
        </div>
        <div style="text-align:center; border:0px solid #ccc; padding-top:20px;  float:center; width:100%;">
            <b><?php echo $comp_name; ?></b><br/>
            <small><?php echo $comp_tag_line; ?></small><br/>
			<small><?php echo $comp_add.", ".$comp_mob; ?></small><br/>
        </div>       
         <div Style=" clear:both; float:none;"></div>
         <h4 align="center">Student Detail Card</h4><hr/>
         
		<div style="text-align:center; border:0px solid #ccc; float:left; width:690px;">
          <table style= 'width:100%; font-size:13px;' border-collapse: collapse; cellspacing='3'>
          <tbody>
			<tr>
              <td colspan="2" style='text-align:left; font-size:15px; font-style:bold; padding: 0px;'><b><?php echo $euname; ?></b></td>
			  <td width="100" style='text-align:left; font-size:15px; font-style:bold; padding: 0px;'><b>Student Id</b></td>
			  <td  style='text-align:left; font-size:15px; font-style:bold;  padding: 0px;'> <span>:</span> <b><?php echo $euid; ?></b></td>
			</tr>
			<tr>
              <td style='text-align:left;  padding: 3px;'>Mobile Number</td>
              <td style='text-align:left;  padding: 3px;'><span>:</span> <?php echo $eumob;?></td>
			  <td style='text-align:left;  padding: 3px;'>Password</td>
              <td style='text-align:left;  padding: 3px;'><span>:</span> <?php echo $eupass; ?></td>
			  </tr>			
			<tr>
			  <td style='text-align:left;  padding: 3px;'>Alt Mobile</td>
              <td style='text-align:left;  padding: 3px;'><span>:</span> <?php echo $altmob; ?></td>
			  <td style='text-align:left;  padding: 3px;'>Gender</td>
              <td style='text-align:left;  padding: 3px;'><span>:</span> <?php echo $gender; ?></td>
			</tr>
			<tr>
			  <td style='text-align:left;  padding: 3px;'>Email Id</td>
              <td style='text-align:left;  padding: 3px;'><span>:</span> <?php echo $email; ?></td>
			  <td style='text-align:left;  padding: 3px;'>Date Of Birth</td>
              <td style='text-align:left;  padding: 3px;'><span>:</span>  <?php echo date('d-m-Y', strtotime($bdate)); ?></td>
			</tr>
            <tr>
              <td style='text-align:left;  padding: 3px;'>Course ID</td>
              <td style='text-align:left;  padding: 3px;'><span>:</span>  <?php echo $cid; ?></td>
			  <td style='text-align:left;  padding: 3px;'>Status</td>
			  <?php 
			   if($cstatus==1){echo "<td style='text-align:left;  padding: 3px;'><span>:</span> Active</td>";}
			   else if ($cstatus==2){echo "<td style='text-align:left;  padding: 3px;'><span>:</span> Pending</td>";}			
			   else if($cstatus==3){echo "<td style='text-align:left;  padding: 3px;'><span>:</span> Rejected</td>";}			
			   else {echo "<td style='text-align:left;  padding: 3px;'><span>:</span> None</td>";}
			  ?>	
              
            </tr>
            <tr>
              <td style='text-align:left;  padding: 3px;'>Address</td>
              <td style='text-align:left;  padding: 3px;'><span>:</span>  <?php echo $address; ?></td>
			  <td style='text-align:left;  padding: 3px;'>Register Date</td>
              <td style='text-align:left;  padding: 3px;'><span>:</span> <?php echo date('d-m-Y', strtotime($euregdate));?></td>
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