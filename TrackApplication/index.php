<?php

include '../Constants/index.php';
include '../Constants/Languages/index.php';

$error=null;

$successMsg=null;

$link=mysqli_connect($server,$user,$pass,$db);

if(isset($_GET['applicationNumber']) AND array_key_exists("applicationNumber", $_GET) AND $_GET['applicationNumber']!=""){
	$applicationNumber=$_GET['applicationNumber'];

	if(!mysqli_connect_error()){
		$query="SELECT `verified`,`approved` FROM `".$USERTABLENAME."` WHERE `userID`=".$applicationNumber;

		$result=mysqli_query($link,$query);

		if(mysqli_num_rows($result)>0){
			//User exists
			$row=mysqli_fetch_array($result);
			
			if($row['verified']==1 AND $row['approved']==1){
				$successMsg="Congratulations! Your application has been approved.";
			}elseif ($row['verified']==1 AND $row['approved']==0) {
				$successMsg="Your application has been verified & now is under approval stage.";
			}else{
				$successMsg="We have received your application. Now your application will be verified & then approved.";
			}
			$error=null;
		}else{
			//user does not exists
			$error="You are not registered!";
			$successMsg=null;
		}
	}
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
 -->
 <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="index.css">

    <title>Subhiksha - Track Application</title>
  </head>
  <body>

    
    <div class="container">
	  <div class="row">
	  	<div class="col-lg-8 col-md-12 col-sm-12" style="margin: auto;">
	  		<div class="card" style="padding: 10px; margin-top: 15vh; margin-bottom: 10px;">
	  			<h3></h3>
	  			<form style=" margin: 5px 10px;">
	  				<u><h3><?php echo $TrackApplicationStatus ?></h3></u>

	  				<?php
	  					if($error!=null){
	  						echo '
	  							<div class="alert alert-danger" role="alert">
								  <h4><b>'.$error.'</b></h4>
								</div>
	  						';
	  					}
	  				?>

	  				<?php
	  					if($successMsg!=null){
	  						echo '
	  							<div class="alert alert-success" role="alert">
								  <h4><b>Application Number : <u>'.$applicationNumber.'</u></b></h4>
								  <h5><b>Application Status : <u>'.$successMsg.'</u></b></h5>
								</div>
	  						';
	  					}
	  				?>

	  				

	  				<div class="form-group" style="margin-top: 5px;">
					    <label for="exampleInputEmail1"><?php echo $EnterAppNumber ?></label>
					    <input type="number" name="applicationNumber" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="<?php echo $EnterAppNumberHere ?>" autocomplete="off" required>
					    <small id="emailHelp" class="form-text text-muted"><?php echo $AppNumberMsg ?></small>
					 </div>
				  <button type="submit" class="btn btn-primary btn-lg btn-block" style="font-weight: bold;"><?php echo $Track_Application ?></button>
				</form>
	  		</div>
	  	</div>
	  </div>
	</div>






	<div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2); margin-top: 10px; color: white;">
    	© Copyright 2019-20 Subhiksha. All rights reserved.
  	</div>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script> -->
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

  </body>
</html>