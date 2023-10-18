<?php
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){
  $urlOfQRCode = "https://"; 
}else {
  $urlOfQRCode = "http://"; 
}
$urlOfQRCode.= $_SERVER['HTTP_HOST'];   

if($urlOfQRCode=="http://localhost"){
  $urlOfQRCode.="/subhiksha";
}
?>
<ul class="nav justify-content-end">
  <a class="navbar-brand" href="#" style="margin-right: auto;margin-left: 10px;">
    <img src="<?php echo $urlOfQRCode ?>/assets/images/subhiksha_logo.png" width="60" height="60" alt="">
  </a>
  <li class="nav-item" style="margin: 5px;">
      <b><button style="margin: 5px;" type="button" class="btn btn-light" data-toggle="modal" data-target="#helpModal"><?php echo $HELP_BTN ?></button></b>
  </li>
  <li class="nav-item" style="margin: 5px;">
  		<div class="btn-group dropleft">
		  <button style="margin: 5px;" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-weight: bold;">
		    <?php echo $LANGUAGE_BTN ?>
		  </button>
		  <div class="dropdown-menu" style="text-align: right;">
		    <a class="dropdown-item" href="?languagePref=english">English</a>
		    <a class="dropdown-item" href="?languagePref=kannada">Kannada</a>
		  </div>
		</div>
  </li>
</ul>



<!-- HELP Modal -->
<div class="modal fade" id="helpModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        <?php echo $PHONE ?><br>
        <b><u>Bank Details</u></b><br>
        Name : Subhiksha Organic Farmers' Multi State Cooperative Society Ltd<br>
        Account No : 510101004439782<br>
        IFSC : UBIN0900184<br>
        Bank Name : Union bank of India,<br>
        Branch : Thirthahalli
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $CLOSE ?></button>
      </div>
    </div>
  </div>
</div>