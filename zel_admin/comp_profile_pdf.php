<?PHP
include('lock.php');
include ("conn.php");
$company_id ="";
$comp_name = "";
$comp_tag_line = "";
$pro_pra_name = "";
$comp_add = "";
$comp_mob= "";
$comp_mob1= "";
$comp_web= "";
//fetch Company Details
$compsql = "SELECT * FROM company_profile WHERE comp_id = 1";
$compQuery = $conn->query($compsql);
while ($compResult = $compQuery->fetch_assoc()) {
	$company_id = $compResult['comp_id'];
	$comp_name = $compResult['comp_name'];
	$comp_tag_line = $compResult['comp_tag_line'];
	$pro_pra_name = $compResult['pro_pra_name'];
	$comp_add = $compResult['comp_add'];
	$comp_mob= $compResult['comp_mob'];
	$comp_mob1= $compResult['comp_mob1'];
	$comp_web= $compResult['comp_web'];
}
?>