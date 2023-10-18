<?php

session_start();



if(isset($_SESSION['formStatus1'])){
  if($_SESSION['formStatus1']==1){
    //FORM 1 DONE
    header("Location: ../2"); 
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
    $_SESSION["applicantName"]=isset($_POST["applicantName"]) ? $_POST["applicantName"] : "";
    $_SESSION["applicantFHName"]=isset($_POST["applicantFHName"]) ? $_POST["applicantFHName"] : "";
    $_SESSION["applicantDOB"]=isset($_POST["applicantDOB"]) ? $_POST["applicantDOB"] : "";
    $_SESSION["applicantAddress"]=isset($_POST["applicantAddress"]) ? $_POST["applicantAddress"] : "";
    $_SESSION["applicantPinCode"]=isset($_POST["applicantPinCode"]) ? $_POST["applicantPinCode"] : "";
    $_SESSION["applicantState"]=isset($_POST["applicantState"]) ? $_POST["applicantState"] : "";
    $_SESSION["applicantDistrict"]=isset($_POST["applicantDistrict"]) ? $_POST["applicantDistrict"] : "";
    $_SESSION["applicantTaluka"]=isset($_POST["applicantTaluka"]) ? $_POST["applicantTaluka"] : "";

    $_SESSION["applicantWhatsAppNumber"]=isset($_POST["applicantWhatsAppNumber"]) ? $_POST["applicantWhatsAppNumber"] : "";
    $_SESSION["applicantAadharNumber"]=isset($_POST["applicantAadharNumber"]) ? $_POST["applicantAadharNumber"] : "";
    $_SESSION["applicantIsMale"]=isset($_POST["applicantIsMale"]) ? $_POST["applicantIsMale"] : "";
    $_SESSION["applicantReligion"]=isset($_POST["applicantReligion"]) ? $_POST["applicantReligion"] : "";
    $_SESSION["applicantCaste"]=isset($_POST["applicantCaste"]) ? $_POST["applicantCaste"] : "";
    $_SESSION["applicantNomineeName"]=isset($_POST["applicantNomineeName"]) ? $_POST["applicantNomineeName"] : "";
    $_SESSION["applicantNomineeAge"]=isset($_POST["applicantNomineeAge"]) ? $_POST["applicantNomineeAge"] : "";
    $_SESSION["applicantNomineeRelation"]=isset($_POST["applicantNomineeRelation"]) ? $_POST["applicantNomineeRelation"] : "";
    $_SESSION["applicantIsOrganic"]=isset($_POST["applicantName"]) ? $_POST["applicantIsOrganic"] : "";
    $_SESSION["UserType"]=0;

    if(
    array_key_exists("applicantName", $_POST) AND !$_POST['applicantName']=="" AND
    array_key_exists("applicantFHName", $_POST) AND !$_POST['applicantFHName']=="" AND
    array_key_exists("applicantDOB", $_POST) AND !$_POST['applicantDOB']=="" AND
    array_key_exists("applicantAddress", $_POST) AND !$_POST['applicantAddress']=="" AND
    array_key_exists("applicantPinCode", $_POST) AND !$_POST['applicantPinCode']=="" AND
    array_key_exists("applicantState", $_POST) AND $_POST['applicantState']!="" AND
    array_key_exists("applicantDistrict", $_POST) AND $_POST['applicantDistrict']!="" AND
    array_key_exists("applicantTaluka", $_POST) AND $_POST['applicantTaluka']!="" AND
    //array_key_exists("applicantPreviousAddress", $_POST) AND
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

      $contactNumberHash=md5($_SESSION['applicantPhoneNumber']);

      if($_POST['applicantIsOrganic']=="true"){$intApplicantIsOrganic=1;}else{$intApplicantIsOrganic=0;}

      if($_POST['applicantIsMale']=="1"){$intApplicantIsMale=1;}
      elseif($_POST['applicantIsMale']=="0"){$intApplicantIsMale=0;}
      else{$intApplicantIsMale=2;}

      $query="INSERT INTO ".$USERTABLENAME." (`formStatus1`,`name`, `fatherHusbandName`, `dob`, `address`,`pinCode`,`state_code`,`dist_code`,`taluka_code`,`contactNumber`,`contactNumberHash`, `whatsappNumber`, `aadharNumber`,`isMale`, `religion`, `caste`, `nomineeName`, `nomineeAge`, `nomineeRelationship`, `isOrganicFarmer`) VALUES (1,'{$_POST['applicantName']}','{$_POST['applicantFHName']}','{$_POST['applicantDOB']}','{$_POST['applicantAddress']}','{$_POST['applicantPinCode']}','{$_POST['applicantState']}','{$_POST['applicantDistrict']}','{$_POST['applicantTaluka']}','{$_SESSION['applicantPhoneNumber']}','{$contactNumberHash}','{$_POST['applicantWhatsAppNumber']}','{$_POST['applicantAadharNumber']}',{$intApplicantIsMale},'{$_POST['applicantReligion']}','{$_POST['applicantCaste']}','{$_POST['applicantNomineeName']}','{$_POST['applicantNomineeAge']}','{$_POST['applicantNomineeRelation']}',{$intApplicantIsOrganic})";

      //echo $query;

      if(mysqli_query($link,$query)){
        // echo "Successfully Added form 1 data to db";
        $_SESSION['formStatus1']=1;

        $queryForGettingUser="SELECT `userID` FROM ".$USERTABLENAME." WHERE `contactNumber`=".$_SESSION['applicantPhoneNumber'];
        $result=mysqli_query($link,$queryForGettingUser);
        $row=mysqli_fetch_array($result);

        $_SESSION['userID']=$row["userID"];

        header("Location: ../2"); 

        exit;


      }else{
        // echo "Error";
        // echo("Error description: " . $link -> error);
      }

    }else{
      // echo "Partial data!";
      // print_r($_POST);
    }

    }


}else{
  //Error connecting to DB
  echo "Error connecting to DB";
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
  

  <div class="row" style="margin-top: 0px" style="width: 100%">
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

          <u><h4><?php echo $PERSONAL_INFO ?></h4></u>

          <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $Full_Name?></label>
            <input name="applicantName" type="text" class="form-control" placeholder="<?php echo $Enter_Full_Name_Here ?>" autocomplete="off" required value="<?php echo isset($_SESSION["applicantName"])?$_SESSION["applicantName"]:""; ?>" >
            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $FATHERHUSBANDNAME ?></label>
            <input name="applicantFHName" type="text" class="form-control" placeholder="<?php echo $ENTERFATHERHUSBANDNAME?>" autocomplete="off" required value="<?php echo isset($_SESSION["applicantFHName"])?$_SESSION["applicantFHName"]:""; ?>" >
          </div>

          <div class="form-group">
            <label for="birthday"><?php echo $DOB ?></label><br>
            <div id="messageBoxDOB">
              
            </div>
            <input name="applicantDOB" id="applicantDOB" type="date" id="birthday" required value="<?php echo isset($_SESSION["applicantDOB"])?$_SESSION["applicantDOB"]:""; ?>">

          </div>

          <div class="form-group">
            <label><?php echo $Address ?></label>
            <input name="applicantAddress" type="text" class="form-control" placeholder="<?php echo $EnterAddress ?>" autocomplete="off" required value="<?php echo isset($_SESSION["applicantAddress"])?$_SESSION["applicantAddress"]:""; ?>">
          </div>

          <div class="form-group">
            <label><?php echo $PinCode ?></label>
            <input name="applicantPinCode" type="number" class="form-control" placeholder="<?php echo $EnterPinCode ?>" autocomplete="off" required value="<?php echo isset($_SESSION["applicantPinCode"])?$_SESSION["applicantPinCode"]:""; ?>">
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label>State</label>
              <select  name="applicantState" id="applicantState" class="form-control" required>
                <?php 
                  if(isset($_SESSION["applicantState"]) AND $_SESSION["applicantState"]!=""){
                    $applicantState = $_SESSION["applicantState"];
                    echo "<option selected value=\"$applicantState\">".$applicantState."</option>";
                  }else{
                    echo '<option value="" selected disabled="disabled">Please Select</option>';
                  }
                ?>
              </select>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label>District</label>
              <select  name="applicantDistrict" id="applicantDistrict" class="form-control" required>
                <?php 
                  if(isset($_SESSION["applicantDistrict"]) AND $_SESSION["applicantDistrict"]!=""){
                    $applicantDistrict = $_SESSION["applicantDistrict"];
                    echo "<option selected value=\"$applicantDistrict\">".$applicantDistrict."</option>";
                  }else{
                    echo '<option value="" selected disabled="disabled">Please Select</option>';
                  }
                ?>
              </select>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Taluk</label>
              <select  name="applicantTaluka" id="applicantTaluka" class="form-control" required>
                <?php 
                  if(isset($_SESSION["applicantTaluka"]) AND $_SESSION["applicantTaluka"]!=""){
                    $applicantTaluka = $_SESSION["applicantTaluka"];
                    echo "<option selected value=\"$applicantTaluka\">".$applicantTaluka."</option>";
                  }else{
                    echo '<option value="" selected disabled="disabled">Please Select</option>';
                  }
                ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $whatsappnumber ?></label>
              <div id="messageBoxDivMobileNumber">
                
              </div>
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">+91</div>
              </div>
              <input name="applicantWhatsAppNumber" id="applicantWhatsAppNumber" type="number" class="form-control" placeholder="<?php echo $enterwhatsappnumber ?>" autocomplete="off" required value="<?php echo isset($_SESSION["applicantWhatsAppNumber"])?$_SESSION["applicantWhatsAppNumber"]:""; ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $aadharnumber ?></label>
              <div id="messageBoxDivAadharNumber">
              </div>
              <div class="input-group">
                <input name="applicantAadharNumber" id="applicantAadharNumber" type="number" class="form-control" placeholder="<?php echo $enteraadharnumber ?>" autocomplete="off" required value="<?php echo isset($_SESSION["applicantAadharNumber"])?$_SESSION["applicantAadharNumber"]:""; ?>">
              </div>
          </div>

          <div class="form-group">
            <label><?php echo $SelectGender ?></label><br>
            <div class="form-check form-check-inline">
              <input name="applicantIsMale" class="form-check-input" type="radio" id="inlineRadio3" value="1"
              <?php if(isset($_SESSION["applicantIsMale"])){if($_SESSION["applicantIsMale"]=="1" OR $_SESSION["applicantIsMale"]==""){echo "checked";}}else{echo "checked";}?>>
              <label class="form-check-label" for="inlineRadio3"><?php echo $Male ?></label>
            </div>
            <div class="form-check form-check-inline">
              <input name="applicantIsMale" class="form-check-input" type="radio" id="inlineRadio4" value="0" <?php if(isset($_SESSION["applicantIsMale"])){if($_SESSION["applicantIsMale"]=="0"){echo "checked";}} ?>>
              <label class="form-check-label" for="inlineRadio4"><?php echo $Female ?></label>
            </div>
            <div class="form-check form-check-inline">
              <input name="applicantIsMale" class="form-check-input" type="radio" id="inlineRadio5" value="2" <?php if(isset($_SESSION["applicantIsMale"])){if($_SESSION["applicantIsMale"]=="2"){echo "checked";}} ?>>
              <label class="form-check-label" for="inlineRadio5"><?php echo $Transgender ?></label>
            </div>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $contactnumber ?></label>
            <div class="input-group">
              <input type="text" class="form-control" placeholder="" disabled value="<?php echo $_SESSION['applicantPhoneNumber']; ?>">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label><?php echo $religion ?></label>
              <select  name="applicantReligion" id="inputState" class="form-control" required>
                <?php 
                  if(isset($_SESSION["applicantReligion"]) AND $_SESSION["applicantReligion"]!=""){
                    $religionValue = $_SESSION["applicantReligion"];
                    echo "<option selected value=\"$religionValue\">".$religionValue."</option>";
                  }else{
                    echo '<option value="" selected disabled="disabled">Please Select</option>';
                  }
                ?>
                <option value="Hindu"><?php echo $Hindu ?></option>
                <option value="Muslim"><?php echo $Muslim ?></option>
                <option value="Christian"><?php echo $Christian ?></option>
                <option value="Other"><?php echo $Other ?></option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label><?php echo $Caste ?></label>
              <select  name="applicantCaste" id="inputState" class="form-control" required>
                <?php 
                  if(isset($_SESSION["applicantCaste"]) AND $_SESSION["applicantCaste"]!=""){
                    $casteValue = $_SESSION["applicantCaste"];
                    echo "<option selected value=\"$casteValue\">".$casteValue."</option>";
                  }else{
                    echo '<option value="" selected disabled="disabled">Please Select</option>';
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
            <label><?php echo $Nominee_Name ?></label>
            <input name="applicantNomineeName" type="text" class="form-control" placeholder="<?php echo $enterNominee_Name ?>" autocomplete="off" required value="<?php echo isset($_SESSION["applicantNomineeName"])?$_SESSION["applicantNomineeName"]:""; ?>" >
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label><?php echo $Nominee_Age ?></label>
              <input name="applicantNomineeAge" type="number" class="form-control" autocomplete="off" min="1" required  value="<?php echo isset($_SESSION["applicantNomineeAge"])?$_SESSION["applicantNomineeAge"]:""; ?>">
            </div>
            <div class="form-group col-md-6">
              <label><?php echo $Nominee_Relationship ?></label>
              <select name="applicantNomineeRelation" id="inputState" class="form-control" required>
                <?php 
                  if(isset($_SESSION["applicantNomineeRelation"]) AND $_SESSION["applicantNomineeRelation"]!=""){
                    $relationValue = $_SESSION["applicantNomineeRelation"];
                    echo "<option selected value=\"$relationValue\">".$relationValue."</option>";
                  }else{
                    echo '<option value="" selected disabled="disabled">Please Select</option>';
                  }
                ?>
                <option value="Husband"><?php echo $Husband ?></option>
                <option value="Wife"><?php echo $Wife ?></option>
                <option value="Father"><?php echo $Father ?></option>
                <option value="Mother"><?php echo $Mother ?></option>
                <option value="Sister"><?php echo $Sister ?></option>
                <option value="Brother"><?php echo $Brother ?></option>
                <option value="Son"><?php echo $Son ?></option>
                <option value="Daughter"><?php echo $Daughter ?></option>
                <option value="Daughter in Law"><?php echo $Daughter_in_Law ?></option>
                <option value="Son in Law"><?php echo $Son_in_Law ?></option>
                <option value="Mother in Law"><?php echo $Mother_in_Law ?></option>
                <option value="Father in Law"><?php echo $Father_in_Law ?></option>
                <option value="Grandfather"><?php echo $Grandfather ?></option>
                <option value="Grandmother"><?php echo $Grandmother ?></option>
                <option value="Niece"><?php echo $Niece ?></option>
                <option value="Nephew"><?php echo $Nephew ?></option>
                <option value="Uncle"><?php echo $Uncle ?></option>
                <option value="Aunt"><?php echo $Aunt ?></option>
                <option value="Friend"><?php echo $Friend ?></option>
                <option value="Grand son"><?php echo $Grand_son ?></option>
                <option value="Grand daughter"><?php echo $Grand_daughter ?></option>
                <option value="Brothers Daughter"><?php echo $Brothers_Daughter ?></option>
                <option value="Brothers Son"><?php echo $Brothers_Son ?></option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label><?php echo $areyouoragni ?></label><br>
            <div id="messageBoxDivOrganic">
            </div>
            <div class="form-check form-check-inline">
              <input name="applicantIsOrganic" class="form-check-input" type="radio" id="oragnicYes" value="true"
              <?php if(isset($_SESSION["applicantIsOrganic"])){if($_SESSION["applicantIsOrganic"]=="true" OR $_SESSION["applicantIsOrganic"]==""){echo "checked";}}else{echo "checked";}?>>
              <label class="form-check-label" for="oragnicYes"><?php echo $Yes ?></label>
            </div>
            <div class="form-check form-check-inline">
              <input name="applicantIsOrganic" class="form-check-input" type="radio" id="oragnicNo" value="false" <?php if(isset($_SESSION["applicantIsOrganic"])){if($_SESSION["applicantIsOrganic"]=="false"){echo "checked";}} ?>>
              <label class="form-check-label" for="oragnicNo"><?php echo $No ?></label>
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


  <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>


  <script type="text/javascript">
    var applicantWhatsAppNumber=document.getElementById("applicantWhatsAppNumber");
    var messageBoxDivMobileNumber=document.getElementById("messageBoxDivMobileNumber");

    var applicantAadharNumber=document.getElementById("applicantAadharNumber");
    var messageBoxDivAadharNumber=document.getElementById("messageBoxDivAadharNumber");

    var applicantDOB=document.getElementById("applicantDOB");
    var messageBoxDOB=document.getElementById("messageBoxDOB");

    var messageBoxDivOrganic=document.getElementById("messageBoxDivOrganic");
    

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
        messageBoxDOB.innerHTML="<div class=\"alert alert-danger\" role=\"alert\"><?php echo $AgeError;?></div>";
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
        messageBoxDivMobileNumber.innerHTML="<div class=\"alert alert-danger\" role=\"alert\"><?php echo $PhoneError;?></div>";
        return false;
      }
    }

    function aadhaarNumberValidate(){
      var aadharNo = /^\d{12}$/;
      if(applicantAadharNumber.value.match(aadharNo))
      {
        messageBoxDivAadharNumber.innerHTML="";
        return true;
      }
      else
      {
        messageBoxDivAadharNumber.innerHTML="<div class=\"alert alert-danger\" role=\"alert\"><?php echo $AadharError;?></div>";
        return false;
      }
    }

    function isAgriculturalFamily(){
      if(document.getElementById('oragnicYes').checked) {
        messageBoxDivOrganic.innerHTML="";
       return true;
      }else if(document.getElementById('oragnicNo').checked) {
        messageBoxDivOrganic.innerHTML="<div class=\"alert alert-danger\" role=\"alert\"><?php echo $organicError;?></div>";
        return false;
      }
    }

    function validateForm(){

      var mob=mobileNumberValidate();
      var dob=underAgeValidate(applicantDOB.value);
      var aadhar=aadhaarNumberValidate();
      var organic=isAgriculturalFamily();

      if(mob && dob && aadhar && organic){
        return true;
      }else{
        return false;
      }
      
    }

    $(document).ready(function(){

      var selectedDistrictCode;
      var selectedStateCode;

       $.getJSON('../../../Helpers/Locations/GetStates.php',function(data) { 
          var applicantState=$("#applicantState");
          applicantState.empty();
          // console.log(data);
          applicantState.append('<option value="" selected disabled="disabled">Please Select</option>');
          for (var i=0; i<data.length; i++) {
            applicantState.append('<option value="' + data[i].state_code + '">' + data[i].state_name + '</option>');
          }
        });


        $('#applicantState').change(function(){
          selectedStateCode=this.value;

          $.getJSON('../../../Helpers/Locations/GetDistricts.php',{"stateCode":selectedStateCode},function(data) { 
            var applicantDistrict=$("#applicantDistrict");
            applicantDistrict.empty();
            // console.log(data);
            applicantDistrict.append('<option value="" selected disabled="disabled">Please Select</option>');
            for (var i=0; i<data.length; i++) {
              applicantDistrict.append('<option value="' + data[i].dist_code + '">' + data[i].dist_name + '</option>');
            }
          });

        });


        $('#applicantDistrict').change(function(){
          selectedDistrictCode=this.value;

          $.getJSON('../../../Helpers/Locations/GetTalukas.php',{"stateCode":selectedStateCode,"districtCode":selectedDistrictCode},function(data) { 
            var applicantTaluka=$("#applicantTaluka");
            applicantTaluka.empty();
            // console.log(data);
            applicantTaluka.append('<option value="" selected disabled="disabled">Please Select</option>');
            for (var i=0; i<data.length; i++) {
              applicantTaluka.append('<option value="' + data[i].taluka_code + '">' + data[i].taluka_name + '</option>');
            }
          });

        });

    });

  </script>

</body>
</html>
