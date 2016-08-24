<?php
	if (!defined('INAPP'))
{
	exit;
}
if($_POST){
 $p = request_var('p','');
 $pp = request_var('pp','');
 $op = request_var('op','');
 
 $iiid = $_SESSION['id'];
 if($pp!=$p){
 colored_text("Password doesn't match","red");
 
 }else{
 
 if($mysqli->query("UPDATE login set password='$p' where (password='$op' && uid='$iiid')")){
 
 
 if($mysqli->affected_rows>0){
  colored_text("Password changed!","green");
 }else{
 colored_text("Wrong old Password. Please try again","red");
 }
 
 

 }else{
 
 colored_text("Wrong Password. Please try again","red");
 }
 
 }
 
 }
?>

<section>
<h1>Profile</h1>
<form id="perm-form" method="post" >
	   Old Password: <input type="password" name="op"  value="" placeholder="Old Password" required>
	   New Password: <input type="password" name="p"  value="" placeholder="New Password" required>
	   Type New Password Again: <input type="password" name="pp"  value="" placeholder="New Password" required><br />
	   <p class="submit right"><input class="perm-submit" type="submit" name="commit" value="Submit"></p>
	  
	   </form>
</section>