<?php

session_start();

if(!isset($_SESSION['formStatus3']) OR !isset($_SESSION['applicantPhoneNumber'])){
    header("Location: ../3");
    exit;
}

// if(isset($_SESSION['formStatus4'])){
//   if($_SESSION['formStatus4']==1){
//     //FORM 4 DONE
//     header("Location: ../ApplicationReceived"); 
//   }
// }

include '../../../Constants/index.php';

$link=mysqli_connect($server,$user,$pass,$db);

if(!mysqli_connect_error()){

    if(isset($_POST["applicantUTRNumber"]) AND isset($_POST["applicantPaymentDate"]) AND $_FILES["applicantDemandDraft"]){


    //PAGE HAS BEEN SUBMITTED
    $_SESSION["applicantUTRNumber"]=isset($_POST["applicantUTRNumber"]) ? $_POST["applicantUTRNumber"] : "";
    $_SESSION["applicantPaymentDate"]=isset($_POST["applicantPaymentDate"]) ? $_POST["applicantPaymentDate"] : "";

    //CREATE DIRECTORY
    $directoryName=md5($_SESSION['applicantPhoneNumber']."subhiksha");

    if (!file_exists('../../../data/'.$directoryName)) {
        mkdir('../../../data/'.$directoryName, 0777, true);
    }

    $target_dir = "../../../data/".$directoryName."/";

    $isPhotoUploaded=false;

    if($_FILES["applicantDemandDraft"]){

      $uploadedFilename = $_FILES['applicantDemandDraft']['name'];
      $extension = pathinfo($uploadedFilename, PATHINFO_EXTENSION);

      $fileName=md5($_SESSION['applicantPhoneNumber']."ddphoto");

      $target_file = $target_dir .$fileName.".".$extension;

      if(move_uploaded_file($_FILES["applicantDemandDraft"]["tmp_name"], $target_file)){
        $isPhotoUploaded=true;

        if(array_key_exists("applicantUTRNumber", $_POST) AND !$_POST['applicantUTRNumber']==""){

          $query="UPDATE ".$USERTABLENAME." SET `formStatus4`=1,`utrNumber`='".$_POST['applicantUTRNumber']."',`paymentDate`='".$_POST['applicantPaymentDate']."' WHERE `userID`=".$_SESSION['userID'];

          if(mysqli_query($link,$query)){

            $_SESSION['formStatus4']=1;

            //header("Location: ../ApplicationReceived"); 
            exit;

          }

        }

      }else {
        // echo "Sorry, there was an error uploading your photo.";
      }

    }

  }else{
    http_response_code(404);
    die();
  }

}
?>