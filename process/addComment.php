<?php
	require('../res/connect.php');
	require('../res/user.php');

if (isset($id)){


	if (isset($_REQUEST['commentType'])){
		$type = $_REQUEST['commentType'];

		if ($type == 'single'){
			if (isset($_REQUEST['singleCommentUserID']) && ($_REQUEST['singleCommentUserID'] == $id)){
				//Single comment
				$postID = $_REQUEST['singleCommentPostID'];
				$userID = $_REQUEST['singleCommentUserID'];
				$commentContent = mysqli_real_escape_string($connect, $_REQUEST['singleCommentMessage']);
				$date = date("Y-m-d H:i:s");
				$commentCheck = mysqli_query($connect, "SELECT * FROM comments WHERE userID = '$userID' AND postID = '$postID' AND commentMessage = '$commentContent'");
				$commentCheckCount = mysqli_num_rows($commentCheck);
				if ($commentCheckCount == 0){
					$commentAdd = mysqli_query($connect, "INSERT INTO comments VALUES ('','$postID','$userID','$commentContent','$date','0','0','0')");
					if ($commentAdd){
						 header("location:/post/?id=".$postID."&comment=success#comments");
					} else {
						header("location:/post/?id=".$postID."&comment=fail#comments");
					}
				} else {
					$commentAdd = mysqli_query($connect, "INSERT INTO comments VALUES ('','$postID','$userID','$commentContent','$date','0','0','1')");
					if ($commentAdd){
						header("location:/post/?id=".$postID."&comment=success&moderate=true#comments");
					} else {
						header("location:/post/?id=".$postID."&comment=fail#comments");
					}
				}
			}
		} else if ($type == 'reply') {
			if (isset($_REQUEST['replyCommentUserID']) && ($_REQUEST['replyCommentUserID'] == $id)){
				//Reply to a comment
				$postID = $_REQUEST['replyCommentPostID'];
				$userID = $_REQUEST['replyCommentUserID'];
				$commentContent = mysqli_real_escape_string($connect, $_REQUEST['replyCommentMessage']);
				$replyID = $_REQUEST['replyCommentID'];
				$date = date("Y-m-d H:i:s");
				$commentCheck = mysqli_query($connect, "SELECT * FROM comments WHERE userID = '$userID' AND postID = '$postID' AND commentMessage = '$commentContent' AND commentInReplyTo = '$replyID'");
				$commentCheckCount = mysqli_num_rows($commentCheck);
				if ($commentCheckCount == 0){
					$commentAdd = mysqli_query($connect, "INSERT INTO comments VALUES ('','$postID','$userID','$commentContent','$date','$replyID','0','0')");
					if ($commentAdd){
						header("location:/post/?id=".$postID."&comment=success#comments");
					} else {
						header("location:/post/?id=".$postID."&comment=fail#comments");
					}
				} else {
					$commentAdd = mysqli_query($connect, "INSERT INTO comments VALUES ('','$postID','$userID','$commentContent','$date','$replyID','0','1')");
					if ($commentAdd){
						header("location:/post/?id=".$postID."&comment=success&moderate=true#comments");
					} else {
						header("location:/post/?id=".$postID."&comment=fail#comments");
					}
				}
			}
		}
	}
} else {
	header('location: /');
}
?>