<?php

	
	if (!defined('INAPP'))
{
	exit;
}
auth_check();
$dd = request_var('date',date('Y-m-d'));
if(get_level()==FA || get_level()==SA){
$sum = 0;
?>
<table id="agentlist"><thead><tr><th>Date</th><th>Total</th><th>Embassy</th></tr></thead><tfoot><tr><th>Date</th><th>Total</th><th>Embassy</th></tr></tfoot>
<?php

if($dd!=date('Y-m-d')){
$queryy = $mysqli->query("Select
     count(id) as sum,date,embassy from printrecord where date = '$dd'
group by date,embassy ");
}else{
$queryy = $mysqli->query("Select
     count(id) as sum,date,embassy from printrecord
group by date,embassy");
}

while ($row = $queryy->fetch_object())
		{
		
		
		
		echo "<tr><td>".$row->date."</td><td>".$row->sum."</td><td>".$row->embassy."</td></tr>";
		
		
		}
?>
</tbody></table>
<?php 
}

?>