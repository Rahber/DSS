
<?php


	
	if (!defined('INAPP'))
{
	exit;
}

auth_check();
if(get_level()==FA){
$id = request_var('id',0);
$sql = "select * from userrecord where id = '$id'";

$result		=	$mysqli->query($sql);
while ($res1 = $result->fetch_object()){

?>
<section>
<div class="detail">

<h2>Passenger History : <?php  echo $res1->fname ." ". $res1->lname ?></h2>
<table border='1' width='80%' cellspacing='0' align="center" cellpadding='2' bordercolor='#f4faff' bgcolor="#FFFFFF">
	<tr>
	<td>ID</td>
	<td><?php echo $res1->id;?></td>
	<td></td><td></td>

	<td rowspan="6"><img src="<? echo $res1->pic; ?>" border="2" width="85px"/></td></tr>
	<tr>
	<td>CNIC#</td>
	<td><?php echo $res1->cnic; ?></td>
	</tr>
	<tr>
	<td>Name</td>
	<td><?php echo  $res1->fname ." ".$res1->lname; ?></td>
	<td>Address</td>
	<td><?php echo $res1->address;?></td></tr>
	
	<tr>
	<td>Contact#</td>
	<td><?php echo $res1->phone;?></td>
	
	<td>Email</td>
	<td><?php echo $res1->email; ?></td></tr>
	
	
	
	<!--
	
	
	</tr>-->
	
	
	
	
	
	
	</table>
	
<?php } ?>

<h1>Tickets History</h1>
	<table id='agentlist' class='display' width='100%'>
	<thead>
	<tr>
	<th>Coupon#</th>
	<th>Date</th>
	<th>Embassay</th>
	<th>Service Charges</th>
	<th>Counters</th>
	</tr>
	</thead>
	<tfoot><tr>
	<th>Coupon#</th>
	<th>Date</th>
	<th>Embassay</th>
	<th>Service Charges</th>
	<th>Counters</th>
	</tr>
	</tfoot>

<?php


	
$queryy = $mysqli->query("SELECT * FROM printrecord where uid = '$id' ORDER BY id DESC ");
	
while ($row = $queryy->fetch_object()){
		
?>
<tr align="center">
<td><?php echo $row->id;  ?></a></td>
<td><?php echo $row->date;?></td>

<td><?php echo $row->embassy;?></td>
<td><?php echo $row->express;?></td>
<?php $aname = get_name($row->printedby); ?>
<td><?php echo $aname[0];?></td>

</tr>

<?php  }} ?>




</table>

</detail>
</section>