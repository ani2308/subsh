<?php

session_start();

if(!isset($_SESSION['formStatus1']) OR !isset($_SESSION['applicantPhoneNumber'])){
    header("Location: ../1");
    exit;
}

include '../../../Constants/index.php';

$link=mysqli_connect($server,$user,$pass,$db);

if(!mysqli_connect_error()){

	//CREATE DIRECTORY
    $directoryName=md5($_SESSION['applicantPhoneNumber']."subhiksha");

    if (!file_exists('../../../data/'.$directoryName)) {
        mkdir('../../../data/'.$directoryName, 0777, true);
    }

    $target_dir = "../../../data/".$directoryName."/";

    $isPhotoUploaded=false;
    $isAadharFrontUploaded=false;
    $isAadharBackUploaded=false;

    if($_FILES["applicantPhoto"]){

      $uploadedFilename = $_FILES['applicantPhoto']['name'];
      $extension = pathinfo($uploadedFilename, PATHINFO_EXTENSION);

      $fileName=md5($_SESSION['applicantPhoneNumber']."photo");

      // $target_file = $target_dir . basename($_FILES["applicantPhoto"]["name"]);
      $target_file = $target_dir .$fileName.".".$extension;

      // echo $target_file;

      if(move_uploaded_file($_FILES["applicantPhoto"]["tmp_name"], $target_file)){
        $isPhotoUploaded=true;
      }else {
        //echo "Sorry, there was an error uploading your photo.";
      }

    }

    if($_FILES["applicantAadharFront"]){

      $uploadedFilename = $_FILES['applicantAadharFront']['name'];
      $extension = pathinfo($uploadedFilename, PATHINFO_EXTENSION);

      $fileName=md5($_SESSION['applicantPhoneNumber']."aadharfront");

      $target_file = $target_dir .$fileName.".".$extension;

      if(move_uploaded_file($_FILES["applicantAadharFront"]["tmp_name"], $target_file)){
        $isAadharFrontUploaded=true;
      }else {
        //echo "Sorry, there was an error uploading your Aadhar front.";
      }

    }

    if($_FILES["applicantAadharBack"]){

      $uploadedFilename = $_FILES['applicantAadharBack']['name'];
      $extension = pathinfo($uploadedFilename, PATHINFO_EXTENSION);

      $fileName=md5($_SESSION['applicantPhoneNumber']."aadharback");

      $target_file = $target_dir .$fileName.".".$extension;

      if(move_uploaded_file($_FILES["applicantAadharBack"]["tmp_name"], $target_file)){
        $isAadharBackUploaded=true;
      }else {
        //echo "Sorry, there was an error uploading your Aadhar back.";
      }

    }

    if($isPhotoUploaded AND $isAadharFrontUploaded AND $isAadharBackUploaded){

      $query="UPDATE ".$USERTABLENAME." SET `formStatus2`=1 WHERE `userID`=".$_SESSION['userID'];

      if(mysqli_query($link,$query)){
        $_SESSION['formStatus2']=1;
      }

      //header("Location: ../3"); 

      exit;
    }else{
    	http_response_code(404);
    	die();
    }


}

?>