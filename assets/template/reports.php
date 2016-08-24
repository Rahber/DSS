<?php

	
	if (!defined('INAPP'))
{
	exit;
}
auth_check();
if(get_level()==FA || get_level()==SA){
?>

<section class="content">


<div class="container">

<div class="row">
<div class="4u">
View Agent Report:<select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
    <option value="">Select...</option>
   

<?php

$queryy= $mysqli->query("select * from login");

while ($row = $queryy->fetch_object()){

echo "<option value='viewreports.php?mode=agent&id=".$row->uid."'>".$row->fname."</option>";


}





?>
</select>


</div>

<div class="4u">
View Labours by Agent Report:<select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
    <option value="">Select...</option>
   

<?php

$queryy= $mysqli->query("select * from login");

while ($row = $queryy->fetch_object()){

echo "<option value='viewreports.php?mode=lbagent&id=".$row->uid."'>".$row->fname."</option>";


}





?>
</select>


</div><div class="4u">
View Misc<select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
    <option value="">Select...</option>
   

<option value='finance.php'>Financials</option>";

<option value='stats.php'>Stats</option>";




</select>


</div></div><br /><br />
					<div class="row">
						<div class="4u">
							<section class="special box">
								
								
								
								<a href="viewreports.php?mode=users">View All Active Users</a>
							</section>
						</div>
						<div class="4u">
							<section class="special box">
								
							<a href="viewreports.php?mode=slips">View All Printed Slips</a>
							</section>
						</div>
						<div class="4u">
							<section class="special box">
								
								
							<a href="viewreports.php?mode=logs">View All Logs</a>
							</section>
						</div>
						<div class="4u">
							<section class="special box">
								
							
							<a href="viewreports.php?mode=labour">View All Labours Slips</a>
							</section>
						</div>
						<div class="4u">
							<section class="special box">
								
								
								
								<a href="sreports.php">Advance Reports</a>
							</section>
						</div>
						<div class="4u">
							<section class="special box">
								
								
								
								<a href="vreports.php">Verified Tickets</a>
							</section>
						</div>
					</div>
				</div>
</section>

<?php
}else{

redirect('home.php');
}

?>