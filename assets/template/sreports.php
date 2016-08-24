<?php
	
	if (!defined('INAPP'))
{
	exit;
}
auth_check();


if(get_level()==FA){
	
	$id=request_var('id',0);
	
	if(isset($_GET['pag'])){
		if($_GET['ex']==1){
?>
<form name="form" method="post" action="export.php">
<?php
}else{
?>
<form name="form" method="post" action="search.php" target="_blank">

<?php } ?>
		
		
		<h2><?php 
if($id=='1'){echo "Report by Date"; }
if($id=='2'){echo "Report by Passport#/CNIC#";}
if($id=='3'){echo "Report by Coupon";}
if($id=='4'){echo "Report by Counter";}
if($id=='5'){echo "Report by Embassy";}
if($id=='8'){echo "Report by Passenger";}
?></h2>
<table border='1' bordercolor="#f4faff" width='98%' cellspacing='0' align="center" cellpadding='0' bgcolor="#FFFFFF">
<tr bgcolor="#f4faff">
<td align="right"><b>Date:</b>&nbsp;&nbsp;&nbsp;
        <?php echo date('F d, Y'); ?>  &nbsp;&nbsp;&nbsp;
    	<b>Time:</b>&nbsp;&nbsp;&nbsp;<?php echo date('h:i:s A',(time())); ?></td></tr>
		<tr><td>&nbsp;</td></tr>
<tr>
<td>
	<?php  if($id=='1' || $id=='4' || $id=='5' || $id=='6' || $id=='7' || $id=='8'){?>
	<b>Date From</b>&nbsp;&nbsp;<input type="text" name="start_date" id="datepicker"  />
	
	
	<b>Date To</b>&nbsp;&nbsp;<input type="text" name="end_date" id="datepicker2"  />
	
	<?php } if($id=='2'){?>
	<b>Passport#/CNIC#</b>&nbsp;&nbsp;
	<input type="hidden" name="id"  value="2"/>
	<input type='text' name='passp' id="passport"  />
	 <div id="box" class='result'></div>
	<?php } if($id=='3'){?>
	<b>Coupon# Start</b>&nbsp;&nbsp;
	<input type="text" name="start_ticket"  />
	&nbsp;&nbsp;
	<b>Coupon# End</b>&nbsp;&nbsp;
	<input type="text" name="end_ticket" />
	<?php }if($id=='4'){?>
	<select name='counter'>
	<option value=''>Select Counter</option>
	<?php
		$sql2 = $mysqli->query("select * from login order by uid");
		while($result2 = mysqli_fetch_array($sql2))
		{
			echo "<option value='".$result2['uid']."'>";
			echo $result2['username']."</option>";
		}
	?></select>
	
	<?php }if($id=='5' || $id=='8'){?>
	Embassy&nbsp;&nbsp;
    <select name='embassay'>
	<option value=''>Select Embassy</option>

	<?php
		$sql1 = $mysqli->query("select * from embassy");
		while($result1 = $sql1->fetch_object())
		{
			echo strtolower($result1->name);
			echo "<option value='".$result1->name."'>";
			echo $result1->name."</option>";
		}
	?>

		</select>
	<?php } 
	
	if($id=='8'){?>
	Name&nbsp;&nbsp;
	<input name="passenger" type="text"   />	
	<?php }if($id=='6'){?>
	<b>City</b>&nbsp;&nbsp;
	<select name='city' >
	<option value=''>Select City</option>
	<?php
		$sql2 = $mysqli->query("select * from passenger where city!='' group by city");
		while($result2 = $sql2->fetch_object())
		{
			echo strtolower($result2['city']);
			echo "<option value='".$result2['city']."'>";
			echo $result2['city']."</option>";
		}
	?>
	</select>
	<?php } if($id=='7'){?>
	<b>Country</b>&nbsp;&nbsp;
	<select name='country' >
	<option value=''>Select Country</option>
	<?php
		//$sql2 = mysql_query("select * from passenger where country!='' group by country");
		$sql2 = $mysqli->query("select * from country");
		while($result2 = $sql2->fetch_object())
		{
			//echo strtolower($result2['country']);
			echo "<option value='".$result2['countryname']."'>";
			echo $result2['countryname']."</option>";
		}
	?>

	</select>
	<?php } ?>
	
	
<button type='submit' name='search' value='nomoney' class='add'>Search Without Service Charges</button>
	<button type='submit' name='search' value='money' class='add'>Search With Service Charges</button>
	</td>

</tr>	</table>

		
		
		<?php
	}else{
?>
<section>
<h2>Standard Reports</h2>
<form>
<table border='1' bordercolor='#f4faff' width='80%' cellspacing='0' align="center" cellpadding='5' bgcolor="#FFFFFF">
<tr>
<td>

<input type="button" name="export" value="Export" checked="checked" onclick="hide(this.value)"/>&nbsp;&nbsp;

<input type="button" name="export" value="Without Export" onclick="hide(this.value)" />&nbsp;&nbsp;	

</td>
</tr>
<tr>
	<td>
	
	<div style="float:left; width:40%; display:block" id="without_export">
<ul>
<li>Without Export List <a href="sreports.php?pag=5&id=8&ex=0">By Passenger</a></li>
<li>Without Export List  <a href="sreports.php?pag=5&id=1&ex=0">By Date</a></li>
<li>Without Export List  <a href="sreports.php?pag=5&id=2&ex=0">By Passport#/CNIC#</a></li>
<li>Without Export List  <a href="sreports.php?pag=5&id=3&ex=0">By Coupon#</a></li>
<li>Without Export List  <a href="sreports.php?pag=5&id=4&ex=0">By Counter</a></li>
<li>Without Export List  <a href="sreports.php?pag=5&id=5&ex=0">By Embassy</a></li>

<li>Without Export List  <a href="search.php" target="_blank">By All Passenger</a></li>
</ul>
</div>

<div style="float:left; width:40%; display:none" id="export">
<ul>
<li>Export List <a href="sreports.php?pag=5&id=8&ex=1">By Passenger</a></li>
<li>Export List <a href="sreports.php?pag=5&id=1&ex=1">By Date</a></li>
<li>Export List <a href="sreports.php?pag=5&id=2&ex=1">By Passport#/CNIC#</a></li>
<li>Export List <a href="sreports.php?pag=5&id=3&ex=1">By Coupn#</a></li>
<li>Export List <a href="sreports.php?pag=5&id=4&ex=1">By Counter</a></li>
<li>Export List <a href="sreports.php?pag=5&id=5&ex=1">By Embassy</a></li>

<li>Export List <a href="export.php">By All Passenger</a></li>
</ul>
</div>



	</td>
</tr>
</table>
</form>

<script>

function hide(id){
if(id=='Export'){
document.getElementById("export").style.display="block";
document.getElementById("without_export").style.display="none";
}
if(id=='Without Export'){
document.getElementById("export").style.display="none";
document.getElementById("without_export").style.display="block";
}

}
</script>

</section>


	<?php }} ?>