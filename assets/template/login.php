 <?php
 	
	if (!defined('INAPP'))
{
	exit;
}
 auth_check();
 
 if($_POST){
echo do_login(request_var('username',''),request_var('password',''));
}


?> <section class="content">

    <div class="login">
	
      <h2>Welcome to DSS.</h2>
	  <h1>Login</h1>
      <form id="login-form" method="post" >
        <p><input type="text" name="username"  value="" placeholder="Username" required></p>
        <p><input type="password" name="password"  value="" placeholder="Password" required></p>
        
        <p class="submit"><input class="login-submit" type="submit" name="commit" value="Login"></p>
      </form>
    </div>

	

  </section>