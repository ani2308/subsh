<!-- <h1>sdsad</h1> -->
<?php 
  
  if (isset($disableEditing) AND $disableEditing=="disabled"){
    $isDisbaledText=" disabled";
  }else{
    $isDisbaledText=" ";

    if(!mysqli_connect_error()){
      if(array_key_exists("userIDToChangePersonalInfo", $_POST) AND $_POST["changePersonalInfo"]){

        if(
        array_key_exists("applicantName", $_POST) AND !$_POST['applicantName']=="" AND
        array_key_exists("applicantFHName", $_POST) AND !$_POST['applicantFHName']=="" AND
        array_key_exists("applicantDOB", $_POST) AND !$_POST['applicantDOB']=="" AND
        array_key_exists("applicantAddress", $_POST) AND !$_POST['applicantAddress']=="" AND
        array_key_exists("applicantPinCode", $_POST) AND !$_POST['applicantPinCode']=="" AND
        // array_key_exists("applicantPreviousAddress", $_POST) AND
        array_key_exists("applicantWhatsAppNumber", $_POST) AND !$_POST['applicantWhatsAppNumber']=="" AND
        array_key_exists("applicantAadharNumber", $_POST) AND !$_POST['applicantAadharNumber']=="" AND
        array_key_exists("applicantIsMale", $_POST) AND 
        array_key_exists("applicantReligion", $_POST) AND !$_POST['applicantReligion']=="" AND
        array_key_exists("applicantCaste", $_POST) AND !$_POST['applicantCaste']=="" AND
        array_key_exists("applicantNomineeName", $_POST) AND !$_POST['applicantNomineeName']=="" AND
        array_key_exists("applicantNomineeAge", $_POST) AND !$_POST['applicantNomineeAge']=="" AND
        array_key_exists("applicantNomineeRelation", $_POST) AND !$_POST['applicantNomineeRelation']=="" AND
        array_key_exists("applicantIsOrganic", $_POST) AND !$_POST['applicantIsOrganic']==""
        ){
          //ALL DATA IS ENTERED & IS NOT EMPTY

          if($_POST['applicantIsOrganic']=="true"){$intApplicantIsOrganic=1;}else{$intApplicantIsOrganic=0;}
          if($_POST['applicantIsMale']=="1"){$intApplicantIsMale=1;}
          elseif($_POST['applicantIsMale']=="0"){$intApplicantIsMale=0;}
          else{$intApplicantIsMale=2;}

          $queryToUpdatePersonalInfo="UPDATE `".$USERTABLENAME."` SET `formStatus1`=1, `name`='{$_POST['applicantName']}',`fatherHusbandName`='{$_POST['applicantFHName']}',`dob`='{$_POST['applicantDOB']}',`address`='{$_POST['applicantAddress']}',`pinCode`='{$_POST['applicantPinCode']}',`whatsappNumber`='{$_POST['applicantWhatsAppNumber']}',`aadharNumber`='{$_POST['applicantAadharNumber']}',`isMale`={$intApplicantIsMale},`religion`='{$_POST['applicantReligion']}',`caste`='{$_POST['applicantCaste']}',`nomineeName`='{$_POST['applicantNomineeName']}',`nomineeAge`='{$_POST['applicantNomineeAge']}',`nomineeRelationship`='{$_POST['applicantNomineeRelation']}',`isOrganicFarmer`={$intApplicantIsOrganic} WHERE `userID`=".$_POST["userIDToChangePersonalInfo"];

          if(mysqli_query($link,$queryToUpdatePersonalInfo)){
                // echo "Success!";
                // header("Location: ../");
                //exit;
            }else{
                // echo "Error updating!";
            }
        }

      }
    }
    
  }

?>

