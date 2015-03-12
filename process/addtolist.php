<?php
	require('../res/user.php');
	
	if ($id){
		$listID = $_REQUEST['listID'];
		$postID = $_REQUEST['postID'];
	
		$checkCollection = mysqli_query($connect, "SELECT * FROM collectionposts WHERE postID = '$postID' AND userID = '$id' AND listID = '$listID'");
		echo mysqli_num_rows($checkCollection);
		if (mysqli_num_rows($checkCollection) > 0){
			//return false;	
			echo "return false";
		} else {
			$listQuery = mysqli_query($connect, "INSERT INTO collectionposts VALUES ('','$listID','$id', '$postID')") or die(mysqli_error($connect));
			if ($listQuery){
				echo "success";
			} else {
				echo "fail";
			
			}
		}
	}
?>