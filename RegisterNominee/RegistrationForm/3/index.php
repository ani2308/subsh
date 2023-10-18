<?php

session_start();

if(!isset($_SESSION['formStatus2']) OR !isset($_SESSION['applicantPhoneNumber'])){
    header("Location: ../2");
    exit;
}

if(isset($_SESSION['formStatus3'])){
  if($_SESSION['formStatus3']==1){
    //FORM 3 DONE
    header("Location: ../4"); 
  }
}

if(isset($_GET['languagePref'])){
  $_SESSION['languagePref']=$_GET['languagePref'];
}

include '../../../Constants/index.php';
include '../../../Constants/Languages/index.php';

$link=mysqli_connect($server,$user,$pass,$db);

// echo "hello {$_SESSION['applicantPhoneNumber']}";

if(!mysqli_connect_error()){

  if(isset($_POST["submit"])){
    //FORM SUBMITTED
    $_SESSION["applicantReferrerName"]=isset($_POST["applicantReferrerName"]) ? $_POST["applicantReferrerName"] : "";
    $_SESSION["applicantReferrerFolioNumber"]=isset($_POST["applicantReferrerFolioNumber"]) ? $_POST["applicantReferrerFolioNumber"] : "";
    $_SESSION["applicantReferrerMobileNumber"]=isset($_POST["applicantReferrerMobileNumber"]) ? $_POST["applicantReferrerMobileNumber"] : "";

    if(
      array_key_exists("applicantReferrerName", $_POST) AND !$_POST['applicantReferrerName']=="" AND
      array_key_exists("applicantReferrerFolioNumber", $_POST) AND !$_POST['applicantReferrerFolioNumber']=="" AND
      array_key_exists("applicantReferrerMobileNumber", $_POST) AND !$_POST['applicantReferrerMobileNumber']==""
      ){

        $query="UPDATE ".$USERTABLENAME." SET `formStatus3`=1,`referrerName`='{$_POST['applicantReferrerName']}',`referrerFolioNumber`='{$_POST['applicantReferrerFolioNumber']}',`referrerMobileNumber`='{$_POST['applicantReferrerMobileNumber']}' WHERE `userID`=".$_SESSION['userID'];

        if(mysqli_query($link,$query)){
          $_SESSION['formStatus3']=1;

          header("Location: ../4"); 
          exit;

        }else{
          echo "error!";
        }

      }

  }

  

}


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,600,700' rel='stylesheet' type='text/css'>
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>



<div class="container">

  <?php
  include '../../../Components/HelpLanguageNav/index.php';
  ?>

  <div class="row" style="margin-top: 10px" style="width: 100%">
    <div class="col-lg-12 col-md-12 col-sm-12" id="timeLine" style="text-align: center;">
      <div class="card" style="padding: 10px">
        <ul class="timeline" style="margin-top: 20px">
          <li class="li <?php if($_SESSION['formStatus1']){echo "complete";} ?>">
            <div class="status">
              <h4> <?php echo $PERSONAL_INFO ?> </h4>
            </div>
          </li>
          <li class="li <?php if($_SESSION['formStatus2']){echo "complete";} ?>">
            <div class="status">
              <h4> <?php echo $PHOTO_AADHAR ?> </h4>
            </div>
          </li>
          <li class="li <?php if($_SESSION['formStatus3']){echo "complete";} ?>">
            <div class="status">
              <h4> <?php echo $REFERRER ?> </h4>
            </div>
          </li>
          <li class="li <?php if($_SESSION['formStatus4']){echo "complete";} ?>">
            <div class="status">
              <h4> <?php echo $PAYMENT ?> </h4>
            </div>
          </li>
         </ul>
      </div>
    </div>
  </div>



  <div class="row" style="margin-top: 10px;">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="card" style="padding: 10px; margin-bottom: 30px">

        <form style="padding: 10px" method="POST" onsubmit="return validateForm()">

          <u><h4><?php echo $REFERRER ?></h4></u>

          <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $referrer_name ?></label>
            <!-- <small id="emailHelp" class="form-text text-muted">
              
            </small> -->
            <input name="applicantReferrerName" type="text" class="form-control" placeholder="<?php echo $enter_referrer_name ?>" autocomplete="off" required value="<?php echo isset($_SESSION["applicantReferrerName"])?$_SESSION["applicantReferrerName"]:""; ?>">
            
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1"> <?php echo $referrer_folio_no ?></label>
            <input name="applicantReferrerFolioNumber" type="text" class="form-control" placeholder=" <?php echo $enter_referrer_folio_no ?>" autocomplete="off" required value="<?php echo isset($_SESSION["applicantReferrerFolioNumber"])?$_SESSION["applicantReferrerFolioNumber"]:""; ?>">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $referrer_mobile ?></label>
            <div id="messageBoxDivMobileNumber">
                
            </div>
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">+91</div>
              </div>
              <input name="applicantReferrerMobileNumber" id="applicantReferrerMobileNumber" type="number" class="form-control" placeholder="<?php echo $enter_referrer_mobile ?>" autocomplete="off" required value="<?php echo isset($_SESSION["applicantReferrerMobileNumber"])?$_SESSION["applicantReferrerMobileNumber"]:""; ?>">
            </div>
          </div>
          
          <div class="col-lg-12" style="text-align: center;">
            <input name="submit" style="padding-left: 30px;padding-right: 30px;" type="submit" class="btn btn-primary btn-lg" value="<?php echo $Save_continue ?>">
          </div>
          

        </form>
        
      </div>
    </div>
  </div>
     
</div> 


  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

  <script type="text/javascript">
    var applicantReferrerMobileNumber=document.getElementById("applicantReferrerMobileNumber");
    var messageBoxDivMobileNumber=document.getElementById("messageBoxDivMobileNumber");

    function mobileNumberValidate(){
      var phoneno = /^\d{10}$/;
      if(applicantReferrerMobileNumber.value.match(phoneno))
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

    function validateForm(){

      var mob=mobileNumberValidate();

      if(mob){
        return true;
      }else{
        return false;
      }
      
    }
  </script>

</body>
</html>