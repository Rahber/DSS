

<?php
	if (!defined('INAPP'))
{
	exit;
}
auth_check();
if(get_level()==FA || get_level()==LA || get_level()==LCA){
$latestd=0;
$idd = $_SESSION['id'];
$go = request_var('go','');
 $cnic = urldecode(decrypt_text($go));

$queryy = $mysqli->query("select * from labour where (nic = '$cnic' and allow='1')");
while ($row = $queryy->fetch_object()){
$t = time();
$d = date('Y-m-d',$t);
$labid= $row->id;


$queryy = $mysqli->query("select * from labourrecord where lab_id = '$labid' order by date desc limit 1");
while ($roww = $queryy->fetch_object()){

 $latestd = $roww->date;
}
if(get_companystatus($row->company)!="0"){
if($d!=$latestd){

$q = "INSERT INTO labourrecord (lab_id,company,time,date,checked,printedby) VALUES ('$labid','$row->company','$t','$d','1','$idd');";
	if($mysqli->query($q)){
	
	add_log($_SESSION['id'],"Slip of Labour ID:". $labid ." was Printed");
	colored_text("the Slip is printing.","green");
	
	include('./assets/template/lprint-text.php');
	}
	}else{
	colored_text("The slip for this user has already been printed.","red");
	
	redirect('labour.php?act=already',300);
	}}else{
	colored_text("Labour Company has been blacklisted.","red");
	
	redirect('labour.php?act=blk',20);
	}
	}
	}
	?>