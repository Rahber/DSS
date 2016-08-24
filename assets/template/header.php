<?php
	
	if (!defined('INAPP'))
{
	exit;
}

?><!DOCTYPE HTML>

<html>
	<head>
		<title>DSS</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />

		
			<link rel="stylesheet" href="<?php echo $sitepath;  ?>/assets/css/skel.css" />
			<link rel="stylesheet" href="<?php echo $sitepath;  ?>/assets/css/style.css" />
			<link rel="stylesheet" href="<?php echo $sitepath;  ?>/assets/css/jquery-ui.min.css" />
			<link rel="stylesheet" href="<?php echo $sitepath;  ?>/assets/css/jquery-ui.structure.min.css" />
			<link rel="stylesheet" href="<?php echo $sitepath;  ?>/assets/css/jquery-ui.theme.min.css" />
			<link rel="stylesheet" href="<?php echo $sitepath;  ?>/assets/css/jquery.dataTables.css" />
			<link rel="stylesheet" href="<?php echo $sitepath;  ?>/assets/css/dataTables.tableTools.css" />
			
			

	</head>
	<body id="top" class="<?php echo pgname(); ?>">

		<!-- Header -->
			<header id="header" class="skel-layers-fixed noprint">
				<h1><a href="#"><img src="./assets/media/small-logo.jpg" alt="" /></a></h1>
				<nav id="nav">
					<ul>
	

	
						
<?php if(!check_login()){?>
<li><a href="index.php">Home</a></li>
						<li><a href="index.php?item=contact">Contact</a></li>
<?php }else{ ?> 

 <li><a href="home.php">Home</a></li>
 
 <?php if(get_level()==FA || get_level()==LA || get_level()==LCA){?><li><a href="labour.php">Labours</a><?php } ?>
  <?php if(get_level()==FA || get_level()==LCA || get_level()==CA){?><li><a href="slips.php">Print Slips</a></li><?php } ?>

 <?php if(get_level()== FA || get_level()==SA ){?><li><a href="reports.php">View Reports</a></li>	<?php } ?>
  <?php if(get_level()==FA){?><li><a href="admin.php">Admin</a></li>	<?php } ?>
  <?php if(get_level()==BLHI ||get_level()==FA ){?><li><a href="blhi.php">BLHI</a></li>	<?php } ?>
  <li><a href="profile.php">Profile</a></li>
   <?php if(get_level()==LA || get_level()==LCA || get_level()==CA || get_level()==FA){?><li><a href="agentreport.php">My Report</a></li><?php } ?>
 <li><a href="logout.php">Logout</a></li>  
 
 <?php } ?>
					</ul>
				</nav>
			</header>
			<section id="one" class="wrapper style1">
			<div class="container">