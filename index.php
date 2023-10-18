<?php
session_start();

if(isset($_GET['languagePref'])){
	$_SESSION['languagePref']=$_GET['languagePref'];
}

include './Constants/index.php';
include './Constants/Languages/index.php';

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
 -->
 <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="index.css">

    <title>Subhiksha</title>
  </head>
  <body>

	<!-- <ul class="nav justify-content-end">
	  <li class="nav-item" style="margin: 5px;">
	  		<div class="btn-group dropleft">
			  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-weight: bold;">
			    <?php echo $LANGUAGE_BTN ?>
			  </button>
			  <div class="dropdown-menu" style="text-align: right;">
			    <a class="dropdown-item" href="?languagePref=english">English</a>
			    <a class="dropdown-item" href="?languagePref=kannada">Kannada</a>
			  </div>
			</div>
	  </li>
	  <li class="nav-item" style="margin: 5px;">
	  		<b><button type="button" class="btn btn-light" data-toggle="modal" data-target="#helpModal"><?php echo $HELP_BTN ?></button></b>
	  </li>
	</ul> -->

	<?php
		include './Components/HelpLanguageNav/index.php';
	?>

    
    <div class="container">
	  <div class="row">
	  	<div class="col-lg-7 col-md-12 col-sm-12" style="margin: auto;">
	  		<div class="card" style="height: 75vh; padding: 5px; margin-top: 5vh;">
	  			<div class="jumbotron jumbotron-fluid" style="text-align: center; margin: auto;background: white;">
				  <div class="container">
				    <h3>Subhiksha Shareholder Portal</h3>
				    <p class="lead"><?php echo $FIRST_PAGE_TEXT_ABOVE_JOIN ?></p>
				  </div>
				  <a type="button" class="btn btn-primary btn-lg" href=".\RegisterApplicant"><?php echo $FIRST_PAGE_JOIN_BTN ?> <br>(As a shareholder)</a>
				  <a type="button" class="btn btn-primary btn-lg" href=".\RegisterNominee"><?php echo $FIRST_PAGE_JOIN_BTN ?> <br>(As a nominal member)</a>
				</div>
	  		</div>
	  	</div>
	  	<div class="col-lg-5 col-md-12 col-sm-12" style="margin: auto;">
	  		<div class="card" style="padding: 10px; margin-top: 10px; margin-bottom: 10px;">

	  			<!-- <form style="text-align: center; margin: 20px 10px;">
				  	<div class="input-group mb-3 form-group">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon1">+91</span>
					  </div>
					  <input name="mobile" type="Number" class="form-control" placeholder="Mobile Number" aria-label="Mobile Number" aria-describedby="basic-addon1">
					</div>
				  <button type="submit" class="btn btn-primary btn-lg btn-block">Login</button>
				</form> -->

				<div id="enterMobileDiv" style="text-align: center; margin: 20px 10px;">
  					<div id="messageBoxDivMobileNumber">
						
					</div>

				  	<div class="input-group mb-3 form-group">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon1">+91</span>
					  </div>
					  <input name="mobileNumber" id="mobileNumberInput" type="number" class="form-control" placeholder="<?php echo $EnterMobileHere ?>" aria-label="Mobile Number" aria-describedby="basic-addon1" autocomplete="off" required>
					</div>
					<div id="recaptcha-container"></div>
				  <button type="submit" id="sendOtpBtn" class="btn btn-primary btn-lg btn-block"><?php echo $SEND_OTP ?></button>
			  	</div>

			  	<div id="enterOtpDiv" style="text-align: center; margin: 20px 10px; display: none;">
					<div id="messageBoxDivOTP">
						<div class="alert alert-success" role="alert">
						  <?php echo $OTP_SENT ?>
						</div>
					</div>
					
				  	<div class="input-group mb-3 form-group">
					  <input name="codeInput" id="otpInput" type="Number" class="form-control" placeholder="Enter OTP Here" aria-label="OTP" aria-describedby="basic-addon1" autocomplete="off">
					</div>
				  <button type="submit" id="verifyOtpBtn" class="btn btn-primary btn-lg btn-block"><?php echo $VERIFY_OTP ?></button>
			  </div>



				<a style="margin-top: 10px;" type="submit" class="btn btn-outline-primary btn-lg btn-block" href="./TrackApplication"><?php echo $TRACK_APPLICATION ?></a>
	  		</div>
	  	</div>
	  </div>
	</div>



	<!-- HELP Modal -->
	<!-- <div class="modal fade" id="helpModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel"><?php echo $HELP_BTN ?></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <?php echo $ADDRESS ?><br>
	        <?php echo $PHONE ?>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $CLOSE ?></button>
	      </div>
	    </div>
	  </div>
	</div> -->


	<div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2); margin-top: 10px; color: white;">
    	© Copyright 2019-20 Subhiksha. All rights reserved.
  	</div>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script> -->
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>


