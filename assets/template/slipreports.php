<?php
	if (!defined('INAPP'))
{
	exit;
}

echo "<h1>View Printed Slips</h1>";


echo "<table id='slipsreport' class='display' width='100%'><thead><tr><th>Ticket Number</th><th>Name</th><th>CNIC</th><th>Embassy</th><th>Time</th><th>Mode</th><th>Printed By</th></tr></thead><tfoot><tr><th>Ticket Number</th><th>Name</th><th>CNIC</th><th>Embassy</th><th>Time</th><th>Mode</th><th>Printed By</th></tr></tfoot><tbody>";


$queryy = $mysqli->query("SELECT * FROM printrecord  order by id  DESC ");


								while ($row = $queryy->fetch_object())
								{
								list($a,$b) = get_recordname($row->cnic);
								$aname = get_name($row->printedby);
   echo "<tr><td>".$row->id."</td><td><span title='".$row->cnic."'>". $a ."</a></td><td><a href='view.php?id=".$b."'>".$row->cnic."</a></td><td>" . $row->embassy ."</td><td>". date("Y-m-d H:i:s",$row->t)."</td><td> ".$row->express."</td><td>".$aname[0] ."</td></tr>";

}
echo "</tbody></table>";





?>