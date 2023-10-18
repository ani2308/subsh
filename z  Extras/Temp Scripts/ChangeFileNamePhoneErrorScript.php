<?php

include './Constants/index.php';

$link=mysqli_connect($server,$user,$pass,$db);

if(!mysqli_connect_error()){

	$query="SELECT * FROM `".$USERTABLENAME."` WHERE `isImportedUser`=2;";

	$result=mysqli_query($link,$query);

	while ($row=mysqli_fetch_array($result)) {

		$newDirectoryNumber=$row['contactNumber'];
		$newDirectoryName=md5($newDirectoryNumber."subhiksha");

		$oldDirectoryNumber=substr($row['contactNumber'],3);
		$oldDirectoryName=md5($oldDirectoryNumber."subhiksha");

		if(is_dir("data/".$newDirectoryName)) {

			echo $row['userID']."<br>";

			$target_dir = "data/".$newDirectoryName."/";

			$photoFileName=md5($oldDirectoryNumber."photo");
		    $photoFilePath = glob ($target_dir.$photoFileName.".*")[0]; 
		    $photoFilePathExploded=explode('.', $photoFilePath);
		    $photoExtension = end($photoFilePathExploded);
		    $photoSourceUrl=$target_dir.$photoFileName.".".$photoExtension;

			$newPhotoFileName=md5($newDirectoryNumber."photo");
		    $newPhotoSourceUrl=$target_dir.$newPhotoFileName.".".$photoExtension;

			rename($photoSourceUrl,$newPhotoSourceUrl);



			$aadharFrontFileName=md5($oldDirectoryNumber."aadharfront");
			$aadharFrontFilePath = glob ($target_dir.$aadharFrontFileName.".*")[0];
			$aadharFrontFilePathExploded=explode('.', $aadharFrontFilePath);
			$aadharFrontExtension = end($aadharFrontFilePathExploded);
			$aadharFrontSourceUrl=$target_dir.$aadharFrontFileName.".".$aadharFrontExtension;

			$newAadharFrontFileName=md5($newDirectoryNumber."aadharfront");
		    $newAadharFrontSourceUrl=$target_dir.$newAadharFrontFileName.".".$aadharFrontExtension;

			rename($aadharFrontSourceUrl,$newAadharFrontSourceUrl);




			$aadharBackFileName=md5($oldDirectoryNumber."aadharback");
			$aadharBackFilePath = glob ($target_dir.$aadharBackFileName.".*")[0];
			$aadharBackFilePathExploded=explode('.', $aadharBackFilePath);
			$aadharBackExtension = end($aadharBackFilePathExploded);
			$aadharBackSourceUrl=$target_dir.$aadharBackFileName.".".$aadharBackExtension;


			$newAadharBackFileName=md5($newDirectoryNumber."aadharback");
		    $newAadharBackSourceUrl=$target_dir.$newAadharBackFileName.".".$aadharBackExtension;

			rename($aadharBackSourceUrl,$newAadharBackSourceUrl);




			$ddPhotoFileName=md5($oldDirectoryNumber."ddphoto");
			$ddPhotoFilePath = glob ($target_dir.$ddPhotoFileName.".*")[0];
			$ddPhotoFilePathExploded=explode('.', $ddPhotoFilePath);
			$ddPhotoExtension = end($ddPhotoFilePathExploded);
			$ddPhotoSourceUrl=$target_dir.$ddPhotoFileName.".".$ddPhotoExtension;

			$newddPhotoFileName=md5($newDirectoryNumber."ddphoto");
		    $newddPhotoSourceUrl=$target_dir.$newddPhotoFileName.".".$ddPhotoExtension;

			rename($ddPhotoSourceUrl,$newddPhotoSourceUrl);



			echo "<br><br>";
		}


	}

}




?>