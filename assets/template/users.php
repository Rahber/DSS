<section class='content'>
<?php

	
	if (!defined('INAPP'))
{
	exit;
}


$mode = request_var('action','');
$iid = request_var('id','');
$iid = urldecode(decrypt_text($iid));
auth_check();
if(get_level()==FA){

if($mode=='perm'){

include ('perm.php');

}else if ($mode =='delete'){

colored_text("You have deleted a user","red");

$mysqli->query("UPDATE login set active='0' where uid ='$iid'");
add_log($_SESSION['id'],"Deleted a user with user id ". $iid);
redirect("users.php",3);

}else if ($mode =='active'){

add_log($_SESSION['id'],"Activated a user with user id ". $iid);
colored_text("You have enabled a user","green");

$mysqli->query("UPDATE login set active='1' where uid ='$iid'");

redirect("users.php",3);

}else{
echo "<div class='container'>";

include ('add.php');
echo "<h1>Current Users</h1><table><tr><th>Username</th><th>Change Permission</th><th>Delete/Active</th></tr>";		
$queryy = $mysqli->query("select * from login");

 while ($row = $queryy->fetch_object()){
	
if($row->active==1){	
  echo "<tr class='asuccess'><td>". $row->fname ."</td><td><a href='users.php?action=perm&id=". urlencode(encrypt_text($row->uid)) ."'>Edit this User</td><td><a href='users.php?action=delete&id=".urlencode(encrypt_text($row->uid))."'>Delete this User</a></td></tr>";
	}else{

  echo "<tr class='aerror'><td>". $row->fname ."</td><td><a href='#". encrypt_text("users.php?action=perm&id=". urlencode(encrypt_text($row->uid))) ."'>Edit this User</td><td><a href='users.php?action=active&id=".urlencode(encrypt_text($row->uid))."'>Delete this User</a></td></tr>";

}	
								
							
								


}
echo "</table></div>";	

}
}
?>
</section>