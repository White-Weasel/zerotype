<!DOCTYPE HTML>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Contact - Zerotype Website Template</title>
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
				<li class="active">
					<a href="/contact.php">Contact</a>
				</li>
			</ul>
		</div>
	</div>
	<div id="contents">
		<div class="section">
			<h1>Contact</h1>
			<p>
				You can replace all this text with your own text. Want an easier solution for a Free Website? Head straight to Wix and immediately start customizing your website! Wix is an online website builder with a simple drag & drop interface, meaning you do the work online and instantly publish to the web. All Wix templates are fully customizable and free to use. Just pick one you like, click Edit, and enter the online editor.
			</p>
			<form method="post" class="message">
				<input type="text" name="txtname" value="Name" onFocus="this.select();" onMouseOut="javascript:return false;"/>
				<input type="text" name="txtemail" value="Email" onFocus="this.select();" onMouseOut="javascript:return false;"/>
				<input type="text" name="txtsub" value="Subject" onFocus="this.select();" onMouseOut="javascript:return false;"/>
				<textarea name="txtcontent"></textarea>
				<input type="submit" name="sub_send" value="Send"/>
			</form>

			<?php
				include($_SERVER['DOCUMENT_ROOT']."/control/control.php");
				$contact = new Contacts();
				if(isset($_POST['sub_send']))
				{
					$contact->name = $_POST['txtname'];
					$contact->email = $_POST['txtemail'];
					$contact->sub = $_POST['txtsub'];
					$contact->content = $_POST['txtcontent'];

					$result = $contact->insert();
					if($result)
						echo "<script>alert('Success!')</script>";
					else
						echo "<script>alert('ERROR!')</script>";
				}
			?>



		</div>
		<div class="section contact">
			<p>
				For Inquiries Please Call: <span>877-433-8137</span>
			</p>
			<p>
				Or you can visit us at: <span>ZeroType<br> 250 Business ParK Angel Green, Sunville 109935</span>
			</p>
			<p>
				Or you can <a href="/login.php">log in</a>
			</p>
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