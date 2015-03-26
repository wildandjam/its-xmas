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
/*if (!isset($id) || !($id > 0)){
	if (isset($_SESSION)){
		if (isset($_SESSION['id'])){
			$id = $_SESSION['id'];
		}
		if (isset($_SESSION['name'])){
			$name = $_SESSION['name'];
		}
		if (isset($_COOKIE['username'])){
			$uu = $_COOKIE['username'];
		}
	} else {
		$id = false;
	}
}*/
if (isset($id) && ($id > 0)){
	$userControllerQuery = mysqli_query($connect, "SELECT * FROM users WHERE userID = '$id'");
	$userControllerRows = mysqli_num_rows($userControllerQuery);

	if ($userControllerRows == 1){
		while($xUserRow = mysqli_fetch_object($userControllerQuery)){
			$xID = $xUserRow->userID;	
			$xUserEmail = $xUserRow->userEmail;
			$xUsername = $xUserRow->userName;

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
		}

	}
} else {
	$id = false;
}
?>