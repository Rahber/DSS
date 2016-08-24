<?php

	
	if (!defined('INAPP'))
{
	exit;
}
auth_check();


$sql	=	"select * from labourrecord,labour where (labourrecord.lab_id='$labid'  and labourrecord.date='$d' and labour.id='$labid' and labour.allow='1')";
$result	=	$mysqli->query($sql);
$rs		=	$result->fetch_array();
	$id		=	$rs['id'];
	$status	=	$rs['status'];
	$batch	=	$rs['batch_no'];
	$nic	=	$rs['nic'];
	$name	=	$rs['name'];
	$company =	get_company($rs['company']);
	$position=	$rs['position'];
	$cell	=	$rs['contact'];
	$city	=	$rs['city'];
	$address=	$rs['address'];
	$image	=	$rs['image'];
	$status	=	$rs['status'];
	$allow	=	$rs['allow'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<script>
		function printed(){
			window.print();
			document.location.href="./labour.php";
		}
	</script>
</head>
<body onLoad="printed()">
<div class="10u">
<div class="5u left gg">
<div class="left">Company: <b><?php echo $company;?></b></div><div class="right">Batch Number: <b><?php echo $batch;?></b></div>
<div class="left"><b><?php echo $name;?></b><br><?php echo $nic;?><br><?php echo $city;?></div><div class="right"><?php if($image!=""){
			?>
			<img src="../img/labour_img/<?php echo $image;?>" class="img-thumbnail" height="100" width="100" />
			<?php }else{ ?>
				<img src="./assets/media/no-profile-pic.png" width="100" height="100" class="thumbnail" alt="200x200">
			<?php }?></div>
<div class="9u small left">This ticket is only valid for: <?php echo $d; ?></div><div class="right"><image src='./assets/media/ok.png' alt='' class='sm' /></div>
<div class="9u small left">Coupon #: <?php echo $id; ?></div>
</div>
<div class="space"></div>
<div class="5u left space gg">
<div class="left">Company: <b><?php echo $company;?></b></div><div class="right">Batch Number: <b><?php echo $batch;?></b></div>
<div class="left"><b><?php echo $name;?></b><br><?php echo $nic;?><br><?php echo $city;?></div><div class="right"><?php if($image!=""){
			?>
			<img src="../img/labour_img/<?php echo $image;?>" class="img-thumbnail" height="100" width="100" />
			<?php }else{ ?>
				<img src="./assets/media/no-profile-pic.png" width="100" height="100" class="thumbnail" alt="200x200">
			<?php }?></div>
<div class="9u small left">This ticket is only valid for: <?php echo $d; ?></div><div class="right"><image src='./assets/media/ok.png' alt='' class='sm' /></div>
<div class="9u small left">Coupon #: <?php echo $id; ?></div>
</div>
</div>
<br /><br /><br />

<div class="clear"></div

