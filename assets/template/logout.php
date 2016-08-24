<?php
	
	if (!defined('INAPP'))
{
	exit;
}

$go = request_var('go','');
if(isset($_GET['go'])){

 $go = urldecode(decrypt_text($go));
$mysqli->query("DELETE FROM session WHERE ais='$go'");
add_log($_SESSION['id'],"A user was forced logout");
redirect("viewreports.php?mode=users");

}else if(check_login()){
remove_session();

redirect('index.php',0);

}else{
redirect('index.php',0);
}

?>