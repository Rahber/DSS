<?php

	
	if (!defined('INAPP'))
{
	exit;
}
auth_check();

 get_level();
if(get_level()==FA || get_level()==CA || get_level()==LCA){

if($_POST){
$tid = 	request_var('tid',0);
$uid = $_SESSION['id'];
$queryy = $mysqli->query("select * from printrecord where id = '$tid'");
while ($row = $queryy->fetch_object()){
	$nc = $row->cnic;
	$nd = $row->uid;
}
if( ($queryy->num_rows)==1){
	
	$t = time();
	$q = "INSERT INTO verify (tid,t,pid,cnic) VALUES ('$tid','$t','$uid','$nc')";
	if($mysqli->query($q)){
		
		$queryy = $mysqli->query("select * from userrecord where cnic = '$nc'");
		while ($row = $queryy->fetch_object()){
			
			echo "<div style='background:green;width:600px;height:200px;font-size:30px;color:white;margin:0 auto;text-align: center;padding-top: 60px;'>
		Name: ". $row->fname. $row->lname ."
		<br />
		CNIC: ".$row->cnic."
		<br />
		<img src='".$row->pic."' alt='' />
		</div>";
		}
		
		
	}else{
		colored_text("There was an error","red");
	}
}else{
	
	echo "<div style='background:red;width:600px;height:200px;font-size:150px;color:white;margin:0 auto;text-align: center;padding-top: 60px;'>FRAUD</div>";
	
	
}
	
	
}else{
	echo "<div style='background:white;width:600px;height:200px;font-size:150px;color:white;margin:0 auto;text-align: center;padding-top: 60px;'></div>";
	
	
}


?>



<section class="noprint">
<h1>Verify ID</h1>
<form method="post" id="slip-print">

<p>Ticket Number:  <input type="text" name="tid" />



<p class="submit right"><input class="slips-submit" type="submit" name="commit" value="Submit"></p>
</form>
</section>
<?php
}
?>