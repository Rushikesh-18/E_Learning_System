<?php
require_once('./mail/class.phpmailer.php');
require_once('./mail/class.smtp.php');
require_once('./zel_admin/conn.php');
require_once('./sms.php');
if (isset($_GET['sender'])) {
  $sender=$_GET['sender'];
  $task=$_GET['task'];
}
else{
	$sender="contact";
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["name"]);
    $mob = test_input($_POST["mob"]);
    $pass = "Aura@2020";
    $altmob = test_input($_POST["altmob"]);
	$address = test_input($_POST["address"]);
	$location = test_input($_POST["location"]);
	$map_location = test_input($_POST["maplocation"]);
	$rent_owner = test_input($_POST["rent_owner"]);
	$area = test_input($_POST["area"]);
	$partner_owner = test_input($_POST["partner_owner"]);
    $adminemail="zelosinfotech@gmail.com";
	if($task=="contact"){
		$subject="Contact / feedback Received From Website auracakes.com.";
		$body="<b>Online Enquiry Received From: </b> <br/>  <b>".$name."</b> <br/> email Id:<b>  ".$cmail." </b><br/> Mobile: <b>".$mob." </b><br/>Subject: <b>".$csubject." </b><br/> Message: <b>".$msg."</b><br/><br/>Thank You.";
	}
	else if($task=="callback"){
		$subject="Call Back Request Received From Website auracakes.com.";
		$body="<b>Online Call Back Request Received From: </b> <br/> Mobile: <b>".$mob." </b><br/>Thank You.";
	}
	else if($task=="newslatter"){
		$subject="News Letter Request Received From Website auracakes.com.";
		$body="<b>Online News Letter Request Received From: </b> <br/> Email: <b>".$cmail." </b><br/>Thank You.";
	}
	else if($task=="Franchise"){
		$sql1="SELECT mob FROM franchise WHERE mob='$mob' and fr_status!=0 ";
		$result = $conn->query($sql1);
		if ($result->num_rows > 0){
			$error="You are already Requested!";
			$show="display:show;";
			$alert="alert alert-danger";
			header("Location:./".$sender.".php?alert=$alert&show=$show&error=$error");
			exit();
		}
		else
        {
          $sql = "INSERT INTO franchise (name, address, mob, pass, altmob, shop_location, map_location, rent_owner, shop_area, partner_owner, fr_status, regdate)
          VALUES ('$name', '$address','$mob', '$pass', '$altmob','$location','$map_location','$rent_owner','$area','$partner_owner',2, @now := now())";
          if ($conn->query($sql) === TRUE) {
			$message="Hi, ".$name."! Your Franchise request is Received and under Review Process on AuraCakes.com. Your User Name: ".$mob." and password:".$pass." Thank You.";
			$mobile_number=$mob;
			$message1= sms_unicode($message);
			sentsms($message1, $mobile_number);
			//SMS to Admin
			$message="New Franchise Request is Received from ".$name." on AuraCakes.com. User Name: ".$mob." and password:".$pass." Thank You.";
			$mobile_number="7506192211";
			$message1= sms_unicode($message);
			sentsms($message1, $mobile_number);

          }

          else{
			$error="Something Gone Wrong! Try Again after Some Time!";
			$show="display:show;";
			$alert="alert alert-danger";
			header("Location:./".$sender.".php?alert=$alert&show=$show&error=$error");
			exit();
          }
        }
		$subject="Franchise Application Received from auracakes.com.";
		$body="<b>Online Franchise Application Received From: </b> <br/>  <b>".$name."</b> <br/> Address:<b>  ".$address." </b><br/> Mobile: <b>".$mob." </b><br/>Location: <b>".$location." </b><br/> Shop On: <b>".$rent_owner."</b><br/>Business In: <b>".$partner_owner."</b><br/>Area In Squere Feet: <b>".$area."</b><br/><br/>Thank You.";
	}
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPDebug = 1;
    $mail->Host = 'smtp.hostinger.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->Username = 'contact@auracakes.com';
    $mail->Password = 'Auracakes@121$';
    $mail->setFrom('contact@auracakes.com', 'Contact Auracakes');
    $mail->addReplyTo('jaisadgurufoods@gmail.com', 'Jai Sadguru');
    $mail->addAddress($adminemail, 'Jai Sadguru');
    $mail->Subject = $subject;
    $mail->msgHTML($body);
    //$mail->msgHTML(file_get_contents('message.html'), __DIR__);
    $mail->Body = $body;
    //$mail->addAttachment('test.txt');
    if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        $error="We ahve received your Franchise request! Your Process is under Review. Thank You.";
		$show="display:show;";
		$alert="alert alert-success";
		header("Location:./".$sender.".php?alert=$alert&show=$show&error=$error");
    }
}
 function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>