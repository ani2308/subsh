<?php

session_start();

if(!isset($_SESSION['adminID'])){
    header("Location: ../");
    exit;
}

include '../../../../Constants/index.php';

$error=null;

$link=mysqli_connect($server,$user,$pass,$db);

$GetParams="?userID=".$_GET['userID']."&name=".$_GET['name']."&contactNumber=".$_GET['contactNumber'];

// ======================= MARK USER TO FO ================================
if(!mysqli_connect_error()){
    if(array_key_exists("AddFarmerToFO", $_POST)){
        $queryToApprove="UPDATE `".$USERTABLENAME."` SET `managerID`=0 WHERE `userID`=".$_POST["userID"];
        if(mysqli_query($link,$queryToApprove)){
            // echo "Success!";

        }else{
            // echo "Error updating!";
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
    <!-- <link rel="stylesheet" href="./index.css"> -->
    <!-- Scrollbar Custom CSS -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css"> -->


</head>
<body>

	<div class="alert alert-primary" role="alert" style="margin: 10px;">
	  <h4><u>View Farmers Under Field Officer</u></h4>
	  <b><u>List Of Farmers</u></b>
	</div>

	<div class="alert alert-success" role="alert" style="margin: 10px;">
	  <h5><u>Selected FO Name</u> : <?php echo $_GET['name'];?></h5>
	  <h5><u>Selected FO Contact No.</u> : <?php echo $_GET['contactNumber'];?></h5>
	  <h6><u>Selected FO ID</u> : <?php echo $_GET['userID'];?></h6>
	</div>

	<form method="GET">
		<div class="input-group col-lg-10" style="margin-top: 15px; margin-bottom: 15px;">

			<input type="hidden" name="userID" value="<?php echo $_GET['userID'];?>" /> 
			<input type="hidden" name="name" value="<?php echo $_GET['name'];?>" /> 
			<input type="hidden" name="contactNumber" value="<?php echo $_GET['contactNumber'];?>" /> 

			<input type="hidden" name="pageno" value="<?php echo isset($_GET['pageno'])?$_GET['pageno']:1; ?>">
			<input type="text" autocomplete="off" name="searchQuery" class="form-control rounded" placeholder="Search by Name/Contact No./Share Certificate No./Aadhar No./Application No." aria-label="Search"
		    aria-describedby="search-addon" value="<?php echo isset($_GET['searchQuery'])?$_GET['searchQuery']:""; ?>" />
		  <button type="submit" class="btn btn-outline-primary" style="margin-left: 5px;">Search</button>
		</div>
	</form>

	<table border="2px solid black" style="background: white;margin-left: 10px;">
		<tr>
			<th style="padding: 10px; text-align: center;font-size: 20px;"><span class="badge badge-danger" style="padding: 10px">Application No.</span></th>
			<th style="padding: 10px;text-align: center;font-size: 20px;"><span class="badge badge-danger" style="padding: 10px">Name</span></th>
			<th style="padding: 10px;text-align: center;font-size: 20px;"><span class="badge badge-danger" style="padding: 10px">Contact Number</span></th>
			<th style="padding: 10px;text-align: center;font-size: 20px;"><span class="badge badge-warning" style="padding: 10px">View Farmer Details</span></th>
			<th style="padding: 10px;text-align: center;font-size: 20px;"><span class="badge badge-danger" style="padding: 10px">Remove user under FO</span></th>
		</tr>

		<?php

		if(isset($_GET['searchQuery'])){
			$sq=$_GET['searchQuery'];
			$searchQuerySQL=" AND (`contactNumber` LIKE '%".$sq."%' OR `name` LIKE '%".$sq."%' OR `aadharNumber` LIKE '%".$sq."%' OR `userID` LIKE '%".$sq."%' OR `certificateNumber` LIKE '%".$sq."%')";
		}else{
			$searchQuerySQL="";
		}

		if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }

        $no_of_records_per_page = 15;
        $offset = ($pageno-1) * $no_of_records_per_page;

		if(!mysqli_connect_error()){

			$total_pages_sql = "SELECT COUNT(*) FROM `".$USERTABLENAME."` WHERE `userLevel`=1 AND `managerID`=".$_GET['userID']." AND `verified`=1 AND `approved`=1 AND `formStatus1`=1 AND `formStatus2`=1 AND `formStatus3`=1 AND `formStatus4`=1".$searchQuerySQL;
	        $result = mysqli_query($link,$total_pages_sql);
	        $total_rows = mysqli_fetch_array($result)[0];
	        $total_pages = ceil($total_rows / $no_of_records_per_page);

			$query="SELECT `userID`,`name`,`contactNumber`,`verifierID`,`approverID` FROM `".$USERTABLENAME."` WHERE `userLevel`=1 AND `managerID`=".$_GET['userID']." AND `verified`=1 AND `approved`=1 AND `formStatus1`=1 AND `formStatus2`=1 AND `formStatus3`=1 AND `formStatus4`=1".$searchQuerySQL." LIMIT $offset, $no_of_records_per_page";
			$result=mysqli_query($link,$query);

			while ($row=mysqli_fetch_array($result)) {
				echo '
					<tr>
						<td style="padding: 10px;"><span style="padding: 10px">'.$row["userID"].'</span></td>
						<td style="padding: 10px;"><span style="padding: 10px">'.$row["name"].'</span></td>
						<td style="padding: 10px;"><span style="padding: 10px">'.$row["contactNumber"].'</span></td>

						<td style="text-align: center; padding: 10px;">
							<form method="GET" action="./ViewApplicantForm">
								<input type="hidden" name="userID" value="'.$row['userID'].'">
								<button style="margin-top: 2px;" class="btn btn-warning" type="submit" value="'.$row['userID'].'"><b>View Farmer Details</button>
							</form>
						</td>

						<td style="text-align: center; padding: 10px;">
							<form method="POST">
								<input type="hidden" name="userID" value="'.$row['userID'].'">
								<input style="margin-top: 2px;" class="btn btn-danger" type="submit" name="AddFarmerToFO" value="Remove">
							</form>
						</td>

					</tr>
				';
			}
		}


		?>


	</table>

	<ul class="pagination justify-content-center" style="margin: 20px;  margin-bottom: 60px;">
        <li class="page-item">
        	<a class="page-link" href="<?php echo $GetParams; ?>&pageno=1<?php echo isset($_GET['searchQuery'])?"&searchQuery=".$_GET['searchQuery']:"";?>">First</a>
        </li>
        <li class="page-item <?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a class="page-link" href="<?php echo $GetParams; ?><?php if($pageno <= 1){ echo '#'; } else { echo "&pageno=".($pageno - 1);echo isset($_GET['searchQuery'])?"&searchQuery=".$_GET['searchQuery']:""; } ?>">Prev</a>
        </li>
        <li class="page-item <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a class="page-link" href="<?php echo $GetParams; ?><?php if($pageno >= $total_pages){ echo '#'; } else { echo "&pageno=".($pageno + 1);echo isset($_GET['searchQuery'])?"&searchQuery=".$_GET['searchQuery']:""; } ?>">Next</a>
        </li>
        <li class="page-item">
        	<a class="page-link" href="<?php echo $GetParams; ?>&pageno=<?php echo $total_pages; echo isset($_GET['searchQuery'])?"&searchQuery=".$_GET['searchQuery']:""; ?>">Last</a>
        </li>
    </ul>

</body>
</html>