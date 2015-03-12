<?php require('res/meta.php'); ?>
<title>It's Christmas | Share the Christmas Spirit</title>
<meta itemprop="title" property="og:title" content="It's Christmas | Share the Christmas Spirit" />
</head>
<body>
<?php require('res/headnav.php'); ?>
<div id="container" class="home-background">
	<div id="pageHeader">
		<h1 class="small">Share the Christmas Spirit</h1>
		<?php require('res/userPortal.php'); ?>
		<div class="clearfix"></div>
		<div id="pageHeaderLinks">
			<a href="#">Search</a>
		</div>
	</div>
	<div id="home-container">

		<div class="row">
			<div class="home posts">
				<a href="/posts/">Posts</a>
			</div>
			<div class="home events">
				<a href="/events/">Events</a>
			</div>
			<div class="home tools">
				<a href="/tools/">Tools</a>
			</div>
		</div>
		<div class="row">
			<div class="home blog">
				<a href="/blog/">Blog</a>
			</div>
			<div class="home wiki">
				<a href="/wiki/">Wiki</a>
			</div>
		</div>
		<div class="row">
			<div id="countdown-holder">
				<span>It's Christmas</span>
				<span id="countdown">
					<?php echo $countphp; ?>
				</span>
			</div>
		</div>
</div>
</body>
</html>