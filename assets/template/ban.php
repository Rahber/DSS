<section>

<?php
if (!defined('INAPP'))
{
	exit;
}
auth_check();

if(get_level()==FA){

if(isset($_GET['id']) && !$_POST){

$idd = request_var('id',0);
$allow = request_var('allow',0);
 $allow = 1 - $allow ;
$gg = $mysqli->query("UPDATE userrecord set allow ='$allow' where id = '$idd'");

if($allow ==0){
$text= "Banned";
}else{
$text= "Unbanned";
}
add_log($_SESSION['id'],"Customer status of ".$idd." has been changed to <b>".$text."</b>",1);
colored_text("Customer status of ".$idd." has been changed","green");


}

?><h1>
Ban a User
</h1><form method="post">
<input name="name" type="text" placeholder="Enter Name or CNIC or Passport No."  />	
<input type="submit"></form>
<?php
if($_POST){
	
$queryy = $mysqli->query("select * from userrecord where (fname like '%".$_POST['name']."%' or lname like '%".$_POST['name']."%'or cnic like '%".$_POST['name']."%'or passp like '%".$_POST['name']."%') ");

echo "<table id='labourlist' class='display'  width='100%'><thead><tr><th>Name</th><th>Cnic</th><th>phone</th><th>Allowed</th></tr></thead><tfoot><tr><th>Name</th><th>Cnic</th><th>phone</th><th>Allowed</th></tr></tfoot><tbody class='list'>";
		while($row = $queryy->fetch_object()){
	
	 if($row->allow==0){ 
 $g= 'aerror';
 }else{
 $g= 'asuccess';
 }
	 
	echo "<tr><td><a href='view.php?id=".$row->id."'>".$row->fname." ".$row->lname . "</a></td><td >".$row->cnic. "</td><td>".$row->phone. "</td><td class='".$g."'><a href='ban.php?id=".$row->id."&allow=".$row->allow."'>". yes_no($row->allow)."</a><span class='status'>". $row->allow. "</span></td></tr>";
	
	}
	echo "</tbody></table>";
	}	
	

}


?>

</section>