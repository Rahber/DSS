<?php

	
	if (!defined('INAPP'))
{
	exit;
}

auth_check();
if(get_level()==FA){


?>
<div class="container">
<h1>Administration Panel</h1>
					<div class="row">
					
					<div class="4u">
					<section class="special box">
					<a href="users.php" class="sklink">Users</a>
					
					</section></div>
					<div class="4u">
					<section class="special box">
					<a href="embassy.php" class="sklink">Embassy</a>
					
					</section></div>
					<div class="4u">
					<section class="special box">
					<a href="alabour.php" class="sklink">Labours</a>
					
					</section></div>
					<div class="4u">
					<section class="special box">
					<a href="acust.php" class="sklink">Customers</a>
					
					</section></div>
						<div class="4u">
					<section class="special box">
					<a href="company.php" class="sklink">Company</a>
					
					</section></div>
					<div class="4u">
					<section class="special box">
					<a href="ban.php" class="sklink">Banning</a>
					
					</section></div>
<div class="4u">
					<section class="special box">
					<a href="printd.php" class="sklink">Duplicate Slips</a>
					
					</section></div>
					
					 </div>




</div>

<?php

}

?>