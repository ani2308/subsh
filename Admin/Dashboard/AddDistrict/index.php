<?php

session_start();

if(!isset($_SESSION['adminID'])){
    header("Location: ../");
    exit;
}

include '../../../Constants/index.php';

$error=null;
$success=null;


$link=mysqli_connect($server,$user,$pass,$db);


if(!mysqli_connect_error()){
	if(isset($_POST["addLocation"])){
		if(
			array_key_exists("stateName", $_POST) AND !$_POST['stateName']=="" AND
			array_key_exists("stateCode", $_POST) AND !$_POST['stateCode']=="" AND
			array_key_exists("districtName", $_POST) AND !$_POST['districtName']=="" AND
			array_key_exists("districtCode", $_POST) AND !$_POST['districtCode']=="" AND
			array_key_exists("talukName", $_POST) AND !$_POST['talukName']=="" AND
    		array_key_exists("talukCode", $_POST) AND !$_POST['talukCode']==""
		){
			
			$stateName=ucwords(strtolower($_POST['stateName']));
			$stateCode=strtoupper($_POST['stateCode']);

			$districtName=ucwords(strtolower($_POST['districtName']));
			$districtCode=strtoupper($_POST['districtCode']);

			$talukName=ucwords(strtolower($_POST['talukName']));
			$talukCode=strtoupper($_POST['talukCode']);

			$query="INSERT INTO `locations` (`state_name`, `state_code`, `dist_name`, `dist_code`,`taluka_name`, `taluka_code`) VALUES ('{$stateName}', '{$stateCode}','{$districtName}','{$districtCode}','{$talukName}','{$talukCode}')";

			 if(mysqli_query($link,$query)){
			 	$success="New location added successfully!";
			 	$error=null;
			 }else{
			 	//ERROR
			 	$error="Failed to add new location!";
			 	$success=null;
			 	echo mysqli_error($link);
			 }
		}
	}
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Subhiksha</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="./index.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">


</head>

<body>

	<div class="alert alert-primary" role="alert" style="margin: 10px;">
	  <h4><u>Add District</u></h4>
	</div>

	<div class="container">
		<?php

		if($error!=null){
			echo '
			<div class="alert alert-danger" role="alert">
			  <b>'.$error.'</b>
			</div>
			';
		}

		if($success!=null){
			echo '
			<div class="alert alert-success" role="alert">
			  <b>'.$success.'</b>
			</div>
			';
		}

		?>

		<form method="POST" class="card" style="padding: 20px; margin-bottom: 80px;">

		  <div class="form-group">
		    <label>Enter state name Eg. Karnataka</label>
		    <input type="text" name="stateName" class="form-control" aria-describedby="emailHelp" placeholder="Enter state name" required autocomplete="off">
		  </div>

		  <div class="form-group">
		    <label>Enter state code Eg. KA</label>
		    <input type="text" name="stateCode" class="form-control" aria-describedby="emailHelp" placeholder="Enter state code" required autocomplete="off">
		  </div>

		  <div class="form-group">
		    <label>Enter district name Eg. Bagalkot</label>
		    <input type="text" name="districtName" class="form-control" aria-describedby="emailHelp" placeholder="Enter district name" required autocomplete="off">
		  </div>

		  <div class="form-group">
		    <label>Enter district code Eg. BAG</label>
		    <input type="text" name="districtCode" class="form-control" aria-describedby="emailHelp" placeholder="Enter district code" required autocomplete="off">
		  </div>

		  <div class="form-group">
		    <label>Enter taluk name Eg. Badami</label>
		    <input type="text" name="talukName" class="form-control" aria-describedby="emailHelp" placeholder="Enter taluk name" required autocomplete="off">
		  </div>

		  <div class="form-group">
		    <label>Enter state code Eg. BAD</label>
		    <input type="text" name="talukCode" class="form-control" aria-describedby="emailHelp" placeholder="Enter taluk code" required autocomplete="off">
		  </div>

		  <input type="submit" name="addLocation" class="btn btn-primary" value="Add Location" style="font-weight: bold;">

		</form>
	</div>

	


    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>


</body>


</html>