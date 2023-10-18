<?php

session_start();

if(!isset($_SESSION['userID'])){
    header("Location: ../");
    exit;
}

include '../../../../Constants/index.php';

$error=null;
$success=null;

$link=mysqli_connect($server,$user,$pass,$db);

if(!mysqli_connect_error()){
    if(array_key_exists("submit", $_POST) AND array_key_exists("quantity", $_POST) AND array_key_exists("availableDate", $_POST) AND array_key_exists("units", $_POST) AND array_key_exists("isOrganic", $_POST)){

    	$query="INSERT INTO ".$AVAILABLEPRODUCTS." (`userID`, `productID`, `quantity`, `unit`, `availableDate`,`isOrganic`) VALUES ('{$_SESSION['userID']}','{$_POST['productID']}' ,'{$_POST['quantity']}' ,'{$_POST['units']}','{$_POST['availableDate']}','{$_POST['isOrganic']}')";

    	if(mysqli_query($link,$query)){
		 	$success="Added product successfully!";
		 	$error=null;
		 }else{
		 	//ERROR
		 	$error="Failed to add product!";
		 	$success=null;
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
	  <h4><u>Enter Product Details</u></h4>
	</div>

	<?php
		if(!mysqli_connect_error()){
		
			$query="SELECT * FROM ".$PRODUCTSTABLENAME." WHERE id=".$_GET['productID'];

			$result=mysqli_query($link,$query);

			$row=mysqli_fetch_array($result);
			
		}
	?>

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
	</div>


	<form method="POST">

		<div class="container">
			<div class="row">

				<input type="hidden" name="productID" value="<?php echo $_GET['productID']?>">

				<div class="col-lg-3 col-md-4 col-sm-12" style="margin-bottom: 10px;">
			        <div class="card">
			          <img class="card-img-top" src="<?php echo $row['imageUrl']?>" alt="Image not available">
			        </div>
			    </div>

			    <div class="col-lg-12 col-md-12 col-sm-12" style="margin-bottom: 10px;">
			        <div class="input-group">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon1"><b>Product Name</b></span>
					  </div>
					  <input type="text" disabled="disabled" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1" value="<?php echo $row['producName']?>">
					</div>
			    </div>

			    <div class="col-lg-8 col-md-8 col-sm-8" style="margin-bottom: 10px;">
			        <div class="input-group">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon1"><b>Quantity</b></span>
					  </div>
					  <input type="number" name="quantity" class="form-control" placeholder="300" aria-label="Username" aria-describedby="basic-addon1" required="required" autocomplete="off">
					</div>
			    </div>

			    <div class="col-lg-4 col-md-4 col-sm-4" style="margin-bottom: 10px;">
			    	<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text" id="basic-addon1"><b>Units</b></span>
						</div>
					    <select name="units" class="form-control" id="exampleFormControlSelect1">
					      <option value="Kilogram">Kilogram</option>
					      <option value="Litre">Litre</option>
					    </select>
					</div>     
				</div>

			    <div class="col-lg-6 col-md-6 col-sm-12" style="margin-bottom: 10px;">
			        <div class="input-group">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon1"><b>Availability Date</b></span>
					  </div>
					  <input type="date" name="availableDate" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" required="required" value="<?php echo date("Y-m-d");?>">
					</div>
			    </div>

			    <div class="col-lg-6 col-md-6 col-sm-12" style="margin-bottom: 10px;">
			    	<div class="input-group">
						<div class="input-group-prepend">
						  <span class="input-group-text" id="basic-addon1"><b>Organically grown</b></span>
						</div>
					    <select name="isOrganic" class="form-control" id="exampleFormControlSelect1">
					      <option value="Yes">Yes</option>
					      <option value="No">No</option>
					    </select>
					</div>     
				</div>

			    <div class="col-lg-12 col-md-12 col-sm-12" style="margin-bottom: 10px; text-align: center;">

					<input type="Submit" name="submit" value="Submit" class="btn btn-success" placeholder="" aria-label="Username" aria-describedby="basic-addon1">

			    </div>

			</div>
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
		</div>

	</form>

	


    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

    <!-- PREVENT FORM RESUBMISSION -->
  <script>
    if ( window.history.replaceState ) {
      window.history.replaceState( null, null, window.location.href );
    }
  </script>

</body>


</html>