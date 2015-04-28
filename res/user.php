<?php 
if (isset($id)){
} else {
	if (isset($_SESSION['id'])){
		$id = $_SESSION['id'];
	} else {
		if (isset($_COOKIE['id'])){
			$id = $_COOKIE['id'];
		} else {
			$id = false;
		}
	}
}
if (isset($id) && ($id > 0)){
	$userControllerQuery = mysqli_query($connect, "SELECT * FROM users WHERE userID = '$id'");
	$userControllerRows = mysqli_num_rows($userControllerQuery);

	if ($userControllerRows == 1){
		while($xUserRow = mysqli_fetch_object($userControllerQuery)){
			$xID = $xUserRow->userID;	
			$xUserEmail = $xUserRow->userEmail;
			$xUsername = $xUserRow->userName;
			$xUser = true;
		}
		$userDetailsControllerQuery = mysqli_query($connect, "SELECT * FROM userdetails WHERE userID = '$xID'");
		$userDetailControllerRows = mysqli_num_rows($userDetailsControllerQuery);

		if ($userDetailControllerRows == 1){
			while($xUserDetailRow = mysqli_fetch_object($userDetailsControllerQuery)){
				$xFirstName = $xUserDetailRow->userFirstName;
				$xLastName = $xUserDetailRow->userLastName;
				$xGender = $xUserDetailRow->userGender;
				$xDOB = $xUserDetailRow->userDOB;
				$xBio = $xUserDetailRow->userBio;
				$xLocation = $xUserDetailRow->userLocation;
				$xPrivate = $xUserDetailRow->userPrivate;
			}
			$xUserDetails = true;
		} else {
			$xUserDetails = false;
		}

		$userAvatarQuery = mysqli_query($connect, "SELECT * FROM userAvatars WHERE userID = '$xID' AND userAvatarSelected ='1'");
		$userAvatarCount = mysqli_num_rows($userAvatarQuery);

		if ($userAvatarCount > 0){
			while($userAvatarRow = mysqli_fetch_assoc($userAvatarQuery)){
				$userAvatarSrc = $userAvatarRow['userAvatarSrc'];
			}
			$userAvatar = '/images/avatars/' . $userAvatarSrc;
			$userAvatarBool = true;
		} else {
			$userAvatarBool = false;
		}
	} else {
		$xUser = true;
		$xUserDetails = false;
	}
} else {
	$id = false;
	$xUser = true;
	$xUserDetails = false;
}
?>