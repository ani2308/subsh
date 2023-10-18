<?php

session_start();

if(!isset($_SESSION['formStatus1']) OR !isset($_SESSION['applicantPhoneNumber'])){
    header("Location: ../1");
    exit;
}

if(isset($_SESSION['formStatus2'])){
  if($_SESSION['formStatus2']==1){
    //FORM 2 DONE
    header("Location: ../3"); 
  }
}

if(isset($_GET['languagePref'])){
  $_SESSION['languagePref']=$_GET['languagePref'];
}

include '../../../Constants/index.php';
include '../../../Constants/Languages/index.php';

$link=mysqli_connect($server,$user,$pass,$db);

// if(!mysqli_connect_error()){

//   if(isset($_POST["submit"])){
//     //PAGE HAS BEEN SUBMITTED

//     //CREATE DIRECTORY
//     $directoryName=md5($_SESSION['applicantPhoneNumber']."subhiksha");

//     if (!file_exists('../../../data/'.$directoryName)) {
//         mkdir('../../../data/'.$directoryName, 0777, true);
//     }

//     $target_dir = "../../../data/".$directoryName."/";

//     $isPhotoUploaded=false;
//     $isAadharFrontUploaded=false;
//     $isAadharBackUploaded=false;

//     if($_FILES["applicantPhoto"]){

//       $uploadedFilename = $_FILES['applicantPhoto']['name'];
//       $extension = pathinfo($uploadedFilename, PATHINFO_EXTENSION);

//       $fileName=md5($_SESSION['applicantPhoneNumber']."photo");

//       // $target_file = $target_dir . basename($_FILES["applicantPhoto"]["name"]);
//       $target_file = $target_dir .$fileName.".".$extension;

//       // echo $target_file;

//       if(move_uploaded_file($_FILES["applicantPhoto"]["tmp_name"], $target_file)){
//         $isPhotoUploaded=true;
//       }else {
//         //echo "Sorry, there was an error uploading your photo.";
//       }

//     }

//     if($_FILES["applicantAadharFront"]){

//       $uploadedFilename = $_FILES['applicantAadharFront']['name'];
//       $extension = pathinfo($uploadedFilename, PATHINFO_EXTENSION);

//       $fileName=md5($_SESSION['applicantPhoneNumber']."aadharfront");

//       $target_file = $target_dir .$fileName.".".$extension;

//       if(move_uploaded_file($_FILES["applicantAadharFront"]["tmp_name"], $target_file)){
//         $isAadharFrontUploaded=true;
//       }else {
//         //echo "Sorry, there was an error uploading your Aadhar front.";
//       }

//     }

//     if($_FILES["applicantAadharBack"]){

//       $uploadedFilename = $_FILES['applicantAadharBack']['name'];
//       $extension = pathinfo($uploadedFilename, PATHINFO_EXTENSION);

//       $fileName=md5($_SESSION['applicantPhoneNumber']."aadharback");

//       $target_file = $target_dir .$fileName.".".$extension;

//       if(move_uploaded_file($_FILES["applicantAadharBack"]["tmp_name"], $target_file)){
//         $isAadharBackUploaded=true;
//       }else {
//         //echo "Sorry, there was an error uploading your Aadhar back.";
//       }

//     }

//     if($isPhotoUploaded AND $isAadharFrontUploaded AND $isAadharBackUploaded){

//       $query="UPDATE ".$USERTABLENAME." SET `formStatus2`=1 WHERE `userID`=".$_SESSION['userID'];

//       if(mysqli_query($link,$query)){

//       }

//       $_SESSION['formStatus2']=1;

//       header("Location: ../3"); 

