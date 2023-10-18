<!-- <h1>sdsad</h1> -->
<?php 
  
  if (isset($disableEditingPhotoAadhar) AND $disableEditingPhotoAadhar=="disabled"){
    $isDisabledTextPhotoAadhar=" disabled";
  }else{
    $isDisabledTextPhotoAadhar=" ";

    if(!mysqli_connect_error()){
      if(array_key_exists("userIDToRejectPhotoAadhar", $_POST) AND $_POST["rejectPhotoAadhar"]){

        $queryToChangeReferrerDetails="UPDATE ".$USERTABLENAME." SET `formStatus2`=-1 WHERE `userID`=".$_POST['userIDToRejectPhotoAadhar'];

          if(mysqli_query($link,$queryToChangeReferrerDetails)){

          }else{
            //echo "error!";
        }

      }
    }
    
  }


  if(!mysqli_connect_error()){

      $directoryName=md5($row['contactNumber']."subhiksha");
      $target_dir = "../../../../data/".$directoryName."/";

      $photoFileName=md5($row['contactNumber']."photo");
      $photoFilePath = glob ($target_dir.$photoFileName.".*")[0]; 
      $photoFilePathExploded=explode('.', $photoFilePath);
      $photoExtension = end($photoFilePathExploded);
      $photoSourceUrl=$target_dir.$photoFileName.".".$photoExtension;

      $aadharFrontFileName=md5($row['contactNumber']."aadharfront");
      $aadharFrontFilePath = glob ($target_dir.$aadharFrontFileName.".*")[0];
      $aadharFrontFilePathExploded=explode('.', $aadharFrontFilePath);
      $aadharFrontExtension = end($aadharFrontFilePathExploded);
      $aadharFrontSourceUrl=$target_dir.$aadharFrontFileName.".".$aadharFrontExtension;

      $aadharBackFileName=md5($row['contactNumber']."aadharback");
      $aadharBackFilePath = glob ($target_dir.$aadharBackFileName.".*")[0];
      $aadharBackFilePathExploded=explode('.', $aadharBackFilePath);
      $aadharBackExtension = end($aadharBackFilePathExploded);
      $aadharBackSourceUrl=$target_dir.$aadharBackFileName.".".$aadharBackExtension;

      $ddPhotoFileName=md5($row['contactNumber']."ddphoto");
      $ddPhotoFilePath = glob ($target_dir.$ddPhotoFileName.".*")[0];
      $ddPhotoFilePathExploded=explode('.', $ddPhotoFilePath);
      $ddPhotoExtension = end($ddPhotoFilePathExploded);
      $ddPhotoSourceUrl=$target_dir.$ddPhotoFileName.".".$ddPhotoExtension;

  }


  if(!mysqli_connect_error() AND $disableEditingPhotoAadhar!="disabled"){

  //CREATE DIRECTORY
    $directoryName=md5($row['contactNumber']."subhiksha");

    $dataDirectoryPath=dirname(__DIR__, 3);

    if (!file_exists($dataDirectoryPath.'/data/'.$directoryName)) {
        mkdir($dataDirectoryPath.'/data/'.$directoryName, 0777, true);
    }

    $target_dir = $dataDirectoryPath."/data/".$directoryName."/";


    if(isset($_FILES["applicantPhoto"]) AND $_FILES["applicantPhoto"]){

      unlink($photoSourceUrl);

      $uploadedFilename = $_FILES['applicantPhoto']['name'];
      $extension = pathinfo($uploadedFilename, PATHINFO_EXTENSION);

      $fileName=md5($row['contactNumber']."photo");

      $target_file = $target_dir .$fileName.".".$extension;

      if(move_uploaded_file($_FILES["applicantPhoto"]["tmp_name"], $target_file)){

      }else {
        //echo "Sorry, there was an error uploading your photo.";
      }

    }

    
    if(isset($_FILES["applicantAadharFront"]) AND $_FILES["applicantAadharFront"]){

      unlink($aadharFrontSourceUrl);

      $uploadedFilename = $_FILES['applicantAadharFront']['name'];
      $extension = pathinfo($uploadedFilename, PATHINFO_EXTENSION);

      $fileName=md5($row['contactNumber']."aadharfront");

      $target_file = $target_dir .$fileName.".".$extension;

      if(move_uploaded_file($_FILES["applicantAadharFront"]["tmp_name"], $target_file)){

      }else {
        //echo "Sorry, there was an error uploading your photo.";
      }

    }


    if(isset($_FILES["applicantAadharBack"]) AND $_FILES["applicantAadharBack"]){

      unlink($aadharBackSourceUrl);

      $uploadedFilename = $_FILES['applicantAadharBack']['name'];
      $extension = pathinfo($uploadedFilename, PATHINFO_EXTENSION);

      $fileName=md5($row['contactNumber']."aadharback");

      $target_file = $target_dir .$fileName.".".$extension;

      if(move_uploaded_file($_FILES["applicantAadharBack"]["tmp_name"], $target_file)){

      }else {
        //echo "Sorry, there was an error uploading your photo.";
      }

    }

}

