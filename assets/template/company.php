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
$queryy = $mysqli->query("select * from company where cid=$eid");
while ($row = $queryy->fetch_object()){

$st = $row->status;
$sn = $row->company;
}

$st = 1 - $st;

$mysqli->query("UPDATE company  set status='$st' where cid ='$eid'");

colored_text("Company status of ".$sn ." has been changed","green");
//redirect('company.php',1);
if($st==0){
$text= "Banned";
}else{
$text= "Unbanned";
}
add_log($_SESSION['id'],"Company status of ".$sn ." has been changed to <b>".$text."</b>",1);
}
if($_POST){
$em = request_var('company','');

if( $mysqli->query("insert into company(name,status) values ('$em',0)")){
add_log($_SESSION['id'],$em." Company was added!");
colored_text("Company was added","green",1);
}else{
colored_text("Error","red");
}
}

?>
<section>
<h1>Add New Company</h1>
<form id="company-form" method="post" >
	   
      Company Name: <input type="text" name="company"  value="" placeholder="New Company">
	   <br />
	  <p class="submit"><input class="company-submit" type="submit" name="commit" value="Submit"></p>
	   </form>
<?php



$queryy = $mysqli->query("select * from company");




echo "<h1>Company</h1><table id='companylist' class='display' width='100%'><thead><tr><th>company Name</th><th>Status</th></tr></thead><tfoot><tr><th>Company Name</th><th>Status</th></tr></tfoot><tbody class='list'>";
 while ($row = $queryy->fetch_object()){
 if($row->status==0){ 
 $g= 'aerror';
 }else{
 $g= 'asuccess';
 }
 
echo "<tr class='".$g ."'><td>". $row->company ."</td><td><a href='company.php?id=". urlencode(encrypt_text($row->cid)) ."'>Change Status<span class='status'> ". $row->status ."</span></td></tr>";
	
 
 }}
 ?>
</tbody></table>
</section>
