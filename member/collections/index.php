<?php 
    $membercheck = true;
    require('../../res/meta.php');
?>
<title>My Collections | It's Christmas</title>
</head>
<body>
<?php require('../../res/headnav.php'); ?>
<div id="container" class="myCollectionsContainer">
	<?php if ($id){?>
        <div id="breadcrumbs">
            <ul>
                <li><a href="/member/my-christmas/">My Christmas</a></li>
                <li><a href="/member/collections/">My Collections</a></li>
            </ul>
        </div>
    <?php } ?>
	<h1>My Collections</h1>
    <?php
		if (isset($_REQUEST['status'])){
			if ($_REQUEST['status'] == "deletesuccess") {
				echo "<p class='successMsg'>Collection deleted</p>";	
			}
		}
	
	?>
	<?php if (!$id){ ?>
    	<div class="content content1000">
			<p class="errorMsg">To have the ability to make collections you need to <a href="/login/">sign in</a> to the Christmas spirit.</p>
        </div>
	<?php } else { ?>
            <div id="myCollectionPanel">
                <?php 
					$collectionQuery = mysqli_query($connect, "SELECT * FROM collections WHERE userID='$id' AND listParentID = '0'");
					$collectionCount = mysqli_num_rows($collectionQuery);
                    if ($collectionCount == 0){
                        echo "You haven't added any collections yet - do you want to add one?";
                    } else {
                        while($listRow = mysqli_fetch_assoc($collectionQuery)) {
                            $listID = $listRow['listID'];
                            $listName = $listRow['listName'];
                            $listPrivate = $listRow['listPrivate'];
                            echo "<a class=\"christmasList\" href='/collection/?collectionid=" . $listID . "'>";
                            $listpostquery = mysqli_query($connect, "SELECT * FROM collectionposts WHERE listID='$listID'");
                            $listpostcount = mysqli_num_rows($listpostquery);
                            if ($listpostcount == 0){
                                echo "<div class='listImage noPosts'></div>";
                            } else {
                                if ($listpostcount > 4){
                                    $listpostqueryfour = mysqli_query($connect, "SELECT * FROM collectionposts WHERE listID='$listID' LIMIT 0,4");
                                    while ($arrayRow = mysqli_fetch_array($listpostqueryfour)){
                                        $fourpostquery = mysqli_query($connect, "SELECT * FROM posts WHERE postID = '" . $arrayRow['postID'] . "'");
                                        while($fourpost = mysqli_fetch_array($fourpostquery)){
                                            echo "<div style='background-image: url(" . $fourpost['postImage'] . ");' class='fourPost'/></div>";
                                        }
                                    }								
                                } else {
                                    $listpostqueryone = mysqli_query($connect, "SELECT * FROM collectionposts WHERE listID='$listID' LIMIT 0,1");
                                    while ($arrayRowOne = mysqli_fetch_array($listpostqueryone)){
                                        $onepostquery = mysqli_query($connect, "SELECT * FROM posts WHERE postID = '" . $arrayRowOne['postID'] . "'") or die(mysqli_error($connect));
                                        while($onepost = mysqli_fetch_array($onepostquery)){
                                            echo "<div style='background-image: url(" . $onepost['postImage'] . ");' class='onePost'/></div>";
                                        }
                                    }
                                        
                                    
                                }							
                            }
                            echo "<div class='listName'>" . $listName . "</div></a>";
                        }
                    }
                ?>
            </div>
            <?php
				$definitionNeeded = "collection";
				require('../../res/definitions/define.php');
		?>
	<?php 
	}
?>
</div>

</body>
</html>