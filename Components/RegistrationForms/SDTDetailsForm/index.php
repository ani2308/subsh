<!-- <h1>sdsad</h1> -->
<?php 
  
  if (isset($disableEditingSDT) AND $disableEditingSDT=="disabled"){
    $isDisabledTextSDT=" disabled";
  }else{
    $isDisabledTextSDT=" ";

    if(!mysqli_connect_error()){
      if(array_key_exists("userIDToChangeSDTDetails", $_POST) AND $_POST["changeSDTDetails"]){
        if(
          array_key_exists("applicantState", $_POST) AND $_POST['applicantState']!="" AND
          array_key_exists("applicantDistrict", $_POST) AND $_POST['applicantDistrict']!="" AND
          array_key_exists("applicantTaluka", $_POST) AND $_POST['applicantTaluka']!=""
          ){

          $queryToChangeReferrerDetails="UPDATE ".$USERTABLENAME." SET `state_code`='{$_POST['applicantState']}',`dist_code`='{$_POST['applicantDistrict']}',`taluka_code`='{$_POST['applicantTaluka']}' WHERE `userID`=".$_POST['userIDToChangeSDTDetails'];

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

        <u><h4>State, District & Taluka Details Changes</h4></u>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label>State</label>
            <select  <?php echo $isDisabledTextSDT; ?> name="applicantState" id="applicantState" class="form-control" required>
            </select>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label>District</label>
            <select  <?php echo $isDisabledTextSDT; ?> name="applicantDistrict" id="applicantDistrict" class="form-control" required>
              ?>
            </select>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label>Taluka</label>
            <select  <?php echo $isDisabledTextSDT; ?> name="applicantTaluka" id="applicantTaluka" class="form-control" required>
            </select>
          </div>
        </div>

        <div class="row" style="margin: 10px;">
          <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="col-lg-12" style="text-align: center;">
                  <input type="hidden" name="userIDToChangeSDTDetails" value="<?php echo $_GET["userID"];?>">
                  <input style="font-weight: bold;white-space: inherit;" name="changeSDTDetails" type="submit" class="btn btn-primary" value="Save Changes (State, District & Taluka)">
              </div>
          </div>
        </div>
        
      </form>
      
    </div>
  </div>
</div>

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