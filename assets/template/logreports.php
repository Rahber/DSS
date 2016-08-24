<?php
	if (!defined('INAPP'))
{
	exit;
}


if(get_level()==SA || get_level()==FA){
$byid = request_var('uid',0);

echo "<h1>View logs</h1>";

	echo "<table id='agentlist' class='display' width='100%'><thead><tr><th>Time</th><th>Performed by</th><th>Action</th><th>Critical</th></tr></thead><tfoot><tr><th>Time</th><th>Performed by</th><th>Action</th><th>Critical</th></tr></tfoot></tbody>";


		

$queryy = $mysqli->query("SELECT * FROM log  order by logtime DESC ");

	
	
	

while ($row = $queryy->fetch_object()){
								$aname= get_name($row->uid);
								
   echo "<tr><td>". date("Y-m-d H:i:s",$row->logtime)."</td><td>" . $aname[0] . "</td><td>" . $row->action ."</td><td>" . $row->p ."</td></tr>";

}
echo "</tbody></table>";



}
?>