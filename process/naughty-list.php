<?php require('../res/meta.php'); 
	require('../res/connect.php'); ?>
	<title>Add to naughty list | It's Christmas</title>
</head>
<body>
<?php require('../res/headnav.php'); ?>
<div id="container" class="addToNaughty">
	<?php
	if ($id){
		$type = $_REQUEST['type'];
		$userOne = $_REQUEST['userOne'];
		$userTwo = $_REQUEST['userTwo'];
		$from = $_REQUEST['from'];
		
		if ($from){
			$baseRedirect = $from;	
		} else {
			$baseRedirect = "/user/";
		}
		
		if ($userOne == $id || $userTwo == $id){
			if ($userOne > $userTwo){ //Order users, just in case of manual input
				$user1 = $userTwo;
				$user2 = $userOne;
			} else {
				$user1 = $userOne;
				$user2 = $userTwo;
			}
			
			$niceFriendQuery = mysqli_query($connect, "SELECT * FROM relationships WHERE userID1 = '$user1' AND userID2 = '$user2'");
			if (mysqli_num_rows($niceFriendQuery) == 1){
				while($relRow = mysqli_fetch_array($niceFriendQuery)){
					$relType = $relRow['relationshipTypeID'];
						if ($type == "block"){
							switch($relType){
								case "1":
									$value = 9;
									break;
								case "2":
									$value = 9;
									break;
								case "3":
									$value = 6;
									break;
								case "4":
									$value = 6;
									break;
								case "5":
									$value = 7;
									break;
								case "6":
									$status = "already";
									break;
								case "7":
									$status = "already";
									break;
								case "8":
									$value = 7;
									break;
								case "9":
									$status = "already";
									break;
							}// End switch
							
							if ($status){
								if ($status == "already"){
									if ($id == $userID1){
										header("location: " . $baseRedirect . "?uid=" . $user2 . "&error=already");
									} else {
										header("location: " . $baseRedirect . "?uid=" . $user1 . "&error=already");
									}
								}// end status if
							} else{
								$updateRowQuery = mysqli_query($connect, "UPDATE relationships SET relationshipTypeID = '$value' WHERE userID1 = '$user1' AND userID2 = '$user2'");
								if ($updateRowQuery){
									if ($newadd == true){
										if ($id == $userID1){
											$notificationDate = date("Y-m-d H:i:s");
											$notificationAdd = mysqli_query($connect, "INSERT INTO notifications SET ('','1','$user2','$id', '$notificationDate','0', '0', '0'");
											if ($notificationAdd){
												header("location: " . $baseRedirect . "?uid=" . $user2 . "");
											} else {
												header("location: " . $baseRedirect . "?uid=" . $user2 . "&error=notify");
											}
											
											
										} else {
											$notificationDate = date("Y-m-d H:i:s");
											$notificationAdd = mysqli_query($connect, "INSERT INTO notifications SET ('','1','$user1','$id', '$notificationDate','0', '0', '0'");
											if ($notificationAdd){
												header("location: " . $baseRedirect . "?uid=" . $user1 . "");
											} else {
												header("location: " . $baseRedirect . "?uid=" . $user1 . "&error=notify");
											}
										}
									} else {
										if ($id == $userID1){
											header("location: " . $baseRedirect . "?uid=" . $user2 . "");
										} else {
											header("location: " . $baseRedirect . "?uid=" . $user1 . "");	
										}
										
									}
								
									
								} else {
									if ($id == $userID1){
										header("location: " . $baseRedirect . "?uid=" . $user2 . "&error=error");
									} else {
										header("location: " . $baseRedirect . "?uid=" . $user1 . "&error=error");
									}
								}
							}//End if ($status)
						} elseif ($type == "unblock"){
							switch($relType){
								case "1":
									$status = "noton1";
									break;
								case "2":
									$status = "noton2";
									break;
								case "3":
									$status = "noton3";
									break;
								case "4":
									$status = "noton4";
									break;
								case "5":
									$status = "noton5";
									break;
								case "6":
									$value = 3;
									break;
								case "7":
									$value = 8;
								case "8":
									$status = "noton8";
									break;
								case "9":
									$value = 1;
									break;
							}// End switch

							if ($status == "noton"){
								if ($id == $userID1){
										header("location: " . $baseRedirect . "?uid=" . $user2 . "&error=noton");
									} else {
										header("location: " . $baseRedirect . "?uid=" . $user1 . "&error=noton");
									}	
							} else {
								$updateRowQuery = mysqli_query($connect, "UPDATE relationships SET relationshipTypeID = '$value' WHERE userID1 = '$user1' AND userID2 = '$user2'");
								if ($updateRowQuery){
									if ($id == $userID1){
										header("location: " . $baseRedirect . "?uid=" . $user2 . "");
									} else {
										header("location: " . $baseRedirect . "?uid=" . $user1 . "");
									}
									
								} else {
									if ($id == $userID1){
										header("location: " . $baseRedirect . "?uid=" . $user2 . "&error=error");
									} else {
										header("location: " . $baseRedirect . "?uid=" . $user1 . "&error=error");
									}
								}
							}//End if ($status)	
						}
				}//End while	
			} else {
				$inputDate = date("Y-m-d");
				if ($user1 == $id){
					$insertRowQuery = mysqli_query($connect, "INSERT INTO relationships VALUES ('', '$user1','$user2','1','$inputDate')");
				} else {
					$insertRowQuery = mysqli_query($connect, "INSERT INTO relationships VALUES ('', '$user1','$user2','3','$inputDate')");	
				}
				
				if ($insertRowQuery){
					$notificationDate = date("Y-m-d H:i:s");
					if ($id == $user1){
						$notificationAdd = mysqli_query($connect, "INSERT INTO notifications VALUES ('','1','$user2','$id', '$notificationDate','0', '0', '0')");
						if ($notificationAdd){
							header("location: " . $baseRedirect . "?uid=" . $user2 . "");
						}
					} else {
						$notificationAdd = mysqli_query($connect, "INSERT INTO notifications VALUES ('','1','$user1','$id', '$notificationDate','0', '0', '0')");
						if ($notificationAdd){
							header("location: " . $baseRedirect . "?uid=" . $user1 . "");
						}
					}
				} else {
					if ($id == $user1){
						header("location: " . $baseRedirect . "?uid=" . $user2 . "");
					} else {
						header("location: " . $baseRedirect . "?uid=" . $user1 . "");
					}
				}
			}//End if
		} //Make sure one of the users is the logged in user
	} else {
		header("location: /login/");	
	}

     require('../res/sidebars.php'); ?>
    </div>
	
</div>
</body>
</html>
