<?php
$replyQuery = mysqli_query($connect, "SELECT * FROM comments INNER JOIN users ON (comments.userID = users.userID) WHERE postID = '$postID' AND commentDeleted = '0' AND commentInReplyTo = '$commentID'");
$replyCount = mysqli_num_rows($replyQuery);

if ($replyCount > 0){

	echo "<ul>";

	while($replyRow = mysqli_fetch_object($replyQuery)){
		$commentID = $replyRow->commentID;
		echo $commentID;
		$commentUserName = $replyRow->userName;
		$postID = $replyRow->postID;
		$commentMessage = $replyRow->commentMessage;
		$commentDate = $replyRow->commentDate;
		$commentReplied = $replyRow->commentInReplyTo;


		echo "<li>";
		echo "reply"; 

			//require('reply.php');
		echo "</li>";

	}
	echo "</ul>";
}
?>