<?php require('../res/meta.php'); ?>
<title>Lists | Share the Christmas Spirit</title>
<meta itemprop="title" property="og:title" content="Lists | Share the Christmas Spirit" />
</head>
<body>
<?php require('../res/headnav.php'); ?>
<div id="container" class="home-background">
	<?php 
        $pgTitle = "Lists";
        $pgBreadcrumb = "<li>Lists</li>";
        $pgHeaderLinks =  "<a href='#' class='pull-right'>Search</a>";
        require('../res/pageHeader.php');
    ?>
	<h2 class="text-left">Create a new list</h2>

	<h2 class="text-left">Your lists</h2>
	<?php 
		$listQuery = mysqli_query($connect, "SELECT * FROM userlist WHERE userID = '$xID'");
		$listCount = mysqli_num_rows($listQuery);

		if ($listCount > 0){
			while ($listRow = mysqli_fetch_object($listQuery)){
				$listID = $listRow->userListID;
				$listName = $listRow->userListName;
				$listType = $listRow->userListType;
				$listUserID = $listRow->userID;
				$listDate = $listRow->userListDate;
				$userMode = $listRow->userMode;
				
				?>
					<div class='tool-box'>
						<a href='/list/?listid=<?php echo $listID; ?>'><?php echo $listName ?></a>
					</div>

				<?php
			}
		}
	?>
	<h2 class="text-left">Lists shared with you</h2>
</div>
</body>
</html>