<?php

session_start();

if(!isset($_SESSION['formStatus3']) OR !isset($_SESSION['applicantPhoneNumber'])){
    header("Location: ../3");
    exit;
}

if(isset($_SESSION['formStatus4'])){
  if($_SESSION['formStatus4']==1){
    //FORM 4 DONE
    header("Location: ../ApplicationReceived"); 
  }
}

if(isset($_GET['languagePref'])){
  $_SESSION['languagePref']=$_GET['languagePref'];
}

include '../../../Constants/index.php';
include '../../../Constants/Languages/index.php';

// $link=mysqli_connect($server,$user,$pass,$db);

// if(!mysqli_connect_error()){

//   if(isset($_POST["submit"])){
//     //PAGE HAS BEEN SUBMITTED
//     $_SESSION["applicantUTRNumber"]=isset($_POST["applicantUTRNumber"]) ? $_POST["applicantUTRNumber"] : "";
//     $_SESSION["applicantPaymentDate"]=isset($_POST["applicantPaymentDate"]) ? $_POST["applicantPaymentDate"] : "";

//     //CREATE DIRECTORY
//     $directoryName=md5($_SESSION['applicantPhoneNumber']."subhiksha");

//     if (!file_exists('../../../data/'.$directoryName)) {
//         mkdir('../../../data/'.$directoryName, 0777, true);
//     }

//     $target_dir = "../../../data/".$directoryName."/";

//     $isPhotoUploaded=false;

//     if($_FILES["applicantDemandDraft"]){

//       $uploadedFilename = $_FILES['applicantDemandDraft']['name'];
//       $extension = pathinfo($uploadedFilename, PATHINFO_EXTENSION);

//       $fileName=md5($_SESSION['applicantPhoneNumber']."ddphoto");

//       $target_file = $target_dir .$fileName.".".$extension;

//       if(move_uploaded_file($_FILES["applicantDemandDraft"]["tmp_name"], $target_file)){
//         $isPhotoUploaded=true;

//         if(array_key_exists("applicantUTRNumber", $_POST) AND !$_POST['applicantUTRNumber']==""){

//           $query="UPDATE ".$USERTABLENAME." SET `formStatus4`=1,`utrNumber`='".$_POST['applicantUTRNumber']."',`paymentDate`='".$_POST['applicantPaymentDate']."' WHERE `userID`=".$_SESSION['userID'];

//           if(mysqli_query($link,$query)){

//             $_SESSION['formStatus4']=1;

//             header("Location: ../ApplicationReceived"); 
//             exit;

//           }

//         }

//       }else {
//         // echo "Sorry, there was an error uploading your photo.";
//       }

//     }



//   }

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

        <form style="padding: 10px" method="POST" enctype="multipart/form-data">

          <u><h4><?php echo $PAYMENT ?></h4></u>

          <div class="container">

            <div class="card" style="padding: 10px; padding-left: 20px; margin-bottom: 20px;">
              <h5><u>Bank Details</u></h5>
              Name : Subhiksha Organic Farmers' Multi State Cooperative Society Ltd<br>
                Account No : 510101004439782<br>
                IFSC : UBIN0900184<br>
                Bank Name : Union bank of India,<br>
                Branch : Thirthahalli
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1"><?php echo $utrNumber ?></label>
              <input id="applicantUTRNumber" name="applicantUTRNumber" type="text" class="form-control" placeholder="<?php echo $enterutrNumber ?>" autocomplete="off" required value="<?php echo isset($_SESSION["applicantUTRNumber"])?$_SESSION["applicantUTRNumber"]:""; ?>">
              <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>

            <div class="form-group">
              <label for="birthday"><?php echo $paymentDate ?></label><br>
              <input id="applicantPaymentDate" name="applicantPaymentDate" type="date" required value="<?php echo isset($_SESSION["applicantPaymentDate"])?$_SESSION["applicantPaymentDate"]:""; ?>">
            </div>

            <div class="row" style="text-align: center;">
              <div class="col-sm-8 imgUp">
                <label for="exampleInputEmail1"><?php echo $uploadDemandDraft ?></label>
                <div class="imagePreview"></div>
                <label class="btn btn-primary">
                  <?php echo $uploadDemandDraft ?><input id="applicantDemandDraft" name="applicantDemandDraft" type="file" class="uploadFile img" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;" accept=".jpg,.png,.gif,.jpeg">
                </label>
                <img id="photo_src_img"  style="width:100%;display: none;">
                <img id="photo_comprsd_img"  style="width:100%;display: none;">
              </div>
            </div>

          </div>
          
          <!-- <div class="col-lg-12" style="text-align: center;">
            <input style="padding-left: 30px;padding-right: 30px; " name="submit" type="submit" class="btn btn-primary btn-lg" value="<?php //echo $submit ?>">
          </div> -->
          
        </form>

        <div class="col-lg-12" style="text-align: center;">
          <input id="submitBtn" style="padding-left: 30px;padding-right: 30px;" name="submit" type="submit" class="btn btn-primary btn-lg" value="<?php echo $submit ?>">
        </div>
        
      </div>
    </div>
  </div>
     
