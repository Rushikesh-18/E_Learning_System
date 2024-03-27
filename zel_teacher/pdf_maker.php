<?PHP
include('lock.php');
include('conn.php');
include_once('TCPDF-main/tcpdf.php');
//include_once('TCPDF-main/include/tcpdf_fonts.php');
require_once('./mail/class.phpmailer.php');
require_once('./mail/class.smtp.php');
if (isset($_GET['comp_id'])) {	
$comp_id=$_GET['comp_id'];
$sql1 = "SELECT c.comp_id, cat.cat_name, e.euid, e.euname, e.email, e.eumob, e.altmob, e.address, e.eutype, c.priority, c.comp_desc, c.charg_amt, c.paid_amt, c.comp_regdate, c.comp_closedate, c.comp_status FROM compliants c, end_user e, category cat, employee emp WHERE emp.emp_id=c.emp_id AND e.euid=c.euid AND cat.cid=c.cid AND c.comp_id=$comp_id";
$result = $conn->query($sql1);
if ($result->num_rows > 0){
	while($row = $result->fetch_assoc()) {
		$comp_id = $row["comp_id"];		
		$cat_name = $row["cat_name"];
		$euid = $row["euid"];		
		$euname = $row["euname"];
		$email = $row["email"];
		$emails = explode (",", $email);		
		$eumob = $row["eumob"];
		$altmob = $row["altmob"];
		$address = $row["address"];
		$eutype = $row["eutype"];
		$priority = $row["priority"];
		$comp_desc = $row["comp_desc"];
		$comp_desc=preg_replace("#\[sp\]#", "&nbsp;", $comp_desc);
		$comp_desc=preg_replace("#\[nl\]#", "<br>\n", $comp_desc);
		$charg_amt = $row["charg_amt"];
		$paid_amt = $row["paid_amt"];
		$comp_closedate = date('d-m-Y', strtotime($row["comp_closedate"]));
		$comp_status = $row["comp_status"];
		$comp_regdate= date('d-m-Y', strtotime($row["comp_regdate"]));	
	}
}
else 
{
	$error='<b>'.$comp_id.'</b>'." "."Compliant Id Is Not Exist!";
	header('Location:./compliants_list.php');
}
}
else{
	header('Location:./compliants_list.php');
}
	//----- Code for generate pdf
	$pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$pdf->SetCreator(PDF_CREATOR);  
	//$pdf->SetTitle("Export HTML Table data to PDF using TCPDF in PHP");  
	$pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
	$pdf->SetDefaultMonospacedFont('tirodevanagarimarathi');  
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
	$pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);  
	$pdf->setPrintHeader(false);  
	$pdf->setPrintFooter(false);  
	$pdf->SetAutoPageBreak(TRUE, 10); 
	//$pdf->addfont(dirname(__FILE__).'/TCPDF-main/fonts/arial-unicode-ms.ttf', 'TrueTypeUnicode', '', 32);	
	$pdf->SetFont('tirodevanagarimarathi', '', 14, '', true);  
	//$pdf->setFont($font_family='tirodevanagarimarathi',$font_variant='',$font_size=10);
	$pdf->AddPage(); //default A4
	//$pdf->AddPage('P','A5'); //when you require custome page size 	
	$content ="<p> कॅशियर  व  मॅनेजर  इमर्जन्सी  अलार्म  बंद  आहे,तिजोरी  अलार्म  सेन्सर  बंद  आहे </p>"; 
	//$content = content($comp_id); 
	$pdf->writeHTML($content, true, false, true, false, '');
	$file_location = dirname(__FILE__).'/uploads/'; //add your full path of your server
	//$file_location = "C:/xampp/htdocs/test/generate_pdf/uploads/"; //for local xampp server
	$datetime=date('dmY_hms');
	$file_name = $comp_id."_".$datetime.".pdf";
	
	//$pdf->Output(dirname(__FILE__).'/uploads/'.$file_name.'.pdf', 'F');
	//echo "Upload successfully!!";
	ob_end_clean();
	if($_GET['ACTION']=='VIEW') 
	{
		$pdf->Output($file_name, 'I'); // I means Inline view
	} 
	else if($_GET['ACTION']=='DOWNLOAD')
	{
		$pdf->Output($file_name, 'D'); // D means download
	}
	else if($_GET['ACTION']=='UPLOAD')
	{
	$pdf->Output($file_location.$file_name, 'F'); // F means upload PDF file on some folder
	//$pdf->Output(dirname(__FILE__).'/uploads/'.$file_name.'.pdf', 'F');
	echo "Upload successfully!!";
	}
	else if($_GET['ACTION']=='EMAIL')
	{
	$pdf->Output($file_location.$file_name, 'F'); // F means upload PDF file on some folder
	//Email Code
	$subject="Megavision complaint id ".$comp_id." Job Card!";
	$body="Hi <b>".$euname."</b>, <br/> your Maintenance/Job card.<br/> Complaint id ".$comp_id." has been sent by  Megavision technical team! Please see the attached file. <br/><br/><br/><br/><b>Thank and Regards<br/>
	Megavision Technologies,<br/>
	Complaint Management System<br/>
	Technical Support<br/>
	7387474411<br/>
	7387471144<br/>
	Whatsapp No: 7506192211<br/></b>";
	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->SMTPDebug = 0;
	$mail->Host = 'smtp.hostinger.com';
	$mail->Port = 587;
	$mail->SMTPAuth = true;
	$mail->Username = 'contact@megavision.org.in';
	$mail->Password = 'Megavision@121$';
	$mail->setFrom('contact@megavision.org.in', 'Contact Megavision');
	$mail->addReplyTo('megavision.pune@gmail.com', 'Megavision Pune');
	$mail->AddCC('megavision.pune@gmail.com', 'Megavision Pune');			
	$mail->Subject = $subject;
	$mail->AddAttachment($file_location.$file_name);
	$mail->msgHTML($body);
	$mail->Body = $body;	
	foreach($emails as $val){
		$mail->addAddress($val, $euname);			
		if (!$mail->send()) {
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		}
	}
	unlink($file_location.$file_name);
	echo "Email Sent successfully!!";
	}
			
