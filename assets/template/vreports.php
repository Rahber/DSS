<?php
	if (!defined('INAPP'))
{
	exit;
}

echo "<h1>View Verified Printed Slips</h1>";


echo "<table id='slipsreport' class='display' width='100%'><thead><tr><th>Ticket Number</th><th>Time</th><th>CNIC</th><th>Verified By</th></tr></thead><tfoot><tr><th>Ticket Number</th><th>Time</th><th>CNIC</th><th>Verified By</th></tr></tfoot><tbody>";


$queryy = $mysqli->query("SELECT * FROM verify  order by id  DESC ");


								while ($row = $queryy->fetch_object())
								{
								list($a,$b) = get_recordname($row->cnic);
								 $gg =get_name($row->pid);
   echo "<tr><td>".$row->tid."</td><td>". date("Y-m-d H:i:s",$row->t)."</td><td><a title='".$row->cnic."' href='view.php?id=".$b."'>".$a."</a></td><td>". $gg[0] ."</td></tr>";

}
echo "</tbody></table>";





?>