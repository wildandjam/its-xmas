<?php
	require('../res/user.php');
	$postID = $_REQUEST['postID'];
	$getCollection = mysqli_query($connect, "SELECT * FROM collectionposts INNER JOIN collections ON (collectionposts.listID = collections.listID) WHERE postID = '$postID' AND collections.userID = '$id'");
	if (mysqli_num_rows($getCollection) != 0){
		$data = array();
		while ($collectionRow = mysqli_fetch_array($getCollection)){
			$listID = $collectionRow['listID'];
			$listName = $collectionRow['listName'];
			$data[] = array("listName" => $listName, "listID" => $listID);
			//$lists[] = array("list" => $listID);
		}
		echo json_encode(array("response"=>$data));
		return true;
		exit();
	} else {
		return true;
		exit();
	}

?>