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
	if(isset($_POST["addVerifier"])){
		if(
			array_key_exists("username", $_POST) AND !$_POST['username']=="" AND
    		array_key_exists("password", $_POST) AND !$_POST['password']==""
		){
			$md5Hash=md5($_POST['password']);
			$query="INSERT INTO ".$VERIFIERTABLENAME." (`verifierUsername`, `verifierPasswordHash`) VALUES ('{$_POST['username']}','{$md5Hash}')";

			 if(mysqli_query($link,$query)){
			 	$success="New verifier added successfully!";
			 	$error=null;
			 }else{
			 	//ERROR
			 	$error="Failed to add new verifier!";
			 	$success=null;
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
	  <h4><u>Add Verifier</u></h4>
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

		<form method="POST" class="card" style="padding: 20px;">
		  <div class="form-group">
		    <label for="exampleInputEmail1">Username for new verifier </label>
		    <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Username" required autocomplete="off">
		    <small id="emailHelp" class="form-text text-muted">New verifier will be using these credentials to login</small>
		  </div>
		  <div class="form-group">
		    <label for="exampleInputPassword1">Password for new verifier</label>
		    <input type="text" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required autocomplete="off">
		  </div>
		  <input type="submit" name="addVerifier" class="btn btn-primary" value="Add Verifier" style="font-weight: bold;">
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