<?php

if(!isset($_GET['key'])){
	header("Location: ../");
    exit;
}

$contactNumberHash = $_GET['key'];

include '../Constants/index.php';

$link=mysqli_connect($server,$user,$pass,$db);

$error=null;

if(!mysqli_connect_error()){
	$query="SELECT * FROM `".$USERTABLENAME."` WHERE `verified`=1 AND `approved`=1 AND `formStatus1`=1 AND `formStatus2`=1 AND `formStatus3`=1 AND `formStatus4`=1 AND `contactNumberHash`='".$contactNumberHash."'";

	$result=mysqli_query($link,$query);
	$row=mysqli_fetch_array($result);

	if(mysqli_num_rows($result)>0){
		$name=$row['name'];
    
    $certificateNumberDisplay=$row['certificateNumber'];
		

	}else{
		$error=1;
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

    <title>Subhiksha - QR Verification</title>
  </head>
  <body>

  	<div class="container" style="margin-top: 10px;">

  		<?php

  			if($error==null){
  				echo '
  					<div class="jumbotron jumbotron-fluid">
					  <div class="container">
					    <h2><u>Certificate Number</u> : '.$certificateNumberDisplay.'</h2>
					    <h2><u>Name</u> : '.$name.'</h2>
					    <p class="lead">Scan the QR code on the share certificate to verify the authenticity.</p>
					  </div>
					</div>
  				';
  			}else{
  				echo '
  					<div class="alert alert-danger" role="alert" style="text-align: center;">
					  <h2><b>Invalid certificate QR Code!</b></h2>
					</div>
  				';
  			}

  		?>
  		
  	</div>


  	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

	</body>
</html>