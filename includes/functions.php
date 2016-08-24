<?php
/*********************************************

	Copyright:	Nevdo
	File Name:	functions.php
	Package:	DSS
	Author:		Rahber

*********************************************/



global $mysqli;


function startSession($timeout = 600){ /* Start session and session cronning */
	global $mysqli;
	session_name('czid');
	session_set_cookie_params(0);
	session_start();

	if (isset($_SESSION['timeout_idle']) && $_SESSION['timeout_idle'] < time()) {

		//logout();
		
    }else{
	$_SESSION['timeout_idle'] = time() + $timeout;
	}
    

}

function update_lastpage($page){ /* Update user last page */
	global $mysqli;
	
	if($page!='logout' &&check_login()){
	$id = $_SESSION['id'];
	if($mysqli->query("UPDATE login set lastpage='$_SERVER[REQUEST_URI]' where uid ='$id'")){
		return true;
	}
	else {
		return false;
	}
	return false;
	}

}

function takemehome(){ /* Redirection to home. */

redirect("home.php");

}

function update_session(){ /* Update session and update time so user is always with in 10 minutes of activity */
	if(check_login()){
	global $mysqli;
		$sep = $_SESSION['true'];
		$id = $_SESSION['id'];
		$t = time();
		if($mysqli->query("UPDATE session set t='$t' where (sessionid='$sep' and uid ='$id')")){
			return true;
		}
		else {
			return false;
		}
	}else{  return false;  }
}

function randomalpha($length){  /* Random string generator */
    $alphNums = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";        
    $newString = str_shuffle(str_repeat($alphNums, rand(1, $length))); 
    return substr($newString, rand(0,strlen($newString)-$length), $length); 
} 

function set_name($title){ /* Set name {{sname}} with the given variable */

	$pageContents = ob_get_contents (); // Get all the page's HTML into a string
	ob_end_clean (); // Wipe the buffer
	$title =  $title ." - ". get_config('sitename') ;
	echo str_replace ('{{sname}}', $title, $pageContents);
}

function remove_session(){/* Logout a user */
	global $mysqli;
	$ds = $_SESSION['true'];
	$mysqli->query("DELETE FROM session WHERE sessionid='$ds'");
	setcookie("dss", "", time()-3600);
	add_log($_SESSION['id'],"User successfully logged out!",0);
	
	
	session_unset();
	$_SESSION = array();
	
    session_destroy();
	startSession();
	session_regenerate_id();

}

function get_name($uid){ /* Get current user name */
global $mysqli;
	$result = $mysqli->query("SELECT * FROM login where uid='$uid'");
	while($row = $result->fetch_object()){
		return  array( $row->fname,$row->username) ;
	}

}

function get_recordname($cnic){ /* Get user record name */
global $mysqli;

	$result = $mysqli->query("SELECT * FROM userrecord where cnic='$cnic'");
	while($row = $result->fetch_object()){
		return   array($row->fname." ".$row->lname,$row->id) ;
	}

}

function get_labourname($labid){ /* Get user record name */
global $mysqli;

	$result = $mysqli->query("SELECT * FROM labour where id='$labid'");
	while($row = $result->fetch_object()){
		return   array($row->name,$row->nic) ;
	}

}

function update_config($name,$data){ /* Update Configurations */
	global $mysqli;
	if($mysqli->query("UPDATE config set value='$data' where name='$name'")){
		return true;
	}
	else {
		return false;
	}
}

function get_config($vvalue){  /*  Get values from configuration. Configuration to do.*/
	global $mysqli;
	$result = $mysqli->query("SELECT * FROM config where name='$vvalue'");
	while($row = $result->fetch_object()){
		return $p = $row->value;
	}
}


function redirect($add,$delay=0){ /* Redirection Script */
	echo "<script>window.setTimeout(function(){ window.location = '".$add."'; }, ".$delay.")</script>";
	//header("Refresh:". $delay .";url=". $add ); 
}


function onpage($ppg){ /* Returns true if you are on current page */
	if($ppg==pgname())
		return true;
	else
		return false;
}

function pgname(){ /* Current page full name without extension */
	$currentFile = $_SERVER["PHP_SELF"];
	$parts = Explode('/', $currentFile);
	$parts = $parts[count($parts) - 1];
	$parts = Explode('.', $parts);
	$pageName = $parts[0];
	return $pageName;
}

function fullpagename(){ /* Current page full name with exntension */
	$currentFile = $_SERVER["PHP_SELF"];
	$parts = Explode('/', $currentFile);
	$parts = $parts[count($parts) - 1];
	return $parts;

}

