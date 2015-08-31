<?php require('../res/meta.php'); 
	require('../res/connect.php');
	if (isset($_REQUEST["uid"])){
		$requestid = $_REQUEST["uid"];
	} else {
		$requestid = false;
	}
	$icheck = mysqli_query($connect, "SELECT * FROM users WHERE userID = '$requestid'");
	$icount = mysqli_num_rows($icheck);
	if ($icount == 1){
		while($irow = mysqli_fetch_assoc($icheck)) {
			$profilename = $irow['userName'];
		}
	
?>
<title><?php echo $profilename; ?>'s Christmas | It's Christmas</title>
</head>
<body>
<?php require('../res/headnav.php'); ?>
<div id="container" class="userProfile">
	<?php 
		$pgTitle = $profilename;
		$pgBreadcrumb = "<li><a href='/users/'>Users</a></li>";
		require('../res/pageHeader.php');
	?>

	<?php if (isset($xID)){ 
		echo "<div class='content content1000 container border-bottom'>";
		$viewQ = mysqli_query($connect, "SELECT * FROM preferences WHERE userID = '$xID'");
		$viewQCount = mysqli_num_rows($viewQ);
		if ($viewQCount == 1){
			while($viewQRow = mysqli_fetch_array($viewQ)){
				$view = $viewQRow['viewID'];
				$perPage = $viewQRow['perPage'];	
			}
		} else {
			$viewInsert = mysqli_query($connect, "INSERT INTO preferences VALUES ('','$xID','1', '')");
			$view = 1;
		}
	    	$viewSteps = 1;
			
			if ($id != $requestid){
				if ($requestid > $id){
					$user1 = $id;
					$user2 = $requestid;
				} else {
					$user1 = $requestid;
					$user2 = $id;
				}
				$friendQuery = mysqli_query($connect, "SELECT * FROM relationships WHERE userID1 = '$user1' AND userID2 = '$user2'");
				if (mysqli_num_rows($friendQuery) == 1){
					while($relRow = mysqli_fetch_array($friendQuery)){
						$relType = $relRow['relationshipTypeID'];
						//$relQuery = mysqli_query($connect, "SELECT * from relationshiptypes WHERE relationshipTypeID = '$relType'");
						switch($relType){
							case "1":
								$showFollowButton = true;
								break;
							case "2":
								if ($requestid > $id){
									$listStatus = "<div class='listUpdate'>" .  $profilename .  " is on your nice list. <a href=\"/process/nice-list.php?type=unfollow&userOne=" . $user1 . "&userTwo=" . $user2 . "\">Remove?</a></div>";
									$showUnfollowButton = true;
								} else {
									$listStatus = "<div class='listUpdate'>You are on their nice list</div>";
									$showFollowButton = true;
								}
								break;
							case "3":
								if ($requestid > $id){
									$listStatus = "<div class='listUpdate'>You are on their nice list</div>";
									$showFollowButton = true;
								} else {
									$listStatus = "<div class='listUpdate'>" .  $profilename .  " is on your nice list. <a href=\"/process/nice-list.php?type=unfollow&userOne=" . $user1 . "&userTwo=" . $user2 . "\">Remove?</a></div>";
									$showUnfollowButton = true;
								}
								break;
							case "4":
								$listStatus = "<div class='listUpdate'>" .  $profilename .  " is on your nice list. <a href=\"/process/nice-list.php?type=unfollow&userOne=" . $user1 . "&userTwo=" . $user2 . "\" class=\"userButton removeNiceButton\">Remove?</a></div>";
								$listStatus .= "<div class='listUpdate'>You are on their nice list</div>";
								$showUnfollowButton = true;
								break;
							case "5":
								$userBlock = true;
								break;
							case "6":
								$userBlock = true;
								$youBlock = true;
								break;
							case "7":
								$userBlock = true;
								$youBlock = true;
								break;
							case "8":
								$userBlock = true;
								break;
							case "9":
								$userBlock = true;
								$youBlock = true;
								break;
							
						}
						
						
						
					}				
				} else {
					$showFollowButton = true;
				}
			}
			require('../res/switchView.php'); ?>
            <?php 
			if (isset($userBlock) && $userBlock == true){
					if ($youBlock == true){
						echo "<div class='errorNoItems error'>Unfortunately, you cannot view this user's profile because they are on <em>your</em> <a href=\"/member/naughty-list/\">naughty list</a></div>";
						echo "<a href=\"/process/naughty-list.php?type=unblock&userOne=" . $user1 . "&userTwo=" . $user2 . "\">Remove from naughty list</a>";
					} else {
						echo "<div class='errorNoItems error'>Unfortunately, you cannot view this user's profile</div>";
					}
				} else {
					$detailsquery = mysqli_query($connect, "SELECT * FROM userdetails WHERE userID = '$requestid'");
					if (mysqli_num_rows($detailsquery) != '1'){
						//insert entry
						$insertDetails = mysqli_query($connect, "INSERT INTO userdetails VALUES ('','$requestid','','','','1900-01-01 00:00','','7','#183051','#e8e8e8','','0')");
						if (!$insertDetails){
							//echo "Errrorrr";	
						}
							
							
					} 
					//Check privacy
					$userdetailsquery = mysqli_query($connect, "SELECT * FROM userdetails LEFT JOIN avatar ON (userdetails.userAvatar = avatar.avatarID) WHERE userID = '$requestid' AND userPrivate = '0'");
					if (mysqli_num_rows($detailsquery) == '1'){ 
						while ($detailRow = mysqli_fetch_array($userdetailsquery)){
							$firstname = $detailRow['userFirstName'];
							$lastname = $detailRow['userLastName'];
							$gender = $detailRow['userGender'];
							$dataDOB = $detailRow['userDOB'];
							if ($dataDOB == "0000-00-00 00:00:00"){
								$fixedDOB = false;
							} else {
								$dob = date_create($dataDOB);
								$fixedDOB = date_format($dob, "d/m/Y");
							}
							$location = $detailRow['userLocation'];
							$bio = $detailRow['userBio'];
							
						?>
							<div id="userProfile">
								<div id="userProfileAvatar" class="col-sm-3">
									<?php
										if ($userAvatarBool){
											echo '<img src="' . $userAvatar . '" alt="Icon" width="110"/>'; 
										} else {
											echo '<img src="http://www.placehold.it/30x30" alt="Icon" />';
										}
									?>
                                </div>
                                <div id="userProfileInfo" class="col-sm-3">
                                    <?php if (($firstname == '') && ($lastname == '') && ($gender == '') && ($location == '') && ($bio == '')){
										if ($requestid == $id){
											echo "<span class='errorMsg'>You haven't edited your profile. <a href='/member/details'>Do you want to?</a></span>";
										} else {
											echo "<span class='errorMsg'>" . $profilename . " hasn't submitted their profile</span>";
										}
									}
									?>
									<?php if ($firstname || $lastname){
										echo "<span class='greyLabel'>Name:</span> " . $firstname; ?> <?php echo $lastname; ?><br />
									<?php } 
										if ($gender){
										echo "<span class='greyLabel'>Gender:</span> " . $gender; ?><br />
									<?php } 
										if ($fixedDOB != '01/01/1900' && $fixedDOB) {
											echo "<span class='greyLabel'>Date of Birth:</span> " . $fixedDOB . "<br />";
										}
									if ($location){
										echo "<span class='greyLabel'>From:</span> " .$location; ?><br />
									<?php }  ?>
									
								</div>
								<div id="userProfileBio" class="col-sm-3">
										<?php if ($bio){ ?>
											<span class='greyLabel'>Bio:</span> <?php echo $bio; ?>
										<?php } ?>
									</div>
								<div id="userButtons" class="col-sm-3">
									<?php 
									if ($id != $requestid){
										echo $listStatus;
										if ($showFollowButton == true){ ?>
                                        	<a href="/process/nice-list.php?type=follow&userOne=<?php echo $user1; ?>&userTwo=<?php echo $user2; ?>" class="userButton addNiceButton">Add to nice list</a>
											<a href="/process/naughty-list.php?type=block&userOne=<?php echo $user1; ?>&userTwo=<?php echo $user2; ?>" class="userButton addNaughtyButton">Add to naughty list</a>
											
									<?php } else if ($showUnfollowButton == true){ ?>
											<a href="/process/naughty-list.php?type=block&userOne=<?php echo $user1; ?>&userTwo=<?php echo $user2; ?>" class="userButton addNaughtyButton">Add to naughty list</a>
									<?php 	} 
									} else {
										//Your profile
										echo "<div class='listUpdate'>This is your profile!</div>";	
										echo "<a class='userButton' href='/member/details/'>Edit profile</a>";
									}?>
								</div>          
							</div>
						<?php
						}
					} else {
						if ($requestid == $id){
							echo "<p class='errorMsg'>You haven't edited your profile. <a href='/member/details'>Do you want to?</a></p>";
						} else {
							echo "<p class='errorMsg'>" . $username . " hasn't submitted their profile</p>";
						}
					}
				?>
				</div>
				<div id="itemholder" class="<?php echo $viewName ?>">
				
				<?php 
					if ($requestid == $id){
						$postcheck = mysqli_query($connect, "SELECT * FROM posts WHERE userID = '$requestid' AND postHidden = '0' ORDER BY postDate DESC");
					} else {
						$postcheck = mysqli_query($connect, "SELECT * FROM posts WHERE userID = '$requestid' AND postHidden = '0' AND postPrivacy = '0' ORDER BY postDate DESC");
					}
					
						
						$count = mysqli_num_rows($postcheck);
						if ($count != 0) {
							while($row = mysqli_fetch_assoc($postcheck)) {
								require('../res/prepPost.php');
								require($viewPath);
							}
						} else {
							echo "<div class='errorNoItems error'>It'll be lonely this Christmas, with no posts no hold</div>";
						} 
					
				?>
				
				</div>
			<?php 
			}
		} else { ?>
        	<div class="content content1000">
            	<h1>User: <?php echo $profilename; ?></h1>
	        	<p class="alignCenter errorMsg">Sorry, you can't see this until you've <a href="/login/?from=/user/?uid=<?php echo $requestid; ?>">signed in</a> to the Christmas spirit!</p>
            </div>
        <?php } 
	} else { ?>
		<title>Missing User | It's Christmas</title>
        </head>
        <body>
        <?php require('../res/headnav.php'); ?>
        <div id="container" class="userProfile">
        	<div class="content content1000">
                <h1>Missing User</h1>
                <p class="errorMsg">Sorry, the elves don't recognise those details</p>
        	</div>
        </div>
    <?php  
		}
	
	?>
        
 
    <?php require('../res/sidebars.php'); ?>
    </div>
	
</div>
</body>
</html>
