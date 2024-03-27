<?php
session_start();

if(isset($_COOKIE["member_login"]))   
{  
 setcookie ("member_login","");  
}  
if(isset($_COOKIE["member_password"]))   
{  
 setcookie ("member_password","");  
}  
if(session_destroy())
{
header("Location:./login.php");
}
?>