function content($comp_id){
include('./conn.php');
//include('./lock.php');
$today=date('d-m-Y');
$content_data="";
$sql1 = "SELECT c.comp_id, cat.cat_name, emp.emp_name, emp.emp_mob, e.euid, e.euname, e.email, e.eumob, e.altmob, e.address, e.eutype, c.priority, c.summary, c.comp_desc, c.charg_amt, c.paid_amt, c.comp_regdate, c.comp_closedate, c.comp_status FROM compliants c, end_user e, category cat, employee emp WHERE emp.emp_id=c.emp_id AND e.euid=c.euid AND cat.cid=c.cid AND c.comp_id=$comp_id";
$result = $conn->query($sql1);
if ($result->num_rows > 0){
	while($row = $result->fetch_assoc()) {
		$comp_id = $row["comp_id"];		
		$cat_name = $row["cat_name"];
		$euid = $row["euid"];		
		$euname = $row["euname"];		
		$email = $row["email"];
		$eumob = $row["eumob"];
		$altmob = $row["altmob"];
		$address = $row["address"];
		$eutype = $row["eutype"];
		$emp_name = $row["emp_name"];
		$emp_mob = $row["emp_mob"];
		$priority = $row["priority"];
		$summary = $row["summary"];
		$comp_desc = $row["comp_desc"];
		$comp_desc=preg_replace("#\[sp\]#", "&nbsp;", $comp_desc);
		$comp_desc=preg_replace("#\[nl\]#", "<br>\n", $comp_desc);
		$charg_amt = $row["charg_amt"];
		$paid_amt = $row["paid_amt"];
		$comp_closedate = date('d-m-Y h:i:s a', strtotime($row["comp_closedate"]));
		$comp_status = $row["comp_status"];
		$comp_regdate= date('d-m-Y h:i:s a', strtotime($row["comp_regdate"]));	
		if($comp_status==1){$comp_status_temp= "Sent"; $comp_closedate=  "Not Available";}
		else if ($comp_status==2){$comp_status_temp=  "Assigned"; $comp_closedate=  "Not Available";}			
		else if ($comp_status==3){$comp_status_temp=  "Completed";}			
		else if($comp_status==4){$comp_status_temp=  "Closed";}			
		else if($comp_status==0){$comp_status_temp=  "Deleted";}			
		else {$comp_status_temp =  "None"; $comp_closedate=  "Not Available";}
	}
}
else 
{
	$content_data.='<b>'.$comp_id.'</b>'." "."Compliant Id Is Not Exist!";	
}
include('./comp_profile_pdf.php');


    $content_data.='<style type="text/css">
		body{
		font-size:12px;
		line-height:24px;
		font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
		color:#000;
		}
		</style>
		<div  id="invoice"  style="border:1px solid #ccc; padding:10px; height:100%; width:590pt;">
		<div style="text-align:center; padding-top:10px; float:left; width:70px;">
            <img src="./img/logo.png">
        </div>
        <div style="text-align:center; padding-top:10px;  float:center; width:100%;">
            <b>'.$comp_name.'</b><br/>
            <medium>'.$comp_tag_line.'</medium><br/>
			<small>'.$comp_add.'</small><br/>
			<small>Mobile No: '.$comp_mob.','.$comp_mob1.'</small><br/>
        </div> <hr/>
		<div style="text-align:center;float:left; width:690px;">
          <table style= "width:100%;  padding-top:5px; font-size:9px;" border-collapse: collapse; cellspacing="3">
          <tbody>
			<tr>
              <td style="text-align:left; padding: 0px;">No: '.$comp_id.'/AMC/SERVICE</td>			  		  
              <td style="text-align:center; padding: 0px;"></td>			  		  
              <td style="text-align:right; padding: 0px;">Date: '.$today.' </td>			  		  
			</tr>		  
			<tr>
              <td style="text-align:left; padding: 0px;"><img Style="width:50px;" src="./img/iso.png"> </td>			  		  
              <td style="text-align:center; padding: 0px;"><h3 align="center" Style="text-align:center;"><br/>Maintenance/Job Card</h3></td>			  		  
              <td style="text-align:right; padding: 0px;"><img Style="width:50px;" src="./img/247.png"> </td>			  		  
			</tr>			
          </tbody>
      </table>
	  </div>	
		<div style="text-align:center; border:0px solid #ccc; float:left; width:690px;">
          <table style= "width:100%; font-size:10px;" border-collapse: collapse; cellspacing="3">
          <tbody>
		  <tr>
              <td colspan="2" style="text-align:left; padding: 3px;"><b>Customer Name: '.$euname.' (ID: '.$euid.')</b></td>			  		                		  		 
			</tr>
			<tr>
              <td style="text-align:left;  padding: 3px;"><b>Mobile Number<span>:</span></b>'.$eumob.', '.$altmob.'</td>
			  <td style="text-align:left;  padding: 3px;"><b>Customer Type<span>:</span> </b>'.$eutype.'</td>
			</tr>
			<tr>         
			  <td colspan="2" style="text-align:left;  padding: 3px;"><b>Email <span>:</span> </b>'.$email.'</td>        
			</tr>
			<tr>         
			  <td colspan="2" style="text-align:left;  padding: 3px;"><b>Address <span>:</span> </b>'.$address.'</td>        
			</tr>						    							
          </tbody>
      </table>	  
	  </div>
	  		<div style=" clear:both; text-align:center; border:0px solid #ccc; float:right; width:100%;">
			<h5>Complaint Details </h5>
				<table border="1" style= "border:0px solid #ccc; width:100%; font-size:10px;  border-collapse:collapse;">
					
			<tbody>
			<tr>
              <td style="text-align:left;  padding: 3px;"><b>Complaint Id</b></td>
              <td style="text-align:left;  padding: 3px;">'.$comp_id.'</td>
			  <td style="text-align:left;  padding: 3px;"><b>Category</b></td>
              <td style="text-align:left;  padding: 3px;">'.$cat_name.'</td>
			</tr>
			<tr>
              <td style="text-align:left;  padding: 3px;"><b>Priority</b></td>
              <td style="text-align:left;  padding: 3px;">'.$priority.'</td>
			  <td style="text-align:left;  padding: 3px;"><b>Charge Amount</b></td>
              <td style="text-align:left;  padding: 3px;">'.$charg_amt.'</td>
			</tr>
			<tr>
              <td style="text-align:left;  padding: 3px;"><b>Paid Amount</b></td>
              <td style="text-align:left;  padding: 3px;">'.$paid_amt.'</td>
			  <td style="text-align:left;  padding: 3px;"><b>Status</b></td>
              <td style="text-align:left;  padding: 3px;">'.$comp_status_temp.'</td>
			</tr>
			<tr>
              <td style="text-align:left;  padding: 3px;"><b>Handle By</b></td>
              <td style="text-align:left;  padding: 3px;">'.$emp_name.'</td>
			  <td style="text-align:left;  padding: 3px;"><b>Technician Number</b></td>
              <td style="text-align:left;  padding: 3px;">'.$emp_mob.'</td>
			</tr>
			<tr>
              <td style="text-align:left;  padding: 3px;"><b>Register Date</b></td>
              <td style="text-align:left;  padding: 3px;">'.$comp_regdate.'</td>
			  <td style="text-align:left;  padding: 3px;"><b>Close Date</b></td>
              <td style="text-align:left;  padding: 3px;">'.$comp_closedate.'</td>
			</tr>
			
					</tbody>
				</table>
<p Style="font-size:10px;text-align:left;"><b>Complaint summary: </b>'.$comp_desc.'</p>				
<p Style="font-size:10px;text-align:left;"><b>Job Description: </b>'.$summary.'</p>				
	  </div>
	  <div style="text-align:center; float:left; width:690px;">
          <table style= "width:100%; font-size:11px;" border-collapse: collapse; cellspacing="3">
          <tbody>
		  <tr>
              <td style="text-align:left; padding: 0px;"> </td>			  		  			  		  
              <td style="text-align:right; padding: 0px;"><img Style="width:100px;" src="./img/sign.png"> </td>			  		  
			</tr>
			<tr>
              <td style="text-align:left; padding: 0px;"> Customers Signature</td>			  		  			  		  
              <td style="text-align:right; padding: 0px;"><p>'.$pro_pra_name.'</p> </td>			  		  
			</tr>									    						
          </tbody>
      </table>
	  </div>
</div>';
return $content_data;
} 
?>