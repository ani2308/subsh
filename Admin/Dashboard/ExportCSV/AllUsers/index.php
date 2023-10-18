<?php

session_start();

if(!isset($_SESSION['adminID'])){
    header("Location: ../");
    exit;
}


include '../../../../Constants/index.php';

$error=null;

$link=mysqli_connect($server,$user,$pass,$db);

header('Content-Type: text/csv; charset=utf-8');  
header('Content-Disposition: attachment; filename=dashboard.csv'); 
ob_end_clean(); 
$output = fopen("php://output", "w");

fputcsv($output, array('userID','verified','verifierID','approved','approverID','adminID','formStatus1','formStatus2','formStatus3','formStatus4','name','fatherHusbandName','dob','address','pinCode','state_code','dist_code','taluka_code','contactNumber','contactNumberHash','whatsappNumber','aadharNumber','isMale','religion','caste','nomineeName','nomineeAge','nomineeRelationship','isOrganicFarmer','referrerName','referrerFolioNumber','referrerMobileNumber','utrNumber','paymentDate','paymentReceivedDate','certificateNumber','certificateNumberFrom','certificateNumberTo','certificateIssueDate','isOldUser','oldUserId'));


$query="SELECT * FROM `".$USERTABLENAME."`;";

$result=mysqli_query($link,$query);

while ($row=mysqli_fetch_assoc($result)) {

	fputcsv($output, $row);

}

fclose($output);
?>