function set_var(&$result, $var, $type, $multibyte = false) /* Part of request_var function */
{
	settype($var, $type);
	$result = $var;

	if ($type == 'string')
	{
		$result = trim(htmlspecialchars(str_replace(array("\r\n", "\r", "\0"), array("\n", "\n", ''), $result), ENT_COMPAT, 'UTF-8'));

		if (!empty($result))
		{
			// Make sure multibyte characters are wellformed
			if ($multibyte)
			{
				if (!preg_match('/^./u', $result))
				{
					$result = '';
				}
			}
			else
			{
				// no multibyte, allow only ASCII (0-127)
				$result = preg_replace('/[\x80-\xFF]/', '?', $result);
			}
		}

		//$result = (STRIP) ? stripslashes($result) : $result;
	}
}


function request_var($var_name, $default, $multibyte = false, $cookie = false) /* GET OR POST  Alternative. Always use it to avoid injection or hacking attempts  */
{
	if (!$cookie && isset($_COOKIE[$var_name]))
	{
		if (!isset($_GET[$var_name]) && !isset($_POST[$var_name]))
		{
			return (is_array($default)) ? array() : $default;
		}
		$_REQUEST[$var_name] = isset($_POST[$var_name]) ? $_POST[$var_name] : $_GET[$var_name];
	}

	$super_global = ($cookie) ? '_COOKIE' : '_REQUEST';
	if (!isset($GLOBALS[$super_global][$var_name]) || is_array($GLOBALS[$super_global][$var_name]) != is_array($default))
	{
		return (is_array($default)) ? array() : $default;
	}

	$var = $GLOBALS[$super_global][$var_name];
	if (!is_array($default))
	{
		$type = gettype($default);
	}
	else
	{
		list($key_type, $type) = each($default);
		$type = gettype($type);
		$key_type = gettype($key_type);
		if ($type == 'array')
		{
			reset($default);
			$default = current($default);
			list($sub_key_type, $sub_type) = each($default);
			$sub_type = gettype($sub_type);
			$sub_type = ($sub_type == 'array') ? 'NULL' : $sub_type;
			$sub_key_type = gettype($sub_key_type);
		}
	}

	if (is_array($var))
	{
		$_var = $var;
		$var = array();

		foreach ($_var as $k => $v)
		{
			set_var($k, $k, $key_type);
			if ($type == 'array' && is_array($v))
			{
				foreach ($v as $_k => $_v)
				{
					if (is_array($_v))
					{
						$_v = null;
					}
					set_var($_k, $_k, $sub_key_type, $multibyte);
					set_var($var[$k][$_k], $_v, $sub_type, $multibyte);
				}
			}
			else
			{
				if ($type == 'array' || is_array($v))
				{
					$v = null;
				}
				set_var($var[$k], $v, $type, $multibyte);
			}
		}
	}
	else
	{
		set_var($var, $var, $type, $multibyte);
	}

	return $var;
}



function short($string, $limit, $break=".", $pad="..."){ /* Cuts a given paragraph into small chunk with ... dots */
	if(strlen($string) <= $limit) return $string;
	if(false !== ($breakpoint = strpos($string, $break, $limit))) {
		if($breakpoint < strlen($string) - 1) {
			$string = substr($string, 0, $breakpoint) . $pad;
		}
	}
	return $string;
}
 








function encrypt_text($value) /* 256bit Rijndael encryption */
{
   if(!$value) return false;
 
   $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, 'SECURE_STRING_1', $value, MCRYPT_MODE_ECB, 'SECURE_STRING_2');
   return trim(base64_encode($crypttext));
}
 
function decrypt_text($value) /* Decryption Functions */
{ 
   if(!$value) return false;
 
   $crypttext = base64_decode($value);
   $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, 'SECURE_STRING_1', $crypttext, MCRYPT_MODE_ECB, 'SECURE_STRING_2');
   return trim($decrypttext);
}


function verify_cnic($cnic) /* verify user nic */
{


global $mysqli;
$queryy = $mysqli->query("select * from userrecord where cnic= '$cnic'");

return @(($queryy->num_rows==1) ? true : false);


}


