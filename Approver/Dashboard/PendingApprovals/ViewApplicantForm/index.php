<?php

session_start();

if(!isset($_SESSION['approverID'])){
    header("Location: ../");
    exit;
}

include '../../../../Constants/index.php';

$error=null;

$link=mysqli_connect($server,$user,$pass,$db);


if(!mysqli_connect_error()){
    $query="SELECT * FROM `".$USERTABLENAME."` WHERE `verified`=1 AND `approved`=0 AND `formStatus1`=1 AND `formStatus2`=1 AND `formStatus3`=1 AND `formStatus4`=1 AND `userID`=".$_GET["userID"];

    $result=mysqli_query($link,$query);

    // GO BACK IF NO USER FOUND
    if(mysqli_num_rows($result)<=0){
        header("Location: ../");
        exit;
    }

    $row=mysqli_fetch_array($result);

    // $directoryName=md5($row['contactNumber']."subhiksha");
    // $target_dir = "../../../../data/".$directoryName."/";

    // $photoFileName=md5($row['contactNumber']."photo");
    // $photoFilePath = glob ($target_dir.$photoFileName.".*")[0]; 
    // $photoFilePathExploded=explode('.', $photoFilePath);
    // $photoExtension = end($photoFilePathExploded);
    // $photoSourceUrl=$target_dir.$photoFileName.".".$photoExtension;

    // $aadharFrontFileName=md5($row['contactNumber']."aadharfront");
    // $aadharFrontFilePath = glob ($target_dir.$aadharFrontFileName.".*")[0];
    // $aadharFrontFilePathExploded=explode('.', $aadharFrontFilePath);
    // $aadharFrontExtension = end($aadharFrontFilePathExploded);
    // $aadharFrontSourceUrl=$target_dir.$aadharFrontFileName.".".$aadharFrontExtension;

    // $aadharBackFileName=md5($row['contactNumber']."aadharback");
    // $aadharBackFilePath = glob ($target_dir.$aadharBackFileName.".*")[0];
    // $aadharBackFilePathExploded=explode('.', $aadharBackFilePath);
    // $aadharBackExtension = end($aadharBackFilePathExploded);
    // $aadharBackSourceUrl=$target_dir.$aadharBackFileName.".".$aadharBackExtension;

    // $ddPhotoFileName=md5($row['contactNumber']."ddphoto");
    // $ddPhotoFilePath = glob ($target_dir.$ddPhotoFileName.".*")[0];
    // $ddPhotoFilePathExploded=explode('.', $ddPhotoFilePath);
    // $ddPhotoExtension = end($ddPhotoFilePathExploded);
    // $ddPhotoSourceUrl=$target_dir.$ddPhotoFileName.".".$ddPhotoExtension;

}

// =======================TO MARK USER AS APPROVED================================
if(!mysqli_connect_error()){
    if(array_key_exists("markAsApproved", $_POST) AND $_POST["userIDToApprove"]){
        $queryToApprove="UPDATE `".$USERTABLENAME."` SET `approved`=1, `approverID`=".$_SESSION['approverID']." WHERE `verified`=1 AND `approved`=0 AND `userID`=".$_POST["userIDToApprove"];
        if(mysqli_query($link,$queryToApprove)){
            // echo "Success!";

            $queryForShareCertificate="INSERT INTO ".$SHARECERTIFICATETABLENAME." (`userID`) VALUES (".$_POST["userIDToApprove"].")";
            if(mysqli_query($link,$queryForShareCertificate)){

              $queryToGetCertificateNumber="SELECT * FROM `".$SHARECERTIFICATETABLENAME."` WHERE `userID`=".$_POST["userIDToApprove"];

              $resultCertificateNumber=mysqli_query($link,$queryToGetCertificateNumber);
              $rowCertificateNumber=mysqli_fetch_array($resultCertificateNumber);

              $rawRowCertificateNumber=$rowCertificateNumber['shareCertificateID'];

              $paddedCertificateSerialNumber=sprintf('%06d', $rawRowCertificateNumber);

              $finalCertificateNumber=$row['state_code']."/".$row['dist_code']."/".$row['taluka_code']."/".$paddedCertificateSerialNumber;

              $certificateNumberTo=$rawRowCertificateNumber*10;
              $certificateNumberFrom=$certificateNumberTo-9;

              $cerificateIssueDate=$rowCertificateNumber['issueTimeStamp'];

              $queryToUpdateUserTableWithCertiNo="UPDATE `".$USERTABLENAME."` SET `certificateNumberFrom`=".$certificateNumberFrom.",`certificateNumberTo`=".$certificateNumberTo.",`certificateNumber`='".$finalCertificateNumber."', `certificateIssueDate`='".$cerificateIssueDate."' WHERE `verified`=1 AND `approved`=1 AND `userID`=".$_POST["userIDToApprove"];

              if(mysqli_query($link,$queryToUpdateUserTableWithCertiNo)){
                header("Location: ../");
                exit;
              }
              
            }
        }else{
            // echo "Error updating!";
        }
    }
}


