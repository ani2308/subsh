<?php

session_start();

include '../Constants/index.php';

if(!isset($_SESSION['userID']) AND !isset($_SESSION['approverID']) AND !isset($_SESSION['adminID'])){
    header("Location: ../");
    exit;
}

if(isset($_SESSION['userID'])){
	$query="SELECT * FROM `".$USERTABLENAME."` WHERE `verified`=1 AND `approved`=1 AND `formStatus1`=1 AND `formStatus2`=1 AND `formStatus3`=1 AND `formStatus4`=1 AND `userID`=".$_SESSION['userID'];
}

if(isset($_SESSION['approverID']) AND isset($_GET['userID'])){
	$query="SELECT * FROM `".$USERTABLENAME."` WHERE `verified`=1 AND `approved`=1 AND `formStatus1`=1 AND `formStatus2`=1 AND `formStatus3`=1 AND `formStatus4`=1 AND `userID`=".$_GET['userID'];
}

if(isset($_SESSION['adminID']) AND isset($_GET['userID'])){
	$query="SELECT * FROM `".$USERTABLENAME."` WHERE `verified`=1 AND `approved`=1 AND `formStatus1`=1 AND `formStatus2`=1 AND `formStatus3`=1 AND `formStatus4`=1 AND `userID`=".$_GET['userID'];
}


$error=null;

$link=mysqli_connect($server,$user,$pass,$db);

if(!mysqli_connect_error()){
	
	$result=mysqli_query($link,$query);
	$row=mysqli_fetch_array($result);

	$certificateNumberDisplay=$row['certificateNumber'];
	$issueTimeStamp=$row['certificateIssueDate'];
	$phpdate = strtotime( $issueTimeStamp );
	$issueDateDisplay = date( 'd-M-Y', $phpdate);

	$regdNumber=$row['userID'];
	$name=strtoupper($row['name']);
	$contactNumberHash=$row['contactNumberHash'];
	$aadharNumber=$row['aadharNumber'];
	$nomineeName=strtoupper($row['nomineeName']);
	$nomineeRelationship=$row['nomineeRelationship'];

	$distinctiveNumberDisplay=$row['certificateNumberFrom']." - ".$row['certificateNumberTo'];

	$nomineeDisplay=$nomineeName.' ('.$nomineeRelationship.')';

	if($row['certificateIssueDate']<="2020-03-10"){
		//RAJIV
		$pdfSourceFileName='share-certificate-template-old.pdf';
	}else{
		//CHAITRA
		$pdfSourceFileName='share-certificate-template.pdf';
	}


}else{
	header("Location: ../");
    exit;
}


use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;


require('./fpdf/fpdf.php');
require_once('./FPDI/src/autoload.php');


// initiate FPDI
$pdf = new Fpdi();
// add a page
$pdf->AddPage();
// set the source file
$pdf->setSourceFile($pdfSourceFileName);
// import page 1
$tplIdx = $pdf->importPage(1);
// use the imported page and place it at position 10,10 with a width of 100 mm
$pdf->useTemplate($tplIdx, -25, 10, 260);

// now write some text above the imported page
$pdf->SetFont('Helvetica');
$pdf->SetTextColor(0, 0, 0);

$pdf->SetXY(155, 30);
$pdf->SetFontSize(10);
$pdf->Write(67, $certificateNumberDisplay);//$regdNumber

$pdf->SetXY(155, 30);
$pdf->SetFontSize(10);
$pdf->Write(77, $certificateNumberDisplay);
$pdf->SetFontSize(12);

$pdf->SetXY(155, 30);
$pdf->Write(88, $issueDateDisplay);

$pdf->SetXY(65, 30);
$pdf->Write(132, $name);

$pdf->SetXY(65, 30);
$pdf->Write(149, $aadharNumber);

$pdf->SetXY(65, 30);
$pdf->Write(165, $distinctiveNumberDisplay);

$pdf->SetXY(65, 30);
$pdf->Write(197, $nomineeDisplay);

//======QR CODE=======================================================
include 'QRcodeGenerator/phpqrcode/qrlib.php'; 

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){
	$urlOfQRCode = "https://"; 
}else {
	$urlOfQRCode = "http://"; 
}
$urlOfQRCode.= $_SERVER['HTTP_HOST'];   

if($urlOfQRCode=="http://localhost"){
	$urlOfQRCode.="/subhiksha";
}

$urlOfQRCode= $urlOfQRCode."/VerifyQRCertificate/index.php?key=".$contactNumberHash;
// echo $urlOfQRCode; 

$imageTempFileName='qr'.uniqid('subhiksha', true).'.png';
// echo $imageTempFileName;
QRcode::png($urlOfQRCode, $imageTempFileName);

$pdf->Image($imageTempFileName,70,133,19);

unlink($imageTempFileName);//DELETES THE QR CODE

//=========================================================QR CODEs====

$pdfileName=$certificateNumberDisplay."_".$name."_Share_Certificate.pdf";

if(isset($_SESSION['approverID']) OR isset($_SESSION['adminID'])){
	$pdf->Output('I', $pdfileName);
}else{
	$pdf->Output('D', $pdfileName);
}



?>