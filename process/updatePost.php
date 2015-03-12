<?php
require('../res/connect.php');
$postID = $_REQUEST['postID'];
$userID = $_REQUEST['userID'];
$title = mysqli_real_escape_string($connect, $_REQUEST['title']);
$category = $_REQUEST['category'];
$description = mysqli_real_escape_string($connect, $_REQUEST['postDescriptionInput']);
$postPrivacy = $_REQUEST['itemPrivacy'];


$postcheck = mysqli_query($connect, "SELECT * FROM posts WHERE postID = '$postID'");
$count = mysqli_num_rows($postcheck);

if ($count == 1) {
	while($row = mysqli_fetch_assoc($postcheck)) {
		$posterID = $row['userID'];
				
		if ($posterID == $userID){
			$updateQuery = "UPDATE posts SET postTitle = '$title', categoryID = '$category', postDesc= '$description', postPrivacy = '$postPrivacy' WHERE postID = '$postID'";
			$updatePost = mysqli_query($connect, $updateQuery) or mysqli_error($die);
			if ($updatePost){
				
				header('location: /post/?id=' . $postID . '&status=success');
			} else {
				
				header('location: /post/?id=' . $postID . '&status=fail');
			}
		
		} else {
			header('location: /post/?id=' . $postID . '&error=permission');
		}
	}

} else {
	header('location: /post/?id=' . $postID . '');
}

?>