//=============CHANGE PERSONAL INFORMATION =========================
// 


//=========CHANGE REFERRER======================
// 

//=========CHANGE State D T======================
// if(!mysqli_connect_error()){
//   if(array_key_exists("userIDToChangeSDTDetails", $_POST) AND $_POST["changeSDTDetails"]){
//     if(
//       array_key_exists("applicantState", $_POST) AND $_POST['applicantState']!="" AND
//       array_key_exists("applicantDistrict", $_POST) AND $_POST['applicantDistrict']!="" AND
//       array_key_exists("applicantTaluka", $_POST) AND $_POST['applicantTaluka']!=""
//       ){

//       $queryToChangeReferrerDetails="UPDATE ".$USERTABLENAME." SET `state_code`='{$_POST['applicantState']}',`dist_code`='{$_POST['applicantDistrict']}',`taluka_code`='{$_POST['applicantTaluka']}' WHERE `userID`=".$_POST['userIDToChangeSDTDetails'];

//         if(mysqli_query($link,$queryToChangeReferrerDetails)){

//         }else{
//           //echo "error!";
//       }
//     }
//   }
// }

//=========REJECT PHOTO & AADHAR======================
// 

//=========REJECT DD======================


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Subhiksha - Approver</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <!-- <link rel="stylesheet" href="./index.css"> -->
    <!-- Scrollbar Custom CSS -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css"> -->


</head>
<body>

	<div class="alert alert-primary" role="alert" style="margin: 10px;">
	  <h4><u>Pending Approvals</u></h4> 
	  <b>Application No : <?php echo $_GET["userID"];?></b>
	</div>

    <div class="row" style="margin: 10px;">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card" style="padding: 10px; margin-bottom: 10px">
                <form method="POST">
                    <div class="col-lg-12" style="text-align: center;">
                        <input type="hidden" name="userIDToApprove" value="<?php echo $_GET["userID"];?>">
                        <input style="padding-left: 30px;padding-right: 30px;font-weight: bold; " name="markAsApproved" type="submit" class="btn btn-success btn-lg" value="Mark As Approved">
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- PERSONAL DETAILS -->
    <?php 
    // $disableEditing="disabled";
    $disableEditing=" ";
    include '../../../../Components/RegistrationForms/PersonalDetailsForm/index.php'; ?>
    <!-- PERSONAL DETAILS END -->


    <!-- STATE DISTRICT TALUKA DETAILS -->
    <?php 
    // $disableEditingSDT="disabled";
    $disableEditingSDT=" ";
    include '../../../../Components/RegistrationForms/SDTDetailsForm/index.php'; 
    ?>
    <!-- STATE DISTRICT TALUKA DETAILS END -->


    <!-- REFERRER DETAILS -->
    <?php 
    // $disableEditingReferrer="disabled";
    $disableEditingReferrer=" ";
    include '../../../../Components/RegistrationForms/ReferrerDetailsForm/index.php'; 
    ?>
    <!-- REFERRER DETAILS END -->


    <!-- PHOTO AADHAAR -->
    <?php 
    // $disableEditingPhotoAadhar="disabled";
    $disableEditingPhotoAadhar=" ";
    include '../../../../Components/RegistrationForms/PhotoAadharDetailsForm/index.php'; 
    ?>
    <!-- PHOTO AADHAR END -->
    

    <!-- PAYMENT DETAILS -->
    <?php 
    // $disableEditingPayment="disabled";
    $disableEditingPayment=" ";
    include '../../../../Components/RegistrationForms/PaymentDetailsForm/index.php'; 
    ?>
    <!-- PAYMENT DETAILS END -->


