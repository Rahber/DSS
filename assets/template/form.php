   <?php
   	
	if (!defined('INAPP'))
{
	exit;
}


$cnic = request_var('cnic','');
if($_POST){

$fname = request_var('fname','');
$lname = request_var('lname','');
$cp = request_var('cnic','');
$phone = request_var('phone','');
$address = request_var('address','');
$snap = request_var('snap','');




if(verify_cnic($cp)){
colored_text("User already exist. Please check logs!","red");
redirect('slips.php',2);

}else{
if($fname!='' && $cp!=''){
$q = "INSERT INTO userrecord (fname,lname,address,cnic,pic,phone,email,allow) VALUES ('$fname','$lname','$address','$cp','$snap','$phone','no email','1');";
	if($mysqli->query($q)){
	
	colored_text("User record added. Please wait for page to reload.","green");
	add_log($_SESSION['id'],"User record was added. CNIC: ". $cnic);
	
	$ugl = "print.php?go=". urlencode(encrypt_text($cp));
	redirect($ugl,0);
	}
	}else{
	if(isset($_POST['formsmt'])){
	colored_text("Invalid Entry.","red");
	redirect("slips.php",0);
	}}
}
}
   
   ?>
<script type="text/javascript" src="assets/js/webcam.js"></script>
   <div class="container">
					
      <h1>New User</h1>
      <form id="slips-form" method="post" >
	  <div class="row">
						<div class="8u">
        First Name<input type="text" name="fname"  value="" placeholder="First Name" required>
		Last Name<input type="text" name="lname"  value="" placeholder="Last Name">
		
        CNIC/Passport No.<input type="text" name="cnic"  value="<?php  echo $cnic = request_var('nic',""); ?>" placeholder="CNIC/Passport" required>
        Phone No.<input type="text" name="phone"  value="" placeholder="Phone Number" required>
		Address<input type="text" name="address"  value="" placeholder="Address" required>
		</div>
		<div class="4u">Picture
		<br />
		
	
	
	<script language="JavaScript">
		webcam.set_api_url( 'includes/snap.php' );
		webcam.set_quality( 90 ); 
		webcam.set_shutter_sound( true ); 
	
		document.write( webcam.get_html(220, 140) );
	</script>
		
		
	<script language="JavaScript">
		webcam.set_hook( 'onComplete', 'my_completion_handler' );
		
		function take_snapshot() {
			document.getElementById('upload_results').innerHTML = '<h1>Uploading...</h1>';
			webcam.snap();
		}
		
		function my_completion_handler(msg) {
			if (msg.match(/(http\:\/\/\S+)/)) {
				var image_url = RegExp.$1;
				document.getElementById('upload_results').innerHTML = 
					'<img src="' + image_url + '"><input type="text" name="snap"  value="' + image_url + '" placeholder="Image" required readonly>';
				document.form.image.value =image_url  ;
				webcam.reset();
			}
			else alert("PHP Error: " + msg);
		}
		function do_upload() {
			// upload to server
			document.getElementById('upload_results').innerHTML = '<h1>Uploading...</h1>';
			webcam.upload();
		}
	</script>
		
	<br />
	
		<div id="upload_results"></div>
		
		<img src="assets/media/camera-icon.jpg" onClick="webcam.freeze()">
		&nbsp;
		<img src="assets/media/upload-icon.jpg" onClick="do_upload()">
		&nbsp;
		<img src="assets/media/reset-icon.jpg" onClick="webcam.reset()">
    
  </tr>
        <p class="submit"><input class="slips-submit" type="submit" name="formsmt" value="Submit"></p>
		
		</div>
		
		
		
		</div></div>
      </form>
    </div>