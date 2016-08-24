<?php
	if (!defined('INAPP'))
{
	exit;
}

if(get_level()==BLHI ||get_level()==FA ){
echo "<h1>BLHI Printed Slips</h1>";


echo "<table id='blhilist' class='display' width='100%'><thead><tr><th>Name</th><th>NIC</th><th>Company</th><th>Date</th><th>Printed By</th></tr></thead><tfoot><tr><th>Name</th><th>NIC</th><th>Company</th><th>Date</th><th>Printed By</th></tr></tfoot><tbody>";

	

$queryy = $mysqli->query("SELECT * FROM labourrecord  where company = 1 order by id  DESC  ");



								while ($row = $queryy->fetch_object())
								{
								list($a,$b) = get_labourname($row->lab_id);
								$aname = get_name($row->printedby);
								
   echo "<tr><td><span>". $a ."</a></td><td>" . $b . "</td><td>". get_company($row->company)."</td><td>". $row->date."</td><td>".$aname[0] ."</td></tr>";

}
echo "</tbody></table>";




}
?>

<input type="button" value="Print" class="add" onClick="window.print()">