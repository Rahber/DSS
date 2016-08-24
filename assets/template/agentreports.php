<?php

	
	if (!defined('INAPP'))
{
	exit;
}

$agent = request_var('id',0);

 $date = request_var('date',date('Y-m-d'));
?>


<div class="row">

<div class="4u">Agent Name: <?php  $anme= get_name($agent); echo $anme[0]; ?> </div>
<div class="4u">Date: <?php  echo $date ?> </div>
<div class="4u">
<form method="post">
Change date: <input type="text"name="date" id="datepicker" placeholder="YYYY-MM-DD">
<input type="submit">
</form></div>

<div class="turn-me-into-datepicker"></div>
</div>
<br /><br />
<table id='agentlist' class='display' width='100%'>
<thead>
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

$i=1;
$amount = 0;

$queryy = $mysqli->query("select * from printrecord where (printedby='$agent' and date='$date')");
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
		
		echo "<tr><td>".$i."</td><td>".$row->id."</td><td>".$row->date."</td><td><a href='view.php?id=".$b."'>".$a."</a></td><td>".$row->cnic."</td><td>".$row->embassy."</td><td>".$aa."</td></tr>";
	
		
		

$i++;

}
/*}*/
?>
</tbody>
</table>

<table>
<tr style="color:#FF0000">
  <td colspan="8" align="left">Total Service Charges:&nbsp;&nbsp;<?=$amount;?></td>
</tr>
<tr>
<td colspan="8" align="center" style="border-bottom:hidden;border-right:hidden;border-left:hidden;">
&nbsp;<br><input type="button" value="Print" class="add" onClick="window.print()">
</td>
</tr>
</table>


