<?php 
session_start();
if(isset($_POST['submitLogIn'])):
{
	
	include($_SERVER['DOCUMENT_ROOT']."/control/control.php");

	$_SESSION['user']->username = $_POST['username'];
	$_SESSION['user']->pass = $_POST['password'];
	header("Location: /admin/admin.php");
}
elseif(!( isset($_SESSION['user']))):?>

<!DOCTYPE HTML>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Log In</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
	<div id="header">
		<div>
			<div class="logo">
				<a href="/index.php">Zero Type</a>
			</div>
			<ul id="navigation">
				<li>
					<a href="/index.php">Home</a>
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
			<a href="/admin/forgetPassword.php">Forgot your password?</a>
			
			
			
		</div>


		<div class="section">
			<h1>SignUp</h1>
			<div>
                <form method="post" class="message" action="/control/user.php" id="SignUpForm">
                    <input type="text" 		name="username" value="username" 	id="SignUpUsername"		require		onFocus="this.select();" onMouseOut="javascript:return false;"/>
					<input type="password" 	name="password" value="password" 	id="SignUpPass" 		require		onFocus="this.select();" onMouseOut="javascript:return false;"/>
					<input type="text" 		name="gender"	value="gender" 		id="SignUpGendere" 		onFocus="this.select();" onMouseOut="javascript:return false;"/>
					<input type="date" 		name="birth" 	value="" 			id="SignUpDate" 		onFocus="this.select();" onMouseOut="javascript:return false;"/>
                    
					<button type="button" name="signUp" value="Sign Up" onclick="sigUp()">Sign Up</button>
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




	<script>
		function toAdmin()
		{
			window.location.replace("http://<?=$_SERVER['HTTP_HOST'] ?>/admin/admin.php");
		}


		function sigUp()
		{
			$.getJSON(
				"/api/user.php",
				{
					username: document.getElementById("SignUpUsername").value,

				},
				function(data) {
					if(!(data == null))
						//check username exist
						alert("Account name already exist!")
					else{
						//signup
						$.ajax({
						url : '/api/user.php',
						type: "POST",
						data: {
							username: document.getElementById("SignUpUsername").value,
							pass: document.getElementById("SignUpPass").value,
							gender: document.getElementById("SignUpGendere").value,
							date: document.getElementById("SignUpDate").value,
							action: 'insert'
							},
						success: toAdmin
						});

						
					}
					
				}
			);
		}

		function login()
		{

		}
	</script>
</body>
</html>

<?php
else:
	header("Location: /admin/admin.php");

endif
?>