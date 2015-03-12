<?php require('../res/meta.php'); ?>
<title>Events | It's Christmas</title>
<meta itemprop="title" property="og:title" content="Events | It's Christmas" />
</head>
<body>
<?php require('../res/headnav.php'); ?>
<div id="container">
	<div id="pageHeader">
		<h1>Events</h1>
		<?php require('../res/userPortal.php'); ?>
		<div id="breadcrumbs">
            <ul>
                <li><a href="/">Home</a></li>
                <li>Events</li>
            </ul>
        </div>
		<div id="pageHeaderLinks">
			<?php 
				if (isset($id)){
			?>
				<a href="#">New event</a>
			<?php
				}
			?>
			<a href="#">Search events</a>
		</div>
	</div>
	<?php
		$eventQuery = mysqli_query($connect, "SELECT * FROM events WHERE eventHidden = '0' AND eventDeleted = '0'");
		$eventRows = mysqli_num_rows($eventQuery);

		if ($eventRows > 0){

		} else {
			echo "Unfortunately there are no events that match your search";
		}



	?>


</div>
</body>
</html>