</div> 


  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

  <script type="text/javascript" src="JIC.js"></script>

  <script type="text/javascript">
  
  $(document).on("click", "i.del", function () {
    //  to remove card
    $(this).parent().remove();
    // to clear image
    // $(this).parent().find('.imagePreview').css("background-image","url('')");
  });

  $(function () {
    $(document).on("change", ".uploadFile", function () {

      const size = (this.files[0].size / 1024 / 1024).toFixed(2);
      // if (size > 7) {
      //   alert("File must be less than 7MB");
      //   return;
      // }

      
      var uploadFile = $(this);
      var files = !!this.files ? this.files : [];
      if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

      if (/^image/.test(files[0].type)) {
        // only image file
        var reader = new FileReader(); // instance of the FileReader
        reader.readAsDataURL(files[0]); // read the local file

        reader.onloadend = function () {
          // set image data as background of div
          //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
          uploadFile
            .closest(".imgUp")
            .find(".imagePreview")
            .css("background-image", "url(" + this.result + ")");
        };
      }
    });
  });

  </script>


  <!-- IMAGE COMPRESSION -->
  <script>

    // PHOTO COMPRESSION===================================================
    var photo_output_format = null;
    var photo_file_name = null;

    function readFilePhoto(evt) {

      var photo_file = evt.target.files[0];
      var photo_reader = new FileReader();

      photo_reader.onload = function(event) {
        var photo_src_img = document.getElementById("photo_src_img");
        photo_src_img.src = event.target.result;

        var photo_comprsd_img = document.getElementById("photo_comprsd_img");
        
        photo_src_img.onload = function(){
            // console.log("Image loaded");
            photo_output_format = photo_file.name.split(".").pop();
            var quality = 30;
            photo_comprsd_img.src = jic.compress(photo_src_img,quality,photo_output_format).src;
        }
      };

      photo_file_name = photo_file.name;

      photo_reader.readAsDataURL(photo_file);
      
      return false;
    }
    document.getElementById("applicantDemandDraft").addEventListener("change", readFilePhoto, false);


    // UPLOAD IMAGE
    $("#submitBtn").click(function() {

      var photo_comprsd_img = document.getElementById("photo_comprsd_img");

      var applicantUTRNumber = document.getElementById("applicantUTRNumber").value;
      var applicantPaymentDate = document.getElementById("applicantPaymentDate").value;

      var successCallback= function(response){
        // console.log("image uploaded successfully! :)");
        // console.log(response);
        window.location.replace("../ApplicationReceived");
        // alert("Success");  
      }

      var errorCallback= function(response){
        // console.log("image Filed to upload! :)");
        // console.log(response);
        alert("Upload all the files!");
      }
      
      // console.log("process start upload ...");
      jic.upload(photo_comprsd_img, "applicantDemandDraft", photo_file_name,"applicantUTRNumber",applicantUTRNumber,"applicantPaymentDate",applicantPaymentDate,"SubmitImages.php",successCallback,errorCallback);
      
    });

  </script>


</body>
</html>