function do_login($email,$password){ /*  Do login*/
	
	
	
	
	global $mysqli;
	
	
	if($email!='' || $password!=''){
	$queryy = $mysqli->query("select * from login where (username='$email' and password='$password')");

		if( ($queryy->num_rows)==1){
			while ($row = $queryy->fetch_object()){
			
				if(user_already($row ->uid)){
				
		add_log($row ->uid,"User tried login when he was already logged in some where else",1);
		return colored_text("User is already logged in. Please contact supervisor", "red");
		
				}else if($row->active==0 ){
				return colored_text("Your account was disabled/deleted by admin.", "red");
				
				}else{
					$ds = session_id();
				$_SESSION['id'] = $row ->uid;
				$_SESSION['fname'] = $row ->fname;
				$_SESSION['name'] = $row ->username;
				$_SESSION['counter'] = $row ->counter;
				$_SESSION['accesslevel'] = $row ->accesslevel;
				$_SESSION['host'] = $_SERVER['HTTP_HOST'];
				$_SESSION['true'] = $ds;
				setcookie("dss", $ds, time()+86400);
				
				insert_ses($ds,$row ->uid);
				
				
				add_log($row ->uid,"User successfully logged in",0);
				redirect('home.php',$delay=0);
				return colored_text("User successfully logged in! Please wait for browser to load.", "green");
				}
			}
		}
		else{
			
				@add_log(0,"Unauthorized Access. " . $_SERVER['REMOTE_ADDR'],0);
				return colored_text("Invalid Credentials!", "red");
				
							
		}}else{
		
			return colored_text("Please fill all fields", "yellow");
		}
}

function get_level()/* Get user access level  */{
$lvl = $_SESSION['accesslevel'];


return $lvl;
}
function insert_ses($a,$b){ /* Insert current session in db */
	global $mysqli;
	$time = time();
	$ip = $_SERVER['REMOTE_ADDR'];
	$ip2 =  '';// $_SERVER['HTTP_X_FORWARDED_FOR'];
	$q = "INSERT INTO session (uid,sessionid,t,ip,ip2) VALUES ('$b','$a','$time','$ip','$ip2');";
	$mysqli->query($q);
}

function check_login(){ /*  Returns true or false that is a user is logged in or not */
	$ddd = session_id() ;global $mysqli;		
	if(isset($_SESSION['id'])){	
				
		$queryy = $mysqli->query("select * from session where (sessionid='$ddd')");
		$row_cnt = $queryy->num_rows;
	
	$cookie = request_var('dss', "", false, true);
	
		if($row_cnt==1 && $cookie==$ddd){
			return true;
		}else{
			return false;
		}
	
	}
	else{
			
		return false;
	}
}

function remove_http($url) { /* Remove http or https from url */
   $disallowed = array('http://', 'https://');
   foreach($disallowed as $d) {
      if(strpos($url, $d) === 0) {
         return str_replace($d, '', $url);
      }
   }
   return $url;
}

function getsubpage(){ /* Get Subpage  */

$currentFile = $_SERVER["PHP_SELF"];
	$parts = Explode('/', $currentFile);
	$parts = $parts[count($parts) - 1];
	$parts = Explode('.', $parts);
	$pageName = $parts[0];
	return $pageName;


}

function auth_check(){ /* Check if a user is logged in or not */
	$pg = pgname();
	global $sitepath;
	if(!check_login() && $pg !='index'){
		redirect($sitepath.'/index.php?return='.$pg,0);
		die();
	}else if(check_login() && $pg =='index'){
	redirect($sitepath.'/home.php');
	}
}



function user_already($id)/* Function to check if user is already logged in */{

global $mysqli;
$query = $mysqli->query("select * FROM session WHERE uid='$id'");
if($query->num_rows != 0 ){
return true;

}else{
return false;
}
}

function add_log($uid,$action,$prior=0){ /* Add log values*/
	global $mysqli;
	$time = time();
	$q = "INSERT INTO log (uid,action,logtime,p) VALUES ('$uid','$action','$time',$prior);";
	$mysqli->query($q);
}

function cron_session(){ /* Check if the session that exist in database is older than 10 minutes*/
	global $mysqli;
	$t = time();
	$queryy =  $mysqli->query("Select * from session");
		while ($row = $queryy->fetch_object()){
			$op = $row->sessionid;
			if((($t) - ($row->t)) > 600){
			$mysqli->query("DELETE FROM session WHERE sessionid='$op'");
			setcookie("dss", "", time()-3600);
			}
		}
		
	
}

function send_email($email,$subject,$body,$bccallow=0,$bccemail=''){ /* Send email function*/
	global $contactemail;
    $to = $email; 
    $from = $contactemail; 

    $headers = "MIME-Version: 1.0rn"; 
    $headers .= "Content-type: text/html; charset=iso-8859-1rn"; 
    $headers  .= "From: $from\r\n"; 

   if($bccallow==1){
    $headers .= "Bcc: $bccemail"; 
	}
 
    // now lets send the email. 
    if(mail($to, $subject, $body, $headers)){
		return 1;	
	}else{
		return 0;
	}



}




function colored_text($string,$color) /* Randome colored text generator*/{

if($color=='red'){

echo "<div class='aerror noprint'>". $string."</div>";
}else if($color=='yellow'){
echo "<div class='awarning noprint'>". $string."</div>";
}else if($color=='blue'){
echo "<div class='ainfo noprint'>". $string."</div>";

}else{
echo "<div class='asuccess noprint'>". $string."</div>";
}

}

