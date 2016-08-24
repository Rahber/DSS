<?php
/*********************************************
	Copyright:	Nevdo
	File Name:	clt.php
	Package:	DSS
	Author:		Rahber
*********************************************/
include('./includes/functions.php');



if(isset($_GET['pwd']) && $_GET['pwd']=='dss'){
	echo "<table>";

	$queryy = $mysqli->query("SELECT * FROM session");
			while ($row = $queryy->fetch_object())
								{
								list($a,$b) = get_name($row->uid);
								
   echo "<tr><td>". $a ."</td><td>" . $b . "</td><td><a href='logout.php?go=".urlencode(encrypt_text($row->ais))."'>Logout this User</a></td></tr>";

}
	
	echo "</table>";
	
}

?>

<form method="get">

<input name="pwd" type="text" />

  <input type="submit" value="Submit">
</form>