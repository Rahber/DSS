<section>

<?php
	if (!defined('INAPP'))
{
	exit;
}
auth_check();

if(get_level()==BLHI ||get_level()==FA ){
	
	
	if($_POST){
	
		$img	=	$_FILES['img']['name'];
		if($img!=""){				
			$newfile1			=	rand()*1200;
			$ext				=	strrchr($img,".");
			$newpic1			=	$newfile1.$ext;
			save($_FILES['img'],'',"./snaps/");
			rename("./snaps/".$img,"./snaps/".$newpic1);

			$sql	=	"insert into labour set
							batch_no		=	'".$_POST['batch']."',
							nic				=	'".$_POST['nic']."',
							name			=	'".$_POST['name']."',
							company			=	'".$_POST['company']."',
							position		=	'".$_POST['position']."',
							contact			=	'".$_POST['contact']."',
							city			=	'".$_POST['city']."',
							address			=	'".$_POST['address']."',
							image			=	'$newpic1',
							status			=	'1',
							allow			=	'1'
						";
		}else{
			$sql	=	"insert into labour set
							batch_no		=	'".$_POST['batch']."',
							nic				=	'".$_POST['nic']."',
							name			=	'".$_POST['name']."',
							company			=	'".$_POST['company']."',
							position		=	'".$_POST['position']."',
							contact			=	'".$_POST['contact']."',
							city			=	'".$_POST['city']."',
							address			=	'".$_POST['address']."',
							status			=	'0',
							allow			=	'0'
						";
		}

		$mysqli->query($sql);
		
		colored_text("Labour Added","green");
		add_log($_SESSION['id'],"BLHI Labour was added CNIC <b>". $_POST['nic'] ."</b>");
	
}
?>
<section>
<h1>Add Labour</h1>
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="well">
			<form method="post" enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label>Company:</label>
						<select name="company" class="form-control" required onchange="show_batch(this.value)">
							
							
							<option value="1" selected>BLHI</option>
							
						</select>
					</div>
					<div class="form-group">
						<label>Name:</label>
						<input type="text" name="name" value="" id="" class="form-control" placeholder="Full name" required autocomplete="off" />
					</div>
					<div class="form-group">
						<label>Contact #:</label>
						<input type="text" name="contact" value="" id="" class="form-control" maxlength="11" placeholder="Contact no" required autocomplete="off" onkeypress="return isNumberKey(event)" />
					</div>
					<div class="form-group">
						<label>City:</label>
						<input type="text" name="city" value="" id="" class="form-control" placeholder="City name" required autocomplete="off" />
					</div>
				</div>
				<div class="col-md-12">
					<div id="find_batch" class="form-group">
						<label>Batch no:</label>
						<input type="text" name="batch" value="" id="" class="form-control" placeholder="Batch no" required autocomplete="off" readonly="" />
					</div>
					<div class="form-group">
						<label>National ID #:</label>
						<input type="text" name="nic" class="form-control" placeholder="National ID #" required autocomplete="off" />
					</div>
					<div class="form-group">
						<label>Position:</label>
						<input type="text" name="position" value="" id="" class="form-control" placeholder="Your Postion" required autocomplete="off" />
					</div>
					<div class="form-group">
						<label>Image:</label>
						<input type="file" name="img" value="" id="" class="form-control" autocomplete="off" />
					</div>

				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label>Address:</label>
						<textarea name="address" class="form-control"></textarea>
					</div>
				</div>
			</div>
			<hr />
			<div class="row">
				<div class="col-md-12">
					<div class="pull-right">
						
						<p class="submit"><input class="perm-submit" type="submit" name="commit" value="Submit"></p>
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>
</section>
<?php
}

?>