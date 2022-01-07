<?php 
session_start();
if(isset($_POST['submitLogIn'])):
{
	
	include($_SERVER['DOCUMENT_ROOT']."/control/control.php");

	$_SESSION['username'] = $_POST['username'];
	$_SESSION['password'] = $_POST['password'];
	header("Location: /admin/admin.php");
}
elseif(!( isset($_SESSION['username']) && isset($_SESSION['password']))):?>

<!DOCTYPE HTML>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Log In</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
	<div id="header">
		<div>
			<div class="logo">
				<a href="/trang1.php">Zero Type</a>
			</div>
			<ul id="navigation">
				<li>
					<a href="/trang1.php">Home</a>
				</li>
				<li>
					<a href="/features.php">Features</a>
				</li>
				<li>
					<a href="/news.php">News</a>
				</li>
				<li>
					<a href="/about.php">About</a>
				</li>
				<li>
					<a href="/contact.php">Contact</a>
				</li>
			</ul>
		</div>
	</div>
	<div id="contents">
		<div class="section">
			<h1>Login</h1>
		
			
			<div>
                <form method="post" class="message">
                    <input type="text" name="username" value="username" onFocus="this.select();" onMouseOut="javascript:return false;"/>
					<input type="password" name="password" value="password" onFocus="this.select();" onMouseOut="javascript:return false;"/>
                    <input type="submit" name="submitLogIn" value="LogIn"/>
                </form>
			</div>
			
			
		</div>


		<div class="section">
			<h1>SignUp</h1>
			<div>
                <form method="post" class="message" action="/control/user.php">
                    <input type="text" 		name="username" value="username" 	onFocus="this.select();" onMouseOut="javascript:return false;"/>
					<input type="password" 	name="password" value="password" 	onFocus="this.select();" onMouseOut="javascript:return false;"/>
					<input type="text" 		name="gender"	value="gender" 		onFocus="this.select();" onMouseOut="javascript:return false;"/>
					<input type="date" 		name="birth" 	value="" 			onFocus="this.select();" onMouseOut="javascript:return false;"/>
                    
					<input type="submit" name="signUp" value="Sign Up"/>
                </form>
                
			</div>
			
		</div>
	</div>
	<div id="footer">
		<div class="clearfix">
			<div id="connect">
				<a href="http://freewebsitetemplates.com/go/facebook/" target="_blank" class="facebook"></a><a href="http://freewebsitetemplates.com/go/googleplus/" target="_blank" class="googleplus"></a><a href="http://freewebsitetemplates.com/go/twitter/" target="_blank" class="twitter"></a><a href="http://www.freewebsitetemplates.com/misc/contact/" target="_blank" class="tumbler"></a>
			</div>
			<p>
				© 2023 Zerotype. All Rights Reserved.
			</p>
		</div>
	</div>
</body>
</html>

<?php
else:
	header("Location: /admin/admin.php");

endif
?>