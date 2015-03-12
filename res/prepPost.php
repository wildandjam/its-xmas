<?php

	$image = $row['postImage'];
	$title = $row['postTitle'];
	$url = $row['postURL'];
	$userID = $row['userID'];
	$postID = $row['postID'];
	$postRating = $row['postRating'];
	$postCategory = $row['categoryID'];
	$postDesc = $row['postDesc'];
	$postType = $row['postType'];
	$postImageRotate = $row['postImageRotate'];


	$userCheck = mysqli_query($connect, "SELECT * FROM users LEFT JOIN userdetails ON (users.userID = userdetails.userID) LEFT JOIN avatar ON (userdetails.userAvatar = avatar.avatarID) WHERE users.userID ='$userID'");
	$userCount = mysqli_num_rows($userCheck);
	if ($userCount == 1){
		while ($userRow = mysqli_fetch_array($userCheck)){
			$username = $userRow['userName'];
			$userAvatar = $userRow['userAvatar'];
			if ($userAvatar == ""){$userAvatar ="7";}
			$userAvatarFore = $userRow['userAvatarFore'];
			if ($userAvatarFore == ""){$userAvatarFore = "#183051";}
			$userAvatarBack = $userRow['userAvatarBack'];
			if ($userAvatarBack == ""){$userAvatarBack = "#e8e8e8";}
			$avatarSpan = $userRow['avatarFontName'];
		}
		/*$avatarQuery = mysqli_query($connect, "SELECT * FROM avatar WHERE avatarHidden != 1 AND avatarID = '$userAvatar'");
        if (mysqli_num_rows($avatarQuery) == 1){
        	while ($avatarRow = mysqli_fetch_array($avatarQuery)){
	            $avatarSpan = $avatarRow['avatarFontName'];
			}
		}*/

	}
	$categoryCheck = mysqli_query($connect, "SELECT * FROM categories WHERE categoryID = '$postCategory'");
	$categoryCount = mysqli_num_rows($categoryCheck);
	if ($categoryCount == 1){
		while ($categoryRow = mysqli_fetch_array($categoryCheck)){
			$categoryName = $categoryRow['categoryName'];	
		}
	}
	
	if (isset($id)){
		$likeCheck = mysqli_query($connect, "SELECT * FROM postLikes WHERE postID = '$postID' AND userID = '$id'");
		$likeCount = mysqli_num_rows($likeCheck);
		if ($likeCount > 0){
			while ($likeRow = mysqli_fetch_array($likeCheck)){
				$liked = $likeRow['liked'];
				$disliked = $likeRow['disliked'];
				if ($liked == '1'){
					$likeStatus = "like";
				} else if ($disliked == "1"){
					$likeStatus = "dislike";
				} else {
					$likeStatus = false;
				}
			}
		} else {
			$likeStatus = false;
		}
	}
	$likeInfoCheck = mysqli_query($connect, "SELECT * FROM postLikes WHERE postID = '$postID' AND liked = '1'");
	$likeInfoCount = mysqli_num_rows($likeInfoCheck);
	$dislikeInfoCheck = mysqli_query($connect, "SELECT * FROM postLikes WHERE postID = '$postID' AND disliked = '1'");
	$dislikeInfoCount = mysqli_num_rows($dislikeInfoCheck);

	if (isset($id)){
		$queryList = mysqli_query($connect, "SELECT * FROM collectionposts WHERE userID = '$id' AND postID = '$postID'");
		$queryListRows = mysqli_num_rows($queryList);
	}
	if (isset($queryListRows) && $queryListRows > '0'){
		$inlist = true;
	} else {
		$inlist  =  false;
	}
	
	if ($url == "0"){
		$itemURL = "Uploaded by: <a href=\"/user/?uid=" . $userID . "\">" .  $username . "</a>";
	} else {						
		$seg = explode("/", $url);
		$itemURL = "Shared from: ";
		$itemURL .= "<a href='" . $url . "'>";
		if ((substr($seg[2],0,4)) == "www."){
			$itemURL .=  substr($seg[2],4);
		} else {
			$itemURL .=  $seg[2];
		}
		$itemURL .=  "</a>";
	}
	$isFriend = "";
	if (isset($id)){
		$friendshipQuery = mysqli_query($connect, "SELECT * FROM relationships WHERE (userID1 = '$id' AND userID2 = '$userID' AND relationshipTypeID = '2') OR (userID1 = '$id' AND userID2 = '$userID' AND relationshipTypeID = '4') OR (userID1 = '$userID' AND userID2 = '$id' AND relationshipTypeID = '3') OR (userID1 = '$userID' AND userID2 = '$id' AND relationshipTypeID = '4')");
	}
	
	if (isset($friendshipQuery) && mysqli_num_rows($friendshipQuery) == 1){
		$isFriend = "yes";
	} else {
		$isFriend = "no";
	}
	
	
	
	
	
	
	?>