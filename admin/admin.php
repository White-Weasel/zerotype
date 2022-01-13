<!DOCTYPE HTML>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Admin</title>
	<link rel="stylesheet" href="/css/style.css" type="text/css">
	<link rel="stylesheet" href="/css/custom.css" type="text/css">
	<link rel="stylesheet" href="/css/infobox.css" type="text/css">

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
		<div id="tagline" class="clearfix">

			<?php
			include $_SERVER['DOCUMENT_ROOT']."/control/control.php";
			
			session_start();
			
			//destroy session after user pressed log out
			if(isset($_POST))
			{
				if(isset($_POST['logout']))
				{
					session_unset();
					session_destroy();
					header('Location: /login.php');
				}
			}

			//destroy sesstion after an amount of time inactive
			if (isset($_SESSION['LAST_ACTIVITY']))
			{
				if ((time() - $_SESSION['LAST_ACTIVITY'] > 1800))
				// last request was more than 30 minutes ago
				{
					session_unset();     // unset $_SESSION variable for the run-time 
					session_destroy();   // destroy session data in storage
				}
			}
			
			$_SESSION['LAST_ACTIVITY'] = time(); 
			if(isset($_SESSION['username'])):?>

			<?php 
				//Validate user, put all html elements of the admin page inside this if statement
				if((new Users())->validate($_SESSION['username'], $_SESSION['password'])):?>
				
			
			<h1 style="text-align: center;">Hello <span class='text-bold'><?= $_SESSION["username"]?></span></h1>
            <br>

			<a class="info-box" href="/admin/user.php?action=show">
				<span class="info-box-icon bg-info"><img src="/images/user-icon.png"></span>

				<div class="info-box-content">
				<span class="info-box-text">Users management</span>
				</div>
				
			</a>

			<a class="info-box" href="/admin/contact.php?action=show">
				<span class="info-box-icon bg-info"><img src="/images/contact-icon.png"></span>

				<div class="info-box-content">
				<span class="info-box-text">Contacts management</span>
				</div>
			</a>

			<a class="info-box" href="/admin/news.php?action=show">
				<span class="info-box-icon bg-info"><img src="/images/news-icon.png"></span>

				<div class="info-box-content">
				<span class="info-box-text">News management</span>
				</div>
			</a>

			<a class="info-box" href="/admin/news.php?action=insert">
				<span class="info-box-icon bg-info"><img src="/images/write_news.png"></span>

				<div class="info-box-content">
				<span class="info-box-text">Post News</span>
				</div>
			</a>


			<?php 
				//Admin page's content ends here
				else:
					session_unset();
					session_destroy();?>
				<h1>Wrong username/password</h1>
				<h2>You will be redirect back in <span id="time-left"></span> second(s)</h2>
				<script>
					i = 5000;
					elm = document.getElementById("time-left");
					elm.innerHTML = i/1000;
					setTimeout(function(){
						window.location.replace("http://<?=$_SERVER['HTTP_HOST'] ?>/login.php");
					}, i);
					setInterval(function(){
						i = i - 1000;
						elm.innerHTML = i/1000;
					}, 1000);
				</script>
			<?php endif ?>

		</div>

		
	</div>
	<div id="footer">
		<div class="clearfix">
		<form method="POST">
				<input type="submit" name="logout" value="Log out">
		</form>
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
	else: ?>
	<h1>Please log in again</h1>
	<h2>You will be redirect back in <span id="time-left"></span> second(s)</h2>
	<script>
		i = 5000;
		elm = document.getElementById("time-left");
		elm.innerHTML = i/1000;
		setTimeout(function(){
			window.location.replace("http://<?=$_SERVER['HTTP_HOST'] ?>/login.php");
		}, i);
		setInterval(function(){
			i = i - 1000;
			elm.innerHTML = i/1000;
		}, 1000);
		
		
	</script>
	<?php
	endif; 
?>