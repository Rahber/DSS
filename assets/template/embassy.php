<?php

	
	if (!defined('INAPP'))
{
	exit;
}
auth_check();
if(get_level()==FA){

$status = request_var('status',0);

$s = 1 - $status;

if(isset($_GET['id'])){

$eid = request_var('id','');
$eid = urldecode(decrypt_text($eid));
$queryy = $mysqli->query("select * from embassy where embassyid=$eid");
while ($row = $queryy->fetch_object()){

$st = $row->active;
$sn = $row->name;
}

$st = 1 - $st;

$mysqli->query("UPDATE embassy set active='$st' where embassyid ='$eid'");
if($st==0){
$text= "Banned";
}else{
$text= "Unbanned";
}
colored_text("Embassy status of".$sn."has been changed","green");
add_log($_SESSION['id'],"Embassy status of ".$sn." has been changed to <b>".$text."</b>",1);
//redirect('embassy.php',1);
}
if($_POST){
$em = request_var('embassy','');

if( $mysqli->query("insert into embassy(name,active) values ('$em',0)")){
add_log($_SESSION['id'],$em." embassy was added!",1);
colored_text("Embassy was added","green");
}else{
colored_text("Error","red");
}
}

?>
<section>
<h2>Add New Embassy</h2>
<form id="embassy-form" method="post" >
	   
	   Embassy Name: <input type="text" name="embassy"  value="" placeholder="New Embassy">
	   <br />
	  <p class="submit"><input class="embassy-submit" type="submit" name="commit" value="Submit"></p>
	   </form>
<?php



$queryy = $mysqli->query("select * from embassy");




echo "<h1>Embassy</h1><table id='embassylist' class='display' width='100%'><thead><tr><th>Embassay Name</th><th>Status</th></tr></thead><tfoot><tr><th>Embassay Name</th><th>Status</th></tr></tfoot><tbody class='list'>";
 while ($row = $queryy->fetch_object()){
 if($row->active==0){ 
 $g= 'aerror';
 }else{
 $g= 'asuccess';
 }
 
echo "<tr class='".$g ."'><td>". $row->name ."</td><td><a href='embassy.php?id=". urlencode(encrypt_text($row->embassyid)) ."'>Change Status<span class='status'> ". $row->active ."</span></td></tr>";
	
 
 }}
 ?>
</tbody></table>
</section>
