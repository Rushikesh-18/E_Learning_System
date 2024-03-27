<?php
$login_session="" ;
 $url="";
 $status="";
include('lock.php');
include ("conn.php");
   $uname = "";
   $pass = "";
   $currdate= ""; 
   $status=null;
   $type=null;
  $error="";
  $show="display:none;";
  $alert="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
     $uname = test_input($_POST["txtuname"]);
     $pass = test_input($_POST["inputPassword"]);
     $confpass = test_input($_POST["inputPasswordConfirm"]);
     $status=1;
     $type=1;
     $sql1="SELECT uname FROM user WHERE uname='$uname' and ustatus=1 ";
     $result = $conn->query($sql1);
      if ($result->num_rows > 0){
        $error=$uname." "."User Name Is Already Exist!";
        $show="display:show;";
        $alert="alert alert-danger";
      }
      else 
      {
        if($pass===$confpass)
        {
          $sql = "INSERT INTO user (uname, pass, uregdate, utype, ustatus)
          VALUES ('$uname', '$pass', @now := now(), '$type' , '$status')";
          // use exec() because no results are returned
          if ($conn->query($sql) === TRUE) {
          $error="User Is Addes successfully!";
          $show="display:show;";
          $alert="alert alert-success";
          //header("location:./signup.php");
          }

          else{
          $error="Your signup is invalid";
          $show="display:show;";
          $alert="alert alert-danger";
          }
        }
        else
        {
          $error="Your Password and Confirm Password is Not Match!";
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
  <title>Add Teacher</title>
  <link rel="shortcut icon" type="image/x-icon" href="./images/favicon.ico" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

 <link rel="stylesheet" href="./resources/bootstrap-3.3.6-dist/css/bootstrap.min.css">
  <script src="./resources/bootstrap-3.3.6-dist/js/jquery.min.js"></script>
  <script src="./resources/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>

<script type="text/javascript">
      function confpass(){
      var counter=0;
      var f1 = document.getElementById("inputPassword").value;
      var f2 = document.getElementById("inputPasswordConfirm").value;
      //var r= parseFloat(f1)*parseFloat(f2);
      if(f1==f2)
      {
          document.getElementById("msg").innerHTML="Password Is Match";
          document.getElementById("inputPassword").style.borderColor = "#008000";
          document.getElementById("inputPasswordConfirm").style.borderColor = "#008000";
          
      }
      else
      {
        document.getElementById("msg").innerHTML="Password Is Not Match";
        document.getElementById("inputPassword").style.borderColor = "#E34234";
        document.getElementById("inputPasswordConfirm").style.borderColor = "#E34234";
      
      }
   }
  </script>
<script src="./activemenu.js"></script>

</head>
<body>
<?php
include('./header.php');
?>


<div class="container" style="margin-top:20px">
<div class="row">

  <div class = "col-md-4">
<!--<div class="alert alert-success alert-sm" role="alert" id="signalert" style="display:show;">Well done! You successfully Signup!</div> -->
<div class="panel panel-info">
      <div class="panel-heading" align="center">Create Teacher Account</div>
      <div class="panel-body">

 <form data-toggle="validator" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <div class="form-group">
    <input class="form-control" type="text" id="txtuname" name= "txtuname" placeholder="User Name" required>
  </div>
  
  <div class="form-group">
   <input type="password" data-minlength="6" class="form-control" id="inputPassword" name="inputPassword" placeholder="Password" required>
    
  </div>
  <div class="form-group">
   <input type="password" class="form-control" onkeyup="confpass();" id="inputPasswordConfirm" name= "inputPasswordConfirm" data-match="#inputPassword" data-match-error="Whoops, these don't match" placeholder="Confirm Password" required>
      <div class="help-block with-errors"></div>
  </div>
 <h5 ng-show="val2" id="msg">  </h5>

  <div class="form-group" align="center">
    <button type="submit" class="btn btn-info" name="submit">Add Teacher</button>
  </div>

</form>
<div class="<?php echo $alert; ?>" role="alert" style="<?php echo $show; ?>"><?php echo $error; ?></div>



</div> <!-- Close panel Body -->

</div> <!-- Close Panel -->

</div> <!-- Close Col -->

<div class="col-md-8">
<div class="panel panel-info">
      <div class="panel-heading" align="center">Teacher Details</div>
      <div class="panel-body">
        <div class='table-responsive'>
      <?php
      //include('conn.php');
      $sql = "SELECT uid, uname, uregdate FROM user WHERE ustatus=1";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        // output data of each row
       
          echo "<table class='table table-striped'>
          <thead>
            <tr>
              <th>Id</th>
              <th>Name </th>
              <th>Registration Date</th>
           </tr>
          </thead>


          <tbody>";
          while($row = $result->fetch_assoc()) {
           echo"<tr>";
             
              echo"<td>".$row['uid']."</td>";
              echo "<td>".$row['uname']."</td>";
              echo"<td>".date( 'd/m/Y g:i:s', strtotime($row['uregdate']))."</td>";
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
include('./footer.php');
?>
</body>
</html>