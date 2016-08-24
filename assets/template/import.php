<?php
	if (!defined('INAPP'))
{
	exit;
}
if(get_level()==FA){
auth_check();
	if(isset($_POST['Submit'])){
		if ($_FILES['csv']['size'] > 0) { 
		
			//get the csv file 
			$file = $_FILES['csv']['tmp_name']; 
			$handle = fopen($file,"r"); 
			 
			//loop through the csv file and insert into database 
			do { 
				if (@$data[0]) { 
					$mysqli->query("INSERT INTO labour (batch_no,nic,name,company,position,contact,city,address) VALUES 
						( 
							'".addslashes($data[0])."', 
							'".addslashes($data[1])."', 
							'".addslashes($data[2])."', 
							'".addslashes($data[3])."', 
							'".addslashes($data[4])."', 
							'".addslashes($data[5])."', 
							'".addslashes($data[6])."', 
							'".addslashes($data[7])."') 
					"); 
				} 
			} while ($data = fgetcsv($handle,1000,",","'")); 
			// 
		
			colored_text("Data was uploaded. An admin should enable these users before there slips can be printed","blue");
			add_log($_SESSION['id'],"Bulk labour records were added. ");
		
		} 
	}
?>
<h2>Bulk Upload</h2>
<form  method="post" enctype="multipart/form-data" name="form1">

						<input name="csv" type="file" id="csv"  />
					
			
						<input type="submit"  name="Submit" />
							


<br /><br />
<h1>Instructions</h1> 
<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-bordered table-striped " id="table">
				<thead>
					<tr>
						

						<th>Batch #</th>
						<th>NIC</th>
						<th>Name</th>
						<th>Company</th>
						<th>Position</th>
						<th>Contact No</th>
						<th>City</th>
						<th>Address</th>
						
					</tr>
				</thead>
				
			</table>
		</div>
	</div>
</div>
<ul>
<li><b>when you import excel file kindly follow this sequence:</b></li>
<li><b>when enter the all data in excel sheet then file save as with extension .csv, Like this(filename.csv)</b></li>
<li><b>Then import the csv file.</b></li>
</ul>
<a href="./assets/media/formate.csv"><b>Download</b></a>
</form>

<?php  } ?>
