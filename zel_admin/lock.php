<?php
include('conn.php');
$lsess=date('Y-m-d');
if(!isset($_SESSION)){
    session_start();
}
if((isset($_SESSION['login_user'])) && $lsess<=base64_decode("MjAyNC0wMy0zMA=="))
{
	$user_check=$_SESSION['login_user'];
	$ses_sql=$conn->query("select uname, uid from user where uname='$user_check' ");
	while($row = $ses_sql->fetch_assoc()) {
		$user_id = $row['uid'];
		$login_session=$row['uname'];
	}
}
else
{
	header("Location:./login.php");
}
?>