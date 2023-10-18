<?php 

if(!isset($_SESSION['adminID'])){
    header("Location: ../");
    exit;
}


if(!mysqli_connect_error()){
  if(array_key_exists("deleteApprovedUserPermanently", $_POST) AND $_POST["deleteApprovedUserPermanently"]){
    if(
      array_key_exists("userIDToDeleteApprovedUserPermanently", $_POST) AND !$_POST['userIDToDeleteApprovedUserPermanently']==""
      ){

      $queryToDeleteApprovedUserPermanently="DELETE FROM `".$USERTABLENAME."` WHERE `userID`=".$_POST['userIDToDeleteApprovedUserPermanently'];

        if(mysqli_query($link,$queryToDeleteApprovedUserPermanently)){
          
        }else{
          //echo "error!";
      }
    }
  }
}


?>


<div class="row" style="margin: 10px;">
  <div class="col-lg-12 col-md-12 col-sm-12">
    <div class="card" style="padding: 10px; margin-bottom: 30px">

      <form style="padding: 10px" method="POST">

        <div class="row" style="margin: 10px;">
          <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="col-lg-12" style="">
                  <input type="hidden" name="userIDToDeleteApprovedUserPermanently" value="<?php echo $_GET["userID"] ?>">
                  <input style="font-weight: bold;white-space: inherit;" name="deleteApprovedUserPermanently" type="submit" class="btn btn-danger btn-sm" value="DELETE APPROVED USER PERMANENTLY">
              </div>
          </div>
        </div>
        
      </form>
      
    </div>
  </div>
</div>