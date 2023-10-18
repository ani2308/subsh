<!-- <h1>sdsad</h1> -->
<?php 
  
  if (isset($disableEditingReferrer) AND $disableEditingReferrer=="disabled"){
    $isDisabledTextReferrer=" disabled";
  }else{
    $isDisabledTextReferrer=" ";

    if(!mysqli_connect_error()){
      if(array_key_exists("userIDToChangeReferrerDetails", $_POST) AND $_POST["changeReferrerDetails"]){
        if(
          array_key_exists("applicantReferrerName", $_POST) AND !$_POST['applicantReferrerName']=="" AND
          array_key_exists("applicantReferrerFolioNumber", $_POST) AND !$_POST['applicantReferrerFolioNumber']=="" AND
          array_key_exists("applicantReferrerMobileNumber", $_POST) AND !$_POST['applicantReferrerMobileNumber']==""
          ){

          $queryToChangeReferrerDetails="UPDATE ".$USERTABLENAME." SET `formStatus3`=1, `referrerName`='{$_POST['applicantReferrerName']}',`referrerFolioNumber`='{$_POST['applicantReferrerFolioNumber']}',`referrerMobileNumber`='{$_POST['applicantReferrerMobileNumber']}' WHERE `userID`=".$_POST['userIDToChangeReferrerDetails'];

            if(mysqli_query($link,$queryToChangeReferrerDetails)){

            }else{
              //echo "error!";
          }
        }
      }
    }
    
  }

?>


<div class="row" style="margin: 10px;">
  <div class="col-lg-12 col-md-12 col-sm-12">
    <div class="card" style="padding: 10px; margin-bottom: 30px">

      <form style="padding: 10px" method="POST">

        <u><h4>Referrer Details</h4></u>

        <div class="form-group">
          <label for="exampleInputEmail1">Subhiksha Referrer's Name</label>
          <input <?php echo $isDisabledTextReferrer; ?> name="applicantReferrerName" type="text" class="form-control" placeholder="Enter Subhiksha Referrer's Name Here" autocomplete="off" required value="<?php echo isset($_POST['applicantReferrerName'])?$_POST['applicantReferrerName']:(isset($row["referrerName"])?$row["referrerName"]:""); ?>">
          
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Referrer's Subhiksha Folio Number</label>
          <input <?php echo $isDisabledTextReferrer; ?> name="applicantReferrerFolioNumber" type="text" class="form-control" placeholder="Enter Referrer's Subhiksha Folio Number Here" autocomplete="off" required value="<?php echo isset($_POST['applicantReferrerFolioNumber'])?$_POST['applicantReferrerFolioNumber']:(isset($row["referrerFolioNumber"])?$row["referrerFolioNumber"]:""); ?>">
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Referrer's Mobile Number</label>
          <div id="messageBoxDivMobileNumber">
              
          </div>
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">+91</div>
            </div>
            <input <?php echo $isDisabledTextReferrer; ?> name="applicantReferrerMobileNumber" id="applicantReferrerMobileNumber" type="number" class="form-control" placeholder="Enter Referrer's Mobile Number Here" autocomplete="off" required value="<?php echo isset($_POST['applicantReferrerMobileNumber'])?$_POST['applicantReferrerMobileNumber']:(isset($row["referrerMobileNumber"])?$row["referrerMobileNumber"]:""); ?>">
          </div>
        </div>


        <?php 
        if($disableEditingReferrer!=" disabled"){

          echo '
            <div class="row" style="margin: 10px;">
              <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="col-lg-12" style="text-align: center;">
                      <input type="hidden" name="userIDToChangeReferrerDetails" value="'.$_GET["userID"].'">
                      <input style="font-weight: bold;white-space: inherit;" name="changeReferrerDetails" type="submit" class="btn btn-primary" value="Save Changes in Referrer Details">
                  </div>
              </div>
            </div>
          ';

        }
      ?>
        
      </form>
      
    </div>
  </div>
</div>