<?php

	
	if (!defined('INAPP'))
{
	exit;
}

add_log($_SESSION['id'],"Agent Report was Printed.");
?><body onload="window.print(); redirected();">
<div class="row">
<div class="4u">Agent Name: <?php  $dn = get_name($_SESSION['id']); echo $dn[0]; ?> </div>
<div class="4u">Date: <?php  echo date('Y-m-d'); ?> </div>
</div>
<br /><br />
<table id="nsfw"><thead>
<tr>
<th>Sr#</th>
<th>Coupon#</th>
<th>Time</th>
<th>Name</th>

<th>NIC#</th>
<th>Embassy</th>
<th>Service Charges</th>
</tr>
</thead>
<tfoot>
<tr>
<th>Sr#</th>
<th>Coupon#</th>
<th>Time</th>
<th>Name</th>
<th>NIC#</th>
<th>Embassy</th>
<th>Service Charges</th>
</tr>
</tfoot>
<tbody>
<?php 
$idd= $_SESSION['id'];
$i=1;
$amount = 0;
$t = time();
$d = date('Y-m-d',$t);
$queryy = $mysqli->query("select * from printrecord where (printedby='$idd' and date='$d')");
		while ($row = $queryy->fetch_object())
		{
		
		list($a,$b) = get_recordname($row->cnic);
		
		if($row->express==500){
		$aa = 500;
		
		}else if($row->express==200){
		
		$aa=200;
		}else{
		$aa = 0;	
		}
		$amount = $amount + $aa;
		echo "<tr><td>".$i."</td><td>".$row->id."</td><td>".date("Y-m-d H:i:s",$row->t)."</td><td>".$a."</td><td>".$row->cnic."</td><td>".$row->embassy."</td><td>".$aa."</td></tr>";
	
		
		

$i++;

}

?>
</tbody>
</table>

<table>
<tr style="color:#FF0000">
  <td colspan="8" align="left">Total Service Charges:&nbsp;&nbsp;<?php echo $amount;?></td>
</tr>
<tr>
<td colspan="8" align="center" style="border-bottom:hidden;border-right:hidden;border-left:hidden;">
&nbsp;<br><input type="button" value="Print" class="add" onClick="redirected()">
</td>
</tr>
</table>

<script>
function redirected(){
				document.location.href="agentreport.php";
}</script>
<div class="small">================Verified Printed=====================</div>
</body>