?>

<div class="row" style="margin: 10px;">
  <div class="card" style="padding: 20px; margin-bottom: 10px">
    <u><h4>Photograph</h4></u>
    <img id="photo_src_img" src="<?php echo $photoSourceUrl ?>" class="img-fluid src_img" alt="Image not available" style="max-height:500px;">

    <?php if($disableEditingPhotoAadhar!="disabled") : ?>
      <img id="photo_comprsd_img"  style="width:100%;display: none;">
      <label class="btn btn-primary" style="margin-top: 10px;">
        Change Image<input name="applicantPhoto" id="applicantPhoto" type="file" class="uploadFile img" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;" accept=".jpg,.png,.gif,.jpeg">
      </label>
      <div id="messageBoxPhoto"></div>
      <input id="submitPhotoButton" type="submit" class="btn btn-primary" value="Save Image" style="display: none;">
    <?php endif; ?>
  </div>
</div>


<div class="row" style="margin: 10px;">
  <div class="card" style="padding: 20px; margin-bottom: 10px">
    <u><h4>Aadhar Front</h4></u>
    <img id="aadharf_src_img" src="<?php echo $aadharFrontSourceUrl ?>" class="img-fluid" alt="Image not available" style="max-height:500px;">
    
    <?php if($disableEditingPhotoAadhar!="disabled") : ?>
      <img id="aadharf_comprsd_img"  style="width:100%;display: none;">
      <label class="btn btn-primary" style="margin-top: 10px;">
        Change Image<input name="applicantAadharFront" id="applicantAadharFront" type="file" class="uploadFile img" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;" accept=".jpg,.png,.gif,.jpeg">
      </label>
      <div id="messageBoxAadharf"></div>
      <input id="submitAadharfButton" type="submit" class="btn btn-primary" value="Save Image" style="display: none;">
    <?php endif; ?>
  </div>
</div>


<div class="row" style="margin: 10px;">
  <div class="card" style="padding: 20px; margin-bottom: 10px">
    <u><h4>Aadhar Back</h4></u>
    <img id="aadharb_src_img" src="<?php echo $aadharBackSourceUrl ?>" class="img-fluid" alt="Image not available" style="max-height:500px;">
    
    <?php if($disableEditingPhotoAadhar!="disabled") : ?>
      <img id="aadharb_comprsd_img"  style="width:100%;display: none;">
      <label class="btn btn-primary" style="margin-top: 10px;">
        Change Image<input name="applicantAadharBack" id="applicantAadharBack" type="file" class="uploadFile img" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;" accept=".jpg,.png,.gif,.jpeg">
      </label>
      <div id="messageBoxAadharb"></div>
      <input id="submitAadharbButton" type="submit" class="btn btn-primary" value="Save Image" style="display: none;">
    <?php endif; ?>
  </div>
</div>

<?php if($disableEditingPhotoAadhar!="disabled") : ?>
<div class="row" style="margin: 10px;">
  <div class="col-lg-12 col-md-12 col-sm-12">
    <div class="card" style="padding: 10px; margin-bottom: 30px">
      <form style="padding: 10px" method="POST">
        <div class="row" style="margin: 10px;">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="col-lg-12" style="text-align: center;">
                <input type="hidden" name="userIDToRejectPhotoAadhar" value="<?php echo $_GET["userID"] ?>">
                <input style="font-weight: bold;white-space: inherit;" name="rejectPhotoAadhar" type="submit" class="btn btn-danger" value="Reject Photo & Aadhar">
            </div>
          </div>
        </div>
      </form>  
    </div>
  </div>
</div>
<?php endif; ?>


<?php if($disableEditingPhotoAadhar!="disabled") : ?>

