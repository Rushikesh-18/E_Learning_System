<?php
function sms_unicode($message){
	$hex1="";
	if (function_exists('iconv')){
	$latin=@iconv('UTF-8','ISO-8859-1',$message);
	if (strcmp($latin,$message)){
	$arr=unpack('hex',@iconv('UTF-8','UCS-2BE','$message'));
	$hex1=stroupper($arr['hex']);
	}
	if ($hex1==""){
	$hex2="";
	$hex="";
	for($i=0;$i<strlen($message);$i++){
	$hex=dechex(ord($message[$i]));
	$len=strlen($hex);
	$add=4 - $len;
	if($len<4){
	for($j=0;$j<$add;$j++){
	$hex="0".$hex;
	}
	}
	$hex2.=$hex;
	}
	return $hex2;
	}
	else{
	return $hex1;
	}
	}
	else{
	print'iconv Function Not Exist !';
	}
}

function sentsms($message1, $mob, $temp_id){
$username="zel-megavisionn"; //My username
$password="Mega"; // My Password
$sender="MEGAVN"; //ex:INVITE
$entityid="1201161684141837746";
$temid=$temp_id;
$mobile_number=$mob;
$data="username=".$username."&password=".$password."&type=0&dlr=1&destination=".$mobile_number."&source=".$sender."&message=".$message1."&entityid=".$entityid."&tempid=".$temid;
$url="http://103.16.101.52/sendsms/bulksms?";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$curl_scraped_page = curl_exec($ch);
curl_close($ch);
}	
?>