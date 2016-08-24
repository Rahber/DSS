<section>
<h1>Labour Management System</h1>
<?php
	if (!defined('INAPP'))
{
	exit;
}
if(get_level()==LA || get_level()==LCA || get_level()==FA){
auth_check();
 
 if(isset($_GET['act'])){
	 $act = $_GET['act'];
 }else{
	 
	 $act = 'yo';
 }
if($_POST){


$bn = request_var('batch','');
$cnic = request_var('cnic','');
$queryy = $mysqli->query("select * from labour where (batch_no = '$bn' or nic='$cnic')");

if( @($queryy->num_rows)==1){
while ($row = $queryy->fetch_object()){

if($row->allow==1){
$gg = $mysqli->query("UPDATE labour set status ='1' where (batch_no = '$bn' or nic='$cnic')");
redirect("lprint.php?go=".urlencode(encrypt_text($row->nic)));
}else{

colored_text("Labour is Blacklisted.","red");
}
}
}else{

colored_text("No Record Found.","blue");

}
}


if($act=='already'){
	colored_text("The slip for this user has already been printed.","red");
	
}else{
	
}
?>










<h2>Print Slip</h2>
<div class="right">Today is: <?php echo date('Y-m-d',time()); ?></div>
<form method="post" name="labor-slip">
Labour Batch Number: <input type="text" name="batch"  value="" placeholder="Batch Number! - XXXX" >
CNIC: <input type="text" name="cnic"  value="" placeholder="CNIC! - XXXXX-XXXXXXX-X" >
<br />
<p class="submit"><input class="usr-submit" type="submit" name="labour" value="Submit"></p>
</form>


</section>
<?php } ?>