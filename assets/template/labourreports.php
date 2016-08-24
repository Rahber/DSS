<?php
	if (!defined('INAPP'))
{
	exit;
}

echo "<h1>View Printed Slips</h1>";


echo "<table id='agentlist' class='display' width='100%'><thead><tr><th>Name</th><th>NIC</th><th>Company</th><th>Time</th><th>Printed By</th></tr></thead><tfoot><tr><th>Name</th><th>NIC</th><th>Company</th><th>Time</th><th>Printed By</th></tr></tfoot><tbody>";

	

$queryy = $mysqli->query("SELECT * FROM labourrecord  order by id  DESC ");



								while ($row = $queryy->fetch_object())
								{
								list($a,$b) = get_labourname($row->lab_id);
								$p0 = get_name($row->printedby);
								
   echo "<tr><td><span>". $a ."</a></td><td>" . $b . "</td><td>". get_company($row->company)."</td><td>". $row->date."</td><td>".$p0[0] ."</td></tr>";

}
echo "</tbody></table>";


echo "<div class='info'>Some Info</div>";


?>