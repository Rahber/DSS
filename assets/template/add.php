<?php
	
	if (!defined('INAPP'))
{
	exit;
}

auth_check();
	
	
	if($_POST){
	 $username = request_var('uname','');
	 $fname = request_var('fname','');
	 $pw = request_var('p','');
	 $pww = request_var('pp','');
	 $lvl = request_var('usrlvl',1);
	$cnt = request_var('cnt',1);
	
	if($pw!=$pww || $pw==''){
	colored_text("passwords doesnt match", "red");
	}else if($fname=='' || $username==''){
	colored_text("There was an error. Please contact IT Support", "red");
	}else{
$t = time();
		$q = "INSERT INTO login (username,fname,password,accesslevel,active,registertime,counter) VALUES ('$username','$fname','$pw','$lvl',1,'$t','$cnt');";
	$mysqli->query($q);
	
	colored_text("User was successfully added","green");
	add_log($_SESSION['id'],"<b>".$username."</b> was added with access level".$lvl,1);
	}
	
	
	}
	?>


 <div class="container">
					
      <h1>Add New User</h1>
      <form id="usr-form" method="post" >
	  
						
        Username<input type="text" name="uname"  value="" placeholder="Username must be first alphabet and last name. e.g akhan for Ali Khan" required>
		Full Name<input type="text" name="fname"  value="" placeholder="Full Name" required>
        Password<input type="password" name="p"  value="" placeholder="Password" required>
        Password Again<input type="password" name="pp"  value="" placeholder="Password" required>
		 User Level: <select name="usrlvl">
	   
	   <option value="1" selected">Coupon Access Only </option>
	   <option value="2">Labour Access Only</option>
	   <option value="3">Coupon and Labour Access Only </option>
	   <option value="4">Reports Access</option>
	   <option value="5">Full Access</option>
	   <option value="6">BLHI</option>
	   </select>
		
		
		Counter: <select name="cnt">
	   
	   <option value="1" selected">Normal</option>
	   <option value="0">Express</option>
	   
	   </select>
		</div>
		<p class="submit"><input class="usr-submit" type="submit" name="commit" value="Submit"></p>
		
		
		
      </form>
    </div>
	
	
