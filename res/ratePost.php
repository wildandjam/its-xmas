<?php
	require_once('connect.php');
	require_once('user.php');
	
	if (isset($xID){
		$postID = $_REQUEST['postID'];
		$type = $_REQUEST['type'];
		$userID = $_REQUEST['token'];

		function notifyLike($postID, $type, $userID, $id){
			$getRepeat = mysqli_query($connect, "SELECT * FROM notifications WHERE notificationTypeID = '2' AND notificationUserID = '$notifyUser' AND notificationActionUserID = '$xID' AND notificationPostID = '$postID'");
			if (mysqli_num_rows($getRepeat) == 0){
				$notifydate = date('Y-m-d g:i:s',time()); 
				$getUser = mysqli_query($connect, "SELECT * FROM posts WHERE postID =  '$postID'");
				if (mysqli_num_rows($getUser) == 1){
					while ($getUserRow = mysqli_fetch_array($getUser)){
						$notifyUser = $getUserRow['userID'];	
					}
				}
				 $notificationMysql = "INSERT INTO notifications VALUES ('','2','$notifyUser','$xID','$notifydate','0','0','$postID')";
				$notificationQuery = mysqli_query($connect, $notificationMysql);
				if ($notificationQuery){
					return true;
				} else {
					return false;
				}
			}
		}
		
		$likeMySQL = "SELECT * FROM postlikes WHERE postID = '" . $postID . "' AND userID = '" . $userID ."'";
		$likeCheck = mysqli_query($connect, $likeMySQL);
		$likeCount = mysqli_num_rows($likeCheck);
		while ($likeRow = mysqli_fetch_array($likeCheck)){
			$likedStatus = $likeRow['liked'];
		}
		
		if ($likeCount != 0){
			if ($likedStatus == "1"){
				$itemLikeCount = $itemLikeCount - 1;
			} else {
				$itemDislikeCount = $itemDislikeCount - 1;
			}
			mysqli_query($connect, "DELETE FROM postlikes WHERE postID = '" . $postID . "' AND userID = '" . $userID ."'");
		}
		$date = date('Y-m-d', strtotime(today));
	
		if ($type === "like"){
			$ratepost = mysqli_query($connect, "INSERT INTO postlikes VALUES ('','$userID','$postID','1','0','$date')");
			$itemLikeCount = $itemLikeCount + 1;
			
			 notifyLike($postID, $type, $userID, $id);
		} else {
			$ratepost = mysqli_query($connect, "INSERT INTO postlikes VALUES ('','$userID','$postID','0','1','$date')");
			$itemDislikeCount = $itemDislikeCount + 1;
		}
	}
?>
