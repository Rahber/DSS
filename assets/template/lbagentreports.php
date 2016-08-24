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
<table id='reportslist' class='display' width='100%'>
<thead>
<tr>
<th>Sr#</th>
<th>Coupon#</th>
<th>Time</th>
<th>Name</th>
<th>NIC#</th>
<th>Company</th>

</tr>
</thead>
<tfoot>
<tr>
<th>Sr#</th>
<th>Coupon#</th>
<th>Time</th>
<th>Name</th>
<th>NIC#</th>
<th>Company</th>

</tr>
</tfoot>
<tbody>
<?php 

$i=1;
$amount = 0;

$queryy = $mysqli->query("select * from labourrecord where (printedby='$agent' and date='$date')");
		while ($row = $queryy->fetch_object())
		{
		
		list($a,$b) = get_labourname($row->lab_id);
		
		
		
		echo "<tr><td>".$i."</td><td>".$row->id."</td><td>".$row->date."</td><td>".$a."</td><td>".$b."</td><td>".get_company($row->company)."</td></tr>";
	
		
		

$i++;

}
/*}*/
?>
</tbody>
</table>

<table>
<tr style="color:#FF0000">
  <td colspan="8" align="left">Total Labour Slips Printed:&nbsp;&nbsp;<?=$i-1;?></td>
</tr>

</table>


