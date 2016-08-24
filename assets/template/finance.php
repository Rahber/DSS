<?php

	
	if (!defined('INAPP'))
{
	exit;
}
auth_check();
if(get_level()==FA || get_level()==SA){
$sum = 0;
?>
<table id="agentlist"><thead><tr><th>Date</th><th>Total</th></tr></thead><tfoot><tr><th>Date</th><th>Total</th></tr></tfoot>
<?php

$queryy = $mysqli->query("Select
     sum(express) as sum,date from printrecord
group by date");
while ($row = $queryy->fetch_object())
		{
		
		echo "<tr><td>".$row->date."</td><td>".$row->sum."</td></tr>";
		
		$sum = $row->sum + $sum;
		}
?>
</tbody></table>
<table>
<tr style="color:#FF0000">
  <td colspan="8" align="left">Total Cash till date:&nbsp;&nbsp;<?=$sum;?></td>
</tr>
</table>
<table id="flist"><thead><tr><th>Date</th><th>Total</th><th>Printed By</th></tr></thead><tfoot><tr><th>Date</th><th>Total</th><th>Printed By</th></tr></tfoot>
<?php

$queryy = $mysqli->query("Select sum(express) as sum,date,printedby from printrecord group by date,printedby");
while ($row = $queryy->fetch_object())
		{
		
			 $aname = get_name($row->printedby);
		echo "<tr><td>".$row->date."</td><td>".$row->sum."</td><td>".$aname[0]."</td></tr>";
		
		$sum = $row->sum + $sum;
		}
?>
</tbody></table>
<?php 
}

?>