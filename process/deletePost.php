<?php
	require('../res/user.php');
	//require('../res/connect.php');

	$postid = $_REQUEST['postid'];
	$userid = $_REQUEST['userid'];
	$deletecode = $_REQUEST['deletecode'];
	$md5code = md5($postid) . md5($userid);
	
	if ($id == $userid){
		if ($deletecode == $md5code){
			$query = "SELECT * FROM posts WHERE postID = '$postid' AND userID = '$userid'";
			echo $query;
			$selectquery = mysqli_query($connect, $query);
			if (mysqli_num_rows($selectquery) == 1){
				$deleteQuery = mysqli_query($connect, "UPDATE posts SET postHidden = '2' WHERE postID = '$postid' AND userID = '$userid'");
				if ($deleteQuery){
					$deleteColQuery = mysqli_query($connect, "DELETE FROM collectionposts WHERE postID = '$postid'");
					if ($deleteColQuery){
						header("location: /member/my-christmas/?deleteStatus=success");
					} else {
						header("location: /member/my-christmas/?deleteStatus=success&collectionStatus=fail");
					}
					
				} else {
					header("location: /post/?id=" . $postid . "&deleteStatus=fail");
									}			
			} else {
				// No post
				header("location: /post/?id=" . $postid . "&deleteStatus=nopost");
			}
		} else {
			//Wrong code
			header("location: /post/?id=" . $postid . "&deleteStatus=code");
		}
	} else {
		// Wrong user
		header("location: /post/?id=" . $postid . "&deleteStatus=user");
	}

?>
