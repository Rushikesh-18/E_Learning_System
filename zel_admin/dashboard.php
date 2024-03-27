<?php
$login_session="" ;
 $url="";
 $status="";
 include('lock.php');
?>
<?php 
$today=date("Y-m-d");
$remcreditamt=0;
//count participant user
$sql = "SELECT * FROM end_user WHERE status = 1";
$query = $conn->query($sql);
$countstudents = $query->num_rows;
//count participant user
$sql = "SELECT * FROM course WHERE status = 1";
$query = $conn->query($sql);
$countcourses = $query->num_rows;
//Colunt end user
$sql = "SELECT * FROM classrooms WHERE cr_status=1";
$query = $conn->query($sql);
$countclassrooms = $query->num_rows;
//Colunt total photos
$sql = "SELECT * FROM assignment WHERE ass_status=1";
$query = $conn->query($sql);
$countassignment = $query->num_rows;
//count todays compliants
$sql = "SELECT * FROM meet WHERE meet_status=1 AND meet_date='$today'";
$query = $conn->query($sql);
$todaysmeets = $query->num_rows;
//count todays compliants
$sql = "SELECT * FROM assignment WHERE ass_status=1 AND ass_date='$today'";
$query = $conn->query($sql);
$todaysassignments = $query->num_rows;
//count todays compliants
$sql = "SELECT * FROM classrooms WHERE cr_status=1 AND cr_regdate='$today'";
$query = $conn->query($sql);
$todaysclassrooms = $query->num_rows;
//count todays customers
$sql = "SELECT * FROM end_user WHERE status=1 AND euregdate='$today'";
$query = $conn->query($sql);
$todaysstudents = $query->num_rows;
$conn->close();

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>E-Learning Management System | Dashboard</title>
  <link rel="shortcut icon" type="image/x-icon" href="./images/favicon.ico" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="./resources/bootstrap-3.3.6-dist/css/bootstrap.min.css">
  <script src="./resources/bootstrap-3.3.6-dist/js/jquery.min.js"></script>
  <script src="./resources/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
   <script src="./activemenu.js"></script>
<!-- fullCalendar 2.2.5 -->
<script src="./stock/assests/plugins/moment/moment.min.js"></script>
<script src="./stock/assests/plugins/fullcalendar/fullcalendar.min.js"></script>
<script type="text/javascript">
	$(function () {
			// top bar active
	$('#navDashboard').addClass('active');

      //Date for the calendar events (dummy data)
      var date = new Date();
      var d = date.getDate(),
      m = date.getMonth(),
      y = date.getFullYear();

      $('#calendar').fullCalendar({
        header: {
          left: '',
          center: 'title'
        },
        buttonText: {
          today: 'today',
          month: 'month'          
        }        
      });


    });
</script>

<style type="text/css">
	.ui-datepicker-calendar {
		display: none;
	}
	.card{
	width: 100%;
	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
	text-align: center;
	}
	.cardHeader{
		background-color: #4CAF50;
		color: white; 
		padding: 10px; 
		font-size: 40px;
	}
	.cardContainer{
		padding: 10px;
	}
		
</style>

<!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="./stock/assests/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="./stock/assests/plugins/fullcalendar/fullcalendar.print.css" media="print">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body id="dashboard">
<?php
include('./header.php');
?>

 <div class="container" style="margin-top: 10px">
<div class="row">
	
	<div class="col-md-3">
		<div class="panel panel-success">
			<div class="panel-heading">
				
				<a href="customer_list.php" style="text-decoration:none;color:black;">
					Total Students
					<span class="badge pull pull-right"><?php echo $countstudents; ?></span>	
				</a>
				
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
	</div> <!--/col-md-4-->
		<div class="col-md-3">
			<div class="panel panel-info">
			<div class="panel-heading">
				<a href="./employee_list.php" style="text-decoration:none;color:black;">
					Total Classrooms
					<span class="badge pull pull-right"><?php echo $countclassrooms; ?></span>
				</a>
					
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
		</div> <!--/col-md-4-->
	<div class="col-md-3">
		<div class="panel panel-danger">
			<div class="panel-heading">
				<a href="compliants_list.php" style="text-decoration:none;color:black;">
					Total Assignments
					<span class="badge pull pull-right"><?php echo $countassignment; ?></span>	
				</a>
				
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
	</div> <!--/col-md-4-->
	<div class="col-md-3">
		<div class="panel panel-success">
			<div class="panel-heading">
				
				<a href="add_category.php" style="text-decoration:none;color:black;">
					Total Courses
					<span class="badge pull pull-right"><?php echo $countcourses; ?></span>	
				</a>
				
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
	</div> <!--/col-md-4-->

	<div class="col-md-8">
		<div class="panel panel-default">
			<div class="panel-heading"> <i class="glyphicon glyphicon-calendar"></i> E-Learning Management System</div>
			<div class="panel-body">
				<img src="images/dashboard.png" class="img-responsive"/>				
			</div>	
		</div>
		
	</div>
	
		<div class="col-md-4">
		<div class="card">
		  <div class="cardHeader" >
		    <h1><?php if($todaysstudents) {
		    	echo $todaysstudents;
				
		    	} else {
		    		echo '0';
		    		} ?></h1>
		  </div>

		  <div class="cardContainer">
		    Today's Enrolled Students
		  </div>
		</div> 
		<br/>

		<div class="card">
		  <div class="cardHeader" style="background-color:#b13f79;">
		    <h1><?php if($todaysmeets) {
		    	echo $todaysmeets;
				
		    	} else {
		    		echo '0';
		    		} ?></h1>
		  </div>

		  <div class="cardContainer">
		    <p> Today's Meets</p>
		  </div>
		</div> 
		<br/>
		<div class="card">
		  <div class="cardHeader" style="background-color:#245580;">
		    <h1><?php if($todaysassignments) {
		    	echo $todaysassignments;
				
		    	} else {
		    		echo '0';
		    		} ?></h1>
		  </div>

		  <div class="cardContainer">
		    <p> Today's Assignments</p>
		  </div>
		</div> 
		<br/>
		
		<div class="card">
		  <div class="cardHeader" style="background-color:#623b65;">
		    <h1><?php if($todaysclassrooms) {
		    	echo $todaysclassrooms;
		    	} else {
		    		echo '0';
		    		} ?></h1>
		  </div>

		  <div class="cardContainer">
		    <p> Today's classrooms</p>
		  </div>
		</div>

	</div>

	
</div> <!--/row-->

</div> <!-- Close Container -->

<?php
include('./footer.php');
?>
</body>
</html>