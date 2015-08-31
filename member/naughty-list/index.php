<?php 
    $membercheck = true;
    require('../../res/meta.php');
?>
	<title>The Naughty List | It's Christmas</title>
</head>
<body>
<?php require('../../res/headnav.php'); ?>
<div id="container" class="naughtyList">
    <div id="pageHeader">
        <h1>My Naughty List</h1>
        <?php require('../../res/userPortal.php'); ?>
        
        <div id="breadcrumbs">
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/member/my-christmas">My Christmas</a></li>
                <li>My Naughty List</li>
            </ul>
        </div>
    </div>
	
        <?php 
			if (isset($_REQUEST['uid']) && $_REQUEST['uid']){
				if (isset($_REQUEST['error']) && $_REQUEST['error']){
					echo "<p class='errorMsg'>Unfortunately there was an issue updating your naughty list!</p>";
				} else {
					echo "<p class='successMsg'>Your naughty list has been updated!</p>";
				}
			}
		?>
        
        
        <div id="naughtylistHolder">
        <?php 
			
            require('../../res/connect.php');
            if (isset($id)){
                $naughtyQuery = mysqli_query($connect, "SELECT * FROM relationships LEFT JOIN users  ON (relationships.userID1 = users.userID) OR (relationships.userID2 = users.userID) WHERE (userID1 = '$id' OR userID2 = '$id') AND (relationshipTypeID = '6' OR relationshipTypeID = '7' OR relationshipTypeID = '9')");
                if (mysqli_num_rows($naughtyQuery) > 0){
                    while ($naughtyRow = mysqli_fetch_array($naughtyQuery)){
						$thisID = $naughtyRow['userID'];
                        if ($id != $thisID){
                            echo '<div class="naughtyRow">';
							echo '<a href="/user/?uid=' . $thisID . '" class="listName">'. $naughtyRow['userName'].'</a>';
							if ($thisID > $id){
								$user1 = $id;
								$user2 = $thisID;
							} else {
								$user1 = $thisID;
								$user2 = $id;
							}
							
							echo '<a href="/process/naughty-list.php?type=unblock&userOne=' . $user1 . '&userTwo=' . $user2 . '&from=/member/naughty-list/" class="removeLink">Remove?</a>';							
							echo '</div>';
                        }
                    }
                } else {
                    echo "<p>You have no one on your naughty list! Good for you!</p>";	
                }
            } else {
                echo "<p class='errorMsg'>Please <a href='/login/'>log in</a> to create your naughty list.</p>";
            }		
        ?>
        	</div>
            <?php
			$definitionNeeded = "naughty-list";
			require('../../res/definitions/define.php');
		?>
    </div>
</div>
</body>
</html>