<script type="text/javascript">
    var applicantWhatsAppNumber=document.getElementById("applicantWhatsAppNumber");
    var messageBoxDivMobileNumber=document.getElementById("messageBoxDivMobileNumber");

    var applicantDOB=document.getElementById("applicantDOB");
    var messageBoxDOB=document.getElementById("messageBoxDOB");
    

    function underAgeValidate(birthday){
      // it will accept two types of format yyyy-mm-dd and yyyy/mm/dd
      var optimizedBirthday = birthday.replace(/-/g, "/");

      //set date based on birthday at 01:00:00 hours GMT+0100 (CET)
      var myBirthday = new Date(optimizedBirthday);

      // set current day on 01:00:00 hours GMT+0100 (CET)
      var currentDate = new Date().toJSON().slice(0,10)+' 01:00:00';

      // calculate age comparing current date and borthday
      var myAge = ~~((Date.now(currentDate) - myBirthday) / (31557600000));

      if(myAge < 18) {
        messageBoxDOB.innerHTML="<div class=\"alert alert-danger\" role=\"alert\">Your age should be more than 18 years.</div>";
          return false;
      }else{
        messageBoxDOB.innerHTML="";
        return true;
      }

    } 

    function mobileNumberValidate(){
      var phoneno = /^\d{10}$/;
      if(applicantWhatsAppNumber.value.match(phoneno))
      {
        messageBoxDivMobileNumber.innerHTML="";
        return true;
      }
      else
      {
        messageBoxDivMobileNumber.innerHTML="<div class=\"alert alert-danger\" role=\"alert\">Enter a Valid 10 Digit Phone Number!</div>";
        return false;
      }
    }

    function validatePersonalInfoForm(){

      var mob=mobileNumberValidate();
      var dob=underAgeValidate(applicantDOB.value);

      if(mob && dob){
        return true;
      }else{
        return false;
      }
      
    }

</script>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){

      var selectedDistrictCode;
      var selectedStateCode;

       $.getJSON('../../../../Helpers/Locations/GetStates.php',function(data) { 
          var applicantState=$("#applicantState");
          applicantState.empty();
          // console.log(data);
          applicantState.append('<option value="" selected disabled="disabled">Please Select</option>');
          for (var i=0; i<data.length; i++) {
            applicantState.append('<option value="' + data[i].state_code + '">' + data[i].state_name + ' ['+data[i].state_code+']</option>');
          }
        });


        $('#applicantState').change(function(){
          selectedStateCode=this.value;

          $.getJSON('../../../../Helpers/Locations/GetDistricts.php',{"stateCode":selectedStateCode},function(data) { 
            var applicantDistrict=$("#applicantDistrict");
            applicantDistrict.empty();
            // console.log(data);
            applicantDistrict.append('<option value="" selected disabled="disabled">Please Select</option>');
            for (var i=0; i<data.length; i++) {
              applicantDistrict.append('<option value="' + data[i].dist_code + '">' + data[i].dist_name + ' ['+data[i].dist_code+']</option>');
            }
          });

        });


        $('#applicantDistrict').change(function(){
          selectedDistrictCode=this.value;

          $.getJSON('../../../../Helpers/Locations/GetTalukas.php',{"stateCode":selectedStateCode,"districtCode":selectedDistrictCode},function(data) { 
            var applicantTaluka=$("#applicantTaluka");
            applicantTaluka.empty();
            // console.log(data);
            applicantTaluka.append('<option value="" selected disabled="disabled">Please Select</option>');
            for (var i=0; i<data.length; i++) {
              applicantTaluka.append('<option value="' + data[i].taluka_code + '">' + data[i].taluka_name + ' ['+data[i].taluka_code+']</option>');
            }
          });

        });

    });
</script>


</body>
</html>