<?php require('../res/meta.php'); ?>
<title>Lists | Share the Christmas Spirit</title>
<meta itemprop="title" property="og:title" content="Lists | Share the Christmas Spirit" />
</head>
<body>
<?php require('../res/headnav.php'); ?>
<div id="container" class="home-background">
	<div id="pageHeader">
		<h1>Lists</h1>
		<?php require('../res/userPortal.php'); ?>
		<div class="clearfix"></div>
		<div id="breadcrumbs">
            <ul>
                <li><a href="/">Home</a></li>
                <li>Lists</li>
            </ul>
        </div>
		<div id="pageHeaderLinks">
			<a href="#">Search</a>
		</div>
	</div>
	<?php 
		$listQuery = mysqli_query($connect, "SELECT * FROM userlist WHERE userListPrivate = '0'");
		$listCount = mysqli_num_rows($listQuery);

		if ($listCount > 0){
			while ($listRow = mysqli_fetch_object($listQuery)){
				$listID = $listRow->userListID;
				$listName = $listRow->userListName;
				$listType = $listRow->userListType;
				$listUserID = $listRow->userID;
				$listDate = $listRow->userListDate;
				$userMode = $listRow->userMode;
				
				echo "<a href='/list/?listid=" . $listID ."'>" . $listName . "</a><br />";


			}
		}
	?>
</div>
</body>
</html>