<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"> Teacher Panel </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="./dashboard.php">Home<span class="sr-only">(current)</span></a></li>
		<!--<li class="dropdown">
			<a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Master<span class="caret"></span></a>
			<ul class="dropdown-menu">
		    <li><a href="./add_course.php">Add Course</a></li>		   		    		   
			</ul>
		</li>-->
		<li class="dropdown">
			<a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Student Master<span class="caret"></span></a>
			<ul class="dropdown-menu">
		    <li><a href="./student_list.php">Student List</a></li>
			</ul>
		</li>
		<li class="dropdown">
			<a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Classroom Master<span class="caret"></span></a>
			<ul class="dropdown-menu">
		    <li><a href="./add_classroom.php">Add Classroom</a></li>
		    <li><a href="./classroom_list.php">Classroom List</a></li>				
			</ul>
		</li>
		<li class="dropdown">
			<a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Assignment Master<span class="caret"></span></a>
			<ul class="dropdown-menu">
		    <li><a href="./add_assignment.php">Add Assignment</a></li>
		    <li><a href="./assignments_list.php">Assignment List</a></li>				
			</ul>
		</li>
		<li class="dropdown">
			<a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Meets Master<span class="caret"></span></a>
			<ul class="dropdown-menu">
		    <li><a href="./add_meet.php">Add Meets</a></li>
		    <li><a href="./meets_list.php">Meets List</a></li>				
			</ul>
		</li>		
		<!--<li><a href="./comp_profile.php">Company Profile</a></li>-->   		
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
       
        <li class="dropdown">
          <?php if($login_session)  
        {   
            $status="Welcome ".$login_session; 
            $url="./logout.php";
            $status1="Logout";  
        }
        else
        { 
            $status="Welcome Guest"; 
            $url="./login.php";
            $status1="Login"; 
         }
          ?>
          <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $status; ?><span class="caret"></span></a>
          <ul class="dropdown-menu">
		  
           <li><a href="./changepass.php">Change Password</a></li>
		    <li role="separator" class="divider"></li>
            <!--<li><a href="./signup.php">Add User</a></li>
            <li role="separator" class="divider"></li>-->
			
           
            <li><a href="<?php echo  $url; ?>"><?php echo $status1; ?></a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>