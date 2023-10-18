<!-- <h1>sdsad</h1> -->
<?php 
  
  if (isset($disableEditingPayment) AND $disableEditingPayment=="disabled"){
    $isDisabledTextPayment=" disabled";
  }else{
    $isDisabledTextPayment=" ";

    if(!mysqli_connect_error()){
      if(array_key_exists("userIDToRejectDDPhoto", $_POST) AND $_POST["rejectDDPhoto"]){

        $queryToChangeReferrerDetails="UPDATE ".$USERTABLENAME." SET `formStatus4`=-1 WHERE `userID`=".$_POST['userIDToRejectDDPhoto'];

          if(mysqli_query($link,$queryToChangeReferrerDetails)){

          }else{
            //echo "error!";
        }

      }
    }

    if(!mysqli_connect_error()){
      if(array_key_exists("addPaymentReceivedDate", $_POST) AND $_POST["addPaymentReceivedDate"]){
        if(
          array_key_exists("applicantPaymentReceivedDate", $_POST) AND $_POST['applicantPaymentReceivedDate']!=""){

          $queryToChangeReferrerDetails="UPDATE ".$USERTABLENAME." SET `paymentReceivedDate`='{$_POST['applicantPaymentReceivedDate']}' WHERE `userID`=".$_POST['userIDToSavePaymentDate'];

            if(mysqli_query($link,$queryToChangeReferrerDetails)){

            }else{
              //echo "error!";
          }
        }
      }
    }
  }


  if(!mysqli_connect_error() AND $disableEditingPayment!="disabled"){

    //CREATE DIRECTORY
      $directoryName=md5($row['contactNumber']."subhiksha");

      $dataDirectoryPath=dirname(__DIR__, 3);

      if (!file_exists($dataDirectoryPath.'/data/'.$directoryName)) {
          mkdir($dataDirectoryPath.'/data/'.$directoryName, 0777, true);
      }

      $target_dir = $dataDirectoryPath."/data/".$directoryName."/";


      if(isset($_FILES["applicantDDPhoto"]) AND $_FILES["applicantDDPhoto"]){

        unlink($ddPhotoSourceUrl);

        $uploadedFilename = $_FILES['applicantDDPhoto']['name'];
        $extension = pathinfo($uploadedFilename, PATHINFO_EXTENSION);

        $fileName=md5($row['contactNumber']."ddphoto");

        $target_file = $target_dir .$fileName.".".$extension;

        if(move_uploaded_file($_FILES["applicantDDPhoto"]["tmp_name"], $target_file)){

        }else {
          //echo "Sorry, there was an error uploading your photo.";
        }

      }

  }

?>

<?php 
  if($isDisabledTextPayment!=" disabled"){

    $temp=isset($_POST["applicantPaymentReceivedDate"])?$_POST["applicantPaymentReceivedDate"]:(isset($row["paymentReceivedDate"])?$row["paymentReceivedDate"]:"");

    echo '
       <div class="row" style="margin: 10px;">
        <div class="card" style="padding: 20px; margin-bottom: 10px">
          <div class="form-group">
            <form method="POST">
              <label for="Payment">Payment Received On </label><br>
              <input name="applicantPaymentReceivedDate" id="applicantPaymentReceivedDate" type="date" id="Payment" required value="'.$temp.'">
              <input type="hidden" name="userIDToSavePaymentDate" value="'.$_GET["userID"].'">
              <input style="font-weight: bold;white-space: inherit;margin-left: 10px; " name="addPaymentReceivedDate" type="submit" class="btn btn-primary" value="Save Payment Received Date">
            </form>
          </div>
        </div>
      </div> 
    ';

  }else{

    $temp=isset($_POST["applicantPaymentReceivedDate"])?$_POST["applicantPaymentReceivedDate"]:(isset($row["paymentReceivedDate"])?$row["paymentReceivedDate"]:"");

    echo '
       <div class="row" style="margin: 10px;">
        <div class="card" style="padding: 20px; margin-bottom: 10px">
          <div class="form-group">
              <label for="Payment">Payment Received On </label><br>
              <input disabled name="applicantPaymentReceivedDate" id="applicantPaymentReceivedDate" type="date" id="Payment" required value="'.$temp.'">
              <input type="hidden" name="userIDToSavePaymentDate" value="'.$_GET["userID"].'">
          </div>
        </div>
      </div> 
    ';

  }

