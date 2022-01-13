<?php include $_SERVER['DOCUMENT_ROOT']."/control/control.php"; ?>
<!DOCTYPE HTML>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>News title - Zerotype Website Template</title>
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
				<li class="active">
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
		<div class="post">
			<div class="date">
				<?php 
				if(isset($_GET['id'])): ?>
				<?php $news = (new News())->select($_GET['id'])->fetch_assoc()?>
				<p>
					<span><?=date('m', strtotime($news['Date'])) ?></span>
					<?=date('Y', strtotime($news['Date'])) ?>
				</p>
			</div>
			<h1><?=$news['Title'] ?> <span class="author"><?=$news['Author']?></span></h1>
			<p><?=$news['Content']?></p>
			<span><a href="/news.php" class="more">Back to News</a></span>
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