<script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-app.js"></script>

<script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-analytics.js"></script>
<script defer src="https://www.gstatic.com/firebasejs/7.19.0/firebase-auth.js"></script>

	<!-- TODO: Add SDKs for Firebase products that you want to use
	     https://firebase.google.com/docs/web/setup#available-libraries -->

	<script>
	  // Your web app's Firebase configuration
	  var firebaseConfig = {
	    apiKey: "AIzaSyBEhyU2MQMMhTZyvi0mW_gohEzUKuRBj10",
	    authDomain: "subhiksha-508f2.firebaseapp.com",
	    projectId: "subhiksha-508f2",
	    storageBucket: "subhiksha-508f2.appspot.com",
	    messagingSenderId: "144532018775",
	    appId: "1:144532018775:web:a1362ace0c6ab39a86f512"
	  };
	  // Initialize Firebase
	  firebase.initializeApp(firebaseConfig);
	</script>


	<script type="text/javascript">

		var enterMobileDiv=document.getElementById("enterMobileDiv");
		var enterOtpDiv=document.getElementById("enterOtpDiv");
		// enterOtpDiv.style.display = "none";

		var messageBoxDivMobileNumber=document.getElementById("messageBoxDivMobileNumber");
		var messageBoxDivOTP=document.getElementById("messageBoxDivOTP");
		
		var mobileNumberInput= document.getElementById("mobileNumberInput");
		var sendOtpBtn=document.getElementById("sendOtpBtn");

		var otpInput=document.getElementById("otpInput");
		var verifyOtpBtn=document.getElementById("verifyOtpBtn");

		sendOtpBtn.onclick=function(){

			var phoneno = /^\d{10}$/;
			if(mobileNumberInput.value.match(phoneno))
			{
				// return true;
			}
			else
			{
				messageBoxDivMobileNumber.innerHTML="<div class=\"alert alert-danger\" role=\"alert\"><?php echo $ENTER_10_DIGIT ?></div>";
				return;
			}

			// window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
			//   'size': 'normal',
			//   'callback': (response) => {
			//     // reCAPTCHA solved, allow signInWithPhoneNumber.
			//     // ...
			//   },
			//   'expired-callback': () => {
			//     // Response expired. Ask user to solve reCAPTCHA again.
			//     // ...
			//   }
			// });

			window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('sendOtpBtn', {
			  'size': 'invisible',
			  'callback': (response) => {
			    // reCAPTCHA solved, allow signInWithPhoneNumber.
			    onSignInSubmit();
			  }
			});
			// console.log("+91"+mobileNumberInput.value);
			const appVerifier = window.recaptchaVerifier;
			firebase.auth().signInWithPhoneNumber("+91"+mobileNumberInput.value, appVerifier)
			    .then((confirmationResult) => {
			      // SMS sent. Prompt user to type the code from the message, then sign the
			      // user in with confirmationResult.confirm(code).
			      //console.log(confirmationResult);
			      window.confirmationResult = confirmationResult;
			      // ...
			    }).catch((error) => {
			      // Error; SMS not sent
			      // ...
			    });

			    enterMobileDiv.style.display = "none";
			    enterOtpDiv.style.display = "block";
		}


		verifyOtpBtn.onclick=function(){
			verifyOtpBtn.innerHTML="Please Wait...";

			confirmationResult.confirm(otpInput.value).then((result) => {
			  // User signed in successfully.
			  const user = result.user;
			  // console.log(result);
			  // console.log(result.user.l);
			  // console.log(result.user.xa);

			  verifyOtpBtn.innerHTML="OTP Verified";
			  messageBoxDivOTP.innerHTML="<div class=\"alert alert-success\" role=\"alert\">OTP Verified Successfully!</div>";
			  verifyOtpBtn.innerHTML="Redirecting...";
			  window.location.href = './ApplicantLogin?l='+result.user.l+'&xa='+result.user.xa;

			}).catch((error) => {
			  // User couldn't sign in (bad verification code?)

			  //console.log(error);
			  messageBoxDivOTP.innerHTML="<div class=\"alert alert-danger\" role=\"alert\"><?php echo $INCORRECT_OTP ?></div>";
			  verifyOtpBtn.innerHTML="Verify OTP";
			});

		}


	</script>


  </body>
</html>