?>


<div class="row" style="margin: 10px;">
  <div class="card" style="padding: 20px; margin-bottom: 10px">

    <u><h4>Payment Image</h4></u>

    <div class="form-group">
      <label for="exampleInputEmail1">UTR Number</label>
      <input <?php echo $isDisabledTextPayment; ?> name="applicantUTRNumber" type="text" class="form-control" placeholder="Enter UTR Number Here" autocomplete="off" required value="<?php echo isset($_POST['applicantUTRNumber'])?$_POST['applicantUTRNumber']:(isset($row["utrNumber"])?$row["utrNumber"]:""); ?>">
      <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
    </div>
    
    <img id="ddphoto_src_img" src="<?php echo $ddPhotoSourceUrl ?>" class="img-fluid" alt="Responsive image" style="max-height:500px;">
    
    <?php if($disableEditingPayment!="disabled") : ?>
      <img id="ddphoto_comprsd_img"  style="width:100%;display: none;">
      <label class="btn btn-primary" style="margin-top: 10px;">
        Change Image<input name="applicantDDPhoto" id="applicantDDPhoto" type="file" class="uploadFile img" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;" accept=".jpg,.png,.gif,.jpeg">
      </label>
      <div id="messageBoxDDPhoto"></div>
      <input id="submitDDPhotoButton" type="submit" class="btn btn-primary" value="Save Image" style="display: none;">
    <?php endif; ?>
  </div>
</div>


<?php if($disableEditingPayment!="disabled") : ?>
<div class="row" style="margin: 10px;">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="card" style="padding: 10px; margin-bottom: 30px">
        <form style="padding: 10px" method="POST">
          <div class="row" style="margin: 10px;">
            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="col-lg-12" style="text-align: center;">
                  <input type="hidden" name="userIDToRejectDDPhoto" value="<?php echo $_GET["userID"];?>">
                  <input style="font-weight: bold;white-space: inherit;" name="rejectDDPhoto" type="submit" class="btn btn-danger" value="Reject Payment Photo">
              </div>
            </div>
          </div>
        </form>  
      </div>
    </div>
</div>
<?php endif; ?>


<script type="text/javascript">
  
  // PHOTO COMPRESSION===================================================
  var photo_output_format = null;
  var photo_file_name = null;

  function readFileDDPhoto(evt) {

    var ddphoto_file = evt.target.files[0];
    var ddphoto_reader = new FileReader();

    ddphoto_reader.onload = function(event) {
      var ddphoto_src_img = document.getElementById("ddphoto_src_img");
      ddphoto_src_img.src = event.target.result;

      var ddphoto_comprsd_img = document.getElementById("ddphoto_comprsd_img");
      
      ddphoto_src_img.onload = function(){
          // console.log("Image loaded");
          ddphoto_output_format = ddphoto_file.name.split(".").pop();
          var quality = 30;
          ddphoto_comprsd_img.src = jic.compress(ddphoto_src_img,quality,ddphoto_output_format).src;
          setTimeout(function() {
            $("#submitDDPhotoButton").css("display","block");
          }, 2000);
          
      }
    };

    ddphoto_file_name = ddphoto_file.name;

    ddphoto_reader.readAsDataURL(ddphoto_file);
    
    return false;
  }
  document.getElementById("applicantDDPhoto").addEventListener("change", readFileDDPhoto, false);


  // UPLOAD IMAGE PHOTO ==============================================
  $("#submitDDPhotoButton").click(function() {

    var ddphoto_comprsd_img = document.getElementById("ddphoto_comprsd_img");

    var successCallback= function(response){
      // console.log("image uploaded successfully! :)");
      $("#messageBoxDDPhoto").html("<div class=\"alert alert-success\" role=\"alert\">Image added successfully!</div>");
    }

    var errorCallback= function(response){
      // console.log("image Filed to upload! :)");
      $("#messageBoxDDPhoto").html("<div class=\"alert alert-danger\" role=\"alert\">Failed to add image!</div>");
    }
    
    // console.log("process start upload ...");
    jic.upload(ddphoto_comprsd_img, "applicantDDPhoto", ddphoto_file_name,"./?userID=<?php echo $_GET['userID']?>",successCallback,errorCallback);
    
  });

</script>