<?php
if (!defined('INAPP'))
{
	exit;
}
auth_check();
if(get_level()==SA || get_level()==FA){

$mode=request_var('mode','');

$submode = request_var('item','');


?>

<section class="content">
<table>
<?php
if($mode=='users'){

echo "<tr><th>Name</th><th>Username</th><th>Last Active</th><th>Logout this User</th></tr>";
$queryy = $mysqli->query("SELECT * FROM session");

if(isset($_GET['item'])){


}else{


}
								while ($row = $queryy->fetch_object())
								{
								list($a,$b) = get_name($row->uid);
								
   echo "<tr><td>". $a ."</td><td>" . $b . "</td><td>" . date("Y-m-d H:i:s",$row->t) ."</td><td><a href='logout.php?go=".urlencode(encrypt_text($row->ais))."'>Logout this User</a></td></tr>";

}
}else if($mode=='logs'){
	


include('logreports.php');
}else if($mode=='slips'){

include('slipreports.php');

}else if ($mode =='labour'){
include('labourreports.php');
}else if ($mode =='agent'){
include('agentreports.php');
}else if ($mode =='lbagent'){
include('lbagentreports.php');
}else{
colored_text("No option selected","red");
}



?>
</table>
</section>


<?php
}else{

redirect('home.php');
}
?>