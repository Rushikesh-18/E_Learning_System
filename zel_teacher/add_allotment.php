<?php 	
//require_once 'core.php';
require_once 'conn.php';
require_once 'lock.php';
$valid['success'] = array('success' => false, 'messages' => array());
$euid = $_POST['euid'];
$cr_id = $_POST['cr_id'];
$today=date('Y-m-d');
if($cr_id) { 
 $sql = "INSERT INTO classroom_student (cr_id, euid, cr_st_status, cr_st_date, uid )VALUES($cr_id, $euid, 1, '$today', $user_id)";
 if($conn->query($sql) === TRUE ) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Removed";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the brand";
 }
 $conn->close();
 echo json_encode($valid);
} // /if $_POST