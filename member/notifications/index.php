<?php 
    $membercheck = true;
	require('../../res/meta.php');
?>
	<title>Notifications | It's Christmas</title>
</head>
<body>
<?php require('../../res/headnav.php'); ?>

<div id="container" class="notifications">
    <?php 
		$pgTitle = "Notifications";
		$pgBreadcrumb = "<li><a href='/member/my-christmas'>My Christmas</a></li><li>Notifications</li>";
		require('../../res/pageHeader.php');
	?>
	<div class="content">
    <?php 
	if (!isset($id)){
		echo "<p class='errorMsg'>To get notifications, you need to <a href='/login/'>sign in</a> to the Christmas spirit.</p>";
		
	} else { ?>
    	<div id="notificationHolder" class="container">
		<?php
				$notificationQuery = mysqli_query($connect, "SELECT * FROM notifications WHERE notificationUserID = '$xID' AND notificationHidden = '0' ORDER BY notificationDate DESC");
				if (mysqli_num_rows($notificationQuery) > 0){
					while ($notificationRow = mysqli_fetch_array($notificationQuery)){
						$notifID = $notificationRow['notificationID'];
						$notifType = $notificationRow['notificationTypeID'];
						$notifUser = $notificationRow['notificationUserID'];
						$notifActionUser = $notificationRow['notificationActionUserID'];
						$notifDate = $notificationRow['notificationDate'];
						$notifDateFix = date("d/m/Y", strtotime($notifDate));
						$notifRead = $notificationRow['notificationRead'];
						$notifPost = $notificationRow['notificationPostID'];
						
						if ($notifRead == "0"){
							echo "<div class='notification unread row' data-noID='" . $notifID . "'>";	
						} else {
							echo "<div class='notification read row' data-noID='" . $notifID . "'>";	
						}
						
						$notifUserQUery = mysqli_query($connect, "SELECT * FROM users WHERE userID = '$notifActionUser'");
						if (mysqli_num_rows($notifUserQUery) == '1'){
							while ($notifUserRow = mysqli_fetch_array($notifUserQUery)){
								$notifUserName = "<a href='/user/?uid=" . $notifActionUser . "'>" . $notifUserRow['userName'] . "</a>";
							}
						}
						
						
						
						$notTypeQuery = mysqli_query($connect, "SELECT * FROM notificationType WHERE notificationTypeID = '$notifType'");
						if (mysqli_num_rows($notTypeQuery) == '1'){
							while ($notTypeRow = mysqli_fetch_array($notTypeQuery)){
								$notTypeName = 	$notTypeRow['notificationTypeName'];
								$notTypeNameExtra = $notTypeRow['notificationTypeNameExtra'];
								
								switch ($notTypeNameExtra){
									case "nice-list":
										$notifIcon = "<span class='itemFriend notificationIcon'></span>";
										$notifContent = " added you to their nice list";
										break;
									case "liked-post":
										$notifIcon = "<span class='likePost notificationIcon'></span>";
										$notifContent = " liked your <a href='/post/?id= " . $notifPost . "'>post</a>";
										break;	
								}
							}
						}
						echo "<div class='col-xs-9'>";
						echo $notifIcon;
						echo $notifUserName;
						echo $notifContent;					
						echo "</div>";
						echo "<div class='col-xs-3'>";
						echo "<span class='notifyDate pull-right'>" . $notifDateFix . "</span>";
						echo "</div>";
						echo "</div>";
												
					}
					$readQuery = mysqli_query($connect, "UPDATE notifications SET notificationRead = 1 WHERE notificationUserID = '$id' AND notificationHidden = '0' AND notificationRead = 0");
					if (!$readQuery) {
						echo "Unfortunately, there was an error. Read posts may show as unread for a period of time.";
					}
				} else {
					echo "<p class='errorMsg'>You do not have any notifications</p>";	
				}
		
        ?>
    </div>
    <?php } ?>
	</div>
    </div>
	
</div>
</body>
</html>
