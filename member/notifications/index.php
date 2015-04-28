<?php require('../../res/meta.php'); ?>
	<title>Notifications | It's Christmas</title>
</head>
<body>
<?php require('../../res/headnav.php'); ?>

<div id="container" class="notifications">
	<div id="pageHeader">
        <h1>Nofications</h1>
        <?php require('../../res/userPortal.php'); ?>
        <div id="breadcrumbs">
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/member/my-christmas">My Christmas</a></li>
                <li>Notifications</li>
            </ul>
        </div>
    </div>
	<div class="content">
    <?php 
	if (!isset($id)){
		echo "<p class='errorMsg'>To get notifications, you need to <a href='/login/'>sign in</a> to the Christmas spirit.</p>";
		
	} else { ?>
    	<div id="notificationHolder">
		<?php
				require('../../res/connect.php');
				$notificationQuery = mysqli_query($connect, "SELECT * FROM notifications WHERE notificationUserID = '$id' AND notificationHidden = '0' ORDER BY notificationDate DESC");
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
							echo "<div class='notification unread' data-noID='" . $notifID . "'>";	
						} else {
							echo "<div class='notification read' data-noID='" . $notifID . "'>";	
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
										$notifIcon = "<span class=\"itemFriend notificationIcon\"></span>";
										$notifContent = " added you to their nice list";
										break;
									case "liked-post":
										$notifIcon = "<span class=\"likePost notificationIcon\"></span>";
										$notifContent = " liked your <a href='/post/?id= " . $notifPost . "'>post</a>";
										break;	
								}
							}
						}
						echo $notifIcon;
						echo $notifUserName;
						echo $notifContent;					
						
						echo "<span class='notifyDate'>" . $notifDateFix . "</span>";
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
