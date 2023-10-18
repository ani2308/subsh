<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['languagePref'])){
	//IF LANGUAGE NOT SET, USE ENGLISH
	include 'english.php';
}elseif ($_SESSION['languagePref']=="english") {
	include 'english.php';
}elseif ($_SESSION['languagePref']=="kannada") {
	include 'kannada.php';
}else{
	//EXTRA SAFE CONDITION
	include 'english.php';
}

?>