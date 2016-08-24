<?php
	
	if (!defined('INAPP'))
{
	exit;
}

auth_check();


if($_POST){

 $p = request_var('p','');
 $pp = request_var('pp','');
 $lvl = request_var('usrlvl',1);
  $cnt = request_var('cnt',1);



if($p==$pp && $p!=''){

$query = $mysqli->query("UPDATE login set password='$p', accesslevel='$lvl', counter='$cnt'  where uid ='$iid'");
add_log($_SESSION['id'],get_name($iid)." password and permission were changed. New level".$lvl,1);
colored_text("User  password and permissions are changed!","green");
}else if($p=='' || $pp=''){

$query = $mysqli->query("UPDATE login set accesslevel='$lvl',counter='$cnt'  where uid ='$iid'");
colored_text("User permissions are changed!","blue");
$aname = get_name($iid);
add_log($_SESSION['id'],$aname[1]." permissions were changed. New level: ".$lvl,1);
}else{

colored_text("There was error. Please try again","red");
add_log($_SESSION['id'],"Failed attempt to change user level and permissions",1);
}

}
if(get_level()==FA){

$queryy = $mysqli->query("select * from login where uid = '$iid'");
if( $queryy->num_rows==1){
 while ($row = $queryy->fetch_object()){
 
 
?>


    <div class="container">
					
      <h1>User Permission of <?php echo $row->username; ?></h1>
	  <div class="rowp">
      <form id="perm-form" method="post" >
	   
	   New Password: <input type="text" name="p"  value="" placeholder="New Password">
	   Type New Password Again: <input type="text" name="pp"  value="" placeholder="New Password">
	   
	   User Level: <select name="usrlvl">
	   
	   <option value="1" <?php   if($row->accesslevel==1){echo "selected";}?>>Coupon Access Only </option>
	   <option value="2" <?php   if($row->accesslevel==2){echo "selected";}?>>Labour Access Only</option>
	   <option value="3" <?php   if($row->accesslevel==3){echo "selected";}?>>Coupon and Labour Access Only </option>
	   <option value="4" <?php   if($row->accesslevel==4){echo "selected";}?>>Reports Access</option>
	   <option value="6"<?php   if($row->accesslevel==6){echo "selected";}?>>BLHI</option>
	   <option value="5"<?php   if($row->accesslevel==5){echo "selected";}?>>Full Access</option>
	   
	   </select>
	   
	   Assigned Counter: <select name="cnt">
	   
	   <option value="1" <?php   if($row->counter==1){echo "selected";}?>>Normal Counter </option>
	   <option value="0" <?php   if($row->counter!=1){echo "selected";}?>>Express Counter</option>
	  
	   
	   </select>
	  <br />
	  <p class="submit"><input class="perm-submit" type="submit" name="commit" value="Submit"></p>
	  </form></div>
	  
	  <?php  
	  }
	  colored_text("Please leave the password field blank if you just want to change the permission level","blue");
	  }
	  ?>
	  
	  </div>

<?php 

}

?>