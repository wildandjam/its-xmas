<?php require('../../res/meta.php'); 
	require('../../res/connect.php'); ?>
	<title>The Nice List | It's Christmas</title>
</head>
<body>
<?php require('../../res/headnav.php'); ?>
<div id="container" class="NiceList">
		<div id="pageHeader">
	        <h1>My Nice List</h1>
	        <?php require('../../res/userPortal.php'); ?>
	        
	        <div id="breadcrumbs">
	            <ul>
	                <li><a href="/">Home</a></li>
	                <li><a href="/member/my-christmas">My Christmas</a></li>
	                <li>My Nice list</li>
	            </ul>
	        </div>
	    </div>
        <?php 
			if (isset($_REQUEST['uid']) && $_REQUEST['uid']){
				if (isset($_REQUEST['error']) && $_REQUEST['error']){
					echo "<p class='errorMsg'>Unfortunately there was an issue updating your nice list!</p>";
				} else {
					echo "<p class='successMsg'>Your nice list has been updated!</p>";
				}
			}
		?>
        
        
        <div id="nicelistHolder">
        <?php 
			
		
		
            require('../../res/connect.php');
            if (isset($id)){
				
                $niceQuery = mysqli_query($connect, "SELECT * FROM relationships WHERE ((relationshipTypeID = '2' OR relationshipTypeID = '4') AND (userID1 = '$id')) OR ((relationshipTypeID = '3' OR relationshipTypeID = '4') AND userID2 = '$id')");
				if (mysqli_num_rows($niceQuery) > 0){
                    while ($niceRow = mysqli_fetch_array($niceQuery)){
						// work ON THIS
						$ID1 = $niceRow['userID1'];
						$ID2 = $niceRow['userID2'];
						$relID = $niceRow['relationshipTypeID'];
						
						if ($id == $ID1){
							$myUser = $ID1;
							$relUser = $ID2;
							
						} else if ($id == $ID2) {
							$myUser = $ID2;
							$relUser = $ID1;
						}
						if ($myUser > $relUser){
							$user1 = $relUser;
							$user2 = $myUser;							
						} else {
							$user1 = $myUser;
							$user2 = $relUser;	
						}
   						$usersQuery = mysqli_query($connect, "SELECT * FROM users WHERE userID = '$relUser'");
						
						if (mysqli_num_rows($usersQuery) == 1){
							while ($userQueryRow = mysqli_fetch_array($usersQuery)){
								$relUserName = 	$userQueryRow['userName'];
							}
									
							
						}
   						
                            echo '<div class="niceRow">';
							echo '<a href="/user/?uid=' . $relUser . '" class="listName">'. $relUserName.'</a>';
							echo '<a href="/process/nice-list.php?type=unfollow&userOne=' . $user1 . '&userTwo=' . $user2 . '&from=/member/nice-list/" class="removeLink">Remove?</a>';							
							echo '</div>';
                        
                    }
                } else {
                    echo "<p class='errorMsg'>You have no one on your nice list! Well, it saves money and trees!</p>";	
                }
            } else {
                echo "<p class='errorMsg'>Please <a href='/login/'>log in</a> to create your nice list.</p>";
            }	
        ?>
        	</div>
            <?php
			$definitionNeeded = "nice-list";
			require('../../res/definitions/define.php');
		?>
        
    <?php require('../../res/sidebars.php'); ?>
    </div>
	
</div>
</body>
</html>
