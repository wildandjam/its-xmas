<?php require('res/meta.php'); ?>
<title>It's Christmas | Share the Christmas Spirit</title>
<meta itemprop="title" property="og:title" content="It's Christmas | Share the Christmas Spirit" />
</head>
<body>
<?php require('res/headnav.php'); ?>
<div id="container" class="home-background">
	<?php 
        $pgTitle = "Share the Christmas Spirit";
        $pgHeaderLinks =  "<a href='#' class='pull-right'>Search</a>";
        require('res/pageHeader.php');
    ?>
	<div id="home-container">
		<?php if (isset($_REQUEST['error']) && ($_REQUEST['error'] != '')){ ?>
			<div class="row error">
				Please <a href="/login/">login</a> or <a href="/register/">register</a> to access your required area

			</div>
		<?php } ?>
		<div class="row">
			<div class="col-xs-12 col-sm-4">
				<div class="home posts col-xs-12">
					<a href="/posts/">Posts</a>
				</div>
			</div>
			<div class="col-xs-12 col-sm-4">
				<div class="home events col-xs-12">
					<a href="/events/">Events</a>
				</div>
			</div>
			<div class="col-xs-12 col-sm-4">
				<div class="home tools col-xs-12">
					<a href="/tools/">Tools</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
				<div class="home blog col-xs-12">
					<a href="/blog/">Blog</a>
				</div>
			</div>
			<div class="col-xs-6">
				<div class="home countdown col-xs-12">
					<span>It's Christmas</span>
					<span id="countdown">
						<?php echo $countphp; ?>
					</span>
				</div>
			</div>
			<!--<div class="col-xs-6">
				<div class="home Wiki col-xs-12">
					<a href="/wiki/">Wiki</a>
				</div>
			</div>-->
		</div>
	</div>
</div>
<?php require('res/gtm.php'); ?>
</body>
</html>