//       exit;
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

        <form style="padding: 10px" method="POST" enctype="multipart/form-data" onsubmit="return validateFileSize()">

          <u><h4><?php echo $PHOTO_AADHAR ?></h4></u>

          <div class="container">

            <div class="row">
              <div class="col-sm-3 imgUp">
                <label for="exampleInputEmail1"><?php echo $Upload_Photograph ?></label>
                <div class="imagePreview"></div>
                <label class="btn btn-primary">
                  <?php echo $Upload_Photograph ?><input name="applicantPhoto" id="applicantPhoto" type="file" class="uploadFile img" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;" accept=".jpg,.png,.gif,.jpeg">
                </label>
                <img id="photo_src_img"  style="width:100%;display: none;">
                <img id="photo_comprsd_img"  style="width:100%;display: none;">
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6 imgUp">
                <label for="exampleInputEmail1"><?php echo $upload_aadhar ?></label>
                <div class="imagePreview"></div>
                <label class="btn btn-primary">
                  <?php echo $upload_aadhar ?><input name="applicantAadharFront" id="applicantAadharFront" type="file" class="uploadFile img" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;" accept=".jpg,.png,.gif,.jpeg">
                </label>
                <img id="aadharf_src_img"  style="width:100%;display: none;">
                <img id="aadharf_comprsd_img"  style="width:100%;display: none;">
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6 imgUp">
                <label for="exampleInputEmail1"><?php echo $upload_aadhar_back ?></label>
                <div class="imagePreview"></div>
                <label class="btn btn-primary">
                  <?php echo $upload_aadhar_back ?><input name="applicantAadharBack" id="applicantAadharBack" type="file" class="uploadFile img" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;" accept=".jpg,.png,.gif,.jpeg">
                </label>
                <img id="aadharb_src_img"  style="width:100%;display: none;">
                <img id="aadharb_comprsd_img"  style="width:100%;display: none;">
              </div>
            </div>

          </div>
          
          
          <!-- <div class="col-lg-12" style="text-align: center;">
            <input style="padding-left: 30px;padding-right: 30px; " name="submit" type="submit" class="btn btn-primary btn-lg" value="<?php //echo $Save_continue ?>">
          </div> -->


        </form>

        <div class="col-lg-12" style="text-align: center;">
          <input id="submitBtn" style="padding-left: 30px;padding-right: 30px; " name="submit" type="submit" class="btn btn-primary btn-lg" value="<?php echo $Save_continue ?>">
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
    document.getElementById("applicantPhoto").addEventListener("change", readFilePhoto, false);


    // AADHAR FRONT COMPRESSION===================================================
    var aadharf_output_format = null;
    var aadharf_file_name = null;

    function readFileAadharf(evt) {

      var aadharf_file = evt.target.files[0];
      var aadharf_reader = new FileReader();

      aadharf_reader.onload = function(event) {
        var aadharf_src_img = document.getElementById("aadharf_src_img");
        aadharf_src_img.src = event.target.result;

        var aadharf_comprsd_img = document.getElementById("aadharf_comprsd_img");
        
        aadharf_src_img.onload = function(){
            // console.log("Image loaded");
            aadharf_output_format = aadharf_file.name.split(".").pop();
            var quality = 30;
            aadharf_comprsd_img.src = jic.compress(aadharf_src_img,quality,aadharf_output_format).src;
        }
      };

      aadharf_file_name = aadharf_file.name;

      aadharf_reader.readAsDataURL(aadharf_file);
      
      return false;
    }
    document.getElementById("applicantAadharFront").addEventListener("change", readFileAadharf, false);


    // AADHAR BACK COMPRESSION===================================================
    var aadharb_output_format = null;
    var aadharb_file_name = null;

    function readFileAadharb(evt) {

      var aadharb_file = evt.target.files[0];
      var aadharb_reader = new FileReader();

      aadharb_reader.onload = function(event) {
        var aadharb_src_img = document.getElementById("aadharb_src_img");
        aadharb_src_img.src = event.target.result;

        var aadharb_comprsd_img = document.getElementById("aadharb_comprsd_img");
        
        aadharb_src_img.onload = function(){
            // console.log("Image loaded");
            aadharb_output_format = aadharb_file.name.split(".").pop();
            var quality = 30;
            aadharb_comprsd_img.src = jic.compress(aadharb_src_img,quality,aadharb_output_format).src;
        }
      };

      aadharb_file_name = aadharb_file.name;

      aadharb_reader.readAsDataURL(aadharb_file);
      
      return false;
    }
    document.getElementById("applicantAadharBack").addEventListener("change", readFileAadharb, false);


    // UPLOAD IMAGE
      $("#submitBtn").click(function() {

        var photo_comprsd_img = document.getElementById("photo_comprsd_img");
        var aadharf_comprsd_img = document.getElementById("aadharf_comprsd_img");
        var aadharb_comprsd_img = document.getElementById("aadharb_comprsd_img");


        var successCallback= function(response){
          // console.log("image uploaded successfully! :)");
          // console.log(response);
          window.location.replace("../3");  
        }

        var errorCallback= function(response){
          // console.log("image Filed to upload! :)");
          // console.log(response);
          alert("Upload all the files!");
        }
        
        // console.log("process start upload ...");
        jic.upload(photo_comprsd_img, "applicantPhoto", photo_file_name, aadharf_comprsd_img, "applicantAadharFront", aadharf_file_name, aadharb_comprsd_img, "applicantAadharBack", aadharb_file_name,"SubmitImages.php",successCallback,errorCallback);
        
      });

    
  </script>


</body>
</html>