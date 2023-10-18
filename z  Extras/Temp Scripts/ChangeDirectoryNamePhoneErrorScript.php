<?php

include './Constants/index.php';

$link=mysqli_connect($server,$user,$pass,$db);

if(!mysqli_connect_error()){

	$query="SELECT * FROM `".$USERTABLENAME."` WHERE `isImportedUser`=2;";

	$result=mysqli_query($link,$query);

	while ($row=mysqli_fetch_array($result)) {

		echo $row['userID']."<br>";

		$newDirectoryNumber=$row['contactNumber'];
		$newDirectoryName=md5($newDirectoryNumber."subhiksha");

		$oldDirectoryNumber=substr($row['contactNumber'],3);
		$oldDirectoryName=md5($oldDirectoryNumber."subhiksha");

		if(is_dir("data/".$oldDirectoryName)) {

			if(is_dir("data/".$newDirectoryName)) {
				rmdir("data/".$newDirectoryName);
			}

			rename("data/".$oldDirectoryName,"data/".$newDirectoryName);

		}


		echo "<br><br>";
	}

}




?>