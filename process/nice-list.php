<?php require('../res/meta.php'); 
	require('../res/connect.php'); ?>
	<title>Add to nice list | It's Christmas</title>
</head>
<body>
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
			if ($id == $user1){
				$niceFriendQuery = mysqli_query($connect, "SELECT * FROM relationships WHERE userID1 = '$user1' AND userID2 = '$user2'");
				if (mysqli_num_rows($niceFriendQuery) == 1){
					while($relRow = mysqli_fetch_array($niceFriendQuery)){
						$relType = $relRow['relationshipTypeID'];
							if ($type == "follow"){
								//echo $relType;
								switch($relType){
									case "1":
										$value = 2;
										$newadd = true;
										break;
									case "2":
										$status = "previous";
										break;
									case "3":
										$value = 4;
										$newadd = true;
										break;
									case "4":
										$status = "previous";
										break;
									case "5":
										$status = "previous";
										break;
									case "6":
										$status = "block";
										break;
									case "7":
										$status = "block";
										break;
									case "8":
										$value = 5;
										$newadd = true;
										break;
									case "9":
										$status = "block";
										break;
								}// End switch
								
								if ($status){
									if ($status == "block"){
										header("location: " . $baseRedirect . "?uid=" . $user2 . "&error=already-blocked");
									} elseif ($status == "previous"){
										header("location: " . $baseRedirect . "?uid=" . $user2 . "&error=already-liked");
									}// end status if
								} else{
									$updateRowQuery = mysqli_query($connect, "UPDATE relationships SET relationshipTypeID = '$value' WHERE userID1 = '$user1' AND userID2 = '$user2'");
									if ($updateRowQuery){
										if ($newadd == true){
											if ($id == $user1){
												$notificationDate = date("Y-m-d H:i:s");
												$notifySQL = "INSERT INTO notifications VALUES ('','1','$user2','$id', '$notificationDate','0', '0', '0')";
												//echo $notifySQL;
												$notificationAdd = mysqli_query($connect, $notifySQL);
												if ($notificationAdd){
													header("location: " . $baseRedirect . "?uid=" . $user2 . "");
												} else {
													header("location: " . $baseRedirect . "?uid=" . $user2 . "&error=notify");
												}
												
												
											} else {
												//echo "2";
												$notificationDate = date("Y-m-d H:i:s");
												$notificationSQL = "INSERT INTO notifications VALUES ('','1','$user1','$id', '$notificationDate','0', '0', '0')";
												$notificationAdd = mysqli_query($connect, $notificationSQL);
												if ($notificationAdd){
													header("location: " . $baseRedirect . "?uid=" . $user2 . "");
												} else {
													header("location: " . $baseRedirect . "?uid=" . $user2 . "&error=notify");
												}
											}
										} else {
											header("location: " . $baseRedirect . "?uid=" . $user2 . "");	
										}
									} else {
										header("location: " . $baseRedirect . "?uid=" . $user1 . "&error=general");	
									}
								}//End if ($status)	
							} elseif ($type == "unfollow"){
								switch($relType){
									case "1":
										$status = "noton";
										break;
									case "2":
										$value = 1;
										break;
									case "3":
										$status = "noton";
										break;
									case "4":
										$value = 3;
										break;
									case "5":
										$value = 8;
										break;
									case "6":
										$status = "noton";
										break;
									case "7":
										$status = "noton";
										break;
									case "8":
										$status = "noton";
										break;
									case "9":
										$status = "noton";
										break;
								}// End switch
								
								if ($status == "noton"){
										header("location: " . $baseRedirect . "?uid=" . $user2 . "&error=not-liked");

								} else {
									$updateRowQuery = mysqli_query($connect, "UPDATE relationships SET relationshipTypeID = '$value' WHERE userID1 = '$user1' AND userID2 = '$user2'");
									if ($updateRowQuery){
											header("location: " . $baseRedirect . "?uid=" . $user2. "");
									} else {
											header("location: " . $baseRedirect . "?uid=" . $user2 . "&error=general");
									}
								}//End if ($status)	
							}
					}//End while		
				} else {
					$inputDate = date("Y-m-d");
					//echo $inputDate;
					if ($user1 == $id){
						$insertRowQuery = mysqli_query($connect, "INSERT INTO relationships VALUES ('', '$user1','$user2','2','$inputDate')");
					} else {
						$insertRowQuery = mysqli_query($connect, "INSERT INTO relationships VALUES ('', '$user1','$user2','3','$inputDate')");	
					}
					
					if ($insertRowQuery){
						$notificationDate = date("Y-m-d H:i:s");
						if ($id == $user1){
							//echo "<br />";
							$notiSQL = "INSERT INTO notifications VALUES ('','1','$user2','$id', '$notificationDate','0', '0', '0')";
							//echo $notiSQL;
							$notificationAdd = mysqli_query($connect, $notiSQL );
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
			} else {
				$niceFriendQuery = mysqli_query($connect, "SELECT * FROM relationships WHERE userID1 = '$user1' AND userID2 = '$user2'");
				if (mysqli_num_rows($niceFriendQuery) == 1){
					while($relRow = mysqli_fetch_array($niceFriendQuery)){
						$relType = $relRow['relationshipTypeID'];
							if ($type == "follow"){
								echo $relType;
								switch($relType){
									case "1":
										$value = 3;
										$newadd = true;
										break;
									case "2":
										$value = 4;
										$newadd = true;
										break;
									case "3":
										$status = "previous";
										break;
									case "4":
										$status = "previous";
										break;
									case "5":
										$status = "block";
										break;
									case "6":
										$status = "block";
										break;
									case "7":
										$status = "block";
										break;
									case "8":
										$status = "block";
										break;
									case "9":
										$value = 6;
										$newadd = true;
										break;
								}// End switch
								
								if ($status){
									if ($status == "block"){
										if ($user1 == $id){
											header("location: " . $baseRedirect . "?uid=" . $user2 . "&error=already-blocked");
										} else {
											header("location: " . $baseRedirect . "?uid=" . $user1 . "&error=already-blocked");
										}
									} elseif ($status == "previous"){
										if ($user1 == $id){
											header("location: " . $baseRedirect . "?uid=" . $user2 . "&error=already-liked");
										} else {
											header("location: " . $baseRedirect . "?uid=" . $user1 . "&error=already-liked");
										}
									}// end status if
								} else{
									$updateRowQuery = mysqli_query($connect, "UPDATE relationships SET relationshipTypeID = '$value' WHERE userID1 = '$user1' AND userID2 = '$user2'");
									if ($updateRowQuery){
										if ($newadd == true){
											if ($id == $user1){
												echo "1";
												$notificationDate = date("Y-m-d H:i:s");
												$notifySQL = "INSERT INTO notifications VALUES ('','1','$user2','$id', '$notificationDate','0', '0', '0')";
												echo $notifySQL;
												$notificationAdd = mysqli_query($connect, $notifySQL);
												if ($notificationAdd){
													header("location: " . $baseRedirect . "?uid=" . $user2 . "");
												} else {
													header("location: " . $baseRedirect . "?uid=" . $user2 . "&error=notify");
												}
												
												
											} else {
												echo "2";
												$notificationDate = date("Y-m-d H:i:s");
												$notificationSQL = "INSERT INTO notifications VALUES ('','1','$user1','$id', '$notificationDate','0', '0', '0')";
												echo $notificationSQL;											
												$notificationAdd = mysqli_query($connect, $notificationSQL);
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
												header("location: " . $baseRedirect . "?uid=" . $user2 . "&error=general");
											} else {
												header("location: " . $baseRedirect . "?uid=" . $user1 . "&error=general");	
											}
									}
								}//End if ($status)	
							} elseif ($type == "unfollow"){
								switch($relType){
									case "1":
										$status = "noton";
										break;
									case "2":
										$status = "noton";
										break;
									case "3":
										$value = 1;
										break;
									case "4":
										$value = 3;
										break;
									case "5":
										$value = 8;
										break;
									case "6":
										$status = "noton";
										break;
									case "7":
										$status = "noton";
										break;
									case "8":
										$status = "noton";
										break;
									case "9":
										$status = "noton";
										break;
								}// End switch
								
								if ($status == "noton"){
									if ($id == $userID1){
										header("location: " . $baseRedirect . "?uid=" . $user2 . "&error=not-liked");
									} else {
										header("location: " . $baseRedirect . "?uid=" . $user1 . "&error=not-liked");	
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
										header("location: " . $baseRedirect . "?uid=" . $user2 . "&error=general");
									} else {
										header("location: " . $baseRedirect . "?uid=" . $user1 . "&error=general");	
									}
									}
								}//End if ($status)	
							}
					}//End while		
				} else {
					$inputDate = date("Y-m-d");
					echo $inputDate;
					if ($user1 == $id){
						$insertRowQuery = mysqli_query($connect, "INSERT INTO relationships VALUES ('', '$user1','$user2','2','$inputDate')");
					} else {
						$insertRowQuery = mysqli_query($connect, "INSERT INTO relationships VALUES ('', '$user1','$user2','3','$inputDate')");	
					}
					
					if ($insertRowQuery){
						$notificationDate = date("Y-m-d H:i:s");
						if ($id == $user1){
							echo "<br />";
							$notiSQL = "INSERT INTO notifications VALUES ('','1','$user2','$id', '$notificationDate','0', '0', '0')";
							echo $notiSQL;
							$notificationAdd = mysqli_query($connect, $notiSQL );
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
			}
		} //Make sure one of the users is the logged in user
	} else {
		header("location: /login/");
	}
?>

</body>
</html>
