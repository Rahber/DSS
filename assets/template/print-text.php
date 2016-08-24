<?php

	
	if (!defined('INAPP'))
{
	exit;
}
auth_check();


$sql	=	"select *,printrecord.id as user_id from printrecord,userrecord where (userrecord.cnic='$cnic'  and printrecord.date='$d' and printrecord.cnic='$cnic' ) order by t desc";
$result	=	$mysqli->query($sql);
$rs		=	$result->fetch_array();
	$id		=	$rs['user_id'];
	$uid	=	$rs['uid'];
	$embassy	=	$rs['embassy'];
	$nic	=	$rs['cnic'];
	$express	=	$rs['express'];
	$date =$rs['date'];
	
	$t = $rs['t'];
	$adress=	$rs['address'];
	$cell	=	$rs['phone'];
	$pic	=	$rs['pic'];
	$fname=	$rs['fname'];
	$lname	=	$rs['lname'];
	$aname = get_name($rs['printedby']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<script>
		function printed(){
			window.print();
			document.location.href="./slips.php";
		}
	</script>
</head>
<body onLoad="printed()">


	<div class="left fprint" style="width:800px;">


<div class="left gg mpn-text" style="width:550px">
<div class="left"><span style="font-weight:bold;font-size:16px;"><?php echo $embassy; ?></span></div><div class="right" style="font-size:9px">Ticket No: <b><?php echo $id;?></b></div><br />
<div class="left">Name: <b><?php echo $fname . $lname;?></b><br>Cnic: <?php echo $nic;?><br></div><div class="right"><?php if($pic!=""){
			?>
			<img src="<?php echo $pic;?>" class="img-thumbnail" height="80" width="80" />
			<?php }else{ ?>
				<img src="./assets/media/no-profile-pic.png" width="80" height="80" class="thumbnail" alt="200x200">
			<?php }?></div>



<br />
<div class="small left">This ticket is only valid for: <?php  echo date("Y-m-d H:i:s",$t); ?>  <br /> Issued By:<?php echo $aname[0] ?> <br /><div class="left">Coupon Price: Rs.<?php  if ($express != 500){
?>  <?php  echo $express ;} ?> </div></div>
</div>
<div class="left gg gng-text" style="width:250px;border-right:0;">
<div class="left"><b><?php echo $embassy;?></b></div><div class="right">Ticket No: <b><?php echo $id;?></b></div><br />
<div class="left">Name: <b><?php echo $fname . $lname;?></b><br>Cnic: <?php echo $nic;?></div><br />
<div class="right"><span class="small">Phone No: <?php echo $cell;?></span></div>

<div class="small left" width="750px;">Ticket Valid for SINGLE journey on <?php echo $d; ?> <br /> Issued By:<?php echo $aname[0] ?></div>
</div>
<div class="left" width="800px;">
<div class="small left s-text" width="800px;">
&#9830;<strong>We provide following services:-</strong><br>
&nbsp;&nbsp;Security Checking, Data Entry, Snap Shot, Mobile, Luggage Deposit, Pick & Drop etc.<br>
&#9830;  Coupon will NOT be cancelled/refunded once issued.<br>
&#9830;  Coupon must be shown to driver on return from Embassy. DSS will not entertained in case Loss of Coupon.<br>
&#9830;  Mobile, Camera, Weapon, Eatables are NOT allowed during visit. Please deposit at counter.<br>&#9830;  This is a SINGLE journey ticket valid ONLY for the above mentioned Embassy.<br>
&#9830;  Take care of your belongings during visit. DSS will not be responsible for compensation.<br>

<?php  if ($express == 500){
?>
&#9830;<strong>Speed way optional facilities:-</strong><br>
&nbsp;&nbsp;Refreshment (Snacks, Biscuits, Coffee, Tea, Green Tea, Juices, Cold Drinks, Mineral Water)<br />
&nbsp;&nbsp;LCD TV, Air-conditioned/Heating Environment, Internet, Fax, Local Calls, Printing, Newspapers/Magazines, Luxury Small Coaches<br>

<?php  } ?>
&#9830;  <span style="font-weight:bold;">DSS Helpline: 051-2601524 - 3 </span>
</div>

<?php  if ($express == 500){
?>
	<div class="left" width="200px">
<img src="./assets/media/rib.png" alt="" />
</div>
	<?php	
}else{
	?>
	<div class=" left" width="200px">

</div>
	<?php
}
?>

</div>

</div>
<div class="clear"></div>
<br /><br /><br />

<div class="clear"></div>
</body>

