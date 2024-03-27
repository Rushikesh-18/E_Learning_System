<?php ob_start(); ?>

<?php
$login_session="" ;
 $url="";
 $status="";
 include('lock.php');

?>

<?php
include ("conn.php");
$error="";
$show="display:none;";
$alert="";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
// username and password sent from form 

$currpass=addslashes($_POST['currpass']);
$newpass=addslashes($_POST['inputPassword']); 
$confpass=addslashes($_POST['inputPasswordConfirm']); 
$uid=$user_id;

if($newpass===$confpass)
{
  $sql="SELECT pass FROM user WHERE pass='$currpass' and uid='$uid' and ustatus=1";
 $result = $conn->query($sql);
  if ($result->num_rows > 0){
    $sqlupdate = "UPDATE user SET pass='$newpass' WHERE pass='$currpass' and uid='$uid' and ustatus=1";
        // use exec() because no results are returned
        if ($conn->query($sqlupdate) === TRUE) {
          header("Location:./logout.php");
          die();
        $error="Your New Password is Change Successfully!";
        $show="display:show;";
        $alert="alert alert-success";
        }
  }
  else
  {
    $error="Your Current Password is Worng!";
    $show="display:show;";
    $alert="alert alert-danger";
  }

  
}
else
{
  $error="Your New Password and Confirm Password is Not Match!";
  $show="display:show;";
  $alert="alert alert-danger";
}
}
?>

<?php ob_end_flush(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title> Change Password User Account  </title>
  <link rel="shortcut icon" type="image/x-icon" href="./images/favicon.ico" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="description" content=" Diamond Petroleum Nirgudsar, Zelos Infotech Pvt . Ltd." />

<meta name="keywords" content="Diamond Petroleum Nirgudsar, Zelos Infotech Pvt . Ltd." />


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
  

<div class="container" style="margin-top: 70px">
<div class="row">

<div class="col-md-4">
  <!--<img src="./images/diamond.jpg" class="img-responsive"/>-->
 
</div>


  <div class = "col-md-4">

<div class="panel panel-info">
      <div class="panel-heading" align="center">Change Password</div>
      <div class="panel-body">

 <form data-toggle="validator" role="form" method ="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
 
  <div class="form-group">
     <input class="form-control" type="password" id="currpass" name= "currpass" placeholder="Current Password" required>
    <div class="help-block with-errors"></div>
  </div>
   <div class="form-group">
   <input type="password" data-minlength="6" class="form-control" id="inputPassword" name="inputPassword" placeholder="New Password" required>
    
  </div>
  <div class="form-group">
   <input type="password" class="form-control" onkeyup="confpass();" id="inputPasswordConfirm" name= "inputPasswordConfirm" data-match="#inputPassword" data-match-error="Whoops, these don't match" placeholder="Confirm Password" required>
      <div class="help-block with-errors"></div>
  </div>
 <h5 ng-show="val2" id="msg">  </h5>
 
  

  <div class="form-group" align="center">
    <button type="submit" class="btn btn-info">Change Password</button>
  </div>

</form>
<p> If You Forgot Password? Or Not Account created?  So Please Contact Your Administrative Person.</p>
<!--<div style="font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>-->
<div class="<?php echo $alert; ?>" role="alert" style="<?php echo $show; ?>"><?php echo $error; ?></div>
</div> <!-- Close panel Body -->

</div> <!-- Close Panel -->

</div> <!-- Close Col -->

<div class="col-md-4">
 
</div>


</div> <!-- Close Row -->


</div> <!-- Close Container -->

<?php
include('./footer.php');
?>

</body>
</html>