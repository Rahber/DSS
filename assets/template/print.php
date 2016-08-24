<?php

	
	if (!defined('INAPP'))
{
	exit;
}
auth_check();


if(get_level()==FA || get_level()==CA || get_level()==LCA){

$go = request_var('go','');
$cnic = urldecode(decrypt_text($go));
$id = $_SESSION['id'];
  $t = time();
 $d = date('Y-m-d',$t);

$t = time();



$d = date('Y-m-d',$t);
$resultq= $mysqli->query("select * from printrecord where (cnic ='$cnic' and date ='$d') order by id desc limit 1");

$rs		=	$resultq->fetch_array();
$rst = $rs['t'];
 $t40 = $t - $rst;

if(@($queryy->num_rows>0)){
	
	colored_text("The slip for this user has been already printed.","blue");
}
 if($t40 > 2400){
if(verify_cnic($cnic)){
	
	 if($_POST){
 
  $emb = request_var('embassy','');
 $mode = request_var('trnfmode',0);
  $uid = get_recordname($cnic);
  $uid = $uid[1];

 $q = "INSERT INTO printrecord (uid,embassy,cnic,express,t,printedby,date) VALUES ('$uid','$emb','$cnic','$mode','$t',$id,'$d');";
	if($mysqli->query($q)){
	
	$rname = get_recordname($cnic);
	add_log($_SESSION['id'],"Slip Printed: Name: <b>".$rname[0] ."</b> of embassy <b>".$emb."</b>");
	colored_text("the Slip is printing.","green");
	include('print-text.php');
	exit();
	}
 
 }
 

?>



<section class="noprint">
<h1>Print Coupon</h1>
<form method="post" id="slip-print">

<p>Select Embassy <select name="embassy"></p>

<?php
$queryy = $mysqli->query("select * from embassy where active =1");

while ($row = $queryy->fetch_object()){

echo "<option value'". $row->embassyid. "'>". $row->name."</option>";
}



?>

</select>

<p>Mode <select name="trnfmode">

<?php 

if($_SESSION['counter'] ==1){
	
	?>
	<option value="200">Normal</option>
	<option value="0">Free</option>

	<?php
}else{
	?>
<option value="500">Speedway</option>	
<option value="0">Free</option>

	<?php
	
}

?>
</select></p>

<p class="submit right"><input class="slips-submit" type="submit" name="commit" value="Submit"></p>
</form>
</section>

<?php
}}else{


colored_text("Please wait 40 minutes or contact supervisor to print this slip","blue");
colored_text("You will be able to print slip for this user after: " . date("Y-m-d H:i:s",time()+2400-$t40),"blue");

if(get_level() == FA){

colored_text("As an admin you are printing the slip for this user before 40 minutes limit.","blue");
if(verify_cnic($cnic)){
	
	 if($_POST){
 
  $emb = request_var('embassy','');
 $mode = request_var('trnfmode',0);
  $uid = get_recordname($cnic);
  $uid = $uid[1];

 $q = "INSERT INTO printrecord (uid,embassy,cnic,express,t,printedby,date) VALUES ('$uid','$emb','$cnic','$mode','$t',$id,'$d');";
	if($mysqli->query($q)){
	$rname = get_recordname($cnic);
	add_log($_SESSION['id'],"Slip Printed: Name: <b>".$rname[0] ."</b> of embassy <b>".$emb."</b>");
	colored_text("the Slip is printing.","green");
	include('./assets/template/print-text.php');
	exit();
	}
 
 }
?>

<section class="slip-print">
<h1>Print Coupon</h1>
<form method="post" id="slip-print">

<p>Select Embassy <select name="embassy"></p>

<?php
$queryy = $mysqli->query("select * from embassy where active =1");

while ($row = $queryy->fetch_object()){

echo "<option value'". $row->embassyid. "'>". $row->name."</option>";
}



?>

</select>

<p>Mode <select name="trnfmode">
<?php
if($_SESSION['counter'] ==1){
	
	?>
	<option value="200">Normal</option>
	<option value="0">Free</option>

	<?php
}else{
	?>
<option value="500">Speedway</option>	
<option value="0">Free</option>

	<?php
	
}

?>

</select></p>

<p class="submit right"><input class="slips-submit" type="submit" name="commit" value="Submit"></p>
</form>
</section>

<?php


}
}

}
}
?>