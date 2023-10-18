<?php

session_start();

if(!isset($_SESSION['formStatus1']) OR !isset($_SESSION['formStatus2']) OR !isset($_SESSION['formStatus3']) OR !isset($_SESSION['formStatus4']) OR !isset($_SESSION['applicantPhoneNumber'])){
    header("Location: ../1");
    exit;
}

if(isset($_GET['languagePref'])){
  $_SESSION['languagePref']=$_GET['languagePref'];
}


include '../../../Constants/index.php';
include '../../../Constants/Languages/index.php';

// $link=mysqli_connect($server,$user,$pass,$db);

// if(!mysqli_connect_error()){

// }


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

        <u><h4><b><?php echo $Application_Received ?></b></h4></u>

        <div class="container">

          <div class="row" >
            <div class="col-sm-8 imgUp" style="margin: 10px auto;">

              <div class="alert alert-success" role="alert">
                <h4 class="alert-heading"><b><?php echo $Your_app_number." ".$_SESSION["userID"]; ?></b></h4>
                <p><?php echo $Your_app_number_msg ?></p>
                <!-- <hr>
                <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p> -->
              </div>

              <div class="col-lg-12" style="text-align: center;">
                <a style="padding-left: 30px;padding-right: 30px;" href="../../../" class="btn btn-primary btn-lg"><?php echo $Continue ?></a>
              </div>
              
            </div>
          </div>

        </div>
        
      </div>
    </div>
  </div>
     
</div> 


  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

</body>
</html>

<?php
session_unset();//deletes all session
?>