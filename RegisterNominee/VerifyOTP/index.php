<?php

session_start();

include '../../Constants/index.php';

$link=mysqli_connect($server,$user,$pass,$db);

$key=$_GET['l'];
$idToken=$_GET['xa'];

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://identitytoolkit.googleapis.com/v1/accounts:lookup?key=".$key."&idToken=".$idToken,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_HTTPHEADER => array(
        "Content-length:0"
    )
));

$response = curl_exec($curl);

curl_close($curl);

$array_response = json_decode($response, true);
// print_r($array_response);

if (array_key_exists("error", $array_response)) {

	header("Location: ../"); 

	exit; 

}

// if (array_key_exists("users", $array_response)) {

// 	$applicantPhoneNumber = $array_response["users"][0]["providerUserInfo"][0]["phoneNumber"];
// 	// echo $applicantPhoneNumber;

//     if(!mysqli_connect_error()){
//         $query="SELECT * FROM `".$USERTABLENAME."` WHERE `contactNumber`=".$applicantPhoneNumber;
//         $result=mysqli_query($link,$query);
//         $row=mysqli_fetch_array($result);

//         if(mysqli_num_rows($result)>0){
//             //Already registered
            
//             header("Location: ../../TrackApplication/?applicationNumber=".$row['userID']);
//             exit;
//         }else{
//             //New member

//             $_SESSION['applicantPhoneNumber']=$applicantPhoneNumber;

//             header("Location: ../RegistrationForm");
//             exit;

//         }
//     }
// }

if (array_key_exists("users", $array_response)) {

    //OTP VERIFIED
    $applicantPhoneNumber = $array_response["users"][0]["providerUserInfo"][0]["phoneNumber"];
    // echo $applicantPhoneNumber;

    if(!mysqli_connect_error()){
        $query="SELECT * FROM `".$USERTABLENAME."` WHERE `contactNumber`=".$applicantPhoneNumber;
        $result=mysqli_query($link,$query);
        $row=mysqli_fetch_array($result);

        if(mysqli_num_rows($result)>0){
            //Already Registered
            if($row['verified']==1 AND $row['approved']==1 AND $row['formStatus1']==1 AND $row['formStatus2']==1 AND $row['formStatus3']==1 AND $row['formStatus4']==1){
                //APPLICANT HAS FILLED EVERYTHING & VERIFIED & APPROVED

                $_SESSION['userID']=$row['userID'];
                // echo "1";
                header("Location: ../../ApplicantLogin/Dashboard");
                exit;
            }

            if($row['verified']==1 AND $row['approved']==0 AND $row['formStatus1']==1 AND $row['formStatus2']==1 AND $row['formStatus3']==1 AND $row['formStatus4']==1){
                //NOT APPROVED, BUT VERIFIED
                header("Location: ../../TrackApplication/index.php?applicationNumber=".$row['userID']);
                exit;
                // echo "2";
            }

            if($row['verified']==0 AND $row['approved']==0 AND $row['formStatus1']==1 AND $row['formStatus2']==1 AND $row['formStatus3']==1 AND $row['formStatus4']==1){
                //NOT VERIFIED & APPROVED
                header("Location: ../../TrackApplication/index.php?applicationNumber=".$row['userID']);
                exit;
                // echo "3";
            }

            $_SESSION['applicantPhoneNumber']=$applicantPhoneNumber;
            $_SESSION['userID']=$row['userID'];


            if($row['formStatus1']==1){
                $_SESSION['formStatus1']=1;
            }
            if($row['formStatus2']==1){
                $_SESSION['formStatus2']=1;
            }
            if($row['formStatus3']==1){
                $_SESSION['formStatus3']=1;
            }
            if($row['formStatus4']==1){
                $_SESSION['formStatus4']=1;
            }


            if($row['formStatus1']!=1){
                header("Location: ../RegistrationForm/1/index.php");
                exit;
            }
            if($row['formStatus2']!=1){
                header("Location: ../RegistrationForm/2/index.php");
                exit;
            }
            if($row['formStatus3']!=1){
                header("Location: ../RegistrationForm/3/index.php");
                exit;
            }
            if($row['formStatus4']!=1){
                header("Location: ../RegistrationForm/4/index.php");
                exit;
            }

        }else{
            //New member
            $_SESSION['applicantPhoneNumber']=$applicantPhoneNumber;
            header("Location: ../RegistrationForm/1/index.php");
            exit;
            // echo "8";

        }
    }

}

?>