<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script type="text/javascript">
  // JIC
  var jic = {
    compress: function(source_img_obj, quality, output_format){
         
       var mime_type;
       if(output_format==="png"){
          mime_type = "image/png";
       } else if(output_format==="webp") {
          mime_type = "image/webp";
       } else {
          mime_type = "image/jpeg";
       }

       var cvs = document.createElement('canvas');
       cvs.width = source_img_obj.naturalWidth;
       cvs.height = source_img_obj.naturalHeight;
       var ctx = cvs.getContext("2d").drawImage(source_img_obj, 0, 0);
       var newImageData = cvs.toDataURL(mime_type, quality/100);
       var result_image_obj = new Image();
       result_image_obj.src = newImageData;
       return result_image_obj;
    },

    upload: function(photo_comprsd_img, photo_name, photo_file_name, upload_url, successCallback, errorCallback){

        //ADD sendAsBinary compatibilty to older browsers
        if (XMLHttpRequest.prototype.sendAsBinary === undefined) {
            XMLHttpRequest.prototype.sendAsBinary = function(string) {
                var bytes = Array.prototype.map.call(string, function(c) {
                    return c.charCodeAt(0) & 0xff;
                });
                this.send(new Uint8Array(bytes).buffer);
            };
        }

        var photo_type;
        if(photo_file_name.substr(-4).toLowerCase()===".png"){
            photo_type = "image/png";
        } else if(photo_file_name.substr(-5).toLowerCase()===".webp") {
            photo_type = "image/webp";
        } else {
            photo_type = "image/jpeg";
        }

        var photo_data = photo_comprsd_img.src;
        photo_data = photo_data.replace('data:' + photo_type + ';base64,', '');
        
        var xhr = new XMLHttpRequest();
        xhr.open('POST', upload_url, true);
        var boundary = 'someboundary';

        xhr.setRequestHeader('Content-Type', 'multipart/form-data; boundary=' + boundary);


        var fdImg1=['--' + boundary, 'Content-Disposition: form-data; name="' + photo_name + '"; filename="' + photo_file_name + '"', 'Content-Type: ' + photo_type, '', atob(photo_data),'--' + boundary+ '--'];

        var fdMerged = [];
        fdMerged.push.apply(fdMerged, fdImg1);

        var formData=fdMerged.join('\r\n');
  
        xhr.sendAsBinary(formData);
        
        xhr.onreadystatechange = function() {
          if (this.readyState == 4){
            if (this.status == 200) {
              successCallback(this.responseText);
            }else if (this.status >= 400) {
              if (errorCallback &&  errorCallback instanceof Function) {
                errorCallback(this.responseText);
              }
            }else{
              if (errorCallback &&  errorCallback instanceof Function) {
                errorCallback(this.responseText);
              }
            }
          }
        };

    }
  };

  
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
            uploadFile.parent().siblings(".src_img").attr("src", this.result);
        };
      }
    });
  });

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
          setTimeout(function() {
            $("#submitPhotoButton").css("display","block");
          }, 2000);
          
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
          setTimeout(function() {
            $("#submitAadharfButton").css("display","block");
          }, 2000);
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
          setTimeout(function() {
            $("#submitAadharbButton").css("display","block");
          }, 2000);
      }
    };

    aadharb_file_name = aadharb_file.name;

    aadharb_reader.readAsDataURL(aadharb_file);
    
    return false;
  }
  document.getElementById("applicantAadharBack").addEventListener("change", readFileAadharb, false);



  // UPLOAD IMAGE PHOTO ==============================================
  $("#submitPhotoButton").click(function() {

    var photo_comprsd_img = document.getElementById("photo_comprsd_img");

    var successCallback= function(response){
      // console.log("image uploaded successfully! :)");
      $("#messageBoxPhoto").html("<div class=\"alert alert-success\" role=\"alert\">Image added successfully!</div>");
    }

    var errorCallback= function(response){
      // console.log("image Filed to upload! :)");
      $("#messageBoxPhoto").html("<div class=\"alert alert-danger\" role=\"alert\">Failed to add image!</div>");
    }
    
    // console.log("process start upload ...");
    jic.upload(photo_comprsd_img, "applicantPhoto", photo_file_name,"./?userID=<?php echo $_GET['userID']?>",successCallback,errorCallback);
    
  });

  // UPLOAD IMAGE AADHAR FRONT ==============================================
  $("#submitAadharfButton").click(function() {

    var aadharf_comprsd_img = document.getElementById("aadharf_comprsd_img");

    var successCallback= function(response){
      // console.log("image uploaded successfully! :)");
      $("#messageBoxAadharf").html("<div class=\"alert alert-success\" role=\"alert\">Image added successfully!</div>");
    }

    var errorCallback= function(response){
      // console.log("image Filed to upload! :)");
      $("#messageBoxAadharf").html("<div class=\"alert alert-danger\" role=\"alert\">Failed to add image!</div>");
    }
    
    // console.log("process start upload ...");
    jic.upload(aadharf_comprsd_img, "applicantAadharFront", aadharf_file_name,"./?userID=<?php echo $_GET['userID']?>",successCallback,errorCallback);
    
  });

  // UPLOAD IMAGE PHOTO ==============================================
  $("#submitAadharbButton").click(function() {

    var aadharb_comprsd_img = document.getElementById("aadharb_comprsd_img");

    var successCallback= function(response){
      // console.log("image uploaded successfully! :)");
      $("#messageBoxAadharb").html("<div class=\"alert alert-success\" role=\"alert\">Image added successfully!</div>");
    }

    var errorCallback= function(response){
      // console.log("image Filed to upload! :)");
      $("#messageBoxAadharb").html("<div class=\"alert alert-danger\" role=\"alert\">Failed to add image!</div>");
    }
    
    // console.log("process start upload ...");
    jic.upload(aadharb_comprsd_img, "applicantAadharBack", aadharb_file_name,"./?userID=<?php echo $_GET['userID']?>",successCallback,errorCallback);
    
  });

</script>

<?php endif; ?>