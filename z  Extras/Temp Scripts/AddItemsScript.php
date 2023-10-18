<?php

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://app.ecwid.com/api/v3/30049435/products?token=public_3nqPwKmSVPnKbFFDPEeQwWgwh1xDbdZK&offset=0");
// curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_HEADER, 0);

//$body = '{}';
//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET"); 
//curl_setopt($ch, CURLOPT_POSTFIELDS,$body);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = json_decode(curl_exec($ch),true);

// print_r($response);
include './Constants/index.php';


$link=mysqli_connect($server,$user,$pass,$db);

foreach ($response["items"] as $value){

	if($value["enabled"]=="true"){

	    $query="INSERT INTO products4531 (`name`, `imageUrl`) VALUES ('{$value["name"]}','{$value["thumbnailUrl"]}')";

    	if(mysqli_query($link,$query)){
    		echo "success";
    	}else{
    		echo "fail";
    	}
	}
    
}

?>