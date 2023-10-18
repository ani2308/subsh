<?php

session_start();

if(!isset($_SESSION['userID'])){
    header("Location: ../");
    exit;
}

include '../../../Constants/index.php';

$error=null;
$success=null;

$link=mysqli_connect($server,$user,$pass,$db);

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
	  <h4><u>Add Products</u></h4>
	</div>

	<form method="GET">
		<div class="input-group col-lg-7" style="margin-top: 15px; margin-bottom: 15px;">
			<input type="hidden" name="pageno" value="<?php echo isset($_GET['pageno'])?$_GET['pageno']:1; ?>">
		  <input type="text" autocomplete="off" name="searchQuery" class="form-control rounded" placeholder="Search by Product Name" aria-label="Search"
		    aria-describedby="search-addon" value="<?php echo isset($_GET['searchQuery'])?$_GET['searchQuery']:""; ?>" />
		  <button type="submit" class="btn btn-outline-primary" style="margin-left: 5px;">Search</button>
		</div>
	</form>

	<div class="container">
	  <div class="row">

	  		<?php
	  			if(!mysqli_connect_error()){
					
					$query="SELECT * FROM ".$PRODUCTSTABLENAME;

					$result=mysqli_query($link,$query);

					 if(mysqli_query($link,$query)){
					 	$success="New approver added successfully!";
					 	$error=null;
					 }else{
					 	//ERROR
					 	$error="Failed to add new approver!";
					 	$success=null;
					 }
						
					
				}
	  		?>

	  		<?php

				if(isset($_GET['searchQuery'])){
					$sq=$_GET['searchQuery'];
					$searchQuerySQL=" WHERE (`producName` LIKE '%".$sq."%')";
				}else{
					$searchQuerySQL="";
				}

				if (isset($_GET['pageno'])) {
		            $pageno = $_GET['pageno'];
		        } else {
		            $pageno = 1;
		        }

		        $no_of_records_per_page = 16;
		        $offset = ($pageno-1) * $no_of_records_per_page;

				if(!mysqli_connect_error()){

					$total_pages_sql = "SELECT COUNT(*) FROM `".$PRODUCTSTABLENAME."`".$searchQuerySQL;
			        $result = mysqli_query($link,$total_pages_sql);
			        $total_rows = mysqli_fetch_array($result)[0];
			        $total_pages = ceil($total_rows / $no_of_records_per_page);

					$query="SELECT * FROM `".$PRODUCTSTABLENAME."`".$searchQuerySQL." LIMIT $offset, $no_of_records_per_page";
					$result=mysqli_query($link,$query);

					while ($row=mysqli_fetch_array($result)) {
						echo '
							<div class="col-lg-3 col-md-4 col-sm-6" style="margin-bottom: 10px;">
					            <div class="card">
					              <img class="card-img-top" src="'.$row['imageUrl'].'" alt="Image not available">
					              <div class="card-body">
					                <h5 class="card-title">'.$row['producName'].'</h5>
					                <a href="./AddProduct/index.php?productID='.$row['id'].'" class="btn btn-primary btn-lg btn-block">ADD</a>
					              </div>
					            </div>
					        </div>
						';
					}
				}


			?>

          <!-- <div class="col-lg-3 col-md-4 col-sm-6" style="margin-bottom: 10px;">
            <div class="card">
              <img class="card-img-top" src='https://d2j6dbq0eux0bg.cloudfront.net/images/30049435/2019686017.jpg' alt="Image not available">
              <div class="card-body">
                <h5 class="card-title">Ginger</h5>
                <a href="./AddProduct/index.php?productID=2" class="btn btn-primary btn-lg btn-block">ADD</a>
              </div>
            </div>
          </div> -->

	  </div>
	</div>

	<ul class="pagination justify-content-center" style="margin: 20px;  margin-bottom: 60px;">
        <li class="page-item">
        	<a class="page-link" href="?pageno=1<?php echo isset($_GET['searchQuery'])?"&searchQuery=".$_GET['searchQuery']:"";?>">First</a>
        </li>
        <li class="page-item <?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1);echo isset($_GET['searchQuery'])?"&searchQuery=".$_GET['searchQuery']:""; } ?>">Prev</a>
        </li>
        <li class="page-item <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a class="page-link" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1);echo isset($_GET['searchQuery'])?"&searchQuery=".$_GET['searchQuery']:""; } ?>">Next</a>
        </li>
        <li class="page-item">
        	<a class="page-link" href="?pageno=<?php echo $total_pages; echo isset($_GET['searchQuery'])?"&searchQuery=".$_GET['searchQuery']:""; ?>">Last</a>
        </li>
    </ul>

	


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