<div class="row" style="margin: 10px;">
  <div class="col-lg-12 col-md-12 col-sm-12">
    <div class="card" style="padding: 10px; margin-bottom: 30px">

      <form style="padding: 10px" method="POST" onsubmit="return validatePersonalInfoForm()">

        <u><h4>Personal Information</h4></u>

        <div class="form-group">
          <label for="exampleInputEmail1">Full Name</label>
          <input <?php echo $isDisbaledText; ?> name="applicantName" type="text" class="form-control" placeholder="Enter Full Name Here" autocomplete="off" required value="<?php echo isset($_POST['applicantName'])?$_POST['applicantName']:(isset($row["name"])?$row["name"]:""); ?>">
          <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Father's/Husband's Name</label>
          <input <?php echo $isDisbaledText; ?> name="applicantFHName" type="text" class="form-control" placeholder="Enter Father's/Husband's Name Here" autocomplete="off" required value="<?php echo isset($_POST['applicantFHName'])?$_POST['applicantFHName']:(isset($row["fatherHusbandName"])?$row["fatherHusbandName"]:""); ?>">
        </div>

        <div class="form-group">
          <label for="birthday">Date of Birth</label><br>
          <div id="messageBoxDOB">
            
          </div>
          <input <?php echo $isDisbaledText; ?> name="applicantDOB" id="applicantDOB" type="date" id="birthday" required value="<?php echo isset($_POST['applicantDOB'])?$_POST['applicantDOB']:(isset($row["dob"])?$row["dob"]:""); ?>">

        </div>

        <div class="form-group">
          <label>Address</label>
          <input <?php echo $isDisbaledText; ?> name="applicantAddress" type="text" class="form-control" placeholder="Enter Address Here" autocomplete="off" required value="<?php echo isset($_POST['applicantAddress'])?$_POST['applicantAddress']:(isset($row["address"])?$row["address"]:""); ?>">
        </div>

        <div class="form-group">
          <label>PIN Code</label>
          <input <?php echo $isDisbaledText; ?> name="applicantPinCode" type="number" class="form-control" placeholder="Enter PIN Code Here" autocomplete="off" required value="<?php echo isset($_POST['applicantPinCode'])?$_POST['applicantPinCode']:(isset($row["pinCode"])?$row["pinCode"]:""); ?>">
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">State Code</label>
          <div class="input-group">
            <input <?php echo $isDisbaledText; ?> type="text" class="form-control" placeholder="" disabled value="<?php echo isset($_POST['applicantState'])?$_POST['applicantState']:(isset($row["state_code"])?$row["state_code"]:""); ?>">
          </div>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">District Code</label>
          <div class="input-group">
            <input <?php echo $isDisbaledText; ?> type="text" class="form-control" placeholder="" disabled value="<?php echo isset($_POST['applicantDistrict'])?$_POST['applicantDistrict']:(isset($row["dist_code"])?$row["dist_code"]:""); ?>">
          </div>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Taluka Code</label>
          <div class="input-group">
            <input <?php echo $isDisbaledText; ?> type="text" class="form-control" placeholder="" disabled value="<?php echo isset($_POST['applicantTaluka'])?$_POST['applicantTaluka']:(isset($row["taluka_code"])?$row["taluka_code"]:""); ?>">
          </div>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">WhatsApp Number</label>
            <div id="messageBoxDivMobileNumber">
              
            </div>
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">+91</div>
            </div>
            <input <?php echo $isDisbaledText; ?> name="applicantWhatsAppNumber" id="applicantWhatsAppNumber" type="number" class="form-control" placeholder="Enter WhatsApp Number Here" autocomplete="off" required value="<?php echo isset($_POST['applicantWhatsAppNumber'])?$_POST['applicantWhatsAppNumber']:(isset($row["whatsappNumber"])?$row["whatsappNumber"]:""); ?>">
          </div>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Aadhar Number</label>
            <div id="messageBoxDivMobileNumber">
            </div>
            <div class="input-group">
              <input <?php echo $isDisbaledText; ?> name="applicantAadharNumber" id="applicantAadharNumber" type="number" class="form-control" placeholder="Enter Aadhar Number Here" autocomplete="off" required value="<?php echo isset($_POST['applicantAadharNumber'])?$_POST['applicantAadharNumber']:(isset($row["aadharNumber"])?$row["aadharNumber"]:""); ?>">
            </div>
        </div>

        <div class="form-group">
          <label>Gender</label><br>
          <div class="form-check form-check-inline">
            <input <?php echo $isDisbaledText; ?> name="applicantIsMale" class="form-check-input" type="radio" id="inlineRadio3" value="1"
              <?php 
              if(isset($_POST['applicantIsMale'])){
                if($_POST['applicantIsMale']=="1"){
                    echo "checked";
                }
              }else{
                if(isset($row["isMale"])){
                  if($row["isMale"]==1 OR $row["isMale"]==""){
                    echo "checked";
                  }
                }else{
                  echo "checked";
                }
              }
              
              ?>
            >
            <label class="form-check-label" for="inlineRadio3">Male</label>
          </div>
          <div class="form-check form-check-inline">
            <input <?php echo $isDisbaledText; ?> name="applicantIsMale" class="form-check-input" type="radio" id="inlineRadio4" value="0" 
            <?php 
              if(isset($_POST['applicantIsMale'])){
                if($_POST['applicantIsMale']=="0"){
                    echo "checked";
                }
              }else{
                if(isset($row["isMale"])){
                  if($row["isMale"]==0 ){
                    echo "checked";
                  }
                }
              }
              
            ?>
            >
            <label class="form-check-label" for="inlineRadio4">Female</label>
          </div>
          <div class="form-check form-check-inline">
            <input <?php echo $isDisbaledText; ?> name="applicantIsMale" class="form-check-input" type="radio" id="inlineRadio5" value="2" 
            <?php 
              if(isset($_POST['applicantIsMale'])){
                if($_POST['applicantIsMale']=="2"){
                    echo "checked";
                }
              }else{
                if(isset($row["isMale"])){
                  if($row["isMale"]==2 ){
                    echo "checked";
                  }
                }
              }
              
            ?>
            >
            <label class="form-check-label" for="inlineRadio5">Transgender</label>
          </div>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Contact Number</label>
          <div class="input-group">
            <input type="text" class="form-control" placeholder="" disabled value="<?php echo isset($row["whatsappNumber"])?$row["contactNumber"]:""; ?>">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label>Religion</label>
            <select  <?php echo $isDisbaledText; ?> name="applicantReligion" id="inputStates" class="form-control" required>
              <?php 
                if(isset($_POST['applicantReligion']) AND $_POST['applicantReligion']!=""){
                  $religionValue = $_POST['applicantReligion'];
                  echo "<option selected value=\"$religionValue\">".$religionValue."</option>";
                }else{
                  if(isset($row["religion"]) AND $row["religion"]!=""){
                    $religionValue = $row["religion"];
                    echo "<option selected value=\"$religionValue\">".$religionValue."</option>";
                  }else{
                    echo '<option value="" selected disabled="disabled">Please Select</option>';
                  }
                }
              ?>
              <option value="Hindu">Hindu</option>
              <option value="Muslim">Muslim</option>
              <option value="Christian">Christian</option>
              <option value="Other">Other</option>

            </select>
          </div>

          <div class="form-group col-md-6">
              <label>Caste</label>
              <select <?php echo $isDisbaledText; ?> name="applicantCaste" id="inputStatess" class="form-control" required>
                <?php 
                  if(isset($_POST["applicantCaste"]) AND $_POST["applicantCaste"]!=""){
                    $casteValue = $_POST["applicantCaste"];
                    echo "<option selected value=\"$casteValue\">".$casteValue."</option>";
                  }else{
                    if(isset($row["caste"]) AND $row["caste"]!=""){
                      $relationValue = $row["caste"];
                      echo "<option selected value=\"$relationValue\">".$relationValue."</option>";
                    }else{
                      echo '<option value="" selected disabled="disabled">Please Select</option>';
                    }
                  }
                ?>
                <option value="General">General</option>
                <option value="OBC">OBC</option>
                <option value="SC">SC</option>
                <option value="ST">ST</option>
                <option value="Minority">Minority</option>
              </select>
            </div>
        </div>
        
        <div class="form-group">
          <label>Nominee Name</label>
          <input <?php echo $isDisbaledText; ?> name="applicantNomineeName" type="text" class="form-control" placeholder="Enter Nominee Name Here" autocomplete="off" required value="<?php echo isset($_POST['applicantNomineeName'])?$_POST['applicantNomineeName']:(isset($row["nomineeName"])?$row["nomineeName"]:""); ?>">
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label>Nominee Age</label>
            <input <?php echo $isDisbaledText; ?> name="applicantNomineeAge" type="number" class="form-control" placeholder="Enter Nominee Name Here" autocomplete="off" min="1" required  value="<?php echo isset($_POST['applicantNomineeAge'])?$_POST['applicantNomineeAge']:(isset($row["nomineeAge"])?$row["nomineeAge"]:""); ?>">
          </div>
          <div class="form-group col-md-6">
            <label>Nominee Relationship</label>
            <select <?php echo $isDisbaledText; ?> name="applicantNomineeRelation" id="inputState" class="form-control" required>
              <?php 
                if(isset($_POST['applicantNomineeRelation']) AND $_POST['applicantNomineeRelation']!=""){
                  $relationValue = $_POST['applicantNomineeRelation'];
                  echo "<option selected value=\"$relationValue\">".$relationValue."</option>";
                }else{
                  if(isset($row["nomineeRelationship"]) AND $row["nomineeRelationship"]!=""){
                    $relationValue = $row["nomineeRelationship"];
                    echo "<option selected value=\"$relationValue\">".$relationValue."</option>";
                  }else{
                    echo '<option value="" selected disabled="disabled">Please Select</option>';
                  }
                }
              ?>
              <option value="Husband">Husband</option>
              <option value="Wife">Wife</option>
              <option value="Father">Father</option>
              <option value="Mother">Mother</option>
              <option value="Son">Son</option>
              <option value="Daughter">Daughter</option>

              <option value="Husband">Husband</option>
              <option value="Wife">Wife</option>
              <option value="Father">Father</option>
              <option value="Mother">Mother</option>
              <option value="Son">Son</option>
              <option value="Daughter">Daughter</option>
              <option value="Daughter in Law">Daughter in Law</option>
              <option value="Son in Law">Son in Law</option>
              <option value="Mother in Law">Mother in Law</option>
              <option value="Father in Law">Father in Law</option>
              <option value="Grandfather">Grandfather</option>
              <option value="Grandmother">Grandmother</option>
              <option value="Niece">Niece</option>
              <option value="Nephew">Nephew</option>
              <option value="Uncle">Uncle</option>
              <option value="Aunt">Aunt</option>
              <option value="Friend">Friend</option>
              <option value="Grand son">Grand son</option>
              <option value="Grand daughter">Grand daughter</option>
              <option value="Brothers Daughter">Brothers Daughter</option>
              <option value="Brothers Son">Brothers Son</option>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label>I belong to an Agricultural family</label><br>
          <div class="form-check form-check-inline">
            <input <?php echo $isDisbaledText; ?> name="applicantIsOrganic" class="form-check-input" type="radio" id="inlineRadio1" value="true"
            <?php 
            if(isset($_POST['applicantIsOrganic'])){
              if($_POST['applicantIsOrganic']=="true"){
                  echo "checked";
              }
            }else{
              if(isset($row["isOrganicFarmer"])){
                if($row["isOrganicFarmer"]==1 OR $row["isOrganicFarmer"]==""){
                  echo "checked";
                }
              }else{
                echo "checked";
              }
            }
            
            ?>
            >
            <label class="form-check-label" for="inlineRadio1">Yes</label>
          </div>
        <div class="form-check form-check-inline">
          <input <?php echo $isDisbaledText; ?> name="applicantIsOrganic" class="form-check-input" type="radio" id="inlineRadio2" value="false" 
          <?php 
            if(isset($_POST['applicantIsOrganic'])){
              if($_POST['applicantIsOrganic']=="false"){
                  echo "checked";
              }
            }else{
              if(isset($row["isOrganicFarmer"])){
                if($row["isOrganicFarmer"]==0 ){
                  echo "checked";
                }
              }
            }
            
          ?>
          >
          <label class="form-check-label" for="inlineRadio2">No</label>
        </div>
      </div>

      <?php 
        if($disableEditing!=" disabled"){

          echo '
            <div class="row" >
              <div class="col-lg-12 col-md-12 col-sm-12">
                  <form method="POST">
                      <div  style="text-align: center;">
                          <input type="hidden" name="userIDToChangePersonalInfo" value="'.$_GET["userID"].'">
                          <input style="font-weight: bold;white-space: inherit;" name="changePersonalInfo" type="submit" class="btn btn-primary" value="Save Changes in Personal Information">

                      </div>
                  </form>
              </div>
            </div>
          ';

        }
      ?>
      
    </div>
  </div>
</div>
