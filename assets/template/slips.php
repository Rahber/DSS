<?php

	
	if (!defined('INAPP'))
{
	exit;
}
auth_check();

if(get_level()==FA || get_level()==CA || get_level()==LCA){
if(!$_POST){
?>
<script>
 $(function() {
            $("input:text:visible:first").focus();
        });
</script>
<section>
<form id="slipform-form" method="post" >
<p><input id="nic" type="text" name="nic"  value="" placeholder="CNIC/Passport Number" required></p>
 <p class="submit"><input class="login-submit" type="submit" name="commit" value="Go"></p>
</form>


<?php

}
if($_POST){

 $cnic = request_var('nic','');


$queryy = $mysqli->query("select * from userrecord where cnic = '$cnic'");

$rs		=	$queryy->fetch_array();



$allow = $rs['allow'];
if( ($queryy->num_rows)==1){
	
	$cnic = $rs['cnic'];
								
								
								if($allow!=0){
								redirect("print.php?go=".urlencode(encrypt_text($cnic)));
								}else{
									
									colored_text("The user you tried to issue slip is BANNED.","red");
									
									add_log($_SESSION['id'],"Banned User Slip Was tried with CNIC: ". $cnic);
								}
								
								
								
								
								}else{
								
								include('form.php');
								
								}
								}



}

?>

<h1>Banned Users</h1><marquee direction="left" scrolldelay="150" height="200" width="100%">
<?php 
$queryy = $mysqli->query("select * from userrecord where allow = '0'");
while ($row = $queryy->fetch_object()){
	
	echo "<span style='color:red' title='".$row->cnic."'><a style='color:red' href='view.php?id=".$row->id."'>".$row->fname . $row->lname ."</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
}

?>
</marquee>
</section>