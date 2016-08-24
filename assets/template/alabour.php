<section>

<?php
	if (!defined('INAPP'))
{
	exit;
}
auth_check();

if(get_level()==FA){
?>

<a href="import.php" class="paginate_button button">Import New Labour</a><a href="addlabour.php" class="paginate_button button">Add New Labour</a>
<?php
if(isset($_GET['id'])){

$idd = request_var('id',0);
$allow = request_var('allow',0);
 $allow = 1 - $allow ;
$gg = $mysqli->query("UPDATE labour set allow ='$allow' where id = '$idd'");

if($allow ==0){
$text= "Banned";
}{
$text= "Unbanned";
}
add_log($_SESSION['id'],"Labour status of ".$idd." has been changed to <b>".$text."</b>",1);
colored_text("Labour status of ".$idd." has been changed","green");
}


$queryy = $mysqli->query("select * from labour");

echo "<table id='labourlist' class='display'  width='100%'><thead><tr><th>Name</th><th>Cnic</th><th>Company</th><th>Allowed</th></tr></thead><tfoot><tr><th>Name</th><th>Cnic</th><th>Company</th><th>Allowed</th></tr></tfoot><tbody class='list'>";
		while($row = $queryy->fetch_object()){
	
	 if($row->allow==0){ 
 $g= 'aerror';
 }else{
 $g= 'asuccess';
 }
	 
	echo "<tr><td title='Batch Number: ".$row->batch_no."'>".$row->name. "</td><td >".$row->nic. "</td><td title='".$row->position."'>".get_company($row->company). "</td><td class='".$g."'><a href='alabour.php?id=".$row->id."&allow=".$row->allow."'>". yes_no($row->allow)."</a><span class='status'>". $row->allow. "</span></td></tr>";
	
	}
	echo "</tbody></table>";
	}
?>

</section>