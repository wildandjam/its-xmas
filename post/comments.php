<?php 
if (isset($postID)){
	$commentQuery = mysqli_query($connect, "SELECT * FROM comments INNER JOIN users ON (comments.userID = users.userID) WHERE postID = '$postID' AND commentDeleted = '0' AND commentInReplyTo = '0'");
	$commentCount = mysqli_num_rows($commentQuery);
	if ($commentCount > 0){
		echo "<ul>";
		while($commentRow = mysqli_fetch_object($commentQuery)){
			$commentID = $commentRow->commentID;
			$commentUserName = $commentRow->userName;
			$postID = $commentRow->postID;
			$commentMessage = $commentRow->commentMessage;
			$commentDate = $commentRow->commentDate;
			$commentReplied = $commentRow->commentInReplyTo;

			echo "<li>";
			require('comment.php');
			echo "</li>";

		}
		echo "</ul>";	
	} else {
		echo "No one has commented on this post yet!";
	}

}

//		$commentQuery = mysqli_query($connect, "SELECT * FROM comments INNER JOIN users ON (comments.userID = users.userID) WHERE postID = '$postID' AND commentDeleted = '0' AND commentInReplyTo = '0'");
?>