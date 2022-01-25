<!DOCTYPE HTML>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>User List</title>
	<link rel="stylesheet" href="/css/style.css" type="text/css">
	<link rel="stylesheet" href="/css/custom.css" type="text/css">
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
		<div id="tagline" class="clearfix">
		<?php
			include $_SERVER['DOCUMENT_ROOT']."/control/control.php";
			session_start();
			if(isset($_SESSION['user'])):?>

			<?php 
				if((new Users())->validate($_SESSION['user']->username, $_SESSION['user']->pass)):?>

            <br>
            <table class="table table-blue user-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Gender</th>
                        <th>Birth</th>
                    </tr>
                </thead>
                <?php
                    $user_list = (new Users())->select();
                    foreach($user_list as $user): ?>
                        <tr>
                            <td><?=$user['ID'] ?></td>
                            <td><?=$user['Username']?></td>
                            <td><?=$user['Pass']?></td>
                            <td><?=$user['Gender']?></td>
                            <td><?=$user['Birth']?></td>
                        </tr>
                <?php endforeach;?>
            </table>
			
			<?php 
				else:?>
				<h1>Wrong username/password</h1>
				<h2>You will be redirect back in <span id="time-left"></span> second(s)</h2>
				<script>
					i = 5000;
					elm = document.getElementById("time-left");
					elm.innerHTML = i/1000;
					setTimeout(function(){
						window.location.replace(window.location.href.replace('admin/user.php', 'login.php'));
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
			window.location.replace(window.location.href.replace('admin/user.php', 'login.php'));
		}, i);
		setInterval(function(){
			i = i - 1000;
			elm.innerHTML = i/1000;
		}, 1000);
		
		
	</script>
	<?php
	endif; 
?>