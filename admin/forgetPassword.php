<!DOCTYPE HTML>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Zerotype Website Template</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" href="/css/style.css" type="text/css">
</head>
<body>
	<div id="header">
		<div>
			<div class="logo">
				<a href="/index.php">Zero Type</a>
			</div>
			<ul id="navigation">
				<li class="active">
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
			<h1>Get your password back</h1>


            <div>
                <form method="post" class="message">
                    <input type="text" name="username" value="username" id="username" onFocus="this.select();" onMouseOut="javascript:return false;"/>
					<input type="text" name="password" value="Your password will appare here" id="password" onFocus="this.select();" onMouseOut="javascript:return false;" readonly="readonly"/>
                    <button type="button" id="getPasswordBtn" onclick="getPass()">Get password</button>
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
        function getPass()
        {
            $.getJSON(
				"/api/user.php",
				{
					username: document.getElementById("username").value,

				},
				function(data) {
					if(!(data == null))
					{
                        document.getElementById("password").value = data.Pass;
                    }
                    else
                    {
                        alert("Username does not exist");
                    }
				}
			);
        }
    </script>
</body>
</html>