function cache_bottom(){ /* Cache bottom initlaizer */
global $enablecache;
if($enablecache==1 && check_login() &&  pgname()!='search'){
	global $cachefile;
	// Cache the contents to a file
	$cached = fopen($cachefile, 'w');
	fwrite($cached, ob_get_contents());
	fclose($cached);
	ob_end_flush(); // Send the output to the browser
	}
}

function purgecache(){ /* Delete all cache files*/
	$c=0;

	$files = glob('../cache/*'); // get all file names
		foreach($files as $file){ // iterate files
			if(is_file($file))
				unlink($file); 
				$c++;// delete file
		}

			$arr = array('s' => 1,'v'=>$c .' file(s) was/were purged');
				return json_encode($arr);
	

}





function cache_top(){ /* Start of Cache Header */
	global $enablecache;
	if($enablecache==1 && check_login() && pgname()!='search'){
		global $cachefile,$sitepath,$view;
		$urlp = $_SERVER["SCRIPT_NAME"];
		$break = Explode('/', $urlp);
		$filep = $break[count($break) - 1];
		if(check_login()){
			$idp= $_SESSION['id'];
		}else{
			$idp = 0;
		}
		if(pgname()=='profile'){
			if($view!='0'){
				$idp = $idp .'-'. ($view);
			}else{
				$idp = $idp .'-'.$idp;
			}
		}
		$cachefile = './cache/cached-'.$idp.'-'.substr_replace($filep ,"",-4).'.html';
		$cachetime = 18000;

// Serve from the cache if it is younger than $cachetime
		if (file_exists($cachefile) && time() - $cachetime < filemtime($cachefile) ) {
			echo "<!-- \n\tCached  Copy, generated ".date('H:i', filemtime($cachefile))." \n\t (c) nevdo.com \n\t Author: rahber \n-->\n";
			include($cachefile);
		exit;
		}
	ob_start();
	}
}

function getvars(){ /* Initilaize Variables to get default variables using get or post*/
global $ret,$f,$view,$skey;
	$ret = request_var('return','');  
	if(pgname()=='candidate'){$f= request_var('f',0);  }
	if(pgname()=='profile' || pgname()=='complete_profile'){$view = request_var('view','0'); 
	if($view=='0'){
	}else{
	 $view = urldecode(decrypt_text($view));
	}
	}
	if( pgname()=='complete_profile'){$skey = request_var('key',''); 
	if($skey==''){
	}else{
	 $skey = urldecode(decrypt_text($skey));
	}
	}
}

function adddash(){ /* Add Dash */
	return ' - ';
}



function addbreak(){ /* Adds a line break*/
	return "<br />";
}

function labour_auth($pw) /* Re authenticate the user*/
{
global $mysqli;

$iid = $_SESSION['id'];
$queryy = $mysqli->query("select * from login where  (password='$pw' and uid='$iid')");

		if( ($queryy->num_rows)==1){
		return true;
		}else{
		
		return false;

}
}

function get_company($id){
global $mysqli;
$queryy = $mysqli->query("select * from company where cid = '$id'");
	if($row = $queryy->fetch_object()){
	
	if($row->status==1){
	return $row->company;
	}else{
	return "<span style='color:red'>".$row->company."</a>";
	}
	
	}else{
	
	return null;

}
}
function get_companystatus($id){
global $mysqli;
$queryy = $mysqli->query("select * from company where cid = '$id'");
	if($row = $queryy->fetch_object()){
	
	if($row->status==1){
	return 1;
	}else{
	return 0;
	}
	
	}else{
	
	return 0;

}
}

function yes_no($i){

if($i==0){
$g  = "<image src='./assets/media/no.png' alt='' class='sm'/>";

}else{
$g  = "<image src='./assets/media/ok.png' alt='' class='sm' />";
}

return $g;

}



function start_app(){ /* Initialize Different Variables */
	global $mysqli,$enablecache,$purgepage,$membershippage,$indexpage,$candidatepage,$uploadpath,$matchpage,$sitepath,$contactemail,$explorepage,$inboxpage,$homepage,$accountpage,$searchpage,$logoutpage,$photospage,$settingspage,$profilepage;
	$mysqli = new mysqli("localhost", "root", "root", "dss");
	$contactemail = "info@info.com";
	$sitepath ="http://localhost:90/dss";
	
	$enablecache = 0;
	
	define("INAPP",true);
	define("CA", 1);
	define("LA", 2);
	define("LCA", 3);
	define("SA", 4);
	define("FA", 5);
	define("BLHI", 6);
	$uploadpath = $sitepath. "/upload_images/";
	
	error_reporting(0);
	startSession();
	update_session();
	cron_session();
	update_lastpage(pgname());
	
	cache_top();
	


}

start_app();


?>