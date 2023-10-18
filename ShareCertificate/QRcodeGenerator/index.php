<?php 
  
// Include the qrlib file 
include 'phpqrcode/qrlib.php'; 
  
// $text variable has data for QR  
$text = "https://www.linkedin.com/in/kailashnadh/"; 
  
// QR Code generation using png() 
// When this function has only the 
// text parameter it directly 
// outputs QR in the browser 
// QRcode::png($text); 
QRcode::png($text, 'qrcode.png');

?> 
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<img src="filename.png">

</body>
</html>