<?php

	
	if (!defined('INAPP'))
{
	exit;
}
auth_check();

if(get_level()==FA){

$go = request_var('go','');
$cid = request_var('id',0);
$cnic = urldecode(decrypt_text($go));
$id = $_SESSION['id'];
  $t = time();
 $d = date('Y-m-d',$t);



	

	 if(isset($_GET['go'])){
 

 $uid = get_recordname($cnic);
  $uid = $uid[1];

$rname = get_recordname($cnic);
	
	add_log($_SESSION['id'],"Duplicate Slip Printed: Name: <b>".$rname[0] ." </b>Ticket ID <b>" .$cid."</b>");
	colored_text("the Slip is printing.","green");
	echo "<div><b>Duplicate Print</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Duplicate Print</b></div>";
	include('./assets/template/print-text.php');
	exit();
	
 
 }

?>



<section class="noprint">
<h1>Todays Printed Slips</h1>




<?php

echo "<table id='slipsreport' class='display' width='100%'><thead><tr><th>Ticket Number</th><th>Name</th><th>CNIC</th><th>Embassy</th><th>Time</th><th>Mode</th><th>Printed By</th></tr></thead><tfoot><tr><th>Ticket Number</th><th>Name</th><th>CNIC</th><th>Embassy</th><th>Time</th><th>Mode</th><th>Printed By</th></tr></tfoot><tbody>";


$queryy = $mysqli->query("SELECT * FROM printrecord where date = '$d' order by id  DESC ");


								while ($row = $queryy->fetch_object())
								{
								list($a,$b) = get_recordname($row->cnic);
								$aname = get_name($row->printedby);
								
   echo "<tr><td><a href='printd.php?id=".$row->id."&go=".urlencode(encrypt_text($row->cnic))."'>".$row->id."</a></td><td><span title='".$row->cnic."'>". $a ."</a></td><td>".$row->cnic."</td><td>" . $row->embassy ."</td><td>". date("Y-m-d H:i:s",$row->t)."</td><td> ".$row->express."</td><td>".$aname[0] ."</td></tr>";

}
echo "</tbody></table>";

?>
</section>

<?php



}

?>